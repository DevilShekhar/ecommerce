@extends('frontend.layouts.customer-layout')

@section('title', 'My Wishlist - ShopEase')

@section('styles')
    <style>
        .wishlist-page {
            padding: 10px 0 30px;
        }

        /* Page Header */
        .wishlist-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .wishlist-title-area {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .wishlist-title-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #1d2b44;
        }

        .wishlist-title-area h2 {
            font-size: 25px;
            font-weight: 700;
            color: #1d2b44;
            margin: 0 0 5px;
        }

        .wishlist-title-area p {
            margin: 0;
            color: #64748b;
            font-size: 15px;
        }

        .wishlist-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .wishlist-action-btn {
            min-height: 44px;
            padding: 0 20px;
            border: 1px solid #dbe2ea;
            border-radius: 6px;
            background: #fff;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: all .25s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .wishlist-action-btn:hover {
            border-color: #1d3557;
            color: #1d3557;
            background: #f8fafc;
        }

        .wishlist-action-btn.primary {
            background: #142b4a;
            border-color: #142b4a;
            color: #fff;
            min-width: 145px;
        }

        .wishlist-action-btn.primary:hover {
            background: #0d2039;
            border-color: #0d2039;
            color: #fff;
        }


        /* ==========================================
               WISHLIST PRODUCT GRID
            ========================================== */

        .wishlist-products-row {
            margin-bottom: 28px;
        }

        .wishlist-product-card {
            background: #fff;
            border: 1px solid #e9edf2;
            border-radius: 14px;
            padding: 20px;
            height: auto !important;
            min-height: 290px;
            display: flex;
            gap: 24px;
            transition: all .25s ease;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
        }

        .wishlist-product-card:hover {
            box-shadow: 0 12px 30px rgba(15, 23, 42, .09);
            transform: translateY(-3px);
        }

        /* Product Image */
        .wishlist-product-image {
            width: 220px;
            min-width: 220px;
            height: 250px;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            background: #f8fafc;
        }

        .wishlist-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .wishlist-no-image {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 50px;
        }

        .heart-display {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1d2b44;
            font-size: 21px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .10);
            cursor: pointer;
            transition: all .2s ease;
            z-index: 3;
        }

        .heart-display:hover {
            color: #e11d48;
            transform: scale(1.06);
        }


        /* Product Details */
        .wishlist-product-details {
            flex: 1;
            min-width: 0;
            padding: 2px 0;
            display: flex;
            flex-direction: column;
        }

        .product-category {
            color: #b8862d;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .wishlist-product-name {
            color: #1d2b44;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .wishlist-rating {
            display: flex;
            align-items: center;
            gap: 3px;
            margin-bottom: 14px;
        }

        .wishlist-rating .stars {
            color: #d69e2e;
            font-size: 14px;
        }

        .wishlist-rating .review-count {
            margin-left: 7px;
            color: #64748b;
            font-size: 13px;
        }

        .wishlist-price {
            color: #1d2b44;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .wishlist-features {
            list-style: none;
            padding: 0;
            margin: 0 0 18px;
        }

        .wishlist-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #526174;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .wishlist-features li i {
            color: #526174;
            width: 16px;
        }

        .wishlist-product-buttons {
            display: flex;
            gap: 12px;
            margin-top: auto;
        }

        .btn-remove-wishlist,
        .btn-wishlist-cart {
            height: 44px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all .25s ease;
        }

        .btn-remove-wishlist {
            background: #fff;
            border: 1px solid #d8dee7;
            color: #334155;
            min-width: 140px;
        }

        .btn-remove-wishlist:hover {
            background: #fff5f5;
            color: #dc2626;
            border-color: #fecaca;
        }

        .btn-wishlist-cart {
            flex: 1;
            background: #142b4a;
            border: 1px solid #142b4a;
            color: #fff;
        }

        .btn-wishlist-cart:hover {
            background: #0d2039;
            border-color: #0d2039;
            color: #fff;
        }


        /* ==========================================
               RECOMMENDED SECTION
            ========================================== */

        .recommended-section {
            background: #fff;
            border: 1px solid #e9edf2;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
        }

        .recommended-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .recommended-title {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .recommended-title .recommend-icon {
            color: #c69231;
            font-size: 24px;
            line-height: 1;
        }

        .recommended-title h4 {
            color: #1d2b44;
            font-size: 19px;
            font-weight: 700;
            margin: 0 0 3px;
        }

        .recommended-title p {
            margin: 0;
            color: #64748b;
            font-size: 12px;
        }

        .recommended-view-all {
            color: #1d2b44;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .recommended-view-all:hover {
            color: #b8862d;
        }


        /* Recommended Product Card */
        .rec-product-card {
            background: #fff;
            border: 1px solid #e8edf3;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
            transition: all .25s ease;
        }

        .rec-product-card:hover {
            box-shadow: 0 10px 24px rgba(15, 23, 42, .10);
            transform: translateY(-4px);
        }

        .rec-product-img {
            height: 190px;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .rec-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .rec-heart {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .95);
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            transition: .2s ease;
        }

        .rec-heart:hover,
        .rec-heart.active {
            color: #e11d48;
        }

        .rec-product-info {
            padding: 14px;
        }

        .rec-category {
            color: #b8862d;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .rec-product-info h6 {
            color: #1d2b44;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 7px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rec-price {
            color: #1d2b44;
            font-size: 16px;
            font-weight: 700;
        }

        .rec-rating {
            color: #d69e2e;
            font-size: 12px;
            margin-top: 8px;
        }

        .rec-rating span {
            color: #64748b;
            margin-left: 5px;
        }

        .rec-add-cart {
            width: 100%;
            margin-top: 14px;
            height: 40px;
            background: #fff;
            color: #1d2b44;
            border: 1px solid #d8dee7;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            transition: all .25s ease;
        }

        .rec-add-cart:hover {
            background: #142b4a;
            border-color: #142b4a;
            color: #fff;
        }


        /* Empty State */
        .empty-products {
            text-align: center;
            padding: 70px 20px;
            background: #fff;
            border: 1px solid #e9edf2;
            border-radius: 14px;
            margin-bottom: 10px;
        }

        .empty-products i {
            font-size: 60px;
            color: #cbd5e1;
            display: block;
            margin-bottom: 15px;
        }

        .empty-products h4 {
            color: #1d2b44;
            font-weight: 700;
        }

        .empty-products p {
            color: #64748b;
        }


        /* Responsive */
        @media (max-width: 1199px) {
            .wishlist-product-image {
                width: 180px;
                min-width: 180px;
                height: 220px;
            }
        }

        @media (max-width: 991px) {
            .wishlist-top {
                flex-direction: column;
            }

            .wishlist-actions {
                width: 100%;
            }
        }

        @media (max-width: 767px) {
            .wishlist-product-card {
                flex-direction: column;
            }

            .wishlist-product-image {
                width: 100%;
                min-width: 100%;
                height: 260px;
            }

            .wishlist-actions {
                gap: 8px;
            }

            .wishlist-action-btn {
                padding: 0 14px;
            }

            .wishlist-product-buttons {
                flex-direction: column;
            }

            .btn-remove-wishlist {
                width: 100%;
            }

            .rec-product-img {
                height: 210px;
            }
        }

        @media (max-width: 575px) {
            .wishlist-title-area h2 {
                font-size: 21px;
            }

            .wishlist-actions {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .wishlist-action-btn.primary {
                grid-column: span 2;
            }

            .recommended-header {
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
@endsection

@section('content')

    <div class="wishlist-page">

        <!-- ======================================
                 WISHLIST HEADER
            ======================================= -->
        <div class="wishlist-top">

            <div class="wishlist-title-area">
                <div class="wishlist-title-icon">
                    <i class="bi bi-heart"></i>
                </div>

                <div>
                    <h2>My Wishlist</h2>
                    <p>{{ $wishlistCount ?? 0 }} products saved for later</p>
                </div>
            </div>

            <div class="wishlist-actions">

                <button type="button" class="wishlist-action-btn">
                    <i class="bi bi-share"></i>
                    Share Wishlist
                </button>

                <button type="button" class="wishlist-action-btn" onclick="clearWishlist()">
                    <i class="bi bi-trash"></i>
                    Clear Wishlist
                </button>

                <button type="button" class="wishlist-action-btn primary" onclick="addAllToCart()">
                    <i class="bi bi-cart3"></i>
                    Add All to Cart
                </button>

            </div>
        </div>


        <!-- ======================================
                 WISHLIST PRODUCTS
            ======================================= -->
        @if(isset($wishlistProducts) && $wishlistProducts->count() > 0)

            <div class="row g-4 wishlist-products-row">

                @foreach($wishlistProducts as $wishlist)

                    @php
                        $product = $wishlist->product;

                        $images = $product && $product->image
                            ? array_map('trim', explode(',', $product->image))
                            : [];

                        $firstImage = $images[0] ?? null;

                        if ($firstImage) {
                            $firstImage = preg_replace('#^storage/#', '', $firstImage);
                            $imgUrl = asset($firstImage);
                        } else {
                            $imgUrl = null;
                        }
                    @endphp

                    @if($product)

                        <div class="col-xl-6">

                            <div class="wishlist-product-card">

                                <!-- Image -->
                                <div class="wishlist-product-image">

                                    @if($imgUrl)
                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                            onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                    @else
                                        <div class="wishlist-no-image">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif

                                    <button class="heart-display" data-product-id="{{ $product->id }}" onclick="toggleWishlist(this)">
                                        <i class="bi bi-heart-fill"></i>
                                    </button>

                                </div>


                                <!-- Details -->
                                <div class="wishlist-product-details">

                                    <div class="product-category">
                                        {{ $product->category->name ?? 'Jewellery' }}
                                    </div>

                                    <div class="wishlist-product-name">
                                        {{ $product->name }}
                                    </div>

                                    <div class="wishlist-rating">
                                        <div class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </div>

                                        <span class="review-count">(128)</span>
                                    </div>

                                    <div class="wishlist-price">
                                        ₹{{ number_format($product->price, 0) }}
                                    </div>

                                    <ul class="wishlist-features">
                                        <li>
                                            <i class="bi bi-gem"></i>
                                            Premium Quality Product
                                        </li>

                                        <li>
                                            <i class="bi bi-shield-check"></i>
                                            Quality Guaranteed
                                        </li>

                                        <li>
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            Easy 7-Day Returns
                                        </li>
                                    </ul>

                                    <div class="wishlist-product-buttons">

                                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                                            @csrf

                                            <button type="submit" class="btn btn-wishlist-cart w-100">
                                                <i class="bi bi-cart3"></i>
                                                Add to Cart
                                            </button>
                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif
                @endforeach

            </div>
        @endif


        <!-- ======================================
                 RECOMMENDED FOR YOU
            ======================================= -->
        <div class="recommended-section">

            <div class="recommended-header">

                <div class="recommended-title">

                    <div class="recommend-icon">
                        <i class="bi bi-stars"></i>
                    </div>

                    <div>
                        <h4>Recommended for You</h4>
                        <p>Handpicked products just for you</p>
                    </div>

                </div>

            </div>


            <div class="row g-4">

                @forelse($recommendedProducts ?? [] as $product)

                    @php
                        $images = $product->image
                            ? array_map('trim', explode(',', $product->image))
                            : [];

                        $firstImage = $images[0] ?? null;

                        if ($firstImage) {
                            $firstImage = preg_replace('#^storage/#', '', $firstImage);
                            $imgUrl = asset($firstImage);
                        } else {
                            $imgUrl = null;
                        }

                        $discount = $product->discount ?? 0;
                        $originalPrice = $product->price ?? 0;
                        $discountedPrice = $originalPrice - ($originalPrice * $discount / 100);
                    @endphp


                    <div class="col-xl col-lg-3 col-md-4 col-sm-6">

                        <div class="rec-product-card">

                            <div class="rec-product-img">

                                @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                        onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                @else
                                    <div class="wishlist-no-image">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif

                                <button class="rec-heart wishlist-btn" data-product-id="{{ $product->id }}"
                                    onclick="toggleWishlist(this)">
                                    <i class="bi bi-heart"></i>
                                </button>

                            </div>


                            <div class="rec-product-info">

                                <div class="rec-category">
                                    {{ $product->category->name ?? 'Product' }}
                                </div>

                                <h6 title="{{ $product->name }}">
                                    {{ Str::limit($product->name, 25) }}
                                </h6>

                                <div class="rec-price">
                                    ₹{{ number_format($discountedPrice, 0) }}
                                </div>

                                <div class="rec-rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>

                                    <span>(96)</span>
                                </div>

                                <form class="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf

                                    <button type="submit" class="rec-add-cart">
                                        <i class="bi bi-cart3 me-1"></i>
                                        Add to Cart
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12 text-center py-4 text-muted">
                        No recommended products available.
                    </div>

                @endforelse

            </div>

        </div>

    </div>

@endsection
