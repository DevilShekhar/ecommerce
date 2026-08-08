
{{-- @can('coupons-create') --}}
@extends('layouts.app')

@section('title', 'Create Coupon')

@section('content')

<section class="content">
    <div class="body_scroll">

        <div class="block-header">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Create Coupon</h2>

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
                            Create Coupon
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

            <form method="POST" action="{{ route('coupons.store') }}">
                @csrf

                <div class="row clearfix">

                    <!-- Coupon Details -->
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="header">
                                <h2><strong>Create</strong> Coupon</h2>
                            </div>

                            <div class="body">

                                <div class="row">

                                    <!-- Brand -->
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label>
                                                Brand
                                            </label>

                                            <select name="brand_id"
                                                class="form-control @error('brand_id') is-invalid @enderror">

                                                <option value="">
                                                    All Brands
                                                </option>

                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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

                                            <input type="text"
                                                name="code"
                                                class="form-control @error('code') is-invalid @enderror"
                                                placeholder="Enter Coupon Code"
                                                value="{{ old('code') }}"
                                                style="text-transform: uppercase;">

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
                                                id="discount_type"
                                                class="form-control @error('discount_type') is-invalid @enderror">

                                                <option value="">
                                                    Select Discount Type
                                                </option>

                                                <option value="percentage"
                                                    {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>
                                                    Percentage
                                                </option>

                                                <option value="flat"
                                                    {{ old('discount_type') == 'flat' ? 'selected' : '' }}>
                                                    Flat Discount
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

                                            <input type="number"
                                                name="discount_value"
                                                id="discount_value"
                                                step="0.01"
                                                min="0"
                                                class="form-control @error('discount_value') is-invalid @enderror"
                                                placeholder="Enter Discount Value"
                                                value="{{ old('discount_value') }}">

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

                                            <input type="date"
                                                name="start_date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                value="{{ old('start_date') }}">

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

                                            <input type="date"
                                                name="end_date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                value="{{ old('end_date') }}">

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

                                            <label>
                                                Usage Limit
                                            </label>

                                            <input type="number"
                                                name="usage_limit"
                                                min="1"
                                                class="form-control @error('usage_limit') is-invalid @enderror"
                                                placeholder="Leave empty for unlimited usage"
                                                value="{{ old('usage_limit') }}">

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

                                            <label>
                                                Minimum Order Amount
                                            </label>

                                            <input type="number"
                                                name="minimum_order_amount"
                                                min="0"
                                                step="0.01"
                                                class="form-control @error('minimum_order_amount') is-invalid @enderror"
                                                placeholder="Enter Minimum Order Amount"
                                                value="{{ old('minimum_order_amount', 0) }}">

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

                                            <label>
                                                Maximum Discount
                                            </label>

                                            <input type="number"
                                                name="maximum_discount"
                                                id="maximum_discount"
                                                min="0"
                                                step="0.01"
                                                class="form-control @error('maximum_discount') is-invalid @enderror"
                                                placeholder="Enter Maximum Discount"
                                                value="{{ old('maximum_discount') }}">

                                            <small class="text-muted">
                                                Applicable mainly for percentage coupons.
                                            </small>

                                            @error('maximum_discount')
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
                                                value="{{ old('meta_title') }}">

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
                                                placeholder="Example: discount coupon, shopping coupon, ecommerce coupon">{{ old('meta_keyword') }}</textarea>

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
                                                placeholder="Enter Meta Description">{{ old('meta_ads') }}</textarea>

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

                                <a href="{{ route('coupons.index') }}"
                                    class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button type="submit"
                                    class="btn btn-success">
                                    <i class="zmdi zmdi-save"></i>
                                    Create Coupon
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
