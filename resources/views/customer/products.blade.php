@extends('frontend.layouts.customer-layout')

@section('title', 'My Wishlist - ShopEase')

@section('styles')

<style>
/* =========================================================
   SHOPEASE WISHLIST - BLUE LIGHT THEME
========================================================= */

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

/* PAGE */
.wishlist-page {
    min-height: 100vh;
    background: var(--s-bg);
    padding: 24px 0 60px;
}

/* =========================================================
   TOP TITLE
========================================================= */

.wishlist-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 22px;
}

.wishlist-heading-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.wishlist-heading-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: var(--s-primary-light);
    color: var(--s-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
}

.wishlist-heading h1 {
    margin: 0;
    font-size: 25px;
    font-weight: 700;
    color: var(--s-text);
    letter-spacing: -0.3px;
}

.wishlist-heading p {
    margin: 3px 0 0;
    color: var(--s-muted);
    font-size: 13px;
}

.wishlist-heading-actions {
    display: flex;
    gap: 8px;
}

.wishlist-top-btn {
    border: 1px solid var(--s-border);
    background: #fff;
    color: #4b5563;
    border-radius: 8px;
    padding: 9px 15px;
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    cursor: pointer;
    transition: .25s ease;
}

.wishlist-top-btn:hover {
    border-color: var(--s-primary);
    color: var(--s-primary);
    background: var(--s-primary-bg);
}

.wishlist-top-btn.danger:hover {
    border-color: var(--s-red);
    color: var(--s-red);
    background: #fef2f2;
}

/* =========================================================
   SERVICE STRIP
========================================================= */

.wishlist-services {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 22px;
}

.wishlist-service {
    background: #fff;
    border: 1px solid var(--s-border);
    border-radius: 10px;
    padding: 15px 16px;
    display: flex;
    align-items: center;
    gap: 12px;
    min-height: 76px;
    transition: .25s ease;
}

.wishlist-service:hover {
    transform: translateY(-2px);
    border-color: var(--s-primary-light);
    box-shadow: 0 8px 25px rgba(30, 30, 30, .05);
}

.service-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 10px;
    background: var(--s-primary-light);
    color: var(--s-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.service-content strong {
    display: block;
    font-size: 12px;
    color: #252a32;
    margin-bottom: 3px;
}

.service-content span {
    display: block;
    color: #9095a0;
    font-size: 10px;
}

/* =========================================================
   SECTION CARD
========================================================= */

.wishlist-section {
    background: #fff;
    border: 1px solid var(--s-border);
    border-radius: 12px;
    padding: 18px;
    margin-bottom: 22px;
}

.wishlist-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 17px;
}

.wishlist-section-title {
    display: flex;
    align-items: center;
    gap: 9px;
}

.wishlist-section-title h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #242933;
}

.wishlist-section-title span {
    color: #9298a3;
    font-size: 11px;
}

.wishlist-view-all {
    text-decoration: none;
    color: var(--s-primary);
    font-size: 11px;
    font-weight: 600;
}

.wishlist-view-all:hover {
    color: var(--s-primary-dark);
}

/* =========================================================
   WISHLIST PRODUCT GRID
========================================================= */

.wishlist-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
}

/* =========================================================
   PRODUCT CARD
========================================================= */

.jewel-product-card {
    background: #fff;
    border: 1px solid var(--s-border);
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    transition: all .28s ease;
    cursor: pointer;
}

.jewel-product-card:hover {
    transform: translateY(-4px);
    border-color: var(--s-primary-light);
    box-shadow: 0 12px 30px rgba(59, 130, 246, .08);
}

/* IMAGE */

.jewel-product-image {
    height: 220px;
    background: #f8fafc;
    position: relative;
    overflow: hidden;
}

.jewel-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .45s ease;
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
    color: #c9c7c0;
    font-size: 40px;
}

/* BADGE */

.jewel-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 5;
    padding: 4px 8px;
    border-radius: 5px;
    color: #fff;
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .25px;
}

