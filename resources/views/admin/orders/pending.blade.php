@extends('layouts.master')
@section('title', 'Pending Order')
@section('main-content')

    <main>
        <div class="container-fluid" id="Category">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Pending Order</span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="invoiceContent" class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i> Pending Order List</div>
                            <div class="float-right">

                            </div>
                        </div>
                        <div class="card-body table-card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="datatablesSimple" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Order No</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $item)
                                            <tr class="{{ $item->id }}">
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->order_date }}</td>
                                                <td>{{ $item->customer->name }}</td>
                                                <td>{{ $item->order_number }}</td>
                                                <td>TK. {{ $item->total_amount }}</td>
                                                <td>
                                                    <a href="{{ route('admin.show.order', $item->id) }}"
                                                        title="View Details" class="btn btn-edit shadow-none"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a href="{{ route('admin.pending.to.confirm', $item->id) }}"
                                                        title="Confirm" class="btn btn-edit shadow-none"><i
                                                            class="fas fa-check"></i></a>
                                                    <a href="{{ route('admin.order.print', $item->id) }}" title="Print"
                                                        class="btn btn-delete shadow-none shadow-none"><i
                                                            class="fa fa-print"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <button class="btn btn-sm btn-success float-end" onclick="printDiv('invoiceContent')">Print</button>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
