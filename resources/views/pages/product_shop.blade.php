@extends('layouts.web_master')
@section('title', 'Product')
@push('webcss')
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

    <style>
        .v-select {
            margin-bottom: 5px;
        }

        .v-select .dropdown-toggle {
            padding: 0px;
        }

        .v-select input[type=search],
        .v-select input[type=search]:focus {
            margin: 0px;
        }

        .v-select .vs__selected-options {
            overflow: hidden;
            flex-wrap: nowrap;
        }

        .v-select .selected-tag {
            margin: 2px 0px;
            white-space: nowrap;
            position: absolute;
            left: 0px;
        }

        .v-select .vs__actions {
            margin-top: -5px;
        }

        .v-select .dropdown-menu {
            width: auto;
            overflow-y: auto;
        }
    </style>
@endpush

@section('website-content')

    <main class="main-content" id="productFilters">

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
        <section>
            <div class="container">
                <div class="side_bar mt-3 d-block d-md-none">
                    <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                        aria-controls="offcanvasExample">
                        <i class="fa fa-bars"></i> <span>Filters</span>
                    </a>
                </div>
            </div>
        </section>


        <!--== Start Product Area Wrapper ==-->
        <div class="product-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xl-9 order-0 order-lg-1">

                        <div class="row mb-3">
                            <div class="col-md-9">

                            </div>
                            <div class="col-md-3">
                                <div class="product_sort">
                                    <select name="sortBy" v-model="sortBy" class="form-control shadow-none"
                                        @@change="getProductFilters">
                                        <option value="">Sort By Products</option>
                                        <option value="priceLowtoHigh">Price (Low to high)</option>
                                        <option value="priceHightoLow">Price (High to low)</option>
                                        <option value="nameAtoZ">Product Name (A to Z)</option>
                                        <option value="nameZtoA">Product Name (Z to A)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="column-three" role="tabpanel"
                                aria-labelledby="column-three-tab">
                                <div class="row mb-n6 lozad" id="product-row" style="display: none"
                                    :style="{ display: products.length > 0 ? '' : 'none' }">
                                    <div v-for="(product, ind) in products"
                                        class="col-sm-6 col-md-4 col-6 mb-6 masonry-item" :key="ind">
                                        <div class="product-item pb-2">
                                            <div class="product-img">
                                                <a class="product-item-thumb"
                                                    :href="`${baseUrl}/product/single/${product.slug}`">
                                                    <img class="pic-1"
                                                        :src="'/uploads/product/thumbnail/' + product.thumb_image"
                                                        width="270" height="264" alt="product_image" />
                                                    <img class="pic-2 " :src="`${baseUrl}/` + product.otherimage"
                                                        alt="productimg1-2">
                                                </a>
                                            </div>
                                            <span v-if="product.discount > 0"
                                                class="badges">Sale-@{{ Math.round(product.discount) }}%</span>
                                            <div class="product-item-action d-none d-md-block">
                                                <button type="button"
                                                    class="product-action-btn action-btn-wishlist addcart"
                                                    :data-id="product.id">
                                                    <i class="fa fa-shopping-bag"></i>
                                                </button>

                                            </div>
                                            <div class="product-item-info text-center pb-3">
                                                <p>@{{ product.brand?.name }}</p>
                                                <h5 class="product-item-title mb-2">
                                                    <a
                                                        :href="`${baseUrl}/product/single/${product.slug}`">@{{ product.name }}</a>
                                                </h5>

                                                <div class="product-item-price ">
                                                    <div v-if="product.discount_price > 0">

                                                        <span class="price-old pe-1">&#2547;@{{ parseFloat(product.selling_price) | decimal }}</span>
                                                        &#2547;@{{ parseFloat(product.selling_price - product.discount_price) | decimal }}
                                                    </div>

                                                    <span v-else class="text-center">&#2547;@{{ parseFloat(product.selling_price) | decimal }}</span>

                                                </div>
                                                <div v-if="product.quantity == 0" class="cart-button text-center stock_out">
                                                    <button
                                                        class="product-detail-cart-btn js-prd-addtocar btn-danger text-white"
                                                        disabled type="button"> Out of stock</button>
                                                </div>
                                                <div v-else class="cart-button">
                                                    <button class="product-detail-cart-btn js-prd-addtocar addToCart me-1"
                                                        onclick="AddToCart(event)" type="button" :value="product.id"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasWithCartSidebar"
                                                        aria-controls="offcanvasWithCartSidebar">Add to
                                                        cart</button>
                                                    <button onclick="BuyNow(event)" class="product-detail-cart-btn buyNow"
                                                        type="button" :value="product.id">Buy
                                                        Now</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- <div class="row lozad" style="display: none"
                                    :style="{ display: products.length == 0 ? '' : 'none' }">
                                    <h4 class="text-danger d-flex justify-content-center" style="font-size: 30px">No Product
                                        Found!</h4>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-xl-3 order-1 order-lg-0 d-none d-md-block">
                        <!--== Start Sidebar Area Wrapper ==-->
                        <div class="sidebar-area mt-10 mt-lg-0 accordion" id="accordionExample">
                            <form action="" id="filter-form">
                                <div class="widget-item widget-item-one ">

                                    <h4 class="accordion-header" id="headingTwo4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo4" aria-expanded="false"
                                            aria-controls="collapseTwo4">
                                            Movement
                                        </button>
                                    </h4>

                                    <div id="collapseTwo4" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo4" data-bs-parent="#accordionExample">
                                        <div class="accordion-body side_area">
                                            <div class="form-group" v-for="(movement, ml) in movements">
                                                <input class="form-check-input check-input sort-form"
                                                    :id="`ml-${ml}`" :value="movement.id"
                                                    v-model="selectmovements" type="checkbox"
                                                    @@change="getMovementFilters"> <label
                                                    class="form-check-label"
                                                    :for="`ml-${ml}`">@{{ movement.name }}</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="widget-item widget-item-one">

                                    <h4 class="accordion-header" id="headingTwo5">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo5"
                                            aria-expanded="false" aria-controls="collapseTwo5">
                                            Case Size
                                        </button>
                                    </h4>

                                    <div id="collapseTwo5" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo5" data-bs-parent="#accordionExample">
                                        <div class="accordion-body side_area">
                                            <div class="form-group" v-for="(csize, csl) in caseSize">
                                                <input class="form-check-input check-input sort-form"
                                                    :id="`csl-${csl}`" :value="csize.id"
                                                    v-model="selectCaseSize" type="checkbox"
                                                    @@change="getcaseSizeFilters"> <label
                                                    class="form-check-label"
                                                    :for="`csl-${csl}`">@{{ csize.name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="widget-item widget-item-one ">
                                    <h4 class="accordion-header" id="headingTwo3">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo3"
                                            aria-expanded="false" aria-controls="collapseTwo3">
                                            Dial Color
                                        </button>
                                    </h4>

                                    <div id="collapseTwo3" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo3" data-bs-parent="#accordionExample">
                                        <div class="accordion-body side_area">
                                            <div class="form-group" v-for="(dcolor, cl) in dialColor">
                                                <input class="form-check-input check-input sort-form"
                                                    :id="`cl-${cl}`" :value="dcolor.id"
                                                    v-model="selectdialColor" type="checkbox"
                                                    @@change="getColorFilters"> <label
                                                    class="form-check-label"
                                                    :for="`cl-${cl}`">@{{ dcolor.name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="widget-item widget-item-one">
                                    <h4 class="accordion-header" id="headingTwo2">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo2"
                                            aria-expanded="false" aria-controls="collapseTwo2">
                                            Band Material
                                        </button>
                                    </h4>

                                    <div id="collapseTwo2" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo2" data-bs-parent="#accordionExample">
                                        <div class="accordion-body side_area">
                                            <div class="form-group" v-for="(bmaterial, sl) in brandMaterials">
                                                <input class="form-check-input check-input sort-form"
                                                    :id="`bm-${sl}`" :value="bmaterial.id"
                                                    v-model="selectedMaterial" type="checkbox"
                                                    @@change="getBrandMaterialsFilters">
                                                <label class="form-check-label"
                                                    :for="`bm-${sl}`">@{{ bmaterial.name }}</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="widget-item widget-item-one">
                                    <h4 class="accordion-header" id="headingTwo1">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo1"
                                            aria-expanded="false" aria-controls="collapseTwo1">
                                            Series
                                        </button>
                                    </h4>

                                    <div id="collapseTwo1" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo1" data-bs-parent="#accordionExample">

                                        <div class="accordion-body side_area">
                                            <div class="form-group " v-for="(ser, ind) in series">
                                                <input class="form-check-input check-input sort-form"
                                                    v-bind:value="ser.id" :id="`s-${ind}`" type="checkbox"
                                                    v-model="selectedSeries"
                                                    @@change="getProductSeriesFilters">
                                                <label :for="`s-${ind}`"
                                                    class="form-check-label">@{{ ser.name }}</label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="widget-item widget-item-one">
                                <h4 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Brand
                                    </button>
                                </h4>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
        <div class="offcanvas offcanvas-start product_items_filter" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Side Manu</h5>
                <button type="button" class="btn-close text-reset " data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <div class="sidebar-area accordion" id="accordionExample">
                    <div class="widget-item widget-item-one ">

                        <h4 class="accordion-header" id="headingTwo4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4">
                                Movements
                            </button>
                        </h4>

                        <div id="collapseTwo4" class="accordion-collapse collapse" aria-labelledby="headingTwo4"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body side_area">
                                <div class="form-group" v-for="(movement, ml) in movements">
                                    <input class="form-check-input check-input sort-form" :id="`ml-${ml}`"
                                        :value="movement.id" v-model="selectmovements" type="checkbox"
                                        @@change="getMovementFilters"> <label class="form-check-label"
                                        :for="`ml-${ml}`">@{{ movement.name }}</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="widget-item widget-item-one">

                        <h4 class="accordion-header" id="headingTwo5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5">
                                Case Size
                            </button>
                        </h4>

                        <div id="collapseTwo5" class="accordion-collapse collapse" aria-labelledby="headingTwo5"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body side_area">
                                <div class="form-group" v-for="(csize, csl) in caseSize">
                                    <input class="form-check-input check-input sort-form" :id="`csl-${csl}`"
                                        :value="csize.id" v-model="selectCaseSize" type="checkbox"
                                        @@change="getcaseSizeFilters"> <label class="form-check-label"
                                        :for="`csl-${csl}`">@{{ csize.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-item widget-item-one ">
                        <h4 class="accordion-header" id="headingTwo3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo3" aria-expanded="false" aria-controls="collapseTwo3">
                                Dial Color
                            </button>
                        </h4>

                        <div id="collapseTwo3" class="accordion-collapse collapse" aria-labelledby="headingTwo3"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body side_area">
                                <div class="form-group" v-for="(dcolor, cl) in dialColor">
                                    <input class="form-check-input check-input sort-form" :id="`cl-${cl}`"
                                        :value="dcolor.id" v-model="selectdialColor" type="checkbox"
                                        @@change="getColorFilters"> <label class="form-check-label"
                                        :for="`cl-${cl}`">@{{ dcolor.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-item widget-item-one">

                        <h4 class="accordion-header" id="headingTwo2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                Band Material
                            </button>
                        </h4>

                        <div id="collapseTwo2" class="accordion-collapse collapse" aria-labelledby="headingTwo2"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body side_area">
                                <div class="form-group" v-for="(bmaterial, sl) in brandMaterials">
                                    <input class="form-check-input check-input sort-form" :id="`bm-${sl}`"
                                        :value="bmaterial.id" v-model="selectedMaterial" type="checkbox"
                                        @@change="getBrandMaterialsFilters"> <label
                                        class="form-check-label" :for="`bm-${sl}`">@{{ bmaterial.name }}</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="widget-item widget-item-one ">

                        <h4 class="accordion-header" id="headingTwo1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                                Series
                            </button>
                        </h4>

                        <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body side_area">
                                <div class="form-group" v-for="(ser, ind) in series">
                                    <input class="form-check-input check-input sort-form" v-bind:value="ser.id"
                                        :id="`s-${ind}`" type="checkbox" v-model="selectedSeries"
                                        @@change="getProductSeriesFilters">
                                    <label :for="`s-${ind}`" class="form-check-label">@{{ ser.name }}</label>
                                </div>
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
    </main>
@endsection

@push('web_script')
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/vue-select.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>


    <script>
        const app = new Vue({
            el: '#productFilters',
            data: {
                brands: [],
                series: [],
                selectedSeries: [],
                products: [],
                brandMaterials: [],
                selectedMaterial: [],
                dialColor: [],
                selectdialColor: [],
                movements: [],
                selectmovements: [],
                caseSize: [],
                selectCaseSize: [],
                baseUrl: location.origin,
                brandId: "{{ $brandId }}",
                categoryId: "{{ $categoryId }}",
                sortBy: "",
                proImage: ''
            },
            watch: {

            },
            filters: {
                decimal(value) {
                    const amt = Number(value);
                    return amt && amt.toLocaleString(undefined, {
                        useGrouping: true,
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) || '0';
                }
            },
            created() {
                this.getSeries();
                this.getProducts();
                this.getBrandMaterials();
                this.getDialColors();
                this.getMovements();
                this.getCasesize();
            },
            methods: {
                getProducts() {
                    axios.post('/get-products', {
                            brandId: this.brandId,
                            catId: this.categoryId
                        })
                        .then(res => {
                            this.products = res.data;
                            this.proImage = '/uploads/product/thumbnail/' + res.data[0].image;
                            console.log(this.proImage);
                        })
                },
                getBrands() {
                    axios.get('/get-brands')
                        .then(res => {
                            this.brands = res.data;
                        })
                },
                getSeries() {
                    axios.post('/get-series', {
                            brandId: this.brandId,
                            categoryId: this.categoryId
                        })
                        .then(res => {
                            this.series = res.data;
                        })
                },
                getBrandMaterials() {
                    axios.post('/get-brand-materials', {
                            brandId: this.brandId,
                            categoryId: this.categoryId
                        })
                        .then(res => {
                            this.brandMaterials = res.data;
                        })
                },
                getDialColors() {
                    axios.post('/get-dial-colors', {
                            brandId: this.brandId,
                            categoryId: this.categoryId
                        })
                        .then(res => {
                            this.dialColor = res.data;
                        })
                },
                getMovements() {
                    axios.post('/get-movements', {
                            brandId: this.brandId,
                            categoryId: this.categoryId
                        })
                        .then(res => {
                            this.movements = res.data;
                        })
                },
                getCasesize() {
                    axios.post('/get-case-size', {
                            brandId: this.brandId,
                            categoryId: this.categoryId
                        })
                        .then(res => {
                            this.caseSize = res.data;
                        })
                },
                getProductFilters() {
                    axios.post('/get-filter-products', {
                            brandId: this.brandId,
                            catId: this.categoryId,
                            series: this.selectedSeries,
                            brandMaterial: this.selectedMaterial,
                            dialColor: this.selectdialColor,
                            movement: this.selectmovements,
                            caseSize: this.selectCaseSize,
                            sortBy: this.sortBy
                        })
                        .then(res => {
                            this.products = res.data;
                        })
                },
                getProductSeriesFilters() {
                    this.selectedMaterial = [];
                    this.selectCaseSize = [];
                    this.selectmovements = [];
                    this.selectdialColor = [];
                    axios.post('/get-filter-products', {
                            brandId: this.brandId,
                            catId: this.categoryId,
                            series: this.selectedSeries,
                            sortBy: this.sortBy
                        })
                        .then(res => {
                            this.products = res.data;
                        })
                },
                getBrandMaterialsFilters() {
                    this.selectedSeries = [];
                    this.selectCaseSize = [];
                    this.selectmovements = [];
                    this.selectdialColor = [];
                    axios.post('/get-filter-products', {
                            brandId: this.brandId,
                            catId: this.categoryId,
                            brandMaterial: this.selectedMaterial,
                            sortBy: this.sortBy
                        })
                        .then(res => {
                            this.products = res.data;
                        })
                },
                getMovementFilters() {
                    this.selectedSeries = [];
                    this.selectCaseSize = [];
                    this.selectdialColor = [];
                    this.selectedMaterial = [];
                    axios.post('/get-filter-products', {
                            brandId: this.brandId,
                            catId: this.categoryId,
                            movement: this.selectmovements,
                            sortBy: this.sortBy
                        })
                        .then(res => {
                            this.products = res.data;
                        })
                },
                getColorFilters() {
                    this.selectedSeries = [];
                    this.selectCaseSize = [];
                    this.selectedMaterial = [];
                    this.selectmovements = [];
                    axios.post('/get-filter-products', {
                            brandId: this.brandId,
                            catId: this.categoryId,
                            dialColor: this.selectdialColor,
                            sortBy: this.sortBy
                        })
                        .then(res => {
                            this.products = res.data;
                        })
                },
                getcaseSizeFilters() {
                    this.selectedSeries = [];
                    this.selectedMaterial = [];
                    this.selectmovements = [];
                    this.selectdialColor = [];
                    axios.post('/get-filter-products', {
                            brandId: this.brandId,
                            catId: this.categoryId,
                            caseSize: this.selectCaseSize,
                            sortBy: this.sortBy
                        })
                        .then(res => {
                            this.products = res.data;
                        })
                },
            }
        })
    </script>

    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'vertical',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    </script>
@endpush
