<header class="header-wrapper">
    <div class="header-top d-none d-md-block">
        <div class="container">
            <div class="header-top-area">
                <div class="header-top-info">
                    <ul>
                        <li class="me-2"> <strong>Email :</strong> <a
                                href="mailto:{{ $content->email }}">{{ $content->email }}</a></li>
                        <li> <strong>Phone :</strong> <a
                                href="tel:{{ $content->phone_one }}">{{ $content->phone_one }}</a></li>
                </div>
                <div class="top-link-item ">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#trackModal"><i class="fa fa-search"
                            aria-hidden="true"></i> Track My Order</a>
                </div>
                <div class="header-top-action-area">
                    <ul>
                        <li class="facebook"><a href="{{ $content->facebook }}" target="_blank"> <i
                                    class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        <li class="instagram"> <a href="{{ $content->instagram }}" target="_blank"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li class="youtube"> <a href="{{ $content->youtube }}" target="_blank"><i
                                    class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        <li class="whatsapp"> <a href="{{ $content->whatsapp }}" target="_blank"><i
                                    class="fa fa-whatsapp"></i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <div class="header-top d-block d-md-none">
        <div class="container">
            <div class="header-top-area">

                <div class="top-link-item ">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#trackModal"><i class="fa fa-search"
                            aria-hidden="true"></i> Track My Order</a>
                </div>
                <div class="header-top-action-area">
                    <ul>
                        <li class="facebook"><a href="{{ $content->facebook }}" target="_blank"> <i
                                    class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        <li class="instagram"> <a href="{{ $content->instagram }}" target="_blank"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li class="youtube"> <a href="{{ $content->youtube }}" target="_blank"><i
                                    class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        <li class="whatsapp"> <a href="{{ $content->whatsapp }}" target="_blank"><i
                                    class="fa fa-whatsapp"></i></a></li>
                    </ul>

                </div>

            </div>
            <div class="header-top-info">
                <ul>
                    <li class=""> <strong><i class="fa fa-envelope" aria-hidden="true"></i> </strong> <a
                            href="mailto:{{ $content->email }}">{{ $content->email }}</a></li>
                    <li class="float-end"> <strong><i class="fa fa-phone-square" aria-hidden="true"></i> </strong> <a
                            href="tel:{{ $content->phone_one }}">{{ $content->phone_one }}</a></li>
            </div>
        </div>
    </div>
    <div class="header-middle">
        <div class="container">
            <div class="row  justify-content-between align-items-center">
                <div class="col-auto d-flex align-items-center">
                    <div class="header-logo-area">
                        <a href="{{ route('home') }}">
                            <img class="logo-main" src="{{ asset($content->logo) }}" height="31" alt="Logo" />

                        </a>
                    </div>
                    <div class="head-name ms-2">
                        <a href="{{ route('home') }}">
                            <h2 style="color: #015b9f; margin-bottom:0px">{{ $content->com_name }}</h2>
                            <p>Search Your Time</p>
                        </a>
                    </div>
                </div>

                <div class="col-auto d-flex justify-content-end align-items-center">
                    <div class="product_scr d-none d-lg-block">
                        <form action="{{ route('search.product') }}" method="GET" class="header-search-box">
                            <input name="search" id="search" type="text" onfocus="showSearchResult()"
                                onblur="hideSearchResult()"
                                class="form-control serach-control search-box search-input input-empty"
                                placeholder="Search for products" autocomplete="off" />
                            <button type="submit" class="btn-src search-button">
                                <i class="icon-magnifier"></i>
                            </button>
                        </form>
                        <div class="suggestProduct"></div>
                    </div>

                    <div class="header-top-action-area me-2">
                        <div class="header-info-dropdown">
                            @if (Auth::guard('customer')->user())
                                <button type="button" class="btn-info dropdown-toggle d-none d-lg-block"
                                    id="dropdownLang" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::guard('customer')->user()->name }} </button>
                                <button type="button" class="btn-info dropdown-toggle d-block d-lg-none"
                                    id="dropdownLang" data-bs-toggle="dropdown" aria-expanded="false"> <i
                                        class="icon icon-user"></i> </button>
                            @else
                                <button type="button" class="btn-info dropdown-toggle" id="dropdownLang"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                        class="icon icon-user"></i></button>
                            @endif
                            <ul class="dropdown-menu" aria-labelledby="dropdownLang">
                                @if (Auth::guard('customer')->user())
                                    <li class="dropdown-item active"><a href="{{ route('customer.dashboard') }}">My
                                            Account</a></li>
                                    <li class="dropdown-item active"><a
                                            href="{{ route('customer.logout') }}">Logout</a></li>
                                @else
                                    <li class="dropdown-item"><a
                                            href="{{ route('customer.register') }}">Login/SignUp</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <button class="header-action-cart" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithCartSidebar" aria-controls="offcanvasWithCartSidebar">
                        <i class="cart-icon icon-handbag"></i>
                        <span class="cart-count minicart-qty" id="cartQty"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle-search bg-white sticky">
        <div class="container">
            <div class="row align-items-center justify-content-between align-items-center">

                <div class="col-auto">
                    <button class="btn-menu d-lg-none" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="col-auto">
                    <div class="product_scr d-block d-lg-none">
                        <form action="{{ route('search.product') }}" method="GET" class="header-search-box ">
                            <input name="search" id="search" type="text" onfocus="showSearchResult()"
                                onblur="hideSearchResult()"
                                class="form-control serach-control search-box search-input input-empty"
                                placeholder="Search for products" autocomplete="off" />
                            <button type="submit" class="btn-src search-button">
                                <i class="icon-magnifier"></i>
                            </button>
                        </form>
                        <div class="suggestProduct"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="header-two-area d-none d-lg-block sticky">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <div class="vertical-menu">
                        <button class="vmenu-btn">
                            <i class="icon fa fa-list-ul"></i> All Brands
                            <i class="icon fa fa-angle-down"></i>
                        </button>
                        @php
                            $brand = App\Models\Brand::orderBy('name', 'asc')->get();
                        @endphp
                        <ul class="vmenu-content vmenu-content-none" style="display: none; overflow-y:scroll;">
                            @foreach ($brand as $item)
                                <li class="vmenu-item">
                                    <a href="{{ route('product.brand', $item->slug) }}">
                                        {{ $item->name }}</a>

                                </li>
                            @endforeach
                        </ul>
                        <!-- menu content -->
                    </div>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <div class="header-navigation header-navigation-light ">
                        <ul class="main-nav">

                            @php
                                $categories = App\Models\Category::where('is_homepage', 1)
                                    ->take(7)
                                    ->get();
                            @endphp

                            @foreach ($categories as $category)
                                <li class="main-nav-item has-submenu position-static">
                                    @php
                                        $catb = $category->brandChild;
                                        $caterorisBrad = App\Models\Brand::whereIn('id', explode(',', $catb))->get();
                                    @endphp


                                    <a class="main-nav-link"
                                        href="{{ route('product.cat', $category->slug) }}">{{ $category->name }}
                                        @if (count($caterorisBrad) > 0)
                                            <i class="icon fa fa-angle-down"></i>
                                        @endif
                                    </a>
                                    <ul class="submenu-nav-mega">
                                        @foreach ($caterorisBrad->chunk(10) as $item)
                                            <li class="submenu-nav-mega-item">
                                                <ul>
                                                    @foreach ($item as $brand)
                                                        <li>
                                                            <a class="submenu-nav-mega-link"
                                                                href="{{ route('product.category', ['category' => $category->slug, 'brand' => $brand->slug]) }}">{{ $brand->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            <li class="main-nav-item has-submenu position-static">
                                <a class="main-nav-link" href="{{ route('sale') }}">Sale </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="header-action">
                        <div class="phone-item-action">
                            <div class="phone-item-icon">
                                <img src="{{ asset('website/images/icons/phone2.png') }}" alt="Icon"
                                    width="32" height="36" />
                            </div>
                            <div class="phone-item-content">
                                <span class="text-black">Call Us 24/7</span>
                                <a href="tel:{{ $content->phone_one }}">{{ $content->phone_one }}</a>
                            </div>
                        </div>
                        <button class="btn-search-menu d-md-none" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch">
                            <span class="search-icon">
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.5 11H11.71L11.43 10.73C12.41 9.59 13 8.11 13 6.5C13 2.91 10.09 0 6.5 0C2.91 0 0 2.91 0 6.5C0 10.09 2.91 13 6.5 13C8.11 13 9.59 12.41 10.73 11.43L11 11.71V12.5L16 17.49L17.49 16L12.5 11ZM6.5 11C4.01 11 2 8.99 2 6.5C2 4.01 4.01 2 6.5 2C8.99 2 11 4.01 11 6.5C11 8.99 8.99 11 6.5 11Z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@push('web_script')
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    </script>
    <script>
        $("body").on("keyup", "#search", function() {
            let searchData = $(this).val();
            if (searchData.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('/product/get') }}",
                    data: {
                        search: searchData

                    },
                    success: function(result) {
                        let ulData = "";
                        if (result.length > 0) {
                            $.each(result, (index, value) => {
                                ulData +=
                                    `<li > <a href='/product/single/${value.slug}'> ${value.name} </a></li>`;
                            })
                        } else {
                            ulData += "<li>No Found Data</li>";
                        }
                        $(".suggestProduct").html(`<ul>${ulData}</ul>`);
                    }
                });
            }
            if (searchData.length < 1) $('.suggestProduct').html("");
        })
    </script>

    <script>
        function showSearchResult() {
            $('.suggestProduct').slideDown();
        }

        function hideSearchResult() {
            $('.suggestProduct').slideUp();
        }
    </script>
@endpush
