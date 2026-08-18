<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShopEase')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background: #f5f7fb;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0
        }

        .top-announce-bar {
            background: #0f172a;
            color: #fff;
            font-size: 13px;
            padding: 8px 0
        }

        .top-announce-bar i {
            margin-right: 6px
        }

        .customer-header {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 100
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 22px;
            color: #0f172a;
            white-space: nowrap
        }

        .logo-icon {
            background: #3b82f6;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .search-box .input-group {
            max-width: 580px;
            margin: 0 auto
        }

        .search-box .form-control {
            border-radius: 8px 0 0 8px;
            border: 1px solid #e5e7eb;
            padding: 10px 16px
        }

        .category-select {
            max-width: 150px;
            border-left: 0;
            border-right: 0
        }

        .search-btn {
            border-radius: 0 8px 8px 0;
            background: #3b82f6;
            border-color: #3b82f6;
            padding: 0 18px
        }

        .header-actions .action-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 12px;
            color: #475569;
            text-decoration: none;
            position: relative
        }

        .header-actions .action-item i {
            font-size: 20px;
            margin-bottom: 2px
        }

        .badge-count {
            position: absolute;
            top: -4px;
            right: 8px;
            background: #ef4444;
            color: #fff;
            font-size: 10px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .user-avatar {
            width: 36px;
            height: 36px
        }

        .avatar-placeholder {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #3b82f6;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 600
        }

        .user-info small {
            display: block;
            font-size: 11px;
            color: #94a3b8
        }

        .user-info strong {
            font-size: 13px;
            color: #0f172a
        }

        .customer-sidebar {
            background: #fff;
            border-radius: 12px;
            padding: 12px 0;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 80px
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0
        }

        .sidebar-menu li a,
        .sidebar-menu li button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #475569;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            transition: all 0.2s;
            cursor: pointer
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li.active a {
            background: #eff6ff;
            color: #3b82f6
        }

        .sidebar-menu li.active a {
            border-right: 3px solid #3b82f6
        }

        .sidebar-menu li i {
            font-size: 18px;
            width: 22px
        }

        .logout-item {
            border-top: 1px solid #f1f5f9;
            margin-top: 8px;
            padding-top: 8px
        }

        .welcome-card,
        .profile-card,
        .section-card {
            background: #fff;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            height: 100%
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #3b82f6;
            color: #fff;
            font-size: 30px;
            font-weight: 600;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .edit-profile-link {
            font-size: 13px;
            color: #3b82f6;
            text-decoration: none
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 16px
        }

        .stat-box {
            background: #f8fafc;
            border-radius: 10px;
            padding: 12px 8px;
            text-align: center
        }

        .stat-box h4 {
            margin: 0;
            font-weight: 700;
            color: #0f172a
        }

        .stat-box span {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px
        }

        .stat-box a {
            font-size: 11px;
            color: #3b82f6;
            text-decoration: none
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px
        }

        .section-header h5 {
            margin: 0;
            font-weight: 700;
            color: #0f172a
        }

        .view-all {
            font-size: 13px;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500
        }

        .order-status-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap
        }

        .order-status-item {
            text-align: center;
            flex: 1;
            min-width: 70px
        }

        .status-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-size: 18px
        }

        .status-icon.pending {
            background: #fef3c7;
            color: #d97706
        }

        .status-icon.confirmed {
            background: #dbeafe;
            color: #2563eb
        }

        .status-icon.shipped {
            background: #e0e7ff;
            color: #4f46e5
        }

        .status-icon.delivered {
            background: #d1fae5;
            color: #059669
        }

        .status-icon.cancelled {
            background: #fee2e2;
            color: #dc2626
        }

        .status-label {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 2px
        }

        .order-status-item strong {
            font-size: 18px;
            color: #0f172a
        }

        .category-icons {
            display: flex;
            flex-wrap: wrap;
            gap: 16px
        }

        .cat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #475569;
            font-size: 12px;
            font-weight: 500
        }

        .cat-icon {
            width: 56px;
            height: 56px;
            background: #f1f5f9;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #3b82f6;
            transition: all 0.2s
        }

        .cat-item:hover .cat-icon {
            background: #3b82f6;
            color: #fff
        }

        .top-categories {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding-bottom: 4px
        }

        .top-cat {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #475569;
            font-size: 12px;
            min-width: 70px
        }

        .top-cat-placeholder {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #3b82f6
        }

        .product-slider {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding-bottom: 8px
        }

        .product-card {
            min-width: 160px;
            max-width: 180px;
            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.2s;
            position: relative
        }

        .product-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-3px)
        }

        .product-img {
            height: 140px;
            background: #f8fafc;
            position: relative
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .no-img {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 32px
        }

        .product-info {
            padding: 12px
        }

        .product-info h6 {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis
        }

        .price .current {
            font-weight: 700;
            color: #0f172a;
            font-size: 14px
        }

        .wishlist-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #94a3b8;
            transition: all 0.2s;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            z-index: 2;
            padding: 0
        }

        .wishlist-btn:hover {
            background: #fff;
            color: #ef4444;
            transform: scale(1.05)
        }

        .wishlist-btn.active {
            color: #ef4444;
            background: #fff
        }

        .wishlist-btn i {
            pointer-events: none
        }

        .benefits-bar {
            background: #fff;
            border-radius: 14px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04)
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .benefit-item i {
            font-size: 24px;
            color: #3b82f6
        }

        .benefit-item strong {
            display: block;
            font-size: 13px;
            color: #0f172a
        }

        .benefit-item small {
            font-size: 11px;
            color: #94a3b8
        }

        /* Mobile Toggle Button */
        .mobile-toggle-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #0f172a;
            padding: 4px 8px;
            cursor: pointer;
            transition: color 0.2s;
        }

        .mobile-toggle-btn:hover {
            color: #3b82f6;
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Mobile Sidebar */
        .mobile-sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 280px;
            height: 100%;
            background: #fff;
            z-index: 1000;
            overflow-y: auto;
            transition: left 0.3s ease;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.1);
            padding: 16px 0;
        }

        .mobile-sidebar.open {
            left: 0;
        }

        .mobile-sidebar .sidebar-close {
            position: absolute;
            top: 12px;
            right: 16px;
            background: none;
            border: none;
            font-size: 24px;
            color: #475569;
            cursor: pointer;
        }

        .mobile-sidebar .sidebar-close:hover {
            color: #0f172a;
        }

        .mobile-sidebar .sidebar-menu {
            padding-top: 50px;
        }

        .mobile-sidebar .sidebar-menu li a,
        .mobile-sidebar .sidebar-menu li button {
            padding: 14px 20px;
        }

        @media(max-width:991px) {
            .customer-sidebar {
                display: none;
            }

            .mobile-toggle-btn {
                display: block;
            }

            .header-actions .action-item span {
                display: none;
            }

            .header-actions {
                gap: 8px !important;
            }
        }

        @media(max-width:767px) {
            .search-box {
                display: none;
            }

            .profile-stats {
                grid-template-columns: 1fr;
            }

            .welcome-card,
            .profile-card,
            .section-card {
                padding: 16px;
            }
        }

        .section-card {
            height: auto !important;
        }
    </style>
