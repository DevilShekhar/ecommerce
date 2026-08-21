@extends('frontend.layouts.customer-layout')

@section('title', 'Returns & Refunds')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Returns & Refunds</h4>
            <p class="text-muted mb-0">
                Track your return requests and refund details.
            </p>
        </div>

        <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-bag"></i>
            My Orders
        </a>
    </div>


    {{-- SUMMARY --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="summary-card">
                <div class="icon bg-light text-primary">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
                <h3>{{ $returnCounts['total'] }}</h3>
                <span>Total Returns</span>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="summary-card">
                <div class="icon" style="background:#fef3c7;color:#d97706;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <h3>{{ $returnCounts['pending'] }}</h3>
                <span>Pending Requests</span>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="summary-card">
                <div class="icon" style="background:#fee2e2;color:#dc2626;">
                    <i class="bi bi-x-circle"></i>
                </div>
                <h3>{{ $returnCounts['rejected'] }}</h3>
                <span>Rejected</span>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="summary-card">
                <div class="icon" style="background:#d1fae5;color:#059669;">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <h3>{{ $returnCounts['refunded'] }}</h3>
                <span>Refunded</span>
            </div>
        </div>

    </div>


    <div class="returns-card">

        <div class="p-4 border-bottom">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-arrow-return-left me-2"></i>
                My Return Requests
            </h5>
        </div>

        @if($returns->count())

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Product</th>
                            <th>Order</th>
                            <th>Qty</th>
                            <th>Reason</th>
                            <th>Return Status</th>
                            <th>Refund Amount</th>
                            <th>Refund Status</th>
                            <th>Refund Details</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($returns as $return)

                            @php
                                $product = $return->orderItem?->product;
                                $imageValue = $product?->image;
                                $images = $imageValue
                                    ? array_filter(array_map('trim', explode(',', $imageValue)))
                                    : [];

                                $firstImage = $images[0] ?? null;

                                if ($firstImage) {
                                    $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                    $imgUrl = asset($firstImage);
                                } else {
                                    $imgUrl = null;
                                }
                                $returnStatus = strtolower($return->status ?? 'pending');
                                $refundStatus = strtolower($return->refund_status ?? 'not_required');
                            @endphp

                            <tr>

                                {{-- PRODUCT --}}
                                <td class="ps-4">
                                    <div class="return-product">

                                        @if($imgUrl)
                                            <img src="{{ $imgUrl }}" alt="{{ $product?->name ?? 'Product' }}"
                                                class="return-product-image" onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                        @else
                                            <div class="return-product-placeholder">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif

                                        <div>
                                            <div class="product-name">
                                                {{ $product?->name ?? 'Product Not Available' }}
                                            </div>

                                            @if($return->orderItem)
                                                <div class="product-meta">
                                                    Order Item {{ $return->orderItem->id }}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </td>


                                {{-- ORDER --}}
                                <td>
                                    <strong>
                                        {{ $return->order?->order_number ?? $return->order?->id ?? $return->order_id }}
                                    </strong>
                                </td>


                                {{-- QUANTITY --}}
                                <td>
                                    <span class="fw-semibold">
                                        {{ $return->quantity ?? 1 }}
                                    </span>
                                </td>


                                {{-- REASON --}}
                                <td>
                                    <span class="text-muted">
                                        {{ $return->reason ?? '-' }}
                                    </span>
                                </td>


                                {{-- RETURN STATUS --}}
                                <td>
                                    @if($returnStatus === 'pending')

                                        <span class="return-badge badge-return-pending">
                                            Pending
                                        </span>

                                    @elseif($returnStatus === 'approved')

                                        <span class="return-badge badge-return-approved" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Your return has been approved. The refund has not yet been credited to your account. Please wait while the refund is processed.">
                                            <i class="bi bi-check-circle"></i>
                                            Approved
                                        </span>

                                    @elseif(in_array($returnStatus, ['rejected', 'return_rejected']))

                                        <span class="return-badge badge-return-rejected">
                                            Return Rejected
                                        </span>

                                    @elseif($returnStatus === 'refunded')

                                        <span class="return-badge badge-return-refunded">
                                            Refunded
                                        </span>

                                    @else

                                        <span class="return-badge badge-return-pending">
                                            {{ ucfirst(str_replace('_', ' ', $returnStatus)) }}
                                        </span>

                                    @endif
                                </td>


                                {{-- REFUND AMOUNT --}}
                                <td>
                                    <div class="refund-amount">
                                        ₹{{ number_format($return->refund_amount ?? 0, 2) }}
                                    </div>
                                </td>


                                {{-- REFUND STATUS --}}
                                <td>
                                    @if($refundStatus === 'refunded')

                                        <span class="return-badge badge-return-refunded">
                                            <i class="bi bi-check-circle"></i>
                                            Refunded
                                        </span>

                                    @elseif($refundStatus === 'processing')

                                        <span class="return-badge badge-refund-processing">
                                            Processing
                                        </span>

                                    @elseif($refundStatus === 'pending')

                                        <span class="return-badge badge-refund-pending">
                                            Pending
                                        </span>

                                    @elseif($refundStatus === 'failed')

                                        <span class="return-badge badge-return-rejected">
                                            Failed
                                        </span>

                                    @else

                                        <span class="return-badge badge-refund-not-required">
                                            Not Required
                                        </span>

                                    @endif
                                </td>


                                {{-- REFUND DETAILS --}}
                                <td>
                                    @if($refundStatus === 'refunded')

                                        <div class="small">

                                            <div class="fw-semibold text-success">
                                                {{ strtoupper($return->refund_method ?? 'Refund') }}
                                            </div>

                                            @if($return->refund_transaction_id)
                                                <div class="text-muted">
                                                    ID: {{ $return->refund_transaction_id }}
                                                </div>
                                            @endif

                                            @if($return->refunded_at)
                                                <div class="text-muted">
                                                    {{ $return->refunded_at->format('d M Y, h:i A') }}
                                                </div>
                                            @endif

                                        </div>

                                    @else

                                        <span class="text-muted">-</span>

                                    @endif
                                </td>


                                {{-- DATE --}}
                                <td>
                                    <small class="text-muted">
                                        {{ $return->created_at?->format('d M Y') ?? '-' }}
                                        <br>
                                        {{ $return->created_at?->format('h:i A') ?? '' }}
                                    </small>
                                </td>

                            </tr>


                            {{-- REJECTION REASON --}}
                            @if(
                                    in_array($returnStatus, ['rejected', 'return_rejected'])
                                    && !empty($return->rejection_reason)
                                )
                                <tr>
                                    <td colspan="9" class="bg-light px-4 py-3">
                                        <strong class="text-danger">
                                            <i class="bi bi-x-circle"></i>
                                            Rejection Reason:
                                        </strong>

                                        <span class="ms-1">
                                            {{ $return->rejection_reason }}
                                        </span>
                                    </td>
                                </tr>
                            @endif

                        @empty

                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="bi bi-arrow-return-left fs-4 d-block mb-2"></i>
                                    No returns or refunds found.
                                </td>
                            </tr>

                        @endforelse
                    </tbody>
                </table>

            </div>


            <div class="p-3">
                {{ $returns->links() }}
            </div>

        @else

            <div class="empty-state">

                <i class="bi bi-arrow-return-left"></i>

                <h5>No Returns Found</h5>

                <p class="text-muted">
                    You haven't submitted any return requests yet.
                </p>

                <a href="{{ route('customer.orders.index') }}" class="btn btn-primary">

                    View My Orders

                </a>

            </div>

        @endif

    </div>

@endsection
<script>
     document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = document.querySelectorAll(
            '[data-bs-toggle="tooltip"]'
        );

        [...tooltipTriggerList].map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
