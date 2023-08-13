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