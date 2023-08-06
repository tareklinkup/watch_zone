<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
      $todaysOrder = Order::where('order_date', date('d F Y'))->count();
      $todaysTotal = Order::where('order_date', date('d F Y'))->sum('total_amount');
      $monthOrder = Order::where('order_month', date('F'))->count();
      $monthTotal = Order::where('order_month', date('F'))->sum('total_amount');
      $yearlyOrder = Order::where('order_year', date('Y'))->count();
      $yearTotal = Order::where('order_year', date('Y'))->sum('total_amount');
      $totalAmount = Order::sum('total_amount'); 
        return view('admin.index', compact('todaysOrder', 'todaysTotal', 'monthTotal', 'monthOrder', 'yearlyOrder', 'yearTotal', 'totalAmount'));
    }

    public function customerList()
    {
        $customers = Customer::latest()->get();
        return view('admin.customer_list', compact('customers'));
    }    

}
