@extends('layouts.web_master')
@section('title', 'Customer Order')
@push('webcss')
    <style>
        
    </style>
@endpush
@section('website-content')


<div class="holder breadcrumbs-wrap mt-0">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><span>My account</span></li>
        </ul>
    </div>
</div>
<div class="holder">
    <div class="container">
        <div class="row">
            <div class="col-md-6 aside">
                @include('pages.customer.cus_sidebar')
            </div>
            <div class="col-md-12 aside">
                <h1 class="mb-1">Order History</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-order-history text-center">
                        <thead class="tablehead">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Order Date </th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actiion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->order_number }}</td>
                                <td>{{ date('F j, Y',strtotime($item->order_date)) }}</td>
                                <td><span class="color">&#2547; {{ number_format($item->total_amount, 2) }}</span></td>
                                <td>
                                    @if ($item->status == 'Cancel')
                                        <span class="badge_bg_can">{{ $item->status }}</span>
                                    @else
                                        <span class="badge_bg">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('customer.order.show', $item->id) }}" class="btn btn--grey btn--sm"><i class="icon-eye"></i></a>
                                    <a href="{{ route('customer.order.print', $item->id) }}" class="btn btn--sm">Print</a>
                                </td>
                            </tr>
                            @endforeach
                            
                           
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>

	

@endsection