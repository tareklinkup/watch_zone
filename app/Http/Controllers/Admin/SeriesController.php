<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::latest()->get();
        $brand = Brand::get();
        $category = Category::take(2)->get();
        return view('admin.series.index', compact('brand', 'series', 'category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        try {
            $series = new Series();
            $series->name = $request->name;
            $series->category_id = $request->category_id;
            $series->brand_id = $request->brand_id;
            $series->created_by = 1;
            $series->ip_address = $request->ip();
            $series->save();

            $notification = array(
                'message' => 'Series Added Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function edit($id)
    {
        $series = Series::latest()->get();
        $seriesData = Series::find($id);
        $brand = Brand::get();
        $category = Category::take(2)->get();
        return view('admin.series.index', compact('series', 'seriesData', 'brand', 'category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $series = Series::find($id);
            $series->name = $request->name;
            $series->brand_id = $request->brand_id;
            $series->category_id = $request->category_id;
            $series->updated_by = 1;
            $series->ip_address = $request->ip();
            $series->save();

            $notification=array(
                'message'=>'Series Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('series.index')->with($notification);

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
            $series = Series::find($request->id);
            if($series){
                $series->delete();
            }
            
            return response()->json([
                'message'=>'Series Deleted Successfully',
                'success'=> true
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'message'=>'Something went wrong!',
                'success'=> false
            ]);
        }
    }

    public function getSeries(Request $req)
    {
        
        $series = Series::query();

        if(isset($req->categoryId)) {
            $series = $series->where('category_id', $req->categoryId);
        }
        
        if(isset($req->brandId)) {
            $series = $series->where('brand_id', $req->brandId);
        }

        $series = $series->get();
        return $series;
    }
}
