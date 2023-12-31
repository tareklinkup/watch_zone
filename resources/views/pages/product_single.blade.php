@extends('layouts.web_master')
@section('title', $productMeta->meta_title)
@section('meta_description', $productMeta->meta_description)
@section('meta_keywords', $productMeta->meta_keywords)

@push('webcss')
    <link rel="stylesheet" href="{{ asset('website/css/zoom_style.css') }}" />
    <style>
        .transform {
            transition-duration: 0ms;
            transform: translate3d(0px, 0px, 0px) !important;
        }

        /* Styles for product images */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .image-link {
            display: inline-block;
            cursor: pointer;
            margin: 10px;
        }

        .zoomable-image {
            max-width: 100%;
            height: auto;
        }

        /* Styles for enlarge button */
        /* #enlarge-button {
                                                                                                                                                            display: block;
                                                                                                                                                            margin: 20px auto;
                                                                                                                                                            padding: 10px 20px;
                                                                                                                                                            cursor: pointer;
                                                                                                                                                        } */

        /* Styles for enlarged image */
        .enlarged-image-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #686868e6;
            opacity: 0.8.05;
            text-align: center;
            z-index: 1000;
        }

        #enlarged-image {
            max-width: 100%;
            max-height: 100%;
            margin: auto;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }
    </style>
