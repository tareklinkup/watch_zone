@extends('layouts.master')
@section('title', 'Product List')
@section('main-content')

<main>
    <div class="container-fluid">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Product</span>
            
        </div>
        <div class="row">
            <div class="card my-3">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-table me-1"></i>Product List</div>
                    @can('Product Add')
                    <a href="{{ route('products.create') }}" class="btn btn-addnew shadow-none"> <i class="fa fa-plus-circle"></i> Add Product</a>
                    @endcan
                </div>
                <div class="card-body table-card-body">
                    <table id="datatablesSimple" class="text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount Amount</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                            <tr class="">
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ asset('uploads/product/' .$product->image) }}" width="30" height="30" alt=""></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->selling_price }}</td>
                                {{-- <td>{{}}</td> --}}
                                <td>{{ $product->discount_price }}</td>
                                <td>{{ optional($product->category)->name }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td class="text-center">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-edit"><i class="fas fa-eye"></i></a>
                                    @can('Product Edit')
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                    @endcan
                                    @can('Product Delete')
                                    <a href="{{ route('products.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{ $product->id }}" class="btn btn-delete"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            
        </div>
    </div>
</main>



@endsection

@push('scripts')



<script>
    function mainThambUrl(input){
      if (input.files && input.files[0]) {
        var reader    = new FileReader();
        reader.onload = function(e){
            $('#mainThmb').attr('src',e.target.result).width(80).height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
</script>

<!-- Show multiple image -->  
<script>

    $(document).ready(function(){
     $('#multiimage').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
  
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element
                        $('#showimage').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
  
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
  
</script>



@endpush