</head>

<body>
    @yield('styles')
    @php
        $user = auth()->user();
    @endphp

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- Mobile Sidebar -->
    <div class="mobile-sidebar" id="mobileSidebar">
        <button class="sidebar-close" onclick="closeSidebar()">&times;</button>
        <ul class="sidebar-menu">
            <li class="@if(Route::currentRouteName() == 'customer.dashboard') active @endif">
                <a href="{{ route('customer.dashboard') }}"><i class="bi bi-grid-1x2"></i> Dashboard</a>
            </li>
            <li class="@if(Route::currentRouteName() == 'customer.products') active @endif">
                <a href="{{ route('customer.products') }}"><i class="bi bi-box-seam"></i> Products</a>
            </li>
            <li>
                <a href="{{ route('customer.orders.index') }}"><i class="bi bi-bag-check"></i> My Orders</a>
            </li>
            <li class="@if(Route::currentRouteName() == 'customer.wishlist') active @endif">
                <a href="{{ route('customer.wishlist') }}">
                    <i class="bi bi-heart"></i> Wishlist
                    <span class="badge bg-primary ms-auto">{{ $wishlistCount ?? 0 }}</span>
                </a>
            </li>
            <li class="@if(Route::currentRouteName() == 'checkout') active @endif">
                <a href="{{ route('checkout') }}"><i class="bi bi-credit-card"></i> Checkout</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-geo-alt"></i> Addresses</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-ticket-perforated"></i> Coupons & Offers</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-arrow-return-left"></i> Returns & Refunds</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-star"></i> My Reviews</a>
            </li>
            <li>
                <a href="{{ route('account.settings') }}">
                    Account Settings
                </a>
            </li>
            <li>
                <a href="#"><i class="bi bi-question-circle"></i> Help & Support</a>
            </li>
            <li class="logout-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="customer-dashboard">

        <!-- TOP BAR -->
        <div class="top-announce-bar">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="d-flex gap-4">
                    <span><i class="bi bi-truck"></i> Free Shipping on orders above ₹999</span>
                    <span><i class="bi bi-arrow-repeat"></i> 30 Days Easy Returns</span>
                </div>
                <div>
                    <span><i class="bi bi-phone"></i> Download App & Get 10% Off</span>
                </div>
            </div>
        </div>

        <!-- HEADER -->
        <header class="customer-header">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between gap-3">

                    <!-- Mobile Toggle Button -->
                    <button class="mobile-toggle-btn" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>

                    <a href="{{ route('home') }}" class="brand-logo">
                        <span class="logo-icon"><i class="bi bi-bag-fill"></i></span>
                        <span class="logo-text">ShopEase</span>
                    </a>

                    <div class="search-box flex-grow-1">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                placeholder="Search for products, brands and more...">
                            <select class="form-select category-select">
                                <option>All Categories</option>
                                @foreach($categories as $cat)
                                    <option>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary search-btn"><i class="bi bi-search"></i></button>
                        </div>
                    </div>

                    <div class="header-actions d-flex align-items-center gap-3">
                        <a href="{{ route('customer.wishlist') }}" class="action-item position-relative">
                            <i class="bi bi-heart"></i>
                            <span>Wishlist</span>
                            <span class="badge-count" id="headerWishlistCount">{{ $wishlistCount ?? 0 }}</span>
                        </a>
                        @php
                            $cart = session('cart', []);
                            $cartCount = collect($cart)->sum('quantity');
                        @endphp

                        <a href="{{ route('checkout') }}" class="action-item position-relative">
                            <i class="bi bi-cart3"></i>
                            <span>Cart</span>
                            @if($cartCount > 0)
                                <span class="badge-count cart-badge-count">{{ $cartCount }}</span>
                            @else
                                <span class="badge-count cart-badge-count">0</span>
                            @endif
                        </a>
                        <a href="#" class="action-item position-relative">
                            <i class="bi bi-bell"></i>
                            <span>Notifications</span>
                            <span class="badge-count">0</span>
                        </a>

                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                                <div class="user-avatar">
                                    @php
                                        $firstLetter = strtoupper(substr(trim($user->name), 0, 1));
                                    @endphp
                                    <div class="avatar-placeholder">{{ $firstLetter ?? 'A'}}</div>
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <small>Hi, {{ explode(' ', $user->name)[0] }}</small>
                                    <strong>My Account</strong>
                                </div>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('account.settings') }}">Edit Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid py-4">
            <div class="row g-4">

                <!-- SIDEBAR -->
                <div class="col-lg-2 col-md-3">
                    <div class="customer-sidebar">
                        <ul class="sidebar-menu">
                            <li class="@if(Route::currentRouteName() == 'customer.dashboard') active @endif">
                                <a href="{{ route('customer.dashboard') }}"><i class="bi bi-grid-1x2"></i> Dashboard</a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'customer.products') active @endif">
                                <a href="{{ route('customer.products') }}"><i class="bi bi-box-seam"></i> Products</a>
                            </li>
                            <li>
                                <a href="{{ route('customer.orders.index') }}"><i class="bi bi-bag-check"></i> My Orders</a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'customer.wishlist') active @endif">
                                <a href="{{ route('customer.wishlist') }}">
                                    <i class="bi bi-heart"></i> Wishlist
                                    <span class="badge bg-primary ms-auto">{{ $wishlistCount ?? 0 }}</span>
                                </a>
                            </li>
                            <li class="@if(Route::currentRouteName() == 'checkout') active @endif">
                                <a href="{{ route('checkout') }}"><i class="bi bi-credit-card"></i> Checkout</a>
                            </li>
                            <li>
                                <a href="{{ route('account.settings') }}"><i class="bi bi-geo-alt"></i> Addresses</a>
                            </li>
                            <li>
                                <a href="#"><i class="bi bi-ticket-perforated"></i> Coupons & Offers</a>
                            </li>
                            <li>
                                <a href="#"><i class="bi bi-arrow-return-left"></i> Returns & Refunds</a>
                            </li>
                            <li>
                                <a href="#"><i class="bi bi-star"></i> My Reviews</a>
                            </li>
                            <li>
                                <a href="{{ route('account.settings') }}"><i class="bi bi-gear"></i>
                                    Account Settings
                                </a>
                            </li>
                            <li>
                                <a href="#"><i class="bi bi-question-circle"></i> Help & Support</a>
                            </li>
                            <li class="logout-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- MAIN CONTENT -->
                <div class="col-lg-10 col-md-9">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        // Sidebar toggle functions
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        function closeSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close sidebar on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeSidebar();
            }
        });

        function toggleWishlist(button) {
            if (!button) {
                console.error('Wishlist button is missing');
                return;
            }

            const productId = button.dataset.productId;
            if (!productId) {
                console.error('Product ID not found on button');
                return;
            }

            const url = "{{ url('/customer/wishlist/toggle') }}/" + productId;
            button.disabled = true;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Wishlist request failed');
                    }
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        const icon = button.querySelector('i');
                        if (data.is_in_wishlist) {
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill');
                            button.classList.add('active');
                        } else {
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                            button.classList.remove('active');
                        }

                        document.querySelectorAll('.badge-count').forEach(el => {
                            const link = el.closest('a');
                            if (link && link.href.includes('/customer/wishlist')) {
                                el.textContent = data.wishlist_count;
                            }
                        });

                        console.log(data.message);
                    }
                })
                .catch(error => {
                    console.error('Wishlist Error:', error);
                })
                .finally(() => {
                    button.disabled = false;
                });
        }

        function clearWishlist() {
            const buttons = document.querySelectorAll('.wishlist-btn');
            if (!buttons.length) return;
            if (!confirm('Are you sure you want to clear your wishlist?')) {
                return;
            }
            buttons.forEach(button => {
                if (button.dataset.productId) {
                    toggleWishlist(button);
                }
            });
        }

        function addAllToCart() {
            const forms = document.querySelectorAll(
                '.wishlist-product-card form[action*="/cart/add/"]'
            );
            if (!forms.length) {
                alert('No products available in your wishlist.');
                return;
            }
            forms.forEach((form, index) => {
                setTimeout(() => {
                    form.submit();
                }, index * 300);
            });
        }

        window.clearWishlist = clearWishlist;
        window.addAllToCart = addAllToCart;
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.add-to-cart-form').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const button = form.querySelector('button[type="submit"]');
                    const originalText = button.innerHTML;

                    button.disabled = true;
                    button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Adding...';

                    fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    })
                        .then(async response => {
                            const data = await response.json();
                            if (!response.ok) {
                                throw new Error(data.message || 'Something went wrong.');
                            }
                            return data;
                        })
                        .then(data => {
                            if (data.success) {
                                document.querySelectorAll('.cart-badge-count').forEach(function (badge) {
                                    badge.textContent = data.cart_count;
                                });
                                showCartToast(data.message, 'success');
                                button.innerHTML = originalText;
                            }
                        })
                        .catch(error => {
                            console.error('Cart Error:', error);
                            showCartToast(error.message || 'Failed to add product to cart.', 'error');
                            button.innerHTML = originalText;
                        })
                        .finally(() => {
                            button.disabled = false;
                        });
                });
            });
        });

        function showCartToast(message, type = 'success') {
            const toastId = 'cartToast';
            let toastElement = document.getElementById(toastId);
            if (toastElement) {
                toastElement.remove();
            }

            const bgClass = type === 'success' ? 'text-bg-success' : 'text-bg-danger';
            const toastHtml = `
                <div id="${toastId}"
                    class="toast align-items-center ${bgClass} border-0 position-fixed bottom-0 end-0 m-4"
                    role="alert"
                    style="z-index:9999;">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="bi bi-check-circle me-2"></i>
                            ${message}
                        </div>
                        <button type="button"
                                class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast">
                        </button>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', toastHtml);
            const toast = new bootstrap.Toast(document.getElementById(toastId), {
                delay: 3000
            });
            toast.show();
        }
    </script>
    @yield('scripts')

</body>

</html>
