@extends('layouts.master')
@section('title', 'Role Entry')
@section('main-content')

<main>
    <div class="container-fluid" id="Role">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Role</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fab fa-bandcamp"></i> Role Entry</div>
                        {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                    </div>
                    
                    <div class="card-body table-card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form id="form" method="post" action="{{ route('role.store') }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Role Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control shadow-none form-control-sm @error('name') is-invalid @enderror">
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">Save</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>
            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Role List</div>
                        <div class="float-right">
                          
                        </div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @if ($role->id != 1)
                                                
                                            <a href="{{route('role.permission', $role->id)}}" class="btn btn-edit shadow-none"><i class="fas fa-users-cog"></i></a>
                                            <a data-id="{{$role->id}}" class="btn btn-edit edit-role shadow-none" href="javascript:void(0)"><i class="fas fa-edit"></i></a>
                                            <button type="submit" class="btn btn-delete shadow-none" onclick="deleteRole({{ $role->id }})"><i class="fa fa-trash"></i></button>
                                            <form id="delete-form-{{$role->id}}" action="{{ route('role.destroy',$role->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endif
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
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script>
    function deleteRole(id) {
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

    $(document).on('click', '.edit-role', function(e){
        e.preventDefault();
        let url = "{{url('role/edit')}}/"+$(this).data('id');
        $.ajax({
            url,
            type: 'get',
            success: function(res){
                let role    = res.role;
                let action  = res.action;

                $('#name').val(role.name);
                $('#form').attr('action', action);
            }
        })
    })

    $("document").ready(function(){
        setTimeout(function(){
        $("div.alert").remove();
        }, 3000 ); // 5 secs
    });

</script>
@endpush