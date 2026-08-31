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
                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- ========== SEARCH MODAL ========== -->
    <div id="searchModal" class="search-modal" role="dialog" aria-modal="true" aria-label="Search">
        <div class="search-modal-overlay" onclick="closeSearch()"></div>
        <div class="search-modal-content">
            <div class="search-header">
                <div class="search-input-wrapper">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="searchInput" placeholder="Search jewellery, collections..."
                        autocomplete="off" onkeyup="doSearch(this.value)" aria-label="Search">
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

            <div id="categoryLinks">
                @if(isset($categories) && count($categories))
                    @foreach($categories as $cat)
                        <a href="{{ route('shop', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
                    @endforeach
                @endif
            </div>

            <div class="search-hint" id="searchHint">
                Press <kbd>Esc</kbd> to close
            </div>
        </div>
    </div>

    <script>
        let searchTimeout;

        function openSearch() {
            const modal = document.getElementById('searchModal');
            modal.style.display = 'flex';
            // force reflow then add class for animation
            requestAnimationFrame(() => {
                modal.classList.add('is-open');
            });
            document.body.style.overflow = 'hidden';
            setTimeout(() => document.getElementById('searchInput').focus(), 120);
        }

        function closeSearch() {
            const modal = document.getElementById('searchModal');
            modal.classList.remove('is-open');
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                document.getElementById('searchInput').value = '';
                document.getElementById('searchResults').style.display = 'none';
                document.getElementById('searchResults').innerHTML = '';
                document.getElementById('clearBtn').style.display = 'none';
                document.getElementById('categoryLinks').style.display = 'flex';
                document.getElementById('searchHint').style.display = 'block';
            }, 250);
        }

        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchResults').style.display = 'none';
            document.getElementById('searchResults').innerHTML = '';
            document.getElementById('clearBtn').style.display = 'none';
            document.getElementById('categoryLinks').style.display = 'flex';
            document.getElementById('searchHint').style.display = 'block';
            document.getElementById('searchInput').focus();
        }

        function doSearch(query) {
    const results = document.getElementById('searchResults');
    const clearBtn = document.getElementById('clearBtn');
    const links = document.getElementById('categoryLinks');
    const hint = document.getElementById('searchHint');

    if (query.trim().length === 0) {
        clearBtn.style.display = 'none';
        results.style.display = 'none';
        results.innerHTML = '';
        links.style.display = 'flex';
        hint.style.display = 'block';
        return;
    }

    clearBtn.style.display = 'flex';
    links.style.display = 'none';
    hint.style.display = 'none';
    results.style.display = 'block';
    results.innerHTML = `
        <div class="search-loading">
            <i class="bi bi-hourglass-split"></i>
            Searching...
        </div>`;

    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        fetch(`/search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                let html = '';

                if (data.categories?.length) {
                    html += `<div class="search-categories">
                        <h4 class="search-section-title">Categories</h4>
                        <div class="search-cat-pills">`;
                    data.categories.forEach(c => {
                        html += `<a href="/shop?category=${c.slug}" class="search-cat-pill">${c.name}</a>`;
                    });
                    html += `</div></div>`;
                }

                if (data.products?.length) {
                    html += `<div class="search-products">
                        <h4 class="search-section-title">Products</h4>`;
                    data.products.forEach(p => {
                        const img = p.image ? p.image.split(',')[0] : null;
                        // Same link as product-card
                        html += `<a href="/shop/${p.slug}" class="search-product-item">`;
                        if (img) {
                            html += `<img src="${img}" alt="" class="search-product-img" loading="lazy">`;
                        } else {
                            html += `<div class="search-product-img-placeholder"><i class="bi bi-gem"></i></div>`;
                        }
                        html += `<div class="search-product-info">
                            <div class="search-product-name">${p.name}</div>
                            <div class="search-product-price">₹${parseFloat(p.price).toFixed(2)}</div>
                        </div></a>`;
                    });
                    html += `</div>`;
                }

                if (!html) {
                    html = `<div class="search-empty">
                        <i class="bi bi-search"></i>
                        No results found for “${query}”
                    </div>`;
                }

                results.innerHTML = html;
            })
            .catch(() => {
                results.innerHTML = `<div class="search-error">
                    <i class="bi bi-exclamation-circle"></i>
                    Error loading results
                </div>`;
            });
    }, 300);
}

        // Close on ESC
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeSearch();
        });
    </script>

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
