<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $brand = Brand::get();
        $color = Color::latest()->get();
        $category = Category::take(2)->get();
        return view('admin.color.index', compact('brand', 'color', 'category'));
    }

    public function  store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        try {
            $color = new Color();
            $color->name = $request->name;
            $color->brand_id = $request->brand_id;
            $color->category_id = $request->category_id;
            $color->created_by = 1;
            $color->ip_address = $request->ip();
            $color->save();

            $notification = array(
                'message' => 'Color Added Successfully',
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
        $color = Color::latest()->get();
        $colorData = Color::find($id);
        $category = Category::take(2)->get();
        return view('admin.color.index', compact('brand', 'color', 'colorData','category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $color = Color::find($id);
            $color->name = $request->name;
            $color->brand_id = $request->brand_id;
            $color->category_id = $request->category_id;
            $color->updated_by = 1;
            $color->ip_address = $request->ip();
            $color->save();

            $notification = array(
                'message' => 'Color Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('color.index')->with($notification);
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
            $color = Color::find($request->id);
            if ($color) {
                $color->delete();
            }

            return response()->json([
                'message' => 'Color Deleted Successfully',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'success' => false
            ]);
        }
    }


    public function getDialColors(Request $req)
    {
        // $colors = Color::where('brand_id', $req->brandId)->get();
        // return $colors;

         $colors = Color::query();

        if(isset($req->brandId)) {
            $colors = $colors->where('brand_id', $req->brandId)->orderBy('name', 'asc');
        }

        if(isset($req->categoryId)) {
            $colors = $colors->where('category_id', $req->categoryId)->orderBy('name', 'asc');
        }

        $colors = $colors->get();
        return $colors;

    }

    public function getDialColorsCategory(Request $req)
    {
           $colors = Color::where(['brand_id' => $req->brandId, 'category_id' => $req->categoryId])->orderBy('name', 'asc')->get();
            return $colors;
    }
}
