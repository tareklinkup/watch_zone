<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandMaterial;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandMaterialController extends Controller
{
    public function index()
    {
        $material = BrandMaterial::latest()->get();
        $brand = Brand::get();
        $category = Category::take(2)->get();
        return view('admin.material.index', compact('brand', 'material', 'category'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        try {
            $material = new BrandMaterial();
            $material->name = $request->name;
            $material->brand_id = $request->brand_id;
            $material->brand_id = $request->category_id;
            $material->created_by = 1;
            $material->ip_address = $request->ip();
            $material->save();

            $notification = array(
                'message' => 'Material Added Successfully',
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
        $material = BrandMaterial::latest()->get();
        $materialData = BrandMaterial::find($id);
        $category = Category::take(2)->get();
        return view('admin.material.index', compact('brand', 'material', 'materialData', 'category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $material = BrandMaterial::find($id);
            $material->name = $request->name;
            $material->brand_id = $request->brand_id;
            $material->category_id = $request->category_id;
            $material->updated_by = 1;
            $material->ip_address = $request->ip();
            $material->save();

            $notification = array(
                'message' => ' Material Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('material.index')->with($notification);
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
            $material = BrandMaterial::find($request->id);
            if ($material) {
                $material->delete();
            }

            return response()->json([
                'message' => 'Material Deleted Successfully',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'success' => false
            ]);
        }
    }

    public function getBrandMaterials(Request $req)
    {
        $materials = BrandMaterial::where('brand_id', $req->brandId)->where('category_id', $req->categoryId)->get();
        // $materials = BrandMaterial::where('category_id', $req->categoryId)->get();
        return $materials;
    }
}
