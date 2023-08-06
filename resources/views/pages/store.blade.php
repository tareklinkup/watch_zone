@extends('layouts.web_master')
@section('title', 'Physical Store')
@section('website-content')


    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            {{-- <h2 class="page-header-title">Physical Store </h2> --}}
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home //</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Physical Store</li>
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
                            {!! $policy->phycal_desc !!}

                        </div>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <iframe src="{{$policy->map_link}}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Page Not Found Area Wrapper ==-->

    </main>

@endsection
