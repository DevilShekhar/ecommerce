{{-- @can('coupons-list') --}}
@extends('layouts.app')
@section('title', 'Coupons')
@section('content')

    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h2>Coupons</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Coupons</li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <a href="{{ route('coupons.create') }}" class="btn btn-primary">
                            <i class="zmdi zmdi-plus"></i> Create Coupon
                        </a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Coupons</strong> List</h2>
                            </div>

                            <div class="body table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>SrNo.</th>
                                            <th>Code</th>
                                            <th>Brand</th>
                                            <th>Discount Type</th>
                                            <th>Discount Value</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Usage Limit</th>
                                            <th>Used</th>
                                            <th>Min. Order</th>
                                            <th>Max. Discount</th>
                                            <th>Coupon Status</th>
                                            <th>Status</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($coupons as $key => $coupon)
                                            <tr>
                                                <td>{{ $coupons->firstItem() + $key }}</td>
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
                                                <td>{{ $coupon->brand->name ?? '—' }}</td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $coupon->discount_type == 'percentage' ? 'info' : 'warning' }}">
                                                        {{ ucfirst($coupon->discount_type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($coupon->discount_type == 'percentage')
                                                        {{ $coupon->discount_value }}%
                                                    @else
                                                        {{ number_format($coupon->discount_value, 2) }}
                                                    @endif
                                                </td>
                                                <td>{{ $coupon->start_date ? \Carbon\Carbon::parse($coupon->start_date)->format('d M Y') : '—' }}
                                                </td>
                                                <td>{{ $coupon->end_date ? \Carbon\Carbon::parse($coupon->end_date)->format('d M Y') : '—' }}
                                                </td>
                                                <td>{{ $coupon->usage_limit ?? 'Unlimited' }}</td>
                                                <td>{{ $coupon->used_count ?? 0 }}</td>
                                                <td>{{ number_format($coupon->minimum_order_amount ?? 0, 2) }}</td>
                                                <td>{{ $coupon->maximum_discount ? number_format($coupon->maximum_discount, 2) : '—' }}
                                                </td>
                                                <td>
                                                    @if(now()->lt($coupon->start_date))
                                                        <span class="badge badge-warning">Upcoming</span>
                                                    @elseif(now()->gt($coupon->end_date))
                                                        <span class="badge badge-danger">Expired</span>
                                                    @else
                                                        <span class="badge badge-success">Available</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($coupon->status)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('coupons.edit', $coupon->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <a href="{{ route('coupons.show', $coupon->id) }}" class="btn btn-sm btn-info"
                                                        title="View">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </a>

                                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST"
                                                        class="d-inline delete-form" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')

                                                        @if($coupon->status == 1)
                                                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                                title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        @endif
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="14" class="text-center">No coupons found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                @if($coupons->hasPages())
                                    <div class="mt-3">
                                        {{ $coupons->links() }}
                                    </div>
                                @endif
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
