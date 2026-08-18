@extends('layouts.app')

@section('title', 'Order ' . $order->order_number)

@section('content')
    <style>
        .order-header-card,
        .status-card,
        .status-timeline-card {
            border-radius: 12px
        }

        .order-header-card .body {
            padding: 22px 25px
        }

        .order-header-card h4 {
            font-weight: 700;
            color: #172033
        }

        .order-status-badge {
            font-size: 13px;
            padding: 9px 15px
        }

        .status-card {
            border: 1px solid #dbe7f7
        }

        .status-card .body {
            padding: 20px 25px
        }

        .current-status-box {
            display: flex;
            align-items: center;
            gap: 15px
        }

        .status-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #eef5ff;
            color: #2878f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px
        }

        .status-label {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px
        }

        .current-status-box h5 {
            font-weight: 700;
            color: #172033
        }

        .next-status-btn {
            padding: 10px 17px;
            font-weight: 600;
            border-radius: 7px
        }

        .delivered-message {
            color: #168a4a;
            font-weight: 600;
            font-size: 15px
        }

        .delivered-message i {
            margin-right: 5px
        }

        .final-status-message {
            color: #64748b;
            font-weight: 600
        }

        .status-timeline-card .body {
            padding: 25px
        }

        .order-timeline {
            display: flex;
            position: relative;
            justify-content: space-between;
            gap: 10px
        }

        .timeline-item {
            flex: 1;
            text-align: center;
            position: relative;
            min-width: 80px
        }

        .timeline-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            position: relative;
            z-index: 2;
            font-size: 18px
        }

        .timeline-item.completed .timeline-icon {
            background: #2878f0;
            color: #fff
        }

        .timeline-item.current .timeline-icon {
            box-shadow: 0 0 0 5px #eaf3ff
        }

        .timeline-content strong {
            display: block;
            font-size: 12px;
            color: #172033
        }

        .timeline-content span {
            display: block;
            font-size: 11px;
            margin-top: 4px
        }

        .timeline-current {
            color: #2878f0
        }

        .timeline-completed {
            color: #168a4a
        }

        .timeline-pending {
            color: #94a3b8
        }

        .timeline-line {
            height: 2px;
            background: #e2e8f0;
            position: absolute;
            top: 21px;
            left: calc(50% + 21px);
            width: calc(100% - 42px);
            z-index: 1
        }

        .timeline-line.active {
            background: #2878f0
        }

        .additional-status {
            border-top: 1px solid #e5eaf1;
            padding-top: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .additional-status-title {
            font-size: 13px;
            color: #64748b;
            font-weight: 600
        }

        .additional-status-badge {
            padding: 7px 12px;
            border-radius: 20px;
            background: #fff7e6;
            color: #d97706;
            font-size: 12px;
            font-weight: 600
        }

        .order-product-item {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 18px 0;
            border-bottom: 1px solid #e5eaf1
        }

        .order-product-item:first-child {
            padding-top: 0
        }

        .order-product-item:last-child {
            border-bottom: 0;
            padding-bottom: 0
        }

        .product-image {
            width: 80px;
            height: 80px;
            min-width: 80px;
            border: 1px solid #e5eaf1;
            border-radius: 10px;
            overflow: hidden;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .product-image i {
            font-size: 28px;
            color: #94a3b8
        }

        .product-details {
            flex: 1
        }

        .product-details h6 {
            font-weight: 700;
            color: #172033;
            margin-bottom: 5px
        }

        .product-sku,
        .product-quantity {
            font-size: 12px;
            color: #64748b;
            margin-top: 4px
        }

        .product-variants {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 12px;
            color: #64748b;
            margin-top: 5px
        }

        .product-total {
            font-weight: 700;
            color: #172033;
            white-space: nowrap
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: #64748b
        }

        .summary-row strong {
            color: #172033
        }

        .discount-row,
        .discount-row strong {
            color: #168a4a
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #e5eaf1;
            margin-top: 10px;
            padding-top: 16px;
            font-size: 17px;
            color: #172033
        }

        .info-row {
            margin-bottom: 15px
        }

        .info-row:last-child {
            margin-bottom: 0
        }

        .info-label {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 5px
        }

        .info-value {
            font-weight: 600;
            color: #172033;
            word-break: break-word
        }

        .payment-paid {
            color: #168a4a !important
        }

        .payment-pending {
            color: #d97706 !important
        }

        .shipping-address .address-main {
            font-weight: 600;
            color: #172033
        }

        .shipping-address .address-location {
            color: #64748b;
            margin-top: 7px
        }

        @media(max-width:991px) {
            .order-timeline {
                overflow-x: auto;
                padding-bottom: 10px
            }

            .timeline-item {
                min-width: 120px
            }
        }

        @media(max-width:576px) {
            .current-status-box {
                align-items: flex-start
            }

            .order-product-item {
                align-items: flex-start
            }

            .product-total {
                margin-left: auto
            }

            .additional-status {
                display: block
            }

            .additional-status-badge {
                display: inline-block;
                margin-top: 8px
            }
        }
    </style>
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Order Details</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('orders.index') }}">Orders</a>
                            </li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ul>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-arrow-left"></i> Back to Orders
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="zmdi zmdi-check-circle"></i>
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="zmdi zmdi-alert-circle"></i>
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                @php
                    $currentStatus = strtolower($order->order_status ?? 'pending');

                    $statusFlow = [
                        'pending' => 'confirmed',
                        'confirmed' => 'processing',
                        'processing' => 'packed',
                        'packed' => 'shipped',
                        'shipped' => 'out_for_delivery',
                        'out_for_delivery' => 'delivered',
                    ];

                    $statusLabels = [
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'processing' => 'Processing',
                        'packed' => 'Packed',
                        'shipped' => 'Shipped',
                        'out_for_delivery' => 'Out For Delivery',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                        'returned' => 'Returned',
                        'refunded' => 'Refunded',
                    ];

                    $statusIcons = [
                        'pending' => 'zmdi-time',
                        'confirmed' => 'zmdi-check',
                        'processing' => 'zmdi-settings',
                        'packed' => 'zmdi-case',
                        'shipped' => 'zmdi-truck',
                        'out_for_delivery' => 'zmdi-bike',
                        'delivered' => 'zmdi-home',
                        'cancelled' => 'zmdi-close',
                        'returned' => 'zmdi-rotate-left',
                        'refunded' => 'zmdi-money',
                    ];

                    $nextStatus = $statusFlow[$currentStatus] ?? null;
                    $nextStatusLabel = $nextStatus ? $statusLabels[$nextStatus] : null;

                    $statusBadgeClass = match ($currentStatus) {
                        'pending' => 'badge-warning',
                        'confirmed' => 'badge-primary',
                        'processing' => 'badge-info',
                        'packed' => 'badge-info',
                        'shipped' => 'badge-info',
                        'out_for_delivery' => 'badge-primary',
                        'delivered' => 'badge-success',
                        'cancelled' => 'badge-danger',
                        'returned' => 'badge-warning',
                        'refunded' => 'badge-success',
                        default => 'badge-secondary',
                    };

                    $mainStatuses = [
                        'pending',
                        'confirmed',
                        'processing',
                        'packed',
                        'shipped',
                        'out_for_delivery',
                        'delivered',
                    ];

                    $currentIndex = array_search($currentStatus, $mainStatuses);
                    if ($currentIndex === false) {
                        $currentIndex = -1;
                    }
                @endphp

                <div class="row clearfix">

                    <div class="col-lg-12">

                        <div class="card order-header-card">
                            <div class="body">

                                <div class="row align-items-center">

                                    <div class="col-md-8">
                                        <h4 class="mb-1">
                                            Order {{ $order->order_number }}
                                        </h4>
                                        <p class="text-muted mb-0">
                                            Placed on
                                            {{ $order->created_at?->format('d M Y, h:i A') ?? '-' }}
                                        </p>
                                    </div>

                                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                        <span class="badge {{ $statusBadgeClass }} order-status-badge">
                                            <i class="zmdi {{ $statusIcons[$currentStatus] ?? 'zmdi-info' }}"></i>
                                            {{ $statusLabels[$currentStatus] ?? ucfirst($currentStatus) }}
                                        </span>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="card status-card">

                            <div class="body">

                                <div class="row align-items-center">

                                    <div class="col-lg-8 col-md-7">

                                        <div class="current-status-box">

                                            <div class="status-icon">
                                                <i class="zmdi {{ $statusIcons[$currentStatus] ?? 'zmdi-info' }}"></i>
                                            </div>

                                            <div>
                                                <span class="status-label">
                                                    Current Order Status
                                                </span>

                                                <h5 class="mb-0">
                                                    {{ $statusLabels[$currentStatus] ?? ucfirst($currentStatus) }}
                                                </h5>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-4 col-md-5 text-md-right mt-3 mt-md-0">

                                        @if($currentStatus === 'delivered')

                                            <div class="delivered-message">
                                                <i class="zmdi zmdi-check-circle"></i>
                                                Order Delivered
                                            </div>

                                        @elseif(in_array($currentStatus, ['cancelled', 'returned', 'refunded']))

                                            <div class="final-status-message">
                                                <i class="zmdi zmdi-info-outline"></i>
                                                {{ $statusLabels[$currentStatus] }}
                                            </div>

                                        @elseif($nextStatus)

                                                <form action="{{ route('admin.orders.status.update', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-primary next-status-btn">
                                                        <i class="zmdi {{ $statusIcons[$nextStatus] }}"></i>
                                                        Move to {{ $nextStatusLabel }}
                                                    </button>
                                                </form>


                                        @endif

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="card status-timeline-card">

                            <div class="body">

                                <h5 class="mb-4">
                                    <strong>Order</strong> Status Timeline
                                </h5>

                                <div class="order-timeline">

                                    @foreach($mainStatuses as $index => $status)

                                        @php
                                            $isCompleted = $currentIndex >= $index;
                                            $isCurrent = $currentStatus === $status;
                                            $isLast = $index === count($mainStatuses) - 1;
                                        @endphp

                                        <div
                                            class="timeline-item {{ $isCompleted ? 'completed' : '' }} {{ $isCurrent ? 'current' : '' }}">

                                            <div class="timeline-icon">
                                                <i class="zmdi {{ $statusIcons[$status] }}"></i>
                                            </div>

                                            <div class="timeline-content">

                                                <strong>
                                                    {{ $statusLabels[$status] }}
                                                </strong>

                                                @if($isCurrent)
                                                    <span class="timeline-current">
                                                        Current Status
                                                    </span>
                                                @elseif($isCompleted)
                                                    <span class="timeline-completed">
                                                        Completed
                                                    </span>
                                                @else
                                                    <span class="timeline-pending">
                                                        Pending
                                                    </span>
                                                @endif

                                            </div>

                                            @if(!$isLast)
                                                <div class="timeline-line {{ $currentIndex > $index ? 'active' : '' }}"></div>
                                            @endif

                                        </div>

                                    @endforeach

                                </div>

                                @if(in_array($currentStatus, ['cancelled', 'returned', 'refunded']))

                                    <div class="additional-status mt-4">

                                        <div class="additional-status-title">
                                            Additional Status
                                        </div>

                                        <div class="additional-status-badge">
                                            <i class="zmdi {{ $statusIcons[$currentStatus] ?? 'zmdi-info' }}"></i>
                                            {{ $statusLabels[$currentStatus] }}
                                        </div>

                                    </div>

                                @endif

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8">

                        <div class="card">

                            <div class="header">
                                <h2>
                                    <strong>Order</strong> Items
                                    <span class="text-muted">
                                        ({{ $order->items->count() }})
                                    </span>
                                </h2>
                            </div>

                            <div class="body">

                                @forelse($order->items as $item)

                                    @php
                                        $imageValue = $item->image;

                                        if (!$imageValue && $item->product) {
                                            $imageValue = $item->product->image;
                                        }

                                        $images = $imageValue ? array_map('trim', explode(',', $imageValue)) : [];
                                        $firstImage = $images[0] ?? null;

                                        if ($firstImage) {
                                            $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                            $imgUrl = asset($firstImage);
                                        } else {
                                            $imgUrl = null;
                                        }
                                    @endphp

                                    <div class="order-product-item">

                                        <div class="product-image">

                                            @if($imgUrl)
                                                <img src="{{ $imgUrl }}" alt="{{ $item->product_name }}"
                                                    onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                            @else
                                                <i class="zmdi zmdi-image"></i>
                                            @endif

                                        </div>

                                        <div class="product-details">

                                            <h6>
                                                {{ $item->product_name }}
                                            </h6>

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

                                                    <div class="product-variants">

                                                        @foreach($variants as $key => $value)

                                                            <span>
                                                                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                                {{ is_array($value) ? implode(', ', $value) : $value }}
                                                            </span>

                                                        @endforeach

                                                    </div>

                                                @endif

                                            @endif

                                            <div class="product-quantity">
                                                ₹{{ number_format($item->price ?? 0, 2) }}
                                                ×
                                                {{ $item->quantity }}
                                            </div>

                                        </div>

                                        <div class="product-total">
                                            ₹{{ number_format($item->total ?? 0, 2) }}
                                        </div>

                                    </div>

                                @empty

                                    <div class="text-center text-muted py-4">
                                        No items found for this order.
                                    </div>

                                @endforelse

                            </div>

                        </div>

                        <div class="card">

                            <div class="header">
                                <h2>
                                    <i class="zmdi zmdi-pin"></i>
                                    <strong>Shipping</strong> Address
                                </h2>
                            </div>

                            <div class="body">

                                <div class="shipping-address">

                                    <div class="address-main">
                                        {{ $order->shipping_address ?? 'Address not available' }}
                                    </div>

                                    <div class="address-location">

                                        {{ collect([
        $order->shipping_city,
        $order->shipping_state,
        $order->shipping_country,
        $order->shipping_pincode
    ])->filter()->implode(', ') }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        @if($order->notes)

                            <div class="card">

                                <div class="header">
                                    <h2>
                                        <strong>Order</strong> Notes
                                    </h2>
                                </div>

                                <div class="body">

                                    <p class="mb-0 text-muted">
                                        {{ $order->notes }}
                                    </p>

                                </div>

                            </div>

                        @endif

                    </div>

                    <div class="col-lg-4">

                        <div class="card">

                            <div class="header">
                                <h2>
                                    <strong>Order</strong> Summary
                                </h2>
                            </div>

                            <div class="body">

                                <div class="summary-row">
                                    <span>Subtotal</span>
                                    <strong>
                                        ₹{{ number_format($order->subtotal ?? 0, 2) }}
                                    </strong>
                                </div>

                                @if(($order->discount ?? 0) > 0)

                                    <div class="summary-row discount-row">
                                        <span>Discount</span>
                                        <strong>
                                            - ₹{{ number_format($order->discount, 2) }}
                                        </strong>
                                    </div>

                                @endif

                                <div class="summary-row">
                                    <span>Shipping</span>
                                    <strong>
                                        @if(($order->shipping ?? 0) > 0)
                                            ₹{{ number_format($order->shipping, 2) }}
                                        @else
                                            Free
                                        @endif
                                    </strong>
                                </div>

                                <div class="summary-total">
                                    <span>Total</span>
                                    <strong>
                                        ₹{{ number_format($order->total ?? 0, 2) }}
                                    </strong>
                                </div>

                            </div>

                        </div>

                        <div class="card">

                            <div class="header">
                                <h2>
                                    <strong>Payment</strong> Details
                                </h2>
                            </div>

                            <div class="body">

                                <div class="info-row">
                                    <div class="info-label">
                                        Payment Method
                                    </div>

                                    <div class="info-value text-uppercase">
                                        {{ str_replace('_', ' ', $order->payment_method ?? 'N/A') }}
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-label">
                                        Payment Status
                                    </div>

                                    @php
                                        $paymentStatus = strtolower($order->payment_status ?? 'pending');
                                    @endphp

                                    <div
                                        class="info-value {{ $paymentStatus === 'paid' ? 'payment-paid' : 'payment-pending' }}">
                                        {{ ucfirst($paymentStatus) }}
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

                        @if($order->user)

                            <div class="card">

                                <div class="header">
                                    <h2>
                                        <strong>Customer</strong> Details
                                    </h2>
                                </div>

                                <div class="body">

                                    <div class="info-row">
                                        <div class="info-label">Name</div>
                                        <div class="info-value">
                                            {{ $order->user->name }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Email</div>
                                        <div class="info-value">
                                            {{ $order->user->email ?? '-' }}
                                        </div>
                                    </div>

                                    @if($order->user->mobile)

                                        <div class="info-row">
                                            <div class="info-label">Mobile</div>
                                            <div class="info-value">
                                                {{ $order->user->mobile }}
                                            </div>
                                        </div>

                                    @endif

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

