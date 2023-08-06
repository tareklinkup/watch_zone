@extends('layouts.web_master')
@section('title', 'Customer Registration')
@section('website-content')

    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home //</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Login-Register</li>
                            </ol>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Login Wrapper ==-->
        <div class="login-register-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 login-register-border">
                        <div class="login-register-content">
                            <div class="login-register-title mb-30">
                                <h3>Login</h3>
                                @if (session('error'))
                                    <div class="alert alert-danger"><small>{{ session('error') }}</small></div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success"><small>{{ session('success') }}</small></div>
                                @endif
                                <p>Welcome back! Please enter your username and password to login.</p>
                               
                            </div>
                            <div class="login-register-style ">
                                <form action="{{ route('customer.login.process') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="loginDetail" value="{{Session::get('loginDetail')}}">
                                    <div class="row">
                                        <div class="col-lg-3 col-4"><label for="">Phone</label></div>
                                        <div class="col-lg-9 col-8">
                                            <div class="login-register-input">
                                                <input type="number" name="phone" class="@error('phone') is-invalid @enderror"
                                                    placeholder="Phone Number">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-4"><label for="">Password</label></div>
                                        <div class="col-lg-9 col-8">
                                            <div class="login-register-input">
                                                <input type="password" name="password"
                                                    class="@error('password') is-invalid @enderror" placeholder="Password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                                <div class="forgot">
                                                    <a href="#">Forgot?</a>
                                                    {{-- <a href="{{ route('customer.forgot.password.form') }}">Forgot?</a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    
                                    <div class="btn-register text-end">
                                        <button class="btn-register-now">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="login-register-content login-register-pl">
                            <div class="login-register-title mb-30">
                                <h3>Register</h3>
                                <p>Create new account today to reap the benefits of a personalized shopping experience. </p>
                            </div>
                            <div class="login-register-style">
                                <form action="{{ route('customer.register.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="loginDetail" value="{{Session::get('loginDetail')}}">
                                    <div class="row">
                                        <div class="col-lg-4 col-4"><label for="">Name <span class="text-danger">*</span></label></div>
                                        <div class="col-lg-8 col-8">
                                            <div class="login-register-input">
                                                <input type="text" name="name"
                                                    class="@error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Full Name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-4"><label for="">Phone <span class="text-danger">*</span></label></div>
                                        <div class="col-lg-8 col-8">
                                            <div class="login-register-input">
                                                <input type="number" name="phone" class="@error('phone') is-invalid @enderror"
                                                value="{{old('phone')}}"  placeholder="Phone Number">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-4"><label for="">Email Address </label></div>
                                        <div class="col-lg-8 col-8">
                                            <div class="login-register-input">
                                                <input type="email" name="email" class="@error('email') is-invalid @enderror"
                                                value="{{old('email')}}" placeholder="E-mail Address">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-4"><label for=""> Address <span class="text-danger">*</span></label></div>
                                        <div class="col-lg-8 col-8">
                                            <div class="login-register-input">
                                                <input type="text" name="address" value="{{old('address')}}" class="@error('address') is-invalid @enderror"
                                                    placeholder=" Address">
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-4"><label for=""> Password <span class="text-danger">*</span></label></div>
                                        <div class="col-lg-8 col-8">
                                            <div class="login-register-input">
                                                <input type="password" name="password"
                                                    class="@error('password') is-invalid @enderror" placeholder="Password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-4"><label for=""> Confirm Password <span class="text-danger">*</span></label></div>
                                        <div class="col-lg-8 col-8">
                                            <div class="login-register-input">
                                                <input type="password" name="password_confirmation"
                                                    class="@error('password_confirmation') is-invalid @enderror"
                                                    placeholder="Confirm Password">
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="login-register-paragraph">
                                        <p>Your personal data will be used to support your experience throughout this
                                            website, to manage access to your account, and for other purposes described in
                                            our <a href="{{ route('privacy.policy') }}">privacy policy.</a></p>
                                    </div>
                                    <div class="btn-register">
                                        <button class="btn-register-now"> Register</button>
                                        {{-- <a  href="account.html"></a> --}}
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Login Wrapper ==-->

    </main>



@endsection
