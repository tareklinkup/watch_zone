<?php

namespace App\Http\Controllers\Admin;

use Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use stdClass;

class OrderController extends Controller
{
    public function pendingOrder()
    {
        if (auth()->user()->cannot('Pending Order')) {
            abort(404);
        }
        $order = Order::where('status', 'Pending')->latest()->get();
        return view('admin.orders.pending', compact('order'));
    }
    //all order
    public function allOrder()
    {
        // if (auth()->user()->cannot('All Order')){
        //     abort(404);
        // }
        $order = Order::where('status')->latest()->get();
        return view('admin.orders.allOrder', compact('order'));
    }

    // Order Details View Method
    public function showOrder($id)
    {
        $order = Order::with('customer')->where('id', $id)->first();
        $orderItem = OrderDetail::with('product')->where('order_id', $id)->latest()->get();
        return view('admin.orders.show', compact('order', 'orderItem'));
    }

    // View Confirm Order
    public function confirmOrder()
    {
        if (auth()->user()->cannot('Confirm Order')) {
            abort(404);
        }
        $order = Order::where('status', 'confirm')->latest()->get();
        return view('admin.orders.confirm', compact('order'));
    }

    // Order Processing
    public function processingOrder()
    {
        if (auth()->user()->cannot('Processing Order')) {
            abort(404);
        }
        $order = Order::where('status', 'processing')->latest()->get();
        return view('admin.orders.processing', compact('order'));
    }

    // Order Delivered
    public function deliveredOrder()
    {
        if (auth()->user()->cannot('Delivered Order')) {
            abort(404);
        }
        $order = Order::where('status', 'delivered')->latest()->get();
        return view('admin.orders.delivered', compact('order'));
    }

    // Canceled Order
    public function canceledOrder()
    {
        if (auth()->user()->cannot('Canceled Order')) {
            abort(404);
        }
        $order = Order::where('status', 'Cancelled')->latest()->get();
        return view('admin.orders.canceled', compact('order'));
    }

