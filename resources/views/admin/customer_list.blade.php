@extends('layouts.master')
@section('title', 'Customer List')
@section('main-content')

    <main>
        <div class="container-fluid" id="Customers">
            <div class="heading-title p-2 my-2">
                <span class="my-3 heading "><i class="fas fa-home"></i> <a class=""
                        href="{{ route('dashboard') }}">Home</a> > Customer</span>
            </div>
            <div class="row">
                <div class="card-body bg-white ">
                    <div class="row">
                        <div class="col-sm-8 m-auto card">
                            <h5 class="border-bottom"> Customer Create</h5>
                            <form @submit.prevent="addCustomer">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2">Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control shadow-none" v-model="customer.name"
                                            required>
                                    </div>

                                    <label for="" class="col-sm-2">Phone</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control shadow-none" v-model="customer.phone"
                                            required>
                                    </div>

                                    <label for="" class="col-sm-2">Email</label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control shadow-none" v-model="customer.email">
                                    </div>

                                    <label for="" class="col-sm-2">Address</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control shadow-none" v-model="customer.address"
                                            required>
                                    </div>
                                    <label for="" class="col-sm-2">Password</label>
                                    <div class="col-sm-4">
                                        <input type="password" class="form-control shadow-none" v-model="customer.password"
                                            required>
                                    </div>
                                    <label for="" class="col-sm-2">Confirm Password</label>
                                    <div class="col-sm-4">
                                        <input type="password" class="form-control shadow-none"
                                            v-model="customer.password_confirmation" required>
                                    </div>
                                    <div class="addbtn text-end col-sm-1 ms-auto">
                                        <input type="submit" class="btn btn-success btn-sm" value="Save">

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="card my-2">
                    <div class="card-header d-flex justify-content-between">
                        <div class="table-head"><i class="fas fa-table me-1"></i> Customer List</div>
                        <div class="float-right">
                            <a class="pull-right" href="" onclick="ExportToExcel('xlsx', event)">
                                <i class="fa fa-download" aria-hidden="true"></i> Excel Export</a>
                        </div>
                    </div>
                    <div class="card-body table-card-body" style="display: none"
                        :style="{ display: customers.length > 0 ? '' : 'none' }">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center record-table" id="datatablesSimple"
                                width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="" v-for="(customer, cm) in customers">
                                        <td>@{{ cm + 1 }}</td>
                                        <td>@{{ customer.name }}</td>
                                        <td>@{{ customer.email }}</td>
                                        <td>@{{ customer.phone }}</td>
                                        <td>@{{ customer.created_at | formatDateTime }}</td>
                                        <td>@{{ customer.address }}</td>
                                    </tr>
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
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/vue-select.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script>
        Vue.component('v-select', VueSelect.VueSelect);

        const app = new Vue({
            el: '#Customers',
            data: {
                customer: {
                    id: '',
                    name: '',
                    phone: '',
                    email: '',
                    address: '',
                    password: '',
                    password_confirmation: '',
                },
                customers: [],
                selectedCustomer: null,
            },

            filters: {
                formatDateTime(date) {
                    return date == '' || date == null ? '' : moment(date).format('DD-MM-YYYY h:mm:ss a');
                }
            },

            created() {
                this.getCustoemrs()
            },
            methods: {
                getCustoemrs() {
                    axios.get('/get-customers')
                        .then(res => {
                            this.customers = res.data;
                        })
                },

                addCustomer() {

                    if (this.customer.password != this.customer.password_confirmation) {
                        alert('Password not match');
                        return;
                    }
                    let url = '/add/customer';
                    let data = {
                        customer: this.customer,
                    }
                    axios.post(url, data).then(res => {
                        let r = res.data;
                        if (r.success) {
                            console.log(r);
                            alert('Customer Save Successfully.');
                            this.getCustoemrs();
                            this.clearForm();
                        } else {
                            alert(r.message);
                        }
                    })
                },
                clearForm() {
                    this.customer = {
                        id: '',
                        name: '',
                        phone: '',
                        email: '',
                        address: '',
                        password: '',
                        password_confirmation: '',
                    }
                }
            }
        })
    </script>


    <script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>

    <script type="text/javascript">
        // Export Data to Excel Files
        function ExportToExcel(type, event, fn, dl) {
            event.preventDefault();
            var elt = document.querySelector('.record-table');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('Customer List.' + (type || 'xlsx')));
        }
    </script>
@endpush
