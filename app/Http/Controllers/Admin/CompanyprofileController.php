<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyprofileController extends Controller
{
    public function index()
    {
        $profile = CompanyProfile::first();
        return view('admin.company_profile', compact('profile'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {
            $com_profile = CompanyProfile::find($id);

            //logo image 
            $logoImg = $com_profile->logo;
            if ($request->hasFile('logo')) {
                if (!empty($com_profile->logo) && file_exists($com_profile->logo)) 
                    unlink($com_profile->logo);
                $logoImg = $this->imageUpload($request, 'logo', 'uploads/company');
            }

            //Advertisman image 
            $addImg = $com_profile->add_image;
            if ($request->hasFile('add_image')) {
                if (!empty($com_profile->add_image) && file_exists($com_profile->add_image)) 
                    unlink($com_profile->add_image);
                $addImg = $this->imageUpload($request, 'add_image', 'uploads/company');
            }
            //contact image 
            $contactImg = $com_profile->contact_image;
            if ($request->hasFile('contact_image')) {
                if (!empty($com_profile->contact_image) && file_exists($com_profile->contact_image)) 
                    unlink($com_profile->contact_image);
                $contactImg = $this->imageUpload($request, 'contact_image', 'uploads/company');
            }

            $com_profile->com_name = $request->com_name;
            $com_profile->phone_one = $request->phone_one;
            $com_profile->phone_two = $request->phone_two;
            $com_profile->email = $request->email;
            $com_profile->website = $request->website;
            $com_profile->address = $request->address;
            $com_profile->facebook = $request->facebook;
            $com_profile->twitter = $request->twitter;
            $com_profile->google = $request->google;
            $com_profile->youtube = $request->youtube;
            $com_profile->instagram = $request->instagram;
            $com_profile->linkedin = $request->linkedin;
            $com_profile->pinterest = $request->pinterest;
            $com_profile->whatsapp = $request->whatsapp;
            $com_profile->footer_text = $request->footer_text;
            $com_profile->logo = $logoImg;
            $com_profile->add_image = $addImg;
            $com_profile->contact_image = $contactImg;
            $com_profile->map = $request->map;
            $com_profile->save();

            $notification=array(
                'message'=>'Data Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);

        } catch (\Exception $e) {

            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification,$e);
        }
    }
}
