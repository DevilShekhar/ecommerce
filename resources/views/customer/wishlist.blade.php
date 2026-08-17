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
        --red: #ef3340;
    }

    body {
        background: #f8fafc;
        color: var(--text-dark);
    }

    /* =========================
       MAIN WISHLIST
    ========================= */

    .wishlist-page {
        padding: 38px 0 60px;
    }

    .wishlist-wrapper {
        max-width: 1400px;
        margin: auto;
        padding: 0 25px;
    }

    /* Header */

    .wishlist-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        gap: 20px;
    }

    .wishlist-title-area {
        display: flex;
        align-items: flex-start;
        gap: 16px;
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
        flex-shrink: 0;
    }

    .wishlist-title h1 {
        margin: 0;
        font-size: 29px;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .wishlist-title p {
        margin: 4px 0 0;
        color: var(--shop-blue);
        font-size: 14px;
        font-weight: 600;
    }

    .wishlist-actions {
        display: flex;
        gap: 12px;
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
        transition: .2s ease;
    }

    .wishlist-action-outline {
        border: 1px solid #cbd5e1;
        background: white;
        color: #111827;
    }

    .wishlist-action-outline:hover {
        border-color: var(--shop-blue);
        color: var(--shop-blue);
    }

    .wishlist-action-primary {
        border: 1px solid var(--shop-blue);
        background: var(--shop-blue);
        color: #fff;
    }

    .wishlist-action-primary:hover {
        background: var(--shop-blue-dark);
        color: #fff;
    }

    /* =========================
       WISHLIST ITEM
    ========================= */

    .wishlist-list {
        display: flex;
        flex-direction: column;
        gap: 3px;
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
    }

    .wishlist-item:hover {
        box-shadow: 0 7px 22px rgba(15, 23, 42, .08);
        border-color: #e2e8f0;
    }

    .wishlist-checkbox {
        width: 22px;
        height: 22px;
        cursor: pointer;
        accent-color: var(--shop-blue);
    }

    /* Product image */

    .wishlist-product-image {
        height: 95px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wishlist-product-image img {
        width: 145px;
        height: 95px;
        object-fit: contain;
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
        font-size: 35px;
    }

    /* Product information */

    .wishlist-product-info {
        min-width: 0;
    }

    .wishlist-product-name {
        font-size: 16px;
        font-weight: 600;
        margin: 0 0 7px;
        color: #111827;
        line-height: 1.35;
    }

    .wishlist-product-variant {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stock-status {
        color: var(--green);
        font-size: 13px;
        font-weight: 500;
    }

    /* Price */

    .wishlist-price {
        min-width: 150px;
    }

    .current-price {
        font-size: 19px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 7px;
    }

    .old-price {
        font-size: 13px;
        color: #64748b;
        text-decoration: line-through;
        margin-right: 8px;
    }

    .discount-badge {
        display: inline-block;
        background: #fff0f1;
        color: #ef3340;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 9px;
        border-radius: 5px;
    }

    /* Move cart */

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
        width: 100%;
    }

    .move-cart-btn:hover {
        border-color: var(--shop-blue);
        color: var(--shop-blue);
        background: #f8fbff;
    }

    /* Delete */

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
        transition: .2s ease;
    }

    .delete-wishlist-btn {
        color: #334155;
    }

    .delete-wishlist-btn:hover {
        background: #fef2f2;
        color: #ef3340;
    }

    .heart-wishlist-btn {
        color: #ef3340;
        font-size: 21px;
    }

    .heart-wishlist-btn:hover {
        background: #fff1f2;
        transform: scale(1.08);
    }

    /* =========================
       FEATURES
    ========================= */

    .wishlist-features {
        margin-top: 28px;
        border: 1px solid #dce7f7;
        background: #f6f9ff;
        border-radius: 12px;
        padding: 18px 20px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
    }

    .wishlist-feature {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 8px 28px;
        border-right: 1px solid #dbe6f5;
    }

    .wishlist-feature:last-child {
        border-right: 0;
    }

    .feature-icon {
        width: 42px;
        min-width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: var(--shop-blue);
    }

    .feature-text strong {
        display: block;
        font-size: 15px;
        margin-bottom: 4px;
    }

    .feature-text span {
        color: #64748b;
        font-size: 13px;
    }

    /* =========================
       RECOMMENDATION
    ========================= */

    .recommendation-section {
        margin-top: 45px;
    }

    .recommendation-title {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        margin-bottom: 25px;
    }

    .recommendation-title::before,
    .recommendation-title::after {
        content: "";
        width: 45px;
        height: 1px;
        background: #cbd5e1;
    }

    .recommendation-title h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    .recommendation-card {
        background: #fff;
        border: 1px solid #edf0f4;
        border-radius: 12px;
        overflow: hidden;
        height: 100%;
        position: relative;
        transition: .2s ease;
    }

    .recommendation-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(15, 23, 42, .08);
    }

    .recommendation-image {
        height: 185px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .recommendation-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
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
        cursor: pointer;
    }

    .recommendation-info {
        padding: 13px 15px 17px;
    }

    .recommendation-info h6 {
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 7px;
    }

    .recommendation-price {
        font-size: 16px;
        font-weight: 700;
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-wishlist {
        background: #fff;
        border: 1px solid #edf0f4;
        border-radius: 14px;
        text-align: center;
        padding: 90px 20px;
    }

    .empty-wishlist i {
        display: block;
        font-size: 70px;
        color: #dbe3ed;
        margin-bottom: 20px;
    }

    .empty-wishlist h4 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .empty-wishlist p {
        color: #64748b;
        margin-bottom: 20px;
    }

    /* =========================
       TOAST
    ========================= */

    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 99999;
    }

    .toast {
        background: #fff;
        border-radius: 8px;
        padding: 15px 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,.15);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 300px;
        animation: slideIn .3s ease;
    }

    .toast-success {
        border-left: 4px solid #22c55e;
    }

    .toast-error {
        border-left: 4px solid #ef4444;
    }

    .toast i {
        font-size: 20px;
    }

    .toast-success > i {
        color: #22c55e;
    }

    .toast-error > i {
        color: #ef4444;
    }

    .close-toast {
        background: none;
        border: 0;
        margin-left: auto;
        color: #94a3b8;
        font-size: 20px;
        cursor: pointer;
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

    /* =========================
       RESPONSIVE
    ========================= */

    @media(max-width: 1200px) {
        .wishlist-item {
            grid-template-columns:
                30px
                140px
                minmax(200px, 1fr)
                170px
                210px
                40px
                40px;

            gap: 10px;
            padding: 12px;
        }

        .wishlist-product-image img {
            width: 120px;
        }

        .wishlist-features {
            grid-template-columns: repeat(2, 1fr);
            row-gap: 10px;
        }

        .wishlist-feature:nth-child(2) {
            border-right: 0;
        }
    }

    @media(max-width: 991px) {
        .wishlist-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .wishlist-item {
            grid-template-columns: 30px 130px 1fr 160px;
            grid-template-areas:
                "check image info price"
                "check image actions delete";
            row-gap: 5px;
        }

        .wishlist-item .wishlist-checkbox {
            grid-area: check;
        }

        .wishlist-product-image {
            grid-area: image;
        }

        .wishlist-product-info {
            grid-area: info;
        }

        .wishlist-price {
            grid-area: price;
        }

        .move-cart-btn {
            grid-area: actions;
        }

        .delete-wishlist-btn {
            grid-area: delete;
        }

        .heart-wishlist-btn {
            display: none;
        }
    }

    @media(max-width: 767px) {

        .wishlist-wrapper {
            padding: 0 12px;
        }

        .wishlist-page {
            padding-top: 20px;
        }

        .wishlist-title h1 {
            font-size: 23px;
        }

        .wishlist-actions {
            width: 100%;
        }

        .wishlist-action-btn {
            flex: 1;
            padding: 0 10px;
        }

        .wishlist-item {
            grid-template-columns: 25px 90px 1fr;
            grid-template-areas:
                "check image info"
                "check image price"
                ". image actions"
                ". image delete";
            min-height: 170px;
            padding: 12px 8px;
        }

        .wishlist-product-image {
            height: 120px;
        }

        .wishlist-product-image img {
            width: 90px;
            height: 90px;
        }

        .wishlist-product-name {
            font-size: 14px;
        }

        .wishlist-price {
            min-width: auto;
        }

        .current-price {
            font-size: 16px;
        }

        .move-cart-btn {
            height: 38px;
            padding: 0 10px;
            font-size: 12px;
        }

        .delete-wishlist-btn {
            justify-self: start;
        }

        .wishlist-features {
            grid-template-columns: 1fr;
            padding: 10px;
        }

        .wishlist-feature {
            border-right: 0;
            border-bottom: 1px solid #dbe6f5;
            padding: 15px 10px;
        }

        .wishlist-feature:last-child {
            border-bottom: 0;
        }

        .recommendation-section {
            margin-top: 30px;
        }
    }
</style>
@endsection


@section('content')

<div class="wishlist-page">

    <div class="wishlist-wrapper">

        {{-- =========================
             WISHLIST HEADER
        ========================== --}}

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

                <button type="button"
                        class="wishlist-action-btn wishlist-action-outline">
                    <i class="bi bi-share"></i>
                    Share Wishlist
                </button>

                <button type="button"
                        class="wishlist-action-btn wishlist-action-primary">
                    <i class="bi bi-cart3"></i>
                    Move All to Cart
                </button>

            </div>

        </div>


        {{-- =========================
             WISHLIST PRODUCTS
        ========================== --}}

        @if(isset($wishlistItems) && $wishlistItems->count() > 0)

            <div class="wishlist-list" id="wishlistContainer">

                @foreach($wishlistItems as $item)

                    @php

                        $product = $item->product;

                        $imgUrl = null;

                        if ($product) {

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
                            }
                        }

                        /*
                         * Optional discount calculation
                         * Change original_price to your actual column
                         */
                        $originalPrice = $product->original_price ?? null;

                        $discount = null;

                        if ($originalPrice && $originalPrice > $product->price) {

                            $discount = round(
                                (($originalPrice - $product->price) / $originalPrice) * 100
                            );
                        }

                    @endphp


                    @if($product)

                        <div class="wishlist-item"
                             data-wishlist-id="{{ $item->id }}">

                            {{-- Checkbox --}}

                            <input type="checkbox"
                                   class="wishlist-checkbox"
                                   value="{{ $item->id }}">


                            {{-- Product Image --}}

                            <div class="wishlist-product-image">

                                @if($imgUrl)

                                    <img src="{{ $imgUrl }}"
                                         alt="{{ $product->name }}"
                                         onerror="this.src='{{ asset('images/placeholder.png') }}'">

                                @else

                                    <div class="wishlist-no-image">
                                        <i class="bi bi-image"></i>
                                    </div>

                                @endif

                            </div>


                            {{-- Product Information --}}

                            <div class="wishlist-product-info">

                                <h3 class="wishlist-product-name"
                                    title="{{ $product->name }}">

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


                            {{-- Price --}}

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


                            {{-- Move To Cart --}}

                            <button type="button"
                                    class="move-cart-btn"
                                    data-product-id="{{ $product->id }}">

                                <i class="bi bi-cart3"></i>

                                Move to Cart

                            </button>


                            {{-- Delete --}}

                            <button type="button"
                                    class="delete-wishlist-btn remove-wishlist-btn"
                                    data-id="{{ $item->id }}"
                                    title="Remove from Wishlist">

                                <i class="bi bi-trash3"></i>

                            </button>


                            {{-- Heart --}}

                            <button type="button"
                                    class="heart-wishlist-btn"
                                    title="Wishlist">

                                <i class="bi bi-heart-fill"></i>

                            </button>

                        </div>

                    @endif

                @endforeach

            </div>


            {{-- Pagination --}}

            <div class="mt-4 d-flex justify-content-center">

                {{ $wishlistItems->links() }}

            </div>


            {{-- =========================
                 FEATURES
            ========================== --}}

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


            {{-- =========================
                 RECOMMENDATIONS
            ========================== --}}

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

                                    $recImages = array_map(
                                        'trim',
                                        explode(',', $recommended->image)
                                    );

                                    $recImage = $recImages[0] ?? null;

                                    if ($recImage) {

                                        $recImage = preg_replace(
                                            '#^storage/#',
                                            '',
                                            $recImage
                                        );

                                        $recImage = asset($recImage);
                                    }
                                }

                            @endphp


                            <div class="col-xl-3 col-lg-3 col-md-4 col-6">

                                <div class="recommendation-card">

                                    <div class="recommendation-image">

                                        @if($recImage)

                                            <img src="{{ $recImage }}"
                                                 alt="{{ $recommended->name }}">

                                        @else

                                            <i class="bi bi-image"
                                               style="font-size:45px;color:#cbd5e1"></i>

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

            {{-- =========================
                 EMPTY WISHLIST
            ========================== --}}

            <div class="empty-wishlist">

                <i class="bi bi-heart"></i>

                <h4>Your Wishlist is Empty</h4>

                <p>
                    Save your favorite products here and view them anytime.
                </p>

                <a href="{{ route('customer.products') }}"
                   class="btn btn-primary px-4">

                    <i class="bi bi-cart3 me-1"></i>
                    Start Shopping

                </a>

            </div>

        @endif

    </div>

