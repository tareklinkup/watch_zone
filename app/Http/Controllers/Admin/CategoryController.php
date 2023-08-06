<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Category Management']);
    }
    
    public function index()
    {
        $brands = Brand::get();
        $categories = Category::get();
        return view('admin.category', compact('categories', 'brands'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]);
        
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->brandChild = $request->brandChild ? join(',', $request->brandChild) : '';
            $category->image = $this->imageUpload($request, 'image', 'uploads/category');
            $category->is_homepage = $request->is_homepage;
            $category->created_by = 1;
            $category->ip_address = $request->ip();
            $category->save();

            $notification = array(
                'message'=>'Category Created!',
                'alert-type'=>'success'
            );
            return back()->with($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $categories = Category::get();
        $categoryData = Category::find($id);
        $brands_child = $categoryData ? explode(',', $categoryData->brandChild) : [];
        $brands = Brand::get();
        return view ('admin.category', compact('categories', 'brands', 'brands_child', 'categoryData'));

       
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'image' => 'Image|mimes:jpg,png,gif,webp'
        ]);
        
        try {
            $category = Category::find($id);
            //category image update
            $categoryImg = $category->image;
            if ($request->hasFile('image')) {
                if (!empty($category->image) && file_exists($category->image)) 
                    unlink($category->image);
                $categoryImg = $this->imageUpload($request, 'image', 'uploads/category');
            }

            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->brandChild = $request->brandChild ? join(',', $request->brandChild) : '';
            $category->image = $categoryImg;
            $category->is_homepage = $request->is_homepage;
            $category->updated_by = 1;
            $category->ip_address = $request->ip();
            $category->save();

            $notification = array(
                'message'=>'Category Updated Successfully!',
                'alert-type'=>'success'
            );
            return redirect()->route('category.index')->with($notification);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request,$id)
    {
        try {
            $checkProduct  = Product::where('category_id', $id)->count();
            if($checkProduct > 0) {
                return response()->json([
                    'message'=>'This category Already Used in product.Please! Product delete first',
                   'error' => true
                ]);
            }

            $category = Category::find($request->id);
            if($category){
                if(file_exists($category->image) AND !empty($category->image)){
                    unlink($category->image);
                }

                $category->delete();
            }

            return response()->json([
                'message'=>'Data Deleted Successfully',
                'success'=> true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message'=>'data deleted failed',
                'success'=> false
            ]);
        }
    }

    public function getCategory()
    {
        $category = Category::get();
        return $category;
    }


   
}
