@extends('layouts.master')
@section('title', 'Permission To Role')
@section('main-content')

<main>
    <div class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fa fa-user-plus"></i>  Permission To {{$role->name}}</div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="form-area">
        
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
        
                            @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                        
                            <div class="checkbox select-all">
                                <input id="all" type="checkbox" />
                                <label for="all"><strong>Select all</strong></label>
                            </div>
                         
                            <form id="form" action="{{ route('role.permission.assign', $role->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @foreach($permissions as $p)
                                <div class="row ms-2">
                                    <div class="col-md-12 mb-2 rows">
                                        <input type="checkbox" name="permission[]" id="permission_{{$p->id}}" value="{{$p->id}}" {{in_array($p->id, $role_permissions) ? 'checked' : ''}}>
                                        <label for="permission_{{$p->id}}">{{$p->name}}</label>
                                    </div> 
                                </div>
                                @endforeach
                                
                                <div class="clearfix border-top">
                                    <div class="float-md-right mt-2">
                                        <button type="submit" class="btn btn-submit shadow-none">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</main>
@endsection
@push('scripts')
<script src="{{ asset('js/sweetalert2.all.js') }}"></script>
<script>
  $('#all').change(function(e) {
    if (e.currentTarget.checked) {
    $('.rows').find('input[type="checkbox"]').prop('checked', true);
      } else {
        $('.rows').find('input[type="checkbox"]').prop('checked', false);
     }
  });
</script>
@endpush