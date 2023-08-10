@extends('layouts.web_master')
@section('title', 'Product Cart Page')
@section('website-content')


    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            {{-- <h2 class="page-header-title">Cart</h2> --}}
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home //</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Product Cart Area Wrapper ==-->

        {{-- @if (count($cartPage) > 0) --}}
        <div class="product-area py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table-wrap d-none d-lg-block">
                            <div class="table-responsive">
                                <table class="cart-table">
                                    <thead>
                                        <tr>
                                            <th class="width-thumbnail">Image</th>
                                            <th class="width-name text-center">Product</th>
                                            <th class="width-price text-center"> Price</th>
                                            <th class="width-quantity text-center">Quantity</th>
                                            <th class="width-subtotal text-center">Subtotal</th>
                                            <th class="width-remove text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="cartPage">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- mobile view --}}
                        <div class="cart-table-wrap d-block d-lg-none" id="cartPageM">

                        </div>
                        {{-- mobile view --}}
                        <div class="cart-shiping-update-wrapper">
                            <div class="cart-shiping-btn continure-btn">
                                <a class="btn btn-link" href="{{ route('home') }}"><i class="fa fa-angle-left"></i> Continue
                                    Shopping</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-4 ms-auto">
                        <div class="grand-total-wrap mt-10 mt-lg-0">
                            <div class="grand-total-content">
                                <h5>Subtotal <span id="cartSubTotal"></span></h5>
                                <div class="grand-total">
                                    <h4>Total <span id="cartSubTotal"> </span></h4>
                                </div>
                            </div>
                            <div class="grand-total-btn">
                                <a class="btn btn-link" href="{{ route('product.checkout') }}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endif --}}
        {{-- <div class="product-area py-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                           <h4 class="text-danger">Your cart is currently empty.</h4>
                    </div>
                    <div class="cart-shiping-update-wrapper">
                        <div class="cart-shiping-btn continure-btn">
                            <a class="btn btn-link" href="{{ route('home') }}"><i class="fa fa-angle-left"></i> Continue
                                Shopping</a>
                        </div>

                    </div>
                </div>


            </div>
        </div> --}}

        <!--== End Product Cart Area Wrapper ==-->

    </main>

@endsection
@push('web_script')
@endpush
