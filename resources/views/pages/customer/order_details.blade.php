@extends('layouts.web_master')
@section('title', 'Details Order')
@section('website-content')


    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        {{-- <div class="page-header-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-content">
                        <h2 class="page-header-title">Checkout</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home //</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start My Account Wrapper ==-->
        <div class="holder">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 aside mt-5">
                        {{-- <h1 class="mb-3 order_submit"><i class="fa fa-check" aria-hidden="true"></i> Your Order has Submitted
                            Successfully.</h1> --}}
                        {{-- <p>Thank you. Your order has been received.</p> --}}

                        <div class="row pb-3 border m-1">
                            <div class="col-lg-2">
                                <div class="feature-item">
                                    <p><strong>Order No :</strong> <span id="markup" class="px-1"
                                            style="font-size: 12px">{{ $order->order_number }}</span></p>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="feature-item">
                                    <p><strong>Date :</strong> {{ $order->order_date }}</p>
                                </div>
                            </div>
                            <div class="col-lg-2 ">
                                <div class="feature-item">
                                    <p> <strong>Email :</strong> {{ $order->email }}</p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="feature-item">
                                    <p> <strong>Total :</strong> {{ number_format($order->total_amount, 2) }} BDT </p>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="feature-item">
                                    <p> <strong>Status :</strong>
                                        @if ($order->status == 'Pending')
                                            Received
                                        @else
                                            {{ $order->status }}
                                        @endif
                                        {{-- {{ $order->status }}</p> --}}
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="feature-item">
                                    <p> <strong>Payment Type :</strong> {{ $order->payment_type }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="customer_profile table-responsive mt-3 col-md-12 aside mb-4">

                                <div class="card d-none d-md-block">
                                    <div class="card-header">
                                        <h3>Order Information</h3>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-hover text-center">
                                            <thead class="tablehead">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($orderItem as $item)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td><img src="{{ asset('uploads/product/' . $item->product->image) }}"
                                                                height="80px;" width="80px;" alt="imga"></td>
                                                        <td>{{ $item->product->name }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ number_format($item->price, 2) }}</td>
                                                        <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="5" style="text-align:right;">
                                                        <strong>Sub Total:</strong>
                                                    </td>
                                                    <td><strong>{{ number_format($order->amount, 2) }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="text-align:right;">
                                                        <strong>Shipping Charge:</strong>
                                                    </td>
                                                    <td><strong>{{ number_format($order->ship_charge, 2) }}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="text-align:right;">
                                                        <strong>Total Amount:</strong>
                                                    </td>
                                                    <td><strong>{{ number_format($order->total_amount, 2) }}</strong></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                {{-- mobile view --}}
                                <div class="card d-block d-md-none">
                                    <div class="card-header">
                                        <h3>Order Information</h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($orderItem as $item)
                                            <div class="row">
                                                <div class="col-12 text-center border-bottom"><img
                                                        src="{{ asset($item->product->image) }}" height="80px;"
                                                        width="80px;" alt="imga"></div>
                                                <div class="col-4"><Strong>Name</Strong></div>
                                                <div class="col-8 text-end"> {{ $item->product->name }}</div>
                                                <div class="col-4"><Strong>Quantity</Strong></div>
                                                <div class="col-8 text-end"> {{ $item->quantity }}</div>
                                                <div class="col-4"><Strong>Price</Strong></div>
                                                <div class="col-8 text-end"> {{ number_format($item->price, 2) }}</div>
                                                <div class="col-4"><Strong>Sub Total</Strong></div>
                                                <div class="col-8 text-end">
                                                    {{ number_format($item->price * $item->quantity, 2) }}</div>
                                            </div>
                                        @endforeach
                                        <div class="row border-bottom">
                                            <div class="col-6"><strong>Shipping Charge:</strong></div>
                                            <div class="col-6 text-end">{{ number_format($order->ship_charge, 2) }}</div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-5"><strong>Total Amount:</strong></div>
                                            <div class="col-7 text-end">{{ number_format($order->total_amount, 2) }}</div>
                                        </div>

                                    </div>
                                </div>

                                {{-- mobile view --}}

                            </div>
                        </div>

                        <div class="row mb-5">
                            @if ($order->b_phone != null)
                                <div class="col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Shipping Information</h3>
                                        </div>
                                        <div class="card-body">
                                            {{ $order->b_name }} </br>
                                            {{ $order->b_phone }}</br>
                                            {{ $order->b_email }}</br>
                                            {{ $order->order_date }}</br>
                                            {{-- {{ $order->b_district }}</br> --}}
                                            {{ $order->b_address }}</br>

                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Billing Information</h3>
                                    </div>
                                    <div class="card-body">
                                        {{ $order->name }} </br>
                                        {{ $order->phone }}</br>
                                        {{ $order->email }}</br>
                                        {{ $order->order_date }}</br>
                                        {{-- {{ $order->district }}</br> --}}
                                        {{ $order->address }}</br>

                                    </div>
                                </div>
                            </div>



                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--== End My Account Wrapper ==-->

    </main>

@endsection

@push('web_script')
    <script>
        function selectElementContents(el) {
            // Copy textarea, pre, div, etc.
            if (document.body.createTextRange) {
                // Internet Explorer
                var textRange = document.body.createTextRange();
                textRange.moveToElementText(el);
                textRange.select();
                textRange.execCommand("Copy");
            } else if (window.getSelection && document.createRange) {
                // Non-Internet Explorer
                var range = document.createRange();
                range.selectNodeContents(el);
                var sel = window.getSelection();
                sel.removeAllRanges();
                sel.addRange(range);
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                alart("Copy" + msg);
                // console.log('Copy command was ' + msg);
            }
        }

        function make_copy_button(el) {
            var copy_btn = document.createElement('input');
            copy_btn.type = "button";
            el.parentNode.insertBefore(copy_btn, el.nextSibling);
            copy_btn.onclick = function() {
                selectElementContents(el);
            };

            if (document.queryCommandSupported("copy") || parseInt(navigator.userAgent.match(/Chrom(e|ium)\/([0-9]+)\./)[
                    2]) >= 42) {
                copy_btn.value = "Copy ";
            }
        }
        make_copy_button(document.getElementById("markup"));
    </script>
@endpush
