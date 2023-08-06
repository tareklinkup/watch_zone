<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::latest()->get();
        return view('admin.slider', compact('slider'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:191',
            'image' => 'required|mimes:jpg,webp,png,gif,mp4',
        ]);

        try {
            $slider = new Slider();
            $slider->title = $request->title;
            $slider->image = $this->imageUpload($request, 'image', 'uploads/sllider');
            $slider->link = $request->link;
            $slider->created_by = 1;
            $slider->ip_address = $request->ip();
            $slider->save();

            $notification=array(
                'message'=>'Slider Added Successfully',
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
        $slider = Slider::latest()->get();
        $sliderData = Slider::find($id);
        return view('admin.slider', compact('slider', 'sliderData'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|max:191',
            'image' => 'mimes:jpg,webp,png,gif,mp4'
        ]);

        try {
            $slider = Slider::find($id);

            $sliderImg = $slider->image;
            if ($request->hasFile('image')) {
                if (!empty($slider->image) && file_exists($slider->image)) 
                    unlink($slider->image);
                $sliderImg = $this->imageUpload($request, 'image', 'uploads/sllider');
            }


            $slider->title = $request->title;
            $slider->image = $sliderImg;
            $slider->link = $request->link;
            $slider->updated_by = 1;
            $slider->ip_address = $request->ip();
            $slider->save();

            $notification=array(
                'message'=>'Slider Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('slider.index')->with($notification);

        } catch (\Exception $e) {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function inactive($id)
    {
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->save();

        $notification=array(
            'message'=>'Slider Inactive Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function active($id)
    {
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->save();

        $notification=array(
            'message'=>'Slider Active Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function destroy(Request $request)
    {
        try {
            $slider = Slider::find($request->id);
            if($slider){
                if(file_exists($slider->image) AND !empty($slider->image)){
                    unlink($slider->image);
                }
                
                $slider->delete();
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
