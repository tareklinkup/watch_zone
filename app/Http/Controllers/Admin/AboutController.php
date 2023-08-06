<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('admin.about', compact('about'));
    }

    public function update(Request $request, $id)
    {
        
        try {
            $about = About::find($id);
            $about->privacy_desc = $request->privacy_desc;
            $about->terms_desc = $request->terms_desc;
            $about->updated_by = 1;
            $about->ip_address = $request->ip();
            $about->save();
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
