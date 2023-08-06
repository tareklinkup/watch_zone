@extends('layouts.master')
@section('title', 'Stock Management')
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
                        href="{{ route('dashboard') }}">Home</a> > Stock Management</span>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="from-group row">

                        <div class="col-sm-4">
                            <label for="" class=""><strong>Category</strong> </label>
                        </div>
                        <div class="col-sm-8">
                            <v-select v-bind:options="categories" label="name" v-model="selectedCategory"
                                placeholder="Select Category"></v-select>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="from-group row">
                        <div class="col-sm-4">
                            <label for="" class=""><strong>Brand</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <v-select v-bind:options="brands" label="name" v-model="selectedBrand"
                                placeholder="Select Brand"></v-select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="from-group row">
                        <div class="col-sm-4">
                            <label for="" class=""><strong>Product</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <v-select v-bind:options="products" label="name" v-model="selectedProduct"
                                placeholder="Select Product"></v-select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="from-group row">
                        <div class="col-sm-4">
                            <label for="" class=""><strong>Date</strong></label>
                        </div>
                        <div class="col-sm-8">
                            <input type="date" v-model="date" class="form-control shadow-none">
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <input type="button" class="search_btn" value="Search" v-on:click="getProductStock">
                </div>
            </div>

            <div class="row">
                <div class="card my-3">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Product List</div>
                    </div>

                    <div class="card-body table-card-body" style="display: none"
                        :style="{ display: products.length > 0 ? '' : 'none' }">
                        <table class="table text-center dataTable">
                            <thead class="bg-light">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Model</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Order Quantity</th>
                                    <th>Current Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, ind) in report" :key="ind">
                                    <td>@{{ ind + 1 }}</td>
                                    <td style="width: 20%">@{{ product.name }}</td>
                                    <td>@{{ product.model }}</td>
                                    <td>@{{ product.category?.name }}</td>
                                    <td>@{{ product.brand?.name }}</td>
                                    <td>@{{ product.order_qty }}</td>
                                    <td>@{{ product.quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body table-card-body" style="display: none"
                        :style="{ display: report.length == 0 ? '' : 'none' }">
                        <h4 class="text-center">No Product Found!</h4>

                    </div>
                </div>
            </div>
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
                report: [],
                products: [],
                selectedProduct: {
                    name: 'Select Product',
                },
                categories: [],
                selectedCategory: [],
                brands: [],
                selectedBrand: [],
                checked: [],
                date: moment().format('YYYY-MM-DD'),
                onProgress: false,
            },
            filters: {
                decimal(value) {
                    return value == null || value == '' ? '0.00' : parseFloat(value).toFixed(2);
                }
            },

            created() {
                this.getProducts();
                this.getCategories();
                this.getBrands();
                this.getProductStock();
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

                getProductStock() {
                    axios.post('/get-products-stock', {
                            brandId: this.selectedBrand == null || this.selectedBrand.id == '' ? '' : this.selectedBrand.id,
                            categoryId: this.selectedCategory == null || this.selectedCategory.id == '' ? '' : this.selectedCategory.id,
                            productId: this.selectedProduct == null || this.selectedProduct.id == '' ? '' : this
                                .selectedProduct.id,
                        })
                        .then(res => {
                            this.report = res.data;
                            // console.log(res.data);
                        })
                }
            }
        })
    </script>
@endpush
