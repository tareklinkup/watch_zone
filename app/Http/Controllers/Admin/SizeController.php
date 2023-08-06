<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $brand = Brand::get();
        $size = Size::latest()->get();
        $category = Category::take(2)->get();
        return view('admin.size.index', compact('brand', 'size', 'category'));
    }

    
    public function  store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        try {
            $size = new Size();
            $size->name = $request->name;
            $size->brand_id = $request->brand_id;
            $size->category_id = $request->category_id;
            $size->created_by = 1;
            $size->ip_address = $request->ip();
            $size->save();

            $notification = array(
                'message' => 'Size Added Successfully',
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
        $brand = Brand::get();
        $size = Size::latest()->get();
        $sizeData = Size::find($id);
        $category = Category::take(2)->get();
        return view('admin.size.index', compact('size', 'sizeData', 'brand', 'category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $size = Size::find($id);
            $size->name = $request->name;
            $size->brand_id = $request->brand_id;
            $size->category_id = $request->category_id;
            $size->updated_by = 1;
            $size->ip_address = $request->ip();
            $size->save();

            $notification = array(
                'message' => 'Size Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('size.index')->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function delete(Request $request)
    {
        try {
            $size = Size::find($request->id);
            if ($size) {
                $size->delete();
            }

            return response()->json([
                'message' => 'Size Deleted Successfully',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'success' => false
            ]);
        }
    }

    public function getCasesize(Request $req)
    {
        $casesize = Size::where('brand_id', $req->brandId)->where('category_id', $req->categoryId)->get();
        return $casesize;
    }
}
