@extends('layouts.web_master')
@section('title', 'Customer Registration')
@section('website-content')


<div class="holder breadcrumbs-wrap mt-0">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><span>Sing in</span></li>
        </ul>
    </div>
</div>
<div class="holder">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-10 col-lg-8 register_page">
                <h2 class="text-center"><span>Sing In</span></h2>
                @if (session('error'))
                    <div class="alert alert-danger"><small>{{ session('error') }}</small></div>
                @endif
                
                @if (session('success'))
                    <div class="alert alert-success"><small>{{ session('success') }}</small></div>
                @endif
                <div class="form-wrapper">
                    <form action="{{ route('customer.login.process') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Passsword</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror

                        </div>
                        <div class="text-center">
                            <button class="btn btn-block">Login</button>
                            <div class="  mt-2">
                                <p><a href="{{ route('customer.forgot.password.form') }}">Forgot Password</a></p>
                            </div>
                            <p>Don't have a account ? <a href="{{ route('customer.register') }}">Sing Up</a></p>
                        </div>
                        {{-- <div class="mt-2 float-right">
                            <button type="submit" class="btn-update ml-1"><span>create an account</span></button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer_top')
@endsection
