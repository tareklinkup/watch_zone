<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title') | {{ $content->com_name }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="@yield('meta_description')" />
    <meta name="keywords" content="@yield('meta_keywords')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($content->logo) }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('website/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/css/plugins/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/css/plugins/simple-line-icons.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}" />
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/css/custom.css') }}" />

    @stack('webcss')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <!--== Wrapper Start ==-->
    <div class="wrapper home-five-wrapper">
        <!--== Start Header Wrapper ==-->
        @include('partials.web_header')
        <!--== End Header Wrapper ==-->

        @yield('website-content')

        <!--== Start Footer Area Wrapper ==-->
        @include('partials.web_footer')
        <!--== End Footer Area Wrapper ==-->

        <!--== Scroll Top Button ==-->
        <div class="scroll-to-top">
            <span class="fa fa-angle-double-up"></span>
        </div>

        <!-- Order Tracking Modal -->
        <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-black" id="exampleModalLabel">Order Tracking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('order.tracking') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="order_number">Order Number</label>
                                <input type="text" name="order_number" class="form-control shadow-none"
                                    id="order_number" aria-describedby="emailHelp" placeholder="Enter Order No"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary shadow-none">Track Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--== Start Sidebar Cart Menu ==-->
        <aside class="sidebar-cart-modal offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1"
            id="offcanvasWithCartSidebar">
            <div class="offcanvas-header">
                <button type="button" class="btn-close cart-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    ×
                </button>
            </div>
            <div class="sidebar-cart-inner offcanvas-body">
                <div class="sidebar-cart-content">
                    <div class="sidebar-cart-all">
                        <div class="cart-header">
                            <h3>Shopping Cart</h3>
                            <div class="close-style-wrap">
                                <span class="close-style close-style-width-1 cart-close"></span>
                            </div>
                        </div>
                        <div class="cart-content cart-content-padding">
                            <ul id="miniCart">


                            </ul>
                            <div class="cart-total">
                                <h4>Subtotal: <span id="cartSubTotal"></span></h4>
                            </div>
                            <div class="cart-checkout-btn">
                                <a class="cart-btn" href="{{ route('product.cart') }}">view cart</a>
                                <a class="checkout-btn" href="{{ route('product.checkout') }}">checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!--== End Sidebar Cart Menu ==-->


        <!--== Start Side Menu ==-->
        <aside class="aside-side-menu-wrapper off-canvas-area offcanvas offcanvas-start" data-bs-scroll="true"
            tabindex="-1" id="offcanvasWithBothOptions">

            <div class="offcanvas-header" data-bs-dismiss="offcanvas">
                <h5>Menu</h5>
                <button type="button" class="btn-close">×</button>
            </div>
            <div class="offcanvas-body">
                <!-- Start Mobile Menu Wrapper -->
                <div class="res-mobile-menu">
                    <nav id="offcanvasNav" class="offcanvas-menu">
                        <ul>
                            @php
                                $categories = App\Models\Category::where('is_homepage', 1)->get();
                            @endphp
                            @foreach ($categories as $category)
                                <li>
                                    <a href="javascript:void(0)">{{ $category->name }}</a>

                                    @php
                                        $catb = $category->brandChild;
                                        $caterorisBrad = App\Models\Brand::whereIn('id', explode(',', $catb))->get();
                                    @endphp

                                    @if ($caterorisBrad->count() > 0)
                                        <ul>
                                            @foreach ($caterorisBrad as $item)
                                                <li>
                                                    <a
                                                        href="{{ route('product.category', ['category' => $category->slug, 'brand' => $item->slug]) }}">{{ $item->name }}</a>

                                                </li>
                                            @endforeach

                                        </ul>
                                    @endif

                                </li>
                            @endforeach
                            <li>
                                <a href="{{ route('sale') }}">Sale</a>

                            </li>


                            <li class="vmenu-menu-item">
                                <a href="javascript:void(0)">All Brands</a>

                                @php
                                    $brand = App\Models\Brand::orderBy('name', 'asc')->get();
                                @endphp
                                <ul class="vmenu-content">
                                    @foreach ($brand as $item)
                                        <li class="vmenu-item">
                                            <a href="{{ route('product.brand', $item->slug) }}">
                                                {{ $item->name }}</a>

                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- End Mobile Menu Wrapper -->
            </div>
        </aside>
        <!--== Start Side Menu ==-->


    </div>
    <!--== Wrapper End ==-->


    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/647d8aed7c7b15544f3f0379/1h256dd2n';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <!-- Vendors JS -->
    <script src="{{ asset('website/js/vendor/modernizr-3.11.7.min.js') }}"></script>
    <script src="{{ asset('website/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('website/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
    <script src="{{ asset('website/js/vendor/bootstrap.bundle.min.js') }}"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('website/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('website/js/plugins/isotope.pkgd.min.js') }}"></script>
    <!-- Custom Main JS -->
    <script src="{{ asset('website/js/bootstrap3-typeahead.min.js') }}"></script>
    <script src="{{ asset('website/js/main.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}" type="text/javascript"></script>
    <script src="{{ asset('website/js/sweetalert2@8.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        function AddToCart(event) {
            var id = event.target.value;
            // return
            if (id) {
                $.ajax({
                    url: "{{ url('/product/cart/store/') }}/" + id,
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

                        } else {
                            Toast.fire({
                                type: 'error',
                                title: data.error
                            })
                        }
                        //  end message
                    }
                });
            }
        }

        function BuyNow(e) {
            let id = e.target.value;
            if (id) {
                $.ajax({
                    url: "{{ url('/product/cart/buying/') }}/" + id,
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
                            window.location.href = '/product/carts';
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: data.error
                            })
                        }
                        //  end message
                    }
                });
            }
        }
    </script>




    <script>
        $(document).ready(function() {
            $(".addcart").on("click", function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        url: "{{ url('/product/cart/store/') }}/" + id,
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

                            } else {
                                Toast.fire({
                                    type: 'error',
                                    title: data.error
                                })
                            }
                            //  end message
                        }
                    });
                } else {

                }

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".buynow").on("click", function() {
                var id = $(this).data('id');
                alert(id);
                if (id) {
                    $.ajax({
                        url: "{{ url('/product/cart/buying/') }}/" + id,
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
                                window.location.href = '/product/carts';
                            } else {
                                Toast.fire({
                                    type: 'error',
                                    title: data.error
                                })
                            }
                            //  end message
                        }
                    });
                } else {

                }

            });
        });
    </script>

    <script>
        // View Mini Cart
        function miniCart() {
            $.ajax({
                url: "/product/mini/cart",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    //console.log(response);
                    let total = parseFloat(response.cartTotal).toFixed(2);

                    $('span[id="cartSubTotal"]').text(total);
                    $('#cartQty').text(response.cartQty);

                    var miniCart = '';
                    $.each(response.carts, function(key, value) {
                        miniCart += `<li class="single-product-cart">
                                    <div class="cart-img">
                                        <a href="shop-single-product.html">
                                            <img src="{{ URL::asset('/uploads/product/${value.options.image}') }}" alt="product Image" height="200" width="200">
                                        </a>
                                    </div>
                                    <div class="cart-title">
                                        <h4>
                                            ${value.name}
                                        </h4>
                                        <span> ${value.qty} × <span class="price"> ${value.price}</span></span>
                                    </div>
                                    <div class="cart-delete">
                                        <a href="javascript::void(0)" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                    </div>
                                </li>
                                `
                    });
                    $('#miniCart').html(miniCart);
                }
            });
        }

        miniCart();


        //Mini Cart Remove Start
        function miniCartRemove(rowId) {
            $.ajax({
                type: "GET",
                url: "/mini/cart/remove/" + rowId,
                dataType: "json",
                success: function(data) {
                    miniCart();
                    //start message
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
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }
    </script>

    <!-- Cart page here -->
    <script>
        function cart() {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-cart-product') }}",
                dataType: "json",
                success: function(response) {
                    var rows = '';
                    if ((response.carts.length != 0)) {
                        $.each(response.carts, function(key, value) {
                            rows += `
                         <tr>
                           <td class="product-thumbnail">
                                 <img src="{{ URL::asset('/uploads/product/${value.options.image}') }}" alt="product image"  width=300">
                                </td>
                                <td class="product-name">
                                    <h5><a href="">${value.name}</a></h5>
                                </td>
                                <td class="product-price text-center"><span class="amount">${value.price}</span></td>
                                <td class="cart_btn text-center">
                                    ${value.qty > 1
                                ? ` <button type="submit" class="" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                                : ` <button type="submit" class="" disabled>-</button>`
                                }

                                <input type="text" value="${value.qty}" min="1" max="100" disabled style="width:35px;text-align:center;height:32px;margin:0 5px;">
                                <button type="submit" id="${value.rowId}" onclick="cartIncrement(this.id)" class="">+</button>
                                </td>

                                <td class="product-total text-center"><span>${value.subtotal}</span></td>
                                <td class="product-remove text-center">
                                    <a href="javascript::void(0)" class="border-0" id="${value.rowId}" onclick="CartRemove(this.id)"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            `
                        });
                    } else {
                        $("#amount").addClass('d-none');
                        rows += `
                         <tr>
                                <td colspan="5" style="text-align:center;">
                                    <h5> Your Cart is Currently Empty ! </h5>
                                </td>
                            </tr>      `
                    }



                    $('#cartPage').html(rows);
                }
            });
        }
        cart();


        function cartM() {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-cart-product') }}",
                dataType: "json",
                success: function(response) {
                    var rows = '';
                    $.each(response.carts, function(key, value) {
                        rows += `<div class="row border m-1">
                                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-3 text-center border-bottom'>
                                            <img src="{{ URL::asset('/uploads/product/${value.options.image}') }}" alt="product image"  width=150">
                                        </div>
                                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-2 border-bottom'>
                                            <div class="row">
                                                <div class="col-4"><strong>Product Name:</strong></div>
                                                <div class="col-8 text-end"><span > ${value.name}</span></div>
                                            </div>
                                        </div>
                                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-2 border-bottom'>
                                            <div class="row">
                                                <div class="col-4"><strong>Price : </strong></div>
                                                <div class="col-8 text-end"><span > ${value.price}</span></div>
                                            </div>
                                        </div>
                                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-2 border-bottom'>
                                            <div class="row">
                                                <div class="col-4"><strong>Qty : </strong>  </div>
                                                <div class="col-8 text-end">
                                                    ${value.qty > 1
                                                ? ` <button type="submit" class="mcartbtn" id="${value.rowId}" onclick="cartDecrementM(this.id)">-</button>`
                                                : ` <button type="submit" class="mcartbtn" disabled>-</button>`
                                                }

                                                <input type="text" value="${value.qty}" min="1" max="100" disabled style="width:30px;text-align:center;height:25px;margin:0 3px;">
                                                <button type="submit" id="${value.rowId}" onclick="cartIncrementM(this.id)" class="mcartbtn">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-2 border-bottom'>
                                            <div class="row">
                                                <div class="col-4"><strong>Sub Total : </strong></div>
                                                <div class="col-8 text-end"><span > ${value.subtotal}</span></div>
                                            </div>

                                        </div>
                                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-1'>
                                            <div class="row">
                                                <div class="col-4"><strong>Action : </strong></div>
                                                <div class="col-8 text-end"> <a href="javascript::void(0)" class="border-0" id="${value.rowId}" onclick="CartRemoveM(this.id)"><i class="fa fa-trash-o"></i></a></div>
                                            </div>

                                        </div>
                                </div>
                                `
                    });

                    $('#cartPageM').html(rows);
                }
            });
        }
        cartM();





        function CartRemove(id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/cart-remove/') }}/" + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }


        function CartRemoveM(id) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/cart-remove/') }}/" + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                    //  start message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    //  end message
                }
            });
        }

        //Cart Increment
        // function cartIncrement(rowId) {
        //     $.ajax({
        //         type: 'GET',
        //         url: "{{ url('/cart-increment/') }}/" + rowId,
        //         dataType: 'json',
        //         success: function(data) {
        //             cart();
        //             miniCart();
        //         }
        //     });
        // }

        //Cart Decrement
        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/cart-decrement/') }}/" + rowId,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                }
            });
        }

        //Cart Increment
        function cartIncrementM(rowId) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/cart-increment/') }}/" + rowId,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                }
            });
        }

        //Cart Decrement
        function cartDecrementM(rowId) {
            $.ajax({
                type: 'GET',
                url: "{{ url('/cart-decrement/') }}/" + rowId,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                }
            });
        }
    </script>



    @stack('web_script')
</body>

</html>
