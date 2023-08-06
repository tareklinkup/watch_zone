<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                @if (auth()->user()->can('Slider Management') ||
                        auth()->user()->can('Company About') ||
                        auth()->user()->can('Banner Entry') ||
                        auth()->user()->can('Sale Service') ||
                        auth()->user()->can('Faqs Entry') ||
                        auth()->user()->can('Company Policy'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Website Content
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion1">
                        <nav class="sb-sidenav-menu-nested nav">
                            @can('Slider Management')
                                <a class="nav-link" href="{{ route('slider.index') }}">Add Slider</a>
                            @endcan
                            @can('Company About')
                                <a class="nav-link" href="{{ route('company.about') }}">Terms Condition</a>
                            @endcan
                            @can('Banner Entry')
                                <a class="nav-link" href="{{ route('banner.index') }}">Banner Entry</a>
                            @endcan
                            @can('Sale Service')
                                <a class="nav-link" href="{{ route('sale.service') }}">Sale Service</a>
                            @endcan
                            @can('Faqs Entry')
                                <a class="nav-link" href="{{ route('faq.index') }}">Faqs Entry</a>
                            @endcan
                            @can('Company Policy')
                                <a class="nav-link" href="{{ route('company.policy') }}">Company Policy</a>
                            @endcan
                        </nav>
                    </div>
                @endif


                @if ( auth()->user()->can('Product Add') ||
                        auth()->user()->can('Product List') ||
                        auth()->user()->can('Product Edit') ||
                        auth()->user()->can('Product Delete')||
                        auth()->user()->can('All Product List')||
                        auth()->user()->can('Select Product')||
                        auth()->user()->can('Sale Product')||
                       auth()->user()->can('Category Management') ||
                        auth()->user()->can('Brand Management') ||
                        auth()->user()->can('Series Entry')||
                        auth()->user()->can('Brand Material')||
                        auth()->user()->can('Dial Color')||
                        auth()->user()->can('Case Size')||
                        auth()->user()->can('Movement Entry'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Product
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            @can('Product Add')
                                <a class="nav-link" href="{{ route('products.create') }}">Add Product</a>
                            @endcan
                            @can('Product List')
                                <a class="nav-link" href="{{ route('products.index') }}">Product List</a>
                            @endcan
                            @can('All Product List')
                                <a class="nav-link" href="{{ route('products.all') }}">Discount Product</a>
                            @endcan
                            @can('Select Product')
                                <a class="nav-link" href="{{ route('selected.product') }}">Select Product</a>
                            @endcan
                            @can('Sale Product')
                                <a class="nav-link" href="{{ route('sale.product') }}">Sale Product</a>
                            @endcan
                            @can('Category Management')
                                <a class="nav-link" href="{{ route('category.index') }}">Add Category</a>
                            @endcan
                            @can('Brand Management')
                                <a class="nav-link" href="{{ route('brand.index') }}">Add Brand</a>
                            @endcan
                            @can('Series Entry')
                                <a class="nav-link" href="{{ route('series.index') }}">Series Entry</a>
                            @endcan
                            @can('Brand Material')
                                <a class="nav-link" href="{{ route('material.index') }}">Brand Material</a>
                            @endcan
                            @can('Dial Color')
                                <a class="nav-link" href="{{ route('color.index') }}">Dial Color</a>
                            @endcan
                            @can('Case Size')
                                <a class="nav-link" href="{{route('size.index')}}">Case Size</a>
                            @endcan
                            @can('Movement Entry')
                                <a class="nav-link" href="{{route('movement.index')}}">Movement Entry</a>
                            @endcan
                        
                        
                        </nav>
                    </div>
                @endif



                @if (auth()->user()->can('Pending Order') ||
                        auth()->user()->can('Confirm Order') ||
                        auth()->user()->can('Processing Order') ||
                        auth()->user()->can('Delivered Order') ||
                        auth()->user()->can('Canceled Order') ||
                        auth()->user()->can('All Order'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#orderPages"
                        aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-sort-amount-down-alt"></i></div>
                        View Order
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="orderPages" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            @can('Pending Order')
                                <a class="nav-link" href="{{ route('admin.pending.order') }}">Pending Order</a>
                            @endcan
                            @can('Confirm Order')
                                <a class="nav-link" href="{{ route('admin.confirm.order') }}">Confirm Order</a>
                            @endcan
                            @can('Processing Order')
                                <a class="nav-link" href="{{ route('admin.processing.order') }}">Processing Order</a>
                            @endcan
                         
                            @can('Delivered Order')
                                <a class="nav-link" href="{{ route('admin.delivered.order') }}">Delivered Order</a>
                            @endcan
                            @can('Canceled Order')
                                <a class="nav-link" href="{{ route('admin.canceled.order') }}">Canceled Order</a>
                            @endcan
                            @can('New Order')
                                <a class="nav-link" href="{{ route('new.order') }}">Create New Order</a>
                            @endcan
                            {{-- @can('All Order') --}}
                            <a class="nav-link" href="{{ route('admin.all.order') }}">All Order</a>
                            {{-- @endcan --}}
                        </nav>
                    </div>
                @endif

                @if (auth()->user()->can('Stock Management') ||
                        auth()->user()->can('Order Report'))

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Reports"
                        aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                        Reports
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Reports" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            @can('Stock Management')
                                <a class="nav-link" href="{{ route('order.report') }}">Stock Management</a>
                            @endcan
                            @can('Order Report')
                                <a class="nav-link" href="{{ route('report.list.order') }}">Order Report</a>
                            @endcan
                        </nav>
                    </div>

                    @if (auth()->user()->can('Customer List'))
                        <a class="nav-link {{ Request::is('customer.list') ? 'active' : '' }}"
                            href="{{ route('customer.list') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Customer List
                        </a>
                    @endif
                @endif

                @if (auth()->user()->can('Company Profile') ||
                        // auth()->user()->can('Our Team') ||
                        auth()->user()->can('Coupon') ||
                        auth()->user()->can('District'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#setting"
                        aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        Settings
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <div class="collapse" id="setting" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            @can('Company Profile')
                                <a class="nav-link" href="{{ route('company.profiles') }}">Company Profile</a>
                            @endcan
                            
                            @can('Coupon')
                                <a class="nav-link collapsed" href="{{ route('admin.coupons') }}">Add Coupon</a>
                            @endcan
                            @can('District')
                                <a class="nav-link collapsed" href="{{ route('district.index') }}">Add District</a>
                            @endcan

                           
                        </nav>
                    </div>
                @endif

             

                @if (auth()->user()->can('Public Message'))
                    <a class="nav-link {{ Request::is('visitor.index') ? 'active' : '' }}"
                        href="{{ route('visitor.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                        Website Visitors
                    </a>
                @endif
                @if (auth()->user()->can('User Management') ||
                        auth()->user()->can('User Role Management'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Administration
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            @can('User Management')
                                <a class="nav-link" href="{{ route('role.index') }}">Create Role</a>
                            @endcan
                            @can('User Role Management')
                                <a class="nav-link" href="{{ route('admin.registration') }}">Create User</a>
                            @endcan
                        </nav>
                    </div>
                @endif


            </div>
        </div>
    </nav>
</div>
