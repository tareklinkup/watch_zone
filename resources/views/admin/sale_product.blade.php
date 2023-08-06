@extends('layouts.master')
@section('title', 'Sale All Product List')
@push('admin-css')
    <style>
        .dataTable th,
        td {
            border: 1px solid #000;
            font-size: 13px;
        }
    </style>
@endpush
@section('main-content')

    <main>
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Product</span>

            </div>

            <form action="{{ route('sale.catbybrand.select') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-sm-4">
                        <div class="from-group row">

                            <div class="col-sm-4">
                                <label for="" class=""><strong>Category :</strong> </label>
                            </div>

                            <div class="col-sm-8">
                                <select name="category" class="form-control form-control-sm shadow-none">
                                    <option value="">--Select Category--</option>
                                    @foreach ($category as $categories)
                                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="from-group row">
                            <div class="col-sm-3">
                                <label for="" class=""><strong>Brand :</strong></label>
                            </div>
                            <div class="col-sm-9">
                                <select name="brand" class="form-control form-control-sm shadow-none">
                                    <option value="">--Select Brand--</option>
                                    @foreach ($brand as $brands)
                                        <option value="{{ $brands->id }}">{{ $brands->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="search_btn">Search</button>
                    </div>

                </div>
            </form>

            <form method="POST" action="{{ route('sale.selected') }}">
                @csrf
                <div class="row">
                    <div class="card my-3">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="from-group row">
                                    <div class="col-sm-3">
                                        <label for="" class=""><strong>Product :</strong></label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" id="sale" name="sale" value="">
                                        <label for="sale">Sale</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card my-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i>All Product List</div>

                        </div>

                        <div class="card-body table-card-body">
                            <table class="table text-center dataTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>SL</th>
                                        <th><label for="all_select"> Select All</label> <input type="checkbox"
                                                class="ms-2" name="all_select" type="checkbox" onclick="toggle(this);">
                                        </th>
                                        <th>Name</th>
                                        <th>Model</th>
                                        {{-- <th>Price</th>
                                        <th>Discount</th>
                                        <th>Sale Price</th> --}}
                                        <th>Sale</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr class="">

                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <input class="checkbox" type="checkbox" name="selectedProduct[]"
                                                    id="selectedProduct[]" value="{{$product->id}}" {{  $product->sale == 1 ? "checked" : "" }} />
                                                <input type="hidden" name="product_id[]" id="product_id[]"
                                                    value="{{ $product->id }}">
                                            </td>
                                            <td style="width: 20%">{{ $product->name }}</td>
                                            <td>{{ $product->model }}</td>
                                            <td>
                                                @if ($product->sale == 1)
                                                      Sale
                                                @endif
                                            </td>
                                            <td>{{ optional($product->category)->name }}</td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>


@endpush