.jewel-badge.offer {
    background: var(--s-red);
}

.jewel-badge.new {
    background: var(--s-green);
}

.jewel-badge.featured {
    background: var(--s-gold);
}

/* HEART */

.jewel-heart {
    position: absolute;
    top: 9px;
    right: 9px;
    z-index: 8;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 1px solid var(--s-border);
    background: rgba(255,255,255,.94);
    color: var(--s-red);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .2s ease;
}

.jewel-heart:hover {
    transform: scale(1.08);
    background: #fff;
}

.jewel-heart i {
    font-size: 14px;
}

/* STOCK */

.jewel-stock {
    position: absolute;
    bottom: 9px;
    right: 9px;
    padding: 4px 8px;
    border-radius: 5px;
    font-size: 9px;
    font-weight: 700;
    z-index: 5;
}

.jewel-stock.in-stock {
    background: #dcfce7;
    color: #188754;
}

.jewel-stock.out-stock {
    background: #fee2e2;
    color: #d83c3c;
}

/* PRODUCT INFO */

.jewel-product-info {
    padding: 13px 13px 14px;
}

.jewel-category {
    color: var(--s-primary);
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .7px;
    margin-bottom: 5px;
}

.jewel-product-name {
    font-size: 13px;
    color: #242933;
    font-weight: 600;
    margin-bottom: 7px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.jewel-rating {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 8px;
}

.jewel-rating i {
    color: var(--s-gold);
    font-size: 10px;
}

.jewel-rating span {
    color: #9398a2;
    font-size: 10px;
}

/* PRICE */

.jewel-price-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 11px;
}

.jewel-price {
    color: #242933;
    font-size: 15px;
    font-weight: 750;
}

.jewel-old-price {
    color: #a2a5aa;
    text-decoration: line-through;
    font-size: 10px;
}

.jewel-discount {
    color: var(--s-red);
    font-size: 9px;
    font-weight: 700;
}

/* ADD CART */

.jewel-cart-btn {
    width: 100%;
    border: 1px solid var(--s-border);
    background: #fff;
    color: #242933;
    border-radius: 7px;
    padding: 8px 10px;
    font-size: 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: .25s ease;
}

.jewel-cart-btn:hover:not(:disabled) {
    background: var(--s-primary);
    border-color: var(--s-primary);
    color: #fff;
}

.jewel-cart-btn:disabled {
    background: #f2f2f1;
    color: #999;
    border-color: #e5e5e2;
    cursor: not-allowed;
}

.jewel-cart-btn.notify {
    background: #fef3c7;
    border-color: #fcd34d;
    color: #92400e;
}

/* =========================================================
   EMPTY WISHLIST
========================================================= */

.wishlist-empty {
    background: #fff;
    border: 1px solid var(--s-border);
    border-radius: 12px;
    padding: 65px 20px;
    text-align: center;
}

.empty-heart {
    width: 75px;
    height: 75px;
    border-radius: 50%;
    margin: 0 auto 17px;
    background: var(--s-primary-light);
    color: var(--s-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
}

.wishlist-empty h3 {
    margin: 0 0 7px;
    font-size: 21px;
    color: #242933;
}

.wishlist-empty p {
    color: #9297a1;
    font-size: 13px;
    margin-bottom: 19px;
}

.shop-now-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--s-primary);
    color: #fff;
    text-decoration: none;
    border-radius: 7px;
    padding: 11px 20px;
    font-size: 12px;
    font-weight: 700;
    transition: .25s ease;
}

.shop-now-btn:hover {
    color: #fff;
    background: var(--s-primary-dark);
    transform: translateY(-2px);
}

/* =========================================================
   RECOMMENDED
========================================================= */

.recommended-section {
    margin-top: 22px;
}

.recommended-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 14px;
}

/* =========================================================
   TOAST
========================================================= */

