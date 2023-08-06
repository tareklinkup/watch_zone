@extends('layouts.master')
@section('title', 'Create New Order')
@push('admin-css')
    <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">

    <style>
        .v-select {
            margin-bottom: 5px;
        }

        .v-select .dropdown-toggle {
            padding: 0px;
        }

        .v-select input[type=search],
        .v-select input[type=search]:focus {
            margin: 0px;
        }

        .v-select .vs__selected-options {
            overflow: hidden;
            flex-wrap: nowrap;
        }

        .v-select .selected-tag {
            margin: 2px 0px;
            white-space: nowrap;
            position: absolute;
            left: 0px;
        }

        .v-select .vs__actions {
            margin-top: -5px;
        }

        .v-select .dropdown-menu {
            width: auto;
            overflow-y: auto;
        }
    </style>
@endpush
@section('main-content')
    <main>
        <div class="container-fluid" id="Category">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Create New Order</span>
            </div>
            <div class="row" id="orders">
                <div class="col-12">
                    <div id="invoiceContent" class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i> Customer Information</div>
                            <div class="float-right">

                            </div>
                        </div>
                        <div class="card-body bg-white border">

                            <div class="row">
                                <div class="col-sm-4">
                                    <h5>Customer Info </h5>
                                    <div class="row form-group">
                                        <Label class="col-sm-4">Customer</Label>
                                        <div class="col-sm-8">
                                            <v-select v-bind:options="customers" label="display_name"
                                                v-model="selectedCustomer"></v-select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-4">
                                    <h5>Billing Information</h5>
                                    <form action="">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control shadow-none" name="name"
                                                    v-model="order.name">
                                            </div>

                                            <label for="" class="col-sm-3">Phone</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control shadow-none" name="phone"
                                                    v-model="order.phone">
                                            </div>

                                            <label for="" class="col-sm-3">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control shadow-none" name="email"
                                                    v-model="order.email">
                                            </div>

                                            <label for="" class="col-sm-3">Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control shadow-none" name="address"
                                                    v-model="order.address">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Shipping Information</h5>
                                    <form action="">
                                        <div class="form-group row">
                                            <label for="" class="col-sm-3">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control shadow-none" name="b_name"
                                                    v-model="order.b_name">
                                            </div>

                                            <label for="" class="col-sm-3">Phone</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control shadow-none" name="b_phone"
                                                    v-model="order.b_phone">
                                            </div>

                                            <label for="" class="col-sm-3">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control shadow-none" name="b_email"
                                                    v-model="order.b_email">
                                            </div>

                                            <label for="" class="col-sm-3">Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control shadow-none" name="b_address"
                                                    v-model="order.b_address">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 mt-3">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="table-head"><i class="fas fa-table me-1"></i> Product Information</div>
                                    <div class="float-right">

                                    </div>
                                </div>



                                <div class="card-body bg-white border ">
                                    <div class="row form-group">
                                        <Label class="col-sm-2">Select Product</Label>
                                        <div class="col-sm-5">
                                            <v-select v-bind:options="products" label="name" v-model="selectedProduct">
                                            </v-select>
                                        </div>
                                        <label class="col-sm-1" for="">Quantity</label>
                                        <div class="col-sm-2">
                                            <input type="number" min="1" class="form-control shadow-none"
                                                v-model="selectedProduct.qty">
                                        </div>
                                        <div class="addbtn text-end col-sm-1">
                                            <button @@click="addToCart" id="add_row"
                                                class="btn btn-success pull-left"> Add </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="display: none" :style="{ display: cart.length > 0 ? '' : 'none' }">
                            <div class="col-sm-12">
                                <div class="card-body table-card-body mt-3">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Item Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(product, ind) in cart" :key="ind">
                                                    <td>@{{ ind + 1 }}</td>
                                                    <td>@{{ product.name }}</td>
                                                    <td>@{{ product.qty }}</td>
                                                    <td>@{{ product.price }}</td>
                                                    <td>@{{ product.total }}</td>
                                                    <td>
                                                        <a href="" v-on:click.prevent="removeFromCart(ind)">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td colspan="4" class="text-end"><strong> Total:</strong></td>
                                                    <td>
                                                        <strong>
                                                            @{{ cart.reduce((prev, curr) => {return prev + parseFloat(curr.total)}, 0) | decimal }}
                                                        </strong>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 text-end mt-3">
                                <button @@click="addOrder" class="btn btn-success pull-left"> Save </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/vue-select.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script>
        Vue.component('v-select', VueSelect.VueSelect);

        const app = new Vue({
            el: '#orders',
            data: {
                order: {
                    name: '',
                    b_name: '',
                    phone: '',
                    b_phone: '',
                    email: '',
                    b_email: '',
                    address: '',
                    b_address: '',
                    customerId: '',
                    total: 0
                },
                products: [],
                selectedProduct: {
                    id: '',
                    name: 'Select Product',
                    qty: 0,
                    selling_price: 0,
                    discount_price: 0
                },
                customers: [],
                selectedCustomer: null,
                cart: []
            },
            watch: {
                selectedCustomer(customer) {
                    if (customer == undefined) return;
                    this.order.name = customer.name;
                    this.order.b_name = customer.b_name;
                    this.order.phone = customer.phone;
                    this.order.b_phone = customer.b_phone;
                    this.order.email = customer.email;
                    this.order.b_email = customer.b_email;
                    this.order.address = customer.address;
                    this.order.b_address = customer.b_address;
                    console.log(customer)
                }
            },
            filters: {
                decimal(value) {
                    return value == null || value == '' ? '0.00' : parseFloat(value).toFixed(2);
                }
            },
            created() {
                this.getCustoemrs()
                this.getProducts();
            },
            methods: {
                getProducts() {
                    axios.post('/get-products')
                        .then(res => {
                            this.products = res.data;
                        })
                },
                getCustoemrs() {
                    axios.get('/get-customers')
                        .then(res => {
                            this.customers = res.data.map(item => {
                                item.display_name = `${item.name} - ${item.phone}`
                                return item;
                            });
                        })
                },
                addToCart() {              

                    let product = {
                        productId: this.selectedProduct.id,
                        name: this.selectedProduct.name,
                        price: (parseFloat(this.selectedProduct.selling_price) - parseFloat(this.selectedProduct
                            .discount_price)).toFixed(2),
                        qty: this.selectedProduct.qty,
                        total: (this.selectedProduct.qty * (parseFloat(this.selectedProduct
                            .selling_price) - parseFloat(this.selectedProduct.discount_price))).toFixed(2)
                    }
                        
                    if (product.productId == '') {
                        alert('Select Product');
                        return;
                    }

                    if (product.qty == 0 || product.qty == '' || product.qty == undefined) {
                        alert('Enter quantity');
                        return;
                    }

                    this.cart.unshift(product);
                    this.clearProduct();
                },
                
                removeFromCart(ind) {
                    this.cart.splice(ind, 1);
                },
                
                addOrder() {
                    if (this.selectedCustomer.id == '') {
                        alert('Select Customer');
                        return;
                    }

                    if (this.cart.length == 0) {
                        alert('Cart is empty');
                        return;
                    }

                    this.order.total = this.cart.reduce((prev, curr) => {
                        return prev + parseFloat(curr.total)
                    }, 0).toFixed(2);

                    let url = "/save_order";

                    this.order.customerId = this.selectedCustomer.id;

                    let data = {
                        order: this.order,
                        cart: this.cart
                    }
                    axios.post(url, data).then(res => {
                        let r = res.data;
                        if (r.success) {
                            alert('Order Save Successfully.');
                            window.location = '/order/create';
                        } else {
                            alert(r.message);
                        }
                    })
                },

                clearProduct() {
                    this.selectedProduct = {
                        id: '',
                        name: 'Select Product',
                        qty: 0,
                        selling_price: 0,
                        discount_price: 0
                    }
                }
            }
        })
    </script>
@endpush
