@extends('layouts.master')
@section('title', 'Brand Entry')
@section('main-content')

    <main>
        <div class="container-fluid" id="Category">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Brand</span>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head">
                                @if (@isset($brandData))
                                    <i class="fas fa-edit"></i> Brand Update
                                @else
                                    <i class="fab fa-bandcamp"></i> Brand Entry
                                @endif
                            </div>
                            {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                        </div>

                        <div class="card-body table-card-body">
                            <form method="post"
                                action="{{ @$brandData ? route('brand.update', $brandData->id) : route('brand.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">

                                    <label for="title" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{ @$brandData->name }}"
                                            class="form-control form-control-sm shadow-none" id="name">
                                        @error('name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <h5 class="text-center">SEO</h5>

                                    <label for="meta_title" class="col-sm-3 col-form-label">Meta Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_title" value="{{ @$brandData->meta_title }}"
                                            class="form-control form-control-sm shadow-none" id="meta_title">
                                    </div>

                                    <label for="meta_description" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_description"
                                            value="{{ @$brandData->meta_description }}"
                                            class="form-control form-control-sm shadow-none" id="meta_title">
                                    </div>


                                    <label for="meta_keywords" class="col-sm-3 col-form-label">Meta Keywords</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="meta_keywords" value="{{ @$brandData->meta_keywords }}"
                                            class="form-control form-control-sm shadow-none" id="meta_keywords">
                                    </div>

                                    <label for="name" class="col-sm-3 col-form-label">Is Homepage</label>
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="is_homepage" id="is_homepage"
                                            {{ !empty($brandData->is_homepage) ? 'checked' : '' }} value="1">
                                    </div>

                                    <label for="" class="col-sm-3 col-form-label">Image (<small
                                            class="text-danger">240 X 90</small>)</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" class="form-control form-control-sm"
                                            id="image" onchange="mainThambUrl(this)">
                                        @error('image')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                        <div>
                                            <img src="{{ !empty(@$brandData) ? asset(@$brandData->image) : asset('images/no.png') }}"
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
                                            class="btn btn-success shadow-none">{{ @$brandData ? 'Update change' : 'Save change' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i> Brand List</div>
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
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brand as $item)
                                            <tr class="{{ $item->id }}">
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td><img src="{{ asset($item->image) }}" width="30" height="30"
                                                        alt=""></td>
                                                <td>
                                                    <a href="{{ route('brand.edit', $item->id) }}"
                                                        class="btn btn-edit shadow-none"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ 'brand/delete/' . $item->id }}" id="delete"
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
