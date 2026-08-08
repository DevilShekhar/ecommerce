
{{-- @can('coupons-edit') --}}
@extends('layouts.app')
@section('title', 'Edit Coupon')
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Edit Coupon</h2>

                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="zmdi zmdi-home"></i> Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('coupons.index') }}">Coupons</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Edit Coupon
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

            <form method="POST" action="{{ route('coupons.update', $coupon->id) }}">
                @csrf
                @method('PUT')

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>Edit</strong> Coupon</h2>
                            </div>

                            <div class="body">
                                <div class="row">

                                    <!-- Brand -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="brand_id"
                                                class="form-control @error('brand_id') is-invalid @enderror">
                                                <option value="">Select Brand (Optional)</option>
                                                @foreach($brands ?? [] as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ old('brand_id', $coupon->brand_id) == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Coupon Code -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Coupon Code
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="code"
                                                class="form-control @error('code') is-invalid @enderror"
                                                placeholder="Enter Coupon Code"
                                                value="{{ old('code', $coupon->code) }}">
                                            @error('code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Discount Type -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Discount Type
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="discount_type"
                                                class="form-control @error('discount_type') is-invalid @enderror">
                                                <option value="">Select Discount Type</option>
                                                <option value="percentage"
                                                    {{ old('discount_type', $coupon->discount_type) == 'percentage' ? 'selected' : '' }}>
                                                    Percentage
                                                </option>
                                                <option value="flat"
                                                    {{ old('discount_type', $coupon->discount_type) == 'flat' ? 'selected' : '' }}>
                                                    Flat
                                                </option>
                                            </select>
                                            @error('discount_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Discount Value -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Discount Value
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" step="0.01" name="discount_value"
                                                class="form-control @error('discount_value') is-invalid @enderror"
                                                placeholder="Enter Discount Value"
                                                value="{{ old('discount_value', $coupon->discount_value) }}">
                                            @error('discount_value')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Start Date -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                Start Date
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="start_date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                value="{{ old('start_date', $coupon->start_date ? \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d') : '') }}">
                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>
                                                End Date
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" name="end_date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                value="{{ old('end_date', $coupon->end_date ? \Carbon\Carbon::parse($coupon->end_date)->format('Y-m-d') : '') }}">
                                            @error('end_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Usage Limit -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Usage Limit</label>
                                            <input type="number" name="usage_limit"
                                                class="form-control @error('usage_limit') is-invalid @enderror"
                                                placeholder="Enter Usage Limit (Optional)"
                                                value="{{ old('usage_limit', $coupon->usage_limit) }}">
                                            @error('usage_limit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Minimum Order Amount -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Minimum Order Amount</label>
                                            <input type="number" step="0.01" name="minimum_order_amount"
                                                class="form-control @error('minimum_order_amount') is-invalid @enderror"
                                                placeholder="Enter Minimum Order Amount"
                                                value="{{ old('minimum_order_amount', $coupon->minimum_order_amount) }}">
                                            @error('minimum_order_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Maximum Discount -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maximum Discount</label>
                                            <input type="number" step="0.01" name="maximum_discount"
                                                class="form-control @error('maximum_discount') is-invalid @enderror"
                                                placeholder="Enter Maximum Discount (For Percentage)"
                                                value="{{ old('maximum_discount', $coupon->maximum_discount) }}">
                                            @error('maximum_discount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="checkbox">
                                                <input type="checkbox" name="status" id="status"
                                                    value="1"
                                                    {{ old('status', $coupon->status) ? 'checked' : '' }}>
                                                <label for="status">Active</label>
                                            </div>
                                            @error('status')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Details -->
                    <div class="col-md-12">
                        <div class="card mt-3">
                            <div class="header">
                                <h2><strong>SEO</strong> Details</h2>
                            </div>

                            <div class="body">
                                <div class="row">

                                    <!-- Meta Title -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Title</label>

                                            <input type="text"
                                                name="meta_title"
                                                class="form-control @error('meta_title') is-invalid @enderror"
                                                placeholder="Enter Meta Title"
                                                value="{{ old('meta_title', $coupon->meta_title) }}">

                                            @error('meta_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meta Keywords -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Keywords</label>

                                            <textarea name="meta_keyword"
                                                rows="3"
                                                class="form-control @error('meta_keyword') is-invalid @enderror"
                                                placeholder="Example: discount coupon, shopping coupon, ecommerce coupon">{{ old('meta_keyword', $coupon->meta_keyword) }}</textarea>

                                            @error('meta_keyword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Meta Description -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Meta Description</label>

                                            <textarea name="meta_ads"
                                                rows="4"
                                                class="form-control @error('meta_ads') is-invalid @enderror"
                                                placeholder="Enter Meta Description">{{ old('meta_ads', $coupon->meta_ads) }}</textarea>

                                            @error('meta_ads')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body text-right">
                                <a href="{{ route('coupons.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i>
                                    Update Coupon
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</section>

@endsection
{{-- @else
@php
    abort(403);
@endphp
@endcan --}}
