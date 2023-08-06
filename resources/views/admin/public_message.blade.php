@extends('layouts.master')
@section('title', 'Website Visitors')
@section('main-content')

<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Website Visitors</span>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-envelope me-1"></i> Website Visitors</div>
                        <div class="float-right">
                          
                        </div>
                    </div>
                    <div class="card-body table-card-body">

                        <div class="elfsight-app-31425c65-d823-4a7b-8e74-ac59911f2bc3"></div>
                        {{-- <div class="table-responsive">
                            <table class="table table-bordered text-center" id="datatablesSimple" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($message as $key => $item)
                                    <tr class="{{ $item->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->subject }}</td>
                                        <td>{{ Str::limit($item->message, 20) }}</td>
                                        <td>
                                            <a href="#messageModal{{ $item->id }}" class="btn btn-edit edit-category shadow-none" data-bs-toggle="modal"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('message.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$item->id}}" class="btn btn-delete shadow-none"><i class="fa fa-trash"></i></a>

                                            <!-- Message Modal -->
                                            <div class="modal fade" id="messageModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $item->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="text-align: justify">
                                                        {!! $item->message !!}
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- <script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=2c007da29c9de023fb228cce0119a51cab0ed71a'></script>
<script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/1044790/t/0"></script> --}}
@endsection

@push('scripts')

<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>

@endpush