@endpush
@section('website-content')

    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header-content">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" style="margin-left:8px;">
                                    <a href="{{ route('home') }}"> Home /</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('product.cat', $product->category->slug) }}">{{ $product->category->name }}
                                        /</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{ route('product.brand', $product->brand->slug) }}">
                                        {{ $product->brand->name }} /</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $product->name }}
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

                    <div class="col-lg-6 product-details-mobile col-md-none ">

                        <div class="product-detail-thumb me-lg-6">

                            <div class="enlarged-image-container" id="enlarged-image-container">
                                <span class="close" id="close-btn">&times;</span>
                                <img src alt="Enlarged Product Image" id="enlarged-image">
                            </div>

                            <div class="swiper single-product-thumb-slider">
                                @if ($product->discount > 0)
                                    <span class="badges">Sale-{{ round($product->discount) }}%</span>
                                @endif

                                <div class="swiper-wrapper">

                                    <button id="enlarge-button"
                                        style="height:40px; width:25%; margin-top:50px; backround:transfarent; display:none;">
                                        Zoom </button>
                                    <a class="lightbox-image swiper-slide zoom image-link" data-fancybox="gallery"
                                        href="#" id="zoomAdd">
                                        <img src="{{ asset('uploads/product/' . $product->image) }}"
                                            data-zoom-image="{{ asset('uploads/product/' . $product->image) }}"
                                            width="640" height="530" alt="Image" class="zoomable-image" />
                                        <span
                                            style="margin-top:0px; font-size:18px; font-weight:bold; text-align:center; border:1px solid #ccc; width:40%; margin:auto; border-radius:5px; padding:1px;"
                                            class="d-none"> Touch
                                            Zoom</span>
                                    </a>

                                    <a class="lightbox-image swiper-slide nav-item zoom image-link" data-fancybox="gallery"
                                        href="#">
                                        <img src="{{ asset($product->otherimage) }}" width="640" height="530"
                                            alt="Image" class="zoomable-image" />
                                        <span
                                            style="margin-top:0px; font-size:18px; font-weight:bold; text-align:center; border:1px solid #ccc; width:40%; margin:auto; border-radius:5px; padding:1px;"
                                            class="d-none"> Touch
                                            Zoom</span>
                                    </a>

                                    @foreach ($product_images as $multi)
                                        {{-- <a class="lightbox-image swiper-slide zoom" data-fancybox="gallery" href="#">
                                            <img src="{{ asset($product->otherimage) }}" width="640" height="530"
                                                alt="Image" />
                                        </a> --}}
                                        {{-- <a class="lightbox-image swiper-slide zoom" data-fancybox="gallery" href="#">
                                            <img src="{{ asset($multi->multiimage) }}"
                                                data-zoom-image="{{ asset($multi->multiimage) }}" width="640"
                                                height="530" alt="Image" />
                                        </a> --}}

                                        <a class="lightbox-image swiper-slide nav-item zoom image-link"
                                            data-fancybox="gallery" href="#">
                                            <img src="{{ asset($multi->multiimage) }}" width="640" height="530"
                                                alt="Image" class="zoomable-image" />
                                            <span
                                                style="margin-top:0px; font-size:18px; font-weight:bold; text-align:center; border:1px solid #ccc; width:40%; margin:auto; border-radius:5px; padding:1px;"
                                                class="d-none"> Touch
                                                Zoom</span>
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
                                                {{-- <a class="lightbox-image swiper-slide nav-item" data-fancybox="gallery"
                                                    href="#">
                                                    <img src="{{ asset($multiimg->multiimage) }}" width="640"
                                                        height="530" alt="Image" />
                                                </a> --}}
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

                        <!-------Mobile view---------->
                    </div>

                    <div class="col-lg-6">
                        <div class="product-detail-content">
                            <h2 class="product-detail-title mt-n1 me-10">
                                {{ $product->name }}
                            </h2>
                            <div class="product-item-price  single_price" style="text-align: left">
                                @if ($product->discount_price > 0)
                                    <span class="price-old pe-1 sinlge_old"
                                        style="color:#646464">&#2547;{{ number_format($product->selling_price, 2) }}</span>
                                    &#2547;{{ number_format($product->selling_price - $product->discount_price, 2) }}
                                @else
                                    <span
                                        class="text-center">&#2547;{{ number_format($product->selling_price, 2) }}</span>
                                @endif
                            </div>
                            <ul class="product-detail-meta">
                                @if (isset($product->model))
                                    <li><span><strong>Model :</strong> </span> {{ $product->model }}</li>
                                @endif
                                @if (isset($product->movement->name))
                                    <li><span><strong>Movement :</strong> </span> {{ $product->movement->name }}
                                    </li>
                                @endif
                                @if (isset($product->size->name))
                                    <li><span><strong>Case Size :</strong> </span> {{ $product->size->name }}
                                    </li>
                                @endif
                                @if (isset($product->resistant))
                                    <li><span><strong>Water Resistance :</strong></span> {{ $product->resistant }}</li>
                                @endif
                                @if (isset($product->warranty))
                                    <li><span><strong>Warranty :</strong> </span> {{ $product->warranty }}</li>
                                @endif
                                <li><span><strong>Category :</strong> </span> {{ $product->category->name }}</li>
                                <li><span><strong style="color:#055805;">Availability :</strong> </span>
                                    @if ($product->quantity == 0)
                                        <span class="prd-in-stock" data-stock-status="">Out of stock</span>
                                    @else
                                        <span class="prd-in-stock" data-stock-status=""> {{ $product->quantity }} in
                                            stock
                                        </span>
                                    @endif

                                </li>
                            </ul>
                            <div class="my-2 d-flex">
                                <form action="{{ route('add-cart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="stock" id="stock"
                                        value="{{ $product->quantity }}">
                                    @if ($product->quantity == 0)
                                        <div class="pro-qty" style="display: none">
                                            <input type="text" title="Quantity" name="qty" min="1"
                                                value="1" />
                                        </div>
                                    @else
                                        <div class="pro-qty">
                                            <input type="text" title="Quantity" name="qty" min="0"
                                                max="3" value="1" />
                                        </div>
                                    @endif

                                    <input type="hidden" id="product_id" name="product_id"
                                        value="{{ $product->id }}">

                                    @if ($product->quantity == 0)
                                        <div class="cart-button">
                                            <button
                                                class="product-detail-cart-btn js-prd-addtocar addcart btn-danger text-white"
                                                disabled type="button">Out of stock</button>
                                        </div>
                                    @else
                                        <input type="submit" value="Add To Cart" class="product-detail-cart-btn me-1">
                                </form>

                                <button class="product-detail-cart-btn buying ms-1 " type="button"
                                    data-id="{{ $product->id }}" id="buyButton">
                                    Buy Now
                                </button>
                                @endif
                            </div>
                            <p class="product-detail-desc">
                                For more live images and videos, Contact us now
                            <div class="mb-2 wbutton whats-btn">
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
                        <div class="feature-svg ">

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
                    @foreach ($related as $relatedPro)
                        @if ($relatedPro->quantity !== 0)
                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 mb-6 masonry-item ">
                                <!--== Start Product Item ==-->
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ route('product.show', $relatedPro->slug) }}"
                                            class="product-item-thumb">
                                            <img class="pic-1 "
                                                src="{{ asset('uploads/product/thumbnail/' . $relatedPro->thumb_image) }}"
                                                alt="productimg1">
                                            <img class="pic-2 " src="{{ asset($relatedPro->otherimage) }}"
                                                alt="productimg1-2">
                                        </a>
                                    </div>
                                    @if ($relatedPro->discount > 0)
                                        <span class="badges">Sale-{{ round($relatedPro->discount) }}%</span>
                                    @endif

                                    <div class="product-item-action product-item-action--two d-none d-md-block">
                                        <button type="button" class="product-action-btn action-btn-wishlist addcart"
                                            data-id="{{ $relatedPro->id }}">
                                            <i class="fa fa-shopping-bag"></i>
                                        </button>

                                    </div>
                                    <div class="product-item-info  bg-white pb-1">
                                        <h5 class="product-item-title pt-2 mb-4">
                                            <a
                                                href="{{ route('product.show', $relatedPro->slug) }}">{{ Str::of($relatedPro->name)->limit(63) }}</a>
                                        </h5>

                                        <div class="product-item-price ">
                                            @if ($relatedPro->discount_price > 0)
                                                <span
                                                    class="price-old pe-1">&#2547;{{ number_format($relatedPro->selling_price, 2) }}</span>
                                                &#2547;{{ number_format($relatedPro->selling_price - $relatedPro->discount_price, 2) }}
                                            @else
                                                <span
                                                    class="text-center">&#2547;{{ number_format($relatedPro->selling_price, 2) }}</span>
                                            @endif
                                        </div>

                                        @if ($relatedPro->quantity == 0)
                                            <div class="cart-button text-center">
                                                <button class="product-detail-cart-btn js-prd-addtocar addcart" disabled
                                                    type="button"> Out of stock</button>
                                            </div>
                                        @else
                                            <div class="cart-button">
                                                <button class="product-detail-cart-btn js-prd-addtocar addcart me-1"
                                                    type="button" data-id="{{ $relatedPro->id }}"
                                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithCartSidebar"
                                                    aria-controls="offcanvasWithCartSidebar">Add to
                                                    cart</button>
                                                {{-- <button class="product-detail-cart-btn buynow" type="button"
                                                    data-id="{{ $relatedPro->id }}">Buy
                                                    Now</button> --}}
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

            if (window.innerWidth > 768) {
                $('.zoom').zoom();
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            let toggleVariable = false;

            // Get a reference to the button element
            const toggleButton = document.getElementById('zoombutton');

            // Add a click event listener to the button
            toggleButton.addEventListener('click', function() {
                // Toggle the variable between true and false
                toggleVariable = !toggleVariable;

                // Print the current value of the variable
                console.log('Variable is now:', toggleVariable);
                if (toggleVariable == true) {
                    startZoom();
                } else {
                    stopZoom();
                }

                // $(".zoom-button").click(function() {

                // });

            })

            function startZoom() {
                $('.wbutton').addClass('whats-btn');
                $('.addZoom1').addClass('zoom');
                $('.addZoom2').addClass('zoom');
                $('.addZoom3').addClass('zoom');
                $('.zoom').zoom();
                zoomActive = true;
            }

            function stopZoom() {
                $('.wbutton').removeClass('whats-btn');
                $('.addZoom1').removeClass('zoom');
                $('.zoom').zoom();
                $('.addZoom2').removeClass('zoom');
                $('.addZoom3').removeClass('zoom');

                zoomActive = false;
            }
            // $("#zoombutton").click(function() {

            // })

            // $("#zoombutton").click(function() {
            //     if (!zoomed) {
            //         zoomMethod();
            //     }
            //     console.log(zoomed);
            //     zoomed = true;
            // })

            // function zoomMethod() {
            //     $('.zoom').zoom();
            // }
        })
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imageLinks = document.querySelectorAll(".image-link");
            const enlargeButton = document.getElementById("enlarge-button");
            const enlargedImageContainer = document.getElementById(
                "enlarged-image-container"
            );
            const enlargedImage = document.getElementById("enlarged-image");
            const closeBtn = document.getElementById("close-btn");

            // Click event listener for image links
            imageLinks.forEach(function(link) {
                link.addEventListener("click", function(e) {
                    e.preventDefault(); // Prevent the default link behavior
                    const imageUrl = link
                        .querySelector(".zoomable-image")
                        .getAttribute("src");
                    enlargedImage.setAttribute("src", imageUrl);
                    enlargedImageContainer.style.display = "block";
                });
            });

            // Click event listener for the enlarge button
            enlargeButton.addEventListener("click", function() {
                enlargedImageContainer.style.display = "block";
            });

            // Click event listener to close the enlarged image
            closeBtn.addEventListener("click", function() {
                enlargedImageContainer.style.display = "none";
            });

            // Click event listener to close the enlarged image by clicking outside
            enlargedImageContainer.addEventListener("click", function(e) {
                if (e.target === enlargedImageContainer) {
                    enlargedImageContainer.style.display = "none";
                }
            });
        });
    </script>

    <script>
        var proQty = $(".pro-qty");

        proQty.append('<div class= "dec qty-btn">-</div>');
        proQty.append('<div class="inc qty-btn">+</div>');
        $('.qty-btn').on('click', function(e) {
            e.preventDefault();
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            var stock = $("#stock").val();
            var newStock = parseFloat(stock) + 1;
            if ($button.hasClass('inc')) {

                var newVal = parseFloat(oldValue) + 1;
                if (newStock == newVal) {
                    return;
                }
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            $button.parent().find('input').val(newVal);
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
