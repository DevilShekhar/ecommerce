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
    <meta name="user-logged-in" content="{{ Auth::check() ? 'true' : 'false' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    @php
        $siteLogo = \App\Models\Logo::first();
    @endphp

    <link rel="icon"
        href="{{ $siteLogo?->favicon ? asset('storage/' . $siteLogo->favicon) : asset('assets/admin/images/favicon.ico') }}"
        type="image/x-icon">

    <style>
        /* ========== SEARCH MODAL ========== */
        .search-modal {
            position: fixed;
            inset: 0;
            z-index: 10000;
            display: none;
            align-items: flex-start;
            justify-content: center;
            padding: 80px 20px 40px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .search-modal.is-open {
            display: flex;
            opacity: 1;
        }

        .search-modal-overlay {
            position: absolute;
            inset: 0;
            background: rgba(20, 18, 15, 0.72);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }

        .search-modal-content {
            position: relative;
            width: 100%;
            max-width: 640px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transform: translateY(-12px);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .search-modal.is-open .search-modal-content {
            transform: translateY(0);
        }

        .search-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 20px;
            border-bottom: 1px solid #f0ebe3;
        }

        .search-input-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #faf8f5;
            border: 1.5px solid #e8e2d9;
            border-radius: 12px;
            padding: 0 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input-wrapper:focus-within {
            border-color: #A58B54;
            box-shadow: 0 0 0 3px rgba(165, 139, 84, 0.15);
            background: #fff;
        }

        .search-icon {
            color: #A58B54;
            font-size: 18px;
            flex-shrink: 0;
        }

        #searchInput {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            color: #2c2a26;
            padding: 14px 0;
        }

        #searchInput::placeholder {
            color: #a8a29e;
        }

        .search-clear-btn {
            background: none;
            border: none;
            color: #a8a29e;
            font-size: 14px;
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s, background 0.15s;
        }

        .search-clear-btn:hover {
            color: #2c2a26;
            background: #f0ebe3;
        }

        .search-close-btn {
            background: none;
            border: none;
            color: #78716c;
            font-size: 20px;
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s, color 0.15s;
            flex-shrink: 0;
        }

        .search-close-btn:hover {
            background: #f5f0eb;
            color: #2c2a26;
        }

        /* Results area */
        #searchResults {
            max-height: 55vh;
            overflow-y: auto;
            display: none;
        }

        #searchResults::-webkit-scrollbar {
            width: 6px;
        }

        #searchResults::-webkit-scrollbar-track {
            background: transparent;
        }

        #searchResults::-webkit-scrollbar-thumb {
            background: #e8e2d9;
            border-radius: 3px;
        }

        .search-section-title {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #A58B54;
            margin: 0 0 10px;
            padding: 0 4px;
        }

        .search-categories {
            padding: 16px 20px 8px;
        }

        .search-cat-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .search-cat-pill {
            background: #f8f6f1;
            color: #44403c;
            padding: 6px 14px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid #ebe6df;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }

        .search-cat-pill:hover {
            background: #A58B54;
            border-color: #A58B54;
            color: #fff;
        }

        .search-products {
            padding: 12px 20px 20px;
            border-top: 1px solid #f0ebe3;
        }

        .search-product-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none;
            color: #2c2a26;
            transition: background 0.15s;
            margin-bottom: 4px;
        }

        .search-product-item:hover {
            background: #faf8f5;
        }

        .search-product-img {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 10px;
            background: #f0ebe3;
            flex-shrink: 0;
        }

        .search-product-img-placeholder {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: #f0ebe3;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #c4bdb4;
            font-size: 18px;
        }

        .search-product-info {
            flex: 1;
            min-width: 0;
        }

        .search-product-name {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-product-price {
            color: #A58B54;
            font-weight: 600;
            font-size: 14px;
        }

        .search-empty,
        .search-loading,
        .search-error {
            padding: 48px 24px;
            text-align: center;
            color: #a8a29e;
            font-size: 14px;
        }

        .search-empty i,
        .search-loading i,
        .search-error i {
            font-size: 28px;
            display: block;
            margin-bottom: 12px;
            opacity: 0.6;
        }

        .search-error {
            color: #b91c1c;
        }

        /* Category quick links (shown when empty) */
        #categoryLinks {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
        }

        #categoryLinks a {
            background: #f8f6f1;
            color: #44403c;
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid #ebe6df;
            transition: all 0.15s;
        }

        #categoryLinks a:hover {
            background: #A58B54;
            border-color: #A58B54;
            color: #fff;
        }

        .search-hint {
            text-align: center;
            padding: 8px 20px 20px;
            font-size: 12px;
            color: #a8a29e;
        }

        .search-hint kbd {
            background: #f0ebe3;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            font-family: inherit;
            color: #78716c;
        }

        @media (max-width: 576px) {
            .search-modal {
                padding: 40px 12px 20px;
            }

            .search-modal-content {
                border-radius: 14px;
            }

            .search-header {
                padding: 14px 14px;
            }

            #searchResults {
                max-height: 60vh;
            }
        }

        /* Wishlist Panel - Minimal CSS */
        .wishlist-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .wishlist-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .wishlist-panel {
            position: fixed;
            top: 0;
            right: -420px;
            width: 420px;
            max-width: 100%;
            height: 100%;
            background: #FCFAF6;
            z-index: 9999;
            box-shadow: -4px 0 30px rgba(0, 0, 0, 0.1);
            transition: right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: flex;
            flex-direction: column;
        }

        .wishlist-panel.open {
            right: 0;
        }

        .wishlist-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            border-bottom: 1px solid #E8E1D7;
            background: #fff;
            flex-shrink: 0;
        }

        .wishlist-panel-header h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            color: #292725;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .wishlist-panel-header h2 i {
            color: #e74c3c;
        }

        .wishlist-panel-header .close-btn {
            width: 34px;
            height: 34px;
            border: none;
            background: #F4EFE7;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
            color: #292725;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wishlist-panel-header .close-btn:hover {
            background: #e74c3c;
            color: #fff;
            transform: rotate(90deg);
        }

        .wishlist-panel-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px 24px;
        }

        .wishlist-panel-body::-webkit-scrollbar {
            width: 4px;
        }

        .wishlist-panel-body::-webkit-scrollbar-track {
            background: #F4EFE7;
        }

        .wishlist-panel-body::-webkit-scrollbar-thumb {
            background: #B89B5E;
            border-radius: 4px;
        }

        .wishlist-panel-empty {
            text-align: center;
            padding: 60px 20px;
        }

        .wishlist-panel-empty i {
            font-size: 48px;
            color: #D5CFC5;
            display: block;
            margin-bottom: 12px;
        }

        .wishlist-panel-empty h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            color: #292725;
            margin-bottom: 4px;
        }

        .wishlist-panel-empty p {
            color: #77736D;
            font-size: 14px;
        }

        .wishlist-panel-item {
            display: flex;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid #F0EAE0;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .wishlist-panel-item:last-child {
            border-bottom: none;
        }

        .wishlist-panel-item-image {
            width: 70px;
            height: 70px;
            flex-shrink: 0;
            border-radius: 8px;
            overflow: hidden;
            background: #F4EFE7;
        }

        .wishlist-panel-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .wishlist-panel-item-info {
            flex: 1;
            min-width: 0;
        }

        .wishlist-panel-item-info h4 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            font-weight: 500;
            color: #292725;
            margin: 0 0 2px 0;
        }

        .wishlist-panel-item-info h4 a {
            text-decoration: none;
            color: inherit;
        }

        .wishlist-panel-item-info h4 a:hover {
            color: #B89B5E;
        }

        .wishlist-panel-item-info .price {
            font-size: 15px;
            font-weight: 700;
            color: #292725;
            margin-bottom: 6px;
        }

        .wishlist-panel-item-actions {
            display: flex;
            gap: 6px;
        }

        .wishlist-panel-item-actions .btn-add-cart {
            padding: 3px 12px;
            background: #B89B5E;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .wishlist-panel-item-actions .btn-add-cart:hover {
            background: #967A3F;
        }

        .wishlist-panel-item-actions .btn-remove {
            padding: 3px 10px;
            background: #f8f0ec;
            color: #e74c3c;
            border: none;
            border-radius: 5px;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
        }

        .wishlist-panel-item-actions .btn-remove:hover {
            background: #e74c3c;
            color: #fff;
        }

        .wishlist-panel-footer {
            padding: 14px 24px;
            border-top: 1px solid #E8E1D7;
            background: #fff;
            flex-shrink: 0;
            display: flex;
            gap: 10px;
        }

        .wishlist-panel-footer .btn-view-all {
            flex: 1;
            padding: 10px;
            background: #B89B5E;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .wishlist-panel-footer .btn-view-all:hover {
            background: #967A3F;
        }

        .wishlist-panel-footer .btn-clear-all {
            padding: 10px 16px;
            background: transparent;
            color: #e74c3c;
            border: 1px solid #e74c3c;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .wishlist-panel-footer .btn-clear-all:hover {
            background: #e74c3c;
            color: #fff;
        }

        /* Navbar badge */
        .navbar-wishlist-count {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #A58B54;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .wishlist-icon {
            position: relative;
        }

        .wishlist-icon i {
            transition: color 0.3s ease;
        }

        .wishlist-icon:hover i {
            color: #e74c3c;
        }

        @media (max-width: 768px) {
            .wishlist-panel {
                width: 100%;
                right: -100%;
            }

            .wishlist-panel-header h2 {
                font-size: 18px;
            }

            .wishlist-panel-item-image {
                width: 56px;
                height: 56px;
            }

            .wishlist-panel-item-info h4 {
                font-size: 13px;
            }

            .wishlist-panel-item-info .price {
                font-size: 13px;
            }

            .wishlist-panel-body {
                padding: 16px;
            }
        }

        /* Cart badge */
        .navbar-cart-count {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #B89B5E;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-icon {
            position: relative;
        }

        /* Cart Panel - additional styles */
        #cartPanel .wishlist-panel-header h2 i {
            color: #B89B5E;
        }

        #cartPanel .btn-view-all {
            background: #B89B5E;
        }

        #cartPanel .btn-view-all:hover {
            background: #967A3F;
        }

        #cartPanel .btn-clear-all {
            color: #e74c3c;
            border-color: #e74c3c;
        }

        #cartPanel .btn-clear-all:hover {
            background: #e74c3c;
            color: #fff;
        }

        #cartPanel .wishlist-panel-item-info .price {
            color: #292725;
        }

        /* Quantity buttons in cart */
        .quantity-btn {
            width: 28px;
            height: 28px;
            border: 1px solid #E8E1D7;
            border-radius: 6px;
            background: #fff;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            color: #292725;
        }

        .quantity-btn:hover {
            background: #F4EFE7;
            border-color: #B89B5E;
        }

        .quantity-value {
            font-size: 14px;
            font-weight: 600;
            min-width: 24px;
            text-align: center;
            color: #292725;
        }

        /* Spin animation */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- =============================================
        NAVBAR
    ============================================= -->
    <nav class="navbar-modern">
        <div class="navbar-container">
            <!-- Logo -->
            @php
                $siteLogo = \App\Models\Logo::first();
            @endphp

            <a href="{{ url('/') }}" class="navbar-logo">
                @if($siteLogo && $siteLogo->logo)
                    <img src="{{ asset('storage/' . $siteLogo->logo) }}" alt="{{ $siteLogo->site_name ?? 'Logo' }}"
                        class="navbar-logo-image">
                @else
                    <span class="navbar-logo-text">
                        {{ $siteLogo->site_name ?? 'Aethelweave' }}
                    </span>
                    <span class="navbar-logo-badge">Artisan</span>
                @endif
            </a>

            <!-- Nav Links - Desktop -->
            <ul class="nav-links-desktop">
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
            </ul>

            <!-- Right Icons -->
            <div class="navbar-icons">
                <!-- Search Icon -->
                @if(!Auth::check())
                    <a href="#" onclick="event.preventDefault(); openSearch();" class="navbar-icon" aria-label="Search">
                        <i class="bi bi-search"></i>
                    </a>
                @endif

                <!-- Wishlist Icon -->
                <a href="#" class="navbar-icon wishlist-icon" onclick="event.preventDefault(); toggleWishlistPanel();"
                    aria-label="Wishlist">
                    <i class="bi bi-heart"></i>
                    <span class="navbar-wishlist-count" id="wishlistCount">0</span>
                </a>

                <a href="{{ route('login') }}" class="navbar-icon">
                    <i class="bi bi-person"></i>
                </a>

                <!-- Cart Icon -->
                <a href="#" class="navbar-icon cart-icon" onclick="event.preventDefault(); toggleCartPanel();">
                    <i class="bi bi-bag"></i>
                    <span class="navbar-cart-count" id="cartCount">0</span>
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
                <li><a href="#" onclick="event.preventDefault(); toggleWishlistPanel();"><i class="bi bi-heart"
                            style="color:#B89B5E;"></i> Wishlist <span id="mobileWishlistCount"
                            style="background:#B89B5E;color:#fff;padding:1px 8px;border-radius:50%;font-size:10px;margin-left:5px;">0</span></a>
                </li>
                <li><a href="#" onclick="event.preventDefault(); toggleCartPanel();"><i class="bi bi-bag"
                            style="color:#B89B5E;"></i> Cart <span id="mobileCartCount"
                            style="background:#B89B5E;color:#fff;padding:1px 8px;border-radius:50%;font-size:10px;margin-left:5px;">0</span></a>
                </li>
                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
            </ul>
        </div>
    </nav>

    {{-- ================= SEARCH MODAL ================= --}}
    <div id="searchModal" class="search-modal" role="dialog" aria-modal="true" aria-label="Search">

        <div class="search-modal-overlay" onclick="closeSearch()"></div>

        <div class="search-modal-content">

            <div class="search-header">

                <div class="search-input-wrapper">

                    <i class="bi bi-search search-icon"></i>

                    <input type="text" id="searchInput" placeholder="Search jewellery, collections..."
                        autocomplete="off" oninput="doSearch(this.value)" aria-label="Search">

                    <button type="button" onclick="clearSearch()" id="clearBtn" class="search-clear-btn"
                        style="display:none;" aria-label="Clear search">
                        <i class="bi bi-x-lg"></i>
                    </button>

                </div>

                <button type="button" class="search-close-btn" onclick="closeSearch()" aria-label="Close search">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <div id="searchResults"></div>

            {{-- Quick Category Links --}}
            <div id="categoryLinks">

                @if(isset($categories) && $categories->count())

                    @foreach($categories as $cat)

                        <a href="{{ route('shop', ['category' => $cat->slug]) }}">
                            {{ $cat->name }}
                        </a>

                    @endforeach

                @endif

            </div>

            <div class="search-hint" id="searchHint">
                Press <kbd>Esc</kbd> to close
            </div>

        </div>
    </div>

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
                    <a href="{{ route('privacy-policy.index') }}">Privacy Policy</a>
                    <a href="{{ route('terms-conditions') }}">Terms of Use</a>
                    <a href="{{ route('disclaimer') }}">Disclaimer</a>
                    <a href="{{ route('sitemap') }}">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // =============================================
        // SEARCH FUNCTIONS
        // =============================================
        let searchTimeout;

        function openSearch() {
            const modal = document.getElementById('searchModal');
            const input = document.getElementById('searchInput');
            if (!modal) return;
            modal.style.display = 'flex';
            requestAnimationFrame(() => {
                modal.classList.add('is-open');
            });
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                if (input) input.focus();
            }, 120);
        }

        function closeSearch() {
            const modal = document.getElementById('searchModal');
            const input = document.getElementById('searchInput');
            const results = document.getElementById('searchResults');
            const clearBtn = document.getElementById('clearBtn');
            const categoryLinks = document.getElementById('categoryLinks');
            const searchHint = document.getElementById('searchHint');
            if (!modal) return;
            modal.classList.remove('is-open');
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                if (input) input.value = '';
                if (results) { results.style.display = 'none'; results.innerHTML = ''; }
                if (clearBtn) clearBtn.style.display = 'none';
                if (categoryLinks) categoryLinks.style.display = 'flex';
                if (searchHint) searchHint.style.display = 'block';
            }, 250);
        }

        function clearSearch() {
            const input = document.getElementById('searchInput');
            const results = document.getElementById('searchResults');
            const clearBtn = document.getElementById('clearBtn');
            const categoryLinks = document.getElementById('categoryLinks');
            const searchHint = document.getElementById('searchHint');
            if (input) { input.value = ''; input.focus(); }
            if (results) { results.style.display = 'none'; results.innerHTML = ''; }
            if (clearBtn) clearBtn.style.display = 'none';
            if (categoryLinks) categoryLinks.style.display = 'flex';
            if (searchHint) searchHint.style.display = 'block';
        }

        function doSearch(query) {
            const results = document.getElementById('searchResults');
            const clearBtn = document.getElementById('clearBtn');
            const links = document.getElementById('categoryLinks');
            const hint = document.getElementById('searchHint');

            if (!results) return;

            query = query.trim();

            // Empty search
            if (query.length === 0) {
                if (clearBtn) clearBtn.style.display = 'none';
                results.style.display = 'none';
                results.innerHTML = '';
                if (links) links.style.display = 'flex';
                if (hint) hint.style.display = 'block';
                clearTimeout(searchTimeout);
                return;
            }

            // Search started
            if (clearBtn) clearBtn.style.display = 'flex';
            if (links) links.style.display = 'none';
            if (hint) hint.style.display = 'none';

            results.style.display = 'block';
            results.innerHTML = `
        <div class="search-loading">
            <i class="bi bi-hourglass-split"></i>
            Searching...
        </div>
    `;

            // Clear previous timeout
            clearTimeout(searchTimeout);

            // Delay search by 300ms
            searchTimeout = setTimeout(() => {
                const searchUrl = `/search?q=${encodeURIComponent(query)}`;

                fetch(searchUrl, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Search request failed');
                        }
                        return response.json();
                    })
                    .then(data => {
                        let html = '';

                        // ==========================================
                        // CATEGORIES
                        // ==========================================
                        if (data.categories && data.categories.length > 0) {
                            html += `
                    <div class="search-categories">
                        <h4 class="search-section-title">Categories</h4>
                        <div class="search-cat-pills">
                `;

                            data.categories.forEach(category => {
                                html += `
                        <a href="/shop?category=${encodeURIComponent(category.slug)}" class="search-cat-pill">
                            ${escapeHtml(category.name)}
                        </a>
                    `;
                            });

                            html += `
                        </div>
                    </div>
                `;
                        }

                        // ==========================================
                        // PRODUCTS - UPDATED WITH BOTH PRICES
                        // ==========================================
                        if (data.products && data.products.length > 0) {
                            html += `
                    <div class="search-products">
                        <h4 class="search-section-title">Products</h4>
                `;

                            data.products.forEach(product => {
                                // ==========================================
                                // GET ONLY FIRST IMAGE
                                // ==========================================
                                let imageUrl = '';

                                if (product.image) {
                                    const imagesArray = product.image
                                        .split(',')
                                        .map(s => s.trim())
                                        .filter(Boolean);

                                    const firstImage = imagesArray[0] || '';

                                    if (firstImage) {
                                        if (firstImage.startsWith('/storage/')) {
                                            imageUrl = firstImage;
                                        } else if (firstImage.startsWith('storage/')) {
                                            imageUrl = '/' + firstImage;
                                        } else {
                                            imageUrl = '/storage/' + firstImage.replace(/^\/+/, '');
                                        }
                                    }
                                }

                                // ==========================================
                                // GET PRICES - SELLING & ORIGINAL
                                // ==========================================
                                const sellingPrice = product.selling_price || product.price || 0;
                                const originalPrice = product.price || 0;
                                const hasDiscount = parseFloat(originalPrice) > parseFloat(sellingPrice);

                                html += `
                        <a href="/shop/${encodeURIComponent(product.slug)}" class="search-product-item">
                    `;

                                // Product Image
                                if (imageUrl) {
                                    html += `
                            <img
                                src="${imageUrl}"
                                alt="${escapeHtml(product.name ?? '')}"
                                class="search-product-img"
                                loading="lazy"
                                onerror="
                                    this.onerror=null;
                                    this.style.display='none';
                                    this.nextElementSibling.style.display='flex';
                                "
                            >
                            <div class="search-product-img-placeholder" style="display:none;">
                                <i class="bi bi-gem"></i>
                            </div>
                        `;
                                } else {
                                    html += `
                            <div class="search-product-img-placeholder">
                                <i class="bi bi-gem"></i>
                            </div>
                        `;
                                }

                                // ==========================================
                                // PRODUCT DETAILS WITH BOTH PRICES
                                // ==========================================
                                html += `
                            <div class="search-product-info">
                                <div class="search-product-name">
                                    ${escapeHtml(product.name ?? '')}
                                </div>
                                <div class="search-product-price">
                                    <span style="color:#198754;font-weight:700;">
                                        ₹${formatPrice(sellingPrice)}
                                    </span>
                                    ${hasDiscount ? `
                                        <span style="
                                            color:#888;
                                            font-size:12px;
                                            margin-left:5px;
                                            text-decoration:line-through;
                                            text-decoration-thickness:1px;
                                        ">
                                            ₹${formatPrice(originalPrice)}
                                        </span>
                                        <span style="
                                            color:#e74c3c;
                                            font-size:10px;
                                            margin-left:5px;
                                            font-weight:600;
                                            background:#fef0ef;
                                            padding:1px 6px;
                                            border-radius:3px;
                                        ">
                                            ${Math.round(((parseFloat(originalPrice) - parseFloat(sellingPrice)) / parseFloat(originalPrice)) * 100)}% OFF
                                        </span>
                                    ` : ''}
                                </div>
                            </div>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    `;
                            });

                            html += `
                    </div>
                `;
                        }

                        // ==========================================
                        // NO RESULTS
                        // ==========================================
                        if (!html) {
                            html = `
                    <div class="search-empty">
                        <i class="bi bi-search"></i>
                        <span>No results found for “${escapeHtml(query)}”</span>
                    </div>
                `;
                        }
                        results.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        results.innerHTML = `
                <div class="search-error">
                    <i class="bi bi-exclamation-circle"></i>
                    <span>Unable to load search results. Please try again.</span>
                </div>
            `;
                    });
            }, 300);
        }

        function formatPrice(price) {
            const number = parseFloat(price);
            if (isNaN(number)) return '0.00';
            return number.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function escapeHtml(value) {
            const div = document.createElement('div');
            div.textContent = value ?? '';
            return div.innerHTML;
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeSearch();
        });

        // =============================================
        // WISHLIST FUNCTIONS
        // =============================================

        function getWishlist() {
            try {
                const wishlist = localStorage.getItem('wishlist');
                return wishlist ? JSON.parse(wishlist) : [];
            } catch (e) {
                return [];
            }
        }

        function saveWishlist(wishlist) {
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
        }

        function isInWishlist(productId) {
            const wishlist = getWishlist();
            return wishlist.some(item => item.id == productId);
        }

        function updateWishlistCount() {
            const wishlist = getWishlist();
            const count = wishlist.length;

            const desktopCount = document.getElementById('wishlistCount');
            if (desktopCount) desktopCount.textContent = count;

            const mobileCount = document.getElementById('mobileWishlistCount');
            if (mobileCount) mobileCount.textContent = count;
        }

        function toggleWishlist(button, productId, productName, productPrice, productSlug, productImage, originalPrice = null) {
            event.stopPropagation();

            let wishlist = getWishlist();
            const existingIndex = wishlist.findIndex(item => item.id == productId);

            if (existingIndex > -1) {
                wishlist.splice(existingIndex, 1);
                saveWishlist(wishlist);

                const icon = button.querySelector('i');
                icon.className = 'bi bi-heart';
                icon.style.color = '#77736D';
                button.style.background = 'rgba(255,255,255,0.9)';
                button.style.borderColor = '#E8E1D7';

                showToast('Removed from wishlist', 'removed');
            } else {
                const sellingPriceValue = Number(productPrice);
                const originalPriceValue = (originalPrice !== null && originalPrice !== undefined)
                    ? Number(originalPrice)
                    : sellingPriceValue;

                wishlist.push({
                    id: productId,
                    name: productName,
                    selling_price: sellingPriceValue,
                    price: originalPriceValue,
                    slug: productSlug,
                    image: productImage,
                    addedAt: new Date().toISOString()
                });
                saveWishlist(wishlist);

                const icon = button.querySelector('i');
                icon.className = 'bi bi-heart-fill';
                icon.style.color = '#e74c3c';
                button.style.background = '#fff';
                button.style.borderColor = '#e74c3c';

                showToast('Added to wishlist ❤️', 'added');
            }

            const panel = document.getElementById('wishlistPanel');
            if (panel && panel.classList.contains('open')) {
                renderWishlistPanel();
            }
        }

        function toggleWishlistPanel() {
            const panel = document.getElementById('wishlistPanel');
            const overlay = document.getElementById('wishlistOverlay');
            panel.classList.toggle('open');
            overlay.classList.toggle('active');

            if (panel.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
                renderWishlistPanel();
            } else {
                document.body.style.overflow = '';
            }
        }

        function closeWishlistPanel() {
            const panel = document.getElementById('wishlistPanel');
            const overlay = document.getElementById('wishlistOverlay');
            panel.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        function renderWishlistPanel() {
            const container = document.getElementById('wishlistPanelBody');
            const wishlist = getWishlist();

            if (!wishlist || wishlist.length === 0) {
                container.innerHTML = `<div class="wishlist-panel-empty"><i class="bi bi-heart"></i><h3>Your wishlist is empty</h3><p>Start adding your favourite pieces!</p></div>`;
                return;
            }

            let html = '';
            wishlist.forEach((item, index) => {
                const imageUrl = item.image ? (item.image.startsWith('http') ? item.image : '/' + item.image) : 'https://via.placeholder.com/70x70/F4EFE7/77736D?text=No+Image';
                const cart = getCart();
                const inCart = cart.some(cartItem => cartItem.id == item.id);

                const sellingPrice = Number(item.selling_price ?? item.price ?? 0);
                const originalPrice = Number(item.price ?? item.selling_price ?? 0);
                const hasDiscount = originalPrice > sellingPrice;

                html += `<div class="wishlist-panel-item" style="animation-delay: ${index * 0.05}s">
            <div class="wishlist-panel-item-image">
                <img src="${imageUrl}" alt="${item.name}" loading="lazy" onerror="this.src='https://via.placeholder.com/70x70/F4EFE7/77736D?text=No+Image'">
            </div>
            <div class="wishlist-panel-item-info">
                <h4><a href="/shop/${item.slug}" onclick="closeWishlistPanel()">${escapeHtml(item.name)}</a></h4>

                <div class="price" style="margin-bottom:4px;">
                    <span style="color:#198754;font-weight:700;font-size:15px;">
                        ₹${sellingPrice.toLocaleString('en-IN')}
                    </span>
                    ${hasDiscount ? `
                        <span style="color:#888;font-size:12px;margin-left:5px;text-decoration:line-through;text-decoration-thickness:1px;">
                            ₹${originalPrice.toLocaleString('en-IN')}
                        </span>
                        <span style="color:#e74c3c;font-size:10px;margin-left:5px;font-weight:600;background:#fef0ef;padding:1px 6px;border-radius:3px;">
                            ${Math.round(((originalPrice - sellingPrice) / originalPrice) * 100)}% OFF
                        </span>
                    ` : ''}
                </div>

                <div class="wishlist-panel-item-actions">
                    <button class="btn-add-cart" onclick="event.stopPropagation(); addToCartFromWishlist(${item.id})">
                        <i class="bi ${inCart ? 'bi-check-lg' : 'bi-cart-plus'}"></i> ${inCart ? 'In Cart' : 'Add to Cart'}
                    </button>
                    <button class="btn-remove" onclick="event.stopPropagation(); removeFromWishlistPanel(${item.id})">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
        </div>`;
            });
            container.innerHTML = html;
        }

        function removeFromWishlistPanel(productId) {
            let wishlist = getWishlist();
            wishlist = wishlist.filter(item => item.id != productId);
            saveWishlist(wishlist);
            renderWishlistPanel();
            showToast('Removed from wishlist', 'removed');
        }

        function clearAllWishlist() {
            if (getWishlist().length === 0) return;
            if (confirm('Are you sure you want to clear your entire wishlist?')) {
                saveWishlist([]);
                renderWishlistPanel();
                showToast('Wishlist cleared', 'removed');
            }
        }

        function initWishlistButtons() {
            document.querySelectorAll('.wishlist-btn').forEach(button => {
                const productId = button.dataset.productId;
                if (isInWishlist(productId)) {
                    const icon = button.querySelector('i');
                    icon.className = 'bi bi-heart-fill';
                    icon.style.color = '#e74c3c';
                    button.style.borderColor = '#e74c3c';
                    button.style.background = '#fff';
                } else {
                    const icon = button.querySelector('i');
                    icon.className = 'bi bi-heart';
                    icon.style.color = '#77736D';
                    button.style.borderColor = '#E8E1D7';
                    button.style.background = 'rgba(255,255,255,0.9)';
                }
            });
            updateWishlistCount();
        }

        // =============================================
        // CART FUNCTIONS
        // =============================================

        function getCart() {
            try {
                const cart = localStorage.getItem('cart');
                return cart ? JSON.parse(cart) : [];
            } catch (e) {
                return [];
            }
        }

        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }

        function updateCartCount() {
            const cart = getCart();
            const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);

            const cartCount = document.getElementById('cartCount');
            if (cartCount) cartCount.textContent = totalItems;

            const mobileCartCount = document.getElementById('mobileCartCount');
            if (mobileCartCount) mobileCartCount.textContent = totalItems;
        }

        function addToCartFromWishlist(productId) {
            event.stopPropagation();

            const wishlist = getWishlist();
            const product = wishlist.find(item => item.id == productId);

            if (!product) {
                showToast('Product not found', 'removed');
                return;
            }

            let cart = getCart();
            const existingIndex = cart.findIndex(item => item.id == productId);

            if (existingIndex > -1) {
                cart[existingIndex].quantity = (cart[existingIndex].quantity || 1) + 1;
                showToast('Quantity updated in cart', 'added');
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    selling_price: Number(product.selling_price || product.price || 0),
                    price: Number(product.price || product.selling_price || 0),
                    slug: product.slug,
                    image: product.image,
                    quantity: 1
                });
                showToast('Added to cart 🛒', 'added');
            }

            saveCart(cart);

            if (document.getElementById('cartPanel')?.classList.contains('open')) {
                renderCartPanel();
            }
        }

        function addToCartFromCard(button, productId, productName, productPrice, productSlug, productImage, originalPrice = null) {
            event.stopPropagation();

            let cart = getCart();
            const existingIndex = cart.findIndex(item => item.id == productId);

            const originalText = button.innerHTML;
            button.innerHTML = '<i class="bi bi-arrow-repeat" style="font-size:12px;animation:spin 1s linear infinite;"></i> Adding...';
            button.style.opacity = '0.7';
            button.disabled = true;

            setTimeout(() => {
                const sellingPriceValue = Number(productPrice);
                const originalPriceValue = (originalPrice !== null && originalPrice !== undefined)
                    ? Number(originalPrice)
                    : sellingPriceValue;

                console.log('Adding to cart:', {
                    productId,
                    productName,
                    selling_price: sellingPriceValue,
                    price: originalPriceValue,
                    hasDiscount: originalPriceValue > sellingPriceValue
                });

                if (existingIndex > -1) {
                    cart[existingIndex].quantity = (cart[existingIndex].quantity || 1) + 1;
                    cart[existingIndex].selling_price = sellingPriceValue;
                    cart[existingIndex].price = originalPriceValue;
                    showToast('Quantity updated in cart', 'added');
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        selling_price: sellingPriceValue,
                        price: originalPriceValue,
                        slug: productSlug,
                        image: productImage,
                        quantity: 1
                    });
                    showToast('Added to cart 🛒', 'added');
                }

                saveCart(cart);

                button.innerHTML = '<i class="bi bi-check-lg" style="font-size:12px;"></i> In Cart';
                button.style.background = '#27ae60';
                button.disabled = false;
                button.style.opacity = '1';

                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.style.background = '#B89B5E';
                }, 2000);

                if (document.getElementById('cartPanel')?.classList.contains('open')) {
                    renderCartPanel();
                }
            }, 400);
        }

        // =============================================
        // CART PANEL FUNCTIONS
        // =============================================

        function toggleCartPanel() {
            let panel = document.getElementById('cartPanel');
            let overlay = document.getElementById('cartOverlay');

            if (!panel || !overlay) {
                createCartPanel();
                panel = document.getElementById('cartPanel');
                overlay = document.getElementById('cartOverlay');
            }

            panel.classList.toggle('open');
            overlay.classList.toggle('active');

            if (panel.classList.contains('open')) {
                document.body.style.overflow = 'hidden';
                renderCartPanel();
            } else {
                document.body.style.overflow = '';
            }
        }

        function closeCartPanel() {
            const panel = document.getElementById('cartPanel');
            const overlay = document.getElementById('cartOverlay');
            if (panel) panel.classList.remove('open');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        function createCartPanel() {
            if (document.getElementById('cartPanel')) return;

            const overlay = document.createElement('div');
            overlay.id = 'cartOverlay';
            overlay.className = 'wishlist-overlay';
            overlay.onclick = closeCartPanel;
            document.body.appendChild(overlay);

            const panel = document.createElement('div');
            panel.id = 'cartPanel';
            panel.className = 'wishlist-panel';

            panel.innerHTML = `
        <div class="wishlist-panel-header">
            <h2><i class="bi bi-bag"></i> My Cart</h2>
            <button class="close-btn" onclick="closeCartPanel()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="wishlist-panel-body" id="cartPanelBody">
            <div class="wishlist-panel-empty">
                <i class="bi bi-bag"></i>
                <h3>Your cart is empty</h3>
                <p>Start shopping to add items!</p>
            </div>
        </div>
        <div class="wishlist-panel-footer" id="cartPanelFooter">
            <div style="flex:1;padding:4px 0;">
                <div style="display:flex;justify-content:space-between;font-size:14px;margin-bottom:8px;">
                    <span style="color:#77736D;">Total:</span>
                    <span style="font-weight:700;color:#292725;font-size:18px;" id="cartTotal">₹0</span>
                </div>
                <a href="#" class="btn-view-all" style="display:block;text-align:center;" id="continueShoppingBtn">
                    <i class="bi bi-box-arrow-in-right"></i> Login to Continue
                </a>
            </div>
            <button class="btn-clear-all" onclick="clearAllCart()" style="flex:0 0 auto;">
                <i class="bi bi-trash3"></i>
            </button>
        </div>
    `;

            document.body.appendChild(panel);

            document.getElementById('continueShoppingBtn').addEventListener('click', function (e) {
                e.preventDefault();
                const cart = getCart();
                if (cart.length === 0) {
                    window.location.href = "{{ route('login') }}";
                    return;
                }
                syncCartBeforeRedirect(cart);
            });
        }

        function syncCartBeforeRedirect(cart) {
            fetch('{{ route("checkout.sync-cart") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ cart: cart })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('checkout') }}";
                    } else {
                        console.error(data.message || 'Cart sync failed');
                    }
                })
                .catch(error => {
                    console.error('Cart sync error:', error);
                });
        }

        function renderCartPanel() {
            const container = document.getElementById('cartPanelBody');
            const totalEl = document.getElementById('cartTotal');
            const continueBtn = document.getElementById('continueShoppingBtn');
            const cart = getCart();

            if (!cart || cart.length === 0) {
                container.innerHTML = `<div class="wishlist-panel-empty"><i class="bi bi-bag"></i><h3>Your cart is empty</h3><p>Start shopping to add items!</p></div>`;
                if (totalEl) totalEl.textContent = '₹0';
                if (continueBtn) {
                    continueBtn.innerHTML = '<i class="bi bi-box-arrow-in-right"></i> Login to Continue';
                }
                return;
            }

            let html = '';
            let total = 0;

            cart.forEach((item, index) => {
                const imageUrl = item.image ? (item.image.startsWith('http') ? item.image : '/' + item.image) : 'https://via.placeholder.com/70x70/F4EFE7/77736D?text=No+Image';
                const sellingPrice = Number(item.selling_price ?? item.price ?? 0);
                const originalPrice = Number(item.price ?? item.selling_price ?? 0);
                const hasDiscount = originalPrice > sellingPrice;
                const itemTotal = sellingPrice * (item.quantity || 1);
                total += itemTotal;

                html += `<div class="wishlist-panel-item" style="animation-delay: ${index * 0.05}s">
            <div class="wishlist-panel-item-image"><img src="${imageUrl}" alt="${item.name}" loading="lazy" onerror="this.src='https://via.placeholder.com/70x70/F4EFE7/77736D?text=No+Image'"></div>
            <div class="wishlist-panel-item-info">
                <h4><a href="/shop/${item.slug}" onclick="closeCartPanel()">${item.name}</a></h4>
                <div class="price">
                    <span style="color:#198754;font-weight:700;">
                        ₹${sellingPrice.toLocaleString('en-IN')}
                    </span>
                    ${hasDiscount ? `
                        <span style="color:#888;font-size:12px;margin-left:5px;text-decoration:line-through;text-decoration-thickness:1px;">
                            ₹${originalPrice.toLocaleString('en-IN')}
                        </span>
                        <span style="color:#e74c3c;font-size:11px;margin-left:5px;font-weight:600;">
                            (${Math.round(((originalPrice - sellingPrice) / originalPrice) * 100)}% OFF)
                        </span>
                    ` : ''}
                </div>
                <div style="display:flex;align-items:center;gap:8px;margin-top:4px;">
                    <button class="quantity-btn" onclick="event.stopPropagation(); updateCartQuantity(${item.id}, -1)"><i class="bi bi-dash"></i></button>
                    <span class="quantity-value">${item.quantity || 1}</span>
                    <button class="quantity-btn" onclick="event.stopPropagation(); updateCartQuantity(${item.id}, 1)"><i class="bi bi-plus"></i></button>
                    <button onclick="event.stopPropagation(); removeFromCart(${item.id})" style="margin-left:auto;padding:2px 8px;background:#f8f0ec;color:#e74c3c;border:none;border-radius:4px;font-size:10px;cursor:pointer;">Remove</button>
                </div>
            </div>
        </div>`;
            });

            container.innerHTML = html;
            if (totalEl) totalEl.textContent = '₹' + total.toLocaleString('en-IN');

            if (continueBtn) {
                const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
                if (isLoggedIn) {
                    continueBtn.innerHTML = '<i class="bi bi-bag-check"></i> Proceed to Checkout';
                } else {
                    continueBtn.innerHTML = '<i class="bi bi-box-arrow-in-right"></i> Login to Continue';
                }
            }
        }

        function updateCartQuantity(productId, change) {
            let cart = getCart();
            const index = cart.findIndex(item => item.id == productId);
            if (index > -1) {
                const newQuantity = (cart[index].quantity || 1) + change;
                if (newQuantity <= 0) {
                    cart.splice(index, 1);
                } else {
                    cart[index].quantity = newQuantity;
                }
                saveCart(cart);
                renderCartPanel();
                updateCartCount();
            }
        }

        function removeFromCart(productId) {
            let cart = getCart();
            cart = cart.filter(item => item.id != productId);
            saveCart(cart);
            renderCartPanel();
            updateCartCount();
            showToast('Removed from cart', 'removed');
        }

        function clearAllCart() {
            if (getCart().length === 0) return;
            if (confirm('Are you sure you want to clear your entire cart?')) {
                saveCart([]);
                renderCartPanel();
                updateCartCount();
                showToast('Cart cleared', 'removed');
            }
        }

        // =============================================
        // TOAST NOTIFICATION
        // =============================================

        function showToast(message, type) {
            let toastContainer = document.getElementById('wishlist-toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'wishlist-toast-container';
                toastContainer.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            width: 100%;
        `;
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            const bgColor = type === 'added' ? '#27ae60' : '#e74c3c';
            toast.style.cssText = `
        background: #fff;
        padding: 12px 18px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        border-left: 4px solid ${bgColor};
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideInRight 0.3s ease;
        font-size: 14px;
        color: #292725;
        font-family: 'Plus Jakarta Sans', sans-serif;
    `;

            const icon = document.createElement('i');
            icon.className = type === 'added' ? 'bi bi-heart-fill' : 'bi bi-heart';
            icon.style.color = bgColor;
            icon.style.fontSize = '18px';

            const text = document.createElement('span');
            text.textContent = message;

            toast.appendChild(icon);
            toast.appendChild(text);
            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease forwards';
                setTimeout(() => {
                    if (toast.parentNode) toast.parentNode.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // =============================================
        // CSS ANIMATIONS
        // =============================================

        (function addStyles() {
            const style = document.createElement('style');
            style.textContent = `
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
            document.head.appendChild(style);
        })();

        // =============================================
        // INITIALIZATION
        // =============================================

        document.addEventListener('DOMContentLoaded', function () {
            // Mobile menu toggle
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

            // Initialize wishlist buttons
            initWishlistButtons();

            // Initialize cart count
            updateCartCount();

            // Initialize "In Cart" button states
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                const productId = button.dataset.productId;
                const cart = getCart();
                const inCart = cart.some(item => item.id == productId);
                if (inCart) {
                    const icon = button.querySelector('i');
                    const text = button.querySelector('.btn-text') || button;
                    if (icon) icon.className = 'bi bi-check-lg';
                    if (text) text.textContent = 'In Cart';
                    button.style.background = '#27ae60';
                }
            });
        });

        // Close panels on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeWishlistPanel();
                closeCartPanel();
            }
        });

        // Storage changes listener (for multi-tab support)
        window.addEventListener('storage', function (e) {
            if (e.key === 'wishlist') {
                updateWishlistCount();
                const panel = document.getElementById('wishlistPanel');
                if (panel && panel.classList.contains('open')) {
                    renderWishlistPanel();
                }
            }
            if (e.key === 'cart') {
                updateCartCount();
                const cartPanel = document.getElementById('cartPanel');
                if (cartPanel && cartPanel.classList.contains('open')) {
                    renderCartPanel();
                }
            }
        });
    </script>

    @stack('scripts')

    <!-- Wishlist Overlay -->
    <div class="wishlist-overlay" id="wishlistOverlay" onclick="toggleWishlistPanel()"></div>

    <!-- Wishlist Panel -->
    <div class="wishlist-panel" id="wishlistPanel">
        <div class="wishlist-panel-header">
            <h2><i class="bi bi-heart-fill"></i> My Wishlist</h2>
            <button class="close-btn" onclick="toggleWishlistPanel()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="wishlist-panel-body" id="wishlistPanelBody">
            <!-- Wishlist items will be rendered here -->
        </div>
        <div class="wishlist-panel-footer" id="wishlistPanelFooter">
            <a href="{{ route('shop.index') }}" class="btn-view-all">
                <i class="bi bi-shop"></i> Browse More Products
            </a>
            <button class="btn-clear-all" onclick="clearAllWishlist()">
                <i class="bi bi-trash3"></i> Clear All
            </button>
        </div>
    </div>

</body>

</html>
