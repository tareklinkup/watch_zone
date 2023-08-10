@extends('layouts.web_master')
@section('title', 'Product Details')
@push('webcss')
    <link rel="stylesheet" href="{{ asset('website/css/zoom_style.css') }}" />
    <style>
        .transform {
            transition-duration: 0ms;
            transform: translate3d(0px, 0px, 0px) !important;
        }
    </style>
@endpush
@section('website-content')

    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home //</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $product->brand->name }}
                                </li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Product Detail Area Wrapper ==-->
        <div class="product-detail-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-detail-thumb me-lg-6">
                            <div class="swiper single-product-thumb-slider">
                                @if ($product->discount > 0)
                                    <span class="badges">Sale-{{ round($product->discount) }}%</span>
                                @endif
                                <div class="swiper-wrapper">
                                    <a class="lightbox-image swiper-slide zoom" data-fancybox="gallery" href="#">
                                        <img src="{{ asset('uploads/product/' . $product->image) }}"
                                            data-zoom-image="{{ asset('uploads/product/' . $product->image) }}"
                                            width="640" height="530" alt="Image" />
                                    </a>
                                    <a class="lightbox-image swiper-slide nav-item zoom" data-fancybox="gallery"
                                        href="#">
                                        <img src="{{ asset($product->otherimage) }}" width="640" height="530"
                                            alt="Image" />
                                    </a>
                                    @foreach ($product_images as $multi)
                                        <a class="lightbox-image swiper-slide zoom" data-fancybox="gallery" href="#">
                                            <img src="{{ asset($product->otherimage) }}" width="640" height="530"
                                                alt="Image" />
                                        </a>
                                        <a class="lightbox-image swiper-slide zoom" data-fancybox="gallery" href="#">
                                            <img src="{{ asset($multi->multiimage) }}"
                                                data-zoom-image="{{ asset($multi->multiimage) }}" width="640"
                                                height="530" alt="Image" />
                                        </a>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="single-product-nav-wrp">
                                <div class="swiper single-product-nav-slider">
                                    <div class="swiper-wrapper">
                                        <a class="lightbox-image swiper-slide" data-fancybox="gallery" href="#">
                                            <img src="{{ asset('uploads/product/' . $product->image) }}" width="640"
                                                height="530" alt="Image" />
                                        </a>
                                        <a class="lightbox-image swiper-slide nav-item" data-fancybox="gallery"
                                            href="#">
                                            <img src="{{ asset($product->otherimage) }}" width="640" height="530"
                                                alt="Image" />
                                        </a>
                                        @foreach ($product_images as $multiimg)
                                            <div class="nav-item swiper-slide">
                                                <img src="{{ asset($multiimg->multiimage) }}" alt="Image" width="127"
                                                    height="127" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="swiper-button-style11">
                                    <!--== Start Swiper Navigation ==-->
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-detail-content">
                            <h2 class="product-detail-title mt-n1 me-10">
                                {{ $product->name }}
                            </h2>
                            <div class="product-item-price  single_price" style="text-align: left">
                                @if ($product->discount_price > 0)
                                    <span
                                        class="price-old pe-1 sinlge_old">&#2547;{{ number_format($product->selling_price, 2) }}</span>
                                    &#2547;{{ number_format($product->selling_price - $product->discount_price, 2) }}
                                @else
                                    <span class="text-center">&#2547;{{ number_format($product->selling_price, 2) }}</span>
                                @endif
                            </div>
                            <ul class="product-detail-meta">
                                <li><span><strong>Model :</strong> </span> {{ $product->model }}</li>
                                <li><span><strong>Movement :</strong> </span> {{ optional($product->movement)->name }}</li>
                                <li><span><strong>Case Size :</strong> </span> {{ optional($product->size)->name }}</li>
                                <li><span><strong>Water Resistance :</strong></span> {{ $product->resistant }}</li>
                                <li><span><strong>Warranty :</strong> </span> {{ $product->warranty }}</li>
                                <li><span><strong>Categories :</strong> </span> {{ $product->category->name }}</li>
                                <li><span><strong>Availability :</strong> </span>
                                    @if ($product->quantity == 0)
                                        <span class="prd-in-stock" data-stock-status="">Out of stock</span>
                                    @else
                                        <span class="prd-in-stock" data-stock-status="">In stock</span>
                                    @endif

                                </li>
                            </ul>
                            <div class="my-2 d-flex">
                                @if ($product->quantity == 0)
                                    <div class="pro-qty" style="display: none">
                                        <input type="text" title="Quantity" name="qty" min="1"
                                            value="1" />
                                    </div>
                                @else
                                    <div class="pro-qty">
                                        <input type="text" title="Quantity" name="qty" min="1"
                                            value="1" />
                                    </div>
                                @endif

                                <input type="hidden" id="product_id" value="{{ $product->id }}">
                                @if ($product->quantity == 0)
                                    <div class="cart-button">
                                        <button
                                            class="product-detail-cart-btn js-prd-addtocar addcart btn-danger text-white"
                                            disabled type="button">Out of stock</button>
                                    </div>
                                @else
                                    <button class="product-detail-cart-btn buynow me-1" value="cart" type="button"
                                        data-id="{{ $product->id }}">
                                        Add to cart
                                    </button>
                                    <button class="product-detail-cart-btn buying ms-1" type="button"
                                        data-id="{{ $product->id }}">
                                        Buy Now
                                    </button>
                                @endif
                            </div>
                            <p class="product-detail-desc">
                                For more live images and videos, Contact us now
                            <div class="whats-btn mb-2">
                                <a href="{{ $content->whatsapp }}" target="_blank">WhatsApp</a>
                            </div>
                            <strong><a href="tel:{{ $content->phone_one }}">{{ $content->phone_one }}</a></strong>
                            {!! $product->short_desc !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Product Detail Area Wrapper ==-->


        <div class="product_details">
            <div class="container">
                <div class="row text-center" style="margin:15px; 0">
                    <div class="col-lg-3 col-6">
                        <div class="feature-svg">
                            <div class="svg d-none d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" fill="none" stroke="#333"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    viewBox="0 0 45 45" width="40px" height="40px">
                                    <path
                                        d="M22.5 43.91c20.09-6.58 17-35.21 17-35.21-12.4-.7-17-7.61-17-7.61s-4.6 7.05-17 7.7c.01 0-3.09 28.64 17 35.12z">
                                    </path>
                                    <circle cx="22.5" cy="22.69" r="7.89"></circle>
                                    <path d="M19.12 22.5L22 25.22 26.16 21"></path>
                                </svg>
                            </div>
                            <div class="svg d-block d-md-none">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" fill="none" stroke="#333"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    viewBox="0 0 45 45" width="30px" height="30px">
                                    <path
                                        d="M22.5 43.91c20.09-6.58 17-35.21 17-35.21-12.4-.7-17-7.61-17-7.61s-4.6 7.05-17 7.7c.01 0-3.09 28.64 17 35.12z">
                                    </path>
                                    <circle cx="22.5" cy="22.69" r="7.89"></circle>
                                    <path d="M19.12 22.5L22 25.22 26.16 21"></path>
                                </svg>
                            </div>
                            <div class="svg-name">
                                <span> Authenticity Guaranteed</span>
                            </div>



                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="feature-svg">

                            <div class="svg d-none d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" fill="none" stroke="#333"
                                    stroke-width="1.5" viewBox="0 0 45 45" width="40px" height="40px">
                                    <path
                                        d="M24.06 33.24H8.44a.78.78 0 0 1-.78-.78V2a.77.77 0 0 1 .78-.78h29.1a.77.77 0 0 1 .78.78v30.46a.77.77 0 0 1-.78.78h-2">
                                    </path>
                                    <circle cx="29.82" cy="33.24" r="5.76"></circle>
                                    <path
                                        d="M32.61 38.51v5a.35.35 0 0 1-.49.3l-2.15-1h-.29l-2.15 1a.38.38 0 0 1-.49-.3v-5">
                                    </path>
                                    <path d="M17.13 23.11h12.69M14.2 12.22h18.55M14.2 6.78h18.55M14.2 17.67h18.55"></path>
                                </svg>
                            </div>

                            <div class="svg d-block d-md-none ">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" fill="none" stroke="#333"
                                    stroke-width="1.5" viewBox="0 0 45 45" width="30px" height="30px">
                                    <path
                                        d="M24.06 33.24H8.44a.78.78 0 0 1-.78-.78V2a.77.77 0 0 1 .78-.78h29.1a.77.77 0 0 1 .78.78v30.46a.77.77 0 0 1-.78.78h-2">
                                    </path>
                                    <circle cx="29.82" cy="33.24" r="5.76"></circle>
                                    <path
                                        d="M32.61 38.51v5a.35.35 0 0 1-.49.3l-2.15-1h-.29l-2.15 1a.38.38 0 0 1-.49-.3v-5">
                                    </path>
                                    <path d="M17.13 23.11h12.69M14.2 12.22h18.55M14.2 6.78h18.55M14.2 17.67h18.55"></path>
                                </svg>
                            </div>
                            <div class="svg-name">
                                <span> 1-5 Year Warranty</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="feature-svg">
                            <div class="svg d-none d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" fill="none" stroke="#333"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    viewBox="0 0 45 45" width="40px" height="40px">
                                    <path
                                        d="M31.16 34.21l-3-.48c-2-.32-5.6 1.17-7.81 2.2a2.08 2.08 0 0 1-2.76-1 2.08 2.08 0 0 1 1-2.81l7-3.07c3.06-1.33 8.51-.15 11.42 1.49v11.12l-11.4 1.81a7.79 7.79 0 0 1-5.25-.53L2.89 33.73A1.79 1.79 0 0 1 2 31.44a1.79 1.79 0 0 1 2.28-1l13.34 4.5M37.14 32.11v-3.22h5.99v15.22h-5.99v-2.45">
                                    </path>
                                    <path d="M4.78 30.54V.7h29.36v28.19M12.54.7v15.44l6.92-3.61L26 16.14V.7"></path>
                                </svg>
                            </div>
                            <div class="svg d-block d-md-none">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" fill="none" stroke="#333"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    viewBox="0 0 45 45" width="30px" height="30px">
                                    <path
                                        d="M31.16 34.21l-3-.48c-2-.32-5.6 1.17-7.81 2.2a2.08 2.08 0 0 1-2.76-1 2.08 2.08 0 0 1 1-2.81l7-3.07c3.06-1.33 8.51-.15 11.42 1.49v11.12l-11.4 1.81a7.79 7.79 0 0 1-5.25-.53L2.89 33.73A1.79 1.79 0 0 1 2 31.44a1.79 1.79 0 0 1 2.28-1l13.34 4.5M37.14 32.11v-3.22h5.99v15.22h-5.99v-2.45">
                                    </path>
                                    <path d="M4.78 30.54V.7h29.36v28.19M12.54.7v15.44l6.92-3.61L26 16.14V.7"></path>
                                </svg>
                            </div>
                            <div class="svg-name">
                                <span> Brand New</span>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="feature-svg border-0">
                            <div class="svg d-none d-md-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                    fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path
                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                    <path fill-rule="evenodd"
                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                </svg>
                            </div>
                            <div class="svg d-block d-md-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                    <path
                                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                    <path fill-rule="evenodd"
                                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                </svg>
                            </div>
                            <div class="svg-name">
                                <span> 7 Days Exchange Policy</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- productItem --}}

                <div class="row">
                    @if (count($productItem) > 0)
                        <div class="col-lg-4 col-12 mb-4">
                            <div class="feac-header">
                                <h3>Item</h3>
                            </div>
                            <div class="feature-content">
                                <ul class="feat-item">
                                    @foreach ($productItem as $item)
                                        <li class="feature-link mt-2">
                                            <p class="name" style="font-weight:bold;">{{ $item->label }}</p>
                                            <p class="value">{{ $item->value }}</p>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    @endif

                    @if (count($productCase) > 0)
                        <div class="col-lg-4 col-12 mb-4">
                            <div class="feac-header">
                                <h3>Case</h3>
                            </div>
                            <div class="feature-content">
                                <ul class="feat-item">
                                    @foreach ($productCase as $case)
                                        <li class="feature-link mt-2">
                                            <p class="name" style="font-weight:bold;">{{ $case->case_label }}</p>
                                            <p class="value">{{ $case->case_value }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (count($productDial) > 0)
                        <div class="col-lg-4 col-12 mb-4">
                            <div class="feac-header">
                                <h3>Dial</h3>
                            </div>
                            <div class="feature-content">
                                <ul class="feat-item">
                                    @foreach ($productDial as $dial)
                                        <li class="feature-link mt-2">
                                            <p class="name" style="font-weight:bold;">{{ $dial->dial_label }}</p>
                                            <p class="value">{{ $dial->dial_value }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    @endif
                    @if (count($productMovement) > 0)
                        <div class="col-lg-4 col-12 mb-4">
                            <div class="feac-header">
                                <h3>Movement</h3>
                            </div>
                            <div class="feature-content">
                                <ul class="feat-item">
                                    @foreach ($productMovement as $movement)
                                        <li class="feature-link mt-2">
                                            <p class="name" style="font-weight:bold;">{{ $movement->movement_label }}
                                            </p>
                                            <p class="value">{{ $movement->movement_value }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (count($productBand) > 0)
                        <div class="col-lg-4 col-12 mb-4">
                            <div class="feac-header">
                                <h3>Band</h3>
                            </div>
                            <div class="feature-content">
                                <ul class="feat-item">
                                    @foreach ($productBand as $band)
                                        <li class="feature-link mt-2">
                                            <p class="name" style="font-weight:bold;">{{ $band->band_label }}</p>
                                            <p class="value">{{ $band->band_value }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (count($productAddition) > 0)
                        <div class="col-lg-4 col-12 mb-4">
                            <div class="feac-header">
                                <h3>Additional Information</h3>
                            </div>
                            <div class="feature-content">
                                <ul class="feat-item">
                                    @foreach ($productAddition as $addition)
                                        <li class="feature-link mt-2">
                                            <p class="name" style="font-weight:bold;">{{ $addition->addition_label }}
                                            </p>
                                            <p class="value">{{ $addition->addition_value }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="product_details">
            <div class="container">
                <div class="des-header text-center">
                    <h2>Description</h2>
                </div>
                <div class="description">
                    {!! $product->description !!}
                </div>
            </div>

        </div>


        <!--== Start Related Product Area Wrapper ==-->
        <div class="product-area section-bottom-space" style="background-color: #fff">
            <div class="container">
                <h2 class="section-title text-center mt-3">Related Products</h2>


                <div class="row masonryGrid mb-n6">
                    @foreach ($related as $related)
                        @if ($related->quantity !== 0)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-6 masonry-item ">
                                <!--== Start Product Item ==-->
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('product.show', $related->slug) }}" class="product-item-thumb">
                                            <img class="pic-1 "
                                                src="{{ asset('uploads/product/thumbnail/' . $related->thumb_image) }}"
                                                alt="productimg1">
                                            <img class="pic-2 " src="{{ asset($related->otherimage) }}"
                                                alt="productimg1-2">
                                        </a>
                                    </div>
                                    @if ($related->discount > 0)
                                        <span class="badges">Sale-{{ round($related->discount) }}%</span>
                                    @endif

                                    <div class="product-item-action product-item-action--two d-none d-md-block">
                                        <button type="button" class="product-action-btn action-btn-wishlist addcart"
                                            data-id="{{ $related->id }}">
                                            <i class="fa fa-shopping-bag"></i>
                                        </button>

                                    </div>
                                    <div class="product-item-info  bg-white pb-1">
                                        <h5 class="product-item-title pt-2 mb-4">
                                            <a
                                                href="{{ route('product.show', $related->slug) }}">{{ Str::of($related->name)->limit(63) }}</a>
                                        </h5>

                                        <div class="product-item-price ">
                                            @if ($related->discount_price > 0)
                                                <span
                                                    class="price-old pe-1">&#2547;{{ number_format($related->selling_price, 2) }}</span>
                                                &#2547;{{ number_format($related->selling_price - $related->discount_price, 2) }}
                                            @else
                                                <span
                                                    class="text-center">&#2547;{{ number_format($related->selling_price, 2) }}</span>
                                            @endif
                                        </div>

                                        @if ($related->quantity == 0)
                                            <div class="cart-button text-center">
                                                <button class="product-detail-cart-btn js-prd-addtocar addcart" disabled
                                                    type="button"> Out of stock</button>
                                            </div>
                                        @else
                                            <div class="cart-button">
                                                <button class="product-detail-cart-btn js-prd-addtocar addcart me-1"
                                                    type="button" data-id="{{ $related->id }}"
                                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithCartSidebar"
                                                    aria-controls="offcanvasWithCartSidebar">Add to
                                                    cart</button>
                                                <button class="product-detail-cart-btn buynow" type="button"
                                                    data-id="{{ $related->id }}">Buy
                                                    Now</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!--== End Product Item ==-->
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
        <!--== End Related Product Area Wrapper ==-->
    </main>

@endsection

@push('web_script')
    <script src="{{ asset('website/js/jquery.zoom.js') }}"></script>

    <script>
        $('.swiper-wrapper').addClass('transform');


        $(".swiper-button-prev").click(function() {
            $('.swiper-wrapper').removeClass('transform')
        });
        $(".swiper-button-next").click(function() {
            $('.swiper-wrapper').removeClass('transform')
        });

        $(document).ready(function() {
            $('.zoom').zoom();
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".buying").on("click", function() {
                var id = $(this).data('id');
                // alert(id);
                if (id) {
                    $.ajax({
                        url: "{{ url('/product/checkout/buying/') }}/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            miniCart();

                            //  start message
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000
                            })

                            if ($.isEmptyObject(data.error)) {
                                Toast.fire({
                                    type: 'success',
                                    title: data.success
                                })
                                window.location.href = '/product/checkout';
                            } else {
                                Toast.fire({
                                    type: 'error',
                                    title: data.error
                                })
                            }
                        }
                    });
                } else {

                }

            });
        });
    </script>
@endpush
