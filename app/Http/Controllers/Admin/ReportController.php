<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;

class ReportController extends Controller
{
    public function order()
    {
        return view('admin.report.index');
    }

    public function orderReport(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $product = $request->name;
        $product_stock = Product::where('status', 1);
        if ($request->from_date && $request->to_date) {
            $product_stock = $product_stock->whereBetween('created_at', [$from_date,$to_date]);
        }
        if ($request->name) {
            $product_stock = $product_stock->where('name', $product);
        }
        $get_product_stock = $product_stock->get();
        $products = Product::get();
        $brand = Brand::get();
        $category = Category::get();
        return view('admin.report.index', compact('products', 'get_product_stock', 'brand' ,'category'));
    }

    public function viewOrderReport()
    {
        $orders = Order::latest()->get();
        return view('admin.report.order_report', compact('orders'));
    }

    public function getOrderReport(Request $request)
    {
        $from_date = $request->date_from.' 00:00:00';
        $to_date = $request->date_to.' 23:59:59';

        $orders = Order::whereBetween('created_at',[$from_date,$to_date])->latest()->get();
        return $orders;
    }

    
    public function searchCategoryBrand(Request $request) {

         dd($request->all());
        $category = $request->category;
        $brand    = $request->brand;

        $products = Product::query();

        if ($category) {
            $products = $products->where('category_id', $category);
        }

        if ($brand) {
            $products = $products->where('brand_id', $brand);
        }

        $products = $products->get();
        $category = Category::get();
        $brand = Brand::get();
        return view('admin.report.index', compact('products', 'category', 'brand'));

    }
}
