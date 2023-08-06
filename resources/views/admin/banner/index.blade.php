@extends('layouts.master')
@section('title', 'Banner Entry')
@section('main-content')

    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> >
                    Banner</span>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head">
                                @if (@isset($bannerData))
                                    <i class="fas fa-edit"></i> Banner Update
                                @else
                                    <i class="fab fa-bandcamp"></i> Banner Entry
                                @endif
                            </div>
                            {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                        </div>

                        <div class="card-body table-card-body">
                            <form method="post"
                                action="{{ @$bannerData ? route('banner.update', $bannerData->id) : route('banner.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">

                                    <label for="" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title"
                                            value="{{ @$bannerData ? @$bannerData->title : old('title') }}"
                                            class="form-control form-control-sm shadow-none">
                                        @error('title')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <label for="" class="col-sm-3 col-form-label">Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="link"
                                            value="{{ @$bannerData ? @$bannerData->link : old('link') }}"
                                            class="form-control form-control-sm shadow-none">
                                        @error('link')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label for="inputPassword" class="col-sm-3 col-form-label">Image (<small
                                            class="text-danger">1200 X 424</small>)</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" class="form-control form-control-sm"
                                            id="image" onchange="mainThambUrl(this)">
                                        @error('image')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                        <div class="mb-1">
                                           
                                                <img src="{{ !empty(@$bannerData) ? asset(@$bannerData->image) : asset('images/no.png') }}"
                                                    id="mainThmb"
                                                    style="width: 80px; height: 80px; border: 1px solid #999; padding: 2px;"
                                                    alt="">
                                         

                                        </div>
                                    </div>

                                   


                                </div>


                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                        <button type="submit"
                                            class="btn btn-success shadow-none">{{ @$bannerData ? 'Update change' : 'Save change' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i> banner List</div>
                            <div class="float-right">

                            </div>
                        </div>
                        <div class="card-body table-card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="datatablesSimple" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banner as $item)
                                            <tr class="{{ $item->id }}">
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->link }}</td>
                                                <td>
                                                    <img src="{{ asset($item->image) }}" width="50" height="50"
                                                            alt="">
                                                  
                                                </td>
                                              
                                                <td>
                                                    <a href="{{ route('banner.edit', $item->id) }}"
                                                        class="btn btn-edit shadow-none"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                
                                                    <a href="{{ route('banner.delete') }}" id="delete"
                                                        data-token="{{ csrf_token() }}" data-id="{{ $item->id }}"
                                                        class="btn btn-delete shadow-none"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function mainThambUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
