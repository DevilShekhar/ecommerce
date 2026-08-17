@extends('frontend.layouts.customer-layout')

@section('title', 'Checkout - ShopEase')

@section('styles')
<style>
    .section-card{background:#fff;border-radius:14px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.04)}
    .section-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
    .section-header h5{margin:0;font-weight:700;color:#0f172a}
    .section-header small{color:#64748b}
    .checkout-title{font-size:24px;font-weight:700;color:#0f172a;margin-bottom:5px}
    .checkout-subtitle{color:#64748b;font-size:14px}
    .checkout-product{display:flex;align-items:center;gap:18px;padding:18px 0;border-bottom:1px solid #eef2f7}
    .checkout-product:last-child{border-bottom:none}
    .checkout-product-img{width:90px;height:90px;background:#f8fafc;border-radius:10px;overflow:hidden;flex-shrink:0}
    .checkout-product-img img{width:100%;height:100%;object-fit:cover}
    .checkout-product-info{flex:1}
    .checkout-product-info h6{font-size:15px;font-weight:600;color:#0f172a;margin-bottom:7px}
    .checkout-product-info .quantity{color:#64748b;font-size:13px}
    .checkout-product-price{font-size:16px;font-weight:700;color:#0f172a;white-space:nowrap}
    .summary-card{background:#fff;border-radius:14px;padding:24px;box-shadow:0 2px 12px rgba(0,0,0,0.04);position:sticky;top:100px}
    .summary-card h5{color:#0f172a;font-weight:700;margin-bottom:20px}
    .summary-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;font-size:14px;color:#475569}
    .summary-row strong{color:#0f172a}
    .free-shipping{color:#16a34a;font-weight:600}
    .summary-total{display:flex;justify-content:space-between;align-items:center;padding-top:16px;border-top:1px solid #e5e7eb}
    .summary-total span{font-size:16px;font-weight:700;color:#0f172a}
    .summary-total strong{font-size:20px;font-weight:700;color:#3b82f6}
    .payment-btn{width:100%;background:#3b82f6;border-color:#3b82f6;padding:12px;border-radius:8px;font-weight:600;margin-top:20px}
    .payment-btn:hover{background:#2563eb;border-color:#2563eb}
    .delivery-box{background:#f8fafc;border:1px solid #e5e7eb;border-radius:10px;padding:16px;margin-top:20px}
    .delivery-box i{color:#3b82f6;font-size:20px}
    .delivery-box strong{color:#0f172a;font-size:14px}
    .delivery-box small{display:block;color:#64748b;margin-top:3px}
    .empty-cart{text-align:center;padding:70px 20px}
    .empty-cart i{font-size:65px;color:#e2e8f0;margin-bottom:18px}
    .empty-cart h4{color:#0f172a;font-weight:700}
    .empty-cart p{color:#64748b}
    @media(max-width:991px){.summary-card{position:static;margin-top:20px}}
    @media(max-width:767px){.section-card{padding:16px}.checkout-product{gap:12px}.checkout-product-img{width:70px;height:70px}}
    @media(max-width:575px){.checkout-product-info h6{font-size:13px}.checkout-product-price{font-size:14px}}
</style>
@endsection

@section('content')
<!-- CHECKOUT HEADER -->
<div class="section-card mb-4">
    <div class="section-header mb-0">
        <div>
            <h4 class="checkout-title">
                <i class="bi bi-cart-check me-2 text-primary"></i>
                Checkout
            </h4>
            <small class="checkout-subtitle">Review your products and complete your order.</small>
        </div>
        <a href="{{ route('customer.products') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Continue Shopping
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
</div>
@endif

@if(!empty($cart) && count($cart) > 0)
<div class="row g-4">
    <!-- PRODUCTS -->
    <div class="col-lg-8">
        <div class="section-card">
            <div class="section-header">
                <div>
                    <h5>Your Products</h5>
                    <small>{{ $cartCount ?? 0 }} {{ ($cartCount ?? 0) == 1 ? 'item' : 'items' }} in your cart</small>
                </div>
            </div>

            @foreach($cart as $item)
            <div class="checkout-product">
                <!-- PRODUCT IMAGE -->
                <div class="checkout-product-img">
                    @php
                        $images = $item['image'] ? array_map('trim', explode(',', $item['image'])) : [];
                        $firstImage = $images[0] ?? null;
                        if ($firstImage) {
                            $firstImage = preg_replace('#^storage/#', '', $firstImage);
                            $imgUrl = asset($firstImage);
                        } else {
                            $imgUrl = null;
                        }
                    @endphp

                    @if($imgUrl)
                        <img src="{{ $imgUrl }}" alt="{{ $item['name'] }}" onerror="this.src='{{ asset('images/placeholder.png') }}'">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-image text-muted fs-3"></i>
                        </div>
                    @endif
                </div>

                <!-- PRODUCT DETAILS -->
                <div class="checkout-product-info">
                    <h6>{{ $item['name'] }}</h6>
                    <div class="quantity">Quantity: <strong>{{ $item['quantity'] }}</strong></div>
                    <div class="mt-1">
                        <small class="text-muted">₹{{ number_format($item['price'], 0) }} per item</small>
                    </div>
                </div>

                <!-- PRODUCT TOTAL -->
                <div class="checkout-product-price">
                    ₹{{ number_format($item['price'] * $item['quantity'], 0) }}
                </div>
            </div>
            @endforeach

            <!-- DELIVERY -->
            <div class="delivery-box">
                <div class="d-flex align-items-center">
                    <i class="bi bi-truck me-3"></i>
                    <div>
                        <strong>Free Delivery</strong>
                        <small>Free shipping on orders above ₹999</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ORDER SUMMARY -->
    <div class="col-lg-4">
        <div class="summary-card">
            <h5>Order Summary</h5>

            <!-- SUBTOTAL -->
            <div class="summary-row">
                <span>Subtotal</span>
                <strong>₹{{ number_format($subtotal, 0) }}</strong>
            </div>

            <!-- SHIPPING -->
            <div class="summary-row">
                <span>Shipping</span>
                <span class="free-shipping">FREE</span>
            </div>

            <!-- DISCOUNT -->
            <div class="summary-row">
                <span>Discount</span>
                <span>₹0</span>
            </div>

            <!-- COUPON -->
            <div class="mt-3 mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Coupon code">
                    <button class="btn btn-outline-primary">Apply</button>
                </div>
            </div>

            <!-- TOTAL -->
            <div class="summary-total">
                <span>Total</span>
                <strong>₹{{ number_format($subtotal, 0) }}</strong>
            </div>

            <!-- PAYMENT -->
            <button class="btn btn-primary payment-btn" id="placeOrderBtn">
                <i class="bi bi-lock-fill me-2"></i>Proceed to Payment
            </button>

            <div class="text-center mt-3">
                <small class="text-muted">
                    <i class="bi bi-shield-check me-1"></i>Secure & encrypted checkout
                </small>
            </div>
        </div>
    </div>
</div>
@else
<div class="section-card">
    <div class="empty-cart">
        <i class="bi bi-cart-x"></i>
        <h4>Your Cart is Empty</h4>
        <p>Looks like you haven't added any items to your cart yet.</p>
        <a href="{{ route('shop') }}" class="btn btn-primary mt-2"><i class="bi bi-cart"></i>Start Shopping</a>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Place order button
    const placeOrderBtn = document.getElementById('placeOrderBtn');
    if (placeOrderBtn) {
        placeOrderBtn.addEventListener('click', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

            fetch('{{ route("checkout.place") }}', {
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
                    showToast('success', 'Success!', data.message);
                    setTimeout(() => {
                        window.location.href = '{{ route("customer.dashboard") }}';
                    }, 2000);
                } else {
                    showToast('error', 'Error!', data.message);
                    this.disabled = false;
                    this.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Proceed to Payment';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Error!', 'Something went wrong. Please try again.');
                this.disabled = false;
                this.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Proceed to Payment';
            });
        });
    }

    // Toast notification system
    function showToast(type, title, message) {
        const container = document.createElement('div');
        container.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999';
        document.body.appendChild(container);

        const toast = document.createElement('div');
        const bgColor = type === 'success' ? '#22c55e' : '#ef4444';
        toast.style.cssText = `
            background:#fff;border-left:4px solid ${bgColor};border-radius:8px;
            padding:16px 24px;box-shadow:0 4px 12px rgba(0,0,0,0.15);
            margin-bottom:10px;display:flex;align-items:center;gap:12px;
            min-width:280px;animation:slideIn 0.3s ease
        `;
        toast.innerHTML = `
            <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-x-circle-fill'}" style="color:${bgColor};font-size:20px;"></i>
            <div>
                <strong>${title}</strong>
                <div style="font-size:14px;color:#64748b;margin-top:2px">${message}</div>
            </div>
            <button style="background:none;border:none;font-size:18px;color:#94a3b8;cursor:pointer;margin-left:auto">&times;</button>
        `;
        container.appendChild(toast);

        toast.querySelector('button').addEventListener('click', function() {
            toast.remove();
        });

        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn{from{transform:translateX(100%);opacity:0}to{transform:translateX(0);opacity:1}}
        @keyframes slideOut{from{transform:translateX(0);opacity:1}to{transform:translateX(100%);opacity:0}}
    `;
    document.head.appendChild(style);
});
</script>
@endsection
