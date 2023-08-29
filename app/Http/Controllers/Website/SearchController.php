<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $product = Product::where("name", "LIKE", "%".$request->search."%")
                            ->orWhere("slug", "LIKE", "%".$request->search."%")
                            ->orWhere("model", "LIKE", "%".$request->search."%")
                            ->orWhere("selling_price", "LIKE", "%".$request->search."%")
                            ->orWhere("description", "LIKE", "%".$request->search."%")
                            ->paginate(60);
        $categories = Category::withCount('products')->take(2)->get();
        $metaCategories = Category::withCount('products')->take(2)->get();
        $brands = Brand::withCount('product')->orderBy('id', 'asc')->get();
        return view('pages.category', compact('product', 'categories', 'brands', 'metaCategories'));
    }

    // Get Product
    public function productGet(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $product = Product::where("name", "LIKE", "%".$request->search."%")
                            ->orWhere("slug", "LIKE", "%".$request->search."%")
                            ->orWhere("model", "LIKE", "%".$request->search."%")
                            ->orWhere("selling_price", "LIKE", "%".$request->search."%")
                            ->orWhere("description", "LIKE", "%" . $request->search . "%")
                            ->take(15)->get();

        return $product;
    }

}