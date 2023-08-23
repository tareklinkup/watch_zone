<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\MovementController;
use App\Http\Controllers\Website\SearchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\CustomerController;
use App\Http\Controllers\Admin\SaleServiceController;
use App\Http\Controllers\Admin\BrandMaterialController;
use App\Http\Controllers\Admin\CompanypolicyController;
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\CompanyprofileController;
use App\Http\Controllers\Website\CustomerdashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('product/category/{category?}', [HomeController::class, 'shop'])->name('product.category');
Route::get('/product/brand/{brand}', [HomeController::class, 'brand'])->name('product.brand');
Route::get('/category/{cat}', [HomeController::class, 'category'])->name('product.cat');
Route::get('/all/products', [HomeController::class, 'allProduct'])->name('all.products');
Route::get('/product/single/{slug}', [HomeController::class, 'show'])->name('product.show');
Route::get('/sale-product', [HomeController::class, 'saleProduct'])->name('sale');
Route::post('/contact/send', [HomeController::class, 'sendMsg'])->name('contact.send.msg');
Route::get('/about/page', [HomeController::class, 'about'])->name('about.page');
Route::get('/terms/condition', [HomeController::class, 'termsCondition'])->name('terms.condition');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy.policy');
Route::get('/customer-service', [HomeController::class, 'customerService'])->name('customer.service');
Route::get('/warranty-policy', [HomeController::class, 'warranty'])->name('warranty.policy');
Route::get('/fastest-delivery', [HomeController::class, 'delivery'])->name('fastest.delivery');
Route::get('/physical-store', [HomeController::class, 'physical'])->name('physical.store');

// category brand
Route::get('/category-brand/{id}', [HomeController::class, 'CategoryBand']);
//cart
Route::get('/getCartAjax', [HomeController::class, 'GetCartAjax'])->name('get.cart.ajax');
Route::get('/get-total-amount', [HomeController::class, 'getTotalAmount'])->name('getTotal.Amount');
Route::get('/add-cart-ajax/{id}', [CartController::class, 'addToCartAjax'])->name('add.cart.ajax');

Route::post('/add-cart', [CartController::class, 'addCart'])->name('add-cart');

// product filter
Route::post('/search-product', [HomeController::class, 'filter_products_range'])->name('search.products');
Route::get('/filter-product/{id}', [HomeController::class, 'filter_products_category'])->name('filter.category.product');

Route::get('/product-filter', [HomeController::class, 'filterProduct'])->name('product.filter');

//Product Search Routes
Route::get('/product/search', [SearchController::class, 'search'])->name('search.product');
Route::post('/product/get', [SearchController::class, 'productGet'])->name('get.product');

// get filter product related filter apis

Route::get('/get-category', [HomeController::class, 'getCategories']);
Route::post('/get-series', [SeriesController::class, 'getSeries']);
Route::post('/get-series-category', [SeriesController::class, 'getSeriesCategory']);

Route::post('/get-brand-materials', [BrandMaterialController::class, 'getBrandMaterials']);
Route::post('/get-brand-materials-category', [BrandMaterialController::class, 'getBrandMaterialsCategory']);

Route::post('/get-dial-colors', [ColorController::class, 'getDialColors']);
Route::post('/ get-dial-colors-category', [ColorController::class, 'getDialColorsCategory']);

Route::post('/get-movements', [MovementController::class, 'getMovements']);
Route::post('/get-movements-category', [MovementController::class, 'getMovementsCategory']);
Route::post('/get-case-size', [SizeController::class, 'getCasesize']);
Route::post('/get-case-size-category', [SizeController::class, 'getCasesizeCategory']);
Route::post('/get-filter-products', [HomeController::class, 'getFilterPoducts']);
Route::post('/get-filtering-discount-products', [HomeController::class, 'getFilterDiscountPoducts']);
Route::post('/get-products', [ProductController::class, 'getProducts']);
Route::post('/get-products-stock', [ProductController::class, 'getPoductsStockReport']);

