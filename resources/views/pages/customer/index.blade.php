@extends('layouts.web_master')
@section('title', 'Customer Dashboard')
@section('website-content')

    <main class="main-content">
        <!--== Start Page Header Area Wrapper ==-->
        <div class="page-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="page-header-content">
                            {{-- <h2 class="page-header-title">My Account</h2> --}}
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home //</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Account</li>
                            </ol>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
        <!--== End Page Header Area Wrapper ==-->

        <!--== Start My Account Wrapper ==-->
        <div class="account-area section-space">
            <div class="container">
                <div class="myaccount-page-wrapper">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <nav class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="myaccount-nav-link active" id="dashboad-tab" data-bs-toggle="tab"
                                    data-bs-target="#dashboad" type="button" role="tab" aria-controls="dashboad"
                                    aria-selected="true">Dashboard</button>
                                <button class="myaccount-nav-link" id="orders-tab" data-bs-toggle="tab"
                                    data-bs-target="#orders" type="button" role="tab" aria-controls="orders"
                                    aria-selected="false"> Orders</button>
                                <button class="myaccount-nav-link" id="payment-method-tab" data-bs-toggle="tab"
                                    data-bs-target="#payment-method" type="button" role="tab"
                                    aria-controls="payment-method" aria-selected="false">Payment Method</button>
                                <button class="myaccount-nav-link" id="address-edit-tab" data-bs-toggle="tab"
                                    data-bs-target="#address-edit" type="button" role="tab"
                                    aria-controls="address-edit" aria-selected="false">address</button>
                                <button class="myaccount-nav-link" id="account-info-tab" data-bs-toggle="tab"
                                    data-bs-target="#account-info" type="button" role="tab"
                                    aria-controls="account-info" aria-selected="false">Account Details</button>
                                <a class="myaccount-nav-link" href="{{ route('customer.logout') }}">Logout</a>
                            </nav>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel"
                                    aria-labelledby="dashboad-tab">
                                    <div class="myaccount-content">
                                        <h3>Dashboard</h3>
                                        <div class="welcome">
                                            <p>Hello, <strong>{{ Auth::guard('customer')->user()->name }}</strong> Welcome to our Website.</p>
                                        </div>
                                        <p class="mb-0">From your account dashboard. you can easily check & view your
                                            recent orders, manage your shipping and billing addresses and edit your password
                                            and account details.</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>
                                        <table class="myaccount-table table-responsive text-center table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Date</th>
                                                    <th>Order No</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $key=> $item)
                                                    
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{ date('F j, Y',strtotime($item->order_date)) }}</td>
                                                    <td>{{ $item->order_number }}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td><span class="color">&#2547; {{ number_format($item->total_amount, 2) }}</span></td>
                                                   
                                                    <td><a href="{{ route('customer.order.show', $item->id) }}"
                                                            class="check-btn sqr_btn_eye " title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                            @if ($item->status == 'Delivered')
                                                            <a href="{{ route('customer.order.print', $item->id) }}"
                                                                class="check-btn sqr-btn " title="canceled Order"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                                @else
                                                                <a href="{{ route('customer.canceled', $item->id) }}"
                                                                    class="check-btn sqr-btn " title="canceled Order"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                                
                                                            @endif
                                                        </td>
                                                </tr>
                                                @endforeach
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="payment-method" role="tabpanel"
                                    aria-labelledby="payment-method-tab">
                                    <div class="myaccount-content">
                                        <h3>Payment Method</h3>
                                        <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address-edit" role="tabpanel"
                                    aria-labelledby="address-edit-tab">
                                    <div class="myaccount-content">
                                        <h3> Address</h3>
                                        <address>
                                            <p><strong>{{ Auth::guard('customer')->user()->name }}</strong></p>
                                            <p>{{ Auth::guard('customer')->user()->phone }}</p>
                                            <p>{{ Auth::guard('customer')->user()->email }}</p>
                                            <p>{{ Auth::guard('customer')->user()->address }}</p>
                                        </address>
                                       
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-info" role="tabpanel"
                                    aria-labelledby="account-info-tab">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>
                                        <form class="account-details-form mt-4" action="{{ route('customer.address.update', Auth::guard('customer')->user()->id) }}" method="POST">
                                            @csrf

                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        
                                                        <label for="name" class="required"> Name</label>
                                                        <input type="text" name="name"
                                                            value="{{ Auth::guard('customer')->user()->name }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="last-name" class="required">Email</label>
                                                        <input type="email" id="email" name="email"
                                                            value="{{ Auth::guard('customer')->user()->email }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="last-name" class="required">Phone</label>
                                                        <input type="number" id="phone" name="phone"
                                                            value="{{ Auth::guard('customer')->user()->phone }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="single-input-item">
                                                        <label for="address" class="required">Address</label>
                                                        <input type="text" id="phone" name="address"
                                                            value="{{ Auth::guard('customer')->user()->address }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="single-input-item">
                                                <button class="check-btn sqr-btn" type="submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End My Account Wrapper ==-->

    </main>



  

@endsection

@push('website-js')
    <script>
        $(document).ready(function() {
            $('#country').select2();
            $('#district').select2();
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage')
                        .attr('src', e.target.result)
                        .width(100);

                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        document.getElementById("previewImage").src =
            "{{ Auth::guard('customer')->user()->image ? Auth::guard('customer')->user()->image : '/noimage.png' }} ";
    </script>
@endpush
