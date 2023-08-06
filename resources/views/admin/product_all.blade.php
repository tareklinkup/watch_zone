@extends('layouts.master')
@section('title', 'All Product List')
@push('admin-css')
    <style>
        .dataTable th,
        td {
            border: 1px solid #000;
            font-size: 13px;
        }
    </style>

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
    <main id="discountProduct">
        <div class="container-fluid">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Product</span>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="from-group row">

                        <div class="col-sm-4">
                            <label for="" class=""><strong>Category :</strong> </label>
                        </div>
                        <div class="col-sm-8">
                            <v-select v-bind:options="categories" label="name" v-model="selectedCategory"
                                placeholder="Select Category"></v-select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="from-group row">
                        <div class="col-sm-3">
                            <label for="" class=""><strong>Brand :</strong></label>
                        </div>
                        <div class="col-sm-9">
                            <v-select v-bind:options="brands" label="name" v-model="selectedBrand"
                                placeholder="Select Brand"></v-select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <input type="button" class="search_btn" value="Search" v-on:click="getProductFilters"
                       >

                </div>

            </div>

            <form v-on:submit.prevent="updateDiscount">
                @csrf
                <div class="row">
                    <div class="card my-3">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="from-group row">
                                    <div class="col-sm-3">
                                        <label for="" class=""> <strong>Discount</strong> </label>
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="number" class="col-sm-5 form-control form-control-sm shadow-none"
                                            min="0" max="99" placeholder="0%" v-model="discount" required>
                                    </div>

                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary btn-xs pull-right"
                                            v-bind:style="{display: onProgress ? 'none' : ''}"> Update </button>

                                        <button type="button" class="btn btn-primary btn-xs pull-right" disabled
                                            style="display:none" v-bind:style="{display: onProgress ? '' : 'none'}"> Please
                                            Wait .. </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-header d-flex justify-content-between">
                            <div class="table-head"><i class="fas fa-table me-1"></i>Discount Product List</div>
                        </div>

                        <div class="card-body table-card-body" style="display: none"
                            :style="{ display: products.length > 0 ? '' : 'none' }">
                            <table class="table text-center dataTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Select All <input type="checkbox" v-model="selectAll"></th>
                                        <th>Name</th>
                                        <th>Model</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Discount Amount</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(product, ind) in products" :key="ind">
                                        <td>@{{ ind + 1 }}</td>
                                        <td>
                                            <input type="checkbox" v-bind:value="product.id" v-model="checked">
                                        </td>
                                        <td style="width: 20%">@{{ product.name }}</td>
                                        <td>@{{ product.model }}</td>
                                        <td>@{{ product.selling_price }}</td>
                                        <td>@{{ product.discount }} %</td>
                                        <td>@{{ product.discount_price }}</td>
                                        <td>@{{ product.category?.name }}</td>
                                        <td>@{{ product.brand?.name }}</td>
                                        <td>@{{ product.quantity }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body table-card-body" style="display: none"
                            :style="{ display: products.length == 0 ? '' : 'none' }">
                            <h4 class="text-center">No Product Found!</h4>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>


@endsection

@push('scripts')
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/vue-select.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>



    <script>
        Vue.component('v-select', VueSelect.VueSelect);

        const app = new Vue({
            el: '#discountProduct',
            data: {
                discount: 0,
                products: [],
                selectedProduct: {
                    id: '',
                    name: 'Select Product',
                    qty: 0,
                    selling_price: 0,
                    discount_price: 0
                },
                categories: [],
                selectedCategory: [],
                brands: [],
                selectedBrand: [],
                checked: [],
                onProgress: false,
            },
            filters: {
                decimal(value) {
                    return value == null || value == '' ? '0.00' : parseFloat(value).toFixed(2);
                }
            },
            computed: {
                selectAll: {
                    get: function() {
                        return this.products ? this.checked.length == this.products.length : false;
                    },
                    set: function(value) {
                        var checked = [];
                        if (value) {
                            this.products.forEach(function(product) {
                                checked.push(product.id);
                            });
                        }
                        this.checked = checked;
                    }
                }
            },
            created() {
                // this.getProducts();
                this.getCategories();
                this.getBrands();
            },
            methods: {
                getProducts() {
                    axios.post('/get-products')
                        .then(res => {
                            this.products = res.data;
                        })
                },

                getCategories() {
                    axios.get('/get-discount-category')
                        .then(res => {
                            this.categories = res.data;
                        })
                },
                getBrands() {
                    axios.get('/get-discount-brands')
                        .then(res => {
                            this.brands = res.data;
                        })
                },

                getProductFilters() {
                    axios.post('/get-filter-products', {
                            brandId: this.selectedBrand.id,
                            categoryId: this.selectedCategory.id,
                        })
                        .then(res => {
                            this.products = res.data;
                            // console.log(res.data);
                        })
                },

                updateDiscount() {
                    let data = {
                        checkData: this.checked,
                        discount: this.discount
                    }
                    this.onProgress = true;
                    axios.post('/product/discount/update', data).then(res => {
                        let r = res.data;
                        alert(r.message);
                        this.onProgress = false;
                        this.clearChecked();
                        this.getProductFilters();
                    })
                },

                clearChecked() {
                    this.checked = [];
                    this.onProgress = false;
                },
            }
        })
    </script>
@endpush
