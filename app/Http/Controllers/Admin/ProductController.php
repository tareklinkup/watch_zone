<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use Exception;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Banner;
use App\Models\Series;
use App\Models\Product;
use App\Models\Category;
use App\Models\Movement;
use App\Models\SizeColor;
use App\Models\OrderDetail;
use App\Models\ProductBand;
use App\Models\ProductCase;
use App\Models\ProductDial;
use App\Models\ProductItem;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\BrandMaterial;
use App\Models\ProductMovement;
use App\Models\ProductAdditional;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $brand = Brand::get();
        $series = Series::get();
        $material = BrandMaterial::get();
        $color = Color::get();
        $size = Size::get();
        $movement = Movement::get();
        $category = Category::get();
        $products = Product::latest()->get();
        return view('admin.product', compact('products', 'brand', 'category', 'series', 'material', 'color', 'size', 'movement'));
    }

    public function create()
    {
        $brand = Brand::get();
        $category = Category::get();
        return view('admin.product_create', compact('brand', 'category'));
    }

    public function seriesGet(Request $request)
    {
        // dd($request->all());
        $serise = Series::where(['brand_id' => $request->brand_id, 'category_id' => $request->category_id])->get();
        return response()->json($serise);
    }


    public function materialGet(Request $request)
    {
            //dd($request->brand_id);
        $marerial = BrandMaterial::where(['brand_id' => $request->brand_id, 'category_id' => $request->category_id])->get();
        return response()->json($marerial);
    }

    public function colorGet(Request $request)
    {
        // dd($request->all());
        $color = Color::where(['brand_id' => $request->brand_id, 'category_id' => $request->category_id])->get();
        return response()->json($color);
    }

    public function sizeGet(Request $request)
    {

        $size = Size::where(['brand_id' => $request->brand_id, 'category_id' => $request->category_id])->get();
        return response()->json($size);
    }

    public function movementGet(Request $request)
    {
        $movement = Movement::where(['brand_id' => $request->brand_id, 'category_id' => $request->category_id])->get();
        return response()->json($movement);
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp',

        ]);
        try{

        $price = $request->selling_price;
        $discount = (isset($request->discount_price) && $request->discount_price == 0) ? 0 : $request->discount_price;

        $image = $request->file('image');
        $Image  = 'main' . time() . rand() . $image->getClientOriginalName();
        $thumbImage = 'thumb-' . time() . rand() . $image->getClientOriginalName();

        Image::make($image)->resize(800, 800)->save('uploads/product/' . $Image);
        Image::make($image)->resize(800, 800)->save('uploads/product/thumbnail/' . $thumbImage);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->series_id = $request->series_id ?? null;
        $product->material_id = $request->material_id ?? null;
        $product->color_id = $request->color_id ?? null;
        $product->size_id = $request->size_id ?? null;
        $product->movement_id = $request->movement_id ?? null;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->model = $request->model ?? null;
        $product->selling_price = $request->selling_price;
        $product->discount = $request->discount;
        $product->discount_price = $discount ?? 0;
        $product->short_desc = $request->short_desc;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->warranty = $request->warranty ?? null;
        $product->meta_title = $request->meta_title ?? null;
        $product->meta_description = $request->meta_description ?? null;
        $product->meta_keywords = $request->meta_keywords ?? null;
        $product->resistant = $request->resistant ?? null;
        $product->image     = $Image;
        $product->thumb_image = $thumbImage;
        $product->otherimage = $this->imageUpload($request, 'otherimage', 'uploads/product');
        $product->ip_address = $request->ip();
        $product->status = 1;
        $product->created_by = Auth::user()->id;
        $product->save();

        foreach ($request->label as $key => $value) {
            $productItem = new ProductItem();
            $productItem->product_id =  $product->id;
            if (isset($request->label[$key]) && isset($request->value[$key])) {
                $productItem->label = $request->label[$key] ?? '';
                $productItem->value = $request->value[$key] ?? '';
                $productItem->save();
            }
        }

        foreach ($request->case_label as $key => $case_value) {
            $productCase = new ProductCase();
            $productCase->product_id =  $product->id;
            if (isset($request->case_label[$key]) && isset($request->case_value[$key])) {
                $productCase->case_label = $request->case_label[$key] ?? '';
                $productCase->case_value = $request->case_value[$key] ?? '';
                $productCase->save();
            }
        }

        foreach ($request->dial_label as $key => $dial_value) {
            $productDial = new ProductDial();
            $productDial->product_id =  $product->id;
            if (isset($request->dial_label[$key]) && isset($request->dial_value[$key])) {
                $productDial->dial_label = $request->dial_label[$key] ?? '';
                $productDial->dial_value = $request->dial_value[$key] ?? '';
                $productDial->save();
            }
        }

        foreach ($request->band_label as $key => $band_value) {
            $productBand = new ProductBand();
            $productBand->product_id =  $product->id;
            if (isset($request->band_label[$key]) && isset($request->band_value[$key])) {
                $productBand->band_label = $request->band_label[$key] ?? '';
                $productBand->band_value = $request->band_value[$key] ?? '';
                $productBand->save();
            }
        }

        foreach ($request->movement_label as $key => $movement_value) {
            $productMovement = new ProductMovement();
            $productMovement->product_id =  $product->id;
            if (isset($request->movement_label[$key]) && isset($request->movement_value[$key])) {
                $productMovement->movement_label = $request->movement_label[$key] ?? '';
                $productMovement->movement_value = $request->movement_value[$key] ?? '';
                $productMovement->save();
            }
        }

        foreach ($request->addition_label as $key => $addition_value) {
            $productAddition = new ProductAdditional();
            $productAddition->product_id =  $product->id;
            if (isset($request->addition_label[$key]) && isset($request->addition_value[$key])) {
                $productAddition->addition_label = $request->addition_label[$key] ?? '';
                $productAddition->addition_value = $request->addition_value[$key] ?? '';
                $productAddition->save();
            }
        }

        $productImages = $this->imageUpload($request, 'multiimage', 'uploads/multiimage');
        if (is_array($productImages) && count($productImages)) {
            foreach ($productImages as $image) {
                $imagePath = new ProductImage();
                $imagePath->product_id = $product->id;
                $imagePath->multiimage = $image;
                $imagePath->save();
            }
        }


        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
        return redirect()->back()->with('message', 'Product Successfully Saved!');
    }



    public function edit($id)
    {
        $product = Product::with('productImage')->find($id);
        $productItem = ProductItem::where('product_id', $id)->get();
        $productCase = ProductCase::where('product_id', $id)->get();
        $productDail = ProductDial::where('product_id', $id)->get();
        $productMovement = ProductMovement::where('product_id', $id)->get();
        $productBand = ProductBand::where('product_id', $id)->get();
        $productAddition = ProductAdditional::where('product_id', $id)->get();
        $brand = Brand::get();
        $category = Category::get();
        $series = Series::where(['brand_id' => $product->brand_id, 'category_id' => $product->category_id])->get();
        $material = BrandMaterial::where(['brand_id'=> $product->brand_id, 'category_id' => $product->category_id])->get();
        $color = Color::where(['brand_id'=> $product->brand_id, 'category_id' => $product->category_id])->get();
        $size = Size::where(['brand_id'=> $product->brand_id, 'category_id' => $product->category_id])->get();
        $movement = Movement::where(['brand_id'=> $product->brand_id, 'category_id' => $product->category_id])->get();
        return view('admin.product_edit', compact('brand', 'product', 'category', 'series', 'material', 'color', 'size', 'movement', 'productItem', 'productCase', 'productBand', 'productDail', 'productMovement', 'productAddition'));
    }



    public function removeImage($id)
    {
        try {
            $removeImage = ProductImage::find($id);
            $productId = $removeImage->product_id;
            if (!empty($removeImage->multiimage) && file_exists($removeImage->multiimage)) {
                unlink($removeImage->multiimage);
            }
            $removeImage->delete();

            $productImage =  ProductImage::where("product_id", $productId)->get();
            return response()->json(['success' => true, 'productImage' => $productImage]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'productId' => false]);
        }
    }

    public function show($id)
    {
        $product = Product::with(['images'])->find($id);
        return view('admin.product_show', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $price = $request->selling_price;
        $discount = isset($request->discount_price) && $request->discount_price == 0 ? 0 : $request->discount_price;


        $product = Product::find($id);
        // $Image = $product->image;
        // if ($request->hasFile('image')) {
        //     if (!empty($product->image) && file_exists($product->image))
        //         unlink($product->image);
        //     $Image = $this->imageUpload($request, 'image', 'uploads/product');
        // }

        if ($request->file('image')) {
            $image = $request->file('image');
            if ($product->image) {
                @unlink('uploads/product/' . $product->image);
            }
            if ($product->thumb_image) {
                @unlink('uploads/product/thumbnail/' . $product->thumb_image);
            }

            $Image  = 'main' . time() . rand() . $image->getClientOriginalName();
            $thumbImage = 'thumb-' . time() . rand() . $image->getClientOriginalName();

            Image::make($image)->save('uploads/product/' . $Image);
            Image::make($image)->resize(250, 250)->save('uploads/product/thumbnail/' . $thumbImage);
        } else {
            $Image  = $product->image;
            $thumbImage = $product->thumb_image;
        }


        $anotherImage = $product->otherimage;
        if ($request->hasFile('otherimage')) {
            if (!empty($product->otherimage) && file_exists($product->otherimage))
                unlink($product->otherimage);
            $anotherImage = $this->imageUpload($request, 'otherimage', 'uploads/product');
        }

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->series_id = $request->series_id ?? null;
        $product->material_id = $request->material_id ?? null;
        $product->color_id = $request->color_id ?? null;
        $product->size_id = $request->size_id ?? null;
        $product->movement_id = $request->movement_id ?? null;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->model = $request->model ?? null;
        $product->selling_price = $request->selling_price;
        $product->meta_title = $request->meta_title ?? null;
        $product->meta_description = $request->meta_description ?? null;
        $product->meta_keywords = $request->meta_keywords ?? null;
        $product->discount = $request->discount;
        $product->discount_price = $discount ?? 0;
        $product->short_desc = $request->short_desc;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->warranty = $request->warranty;
        $product->resistant = $request->resistant ?? null;
        $product->image  = $Image;
        $product->thumb_image  = $thumbImage;
        $product->otherimage = $anotherImage;
        $product->ip_address = $request->ip();
        $product->status = 1;
        $product->created_by = Auth::user()->id;
        $product->save();


        if ($request->label) {
            ProductItem::where('product_id', $id)->delete();

            foreach ($request->label as $key => $value) {
                $productItem = new ProductItem();
                $productItem->product_id =  $product->id;
                if (isset($request->label[$key]) && isset($request->value[$key])) {
                    $productItem->label = $request->label[$key] ?? '';
                    $productItem->value = $request->value[$key] ?? '';
                    $productItem->save();
                }
            }
        }


        if ($request->case_label) {
            ProductCase::where('product_id', $id)->delete();

            foreach ($request->case_label as $key => $case_value) {
                $productCase = new ProductCase();
                $productCase->product_id =  $product->id;
                if (isset($request->case_label[$key]) && isset($request->case_value[$key])) {
                    $productCase->case_label = $request->case_label[$key] ?? '';
                    $productCase->case_value = $request->case_value[$key] ?? '';
                    $productCase->save();
                }
            }
        }

        if ($request->dial_label) {
            ProductDial::where('product_id', $id)->delete();

            foreach ($request->dial_label as $key => $dial_value) {
                $productDial = new ProductDial();
                $productDial->product_id =  $product->id;
                if (isset($request->dial_label[$key]) && isset($request->dial_value[$key])) {
                    $productDial->dial_label = $request->dial_label[$key] ?? '';
                    $productDial->dial_value = $request->dial_value[$key] ?? '';
                    $productDial->save();
                }
            }
        }

        if ($request->band_label) {
            ProductBand::where('product_id', $id)->delete();

            foreach ($request->band_label as $key => $band_value) {
                $productBand = new ProductBand();
                $productBand->product_id =  $product->id;
                if (isset($request->band_label[$key]) && isset($request->band_value[$key])) {
                    $productBand->band_label = $request->band_label[$key] ?? '';
                    $productBand->band_value = $request->band_value[$key] ?? '';
                    $productBand->save();
                }
            }
        }

        if ($request->movement_label) {
            ProductMovement::where('product_id', $id)->delete();

            foreach ($request->movement_label as $key => $movement_value) {
                $productMovement = new ProductMovement();
                $productMovement->product_id =  $product->id;
                if (isset($request->movement_label[$key]) && isset($request->movement_value[$key])) {
                    $productMovement->movement_label = $request->movement_label[$key] ?? '';
                    $productMovement->movement_value = $request->movement_value[$key] ?? '';
                    $productMovement->save();
                }
            }
        }

        if ($request->addition_label) {
            ProductAdditional::where('product_id', $id)->delete();

            foreach ($request->addition_label as $key => $addition_value) {
                $productAddition = new ProductAdditional();
                $productAddition->product_id =  $product->id;
                if (isset($request->addition_label[$key]) && isset($request->addition_value[$key])) {
                    $productAddition->addition_label = $request->addition_label[$key] ?? '';
                    $productAddition->addition_value = $request->addition_value[$key] ?? '';
                    $productAddition->save();
                }
            }
        }


        // multiple image
        $productImages = $this->imageUpload($request, 'multiimage', 'uploads/multiimage');
        if (is_array($productImages) && count($productImages)) {
            foreach ($productImages as $image) {
                $imagePath = new ProductImage();
                $imagePath->product_id = $product->id;
                $imagePath->multiimage = $image;
                $imagePath->save();
            }
        }


        return redirect()->route('products.index')->with('message', 'Update Successfullty');
    }

    public function destroy(Request $request)
    {
        try {
            $product = Product::find($request->id);

            if ($product->image) {

                @unlink('uploads/product/' . $product->image);
            }
            if ($product->thumb_image) {
                @unlink('uploads/product/thumbnail/' . $product->thumb_image);
            }
            if (file_exists($product->otherimage) and !empty($product->otherimage)) {
                unlink($product->otherimage);
            }

            $product->delete();

            return response()->json([

                'message' => 'Data Deleted Successfully',
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong!',
                'success' => false
            ]);
        }
    }


    public function allProduct()
    {
        $brand = Brand::get();
        $category = Category::get();
        $products = Product::latest()->get();
        return view('admin.product_all', compact('products', 'brand', 'category'));
    }



    public function searchCatBrand(Request $request)
    {
        $category = $request->category;
        $brand    = $request->brand;

        $products = Product::query();

        if ($category) {
            $products = $products->where('category_id', $category);
        }

        if ($brand) {
            $products = $products->where('brand_id', $brand);
        }
        $products = $products->get();
        $category = Category::latest()->get();
        $brand = Brand::latest()->get();
        return view('admin.product_all', compact('products', 'category', 'brand'));
    }


    public function discountUpdate(Request $request)
    {
        $res = new stdClass();
        try {
            $discount = $request->discount;

            foreach ($request->checkData as $productId) {

                $products = Product::find($productId);
                $products->discount_price = (($products->selling_price * $discount) / 100);
                $products->discount = $discount;
                $products->save();
            }
            $res->message = 'Discount Updated Successfully!';
        } catch (\Exception $e) {
            $res->message = 'Something went wrong!';
        }
        return response(['message' => $res->message, 'success' => true]);
    }




    public function getProducts(Request $req)
    {
        $products = Product::with(['brand', 'category'])->where('status', true);

        if (isset($req->productId)) {
            $products = $products->where('id', $req->productId);
        }

        if (isset($req->brandId)) {
            $products = $products->where('brand_id', $req->brandId);
        }

        if (isset($req->categoryId)) {
            $products = $products->where('category_id', $req->categoryId);
        }

        if (isset($req->catId)) {
            $products = $products->where('category_id', $req->catId);
        }

        $products = $products->orderBy('quantity', 'desc')->get();
        return $products;
    }



    public function getPoductsStockReport(Request $req)
    {
        // return $req->series;
        $products = Product::with(['brand', 'category'])->where('status', true);

        if (isset($req->productId)) {
            $products = $products->where('id', $req->productId);
        }

        if (isset($req->brandId)) {
            $products = $products->where('brand_id', $req->brandId);
        }

        if (isset($req->categoryId)) {
            $products = $products->where('category_id', $req->categoryId);
        }

        $products = $products->addSelect([
            'order_qty' => OrderDetail::selectRaw('ifnull(sum(quantity), 0)')
                ->whereColumn('product_id', 'products.id')
        ]);

        $products = $products->get();
        return $products;
    }


    public function selectedProduct()
    {
        $brand = Brand::get();
        $category = Category::get();
        $banner = Banner::get();
        $products = Product::latest()->get();
        return view('admin.product_selected', compact('banner', 'category', 'brand', 'products'));
    }

    public function searchCatBrandSelect(Request $request)
    {
        $category = $request->category;
        $brand    = $request->brand;

        $products = Product::query();

        if ($category) {
            $products = $products->where('category_id', $category);
        }

        if ($brand) {
            $products = $products->where('brand_id', $brand);
        }

        $products = $products->get();
        $category = Category::get();
        $brand = Brand::get();
        $banner = Banner::get();
        return view('admin.product_selected', compact('products', 'category', 'brand', 'banner'));
    }

    public function selectedProductUpdate(Request $request)
    {
        // dd($request->all());
        $res = new stdClass;
        try {
            $selectedProduct = $request->selectedProduct;
            $cart = isset($selectedProduct) ? $selectedProduct : array();
            $a = [];
            $banner_id = $request->banner_id;
            foreach ($cart as $value) {
                $product = Product::where('id', $value)->first();
                $product->banner_id = $banner_id;
                $product->save();
            }

            return redirect()->route('selected.product')->with('message', 'Selected Product Update Successfully');
        } catch (\Exception $ex) {
            $res->success = false;
            $res->message = 'fail' . $ex->getMessage();
        }

        return $res;
    }

    public function sale()
    {
        $brand = Brand::get();
        $category = Category::get();
        $banner = Banner::get();
        $products = Product::latest()->get();
        return view('admin.sale_product', compact('products', 'brand', 'category', 'banner'));
    }

    public function saleCatBrandSelect(Request $request)
    {
        $category = $request->category;
        $brand    = $request->brand;

        $products = Product::query();

        if ($category) {
            $products = $products->where('category_id', $category);
        }

        if ($brand) {
            $products = $products->where('brand_id', $brand);
        }

        $products = $products->get();
        $category = Category::get();
        $brand = Brand::get();
        $banner = Banner::get();
        return view('admin.sale_product', compact('products', 'category', 'brand', 'banner'));
    }

    public function saleProductUpdate(Request $request)
    {
        $res = new stdClass;
        try {
            $products = Product::all();
            foreach ($products as $item) {
                $product = Product::where('id', $item->id)->first()->update(['sale' => 0]);
            }
            foreach ($request->selectedProduct as $key => $value) {
                $product = Product::where('id', $value)->first();
                $product->sale = isset($request->selectedProduct) ? 1 : 0;
                $product->save();
            }

            return redirect()->route('sale.product')->with('message', 'Selected Product Update Successfully');
        } catch (\Exception $ex) {
            $res->success = false;
            $res->message = 'fail' . $ex->getMessage();
        }

        return $res;
    }
}