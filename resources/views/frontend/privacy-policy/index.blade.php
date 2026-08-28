<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Privacy Policy - Aethelweave</title>
    <!-- Google Fonts: Cormorant Garamond & Plus Jakarta Sans -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FAF9F6;
            color: #292929;
            padding-top: 80px;
        }

        /* =============================================
            NAVBAR - SAME AS ALL PAGES
        ============================================= */
        .navbar-modern {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(253, 251, 247, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(232, 226, 210, 0.6);
            padding: 12px 0;
            transition: all 0.3s ease;
        }

        .navbar-modern.scrolled {
            background: rgba(253, 251, 247, 0.98);
            box-shadow: 0 2px 24px rgba(44, 42, 41, 0.06);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-logo {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-logo-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 500;
            color: #A58B54;
            letter-spacing: -0.5px;
        }

        .navbar-logo-badge {
            font-size: 0.55rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #8F753D;
            background: rgba(165, 139, 84, 0.12);
            padding: 2px 10px;
            border-radius: 20px;
            border: 1px solid rgba(165, 139, 84, 0.2);
        }

        .nav-links-desktop {
            display: none;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
            gap: 28px;
        }

        .nav-links-desktop li a {
            font-size: 0.75rem;
            font-weight: 500;
            color: #2C2A29;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            transition: color 0.3s ease;
            position: relative;
            padding-bottom: 4px;
        }

        .nav-links-desktop li a:hover {
            color: #A58B54;
        }

        .nav-links-desktop li a.active {
            color: #A58B54;
        }

        .nav-links-desktop li a.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #A58B54;
            border-radius: 2px;
        }

        .navbar-icons {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar-icon {
            color: #2C2A29;
            text-decoration: none;
            font-size: 1.1rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .navbar-icon:hover {
            color: #A58B54;
        }

        .navbar-cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #A58B54;
            color: #FFFFFF;
            font-size: 0.5rem;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hamburger-btn {
            display: flex;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
        }

        .hamburger-btn span {
            display: block;
            width: 24px;
            height: 2px;
            background: #2C2A29;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .mobile-menu {
            display: none;
            background: #FFFFFF;
            border-top: 1px solid #E8E2D2;
            padding: 16px 20px 20px;
            margin-top: 12px;
        }

        .mobile-menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .mobile-menu ul li a {
            display: block;
            padding: 10px 0;
            font-size: 0.9rem;
            font-weight: 500;
            color: #2C2A29;
            text-decoration: none;
            border-bottom: 1px solid #F5F0E8;
            transition: color 0.3s ease;
        }

        .mobile-menu ul li a:hover {
            color: #A58B54;
        }

        .mobile-menu ul li a.active {
            color: #A58B54;
            font-weight: 600;
        }

        .mobile-menu ul li:last-child a {
            border-bottom: none;
        }

        @media (min-width: 768px) {
            .nav-links-desktop {
                display: flex;
            }
            .hamburger-btn {
                display: none;
            }
            .mobile-menu {
                display: none !important;
            }
        }

        @media (max-width: 767px) {
            .nav-links-desktop {
                display: none;
            }
            .hamburger-btn {
                display: flex;
            }
        }

        /* =============================================
            PRIVACY POLICY
        ============================================= */
        .privacy-page {
            padding: 70px 20px 40px;
        }

        .privacy-container {
            max-width: 1100px;
            margin: auto;
        }

        .privacy-header {
            text-align: center;
            margin-bottom: 55px;
        }

        .privacy-header .subtitle {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 13px;
            color: #b08d57;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .privacy-header h1 {
            font-size: 42px;
            margin: 0 0 15px;
            font-weight: 500;
            color: #292929;
            font-family: 'Cormorant Garamond', serif;
        }

        .privacy-header p {
            font-size: 16px;
            color: #777;
            margin: 0;
        }

        .privacy-section {
            background: #fff;
            border-radius: 12px;
            padding: 35px;
            margin-bottom: 25px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .05);
        }

        .privacy-section-content {
            display: flex;
            gap: 35px;
            align-items: flex-start;
        }

        .privacy-image {
            width: 280px;
            flex: 0 0 280px;
        }

        .privacy-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .privacy-content {
            flex: 1;
        }

        .privacy-content .section-subtitle {
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #b08d57;
            font-size: 12px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .privacy-content h2 {
            font-size: 26px;
            margin: 0 0 18px;
            color: #292929;
            font-family: 'Cormorant Garamond', serif;
        }

        .privacy-description {
            font-size: 15px;
            line-height: 1.8;
            color: #666;
        }

        .privacy-description p {
            margin-bottom: 12px;
        }

        .privacy-description ul,
        .privacy-description ol {
            padding-left: 22px;
            margin-bottom: 12px;
        }

        .privacy-description li {
            margin-bottom: 6px;
        }

        /* =============================================
            FOOTER - GOLDEN & BLACK THEME
        ============================================= */
        .footer-modern {
            background: #2C2A29;
            padding: 50px 0 20px;
            color: #FFFFFF;
            margin-top: 20px;
        }

        .footer-modern .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            width: 100%;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
            padding-bottom: 30px;
        }

        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: 2fr 1fr 1fr 1.5fr;
                gap: 40px;
            }
        }

        @media (max-width: 767px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 25px;
            }
        }

        @media (max-width: 480px) {
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        .footer-col {
            display: flex;
            flex-direction: column;
        }

        .footer-brand-col {
            gap: 6px;
        }

        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 500;
            color: #A58B54;
            letter-spacing: -0.5px;
        }

        .footer-tagline {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 0.2em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .footer-desc {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            line-height: 1.6;
            max-width: 280px;
            margin-bottom: 12px;
        }

        .footer-social {
            display: flex;
            gap: 10px;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 16px;
        }

        .social-link:hover {
            background: #A58B54;
            color: #FFFFFF;
            transform: translateY(-3px);
        }

        .footer-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: #A58B54;
            margin-bottom: 12px;
            letter-spacing: 0.05em;
        }

        .footer-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .footer-links li a {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }

        .footer-links li a:hover {
            color: #A58B54;
        }

        .footer-payment {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }

        .payment-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 30px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 4px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .payment-icon:hover {
            background: #A58B54;
            color: #FFFFFF;
        }

        .payment-text {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 8px;
            width: 100%;
        }

        .footer-contact {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .footer-contact li {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
            line-height: 1.5;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .footer-contact li i {
            color: #A58B54;
            font-size: 16px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .footer-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin: 16px 0;
        }

        .footer-bottom {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding-top: 8px;
        }

        @media (min-width: 768px) {
            .footer-bottom {
                flex-direction: row;
                justify-content: space-between;
            }
        }

        .footer-copy {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: 0.05em;
            margin: 0;
        }

        .footer-bottom-links {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, 0.3);
            text-decoration: none;
            font-size: 0.65rem;
            letter-spacing: 0.05em;
            transition: color 0.3s ease;
        }

        .footer-bottom-links a:hover {
            color: #A58B54;
        }

        @media (max-width: 480px) {
            .footer-bottom-links {
                justify-content: center;
                gap: 12px;
            }

            .footer-bottom-links a {
                font-size: 0.6rem;
            }

            .footer-contact li {
                font-size: 0.75rem;
            }

            .footer-desc {
                font-size: 0.75rem;
                max-width: 100%;
            }

            .privacy-page {
                padding: 45px 15px 30px;
            }

            .privacy-header h1 {
                font-size: 32px;
            }

            .privacy-section {
                padding: 25px;
            }

            .privacy-section-content {
                display: block;
            }

            .privacy-image {
                width: 100%;
                margin-bottom: 25px;
            }

            .privacy-image img {
                height: 200px;
            }
        }

        @media (max-width: 767px) {
            body {
                padding-top: 65px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding-top: 60px;
            }
        }
    </style>
</head>

<body>

    <!-- =============================================
        NAVBAR - SAME AS ALL PAGES
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
                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                <li><a href="#">Collections</a></li>
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
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                <li><a href="#">Collections</a></li>
                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- =============================================
        PRIVACY POLICY CONTENT
    ============================================= -->
    <section class="privacy-page">
        <div class="privacy-container">
            <div class="privacy-header">
                <div class="subtitle">Your Privacy Matters</div>
                <h1>Privacy Policy</h1>
                <p>Learn how we protect and handle your information.</p>
            </div>
            @forelse($privacyPolicies as $privacyPolicy)
                <div class="privacy-section">
                    <div class="privacy-section-content">
                        @if($privacyPolicy->privacy_policy_image)
                            <div class="privacy-image">
                                <img src="{{ asset('storage/' . $privacyPolicy->privacy_policy_image) }}"
                                    alt="{{ $privacyPolicy->privacy_policy_title }}">
                            </div>
                        @endif
                        <div class="privacy-content">
                            @if($privacyPolicy->privacy_policy_subtitle)
                                <div class="section-subtitle">{{ $privacyPolicy->privacy_policy_subtitle }}</div>
                            @endif
                            <h2>{{ $privacyPolicy->privacy_policy_title }}</h2>
                            <div class="privacy-description">
                                {!! $privacyPolicy->privacy_policy_description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="privacy-section">
                    <div class="privacy-content">
                        <h2>Privacy Policy</h2>
                        <p>No Privacy Policy content available at the moment.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- =============================================
        FOOTER
    ============================================= -->
    <footer class="footer-modern">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div class="footer-col footer-brand-col">
                    <div class="footer-brand">Aethelweave</div>
                    <p class="footer-tagline">Artisan Jewellery · Since 2010</p>
                    <p class="footer-desc">Premium handcrafted jewellery for those who appreciate timeless elegance and exceptional quality.</p>
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
                        <li><a href="#">Courses</a></li>
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
                        <li><i class="bi bi-geo-alt"></i> 123, Jewelry Lane, Koregaon Park, Pune, Maharashtra 411001, India</li>
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

    <!-- =============================================
        SCRIPTS
    ============================================= -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger-btn');
            const mobileMenu = document.querySelector('.mobile-menu');

            if (hamburger && mobileMenu) {
                hamburger.addEventListener('click', function() {
                    const isOpen = mobileMenu.style.display === 'block';
                    mobileMenu.style.display = isOpen ? 'none' : 'block';
                });
            }

            // Navbar scroll effect
            const navbar = document.querySelector('.navbar-modern');
            if (navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }
        });
    </script>

</body>

</html>
