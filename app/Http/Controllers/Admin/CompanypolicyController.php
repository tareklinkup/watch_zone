<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanypolicyController extends Controller
{
    public function index()
    {
        $com_policy = CompanyPolicy::first();
        return view('admin.company_policy', compact('com_policy'));
    }


    public function update(Request $request, $id)
    {


        try {
            $com_policy = CompanyPolicy::find($id);
            $com_policy->delivery_desc = $request->delivery_desc;
            $com_policy->phycal_desc = $request->phycal_desc;
            $com_policy->warranty_desc = $request->warranty_desc;
            $com_policy->map_link = $request->map_link;
            $com_policy->updated_by = 1;
            $com_policy->ip_address = $request->ip();
            $com_policy->save();
            $notification = array(
                'message' => 'Data Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
