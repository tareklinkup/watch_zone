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
        color: #000000 !important;
    }
    .print-btn a:hover {
        background: #B0BEC5;
    }

    .com_address{
        color: #000000 !important;
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

    .com_content img {
    width: 100px;
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
    .print_footer p{
        font-size: 14px;
        margin-bottom: 0;
        font-weight: 500
    }
    .footer{
        padding-top: 140px;
    }
    .recived{
        text-align: right;
    }

    @media print {
        .footer{
            position:fixed;
            left:0;
            bottom:10px;
            width:100%;
    }
    .recived{
        text-align: right;
    }
        .invoice-title {
            font-size: 21px;
        }
        .com_address h5{
            font-size: 21px;
            
        }
        .cus_address h4{
            font-size: 19px

        }
        .com_address p{
            font-size: 18px;
            color: #000000;
        }
        .b-text{
            font-size: 20px;
        }
        .normal-text{
            font-size: 18px;
        }

        .invoice-details td{
            font-size: 18px;
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
                                    <img src="{{ asset($content->logo) }}" class="align-self-center me-2" width="200" height="100" alt="">
                                    <div class="com_address">
                                        <h5>{{ $content->com_name }}</h5>
                                        <p class="m-0"><strong class="b-text">Address : </strong>{{ $content->address }}</p>
                                        <p class="m-0"><strong class="b-text">Mobile : </strong> {{ $content->phone_one }}</p>
                                        <p class="m-0"><strong class="b-text">Email : </strong> {{ $content->email }}</p>
                                    </div>
                                </div>
                                
                                <div class="custom-row">
                                    <div class="invoice-title">
                                        Order Invoice
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-xs-7 cus_address">
                                        <h4>Customer Details</h4>
                                        <strong class="b-text">Name : </strong> <span class="normal-text">{{ $order->name}}</span><br>
                                        <strong class="b-text">Email : </strong> <span class="normal-text">{{ $order->email}}</span><br>
                                        <strong class="b-text">Mobile : </strong> <span class="normal-text">{{ $order->phone}}</span><br>
                                        <strong class="b-text">Order Status : </strong> <span class="normal-text">{{ $order->status}}</span><br>
                                        <strong class="b-text"> Address : </strong> <span class="normal-text">{{ $order->address}}</span>
                                    </div>
                                    <div class="col-xs-5 text-right">
                                        <strong class="b-text">Order No : </strong> <span class="normal-text">{{ $order->order_number}}</span><br>
                                        <strong class="b-text">Order Date : </strong> <span class="normal-text">{{ date('F j, Y',strtotime($order->order_date))}}</span>
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
                                                   
                                                    <td width="20%">{{ $item->price }}</td>
                                                    <td width="20%" class="text-end">{{ number_format($item->price * $item->quantity, 2) }}</td>
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                                <div class="custom-row">
                                    <div class="col-xs-9">
                                        <div class="paid-text">
                                            <strong class="b-text">In Words:</strong> <span class="normal-text text-capitalize" id="words"></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-3 cus_total">
                                        <table width="100%">
                                            <tr>
                                                <td width="40%" class="b-text">Sub Total :</td>
                                                <td class="text-right">{{ $order->amount }}</td>
                                            </tr>
                                            <tr>
                                                <td width="70%" class="b-text">Shipping Cost:</td>
                                                <td class="text-right">{{ $order->ship_charge }}</td>
                                            </tr>

                                            <tr>
                                                <td width="70%" class="b-text">Coupon Discount:</td>
                                                <td class="text-right">
                                                    @if ($order->couponDiscount > 0)
                                                        {{ $order->couponDiscount }}
                                                    @else
                                                        ---
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="border-bottom: 1px solid rgb(204, 204, 204);"></td>
                                            </tr>
                                            <tr>
                                                <td width="45%" class="b-text">Total:</td>
                                                <td class="text-right">{{ number_format($order->total_amount, 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                  {{-- <div class="custom-row">
                                    <div class="col-xs-12">
                                        <p style="margin-top: 25px"><strong>Note : </strong></p>
                                    </div>
                                </div> --}}

                                <section class="footer">
                                        <div class="row">
                                            <div class="col-xs-6 col-gl-6 col-md-6">
                                                <span style="text-decoration:overline;">Authorized by</span>
                                            </div>
                                            <div class="col-xs-6 col-gl-6 col-md-6 recived">
                                                <span style="text-decoration:overline;">Received by</span>
                                            </div>
                                            <div class="col-xs-12 col-gl-12 col-md-12 text-center print_footer">
                                                <p >Thanks for purchasing from Watch Zone </p>
                                            </div>
                                        </div>
                                </section>
                              
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

