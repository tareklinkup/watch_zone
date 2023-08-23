@extends('layouts.master')
@section('title', 'Product Create')
@push('admin-css')
    <style>
        .ckeditor {
            margin-bottom: 15px;
            width: 100%;
            clear: both;
        }

        .cke_toolgroup {
            background-image: none;
            border-color: #fff;
            background: #fff;
            box-shadow: none;
        }
    </style>
@endpush
@section('main-content')
    <main>
        <div class="container-fluid" id="Product">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> >
                    Product</span>
            </div>
            <div class="row">

                <div class="col-12">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fab fa-bandcamp"></i> Product Entry</div>
                            <a href="{{ route('products.index') }}" class="btn btn-addnew shadow-none"> <i
                                    class="fa fa-list-alt"></i> Product List</a>
                        </div>

                        <div class="card-body table-card-body">
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Product Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name"
                                                    class="form-control form-control-sm shadow-none"
                                                    value="{{ old('name') }}" id="name" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="model" class="col-sm-3 col-form-label">Model</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="model"
                                                    class="form-control form-control-sm shadow-none" id="model">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="selling_price" class="col-sm-3 col-form-label">Product Price <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="number" step="any" name="selling_price"
                                                    class="form-control form-control-sm shadow-none" id="price"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="discount_price" class="col-sm-3 col-form-label">Discount</label>

                                            <div class="col-sm-5">
                                                <input type="number" step="any" name="discount"
                                                    class="form-control form-control-sm shadow-none" min="0"
                                                    id="Discount" max="99" placeholder="0%" step="any">
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="text" step="any" name="discount_price"
                                                    class="form-control form-control-sm shadow-none" id="result">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="quantity" class="col-sm-3 col-form-label">Quantity <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="number" name="quantity"
                                                    class="form-control form-control-sm shadow-none" id="quantity"
                                                    required>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="resistant" class="col-sm-3 col-form-label">Water Resistance </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="resistant"
                                                    class="form-control form-control-sm shadow-none" id="resistant">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="warranty" class="col-sm-3 col-form-label">Warranty </label>
                                            <div class="col-sm-9">
                                                <input type="text" name="warranty"
                                                    class="form-control form-control-sm shadow-none" id="warranty">
                                            </div>
                                        </div>


                                        <div class="form-group row mb-1">
                                            <label for="category_id" class="col-sm-3 col-form-label">Category <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="category_id" class="form-control form-control-sm shadow-none"
                                                    id="category_id">
                                                    <option value="">--Select Category--</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-1" id="brandId">
                                            <label for="brand_id" class="col-sm-3 col-form-label">Brand <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="brand_id" class="form-control form-control-sm shadow-none"
                                                    id="brand_id">
                                                    <option value="">--Select Brand--</option>
                                                    @foreach ($brand as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <!------------- start Serialization------------------------------>
                                        <div class="form-group row mb-1" id="movementId">
                                            <label for="movement_id" class="col-sm-3 col-form-label">Movement </label>
                                            <div class="col-sm-9">
                                                <select name="movement_id"
                                                    class="form-control form-control-sm shadow-none" id="movement_id">
                                                    <option value="">--Select Movement--</option>
                                                    {{-- @foreach ($movement as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-1" id="sizeId">
                                            <label for="size_id" class="col-sm-3 col-form-label">Case Size </label>
                                            <div class="col-sm-9">
                                                <select name="size_id" class="form-control form-control-sm shadow-none"
                                                    id="size_id">
                                                    <option value="">--Select Case Size--</option>
                                                    {{-- @foreach ($size as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-1" id="colorId">
                                            <label for="color_id" class="col-sm-3 col-form-label">Dial Color </label>
                                            <div class="col-sm-9">
                                                <select name="color_id" class="form-control form-control-sm shadow-none"
                                                    id="color_id">
                                                    <option value="">--Select Case Size--</option>
                                                    {{-- @foreach ($color as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-1" id="materialId">
                                            <label for="material_id" class="col-sm-3 col-form-label">Band Material
                                            </label>
                                            <div class="col-sm-9">
                                                <select name="material_id"
                                                    class="form-control form-control-sm shadow-none" id="material_id">
                                                    <option value="">--Select Material--</option>
                                                    {{-- @foreach ($material as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row mb-1" id="seriesId">
                                            <label for="series_id" class="col-sm-3 col-form-label"> Series </label>
                                            <div class="col-sm-9">
                                                <select name="series_id" class="form-control form-control-sm shadow-none"
                                                    id="series_id">
                                                    <option value="">--Select Series--</option>
                                                    {{-- @foreach ($series as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row mb-2">
                                            <label for="short_desc" class="col-sm-3 col-form-label">Short
                                                Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="short_desc" class="form-control form-control-sm shadow-none" id="editor1" rows="5"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Product Image <span
                                                    class="text-danger">*</span> (<small class="text-danger">800 X
                                                    800</small>)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control form-control-sm" id="image" type="file"
                                                    name="image" onchange="readURL(this);">
                                            </div>
                                            <div class="col-sm-3">
                                                <div
                                                    style="width: 80px;height:80px;border: 1px solid #ccc;overflow:hidden;">
                                                    <img class="form-controlo img-thumbnail" src=""
                                                        id="previewImage"
                                                        style="width: 100%; height:100%; background: #3f4a49;">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row my-2">
                                            <label for="" class="col-sm-3 col-form-label">Other Image <span
                                                    class="text-danger">*</span> (<small class="text-danger">800 X
                                                    800</small>)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control form-control-sm" id="otherimage"
                                                    type="file" name="otherimage" onchange="readURL1(this);">

                                            </div>
                                            <div class="col-sm-3">
                                                <div
                                                    style="width: 80px;height:80px;border: 1px solid #ccc;overflow:hidden;">
                                                    <img class="form-controlo img-thumbnail" src=""
                                                        id="previewImage1"
                                                        style="width:100%;height: 100%; background: #3f4a49;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-1">
                                            <label for="" class="col-sm-3 col-form-label">Multi Image(<small
                                                    class="text-danger">800 X
                                                    800</small>)
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="file" name="multiimage[]" multiple
                                                    class="form-control form-control-sm" id="multiimage">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row my-2">
                                            <label for="description" class="col-sm-1 col-form-label">Description</label>
                                            <div class="col-sm-10 ms-5">
                                                <textarea name="description" class="form-control form-control-sm shadow-none" id="editor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- product feature --}}
                                    <div class="form-group row mb-1">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10 ms-5">
                                            <div class="row">

                                                <div class="col-sm-6 my-2">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 style="margin-bottom: 0; font-size:18px;"> Items
                                                                Information </h4>
                                                        </div>
                                                        <div class="card-body border pt-0">
                                                            <table id="item-table">
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="label[]" placeholder="Label" /></td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class='del1'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="label[]" placeholder="Label" /></td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class='del1'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="label[]" placeholder="Label" /></td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class="add1"
                                                                            value="+" title="Add More" /></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 my-2">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 style="margin-bottom: 0; font-size:18px;"> Case Information
                                                            </h4>
                                                        </div>
                                                        <div class="card-body border pt-0">
                                                            <table id="case-table">
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="case_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="case_value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class='del2'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="case_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="case_value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class='del2'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="case_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="case_value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class="add2"
                                                                            value="+" title="Add More" /></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 my-2">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 style="margin-bottom: 0; font-size:18px;"> Dial Information
                                                            </h4>
                                                        </div>
                                                        <div class="card-body border pt-0">
                                                            <table id="dail-table">
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="dial_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="dial_value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class='del3'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="dial_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="dial_value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class='del3'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="dial_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="dial_value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class="add3"
                                                                            value="+" title="Add More" /></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 my-2">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 style="margin-bottom: 0; font-size:18px;"> Movement
                                                                Information </h4>
                                                        </div>
                                                        <div class="card-body border pt-0">
                                                            <table id="movement-table">
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="movement_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="movement_value[]" placeholder="Value">
                                                                    </td>
                                                                    <td><input type="button" class='del4'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="movement_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="movement_value[]" placeholder="Value">
                                                                    </td>
                                                                    <td><input type="button" class='del4'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="movement_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="movement_value[]" placeholder="Value">
                                                                    </td>
                                                                    <td><input type="button" class="add4"
                                                                            value="+" title="Add More" /></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 my-2">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 style="margin-bottom: 0; font-size:18px;"> Band Information
                                                            </h4>
                                                        </div>
                                                        <div class="card-body border pt-0">
                                                            <table id="brand-table">
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="band_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="band_value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class='del5'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="band_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="band_value[]" placeholder="Value"></td>
                                                                    <td><input type="button" class='del5'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="band_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="movement_value[]" placeholder="Value">
                                                                    </td>
                                                                    <td><input type="button" class="add5"
                                                                            value="+" title="Add More" /></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 my-2">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 style="margin-bottom: 0; font-size:18px;">Additional
                                                                Information</h4>
                                                        </div>
                                                        <div class="card-body border pt-0">
                                                            <table id="additional-table">
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="addition_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="addition_value[]" placeholder="Value">
                                                                    </td>
                                                                    <td><input type="button" class='del6'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="addition_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="addition_value[]" placeholder="Value">
                                                                    </td>
                                                                    <td><input type="button" class='del6'
                                                                            value='-' title="Delete" /></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input
                                                                            type="text"class="form-control form-control-sm shadow-none"
                                                                            name="addition_label[]" placeholder="Label" />
                                                                    </td>
                                                                    <td><input type="text"
                                                                            class="form-control form-control-sm shadow-none"
                                                                            name="addition_value[]" placeholder="Value">
                                                                    </td>
                                                                    <td><input type="button" class="add6"
                                                                            value="+" title="Add More" /></td>
                                                                </tr>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 my-2">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 style="margin-bottom: 0; font-size:18px;"> SEO Information
                                                            </h4>
                                                        </div>

                                                        <div class="card-body border pt-2">
                                                            <div class="form-group row">
                                                                <label for="meta_title"
                                                                    class="col-sm-3 col-form-label">Meta
                                                                    Title</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="meta_title"
                                                                        class="form-control form-control-sm shadow-none"
                                                                        id="meta_title">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="meta_description"
                                                                    class="col-sm-3 col-form-label">Meta
                                                                    Description</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="meta_description"
                                                                        class="form-control form-control-sm shadow-none"
                                                                        id="meta_description">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="meta-keywords"
                                                                    class="col-sm-3 col-form-label">Meta
                                                                    Keywords</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="meta_keywords"
                                                                        class="form-control form-control-sm shadow-none"
                                                                        id="meta-keywords">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- product feature --}}


                                </div>
                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                        <button type="submit" class="btn btn-success">Save
                                            Product</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </main>
@endsection

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $("#brand_id").on('change', function() {

            var brand_id = $(this).val();
            var category_id = $('#category_id').val();

            var data = {
                brand_id: brand_id,
                category_id: category_id
            };

            $.ajax({
                method: "POST",
                url: "{{ url('series-get') }}",
                dataType: "json",
                data: data,
                success: function(res) {
                    $('#series_id').empty();
                    $.each(res, function(key, value) {
                        $('#series_id').append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });
                }
            });

        });
    </script>

    <script>
        $("#brand_id").on('change', function() {

            var brand_id = $(this).val();
            var category_id = $('#category_id').val();

            var data = {
                brand_id: brand_id,
                category_id: category_id
            };

            $.ajax({
                type: "POST",
                url: "{{ url('material-get') }}",
                dataType: "json",
                data: data,
                success: function(res) {
                    $('#material_id').empty();
                    $.each(res, function(key, value) {
                        $('#material_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });

        });
    </script>

    <script>
        $("#category_id").on('change', function() {

            var category_id = $(this).val();


            console.log(category_id);

            if (category_id == 1 || category_id == 2) {
                $("#movementId").show();
                $("#colorId").show();
                $("#sizeId").show();
                $("#materialId").show();
                $("#seriesId").show();
            } else {
                $("#movementId").hide();
                $("#colorId").hide();
                $("#sizeId").hide();
                $("#materialId").hide();
                $("#seriesId").hide();
            }

        });
    </script>
    <script>
        $("#brand_id").on('change', function() {

            var brand_id = $(this).val();
            var category_id = $('#category_id').val();

            var data = {
                brand_id: brand_id,
                category_id: category_id
            };
            $.ajax({
                type: "POST",
                url: "{{ url('dial/color-get') }}",
                dataType: "json",
                data: data,
                success: function(res) {
                    $('#color_id').empty();
                    $.each(res, function(key, value) {
                        $('#color_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });

        });
    </script>
    <script>
        $("#brand_id").on('change', function() {

            var brand_id = $(this).val();
            var category_id = $('#category_id').val();

            var data = {
                brand_id: brand_id,
                category_id: category_id
            };

            $.ajax({
                type: "POST",
                url: "{{ url('size-get') }}",
                dataType: "json",
                data: data,
                success: function(res) {
                    $('#size_id').empty();
                    $.each(res, function(key, value) {
                        $('#size_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });

        });
    </script>
    <script>
        $("#brand_id").on('change', function() {

            var brand_id = $(this).val();
            var category_id = $('#category_id').val();

            var data = {
                brand_id: brand_id,
                category_id: category_id
            };

            $.ajax({
                type: "POST",
                url: "{{ url('movement-get') }}",
                dataType: "json",
                data: data,
                success: function(res) {
                    $('#movement_id').empty();
                    $.each(res, function(key, value) {
                        $('#movement_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });

        });
    </script>

    <script>
        $('#item-table').on('click', '.del1', function() {
            $(this).parent().parent().remove();

        });

        $('#item-table').on('click', '.add1', function() {
            $(this).val('-');
            $(this).attr('class', 'del1');
            var appendTxt =
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='value[]' placeholder='Value'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='value[]' placeholder='Value'></td> <td><input type='button' class='add1' title='Add More' value='+' /></td></tr>";
            $("#item-table tr:last").after(appendTxt);

        });
    </script>
    <script>
        $('#case-table').on('click', '.del2', function() {
            $(this).parent().parent().remove();

        });

        $('#case-table').on('click', '.add2', function() {
            $(this).val('-');
            $(this).attr('class', 'del2');
            var appendTxt =
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='case_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='case_value[]' placeholder='Value'></td> <td><input type='button' class='add2' title='Add More' value='+' /></td></tr>";
            $("#case-table tr:last").after(appendTxt);

        });
    </script>
    <script>
        $('#dail-table').on('click', '.del3', function() {
            $(this).parent().parent().remove();

        });

        $('#dail-table').on('click', '.add3', function() {
            $(this).val('-');
            $(this).attr('class', 'del3');
            var appendTxt =
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='dial_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='dial_value[]' placeholder='Value'></td> <td><input type='button' class='add3' title='Add More' value='+' /></td></tr>";
            $("#dail-table tr:last").after(appendTxt);

        });
    </script>
    <script>
        $('#movement-table').on('click', '.del4', function() {
            $(this).parent().parent().remove();

        });

        $('#movement-table').on('click', '.add4', function() {
            $(this).val('-');
            $(this).attr('class', 'del4');
            var appendTxt =
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='movement_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='movement_value[]' placeholder='Value'></td> <td><input type='button' class='add4' title='Add More' value='+' /></td></tr>";
            $("#movement-table tr:last").after(appendTxt);

        });
    </script>
    <script>
        $('#brand-table').on('click', '.del5', function() {
            $(this).parent().parent().remove();

        });

        $('#brand-table').on('click', '.add5', function() {
            $(this).val('-');
            $(this).attr('class', 'del5');
            var appendTxt =
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='band_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='band_value[]' placeholder='Value'></td> <td><input type='button' class='add5' title='Add More' value='+' /></td></tr>";
            $("#brand-table tr:last").after(appendTxt);

        });
    </script>
    <script>
        $('#additional-table').on('click', '.del6', function() {
            $(this).parent().parent().remove();

        });

        $('#additional-table').on('click', '.add6', function() {
            $(this).val('-');
            $(this).attr('class', 'del6');
            var appendTxt =
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='addition_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='addition_value[]' placeholder='Value'></td> <td><input type='button' class='add6' title='Add More' value='+' /></td></tr>";
            $("#additional-table tr:last").after(appendTxt);

        });
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById("previewImage").src = "/uploads/no.png";
    </script>
    <script>
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage1')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById("previewImage1").src = "/uploads/no.png";
    </script>
    <script>
        // multiple image
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#multiimage").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "<br/><span class=\"remove\">Remove</span>" +
                                "</span>").insertAfter("#multiimage");
                            $(".remove").click(function() {
                                $(this).parent(".pip").remove();
                            });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>

    <script>
        $(document).on("change keyup blur", "#Discount", function() {
            var price = $('#price').val();
            var disc = $('#Discount').val();

            var dec = "";
            if (isNaN(price) || isNaN(disc)) {
                dec = 0;
            } else {
                var dec = (disc / 100).toFixed(2);
                var mult = price * dec;
                var discont = price - mult;
            }

            $('#result').val(parseFloat(mult).toFixed(2));
        });

        $(document).on("change keyup blur", "#result", function() {
            var price = $('#price').val();
            var discp = $('#result').val();

            var dec = "";
            if (isNaN(price) || isNaN(discp)) {
                dec = 0;
            } else {
                var mult = ((discp / price) * 100).toFixed(2);
                var discont = price - mult;
            }

            $('#Discount').val(parseFloat(mult).toFixed(2));
        });
    </script>
@endpush
