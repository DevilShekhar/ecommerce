@extends('layouts.app')

@section('title', 'Order Management')

@section('content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Order Management</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Customer</strong> Orders</h2>
                        </div>

                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th width="60">SrNo.</th>
                                            <th>Order</th>
                                            <th>Customer</th>
                                            <th>Email</th>
                                            <th>Items</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($orders as $key => $order)
                                            <tr>
                                                <td>{{ $key + 1 + (($orders->currentPage() - 1) * $orders->perPage()) }}</td>

                                                <td>
                                                    <strong>{{ $order->order_number }}</strong>
                                                </td>

                                                <td>
                                                    @if($order->user)
                                                        <strong>{{ $order->user->name }}</strong>
                                                    @else
                                                        <span class="text-muted">Guest</span>
                                                    @endif
                                                </td>

                                                <td>{{ $order->user->email ?? '-' }}</td>

                                                <td>
                                                    <span class="badge bg-info text-white">
                                                        {{ $order->items_count }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @php
                                                        $sellingTotal = $order->items->sum(function ($item) {
                                                            return (float) ($item->selling_price ?? $item->price ?? 0) * (int) ($item->quantity ?? 1);
                                                        });
                                                        $originalTotal = $order->items->sum(function ($item) {
                                                            return (float) ($item->price ?? 0) * (int) ($item->quantity ?? 1);
                                                        });
                                                    @endphp

                                                    <strong style="color:#198754;">
                                                        ₹{{ number_format($sellingTotal, 2) }}
                                                    </strong>

                                                    @if($originalTotal > $sellingTotal)
                                                        <br>
                                                        <span style="color:#888;font-size:12px;text-decoration:line-through;">
                                                            ₹{{ number_format($originalTotal, 2) }}
                                                        </span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @php
                                                        // Get raw status and clean it
                                                        $rawStatus = $order->order_status ?? 'pending';

                                                        // Remove parentheses and trim
                                                        $status = strtolower(trim(str_replace(['(', ')'], '', $rawStatus)));

                                                        // Display status with parentheses removed
                                                        $displayStatus = ucwords(str_replace('_', ' ', $status));
                                                    @endphp

                                                    @switch($status)
                                                        @case('completed')
                                                        @case('delivered')
                                                            <span class="badge bg-success text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('cancelled')
                                                        @case('canceled')
                                                            <span class="badge bg-danger text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('processing')
                                                            <span class="badge bg-info text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('shipped')
                                                            <span class="badge bg-primary text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('out_for_delivery')
                                                            <span class="badge bg-warning text-dark">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('pending')
                                                            <span class="badge bg-secondary text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('confirmed')
                                                            <span class="badge bg-success text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('return_requested')
                                                            <span class="badge bg-warning text-dark">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('return_approved')
                                                        @case('approved')
                                                            <span class="badge bg-info text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('return_rejected')
                                                        @case('rejected')
                                                            <span class="badge bg-danger text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('refunded')
                                                            <span class="badge bg-success text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @case('returned')
                                                            <span class="badge bg-secondary text-white">{{ $displayStatus }}</span>
                                                            @break

                                                        @default
                                                            <span class="badge bg-secondary text-white">
                                                                {{ $displayStatus }}
                                                            </span>
                                                    @endswitch
                                                </td>

                                                <td>
                                                    {{ $order->created_at ? $order->created_at->format('d M Y h:i A') : '-' }}
                                                </td>

                                                <td>
                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                       class="btn btn-info btn-sm"
                                                       title="View Order">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No orders found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
