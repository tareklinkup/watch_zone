@extends('layouts.master')
@section('title', 'Terms Conditions And Privacy Policy')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Terms Conditions And Privacy Policy</span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head">
                            <i class="fas fa-edit"></i> Terms Conditions And Privacy Policy
                        </div>
                    </div>
                    
                    <div class="card-body table-card-body">
                        <div class="row">
                            <form method="post" action="{{ route('company.about.update', $about->id) }}" enctype="multipart/form-data">
                                @csrf
                        
    
                                <div class="form-group row">
                                    
                                    <div class="col-sm-6">
                                        <label for="title" class="col-form-label">Privacy Policy</label>
                                        <textarea name="privacy_desc" class="form-control form-control-sm shadow-none" id="editor" rows="4">{{ (@$about) ? @$about->privacy_desc : old('privacy_desc') }}</textarea>
                                        @error('privacy_desc') <span style="color: red">{{$message}}</span> @enderror

                                       
                                    </div>
    
                                    <div class="col-sm-6">
                                        <label for="title" class="col-form-label">Terms & Condition</label>
                                        <textarea name="terms_desc" class="form-control form-control-sm shadow-none" id="editor1" rows="4">{{ (@$about) ? @$about->terms_desc : old('terms_desc') }}</textarea>
                                        @error('phone_one') <span style="color: red">{{$message}}</span> @enderror
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
<script>
    ClassicEditor
        .create(document.querySelector('#editor1'))
        .catch(error => {
            console.error(error);
        });
</script>


@endpush
