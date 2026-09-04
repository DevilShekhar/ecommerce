@extends('frontend.layouts.customer-layout')

@section('title', 'My Wishlist - Aethelweave')

@section('styles')

    <style>
        :root {
            --s-primary: #3b82f6;
            --s-primary-dark: #2563eb;
            --s-primary-light: #dbeafe;
            --s-primary-bg: #f0f7ff;
            --s-bg: #f5f7fa;
            --s-text: #0f172a;
            --s-muted: #64748b;
            --s-border: #e2e8f0;
            --s-white: #ffffff;
            --s-green: #22c55e;
            --s-red: #ef4444;
            --s-gold: #f59e0b;
        }

        /* =========================================================
                   PAGE
                ========================================================= */

        .wishlist-page {
            min-height: 100vh;
            background: var(--s-bg);
            padding: 16px 0 45px;
        }

        /* =========================================================
                   HEADER
                ========================================================= */

        .wishlist-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 16px;
        }

        .wishlist-heading-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .wishlist-heading-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--s-primary-light);
            color: var(--s-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .wishlist-heading h1 {
            margin: 0;
            font-family: "Cormorant Garamond", serif;
            font-size: 30px;
            line-height: 1;
            font-weight: 600;
            color: var(--s-text);
        }

        .wishlist-heading p {
            margin: 4px 0 0;
            color: var(--s-muted);
            font-size: 11px;
        }

        .wishlist-heading-actions {
            display: flex;
            gap: 7px;
        }

        .wishlist-top-btn {
            border: 1px solid var(--s-border);
            background: #fff;
            color: var(--s-text);
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: .2s ease;
        }

        .wishlist-top-btn:hover {
            border-color: var(--s-primary);
            color: var(--s-primary);
        }

        .wishlist-top-btn.danger:hover {
            border-color: var(--s-red);
            color: var(--s-red);
        }

        /* =========================================================
                   SERVICE STRIP
                ========================================================= */

        .wishlist-services {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            margin-bottom: 14px;
        }

        .wishlist-service {
            background: #fff;
            border: 1px solid var(--s-border);
            border-radius: 7px;
            padding: 9px 11px;
            display: flex;
            align-items: center;
            gap: 9px;
            min-height: 58px;
            transition: .2s ease;
        }

        .wishlist-service:hover {
            border-color: #d9c9a9;
            transform: translateY(-1px);
        }

        .service-icon {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            background: var(--s-primary-light);
            color: var(--s-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .service-content strong {
            display: block;
            font-size: 10px;
            color: var(--s-text);
            margin-bottom: 2px;
            font-weight: 700;
        }

        .service-content span {
            display: block;
            color: #99938a;
            font-size: 8.5px;
        }

        /* =========================================================
                   FILTER SECTION - FOR RECOMMENDED PRODUCTS
                ========================================================= */

        .recommended-filter-section {
            background: #ffffff;
            border-radius: 12px;
            padding: 18px 22px;
            border: 1px solid #e8d9c0;
            margin-bottom: 20px;
        }

        .recommended-filter-section h3 {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #6b5a4a;
            margin-bottom: 15px;
            font-weight: 600;
            border-bottom: 1px solid #f0e8dc;
            padding-bottom: 10px;
        }

        .recommended-filter-section h3 i {
            color: #b18a45;
            margin-right: 8px;
        }

        .filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-row .filter-group {
            margin-bottom: 0;
            flex: 1;
            min-width: 150px;
        }

        .filter-row .filter-group label {
            display: none;
        }

        .filter-row select,
        .filter-row input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #e0d5c8;
            border-radius: 8px;
            background: #faf7f2;
            font-family: inherit;
            font-size: 13px;
            color: #2c2416;
            transition: border-color 0.2s;
        }

        .filter-row select:focus,
        .filter-row input:focus {
            outline: none;
            border-color: #b18a45;
        }

        .filter-row .filter-actions {
            display: flex;
            gap: 8px;
            margin-top: 0;
        }

        .filter-row .btn-filter {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .filter-row .btn-filter-primary {
            background: #0072ff;
            color: white;
        }

        .filter-row .btn-filter-primary:hover {
            background: #9a7740;
        }

        .filter-row .btn-filter-secondary {
            background: #f0e8dc;
            color: #2c2416;
        }

        .filter-row .btn-filter-secondary:hover {
            background: #e0d5c8;
        }

        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-row .filter-group {
                min-width: 100%;
            }

            .filter-row .filter-actions {
                flex-direction: row;
            }

            .filter-row .filter-actions button {
                flex: 1;
            }
        }

        /* =========================================================
                   PRODUCT AREA
                ========================================================= */

        .wishlist-products-section {
            width: 100%;
        }

        .wishlist-section {
            background: transparent;
            border: 0;
            border-radius: 0;
            padding: 0;
            margin: 0 0 20px;
        }

        .wishlist-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .wishlist-section-title {
            display: flex;
            align-items: baseline;
            gap: 8px;
            min-width: 0;
        }

        .wishlist-section-title h3 {
            margin: 0;
            font-family: "Cormorant Garamond", serif;
            font-size: 23px;
            line-height: 1;
            font-weight: 600;
            color: var(--s-text);
        }

        .wishlist-section-title span {
            color: #99938a;
            font-size: 9px;
        }

        .wishlist-view-all {
            text-decoration: none;
            color: var(--s-primary);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .wishlist-view-all:hover {
            color: var(--s-primary-dark);
        }

        /* =========================================================
                   PRODUCT GRID
                ========================================================= */

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        /* =========================================================
                   PRODUCT CARD
                ========================================================= */

        .jewel-product-card {
            background: #fff;
            border: 1px solid var(--s-border);
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: .25s ease;
            cursor: pointer;
            height: 100%;
        }

        .jewel-product-card:hover {
            transform: translateY(-3px);
            border-color: #d6c7aa;
            box-shadow: 0 12px 28px rgba(70, 55, 30, .08);
        }

        /* =========================================================
                   IMAGE
                ========================================================= */

        .jewel-product-image {
            height: 245px;
            background: #f5f2ec;
            position: relative;
            overflow: hidden;
        }

        .jewel-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .5s ease;
        }

        .jewel-product-card:hover .jewel-product-image img {
            transform: scale(1.045);
        }

        .jewel-no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #c8c0b2;
            font-size: 35px;
        }

        /* =========================================================
                   BADGES
                ========================================================= */

        .jewel-badge {
            position: absolute;
            top: 9px;
            left: 9px;
            z-index: 5;
            padding: 4px 7px;
            border-radius: 3px;
            color: #fff;
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .jewel-badge.offer {
            background: #9f2922;
        }

        .jewel-badge.new {
            background: #53745c;
        }

        .jewel-badge.featured {
            background: var(--s-primary);
        }

        /* =========================================================
                   HEART
                ========================================================= */

        .jewel-heart {
            position: absolute;
            top: 9px;
            right: 9px;
            z-index: 8;
            width: 31px;
            height: 31px;
            border-radius: 50%;
            border: 1px solid rgba(165, 139, 84, .25);
            background: rgba(255, 255, 255, .96);
            color: #a58b54;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .06);
        }

        .jewel-heart:hover {
            transform: scale(1.08);
            background: #fff;
            color: #9f2922;
        }

        .jewel-heart i {
            font-size: 13px;
        }

        .jewel-heart.active {
            color: #a58b54;
        }

        /* =========================================================
                   STOCK
                ========================================================= */

        .jewel-stock {
            position: absolute;
            bottom: 9px;
            right: 9px;
            padding: 4px 7px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: 700;
            z-index: 5;
        }

        .jewel-stock.in-stock {
            background: #edf7ef;
            color: #39734b;
        }

        .jewel-stock.out-stock {
            background: #fceceb;
            color: #a83b34;
        }

        /* =========================================================
                   PRODUCT INFO
                ========================================================= */

        .jewel-product-info {
            padding: 11px 12px 12px;
        }

        .jewel-category {
            color: var(--s-primary);
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 4px;
        }

        .jewel-product-name {
            font-family: "Cormorant Garamond", serif;
            font-size: 16px;
            line-height: 1.1;
            color: var(--s-text);
            font-weight: 600;
            margin-bottom: 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* =========================================================
                   RATING
                ========================================================= */

        .jewel-rating {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-bottom: 7px;
        }

        .jewel-rating i {
            color: var(--s-gold);
            font-size: 8px;
        }

        .jewel-rating span {
            color: #99938a;
            font-size: 8px;
            margin-left: 3px;
        }

        /* =========================================================
                   PRICE
                ========================================================= */

        .jewel-price-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 9px;
        }

        .jewel-price {
            color: var(--s-text);
            font-size: 14px;
            font-weight: 800;
        }

        .jewel-old-price {
            color: #aaa59c;
            text-decoration: line-through;
            font-size: 9px;
        }

        .jewel-discount {
            color: #a33c35;
            font-size: 8px;
            font-weight: 700;
        }

        /* =========================================================
                   CART BUTTON
                ========================================================= */

        .jewel-cart-btn {
            width: 100%;
            min-height: 31px;
            border: 1px solid #dcd5c8;
            background: #fff;
            color: var(--s-text);
            border-radius: 4px;
            padding: 6px 8px;
            font-size: 9px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: .2s ease;
        }

        .jewel-cart-btn:hover:not(:disabled) {
            background: var(--s-primary);
            border-color: var(--s-primary);
            color: #fff;
        }

        .jewel-cart-btn:disabled {
            background: #f3f1ed;
            color: #9b978f;
            border-color: #e4dfd6;
            cursor: not-allowed;
        }

        .jewel-cart-btn.notify {
            background: #faf5e8;
            border-color: #e6d7b6;
            color: #8d733f;
        }

        /* =========================================================
                   EMPTY
                ========================================================= */

        .wishlist-empty {
            background: #fff;
            border: 1px solid var(--s-border);
            border-radius: 8px;
            padding: 55px 20px;
            text-align: center;
        }

        .empty-heart {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            margin: 0 auto 14px;
            background: var(--s-primary-light);
            color: var(--s-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
        }

        .wishlist-empty h3 {
            margin: 0 0 5px;
            font-family: "Cormorant Garamond", serif;
            font-size: 25px;
            font-weight: 600;
            color: var(--s-text);
        }

        .wishlist-empty p {
            color: #918c84;
            font-size: 11px;
            margin-bottom: 16px;
        }

        .shop-now-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--s-primary);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            padding: 9px 17px;
            font-size: 10px;
            font-weight: 700;
            transition: .2s ease;
        }

        .shop-now-btn:hover {
            color: #fff;
            background: var(--s-primary-dark);
        }

        /* =========================================================
                   RECOMMENDED - FILTERED SECTION
                ========================================================= */

        .recommended-section {
            margin-top: 20px;
        }

        .recommended-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
        }

        .recommended-grid .no-products-found {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px 20px;
            background: #fff;
            border: 1px solid var(--s-border);
            border-radius: 8px;
        }

        .recommended-grid .no-products-found i {
            font-size: 38px;
            color: #d5cfc5;
            display: block;
            margin-bottom: 10px;
        }

        .recommended-grid .no-products-found p {
            color: #77736d;
            font-size: 11px;
            margin: 0;
        }

        .recommended-grid .no-products-found .shop-now-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--s-primary);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            padding: 9px 17px;
            font-size: 10px;
            font-weight: 700;
            margin-top: 12px;
            transition: .2s ease;
        }

        .recommended-grid .no-products-found .shop-now-btn:hover {
            color: #fff;
            background: var(--s-primary-dark);
        }

        /* =========================================================
                   PRODUCT MODAL
                ========================================================= */

        #productDetailsModal .modal-content {
            border: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        #productDetailsModal .modal-body {
            background: #fff;
        }

        /* =========================================================
                   RESPONSIVE
                ========================================================= */

        @media(max-width:1200px) {
            .wishlist-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .recommended-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .jewel-product-image {
                height: 220px;
            }
        }

        @media(max-width:992px) {
            .wishlist-services {
                grid-template-columns: repeat(2, 1fr);
            }

            .wishlist-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .recommended-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media(max-width:768px) {
            .wishlist-page {
                padding: 13px 0 35px;
            }

            .wishlist-heading {
                align-items: flex-start;
                flex-direction: column;
                margin-bottom: 13px;
            }

            .wishlist-heading h1 {
                font-size: 27px;
            }

            .wishlist-heading-actions {
                width: 100%;
            }

            .wishlist-top-btn {
                flex: 1;
                justify-content: center;
            }

            .wishlist-services {
                grid-template-columns: repeat(2, 1fr);
                gap: 6px;
            }

            .wishlist-service {
                min-height: 52px;
                padding: 8px;
            }

            .service-icon {
                width: 29px;
                height: 29px;
                min-width: 29px;
                font-size: 12px;
            }

            .service-content strong {
                font-size: 9px;
            }

            .service-content span {
                font-size: 7.5px;
            }

            .wishlist-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .recommended-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .jewel-product-image {
                height: 205px;
            }

            .wishlist-section-title h3 {
                font-size: 21px;
            }
        }

        @media(max-width:576px) {
            .wishlist-heading h1 {
                font-size: 25px;
            }

            .wishlist-heading p {
                font-size: 10px;
            }

            .wishlist-services {
                grid-template-columns: 1fr 1fr;
            }

            .wishlist-service {
                padding: 7px;
            }

            .service-icon {
                width: 27px;
                height: 27px;
                min-width: 27px;
            }

            .jewel-product-image {
                height: 170px;
            }

            .jewel-product-info {
                padding: 9px;
            }

            .jewel-product-name {
                font-size: 15px;
            }

            .jewel-price {
                font-size: 13px;
            }

            .jewel-old-price {
                font-size: 8px;
            }

            .jewel-cart-btn {
                min-height: 29px;
                font-size: 8px;
            }

            .jewel-heart {
                width: 28px;
                height: 28px;
                top: 7px;
                right: 7px;
            }

            .jewel-badge {
                top: 7px;
                left: 7px;
                font-size: 7px;
            }

            .jewel-stock {
                bottom: 7px;
                right: 7px;
                font-size: 7px;
            }

            .wishlist-section-header {
                align-items: flex-end;
            }

            .wishlist-section-title {
                display: block;
            }

            .wishlist-section-title span {
                display: block;
                margin-top: 3px;
            }
        }
    </style>

@endsection


@section('content')

    <div class="wishlist-page">

        <div class="container">

            {{-- =====================================================
            HEADER
            ====================================================== --}}

            <div class="wishlist-heading">

                <div class="wishlist-heading-left">

                    <div class="wishlist-heading-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>

                    <div>

                        <h1>My Wishlist</h1>

                        <p>
                            {{ $wishlistCount ?? 0 }}
                            {{ ($wishlistCount ?? 0) == 1 ? 'item' : 'items' }}
                            saved for later
                        </p>

                    </div>

                </div>

                <div class="wishlist-heading-actions">

                    <button type="button" class="wishlist-top-btn" onclick="shareWishlist()">

                        <i class="bi bi-share"></i>
                        Share Wishlist

                    </button>

                    @if(isset($wishlistProducts) && $wishlistProducts->count() > 0)

                        <button type="button" class="wishlist-top-btn danger" onclick="clearWishlist()">

                            <i class="bi bi-trash3"></i>
                            Clear All

                        </button>

                    @endif

                </div>

            </div>


            {{-- =====================================================
            SERVICES
            ====================================================== --}}

            <div class="wishlist-services">

                <div class="wishlist-service">

                    <div class="service-icon">
                        <i class="bi bi-award"></i>
                    </div>

                    <div class="service-content">
                        <strong>Premium Quality</strong>
                        <span>100% genuine products</span>
                    </div>

                </div>

                <div class="wishlist-service">

                    <div class="service-icon">
                        <i class="bi bi-lock"></i>
                    </div>

                    <div class="service-content">
                        <strong>Secure Payment</strong>
                        <span>Safe & secure checkout</span>
                    </div>

                </div>

                <div class="wishlist-service">

                    <div class="service-icon">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </div>

                    <div class="service-content">
                        <strong>Easy Returns</strong>
                        <span>7-day return policy</span>
                    </div>

                </div>

                <div class="wishlist-service">

                    <div class="service-icon">
                        <i class="bi bi-truck"></i>
                    </div>

                    <div class="service-content">
                        <strong>Free Shipping</strong>
                        <span>Orders above ₹999</span>
                    </div>

                </div>

            </div>

            {{-- =====================================================
            RECOMMENDED PRODUCTS WITH FILTER
            ====================================================== --}}

            @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)

                <div class="recommended-section">

                    {{-- FILTER FOR RECOMMENDED PRODUCTS --}}
                    <div class="recommended-filter-section">
                        <h3><i class="fas fa-filter"></i> Filter Recommended Products</h3>

                        <form id="recommendedFilterForm" onsubmit="return false;">
                            <div class="filter-row">

                                {{-- Category Filter --}}
                                <div class="filter-group">
                                    <select name="rec_category" id="recCategoryFilter">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->slug }}" {{ request('rec_category') == $category->slug ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Price Range --}}
                                <div class="filter-group" style="display:flex; gap:8px;">
                                    <input type="number" name="rec_min_price" id="recMinPrice" placeholder="Min ₹" min="0"
                                        value="{{ request('rec_min_price') }}">
                                    <input type="number" name="rec_max_price" id="recMaxPrice" placeholder="Max ₹" min="0"
                                        value="{{ request('rec_max_price') }}">
                                </div>

                                {{-- Sort --}}
                                <div class="filter-group">
                                    <select name="rec_sort" id="recSortFilter">
                                        <option value="newest" {{ request('rec_sort') == 'newest' ? 'selected' : '' }}>Newest
                                        </option>
                                        <option value="price_asc" {{ request('rec_sort') == 'price_asc' ? 'selected' : '' }}>
                                            Price: Low to High</option>
                                        <option value="price_desc" {{ request('rec_sort') == 'price_desc' ? 'selected' : '' }}>
                                            Price: High to Low</option>
                                        <option value="name_asc" {{ request('rec_sort') == 'name_asc' ? 'selected' : '' }}>Name: A
                                            to Z</option>
                                        <option value="name_desc" {{ request('rec_sort') == 'name_desc' ? 'selected' : '' }}>Name:
                                            Z to A</option>
                                    </select>
                                </div>

                                {{-- Actions --}}
                                <div class="filter-actions">
                                    <button type="button" class="btn-filter btn-filter-primary"
                                        onclick="applyRecommendedFilters()">
                                        <i class="fas fa-search"></i> Apply
                                    </button>
                                    <button type="button" class="btn-filter btn-filter-secondary"
                                        onclick="resetRecommendedFilters()">
                                        <i class="fas fa-undo"></i> Reset
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>

                    {{-- RECOMMENDED PRODUCTS GRID --}}
                    <div class="wishlist-section" id="recommendedProductsContainer">

                        <div class="wishlist-section-header">

                            <div class="wishlist-section-title">

                                <h3>
                                    <i class="bi bi-stars" style="color:var(--s-primary);"></i>
                                    @if(isset($selectedCategory))
                                        {{ $selectedCategory->name }} - Recommended For You
                                    @else
                                        Recommended For You
                                    @endif
                                </h3>

                                <span>
                                    @if(isset($selectedCategory))
                                        Handpicked {{ $selectedCategory->name }} products you'll love
                                    @else
                                        Handpicked products you'll love
                                    @endif
                                </span>

                            </div>

                            <a href="{{ route('customer.products', isset($selectedCategory) ? ['category' => $selectedCategory->slug] : []) }}"
                                class="wishlist-view-all">
                                View All <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>

                        <div class="recommended-grid" id="recommendedProductsGrid">

                            @foreach($recommendedProducts as $product)

                                @php

                                    $images = $product->image
                                        ? array_map(
                                            'trim',
                                            explode(',', $product->image)
                                        )
                                        : [];

                                    $firstImage = $images[0] ?? null;

                                    if ($firstImage) {

                                        $firstImage = preg_replace(
                                            '#^storage/#',
                                            '',
                                            $firstImage
                                        );

                                        $imgUrl = asset($firstImage);

                                    } else {

                                        $imgUrl = null;

                                    }


                                    // =============================================
                                    // GET SELLING PRICE AND ORIGINAL PRICE
                                    // =============================================

                                    // Selling price (from product's selling_price field)
                                    $sellingPrice = (float) ($product->selling_price ?? $product->price ?? 0);

                                    // Original price (from product's price field)
                                    $originalPrice = (float) ($product->price ?? 0);

                                    // Check if there's a discount
                                    $hasDiscount = $originalPrice > $sellingPrice;

                                    // Calculate discount percentage
                                    $discountPercent = $hasDiscount ? round((($originalPrice - $sellingPrice) / $originalPrice) * 100) : 0;


                                    // =============================================
                                    // ACTIVE OFFER (from offers table)
                                    // =============================================

                                    $activeOffer =
                                        $product->active_offer ?? null;

                                    // If active offer exists, it overrides the selling price
                                    if ($activeOffer) {

                                        if (
                                            $activeOffer->discount_type
                                            === 'percentage'
                                        ) {

                                            $sellingPrice =
                                                $originalPrice -
                                                (
                                                    $originalPrice *
                                                    $activeOffer->discount_value
                                                    / 100
                                                );

                                        } else {

                                            $sellingPrice =
                                                max(
                                                    0,
                                                    $originalPrice -
                                                    $activeOffer->discount_value
                                                );

                                        }

                                        // Recalculate discount if active offer gives better discount
                                        $hasDiscount = $originalPrice > $sellingPrice;
                                        $discountPercent = $hasDiscount ? round((($originalPrice - $sellingPrice) / $originalPrice) * 100) : 0;
                                    }


                                    $isFutured =
                                        isset($product->is_futured) &&
                                        $product->is_futured == 1;

                                    $isNew =
                                        isset($product->is_futured) &&
                                        $product->is_futured == 2;

                                    $isOutOfStock =
                                        $product->stock !== null &&
                                        $product->stock <= 0;

                                @endphp


                                <div>

                                    <div class="jewel-product-card product-details-trigger" data-product-id="{{ $product->id }}">

                                        {{-- IMAGE --}}

                                        <div class="jewel-product-image">

                                            @if($imgUrl)

                                                <img src="{{ $imgUrl }}" alt="{{ $product->name }}" loading="lazy"
                                                    onerror="this.src='{{ asset('images/placeholder.png') }}'">

                                            @else

                                                <div class="jewel-no-image">
                                                    <i class="bi bi-image"></i>
                                                </div>

                                            @endif


                                            {{-- BADGE --}}

                                            @if($activeOffer)

                                                <span class="jewel-badge offer">

                                                    @if($activeOffer->discount_type === 'percentage')

                                                                            {{ rtrim(
                                                            rtrim(
                                                                number_format(
                                                                    $activeOffer->discount_value,
                                                                    2
                                                                ),
                                                                '0'
                                                            ),
                                                            '.'
                                                        ) }}% OFF

                                                    @else

                                                                            ₹{{ number_format(
                                                            $activeOffer->discount_value,
                                                            0
                                                        ) }} OFF

                                                    @endif

                                                </span>

                                            @elseif($isFutured)

                                                <span class="jewel-badge featured">
                                                    <i class="bi bi-stars"></i>
                                                    Featured
                                                </span>

                                            @elseif($isNew)

                                                <span class="jewel-badge new">
                                                    New
                                                </span>

                                            @endif


                                            {{-- HEART --}}

                                            <button type="button" class="jewel-heart wishlist-btn"
                                                data-product-id="{{ $product->id }}" onclick="
                                                                                                event.preventDefault();
                                                                                                event.stopPropagation();
                                                                                                toggleWishlist(this)
                                                                                            ">

                                                <i class="bi bi-heart"></i>

                                            </button>


                                            {{-- STOCK --}}

                                            @if($product->stock !== null)

                                                                <span class="jewel-stock
                                                                                                                                                                                {{ $isOutOfStock
                                                ? 'out-stock'
                                                : 'in-stock' }}">

                                                                    {{ $isOutOfStock
                                                ? 'Out of Stock'
                                                : 'In Stock' }}

                                                                </span>

                                            @endif

                                        </div>


                                        {{-- INFO --}}

                                        <div class="jewel-product-info">

                                            <div class="jewel-category">
                                                {{ $product->category->name ?? 'Product' }}
                                            </div>


                                            <div class="jewel-product-name" title="{{ $product->name }}">

                                                {{ Str::limit($product->name, 25) }}

                                            </div>


                                            <div class="jewel-rating">

                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>

                                                <span>
                                                    4.8
                                                </span>

                                            </div>


                                            {{-- PRICE ROW --}}
                                            <div class="jewel-price-row">

                                                {{-- SELLING PRICE (green) --}}
                                                <span class="jewel-price" style="color:#198754;font-weight:700;font-size:15px;">
                                                    ₹{{ number_format($sellingPrice, 0) }}
                                                </span>

                                                {{-- ORIGINAL PRICE (crossed out) --}}
                                                @if($hasDiscount)
                                                    <span class="jewel-old-price"
                                                        style="color:#94a3b8;text-decoration:line-through;text-decoration-thickness:1px;font-size:12px;">
                                                        ₹{{ number_format($originalPrice, 0) }}
                                                    </span>

                                                    {{-- DISCOUNT PERCENTAGE BADGE --}}
                                                    <span
                                                        style="background:#fef2f2;color:#ef4444;font-size:9px;font-weight:700;padding:2px 8px;border-radius:3px;margin-left:4px;">
                                                        {{ $discountPercent }}% OFF
                                                    </span>
                                                @endif

                                                {{-- ACTIVE OFFER BADGE (if different from selling price discount) --}}
                                                @if($activeOffer && $hasDiscount)
                                                    <span
                                                        style="background:#f0fdf4;color:#16a34a;font-size:8px;font-weight:600;padding:2px 8px;border-radius:3px;margin-left:4px;border:1px solid #bbf7d0;">
                                                        <i class="bi bi-tag-fill"></i>
                                                        @if($activeOffer->discount_type === 'percentage')
                                                            {{ rtrim(rtrim(number_format($activeOffer->discount_value, 2), '0'), '.') }}%
                                                            OFF
                                                        @else
                                                            ₹{{ number_format($activeOffer->discount_value, 0) }} OFF
                                                        @endif
                                                    </span>
                                                @endif

                                            </div>


                                            @if($isFutured)

                                                <button type="button" class="jewel-cart-btn notify notify-me-btn"
                                                    data-product-id="{{ $product->id }}" onclick="
                                                                                                                    event.preventDefault();
                                                                                                                    event.stopPropagation();
                                                                                                                ">

                                                    <i class="bi bi-bell"></i>
                                                    Notify Me

                                                </button>

                                            @elseif($isOutOfStock)

                                                <button type="button" class="jewel-cart-btn" disabled>

                                                    <i class="bi bi-x-circle"></i>
                                                    Out of Stock

                                                </button>

                                            @else

                                                <form action="{{ route('cart.add', $product->id) }}" method="POST"
                                                    onclick="event.stopPropagation();">

                                                    @csrf

                                                    <button type="submit" class="jewel-cart-btn">

                                                        <i class="bi bi-bag-plus"></i>
                                                        Add to Cart

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @else

                {{-- =================================================
                NO RECOMMENDED PRODUCTS
                ================================================== --}}

                <div class="recommended-section">

                    <div class="wishlist-section">

                        <div class="wishlist-section-header">

                            <div class="wishlist-section-title">

                                <h3>

                                    <i class="bi bi-stars" style="color:var(--s-primary);">
                                    </i>

                                    @if(isset($selectedCategory))

                                        No Products Found in
                                        {{ $selectedCategory->name }}

                                    @else

                                        No Products Found

                                    @endif

                                </h3>

                                <span>

                                    @if(isset($selectedCategory))

                                        Try exploring other categories

                                    @else

                                        Check back later for new arrivals

                                    @endif

                                </span>

                            </div>


                            <a href="{{ route('customer.products') }}" class="wishlist-view-all">

                                View All Products
                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>


                        <div style="
                                                            text-align:center;
                                                            padding:30px 20px;
                                                            background:#fff;
                                                            border:1px solid var(--s-border);
                                                            border-radius:8px;
                                                        ">

                            <i class="bi bi-box" style="
                                                                font-size:38px;
                                                                color:#d5cfc5;
                                                                display:block;
                                                                margin-bottom:10px;
                                                            ">
                            </i>

                            <p style="
                                                                color:#77736d;
                                                                font-size:11px;
                                                                margin:0;
                                                            ">

                                @if(isset($selectedCategory))

                                    No products available in
                                    <strong>
                                        {{ $selectedCategory->name }}
                                    </strong>
                                    category.

                                @else

                                    No products available at the moment.

                                @endif

                            </p>


                            <a href="{{ route('customer.products') }}" class="shop-now-btn" style="margin-top:12px;">

                                <i class="bi bi-arrow-left"></i>
                                Browse All Products

                            </a>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =========================================================
    PRODUCT DETAILS MODAL
    ========================================================= --}}

    <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <button type="button" class="btn-close position-absolute" style="
                                    right:20px;
                                    top:20px;
                                    z-index:10;
                                " data-bs-dismiss="modal">
                </button>


                <div class="modal-body p-4">

                    <div id="productModalLoader" class="text-center py-5">

                        <div class="spinner-border" style="color:var(--s-primary);">
                        </div>

                    </div>


                    <div id="productModalContent" style="display:none;">

                        <div class="row g-4">

                            <div class="col-md-6">

                                <div style="
                                                    height:430px;
                                                    background:#f8f6f1;
                                                    border-radius:8px;
                                                    overflow:hidden;
                                                ">

                                    <img id="modalProductImage" src="" alt="Product" style="
                                                        width:100%;
                                                        height:100%;
                                                        object-fit:contain;
                                                    ">

                                </div>

                            </div>


                            <div class="col-md-6">

                                <span id="modalProductCategory" style="
                                                    color:var(--s-primary);
                                                    font-size:10px;
                                                    font-weight:700;
                                                    text-transform:uppercase;
                                                    letter-spacing:.7px;
                                                ">
                                </span>


                                <h3 id="modalProductName" style="
                                                    font-family:'Cormorant Garamond',serif;
                                                    font-size:30px;
                                                    margin:7px 0 10px;
                                                    font-weight:600;
                                                    color:var(--s-text);
                                                ">
                                </h3>


                                <div style="
                                                    color:var(--s-gold);
                                                    margin-bottom:14px;
                                                    font-size:11px;
                                                ">

                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>

                                    <span style="
                                                        color:#999;
                                                        font-size:10px;
                                                        margin-left:5px;
                                                    ">

                                        4.8 Reviews

                                    </span>

                                </div>


                                <div id="modalProductPrice" style="
                                                    font-size:24px;
                                                    font-weight:800;
                                                    margin-bottom:15px;
                                                    color:var(--s-text);
                                                ">
                                </div>


                                <div id="modalProductDescription" style="
                                                    color:#6b6862;
                                                    font-size:12px;
                                                    line-height:1.7;
                                                    border-top:1px solid #eee;
                                                    border-bottom:1px solid #eee;
                                                    padding:13px 0;
                                                    margin-bottom:16px;
                                                ">
                                </div>


                                <div style="
                                                    display:grid;
                                                    grid-template-columns:1fr 1fr;
                                                    gap:15px;
                                                    margin-bottom:18px;
                                                ">

                                    <div>

                                        <small style="
                                                            color:#999;
                                                            display:block;
                                                            font-size:9px;
                                                            margin-bottom:3px;
                                                        ">

                                            Availability

                                        </small>

                                        <strong id="modalProductStock" style="font-size:11px;">
                                        </strong>

                                    </div>


                                    <div>

                                        <small style="
                                                            color:#999;
                                                            display:block;
                                                            font-size:9px;
                                                            margin-bottom:3px;
                                                        ">

                                            Category

                                        </small>

                                        <strong id="modalProductCategoryInfo" style="font-size:11px;">
                                        </strong>

                                    </div>

                                </div>


                                <div id="modalProductAction"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>

        /* =========================================================
           SHARE WISHLIST
        ========================================================= */

        function shareWishlist() {
            if (navigator.share) {
                navigator.share({
                    title: 'My Wishlist',
                    text: 'Check out my wishlist!',
                    url: window.location.href
                }).catch(() => { });
            } else {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Wishlist link copied to clipboard!');
                }).catch(() => {
                    prompt('Copy this link to share your wishlist:', window.location.href);
                });
            }
        }

        /* =========================================================
           CLEAR WISHLIST
        ========================================================= */

        function clearWishlist() {
            if (confirm('Are you sure you want to clear your entire wishlist?')) {
                // Add your clear wishlist logic here
                alert('Wishlist cleared successfully!');
                location.reload();
            }
        }

        /* =========================================================
           FILTER RECOMMENDED PRODUCTS - AJAX
        ========================================================= */

        function applyRecommendedFilters() {
            const category = document.getElementById('recCategoryFilter').value;
            const minPrice = document.getElementById('recMinPrice').value;
            const maxPrice = document.getElementById('recMaxPrice').value;
            const sort = document.getElementById('recSortFilter').value;

            const params = new URLSearchParams();
            if (category) params.append('rec_category', category);
            if (minPrice) params.append('rec_min_price', minPrice);
            if (maxPrice) params.append('rec_max_price', maxPrice);
            if (sort) params.append('rec_sort', sort);

            const container = document.getElementById('recommendedProductsGrid');
            container.innerHTML = `
                        <div class="no-products-found" style="grid-column:1/-1;text-align:center;padding:40px 20px;">
                            <div class="spinner-border" style="color:var(--s-primary);width:2rem;height:2rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p style="color:#999;font-size:12px;margin-top:10px;">Loading products...</p>
                        </div>
                    `;

            fetch(`{{ route('customer.wishlist.filter') }}?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        container.innerHTML = data.html;
                    } else {
                        container.innerHTML = `
                                <div class="no-products-found">
                                    <i class="bi bi-exclamation-circle" style="color:#ef4444;"></i>
                                    <p>${data.message || 'Failed to load products.'}</p>
                                </div>
                            `;
                    }
                })
                .catch(error => {
                    console.error('Filter error:', error);
                    container.innerHTML = `
                            <div class="no-products-found">
                                <i class="bi bi-exclamation-circle" style="color:#ef4444;"></i>
                                <p>Something went wrong. Please try again.</p>
                            </div>
                        `;
                });
        }

        function resetRecommendedFilters() {
            document.getElementById('recCategoryFilter').value = '';
            document.getElementById('recMinPrice').value = '';
            document.getElementById('recMaxPrice').value = '';
            document.getElementById('recSortFilter').value = 'newest';
            applyRecommendedFilters();
        }

        /* =========================================================
    PRODUCT DETAILS MODAL
    ========================================================= */

        document.addEventListener('DOMContentLoaded', function () {
            const modalEl = document.getElementById('productDetailsModal');
            if (!modalEl) return;

            const productModal = new bootstrap.Modal(modalEl);
            const loader = document.getElementById('productModalLoader');
            const content = document.getElementById('productModalContent');

            // Click handler for product cards
            document.addEventListener('click', function (e) {
                // Find the closest product card
                const card = e.target.closest('.jewel-product-card');
                if (!card) return;

                // Ignore clicks on buttons, forms, or links inside the card
                if (e.target.closest('button') || e.target.closest('form') || e.target.closest('a')) {
                    return;
                }

                const productId = card.dataset.productId;
                if (!productId) return;

                // Show loader, hide content
                if (loader) loader.style.display = 'block';
                if (content) content.style.display = 'none';

                // Show modal
                productModal.show();

                // Fetch product details
                fetch(`/customer/product-details/${productId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(async response => {
                        const data = await response.json();
                        if (!response.ok) throw new Error(data.message || 'Failed to load product details');
                        return data;
                    })
                    .then(data => {
                        if (!data.success || !data.product) throw new Error('Product not found');

                        const product = data.product;

                        // Update modal content
                        document.getElementById('modalProductImage').src = product.image || '{{ asset('images/placeholder.png') }}';
                        document.getElementById('modalProductCategory').textContent = product.category || 'Product';
                        document.getElementById('modalProductCategoryInfo').textContent = product.category || 'Product';
                        document.getElementById('modalProductName').textContent = product.name;

                        // Price display with selling price and original price
                        const sellingPrice = product.selling_price || product.price || 0;
                        const originalPrice = product.price || 0;
                        const hasDiscount = originalPrice > sellingPrice;

                        let priceHtml = `
                            `;

                        if (hasDiscount) {
                            priceHtml += `
                                    <span style="color:#94a3b8;text-decoration:line-through;font-size:16px;margin-left:10px;">
                                        ₹${parseFloat(originalPrice).toFixed(0)}
                                    </span>
                                    <span style="background:#fef2f2;color:#ef4444;font-size:12px;font-weight:700;padding:2px 10px;border-radius:3px;margin-left:8px;">
                                        ${Math.round(((originalPrice - sellingPrice) / originalPrice) * 100)}% OFF
                                    </span>
                                `;
                        }

                        document.getElementById('modalProductPrice').innerHTML = priceHtml;
                        document.getElementById('modalProductDescription').innerHTML = product.description || 'No description available.';

                        // Stock status
                        const stockEl = document.getElementById('modalProductStock');
                        if (stockEl) {
                            if (product.is_out_of_stock || product.stock <= 0) {
                                stockEl.textContent = 'Out of Stock';
                                stockEl.style.color = '#dc2626';
                            } else {
                                stockEl.textContent = 'In Stock' + (product.stock < 10 ? ` (${product.stock} left)` : '');
                                stockEl.style.color = '#16a34a';
                            }
                        }

                        // Review count
                        const reviewEl = document.getElementById('modalReviewCount');
                        if (reviewEl) {
                            reviewEl.textContent = `(${product.reviews_count || 0} Reviews)`;
                        }

                        // Action buttons
                        const actionEl = document.getElementById('modalProductAction');
                        if (actionEl) {
                            if (product.is_futured) {
                                actionEl.innerHTML = `
                                <button class="btn btn-outline-secondary w-100" style="padding:12px;font-weight:600;">
                                    <i class="bi bi-bell me-2"></i> Notify Me
                                </button>
                            `;
                            } else if (product.is_out_of_stock || product.stock <= 0) {
                                actionEl.innerHTML = `
                                <button class="btn btn-secondary w-100" disabled style="padding:12px;font-weight:600;cursor:not-allowed;">
                                    <i class="bi bi-x-circle me-2"></i> Out of Stock
                                </button>
                            `;
                            } else {
                                // Check if product is in cart
                                const cart = getCart ? getCart() : [];
                                const inCart = cart.some(item => item.id == product.id);

                                actionEl.innerHTML = `
                                <button type="button" class="btn btn-primary w-100 add-to-cart-btn"
                                    data-product-id="${product.id}"
                                    data-product-name="${product.name.replace(/'/g, "\\'")}"
                                    data-product-price="${sellingPrice}"
                                    data-product-slug="${product.slug || ''}"
                                    data-product-image="${product.image || ''}"
                                    onclick="event.stopPropagation(); addToCartFromCard(this, ${product.id}, '${product.name.replace(/'/g, "\\'")}', ${sellingPrice}, '${product.slug || ''}', '${product.image || ''}', ${originalPrice});"
                                    style="padding:12px;font-weight:600;">
                                    <i class="bi ${inCart ? 'bi-check-lg' : 'bi-cart-plus'} me-2"></i>
                                    ${inCart ? 'In Cart' : 'Add to Cart'}
                                </button>
                            `;
                            }
                        }

                        // Hide loader, show content
                        if (loader) loader.style.display = 'none';
                        if (content) content.style.display = 'block';

                    })
                    .catch(error => {
                        console.error('Product details error:', error);
                        if (loader) loader.style.display = 'none';
                        if (content) {
                            content.style.display = 'block';
                            content.innerHTML = `
                            <div class="text-center py-4">
                                <i class="bi bi-exclamation-circle" style="font-size:40px;color:#ef4444;"></i>
                                <p class="mt-2 text-danger">${error.message || 'Failed to load product details.'}</p>
                            </div>
                        `;
                        }
                    });
            });

            // Reset modal when closed
            modalEl.addEventListener('hidden.bs.modal', function () {
                if (loader) loader.style.display = 'block';
                if (content) {
                    content.style.display = 'none';
                    // Reset content
                    document.getElementById('modalProductImage').src = '';
                    document.getElementById('modalProductCategory').textContent = '';
                    document.getElementById('modalProductCategoryInfo').textContent = '';
                    document.getElementById('modalProductName').textContent = '';
                    document.getElementById('modalProductPrice').innerHTML = '';
                    document.getElementById('modalProductDescription').innerHTML = '';
                    document.getElementById('modalProductAction').innerHTML = '';
                }
            });
        });

        /* =========================================================
           ADD TO CART FROM MODAL
        ========================================================= */

        // Make sure addToCartFromCard function is available
        if (typeof addToCartFromCard === 'undefined') {
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
                        button.style.background = '#3b82f6';
                    }, 2000);

                    if (document.getElementById('cartPanel')?.classList.contains('open')) {
                        renderCartPanel();
                    }

                    // Close modal after adding to cart
                    const modalEl = document.getElementById('productDetailsModal');
                    if (modalEl) {
                        const modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                    }
                }, 400);
            }
        }

        /* =========================================================
           GET CART - Helper function
        ========================================================= */

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
    </script>

@endsection
