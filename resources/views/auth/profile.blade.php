@extends('layouts.master')
@section('title', 'Profile Update')
@section('main-content')
<main>
    <div class="container-fluid">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{ route('dashboard') }}">Home</a> > Profile</span>
        </div>
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <div class="table-head"><i class="fas fa-user-edit me-1"></i>Update Your Profile</div>
                <a href="{{ route('dashboard') }}" class="btn btn-addnew"> Dashboard</a>
            </div>
            <div class="card-body table-card-body">
                <div class="row">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="name"> Name <span class="text-danger">*</span> </label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control shadow-none @error('name') is-invalid @enderror" id="name" placeholder="Enter name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="username"> UserName <span class="text-danger">*</span></label>
                                <input type="text" name="username" value="{{ Auth::user()->username }}" class="form-control shadow-none @error('username') is-invalid @enderror" id="username" placeholder="Enter Username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="email">E-Mail Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control shadow-none @error('email') is-invalid @enderror" id="email" placeholder="Enter Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="image">User Image</label>
                                <input class="form-control" id="image" type="file" name="image" onchange="readURL(this);">
                                {{-- {{ Auth::user()->image }} --}}
                                <div class="form-group mt-2">
                                    <img class="form-controlo" src="#" id="previewImage" style="width: 100px;height: 80px;">
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="clearfix">
                            <div class="text-end m-auto">
                                <button type="reset" class="btn btn-dark">Reset</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>  
    </div>
</main>
@endsection
@push('scripts')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(100)
                    .height(80);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage").src="{{ asset(Auth::user()->image) }}";
</script>
@endpush