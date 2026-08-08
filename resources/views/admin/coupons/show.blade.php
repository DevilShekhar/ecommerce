{{-- @can('coupons.show') --}}
@extends('layouts.app')

@section('title', 'View Coupon')

@section('content')

    <section class="content">
        <div class="body_scroll">

            <!-- Page Header -->
            <div class="block-header">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>View Coupon</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('coupons.index') }}">
                                    Coupons
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                View Coupon
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('coupons.index') }}" class="btn btn-danger">
                            <i class="zmdi zmdi-arrow-left"></i>
                            Back
                        </a>
                    </div>

                </div>
            </div>

            <div class="container-fluid">

                <div class="row clearfix">

                    <!-- Coupon Information - 6 Columns -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">

                            <div class="header">
                                <h2>
                                    <strong>Coupon</strong> Information
                                </h2>
                            </div>

                            <div class="body">

                                <table class="table table-bordered">

                                    <tr>
                                        <th width="180">Brand</th>
                                        <td>
                                            {{ $coupon->brand->name ?? 'All Brands' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Coupon Code</th>
                                        <td>
                                            <span class="voucher-code-display" style="cursor:pointer"
                                                onclick="toggleVoucherCode(this)">
                                                <span class="voucher-code-hidden">*******</span>
                                                <span class="voucher-code-visible" style="display:none;">
                                                    {{ $coupon->code }}
                                                </span>
                                                <i class="zmdi zmdi-eye voucher-eye-icon ms-1 text-secondary"
                                                    style="font-size: 16px;"></i>
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Discount Type</th>
                                        <td>
                                            @if($coupon->discount_type === 'percentage')
                                                Percentage
                                            @else
                                                Flat Discount
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Discount Value</th>
                                        <td>
                                            @if($coupon->discount_type === 'percentage')
                                                {{ $coupon->discount_value }}%
                                            @else
                                                {{ $coupon->discount_value }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Start Date</th>
                                        <td>
                                            {{ $coupon->start_date
        ? \Carbon\Carbon::parse($coupon->start_date)->format('d M Y')
        : '-' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>End Date</th>
                                        <td>
                                            {{ $coupon->end_date
        ? \Carbon\Carbon::parse($coupon->end_date)->format('d M Y')
        : '-' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Usage Limit</th>
                                        <td>
                                            {{ $coupon->usage_limit ?? 'Unlimited' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Used Count</th>
                                        <td>
                                            {{ $coupon->used_count ?? 0 }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Minimum Order Amount</th>
                                        <td>
                                            {{ $coupon->minimum_order_amount ?? 0 }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Maximum Discount</th>
                                        <td>
                                            {{ $coupon->maximum_discount ?? 'No Limit' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Coupon Status</th>
                                        <td>
                                            @if(now()->lt(\Carbon\Carbon::parse($coupon->start_date)))
                                                <span class="badge badge-warning">
                                                    Upcoming
                                                </span>
                                            @elseif(now()->gt(\Carbon\Carbon::parse($coupon->end_date)))
                                                <span class="badge badge-danger">
                                                    Expired
                                                </span>
                                            @else
                                                <span class="badge badge-success">
                                                    Active
                                                </span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($coupon->status)
                                                <span class="badge badge-success">
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>

                    <!-- SEO Information - 6 Columns -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">

                            <div class="header">
                                <h2>
                                    <strong>SEO</strong> Information
                                </h2>
                            </div>

                            <div class="body">

                                <table class="table table-bordered">

                                    <tr>
                                        <th width="180">Meta Title</th>
                                        <td>
                                            {{ $coupon->meta_title ?: '-' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Meta Keywords</th>
                                        <td>
                                            {{ $coupon->meta_keyword ?: '-' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Meta Description</th>
                                        <td>
                                            {{ $coupon->meta_ads ?: '-' }}
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>

                    <!-- Audit Information - 12 Columns -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">

                            <div class="header">
                                <h2>
                                    <strong>Audit</strong> Information
                                </h2>
                            </div>

                            <div class="body">

                                <table class="table table-bordered">

                                    <tr>
                                        <th width="220">Created By</th>
                                        <td>
                                            {{ optional($coupon->createdBy)->name ?? '-' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Updated By</th>
                                        <td>
                                            {{ optional($coupon->updatedBy)->name ?? '-' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Created At</th>
                                        <td>
                                            {{ $coupon->created_at
        ? $coupon->created_at->format('d M Y h:i A')
        : '-' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Last Updated</th>
                                        <td>
                                            {{ $coupon->updated_at
        ? $coupon->updated_at->format('d M Y h:i A')
        : '-' }}
                                        </td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="body text-right">

                                <a href="{{ route('coupons.index') }}" class="btn btn-secondary">

                                    <i class="zmdi zmdi-arrow-left"></i>
                                    Back to List

                                </a>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
<script>
        function toggleVoucherCode(element) {
            const hidden = element.querySelector('.voucher-code-hidden');
            const visible = element.querySelector('.voucher-code-visible');
            const icon = element.querySelector('.voucher-eye-icon');

            if (visible.style.display === 'none') {
                // Show code
                hidden.style.display = 'none';
                visible.style.display = 'inline';
                icon.classList.remove('zmdi-eye');
                icon.classList.add('zmdi-eye-off');
            } else {
                // Hide code
                hidden.style.display = 'inline';
                visible.style.display = 'none';
                icon.classList.remove('zmdi-eye-off');
                icon.classList.add('zmdi-eye');
            }
        }
    </script>
@endsection

{{-- @else

@php
abort(403);
@endphp

@endcan --}}