    // Order Pending to Confirm Method
    public function pendingToConfirm($id)
    {
        $order = Order::find($id);
        $order->status = 'Confirm';
        $order->confirmed_date = Carbon::now();
        $order->save();


        $notification = array(
            'message' => 'Order Confirm Success',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.confirm.order')->with($notification);
    }


    // Order Pending to Cancel Method
    public function pendingToCanceled($id)
    {
        $order = Order::find($id);
        $order->status = 'Cancelled';
        $order->cancel_date = Carbon::now();
        $order->save();


        $this->sms("Hi, {$order->name} \n Your order #17079 at Watch Zone has been cancelled. Please contact our customer service team for any questions or concerns. \n Thanks, \n Watch Zone \n Hotline: 01934-764333 ", $order->phone);

        $notification = array(
            'message' => 'Order Cancelled Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.pending.order')->with($notification);
    }
    // Order delivery to Cancel Method
    public function deliveredToCanceled($id)
    {
        $order = Order::find($id);
        $order->status = 'Cancelled';
        $order->cancel_date = Carbon::now();
        $order->save();

        $this->sms("Hi, {$order->name} \n Your order #17079 at Watch Zone has been cancelled. Please contact our customer service team for any questions or concerns. \n Thanks, \n Watch Zone \n Hotline: 01934-764333 ", $order->phone);

        $notification = array(
            'message' => 'delivered Cancelled Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.delivered.order')->with($notification);
    }

    // Order delivery to Cancel Method
    // public function customerCanceled($id)
    // {
    //     $order = Order::find($id);
    //     $order->status = 'Cancel';
    //     $order->cancel_date = Carbon::now();
    //     $order->save();

    //     $notification = array(
    //         'message' => 'Order Cancel Success',
    //         'alert-type' => 'success'
    //     );
    //     return Redirect()->back()->with($notification);
    // }
    // Order confirm to panding
    public function processingToConfirm($id)
    {
        $order = Order::find($id);
        $order->status = 'Confirm';
        $order->confirmed_date = Carbon::now();
        $order->save();

        $notification = array(
            'message' => 'Order processing to confirm Success',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.confirm.order')->with($notification);
    }
    // Order picked to processing
    public function pickedToProcessing($id)
    {
        $order = Order::find($id);
        $order->status = 'Processing';
        $order->processing_date = Carbon::now();
        $order->save();

        $notification = array(
            'message' => 'Order picked  to processing Success',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.processing.order')->with($notification);
    }
    // Order confirm to panding
    public function confirmToPending($id)
    {
        $order = Order::find($id);
        $order->status = 'Pending';
        $order->confirmed_date = Carbon::now();
        $order->save();

        $notification = array(
            'message' => 'Order confirm to pending Success',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.pending.order')->with($notification);
    }

    // Order Confirm to Processing Method
    public function confirmToProcessing($id)
    {
        $order = Order::find($id);
        $order->status = 'Processing';
        $order->processing_date = Carbon::now();
        $order->save();

        $this->sms("Hi, {$order->name} \n we are currently processing your order", $order->phone);

        $notification = array(
            'message' => 'Order Processing Success',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.processing.order')->with($notification);
    }


    // Order Shipped to Delivered Method
    public function processingToDelivered($id)
    {
        $order = Order::find($id);
        $order->status = 'Delivered';
        $order->delivered_date = Carbon::now();
        $order->save();


        $this->sms("Hi, {$order->name} \n Your order {$order->order_number} has been delivered. Thank you for Purchasing from us. Please let us know if you have any questions. \n Watch Zone \n Hotline: 01934-764333 ", $order->phone);

        $notification = array(
            'message' => 'Order Delivered Success',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.delivered.order')->with($notification);
    }
    // Order delivery to shipped
    public function deliveredToProcessing($id)
    {
        $order = Order::find($id);
        $order->status = 'Processing';
        $order->processing_date = Carbon::now();
        $order->save();

        $notification = array(
            'message' => 'Order Processing Success',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.processing.order')->with($notification);
    }


    // Order Print
    public function printOrder($id)
    {
        $order = Order::where('id', $id)->first();
        $orderItem = OrderDetail::with('product')->where('order_id', $id)->latest()->get();
        return view('admin.orders.order_print', compact('order', 'orderItem'));
    }
    // Order Print
    public function printDiv($id)
    {
        $order = Order::where('id', $id)->first();
        $orderItem = OrderDetail::with('product')->where('order_id', $id)->latest()->get();
        return view('admin.orders.order_print', compact('order', 'orderItem'));
    }

    public function newOrder()
    {
        $customers = Customer::get();
        $products = Product::get();
        return view('admin.orders.newOrder', compact('customers', 'products'));
    }

    public function newOrderStore(Request $request)
    {
        $res = new stdClass();

        try {
            $orderData = $request->order;

            $order = new Order();
            $order->customer_id = $orderData['customerId'];
            $order->name = $orderData['name'];
            $order->b_name = $orderData['b_name'] ?? NULL;
            $order->email = $orderData['email'];
            $order->b_email = $orderData['b_email'] ?? NULL;
            $order->phone = $orderData['phone'];
            $order->b_phone = $orderData['b_phone'] ?? NULL;
            $order->address = $orderData['address'];
            $order->b_address = $orderData['b_address'] ?? NULL;
            $order->payment_type = 'Cash';
            $order->amount = $orderData['total'];
            $order->total_amount = $orderData['total'];
            $order->couponDiscount = 0;
            $order->order_number = 'WZ'.mt_rand(10000000,99999999);
            $order->ship_charge = 80;
            $order->order_date = Carbon::now()->format('d F Y');
            $order->order_month = Carbon::now()->format('F');
            $order->order_year = Carbon::now()->format('Y');
            $order->status = 'Pending';
            $order->save();

            $orderCart = $request->cart;

            foreach ($orderCart as $product) {
                $order_details = new OrderDetail();
                $order_details->order_id = $order->id;
                $order_details->product_id = $product['productId'];
                $order_details->price = $product['total'];
                $order_details->quantity = $product['qty'];
                $order_details->save();

                // main stock update
                $productData = Product::where('id', $product['productId'])->first();
                $stock = $productData->quantity - $product['qty'];
                $productData->update(['quantity' => $stock]);
            }
            $res->message = 'Order Successfully Saved!';

        } catch (\Exception $e) {
            $res->message = 'Something went wrong!';
        }
        return response(['message' => $res->message , 'success' => true]);
    }
}