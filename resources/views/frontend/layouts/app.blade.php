<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'My Website')</title>
    <meta name="description" content="@yield('meta_description', '')">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">


    @stack('styles')
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <!-- ================= NAVBAR ================= -->
<header class="site-navbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <a href="{{ url('/home') }}" class="site-logo">
                @php
                    $footerSection = \App\Models\PageSection::where('section_type', 'footer')
                        ->where('status', 1)
                        ->first();
                @endphp
                
                <div class="logo-wrapper">
                    @if($footerSection && $footerSection->logo)
                        <img src="{{ asset('storage/' . $footerSection->logo) }}" 
                             alt="{{ $footerSection->title ?? 'Logo' }}" 
                             style="max-height: 50px; width: auto;">
                    @endif
                    <span class="logo-text">E-Commerce</span>
                </div>
            </a>

            <nav class="site-nav">
                <a href="{{ url('/home') }}">Home</a>
                <a href="{{ url('/about-us') }}">About Us</a>
                <a href="{{ url('/all-product') }}">Your Products</a>
                <a href="{{ url('/contact-us') }}">Contact</a>
            </nav>

        </div>
    </div>
</header>


    <!-- ================= CONTENT ================= -->
    @yield('content')


    <!-- ================= FOOTER ================= -->
    <footer class="site-footer">
        <div class="container">
            <div class="text-center">
                <p>© {{ date('Y') }} My Website. All rights reserved.</p>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Subtle shadow on navbar once the page scrolls — purely cosmetic, no functional impact
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