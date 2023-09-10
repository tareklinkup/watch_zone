@extends('layouts.web_master')
@section('title', 'Product Category')

@section('website-content')

    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            {{-- <h2 class="page-header-title">Products</h2> --}}
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home //</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Products
                                </li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->
        {{-- <section>
            <div class="container">
                <div class="side_bar mt-3 d-block d-md-none" v-if="categoryId == 1 || categoryId == 2">
                    <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                        aria-controls="offcanvasExample">
                        <i class="fa fa-bars"></i> <span>Filters</span>
                    </a>
                </div>
            </div>
        </section> --}}
        <!--== Start Product Area Wrapper ==-->
        <div class="product-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-9 order-0 order-lg-1">

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="column-three" role="tabpanel"
                                aria-labelledby="column-three-tab">
                                <div class="row mb-n6">
                                    @if ($product->count() > 0)
                                        @foreach ($product as $item)
                                            <div class="col-sm-6 col-md-4 col-6 mb-6 masonry-item">
                                                <!--== Start Product Item ==-->
                                                <div class="product-item pb-2">
                                                    <div class="product-img">
                                                        <a class="product-item-thumb"
                                                            href="{{ route('product.show', $item->slug) }}">
                                                            <img class="pic-1"
                                                                src="{{ asset('uploads/product/thumbnail/' . $item->thumb_image) }}"
                                                                width="270" height="264" alt="product image" />
                                                            <img class="pic-2" src="{{ asset($item->otherimage) }}"
                                                                alt="productimg-2">
                                                        </a>
                                                    </div>
                                                    @if ($item->discount > 0)
                                                        <span class="badges">Sale-{{ round($item->discount) }}%</span>
                                                    @endif
                                                    <div class="product-item-action d-none d-md-block">
                                                        <button type="button"
                                                            class="product-action-btn action-btn-wishlist addcart"
                                                            data-id="{{ $item->id }}">
                                                            <i class="fa fa-shopping-bag"></i>
                                                        </button>

                                                    </div>
                                                    <div class="product-item-info text-center pb-3">
                                                        <p>{{ $item->brand->name }}</p>
                                                        <h5 class="product-item-title mb-2" style="text-align: left;">
                                                            <a
                                                                href="{{ route('product.show', $item->slug) }}">{{ Str::of($item->name)->limit(65) }}</a>
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
                                                    </div>

                                                    @if ($item->quantity == 0)
                                                        <div class="cart-button">
                                                            <button
                                                                class="product-detail-cart-btn js-prd-addtocar btn-danger text-white"
                                                                disabled type="button"> Out of stock</button>
                                                        </div>
                                                    @else
                                                        <div class="cart-button">
                                                            <button
                                                                class="product-detail-cart-btn js-prd-addtocar addcart me-1"
                                                                type="button" data-id="{{ $item->id }}"
                                                                data-bs-toggle="offcanvas"
                                                                data-bs-target="#offcanvasWithCartSidebar"
                                                                aria-controls="offcanvasWithCartSidebar">Add to
                                                                cart</button>
                                                            {{-- <button class="product-detail-cart-btn buynow" type="button"
                                                                data-id="{{ $item->id }}">Buy
                                                                Now</button> --}}
                                                        </div>
                                                    @endif


                                                </div>
                                                <!--== End Product Item ==-->
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12 text-center">
                                            <h4 class="text-danger d-flex justify-content-center" style="font-size: 30px">No
                                                Product
                                                Found!</h4>
                                        </div>
                                    @endif

                                    <div class="d-flex justify-content-center">
                                        {{ $product->links() }}
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>

                    <div class="col-lg-4 col-xl-3 order-1 order-lg-0 d-none d-md-block">
                        <!--== Start Sidebar Area Wrapper ==-->
                        <div class="sidebar-area mt-10 mt-lg-0 accordion" id="accordionExample">

                            {{-- <div class="widget-item widget-item-one">
                                <h4 class="accordion-header" id="headingTwo1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                                        Gender
                                    </button>
                                </h4>
                                <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1"
                                    data-bs-parent="#accordionExample">
                                    <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1"
                                        data-bs-parent="#accordionExample">
                                        <ul class="accordion-body side_area">
                                            @foreach ($categories as $item)
                                                <li class="border-bottom"><a
                                                        href="{{ route('product.cat', $item->slug) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div> --}}

                            <div class="widget-item widget-item-one">
                                <h4 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Brand
                                    </button>
                                </h4>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                        data-bs-parent="#accordionExample">
                                        <ul class="accordion-body side_area">
                                            @foreach ($brands as $item)
                                                <li class="border-bottom"><a
                                                        href="{{ route('product.brand', $item->slug) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>



                        </div>
                        <!--== End Sidebar Area Wrapper ==-->
                    </div>
                </div>
            </div>
        </div>
        <!--== End Product Area Wrapper ==-->

        {{-- <div class="offcanvas offcanvas-start product_items_filter" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Products Filter</h5>
                <button type="button" class="btn-close text-reset " data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <div class="sidebar-area accordion" id="accordionExample">

                    <div class="widget-item widget-item-one">
                        <h4 class="accordion-header" id="headingTwo1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                                Gender
                            </button>
                        </h4>
                        <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1"
                            data-bs-parent="#accordionExample">
                            <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1"
                                data-bs-parent="#accordionExample">
                                <ul class="accordion-body side_area">
                                    @foreach ($categories as $item)
                                        <li class="border-bottom"><a
                                                href="{{ route('product.cat', $item->slug) }}">{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="widget-item widget-item-one">
                        <h4 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Brand
                            </button>
                        </h4>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <ul class="accordion-body side_area">
                                    @foreach ($brands as $item)
                                        <li class="border-bottom"><a
                                                href="{{ route('product.brand', $item->slug) }}">{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div> --}}



        <div class="offcanvas offcanvas-start product_items_filter" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Side Manu</h5>
                <button type="button" class="btn-close text-reset " data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <div class="sidebar-area accordion" id="accordionExample">

                    <div class="widget-item widget-item-one">
                        <h4 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Brand
                            </button>
                        </h4>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <ul class="accordion-body side_area">
                                @foreach ($brands as $item)
                                    <li class="border-bottom"><a
                                            href="{{ route('product.brand', $item->slug) }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="widget-item widget-item-one">
                        <h4 class="accordion-header" id="headingTwo1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                                Gender
                            </button>
                        </h4>
                        <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1"
                            data-bs-parent="#accordionExample">
                            <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1"
                                data-bs-parent="#accordionExample">
                                <ul class="accordion-body side_area">
                                    @foreach ($categories as $item)
                                        <li class="border-bottom"><a
                                                href="{{ route('product.cat', $item->slug) }}">{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>


        </form>

    </main>

@endsection


@push('web_script')
@endpush
