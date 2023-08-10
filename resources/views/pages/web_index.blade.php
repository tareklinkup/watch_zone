@extends('layouts.web_master')
@section('title', 'Watch Zone - Search Your Time')
@section('website-content')

    <main class="main-content">
        <!--== Start Hero Area Wrapper ==-->
        <div class="hero-five-slider-area">
            <div class="row">
                <div class="col-lg-12 col-xl-12 ">
                    <div class="swiper hero-five-slider-container ms-n3">
                        <div class="swiper-wrapper">
                            @foreach ($slider as $item)
                                <a href="{{ $item->link }}" class="swiper-slide hero-five-slide-item "
                                    data-bg-img="{{ asset($item->image) }}"
                                    style="background: url({{ asset($item->image) }});
                                        width: 100%;
                                        transition-duration: 0ms;
                                        opacity: 1;
                                        transform: translate3d(-1364px, 0px, 0px);
                                        padding-top: 52%;
                                        object-fit: contain;
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        background-size: contain;
                                     ">
                                </a>
                            @endforeach

                        </div>
                        <!--== Add Pagination ==-->
                        <div class="hero-slide-five-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Hero Area Wrapper ==-->
        @isset($coupon)
            <section class="cupon-area pt-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center coupon">
                            <h4>Use Coupon Code "{{ $coupon->coupon_name }}" Get Extra
                                <span>{{ $coupon->coupon_discount }}%</span> Discount
                            </h4>
                        </div>
                    </div>
                </div>
            </section>
        @endisset

        <!-- -- brand section start -->
        <section class="brand-area pt-5 pt-md-3 pb-5 pb-md-3">
            <div class="container">
                <h2 class="text-center mb-4 mt-n2">Most Popular Brands</h2>

                <div class="brand-content">
                    <div class="row">
                        @foreach ($brands as $brand)
                            <div class="col-lg-2 col-md-3 col-4  home_brand">
                                <div class="main-brands">
                                    <a href="{{ route('product.brand', $brand->slug) }}" class="wthree-btn">
                                        <div class="focus-image"><img src="{{ asset($brand->image) }}" alt="brand"></div>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
        <!-- -- brand section end -->

        <!-- category area start -->
        <section class="category-area">
            <div class="sub-header">
                <h3 class="text-center mb-1 mt-n2"> Authenticity Guaranteed and 1-5 Year Warranty On All
                    Watches.</h3>
            </div>
            <div class="header-border"></div>
            <div class="container">
                <div class="category-content">
                    <div class="row">
                        @foreach ($categories as $item)
                            {{-- @if ($item->is_homepage == 1) --}}
                            <div class="col-lg-2 col-md-3 col-4">
                                <div class="cat-item">
                                    <a href="{{ route('product.category', $item->slug) }}"><img
                                            src="{{ asset($item->image) }}" alt="category image"></a>
                                </div>
                                <div class="cat-title">
                                    <h4><a href="{{ route('product.category', $item->slug) }}">{{ $item->name }}</a></h4>
                                </div>
                            </div>
                            {{-- @endif --}}
                        @endforeach

                        <div class="col-lg-2 col-md-3 col-4">
                            <div class="cat-item">
                                <a href="{{ route('sale') }}">
                                    <img src="{{ asset('uploads/sale.webp') }}" alt="category image"></a>
                            </div>
                            <div class="cat-title">
                                <h4><a href="{{ route('sale') }}">Sale</a></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>

        </section>
        <!-- category area end -->

        <!--== Start Features Area Wrapper ==-->
        <section>
            <div class="container ">
                <div class="features-area pt-5 pb-5 mx-3 ">
                    <div class="row features-row ">
                        <div class="col-sm-6 col-md-3 col-lg-3 col-6 ">
                            <!--== Start Feature Item ==-->
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <a href=""> <img src="{{ asset('website/images/icons/showroom.png') }}"
                                            width="50" height="50" alt="Icon" /></a>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title"><a href="{{ route('physical.store') }}">Physical Store</a>
                                    </h4>
                                </div>
                            </div>
                            <!--== End Feature Item ==-->
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-6">
                            <!--== Start Feature Item ==-->
                            <div class="feature-item ">
                                <div class="feature-icon">
                                    <a href=""> <img src="{{ asset('website/images/icons/delevery.png') }}"
                                            width="50" height="50" alt="Icon" /></a>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title"><a href="{{ route('fastest.delivery') }}">Fastest
                                            Delivery</a>
                                    </h4>
                                </div>
                            </div>
                            <!--== End Feature Item ==-->
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-6 ">
                            <!--== Start Feature Item ==-->
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <a href=""> <img src="{{ asset('website/images/icons/service.png') }}"
                                            width="50" height="50" alt="Icon" /></a>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title"><a href="{{ route('customer.service') }}">Sale Service</a>
                                    </h4>
                                </div>
                            </div>
                            <!--== End Feature Item ==-->
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 col-6 ">
                            <!--== Start Feature Item ==-->
                            <div class="feature-item border-0 ">
                                <div class="feature-icon">
                                    <a href=""> <img src="{{ asset('website/images/icons/cus-review.jpg') }}"
                                            width="50" height="50" alt="Icon" /></a>
                                </div>
                                <div class="feature-content">
                                    <h4 class="feature-title"><a href="#">Customer Reviews</a></h4>
                                </div>
                            </div>
                            <!--== End Feature Item ==-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== End Features Area Wrapper ==-->

        <!--== Start Product Banner Area Wrapper ==-->
        @foreach ($banner as $bann)
            <div class="product-banner-area">
                <div class="container bg-white bg-white-wrp ">
                    <!--== Start Product Banner Item ==-->
                    <a href="{{ $bann->link }}">
                        <div class="product-banner-seven-item text-center" data-bg-img="{{ asset($bann->image) }}"
                            style="background-image: url({{ asset($bann->image) }});"> </div>
                    </a>

                    @php
                        $products = App\Models\Product::where('banner_id', $bann->id)
                            ->take(16)
                            ->get();
                    @endphp
                    <!--== End Product Banner Item ==-->
                </div>
            </div>


            <!--== Start Product Area Wrapper ==-->
            <div class="product-area section-two-space">
                <div class="container">
                    <div class="row masonryGrid mb-n6">
                        @foreach ($products as $item)
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-6 masonry-item">
                                <!--== Start Product Item ==-->
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('product.show', $item->slug) }}" class="product-item-thumb">
                                            <img class="pic-1 "
                                                src="{{ asset('uploads/product/thumbnail/' . $item->thumb_image) }}"
                                                alt="productimg1">
                                            <img class="pic-2 " src="{{ asset($item->otherimage) }}"
                                                alt="productimg1-2">
                                        </a>
                                    </div>
                                    @if ($item->discount > 0)
                                        <span class="badges">Sale-{{ round($item->discount) }}%</span>
                                    @endif

                                    <div class="product-item-action product-item-action--two d-none d-md-block">
                                        <button type="button" class="product-action-btn action-btn-wishlist addcart"
                                            data-id="{{ $item->id }}">
                                            <i class="fa fa-shopping-bag"></i>
                                        </button>

                                    </div>
                                    <div class="product-item-info pb-1">
                                        <p>{{ optional($item->brand)->name }}</p>
                                        <h5 class="product-item-title mb-2">
                                            <a
                                                href="{{ route('product.show', $item->slug) }}">{{ Str::of($item->name)->limit(63) }}</a>
                                        </h5>
                                        <div class="product-item-price ">
                                            @if ($item->discount_price > 0)
                                                <span
                                                    class="price-old pe-1">&#2547;{{ number_format($item->selling_price, 2) }}</span>
                                                &#2547;{{ number_format($item->selling_price - $item->discount_price, 2) }}
                                            @else
                                                <span
                                                    class="text-center">&#2547;{{ number_format($item->selling_price, 2) }}</span>
                                            @endif
                                        </div>

                                        @if ($item->quantity == 0)
                                            <div class="cart-button text-center stock_out">
                                                <button
                                                    class="product-detail-cart-btn js-prd-addtocar btn-danger text-white"
                                                    disabled type="button"> Out of stock</button>
                                            </div>
                                        @else
                                            <div class="cart-button">
                                                <button class="product-detail-cart-btn js-prd-addtocar addcart me-1"
                                                    type="button" data-id="{{ $item->id }}"
                                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithCartSidebar"
                                                    aria-controls="offcanvasWithCartSidebar">Add to
                                                    cart</button>
                                                <button class="product-detail-cart-btn buynow" type="button"
                                                    data-id="{{ $item->id }}">Buy
                                                    Now</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!--== End Product Item ==-->
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!--== End Product Area Wrapper ==-->
        @endforeach
    </main>
@endsection

@push('web_script')
@endpush
