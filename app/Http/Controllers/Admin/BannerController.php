<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::get();
        return view('admin.banner.index', compact('banner'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|mimes:jpg,webp,png,gif,mp4',
        ]);

        try {
             $image = $request->file('image');
            $imageName  = 'banner' . rand() .'.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(1200, 424)->save('uploads/banner/' .$imageName);
            $banner = new Banner();
            $banner->link = $request->link;
            $banner->title = $request->title;
            $banner->image = 'uploads/banner/'.$imageName;
            $banner->created_by = 1;
            $banner->ip_address = $request->ip();
            $banner->save();

            $notification=array(
                'message'=>'banner Added Successfully',
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

        $banner = Banner::get();
        $bannerData = Banner::find($id);
        return view('admin.banner.index', compact('banner', 'bannerData'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'image' => 'mimes:jpg,webp,png,gif,mp4'
        ]);

        try {
            $banner = Banner::find($id);

          
            $image = $request->file('image');
            if ($request->hasFile('image')) {
                if (!empty($banner->image) && file_exists($banner->image)) 
                    unlink($banner->image);
                $imageName  = 'banner' . rand() .'.'. $image->getClientOriginalExtension();
                Image::make($image)->resize(1200, 424)->save('uploads/banner/' .$imageName);
            }

            $banner->image = 'uploads/banner/'.$imageName;
            $banner->link = $request->link;
            $banner->title = $request->title;
            $banner->updated_by = 1;
            $banner->ip_address = $request->ip();
            $banner->save();

            $notification=array(
                'message'=>'Banner Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('banner.index')->with($notification);

        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function delete(Request $request)
    {
        try {
            $banner = Banner::find($request->id);
            if($banner){
                if(file_exists($banner->image) AND !empty($banner->image)){
                    unlink($banner->image);
                }
                
                $banner->delete();
            }

            return response()->json([
                'message'=>'Data Deleted Successfully',
                'success'=> true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Something went wrong!',
                'success'=> false
            ]);
        }
    }
}
