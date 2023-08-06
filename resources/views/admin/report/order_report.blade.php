@extends('layouts.master')
@section('title', 'Order Report')
@push('admin-css')
<link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
@endpush
@section('main-content')
<main>
    <div class="container-fluid" id="Order">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Order Report</span>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card my-2">
                    <div class="card-body table-card-body">
                        {{-- <form method="post" action="{{ route('order.report') }}" enctype="multipart/form-data">
                            @csrf --}}

                            <div class="form-group row">
                                <label for="date_from" class="col-sm-1 col-form-label">Date From</label>
                                <div class="col-sm-2">
                                    <input type="date" name="date_from" class="form-control shadow-none" value="{{ date("Y-m-d") }}" id="date_from">
                                </div>

                                <label for="date_to" class="col-sm-1 col-form-label">Date To</label>
                                <div class="col-sm-2">
                                    <input type="date" id="date_to" name="date_to" class="form-control shadow-none" value="{{ date("Y-m-d") }}">
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-submit shadow-none" onclick="getOrderReport()">Search</button>
                                </div>
                            </div>
                        {{-- </form>   --}}
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="card my-2">
                <div class="card-header d-flex justify-content-between">
                    <div class="table-head"><i class="fas fa-table me-1"></i> Search Result</div>
                    <div class="float-right">
                    
                    </div>
                </div>
                <div class="card-body table-card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Date</th>
                                    <th>Order No</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="orderReport">
                                @foreach ($orders as $key => $item) 
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date('F j, Y',strtotime($item->order_date)) }}</td>
                                    <td>{{ $item->order_number }}</td>
                                    <td>{{ number_format($item->total_amount, 2)}}</td>
                                    <td>
                                        @if($item->status == 'Cancel')
                                            <span class='badge bg-danger'>{{ $item->status }}</span>
                                        @else
                                            <span class='badge bg-info'>{{ $item->status }}</span>
                                        @endif
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
</main>
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // Get Search Result
    function getOrderReport(){
        let date_from = $('#date_from').val();
        let date_to = $('#date_to').val();
        let date = new Date();
        let format = new Intl.NumberFormat();
        // console.log(date_from);
        $.ajax({
            url: "{{ route('report.get.order') }}",
            method: "GET",
            data: { date_from: date_from, date_to: date_to },
            success: function(res) {
                console.log(res);

                var orderReport = '';
                $.each(res, function(key, value){
                    orderReport += `
                    <tr>
                        <td>${key + 1}</td>
                        <td>${moment(value.created_at, "YYYY-MM-DD").format("MMMM DD, Y") }</td>
                        <td>${value.order_number}</td>
                        <td>${format.format(value.total_amount)}</td>
                        <td><span class='badge bg-info'>${value.status}</span>
                        </td>
                    </tr>
                    `
                });
                $('#orderReport').html(orderReport);
            },
        });
    }
</script>

@endpush