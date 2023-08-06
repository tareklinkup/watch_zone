<?php

namespace App\Http\Controllers\Website;

use stdClass;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CustomerController extends Controller
{
    public function registerCustomer()
    {
        return view('auth.customer.register');
    }

    public function customerRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            // 'email' => 'required|email|unique:customers,email|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'required|regex:/^01[13-9][\d]{8}$/|digits:11|unique:customers,phone',
            'password' => 'required|confirmed|min:6',
            'password' => 'required'
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->password = bcrypt($request->password);
        $customer->save();

        if ($customer) {
            $notification = array(
                'message' => 'Registration Successfully',
                'alert-type' => 'success'
            );
            Auth::guard('customer')->login($customer);
            if($request->loginDetail == true) {
                return redirect()->route('product.checkout')->with($notification);
            } else {
                return redirect()->route('customer.dashboard')->with($notification);
            }
            // return redirect()->route('customer.dashboard')->with($notification);
        }

        return redirect()->back()->withInput();
    }

    public function loginPage()
    {
        return view('auth.customer.login');
    }

    public function loginCheck(Request $request)
    {

        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);


        $credentiads = $request->only('phone', 'password');
        if (Auth::guard('customer')->attempt($credentiads)) {
            $notification = array(
                'message' => 'Login Successfully',
                'alert-type' => 'success'
            );

                // return redirect()->intended()->with($notification);
                if($request->loginDetail == true) {
                    return redirect()->route('product.checkout')->with($notification);
                } else {
                    return redirect()->route('customer.dashboard')->with($notification);
                }
            
        }
        return redirect()->back()->withInput($request->only('phone'))->with('error', 'Phone number or Password was invalid.');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('home');
    }

    public function showForgotForm()
    {
        return view('auth.customer.forgot');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:11|phone|exists:customers,phone'
        ], [
            'phone.required' => 'You have to choose the file!',
            'phone.exists' => 'The selected phone have no account!'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'phone' => $request->phone,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // $app_name = CompanyProfile::first();
        $action_link = route('customer.reset.password.form', ['token' => $token, 'phone' => $request->phone]);
        $body = "We have received a request to reset the password for <b>Watch Zone</b> account associated with " . $request->phone . ". You can reset your password by clicking the link below.";

        Mail::send('email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('info@watchzone.com', 'Watch Zone');
            $message->to($request->phone, 'Hi')
                ->subject('Reset Password');
        });

        return back()->with('success', 'We sent your password reset OTP');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.customer.reset')->with(['token' => $token, 'phone' => $request->phone]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|min:2|confirmed',
            'password_confirmation' => 'required',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$check_token) {
            return back()->withInput()->with('fail', 'Invalid token');
        } else {
            Customer::where('email', $request->email)->update([
                'password' => bcrypt($request->password)
            ]);

            DB::table('password_resets')->where([
                'email' => $request->email
            ])->delete();

            $notification = array(
                'message' => 'Your password has been changed!',
                'alert-type' => 'success'
            );
            return redirect()->route('customer.login.page')->with($notification)->with('verifiedEmail', $request->email);
        }
    }

    public function getCustomers()
    {
        $customers = Customer::latest()->get();
        return $customers;
    }

    public function addCustomers(Request $request)
    {
        $res = new stdClass();

        try {            
            $customerData = $request->customer;

            $customer = new Customer();
            $customer->id = $customerData['id'];
            $customer->name = $customerData['name'];
            $customer->phone = $customerData['phone'];
            $customer->email = $customerData['email'];
            $customer->address = $customerData['address'];
            $customer->password = bcrypt($customerData['password']);
            $customer->save();
            $res->message = 'Customer Successfully Saved!';

        } catch (\Exception $e) {
            $res->message = 'Something went wrong!';
        }
        return response(['message' => $res->message , 'success' => true]);
    }
}
