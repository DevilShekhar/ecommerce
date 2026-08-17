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

    <!-- User ID Meta for Guest Detection -->
    <meta name="user-id" content="{{ auth()->check() ? auth()->id() : '' }}">
    <meta name="user-logged-in" content="{{ auth()->check() ? 'true' : 'false' }}">

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">

    <style>
        /* ============================================================
           NAVBAR STYLES
           ============================================================ */
        .site-navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .site-navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .site-logo {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            text-decoration: none;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-wrapper img {
            max-height: 50px;
            width: auto;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .logo-text i {
            color: #3b82f6;
        }

        /* Desktop Navigation */
        .site-nav {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .site-nav a {
            color: #475569;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        .site-nav a:hover {
            color: #3b82f6;
        }

        .site-nav a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: width 0.3s ease;
        }

        .site-nav a:hover::after {
            width: 100%;
        }

        /* Wishlist Link */
        .wishlist-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            color: #475569;
            text-decoration: none;
            font-size: 20px;
            transition: color 0.3s ease;
            padding: 4px 6px;
        }

        .wishlist-link:hover {
            color: #ef4444;
        }

        .wishlist-link i {
            font-size: 22px;
        }

        .wishlist-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 50%;
            min-width: 18px;
            text-align: center;
            line-height: 1.4;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.3);
            animation: pulse-badge 2s infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* ============================================================
           THREE DOTS / HAMBURGER MENU (Mobile)
           ============================================================ */
        .navbar-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.2s ease;
        }

        .navbar-toggle:hover {
            background: #f1f5f9;
        }

        .navbar-toggle .dot {
            display: block;
            width: 5px;
            height: 5px;
            margin: 3px 0;
            background: #0f172a;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .navbar-toggle.active .dot:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
            width: 20px;
            height: 2px;
            border-radius: 2px;
        }

        .navbar-toggle.active .dot:nth-child(2) {
            opacity: 0;
        }

        .navbar-toggle.active .dot:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
            width: 20px;
            height: 2px;
            border-radius: 2px;
        }

        /* ============================================================
           MOBILE MENU
           ============================================================ */
        .navbar-mobile-menu {
            display: none;
            background: #fff;
            padding: 16px 20px;
            border-top: 1px solid #e2e8f0;
            width: 100%;
        }

        .navbar-mobile-menu.open {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-mobile-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navbar-mobile-menu ul li {
            margin-bottom: 2px;
        }

        .navbar-mobile-menu ul li a {
            display: block;
            padding: 10px 12px;
            color: #475569;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .navbar-mobile-menu ul li a:hover {
            background: #f1f5f9;
            color: #3b82f6;
        }

        .navbar-mobile-menu ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .navbar-mobile-menu ul li a .mobile-badge {
            background: #ef4444;
            color: #fff;
            font-size: 10px;
            padding: 1px 6px;
            border-radius: 50%;
            margin-left: 4px;
        }

        /* ============================================================
           RESPONSIVE
           ============================================================ */
        @media (max-width: 768px) {
            .site-nav {
                display: none;
            }

            .navbar-toggle {
                display: block;
            }

            .logo-text {
                font-size: 18px;
            }

            .logo-wrapper img {
                max-height: 35px;
            }

            .wishlist-link {
                font-size: 17px;
            }

            .wishlist-link i {
                font-size: 19px;
            }

            .wishlist-badge {
                font-size: 9px;
                min-width: 16px;
                top: -6px;
                right: -6px;
                padding: 1px 5px;
            }
        }

        @media (max-width: 576px) {
            .logo-text {
                font-size: 16px;
            }

            .logo-wrapper {
                gap: 6px;
            }

            .logo-wrapper img {
                max-height: 30px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- ================= NAVBAR ================= -->
    <header class="site-navbar" id="siteNavbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap" style="width:100%;">

                <a href="{{ url('/home') }}" class="site-logo">
                    <div class="logo-wrapper">
                        @if($siteLogo && $siteLogo->logo)
                            <img src="{{ asset('storage/' . $siteLogo->logo) }}" alt="{{ $siteLogo->site_name ?? 'Logo' }}">
                        @endif
                        <span class="logo-text">{{ $siteLogo->site_name ?? 'E-Commerce' }}</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="site-nav">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ url('/about-us') }}">About Us</a>
                    <a href="{{ url('/all-product') }}">Our Products</a>
                    <a href="{{ url('/contact-us') }}">Contact</a>

                    <!-- Wishlist Link - Available to Everyone -->
                    <a href="{{ route('wishlist.index') }}" class="wishlist-link" title="Wishlist">
    <i class="bi bi-heart"></i>
    @auth
        @php
            $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
        @endphp
        @if($wishlistCount > 0)
            <span class="wishlist-badge">{{ $wishlistCount }}</span>
        @endif
    @else
        <span class="wishlist-badge" id="guestWishlistBadge" style="display: none;">0</span>
    @endauth
</a>
                </nav>

                <!-- Mobile Three Dots Button -->
                <button class="navbar-toggle" id="navbarToggle" aria-label="Toggle navigation">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </button>

            </div>

            <!-- Mobile Menu -->
            <div class="navbar-mobile-menu" id="mobileMenu">
                <ul>
                    <li><a href="{{ url('/home') }}"><i class="bi bi-house"></i> Home</a></li>
                    <li><a href="{{ url('/about-us') }}"><i class="bi bi-info-circle"></i> About Us</a></li>
                    <li><a href="{{ url('/all-product') }}"><i class="bi bi-grid"></i> Our Products</a></li>
                    <li><a href="{{ url('/contact-us') }}"><i class="bi bi-envelope"></i> Contact</a></li>
                    <li>
                        <a href="{{ route('wishlist.index') }}">
                            <i class="bi bi-heart"></i> Wishlist
                            @auth
                                @php
                                    $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
                                @endphp
                                @if($wishlistCount > 0)
                                    <span class="mobile-badge">{{ $wishlistCount }}</span>
                                @endif
                            @else
                                <span class="mobile-badge" id="guestMobileWishlistBadge" style="display: none;">0</span>
                            @endauth
                        </a>
                    </li>
                </ul>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // =============================================
        // NAVBAR TOGGLE (Three Dots)
        // =============================================
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('navbarToggle');
            const mobileMenu = document.getElementById('mobileMenu');

            if (toggle && mobileMenu) {
                toggle.addEventListener('click', function() {
                    this.classList.toggle('active');
                    mobileMenu.classList.toggle('open');
                });

                // Close menu when clicking a link
                mobileMenu.querySelectorAll('a').forEach(function(link) {
                    link.addEventListener('click', function() {
                        toggle.classList.remove('active');
                        mobileMenu.classList.remove('open');
                    });
                });
            }

            // =============================================
            // SCROLL EFFECT
            // =============================================
            var nav = document.getElementById('siteNavbar');
            if (nav) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 8) {
                        nav.classList.add('is-scrolled');
                    } else {
                        nav.classList.remove('is-scrolled');
                    }
                });
            }

            // =============================================
            // GUEST WISHLIST COUNTER
            // =============================================
            function updateGuestWishlistBadge() {
                const guestWishlist = JSON.parse(localStorage.getItem('guest_wishlist') || '[]');
                const badge = document.getElementById('guestWishlistBadge');
                const mobileBadge = document.getElementById('guestMobileWishlistBadge');

                if (badge) {
                    if (guestWishlist.length > 0) {
                        badge.textContent = guestWishlist.length;
                        badge.style.display = 'inline';
                    } else {
                        badge.style.display = 'none';
                    }
                }

                if (mobileBadge) {
                    if (guestWishlist.length > 0) {
                        mobileBadge.textContent = guestWishlist.length;
                        mobileBadge.style.display = 'inline';
                    } else {
                        mobileBadge.style.display = 'none';
                    }
                }
            }

            // Update guest wishlist badge on page load
            updateGuestWishlistBadge();

            // Update when localStorage changes
            window.addEventListener('storage', function(e) {
                if (e.key === 'guest_wishlist') {
                    updateGuestWishlistBadge();
                }
            });

            // Also update when wishlist button is clicked (custom event)
            document.addEventListener('wishlistUpdated', function() {
                updateGuestWishlistBadge();
            });

            // Override the showToast and wishlist functions to trigger badge update
            const originalShowToast = window.showToast;
            if (originalShowToast) {
                window.showToast = function(message) {
                    originalShowToast(message);
                    // Dispatch custom event to update badge
                    document.dispatchEvent(new Event('wishlistUpdated'));
                };
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