Route::get('/customer/Canceled/{id}', [CustomerdashboardController::class, 'customerCanceled'])->name('customer.canceled');

//Cart Routes
Route::get('/product/carts', [CartController::class, 'index'])->name('product.cart');
Route::get('/product/cart/store/{id}', [CartController::class, 'cartStore'])->name('product.cart.store');
Route::get('/product/cart/buying/{id}', [CartController::class, 'cartStoreBuying'])->name('product.cart.buying');
Route::get('/product/checkout/buying/{id}', [CartController::class, 'cartStoreingBuying'])->name('product.checkout.buying');
Route::get('/get-cart-product', [CartController::class, 'getAllCart'])->name('product.get.cart');
Route::get('/cart-increment/{rowId}', [CartController::class, 'cartIncrement'])->name('product.cart.increment');
Route::get('/cart-decrement/{rowId}', [CartController::class, 'cartDecrement'])->name('product.cart.decrement');

//View Data Mini Cart with Ajax  Routes
Route::get('/product/mini/cart', [CartController::class, 'miniCart'])->name('product.mini.cart');
Route::get('/mini/cart/remove/{rowId}', [CartController::class, 'miniCartRemove'])->name('product.mini.cart.remove');
Route::get('/cart-remove/{rowId}', [CartController::class, 'cartDestroy'])->name('product.cart.remove');
Route::get('/clear-cart', [CartController::class, 'cartAllDestroy'])->name('product.cart.destroy');


//Coupon  Routes
Route::post('/coupon-apply', [CartController::class, 'couponApply']);

//Order Tracking Routes
Route::post('/order/tracking', [HomeController::class, 'trackingOrder'])->name('order.tracking');

// Customer Authentication
// Route::group(['middleware' => 'guest:customer'], function(){

Route::get('/customer/login/page', [CustomerController::class, 'loginPage'])->name('customer.login.page');
Route::post('/customer/login', [CustomerController::class, 'loginCheck'])->name('customer.login.process');
Route::get('/customer/register', [CustomerController::class, 'registerCustomer'])->name('customer.register');
Route::post('/customer/register', [CustomerController::class, 'customerRegistration'])->name('customer.register.store');

// });

//Customer Forgot Passwortd
Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/password/forgot', [CustomerController::class, 'showForgotForm'])->name('forgot.password.form');
    Route::post('/password/forgot', [CustomerController::class, 'sendResetLink'])->name('forgot.password.link');
    Route::get('/password/reset/{token}', [CustomerController::class, 'showResetForm'])->name('reset.password.form');
    Route::post('/password/reset', [CustomerController::class, 'resetPassword'])->name('reset.password');
});

