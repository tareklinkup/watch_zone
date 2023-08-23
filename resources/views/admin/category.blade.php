@extends('layouts.master')
@section('title', 'Category Entry')
@section('main-content')

    <main>
        <div class="container-fluid" id="Category">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Category</span>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fab fa-bandcamp"></i> Category Entry</div>
                            {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                        </div>

                        <div class="card-body table-card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form id="form" method="post"
                                action="{{ @$categoryData ? route('category.update', $categoryData->id) : route('category.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">

                                    <label for="name" class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="name"
                                            value="{{ @$categoryData->name }}"
                                            class="form-control shadow-none form-control-sm @error('name') is-invalid @enderror">
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <h5 class="text-center">SEO</h5>
                                    <label for="meta_title" class="col-sm-3 col-form-label">Meta Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_title" id="meta_title"
                                            value="{{ @$categoryData->meta_title }}"
                                            class="form-control shadow-none form-control-sm @error('name') is-invalid @enderror">
                                    </div>

                                    <label for="meta_description" class="col-sm-3 col-form-label">Meta Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_description" id="meta_description"
                                            value="{{ @$categoryData->meta_description }}"
                                            class="form-control shadow-none form-control-sm @error('name') is-invalid @enderror">
                                    </div>

                                    <label for="meta_keywords" class="col-sm-3 col-form-label">Meta Keywords</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_keywords" id="meta_keywords"
                                            value="{{ @$categoryData->meta_keywords }}"
                                            class="form-control shadow-none form-control-sm @error('name') is-invalid @enderror">
                                    </div>


                                    <label for="name" class="col-sm-3 col-form-label">Is Homepage</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="is_homepage" id="is_homepage"
                                            {{ !empty($categoryData->is_homepage) ? 'checked' : '' }} value="1">
                                    </div>
                                    <label for="name" class="col-sm-3 col-form-label">Brands</label>
                                    <div class="col-sm-9">
                                        @foreach ($brands as $hs => $item)
                                            <label for="as-{{ $hs }}" class="mr-2" style="user-select:none">
                                                <input name="brandChild[]" type="checkbox" value="{{ $item->id }}"
                                                    id="as-{{ $hs }}"
                                                    {{ @$categoryData && in_array($item->id, $brands_child) ? 'checked' : '' }}>
                                                {{ $item->name }},
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <label for="" class="col-sm-3 col-form-label">Image (<small
                                            class="text-danger">720 X 675</small>)</label>
                                    <div class="col-sm-9 mt-2">
                                        <input type="file" name="image"
                                            class="form-control shadow-none @error('image') is-invalid @enderror"
                                            id="image" onchange="mainThambUrl(this)">

                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <div>
                                            <img src="{{ !empty(@$categoryData) ? asset(@$categoryData->image) : asset('images/no.png') }}"
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
                                            class="btn btn-success shadow-none">{{ @$categoryData ? 'Update change' : 'Save change' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    {{-- <div class="alert alert-danger" role="alert">
                    A simple danger alert—check it out!
                  </div>
                  @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror --}}
                    @if (session('success'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i> Category List</div>
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
                                            <th>Name</th>
                                            {{-- <th>Brand</th> --}}
                                            <th>Image</th>
                                            {{-- <th>Parent Category</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                {{-- <td>{{ optional($item->brand)->name }}</td> --}}
                                                <td><img src="{{ asset($item->image) }}" width="30" height="30"
                                                        alt=""></td>
                                                {{-- <td>{{ $item->parent_id != 0 ? optional($item->parent)->name : '' }}</td> --}}
                                                <td>
                                                    <a data-id="{{ $item->id }}"
                                                        class="btn btn-edit edit-category shadow-none"
                                                        href="{{ route('category.edit', $item->id) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="{{ '/category/delete/' . $item->id }}" id="delete"
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
