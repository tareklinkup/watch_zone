@extends('layouts.master')
@section('title', 'User Registration')
@section('main-content')

<main>
    <div class="container-fluid">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Registration</span>
        </div>
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <div class="table-head"><i class="fas fa-user me-1"></i>Add new user</div>
                <a href="{{ route('dashboard') }}" class="btn btn-addnew"> Dashboard</a>
            </div>
            <div class="card-body table-card-body">
                <div class="row">
                    <form method="POST" action="{{ route('registration.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="name" class="col-form-label">Name <small class="text-danger">*</small></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm shadow-none @error('name') is-invalid @enderror" id="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="username" class="col-form-label">Username <small class="text-danger">*</small></label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-sm shadow-none @error('username') is-invalid @enderror" id="username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="role_id" class="col-form-label">Select Role <small class="text-danger">*</small></label>
                                <select name="role_id" class="form-control form-control-sm shadow-none @error('role_id') is-invalid @enderror" id="role_id">
                                    <option value="">-- select one --</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label for="email" class="col-form-label">Email <small class="text-danger">*</small></label>
                                <input type="email" name="email" value="{{ old('value') }}" class="form-control form-control-sm shadow-none @error('email') is-invalid @enderror" id="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                <label for="inputPassword" class="col-form-label">Password <small class="text-danger">*</small></label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control form-control-sm shadow-none @error('password') is-invalid @enderror" id="inputPassword">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label for="image" class="col-form-label">Image</label>
                                <input class="form-control" id="image" type="file" name="image" onchange="readURL(this);">
                                <div class="form-group mt-1">
                                    <img class="form-controlo border" src="#" id="previewImage" style="width: 100px;height: 70px;">
                                </div>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="clearfix">
                            <div class="text-end m-auto">
                                <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                <button type="submit" class="btn btn-success shadow-none">Submit</button>
                            </div>
                        </div>
                    </form>    
                </div>
            </div>
        </div>  
    </div>
    <div class="container-fluid">
        <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <div class="table-head"> <i class="fas fa-users mr-1"></i>
                    All User List</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>User Type</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key=>$user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ optional($user->role)->name }}</td>
                                    <td><img class="border" style="height: 40px; width:50px;" src="{{ asset($user->image) }}" alt=""></td>
                                    <td>
                                        @if(Auth::user()->id == 1)
                                        {{-- @if($user->id != 1)      
                                        <a data-id="{{$user->id}}" class="btn btn-edit edit-role shadow-none" href="{{route('profile',$user->id)}}"><i class="fas fa-edit"></i></a>
                                        @endif --}}
                                        <button type="submit" class="btn btn-delete shadow-none " onclick="deleteUser({{ $user->id }})" {{ $user->id == 1 ? 'disabled': ''}}><i class="fa fa-trash"></i></button>
                                        <form id="delete-form-{{$user->id}}" action="{{ route('profile.delete', $user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                         </form>  
                                         @endif
                                    </td>
                            
                                </tr>
                            @empty
                                <tr>
                                    <td rowspan="5">Data Not Found</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script>
        function deleteUser(id) {
        swal({
            title: 'Are you sure?',
            text: "You want to Delete this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            }
        })
    }
</script>
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
    document.getElementById("previewImage").src="/notFound.png";
</script>
@endpush