Route::group(['middleware' => 'customer'], function () {

    // Customer Dashboard Routes
    Route::get('/customer/dashboard', [CustomerdashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/address', [CustomerdashboardController::class, 'Cusaddress'])->name('customer.address');
    Route::put('/customer/address/update/{id}', [CustomerdashboardController::class, 'updateAddress'])->name('customer.address.update');
    Route::get('/customer/order', [CustomerdashboardController::class, 'cusOrder'])->name('customer.order');

    // Route::get('/customer/order/show', [CustomerdashboardController::class, 'CustomerOrderShow'])->name('customer.order.show');
    Route::get('/customer/order/show/{id}', [CustomerdashboardController::class, 'CustomerOrderShow'])->name('customer.order.show');
    Route::get('customer/order/print/{id}', [CustomerdashboardController::class, 'orderPrint'])->name('customer.order.print');
    Route::get('/customer/change/password', [CustomerdashboardController::class, 'changePassword'])->name('customer.change.password');
    Route::post('/customer/update/password', [CustomerdashboardController::class, 'updatePassword'])->name('customer.update.password');

    Route::get('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');

    //Checkout Routes
    Route::get('/get-shipamount/{id}', [CartController::class, 'getShipAmount'])->name('get.ship.amount');
    Route::post('/checkout/store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');
    Route::get('/sms-check', [HomeController::class, 'sendMsgs']);
});

Route::get('/product/checkout', [CartController::class, 'checkout'])->name('product.checkout');

Route::group(['middleware' => 'guest'], function () {
    // Authentication
    Route::get('/admin', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/admin', [AuthenticationController::class, 'authCheck'])->name('login.check');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('admin.logout');
    Route::get('/registration', [AuthenticationController::class, 'registration'])->name('admin.registration');
    Route::post('/registration', [AuthenticationController::class, 'newUser'])->name('registration.store');
    Route::put('/password', [AuthenticationController::class, 'passwordUpdate'])->name('password.change');
    Route::get('/profile', [AuthenticationController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthenticationController::class, 'profileUpdate'])->name('profile.update');
    Route::delete('/user-delete/{id}', [AuthenticationController::class, 'delete'])->name('profile.delete');

  Route::post('/add/customer', [CustomerController::class, 'addCustomers']);

    // Category Routes
    Route::get('/admin-category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    Route::get('get-discount-category', [CategoryController::class,'getCategory']);

    // Brand Routes
    Route::get('/admin-brands', [BrandController::class, 'index'])->name('brand.index');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::post('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');

    Route::get('get-discount-brands', [BrandController::class,'getBrands']);

    // serise
    Route::get('/admin-series', [SeriesController::class, 'index'])->name('series.index');
    Route::post('/series/store', [SeriesController::class, 'store'])->name('series.store');
    Route::get('/series/edit/{id}', [SeriesController::class, 'edit'])->name('series.edit');
    Route::post('/series/update/{id}', [SeriesController::class, 'update'])->name('series.update');
    Route::post('/series/delete/{id}', [SeriesController::class, 'delete'])->name('series.delete');

    // brand material
    Route::get('/admin-brand/material', [BrandMaterialController::class, 'index'])->name('material.index');
    Route::post('/brand/material/store', [BrandMaterialController::class, 'store'])->name('material.store');
    Route::get('/brand/material/edit/{id}', [BrandMaterialController::class, 'edit'])->name('material.edit');
    Route::post('/brand/material/update/{id}', [BrandMaterialController::class, 'update'])->name('material.update');
    Route::post('/brand/material/delete/{id}', [BrandMaterialController::class, 'delete'])->name('material.delete');


    // dial color
    Route::get('/admin/dail/color', [ColorController::class, 'index'])->name('color.index');
    Route::post('/dail/color/store', [ColorController::class, 'store'])->name('color.store');
    Route::get('/dail/color/edit/{id}', [ColorController::class, 'edit'])->name('color.edit');
    Route::post('/dail/color/update/{id}', [ColorController::class, 'update'])->name('color.update');
    Route::post('/dail/color/delete/{id}', [ColorController::class, 'delete'])->name('color.delete');


    // case size
    Route::get('/admin/case-size', [SizeController::class, 'index'])->name('size.index');
    Route::post('/case-size/store', [SizeController::class, 'store'])->name('size.store');
    Route::get('/case-size/edit/{id}', [SizeController::class, 'edit'])->name('size.edit');
    Route::post('/case-size/update/{id}', [SizeController::class, 'update'])->name('size.update');
    Route::post('/case-size/delete/{id}', [SizeController::class, 'delete'])->name('size.delete');

    // Movement
    Route::get('/admin/movement', [MovementController::class, 'index'])->name('movement.index');
    Route::post('/movement/store', [MovementController::class, 'store'])->name('movement.store');
    Route::get('/movement/edit/{id}', [MovementController::class, 'edit'])->name('movement.edit');
    Route::post('/movement/update/{id}', [MovementController::class, 'update'])->name('movement.update');
    Route::post('/movement/delete/{id}', [MovementController::class, 'delete'])->name('movement.delete');

    // Product Routes
    Route::get('/admin-products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/save_product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/show/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/products/delete', [ProductController::class, 'destroy'])->name('products.delete');
    Route::get('/delete_product_image/{id}', [ProductController::class, 'removeImage']);

    //category and brand filter

    Route::post('/search/catbybrand/select', [ProductController::class, 'searchCatBrandSelect'])->name('search.catbybrand.select');
    Route::post('/search/catbybrand/sale', [ProductController::class, 'saleCatBrandSelect'])->name('sale.catbybrand.select');
    Route::post('/search/category-brand', [ReportController::class, 'searchCategoryBrand'])->name('search.categorybrand');

    //discount update
    Route::get('/admin-products/all', [ProductController::class, 'allProduct'])->name('products.all');
    Route::any('/search/catbybrand', [ProductController::class, 'searchCatBrand'])->name('search.catbybrand');
    Route::post('/product/discount/update', [ProductController::class, 'discountUpdate'])->name('product.discount');

    //selected product
    Route::get('/selected/product', [ProductController::class, 'selectedProduct'])->name('selected.product');
    Route::post('/product/selected/update', [ProductController::class, 'selectedProductUpdate'])->name('product.selected');

    Route::get('/admin/sale/product', [ProductController::class, 'sale'])->name('sale.product');
    Route::post('/admin/sale-product/update', [ProductController::class, 'saleProductUpdate'])->name('sale.selected');


    // get product all feature
     Route::post('/series-get', [ProductController::class, 'seriesGet']);
    // Route::get('/material-get/{id}', [ProductController::class, 'materialGet']);
        Route::post('/material-get', [ProductController::class, 'materialGet']);

    Route::post('/dial/color-get', [ProductController::class, 'colorGet']);
    Route::post('/size-get', [ProductController::class, 'sizeGet']);
    Route::post('/movement-get', [ProductController::class, 'movementGet']);

    // Slider Routes
    Route::get('/sliders', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/slider/inactive/{id}', [SliderController::class, 'inactive'])->name('slider.inactive');
    Route::get('/slider/active/{id}', [SliderController::class, 'active'])->name('slider.active');
    Route::post('/slider/delete', [SliderController::class, 'destroy'])->name('slider.delete');

    // Company Profile Routes
    Route::get('/company/profiles', [CompanyprofileController::class, 'index'])->name('company.profiles');
    Route::post('/company/profile/update/{id}', [CompanyprofileController::class, 'update'])->name('company.profile.update');

    // About Routes
    Route::get('/company/about', [AboutController::class, 'index'])->name('company.about');
    Route::post('/company/about/update/{id}', [AboutController::class, 'update'])->name('company.about.update');

    //sale service
    Route::get('/sale-service', [SaleServiceController::class,'saleService'])->name('sale.service');
    Route::post('/sale-service/update/{id}', [SaleServiceController::class,'saleUpdate'])->name('sale.update');



    // Company Policy Routes
    Route::get('/company/policy', [CompanypolicyController::class, 'index'])->name('company.policy');
    Route::post('/company/policy/update/{id}', [CompanypolicyController::class, 'update'])->name('company.policy.update');

    //Coupon Routes
    Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupons');
    Route::get('/coupon/create', [CouponController::class, 'create'])->name('admin.coupon.create');
    Route::post('/coupon/store', [CouponController::class, 'store'])->name('admin.coupon.store');
    Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::post('/coupon/update/{id}', [CouponController::class, 'update'])->name('admin.coupon.update');
    Route::post('/coupon/delete', [CouponController::class, 'destroy'])->name('admin.coupon.delete');

    //Order Routes
    Route::get('/pending-order', [OrderController::class, 'pendingOrder'])->name('admin.pending.order');
    Route::get('/order/show/{id}', [OrderController::class, 'showOrder'])->name('admin.show.order');
    Route::get('/order/confirm', [OrderController::class, 'confirmOrder'])->name('admin.confirm.order');
    Route::get('/order/processing', [OrderController::class, 'processingOrder'])->name('admin.processing.order');
    Route::get('/order/picked', [OrderController::class, 'pickedOrder'])->name('admin.picked.order');
    Route::get('/order/shipped', [OrderController::class, 'shippedOrder'])->name('admin.shipped.order');
    Route::get('/order/delivered', [OrderController::class, 'deliveredOrder'])->name('admin.delivered.order');
    Route::get('/order/canceled', [OrderController::class, 'canceledOrder'])->name('admin.canceled.order');
    Route::get('/order/all', [OrderController::class, 'allOrder'])->name('admin.all.order');

    //Order Status Update Routes
    Route::get('/pending-to/confirm/{id}', [OrderController::class, 'pendingToConfirm'])->name('admin.pending.to.confirm');
    Route::get('/pending-to/canceled/{id}', [OrderController::class, 'pendingToCanceled'])->name('admin.pending.to.canceled');
    Route::get('/confirm-to/pending/{id}', [OrderController::class, 'confirmToPending'])->name('admin.confirm.to.pending');
    Route::get('/confirm-to/processing/{id}', [OrderController::class, 'confirmToProcessing'])->name('admin.confirm.to.processing');
    Route::get('/processing-to/confirm/{id}', [OrderController::class, 'processingToConfirm'])->name('admin.processing.to.confirm');

    Route::get('/processing-to/delivered/{id}', [OrderController::class, 'processingToDelivered'])->name('admin.processing.to.delivered');
    Route::get('/delivered-to/shipped/{id}', [OrderController::class, 'deliveredToProcessing'])->name('admin.delivered.to.processing');
    Route::get('/delivered-to/Canceled/{id}', [OrderController::class, 'deliveredToCanceled'])->name('admin.delivered.to.canceled');


    //Order Print Routes
    Route::get('/admin/order/print/{id}', [OrderController::class, 'printOrder'])->name('admin.order.print');
    //Order Print Routes
    Route::get('/admin/order/list/print/{id}', [OrderController::class, 'printDiv'])->name('admin.order.list.print');

    // Public Message Routes
    Route::get('/visitor', [ContactController::class, 'index'])->name('visitor.index');
    Route::post('/message/delete', [ContactController::class, 'destroy'])->name('message.delete');

    // Role Routes
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('/role-permission/{id}',[RoleController::class,'permissioin'])->name('role.permission');
    Route::post('/role-permission/{id}',[RoleController::class,'permissioinAssign'])->name('role.permission.assign');



    // Faq's Routes
    Route::get('/admin/faq', [FaqController::class, 'index'])->name('faq.index');
    Route::post('/faq/store', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('/faq/update/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::post('/faq/delete', [FaqController::class, 'delete'])->name('faq.delete');

    // District Routes
    Route::get('/district', [DistrictController::class, 'index'])->name('district.index');
    Route::post('/district/store', [DistrictController::class, 'store'])->name('district.store');
    Route::get('/district/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
    Route::post('/district/update/{id}', [DistrictController::class, 'update'])->name('district.update');

    // Report
    Route::any('/order/report', [ReportController::class, 'orderReport'])->name('order.report');
    Route::get('/orders/report/list', [ReportController::class, 'viewOrderReport'])->name('report.list.order');
    Route::get('/orders/report/get', [ReportController::class, 'getOrderReport'])->name('report.get.order');

    // Customer List Routes
    Route::get('/customer/list', [DashboardController::class, 'customerList'])->name('customer.list');


    //banner
    Route::get('/banner-entry', [BannerController::class, 'index'])->name('banner.index');
    Route::post('/banner-store', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/banner-edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
    Route::post('/banner-update/{id}', [BannerController::class, 'update'])->name('banner.update');
    Route::post('/banner-delete', [BannerController::class, 'delete'])->name('banner.delete');

    Route::get('/get-customers', [CustomerController::class, 'getCustomers']);

    Route::post('/save_order', [OrderController::class, 'newOrderStore']);
    Route::get('/order/create', [OrderController::class, 'newOrder'])->name('new.order');
    // Route::post('/order/create/store', [OrderController::class, 'newOrderStore'])->name('new.order.store');



    //Cache clear
    Route::get('clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:cache');
        return 'Done';
    });
});