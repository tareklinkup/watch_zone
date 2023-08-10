<?php

namespace App\Http\Controllers\Website;

use App\Models\Blog;
use App\Models\About;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Ourteam;
use App\Models\Product;
use App\Models\Category;
use App\Models\ClientSay;
use App\Models\Subscribe;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\CompanyPolicy;
use App\Models\CompanyProfile;
use App\Models\TrendingProduct;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BrandMaterial;
use App\Models\Coupon;
use App\Models\Movement;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductAdditional;
use App\Models\ProductBand;
use App\Models\ProductCase;
use App\Models\ProductDial;
use App\Models\ProductItem;
use App\Models\ProductMovement;
use App\Models\Series;
use App\Models\Size;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    public function index()
    {
        $data['slider'] = Slider::where('status', 1)->get();
        $data['brands'] = Brand::where('is_homepage', 1)->orderBy('id', 'asc')->take(12)->get();
        $data['categories'] = Category::where('is_homepage', 1)->take(5)->get();
        $data['banner'] = Banner::where('status', 1)->get();
        $data['coupon'] = Coupon::first();
        return view('pages.web_index', $data);
    }


    // category Product Page
    public function category($cat)
    {
        $category_id = Category::where('slug', $cat)->first()->id;
        // dd($product);
        $product = Product::with(['brand', 'images'])->where('brand_id', $category_id)->orderBy('quantity', 'desc');
        $product = $product->paginate(200);
        $brands = Brand::with('product')->orderBy('id', 'asc')->get();
        $categories = Category::with('products')->orderBy('id', 'asc')->take(6)->get();
        return view('pages.category', compact('product', 'brands', 'categories'));
    }
    public function saleProduct()
    {
        $product = Product::with(['brand', 'images'])->where('sale', 1)->orderBy('quantity', 'desc');
        $product = $product->paginate(200);
        $brands = Brand::with('product')->orderBy('id', 'asc')->get();
        $categories = Category::with('products')->orderBy('id', 'asc')->take(2)->get();
        return view('pages.product_sale', compact('product', 'brands', 'categories'));
    }
      // Brand Product Page
      public function brand($brand)
      {
        $brandId = null;
        $categoryId = null;

          $brand_id = Brand::where('slug', $brand)->first()->id;


          $product = Product::with(['brand', 'images'])->where('brand_id', $brand_id)->orderBy('quantity', 'desc');
        //     echo "<pre>";
        //      print_r($product);
        //   echo "<pre/>";
        //   dd();

          if(request()->query('brand')) {

            $brand_id = Brand::where('slug', request()->query('brand'))->first()->id;
        }

          if(request()->query('series')) {
              $product->where('series_id', request()->query('series'));
          }

          if(request()->query('brand_material'))
          {
              $product->where('material_id', request()->query('brand_material'));
          }

          if(request()->query('color')) {
              $product->where('color_id', request()->query('color'));
          }
          if(request()->query('movement')) {
              $product->where('movement_id', request()->query('movement'));
          }
          if(request()->query('size')) {
              $product->where('size_id', request()->query('size'));
          }

          $product = $product->paginate(200);
          $data['brands'] = Brand::with('product')->orderBy('name', 'asc')->get();
          $data['categories'] = Category::with('products')->orderBy('id', 'asc')->take(2)->get();
           if(isset($brand_id)) {
            $data['series']= Series::where('brand_id', $brand_id)->orderBy('id', 'asc')->get();
            $data['brand_material']= BrandMaterial::where('brand_id', $brand_id)->orderBy('id', 'asc')->get();
            $data['color']= Color::where('brand_id', $brand_id)->orderBy('id', 'asc')->get();
            $data['sizes']= Size::where('brand_id', $brand_id)->orderBy('id', 'asc')->get();
            $data['movements']= Movement::where('brand_id', $brand_id)->orderBy('id', 'asc')->get();
            $brandId = $brand_id;
        }

        $data['brandId'] = $brandId;

        $data['categoryId'] = $categoryId;
          return view('pages.product_brand', $data, compact('product'));

      }



    // Category Product Page
    public function shop($category)
    {
        $brandId = null;
        $categoryId = null;

        if($category) {
            $id = Category::where('slug', $category)->first()->id;
            $product = Product::with(['brand', 'images'])->where('category_id', $id);
            $categoryId = $id;
        }
        if(request()->query('brand')) {

            $brand_id = Brand::where('slug', request()->query('brand'))->first()->id;
        }
        if(isset($brand_id)) {
            $product->where('brand_id', $brand_id);
        }
        if(request()->query('series')) {
            $product->where('series_id', request()->query('series'));
        }
        if(request()->query('brand_material')) {
            $product->where('material_id', request()->query('brand_material'));
        }
        if(request()->query('color')) {
            $product->where('color_id', request()->query('color'));
        }
        if(request()->query('movement')) {
            $product->where('movement_id', request()->query('movement'));
        }
        if(request()->query('size')) {
            $product->where('size_id', request()->query('size'));
        }

        $data['product'] = $product->orderBy('quantity', 'desc')->paginate(200);

        $data['categories'] = Category::withCount('products')->get();
        $data['brands'] = Brand::with('product')->orderBy('id', 'asc')->get();
        if(isset($brand_id)) {
            $data['series']= Series::where('brand_id', $id)->orderBy('name', 'asc')->get();
            $data['brand_material']= BrandMaterial::where('brand_id', $id)->orderBy('name', 'asc')->get();
            $data['color']= Color::where('brand_id', $id)->orderBy('name', 'asc')->get();
            $data['sizes']= Size::where('brand_id', $id)->orderBy('name', 'asc')->get();
            $data['movements']= Movement::where('brand_id', $id)->orderBy('name', 'asc')->get();
            $brandId = $brand_id;
        }
        $data['brandId'] = $brandId;
        $data['categoryId'] = $categoryId;


    return view('pages.product_shop', $data);
    }

    public function allProduct() {
        $product = Product::query();
        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'priceLowtoHigh') {
                $product = $product->orderBy('selling_price', 'ASC')->paginate(100);
            }elseif ($_GET['sortBy'] == 'priceHightoLow') {
                $product = $product->orderBy('selling_price', 'DESC')->paginate(100);
            }elseif($_GET['sortBy'] == 'nameAtoZ'){
                $product = $product->orderBy('name', 'ASC')->paginate(100);
            }elseif($_GET['sortBy'] == 'nameZtoA'){
                $product = $product->orderBy('name', 'DESC')->paginate(100);
            }else{
                $product = $product->orderBy('id', 'DESC')->paginate(100);
            }
        } else {
            $product = $product->latest()->paginate(100);
        }

        $categories = Category::withCount('products')->get();
        $brands = Brand::withCount('product')->orderBy('id', 'asc')->get();

        return view('pages.product_shop', compact('product', 'categories', 'brands'));
    }


    // public function parents($id)
    // {
    //     $categories = Category::where('category_id', $id)->with('products')->get();
    //     return view('pages.parent_product', compact('categories'));
    // }

    public function show($slug)
    {
        $product = Product::with('productImage')->where('slug', $slug)->first();
        $productItem = ProductItem::where('product_id', $product->id)->get();
        $productCase = ProductCase::where('product_id', $product->id)->get();
        $productDial = ProductDial::where('product_id', $product->id)->get();
        $productMovement = ProductMovement::where('product_id', $product->id)->get();
        $productBand = ProductBand::where('product_id', $product->id)->get();
        $productAddition = ProductAdditional::where('product_id', $product->id)->get();
        $product_images = ProductImage::where('product_id', $product->id)->get();
        if (isset($product->category_id)) {
            $category_id = $product->category_id;
            $related = Product::where('category_id', '=', $product->category->id)->where('id', '!=', $product->id)->limit('4')->get();
        }
        return view('pages.product_single', compact('product', 'product_images', 'related','productItem', 'productCase', 'productBand', 'productDial', 'productMovement', 'productAddition'));
    }

    // Send Public Message
    public function sendMsg(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:60',
            'phone' => 'required|min:11',
            'message' => 'required'
        ]);

        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();

            $notification=array(
                'message'=>'Message Send Successfully',
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

    // About Page
    public function about()
    {
        $about = About::first();
        return view('pages.about', compact('about'));
    }

    // Terms & Condition Page
    public function termsCondition()
    {
        return view('pages.terms_condition');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function warranty()
    {
        return view('pages.warrenty');
    }


    public function delivery()
    {
        return view('pages.delivery');
    }


    public function physical()
    {
        return view('pages.store');
    }

    public function customerService()
    {
        return view('pages.service');
    }



    // Order Tracking
    public function trackingOrder(Request $request)
    {
        $order = Order::with(['customer'])->where('order_number', $request->order_number)->first();
        if($order){
            $orderItem = OrderDetail::with(['product'])->where('order_id', $order->id)->latest()->get();
            return view('pages.order_track', compact('order', 'orderItem'));
        }else{
            $notification=array(
                'message'=>'Order Not Found',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function getSearchSuggestions($keyword)
    {
        $product = Product::select('name')
        ->where('name', 'like', "%$keyword%")->get()->toArray();
        $newProduct = array_map(function($item) {
            $item['type'] = 'p';
            return $item;
        }, $product);

        $category = Category::select('name as name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();

        $newCategory = array_map(function($item) {
            $item['type'] = 'c';
            return $item;
        }, $category);

        $brand = Brand::select('name as name')
            ->where('name', 'like', "%$keyword%")
            ->get()->toArray();

        $newBrand = array_map(function($item) {
            $item['type'] = 'b';
            return $item;
        }, $brand);

        $mergedArray = array_merge($newProduct, $newCategory, $newBrand);

        $search_results = [];
        foreach ($mergedArray as $sr) {
            $search_results[] = $sr['name'];
        }

        return response()->json($search_results);
    }

    public function productSearch()
    {
        if (request()->query('name')) {
            $keyword = request()->query('name');
            $product = Product::Where('name', 'like', "$keyword%")->first();
            $category = Category::where('name', 'like', "$keyword%")->first();
            $brand = Brand::where('name', 'like', "$keyword%")->first();

            if(request()->query('type')=='p') {
                $product_images = ProductImage::where('product_id', $product->id)->get();
                if (isset($product->category_id)) {
                    $category_id = $product->category_id;
                    $related = Product::where('category_id', '=', $product->category->id)->where('id', '!=', $product->id)->limit('24')->get();
                }
                $productItem = ProductItem::where('product_id', $product->id)->get();
                $productCase = ProductCase::where('product_id', $product->id)->get();
                $productDial = ProductDial::where('product_id', $product->id)->get();
                $productMovement = ProductMovement::where('product_id', $product->id)->get();
                $productBand = ProductBand::where('product_id', $product->id)->get();
                $productAddition = ProductAdditional::where('product_id', $product->id)->get();
                return view('pages.product_single', compact('product', 'product_images', 'related', 'productItem', 'productCase', 'productDial', 'productMovement', 'productBand', 'productAddition'));
            } else if(request()->query('type')=='b') {
                $product = Product::with(['brand', 'images'])->where('brand_id', $brand->id)->orderBy('quantity', 'desc')->paginate(24);
                $brands = Brand::withCount('product')->orderBy('id', 'asc')->get();
                $series = Series::where('brand_id', $brand->id)->orderBy('id', 'asc')->get();
                $brand_material = BrandMaterial::where('brand_id', $brand->id)->orderBy('id', 'asc')->get();
                $color = Color::where('brand_id', $brand->id)->orderBy('id', 'asc')->get();
                $sizes = Size::where('brand_id', $brand->id)->orderBy('id', 'asc')->get();
                $movements = Movement::where('brand_id', $brand->id)->orderBy('id', 'asc')->get();
                return view('pages.product_shop', compact('product', 'brands', 'series', 'brand_material', 'color', 'sizes', 'movements'));
            } else if(request()->query('type') == 'c') {
                $product = Product::where('category_id', $category->id)->orderBy('quantity', 'desc')->paginate(24);
                $categories = Category::withCount('products')->get();
                $brands = Brand::withCount('product')->orderBy('id', 'asc')->get();
                $series = Series::where('brand_id', $category->id)->orderBy('id', 'asc')->get();
                $brand_material = BrandMaterial::where('brand_id', $category->id)->orderBy('id', 'asc')->get();
                $color = Color::where('brand_id', $category->id)->orderBy('id', 'asc')->get();
                $sizes = Size::where('brand_id', $category->id)->orderBy('id', 'asc')->get();
                $movements = Movement::where('brand_id', $category->id)->orderBy('id', 'asc')->get();
                return view('pages.product_shop', compact('product', 'categories', 'brands', 'series', 'brand_material', 'color', 'sizes', 'movements'));
            }
        }
        return redirect()->back();
    }


    public function filterProduct(Request $request)
    {

        $brand_id = $request->brand_id ? $request->brand_id : '';
        $series_id = $request->series_id ? $request->series_id : '';
        $material_id = $request->material_id ? $request->material_id : '';
        $color_id = $request->color_id ? $request->color_id : '';
        $movement_id = $request->movement_id ? $request->movement_id : '';
        $size_id = $request->size_id ? $request->size_id : '';
         $p = Product::get();

        if ($brand_id) {
            $p = $p->filter(function ($q) use ($brand_id) {
                return $q->brand_id == $brand_id;
            });
        }
        if ($series_id) {
            $p = $p->filter(function ($q) use ($series_id) {
                return $q->series_id == $series_id;
            });
        }
        if ($material_id) {
            $p = $p->filter(function ($q) use ($material_id) {
                return $q->material_id == $material_id;
            });
        }
        if ($color_id) {
            $p = $p->filter(function ($q) use ($color_id) {
                return $q->color_id == $color_id;
            });
        }
        if ($movement_id) {
            $p = $p->filter(function ($q) use ($movement_id) {
                return $q->movement_id == $movement_id;
            });
        }
        if ($size_id) {
            $p = $p->filter(function ($q) use ($size_id) {
                return $q->size_id == $size_id;
            });
        }

        return $p;
    }


    public function getCategories()
    {
        $categories = Category::get();
        return $categories;
    }


    public function getFilterPoducts(Request $req)
    {
        // return $req->series;
        $products = Product::with(['brand', 'category'])->where('status', true);

        if (isset($req->productId)) {
            $products = $products->where('id', $req->productId);
        }

        if (isset($req->brandId)) {
            $products = $products->where('brand_id', $req->brandId);
        }

        if (isset($req->catId)) {
            $products = $products->where('category_id', $req->catId);
        }

        if (isset($req->categoryId) && $req->categoryId != []) {
            $products = $products->whereIn('category_id', $req->categoryId);
        }

        if (isset($req->series) && $req->series != []) {
            $products = $products->whereIn('series_id', $req->series);
        }

        if (isset($req->brandMaterial) && $req->brandMaterial != []) {
            $products = $products->whereIn('material_id', $req->brandMaterial);
        }
        if (isset($req->dialColor) && $req->dialColor != []) {
            $products = $products->whereIn('color_id', $req->dialColor);
        }
        if (isset($req->movement) && $req->movement != []) {
            $products = $products->whereIn('movement_id', $req->movement);
        }
        if (isset($req->caseSize) && $req->caseSize != []) {
            $products = $products->whereIn('size_id', $req->caseSize);
        }

        if (isset($req->sortBy)) {
            if ($req->sortBy == 'priceLowtoHigh') {
                $products = $products->orderBy('selling_price', 'ASC');
            }

            if ($req->sortBy == 'priceHightoLow') {
                $products = $products->orderBy('selling_price', 'DESC');
            }

            if ($req->sortBy == 'nameAtoZ') {
                $products = $products->orderBy('name', 'ASC');
            }

            if ($req->sortBy == 'nameZtoA') {
                $products = $products->orderBy('name', 'DESC');
            }
        }

        $products = $products->get();
        return $products;
    }




}