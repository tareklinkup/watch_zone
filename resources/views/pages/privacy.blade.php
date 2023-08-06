@extends('layouts.web_master')
@section('title', 'Privacy Policy')
@section('website-content')


    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            <h2 class="page-header-title">Privacy Policy</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home //</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
                            </ol>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start Page Not Found Area Wrapper ==-->
        <div class="page-not-found-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="error-content ">
                            {!! $privacy->privacy_desc !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Not Found Area Wrapper ==-->

    </main>

@endsection
