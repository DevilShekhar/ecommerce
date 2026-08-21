@extends('frontend.layouts.customer-layout')

@section('title', 'My Orders - ShopEase')

@section('styles')

@endsection

@section('content')
    <div class="orders-page">
        <div class="container">
            <div class="orders-header">
                <h2>My Orders</h2>
                <p>View, track and manage all your orders.</p>
            </div>
            <div class="orders-card">
                @forelse($orders as $order)
                    @php
                        $trackingStatus = strtolower($order->order_status ?? 'pending');
                        if ($trackingStatus === 'completed') {
                            $trackingStatus = 'delivered';
                        }
                        $statusClass = match ($trackingStatus) {
                            'confirmed',
                            'processing',
                            'packed',
                            'shipped',
                            'out_for_delivery' => 'status-processing',
                            'delivered' => 'status-delivered',
                            'return_requested' => 'status-return-requested',
                            'returned' => 'status-returned',
                            'refunded' => 'status-refunded',
                            'cancelled',
                            'failed' => 'status-cancelled',
                            default => 'status-pending',
                        };
                        $steps = [
                            'pending' => [
                                'title' => 'Order Placed',
                                'description' => 'Your order has been successfully placed.',
                                'icon' => 'bi-bag-check',
                            ],
                            'confirmed' => [
                                'title' => 'Order Confirmed',
                                'description' => 'Your order has been confirmed.',
                                'icon' => 'bi-patch-check',
                            ],
                            'processing' => [
                                'title' => 'Processing',
                                'description' => 'Your order is being prepared.',
                                'icon' => 'bi-gear',
                            ],
                            'packed' => [
                                'title' => 'Packed',
                                'description' => 'Your order has been packed and is ready for shipping.',
                                'icon' => 'bi-box-seam',
                            ],
                            'shipped' => [
                                'title' => 'Shipped',
                                'description' => 'Your order has been handed over for delivery.',
                                'icon' => 'bi-truck',
                            ],
                            'out_for_delivery' => [
                                'title' => 'Out For Delivery',
                                'description' => 'Your order is on the way to your address.',
                                'icon' => 'bi-truck-front',
                            ],
                            'delivered' => [
                                'title' => 'Delivered',
                                'description' => 'Your order has been successfully delivered.',
                                'icon' => 'bi-house-check',
                            ],
                        ];
                        $statusOrder = [
                            'pending' => 1,
                            'confirmed' => 2,
                            'processing' => 3,
                            'packed' => 4,
                            'shipped' => 5,
                            'out_for_delivery' => 6,
                            'delivered' => 7,
                        ];
                        $currentStep = $statusOrder[$trackingStatus] ?? 1;
                        $cancellationReason = $order->cancellation_reason ?? $order->cancel_reason ?? null;
                        $returnReason = $order->returned_reason ?? $order->return_reason ?? null;
                        $refundReason = $order->refund_reason ?? null;
                        $currentStatusData = $steps[$trackingStatus] ?? [
                            'title' => ucwords(str_replace('_', ' ', $trackingStatus)),
                            'description' => 'Your order status has been updated.',
                            'icon' => 'bi-info-circle',
                        ];
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
                                    {{ $order->items_count ?? ($order->items?->count() ?? 0) }}
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
                                    {{ ucwords(str_replace('_', ' ', $trackingStatus)) }}
                                </span>
                            </div>
                        </div>
                        <div class="order-actions">
                            <button type="button" class="track-order-btn" onclick="openTrackOrderModal({{ $order->id }})">
                                <i class="bi bi-truck"></i>
                                Track Order
                            </button>
                        </div>
                    </div>
                    <div class="track-popup" id="trackOrderPopup{{ $order->id }}"
                        onclick="closeTrackOrderOnOverlay(event, {{ $order->id }})">
                        <div class="track-popup-content">
                            <div class="track-popup-header">
                                <div>
                                    <h4>Track Order</h4>
                                    <span>
                                        {{ $order->order_number }}
                                    </span>
                                </div>
                                <button type="button" class="track-popup-close"
                                    onclick="closeTrackOrderModal({{ $order->id }})">
                                    &times;
                                </button>
                            </div>
                            <div class="track-popup-body">
                                <div class="tracking-status-overview">
                                    <div class="tracking-status-left">
                                        <div class="tracking-status-icon">
                                            <i class="bi {{ $currentStatusData['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <div class="tracking-status-title">
                                                {{ $currentStatusData['title'] }}
                                            </div>
                                            <div class="tracking-status-description">
                                                {{ $currentStatusData['description'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ ucwords(str_replace('_', ' ', $trackingStatus)) }}
                                    </span>
                                </div>
                                @if($trackingStatus === 'pending')
                                    <div class="tracking-action-section">
                                        <div class="tracking-action-info">
                                            <div>
                                                <h6>Need to cancel this order?</h6>
                                                <p>
                                                    You can cancel this order before it is confirmed and processed.
                                                </p>
                                            </div>
                                            <button type="button" class="cancel-order-btn"
                                                onclick="showCancelConfirmation({{ $order->id }})">
                                                <i class="bi bi-x-circle"></i>
                                                Cancel Order
                                            </button>
                                        </div>
                                    </div>
                                    <div class="cancel-confirmation" id="cancelConfirmation{{ $order->id }}">
                                        <div class="cancel-confirmation-content">
                                            <div class="cancel-confirmation-icon">
                                                <i class="bi bi-exclamation-triangle"></i>
                                            </div>
                                            <h5>Cancel this order?</h5>
                                            <p>
                                                Please select a reason before cancelling your order.
                                            </p>
                                            <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-3 text-start">
                                                    <label class="form-label">
                                                        Cancellation Reason
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="cancellation_reason" class="form-select" required>
                                                        <option value="">Select cancellation reason</option>
                                                        <option value="Changed my mind">Changed my mind</option>
                                                        <option value="Ordered by mistake">Ordered by mistake</option>
                                                        <option value="Found a better price">Found a better price</option>
                                                        <option value="Delivery time is too long">Delivery time is too long</option>
                                                        <option value="Incorrect address">Incorrect address</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="cancel-confirmation-actions">
                                                    <button type="button" class="btn btn-light"
                                                        onclick="hideCancelConfirmation({{ $order->id }})">
                                                        Keep Order
                                                    </button>
                                                    <button type="submit" class="confirm-cancel-btn">
                                                        <i class="bi bi-x-circle"></i>
                                                        Yes, Cancel Order
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $canReturn = false;

                                    if ($order->order_status === 'delivered' && $order->status_updated_at) {
                                        $canReturn = now()->lte(
                                            \Carbon\Carbon::parse($order->status_updated_at)->addDays(7)
                                        );
                                    }
                                @endphp
                                @if($trackingStatus === 'delivered')
                                    @if($canReturn)
                                        <div class="tracking-action-section tracking-return-section">
                                            <div class="tracking-action-info">
                                                <div>
                                                    <h6>Need to return this order?</h6>
                                                    <p>
                                                        You can request a return within 7 days of delivery.
                                                    </p>
                                                </div>

                                                <button type="button" class="return-order-btn"
                                                    onclick="showReturnConfirmation({{ $order->id }})">
                                                    <i class="bi bi-arrow-return-left"></i>
                                                    Return Order
                                                </button>

                                            </div>
                                        </div>
                                    @endif

                                    {{-- RETURN CONFIRMATION --}}
                                    <div class="return-confirmation" id="returnConfirmation{{ $order->id }}">
                                        <div class="return-confirmation-content">
                                            <div class="return-confirmation-icon">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </div>
                                            <h5>Request Return?</h5>
                                            <p>
                                                Please select a reason for returning this order.
                                            </p>
                                            <form action="{{ route('customer.orders.return', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-3 text-start">
                                                    <label class="form-label">
                                                        Return Reason
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="return_reason" class="form-select" required>
                                                        <option value="">Select return reason</option>
                                                        <option value="Damaged product">Damaged product</option>
                                                        <option value="Wrong item sent">Wrong item sent</option>
                                                        <option value="Product not as described">Product not as described</option>
                                                        <option value="Size/color mismatch">Size/color mismatch</option>
                                                        <option value="Defective product">Defective product</option>
                                                        <option value="Changed mind">Changed mind</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 text-start">
                                                    <label class="form-label">Additional Notes (Optional)</label>
                                                    <textarea name="return_notes" class="form-control" rows="2"
                                                        placeholder="Please provide any additional details about your return request."></textarea>
                                                </div>
                                                <div class="return-confirmation-actions">
                                                    <button type="button" class="btn btn-light"
                                                        onclick="hideReturnConfirmation({{ $order->id }})">
                                                        Keep Order
                                                    </button>
                                                    <button type="submit" class="confirm-return-btn">
                                                        <i class="bi bi-arrow-return-left"></i>
                                                        Submit Return Request
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                @if($trackingStatus === 'return_requested')
                                    <div class="tracking-special-box returned">
                                        <div class="tracking-special-top">
                                            <div class="tracking-special-icon">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </div>

                                            <div class="tracking-special-content">
                                                <h5>Return Request Submitted</h5>

                                                <p>
                                                    Your return request has been submitted successfully.
                                                    Our team will review your request and update the return status.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="tracking-reason">
                                            <span>Return Reason</span>

                                            <strong>
                                                {{ $returnReason ?: 'No return reason was provided.' }}
                                            </strong>
                                        </div>

                                        @if($order->return_notes)
                                            <div class="tracking-reason">
                                                <span>Additional Notes</span>

                                                <strong>
                                                    {{ $order->return_notes }}
                                                </strong>
                                            </div>
                                        @endif

                                        @if($order->return_requested_at)
                                            <div class="tracking-reason">
                                                <span>Requested On</span>

                                                <strong>
                                                    {{ $order->return_requested_at->format('d M Y, h:i A') }}
                                                </strong>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if(in_array($trackingStatus, ['cancelled', 'failed']))
                                    <div class="tracking-special-box cancelled">
                                        <div class="tracking-special-top">
                                            <div class="tracking-special-icon">
                                                <i class="bi bi-x-circle"></i>
                                            </div>
                                            <div class="tracking-special-content">
                                                <h5>
                                                    Order {{ ucwords(str_replace('_', ' ', $trackingStatus)) }}
                                                </h5>
                                                <p>
                                                    This order is no longer being processed.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tracking-reason">
                                            <span>Cancellation Reason</span>
                                            <strong>
                                                {{ $cancellationReason ?: 'No cancellation reason was provided.' }}
                                            </strong>
                                        </div>
                                    </div>
                                @elseif($trackingStatus === 'returned')
                                    <div class="tracking-special-box returned">
                                        <div class="tracking-special-top">
                                            <div class="tracking-special-icon">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </div>
                                            <div class="tracking-special-content">
                                                <h5>Order Returned</h5>
                                                <p>
                                                    Your order has been successfully returned.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tracking-reason">
                                            <span>Return Reason</span>
                                            <strong>
                                                {{ $returnReason ?: 'No return reason was provided.' }}
                                            </strong>
                                        </div>
                                    </div>
                                @elseif($trackingStatus === 'refunded')
                                    <div class="tracking-special-box refunded">
                                        <div class="tracking-special-top">
                                            <div class="tracking-special-icon">
                                                <i class="bi bi-cash-stack"></i>
                                            </div>
                                            <div class="tracking-special-content">
                                                <h5>Refund Processed</h5>
                                                <p>
                                                    Your refund has been successfully processed.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tracking-reason">
                                            <span>Refund Details</span>
                                            <strong>
                                                {{ $refundReason ?: 'Refund has been processed for this order.' }}
                                            </strong>
                                        </div>
                                    </div>
                                @endif
                                @if(
                                        !in_array($trackingStatus, [
                                            'cancelled',
                                            'failed',
                                            'return_requested',
                                            'returned',
                                            'refunded'
                                        ])
                                    )
                                    <h5 class="tracking-section-title">Order Status</h5>
                                    <div class="tracking-timeline-horizontal">
                                        @foreach($steps as $key => $step)
                                            @php
                                                $stepNumber = $statusOrder[$key];
                                                $isCompleted = $stepNumber <= $currentStep;
                                                $isCurrent = $stepNumber === $currentStep;
                                            @endphp
                                            <div
                                                class="tracking-horizontal-item {{ $isCompleted ? 'completed' : '' }} {{ $isCurrent ? 'current' : '' }}">
                                                <div class="tracking-horizontal-icon-wrapper">
                                                    <div class="tracking-horizontal-icon">
                                                        <i class="bi {{ $step['icon'] }}"></i>
                                                    </div>
                                                    @if(!$loop->last)
                                                        <div class="tracking-horizontal-line {{ $isCompleted ? 'completed' : '' }}"></div>
                                                    @endif
                                                </div>
                                                <div class="tracking-horizontal-info">
                                                    <h5>
                                                        {{ $step['title'] }}
                                                        @if($isCurrent)
                                                            <span class="tracking-current">Current</span>
                                                        @endif
                                                    </h5>
                                                    <p>{{ $step['description'] }}</p>
                                                    @if($isCompleted)
                                                        <small><i class="bi bi-check-circle"></i>
                                                            {{ $isCurrent ? 'Current Status' : 'Completed' }}</small>
                                                    @else
                                                        <small>Pending</small>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="tracking-products">
                                    <div class="tracking-products-header">
                                        <h5>
                                            <i class="bi bi-box-seam me-1"></i>
                                            Ordered Products
                                        </h5>
                                        <span>
                                            {{ $order->items_count ?? ($order->items?->count() ?? 0) }} Item(s)
                                        </span>
                                    </div>
                                    @forelse($order->items ?? [] as $item)
                                        @php
                                            $product = $item->product ?? null;
                                            $productName = $product->name ?? $item->product_name ?? $item->name ?? 'Product';
                                            $productSku = $product->sku ?? $item->sku ?? null;
                                            $quantity = $item->quantity ?? $item->qty ?? 1;
                                            $unitPrice = $item->price ?? $item->unit_price ?? 0;
                                            $subtotal = $item->subtotal ?? $item->total ?? ($unitPrice * $quantity);
                                            $productImage = $product->image ?? $product->image_path ?? $product->thumbnail ?? $item->image ?? null;
                                            if ($productImage && !\Illuminate\Support\Str::startsWith($productImage, ['http://', 'https://'])) {
                                                $productImage = asset('storage/' . ltrim($productImage, '/'));
                                            }
                                        @endphp
                                        <div class="tracking-product-item">
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
                                            <div class="tracking-product-image product-details-trigger"
                                                data-product-id="{{ $product?->id }}" role="button" tabindex="0"
                                                title="View Product Details">

                                                @if($imgUrl)
                                                    <img src="{{ $imgUrl }}" alt="{{ $productName }}"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    <div class="tracking-product-placeholder" style="display:none;">
                                                        <i class="bi bi-image"></i>
                                                    </div>
                                                @else
                                                    <div class="tracking-product-placeholder">
                                                        <i class="bi bi-image"></i>
                                                    </div>
                                                @endif

                                                <div class="product-image-overlay">
                                                    <i class="bi bi-eye"></i>
                                                    <span>View</span>
                                                </div>
                                            </div>
                                            <div class="tracking-product-details">
                                                <div class="tracking-product-name">
                                                    {{ $productName }}
                                                </div>
                                                <div class="tracking-product-meta">
                                                    @if($productSku)
                                                        <span>
                                                            SKU: {{ $productSku }}
                                                        </span>
                                                    @endif
                                                    <span>
                                                        Qty: {{ $quantity }}
                                                    </span>
                                                    <span>
                                                        ₹{{ number_format($unitPrice, 2) }} each
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="tracking-product-price">
                                                <strong>
                                                    ₹{{ number_format($subtotal, 2) }}
                                                </strong>
                                                <span>
                                                    Subtotal
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-4 text-center text-muted">
                                            Product information is not available.
                                        </div>
                                    @endforelse
                                </div>
                                <h5 class="tracking-section-title">
                                    Order Details
                                </h5>
                                <div class="tracking-summary">
                                    <div class="tracking-summary-item">
                                        <span>Order Number</span>
                                        <strong>
                                            {{ $order->order_number }}
                                        </strong>
                                    </div>
                                    <div class="tracking-summary-item">
                                        <span>Order Date</span>
                                        <strong>
                                            {{ $order->created_at?->format('d M Y, h:i A') }}
                                        </strong>
                                    </div>
                                    <div class="tracking-summary-item">
                                        <span>Total Items</span>
                                        <strong>
                                            {{ $order->items_count ?? ($order->items?->count() ?? 0) }}
                                        </strong>
                                    </div>

                                    <div class="tracking-summary-item">
                                        <span>Total Qty</span>
                                        <strong>
                                            {{ $order->items?->sum('quantity') ?? 0 }}
                                        </strong>
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
                                            {{ ucwords(str_replace('_', ' ', $trackingStatus)) }}
                                        </strong>
                                    </div>
                                    @if(in_array($trackingStatus, ['cancelled', 'failed']))
                                        <div class="tracking-summary-item">
                                            <span>Cancellation Reason</span>
                                            <strong>
                                                {{ $cancellationReason ?: 'Not provided' }}
                                            </strong>
                                        </div>
                                    @elseif($trackingStatus === 'returned')
                                        <div class="tracking-summary-item">
                                            <span>Return Reason</span>
                                            <strong>
                                                {{ $returnReason ?: 'Not provided' }}
                                            </strong>
                                        </div>
                                    @elseif($trackingStatus === 'refunded')
                                        <div class="tracking-summary-item">
                                            <span>Refund Status</span>
                                            <strong>
                                                Refund Processed
                                            </strong>
                                        </div>
                                    @endif
                                </div>

                                @if($trackingStatus === 'delivered')
                                    @if($item->rating)
                                        {{-- ALREADY RATED --}}
                                        <div class="order-rating-section">
                                            <h5 class="tracking-section-title">
                                                Your Rating for {{ $productName }}
                                            </h5>

                                            <div class="rating-stars saved-rating">
                                                @for($star = 1; $star <= 5; $star++)
                                                    <span class="star {{ $star <= $item->rating->rating ? 'active' : '' }}">
                                                        ★
                                                    </span>
                                                @endfor
                                            </div>

                                            <p class="rating-text">
                                                You rated this product {{ $item->rating->rating }} out of 5 stars.
                                            </p>
                                        </div>
                                    @else
                                        {{-- NOT RATED YET --}}
                                        <div class="order-rating-section">
                                            <h5 class="tracking-section-title">
                                                Rate {{ $productName }}
                                            </h5>

                                            <form action="{{ route('customer.orders.rating') }}" method="POST" class="rating-form">

                                                @csrf

                                                <input type="hidden" name="product_id" value="{{ $product?->id }}">
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                                                <input type="hidden" name="rating" class="rating-input">

                                                <div class="rating-stars">
                                                    @for($star = 1; $star <= 5; $star++)
                                                        <span class="star" data-rating="{{ $star }}">★</span>
                                                    @endfor
                                                </div>

                                                <p class="rating-text">
                                                    Click on a star to rate this product
                                                </p>

                                                <button type="submit" class="btn btn-primary btn-sm mt-2 rating-submit-btn"
                                                    style="display:none;">
                                                    Submit Rating
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endif

                            </div>
                            <div class="track-popup-footer">
                                <button type="button" class="btn btn-light" onclick="closeTrackOrderModal({{ $order->id }})">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-orders">
                        <i class="bi bi-bag-x"></i>
                        <h4>No Orders Yet</h4>
                        <p>You haven't placed any orders yet.</p>
                        <a href="{{ route('customer.products') }}" class="btn btn-primary mt-2">
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

<!-- PRODUCT DETAILS MODAL -->
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

                        <div class="col-md-6">
                            <div class="product-modal-image-wrap">
                                <img id="modalProductImage" src="" alt="Product Image">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="product-modal-details">

                                <div id="modalProductCategory" class="product-modal-category">
                                </div>

                                <h3 id="modalProductName"></h3>

                                <div class="product-modal-rating">
                                    <span class="stars">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </span>
                                    <span>(128 Reviews)</span>
                                </div>

                                <div id="modalProductPrice" class="product-modal-price">
                                </div>

                                <div id="modalProductDescription" class="product-modal-description">
                                </div>

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

                                <div id="modalProductAction" class="product-modal-action">
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

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
            hideCancelConfirmation(orderId);
        }

        function closeTrackOrderOnOverlay(event, orderId) {
            if (event.target === event.currentTarget) {
                closeTrackOrderModal(orderId);
            }
        }

        function showCancelConfirmation(orderId) {
            const confirmation = document.getElementById('cancelConfirmation' + orderId);
            if (confirmation) {
                confirmation.classList.add('show');
                confirmation.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }

        function hideCancelConfirmation(orderId) {
            const confirmation = document.getElementById('cancelConfirmation' + orderId);
            if (confirmation) {
                confirmation.classList.remove('show');
            }
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.track-popup.show').forEach(function (popup) {
                    popup.classList.remove('show');
                });
                document.querySelectorAll('.cancel-confirmation.show').forEach(function (confirmation) {
                    confirmation.classList.remove('show');
                });
                document.body.classList.remove('track-popup-open');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {

            const modalElement = document.getElementById('productDetailsModal');

            if (!modalElement) {
                console.error('Product details modal not found.');
                return;
            }

            const productModal = new bootstrap.Modal(modalElement);

            const detailsUrl = "{{ url('/customer/product-details') }}";

            const loader = document.getElementById('productModalLoader');
            const content = document.getElementById('productModalContent');
            const image = document.getElementById('modalProductImage');
            const category = document.getElementById('modalProductCategory');
            const categoryInfo = document.getElementById('modalProductCategoryInfo');
            const name = document.getElementById('modalProductName');
            const price = document.getElementById('modalProductPrice');
            const description = document.getElementById('modalProductDescription');
            const stock = document.getElementById('modalProductStock');
            const action = document.getElementById('modalProductAction');

            document.addEventListener('click', function (event) {
                const trigger = event.target.closest('.product-details-trigger');
                if (!trigger) {
                    return;
                }
                const productId = trigger.dataset.productId;
                if (!productId) {
                    console.error('Product ID not found.');
                    return;
                }
                loadProductDetails(productId);
            });

            document.addEventListener('keydown', function (event) {
                if (event.key !== 'Enter' && event.key !== ' ') {
                    return;
                }
                const trigger = event.target.closest('.product-details-trigger');
                if (!trigger) {
                    return;
                }
                event.preventDefault();
                const productId = trigger.dataset.productId;
                if (!productId) {
                    return;
                }
                loadProductDetails(productId);
            });

            function loadProductDetails(productId) {

                loader.style.display = 'flex';
                content.style.display = 'none';

                image.src = '';
                image.alt = 'Product Image';
                category.textContent = '';
                categoryInfo.textContent = '';
                name.textContent = '';
                price.textContent = '';
                description.innerHTML = '';
                stock.textContent = '';
                action.innerHTML = '';

                productModal.show();

                fetch(detailsUrl + '/' + encodeURIComponent(productId), {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(async response => {
                        const contentType = response.headers.get('content-type') || '';
                        if (!contentType.includes('application/json')) {
                            throw new Error(
                                'Server returned an invalid response. Please check the product details route.'
                            );
                        }
                        const data = await response.json();
                        if (!response.ok) {
                            throw new Error(
                                data.message || 'Failed to load product details.'
                            );
                        }
                        return data;
                    })
                    .then(data => {
                        if (!data.success || !data.product) {
                            throw new Error('Product details not found.');
                        }

                        const product = data.product;

                        if (product.image) {
                            image.src = product.image;
                            image.alt = product.name || 'Product Image';
                            image.onerror = function () {
                                this.src = "{{ asset('images/no-image.png') }}";
                            };
                        } else {
                            image.src = "{{ asset('images/no-image.png') }}";
                            image.alt = 'No Image';
                        }

                        category.textContent = product.category || 'Product';
                        categoryInfo.textContent = product.category || 'N/A';
                        name.textContent = product.name || 'Product';
                        price.textContent = product.formatted_price || '₹0.00';
                        description.innerHTML = product.description || '<p>No description available.</p>';

                        if (product.is_out_of_stock) {
                            stock.textContent = 'Out of Stock';
                            stock.style.color = '#dc2626';
                        } else {
                            stock.textContent = 'In Stock';
                            stock.style.color = '#16a34a';
                        }

                        if (product.is_futured) {
                            action.innerHTML = `
                        <button type="button"
                            class="product-modal-notify notify-me-btn"
                            data-product-id="${product.id}">
                            <i class="bi bi-bell me-2"></i>
                            Notify Me
                        </button>
                    `;
                        } else if (product.is_out_of_stock) {
                            action.innerHTML = `
                        <button type="button"
                            class="product-modal-add-cart"
                            disabled>
                            <i class="bi bi-x-circle me-2"></i>
                            Out of Stock
                        </button>
                    `;
                        } else {
                            // FIXED: Use JavaScript variables instead of Blade syntax
                            // Get the CSRF token from the meta tag
                            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                            // Build the URL using JavaScript
                            const addToCartUrl = "{{ url('/cart/add') }}" + '/' + product.id;

                            action.innerHTML = `
                        <form class="add-to-cart-form" action="${addToCartUrl}" method="POST">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <button type="submit" class="rec-add-cart">
                                <i class="bi bi-cart3 me-1"></i>
                                Add to Cart
                            </button>
                        </form>
                    `;
                        }

                        loader.style.display = 'none';
                        content.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Product Details Error:', error);
                        loader.style.display = 'none';
                        content.style.display = 'none';
                        productModal.hide();
                        if (typeof showSidebarToast === 'function') {
                            showSidebarToast(
                                'error',
                                'Error',
                                error.message || 'Failed to load product details.'
                            );
                        } else {
                            alert(
                                error.message || 'Failed to load product details.'
                            );
                        }
                    });
            }
        });
        function showReturnConfirmation(orderId) {
            const confirmation = document.getElementById('returnConfirmation' + orderId);
            if (confirmation) {
                confirmation.classList.add('show');
                confirmation.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }

        function hideReturnConfirmation(orderId) {
            const confirmation = document.getElementById('returnConfirmation' + orderId);
            if (confirmation) {
                confirmation.classList.remove('show');
            }
        }

        // Update the ESC key handler to also close return confirmation
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.track-popup.show').forEach(function (popup) {
                    popup.classList.remove('show');
                });
                document.querySelectorAll('.cancel-confirmation.show').forEach(function (confirmation) {
                    confirmation.classList.remove('show');
                });
                document.querySelectorAll('.return-confirmation.show').forEach(function (confirmation) {
                    confirmation.classList.remove('show');
                });
                document.body.classList.remove('track-popup-open');
            }
        });

        // Update closeTrackOrderModal to also hide return confirmation
        function closeTrackOrderModal(orderId) {
            const popup = document.getElementById('trackOrderPopup' + orderId);
            if (!popup) {
                return;
            }
            popup.classList.remove('show');
            document.body.classList.remove('track-popup-open');
            hideCancelConfirmation(orderId);
            hideReturnConfirmation(orderId);
        }
    </script>
    <script>
        document.querySelectorAll('.rating-form').forEach(form => {
            const stars = form.querySelectorAll('.star');
            const ratingInput = form.querySelector('.rating-input');
            const submitButton = form.querySelector('.rating-submit-btn');
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const rating = parseInt(this.dataset.rating);
                    ratingInput.value = rating;
                    stars.forEach(item => {
                        item.classList.toggle(
                            'active',
                            parseInt(item.dataset.rating) <= rating
                        );
                    });
                    submitButton.style.display = 'inline-block';
                });
            });
        });
    </script>
@endsection
