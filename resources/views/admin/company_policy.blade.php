@extends('layouts.master')
@section('title', 'Company Policy')
@section('main-content')

    <main>
        <div class="container-fluid" id="Category">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Company Policy</span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head">
                                <i class="fas fa-edit"></i> Company Policy
                            </div>
                        </div>

                        <div class="card-body table-card-body">
                            <div class="row">
                                <form method="post" action="{{ route('company.policy.update', $com_policy->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">


                                        <div class="col-sm-12">
                                            <label for="title" class="col-form-label"> Fastest Delivery </label>
                                            <textarea name="delivery_desc" class="form-control form-control-sm shadow-none" id="editor1" rows="4">{{ @$com_policy ? @$com_policy->delivery_desc : old('delivery_desc') }}</textarea>
                                            @error('delivery_desc')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="title" class="col-form-label">Warranty Policy</label>
                                            <textarea name="warranty_desc" class="form-control form-control-sm shadow-none" id="editor2" rows="4">{{ @$com_policy ? @$com_policy->warranty_desc : old('warranty_desc') }}</textarea>
                                            @error('warranty_desc')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="title" class="col-form-label"> Physical Store</label>
                                            <textarea name="phycal_desc" class="form-control form-control-sm shadow-none" id="editor" rows="4">{{ @$com_policy ? @$com_policy->phycal_desc : old('phycal_desc') }}</textarea>
                                            @error('phycal_desc')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror


                                        </div>


                                        <div class="col-sm-6">
                                            <label for="title" class="col-form-label">Store Map</label>
                                            <textarea name="map_link" class="form-control form-control-sm shadow-none" rows="4">{{ @$com_policy ? @$com_policy->map_link : old('map_link') }}</textarea>
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
            .then(editor => {
                editor.ui.view.editable.element.style.height = '300px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '300px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '300px';
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
