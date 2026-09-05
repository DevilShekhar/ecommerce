@extends('layouts.app')
@section('title', 'Order ' . $order->order_number)
@section('content')
    <style>
        .order-header-card,
        .status-card,
        .status-timeline-card {
            border-radius: 12px;
        }

        .order-header-card .body {
            padding: 22px 25px;
        }

        .order-header-card h4 {
            font-weight: 700;
            color: #172033;
        }

        .order-status-badge {
            font-size: 13px;
            padding: 9px 15px;
        }

        .status-card {
            border: 1px solid #dbe7f7;
        }

        .status-card .body {
            padding: 20px 25px;
        }

        .current-status-box {
            display: flex;
            align-items: center;
            gap: 15px;
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
            font-size: 22px;
        }

        .status-label {
            display: block;
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .current-status-box h5 {
            font-weight: 700;
            color: #172033;
        }

        .delivered-message {
            color: #168a4a;
            font-weight: 600;
            font-size: 15px;
        }

        .delivered-message i {
            margin-right: 5px;
        }

        .final-status-message {
            color: #64748b;
            font-weight: 600;
        }

        .status-timeline-card .body {
            padding: 25px;
        }

        .order-timeline {
            display: flex;
            position: relative;
            justify-content: space-between;
            gap: 10px;
        }

        .timeline-item {
            flex: 1;
            text-align: center;
            position: relative;
            min-width: 80px;
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
            font-size: 18px;
        }

        .timeline-item.completed .timeline-icon {
            background: #2878f0;
            color: #fff;
        }

        .timeline-item.current .timeline-icon {
            background: #2878f0;
            color: #fff;
            box-shadow: 0 0 0 5px #eaf3ff;
        }

        .timeline-content strong {
            display: block;
            font-size: 12px;
            color: #172033;
        }

        .timeline-content span {
            display: block;
            font-size: 11px;
            margin-top: 4px;
        }

        .timeline-current {
            color: #2878f0;
        }

        .timeline-completed {
            color: #168a4a;
        }

        .timeline-pending {
            color: #94a3b8;
        }

        .timeline-line {
            height: 2px;
            background: #e2e8f0;
            position: absolute;
            top: 21px;
            left: calc(50% + 21px);
            width: calc(100% - 42px);
            z-index: 1;
        }

        .timeline-line.active {
            background: #2878f0;
        }

        .additional-status {
            border-top: 1px solid #e5eaf1;
            padding-top: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .additional-status-title {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
        }

        .additional-status-badge {
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .return-requested-badge {
            background: #fff7e6;
            color: #d97706;
        }

        .return-approved-badge {
            background: #e9f9ef;
            color: #168a4a;
        }

        .return-rejected-badge {
            background: #fff0f0;
            color: #dc3545;
        }

        .refunded-badge {
            background: #e9f9ef;
            color: #168a4a;
        }

        .return-action-card {
            border: 1px solid #f1dfb5;
            background: #fffdf7;
        }

        .return-action-card .header {
            border-bottom: 1px solid #f1dfb5;
            margin-left: 10px;
        }

        .return-action-title {
            font-size: 14px;
            font-weight: 700;
            color: #172033;
        }

        .return-info-box {
            background: #f8fafc;
            border: 1px solid #e5eaf1;
            border-radius: 8px;
            padding: 14px 16px;
        }

        .refund-box {
            background: #effcf4;
            border: 1px solid #c9efd7;
            border-radius: 8px;
            padding: 15px;
        }

        .refund-amount {
            font-size: 22px;
            font-weight: 700;
            color: #168a4a;
        }

        .order-product-item {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 18px 0;
            border-bottom: 1px solid #e5eaf1;
        }

        .order-product-item:first-child {
            padding-top: 0;
        }

        .order-product-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
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

        .product-details {
            flex: 1;
        }

        .product-details h6 {
            font-weight: 700;
            color: #172033;
            margin-bottom: 5px;
        }

        .product-sku,
        .product-quantity {
            font-size: 12px;
            color: #64748b;
            margin-top: 4px;
        }

        .product-variants {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            font-size: 12px;
            color: #64748b;
            margin-top: 5px;
        }

        .product-total {
            font-weight: 700;
            color: #172033;
            white-space: nowrap;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            color: #64748b;
        }

        .summary-row strong {
            color: #172033;
        }

        .discount-row,
        .discount-row strong {
            color: #168a4a;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #e5eaf1;
            margin-top: 10px;
            padding-top: 16px;
            font-size: 17px;
            color: #172033;
        }

        .info-row {
            margin-bottom: 15px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 600;
            color: #172033;
            word-break: break-word;
        }

        .payment-paid {
            color: #168a4a !important;
        }

        .payment-pending {
            color: #d97706 !important;
        }

        .shipping-address .address-main {
            font-weight: 600;
            color: #172033;
            white-space: pre-line;
        }

        .shipping-address .address-location {
            color: #64748b;
            margin-top: 7px;
        }

        .return-alert {
            border-radius: 8px;
            padding: 15px 18px;
        }

        .return-action-box {
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #e5eaf1;
            background: #fff;
            height: 100%;
            transition: all .3s ease;
        }

        .return-action-box:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, .06);
        }

        .return-accept-box {
            border-color: #b7e4c7;
            background: #f6fdf9;
        }

        .return-reject-box {
            border-color: #f5c6cb;
            background: #fff8f8;
        }

        .return-action-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .return-action-header i {
            font-size: 28px;
        }

        .return-action-header h5 {
            margin: 0;
            font-weight: 700;
            color: #172033;
            font-size: 16px;
        }

        .return-action-box .btn-block {
            width: 100%;
        }

        .return-action-box .form-group {
            margin-bottom: 12px;
        }

        .return-action-box .form-control {
            border-radius: 8px;
            border-color: #e5eaf1;
            font-size: 13px;
            resize: vertical;
        }

        .return-action-box .form-control:focus {
            border-color: #2878f0;
            box-shadow: 0 0 0 3px rgba(40, 120, 240, .1);
        }

        .return-info-footer {
            padding: 12px 16px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e5eaf1;
        }

        .return-info-footer i {
            color: #2878f0;
            margin-right: 6px;
        }

        @media(max-width:768px) {
            .return-action-box {
                margin-bottom: 16px;
            }

            .order-timeline {
                overflow-x: auto;
                padding-bottom: 10px;
            }

            .timeline-item {
                min-width: 120px;
            }
        }

        @media(max-width:576px) {
            .current-status-box {
                align-items: flex-start;
            }

            .order-product-item {
                align-items: flex-start;
            }

            .product-total {
                margin-left: auto;
            }

            .additional-status {
                display: block;
            }

            .additional-status-badge {
                display: inline-block;
                margin-top: 8px;
            }
        }
    </style>
    @php
        $returnRequest = $order->returns()->latest()->first();
        $isSuperAdmin = auth()->check() && auth()->user()->role?->name === 'SuperAdmin';
        $statusLabels = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'processing' => 'Processing',
            'packed' => 'Packed',
            'shipped' => 'Shipped',
            'out_for_delivery' => 'Out for Delivery',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            'return_requested' => 'Return Requested',
            'approved' => 'Return Approved',
            'rejected' => 'Return Rejected',
            'returned' => 'Returned',
            'refunded' => 'Refunded',
            'failed' => 'Failed',
            'completed' => 'Completed'
        ];
        $statusIcons = [
            'pending' => 'zmdi-time',
            'confirmed' => 'zmdi-check-circle',
            'processing' => 'zmdi-settings',
            'packed' => 'zmdi-archive',
            'shipped' => 'zmdi-truck',
            'out_for_delivery' => 'zmdi-navigation',
            'delivered' => 'zmdi-check-all',
            'cancelled' => 'zmdi-close-circle',
            'return_requested' => 'zmdi-undo',
            'return_approved' => 'zmdi-check-circle',
            'return_rejected' => 'zmdi-close-circle',
            'returned' => 'zmdi-undo',
            'refunded' => 'zmdi-money',
            'failed' => 'zmdi-alert-circle',
            'completed' => 'zmdi-check-circle'
        ];
        $currentStatus = strtolower($order->order_status ?? 'pending');
        $isReturnFlow = $returnRequest && in_array($returnRequest->status, ['return_requested', 'approved', 'rejected', 'refunded']);
        $statusBadgeClass = match ($currentStatus) {
            'confirmed', 'processing', 'packed', 'shipped', 'out_for_delivery' => 'status-processing',
            'delivered', 'completed' => 'status-delivered',
            'cancelled', 'returned', 'refunded', 'failed' => 'status-cancelled',
            default => 'status-pending'
        };
        $mainStatuses = ['pending', 'confirmed', 'processing', 'packed', 'shipped', 'out_for_delivery', 'delivered', 'return_requested', 'returned', 'refunded', 'return_rejected'];
        $currentIndex = array_search($currentStatus, $mainStatuses, true);
        if ($currentIndex === false) {
            $currentIndex = -1;
        }
        $nextStatus = match ($currentStatus) {
            'pending' => 'confirmed', 'confirmed' => 'processing', 'processing' => 'packed',
            'packed' => 'shipped', 'shipped' => 'out_for_delivery', 'out_for_delivery' => 'delivered',
            default => null
        };
        $nextStatusLabel = $nextStatus ? ($statusLabels[$nextStatus] ?? ucfirst(str_replace('_', ' ', $nextStatus))) : null;
    @endphp
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Order Details</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                    Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ul>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('orders.index') }}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left"></i>
                            Back to Orders</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @if($returnRequest)
                    <div class="card return-action-card mt-4">
                        <div class="header">
                            <h2>
                                <strong>Return</strong> Request
                                @if($returnRequest->status === 'return_requested')
                                    <span class="badge badge-warning ml-2">Pending Approval</span>
                                @elseif($returnRequest->status === 'approved')
                                    <span class="badge badge-success ml-2">Approved</span>
                                @elseif($returnRequest->status === 'rejected')
                                    <span class="badge badge-danger ml-2">Rejected</span>
                                @elseif($returnRequest->status === 'refunded')
                                    <span class="badge badge-info ml-2">Refunded</span>
                                @endif
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-row">
                                        <div class="info-label">Return Status</div>
                                        <div class="info-value">
                                            @if($returnRequest->status === 'return_requested')
                                                <span class="additional-status-badge return-requested-badge"><i
                                                        class="zmdi zmdi-time"></i> Return Requested</span>
                                            @elseif($returnRequest->status === 'approved')
                                                <span class="additional-status-badge return-approved-badge"><i
                                                        class="zmdi zmdi-check-circle"></i> Return Approved</span>
                                            @elseif($returnRequest->status === 'rejected')
                                                <span class="additional-status-badge return-rejected-badge"><i
                                                        class="zmdi zmdi-close-circle"></i> Return Rejected</span>
                                            @elseif($returnRequest->status === 'refunded')
                                                <span class="additional-status-badge refunded-badge"><i class="zmdi zmdi-money"></i>
                                                    Refunded</span>
                                            @else
                                                <span
                                                    class="badge badge-secondary">{{ ucfirst(str_replace('_', ' ', $returnRequest->status)) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-row">
                                        <div class="info-label">Refund Amount</div>
                                        <div class="info-value">₹{{ number_format($returnRequest->refund_amount ?? 0, 2) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-row">
                                        <div class="info-label">Quantity</div>
                                        <div class="info-value">
                                            {{ $returnRequest->quantity ?? 0 }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($returnRequest->reason)
                                <div class="info-row">
                                    <div class="info-label">Return Reason</div>
                                    <div class="info-value">{{ $returnRequest->reason }}</div>
                                </div>
                            @endif
                            @if($returnRequest->customer_note)
                                <div class="info-row">
                                    <div class="info-label">Customer Note</div>
                                    <div class="return-info-box">{{ $returnRequest->customer_note }}</div>
                                </div>
                            @endif
                            @if($returnRequest->admin_note)
                                <div class="info-row">
                                    <div class="info-label">Admin Note</div>
                                    <div class="return-info-box">{{ $returnRequest->admin_note }}</div>
                                </div>
                            @endif
                            @if($isSuperAdmin && $returnRequest->status === 'return_requested' && $returnRequest->id)
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="return-action-box return-accept-box">
                                            <div class="return-action-header">
                                                <i class="zmdi zmdi-check-circle text-success"></i>
                                                <h5>Approve Return</h5>
                                            </div>
                                            <p class="text-muted small">Approve this return request. Customer will be notified.</p>
                                            <form action="{{ route('orders.returns.approve', $returnRequest->id) }}" method="POST"
                                                onsubmit="return approveReturnConfirm(event, this)">

                                                @csrf

                                                <div class="form-group">
                                                    <label>Admin Note (Optional)</label>
                                                    <textarea name="admin_note" class="form-control" rows="2"
                                                        placeholder="Add any notes for the customer..."></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-success btn-block">
                                                    <i class="zmdi zmdi-check"></i> Approve Return
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="return-action-box return-reject-box">
                                            <div class="return-action-header">
                                                <i class="zmdi zmdi-close-circle text-danger"></i>
                                                <h5>Reject Return</h5>
                                            </div>
                                            <p class="text-muted small">Reject this return request with a reason.</p>
                                            <form action="{{ route('orders.returns.reject', $returnRequest->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to REJECT this return request?')">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Rejection Reason <span class="text-danger">*</span></label>
                                                    <textarea name="admin_note" class="form-control" rows="2" required
                                                        placeholder="Enter reason for rejecting..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-danger btn-block"><i
                                                        class="zmdi zmdi-close"></i> Reject Return</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="return-info-footer mt-3">
                                    <i class="zmdi zmdi-info-outline"></i>
                                    <small class="text-muted">Customer will be notified via email about your decision.</small>
                                </div>
                            @endif
                            @if($isSuperAdmin && $returnRequest->status === 'approved' && $returnRequest->id)
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="refund-box mb-3">
                                            <div class="return-action-title mb-1">Return Approved</div>
                                            <div class="text-muted mb-2">The return request has been approved. Refund can now be
                                                processed.</div>
                                            <div class="refund-amount">₹{{ number_format($returnRequest->refund_amount ?? 0, 2) }}
                                            </div>
                                            <small class="text-muted">Refund Amount</small>
                                        </div>
                                        <form action="{{ route('orders.returns.refund', $returnRequest->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-block"
                                                onclick="event.preventDefault();Swal.fire({title:'Process Refund?',text:'Are you sure?',icon:'warning',showCancelButton:true,confirmButtonText:'Yes, Refund'}).then(r=>{if(r.isConfirmed)this.form.submit()})">
                                                <i class="zmdi zmdi-money"></i>
                                                Process Refund</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            @if($returnRequest->status === 'rejected')
                                <div class="alert alert-danger return-alert mt-3 mb-0">
                                    <i class="zmdi zmdi-close-circle"></i>
                                    <strong>Return Request Rejected</strong>
                                    @if($returnRequest->admin_note)
                                        <br><span>Reason: {{ $returnRequest->admin_note }}</span>
                                    @endif
                                </div>
                            @endif
                            @if($returnRequest->status === 'refunded')
                                <div class="alert alert-success return-alert mt-3 mb-0">
                                    <i class="zmdi zmdi-check-circle"></i>
                                    <strong>Refund Completed</strong>
                                    @if($returnRequest->refunded_at)
                                        <br>Refunded on:
                                        {{ $returnRequest->refunded_at instanceof \Carbon\Carbon ? $returnRequest->refunded_at->format('d M Y, h:i A') : $returnRequest->refunded_at }}
                                    @endif
                                    <br>Refund Amount: <strong>₹{{ number_format($returnRequest->refund_amount ?? 0, 2) }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                @elseif($order->order_status === 'return_requested')
                    <div class="card return-action-card mt-4">
                        <div class="header">
                            <h2><strong>Return</strong> Request <span class="badge badge-warning ml-2">Pending</span></h2>
                        </div>
                        <div class="body">
                            <div class="alert alert-warning">
                                <i class="zmdi zmdi-alert-triangle"></i>
                                <strong>Return request detected but no return record found.</strong>
                                <br>Please create a return record for this order.
                                <br><small>Order Status: {{ $order->order_status }}</small>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card mt-4">
                    <div class="header">
                        <h2><strong>Order</strong> Status Management</h2>
                    </div>
                    <div class="body">
                        <div class="mb-3">
                            <strong>Current Status:</strong>
                            <span
                                class="badge badge-primary ml-2">{{ $statusLabels[$currentStatus] ?? ucfirst(str_replace('_', ' ', $currentStatus)) }}</span>
                        </div>
                        <div class="d-flex flex-wrap" style="gap:10px;">
                            @if($nextStatus && !$isReturnFlow && !in_array($currentStatus, ['delivered', 'returned', 'refunded', 'cancelled']))
                                <form action="{{ route('orders.update-status', $order->id) }}" method="POST"
                                    class="update-status-form">
                                    @csrf
                                    <input type="hidden" name="status" value="{{ $nextStatus }}">
                                    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-arrow-right"></i> Mark as
                                        {{ $nextStatusLabel }}</button>
                                </form>
                            @endif
                            @if($returnRequest)
                                @if($returnRequest->status === 'return_requested')
                                    <div class="alert alert-warning mb-0"><i class="zmdi zmdi-time"></i> Return request is waiting
                                        for <strong>Super Admin approval.</strong></div>
                                @elseif($returnRequest->status === 'approved')
                                    <div class="alert alert-success mb-0"><i class="zmdi zmdi-check-circle"></i> Return approved.
                                        Refund is pending.</div>
                                @elseif($returnRequest->status === 'rejected')
                                    <div class="alert alert-danger mb-0"><i class="zmdi zmdi-close-circle"></i> Return request has
                                        been rejected.</div>
                                @elseif($returnRequest->status === 'refunded')
                                    <div class="alert alert-success mb-0"><i class="zmdi zmdi-money"></i> Refund has been completed.
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if(in_array($currentStatus, ['cancelled', 'refunded']))
                            <div class="alert alert-info mt-3 mb-0"><strong>This order has reached its final status:</strong>
                                {{ $statusLabels[$currentStatus] }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card order-header-card">
                            <div class="body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h4 class="mb-1">Order {{ $order->order_number }}</h4>
                                        <p class="text-muted mb-0">Placed on
                                            {{ $order->created_at?->format('d M Y, h:i A') ?? '-' }}
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                                        <span class="badge {{ $statusBadgeClass }} order-status-badge">
                                            <i class="zmdi {{ $statusIcons[$currentStatus] ?? 'zmdi-info' }}"></i>
                                            {{ $statusLabels[$currentStatus] ?? ucfirst(str_replace('_', ' ', $currentStatus)) }}
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
                                            <div class="status-icon"><i
                                                    class="zmdi {{ $statusIcons[$currentStatus] ?? 'zmdi-info' }}"></i>
                                            </div>
                                            <div>
                                                <span class="status-label">Current Order Status</span>
                                                <h5 class="mb-0">
                                                    {{ $statusLabels[$currentStatus] ?? ucfirst(str_replace('_', ' ', $currentStatus)) }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-5 text-md-right mt-3 mt-md-0">
                                        @if($currentStatus === 'delivered')
                                            <div class="delivered-message"><i class="zmdi zmdi-check-circle"></i> Order
                                                Delivered</div>
                                        @elseif($isReturnFlow)
                                            <div class="final-status-message"><i class="zmdi zmdi-undo"></i> Return:
                                                {{ ucfirst(str_replace('_', ' ', $returnRequest->status)) }}
                                            </div>
                                        @elseif(in_array($currentStatus, ['cancelled', 'returned', 'refunded', 'failed']))
                                            <div class="final-status-message"><i class="zmdi zmdi-info-outline"></i>
                                                {{ $statusLabels[$currentStatus] ?? ucfirst($currentStatus) }}
                                            </div>
                                        @elseif($nextStatus)
                                            <div class="final-status-message">Next: {{ $nextStatusLabel }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card status-timeline-card">
                            <div class="body">
                                <h5 class="mb-4"><strong>Order</strong> Status Timeline</h5>
                                <div class="order-timeline">
                                    @foreach($mainStatuses as $index => $status)
                                        @php
                                            $isCompleted = $currentIndex > $index;
                                            $isCurrent = $currentIndex === $index;
                                            $isLast = $index === count($mainStatuses) - 1;

                                            // Get the timestamp for this status from the history
                                            $statusTimestamp = null;
                                            if (isset($statusTimestamps[$status])) {
                                                $statusTimestamp = $statusTimestamps[$status];
                                            }

                                            // For the current status, also check status_updated_at
                                            if ($isCurrent && !$statusTimestamp && $order->status_updated_at) {
                                                $statusTimestamp = $order->status_updated_at;
                                            }
                                        @endphp
                                        <div
                                            class="timeline-item {{ $isCompleted ? 'completed' : '' }} {{ $isCurrent ? 'current' : '' }}">
                                            <div class="timeline-icon">
                                                <i class="zmdi {{ $statusIcons[$status] ?? 'zmdi-info' }}"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <strong>{{ $statusLabels[$status] ?? ucfirst(str_replace('_', ' ', $status)) }}</strong>

                                                {{-- Display timestamp for this status --}}
                                                @if($statusTimestamp)
                                                    <div class="small text-muted mt-1">
                                                        <i class="zmdi zmdi-time"></i>
                                                        {{ $statusTimestamp instanceof \Carbon\Carbon ? $statusTimestamp->format('d M Y, h:i A') : $statusTimestamp }}
                                                    </div>
                                                @endif

                                                {{-- Status label --}}
                                                @if($isCurrent)
                                                    <span class="timeline-current">Current Status</span>
                                                @elseif($isCompleted)
                                                    <span class="timeline-completed">Completed</span>
                                                @else
                                                    <span class="timeline-pending">Pending</span>
                                                @endif
                                            </div>
                                            @if(!$isLast)
                                                <div class="timeline-line {{ $currentIndex > $index ? 'active' : '' }}"></div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Return Status Section (if exists) --}}
                                @if($returnRequest)
                                    <div class="additional-status mt-4">
                                        <div class="additional-status-title">Return Status</div>
                                        @if($returnRequest->status === 'return_requested')
                                            <div class="additional-status-badge return-requested-badge">
                                                <i class="zmdi zmdi-time"></i> Return Requested
                                                @if($returnRequest->created_at)
                                                    <small class="ml-2">
                                                        {{ $returnRequest->created_at->format('d M Y, h:i A') }}
                                                    </small>
                                                @endif
                                            </div>
                                        @elseif($returnRequest->status === 'approved')
                                            <div class="additional-status-badge return-approved-badge">
                                                <i class="zmdi zmdi-check-circle"></i> Return Approved
                                                @if($returnRequest->updated_at)
                                                    <small class="ml-2">
                                                        {{ $returnRequest->updated_at->format('d M Y, h:i A') }}
                                                    </small>
                                                @endif
                                            </div>
                                        @elseif($returnRequest->status === 'rejected')
                                            <div class="additional-status-badge return-rejected-badge">
                                                <i class="zmdi zmdi-close-circle"></i> Return Rejected
                                                @if($returnRequest->updated_at)
                                                    <small class="ml-2">
                                                        {{ $returnRequest->updated_at->format('d M Y, h:i A') }}
                                                    </small>
                                                @endif
                                            </div>
                                        @elseif($returnRequest->status === 'refunded')
                                            <div class="additional-status-badge refunded-badge">
                                                <i class="zmdi zmdi-money"></i> Refunded
                                                @if($returnRequest->refunded_at)
                                                    <small class="ml-2">
                                                        {{ $returnRequest->refunded_at instanceof \Carbon\Carbon ? $returnRequest->refunded_at->format('d M Y, h:i A') : $returnRequest->refunded_at }}
                                                    </small>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Order</strong> Items <span
                                        class="text-muted">({{ $order->items->count() }})</span></h2>
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

                                        // =============================================
                                        // GET SELLING PRICE AND ORIGINAL PRICE
                                        // =============================================
                                        $product = $item->product;
                                        $quantity = $item->quantity ?? 1;

                                        // Original price from product or item
                                        $originalPrice = (float) ($product->price ?? $item->price ?? 0);

                                        // Selling price - priority: item selling_price > product selling_price > item price > product price
                                        $sellingPrice = (float) (
                                            $item->selling_price ??
                                            $product->selling_price ??
                                            $item->price ??
                                            $product->price ??
                                            0
                                        );

                                        if ($sellingPrice <= 0) {
                                            $sellingPrice = $originalPrice;
                                        }

                                        $hasDiscount = $originalPrice > $sellingPrice && $sellingPrice > 0;
                                        $discountPercent = $hasDiscount ? round((($originalPrice - $sellingPrice) / $originalPrice) * 100) : 0;

                                        // Item totals
                                        $itemSellingTotal = $sellingPrice * $quantity;
                                        $itemOriginalTotal = $originalPrice * $quantity;
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
                                            <h6>{{ $item->product_name }}</h6>
                                            @if($item->sku)
                                            <div class="product-sku">SKU: {{ $item->sku }}</div>@endif

                                            {{-- PRICE DISPLAY WITH SELLING AND ORIGINAL PRICE --}}
                                            <div class="product-price-display" style="margin-top:5px;">
                                                @if($hasDiscount)
                                                    <span style="color:#198754;font-weight:600;font-size:14px;">
                                                        ₹{{ number_format($sellingPrice, 2) }}
                                                    </span>
                                                    <span
                                                        style="color:#94a3b8;font-size:12px;text-decoration:line-through;text-decoration-thickness:1px;margin-left:6px;">
                                                        ₹{{ number_format($originalPrice, 2) }}
                                                    </span>
                                                    <span
                                                        style="background:#fef2f2;color:#ef4444;font-size:9px;font-weight:700;padding:2px 8px;border-radius:3px;margin-left:6px;">
                                                        {{ $discountPercent }}% OFF
                                                    </span>
                                                @else
                                                    <span style="color:#198754;font-weight:600;font-size:14px;">
                                                        ₹{{ number_format($sellingPrice, 2) }}
                                                    </span>
                                                @endif
                                                <span style="color:#64748b;font-size:12px;margin-left:4px;">
                                                    × {{ $quantity }}
                                                </span>
                                            </div>

                                            @if(!empty($item->variants))
                                                @php
                                                    $variants = $item->variants;
                                                    if (is_string($variants)) {
                                                        $decodedVariants = json_decode($variants, true);
                                                        if (json_last_error() === JSON_ERROR_NONE) {
                                                            $variants = $decodedVariants;
                                                        }
                                                    }
                                                @endphp
                                                @if(is_array($variants) && count($variants))
                                                    <div class="product-variants">
                                                        @foreach($variants as $key => $value)
                                                            <span><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                                {{ is_array($value) ? implode(', ', $value) : $value }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="product-total" style="text-align:right;">
                                            {{-- Selling Price Total (green) --}}
                                            <div style="color:#198754;font-weight:700;font-size:16px;">
                                                ₹{{ number_format($itemSellingTotal, 2) }}
                                            </div>
                                            {{-- Original Price Total (crossed out) --}}
                                            @if($hasDiscount)
                                                <div
                                                    style="color:#94a3b8;font-size:12px;text-decoration:line-through;text-decoration-thickness:1px;">
                                                    ₹{{ number_format($itemOriginalTotal, 2) }}
                                                </div>
                                            @endif
                                            <div style="font-size:10px;color:#64748b;margin-top:2px;">Subtotal</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-muted py-4">No items found for this order.</div>
                                @endforelse
                            </div>
                        </div>
                        <div class="card">
                            <div class="header">
                                <h2><i class="zmdi zmdi-pin"></i> <strong>Shipping</strong> Address</h2>
                            </div>
                            <div class="body">
                                @php
                                    $shippingAddress = collect($order->user->address ?? [])->firstWhere('is_default', true) ?? collect($order->user->address ?? [])->first();
                                @endphp
                                <div class="shipping-address">

                                    <div class="info-row">
                                        <div class="info-label">Name</div>
                                        <div class="info-value">
                                            {{ $order->user->name ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Email</div>
                                        <div class="info-value">
                                            {{ $order->user->email ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Mobile</div>
                                        <div class="info-value">
                                            {{ $shippingAddress['mobile'] ?? ($order->user->mobile ?? '-') }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Address</div>
                                        <div class="info-value">
                                            {{ $order->shipping_address ?? 'Address not available' }}
                                        </div>
                                    </div>

                                    <div class="info-row">
                                        <div class="info-label">Location</div>
                                        <div class="info-value">
                                            {{ collect([
        $order->shipping_city,
        $order->shipping_state,
        $order->shipping_country,
        $order->shipping_pincode
    ])->filter()->implode(', ') ?: '-' }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @if($order->notes)
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Order</strong> Notes</h2>
                                </div>
                                <div class="body">
                                    <p class="mb-0 text-muted">{{ $order->notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4">

                        <div class="card">
                            <div class="header">
                                <h2><strong>Payment</strong> Details</h2>
                            </div>
                            <div class="body">
                                <div class="info-row">
                                    <div class="info-label">Payment Method</div>
                                    <div class="info-value text-uppercase">
                                        {{ str_replace('_', ' ', $order->payment_method ?? 'N/A') }}
                                    </div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Payment Status</div>
                                    @php $paymentStatus = strtolower($order->payment_status ?? 'pending'); @endphp
                                    <div
                                        class="info-value {{ $paymentStatus === 'paid' ? 'payment-paid' : 'payment-pending' }}">
                                        {{ ucfirst($paymentStatus) }}
                                    </div>
                                </div>
                                @if($order->razorpay_payment_id)
                                    <div class="info-row">
                                        <div class="info-label">Razorpay Payment ID</div>
                                        <div class="info-value">{{ $order->razorpay_payment_id }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($returnRequest && $returnRequest->status === 'refunded')
                            <div class="card">
                                <div class="header">
                                    <h2><strong>Refund</strong> Details</h2>
                                </div>
                                <div class="body">
                                    <div class="refund-box">
                                        <div class="info-label">Refund Amount</div>
                                        <div class="refund-amount">₹{{ number_format($returnRequest->refund_amount ?? 0, 2) }}
                                        </div>
                                        @if($returnRequest->refunded_at)
                                            <div class="small text-muted mt-2">Refunded on:
                                                {{ $returnRequest->refunded_at instanceof \Carbon\Carbon ? $returnRequest->refunded_at->format('d M Y, h:i A') : $returnRequest->refunded_at }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if($returnRequest && $returnRequest->id && $isSuperAdmin && $returnRequest->status === 'return_requested')
        <div class="modal fade" id="rejectReturnModal" tabindex="-1" role="dialog" aria-labelledby="rejectReturnModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectReturnModalLabel">Reject Return Request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('orders.returns.reject', $returnRequest->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Rejection Reason <span class="text-danger">*</span></label>
                                <textarea name="admin_note" class="form-control" rows="4" required
                                    placeholder="Enter reason for rejecting this return request..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-close"></i> Reject Return</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.update-status-form').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const statusInput = form.querySelector('input[name="status"]');
                    if (!statusInput) {
                        return;
                    }
                    const status = statusInput.value;
                    const statusLabel = status
                        .replace(/_/g, ' ')
                        .replace(/\b\w/g, function (letter) {
                            return letter.toUpperCase();
                        });
                    Swal.fire({
                        title: 'Update Order Status?',
                        text: 'Are you sure you want to mark this order as ' + statusLabel + '?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Update',
                        cancelButtonText: 'Cancel'
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            HTMLFormElement.prototype.submit.call(form);
                        }
                    });
                });
            });
        });
        function approveReturnConfirm(event, form) {
            event.preventDefault();
            Swal.fire({
                title: 'Approve Return Request?',
                text: 'Are you sure you want to approve this return request?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve',
                cancelButtonText: 'Cancel'
            }).then(function (result) {
                if (result.isConfirmed) {
                    HTMLFormElement.prototype.submit.call(form);
                }
            });
            return false;
        }
    </script>
@endsection
