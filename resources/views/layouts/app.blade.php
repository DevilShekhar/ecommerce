<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>{{ config('app.name', 'Ecommerce') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/admin/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/dist/summernote.css') }}">

    <script src="{{ asset('assets/admin/plugins/summernote/dist/summernote.js') }}"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-select/css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
    <!-- jVectorMap -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}">
    <!-- C3 Charts -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/charts-c3/plugin.css') }}">
    <!-- Morris Charts -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/morrisjs/morris.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.min.css') }}">
    {{-- Swal css Link --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/swal.css') }}">
    <style>
        /* SweetAlert2 always creates an internal select element. It is not used by our alerts. */
        .swal2-popup>.swal2-select,
        .swal2-popup>.bootstrap-select {
            display: none !important;
        }
    </style>
</head>

<body class="theme-blush">
    <!-- Right Icon menu Sidebar -->
    <div class="navbar-right">
        <ul class="navbar-nav">
            <li><a href="#search" class="main_search" title="Search..."><i class="zmdi zmdi-search"></i></a></li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" title="App" data-toggle="dropdown"
                    role="button"><i class="zmdi zmdi-apps"></i></a>
                <ul class="dropdown-menu slideUp2">
                    <li class="header">App Sortcute</li>
                    <li class="body">
                        <ul class="menu app_sortcut list-unstyled">
                            <li>
                                <a href="image-gallery.html">
                                    <div class="icon-circle mb-2 bg-blue"><i class="zmdi zmdi-camera"></i></div>
                                    <p class="mb-0">Photos</p>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle mb-2 bg-amber"><i class="zmdi zmdi-translate"></i></div>
                                    <p class="mb-0">Translate</p>
                                </a>
                            </li>
                            <li>
                                <a href="events.html">
                                    <div class="icon-circle mb-2 bg-green"><i class="zmdi zmdi-calendar"></i></div>
                                    <p class="mb-0">Calendar</p>
                                </a>
                            </li>
                            <li>
                                <a href="contact.html">
                                    <div class="icon-circle mb-2 bg-purple"><i class="zmdi zmdi-account-calendar"></i>
                                    </div>
                                    <p class="mb-0">Contacts</p>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle mb-2 bg-red"><i class="zmdi zmdi-tag"></i></div>
                                    <p class="mb-0">News</p>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle mb-2 bg-grey"><i class="zmdi zmdi-map"></i></div>
                                    <p class="mb-0">Maps</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" title="Notifications" data-toggle="dropdown"
                    role="button"><i class="zmdi zmdi-notifications"></i>
                    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu slideUp2">
                    <li class="header">Notifications</li>
                    <li class="body">
                        <ul class="menu list-unstyled">
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                                    <div class="menu-info">
                                        <h4>8 New Members joined</h4>
                                        <p><i class="zmdi zmdi-time"></i> 14 mins ago </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-amber"><i class="zmdi zmdi-shopping-cart"></i></div>
                                    <div class="menu-info">
                                        <h4>4 Sales made</h4>
                                        <p><i class="zmdi zmdi-time"></i> 22 mins ago </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>
                                    <div class="menu-info">
                                        <h4><b>Nancy Doe</b> Deleted account</h4>
                                        <p><i class="zmdi zmdi-time"></i> 3 hours ago </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-green"><i class="zmdi zmdi-edit"></i></div>
                                    <div class="menu-info">
                                        <h4><b>Nancy</b> Changed name</h4>
                                        <p><i class="zmdi zmdi-time"></i> 2 hours ago </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-grey"><i class="zmdi zmdi-comment-text"></i></div>
                                    <div class="menu-info">
                                        <h4><b>John</b> Commented your post</h4>
                                        <p><i class="zmdi zmdi-time"></i> 4 hours ago </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-purple"><i class="zmdi zmdi-refresh"></i></div>
                                    <div class="menu-info">
                                        <h4><b>John</b> Updated status</h4>
                                        <p><i class="zmdi zmdi-time"></i> 3 hours ago </p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="icon-circle bg-light-blue"><i class="zmdi zmdi-settings"></i></div>
                                    <div class="menu-info">
                                        <h4>Settings Updated</h4>
                                        <p><i class="zmdi zmdi-time"></i> Yesterday </p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"> <a href="javascript:void(0);">View All Notifications</a> </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i
                        class="zmdi zmdi-flag"></i>
                    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu slideUp2">
                    <li class="header">Tasks List <small class="float-right"><a href="javascript:void(0);">View
                                All</a></small></li>
                    <li class="body">
                        <ul class="menu tasks list-unstyled">
                            <li>
                                <div class="progress-container progress-primary">
                                    <span class="progress-badge">eCommerce Website</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                            aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 86%;">
                                            <span class="progress-value">86%</span>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled team-info">
                                        <li class="m-r-15"><small>Team</small></li>
                                        <li>
                                            <img src="assets/images/xs/avatar2.jpg" alt="Avatar">
                                        </li>
                                        <li>
                                            <img src="assets/images/xs/avatar3.jpg" alt="Avatar">
                                        </li>
                                        <li>
                                            <img src="assets/images/xs/avatar4.jpg" alt="Avatar">
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="progress-container">
                                    <span class="progress-badge">iOS Game Dev</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                            aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 45%;">
                                            <span class="progress-value">45%</span>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled team-info">
                                        <li class="m-r-15"><small>Team</small></li>
                                        <li>
                                            <img src="assets/images/xs/avatar10.jpg" alt="Avatar">
                                        </li>
                                        <li>
                                            <img src="assets/images/xs/avatar9.jpg" alt="Avatar">
                                        </li>
                                        <li>
                                            <img src="assets/images/xs/avatar8.jpg" alt="Avatar">
                                        </li>
                                        <li>
                                            <img src="assets/images/xs/avatar7.jpg" alt="Avatar">
                                        </li>
                                        <li>
                                            <img src="assets/images/xs/avatar6.jpg" alt="Avatar">
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="progress-container progress-warning">
                                    <span class="progress-badge">Home Development</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar"
                                            aria-valuenow="29" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 29%;">
                                            <span class="progress-value">29%</span>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled team-info">
                                        <li class="m-r-15"><small>Team</small></li>
                                        <li>
                                            <img src="assets/images/xs/avatar5.jpg" alt="Avatar">
                                        </li>
                                        <li>
                                            <img src="assets/images/xs/avatar2.jpg" alt="Avatar">
                                        </li>
                                        <li>
                                            <img src="assets/images/xs/avatar7.jpg" alt="Avatar">
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="app_calendar" title="Calendar"><i
                        class="zmdi zmdi-calendar"></i></a></li>
            <li><a href="javascript:void(0);" class="app_google_drive" title="Google Drive"><i
                        class="zmdi zmdi-google-drive"></i></a></li>
            <li><a href="javascript:void(0);" class="app_group_work" title="Group Work"><i
                        class="zmdi zmdi-group-work"></i></a></li>
            <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i
                        class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
            <li>
                <a href="{{ route('logout') }}" class="mega-menu" title="Sign Out"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="zmdi zmdi-power"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="navbar-brand">
            <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>

            <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/admin/images/logo.svg') }}" width="25"
                    alt="Aero"><span class="m-l-10">Aero</span></a>

        </div>
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        <a class="image" href="{{ 'profile' }}"><img
                                src="{{ asset('assets/admin/images/profile_av.jpg') }}" alt="User"></a>
                        <div class="detail">
                            <h4>{{ Auth::user()?->name ?? 'Guest' }}</h4>
                            <small>{{ Auth::user()?->role?->name ?? 'User' }}</small>
                        </div>
                    </div>
                </li>
                <li class="active open"><a href="{{ route('dashboard') }}"><i
                            class="zmdi zmdi-home"></i><span>Dashboard</span></a>
                    {{-- MASTER --}}
                    @can('roles-index')
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="zmdi zmdi-settings"></i>
                                <span>Master</span>
                            </a>
                            <ul class="ml-menu">
                                @can('roles-index')
                                    <li>
                                        <a href="{{ route('roles.index') }}">
                                            <i class="zmdi zmdi-shield-security"></i>
                                            Roles
                                        </a>
                                    </li>
                                @endcan
                                @can('user-index')
                                    <li>
                                        <a href="{{ route('users.index') }}">
                                            <i class="zmdi zmdi-account"></i>
                                            Users
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                @can('coupons.index')
                    <li class="{{ request()->routeIs('coupons.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-ticket-star"></i>
                            <span>Coupons</span>
                        </a>
                        <ul class="ml-menu">
                            @can('coupons.index')
                                <li class="{{ request()->routeIs('coupons.index') ? 'active' : '' }}">
                                    <a href="{{ route('coupons.index') }}">Coupons List</a>
                                </li>
                            @endcan

                            @can('coupons.create')
                                <li class="{{ request()->routeIs('coupons.create') ? 'active' : '' }}">
                                    <a href="{{ route('coupons.create') }}">Add Coupon</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- CATEGORIES --}}
                @can('product_categories-index')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-collection-item"></i>
                            <span>Categories</span>
                        </a>
                        <ul class="ml-menu">
                            @can('product_categories-index')
                                <li>
                                    <a href="{{ route('product_categories.index') }}">
                                        <i class="zmdi zmdi-view-list"></i>
                                        Product Categories
                                    </a>
                                </li>
                            @endcan
                            @can('sub_categories-index')
                                <li>
                                    <a href="{{ route('sub_categories.index') }}">
                                        <i class="zmdi zmdi-layers"></i>
                                        Sub Categories
                                    </a>
                                </li>
                            @endcan
                            @can('brands-index')
                                <li>
                                    <a href="{{ route('brands.index') }}">
                                        <i class="zmdi zmdi-label"></i>
                                        Brands
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('offer-category.index')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-local-offer"></i>
                            <span>Offers</span>
                        </a>

                        <ul class="ml-menu">
                            @can('offer-category.index')
                                <li>
                                    <a href="{{ route('admin.offer-category.index') }}">
                                        <i class="zmdi zmdi-collection-item"></i>
                                        Offer Categories
                                    </a>
                                </li>
                            @endcan
                            @can('offer.index')
                                <li>
                                    <a href="{{ route('admin.offer.index') }}">
                                        <i class="zmdi zmdi-local-offer"></i>
                                        Offers
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                </li>

                @can('product.index')
                    <li class="{{ request()->routeIs('products.*') ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-shopping-cart"></i>
                            <span>Products</span>
                        </a>
                        <ul class="ml-menu">
                            @can('product.index')
                                <li class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.products.index') }}">Products List</a>
                                </li>
                            @endcan
                            @can('product.create')
                                <li class="{{ request()->routeIs('products.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.products.create') }}">Add Product</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if(auth()->user()?->role?->name === 'SuperAdmin')

                    <li class="{{ request()->routeIs('orders.*') ? 'active open' : '' }}">

                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-shopping-cart"></i>
                            <span>Orders</span>
                        </a>

                        <ul class="ml-menu">

                            <li class="{{ request()->routeIs('orders.index') ? 'active' : '' }}">
                                <a href="{{ route('orders.index') }}">
                                    <i class="zmdi zmdi-view-list"></i>
                                    All Orders
                                </a>
                            </li>

                        </ul>

                    </li>
                    <li class="{{ request()->routeIs('banners.*') ? 'active open' : '' }}">

                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-shopping-cart"></i>
                            <span>Banners</span>
                        </a>

                        <ul class="ml-menu">

                            <li class="{{ request()->routeIs('admin.banners.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.banners.index') }}">
                                    <i class="zmdi zmdi-view-list"></i>
                                    Banenrs
                                </a>
                            </li>

                        </ul>

                    </li>

                @endif

                {{-- PAGES --}}
                @can('website-pages')
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="zmdi zmdi-file-text"></i>
                            <span>Website Settings</span>
                        </a>

                        <ul class="ml-menu">
                            <li>
                                <a href="{{ route('logos.index') }}">
                                    <i class="zmdi zmdi-image"></i>
                                    Logo & Favicon
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.sections.index') }}">
                                    <i class="zmdi zmdi-image"></i>
                                    Home Banners
                                </a>
                                <a href="{{ route('admin.about-us.index') }}">
                                    <i class="zmdi zmdi-image"></i>
                                    About Us
                                </a>
                                <a href="{{ route('shop') }}">
                                    <i class="zmdi zmdi-image"></i>
                                    Shops
                                </a>
                                <a href="{{ route('admin.contact-us.index') }}">
                                    <i class="zmdi zmdi-image"></i>
                                    Contact Us
                                </a>
                                <a href="{{ route('admin.terms-conditions.index') }}">
                                    <i class="zmdi zmdi-image"></i>
                                    Terms Conditions
                                </a>
                                <a href="{{ route('admin.privacy-policies.index') }}">
                                    <i class="zmdi zmdi-image"></i>
                                    Privacy&Policy
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @auth
                    @if(auth()->user()?->role?->name === 'SuperAdmin')
                        <li>
                            <a href="{{ route('admin.contact-submissions.index') }}">
                                <i class="zmdi zmdi-email"></i>
                                <span>Contact Submissions</span>
                            </a>
                        </li>
                    @endif
                @endauth
    </aside>
    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
    {{-- Core admin scripts: these must use the same jQuery instance as the sidebar. --}}
    <script src="{{ asset('assets/admin/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/bundles/mainscripts.bundle.js') }}"></script>
    <script>
        $(function () {
            // The theme binds preventDefault() to every form; application forms must submit normally.
            $('form').off('submit');
        });
    </script>
    <!-- =======================
            DataTables (Only if Required)
        ======================= -->
    @if(request()->routeIs('*.index'))
        <script src="{{ asset('assets/admin/bundles/datatablescripts.bundle.js') }}"></script>
        <script>
            $(function () {
                $('.js-basic-example, #datatable').each(function () {
                    if (!$.fn.dataTable.isDataTable(this)) {
                        $(this).DataTable();
                    }
                });
            });
        </script>
    @endif
    <!-- =======================
            Dashboard Only
        ======================= -->
    @if(request()->routeIs('dashboard'))
        <script src="{{ asset('assets/admin/bundles/morrisscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/admin/bundles/jvectormap.bundle.js') }}"></script>
        <script src="{{ asset('assets/admin/bundles/sparkline.bundle.js') }}"></script>
        <script src="{{ asset('assets/admin/bundles/knob.bundle.js') }}"></script>
        <script src="{{ asset('assets/admin/js/pages/charts/jquery-knob.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/pages/ecommerce.js') }}"></script>

    @endif
    <script src="{{ asset('assets/admin/js/swal.js') }}"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2500
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
        @endif
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    const form = this.closest('.delete-form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to delete? This action cannot be undone!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $('#category_id').on('change', function () {

                let categoryId = $(this).val();
                let $subCategory = $('#sub_category_id');

                // Reset
                $subCategory.html(
                    '<option value="">-- Select Sub Category --</option>'
                );

                if (!categoryId) {
                    refreshSubCategory();
                    return;
                }

                $.ajax({
                    url: "{{ url('products/get-subcategories') }}/" + categoryId,
                    type: "GET",
                    dataType: "json",

                    success: function (data) {

                        console.log('SUBCATEGORY DATA:', data);

                        $.each(data, function (index, item) {

                            $subCategory.append(
                                $('<option>', {
                                    value: item.id,
                                    text: item.name
                                })
                            );

                        });

                        // IMPORTANT: refresh dropdown plugin
                        refreshSubCategory();

                        console.log(
                            'Dropdown options:',
                            $subCategory.find('option').length
                        );
                    },

                    error: function (xhr) {
                        console.log('Subcategory Error:', xhr.responseText);
                    }
                });

            });


            function refreshSubCategory() {

                let $subCategory = $('#sub_category_id');

                // Bootstrap Select
                if ($.fn.selectpicker) {
                    $subCategory.selectpicker('refresh');
                }

                // Select2
                if ($subCategory.hasClass('select2-hidden-accessible')) {
                    $subCategory.trigger('change.select2');
                }

                // Bootstrap custom dropdown
                $subCategory.trigger('change');
            }

        });
    </script>

    @yield('scripts')
    @stack('scripts')


</body>

</html>
