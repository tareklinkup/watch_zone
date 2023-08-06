@extends('layouts.master')
@section('title', 'District Entry')
@section('main-content')
<main>
    <div class="container-fluid" id="">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > District</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if(@isset($districtData))
                                <i class="fas fa-edit"></i> District Update
                            @else
                                <i class="fab fa-bandcamp"></i> District Entry
                            @endif
                        </div>
                        {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form method="post" action="{{ (@$districtData) ? route('district.update', $districtData->id) : route('district.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">District Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ @$districtData->name }}" class="form-control form-control-sm shadow-none" id="name">
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <label for="title" class="col-sm-3 col-form-label">Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" name="amount" value="{{ @$districtData->amount }}" class="form-control form-control-sm shadow-none" id="amount">
                                    @error('amount') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                @if (@$districtData)
                                <label for="title" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control shadow-none form-control-sm">
                                        <option value="0" {{ @$districtData->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        <option value="1" {{ @$districtData->status == 1 ? 'selected' : '' }}>Active</option>
                                    </select>
                                </div>
                                @endif
                                
    
                            </div>

                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$districtData)? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>
            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> District List</div>
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
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($district as $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                               <span class="badge bg-info">Active</span> 
                                            @else
                                                <span class="badge bg-warning">Inactive</span> 
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('district.edit', $item->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                            {{-- <a href="" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete"><i class="fa fa-trash"></i></a> --}}
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

@endpush