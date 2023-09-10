@extends('layouts.web_master')
@section('title', 'faq')
@section('website-content')


    <main class="main-content">

        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            {{-- <h2 class="page-header-title">Terms & Conditions</h2> --}}
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home //</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Frequently Answer Question</li>
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            @if (count($faqs) > 0)
                <h3 class="mt-5 mb-4">Frequently Asked Questions</h3>

                <div class="accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    @foreach ($faqs as $key => $item)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Question {{ $key + 1 }} -: {{ $item->name }}
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#faqAccordion">
                                <div class="card-body">
                                    {{ $item->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="mt-5 mb-5">
                        <h2 class="text-danger">No FAQ Found !</h2>
                    </div>
            @endif

            <!-- Add more FAQ items as needed -->

        </div>
        </div>
    </main>

@endsection
