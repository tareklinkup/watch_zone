@extends('layouts.master')
@section('title', 'Brand Material Entry')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Brand Material</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if(@isset($materialData))
                                <i class="fas fa-edit"></i> Brand Material Update
                            @else
                                <i class="fab fa-bandcamp"></i> Brand Material Entry
                            @endif
                        </div>
                        {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form method="post" action="{{ (@$materialData) ? route('material.update', $materialData->id) : route('material.store') }}">
                            @csrf
                            <div class="form-group row mb-1">
                                <label for="category_id" class="col-sm-3 col-form-label">Category <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control form-control-sm shadow-none"
                                        id="category_id">
                                        <option value="">--Select Category--</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" {{ @$materialData->category_id == $item->id ? 'selected' : '' }}> {{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label for="brand_id" class="col-sm-3 col-form-label">Brand <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <select name="brand_id" class="form-control form-control-sm shadow-none"
                                        id="brand_id">
                                        <option value="">--Select Brand--</option>
                                        @foreach ($brand as $item)
                                            <option value="{{ $item->id }}" {{ @$materialData->brand_id == $item->id ? 'selected' : '' }}> {{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">Material Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ (@$materialData) ? @$materialData->name : old('name') }}" class="form-control form-control-sm shadow-none" id="name">
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror
                                </div>
    
                            </div>

                            
                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$materialData)? 'Update change' : 'Save change' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>
            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Material List</div>
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
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($material as $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ optional($item->brand)->name }}</td>
                                        <td>{{ optional($item->category)->name }}</td>
                                        <td>
                                            <a href="{{ route('material.edit', $item->id) }}" class="btn btn-edit shadow-none"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{('/brand/material/delete/'.$item->id) }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete shadow-none"><i class="fa fa-trash"></i></a>
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