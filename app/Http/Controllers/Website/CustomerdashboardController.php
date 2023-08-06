<?php

namespace App\Http\Controllers\Website;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Wishlist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerdashboardController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();
        return view('pages.customer.index', compact('orders'));
    }

    
    // Customer Address page
    public function Cusaddress()
    {
        return view('pages.customer.address');
    }

    
    public function updateAddress(Request $request, $id)
    {
        try {
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->save();
            $notification = array(
                'message'=>'Profile Update Successfully',
                'alert-type'=>'success'
            );
            return back()->with($notification);

        } catch (\Exception $e) {
            $notification = array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return back()->with($notification);
        }
    }

    // Customer Order page
    public function cusOrder()
    {
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)->latest()->get();
        return view('pages.customer.order', compact('orders'));
    }

    // public function CustomerOrderShow()
    // {
    //     $order = Order::with(['customer'])->where('customer_id', Auth::guard('customer')->user()->id)->where('id', $id)->first();
    //     $orderItem = OrderDetail::with('product' )->where('order_id', $id)->latest()->get();
    //     return view('pages.customer.order_details',compact('order', 'orderItem'));
    // }
    public function CustomerOrderShow($id)
    {
        $order = Order::with(['customer'])->where('customer_id', Auth::guard('customer')->user()->id)->where('id', $id)->first();
        $orderItem = OrderDetail::with('product' )->where('order_id', $id)->latest()->get();
        return view('pages.customer.order_details',compact('order', 'orderItem'));
    }

    public function orderPrint($id)
    {
        $order = Order::with(['customer'])->where('customer_id', Auth::guard('customer')->user()->id)->where('id', $id)->first();
        $orderItem = OrderDetail::with('product')->where('order_id', $id)->latest()->get();
        return view('pages.customer.order_print', compact('order', 'orderItem'));
    }

    public function changePassword()
    {
        return view('pages.customer.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $has_password = Auth::guard('customer')->user()->password;

        if(Hash::check($request->old_password, $has_password)){
            $user = Customer::findOrFail(Auth::guard('customer')->id());
            $user->password = Hash::make($request->password);
            $user->save();
            
            $notification=array(
                'message'=>'Your Password Change Success',
                'alert-type'=>'success'
            );
            Auth::guard('customer')->logout();
            return Redirect()->route('index')->with($notification);
        }else{
            $notification=array(
                'message'=>'Old Password Not Match',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function customerCanceled($id)
    {
        $order = Order::find($id);
        $order->status = 'Cancel';
        $order->cancel_date = Carbon::now();
        $order->save();

        $notification = array(
            'message' => 'Order Cancel Success',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    
}
