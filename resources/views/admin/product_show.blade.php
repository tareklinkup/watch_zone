@extends('layouts.master')
@section('title', 'Product Details')
@push('admin-css')
    <style>
        .pro_show_table tr td{
            padding: 5px
        }
    </style>
@endpush
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Product Details</span>
        </div>
        <div class="row">

            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-table me-1"></i>Product Details</div>
                    <a href="{{ route('products.index') }}" class="btn btn-addnew shadow-none"> <i class="fa fa-file-alt"></i> Go Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-6">
                            <div class="prod_card">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><strong>Product Name</strong></td>
                                            <td>{{ $product->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Category</strong></td>
                                            <td>{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Brand</strong></td>
                                            <td>{{ $product->brand->name }}</td>
                                        </tr>
                                       
                                        <tr>
                                            <td><strong>Product Model</strong></td>
                                            <td>{{ $product->model }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Selling Price</strong></td>
                                            <td>&#2547; {{ number_format($product->selling_price, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Discount Price</strong></td>
                                            <td>&#2547; {{ number_format($product->discount_price, 2) }}</td>
                                        </tr>
                                      
                                        <tr>
                                            <td><strong>Product Quantity</strong></td>
                                            <td>
                                                <span class="badge bg-success">{{ $product->quantity }}</span>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Movement</strong></td>
                                            <td>
                                                <span class=" ">{{ $product->movement->name }}</span>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Water Resistant</strong></td>
                                            <td>
                                                <span class=" ">{{ $product->resistant }}</span>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Warranty</strong></td>
                                            <td>
                                                <span class=" ">{{ $product->warranty }}</span>
                                                
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td><strong>Product Image</strong></td>
                                            <td><img src="{{ asset('uploads/product/'.$product->image) }}" width="80" height="80" alt=""></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Other Images</strong></td>
                                            <td>
                                                @foreach ($product->images as $img)
                                                    <img src="{{ asset($img->multiimage) }}" width="80" height="80" alt="">
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        <div class="col-6">
                            <div class="prod_card">
                                <table class="table">
                                    <tbody>
                                        
                                        <tr>
                                            <td>
                                                <strong>Short Description:</strong><br>
                                                {!! $product->short_desc !!}
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Description:</strong><br>
                                                {!! $product->description !!}
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</main>
@endsection
