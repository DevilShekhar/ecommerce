@extends('frontend.layouts.customer-layout')

@section('title', 'Checkout - Aethelweave')
@section('content')
    <div id="checkoutLoading" style="display:flex;justify-content:center;align-items:center;min-height:300px;">
        <div class="text-center">
            <div class="spinner-border text-gold" role="status" style="width:3rem;height:3rem;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3 text-muted">Loading your cart...</p>
        </div>
    </div>

    <!-- Main Content -->
    <div id="checkoutContent" style="display:none;">
        <!-- Your existing checkout content goes here -->
    </div>
    @php
        // Debug session data
        $debugData = [
            'coupon_code' => session()->get('applied_coupon_code'),
            'coupon_discount' => session()->get('applied_coupon_discount'),
            'coupon_data' => session()->get('applied_coupon_data'),
            'cart' => session()->get('cart'),
            'shipping' => session()->get('shipping'),
        ];
    @endphp
    <div class="checkout-page">
        <div class="checkout-header">
            <div class="checkout-header-inner">
                <a href="{{ route('customer.products') }}" class="continue-shopping">
                    <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>
                <div class="checkout-heading">
                    <h1>Checkout</h1>
                </div>
                <div class="secure-checkout">
                    <div class="secure-icon"><i class="bi bi-lock-fill"></i></div>
                    <div><strong>100% Secure Checkout</strong><span>SSL Encrypted</span></div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-3">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if(!empty($cart) && count($cart) > 0)

            <div class="row g-3">
                <div class="col-lg-8">
                    <div id="deliverySection">

                        <div class="checkout-card">

                            <div class="checkout-card-header">
                                <div class="checkout-card-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <h5>Delivery Address</h5>
                            </div>

                            <div class="address-section">

                                @if(!empty($addresses) && count($addresses) > 0)

                                    <div class="address-list">

                                        @foreach($addresses as $address)

                                            @php
                                                $addressText = $address['address'] ?? '';

                                                if (is_array($addressText)) {
                                                    $addressText = implode(
                                                        ', ',
                                                        array_filter($addressText)
                                                    );
                                                }
                                            @endphp

                                            <div class="address-card {{ !empty($address['is_default']) ? 'selected' : '' }}"
                                                data-address-id="{{ $address['id'] ?? '' }}">

                                                <div class="radio-indicator"></div>

                                                <div class="address-details">

                                                    <div class="name">

                                                        {{ $address['name'] ?? ($user->name ?? 'Customer') }}

                                                        @if(!empty($address['type']))
                                                            <span class="badge">
                                                                {{ $address['type'] }}
                                                            </span>
                                                        @endif

                                                        @if(!empty($address['is_default']))
                                                            <span class="badge badge-default">
                                                                Default
                                                            </span>
                                                        @endif

                                                    </div>

                                                    @if(!empty($address['mobile']))
                                                        <div class="phone">
                                                            <span class="label">Mobile:</span>
                                                            {{ $address['mobile'] }}
                                                        </div>
                                                    @endif

                                                    @if(!empty($addressText))
                                                        <div class="address-line">
                                                            {{ $addressText }}
                                                        </div>
                                                    @endif

                                                    @if(!empty($address['city']) || !empty($address['state']))
                                                        <div class="address-line">

                                                            {{ $address['city'] ?? '' }}

                                                            @if(
                                                                    !empty($address['city']) &&
                                                                    !empty($address['state'])
                                                                )
                                                                ,
                                                            @endif

                                                            {{ $address['state'] ?? '' }}

                                                        </div>
                                                    @endif

                                                    @if(
                                                            !empty($address['country']) ||
                                                            !empty($address['pincode'])
                                                        )

                                                        <div class="address-line">

                                                            {{ $address['country'] ?? '' }}

                                                            @if(
                                                                    !empty($address['country']) &&
                                                                    !empty($address['pincode'])
                                                                )
                                                                -
                                                            @endif

                                                            {{ $address['pincode'] ?? '' }}

                                                        </div>

                                                    @endif

                                                </div>

                                                @if(!empty($address['is_default']))
                                                    <div class="address-tag">
                                                        Selected
                                                    </div>
                                                @endif

                                                <div class="address-actions">

                                                    <button type="button" class="select-address-btn"
                                                        data-address-id="{{ $address['id'] ?? '' }}">
                                                        <i class="bi bi-check-circle"></i>
                                                        Select
                                                    </button>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    <div class="no-address">

                                        <i class="bi bi-geo-alt"></i>

                                        <h6>No Saved Address</h6>

                                        <p>
                                            Add a delivery address to continue with your order.
                                        </p>

                                    </div>

                                @endif

                            </div>

                            <button type="button" class="add-address-btn" id="addAddressBtn">
                                <i class="bi bi-plus-lg"></i>
                                Add Address
                            </button>

                        </div>


                        {{-- =================================================
                        CART ITEMS
                        ================================================== --}}
                        <div class="checkout-card">

                            <div class="checkout-card-header">

                                <div class="checkout-card-icon">
                                    <i class="bi bi-bag-fill"></i>
                                </div>

                                <h5>
                                    Items in Your Cart
                                    ({{ $cartCount ?? count($cart) }})
                                </h5>

                            </div>


                            <div id="cartItemsContainer">

                                @php
                                    $hasOutOfStock = false;
                                    $hasLowStock = false;
                                @endphp


                                @foreach($cart as $key => $item)

                                    @php

                                        /*
                                        |--------------------------------------------------------------------------
                                        | PRODUCT
                                        |--------------------------------------------------------------------------
                                        */

                                        $product = \App\Models\Product::find(
                                            $item['id'] ?? null
                                        );


                                        /*
                                        |--------------------------------------------------------------------------
                                        | STOCK
                                        |--------------------------------------------------------------------------
                                        */

                                        $stock = $product
                                            ? (int) $product->stock
                                            : 0;

                                        $isOutOfStock = $stock <= 0;
                                        $isLowStock = $stock > 0 && $stock <= 5;

                                        $currentQty = max(
                                            1,
                                            (int) ($item['quantity'] ?? 1)
                                        );


                                        if ($isOutOfStock) {
                                            $hasOutOfStock = true;
                                        }

                                        if ($isLowStock) {
                                            $hasLowStock = true;
                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | PRICES - SELLING PRICE & ORIGINAL PRICE
                                        |--------------------------------------------------------------------------
                                        */

                                        // Get selling price from product (this is the discounted price)
                                        $sellingPrice = (float) (
                                            $item['selling_price']
                                            ?? $product?->selling_price
                                            ?? $item['price']
                                            ?? $product?->price
                                            ?? 0
                                        );

                                        // Get original price from product
                                        $originalPrice = (float) (
                                            $item['price']
                                            ?? $product?->price
                                            ?? 0
                                        );

                                        // Check if there's a discount
                                        $hasDiscount = $originalPrice > $sellingPrice;

                                        // Calculate discount percentage
                                        $discountPercent = $hasDiscount ? round((($originalPrice - $sellingPrice) / $originalPrice) * 100) : 0;


                                        /*
                                        |--------------------------------------------------------------------------
                                        | ACTIVE OFFER (from offers table)
                                        |--------------------------------------------------------------------------
                                        */

                                        $activeOffer =
                                            $item['active_offer']
                                            ?? $product?->activeOffer
                                            ?? $product?->active_offer
                                            ?? null;

                                        // If active offer exists, use its discounted price
                                        if ($activeOffer) {

                                            $discountValue = (float)
                                                $activeOffer->discount_value;

                                            if (
                                                $activeOffer->discount_type ===
                                                'percentage'
                                            ) {

                                                $sellingPrice =
                                                    $originalPrice -
                                                    (
                                                        $originalPrice *
                                                        $discountValue /
                                                        100
                                                    );

                                            } else {

                                                $sellingPrice =
                                                    $originalPrice -
                                                    $discountValue;
                                            }

                                            $sellingPrice = max(
                                                0,
                                                $sellingPrice
                                            );
                                        }


                                        /*
                                        |--------------------------------------------------------------------------
                                        | ITEM TOTAL
                                        |--------------------------------------------------------------------------
                                        */

                                        $itemTotal =
                                            $sellingPrice *
                                            $currentQty;


                                        /*
                                        |--------------------------------------------------------------------------
                                        | PRODUCT IMAGE
                                        |--------------------------------------------------------------------------
                                        */

                                        $imgUrl = null;

                                        $imageValue =
                                            $item['image']
                                            ?? $product?->image
                                            ?? null;

                                        if ($imageValue) {

                                            $images = is_array($imageValue)
                                                ? $imageValue
                                                : array_map(
                                                    'trim',
                                                    explode(',', $imageValue)
                                                );

                                            $firstImage =
                                                $images[0] ?? null;

                                            if ($firstImage) {

                                                $firstImage =
                                                    preg_replace(
                                                        '#^storage/#',
                                                        '',
                                                        $firstImage
                                                    );

                                                $imgUrl =
                                                    asset($firstImage);
                                            }
                                        }

                                        $productName =
                                            $item['name']
                                            ?? $product?->name
                                            ?? 'Product';

                                    @endphp
                                    <div class="cart-item" data-cart-key="{{ $key }}" data-price="{{ $sellingPrice }}"
                                        data-original-price="{{ $originalPrice }}" data-stock="{{ $stock }}">


                                        {{-- PRODUCT IMAGE --}}
                                        <div class="cart-item-image">

                                            @if($imgUrl)

                                                <img src="{{ $imgUrl }}" alt="{{ $productName }}"
                                                    onerror="this.src='{{ asset('images/placeholder.png') }}'">

                                            @else

                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">

                                                    <i class="bi bi-image text-muted"></i>

                                                </div>

                                            @endif

                                        </div>


                                        {{-- PRODUCT INFORMATION --}}
                                        <div class="cart-item-info">

                                            {{-- NAME --}}
                                            <div class="cart-item-name">
                                                {{ $productName }}
                                            </div>


                                            {{-- PRICE - SHOW BOTH SELLING AND ORIGINAL --}}
                                            <div class="cart-item-price">

                                                {{-- SELLING PRICE (green) --}}
                                                <span style="color:#198754;font-weight:700;font-size:15px;">
                                                    ₹{{ number_format($sellingPrice, 0) }}
                                                </span>

                                                {{-- ORIGINAL PRICE (crossed out) --}}
                                                @if($hasDiscount || $activeOffer)
                                                    <span
                                                        style="color:#94a3b8;text-decoration:line-through;text-decoration-thickness:1px;font-size:12px;margin-left:5px;">
                                                        ₹{{ number_format($originalPrice, 0) }}
                                                    </span>

                                                    {{-- DISCOUNT PERCENTAGE BADGE --}}
                                                    <span
                                                        style="background:#fef2f2;color:#ef4444;font-size:10px;font-weight:700;padding:2px 8px;border-radius:3px;margin-left:5px;">
                                                        @if($hasDiscount)
                                                            {{ $discountPercent }}% OFF
                                                        @elseif($activeOffer)
                                                            @if($activeOffer->discount_type === 'percentage')
                                                                {{ rtrim(rtrim(number_format($activeOffer->discount_value, 2), '0'), '.') }}%
                                                                OFF
                                                            @else
                                                                ₹{{ number_format($activeOffer->discount_value, 0) }} OFF
                                                            @endif
                                                        @endif
                                                    </span>
                                                @endif

                                                <div style="font-size:11px;color:#64748b;margin-top:2px;">
                                                    per item
                                                </div>

                                            </div>


                                            {{-- OFFER APPLIED (if active offer exists) --}}
                                            @if($activeOffer)

                                                <div
                                                    style="margin-top:5px;display:inline-flex;align-items:center;gap:4px;color:#16a34a;font-size:11px;font-weight:600;">

                                                    <i class="bi bi-tag-fill"></i>

                                                    @if($activeOffer->discount_type === 'percentage')

                                                        {{ rtrim(rtrim(number_format($activeOffer->discount_value, 2), '0'), '.') }}% offer
                                                        applied

                                                    @else

                                                        ₹{{ number_format($activeOffer->discount_value, 0) }} offer applied

                                                    @endif

                                                </div>

                                            @endif


                                            {{-- STOCK STATUS --}}
                                            @if($isOutOfStock)

                                                <div class="stock-status out-of-stock">

                                                    <i class="bi bi-x-circle-fill"></i>

                                                    <span style="color:#ef4444;font-size:12px;font-weight:600;">
                                                        Out of Stock
                                                    </span>

                                                </div>

                                            @elseif($isLowStock)

                                                <div class="stock-status low-stock">

                                                    <i class="bi bi-exclamation-triangle-fill"></i>

                                                    <span style="color:#f59e0b;font-size:12px;font-weight:600;">
                                                        Only {{ $stock }} {{ $stock == 1 ? 'item' : 'items' }} left in stock
                                                    </span>

                                                </div>

                                            @else

                                                <div class="stock-status in-stock">

                                                    <i class="bi bi-check-circle-fill"></i>

                                                    <span style="color:#16a34a;font-size:12px;font-weight:600;">
                                                        In Stock
                                                    </span>

                                                </div>

                                            @endif


                                            {{-- QUANTITY + REMOVE --}}
                                            <div class="cart-item-actions">

                                                <select class="cart-item-qty-select" data-cart-key="{{ $key }}"
                                                    data-max-stock="{{ $stock }}" {{ $isOutOfStock ? 'disabled' : '' }}>

                                                    @if($isOutOfStock)

                                                        <option value="0" selected>
                                                            Out of Stock
                                                        </option>

                                                    @else

                                                        @php
                                                            $maxQty = min(5, $stock);
                                                        @endphp

                                                        @for($i = 1; $i <= $maxQty; $i++)

                                                            <option value="{{ $i }}" {{ $currentQty == $i ? 'selected' : '' }}>
                                                                {{ $i }}
                                                            </option>

                                                        @endfor

                                                        @if($stock > 5)

                                                            <option value="more">
                                                                More...
                                                            </option>

                                                        @endif

                                                    @endif

                                                </select>


                                                <button type="button" class="remove-cart-btn" data-cart-key="{{ $key }}"
                                                    title="Remove from cart">
                                                    <i class="bi bi-trash3"></i>
                                                </button>

                                            </div>

                                        </div>


                                        {{-- ITEM TOTAL --}}
                                        <div class="cart-item-total" id="itemTotal-{{ $key }}">

                                            @if($isOutOfStock)

                                                <span style="color:#ef4444;">
                                                    Unavailable
                                                </span>

                                            @else

                                                {{-- ORIGINAL TOTAL (crossed out) --}}
                                                @if($hasDiscount || $activeOffer)
                                                    <div>
                                                        <span
                                                            style="color:#94a3b8;text-decoration:line-through;text-decoration-thickness:1px;font-size:12px;">
                                                            ₹{{ number_format($originalPrice * $currentQty, 0) }}
                                                        </span>
                                                    </div>
                                                @endif

                                                {{-- SELLING TOTAL --}}
                                                <strong style="{{ ($hasDiscount || $activeOffer) ? 'color:#198754;' : '' }}">
                                                    ₹{{ number_format($itemTotal, 0) }}
                                                </strong>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            {{-- FREE DELIVERY --}}
                            <div class="free-delivery-box">

                                <i class="bi bi-truck"></i>

                                <div>
                                    <span>
                                        Yay! You've unlocked FREE shipping.
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-lg-4">

                    <div class="summary-card">

    <div class="summary-header">
        <h5>Price Details</h5>
    </div>

    @php
        /*
        |--------------------------------------------------------------------------
        | CALCULATE SUBTOTAL BASED ON SELLING PRICE
        |--------------------------------------------------------------------------
        */
        $subtotal = 0;
        $originalSubtotal = 0;
        $totalDiscount = 0;
        $hasDiscountItems = false;

        foreach ($cart as $cartItem) {
            $product = \App\Models\Product::find($cartItem['id'] ?? null);
            $quantity = (int) ($cartItem['quantity'] ?? 1);

            // Get selling price (discounted price)
            $sellingPrice = (float) ($cartItem['selling_price'] ?? $product?->selling_price ?? $cartItem['price'] ?? $product?->price ?? 0);

            // Get original price
            $originalPrice = (float) ($cartItem['price'] ?? $product?->price ?? 0);

            // Check for active offer
            $activeOffer = $cartItem['active_offer'] ?? $product?->activeOffer ?? $product?->active_offer ?? null;

            if ($activeOffer) {
                $discountValue = (float) $activeOffer->discount_value;
                if ($activeOffer->discount_type === 'percentage') {
                    $sellingPrice = $originalPrice - ($originalPrice * $discountValue / 100);
                } else {
                    $sellingPrice = $originalPrice - $discountValue;
                }
                $sellingPrice = max(0, $sellingPrice);
            }

            // Add to subtotals
            $subtotal += $sellingPrice * $quantity;
            $originalSubtotal += $originalPrice * $quantity;

            if ($originalPrice > $sellingPrice) {
                $hasDiscountItems = true;
                $totalDiscount += ($originalPrice - $sellingPrice) * $quantity;
            }
        }

        $shippingAmount = (float) ($shipping ?? 0);
        $couponDiscount = (float) ($discount ?? 0);
        $finalTotal = max(0, $subtotal + $shippingAmount - $couponDiscount);

        // Format numbers
        $formattedSubtotal = number_format($subtotal, 0);
        $formattedOriginalSubtotal = number_format($originalSubtotal, 0);
        $formattedTotalDiscount = number_format($totalDiscount, 0);
        $formattedFinalTotal = number_format($finalTotal, 0);
        $formattedCouponDiscount = number_format($couponDiscount, 0);
        $formattedShipping = number_format($shippingAmount, 0);

        // Check if coupon is applied from session
        $appliedCouponCode = session()->get('applied_coupon_code');
        $hasCoupon = !empty($appliedCouponCode);
    @endphp

    {{-- PRICE (Subtotal based on selling price) --}}
    <div class="summary-row">

        <span>
            Price ({{ $cartCount ?? count($cart) }} items)
        </span>

        <div style="text-align:right;">
            @if($hasDiscountItems)
                <span style="color:#94a3b8;text-decoration:line-through;font-size:12px;display:block;">
                    ₹{{ $formattedOriginalSubtotal }}
                </span>
            @endif
            <strong id="subtotalDisplay" style="color:#198754;">
                ₹{{ $formattedSubtotal }}
            </strong>
        </div>

    </div>

    {{-- DISCOUNT (from product discounts) --}}
    @if($totalDiscount > 0)
        <div class="summary-row" style="background:#f0fdf4;padding:6px 0;border-radius:4px;">
            <span style="color:#16a34a;">
                <i class="bi bi-tag-fill me-1"></i> Product Discount
            </span>
            <span class="discount-value" style="color:#16a34a;">
                -₹{{ $formattedTotalDiscount }}
            </span>
        </div>
    @endif

    {{-- DELIVERY --}}
    <div class="summary-row">
        <span>Delivery Charges</span>
        @if($shippingAmount > 0)
            <strong>
                ₹{{ $formattedShipping }}
            </strong>
        @else
            <span class="free-shipping">
                FREE
            </span>
        @endif
    </div>

    {{-- COUPON --}}
    <div class="coupon-wrapper">

        <input type="text" id="couponCode" class="form-control" placeholder="Enter coupon code"
            value="{{ $appliedCouponCode ?: '' }}" {{ $hasCoupon ? 'readonly' : '' }}>

        <button type="button" class="btn {{ $hasCoupon ? 'btn-success' : 'btn-outline-primary' }}" id="applyCouponBtn">
            @if($hasCoupon)
                Applied ✅
            @else
                Apply
            @endif
        </button>

    </div>

    {{-- COUPON DISCOUNT ROW --}}
    <div class="summary-total coupon-discount-row" id="couponDiscountRow" style="{{ $hasCoupon && $couponDiscount > 0 ? 'display:flex;' : 'display:none;' }};">

        <span>

            Coupon Discount

            @if($hasCoupon)
                <small id="appliedCouponCode" style="color:#64748b;font-size:11px;">
                    ({{ $appliedCouponCode }})
                </small>
            @endif

        </span>

        <strong class="text-success" id="discountDisplay">
            - ₹{{ $formattedCouponDiscount }}
        </strong>

    </div>

    <div class="summary-divider"></div>

    {{-- SUBTOTAL --}}
    <div class="summary-total">

        <span>Subtotal</span>

        <strong id="subtotalDisplay2" style="color:#198754;">
            ₹{{ $formattedFinalTotal }}
        </strong>

    </div>

    {{-- TOTAL --}}
    <div class="summary-total" style="border-top:2px solid #e5eaf1;padding-top:12px;margin-top:4px;">

        <span style="font-size:16px;font-weight:700;">Total Amount</span>

        <strong id="totalDisplay" data-original-total="{{ $finalTotal }}" style="font-size:20px;color:#0f172a;">
            ₹{{ $formattedFinalTotal }}
        </strong>

    </div>

    <div class="tax-note">
        Inclusive of applicable taxes
    </div>

    {{-- =================================================
    STOCK CHECK
    ================================================== --}}
    @php
        $hasOutOfStock = false;
        foreach ($cart as $cartItem) {
            $cartProduct = \App\Models\Product::find($cartItem['id'] ?? null);
            if ($cartProduct && $cartProduct->stock <= 0) {
                $hasOutOfStock = true;
                break;
            }
        }
    @endphp

    {{-- CONTINUE BUTTON --}}
    <button class="continue-btn" id="continueBtn" type="button" {{ $hasOutOfStock ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '' }}>

        <i class="bi bi-arrow-right me-2"></i>

        @if($hasOutOfStock)
            Out of Stock Items in Cart
        @else
            Continue
        @endif

    </button>

    {{-- STOCK WARNING --}}
    @if($hasOutOfStock)
        <div style="padding:8px 16px;background:#fef2f2;border:1px solid #fecaca;border-radius:4px;margin-top:10px;font-size:12px;color:#dc2626;">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            Please remove out of stock items to proceed with checkout.
        </div>
    @endif

    {{-- PLACE ORDER --}}
    <button class="payment-btn" id="placeOrderBtn" type="button" style="display:none;">

        <i class="bi bi-lock-fill me-2"></i>
        Place Order

    </button>

    <div class="secure-note text-center text-muted small mt-3">

        <i class="bi bi-shield-check me-1"></i>

        Safe and secure payments

    </div>

</div>


                    {{-- =====================================================
                    SIDE BENEFITS
                    ====================================================== --}}
                    <div class="side-benefits">

                        <div class="side-benefit">

                            <div class="side-benefit-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <div>
                                <strong>Secure Payments</strong>
                                <span>
                                    Your payment information is protected
                                </span>
                            </div>

                        </div>


                        <div class="side-benefit">

                            <div class="side-benefit-icon">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </div>

                            <div>
                                <strong>Easy Returns</strong>
                                <span>
                                    Return options available as per product policy
                                </span>
                            </div>

                        </div>


                        <div class="side-benefit">

                            <div class="side-benefit-icon">
                                <i class="bi bi-headset"></i>
                            </div>

                            <div>
                                <strong>Customer Support</strong>
                                <span>
                                    We're here to help with your order
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="checkout-benefits">

                <div class="benefits-grid">

                    <div class="benefit-item">

                        <div class="benefit-icon">
                            <i class="bi bi-truck"></i>
                        </div>

                        <div>
                            <strong>Free Shipping</strong>
                            <span>On orders above ₹999</span>
                        </div>

                    </div>


                    <div class="benefit-item">

                        <div class="benefit-icon">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>

                        <div>
                            <strong>7 Days Return</strong>
                            <span>Easy returns & refunds</span>
                        </div>

                    </div>


                    <div class="benefit-item">

                        <div class="benefit-icon">
                            <i class="bi bi-lock"></i>
                        </div>

                        <div>
                            <strong>Secure Checkout</strong>
                            <span>100% protected payments</span>
                        </div>

                    </div>


                    <div class="benefit-item">

                        <div class="benefit-icon">
                            <i class="bi bi-award"></i>
                        </div>

                        <div>
                            <strong>Best Quality</strong>
                            <span>Premium products only</span>
                        </div>

                    </div>

                </div>

            </div>


        @else
            <div class="checkout-card">

                <div class="empty-cart">

                    <i class="bi bi-cart-x"></i>

                    <h4>Your Cart is Empty</h4>

                    <p>
                        Looks like you haven't added any items to your cart yet.
                    </p>

                    <a href="{{ route('customer.products') }}" class="btn btn-primary">
                        <i class="bi bi-cart me-1"></i>
                        Start Shopping
                    </a>

                </div>

            </div>

        @endif
    </div>

    {{-- QUANTITY MODAL --}}
    <div class="modal-overlay" id="qtyModal">
        <div class="modal-box">
            <h4>Enter Quantity</h4>
            <input type="number" id="qtyInput" min="1" max="999" value="1">
            <div class="modal-actions">
                <button class="btn-secondary" id="qtyCancelBtn">Cancel</button>
                <button class="btn-primary" id="qtyConfirmBtn">Confirm</button>
            </div>
        </div>
    </div>

    {{-- TOAST --}}
    <div class="toast-container-custom" id="toastContainer"></div>

    {{-- CONFIRMATION MODAL --}}
    <div class="modal-overlay" id="confirmModal">
        <div class="modal-box" style="max-width: 450px;">
            <div style="text-align: center; margin-bottom: 15px;">
                <div
                    style="width: 55px; height: 55px; border-radius: 50%; background: #fef3c7; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 26px; color: #d97706;"></i>
                </div>
                <h4 style="margin: 0 0 4px; font-weight: 700; color: #172033; font-size: 18px;">Confirm Your Order</h4>
                <p style="color: #64748b; font-size: 13px; margin: 0;">Please review your order details before placing.</p>
            </div>

            <div style="background: #f8fafc; border-radius: 8px; padding: 12px 15px; margin-bottom: 15px;">
                <div
                    style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e5eaf1;">
                    <span style="color: #64748b; font-size: 13px;">Items</span>
                    <span style="font-weight: 600; color: #172033; font-size: 13px;"
                        id="confirmItems">{{ $cartCount ?? 0 }}</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e5eaf1;">
                    <span style="color: #64748b; font-size: 13px;">Subtotal</span>
                    <span style="font-weight: 600; color: #172033; font-size: 13px;"
                        id="confirmSubtotal">₹{{ number_format($subtotal ?? 0, 0) }}</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e5eaf1;">
                    <span style="color: #64748b; font-size: 13px;">Delivery Charges</span>
                    <span style="font-weight: 600; color: #172033; font-size: 13px;" id="confirmShipping">FREE</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px solid #e5eaf1;">
                    <span style="color: #64748b; font-size: 13px;">Coupon Discount</span>
                    <span style="font-weight: 600; color: #16a34a; font-size: 13px;" id="confirmDiscount">- ₹0</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span style="font-weight: 700; color: #172033; font-size: 15px;">Total Amount</span>
                    <span style="font-weight: 700; color: #2878f0; font-size: 18px;"
                        id="confirmTotal">₹{{ number_format($finalTotal ?? 0, 0) }}</span>
                </div>
            </div>
            <div style="display: flex; gap: 10px;">
                <button class="btn-secondary" id="cancelOrderBtn"
                    style="flex: 1; padding: 12px; border: 1px solid #dbe2ea; background: #fff; border-radius: 6px; font-weight: 600; cursor: pointer; color: #475569;">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </button>
                <button class="btn-primary" id="confirmOrderBtn"
                    style="flex: 2; padding: 12px; border: 0; background: #2878f0; border-radius: 6px; font-weight: 600; cursor: pointer; color: #fff;">
                    <i class="bi bi-lock-fill me-1"></i> Pay Now
                </button>
            </div>
        </div>
    </div>

    {{-- ADD ADDRESS MODAL --}}
    <div class="address-modal-overlay" id="addressChoiceModal">
        <div class="address-modal">
            <div class="address-modal-header">
                <div>
                    <h5>Add Delivery Address</h5>
                    <p>Choose how you want to add your delivery address.</p>
                </div>
                <button type="button" class="address-modal-close" id="closeAddressModal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="address-options" id="addressOptions">
                <button type="button" class="address-option" id="currentLocationOption">
                    <div class="address-option-icon location">
                        <i class="bi bi-crosshair"></i>
                    </div>
                    <div class="address-option-content">
                        <strong>Use Current Location</strong>
                        <span>Automatically detect your current area and address.</span>
                    </div>
                    <i class="bi bi-chevron-right address-option-arrow"></i>
                </button>
                <button type="button" class="address-option" id="manualAddressOption">
                    <div class="address-option-icon manual">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="address-option-content">
                        <strong>Enter Address Manually</strong>
                        <span>Add or manage your address from Account Settings.</span>
                    </div>
                    <i class="bi bi-chevron-right address-option-arrow"></i>
                </button>
            </div>
            <div class="location-result" id="locationResult" style="display:none;">
                <div class="location-result-header">
                    <div class="location-result-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <strong id="locationResultTitle">Current Location Found</strong>
                        <span id="modalLocationStatus">Finding your location...</span>
                    </div>
                </div>
                <div class="detected-address" id="modalDetectedAddress">
                    Detecting your address...
                </div>
                <div class="location-coordinates" id="modalLocationCoordinates" style="display:none;">
                    <span>Latitude: <strong id="modalLatitude"></strong></span>
                    <span>Longitude: <strong id="modalLongitude"></strong></span>
                </div>
                <div class="location-result-actions">
                    <button type="button" class="location-cancel-btn" id="locationBackBtn">
                        <i class="bi bi-arrow-left me-1"></i>Back
                    </button>
                    <button type="button" class="use-location-btn" id="modalUseLocationBtn" disabled>
                        <i class="bi bi-check-circle me-1"></i>Use This Location
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function getCartFromLocalStorage() {
            try {
                const cart = localStorage.getItem('cart');
                return cart ? JSON.parse(cart) : [];
            } catch (e) {
                return [];
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const loading = document.getElementById('checkoutLoading');
            const content = document.getElementById('checkoutContent');
            const cartItemsOnPage = document.querySelectorAll('.cart-item').length;

            if (cartItemsOnPage > 0) {
                loading.style.display = 'none';
                content.style.display = 'block';
                return;
            }

            const cart = getCartFromLocalStorage();

            if (cart.length > 0) {
                loading.style.display = 'flex';
                content.style.display = 'none';

                fetch('{{ route("checkout.sync-cart") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ cart: cart })
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Cart sync failed');
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            sessionStorage.setItem('cart_synced', 'true');
                            window.location.reload();
                        } else {
                            loading.style.display = 'none';
                            content.style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Cart sync error:', error);
                        loading.style.display = 'none';
                        content.style.display = 'block';
                    });
            } else {
                loading.style.display = 'none';
                content.style.display = 'block';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            var pendingQtyKey = null;
            var currentStep = 1;
            var isProcessingOrder = false;

            // ============================================================
            // TOAST NOTIFICATIONS
            // ============================================================
            function showToast(type, title, message) {
                var container = document.getElementById('toastContainer');
                if (!container) return;

                var toast = document.createElement('div');
                toast.className = 'toast-custom toast-custom-' + type;

                var icons = {
                    success: 'bi bi-check-circle-fill',
                    error: 'bi bi-exclamation-circle-fill',
                    info: 'bi bi-info-circle-fill'
                };

                toast.innerHTML =
                    '<i class="' + (icons[type] || icons.info) + '"></i>' +
                    '<div style="flex:1;"><strong style="display:block;margin-bottom:2px;">' + title + '</strong>' +
                    '<div style="font-size:13px;color:#64748b;">' + message + '</div></div>' +
                    '<button type="button" class="toast-close">&times;</button>';

                container.appendChild(toast);

                var closeBtn = toast.querySelector('.toast-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function () {
                        toast.remove();
                    });
                }

                setTimeout(function () {
                    if (toast.parentNode) {
                        toast.style.animation = 'slideOut 0.3s ease forwards';
                        setTimeout(function () { toast.remove(); }, 300);
                    }
                }, 4000);
            }

            // ============================================================
            // STEP NAVIGATION
            // ============================================================
            function goToStep(step) {
                currentStep = step;
                var deliverySection = document.getElementById('deliverySection');
                var continueBtn = document.getElementById('continueBtn');
                var placeOrderBtn = document.getElementById('placeOrderBtn');

                document.querySelectorAll('.checkout-step').forEach(function (el) {
                    var stepNum = parseInt(el.dataset.step);
                    el.classList.remove('active', 'completed');
                    if (stepNum < step) {
                        el.classList.add('completed');
                    } else if (stepNum === step) {
                        el.classList.add('active');
                    }
                });

                // Only step 1 is visible now
                if (step === 1) {
                    deliverySection.style.display = 'block';
                    continueBtn.style.display = 'block';
                    placeOrderBtn.style.display = 'none';
                }
            }

            window.goToStep = goToStep;

            // ============================================================
            // CONTINUE BUTTON - Show loader for 2s then show Place Order
            // ============================================================
            var continueBtn = document.getElementById('continueBtn');
            if (continueBtn) {
                continueBtn.addEventListener('click', function () {
                    var selectedAddress = document.querySelector('.address-card.selected');
                    if (!selectedAddress) {
                        showToast('error', 'Address Required', 'Please select a delivery address.');
                        return;
                    }

                    // Show loader on continue button
                    var originalText = continueBtn.innerHTML;
                    continueBtn.disabled = true;
                    continueBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

                    // After 2 seconds, hide loader, hide continue button, show place order button
                    setTimeout(function () {
                        continueBtn.style.display = 'none';
                        var placeOrderBtn = document.getElementById('placeOrderBtn');
                        if (placeOrderBtn) {
                            placeOrderBtn.style.display = 'block';
                            placeOrderBtn.disabled = false;
                            // Reset the continue button for future use
                            continueBtn.innerHTML = originalText;
                            continueBtn.disabled = false;
                        }
                        showToast('success', 'Ready to Order', 'Please review and place your order.');
                    }, 2000);
                });
            }

            // ============================================================
            // ADDRESS SELECTION
            // ============================================================
            document.querySelectorAll('.address-card').forEach(function (card) {
                card.addEventListener('click', function (e) {
                    if (e.target.closest('.address-actions')) {
                        return;
                    }
                    document.querySelectorAll('.address-card').forEach(function (item) {
                        item.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    showToast('success', 'Address Selected', 'This address will be used for your delivery.');
                });
            });

            document.querySelectorAll('.select-address-btn').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var card = this.closest('.address-card');
                    if (!card) return;
                    document.querySelectorAll('.address-card').forEach(function (item) {
                        item.classList.remove('selected');
                    });
                    card.classList.add('selected');
                    showToast('success', 'Address Selected', 'This address will be used for your delivery.');
                });
            });

            // ============================================================
            // QUANTITY DROPDOWN
            // ============================================================
            document.querySelectorAll('.cart-item-qty-select').forEach(function (select) {
                select.addEventListener('change', function () {
                    var value = this.value;
                    var cartKey = this.dataset.cartKey;

                    if (value === 'more') {
                        pendingQtyKey = cartKey;
                        var modal = document.getElementById('qtyModal');
                        var input = document.getElementById('qtyInput');
                        if (modal) modal.classList.add('active');
                        if (input) input.value = 1;
                        this.value = 1;
                        return;
                    }

                    updateCartQuantity(cartKey, parseInt(value));
                });
            });

            // ============================================================
            // QUANTITY MODAL
            // ============================================================
            var qtyModal = document.getElementById('qtyModal');
            var qtyInput = document.getElementById('qtyInput');
            var qtyCancelBtn = document.getElementById('qtyCancelBtn');
            var qtyConfirmBtn = document.getElementById('qtyConfirmBtn');

            if (qtyCancelBtn) {
                qtyCancelBtn.addEventListener('click', function () {
                    if (qtyModal) qtyModal.classList.remove('active');
                    pendingQtyKey = null;
                });
            }

            if (qtyConfirmBtn) {
                qtyConfirmBtn.addEventListener('click', function () {
                    var qty = parseInt(qtyInput ? qtyInput.value : 1) || 1;
                    if (qty < 1) qty = 1;

                    if (pendingQtyKey) {
                        updateCartQuantity(pendingQtyKey, qty);

                        var select = document.querySelector('.cart-item-qty-select[data-cart-key="' + pendingQtyKey + '"]');
                        if (select) {
                            var optionExists = false;
                            select.querySelectorAll('option').forEach(function (opt) {
                                if (parseInt(opt.value) === qty) optionExists = true;
                            });
                            if (!optionExists) {
                                var newOption = document.createElement('option');
                                newOption.value = qty;
                                newOption.textContent = qty;
                                select.appendChild(newOption);
                            }
                            select.value = qty;
                        }
                    }

                    if (qtyModal) qtyModal.classList.remove('active');
                    pendingQtyKey = null;
                });
            }

            if (qtyModal) {
                qtyModal.addEventListener('click', function (e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                        pendingQtyKey = null;
                    }
                });
            }

            // ============================================================
            // UPDATE CART QUANTITY
            // ============================================================
            function updateCartQuantity(cartKey, qty) {
                var row = document.querySelector('.cart-item[data-cart-key="' + cartKey + '"]');
                if (!row) return;

                var price = parseFloat(row.dataset.price) || 0;
                var total = price * qty;

                var totalElement = document.getElementById('itemTotal-' + cartKey);
                if (totalElement) {
                    totalElement.textContent = '₹' + total.toLocaleString('en-IN');
                }

                fetch('/cart/update/' + cartKey, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ quantity: qty })
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        if (data.success) {
                            if (data.subtotal !== undefined) updateTotals(data.subtotal);
                            if (data.cart_count !== undefined) updateCartCount(data.cart_count);
                            showToast('success', 'Updated', 'Quantity updated successfully.');
                        } else {
                            showToast('error', 'Error', data.message || 'Failed to update quantity.');
                        }
                    })
                    .catch(function (error) {
                        console.error('Update error:', error);
                        showToast('error', 'Error', 'Something went wrong.');
                    });
            }

            // ============================================================
            // REMOVE CART ITEM
            // ============================================================
            document.querySelectorAll('.remove-cart-btn').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var cartKey = this.dataset.cartKey;
                    var btn = this;
                    var row = this.closest('.cart-item');

                    if (!cartKey) {
                        showToast('error', 'Error', 'Invalid product key.');
                        return;
                    }

                    btn.disabled = true;
                    btn.classList.add('loading');
                    btn.innerHTML = '<i class="bi bi-hourglass-split"></i>';

                    fetch('/cart/remove/' + cartKey, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(function (response) {
                            if (!response.ok) {
                                return response.json().then(function (data) {
                                    throw new Error(data.message || 'Failed to remove item.');
                                });
                            }
                            return response.json();
                        })
                        .then(function (data) {
                            if (data.success) {
                                row.style.transition = 'all 0.3s ease';
                                row.style.opacity = '0';
                                row.style.transform = 'translateX(30px)';

                                setTimeout(function () {
                                    row.remove();
                                    showToast('success', 'Removed', 'Product removed from cart.');

                                    if (data.cart_count !== undefined) updateCartCount(data.cart_count);
                                    if (data.subtotal !== undefined) updateTotals(data.subtotal);

                                    if (document.querySelectorAll('.cart-item').length === 0) {
                                        showToast('info', 'Cart Empty', 'Your cart is empty. Redirecting...');
                                        setTimeout(function () {
                                            window.location.href = "{{ route('customer.products') }}";
                                        }, 800);
                                    }
                                }, 300);
                            } else {
                                showToast('error', 'Error', data.message || 'Failed to remove item.');
                                restoreRemoveButton(btn);
                            }
                        })
                        .catch(function (error) {
                            console.error('Cart remove error:', error);
                            showToast('error', 'Error', error.message || 'Something went wrong.');
                            restoreRemoveButton(btn);
                        });
                });
            });

            function restoreRemoveButton(button) {
                button.disabled = false;
                button.classList.remove('loading');
                button.innerHTML = '<i class="bi bi-trash3"></i>';
            }

            // ============================================================
            // UPDATE TOTALS
            // ============================================================
            function updateCartCount(count) {
                document.querySelectorAll('.checkout-card h5').forEach(function (title) {
                    if (title.textContent.includes('Items in Your Cart')) {
                        title.textContent = 'Items in Your Cart (' + count + ')';
                    }
                });
            }

            function updateTotals(subtotal) {
                var subtotalDisplay = document.getElementById('subtotalDisplay');
                var subtotalDisplay2 = document.getElementById('subtotalDisplay2');
                var totalDisplay = document.getElementById('totalDisplay');
                var formatted = Number(subtotal).toLocaleString('en-IN');
                if (subtotalDisplay) subtotalDisplay.textContent = '₹' + formatted;
                if (subtotalDisplay2) subtotalDisplay2.textContent = '₹' + formatted;
                if (totalDisplay) totalDisplay.textContent = '₹' + formatted;
            }

            // ============================================================
            // PAYMENT METHOD SELECTION IN MODAL
            // ============================================================
            document.querySelectorAll('.payment-method-option').forEach(function (option) {
                option.addEventListener('click', function () {
                    document.querySelectorAll('.payment-method-option').forEach(function (item) {
                        item.style.borderColor = '#e5eaf1';
                        item.style.background = 'transparent';
                    });
                    this.style.borderColor = '#2878f0';
                    this.style.background = '#f8fbff';
                    var radio = this.querySelector('input[type="radio"]');
                    if (radio) radio.checked = true;
                });
            });

            // ============================================================
            // CONFIRMATION MODAL
            // ============================================================
            var confirmModal = document.getElementById('confirmModal');
            var cancelOrderBtn = document.getElementById('cancelOrderBtn');
            var confirmOrderBtn = document.getElementById('confirmOrderBtn');

            function showConfirmModal() {
                console.log('=== SHOWING CONFIRMATION MODAL ===');
                console.log('Current totals from display:');

                var totalEl = document.getElementById('totalDisplay');
                console.log('Total Display:', totalEl ? totalEl.textContent : 'null');

                var subtotalEl = document.getElementById('subtotalDisplay');
                console.log('Subtotal Display:', subtotalEl ? subtotalEl.textContent : 'null');

                var discountEl = document.getElementById('discountDisplay');
                console.log('Discount Display:', discountEl ? discountEl.textContent : 'null');

                var couponRow = document.getElementById('couponDiscountRow');
                console.log('Coupon Row Visible:', couponRow ? couponRow.style.display : 'null');

                var couponCodeInput = document.getElementById('couponCode');
                console.log('Coupon Code Input Value:', couponCodeInput ? couponCodeInput.value : 'null');

                if (confirmModal) {
                    var subtotalEl = document.getElementById('subtotalDisplay');
                    var totalEl = document.getElementById('totalDisplay');
                    var discountEl = document.getElementById('discountDisplay');
                    var couponRow = document.getElementById('couponDiscountRow');

                    var confirmItems = document.getElementById('confirmItems');
                    var confirmSubtotal = document.getElementById('confirmSubtotal');
                    var confirmTotal = document.getElementById('confirmTotal');
                    var confirmDiscount = document.getElementById('confirmDiscount');

                    if (confirmItems) {
                        var itemsCount = document.querySelectorAll('.cart-item').length;
                        confirmItems.textContent = itemsCount;
                    }

                    // Get subtotal
                    if (confirmSubtotal && subtotalEl) {
                        var subtotalText = subtotalEl.textContent.replace(/[₹,\s]/g, '').trim();
                        console.log('Parsed Subtotal:', subtotalText);
                        confirmSubtotal.textContent = '₹' + Number(subtotalText).toLocaleString('en-IN');
                    }

                    // Get total - this already has discount applied
                    if (confirmTotal && totalEl) {
                        var totalText = totalEl.textContent.replace(/[₹,\s]/g, '').trim();
                        console.log('Parsed Total (with discount):', totalText);
                        confirmTotal.textContent = '₹' + Number(totalText).toLocaleString('en-IN');
                    }

                    // Handle discount
                    if (confirmDiscount) {
                        // Check if coupon is applied
                        var couponCodeInput = document.getElementById('couponCode');
                        var isCouponApplied = couponCodeInput && couponCodeInput.value && couponCodeInput.hasAttribute('readonly');

                        console.log('Is coupon applied?', isCouponApplied);

                        if (isCouponApplied && discountEl) {
                            var discountText = discountEl.textContent.replace(/[₹,\-\s]/g, '').trim();
                            console.log('Parsed Discount:', discountText);
                            if (discountText && discountText !== '0') {
                                confirmDiscount.textContent = '- ₹' + Number(discountText).toLocaleString('en-IN');
                                confirmDiscount.style.display = 'block';
                                confirmDiscount.style.color = '#16a34a';
                            } else {
                                confirmDiscount.textContent = '- ₹0';
                                confirmDiscount.style.display = 'block';
                            }
                        } else {
                            confirmDiscount.textContent = '- ₹0';
                            confirmDiscount.style.display = 'block';
                            confirmDiscount.style.color = '#64748b';
                        }
                    }

                    confirmModal.classList.add('active');
                }
            }

            function closeConfirmModal() {
                if (confirmModal) {
                    confirmModal.classList.remove('active');
                }
            }

            if (cancelOrderBtn) {
                cancelOrderBtn.addEventListener('click', function () {
                    closeConfirmModal();
                });
            }

            if (confirmModal) {
                confirmModal.addEventListener('click', function (e) {
                    if (e.target === confirmModal) {
                        closeConfirmModal();
                    }
                });
            }

            // ============================================================
            // PLACE ORDER - Show Confirmation Modal
            // ============================================================
            var placeBtn = document.getElementById('placeOrderBtn');
            if (placeBtn) {
                placeBtn.addEventListener('click', function () {
                    showConfirmModal();
                });
            }

            // ============================================================
            // CONFIRM ORDER - Place the actual order
            // ============================================================
            if (confirmOrderBtn) {
                confirmOrderBtn.addEventListener('click', function () {
                    if (isProcessingOrder) return;

                    var btn = confirmOrderBtn;
                    var cancelBtn = cancelOrderBtn;

                    btn.disabled = true;
                    cancelBtn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

                    var selectedAddress = document.querySelector('.address-card.selected');
                    var addressId = selectedAddress ? selectedAddress.dataset.addressId : null;

                    // Get selected payment method from modal
                    var selectedPaymentRadio = document.querySelector('input[name="modal_payment_method"]:checked');
                    var paymentMethod = selectedPaymentRadio ? selectedPaymentRadio.value : 'online';

                    if (!addressId) {
                        showToast('error', 'Error', 'Please select a delivery address.');
                        btn.disabled = false;
                        cancelBtn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                        return;
                    }

                    // If COD, place order directly
                    if (paymentMethod === 'cod') {
                        placeCodOrder(addressId, btn, cancelBtn);
                    } else {
                        // For online payments - create Razorpay order
                        createRazorpayOrder(addressId, btn, cancelBtn);
                    }
                });
            }

            // ============================================================
            // PLACE COD ORDER
            // ============================================================
            function placeCodOrder(addressId, btn, cancelBtn) {
                console.log('=== PLACING COD ORDER ===');
                console.log('Address ID:', addressId);

                var totalDisplay = document.getElementById('totalDisplay');
                var finalAmount = totalDisplay ? totalDisplay.textContent.replace(/[₹,\s]/g, '').trim() : '0';

                var couponInput = document.getElementById('couponCode');
                var couponCode = couponInput ? couponInput.value : '';

                var orderData = {
                    address_id: addressId,
                    payment_method: 'cod',
                    coupon_code: couponCode,
                    amount: parseFloat(finalAmount) || 0,
                    notes: ''
                };

                fetch('{{ route("checkout.place") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(orderData)
                })
                    .then(function (response) {
                        console.log('COD Response Status:', response.status);
                        return response.json();
                    })
                    .then(function (data) {
                        console.log('COD Response Data:', data);
                        if (data.success) {
                            // Clear localStorage cart after successful order
                            localStorage.removeItem('cart');
                            sessionStorage.removeItem('cart_synced');
                            sessionStorage.setItem('order_placed', 'true');
                            console.log('Cart cleared from localStorage');

                            closeConfirmModal();
                            showToast('success', 'Success!', data.message);
                            setTimeout(function () {
                                window.location.href = data.redirect_url || '{{ route("customer.dashboard") }}';
                            }, 2000);
                        } else {
                            showToast('error', 'Error!', data.message || 'Failed to place order.');
                            btn.disabled = false;
                            cancelBtn.disabled = false;
                            btn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                        }
                    })
                    .catch(function (error) {
                        console.error('❌ COD Order Error:', error);
                        showToast('error', 'Error!', 'Something went wrong. Please try again.');
                        btn.disabled = false;
                        cancelBtn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                    });
            }

            // ============================================================
            // CREATE RAZORPAY ORDER
            // ============================================================
            function createRazorpayOrder(addressId, btn, cancelBtn) {
                console.log('=== CREATE RAZORPAY ORDER ===');
                console.log('Address ID:', addressId);

                isProcessingOrder = true;

                // Get the correct total from the display (already has discount applied)
                var totalDisplay = document.getElementById('totalDisplay');
                var finalTotal = totalDisplay ? totalDisplay.textContent.replace(/[₹,\s]/g, '').trim() : '0';
                console.log('Final Total from display:', finalTotal);

                // Get coupon code if applied
                var couponInput = document.getElementById('couponCode');
                var couponCode = couponInput ? couponInput.value : '';

                // Get subtotal from display
                var subtotalDisplay = document.getElementById('subtotalDisplay');
                var subtotal = subtotalDisplay ? subtotalDisplay.textContent.replace(/[₹,\s]/g, '').trim() : '0';
                console.log('Subtotal from display:', subtotal);

                fetch('{{ route("checkout.create.razorpay.order") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        address_id: addressId,
                        coupon_code: couponCode,
                        final_total: parseFloat(finalTotal) || 0,  // Send the correct total
                        subtotal: parseFloat(subtotal) || 0        // Send the subtotal
                    })
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            console.log('✅ Order created successfully!');
                            closeConfirmModal();
                            openRazorpayCheckout(data, addressId);

                            setTimeout(function () {
                                btn.disabled = false;
                                cancelBtn.disabled = false;
                                btn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                                isProcessingOrder = false;
                            }, 500);
                        } else {
                            console.error('❌ Server returned error:', data.message);
                            showToast('error', 'Error!', data.message || 'Failed to initialize payment.');
                            btn.disabled = false;
                            cancelBtn.disabled = false;
                            btn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                            isProcessingOrder = false;
                        }
                    })
                    .catch(function (error) {
                        console.error('❌ Fetch error:', error);
                        showToast('error', 'Error!', 'Something went wrong. Please try again.');
                        btn.disabled = false;
                        cancelBtn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                        isProcessingOrder = false;
                    });
            }
            // ============================================================
            // OPEN RAZORPAY CHECKOUT
            // ============================================================
            function openRazorpayCheckout(data, addressId) {
                console.log('=== OPENING RAZORPAY CHECKOUT ===');
                console.log('Razorpay Data:', data);
                console.log('Amount from server:', data.amount);
                console.log('Amount in rupees:', data.amount / 100);

                var options = {
                    key: data.key,
                    amount: data.amount, // Amount is in paise
                    currency: data.currency,
                    name: data.name,
                    description: data.description,
                    order_id: data.razorpay_order_id,
                    prefill: {
                        name: data.prefill.name,
                        email: data.prefill.email,
                        contact: data.prefill.contact
                    },
                    notes: data.notes,
                    handler: function (response) {
                        console.log('=== PAYMENT SUCCESSFUL ===');
                        console.log('Payment Response:', response);
                        // Payment successful - verify
                        verifyRazorpayPayment(response, addressId);
                    },
                    modal: {
                        ondismiss: function () {
                            console.log('Payment modal dismissed by user');
                            isProcessingOrder = false;
                            var confirmBtn = document.getElementById('confirmOrderBtn');
                            var cancelBtn = document.getElementById('cancelOrderBtn');
                            if (confirmBtn) {
                                confirmBtn.disabled = false;
                                confirmBtn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                            }
                            if (cancelBtn) {
                                cancelBtn.disabled = false;
                            }
                            showToast('info', 'Payment Cancelled', 'You cancelled the payment. You can try again.');
                        }
                    },
                    theme: {
                        color: '#2878f0'
                    }
                };

                console.log('Razorpay Options:', options);
                var rzp = new Razorpay(options);
                rzp.open();
            }

            // ============================================================
            // VERIFY RAZORPAY PAYMENT
            // ============================================================
            function verifyRazorpayPayment(response, addressId) {
                console.log('=== VERIFYING RAZORPAY PAYMENT ===');
                console.log('Payment Response:', response);
                console.log('Address ID:', addressId);

                var placeBtn = document.getElementById('placeOrderBtn');
                if (placeBtn) {
                    placeBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Verifying...';
                }

                var verificationData = {
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature,
                    address_id: addressId,
                    payment_method: 'razorpay'
                };

                console.log('Verification Data:', verificationData);

                fetch('{{ route("checkout.verify.razorpay") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(verificationData)
                })
                    .then(function (response) {
                        console.log('Verification Response Status:', response.status);
                        return response.json();
                    })
                    .then(function (data) {
                        console.log('Verification Response Data:', data);
                        if (data.success) {
                            localStorage.removeItem('cart');
                            sessionStorage.removeItem('cart_synced');
                            sessionStorage.setItem('order_placed', 'true');
                            console.log('Cart cleared from localStorage after Razorpay payment');
                            showToast('success', 'Payment Success!', data.message);
                            setTimeout(function () {
                                window.location.href = data.redirect_url || '{{ route("customer.dashboard") }}';
                            }, 2000);
                        } else {
                            console.error('❌ Payment Verification Failed:', data.message);
                            showToast('error', 'Payment Failed!', data.message || 'Payment verification failed.');
                            if (placeBtn) {
                                placeBtn.disabled = false;
                                placeBtn.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Place Order';
                            }
                            var confirmBtn = document.getElementById('confirmOrderBtn');
                            if (confirmBtn) {
                                confirmBtn.disabled = false;
                                confirmBtn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error('❌ Verification Error:', error);
                        showToast('error', 'Error!', 'Payment verification failed. Please contact support.');
                        if (placeBtn) {
                            placeBtn.disabled = false;
                            placeBtn.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Place Order';
                        }
                        var confirmBtn = document.getElementById('confirmOrderBtn');
                        if (confirmBtn) {
                            confirmBtn.disabled = false;
                            confirmBtn.innerHTML = '<i class="bi bi-lock-fill me-1"></i> Pay Now';
                        }
                    });
            }

            // ============================================================
            // COUPON APPLY
            // ============================================================
            const couponCodeInput = document.getElementById('couponCode');
            const applyCouponBtn = document.getElementById('applyCouponBtn');
            const totalDisplay = document.getElementById('totalDisplay');
            const discountDisplay = document.getElementById('discountDisplay');
            const couponDiscountRow = document.getElementById('couponDiscountRow');
            const appliedCouponCode = document.getElementById('appliedCouponCode');
            const originalTotal = parseFloat(totalDisplay.dataset.originalTotal) || 0;

            function formatAmount(amount) {
                return new Intl.NumberFormat('en-IN', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                }).format(amount);
            }

            if (applyCouponBtn) {
                applyCouponBtn.addEventListener('click', function () {
                    const couponCode = couponCodeInput.value.trim();

                    if (!couponCode) {
                        showToast('error', 'Coupon Required', 'Please enter a coupon code.');
                        return;
                    }

                    console.log('=== APPLYING COUPON ===');
                    console.log('Coupon Code:', couponCode);

                    applyCouponBtn.disabled = true;
                    applyCouponBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Applying...';

                    fetch("{{ route('checkout.applyCoupon') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            coupon_code: couponCode,
                            order_amount: originalTotal
                        })
                    })
                        .then(response => {
                            console.log('Coupon Response Status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Coupon Response Data:', data);

                            if (data.success) {
                                // Update all displays
                                totalDisplay.textContent = '₹' + formatAmount(data.final_amount);
                                discountDisplay.textContent = '- ₹' + formatAmount(data.discount_amount);
                                couponDiscountRow.style.display = 'flex';
                                couponDiscountRow.style.background = '#f0fdf4';
                                couponDiscountRow.style.padding = '8px 0';
                                appliedCouponCode.textContent = '(' + data.coupon.code + ')';
                                couponCodeInput.value = data.coupon.code;
                                couponCodeInput.setAttribute('readonly', true);
                                applyCouponBtn.innerHTML = 'Applied ✅';
                                applyCouponBtn.classList.remove('btn-outline-primary');
                                applyCouponBtn.classList.add('btn-success');

                                // Update the original total for reference
                                totalDisplay.dataset.originalTotal = data.final_amount;

                                // Show success message
                                showToast('success', 'Coupon Applied!', data.message);

                                console.log('Updated Total:', data.final_amount);
                                console.log('Discount Amount:', data.discount_amount);
                            } else {
                                console.error('Coupon application failed:', data.message);
                                showToast('error', 'Error', data.message || 'Failed to apply coupon.');
                                applyCouponBtn.disabled = false;
                                applyCouponBtn.innerHTML = 'Apply';
                            }
                        })
                        .catch(error => {
                            console.error('❌ Coupon error:', error);
                            showToast('error', 'Coupon Error', error.message || 'Something went wrong while applying the coupon.');
                            applyCouponBtn.disabled = false;
                            applyCouponBtn.innerHTML = 'Apply';
                        });
                });
            }

            // ============================================================
            // ADDRESS MODAL
            // ============================================================
            var addAddressBtn = document.getElementById('addAddressBtn');
            var addressChoiceModal = document.getElementById('addressChoiceModal');
            var closeAddressModal = document.getElementById('closeAddressModal');
            var currentLocationOption = document.getElementById('currentLocationOption');
            var manualAddressOption = document.getElementById('manualAddressOption');
            var addressOptions = document.getElementById('addressOptions');
            var locationResult = document.getElementById('locationResult');
            var locationBackBtn = document.getElementById('locationBackBtn');
            var modalUseLocationBtn = document.getElementById('modalUseLocationBtn');
            var detectedLatitude = null;
            var detectedLongitude = null;
            var detectedLocationData = {
                address: '',
                city: '',
                state: '',
                country: '',
                pincode: ''
            };

            function closeAddressChoiceModal() {
                if (addressChoiceModal) {
                    addressChoiceModal.classList.remove('active');
                }
                if (addressOptions) {
                    addressOptions.style.display = 'block';
                }
                if (locationResult) {
                    locationResult.style.display = 'none';
                }
            }

            if (addAddressBtn) {
                addAddressBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (addressChoiceModal) {
                        addressChoiceModal.classList.add('active');
                    }
                    if (addressOptions) {
                        addressOptions.style.display = 'block';
                    }
                    if (locationResult) {
                        locationResult.style.display = 'none';
                    }
                });
            }

            if (closeAddressModal) {
                closeAddressModal.addEventListener('click', function () {
                    closeAddressChoiceModal();
                });
            }

            if (addressChoiceModal) {
                addressChoiceModal.addEventListener('click', function (e) {
                    if (e.target === addressChoiceModal) {
                        closeAddressChoiceModal();
                    }
                });
            }

            if (manualAddressOption) {
                manualAddressOption.addEventListener('click', function () {
                    window.location.href = "{{ route('account.settings') }}";
                });
            }

            if (currentLocationOption) {
                currentLocationOption.addEventListener('click', function () {
                    if (addressOptions) {
                        addressOptions.style.display = 'none';
                    }
                    if (locationResult) {
                        locationResult.style.display = 'block';
                    }
                    detectCurrentLocation();
                });
            }

            if (locationBackBtn) {
                locationBackBtn.addEventListener('click', function () {
                    if (locationResult) {
                        locationResult.style.display = 'none';
                    }
                    if (addressOptions) {
                        addressOptions.style.display = 'block';
                    }
                });
            }

            function detectCurrentLocation() {
                if (!navigator.geolocation) {
                    showToast('error', 'Location Not Supported', 'Your browser does not support location services.');
                    return;
                }

                var modalStatus = document.getElementById('modalLocationStatus');
                var modalAddress = document.getElementById('modalDetectedAddress');
                var modalUseBtn = document.getElementById('modalUseLocationBtn');

                if (modalStatus) {
                    modalStatus.textContent = 'Finding your current location...';
                }
                if (modalAddress) {
                    modalAddress.textContent = 'Please wait...';
                }
                if (modalUseBtn) {
                    modalUseBtn.disabled = true;
                    modalUseBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Detecting...';
                }

                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        detectedLatitude = position.coords.latitude;
                        detectedLongitude = position.coords.longitude;

                        var modalLat = document.getElementById('modalLatitude');
                        var modalLng = document.getElementById('modalLongitude');
                        var modalCoords = document.getElementById('modalLocationCoordinates');

                        if (modalLat) modalLat.textContent = detectedLatitude.toFixed(7);
                        if (modalLng) modalLng.textContent = detectedLongitude.toFixed(7);
                        if (modalCoords) modalCoords.style.display = 'flex';

                        if (modalStatus) {
                            modalStatus.textContent = 'GPS location detected. Finding address...';
                        }
                        if (modalAddress) {
                            modalAddress.textContent = 'Finding your address...';
                        }

                        var url = 'https://nominatim.openstreetmap.org/reverse' +
                            '?format=jsonv2' +
                            '&lat=' + encodeURIComponent(detectedLatitude) +
                            '&lon=' + encodeURIComponent(detectedLongitude) +
                            '&zoom=18' +
                            '&addressdetails=1';

                        fetch(url, {
                            headers: { 'Accept': 'application/json' }
                        })
                            .then(function (response) { return response.json(); })
                            .then(function (data) {
                                if (data && data.address) {
                                    var address = data.address;
                                    var area = address.suburb || address.neighbourhood || address.quarter || address.residential || address.village || '';
                                    var city = address.city || address.town || address.municipality || address.city_district || address.county || '';
                                    var state = address.state || '';
                                    var country = address.country || '';
                                    var pincode = address.postcode || '';

                                    var parts = [area, city, state, country, pincode].filter(Boolean);
                                    var readableAddress = parts.join(', ') || data.display_name || '';

                                    detectedLocationData = {
                                        address: readableAddress,
                                        city: city,
                                        state: state,
                                        country: country,
                                        pincode: pincode
                                    };

                                    if (modalStatus) {
                                        modalStatus.textContent = 'Address successfully determined.';
                                    }
                                    if (modalAddress) {
                                        modalAddress.textContent = readableAddress;
                                    }
                                    if (modalUseBtn) {
                                        modalUseBtn.disabled = false;
                                        modalUseBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i>Use This Location';
                                    }

                                    showToast('success', 'Location Found', 'Your address has been detected successfully.');
                                } else {
                                    throw new Error('Address could not be determined.');
                                }
                            })
                            .catch(function (error) {
                                if (modalStatus) {
                                    modalStatus.textContent = 'GPS detected but address could not be found.';
                                }
                                if (modalAddress) {
                                    modalAddress.textContent = 'Your GPS location was detected, but we could not determine the address. You can still use the GPS coordinates.';
                                }
                                if (modalUseBtn) {
                                    modalUseBtn.disabled = false;
                                    modalUseBtn.innerHTML = '<i class="bi bi-geo-alt-fill me-1"></i>Use GPS Location';
                                }
                                showToast('info', 'GPS Location', 'GPS detected but address could not be determined. You can still use the GPS coordinates.');
                            });
                    },
                    function (error) {
                        if (error.code === error.PERMISSION_DENIED) {
                            showToast('error', 'Location Permission', 'Please allow location access in your browser.');
                        } else if (error.code === error.POSITION_UNAVAILABLE) {
                            showToast('error', 'Location Unavailable', 'Unable to determine your current location.');
                        } else if (error.code === error.TIMEOUT) {
                            showToast('error', 'Location Timeout', 'Location detection took too long. Please try again.');
                        } else {
                            showToast('error', 'Location Error', 'Unable to detect your current location.');
                        }

                        if (modalUseBtn) {
                            modalUseBtn.disabled = false;
                            modalUseBtn.innerHTML = '<i class="bi bi-geo-alt-fill me-1"></i>Try Again';
                        }
                    }, {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }
                );
            }

            if (modalUseLocationBtn) {
                modalUseLocationBtn.addEventListener('click', function () {
                    if (detectedLatitude !== null && detectedLongitude !== null) {
                        var addressCard = document.querySelector('.address-card.selected');
                        if (addressCard) {
                            addressCard.classList.remove('selected');
                        }

                        var addressList = document.querySelector('.address-list');
                        if (addressList) {
                            var tempCard = document.createElement('div');
                            tempCard.className = 'address-card selected';
                            tempCard.dataset.addressId = 'current_location';
                            tempCard.innerHTML =
                                '<div class="radio-indicator"></div>' +
                                '<div class="address-details">' +
                                '<div class="name">' +
                                'Current Location' +
                                '<span class="badge">GPS</span>' +
                                '<span class="badge badge-default">Selected</span>' +
                                '</div>' +
                                '<div class="address-line">' + (detectedLocationData.address || 'GPS Location') +
                                '</div>' +
                                (detectedLocationData.city ? '<div class="address-line">' + detectedLocationData.city + '</div>' : '') +
                                (detectedLocationData.state ? '<div class="address-line">' + detectedLocationData.state + '</div>' : '') +
                                (detectedLocationData.pincode ? '<div class="address-line">Pincode: ' + detectedLocationData.pincode + '</div>' : '') +
                                '<div class="phone">Lat: ' + detectedLatitude.toFixed(6) + ', Lng: ' + detectedLongitude.toFixed(6) + '</div>' +
                                '</div>' +
                                '<div class="address-tag">Selected</div>';

                            addressList.appendChild(tempCard);

                            document.querySelectorAll('.address-card').forEach(function (card) {
                                if (card !== tempCard) {
                                    card.classList.remove('selected');
                                }
                            });
                        }

                        showToast('success', 'Location Selected', 'Your current location has been set as delivery address.');
                        closeAddressChoiceModal();
                    } else {
                        showToast('error', 'Error', 'Please detect your location first.');
                    }
                });
            }

            console.log('Checkout loaded successfully!');
        });
    </script>
@endsection
