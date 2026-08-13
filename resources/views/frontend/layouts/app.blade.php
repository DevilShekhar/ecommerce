<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $siteLogo = \App\Models\Logo::first();
    @endphp

    <title>@yield('title', $siteLogo->site_name ?? 'My Website')</title>
    <meta name="description" content="@yield('meta_description', $siteLogo->site_description ?? '')">

    <!-- =============================================
    DYNAMIC FAVICON
    ============================================= -->
    @if($siteLogo && $siteLogo->favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $siteLogo->favicon) }}">
        <link rel="shortcut icon" href="{{ asset('storage/' . $siteLogo->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- Additional Favicon Sizes -->
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ $siteLogo && $siteLogo->favicon ? asset('storage/' . $siteLogo->favicon) : asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ $siteLogo && $siteLogo->favicon ? asset('storage/' . $siteLogo->favicon) : asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon"
        href="{{ $siteLogo && $siteLogo->favicon ? asset('storage/' . $siteLogo->favicon) : asset('apple-touch-icon.png') }}">

    <!-- Bootstrap 5 -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"> --}}
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
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    {{-- Swal css Link --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/css/swal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">

    @stack('styles')
</head>

<body>
    <!-- ================= NAVBAR ================= -->
    <header class="site-navbar" id="siteNavbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <a href="{{ url('/home') }}" class="site-logo">
                    <div class="logo-wrapper">

                        @if($siteLogo && $siteLogo->logo)
                            <img src="{{ asset('storage/' . $siteLogo->logo) }}" alt="{{ $siteLogo->site_name ?? 'Logo' }}"
                                style="max-height: 50px; width: auto;">
                        @endif

                        <span class="logo-text">{{ $siteLogo->site_name ?? 'E-Commerce' }}</span>

                    </div>
                </a>

                <nav class="site-nav">
                    <a href="{{ url('/home') }}">Home</a>
                    <a href="{{ url('/about-us') }}">About Us</a>
                    <a href="{{ url('/all-product') }}">Our Products</a>
                    <a href="{{ url('/contact-us') }}">Contact</a>
                </nav>

            </div>
        </div>
    </header>

    <!-- ================= CONTENT ================= -->
    @yield('content')

    <!-- ================= FOOTER ================= -->
    @php
        $footerSection = \App\Models\PageSection::where('section_type', 'footer')
            ->where('status', 1)
            ->first();
    @endphp

    @if($footerSection)
        <footer class="site-footer"
        style="background-image: url('{{ $footerSection->image ? asset('storage/' . $footerSection->image) : '' }}');">
    <div class="footer-overlay"></div>

    <div class="container">
        <div class="row">
            {{-- Logo & About --}}
            <div class="col-lg-3 col-md-6">
                @if($footerSection->logo)
                    <img src="{{ asset('storage/' . $footerSection->logo) }}"
                         alt="{{ $footerSection->title ?? 'Logo' }}"
                         class="footer-logo">
                @endif
                @if($footerSection->content)
                    <p class="footer-about">{{ $footerSection->content }}</p>
                @endif
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><a href="{{ url('/about-us') }}">About Us</a></li>
                    <li><a href="{{ url('/contact-us') }}">Contact</a></li>
                    <li><a href="{{ url('/privacy-policy') }}">Privacy & Policy</a></li>
                </ul>
            </div>

            {{-- Categories (Dynamic) --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Shop by Category</h5>
                <ul class="footer-links">
                    @php
                        $categories = \App\Models\ProductCategory::where('status', 1)
                            ->orderBy('name')
                            ->limit(6)
                            ->get();
                    @endphp
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ url('/category/' . $category->id) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                        <li><a href="{{ url('/all-product') }}" class="footer-view-all">View All Categories →</a></li>
                    @else
                        <li><span class="text-muted">No categories available</span></li>
                    @endif
                </ul>
            </div>

            {{-- Contact & Address --}}
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Contact Us</h5>
                @php
                    $addresses = $footerSection->addresses ? json_decode($footerSection->addresses, true) : [];
                @endphp
                @if(!empty($addresses))
                    @foreach($addresses as $address)
                        <div class="footer-address">
                            <p>
                                {{ $address['address'] ?? '' }}<br>
                                @if(!empty($address['city'])) {{ $address['city'] }}, @endif
                                @if(!empty($address['state'])) {{ $address['state'] }} @endif
                                @if(!empty($address['zip'])) - {{ $address['zip'] }} @endif
                                <br>
                                @if(!empty($address['country'])) {{ $address['country'] }} @endif
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No address available.</p>
                @endif
            </div>
        </div>

        {{-- Copyright --}}
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $footerSection->title ?? 'My Website' }}. All rights reserved.</p>
        </div>
    </div>
</footer>
    @else
        <footer class="site-footer">
            <div class="container">
                <div class="text-center">
                    <p>&copy; {{ date('Y') }} My Website. All rights reserved.</p>
                </div>
            </div>
        </footer>
    @endif

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
     <script src="{{ asset('assets/admin/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/bundles/vendorscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/admin/bundles/mainscripts.bundle.js') }}"></script>

    <script>
        (function () {
            var nav = document.getElementById('siteNavbar');
            if (!nav) return;
            window.addEventListener('scroll', function () {
                if (window.scrollY > 8) {
                    nav.classList.add('is-scrolled');
                } else {
                    nav.classList.remove('is-scrolled');
                }
            });
        })();
    </script>

    @stack('scripts')

</body>

</html>
