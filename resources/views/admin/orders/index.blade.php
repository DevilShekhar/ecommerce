@extends('layouts.app')

@section('title', 'Order Management')

@section('content')
    <section class="content">
        <div class="body_scroll">
            {{-- ========================= PAGE HEADER ========================== --}}
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Order Management</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Orders
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- ========================= MAIN CONTENT ========================== --}}
            <div class="container-fluid">
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- Error Message --}}
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            {{-- Card Header --}}
                            <div class="header">
                                <h2>
                                    <strong>Customer</strong> Orders
                                </h2>
                            </div>
                            {{-- Card Body --}}
                            <div class="body">
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th width="60">
                                                    SrNo.
                                                </th>
                                                <th>
                                                    Order
                                                </th>
                                                <th>
                                                    Customer
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>
                                                    Items
                                                </th>
                                                <th>
                                                    Total
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Order Date
                                                </th>
                                                <th width="100">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orders as $key => $order)
                                                <tr>
                                                    {{-- Sr No --}}
                                                    <td>
                                                        {{ $key + 1 + (($orders->currentPage() - 1) * $orders->perPage()) }}
                                                    </td>
                                                    {{-- Order --}}
                                                    <td>
                                                        <strong>
                                                            {{ $order->order_number }}
                                                        </strong>
                                                    </td>
                                                    {{-- Customer --}}
                                                    <td>
                                                        @if($order->user)
                                                            <strong>
                                                                {{ $order->user->name }}
                                                            </strong>
                                                        @else
                                                            <span class="text-muted">
                                                                Guest
                                                            </span>
                                                        @endif
                                                    </td>
                                                    {{-- Email --}}
                                                    <td>
                                                        {{ $order->user->email ?? '-' }}
                                                    </td>
                                                    {{-- Items --}}
                                                    <td>
                                                        <span class="badge badge-info">
                                                            {{ $order->items_count }}
                                                        </span>
                                                    </td>
                                                    {{-- Total --}}
                                                    <td>
                                                        <strong>
                                                            ₹{{ number_format($order->total ?? 0, 2) }}
                                                        </strong>
                                                    </td>
                                                    {{-- Status --}}
                                                    <td>
                                                        @php
                                                            $status = strtolower($order->order_status ?? 'pending');
                                                        @endphp

                                                        @if($status === 'completed')
                                                            <span class="badge badge-success">
                                                                Completed
                                                            </span>

                                                        @elseif($status === 'cancelled')
                                                            <span class="badge badge-danger">
                                                                Cancelled
                                                            </span>

                                                        @elseif($status === 'processing')
                                                            <span class="badge badge-info">
                                                                Processing
                                                            </span>

                                                        @elseif($status === 'shipped')
                                                            <span class="badge badge-primary">
                                                                Shipped
                                                            </span>

                                                        @elseif($status === 'pending')
                                                            <span class="badge badge-warning">
                                                                Pending
                                                            </span>

                                                        @elseif($status === 'delivered')
                                                            <span class="badge badge-success">
                                                                Delivered
                                                            </span>

                                                        @elseif($status === 'return_requested')
                                                            <span class="badge badge-warning">
                                                                Return Requested
                                                            </span>

                                                        @elseif($status === 'approved' || $status === 'return_approved')
                                                            <span class="badge badge-info">
                                                                Return Approved
                                                            </span>

                                                        @elseif($status === 'rejected' || $status === 'return_rejected')
                                                            <span class="badge badge-danger">
                                                                Return Rejected
                                                            </span>

                                                        @elseif($status === 'refunded')
                                                            <span class="badge badge-success">
                                                                Refunded
                                                            </span>

                                                        @elseif($status === 'returned')
                                                            <span class="badge badge-secondary">
                                                                Returned
                                                            </span>

                                                        @else
                                                            <span class="badge badge-secondary">
                                                                {{ ucwords(str_replace('_', ' ', $status)) }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    {{-- Date --}}
                                                    <td>
                                                        {{ $order->created_at ? $order->created_at->format('d M Y h:i A') : '-' }}
                                                    </td>
                                                    {{-- Action --}}
                                                    <td>
                                                        <a href="{{ route('orders.show', $order->id) }}"
                                                            class="btn btn-info btn-sm" title="View Order">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">
                                                        No orders found.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{-- Pagination --}}
                                @if($orders->hasPages())
                                    <div class="mt-3">
                                        {{ $orders->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
