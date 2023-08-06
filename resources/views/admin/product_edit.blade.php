@extends('layouts.master')
@section('title', 'Product Update')
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
                            <div class="table-head"><i class="fab fa-bandcamp"></i> Product Update</div>
                            <a href="{{ route('products.index') }}" class="btn btn-addnew shadow-none"> <i
                                    class="fa fa-list-alt"></i> Product List</a>
                        </div>

                        <div class="card-body table-card-body">
                            <form id="productUpdate" action="{{ route('product.update', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Product Name <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name"
                                                    class="form-control form-control-sm shadow-none"
                                                    value="{{ $product->name }}" id="name" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="model" class="col-sm-3 col-form-label">Model</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="model"
                                                    class="form-control form-control-sm shadow-none"
                                                    value="{{ $product->model }}" id="model">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="selling_price" class="col-sm-3 col-form-label">Product Price <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="selling_price"
                                                    class="form-control form-control-sm shadow-none"
                                                    value="{{ $product->selling_price }}" id="price" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="discount_price" class="col-sm-3 col-form-label">Discount</label>
                                            @php
                                                $discountAmount = $product->selling_price - $product->discount_price;
                                                $discountPercent = (100 / $product->selling_price) * $product->discount_price;
                                            @endphp
                                            <div class="col-sm-5">
                                                <input type="number" name="discount"
                                                    class="form-control form-control-sm shadow-none" min="0"
                                                    id="Discount" max="99" placeholder="0%"
                                                    value="{{ $discountPercent }}" step="any">
                                            </div>

                                            <div class="col-sm-4">
                                                <input type="text" name="discount_price" value="{{ $product->discount_price }}"
                                                    class="form-control form-control-sm shadow-none" id="result">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="quantity" class="col-sm-3 col-form-label">Quantity <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="quantity"
                                                    class="form-control form-control-sm shadow-none"
                                                    value="{{ $product->quantity }}" id="quantity"
                                                    v-bind:readonly="sizecart.length > 0" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="resistant" class="col-sm-3 col-form-label">Water Resistance <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="resistant"
                                                    class="form-control form-control-sm shadow-none"
                                                    value="{{ $product->resistant }}" id="resistant" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="warranty" class="col-sm-3 col-form-label">Warranty <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="warranty"
                                                    class="form-control form-control-sm shadow-none"
                                                    value="{{ $product->warranty }}" id="warranty" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="category_id" class="col-sm-3 col-form-label">Category <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="category_id"
                                                    class="form-control form-control-sm shadow-none" id="category_id">
                                                    <option value="">--Select Category--</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $product->category_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
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
                                                        <option value="{{ $item->id }}"
                                                            {{ $product->brand_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row mb-1">
                                            <label for="series_id" class="col-sm-3 col-form-label">Series <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="series_id" class="form-control form-control-sm shadow-none"
                                                    id="series_id">
                                                    <option value="">--Select Series--</option>
                                                    @foreach ($series as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $product->series_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="material_id" class="col-sm-3 col-form-label">Brand Material <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="material_id"
                                                    class="form-control form-control-sm shadow-none" id="material_id">
                                                    <option value="">--Select Material--</option>
                                                    @foreach ($material as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $product->material_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="size_id" class="col-sm-3 col-form-label">Case Size <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="size_id" class="form-control form-control-sm shadow-none"
                                                    id="size_id">
                                                    <option value="">--Select Case Size--</option>
                                                    @foreach ($size as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $product->size_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="color_id" class="col-sm-3 col-form-label">Dial Color <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="color_id" class="form-control form-control-sm shadow-none"
                                                    id="color_id">
                                                    <option value="">--Select Case Size--</option>
                                                    @foreach ($color as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $product->color_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label for="movement_id" class="col-sm-3 col-form-label">Movement <span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select name="movement_id"
                                                    class="form-control form-control-sm shadow-none" id="movement_id">
                                                    <option value="">--Select Movement--</option>
                                                    @foreach ($movement as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $product->movement_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-group row mb-2">
                                            <label for="short_desc" class="col-sm-3 col-form-label">Short
                                                Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="short_desc" class="form-control form-control-sm shadow-none" id="editor1" rows="2">{{ $product->short_desc }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Product Image <span
                                                    class="text-danger">*</span> (<small class="text-danger">800 X
                                                    800 px</small>)</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" id="image" type="file"
                                                    name="image" onchange="readURL(this);">
                                                <div
                                                    style="width: 80px;height:80px;border: 1px solid #ccc;overflow:hidden;">
                                                    <img class="form-controlo img-thumbnail" src=""
                                                        id="previewImage"
                                                        style="width: 100%;height: 100%; background: #3f4a49;">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3 col-form-label">Other Image <span
                                                    class="text-danger">*</span> (<small class="text-danger">800 X
                                                    800 px</small>)</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-sm" id="image" type="file"
                                                    name="otherimage" onchange="readURL1(this);">
                                                <div
                                                    style="width: 80px;height:80px;border: 1px solid #ccc;overflow:hidden;">
                                                    <img class="form-controlo img-thumbnail" src=""
                                                        id="previewImage1"
                                                        style="width: 100%;height: 100%; background: #3f4a49;">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row mt-1">
                                            <label for="" class="col-sm-3 col-form-label">Multi Image (<small class="text-danger">800 X
                                                800</small>)
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="file" name="multiimage[]" multiple
                                                    class="form-control form-control-sm" id="multiimage">
                                                <div class="multi-image-box">
                                                    @foreach ($product->productImage as $item)
                                                        <span class="pip">
                                                            <img src="{{ asset($item->multiimage) }}" class="imageThumb"
                                                                data-image_id="{{ $item->id }}" alt="">
                                                            <span class="close-btn remove"
                                                                data-image_id="{{ $item->id }}">
                                                                remove
                                                            </span>
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row my-2">
                                            <label for="description" class="col-sm-1 col-form-label">Description</label>
                                            <div class="col-sm-10 ms-5">
                                                <textarea name="description" class="form-control form-control-sm shadow-none" id="editor">{{ $product->description }}</textarea>
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

                                                                @foreach ($productItem as $item)
                                                                    <tr>
                                                                        <td><input
                                                                                type="text"class="form-control form-control-sm shadow-none"
                                                                                name="label[]"
                                                                                value="{{ $item->label }}"
                                                                                placeholder="Label" /></td>
                                                                        <td><input type="text"
                                                                                class="form-control form-control-sm shadow-none"
                                                                                name="value[]"
                                                                                value="{{ $item->value }}"
                                                                                placeholder="Value"></td>

                                                                        <td>
                                                                            <input type="button" class='del1'
                                                                                value='-' title="Delete" />
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
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

                                                                @foreach ($productCase as $item)
                                                                    <tr>
                                                                        <td><input
                                                                                type="text"class="form-control form-control-sm shadow-none"
                                                                                name="case_label[]"
                                                                                value="{{ $item->case_label }}"
                                                                                placeholder="Label" /></td>
                                                                        <td><input type="text"
                                                                                class="form-control form-control-sm shadow-none"
                                                                                name="case_value[]"
                                                                                value="{{ $item->case_value }}"
                                                                                placeholder="Value"></td>
                                                                        <td> <input type="button" class='del2'
                                                                                value='-' title="Delete" /></td>

                                                                    </tr>
                                                                @endforeach
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


                                                                @foreach ($productDail as $item)
                                                                    <tr>
                                                                        <td><input
                                                                                type="text"class="form-control form-control-sm shadow-none"
                                                                                name="dial_label[]"
                                                                                value="{{ $item->dial_label }}"
                                                                                placeholder="Label" /></td>
                                                                        <td><input type="text"
                                                                                class="form-control form-control-sm shadow-none"
                                                                                name="dial_value[]"
                                                                                value="{{ $item->dial_value }}"
                                                                                placeholder="Value"></td>
                                                                        <td><input type="button" class='del3'
                                                                                value='-' title="Delete" /></td>
                                                                    </tr>
                                                                @endforeach
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


                                                                @foreach ($productMovement as $item)
                                                                    <tr>
                                                                        <td><input
                                                                                type="text"class="form-control form-control-sm shadow-none"
                                                                                name="movement_label[]"
                                                                                value="{{ $item->movement_label }}"
                                                                                placeholder="Label" /></td>
                                                                        <td><input type="text"
                                                                                class="form-control form-control-sm shadow-none"
                                                                                name="movement_value[]"
                                                                                value="{{ $item->movement_value }}"
                                                                                placeholder="Value"></td>
                                                                        <td><input type="button" class='del4'
                                                                                value='-' title="Delete" /></td>
                                                                    </tr>
                                                                @endforeach
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


                                                                @foreach ($productBand as $item)
                                                                    <tr>
                                                                        <td><input
                                                                                type="text"class="form-control form-control-sm shadow-none"
                                                                                name="band_label[]"
                                                                                value="{{ $item->band_label }}"
                                                                                placeholder="Label" /></td>
                                                                        <td><input type="text"
                                                                                class="form-control form-control-sm shadow-none"
                                                                                name="band_value[]"
                                                                                value="{{ $item->band_value }}"
                                                                                placeholder="Value"></td>
                                                                        <td><input type="button" class='del5'
                                                                                value='-' title="Delete" /></td>
                                                                    </tr>
                                                                @endforeach
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


                                                                @foreach ($productAddition as $item)
                                                                    <tr>
                                                                        <td><input
                                                                                type="text"class="form-control form-control-sm shadow-none"
                                                                                name="addition_label[]"
                                                                                value="{{ $item->addition_label }}"
                                                                                placeholder="Label" /></td>
                                                                        <td><input type="text"
                                                                                class="form-control form-control-sm shadow-none"
                                                                                name="addition_value[]"
                                                                                value="{{ $item->addition_value }}"
                                                                                placeholder="Value"></td>
                                                                        <td><input type="button" class='del6'
                                                                                value='-' title="Delete" /></td>
                                                                    </tr>
                                                                @endforeach
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
                                            </div>
                                        </div>

                                    </div>
                                    {{-- product feature --}}


                                </div>
                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="submit" class="btn btn-success">Update
                                            Product</button>
                                    </div>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

    <script>
        $("#brand_id").on('change', function() {
            var brand_id = $(this).val();
            $.ajax({
                url: "{{ url('series-get') }}/" + brand_id,
                dataType: "json",
                method: "GET",
                success: function(data) {
                    $('#series_id').empty();
                    $.each(data, function(key, value) {
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
            $.ajax({
                url: "{{ url('material-get') }}/" + brand_id,
                dataType: "json",
                method: "GET",
                success: function(data) {
                    $('#material_id').empty();
                    $.each(data, function(key, value) {
                        $('#material_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });

        });
    </script>
    <script>
        $("#brand_id").on('change', function() {
            var brand_id = $(this).val();
            $.ajax({
                url: "{{ url('dial/color-get') }}/" + brand_id,
                dataType: "json",
                method: "GET",
                success: function(data) {
                    $('#color_id').empty();
                    $.each(data, function(key, value) {
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
            $.ajax({
                url: "{{ url('size-get') }}/" + brand_id,
                dataType: "json",
                method: "GET",
                success: function(data) {
                    $('#size_id').empty();
                    $.each(data, function(key, value) {
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
            $.ajax({
                url: "{{ url('movement-get') }}/" + brand_id,
                dataType: "json",
                method: "GET",
                success: function(data) {
                    $('#movement_id').empty();
                    $.each(data, function(key, value) {
                        $('#movement_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                }
            });

        });
    </script>

    <script>
        $(document).on('click', '.close-btn.remove', function() {
            var productImgId = $(this).attr("data-image_id");

            $.ajax({
                url: "{{ url('delete_product_image') }}/" + productImgId,
                dataType: "json",
                method: "GET",
                success: function(data) {
                    console.log(data)
                    $html = "";
                    if (data.productImage.length > 0) {
                        data.productImage.forEach(item => {
                            $html += `<span class="pip">
                                <img src="${location.origin}/${item.multiimage}" class="imageThumb" data-image_id="${item.id}" alt="">
                                <span class="close-btn remove" data-image_id="${item.id}">
                                    remove
                                </span>
                            </span>`;
                        });
                    }
                    $(".multi-image-box").empty();
                    $(".multi-image-box").append($html);
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
                "<tr><td><input type='text' class='form-control form-control-sm shadow-none' name='label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='value[]' placeholder='Value'></td>  <td><input type='button' class='add1' value='+' title='Add' /></td></tr>";
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
                "<tr><td><input type='text' class='form-control form-control-sm shadow-none' name='case_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none' name='case_value[]' placeholder='Value'></td> <td><input type='button' class='add2' value='+' title='Add' /></td></tr>";
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
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='dial_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='dial_value[]' placeholder='Value'></td><td><input type='button' class='add3' value='+' title='Add' /></td></tr>";
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
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='movement_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='movement_value[]' placeholder='Value'></td><td><input type='button' class='add4' value='+' title='Add' /></td></tr>";
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
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='band_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='band_value[]' placeholder='Value'></td> <td><input type='button' class='add5' value='+' title='Add' /></td></tr>";
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
                "<tr> <td><input type='text' class='form-control form-control-sm shadow-none' name='addition_label[]' placeholder='Label'></td> <td><input type='text' class='form-control form-control-sm shadow-none'name='addition_value[]' placeholder='Value'></td> <td><input type='button' class='add6' value='+' title='Add' /></td></tr>";
            $("#additional-table tr:last").after(appendTxt);

        });
    </script>

    <script>
        // $('#productUpdate').on('submit', (e) => {
        //     e.preventDefault();

        //     var label = $("input[name='label[]']").map(function() {
        //         return $(this).val();
        //     }).get();
        //     var value = $("input[name='value[]']").map(function() {
        //         return $(this).val();
        //     }).get();
        //     let arrLength = label.length;
        // let j = 0;
        // if(arrLength > 0) {
        //     for (let i = 0; i < arrLength; i++) {
        //         const element = label[i];

        //         if(element == null || element == '') {
        //             alert("Item information label can't be null");
        //             break ;
        //         }
        //         if(value[i] == null || value[i] == '') {
        //             console.log(value[i])
        //             alert("Item information value can't be null");
        //             break;
        //         }


        //     }
        // }
        // label.forEach((item, sl)=> {
        //     if(item == null || item == '') {
        //         console.log(item)
        //         alert("Item information label can't be null");
        //     } 
        //     if(value[sl] == null || value[sl] == ''){
        //         console.log(value[sl])
        //         alert("Item information value can't be null");
        //     }
        // })
        // if(i > 0) {
        //     alert("Item information label can't be null");
        //     return ;
        // }
        // if(j > 0) {
        //     alert("Item information value can't be null");
        //     return;
        // }

        //     $('#productUpdate').submit()
        // })
    </script>





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
        document.getElementById("previewImage").src = "{{ asset('uploads/product/' .$product->image) }}";
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
        document.getElementById("previewImage1").src = "{{ asset($product->otherimage) }}";
    </script>



    {{-- <script>
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
                // var dec = (discp * 100).toFixed(2);
                var mult = ((price * discp) / 100).toFixed(2);
                var discont = price - mult;
            }

            $('#Discount').val(parseFloat(mult).toFixed(2));
        });
    </script> --}}


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
                var mult = (((100 / price)  * discp)).toFixed(2);
                var discont = price - mult;
            }

            $('#Discount').val(parseFloat(mult).toFixed(2));
        });
    </script>
@endpush
