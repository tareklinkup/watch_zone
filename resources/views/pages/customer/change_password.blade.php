@extends('layouts.web_master')
@section('title', 'Customer Dashboard')
@section('content')


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
            <div class="col-md-10 aside">
                <h1 class="mb-1">Edit Password</h1>
                {{-- <div class="row vert-margin">
                    <div class="col-sm-16"> --}}
                        <div class="card customer_dash">
                            <div class="card-body">
                                <form action="{{ route('customer.update.password') }}" method="post">
                                    @csrf
                                    <div class="row mt-1">
                                        <div class="col">
                                            <label>Old Password:</label>
                                            <div class="form-group">
                                                <input type="password" name="old_password" class="form-control form-control--sm" placeholder="Old Password">
                                                @error('old_password')<span style="color: red;">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col">
                                            <label>New Password:</label>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control--sm" placeholder="New Password">
                                                @error('password')<span style="color: red;">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col">
                                            <label>Confirm Password:</label>
                                            <div class="form-group">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control--sm" placeholder="Confirm Password">
                                                @error('password_confirmation')<span style="color: red;">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 float-right">
                                        <button type="submit" class="btn"><span>Update</span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    {{-- </div>
                </div> --}}
                
            </div>
        </div>
    </div>
</div>

@include('partials.footer_top')        
@endsection
