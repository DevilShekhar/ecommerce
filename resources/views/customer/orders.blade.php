@extends('frontend.layouts.customer-layout')

@section('title', 'My Orders - ShopEase')

@section('styles')
    <style>
        :root {
            --primary: #2878f0;
            --primary-dark: #1765d1;
            --text: #172033;
            --muted: #64748b;
            --border: #e5eaf1;
            --bg: #f6f8fc;
        }

        .orders-page {
            padding: 30px 0 60px;
            background: var(--bg);
            min-height: 100vh;
        }

        .orders-header {
            margin-bottom: 24px;
        }

        .orders-header h2 {
            font-size: 25px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }

        .orders-header p {
            color: var(--muted);
            margin: 0;
        }

        .orders-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .order-row {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .order-row:last-child {
            border-bottom: 0;
        }

        .order-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border-radius: 12px;
            background: #eef5ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .order-main {
            flex: 1;
            min-width: 200px;
        }

        .order-number {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }

        .order-date {
            font-size: 13px;
            color: var(--muted);
        }

        .order-meta {
            display: flex;
            gap: 35px;
            align-items: center;
            flex-wrap: wrap;
        }

        .order-meta-label {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .order-meta-value {
            font-weight: 700;
            color: var(--text);
        }

        .status-badge {
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fff7e6;
            color: #d97706;
        }

        .status-paid,
        .status-delivered,
        .status-completed {
            background: #eafaf1;
            color: #168a4a;
        }

        .status-processing,
        .status-shipped {
            background: #eaf3ff;
            color: #2878f0;
        }

        .status-cancelled,
        .status-failed {
            background: #fff0f0;
            color: #dc3545;
        }

        .order-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .view-order-btn,
        .track-order-btn {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: transparent;
            border-radius: 9px;
            padding: 9px 15px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .view-order-btn:hover,
        .track-order-btn:hover {
            background: var(--primary);
            color: #fff;
            text-decoration: none;
        }

        .empty-orders {
            text-align: center;
            padding: 70px 20px;
        }

        .empty-orders i {
            font-size: 55px;
            color: #cbd5e1;
        }

        .empty-orders h4 {
            margin-top: 15px;
            font-weight: 700;
        }

        .empty-orders p {
            color: var(--muted);
        }

        .track-modal {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
        }

        .track-modal .modal-header {
            border-bottom: 1px solid var(--border);
            padding: 20px 24px;
        }

        .track-modal .modal-title {
            font-weight: 700;
            color: var(--text);
            margin-bottom: 3px;
        }

        .track-modal .modal-header small {
            color: var(--muted);
        }

        .track-modal .modal-body {
            padding: 24px;
        }

        .tracking-timeline {
            position: relative;
            padding-left: 8px;
        }

        .tracking-step {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            min-height: 72px;
        }

        .tracking-step:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 19px;
            top: 40px;
            width: 2px;
            height: 45px;
            background: var(--border);
        }

        .tracking-step.completed:not(:last-child)::before {
            background: var(--primary);
        }

        .tracking-step-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .tracking-step.completed .tracking-step-icon {
            background: #eaf3ff;
            color: var(--primary);
        }

        .tracking-step.current .tracking-step-icon {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 0 0 5px rgba(40, 120, 240, .12);
        }

        .tracking-step-content {
            padding-top: 3px;
        }

        .tracking-step-content strong {
            display: block;
            color: var(--text);
            font-size: 14px;
            margin-bottom: 3px;
        }

        .tracking-step-content span {
            font-size: 12px;
            color: var(--muted);
        }

        .tracking-step.current .tracking-step-content span {
            color: var(--primary);
            font-weight: 600;
        }

        .tracking-order-info {
            margin-top: 15px;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 12px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .tracking-order-info span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 4px;
        }

        .tracking-order-info strong {
            color: var(--text);
            font-size: 13px;
        }

        .tracking-cancelled {
            text-align: center;
            padding: 25px 15px;
        }

        .tracking-status-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #fff0f0;
            color: #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .tracking-cancelled h5 {
            font-weight: 700;
            color: var(--text);
        }

        .tracking-cancelled p {
            color: var(--muted);
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .order-meta {
                gap: 18px;
            }

            .order-row {
                align-items: flex-start;
            }

            .order-actions {
                width: 100%;
            }

            .view-order-btn,
            .track-order-btn {
                flex: 1;
                justify-content: center;
            }

            .tracking-order-info {
                grid-template-columns: 1fr;
            }
        }

        .track-order-btn {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: #fff;
            border-radius: 9px;
            padding: 9px 15px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .track-order-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        .track-popup {
            display: none;
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, .65);
            z-index: 99999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .track-popup.show {
            display: flex;
        }

        .track-popup-content {
            width: 100%;
            max-width: 620px;
            max-height: 90vh;
            overflow-y: auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .2);
            animation: trackPopupIn .2s ease;
        }

        @keyframes trackPopupIn {
            from {
                opacity: 0;
                transform: translateY(15px) scale(.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .track-popup-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .track-popup-header h4 {
            margin: 0 0 4px;
            color: var(--text);
            font-weight: 700;
        }

        .track-popup-header span {
            color: var(--muted);
            font-size: 13px;
        }

        .track-popup-close {
            width: 38px;
            height: 38px;
            border: 0;
            background: #f1f5f9;
            color: #475569;
            border-radius: 50%;
            font-size: 25px;
            line-height: 1;
            cursor: pointer;
        }

        .track-popup-close:hover {
            background: #e2e8f0;
        }

        .track-popup-body {
            padding: 25px;
        }

        .tracking-timeline {
            margin-bottom: 25px;
        }

        .tracking-item {
            display: flex;
            gap: 15px;
            min-height: 82px;
        }

        .tracking-line-wrapper {
            width: 42px;
            min-width: 42px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tracking-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            position: relative;
            z-index: 2;
        }

        .tracking-line {
            width: 2px;
            flex: 1;
            min-height: 35px;
            background: #e2e8f0;
        }

        .tracking-item.completed .tracking-icon {
            background: #eaf3ff;
            color: var(--primary);
        }

        .tracking-item.completed .tracking-line {
            background: var(--primary);
        }

        .tracking-item.current .tracking-icon {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 0 0 5px rgba(40, 120, 240, .12);
        }

        .tracking-info {
            padding-top: 2px;
        }

        .tracking-info h5 {
            margin: 0 0 5px;
            color: var(--text);
            font-size: 15px;
            font-weight: 700;
        }

        .tracking-info p {
            margin: 0 0 5px;
            color: var(--muted);
            font-size: 13px;
        }

        .tracking-info small {
            color: #94a3b8;
            font-size: 11px;
        }

        .tracking-item.completed .tracking-info small {
            color: #168a4a;
        }

        .tracking-item.current .tracking-info small {
            color: var(--primary);
            font-weight: 600;
        }

        .tracking-current {
            display: inline-block;
            margin-left: 7px;
            padding: 3px 7px;
            border-radius: 10px;
            background: #eaf3ff;
            color: var(--primary);
            font-size: 10px;
            vertical-align: middle;
        }

        .tracking-summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .tracking-summary-item {
            padding: 8px;
        }

        .tracking-summary-item span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 4px;
        }

        .tracking-summary-item strong {
            color: var(--text);
            font-size: 13px;
            word-break: break-word;
        }

        .track-popup-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .tracking-cancelled {
            text-align: center;
            padding: 30px 15px;
        }

        .tracking-cancelled-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #fff0f0;
            color: #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .tracking-cancelled h4 {
            color: var(--text);
            font-weight: 700;
        }

        .tracking-cancelled p {
            color: var(--muted);
        }

        body.track-popup-open {
            overflow: hidden;
        }

        @media (max-width: 576px) {
            .track-popup {
                padding: 10px;
            }

            .track-popup-content {
                max-height: 94vh;
            }

            .track-popup-body {
                padding: 18px;
            }

            .tracking-summary {
                grid-template-columns: 1fr;
            }

            .track-popup-footer {
                padding: 14px 18px;
                flex-direction: column;
            }

            .track-popup-footer .btn {
                width: 100%;
            }
        }
    </style>
@endsection

@section('content')
    <div class="orders-page">
        <div class="container">
            <div class="orders-header">
                <h2>My Orders</h2>
                <p>View and track all your orders.</p>
            </div>
            <div class="orders-card">
                @forelse($orders as $order)
                    @php
                        $trackingStatus = strtolower($order->order_status ?? 'pending');
                        $statusClass = match ($trackingStatus) {
                            'processing', 'shipped' => 'status-processing',
                            'delivered', 'completed' => 'status-delivered',
                            'cancelled', 'failed' => 'status-cancelled',
                            default => 'status-pending',
                        };
                        if ($trackingStatus === 'completed') {
                            $trackingStatus = 'delivered';
                        }
                        $steps = [
                            'pending' => [
                                'title' => 'Order Placed',
                                'icon' => 'bi-bag-check',
                            ],
                            'processing' => [
                                'title' => 'Processing',
                                'icon' => 'bi-box-seam',
                            ],
                            'shipped' => [
                                'title' => 'Shipped',
                                'icon' => 'bi-truck',
                            ],
                            'delivered' => [
                                'title' => 'Delivered',
                                'icon' => 'bi-house-check',
                            ],
                        ];
                        $statusOrder = [
                            'pending' => 1,
                            'processing' => 2,
                            'shipped' => 3,
                            'delivered' => 4,
                        ];
                        $currentStep = $statusOrder[$trackingStatus] ?? 1;
                    @endphp
                    <div class="order-row">
                        <div class="order-icon">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <div class="order-main">
                            <div class="order-number">
                                {{ $order->order_number }}
                            </div>
                            <div class="order-date">
                                Ordered on {{ $order->created_at?->format('d M Y, h:i A') }}
                            </div>
                        </div>
                        <div class="order-meta">
                            <div>
                                <div class="order-meta-label">Items</div>
                                <div class="order-meta-value">
                                    {{ $order->items_count }}
                                </div>
                            </div>
                            <div>
                                <div class="order-meta-label">Total</div>
                                <div class="order-meta-value">
                                    ₹{{ number_format($order->total ?? 0, 2) }}
                                </div>
                            </div>
                            <div>
                                <div class="order-meta-label">Status</div>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $order->order_status ?? 'Pending' }}
                                </span>
                            </div>
                        </div>
                        <div class="order-actions">
                             @if(auth()->user()->role?->name === 'Super Admin')
                            <a href="{{ route('customer.orders.show', $order->id) }}" class="view-order-btn">
                                <i class="bi bi-eye"></i>
                                View Details
                            </a>
                            @endif
                            @if(auth()->user()->role?->name === 'customer')
                                <button type="button" class="track-order-btn" onclick="openTrackOrderModal({{ $order->id }})">
                                    <i class="bi bi-truck"></i>
                                    Track Order
                                </button>
                            @endif
                        </div>
                    </div>
                    @if(auth()->user()->role?->name === 'customer')
                        <div class="track-popup" id="trackOrderPopup{{ $order->id }}"
                            onclick="closeTrackOrderOnOverlay(event, {{ $order->id }})">

                            <div class="track-popup-content">

                                <div class="track-popup-header">
                                    <div>
                                        <h4>Track Order</h4>
                                        <span>{{ $order->order_number }}</span>
                                    </div>

                                    <button type="button" class="track-popup-close"
                                        onclick="closeTrackOrderModal({{ $order->id }})">
                                        &times;
                                    </button>
                                </div>

                                <div class="track-popup-body">

                                    @php
                                        $trackingStatus = strtolower($order->order_status ?? 'pending');

                                        if ($trackingStatus === 'completed') {
                                            $trackingStatus = 'delivered';
                                        }

                                        $steps = [
                                            'pending' => [
                                                'title' => 'Order Placed',
                                                'description' => 'Your order has been successfully placed.',
                                                'icon' => 'bi-bag-check'
                                            ],
                                            'processing' => [
                                                'title' => 'Processing',
                                                'description' => 'Your order is being prepared.',
                                                'icon' => 'bi-box-seam'
                                            ],
                                            'shipped' => [
                                                'title' => 'Shipped',
                                                'description' => 'Your order has been shipped.',
                                                'icon' => 'bi-truck'
                                            ],
                                            'delivered' => [
                                                'title' => 'Delivered',
                                                'description' => 'Your order has been delivered.',
                                                'icon' => 'bi-house-check'
                                            ]
                                        ];

                                        $statusOrder = [
                                            'pending' => 1,
                                            'processing' => 2,
                                            'shipped' => 3,
                                            'delivered' => 4
                                        ];

                                        $currentStep = $statusOrder[$trackingStatus] ?? 1;
                                    @endphp

                                    @if(in_array($trackingStatus, ['cancelled', 'failed']))

                                        <div class="tracking-cancelled">
                                            <div class="tracking-cancelled-icon">
                                                <i class="bi bi-x-circle"></i>
                                            </div>

                                            <h4>
                                                Order {{ ucfirst($trackingStatus) }}
                                            </h4>

                                            <p>
                                                This order is no longer being processed.
                                            </p>
                                        </div>

                                    @else

                                        <div class="tracking-timeline">

                                            @foreach($steps as $key => $step)

                                                @php
                                                    $stepNumber = $statusOrder[$key];
                                                    $isCompleted = $stepNumber <= $currentStep;
                                                    $isCurrent = $stepNumber === $currentStep;
                                                @endphp

                                                <div
                                                    class="tracking-item {{ $isCompleted ? 'completed' : '' }} {{ $isCurrent ? 'current' : '' }}">

                                                    <div class="tracking-line-wrapper">

                                                        <div class="tracking-icon">
                                                            <i class="bi {{ $step['icon'] }}"></i>
                                                        </div>

                                                        @if(!$loop->last)
                                                            <div class="tracking-line"></div>
                                                        @endif

                                                    </div>

                                                    <div class="tracking-info">

                                                        <h5>
                                                            {{ $step['title'] }}

                                                            @if($isCurrent)
                                                                <span class="tracking-current">
                                                                    Current
                                                                </span>
                                                            @endif
                                                        </h5>

                                                        <p>
                                                            {{ $step['description'] }}
                                                        </p>

                                                        @if($isCompleted)
                                                            <small>
                                                                <i class="bi bi-check-circle"></i>
                                                                Completed
                                                            </small>
                                                        @else
                                                            <small>
                                                                Pending
                                                            </small>
                                                        @endif

                                                    </div>

                                                </div>

                                            @endforeach

                                        </div>

                                    @endif

                                    <div class="tracking-summary">

                                        <div class="tracking-summary-item">
                                            <span>Order Number</span>
                                            <strong>{{ $order->order_number }}</strong>
                                        </div>

                                        <div class="tracking-summary-item">
                                            <span>Order Date</span>
                                            <strong>
                                                {{ $order->created_at?->format('d M Y, h:i A') }}
                                            </strong>
                                        </div>

                                        <div class="tracking-summary-item">
                                            <span>Items</span>
                                            <strong>{{ $order->items_count }}</strong>
                                        </div>

                                        <div class="tracking-summary-item">
                                            <span>Total Amount</span>
                                            <strong>
                                                ₹{{ number_format($order->total ?? 0, 2) }}
                                            </strong>
                                        </div>

                                        <div class="tracking-summary-item">
                                            <span>Current Status</span>
                                            <strong>
                                                {{ ucfirst($order->order_status ?? 'Pending') }}
                                            </strong>
                                        </div>

                                    </div>

                                </div>

                                <div class="track-popup-footer">

                                    <button type="button" class="btn btn-light" onclick="closeTrackOrderModal({{ $order->id }})">
                                        Close
                                    </button>

                                </div>

                            </div>

                        </div>
                    @endif
                @empty
                    <div class="empty-orders">
                        <i class="bi bi-bag-x"></i>
                        <h4>No Orders Yet</h4>
                        <p>You haven't placed any orders yet.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-2">
                            Start Shopping
                        </a>
                    </div>
                @endforelse
            </div>
            @if($orders->hasPages())
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function openTrackOrderModal(orderId) {
            const popup = document.getElementById('trackOrderPopup' + orderId);

            if (!popup) {
                console.error('Tracking popup not found:', orderId);
                return;
            }

            popup.classList.add('show');
            document.body.classList.add('track-popup-open');
        }

        function closeTrackOrderModal(orderId) {
            const popup = document.getElementById('trackOrderPopup' + orderId);

            if (!popup) {
                return;
            }

            popup.classList.remove('show');
            document.body.classList.remove('track-popup-open');
        }

        function closeTrackOrderOnOverlay(event, orderId) {
            if (event.target === event.currentTarget) {
                closeTrackOrderModal(orderId);
            }
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.track-popup.show').forEach(function (popup) {
                    popup.classList.remove('show');
                });

                document.body.classList.remove('track-popup-open');
            }
        });
    </script>
@endsection
