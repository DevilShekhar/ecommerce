@extends('frontend.layouts.customer-layout')
@section('title', 'My Wishlist - ShopHub')
@section('styles')
    <style>
        :root {
            --shop-blue: #1466d8;
            --shop-blue-dark: #0f5bc4;
            --text-dark: #111827;
            --text-muted: #64748b;
            --border: #e5e7eb;
            --light-bg: #f8fafc;
            --green: #16a34a;
            --red: #ef3340
        }

        body {
            background: #f8fafc;
            color: var(--text-dark)
        }

        .wishlist-page {
            padding: 38px 0 60px
        }

        .wishlist-wrapper {
            max-width: 1400px;
            margin: auto;
            padding: 0 25px
        }

        .wishlist-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            gap: 20px
        }

        .wishlist-title-area {
            display: flex;
            align-items: flex-start;
            gap: 16px
        }

        .wishlist-title-icon {
            width: 48px;
            height: 48px;
            border: 2px solid #1e293b;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            color: #172033;
            flex-shrink: 0
        }

        .wishlist-title h1 {
            margin: 0;
            font-size: 29px;
            font-weight: 700;
            letter-spacing: -0.5px
        }

        .wishlist-title p {
            margin: 4px 0 0;
            color: var(--shop-blue);
            font-size: 14px;
            font-weight: 600
        }

        .wishlist-actions {
            display: flex;
            gap: 12px
        }

        .wishlist-action-btn {
            height: 50px;
            padding: 0 24px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            text-decoration: none;
            transition: .2s ease
        }

        .wishlist-action-outline {
            border: 1px solid #cbd5e1;
            background: white;
            color: #111827
        }

        .wishlist-action-outline:hover {
            border-color: var(--shop-blue);
            color: var(--shop-blue)
        }

        .wishlist-action-primary {
            border: 1px solid var(--shop-blue);
            background: var(--shop-blue);
            color: #fff
        }

        .wishlist-action-primary:hover {
            background: var(--shop-blue-dark);
            color: #fff
        }

        .wishlist-list {
            display: flex;
            flex-direction: column;
            gap: 3px
        }

        .wishlist-item {
            background: #fff;
            border: 1px solid #edf0f4;
            border-radius: 13px;
            min-height: 118px;
            padding: 13px 20px;
            display: grid;
            grid-template-columns: 35px 175px minmax(260px, 1fr) 230px 285px 45px 45px;
            align-items: center;
            gap: 18px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
            transition: .2s ease;
            cursor: pointer;
        }

        .wishlist-item:hover {
            box-shadow: 0 7px 22px rgba(15, 23, 42, .08);
            border-color: #e2e8f0
        }

        .wishlist-checkbox {
            width: 22px;
            height: 22px;
            cursor: pointer;
            accent-color: var(--shop-blue)
        }

        .wishlist-product-image {
            height: 95px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .wishlist-product-image img {
            width: 145px;
            height: 95px;
            object-fit: contain
        }

        .wishlist-no-image {
            width: 100px;
            height: 80px;
            background: #f8fafc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 35px
        }

        .wishlist-product-info {
            min-width: 0
        }

        .wishlist-product-name {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 7px;
            color: #111827;
            line-height: 1.35
        }

        .wishlist-product-variant {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 8px
        }

        .stock-status {
            color: var(--green);
            font-size: 13px;
            font-weight: 500
        }

        .wishlist-price {
            min-width: 150px
        }

        .current-price {
            font-size: 19px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 7px
        }

        .old-price {
            font-size: 13px;
            color: #64748b;
            text-decoration: line-through;
            margin-right: 8px
        }

        .discount-badge {
            display: inline-block;
            background: #fff0f1;
            color: #ef3340;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 9px;
            border-radius: 5px
        }

        .move-cart-btn {
            height: 50px;
            border: 1px solid #d8dee7;
            background: white;
            border-radius: 7px;
            padding: 0 25px;
            color: #1f2937;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: .2s ease;
            width: 100%
        }

        .move-cart-btn:hover {
            border-color: var(--shop-blue);
            color: var(--shop-blue);
            background: #f8fbff
        }

        .delete-wishlist-btn,
        .heart-wishlist-btn {
            border: 0;
            background: transparent;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            transition: .2s ease
        }

        .delete-wishlist-btn {
            color: #334155
        }

        .delete-wishlist-btn:hover {
            background: #fef2f2;
            color: #ef3340
        }

        .heart-wishlist-btn {
            color: #ef3340;
            font-size: 21px
        }

        .heart-wishlist-btn:hover {
            background: #fff1f2;
            transform: scale(1.08)
        }

        .wishlist-features {
            margin-top: 28px;
            border: 1px solid #dce7f7;
            background: #f6f9ff;
            border-radius: 12px;
            padding: 18px 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr)
        }

        .wishlist-feature {
            display: flex;
            align-items: center;
            gap: 17px;
            padding: 8px 28px;
            border-right: 1px solid #dbe6f5
        }

        .wishlist-feature:last-child {
            border-right: 0
        }

        .feature-icon {
            width: 42px;
            min-width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--shop-blue)
        }

        .feature-text strong {
            display: block;
            font-size: 15px;
            margin-bottom: 4px
        }

        .feature-text span {
            color: #64748b;
            font-size: 13px
        }

        .recommendation-section {
            margin-top: 45px
        }

        .recommendation-title {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 18px;
            margin-bottom: 25px
        }

        .recommendation-title::before,
        .recommendation-title::after {
            content: "";
            width: 45px;
            height: 1px;
            background: #cbd5e1
        }

        .recommendation-title h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 700
        }

        .recommendation-card {
            background: #fff;
            border: 1px solid #edf0f4;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            position: relative;
            transition: .2s ease
        }

        .recommendation-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(15, 23, 42, .08)
        }

        .recommendation-image {
            height: 185px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative
        }

        .recommendation-image img {
            width: 100%;
            height: 100%;
            object-fit: contain
        }

        .recommendation-heart {
            position: absolute;
            right: 12px;
            top: 12px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer
        }

        .recommendation-info {
            padding: 13px 15px 17px
        }

        .recommendation-info h6 {
            font-size: 14px;
            font-weight: 600;
            margin: 0 0 7px
        }

        .recommendation-price {
            font-size: 16px;
            font-weight: 700
        }

        .empty-wishlist {
            background: #fff;
            border: 1px solid #edf0f4;
            border-radius: 14px;
            text-align: center;
            padding: 90px 20px
        }

        .empty-wishlist i {
            display: block;
            font-size: 70px;
            color: #dbe3ed;
            margin-bottom: 20px
        }

        .empty-wishlist h4 {
            font-weight: 700;
            margin-bottom: 8px
        }

        .empty-wishlist p {
            color: #64748b;
            margin-bottom: 20px
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999
        }

        .toast {
            background: #fff;
            border-radius: 8px;
            padding: 15px 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .15);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            animation: slideIn .3s ease
        }

        .toast-success {
            border-left: 4px solid #22c55e
        }

        .toast-error {
            border-left: 4px solid #ef4444
        }

        .toast i {
            font-size: 20px
        }

        .toast-success>i {
            color: #22c55e
        }

        .toast-error>i {
            color: #ef4444
        }

        .close-toast {
            background: none;
            border: 0;
            margin-left: auto;
            color: #94a3b8;
            font-size: 20px;
            cursor: pointer
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0
            }

            to {
                transform: translateX(0);
                opacity: 1
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1
            }

            to {
                transform: translateX(100%);
                opacity: 0
            }
        }

        @media(max-width:1200px) {
            .wishlist-item {
                grid-template-columns: 30px 140px minmax(200px, 1fr) 170px 210px 40px 40px;
                gap: 10px;
                padding: 12px
            }

            .wishlist-product-image img {
                width: 120px
            }

            .wishlist-features {
                grid-template-columns: repeat(2, 1fr);
                row-gap: 10px
            }

            .wishlist-feature:nth-child(2) {
                border-right: 0
            }
        }

        @media(max-width:991px) {
            .wishlist-header {
                align-items: flex-start;
                flex-direction: column
            }

            .wishlist-item {
                grid-template-columns: 30px 130px 1fr 160px;
                grid-template-areas: "check image info price" "check image actions delete";
                row-gap: 5px
            }

            .wishlist-item .wishlist-checkbox {
                grid-area: check
            }

            .wishlist-product-image {
                grid-area: image
            }

            .wishlist-product-info {
                grid-area: info
            }

            .wishlist-price {
                grid-area: price
            }

            .move-cart-btn {
                grid-area: actions
            }

            .delete-wishlist-btn {
                grid-area: delete
            }

            .heart-wishlist-btn {
                display: none
            }
        }

        @media(max-width:767px) {
            .wishlist-wrapper {
                padding: 0 12px
            }

            .wishlist-page {
                padding-top: 20px
            }

            .wishlist-title h1 {
                font-size: 23px
            }

            .wishlist-actions {
                width: 100%
            }

            .wishlist-action-btn {
                flex: 1;
                padding: 0 10px
            }

            .wishlist-item {
                grid-template-columns: 25px 90px 1fr;
                grid-template-areas: "check image info" "check image price" ". image actions" ". image delete";
                min-height: 170px;
                padding: 12px 8px
            }

            .wishlist-product-image {
                height: 120px
            }

            .wishlist-product-image img {
                width: 90px;
                height: 90px
            }

            .wishlist-product-name {
                font-size: 14px
            }

            .wishlist-price {
                min-width: auto
            }

            .current-price {
                font-size: 16px
            }

            .move-cart-btn {
                height: 38px;
                padding: 0 10px;
                font-size: 12px
            }

            .delete-wishlist-btn {
                justify-self: start
            }

            .wishlist-features {
                grid-template-columns: 1fr;
                padding: 10px
            }

            .wishlist-feature {
                border-right: 0;
                border-bottom: 1px solid #dbe6f5;
                padding: 15px 10px
            }

            .wishlist-feature:last-child {
                border-bottom: 0
            }

            .recommendation-section {
                margin-top: 30px
            }
        }

        /* ==========================================
           PRODUCT DETAILS MODAL
        ========================================== */
        .product-details-modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 60px rgba(15, 23, 42, .18);
        }

        .product-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #1d2b44;
            z-index: 20;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .25s ease;
        }

        .product-modal-close:hover {
            background: #142b4a;
            color: #fff;
            transform: rotate(90deg);
        }

        .product-modal-loader {
            min-height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-modal-image-wrap {
            height: 100%;
            min-height: 480px;
            background: #f8fafc;
            padding: 20px;
        }

        .product-modal-image-wrap img {
            width: 100%;
            height: 100%;
            min-height: 440px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-modal-details {
            padding: 38px 32px 32px;
            height: 100%;
        }

        .product-modal-category {
            color: #b8862d;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 10px;
        }

        .product-modal-details h3 {
            color: #1d2b44;
            font-size: 25px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 12px;
        }

        .product-modal-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .product-modal-rating .stars {
            color: #d69e2e;
        }

        .product-modal-price {
            font-size: 28px;
            font-weight: 700;
            color: #1d2b44;
            margin-bottom: 18px;
        }

        .product-modal-description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 22px;
        }

        .product-modal-info {
            border-top: 1px solid #e9edf2;
            border-bottom: 1px solid #e9edf2;
            padding: 15px 0;
            margin-bottom: 22px;
        }

        .product-modal-info div {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 7px 0;
        }

        .product-modal-info span {
            color: #64748b;
            font-size: 13px;
        }

        .product-modal-info strong {
            color: #1d2b44;
            font-size: 13px;
        }

        .product-modal-action form {
            width: 100%;
        }

        .product-modal-add-cart,
        .product-modal-notify {
            width: 100%;
            height: 48px;
            border-radius: 7px;
            border: 0;
            font-size: 15px;
            font-weight: 600;
            transition: .25s ease;
        }

        .product-modal-add-cart {
            background: #142b4a;
            color: #fff;
        }

        .product-modal-add-cart:hover {
            background: #0d2039;
        }

        .product-modal-notify {
            background: linear-gradient(135deg, #92400e, #78350f);
            color: #fbbf24;
        }

        @media (max-width: 767px) {
            .product-modal-image-wrap {
                min-height: 300px;
            }
            .product-modal-image-wrap img {
                min-height: 260px;
            }
            .product-modal-details {
                padding: 28px 22px;
            }
        }
    </style>
@endsection
@section('content')
    <div class="wishlist-page">
        <div class="wishlist-wrapper">
            <div class="wishlist-header">
                <div class="wishlist-title-area">
                    <div class="wishlist-title-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="wishlist-title">
                        <h1>My Wishlist</h1>
                        <p id="wishlistCountDisplay">
                            {{ isset($wishlistItems) ? $wishlistItems->total() : 0 }} items
                        </p>
                    </div>
                </div>
                <div class="wishlist-actions">
                    <button type="button" class="wishlist-action-btn wishlist-action-outline">
                        <i class="bi bi-share"></i>
                        Share Wishlist
                    </button>
                    <button type="button" class="wishlist-action-btn wishlist-action-primary">
                        <i class="bi bi-cart3"></i>
                        Move All to Cart
                    </button>
                </div>
            </div>
            @if(isset($wishlistItems) && $wishlistItems->count() > 0)
                <div class="wishlist-list" id="wishlistContainer">
                    @foreach($wishlistItems as $item)
                        @php
                            $product = $item->product;
                            $imgUrl = null;
                            if ($product) {
                                $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                $firstImage = $images[0] ?? null;
                                if ($firstImage) {
                                    $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                    $imgUrl = asset($firstImage);
                                }
                            }
                            $originalPrice = $product->original_price ?? null;
                            $discount = null;
                            if ($originalPrice && $originalPrice > $product->price) {
                                $discount = round((($originalPrice - $product->price) / $originalPrice) * 100);
                            }
                        @endphp
                        @if($product)
                            <div class="wishlist-item product-details-trigger" data-wishlist-id="{{ $item->id }}" data-product-id="{{ $product->id }}">
                                <input type="checkbox" class="wishlist-checkbox" value="{{ $item->id }}">
                                <div class="wishlist-product-image">
                                    @if($imgUrl)
                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                            onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                    @else
                                        <div class="wishlist-no-image">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="wishlist-product-info">
                                    <h3 class="wishlist-product-name" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </h3>
                                    @if(isset($product->color))
                                        <div class="wishlist-product-variant">
                                            {{ $product->color }}
                                        </div>
                                    @else
                                        <div class="wishlist-product-variant">
                                            {{ $product->category->name ?? 'Product' }}
                                        </div>
                                    @endif
                                    <div class="stock-status">
                                        <i class="bi bi-check-circle-fill"></i>
                                        In Stock
                                    </div>
                                </div>
                                <div class="wishlist-price">
                                    <div class="current-price">
                                        ₹{{ number_format($product->price, 0) }}
                                    </div>
                                    @if($originalPrice && $originalPrice > $product->price)
                                        <span class="old-price">
                                            ₹{{ number_format($originalPrice, 0) }}
                                        </span>
                                        <span class="discount-badge">
                                            {{ $discount }}% OFF
                                        </span>
                                    @endif
                                </div>
                                <button type="button" class="move-cart-btn" data-product-id="{{ $product->id }}"
                                    data-cart-url="{{ route('cart.add', $product->id) }}">
                                    <i class="bi bi-cart3"></i>
                                    Move to Cart
                                </button>
                                <button type="button" class="delete-wishlist-btn remove-wishlist-btn" data-id="{{ $item->id }}"
                                    data-url="{{ route('customer.wishlist.remove', $item->id) }}" title="Remove from Wishlist">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $wishlistItems->links() }}
                </div>
                <div class="wishlist-features">
                    <div class="wishlist-feature">
                        <div class="feature-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Save Your Favorites</strong>
                            <span>Keep track of items you love</span>
                        </div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon">
                            <i class="bi bi-bell"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Price Drop Alerts</strong>
                            <span>Get notified when prices drop</span>
                        </div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Secure &amp; Private</strong>
                            <span>Your wishlist is private</span>
                        </div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Across Devices</strong>
                            <span>Access anytime, anywhere</span>
                        </div>
                    </div>
                </div>
                @if(isset($recommendedProducts) && $recommendedProducts->count())
                    <div class="recommendation-section">
                        <div class="recommendation-title">
                            <h2>You May Also Like</h2>
                        </div>
                        <div class="row g-3">
                            @foreach($recommendedProducts as $recommended)
                                @php
                                    $recImage = null;
                                    if ($recommended->image) {
                                        $recImages = array_map('trim', explode(',', $recommended->image));
                                        $recImage = $recImages[0] ?? null;
                                        if ($recImage) {
                                            $recImage = preg_replace('#^storage/#', '', $recImage);
                                            $recImage = asset($recImage);
                                        }
                                    }
                                @endphp
                                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                                    <div class="recommendation-card">
                                        <div class="recommendation-image">
                                            @if($recImage)
                                                <img src="{{ $recImage }}" alt="{{ $recommended->name }}">
                                            @else
                                                <i class="bi bi-image" style="font-size:45px;color:#cbd5e1"></i>
                                            @endif
                                            <button class="recommendation-heart">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                        </div>
                                        <div class="recommendation-info">
                                            <h6>
                                                {{ $recommended->name }}
                                            </h6>
                                            <div class="recommendation-price">
                                                ₹{{ number_format($recommended->price, 0) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <div class="empty-wishlist">
                    <i class="bi bi-heart"></i>
                    <h4>Your Wishlist is Empty</h4>
                    <p>
                        Save your favorite products here and view them anytime.
                    </p>
                    <a href="{{ route('customer.products') }}" class="btn btn-primary px-4">
                        <i class="bi bi-cart3 me-1"></i>
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>

        <!-- ==========================================
         PRODUCT DETAILS MODAL
        ========================================== -->
        <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content product-details-modal-content">

                    <button type="button" class="product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>

                    <div class="modal-body p-0">

                        <div id="productModalLoader" class="product-modal-loader">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>

                        <div id="productModalContent" style="display:none;">

                            <div class="row g-0">

                                <!-- IMAGE -->
                                <div class="col-md-6">
                                    <div class="product-modal-image-wrap"
                                        style="height:500px; min-height:500px; max-height:500px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                                        <img id="modalProductImage" src="" alt="Product Image"
                                            style="width:100%; height:500px; object-fit:contain; display:block;">
                                    </div>
                                </div>

                                <!-- DETAILS -->
                                <div class="col-md-6">
                                    <div class="product-modal-details" style="height:500px; overflow-y:auto; padding:30px;">

                                        <div id="modalProductCategory" class="product-modal-category"></div>

                                        <h3 id="modalProductName"></h3>

                                        <div class="product-modal-rating">
                                            <span class="stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </span>
                                            <span id="modalReviewCount">(0 Reviews)</span>
                                        </div>

                                        <div id="modalProductPrice" class="product-modal-price"></div>

                                        <div id="modalProductDescription" class="product-modal-description"></div>

                                        <div class="product-modal-info">
                                            <div>
                                                <span>Availability</span>
                                                <strong id="modalProductStock"></strong>
                                            </div>
                                            <div>
                                                <span>Category</span>
                                                <strong id="modalProductCategoryInfo"></strong>
                                            </div>
                                        </div>

                                        <div id="modalProductAction" class="product-modal-action"></div>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container" id="toastContainer">
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                console.error('CSRF token not found!');
            }

            /*
            |--------------------------------------------------------------------------
            | REMOVE FROM WISHLIST
            |--------------------------------------------------------------------------
            */
            document.querySelectorAll('.remove-wishlist-btn').forEach(button => {

                button.addEventListener('click', function (e) {

                    e.preventDefault();
                    e.stopPropagation();

                    const url = this.dataset.url;
                    const removeBtn = this;

                    if (!url) {
                        showToast(
                            'error',
                            'Error',
                            'Invalid wishlist URL.'
                        );
                        return;
                    }

                    // Disable button while request is processing
                    removeBtn.disabled = true;
                    removeBtn.innerHTML =
                        '<i class="bi bi-hourglass-split"></i>';

                    fetch(url, {
                        method: 'DELETE',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })

                        .then(async response => {

                            const data = await response.json().catch(() => ({}));

                            if (!response.ok) {
                                throw new Error(
                                    data.message ||
                                    `Request failed with status ${response.status}`
                                );
                            }

                            return data;
                        })

                        .then(data => {

                            console.log('Wishlist remove response:', data);

                            if (data.success) {

                                showToast(
                                    'success',
                                    'Removed from wishlist',
                                    data.message ||
                                    'Product has been removed from your wishlist.'
                                );

                                /*
                                |--------------------------------------------------------------------------
                                | REFRESH PAGE AFTER SUCCESS
                                |--------------------------------------------------------------------------
                                */
                                setTimeout(() => {
                                    window.location.reload();
                                }, 700);

                            } else {

                                showToast(
                                    'error',
                                    'Error',
                                    data.message ||
                                    'Failed to remove item from wishlist.'
                                );

                                restoreRemoveButton(removeBtn);
                            }
                        })

                        .catch(error => {

                            console.error(
                                'Wishlist remove error:',
                                error
                            );

                            showToast(
                                'error',
                                'Error',
                                error.message ||
                                'Something went wrong while removing the product.'
                            );

                            restoreRemoveButton(removeBtn);
                        });
                });

            });

            /*
            |--------------------------------------------------------------------------
            | MOVE TO CART (Single Item)
            |--------------------------------------------------------------------------
            */
            document.querySelectorAll('.move-cart-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const url = this.dataset.cartUrl;
                    const btn = this;

                    if (!url) {
                        showToast('error', 'Error', 'Cart URL not found.');
                        return;
                    }

                    btn.disabled = true;
                    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({})
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showToast(
                                    'success',
                                    'Added to Cart',
                                    data.message || 'Product added to cart successfully.'
                                );

                                // Redirect to checkout
                                setTimeout(() => {
                                    window.location.href = "{{ route('checkout') }}";
                                }, 500);
                            } else {
                                showToast(
                                    'error',
                                    'Error',
                                    data.message || 'Failed to add product to cart.'
                                );
                                restoreCartButton(btn);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast(
                                'error',
                                'Error',
                                'Something went wrong while adding the product to cart.'
                            );
                            restoreCartButton(btn);
                        });
                });
            });

            /*
            |--------------------------------------------------------------------------
            | MOVE ALL TO CART
            |--------------------------------------------------------------------------
            */
            document.querySelector('.wishlist-action-primary')?.addEventListener('click', function () {
                const selectedItems = document.querySelectorAll('.wishlist-checkbox:checked');

                if (selectedItems.length === 0) {
                    showToast('info', 'Info', 'Please select at least one item to move to cart.');
                    return;
                }

                const btn = this;
                btn.disabled = true;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Moving...';

                const productIds = [];
                selectedItems.forEach(cb => {
                    const item = cb.closest('.wishlist-item');
                    const moveBtn = item?.querySelector('.move-cart-btn');
                    if (moveBtn) {
                        const pid = moveBtn.getAttribute('data-product-id');
                        if (pid) productIds.push(pid);
                    }
                });

                if (productIds.length === 0) {
                    showToast('error', 'Error', 'No valid products found.');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="bi bi-cart3"></i> Move All to Cart';
                    return;
                }

                let completed = 0;
                let errors = 0;

                productIds.forEach(productId => {
                    fetch(`/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({})
                    })
                        .then(response => response.json())
                        .then(data => {
                            completed++;
                            if (!data.success) {
                                errors++;
                            }

                            if (completed === productIds.length) {
                                if (errors === 0) {
                                    showToast('success', 'Success', 'All selected items moved to cart successfully!');
                                    setTimeout(() => {
                                        window.location.href = "{{ route('checkout') }}";
                                    }, 1000);
                                } else {
                                    showToast('error', 'Error', `${errors} item(s) failed to move to cart.`);
                                    btn.disabled = false;
                                    btn.innerHTML = '<i class="bi bi-cart3"></i> Move All to Cart';
                                }
                            }
                        })
                        .catch(error => {
                            completed++;
                            errors++;
                            console.error('Error moving item:', error);
                            if (completed === productIds.length) {
                                showToast('error', 'Error', 'Some items failed to move to cart.');
                                btn.disabled = false;
                                btn.innerHTML = '<i class="bi bi-cart3"></i> Move All to Cart';
                            }
                        });
                });
            });

            /*
            |--------------------------------------------------------------------------
            | SHARE WISHLIST
            |--------------------------------------------------------------------------
            */
            document.querySelector('.wishlist-action-outline')?.addEventListener('click', function () {
                const url = window.location.href;

                if (navigator.share) {
                    navigator.share({
                        title: 'My Wishlist',
                        text: 'Check out my wishlist on ShopHub!',
                        url: url
                    }).catch(() => { });
                } else {
                    navigator.clipboard.writeText(url)
                        .then(() => {
                            showToast('success', 'Link Copied', 'Wishlist link copied to clipboard!');
                        })
                        .catch(() => {
                            const textArea = document.createElement('textarea');
                            textArea.value = url;
                            document.body.appendChild(textArea);
                            textArea.select();
                            document.execCommand('copy');
                            document.body.removeChild(textArea);
                            showToast('success', 'Link Copied', 'Wishlist link copied to clipboard!');
                        });
                }
            });

            /*
            |--------------------------------------------------------------------------
            | RECOMMENDATION HEART BUTTON
            |--------------------------------------------------------------------------
            */
            document.querySelectorAll('.recommendation-heart').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const icon = this.querySelector('i');

                    if (icon.classList.contains('bi-heart')) {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                        this.style.color = '#ef3340';
                        showToast('success', 'Added to Wishlist', 'Product added to your wishlist!');
                    } else {
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');
                        this.style.color = '#475569';
                        showToast('info', 'Removed', 'Product removed from wishlist.');
                    }
                });
            });

            /*
            |--------------------------------------------------------------------------
            | PRODUCT DETAILS MODAL
            |--------------------------------------------------------------------------
            */
            const modalElement = document.getElementById('productDetailsModal');

            // Only initialize if modal exists
            if (modalElement) {
                const productModal = new bootstrap.Modal(modalElement);
                const detailsUrl = "{{ url('/customer/product-details') }}";

                document.addEventListener('click', function (e) {
                    const card = e.target.closest('.product-details-trigger');

                    if (!card) return;

                    // Don't open modal when clicking buttons/forms/links/checkboxes
                    if (
                        e.target.closest('button') ||
                        e.target.closest('form') ||
                        e.target.closest('a') ||
                        e.target.closest('.wishlist-checkbox')
                    ) {
                        return;
                    }

                    const productId = card.dataset.productId;

                    if (!productId) return;

                    // Show loader, hide content
                    const loader = document.getElementById('productModalLoader');
                    const content = document.getElementById('productModalContent');
                    if (loader) loader.style.display = 'flex';
                    if (content) content.style.display = 'none';

                    productModal.show();

                    fetch(detailsUrl + '/' + productId, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                        .then(async response => {
                            const data = await response.json();
                            if (!response.ok) {
                                throw new Error(data.message || 'Failed to load product details');
                            }
                            return data;
                        })
                        .then(data => {
                            if (!data.success || !data.product) {
                                throw new Error('Product details not found');
                            }

                            const product = data.product;

                            // Set image
                            const img = document.getElementById('modalProductImage');
                            if (img) {
                                img.src = product.image || '{{ asset('images/placeholder.png') }}';
                                img.alt = product.name;
                            }

                            // Set category
                            const category = document.getElementById('modalProductCategory');
                            if (category) category.textContent = product.category || 'Product';

                            const categoryInfo = document.getElementById('modalProductCategoryInfo');
                            if (categoryInfo) categoryInfo.textContent = product.category || 'Product';

                            // Set name
                            const name = document.getElementById('modalProductName');
                            if (name) name.textContent = product.name;

                            // Set price
                            const price = document.getElementById('modalProductPrice');
                            if (price) price.textContent = product.formatted_price || '₹' + product.price;

                            // Set description
                            const desc = document.getElementById('modalProductDescription');
                            if (desc) desc.innerHTML = product.description || 'No description available.';

                            // Set stock
                            const stock = document.getElementById('modalProductStock');
                            if (stock) {
                                if (product.is_out_of_stock) {
                                    stock.textContent = 'Out of Stock';
                                    stock.style.color = '#dc2626';
                                } else {
                                    stock.textContent = product.stock !== null ? 'In Stock' : 'In Stock';
                                    stock.style.color = '#16a34a';
                                }
                            }

                            // Set review count
                            const reviewCount = document.getElementById('modalReviewCount');
                            if (reviewCount) {
                                reviewCount.textContent = `(${product.reviews_count || 0} Reviews)`;
                            }

                            // Set action buttons
                            const actionContainer = document.getElementById('modalProductAction');
                            if (actionContainer) {
                                // FUTURED PRODUCT → NOTIFY ME
                                if (product.is_futured) {
                                    actionContainer.innerHTML = `
                                        <button type="button"
                                                class="product-modal-notify notify-me-btn"
                                                data-product-id="${product.id}">
                                            <i class="bi bi-bell me-2"></i>
                                            Notify Me
                                        </button>
                                    `;
                                }
                                // OUT OF STOCK
                                else if (product.is_out_of_stock) {
                                    actionContainer.innerHTML = `
                                        <button type="button"
                                                class="product-modal-add-cart"
                                                disabled>
                                            <i class="bi bi-x-circle me-2"></i>
                                            Out of Stock
                                        </button>
                                    `;
                                }
                                // ADD TO CART
                                else {
                                    actionContainer.innerHTML = `
                                        <form action="{{ url('/cart/add') }}/${product.id}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="product-modal-add-cart">
                                                <i class="bi bi-cart3 me-2"></i>
                                                Add to Cart
                                            </button>
                                        </form>
                                    `;
                                }
                            }

                            // Show content, hide loader
                            if (loader) loader.style.display = 'none';
                            if (content) content.style.display = 'block';

                        })
                        .catch(error => {
                            console.error('Product Details Error:', error);
                            productModal.hide();
                            if (typeof showToast === 'function') {
                                showToast('error', 'Error', error.message || 'Failed to load product details.');
                            }
                        });
                });
            }
        });

        /*
        |--------------------------------------------------------------------------
        | UTILITY FUNCTIONS
        |--------------------------------------------------------------------------
        */
        function updateWishlistCounts(count) {
            const headerBadge = document.getElementById('headerWishlistCount');
            const sidebarBadge = document.getElementById('sidebarWishlistCount');
            const countDisplay = document.getElementById('wishlistCountDisplay');

            if (headerBadge) {
                headerBadge.textContent = count;
                if (count > 0) {
                    headerBadge.style.display = 'inline';
                } else {
                    headerBadge.style.display = 'none';
                }
            }

            if (sidebarBadge) {
                sidebarBadge.textContent = count;
                if (count > 0) {
                    sidebarBadge.style.display = 'inline';
                } else {
                    sidebarBadge.style.display = 'none';
                }
            }

            if (countDisplay) {
                countDisplay.textContent = count + ' items';
            }
        }

        function restoreRemoveButton(button) {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-trash3"></i>';
        }

        function restoreCartButton(button) {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-cart3"></i> Move to Cart';
        }

        /*
        |--------------------------------------------------------------------------
        | TOAST NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        function showToast(type, title, message) {
            let container = document.getElementById('toastContainer');

            if (!container) {
                container = document.createElement('div');
                container.className = 'toast-container';
                container.id = 'toastContainer';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;

            const icons = {
                success: 'bi bi-check-circle-fill',
                error: 'bi bi-x-circle-fill',
                info: 'bi bi-info-circle-fill',
                warning: 'bi bi-exclamation-triangle-fill'
            };

            const colors = {
                success: '#22c55e',
                error: '#ef4444',
                info: '#3b82f6',
                warning: '#f59e0b'
            };

            toast.innerHTML = `
                        <i class="${icons[type] || icons.info}" style="color: ${colors[type] || colors.info}; font-size: 20px;"></i>
                        <div style="flex: 1;">
                            <strong style="display: block; margin-bottom: 2px;">${title}</strong>
                            <div style="font-size: 13px; color: #64748b;">${message}</div>
                        </div>
                        <button class="close-toast" style="background: none; border: 0; color: #94a3b8; font-size: 20px; cursor: pointer; padding: 0 0 0 10px;">&times;</button>
                    `;

            container.appendChild(toast);

            const timeoutId = setTimeout(() => closeToast(toast), 4000);

            toast.querySelector('.close-toast').addEventListener('click', function () {
                clearTimeout(timeoutId);
                closeToast(toast);
            });
        }

        function closeToast(toast) {
            toast.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 300);
        }

        /*
        |--------------------------------------------------------------------------
        | TOAST STYLES
        |--------------------------------------------------------------------------
        */
        const styleSheet = document.createElement("style");
        styleSheet.textContent = `
                    .toast-container {
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        z-index: 99999;
                        max-width: 400px;
                        width: 100%;
                    }

                    .toast {
                        background: #fff;
                        border-radius: 8px;
                        padding: 15px 20px;
                        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
                        margin-bottom: 10px;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        animation: slideIn 0.3s ease;
                        border-left: 4px solid #ccc;
                    }

                    .toast-success {
                        border-left-color: #22c55e;
                    }

                    .toast-error {
                        border-left-color: #ef4444;
                    }

                    .toast-info {
                        border-left-color: #3b82f6;
                    }

                    .toast-warning {
                        border-left-color: #f59e0b;
                    }

                    @keyframes slideIn {
                        from {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }

                    @keyframes slideOut {
                        from {
                            transform: translateX(0);
                            opacity: 1;
                        }
                        to {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                    }

                    @media (max-width: 576px) {
                        .toast-container {
                            top: 10px;
                            right: 10px;
                            left: 10px;
                            max-width: none;
                        }

                        .toast {
                            padding: 12px 15px;
                            font-size: 14px;
                        }
                    }
                `;
        document.head.appendChild(styleSheet);

        console.log('Wishlist script loaded successfully!');
    </script>
@endsection
