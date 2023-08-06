@extends('layouts.master')
@section('title', 'Slider Entry')
@section('main-content')

    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> >
                    Slider</span>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head">
                                @if (@isset($sliderData))
                                    <i class="fas fa-edit"></i> Slider Update
                                @else
                                    <i class="fab fa-bandcamp"></i> Slider Entry
                                @endif
                            </div>
                            {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                        </div>

                        <div class="card-body table-card-body">
                            <form method="post"
                                action="{{ @$sliderData ? route('slider.update', $sliderData->id) : route('slider.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">Slider Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title"
                                            value="{{ @$sliderData ? @$sliderData->title : old('title') }}"
                                            class="form-control form-control-sm shadow-none">
                                        @error('title')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                  

                                    <label for="" class="col-sm-3 col-form-label">Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="link"
                                            value="{{ @$sliderData ? @$sliderData->link : old('link') }}"
                                            class="form-control form-control-sm shadow-none">
                                        @error('link')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                  


                                    <label for="inputPassword" class="col-sm-3 col-form-label">Image (<small
                                            class="text-danger">1920 X 600</small>)</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" class="form-control form-control-sm"
                                            id="image" onchange="mainThambUrl(this)">
                                        @error('image')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                        <div class="mb-1">
                                            @if (@$sliderData->is_video)
                                                <video src="{{ asset($sliderData->image) }}" width="100" height="100"
                                                    controls></video>
                                            @else
                                                <img src="{{ !empty(@$sliderData) ? asset(@$sliderData->image) : asset('images/no.png') }}"
                                                    id="mainThmb"
                                                    style="width: 80px; height: 80px; border: 1px solid #999; padding: 2px;"
                                                    alt="">
                                            @endif

                                        </div>
                                    </div>

                                   


                                </div>


                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                        <button type="submit"
                                            class="btn btn-success shadow-none">{{ @$sliderData ? 'Update change' : 'Save change' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i> Slider List</div>
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
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($slider as $item)
                                            <tr class="{{ $item->id }}">
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>
                                                    @if ($item->is_video)
                                                        <video width="50" height="50" controls>
                                                            <source src="{{ asset($item->image) }}" type="video/mp4">
                                                        </video>
                                                    @else
                                                        <img src="{{ asset($item->image) }}" width="50" height="50"
                                                            alt="">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge bg-info">Active</span>
                                                    @else
                                                        <span class="badge bg-warning">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('slider.edit', $item->id) }}"
                                                        class="btn btn-edit shadow-none"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    @if ($item->status == 1)
                                                        <a href="{{ route('slider.inactive', $item->id) }}"
                                                            title="Inactive" class="btn btn-delete shadow-none"><i
                                                                class="fas fa-thumbs-down"></i></a>
                                                    @else
                                                        <a href="{{ route('slider.active', $item->id) }}" title="Active"
                                                            class="btn btn-edit shadow-none"><i
                                                                class="fas fa-thumbs-up"></i></a>
                                                    @endif
                                                    <a href="{{ route('slider.delete') }}" id="delete"
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
