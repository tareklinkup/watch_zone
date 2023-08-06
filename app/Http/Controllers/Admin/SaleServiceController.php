<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class SaleServiceController extends Controller
{
    public function saleService()
    {

        $sale = About::first();
        return view('admin.sale_customer', compact('sale'));
    }

    public function saleUpdate(Request $request, $id)
    {
        try {
            $sale = About::find($id);
            $sale->customer_service = $request->customer_service;
            $sale->updated_by = 1;
            $sale->ip_address = $request->ip();
            $sale->save();
            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {
            return $e->getMessage();
          
        }
        
    }
}
