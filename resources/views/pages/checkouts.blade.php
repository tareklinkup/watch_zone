@extends('layouts.web_master')
@section('title', 'Product Cart Page')
<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #f9f9f9 !important;
        opacity: 1;
        border: none;
    }

    /* .form-control[readonly] {
        background-color: #fff;
        opacity: 1;
        border: none;
    } */
</style>
@section('website-content')
    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            {{-- <h2 class="page-header-title">Checkout</h2> --}}
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home //</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Checkout
                                </li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Checkout Area Wrapper ==-->
        <div class="section-space shop-checkout-area">
            <div class="container">



                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <input type="text" name="order_total" value="{{ $cartTotal }}" style="display: none;">

                    @if (count($carts) > 0)
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="billing-info-wrap">
                                    <h3>Billing Address</h3>
                                    <div class="row">
                                        <div class="col-6 col-md-6">
                                            <div class="billing-info mb-1">
                                                <label> Name <small class="text-danger" title="required">*</small></label>
                                                <input type="text" name="name"
                                                    value="{{ Auth::guard('customer')->user()->name }}" />
                                                @error('name')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-6">
                                            <div class="billing-info mb-1">
                                                <label>Phone<small class="text-danger" title="required">*</small></label>
                                                <input type="text" name="phone"
                                                    value="{{ Auth::guard('customer')->user()->phone }}" />
                                                @error('phone')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="billing-info mb-1">
                                                <label>Email Address </label>
                                                <input type="email" name="email"
                                                    value="{{ Auth::guard('customer')->user()->email }}" />
                                                @error('email')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="billing-select mb-4">
                                                <label>Shipping Area <small class="text-danger"
                                                        title="required">*</small></label>
                                                <div class="select-style">
                                                    <select class="select-active @error('area') is-invalid @enderror"
                                                        id="area" required name="area">
                                                        <option>Select an option…</option>
                                                        <option value="80" selected>Inside Dhaka</option>
                                                        <option value="150">Outside Dhaka</option>
                                                    </select>
                                                    @error('area')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12">
                                            <div class="billing-select mb-1">
                                                <label>District/City
                                                    <small class="text-danger" title="required">*</small> </label>
                                                <div class="select-style">
                                                    <select
                                                        class="select2 select-active @error('district') is-invalid @enderror"
                                                        id="district" name="district" required>
                                                        <option>Select an option…</option>
                                                        @foreach ($district as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('district')
                                                        <span style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12">
                                            <div class="additional-info-wrap">
                                                <label> Address <small class="text-danger" title="required">*</small>
                                                </label>
                                                <textarea placeholder="Address..." name="address" class=" @error('address') is-invalid @enderror">{{ Auth::guard('customer')->user()->address }}</textarea>
                                                @error('address')
                                                    <span style="color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="checkout-account">
                                        <input class="checkout-toggle" type="checkbox" />
                                        <span>Ship to a different address?</span>
                                    </div>
                                    <div class="different-address open-toggle mt-30">
                                        <h3>Shipping Address</h3>
                                        <div class="row">
                                            <div class="col-6 col-md-6">
                                                <div class="billing-info mb-1">
                                                    <label> Name <small class="text-danger"
                                                            title="required">*</small></label>
                                                    <input type="text" name="b_name" />
                                                </div>
                                            </div>

                                            <div class="col-6 col-md-6">
                                                <div class="billing-info mb-1">
                                                    <label>Phone <small class="text-danger"
                                                            title="required">*</small></label>
                                                    <input type="number" name="b_phone" />
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-6">
                                                <div class="billing-info mb-1">
                                                    <label>Email </label>
                                                    <input type="text" name="b_email" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="billing-select mb-4">
                                                    <label>Shipping Area <small class="text-danger"
                                                            title="required">*</small></label>
                                                    <div class="select-style">
                                                        <select class="select-active" name="b_district" id="b_district"
                                                            required>
                                                            <option>Select an option…</option>
                                                            <option value="80">Inside Dhaka</option>
                                                            <option value="150">Outside Dhaka</option>
                                                        </select>
                                                        @error('email')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 col-md-12">
                                                <div class="billing-select mb-1">
                                                    <label>District/City <small class="text-danger"
                                                            title="required">*</small></label>
                                                    <div class="select-style">
                                                        <select class="select2 select-active" id="b_district"
                                                            name="b_district">
                                                            <option>Select an option…</option>
                                                            @foreach ($B_district as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('b_district')
                                                            <span style="color: red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="additional-info-wrap">
                                                    <label> Address <small class="text-danger"
                                                            title="required">*</small></label>
                                                    <textarea placeholder="Address..." name="b_address" class=""></textarea>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="your-order-area mt-10 mt-lg-0">
                                    <h4>Your order</h4>
                                    <div class="your-order-wrap">
                                        <div class="your-order-info-wrap">
                                            <div class="your-order-title">
                                                <h6>Items </h6>
                                            </div>

                                            <div class="your-order-product">
                                                <ul>
                                                    @foreach ($carts as $cart)
                                                        <li class="border-bottom">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <img src="{{ asset('uploads/product/' . $cart->options->image) }}"
                                                                        width="50" height="40" alt="">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p style="font-size: 14px">{{ $cart->name }}</p>
                                                                </div>
                                                                <div class="col-lg-2"> {{ $cart->qty }} ×</div>
                                                                <div class="col-lg-2"><span>৳
                                                                        {{ number_format($cart->subtotal, 2) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <div class="your-order-subtotal">
                                                <h3>Subtotal <span>{{ number_format($cartTotal, 2) }}</span></h3>
                                                <input style="display: none;" type="text"
                                                    class="form-control shadow-none" id="SubAmount"
                                                    value="{{ $cartTotal }}">
                                            </div>

                                            <div class="your-order-subtotal">
                                                <h3>Shipping Charge <span id="ShipCharge"></span></h3>
                                                <input type="hidden" class="form-control shadow-none text-end p-0"
                                                    name="ship_charge" id="shipcharge">
                                            </div>

                                            <div class="your-order-subtotal showDiv">
                                                <h3>Couppon Discount (-) <span id="couponDiscountv"></span></h3>
                                                <input type="text" style="display: none;"
                                                    class="form-control shadow-none text-end p-0" name="couponDiscount"
                                                    id="couponDiscount">
                                            </div>

                                            <div class="your-order-total">
                                                <h3><strong>Grand Total</strong> <span id="totalAmount">৳ </span></h3>
                                                <input type="text" name="total_amount" style="display: none;"
                                                    class="form-control shadow-none text-end p-0" id="total_amount">
                                            </div>

                                            <div class="your-order-subtotal">
                                                <h3>Payment Type <span>
                                                        <div class="clearfix">
                                                            <input id="payment_type" name="payment_type"
                                                                value="Cash on Delivery" type="radio" checked>
                                                            <label for="formcheckoutRadio4">Cash on Delivery</label>
                                                            @error('payment_type')
                                                                <span style="color: red">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </span></h3>
                                            </div>
                                            <div class="card my-2">

                                                <div class="card-body">
                                                    <div class="form-group"> <label>Have coupon?</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control shadow-none"
                                                                id="coupon_name" placeholder="Coupon code">
                                                            <span class="input-group-append">
                                                                <input type="button" id="couponBtn"
                                                                    class="btn check-out-btn shadow-none" value="Apply">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    @auth('customer')
                                        <div class="place-order">
                                            <button type="submit" class="btn btn--lg w-100">Place Order</button>
                                        </div>
                                    @endauth
                                    @guest('customer')
                                        <div class="place-order">
                                            <a href="{{ route('customer.login.process') }}">Place Order</a>
                                        </div>
                                        <a href="{{ route('customer.login.process') }}" class="btn btn--lg w-100">Place
                                            Order</a>
                                    @endguest

                                </div>

                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h4 class="text-danger">Product add to cart First</h4>
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-btn continure-btn">
                                        <a class="btn btn-link" href="{{ route('home') }}"><i
                                                class="fa fa-angle-left"></i> Continue
                                            Shopping</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>

    </main>
@endsection

@push('web_script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $(document).ready(function() {
            $('.showDiv').hide();

            $('#area').on('change', function() {
                var data = $(this).val();
                $('#ShipCharge').text("");
                $('#totalAmount').text("");

                if (data) {
                    // console.log(data);
                    $('#ShipCharge').append(data);
                    $('#shipcharge').val(data);

                    var subtotal = $('#SubAmount').val();
                    var charge = data;
                    var total = parseFloat(+subtotal + +charge).toFixed(2);
                    $('#totalAmount').append(total)
                    $('#total_amount').val(total)

                    $('.showDiv').hide();
                } else {
                    alert('danger');
                }

            });


        });

        $(document).ready(function() {
            $('.showDiv').hide();

            $('#b_district').on('change', function() {
                var data = $(this).val();
                $('#ShipCharge').text("");
                $('#totalAmount').text("");

                if (data) {
                    // console.log(data);
                    $('#ShipCharge').append(data);
                    $('#shipcharge').val(data);

                    var subtotal = $('#SubAmount').val();
                    var charge = data;
                    var total = parseFloat(+subtotal + +charge).toFixed(2);
                    $('#totalAmount').append(total)
                    $('#total_amount').val(total)

                    $('.showDiv').hide();
                } else {
                    alert('danger');
                }
            });


        });

        // Coupon Discount
        $("#couponBtn").click(function(event) {
            event.preventDefault();
            var coupon_name = $("#coupon_name").val();

            $.ajax({
                url: "{{ url('/coupon-apply') }}",
                method: 'POST',
                data: {
                    coupon_name: coupon_name
                },
                beforeSend: () => {
                    $('#couponDiscountv').text("");
                    $('#totalAmount').text("")
                },
                success: function(res) {
                    if (res.success.trim() == 'success') {
                        let cartSubTotal = $('#SubAmount').val()
                        let couponDiscount = (+cartSubTotal * +res.coupon_discount / 100).toFixed(2);
                        let shippChar = $('#shipcharge').val();
                        console.log(shippChar);
                        let total = parseFloat(+cartSubTotal + +shippChar) - parseFloat(couponDiscount);
                        $('#total_amount').val(total)
                        $('#totalAmount').append(total)
                        $('#couponName').append(res.coupon_name)
                        $('#couponDiscountv').append(couponDiscount)
                        $('#couponDiscount').val(couponDiscount)
                        $('#coupon_name').val('')

                        $('.showDiv').show();

                    } else if (res.success.trim() == 'e') {

                        //  start message
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        })

                        Toast.fire({
                            type: 'error',
                            title: res.error
                        })
                    }
                }
            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2({})
        })
    </script>
@endpush
