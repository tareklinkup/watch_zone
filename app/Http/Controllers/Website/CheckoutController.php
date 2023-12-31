<?php

namespace App\Http\Controllers\Website;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutStore(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name' => 'required|max:60',
            'phone' => 'required|digits:11',
            'address' => 'required|max:191',
            'order_total' => 'required',
            'area' => 'required',
            'district' => 'required',
            'total_amount' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $order = new Order();
            $order->customer_id = Auth::guard('customer')->user()->id;
            $order->name = $request->name;
            $order->b_name = $request->b_name;
            $order->email = $request->email;
            $order->b_email = $request->b_email;
            $order->phone = $request->phone;
            $order->b_phone = $request->b_phone;
            $order->district = $request->district;
            $order->b_district = $request->b_district;
            $order->address = $request->address;
            $order->b_address = $request->b_address;
            $order->payment_type = $request->payment_type;
            $order->amount = $request->order_total;
            $order->total_amount = $request->total_amount;
            $order->couponDiscount = $request->couponDiscount;
            $order->order_number = 'WZ'.mt_rand(10000000,99999999);
            $order->ship_charge = $request->ship_charge;
            $order->order_date = Carbon::now()->format('d F Y');
            $order->order_month = Carbon::now()->format('F');
            $order->order_year = Carbon::now()->format('Y');
            $order->status = 'Pending';
            $order->save();


            $contents = Cart::content();
            // return $contents;
            foreach ($contents as $content) {
                $order_details = new OrderDetail();
                $order_details->order_id = $order->id;
                $order_details->product_id = $content->id;
                $order_details->price = $content->price;
                $order_details->quantity = $content->qty;
                $order_details->save();

                // main stock update
                $product = Product::where('id', $content->id)->first();
                $stock = $product->quantity - $content->qty;
                $product->update(['quantity' => $stock]);
            }

            Cart::destroy();

            DB::commit();


            // $orderNumber = 'WZ'.mt_rand(10000000, 99999999);

          $this->sms("Hi, {$request->name} \n Your Order is successfully placed. Your Order number: {$order->order_number} and Total Bill: {$request->total_amount} Taka. Delivery Time: Inside of Dhaka: 1-2 days and Outside of Dhaka: 2-4 days \n Thanks, \n Watch Zone \n Hotline: 01934-764333 ", $request->phone);

            $user = Auth::guard('customer')->user();
            // $order = Order::with('order_details')->where('id', $order->id)->first();
            $order = Order::where('id', $order->id)->first();
            $orderItem = OrderDetail::with('product')->where('order_id', $order->id)->latest()->get();
            $this->sendOrderConfirmationEmail($user, $order, $orderItem);

            $notification = array(
                'message'=>'Your Order Taken Successfully',
                'alert-type'=>'success'
            );

            return Redirect()->route('customer.order.show', $order->id)->with($notification);

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }

    }
}