@extends('layouts.web_master')
@section('title', 'Forgot password')
@section('website-content')





<main class="main-content">

    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-header-content">
                        {{-- <h2 class="page-header-title">Forgot password</h2> --}}
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home //</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Forgot password</li>
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
                <div class="col-md-5 m-auto">
                    <div class="login-register-content card p-2">
                        <div class="login-register-title mb-30">
                            <h3>Forgot password</h3>
                          
                        </div>
                        <div class="login-register-styl">
                            <form action="{{ route('customer.forgot.password.link') }}" method="post">
                                
                                @csrf

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
                                <div class="login-register-input">
                                    <input type="number" name="phone" class="@error('phone') is-invalid @enderror"
                                        placeholder="Enter Pgone Number">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                              
                                <div class="btn-register">
                                    <button class="btn-register-now">Reset Password </button>
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
