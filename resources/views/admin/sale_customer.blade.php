@extends('layouts.master')
@section('title', 'Sale Service')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Sale Service</span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            <i class="fas fa-edit"></i> Sale Service
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <div class="row">
                            <form method="post" action="{{ route('sale.update', $sale->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    
                                    <div class="col-sm-12">
                                        <label for="title" class="col-form-label">Sale Service</label>
                                        <textarea name="customer_service" class="form-control form-control-sm shadow-none" id="editor" rows="4">{{ (@$sale) ? @$sale->customer_service : old('customer_service') }}</textarea>
                                        @error('customer_service') <span style="color: red">{{$message}}</span> @enderror

                                       
                                    </div>
    
                                </div>
                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                        <button type="submit" class="btn btn-success shadow-none">Update</button>
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

<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>



@endpush
