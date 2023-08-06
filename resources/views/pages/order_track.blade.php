@extends('layouts.web_master')
@section('title', 'Tracking Order')
@section('website-content')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #59b210
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #59b210;
            color: #fff
        }

        /* cancel area start */
        .track .cancel {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .cancel.done:before {
            background: #EA323D;
        }

        .track .cancel::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .cancel.done .icon {
            background: #EA323D;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd;

        }

        .track .cancel.done .text {
            font-weight: 400;
            color: #000
        }

        /* end cancel area  */

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd;

        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #59b210;
            border-color: #59b210;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #59b210;
            border-color: #59b210;
            border-radius: 1px
        }

        .qty {
            background: #59b210;
        }

        .mt {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .empty {
            padding: 20px;
        }
    </style>

    <!-- Banner section here -->
    <section class="banner_sec">
        <div class="container">
            <div class="row">
                <div class="banner_title d-flex py-2">
                    <p class="text-black m-0 p-0"><a href="{{ route('home') }}">Home</a> / Order Tracking</p>
                </div>

            </div>
        </div>
    </section>

    <div class="body-content py-2">
        <div class="container">
            <div class="my-track-page">
                <div class="row">
                    <article class="card">
                        <div class="card-body tracking_body">
                            <article class="card">
                                <div class="card-body row ">
                                    <div class="col-md-3 col-6">
                                        <strong>Order No:</strong> <br> <span>{{ $order->order_number }}</span>
                                    </div>
                                    <div class="col-md-2 col-6"> <strong>Order Date:</strong> <br>{{ $order->order_date }}
                                    </div>
                                    <div class="col-md-2 col-6"> <strong>Payment Method:</strong> <br> {{ $order->payment_type }}</div>
                                    <div class="col-md-2 col-6 "> <strong>Status:</strong> <br>

                                        @if ($order->status == 'Pending')
                                            Received
                                        @elseif ($order->status == 'Processing')
                                            Picked By Couriar
                                        @else
                                            {{ $order->status }}
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-6 text-lg-end"> <strong>Total: </strong>
                                        <br>৳{{ number_format($order->total_amount, 2) }}
                                    </div>
                                </div>
                            </article>
                            <div class="track">
                                @if ($order->status == 'Pending')
                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-spinner"></i> </span>
                                        <span class="text"> Received</span>
                                        <small class="text-danger">{{ $order->order_date }}</small>
                                    </div>
                                    <div class="step ">
                                        <span class="icon "><i class="fa fa-check"></i> </span>
                                        <span class="text"> confirmed</span>
                                    </div>
                                    <div class="step">
                                        <span class="icon"> <i class="fa fa-shopping-cart"></i> </span>
                                        <span class="text"> Processing</span>
                                    </div>

                                    <div class="step">
                                        <span class="icon"> <i class="fa fa-hand-lizard-o"></i> </span>
                                        <span class="text">Delivered</span>
                                    </div>
                                    {{-- <div class="step ">
                                        <span class="icon"> <i class="fa fa-times"></i> </span>
                                        <span class="text">Cancelled</span>
                                    </div> --}}
                                @elseif($order->status == 'Confirm')
                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-spinner"></i> </span>
                                        <span class="text"> Received</span>
                                        <small class="text-danger">{{ $order->order_date }}</small>
                                    </div>
                                    <div class="step active">
                                        <span class="icon "><i class="fa fa-check"></i> </span>
                                        <span class="text"> confirmed</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->confirmed_date)->format('d F Y') }}</small>
                                    </div>
                                    <div class="step">
                                        <span class="icon"> <i class="fa fa-shopping-cart"></i> </span>
                                        <span class="text"> Processing</span>
                                    </div>

                                    <div class="step">
                                        <span class="icon"> <i class="fa fa-hand-lizard-o"></i> </span>
                                        <span class="text">Delivered</span>
                                    </div>
                                    {{-- <div class="step ">
                                        <span class="icon"> <i class="fa fa-times"></i> </span>
                                        <span class="text">Cancelled</span>
                                    </div> --}}
                                @elseif($order->status == 'Processing')
                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-spinner"></i> </span>
                                        <span class="text">Received</span>
                                        <small class="text-danger">{{ $order->order_date }}</small>
                                    </div>
                                    <div class="step active">
                                        <span class="icon "><i class="fa fa-check"></i> </span>
                                        <span class="text">confirmed</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->confirmed_date)->format('d F Y') }}</small>
                                    </div>
                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-shopping-cart"></i> </span>
                                        <span class="text">Processing</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->processing_date)->format('d F Y') }}</small>
                                    </div>

                                    <div class="step">
                                        <span class="icon"> <i class="fa fa-hand-lizard-o"></i> </span>
                                        <span class="text">Delivered</span>
                                    </div>
                                    {{-- <div class="step ">
                                        <span class="icon"> <i class="fa fa-times"></i> </span>
                                        <span class="text">Cancelled</span>
                                    </div> --}}
                                @elseif($order->status == 'Delivered')
                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-spinner"></i> </span>
                                        <span class="text">Received</span>
                                        <small class="text-danger">{{ $order->order_date }}</small>
                                    </div>
                                    <div class="step active">
                                        <span class="icon "><i class="fa fa-check"></i> </span>
                                        <span class="text">confirmed</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->confirmed_date)->format('d F Y') }}</small>
                                    </div>
                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-shopping-cart"></i> </span>
                                        <span class="text">Processing</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->processing_date)->format('d F Y') }}</small>
                                    </div>

                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-hand-lizard-o"></i> </span>
                                        <span class="text">Delivered</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->delivered_date)->format('d F Y') }}</small>
                                    </div>
                                    {{-- <div class="step ">
                                        <span class="icon"> <i class="fa fa-times"></i> </span>
                                        <span class="text">Cancelled</span>
                                    </div> --}}
                                @elseif($order->status == 'Cancelled')
                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-spinner"></i> </span>
                                        <span class="text">Received</span>
                                        <small class="text-danger">{{ $order->order_date }}</small>
                                    </div>
                                    <div class="step active">
                                        <span class="icon "><i class="fa fa-check"></i> </span>
                                        <span class="text">confirmed</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->confirmed_date)->format('d F Y') }}</small>
                                    </div>
                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-shopping-cart"></i> </span>
                                        <span class="text">Processing</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->processing_date)->format('d F Y') }}</small>
                                    </div>

                                    <div class="step active">
                                        <span class="icon"> <i class="fa fa-hand-lizard-o"></i> </span>
                                        <span class="text">Delivered</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->delivered_date)->format('d F Y') }}</small>
                                    </div>
                                    {{-- <div class="step active">
                                        <span class="icon"> <i class="fa fa-times"></i> </span>
                                        <span class="text">Cancelled</span>
                                        <small
                                            class="text-danger">{{ Carbon\Carbon::parse($order->cancel_date)->format('d F Y') }}</small>
                                    </div> --}}
                                @else
                                    <div class="cancel done">
                                        <span class="icon "> <i class="fa fa-close "></i> </span>
                                        <span class="text">Received</span>
                                    </div>
                                    <div class="cancel done">
                                        <span class="icon "><i class="fa fa-close"></i> </span>
                                        <span class="text">confirmed</span>
                                    </div>
                                    <div class="cancel done">
                                        <span class="icon"> <i class="fa fa-close"></i> </span>
                                        <span class="text">Processing</span>

                                    </div>

                                    <div class="cancel done">
                                        <span class="icon"> <i class="fa fa-close"></i></span>
                                        <span class="text">Delivered</span>

                                    </div>
                                    {{-- <div class="cancel done">
                                        <span class="icon"> <i class="fa fa-close"></i></span>
                                        <span class="text">Cancelled</span>

                                    </div> --}}
                                @endif

                            </div>

                            <div class="empty"></div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($orderItem as $item)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td><img src="{{ asset('/uploads/product/'.$item->product->image) }}" width="30"
                                                            height="30" alt=""></td>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>


@endsection
