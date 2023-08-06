@extends('layouts.master')
@section('title', 'Coupon Entry')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Coupon</span>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            @if(@isset($couponData))
                                <i class="fas fa-edit"></i> Coupon Update
                            @else
                                <i class="fab fa-bandcamp"></i> Coupon Entry
                            @endif
                        </div>
                        {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                    </div>
                    
                    <div class="card-body table-card-body">
                        <form method="post" action="{{ (@$couponData) ? route('admin.coupon.update', $couponData->id) : route('admin.coupon.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">Coupon Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="coupon_name" value="{{ @$couponData->coupon_name }}" class="form-control form-control-sm shadow-none" id="coupon_name">
                                    @error('coupon_name') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">Discount (%)</label>
                                <div class="col-sm-9">
                                    <input type="text" name="coupon_discount" value="{{ @$couponData->coupon_discount }}" class="form-control form-control-sm shadow-none" min='1' max='99'>
                                    @error('coupon_discount') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">Coupon Value</label>
                                <div class="col-sm-9">
                                    <input type="text" name="coupon_value" value="{{ @$couponData->coupon_value }}" class="form-control form-control-sm shadow-none">
                                    @error('coupon_value') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label">Validity Date</label>
                                <div class="col-sm-9">
                                    <input type="date" name="coupon_validity" value="{{ @$couponData->coupon_validity }}" class="form-control form-control-sm shadow-none" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                    @error('coupon_validity') <span style="color: red">{{$message}}</span> @enderror
                                </div>
                            </div>

                            <hr class="my-2">
                            <div class="clearfix">
                                <div class="text-end m-auto">
                                    <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                    <button type="submit" class="btn btn-success shadow-none">{{ (@$couponData)? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>  
            </div>
            <div class="col-lg-7">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Coupon List</div>
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
                                        <th>Discount</th>
                                        <th>Amount</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->coupon_name }}</td>
                                        <td>{{ $item->coupon_discount }}%</td>
                                        <td>{{ number_format($item->coupon_value, 2) }}</td>
                                        <td>
                                            {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}
                                        </td>
                                        <td>
                                            @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                                <span class="badge bg-success">Valid</span>
                                            @else
                                                <span class="badge bg-danger">Invalid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.coupon.edit', $item->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ route('admin.coupon.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete"><i class="fa fa-trash"></i></a>
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
