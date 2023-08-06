@extends('layouts.master')
@section('title', 'Order Details')
@section('main-content')


<main>
    <div class="container-fluid" id="Category">
        <div class="heading-title p-2 my-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('dashboard')}}">Home</a> > Order Details</span>
        </div>
        <div class="row">
            <div class="col-md-6">
                {{-- <ul class="list-group">
                    <li class="list-group-item active text-center">Shipping Information</li>
                    <li class="list-group-item">
                        <strong>Name:</strong> {{ $order->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Phone:</strong>
                        {{ $order->phone }}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong>
                        {{ $order->email }}
                    </li>
                    <li class="list-group-item">
                        <strong>Division:</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>District:</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>State:</strong>
                        
                    </li>
    
                        <li class="list-group-item">
                            <strong>Post Code:</strong>
                            {{ $order->post_code }}
                        </li>
                    <li class="list-group-item">
                        <strong>Order Date:</strong>
                        {{ $order->order_date }}
                    </li>
                </ul> --}}
                <ul class="list-group">
                    <li class="list-group-item bg-success text-center text-white"> <b>Shipping Information</b> </li>
                    <li class="list-group-item">
                        <strong>Name:</strong> {{ $order->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Phone:</strong>
                        {{ $order->phone }}
                    </li>
                    <li class="list-group-item">
                        <strong>Email:</strong>
                        {{ $order->email }}
                    </li>
                    <li class="list-group-item">
                        <strong>Address:</strong>
                        {{ $order->address }}
                    </li>

                    <li class="list-group-item">
                        <strong>Order Date:</strong>
                        {{ $order->order_date }}
                    </li>
                    <li class="list-group-item">
                        <strong>Order Number :</strong>
                        {{ $order->order_number }}
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item bg-success text-center text-white"><b>Order Information</b> </li>
                    <li class="list-group-item">
                        <strong>Name:</strong> {{ $order->customer->name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Phone:</strong>
                        {{ $order->phone }}
                    </li>
                    <li class="list-group-item">
                        <strong>Payment Type:</strong>
                        {{ $order->payment_type }}
                    </li>
                    <li class="list-group-item">
                        <strong>Order Total:</strong>
                        Tk {{ number_format($order->total_amount, 2) }}
                    </li>
    
                    <li class="list-group-item">
                        <strong>Order Status:</strong>
                        <span class="badge bg-primary">{{ $order->status }}</span>
                    </li>
    
                    <li class="list-group-item">
                        @if($order->status == 'Pending')
                            <a href="{{ route('admin.pending.to.confirm', $order->id) }}" class="btn btn-block btn-success shadow-none px-2 py-1" id="confirm" data-token="{{csrf_token()}}" data-id="{{$order->id}}">Confirm Order</a>
                            <a href="{{ route('admin.pending.to.canceled', $order->id) }}" class="btn btn-block btn-danger shadow-none px-2 py-1" id="cancel">Cancel Order</a>
                        @elseif($order->status == 'Confirm')
                            <a href="{{ route('admin.confirm.to.processing', $order->id) }}" class="btn btn-block btn-danger shadow-none px-2 py-1" id="processing">Processing</a>
                    @elseif($order->status == 'Processing')
                            <a href="{{ route('admin.processing.to.delivered', $order->id) }}" class="btn btn-block btn-danger shadow-none px-2 py-1" id="order">Delivery</a>
                        @elseif($order->status == "Delivered")
                            <a href="{{ route('admin.delivered.to.canceled', $order->id) }}" class="btn btn-block btn-danger shadow-none px-2 py-1" id="order">Cancel Delivery</a>
                        @endif
                    </li>
    
                </ul>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                  <tbody>
                          <tr style="background: #E9EBEC;">
                              <td>
                                  <label for="">Image</label>
                              </td>
                              <td>
                              <label for="">Poduct Name</label>
                              </td>
    
                              {{-- <td>
                                  <label for="">Order Code</label>
                              </td> --}}
    
                              <td>
                                  <label for="">Quantity</label>
                              </td>
                              <td>
                                  <label for="">Price</label>
                              </td>
                              {{-- <td>
                                <label for="">Color</label>
                              </td> --}}
                              {{-- <td>
                                <label for="">Size</label>
                              </td> --}}
                              
                              <td>
                                  <label for="">Sub Total</label>
                              </td>
    
                          </tr>
    
                       @foreach ($orderItem as $item)
                          <tr>
                              <td><img src="{{ asset('/uploads/product/'.$item->product->image) }}" height="50px;" width="50px;" alt="imga"></td>
                              <td>
                                  <div class="product-name">{{$item->product->name }}
                                  </div>
                              </td>
    
                              {{-- <td>{{ $item->order->order_number }}</td>  --}}
    
                              <td>{{ $item->quantity }}</td>
    
                              <td>TK.{{ number_format($item->price, 2) }}</td>
                              {{-- <td>{{ $item->color->name ?? 0 }}</td>
                              <td>{{ $item->size->name ?? 0 }}</td> --}}
                              
                              <td>TK.{{ number_format($item->price * $item->quantity, 2) }}</td>
                          </tr>
                       @endforeach
                       <tr>
                            <td colspan="4" class="text-end"><strong>Sub Total :</strong> </td>
                            <td>{{ $order->amount }}</td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-end"><strong>Shipping Charge :</strong> </td>
                            <td>{{ $order->ship_charge }}</td>
                       </tr>

                       <tr>
                            <td colspan="4" class="text-end"><strong>Coupon Discount :</strong> </td>
                            <td>
                                @if ($order->couponDiscount > 0)
                                    {{ $order->couponDiscount }}
                                @else
                                    ---
                                @endif
                            </td>
                       </tr>
                       <tr>
                            <td colspan="4" class="text-end"><strong>Total Amount :</strong> </td>
                            <td>TK.{{ $order->total_amount }} /-</td>
                       </tr>
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
</main>
@endsection
{{-- @push('scripts')
    <script>
        window.print();
    </script>
@endpush --}}

