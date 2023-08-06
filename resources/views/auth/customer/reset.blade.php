@extends('layouts.web_master')
@section('title', 'Reset Password')
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
                <h2 class="text-center"><span>Reset Password</span></h2>
                @if (session('error'))
                    <div class="alert alert-danger"><small>{{ session('error') }}</small></div>
                @endif
                
                @if (session('success'))
                    <div class="alert alert-success"><small>{{ session('success') }}</small></div>
                @endif
                <div class="form-wrapper">
                    <form action="{{ route('customer.reset.password') }}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{$token}}">
                        
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Password" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div>
                            <button class="btn btn-block">Reset Password</button>
                            <p>Don't have a account ? <a href="{{ route('customer.register') }}">Sing Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer_top')
@endsection


    {{-- <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 45px">
                 <h4>Reset Password</h4><hr>
                 <form action="{{ route('customer.reset.password') }}" method="post">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif

                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                     <div class="form-group">
                         <label for="email">Email</label>
                         <input type="email" class="form-control" name="email" placeholder="Enter email address" 
                         value="{{ $email ?? old('email') }}">
                         <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="password">New Password</label>
                         <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                         <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                     </div>
                     <div class="form-group">
                        <label for="password">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter password" value="{{ old('password_confirmation') }}">
                        <span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>
                    </div>
                    
                     <div class="form-group mt-2">
                         <button type="submit" class="btn btn-primary">Reset Password</button>
                     </div>
                     <br>
                 </form>
            </div>
        </div>
    </div> --}}
{{-- @endsection --}}