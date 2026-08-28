<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us · Aethelweave</title>
    <!-- Google Fonts: Cormorant Garamond & Plus Jakarta Sans -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
        /* =============================================
            RESET & BASE STYLES
        ============================================= */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FDFBF7;
            color: #2C2A29;
            -webkit-font-smoothing: antialiased;
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

        /* Desktop nav visible */
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

        /* Mobile nav hidden by default */
        @media (max-width: 767px) {
            .nav-links-desktop {
                display: none;
            }
            .hamburger-btn {
                display: flex;
            }
        }

        /* =============================================
            CONTACT PAGE STYLES
        ============================================= */

        /* Container */
        .contact-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px 60px;
        }

        /* Header */
        .contact-header {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 50px;
        }

        .contact-eyebrow {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: #A58B54;
            margin-bottom: 10px;
        }

        .contact-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3rem;
            font-weight: 500;
            color: #2C2A29;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .contact-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .contact-divider-line {
            width: 50px;
            height: 1px;
            background: rgba(165, 139, 84, 0.4);
        }

        .contact-divider-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(165, 139, 84, 0.6);
        }

        .contact-subtitle {
            font-size: 0.95rem;
            color: #6B6A69;
            line-height: 1.8;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Grid Layout */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }

        @media (min-width: 992px) {
            .contact-grid {
                grid-template-columns: 7fr 5fr;
                gap: 50px;
            }
        }

        /* =============================================
            SUPPORT CARDS
        ============================================= */
        .support-cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (min-width: 480px) {
            .support-cards {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .support-card {
            background: #FFFFFF;
            padding: 24px 16px;
            border-radius: 12px;
            border: 1px solid #E8E2D2;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .support-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px -8px rgba(0, 0, 0, 0.06);
            border-color: #A58B54;
        }

        .support-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #F5EEDC;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #A58B54;
            font-size: 22px;
            margin-bottom: 10px;
            flex-shrink: 0;
        }

        .support-title {
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #8A8A8A;
            margin-bottom: 4px;
        }

        .support-value {
            font-size: 0.85rem;
            font-weight: 500;
            color: #2C2A29;
        }

        .support-value-small {
            font-size: 0.7rem;
        }

        /* =============================================
            MAP SECTION
        ============================================= */
        .map-section {
            background: #FFFFFF;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #E8E2D2;
            transition: all 0.3s ease;
        }

        .map-section:hover {
            box-shadow: 0 16px 32px -10px rgba(44, 42, 41, 0.06);
        }

        .map-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .map-badge {
            font-size: 0.55rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #A58B54;
            background: #FDFBF7;
            padding: 4px 14px;
            border-radius: 20px;
            border: 1px solid #E8E2D2;
        }

        .map-link {
            font-size: 0.7rem;
            color: #A58B54;
            text-decoration: none;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .map-link:hover {
            color: #2C2A29;
        }

        .map-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            border: 1px solid #E8E2D2;
            height: 220px;
            margin-bottom: 14px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            display: block;
            border: none;
        }

        .map-address {
            text-align: center;
        }

        .map-address-label {
            font-size: 0.55rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #9A9A9A;
            margin-bottom: 2px;
        }

        .map-address-text {
            font-size: 0.8rem;
            color: #2C2A29;
            font-weight: 500;
        }

        /* =============================================
            CONTACT FORM
        ============================================= */
        .contact-form-card {
            background: #FFFFFF;
            padding: 32px 28px;
            border-radius: 12px;
            border: 1px solid #E8E2D2;
            transition: all 0.3s ease;
        }

        .contact-form-card:hover {
            box-shadow: 0 16px 32px -10px rgba(44, 42, 41, 0.06);
        }

        .form-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 500;
            color: #2C2A29;
            margin-bottom: 2px;
        }

        .form-subheading {
            font-size: 0.75rem;
            color: #8A8A8A;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 480px) {
            .form-group-row {
                grid-template-columns: 1fr;
            }
        }

        .form-label {
            display: block;
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #777;
            margin-bottom: 4px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            font-size: 0.85rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: rgba(253, 251, 247, 0.5);
            border: 1px solid #E8E2D2;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: #2C2A29;
        }

        .form-control:focus {
            outline: none;
            border-color: #A58B54;
            box-shadow: 0 0 0 3px rgba(165, 139, 84, 0.15);
        }

        .form-control::placeholder {
            color: #B5B5B5;
        }

        .form-select {
            width: 100%;
            padding: 10px 14px;
            font-size: 0.85rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: rgba(253, 251, 247, 0.5);
            border: 1px solid #E8E2D2;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: #2C2A29;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%238A8A8A' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #A58B54;
            box-shadow: 0 0 0 3px rgba(165, 139, 84, 0.15);
        }

        .form-textarea {
            width: 100%;
            padding: 10px 14px;
            font-size: 0.85rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: rgba(253, 251, 247, 0.5);
            border: 1px solid #E8E2D2;
            border-radius: 8px;
            resize: vertical;
            min-height: 110px;
            transition: all 0.3s ease;
            color: #2C2A29;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #A58B54;
            box-shadow: 0 0 0 3px rgba(165, 139, 84, 0.15);
        }

        .form-textarea::placeholder {
            color: #B5B5B5;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #A58B54;
            color: #FFFFFF;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-submit:hover {
            background: #8F753D;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(165, 139, 84, 0.3);
        }

        .alert-success {
            padding: 12px 16px;
            background: #E8F5E9;
            border: 1px solid #A5D6A7;
            border-radius: 8px;
            color: #2E7D32;
            font-size: 0.8rem;
            margin-bottom: 16px;
        }

        /* =============================================
            FOOTER NOTE
        ============================================= */
        .contact-footer-note {
            text-align: center;
            margin-top: 50px;
            padding-top: 24px;
            border-top: 1px solid rgba(232, 226, 210, 0.4);
            font-size: 0.55rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #9A9A9A;
        }

        .contact-footer-note span {
            color: rgba(165, 139, 84, 0.6);
        }

        /* =============================================
            RESPONSIVE
        ============================================= */
        @media (max-width: 991px) {
            body {
                padding-top: 70px;
            }

            .contact-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 767px) {
            body {
                padding-top: 65px;
            }

            .contact-wrapper {
                padding: 30px 16px 40px;
            }

            .contact-title {
                font-size: 2rem;
            }

            .contact-subtitle {
                font-size: 0.85rem;
            }

            .contact-form-card {
                padding: 24px 18px;
            }

            .support-cards {
                gap: 12px;
            }

            .support-card {
                padding: 18px 12px;
            }

            .support-icon {
                width: 42px;
                height: 42px;
                font-size: 18px;
            }

            .map-container {
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding-top: 60px;
            }

            .contact-title {
                font-size: 1.7rem;
            }

            .contact-form-card {
                padding: 18px 14px;
            }

            .support-card {
                padding: 14px 10px;
            }

            .support-icon {
                width: 36px;
                height: 36px;
                font-size: 15px;
            }

            .support-value {
                font-size: 0.75rem;
            }

            .form-control,
            .form-select,
            .form-textarea {
                padding: 8px 12px;
                font-size: 0.8rem;
            }

            .map-container {
                height: 150px;
            }

            .map-address-text {
                font-size: 0.7rem;
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
                <li><a href="{{ route('contact-us') }}" class="active">Contact</a></li>
            </ul>

            <!-- Right Icons -->
            <div class="navbar-icons">
                <a href="#" class="navbar-icon">
                    <i class="bi bi-search"></i>
                </a>
                <a href="#" class="navbar-icon">
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
                <li><a href="{{ route('contact-us') }}" class="active">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- =============================================
        CONTACT PAGE CONTENT
    ============================================= -->
    <div class="contact-wrapper">

        <!-- HEADER -->
        <div class="contact-header">
            <span class="contact-eyebrow">We're Here To Help</span>
            <h1 class="contact-title">Let's Connect With Us</h1>
            <div class="contact-divider">
                <span class="contact-divider-line"></span>
                <span class="contact-divider-dot"></span>
                <span class="contact-divider-line"></span>
            </div>
            <p class="contact-subtitle">
                Have a question about our jewelry, orders, shipping, or anything else? Our expert team is always happy
                to assist. Reach out, and we'll be delighted to help you find the perfect piece or resolve your query.
            </p>
        </div>

        <!-- GRID -->
        <div class="contact-grid">

            <!-- LEFT COLUMN -->
            <div>

                <!-- Support Cards -->
                <div class="support-cards">

                    <!-- WhatsApp -->
                    <div class="support-card">
                        <div class="support-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <h3 class="support-title">WhatsApp</h3>
                        <p class="support-value">+91 98765 43210</p>
                    </div>

                    <!-- Call -->
                    <div class="support-card">
                        <div class="support-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <h3 class="support-title">Call Us</h3>
                        <p class="support-value">+91 98765 43210</p>
                    </div>

                    <!-- Email -->
                    <div class="support-card">
                        <div class="support-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h3 class="support-title">Email</h3>
                        <p class="support-value support-value-small">support@aethelweave.com</p>
                    </div>

                </div>

                <!-- Map -->
                <div class="map-section">
                    <div class="map-header">
                        <span class="map-badge"><i class="bi bi-geo-alt"></i> Find Us</span>
                        <a href="https://maps.google.com" target="_blank" class="map-link">
                            Open in Maps <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.5936087570146!2d73.8870!3d18.5362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTjCsDMyJzEwLjQiTiA3M8KwNTMnMTMuMiJF!5e0!3m2!1sen!2sin!4v1620000000000"
                            loading="lazy"
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="map-address">
                        <p class="map-address-label">Visit Our Boutique</p>
                        <p class="map-address-text">123, Jewelry Lane, Koregaon Park, Pune, Maharashtra 411001, India</p>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN - FORM -->
            <div class="contact-form-card">
                <h2 class="form-heading">Get In Touch</h2>
                <p class="form-subheading">Speak with our jewellery consultant</p>

                @if(session('success'))
                    <div class="alert-success">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact-inquiry.store') }}" method="POST">
                    @csrf

                    <div class="form-group-row">
                        <div class="form-group">
                            <label class="form-label">First Name *</label>
                            <input type="text" name="first_name" required placeholder="Enter your first name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name *</label>
                            <input type="text" name="last_name" required placeholder="Enter your last name" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" required placeholder="Enter your email" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">I am Interested In... *</label>
                        <select name="interest" required class="form-select">
                            <option value="" disabled selected>I am Interested In...</option>
                            <option value="Rings">Rings & Bands</option>
                            <option value="Necklaces">Necklaces & Chains</option>
                            <option value="Bracelets">Bracelets & Bangles</option>
                            <option value="Custom">Custom Design Consultation</option>
                            <option value="Other">General Inquiry</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tell us your enquiry *</label>
                        <textarea name="message" rows="4" required placeholder="Enter your message" class="form-textarea"></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        Submit Your Enquiry
                    </button>
                </form>
            </div>

        </div>

        <!-- Footer Note -->
        <div class="contact-footer-note">
            <span>✦</span> Aethelweave · artisan jewellery
        </div>

    </div>

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
