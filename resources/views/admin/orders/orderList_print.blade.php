@extends('layouts.master')
@section('title', 'Print Order')
@push('admin-css')
<style>
    .container {
        width: 100%;
        margin: 0px auto;
    }
    .custom-row {
        width: 100%;
        display: block;
    }

    .print-btn a{
        background: #CFD8DC;
        display: inline-block;
        padding: 3px 13px;
        border-radius: 5px;
        color: #000 !important;
    }
    .print-btn a:hover {
        background: #B0BEC5;
    }

    .com_address{
        color: #000 !important;
    }
    .invoice-title {
        text-align: center;
        font-weight: bold;
        font-size: 15px;
        margin-bottom: 15px;
        padding: 5px;
        border-top: 1px dotted #454545;
        border-bottom: 1px dotted #454545;
    }

    .com_content img{
        height: 100px;
    }

    .col-xs-12 {
        width: 100%;
    }
    .col-xs-10 {
        width: 80%;
        float: left;
    }
    .col-xs-9 {
        width: 70%;
        float: left;
    }
    .col-xs-7 {
        width: 60%;
        float: left;
    }
    .col-xs-6 {
        width: 50%;
        float: left;
    }
    .col-xs-5 {
        width: 40%;
        float: left;
    }
    .col-xs-4 {
        width: 35%;
        float: left;
    }
    .col-xs-3 {
        width: 30%;
        float: left;
    }
    .col-xs-2 {
        width: 20%;
        float: left;
    }
    .b-text {
        font-weight: 500;
        font-size: 15px;
    }
    .normal-text {
        font-size: 14px;
        margin: 0px;
    }
    .invoice-details {
        width: 100%;
        border-collapse: collapse;
        border:1px solid #ccc;
    }
    .invoice-details thead {
        font-weight: 500;
        text-align:center;
    }
    .invoice-details tbody td{
        padding: 0px 5px;
    }
    .text-center {
        text-align: center;
    }
    .text-right {
        text-align: right;
    }
    .line {
        border-bottom: 1px dotted #454545;
        margin-bottom: 15px;
    }
    .paid-text {
        padding:30px 0px;
    }
    .mt-60 {
        margin-top: 60px;
    }
    .mr-20 {
        margin-right: 20px;
    }
    .ml-20 {
        margin-left: 20px;
    }
    .ft-fiext {
        position: fixed;
        bottom: 0;
    }
    .cls {
        clear: both;
    }

    @media print {
        .invoice-title {
            font-size: 20px;
        }
        .com_address h5{
            font-size: 25px;
            
        }
        .com_address p{
            font-size: 20px;
            color: #000;
        }
        .b-text{
            font-size: 20px;
        }
        .normal-text{
            font-size: 20px;
        }

        .invoice-details td{
            font-size: 20px;
        }

        .cus_total table tr td{
            font-size: 18px;
        }
        /* .cus_total{
            width: 30%;
        }
        .paid-text{
            width: 70%;
        } */

        
      }
</style>
@endpush
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Print Order</span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Print Order</div>
                        <div class="float-right">
                          
                        </div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="content">
                            <!-- order print-->
                            <div class="row ml-1">
                                <div class="col-xs-6 mb-2">
                                    <span class="print-btn"><a href="" onclick="printDiv('invoiceContent')"><i class="fa fa-print"></i> Print</a></span>
                                </div>
                    
                                <div class="col-xs-6 mb-2 d-flex justify-content-end pr-3">
                                    <span class="print-btn"><a href="{{ route('admin.delivered.order') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></span>
                                </div>
                            </div>
                    
                            <div id="invoiceContent">
                                <div class="com_content d-flex py-2">
                                    <img src="{{ asset($content->logo) }}" class="align-self-center me-2" width="250" height="100" alt="">
                                    <div class="com_address">
                                        <h5>{{ $content->com_name }}</h5>
                                        <p class="m-0">{{ $content->address }}</p>
                                        <p class="m-0"><strong>Mobile:</strong> {{ $content->phone_one }}</p>
                                        <p class="m-0"><strong>Email:</strong> {{ $content->email }}</p>
                                    </div>
                                </div>
                                
                                <div class="custom-row">
                                    <div class="invoice-title">
                                        Order Invoice
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-xs-7 cus_address">
                                        <strong class="b-text">Customer  Name:</strong> <span class="normal-text">{{ $order->name}}</span><br>
                                        <strong class="b-text">Customer Email:</strong> <span class="normal-text">{{ $order->email}}</span><br>
                                        <strong class="b-text">Customer Mobile:</strong> <span class="normal-text">{{ $order->phone}}</span><br>
                                        <strong class="b-text">Order Status::</strong> <span class="normal-text">{{ $order->status}}</span><br>
                                        <strong class="b-text"> Address:</strong> <span class="normal-text">{{ $order->address}}</span>
                                    </div>
                                    <div class="col-xs-5 text-right">
                                        <strong class="b-text">Order No:</strong> <span class="normal-text">{{ $order->order_number}}</span><br>
                                        <strong class="b-text">Order Date:</strong> <span class="normal-text">{{ date('F j, Y',strtotime($order->order_date))}}</span>
                                    </div>
                                    <div class="cls"></div>
                                </div>
                                <div class="custom-row">
                                    <div class="line">&nbsp;</div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-xs-12">
                                        <table class="invoice-details table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <td>Sl.</td>
                                                    <td>Description</td>
                                                    <td>Quantity</td>
                                                    <td>Color</td>
                                                    <td>Size</td>
                                                    <td>Price</td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderItem as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                                    <td> <?= !empty($item->product->name) ? $item->product->name: ''?></td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td> <?= !empty($item->color->name) ? $item->color->name: ''?></td>
                                                    <td> <?= !empty($item->size->name) ? $item->size->name: ''?></td>
                                                    <td width="20%">{{ $item->price }}</td>
                                                    <td width="20%" class="text-end">{{ number_format($item->price * $item->quantity, 2) }}</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                              
                                        
                            </div>
                            <!-- order print-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
    
    var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
    var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

    function inWords (num) {
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'taka only ' : '';
        return str;
    }
    document.getElementById('words').innerHTML = inWords({{ $order->total_amount }});
</script>
@endpush

