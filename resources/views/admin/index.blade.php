@extends('layouts.master')
@section('title', 'Admin')
@section('main-content')
<main>
    <div class="container-fluid">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Dashboard</span>
        </div>
        <div class="row mt-3">
            <div class="dashboard-logo text-center pt-3 pb-4">
                <img class="border p-2" style="height: 100px;" src="{{ asset($content->logo) }}" alt="">
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="{{ route('order.report') }}">
                    <div class="card-body mx-auto text-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-file-alt fa-2x text-white"></i>
                        </div>
                        <p class="dashboard-card-text">Reports</p>
                    </div>
                    </a>
                </div>
            </div>
            @can('Product List')
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="{{ route('products.index') }}">
                    <div class="card-body mx-auto text-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="far fa-money-bill-alt fa-2x text-white"></i>
                        </div>
                        <p class="dashboard-card-text">All Product</p>
                    </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('Pending Order')
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="{{ route('admin.pending.order') }}">
                    <div class="card-body mx-auto text-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-spinner fa-2x text-white"></i>
                        </div>
                        <p class="dashboard-card-text">Pending Order</p>
                    </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('Delivered Order')
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="{{ route('admin.delivered.order') }}">
                    <div class="card-body mx-auto text-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-thumbs-up fa-2x text-white"></i>
                        </div>
                        <p class="dashboard-card-text">Delivered Order</p>
                    </div>
                    </a>
                </div>
            </div>
            @endcan
            @if(  
                auth()->user()->can('Public Message')  
            )
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="{{ route('visitor.index') }}">
                    <div class="card-body mx-auto text-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-envelope fa-2x text-white"></i>
                        </div>
                        <p class="dashboard-card-text">Website Visitors</p>
                    </div>
                    </a>
                </div>
            </div>
            @endif
            @can('Canceled Order')
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="{{ route('admin.canceled.order') }}">
                    <div class="card-body mx-auto text-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-ban fa-2x text-white"></i>
                        </div>
                        <p class="dashboard-card-text">Canceled Order</p>
                    </div>
                    </a>
                </div>
            </div>
            @endcan
            @if(  
                auth()->user()->can('Public Message')  
            )
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="{{ route('company.profiles') }}">
                    <div class="card-body mx-auto text-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-address-card fa-2x text-white"></i>
                        </div>
                        <p class="dashboard-card-text">Company Profile</p>
                    </div>
                    </a>
                </div>
            </div>
            @endif
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="{{ route('customer.logout') }}">
                    <div class="card-body mx-auto text-center">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fa fa-sign-out-alt fa-2x text-white"></i>
                        </div>
                        <p class="dashboard-card-text">Sign Out</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="#">
                    <div class="card-body mx-auto text-center">
                        <p class="dashboard-card-text">Today's Order</p>
                        <div class=" justify-content-center align-items-center">
                            <p> <span>Order : </span> {{ $todaysOrder }}</p>
                            <p><span>Amount : </span> {{ number_format($todaysTotal, 2) }} TK</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="#">
                    <div class="card-body mx-auto text-center">
                        <p class="dashboard-card-text"> Monthly Order</p>
                        <div class="justify-content-center align-items-center">
                            <p> <span>Order : </span> {{$monthOrder}}</p> 
                            <p> <span>Amount : </span> {{ number_format($monthTotal, 2) }} TK</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="#">
                    <div class="card-body mx-auto text-center">
                        <p class="dashboard-card-text">Yearly Order</p>
                        <div class="justify-content-center align-items-center">
                           <p><span>Order : </span>{{$yearlyOrder}}</p>
                           <p><span>Amount : </span> {{ number_format($yearTotal, 2) }} TK</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-2 dashboard-card glow">
                    <a href="#">
                    <div class="card-body mx-auto text-center">
                        <p class="dashboard-card-text">Total Amount</p>
                        <div class="justify-content-center align-items-center">
                           <p>{{number_format($totalAmount, 2)}} TK</p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection