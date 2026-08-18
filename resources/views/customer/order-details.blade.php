@extends('frontend.layouts.customer-layout')

@section('title', 'Order ' . $order->order_number . ' - ShopEase')

@section('styles')
    <style>
        :root {
            --primary: #2878f0;
            --text: #172033;
            --muted: #64748b;
            --border: #e5eaf1;
            --bg: #f6f8fc;
        }

        .order-details-page {
            padding: 30px 0 60px;
            background: var(--bg);
            min-height: 100vh;
        }

        .back-btn {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 20px;
        }

        .back-btn:hover {
            color: var(--primary);
        }

        .order-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .order-top h2 {
            font-size: 25px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }

        .order-top p {
            color: var(--muted);
            margin: 0;
        }

        .order-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 20px;
        }

        .product-item {
            display: flex;
            gap: 15px;
            padding-bottom: 18px;
            margin-bottom: 18px;
            border-bottom: 1px solid var(--border);
        }

        .product-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .product-image {
            width: 80px;
            height: 80px;
            min-width: 80px;
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image i {
            font-size: 28px;
            color: #94a3b8;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }

        .product-sku {
            color: var(--muted);
            font-size: 13px;
        }

        .product-price {
            text-align: right;
            font-weight: 700;
            color: var(--text);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: var(--muted);
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            padding-top: 15px;
            margin-top: 8px;
            border-top: 1px solid var(--border);
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
        }

        .info-row {
            margin-bottom: 13px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .info-value {
            color: var(--text);
            font-weight: 600;
        }

        .payment-paid {
            color: #168a4a;
        }

        .payment-pending {
            color: #d97706;
        }

        @media(max-width: 576px) {
            .product-price {
                text-align: left;
            }

            .product-item {
                flex-wrap: wrap;
            }
        }
    </style>
@endsection

@section('content')

    <div class="order-details-page">
        <div class="container">

            <a href="{{ route('customer.orders.index') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Back to My Orders
            </a>

            <div class="order-top">

                <div>
                    <h2>Order {{ $order->order_number }}</h2>

                    <p>
                        Placed on
                        {{ $order->created_at?->format('d M Y, h:i A') }}
                    </p>
                </div>

                <div>
                    <span class="badge bg-primary px-3 py-2 text-capitalize">
                        {{ $order->order_status }}
                    </span>
                </div>

            </div>

            <div class="row">

                {{-- LEFT --}}
                <div class="col-lg-8">

                    {{-- ORDER ITEMS --}}
                    <div class="order-card">

                        <h5 class="card-title">
                            Order Items ({{ $order->items->count() }})
                        </h5>

                        @foreach($order->items as $item)

                            <div class="product-item">

                                @php
                                    $imageValue = $item->image;

                                    if (!$imageValue && $item->product) {
                                        $imageValue = $item->product->image;
                                    }

                                    $images = $imageValue
                                        ? array_map('trim', explode(',', $imageValue))
                                        : [];

                                    $firstImage = $images[0] ?? null;

                                    if ($firstImage) {
                                        $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                        $imgUrl = asset($firstImage);
                                    } else {
                                        $imgUrl = null;
                                    }
                                @endphp

                                <div class="product-image">

                                    @if($imgUrl)
                                        <img
                                            src="{{ $imgUrl }}"
                                            alt="{{ $item->product_name }}"
                                            onerror="this.src='{{ asset('images/placeholder.png') }}'"
                                        >
                                    @else
                                        <i class="bi bi-image"></i>
                                    @endif

                                </div>

                                <div class="product-info">

                                    <div class="product-name">
                                        {{ $item->product_name }}
                                    </div>

                                    @if($item->sku)
                                        <div class="product-sku">
                                            SKU: {{ $item->sku }}
                                        </div>
                                    @endif

                                    @if(!empty($item->variants))
                                        @php
                                            $variants = $item->variants;

                                            if (is_string($variants)) {
                                                $variants = json_decode($variants, true);
                                            }
                                        @endphp

                                        @if(is_array($variants) && count($variants))
                                            <div class="product-sku mt-1">
                                                @foreach($variants as $key => $value)
                                                    <span class="me-2">
                                                        <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                        {{ is_array($value) ? implode(', ', $value) : $value }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif

                                    <div class="product-sku mt-2">
                                        ₹{{ number_format($item->price, 2) }}
                                        ×
                                        {{ $item->quantity }}
                                    </div>

                                </div>

                                <div class="product-price">
                                    ₹{{ number_format($item->total, 2) }}
                                </div>

                            </div>

                        @endforeach

                    </div>

                    {{-- SHIPPING ADDRESS --}}
                    <div class="order-card">

                        <h5 class="card-title">
                            <i class="bi bi-geo-alt me-2"></i>
                            Shipping Address
                        </h5>

                        <div class="info-value">
                            {{ $order->shipping_address ?? 'Address not available' }}
                        </div>

                        <div class="mt-2 text-muted">

                            {{ collect([
                                $order->shipping_city,
                                $order->shipping_state,
                                $order->shipping_country,
                                $order->shipping_pincode
                            ])->filter()->implode(', ') }}

                        </div>

                    </div>

                    {{-- NOTES --}}
                    @if($order->notes)

                        <div class="order-card">

                            <h5 class="card-title">
                                Order Notes
                            </h5>

                            <p class="mb-0 text-muted">
                                {{ $order->notes }}
                            </p>

                        </div>

                    @endif

                </div>

                {{-- RIGHT --}}
                <div class="col-lg-4">

                    {{-- ORDER SUMMARY --}}
                    <div class="order-card">

                        <h5 class="card-title">
                            Order Summary
                        </h5>

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>

                        @if($order->discount > 0)
                            <div class="summary-row text-success">
                                <span>Discount</span>
                                <span>- ₹{{ number_format($order->discount, 2) }}</span>
                            </div>
                        @endif

                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>
                                @if($order->shipping > 0)
                                    ₹{{ number_format($order->shipping, 2) }}
                                @else
                                    Free
                                @endif
                            </span>
                        </div>

                        <div class="summary-total">
                            <span>Total</span>
                            <strong>₹{{ number_format($order->total, 2) }}</strong>
                        </div>

                    </div>

                    {{-- PAYMENT --}}
                    <div class="order-card">

                        <h5 class="card-title">
                            Payment Details
                        </h5>

                        <div class="info-row">
                            <div class="info-label">Payment Method</div>
                            <div class="info-value text-uppercase">
                                {{ str_replace('_', ' ', $order->payment_method ?? 'N/A') }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Payment Status</div>

                            <div class="info-value
                                {{ strtolower($order->payment_status) === 'paid'
        ? 'payment-paid'
        : 'payment-pending' }}">

                                {{ ucfirst($order->payment_status) }}

                            </div>
                        </div>

                        @if($order->razorpay_payment_id)

                            <div class="info-row">
                                <div class="info-label">
                                    Razorpay Payment ID
                                </div>

                                <div class="info-value">
                                    {{ $order->razorpay_payment_id }}
                                </div>
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection
