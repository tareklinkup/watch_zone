<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:District']);
    }

    public function index()
    {
        $district = District::latest()->get();
        return view('admin.district', compact('district'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:100',
            'amount' => 'required|numeric',
        ]);

        try {
            $district = new District();
            $district->name = $request->name;
            $district->amount = $request->amount;
            $district->ip_address = $request->ip();
            $district->created_by = Auth::user()->id;
            $district->save();

            $notification=array(
                'message'=>'Data Added Successfully',
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
        $district = District::latest()->get();
        $districtData = District::find($id);
        return view('admin.district', compact('district', 'districtData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'max:100',
            'amount' => 'numeric',
        ]);

        try {
            $district = District::find($id);
            $district->name = $request->name;
            $district->amount = $request->amount;
            $district->ip_address = $request->ip();
            $district->status = $request->status;
            $district->updated_by = Auth::user()->id;
            $district->save();

            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('district.index')->with($notification);

        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