.jewel-toast-container {
    position: fixed;
    right: 20px;
    top: 80px;
    width: 350px;
    max-width: calc(100vw - 30px);
    z-index: 99999;
}

.jewel-toast {
    background: #fff;
    border-radius: 10px;
    margin-bottom: 10px;
    box-shadow: 0 15px 45px rgba(0,0,0,.13);
    border-left: 4px solid var(--s-primary);
    transform: translateX(120%);
    opacity: 0;
    transition: .35s ease;
}

.jewel-toast.show {
    transform: translateX(0);
    opacity: 1;
}

.jewel-toast-content {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 13px 14px;
}

.jewel-toast-icon {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--s-primary-light);
    color: var(--s-primary);
    display: flex;
    align-items: center;
    justify-content: center;
}

.jewel-toast-body {
    flex: 1;
}

.jewel-toast-title {
    font-size: 12px;
    font-weight: 700;
    color: #252a32;
    margin-bottom: 2px;
}

.jewel-toast-message {
    font-size: 11px;
    color: #7c818b;
    line-height: 1.45;
}

.jewel-toast-close {
    border: 0;
    background: transparent;
    color: #999;
    cursor: pointer;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width: 1200px) {
    .wishlist-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .recommended-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media(max-width: 992px) {
    .wishlist-services {
        grid-template-columns: repeat(2, 1fr);
    }

    .wishlist-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .recommended-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media(max-width: 768px) {
    .wishlist-page {
        padding: 16px 0 40px;
    }

    .wishlist-heading {
        align-items: flex-start;
        flex-direction: column;
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
    }

    .wishlist-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .recommended-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .jewel-product-image {
        height: 190px;
    }
}

@media(max-width: 576px) {
    .wishlist-heading h1 {
        font-size: 20px;
    }

    .wishlist-heading-icon {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }

    .wishlist-services {
        grid-template-columns: 1fr;
    }

    .wishlist-section {
        padding: 12px;
    }

    .wishlist-grid {
        gap: 9px;
    }

    .jewel-product-image {
        height: 155px;
    }

    .jewel-product-info {
        padding: 10px;
    }

    .jewel-product-name {
        font-size: 12px;
    }

    .jewel-price {
        font-size: 13px;
    }

    .jewel-cart-btn {
        font-size: 9px;
        padding: 7px;
    }

    .recommended-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

@endsection


@section('content')

<div class="wishlist-page">

    <div class="container">

        {{-- =====================================================
             WISHLIST HEADER
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

                <button type="button"
                        class="wishlist-top-btn"
                        onclick="shareWishlist()">
                    <i class="bi bi-share"></i>
                    Share Wishlist
                </button>

                @if(isset($wishlistProducts) && $wishlistProducts->count() > 0)
                    <button type="button"
                            class="wishlist-top-btn danger"
                            onclick="clearWishlist()">
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
                    <span>100% safe & secure checkout</span>
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
                    <span>On orders above ₹999</span>
                </div>

            </div>

        </div>


        {{-- =====================================================
             SAVED PRODUCTS
        ====================================================== --}}

        @if(isset($wishlistProducts) && $wishlistProducts->count() > 0)

            <div class="wishlist-section">

                <div class="wishlist-section-header">

                    <div class="wishlist-section-title">

                        <h3>Saved Items</h3>

                        <span>
                            {{ $wishlistProducts->count() }}
                            {{ $wishlistProducts->count() == 1 ? 'product' : 'products' }}
                        </span>

                    </div>

                    <a href="{{ route('customer.products') }}"
                       class="wishlist-view-all">
                        Continue Shopping
                        <i class="bi bi-arrow-right"></i>
                    </a>

                </div>


                <div class="wishlist-grid">

                    @foreach($wishlistProducts as $wishlist)

                        @php

                            $product = $wishlist->product;

                            if (!$product) {
                                continue;
                            }

                            /* IMAGE */
                            $images = $product->image
                                ? array_map('trim', explode(',', $product->image))
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


                            /* STATUS */
                            $isFutured =
                                isset($product->is_futured) &&
                                $product->is_futured == 1;

                            $isNew =
                                isset($product->is_futured) &&
                                $product->is_futured == 2;

                            $isOutOfStock =
                                $product->stock !== null &&
                                $product->stock <= 0;


                            /* OFFER */
                            $activeOffer = $product->active_offer ?? null;

                            $originalPrice = $product->price ?? 0;

                            $discountedPrice = $originalPrice;

                            if ($activeOffer) {

                                if ($activeOffer->discount_type === 'percentage') {

                                    $discountedPrice =
                                        $originalPrice -
                                        (
                                            $originalPrice *
                                            $activeOffer->discount_value /
                                            100
                                        );

                                } else {

                                    $discountedPrice =
                                        max(
                                            0,
                                            $originalPrice -
                                            $activeOffer->discount_value
                                        );
                                }
                            }


                            $discountPercent = 0;

                            if (
                                $originalPrice > 0 &&
                                $discountedPrice < $originalPrice
                            ) {

                                $discountPercent = round(
                                    (
                                        ($originalPrice - $discountedPrice)
                                        / $originalPrice
                                    ) * 100
                                );
                            }

                        @endphp


                        <div>

                            <div class="jewel-product-card product-details-trigger"
                                 data-product-id="{{ $product->id }}">


                                {{-- IMAGE --}}

                                <div class="jewel-product-image">

                                    @if($imgUrl)

                                        <img
                                            src="{{ $imgUrl }}"
                                            alt="{{ $product->name }}"
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

                                    <button
                                        type="button"
                                        class="jewel-heart heart-display"
                                        data-product-id="{{ $product->id }}"
                                        onclick="
                                            event.preventDefault();
                                            event.stopPropagation();
                                            toggleWishlist(this)
                                        ">

                                        <i class="bi bi-heart-fill"></i>

                                    </button>


                                    {{-- STOCK --}}

                                    @if($product->stock !== null)

                                        <span class="jewel-stock
                                            {{ $isOutOfStock ? 'out-stock' : 'in-stock' }}">

                                            @if($isOutOfStock)
                                                Out of Stock
                                            @else
                                                In Stock
                                            @endif

                                        </span>

                                    @endif

                                </div>


                                {{-- PRODUCT INFORMATION --}}

                                <div class="jewel-product-info">

                                    <div class="jewel-category">
                                        {{ $product->category->name ?? 'Product' }}
                                    </div>


                                    <div class="jewel-product-name"
                                         title="{{ $product->name }}">

                                        {{ Str::limit($product->name, 28) }}

                                    </div>


                                    {{-- RATING --}}

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


                                    {{-- PRICE --}}

                                    <div class="jewel-price-row">

                                        @if($activeOffer)

                                            <span class="jewel-price">
                                                ₹{{ number_format($discountedPrice, 0) }}
                                            </span>

                                            <span class="jewel-old-price">
                                                ₹{{ number_format($originalPrice, 0) }}
                                            </span>

                                            @if($discountPercent > 0)

                                                <span class="jewel-discount">
                                                    {{ $discountPercent }}% OFF
                                                </span>

                                            @endif

                                        @else

                                            <span class="jewel-price">
                                                ₹{{ number_format($originalPrice, 0) }}
                                            </span>

                                        @endif

                                    </div>


                                    {{-- ACTION --}}

                                    @if($isFutured)

                                        <button
                                            type="button"
                                            class="jewel-cart-btn notify notify-me-btn"
                                            data-product-id="{{ $product->id }}"
                                            onclick="
                                                event.preventDefault();
                                                event.stopPropagation();
                                            ">

                                            <i class="bi bi-bell"></i>
                                            Notify Me

                                        </button>

                                    @elseif($isOutOfStock)

                                        <button
                                            type="button"
                                            class="jewel-cart-btn"
                                            disabled>

                                            <i class="bi bi-x-circle"></i>
                                            Out of Stock

                                        </button>

                                    @else

                                        <form
                                            action="{{ route('cart.add', $product->id) }}"
                                            method="POST"
                                            onclick="event.stopPropagation();">

                                            @csrf

                                            <button
                                                type="submit"
                                                class="jewel-cart-btn">

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

        @else


            {{-- =================================================
                 EMPTY WISHLIST
            ================================================== --}}

            <div class="wishlist-empty">

                <div class="empty-heart">
                    <i class="bi bi-heart"></i>
                </div>

                <h3>Your Wishlist is Empty</h3>

                <p>
                    Start adding your favourite products to your wishlist!
                </p>

                <a
                    href="{{ route('customer.products') }}"
                    class="shop-now-btn">

                    <i class="bi bi-bag"></i>
                    Start Shopping

                </a>

            </div>

        @endif


        {{-- =====================================================
             RECOMMENDED PRODUCTS
        ====================================================== --}}

        @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)

            <div class="recommended-section">

                <div class="wishlist-section">

                    <div class="wishlist-section-header">

                        <div class="wishlist-section-title">

                            <h3>
                                <i class="bi bi-stars"
                                   style="color:var(--s-primary);"></i>
                                Recommended For You
                            </h3>

                            <span>
                                Handpicked products you'll love
                            </span>

                        </div>

                        <a
                            href="{{ route('customer.products') }}"
                            class="wishlist-view-all">

                            View All
                            <i class="bi bi-arrow-right"></i>

                        </a>

                    </div>


                    <div class="recommended-grid">

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


                                $activeOffer =
                                    $product->active_offer ?? null;

                                $originalPrice =
                                    $product->price ?? 0;

                                $discountedPrice =
                                    $originalPrice;


                                if ($activeOffer) {

                                    if (
                                        $activeOffer->discount_type
                                        === 'percentage'
                                    ) {

                                        $discountedPrice =
                                            $originalPrice -
                                            (
                                                $originalPrice *
                                                $activeOffer->discount_value
                                                / 100
                                            );

                                    } else {

                                        $discountedPrice =
                                            max(
                                                0,
                                                $originalPrice -
                                                $activeOffer->discount_value
                                            );
                                    }
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

                                <div
                                    class="jewel-product-card product-details-trigger"
                                    data-product-id="{{ $product->id }}">


                                    {{-- IMAGE --}}

                                    <div class="jewel-product-image">

                                        @if($imgUrl)

                                            <img
                                                src="{{ $imgUrl }}"
                                                alt="{{ $product->name }}"
                                                onerror="
                                                    this.src='{{ asset('images/placeholder.png') }}'
                                                ">

                                        @else

                                            <div class="jewel-no-image">
                                                <i class="bi bi-image"></i>
                                            </div>

                                        @endif


                                        @if($activeOffer)

                                            <span class="jewel-badge offer">

                                                @if(
                                                    $activeOffer->discount_type
                                                    === 'percentage'
                                                )

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
                                                Featured
                                            </span>

                                        @elseif($isNew)

                                            <span class="jewel-badge new">
                                                New
                                            </span>

                                        @endif


                                        <button
                                            type="button"
                                            class="jewel-heart wishlist-btn"
                                            data-product-id="{{ $product->id }}"
                                            onclick="
                                                event.preventDefault();
                                                event.stopPropagation();
                                                toggleWishlist(this)
                                            ">

                                            <i class="bi bi-heart"></i>

                                        </button>


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

                                        <div
                                            class="jewel-product-name"
                                            title="{{ $product->name }}">

                                            {{ Str::limit(
                                                $product->name,
                                                25
                                            ) }}

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


                                        <div class="jewel-price-row">

                                            @if($activeOffer)

                                                <span class="jewel-price">
                                                    ₹{{ number_format(
                                                        $discountedPrice,
                                                        0
                                                    ) }}
                                                </span>

                                                <span class="jewel-old-price">
                                                    ₹{{ number_format(
                                                        $originalPrice,
                                                        0
                                                    ) }}
                                                </span>

                                            @else

                                                <span class="jewel-price">
                                                    ₹{{ number_format(
                                                        $originalPrice,
                                                        0
                                                    ) }}
                                                </span>

                                            @endif

                                        </div>


                                        @if($isFutured)

                                            <button
                                                type="button"
                                                class="jewel-cart-btn notify notify-me-btn"
                                                data-product-id="{{ $product->id }}">

                                                <i class="bi bi-bell"></i>
                                                Notify Me

                                            </button>

                                        @elseif($isOutOfStock)

                                            <button
                                                type="button"
                                                class="jewel-cart-btn"
                                                disabled>

                                                <i class="bi bi-x-circle"></i>
                                                Out of Stock

                                            </button>

                                        @else

                                            <form
                                                action="{{ route('cart.add', $product->id) }}"
                                                method="POST"
                                                onclick="event.stopPropagation();">

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="jewel-cart-btn">

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

        @endif

    </div>

</div>


{{-- =========================================================
     PRODUCT DETAILS MODAL
========================================================= --}}

<div class="modal fade"
     id="productDetailsModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <button
                type="button"
                class="btn-close position-absolute"
                style="right:20px;top:20px;z-index:10;"
                data-bs-dismiss="modal">
            </button>

            <div class="modal-body p-4">

                <div
                    id="productModalLoader"
                    class="text-center py-5">

                    <div
                        class="spinner-border"
                        style="color:var(--s-primary);">
                    </div>

                </div>


                <div
                    id="productModalContent"
                    style="display:none;">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <div
                                style="
                                    height:430px;
                                    background:#f8fafc;
                                    border-radius:10px;
                                    overflow:hidden;
                                ">

                                <img
                                    id="modalProductImage"
                                    src=""
                                    alt="Product"
                                    style="
                                        width:100%;
                                        height:100%;
                                        object-fit:contain;
                                    ">

                            </div>

                        </div>


                        <div class="col-md-6">

                            <span
                                id="modalProductCategory"
                                style="
                                    color:var(--s-primary);
                                    font-size:11px;
                                    font-weight:700;
                                    text-transform:uppercase;
                                ">
                            </span>

                            <h3
                                id="modalProductName"
                                style="
                                    font-size:25px;
                                    margin:8px 0 12px;
                                    font-weight:700;
                                ">
                            </h3>


                            <div
                                style="
                                    color:var(--s-gold);
                                    margin-bottom:15px;
                                ">

                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>

                                <span
                                    style="
                                        color:#999;
                                        font-size:12px;
                                        margin-left:5px;
                                    ">
                                    4.8 Reviews
                                </span>

                            </div>


                            <div
                                id="modalProductPrice"
                                style="
                                    font-size:26px;
                                    font-weight:800;
                                    margin-bottom:18px;
                                ">
                            </div>


                            <div
                                id="modalProductDescription"
                                style="
                                    color:#6b7280;
                                    font-size:13px;
                                    line-height:1.7;
                                    border-top:1px solid #eee;
                                    border-bottom:1px solid #eee;
                                    padding:15px 0;
                                    margin-bottom:18px;
                                ">
                            </div>


                            <div
                                style="
                                    display:grid;
                                    grid-template-columns:1fr 1fr;
                                    gap:15px;
                                    margin-bottom:20px;
                                ">

                                <div>
                                    <small
                                        style="
                                            color:#999;
                                            display:block;
                                        ">
                                        Availability
                                    </small>

                                    <strong
                                        id="modalProductStock">
                                    </strong>
                                </div>


                                <div>
                                    <small
                                        style="
                                            color:#999;
                                            display:block;
                                        ">
                                        Category
                                    </small>

                                    <strong
                                        id="modalProductCategoryInfo">
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

@endsection