<?php

namespace App\Http\Controllers\Website;

use Cart;
use App\Models\Size;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\District;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Faker\Provider\ka_GE\DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        // $cartQty = Cart::count();
        return view('pages.cart_page');
    }

    // Product Cart Store
    public function cartStore($id)
    {
        $product = Product::where('id', $id)->first();

        $data=array();
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = 1;
        $data['price'] = $product->discount == NULL ? $product->selling_price : ($product->selling_price - $product->discount_price);

        $data['weight'] = 0;
        $data['options']['image'] = $product->image;
        Cart::add($data);

        return response()->json(['success' => 'Sucessfully Added to Cart']);
    }

    // Product Cart Buying
    public function cartStoreBuying($id)
    {
        $product = Product::where('id', $id)->first();

        $data=array();
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = 1;
        $data['price'] = $product->discount == NULL ? $product->selling_price : ($product->selling_price - $product->discount_price);

        $data['weight'] = 0;
        $data['options']['image'] = $product->image;
        Cart::add($data);

        return response()->json(['success' => 'Sucessfully Buying Product']);
    }

    // product Cart store

    public function addCart(Request $request)
    {
         $product = Product::where('id', $request->product_id)->first();

        $data=array();
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = $request->qty;
        $data['price'] = $product->discount == NULL ? $product->selling_price : ($product->selling_price - $product->discount_price);

        $data['weight'] = 0;
        $data['options']['image'] = $product->image;
        Cart::add($data);

        return redirect()->route('product.cart');

        // return response()->json(['success' => 'Sucessfully Buying Product']);
    }

    // Product Cart Buying
    public function cartStoreingBuying($id)
    {
        $product = Product::where('id', $id)->first();

        $data=array();
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = 1;
        $data['price'] = $product->discount == NULL ? $product->selling_price : ($product->selling_price - $product->discount_price);

        $data['weight'] = 0;
        $data['options']['image'] = $product->image;
        Cart::add($data);

        return response()->json(['success' => 'Sucessfully Buying Product']);
    }

    // get Mini Cart Data
    public function miniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::totalFloat();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    }

    public function miniCartRemove($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);
    }

    // get All Product Cart Data
    public function getAllCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    }

    // Cart Destroy
    public function cartDestroy($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);
    }

    // cart Increament
    public function cartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        return response()->json('increment');
    }

    // Cart Decrement
    public function cartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        if ($row->qty == 1) {
            return response()->json('not decrement');
        }else {
            Cart::update($rowId, $row->qty - 1);
            return response()->json('decrement');
        }
    }

    // Checkout Method
    public function checkout()
    {
        $value = false;
        if(!auth()->guard('customer')->check()){
            $value = true;
            Session::flash('loginDetail', $value);

            return redirect()->route('customer.register');
        }
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::totalFloat();
        $district = District::all();
        $B_district = District::all();

        return view('pages.checkouts',compact('carts','cartQty','cartTotal','district', 'B_district'));
    }

    //  Apply Coupon Method
    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if(!$coupon){
            return response()->json(['error' => 'Invalid Coupon', 'success' => 'e']);
        }else{
            if(Cart::total() >= $coupon->target_amount) {
                return response()->json(array(
                    'validity' => true,
                    'success' => 'success',
                    'coupon_discount' => $coupon->coupon_discount,
                    'coupon_name' => $coupon->coupon_name
                ), 200);
            }else{
                return response()->json(['error' => 'Invalid Coupon', 'success' => 'e']);
            }


        }
    }

}