<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupon', compact('coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
            'coupon_value' => 'required|numeric',
        ]);
        
        try {
            $coupon = new Coupon();
            $coupon->coupon_name = $request->coupon_name;
            $coupon->coupon_discount = $request->coupon_discount;
            $coupon->coupon_validity = $request->coupon_validity;
            $coupon->coupon_value = $request->coupon_value;
            $coupon->save();
            
            $notification=array(
                'message'=>'Coupon Added Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
        
    }

    public function edit($id)
    {
        $coupons = Coupon::latest()->get();
        $couponData = Coupon::find($id);
        return view('admin.coupon', compact('coupons', 'couponData'));
    }

    public function update(Request $request, $id)
    {
        try {
            $coupon = Coupon::find($id);
            $coupon->coupon_name = $request->coupon_name;
            $coupon->coupon_discount = $request->coupon_discount;
            $coupon->coupon_validity = $request->coupon_validity;
            $coupon->coupon_value = $request->coupon_value;
            $coupon->save();
            
            $notification=array(
                'message'=>'Coupon Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('admin.coupons')->with($notification);
        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $coupon = Coupon::find($request->id);
            if($coupon){
                $coupon->delete();
            }
            
            return response()->json([
                'message'=>'Data Deleted Successfully',
                'success'=> true
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Something went wrong!',
                'success'=> false
            ]);
        }
        
    }

}