</div>


{{-- Toast --}}

<div class="toast-container"
     id="toastContainer">
</div>

@endsection


@section('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const csrfToken =
        document.querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');


    /*
    |--------------------------------------------------------------------------
    | REMOVE WISHLIST
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.remove-wishlist-btn')
        .forEach(button => {

            button.addEventListener('click', function (e) {

                e.preventDefault();

                const wishlistId =
                    this.getAttribute('data-id');

                const productCard =
                    this.closest('.wishlist-item');

                const removeBtn = this;


                removeBtn.disabled = true;

                removeBtn.innerHTML =
                    '<i class="bi bi-hourglass-split"></i>';


                fetch(`/customer/wishlist/remove/${wishlistId}`, {

                    method: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }

                })

                .then(response => response.json())

                .then(data => {

                    if (data.success) {

                        productCard.style.transition =
                            'all .3s ease';

                        productCard.style.opacity = '0';

                        productCard.style.transform =
                            'translateX(30px)';


                        setTimeout(() => {

                            productCard.remove();

                            updateWishlistCounts(
                                data.wishlist_count
                            );


                            showToast(
                                'success',
                                'Removed from wishlist',
                                'Product has been removed from your wishlist.'
                            );


                            const remainingItems =
                                document.querySelectorAll(
                                    '.wishlist-item'
                                );


                            if (remainingItems.length === 0) {

                                setTimeout(() => {
                                    location.reload();
                                }, 700);

                            }

                        }, 300);

                    }

                    else {

                        showToast(
                            'error',
                            'Error',
                            data.message ||
                            'Failed to remove item.'
                        );

                        restoreRemoveButton(removeBtn);

                    }

                })

                .catch(error => {

                    console.error(error);

                    showToast(
                        'error',
                        'Error',
                        'Something went wrong. Please try again.'
                    );

                    restoreRemoveButton(removeBtn);

                });

            });

        });


    /*
    |--------------------------------------------------------------------------
    | MOVE TO CART
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.move-cart-btn')
        .forEach(button => {

            button.addEventListener('click', function () {

                const productId =
                    this.getAttribute('data-product-id');

                const btn = this;

                btn.disabled = true;

                btn.innerHTML =
                    '<i class="bi bi-hourglass-split"></i> Adding...';


                /*
                 * Replace this URL with your actual
                 * add-to-cart route.
                 */

                fetch(`/customer/cart/add/${productId}`, {

                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }

                })

                .then(response => response.json())

                .then(data => {

                    if (data.success) {

                        showToast(
                            'success',
                            'Added to Cart',
                            'Product has been moved to your cart.'
                        );

                        btn.innerHTML =
                            '<i class="bi bi-check-lg"></i> Added';

                    }

                    else {

                        showToast(
                            'error',
                            'Error',
                            data.message ||
                            'Unable to add product to cart.'
                        );

                        restoreCartButton(btn);

                    }

                })

                .catch(error => {

                    console.error(error);

                    showToast(
                        'error',
                        'Error',
                        'Something went wrong.'
                    );

                    restoreCartButton(btn);

                });

            });

        });


    /*
    |--------------------------------------------------------------------------
    | UPDATE COUNT
    |--------------------------------------------------------------------------
    */

    function updateWishlistCounts(count) {

        const headerBadge =
            document.getElementById('headerWishlistCount');

        const sidebarBadge =
            document.getElementById('sidebarWishlistCount');

        const countDisplay =
            document.getElementById('wishlistCountDisplay');


        if (headerBadge) {

            headerBadge.textContent = count;

        }


        if (sidebarBadge) {

            sidebarBadge.textContent = count;

        }


        if (countDisplay) {

            countDisplay.textContent =
                count + ' items';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | RESTORE BUTTONS
    |--------------------------------------------------------------------------
    */

    function restoreRemoveButton(button) {

        button.disabled = false;

        button.innerHTML =
            '<i class="bi bi-trash3"></i>';

    }


    function restoreCartButton(button) {

        button.disabled = false;

        button.innerHTML =
            '<i class="bi bi-cart3"></i> Move to Cart';

    }


    /*
    |--------------------------------------------------------------------------
    | TOAST
    |--------------------------------------------------------------------------
    */

    function showToast(type, title, message) {

        const container =
            document.getElementById('toastContainer');


        const toast =
            document.createElement('div');


        toast.className =
            `toast toast-${type}`;


        const icons = {

            success:
                'bi bi-check-circle-fill',

            error:
                'bi bi-x-circle-fill',

            info:
                'bi bi-info-circle-fill'

        };


        toast.innerHTML = `

            <i class="${icons[type] || icons.info}"></i>

            <div>

                <strong>${title}</strong>

                <div style="
                    font-size:13px;
                    color:#64748b;
                    margin-top:2px;
                ">
                    ${message}
                </div>

            </div>

            <button class="close-toast">
                &times;
            </button>

        `;


        container.appendChild(toast);


        setTimeout(() => {

            closeToast(toast);

        }, 4000);


        toast.querySelector('.close-toast')
            .addEventListener('click', function () {

                closeToast(toast);

            });

    }


    function closeToast(toast) {

        toast.style.animation =
            'slideOut .3s ease forwards';

        setTimeout(() => {

            toast.remove();

        }, 300);

    }


});

</script>

@endsection
