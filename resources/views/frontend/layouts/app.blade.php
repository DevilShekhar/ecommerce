<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'My Website')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/website.css') }}">

    @stack('styles')
</head>

<body>

    <!-- ================= NAVBAR ================= -->
    <header class="site-navbar" id="siteNavbar">
        <div class="container">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="site-logo">
                <div class="logo-wrapper">
                    <span class="logo-text">
                        My Website
                    </span>
                </div>
            </a>

            <!-- Navigation -->
            <nav class="site-nav">
                <div class="nav-links">

                    <a href="{{ url('/') }}">
                        Home
                    </a>

                    <a href="{{ url('/about-us') }}">
                        About Us
                    </a>

                    <a href="{{ url('/contact-us') }}">
                        Contact
                    </a>

                    <a href="{{ url('/login') }}" class="login-btn">
                        <i class="bi bi-box-arrow-in-right"></i>
                        Login
                    </a>

                </div>
            </nav>

        </div>
    </header>

    <!-- ================= CONTENT ================= -->
    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>
