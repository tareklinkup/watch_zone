<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function index()
    {
        $brand = Brand::get();
        $movement = Movement::latest()->get();
        $category = Category::take(2)->get();
        return view('admin.movement.index', compact('brand', 'movement', 'category'));
    }

    public function  store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        try {
            $movement = new Movement();
            $movement->name = $request->name;
            $movement->brand_id = $request->brand_id;
            $movement->category_id = $request->category_id;
            $movement->created_by = 1;
            $movement->ip_address = $request->ip();
            $movement->save();

            $notification = array(
                'message' => 'movement Added Successfully',
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
        $movement = Movement::latest()->get();
        $movementData = Movement::find($id);
        $category = Category::take(2)->get();
        return view('admin.movement.index', compact('brand', 'movement', 'movementData', 'category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $movement = Movement::find($id);
            $movement->name = $request->name;
            $movement->brand_id = $request->brand_id;
            $movement->category_id = $request->category_id;
            $movement->updated_by = 1;
            $movement->ip_address = $request->ip();
            $movement->save();

            $notification = array(
                'message' => 'movement Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('movement.index')->with($notification);
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
            $movement = Movement::find($request->id);
            if ($movement) {
                $movement->delete();
            }

            return response()->json([
                'message' => 'movement Deleted Successfully',
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'success' => false
            ]);
        }
    }

    public function getMovements(Request $req)
    {
        $movements = Movement::where('brand_id', $req->brandId)->where('category_id', $req->categoryId)->get();
        return $movements;
    }
}
