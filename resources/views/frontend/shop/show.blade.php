<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{ $product->name }} - Aethelweave</title>
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <style>
        /* ========== RESET ========== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FDFBF7;
            color: #2C2A29;
            padding-top: 80px;
        }

        /* ========== NAVBAR ========== */
        .navbar-modern {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(253, 251, 247, .92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(232, 226, 210, .6);
            padding: 12px 0;
            transition: .3s;
        }

        .navbar-modern.scrolled {
            background: rgba(253, 251, 247, .98);
            box-shadow: 0 2px 24px rgba(44, 42, 41, .06);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
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
            letter-spacing: -.5px;
        }

        .navbar-logo-badge {
            font-size: .55rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .15em;
            color: #8F753D;
            background: rgba(165, 139, 84, .12);
            padding: 2px 10px;
            border-radius: 20px;
            border: 1px solid rgba(165, 139, 84, .2);
        }

        .nav-links-desktop {
            display: none;
            list-style: none;
            align-items: center;
            gap: 28px;
        }

        .nav-links-desktop li a {
            font-size: .75rem;
            font-weight: 500;
            color: #2C2A29;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: .08em;
            transition: .3s;
            position: relative;
            padding-bottom: 4px;
        }

        .nav-links-desktop li a:hover,
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
            transition: .3s;
        }

        .navbar-icon:hover {
            color: #A58B54;
        }

        .navbar-cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: #A58B54;
            color: #fff;
            font-size: .5rem;
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
            transition: .3s;
        }

        .mobile-menu {
            display: none;
            background: #fff;
            border-top: 1px solid #E8E2D2;
            padding: 16px 20px 20px;
            margin-top: 12px;
        }

        .mobile-menu ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .mobile-menu ul li a {
            display: block;
            padding: 10px 0;
            font-size: .9rem;
            font-weight: 500;
            color: #2C2A29;
            text-decoration: none;
            border-bottom: 1px solid #F5F0E8;
            transition: .3s;
        }

        .mobile-menu ul li a:hover,
        .mobile-menu ul li a.active {
            color: #A58B54;
        }

        .mobile-menu ul li:last-child a {
            border-bottom: none;
        }

        @media(min-width:768px) {
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

        @media(max-width:767px) {
            .nav-links-desktop {
                display: none;
            }

            .hamburger-btn {
                display: flex;
            }
        }

        /* ========== PRODUCT ========== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 20px 50px;
        }

        .breadcrumb {
            font-size: 13px;
            color: #8a7a6a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .breadcrumb a {
            color: #A58B54;
            text-decoration: none;
            transition: .3s;
        }

        .breadcrumb a:hover {
            color: #2C2A29;
        }

        .breadcrumb .sep {
            color: #D5CFC5;
        }

        .breadcrumb .current {
            color: #2C2A29;
            font-weight: 500;
        }

        /* Product Detail - 6 Column Grid */
        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            background: #fff;
            border-radius: 14px;
            padding: 28px;
            border: 1px solid #E8E2D2;
            margin-bottom: 45px;
        }

        .product-gallery {
            position: relative;
        }

        .product-gallery .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            background: #FDFBF7;
            border: 1px solid #E8E2D2;
        }

        .product-gallery .badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #fff;
        }

        .product-gallery .badge.featured {
            background: #2C3E50;
        }

        .product-gallery .badge.popular {
            background: #A58B54;
        }

        .product-gallery .badge.new {
            background: #2C2A29;
        }

        .product-info {
            display: flex;
            flex-direction: column;
        }

        .product-info .category {
            color: #A58B54;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .15em;
            font-weight: 600;
        }

        .product-info h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 500;
            color: #2C2A29;
            margin: 4px 0 2px;
            line-height: 1.2;
        }

        .product-info .price {
            font-size: 24px;
            font-weight: 700;
            color: #2C2A29;
            margin-bottom: 12px;
        }

        .product-info .price .original {
            font-size: 16px;
            color: #A08878;
            text-decoration: line-through;
            font-weight: 400;
            margin-left: 10px;
        }

        .product-info .stock {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            margin-bottom: 14px;
            width: fit-content;
        }

        .product-info .stock.in {
            background: #E8F5E9;
            color: #27AE60;
        }

        .product-info .stock.out {
            background: #FDE8E8;
            color: #C0392B;
        }

        .product-info .desc {
            color: #6B6A69;
            line-height: 1.8;
            font-size: 14px;
            border-top: 1px solid #F0E8DC;
            padding-top: 16px;
            margin-bottom: 16px;
        }

        .product-info .desc ul,
        .product-info .desc ol {
            padding-left: 20px;
            margin-bottom: 8px;
        }

        .product-info .desc li {
            margin-bottom: 4px;
        }

        .product-info .desc h5,
        .product-info .desc h6 {
            color: #2C2A29;
            margin-bottom: 6px;
            font-family: 'Cormorant Garamond', serif;
        }

        .product-info .desc h5 {
            font-size: 15px;
        }

        .product-info .desc h6 {
            font-size: 13px;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 18px;
        }

        .meta-item {
            background: #FDFBF7;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #E8E2D2;
        }

        .meta-item strong {
            display: block;
            font-size: 9px;
            text-transform: uppercase;
            color: #A08878;
            letter-spacing: .08em;
        }

        .meta-item span {
            font-size: 13px;
            font-weight: 500;
        }

        .btn-cart {
            padding: 14px;
            background: #A58B54;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .1em;
            cursor: pointer;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-cart:hover:not(:disabled) {
            background: #8F753D;
            transform: translateY(-2px);
            box-shadow: 0 6px 24px rgba(165, 139, 84, .3);
        }

        .btn-cart:disabled {
            background: #D5CFC5;
            cursor: not-allowed;
            opacity: .7;
        }

        /* ========== RELATED ========== */
        .related-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .related-header .label {
            display: inline-block;
            padding: 3px 14px;
            background: #F5EEDC;
            color: #A58B54;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .15em;
            margin-bottom: 4px;
        }

        .related-header h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 500;
            color: #2C2A29;
        }

        .related-header p {
            font-size: 14px;
            color: #8A7A6A;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
        }

        .related-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #E8E2D2;
            transition: .3s;
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(44, 42, 41, .08);
            border-color: #A58B54;
        }

        .related-img {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1/1;
            background: #FDFBF7;
        }

        .related-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .5s;
        }

        .related-card:hover .related-img img {
            transform: scale(1.05);
        }

        .related-stock {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: #E8F5E9;
            color: #27AE60;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 600;
        }

        .related-info {
            padding: 10px 12px 14px;
        }

        .related-info .cat {
            font-size: 9px;
            color: #A58B54;
            text-transform: uppercase;
            letter-spacing: .1em;
            font-weight: 600;
        }

        .related-info h4 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            font-weight: 600;
            margin: 2px 0 4px;
        }

        .related-info h4 a {
            color: #2C2A29;
            text-decoration: none;
            transition: .3s;
        }

        .related-info h4 a:hover {
            color: #A58B54;
        }

        .related-info .price {
            font-weight: 700;
            color: #A58B54;
            font-size: 14px;
        }

        .related-info .link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 6px;
            font-size: 11px;
            color: #A58B54;
            text-decoration: none;
            font-weight: 600;
            transition: .3s;
        }

        .related-info .link:hover {
            color: #8F753D;
            gap: 8px;
        }

        .empty-related {
            text-align: center;
            padding: 30px;
            background: #fff;
            border: 1px solid #E8E2D2;
            border-radius: 10px;
            color: #8A7A6A;
            font-size: 14px;
        }

        /* ========== FOOTER ========== */
        .footer {
            background: #2C2A29;
            padding: 35px 0 15px;
            color: #fff;
            margin-top: 10px;
        }

        .footer .container {
            padding: 0 15px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 30px;
            padding-bottom: 20px;
        }

        .footer-col {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 500;
            color: #A58B54;
        }

        .footer-tagline {
            font-size: .65rem;
            color: rgba(255, 255, 255, .4);
            letter-spacing: .2em;
            text-transform: uppercase;
        }

        .footer-desc {
            font-size: .75rem;
            color: rgba(255, 255, 255, .5);
            line-height: 1.6;
            max-width: 280px;
        }

        .footer-social {
            display: flex;
            gap: 8px;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
            color: rgba(255, 255, 255, .5);
            transition: .3s;
            text-decoration: none;
            font-size: 14px;
        }

        .social-link:hover {
            background: #A58B54;
            color: #fff;
            transform: translateY(-2px);
        }

        .footer-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-weight: 600;
            color: #A58B54;
            margin-bottom: 6px;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .footer-links li a {
            color: rgba(255, 255, 255, .6);
            text-decoration: none;
            font-size: .8rem;
            transition: .3s;
        }

        .footer-links li a:hover {
            color: #A58B54;
        }

        .footer-payment {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .payment-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 26px;
            background: rgba(255, 255, 255, .08);
            border-radius: 4px;
            color: rgba(255, 255, 255, .6);
            font-size: 15px;
            transition: .3s;
        }

        .payment-icon:hover {
            background: #A58B54;
            color: #fff;
        }

        .payment-text {
            font-size: .65rem;
            color: rgba(255, 255, 255, .4);
            width: 100%;
        }

        .footer-contact {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .footer-contact li {
            color: rgba(255, 255, 255, .6);
            font-size: .75rem;
            line-height: 1.5;
            display: flex;
            gap: 8px;
        }

        .footer-contact li i {
            color: #A58B54;
            font-size: 14px;
            margin-top: 2px;
        }

        .footer-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, .08);
            margin: 10px 0;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .footer-copy {
            font-size: .65rem;
            color: rgba(255, 255, 255, .3);
        }

        .footer-bottom-links {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, .3);
            text-decoration: none;
            font-size: .6rem;
            transition: .3s;
        }

        .footer-bottom-links a:hover {
            color: #A58B54;
        }

        /* ========== RESPONSIVE ========== */
        @media(max-width:991px) {
            body {
                padding-top: 70px;
            }

            .related-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:768px) {
            body {
                padding-top: 65px;
            }

            .product-detail {
                grid-template-columns: 1fr;
                padding: 18px;
                gap: 20px;
            }

            .product-gallery .main-image {
                height: 320px;
            }

            .product-info h1 {
                font-size: 24px;
            }

            .product-info .price {
                font-size: 20px;
            }

            .related-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 20px;
            }

            .footer-desc {
                max-width: 100%;
            }
        }

        @media(max-width:480px) {
            body {
                padding-top: 60px;
            }

            .container {
                padding: 10px 12px 30px;
            }

            .product-detail {
                padding: 12px;
                gap: 16px;
            }

            .product-gallery .main-image {
                height: 260px;
            }

            .product-info h1 {
                font-size: 20px;
            }

            .product-info .price {
                font-size: 18px;
            }

            .meta-grid {
                grid-template-columns: 1fr;
            }

            .related-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .related-info {
                padding: 8px 10px 12px;
            }

            .related-info h4 {
                font-size: 12px;
            }

            .related-info .price {
                font-size: 12px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-bottom-links {
                justify-content: center;
            }
        }

        @media(max-width:360px) {
            .related-grid {
                grid-template-columns: 1fr 1fr;
            }

            .product-gallery .main-image {
                height: 220px;
            }
        }
    </style>
</head>

<body>

    <!-- ========== NAVBAR ========== -->
    <nav class="navbar-modern">
        <div class="navbar-container">
            <a href="/" class="navbar-logo">
                <span class="navbar-logo-text">Aethelweave</span>
                <span class="navbar-logo-badge">Artisan</span>
            </a>
            <ul class="nav-links-desktop">
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('shop.index') }}" class="active">Shop</a></li>

                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
            </ul>
            <div class="navbar-icons">
                <a href="#" class="navbar-icon"><i class="bi bi-search"></i></a>
                <a href="{{ route('login') }}" class="navbar-icon"><i class="bi bi-person"></i></a>
                <a href="#" class="navbar-icon">
                    <i class="bi bi-bag"></i>
                    <span class="navbar-cart-count">0</span>
                </a>
                <button class="hamburger-btn" aria-label="Toggle menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
        <div class="mobile-menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('shop.index') }}" class="active">Shop</a></li>

                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- ========== PRODUCT ========== -->
    <div class="container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/">Home</a><span class="sep">/</span>
            <a href="{{ route('shop.index') }}">Shop</a>
            @if($product->category)
                <span class="sep">/</span>
                <a
                    href="{{ route('shop.index', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a>
            @endif
            <span class="sep">/</span>
            <span class="current">{{ $product->name }}</span>
        </div>

        <!-- Product Detail -->
        <div class="product-detail">

            <div class="product-gallery">
                @php
                    $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                    $firstImage = !empty($images) ? $images[0] : null;
                @endphp
                @if($firstImage)
                    <img src="{{ asset($firstImage) }}" alt="{{ $product->name }}" class="main-image">
                @else
                    <div class="main-image" style="display:flex;align-items:center;justify-content:center;color:#D5CFC5;">
                        <i class="bi bi-image" style="font-size:50px;"></i>
                    </div>
                @endif

                @if($product->is_featured == 2)
                    <span class="badge featured">Featured</span>
                @elseif($product->is_featured == 1)
                    <span class="badge popular">Popular</span>
                @elseif($product->created_at >= now()->subDays(30))
                    <span class="badge new">New</span>
                @endif
            </div>

            <div class="product-info">
                <div class="category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                <h1>{{ $product->name }}</h1>
                <div class="price">
                    ₹{{ number_format($product->price, 2) }}
                    @if($product->compare_price && $product->compare_price > $product->price)
                        <span class="original">₹{{ number_format($product->compare_price, 2) }}</span>
                    @endif
                </div>

                <div class="stock {{ $product->stock > 0 ? 'in' : 'out' }}">
                    <i class="bi bi-{{ $product->stock > 0 ? 'check-circle-fill' : 'x-circle-fill' }}"></i>
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    @if($product->stock > 0 && $product->stock < 10)
                        (Only {{ $product->stock }} left)
                    @endif
                </div>

                <div class="desc">
                    {!! $product->specification ?? $product->description ?? '' !!}
                </div>

                <div class="meta-grid">
                    @if($product->sku)
                        <div class="meta-item"><strong>SKU</strong><span>{{ $product->sku }}</span></div>
                    @endif
                    @if($product->brand)
                        <div class="meta-item"><strong>Brand</strong><span>{{ $product->brand->name }}</span></div>
                    @endif
                    @if($product->subCategory)
                        <div class="meta-item"><strong>Sub Category</strong><span>{{ $product->subCategory->name }}</span>
                        </div>
                    @endif
                    @if($product->variants)
                        <div class="meta-item"><strong>Material</strong><span>{{ $product->variants }}</span></div>
                    @endif
                </div>

                @if($product->stock > 0)
                    <button type="button" class="btn-cart" onclick="window.location.href='{{ route('login') }}'">
                        <i class="bi bi-cart-plus"></i>
                        Add to Cart
                    </button>
                @else
                    <button type="button" class="btn-cart" disabled>
                        <i class="bi bi-x-circle"></i>
                        Out of Stock
                    </button>
                @endif
            </div>
        </div>

        <!-- ========== RELATED PRODUCTS (6 COLUMN) ========== -->
        @php
            $recommendations = $relatedProducts ?? collect();
            if ($recommendations->count() < 6) {
                $additional = \App\Models\Product::where('id', '!=', $product->id)
                    ->where('stock', '>', 0)
                    ->when($product->category_id, fn($q) => $q->where('category_id', $product->category_id))
                    ->latest()
                    ->take(6 - $recommendations->count())
                    ->get();
                $recommendations = $recommendations->merge($additional);
            }
            $recommendations = $recommendations->where('id', '!=', $product->id)->where('stock', '>', 0)->unique('id')->take(6);
        @endphp

        @if($recommendations->count() > 0)
            <div>
                <div class="related-header">
                    <span class="label"><i class="bi bi-gem"></i> Recommended</span>
                    <h2>You May Also Like</h2>
                    <p>Discover more exquisite jewellery pieces</p>
                </div>

                <div class="related-grid">
                    @foreach($recommendations as $related)
                        <div class="related-card">
                            <div class="related-img">
                                @php
                                    $relImages = $related->image ? array_map('trim', explode(',', $related->image)) : [];
                                    $relFirst = !empty($relImages) ? $relImages[0] : null;
                                @endphp
                                @if($relFirst)
                                    <img src="{{ asset($relFirst) }}" alt="{{ $related->name }}" loading="lazy">
                                @else
                                    <div style="height:100%;display:flex;align-items:center;justify-content:center;color:#D5CFC5;">
                                        <i class="bi bi-image" style="font-size:30px;"></i>
                                    </div>
                                @endif
                                <span class="related-stock">In Stock</span>
                            </div>
                            <div class="related-info">
                                <div class="cat">{{ $related->category->name ?? 'Jewellery' }}</div>
                                <h4><a href="{{ route('shop.show', $related->id) }}">{{ Str::limit($related->name, 25) }}</a>
                                </h4>
                                <div class="price">₹{{ number_format($related->price, 2) }}</div>
                                <a href="{{ route('shop.show', $related->id) }}" class="link">
                                    View <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="empty-related">
                <i class="bi bi-box" style="font-size:28px;display:block;margin-bottom:8px;color:#D5CFC5;"></i>
                No recommended products available.
            </div>
        @endif
    </div>

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="footer-brand">Aethelweave</div>
                    <div class="footer-tagline">Artisan Jewellery · Since 2010</div>
                    <div class="footer-desc">Premium handcrafted jewellery for those who appreciate timeless elegance.
                    </div>
                    <div class="footer-social">
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-pinterest"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <div class="footer-heading">Quick Links</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Courses</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <div class="footer-heading">We Accept</div>
                    <div class="footer-payment">
                        <span class="payment-icon"><i class="bi bi-credit-card"></i></span>
                        <span class="payment-icon"><i class="bi bi-paypal"></i></span>
                        <span class="payment-icon"><i class="bi bi-bank"></i></span>
                        <span class="payment-icon"><i class="bi bi-cash"></i></span>
                        <span class="payment-text">Secure payment options</span>
                    </div>
                </div>
                <div class="footer-col">
                    <div class="footer-heading">Contact Us</div>
                    <ul class="footer-contact">
                        <li><i class="bi bi-envelope"></i> info@aethelweave.com</li>
                        <li><i class="bi bi-geo-alt"></i> Pune, Maharashtra, India</li>
                        <li><i class="bi bi-telephone"></i> +91 98765 43210</li>
                    </ul>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="footer-bottom">
                <span class="footer-copy">&copy; 2026 Aethelweave. All Rights Reserved.</span>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                    <a href="#">Disclaimer</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ========== SCRIPTS ========== -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.querySelector('.hamburger-btn');
            const mobileMenu = document.querySelector('.mobile-menu');
            if (hamburger && mobileMenu) {
                hamburger.addEventListener('click', function () {
                    mobileMenu.style.display = mobileMenu.style.display === 'block' ? 'none' : 'block';
                });
            }
            const navbar = document.querySelector('.navbar-modern');
            if (navbar) {
                window.addEventListener('scroll', function () {
                    navbar.classList.toggle('scrolled', window.scrollY > 50);
                });
            }
        });
    </script>

</body>

</html>
