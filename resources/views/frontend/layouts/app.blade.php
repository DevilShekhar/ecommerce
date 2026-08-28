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
    <!-- =============================================
        NAVBAR
    ============================================= -->
    <nav class="navbar-modern">
        <div class="navbar-container">
            <!-- Logo -->
            <a href="/" class="navbar-logo">
                <span class="navbar-logo-text">Aethelweave</span>
                <span class="navbar-logo-badge">Artisan</span>
            </a>

            <!-- Nav Links - Desktop -->
            <ul class="nav-links-desktop">
                <li><a href="/">Home</a></li>
                <li><a href={{ route('shop.index') }}>Shop</a></li>

                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
            </ul>

            <!-- Right Icons -->
            <div class="navbar-icons">
                <a href="#" class="navbar-icon">
                    <i class="bi bi-search"></i>
                </a>
                <a href="{{ route('login') }}" class="navbar-icon">
                    <i class="bi bi-person"></i>
                </a>
                <a href="#" class="navbar-icon">
                    <i class="bi bi-bag"></i>
                    <span class="navbar-cart-count">0</span>
                </a>
                <!-- Hamburger (Mobile) -->
                <button class="hamburger-btn" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>

                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- ================= CONTENT ================= -->
    @yield('content')
    {{-- =============================================
    FOOTER
    ============================================= --}}
    <footer class="footer-modern">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div class="footer-col footer-brand-col">
                    <div class="footer-brand">Aethelweave</div>
                    <p class="footer-tagline">Artisan Jewellery · Since 2010</p>
                    <p class="footer-desc">Premium handcrafted jewellery for those who appreciate timeless elegance and
                        exceptional quality.</p>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Instagram" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="YouTube" class="social-link"><i class="bi bi-youtube"></i></a>
                        <a href="#" aria-label="Pinterest" class="social-link"><i class="bi bi-pinterest"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        <li><a href="#">Blogs</a></li>
                    </ul>
                </div>

                <!-- We Accept -->
                <div class="footer-col">
                    <h4 class="footer-heading">We Accept</h4>
                    <div class="footer-payment">
                        <span class="payment-icon"><i class="bi bi-credit-card"></i></span>
                        <span class="payment-icon"><i class="bi bi-paypal"></i></span>
                        <span class="payment-icon"><i class="bi bi-bank"></i></span>
                        <span class="payment-icon"><i class="bi bi-cash"></i></span>
                        <p class="payment-text">Secure payment options available</p>
                    </div>
                </div>

                <!-- Contact Us -->
                <div class="footer-col">
                    <h4 class="footer-heading">Contact Us</h4>
                    <ul class="footer-contact">
                        <li><i class="bi bi-envelope"></i> info@aethelweave.com</li>
                        <li><i class="bi bi-geo-alt"></i> 123, Jewelry Lane, Koregaon Park, Pune, Maharashtra 411001,
                            India</li>
                        <li><i class="bi bi-telephone"></i> +91 98765 43210</li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <hr class="footer-divider">
            <div class="footer-bottom">
                <p class="footer-copy">&copy; 2026 Aethelweave. All Rights Reserved.</p>
                <div class="footer-bottom-links">
                    <a href="{{ route('privacy-policy.index')}}">Privacy Policy</a>
                    <a href={{ route('terms-conditions') }}>Terms of Use</a>
                    <a href={{ route('disclaimer') }}>Disclaimer</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.querySelector('.hamburger-btn');
            const mobileMenu = document.querySelector('.mobile-menu');

            if (hamburger && mobileMenu) {
                hamburger.addEventListener('click', function () {
                    const isOpen = mobileMenu.style.display === 'block';
                    mobileMenu.style.display = isOpen ? 'none' : 'block';
                });
            }

            // Navbar scroll effect
            const navbar = document.querySelector('.navbar-modern');
            if (navbar) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }
        });
    </script>

    @stack('scripts')

</body>

</html>