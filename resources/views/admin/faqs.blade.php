@extends('layouts.master')
@section('title', 'Faq Entry')
@section('main-content')

    <main>
        <div class="container-fluid" id="Category">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Faq's</span>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head">
                                @if (@isset($faqdata))
                                    <i class="fas fa-edit"></i> Faq's Update
                                @else
                                    <i class="fab fa-bandcamp"></i> Faq's Entry
                                @endif
                            </div>
                            {{-- <a href="" class="btn btn-addnew"> <i class="fa fa-file-alt"></i> view all</a> --}}
                        </div>

                        <div class="card-body table-card-body">
                            <form method="post"
                                action="{{ @$faqdata ? route('faq.update', $faqdata->id) : route('faq.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label">Qustion</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="question" value="{{ @$faqdata->name }}"
                                            class="form-control form-control-sm shadow-none" id="question">
                                        @error('question')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label for="title" class="col-sm-3 col-form-label">Descirption</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" class="form-control form-control-sm shadow-none" id="editor" rows="4">{{ @$faqdata ? @$faqdata->description : old('description') }}</textarea>
                                        @error('description')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>


                                <hr class="my-2">
                                <div class="clearfix">
                                    <div class="text-end m-auto">
                                        <button type="reset" class="btn btn-danger shadow-none">Reset</button>
                                        <button type="submit"
                                            class="btn btn-success shadow-none">{{ @$faqdata ? 'Update change' : 'Save change' }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i> Clients List</div>
                            <div class="float-right">

                            </div>
                        </div>
                        <div class="card-body table-card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="datatablesSimple" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            {{-- <th>Image</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $key => $item)
                                            <tr class="{{ $item->id }}">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <a href="{{ route('faq.edit', $item->id) }}"
                                                        class="btn btn-edit shadow-none"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <a href="{{ route('faq.delete') }}" id="delete"
                                                        data-token="{{ csrf_token() }}" data-id="{{ $item->id }}"
                                                        class="btn btn-delete shadow-none"><i class="fa fa-trash"></i></a>
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
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
