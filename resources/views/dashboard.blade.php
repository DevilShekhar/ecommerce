@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    @php
        $user = Auth::user();
        $roleName = $user?->role?->name;
    @endphp

    <section class="content">
        <div class="body_scroll">

            {{-- ============================
            BLOCK HEADER
            ============================= --}}
            <div class="block-header">

                <div class="row">

                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Welcome, {{ $user->name ?? 'User' }}!</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <i class="zmdi zmdi-home"></i>
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Overview
                            </li>
                        </ul>

                        <button class="btn btn-primary btn-icon mobile_menu" type="button">
                            <i class="zmdi zmdi-sort-amount-desc"></i>
                        </button>
                    </div>

                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                            <i class="zmdi zmdi-arrow-right"></i>
                        </button>
                        @if($roleName === 'SuperAdmin')
                            <div class="btn-group float-right mr-2">

                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="zmdi zmdi-download"></i>
                                    Download Report
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="{{ route('dashboard.download.report') }}">
                                        <i class="zmdi zmdi-file"></i>
                                        Download PDF
                                    </a>

                                    <a class="dropdown-item" href="{{ route('dashboard.download.excel') }}">
                                        <i class="zmdi zmdi-grid"></i>
                                        Download Excel
                                    </a>

                                </div>

                            </div>
                        @endif
                    </div>

                </div>
            </div>


            <div class="container-fluid">
                <div class="dashboard-wrapper">
                    @if($roleName === 'SuperAdmin')
                        <div class="row dashboard-stats-row">
                            {{-- Total Customers --}}
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card dashboard-stat-card stat-customers">
                                    <div class="body">
                                        <div class="stat-card-content">
                                            <div class="stat-icon-box">
                                                <i class="zmdi zmdi-accounts"></i>
                                            </div>
                                            <div class="stat-details">
                                                <span class="stat-title">Total Customers</span>
                                                <h2>{{ number_format($totalCustomers ?? 0) }}</h2>
                                                <div class="stat-subtitle active-text">
                                                    <i class="zmdi zmdi-trending-up"></i>
                                                    {{ number_format($activeCustomers ?? 0) }} Active
                                                </div>
                                            </div>
                                            <div class="stat-bg-icon">
                                                <i class="zmdi zmdi-accounts"></i>
                                            </div>
                                        </div>
                                        <div class="stat-sparkline sparkline-blue">
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Total Products --}}
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card dashboard-stat-card stat-products">
                                    <div class="body">
                                        <div class="stat-card-content">
                                            <div class="stat-icon-box">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="stat-details">
                                                <span class="stat-title">Total Products</span>
                                                <h2>{{ number_format($totalProducts ?? 0) }}</h2>
                                                <div class="stat-subtitle active-text">
                                                    <i class="zmdi zmdi-trending-up"></i>
                                                    {{ number_format($activeProducts ?? 0) }} Active
                                                </div>
                                            </div>
                                            <div class="stat-bg-icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="stat-sparkline sparkline-red">
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Total Brands --}}
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card dashboard-stat-card stat-brands">
                                    <div class="body">
                                        <div class="stat-card-content">
                                            <div class="stat-icon-box">
                                                <i class="zmdi zmdi-label"></i>
                                            </div>
                                            <div class="stat-details">
                                                <span class="stat-title">Total Brands</span>
                                                <h2>{{ number_format($totalBrands ?? 0) }}</h2>
                                                <div class="stat-subtitle active-text">
                                                    <i class="zmdi zmdi-trending-up"></i>
                                                    {{ number_format($activeBrands ?? 0) }} Active
                                                </div>
                                            </div>
                                            <div class="stat-bg-icon">
                                                <i class="zmdi zmdi-label"></i>
                                            </div>
                                        </div>
                                        <div class="stat-sparkline sparkline-purple">
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Categories --}}
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card dashboard-stat-card stat-categories">
                                    <div class="body">
                                        <div class="stat-card-content">
                                            <div class="stat-icon-box">
                                                <i class="zmdi zmdi-view-module"></i>
                                            </div>
                                            <div class="stat-details">
                                                <span class="stat-title">Categories</span>
                                                <h2>{{ number_format($totalCategories ?? 0) }}</h2>
                                                <div class="stat-subtitle">
                                                    Product Categories
                                                </div>
                                            </div>
                                            <div class="stat-bg-icon">
                                                <i class="zmdi zmdi-layers"></i>
                                            </div>
                                        </div>
                                        <div class="stat-sparkline sparkline-green">
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        {{-- ============================================
                        SECOND STATISTICS ROW
                        ============================================ --}}
                        <div class="row dashboard-stats-row">

                            {{-- Total Coupons --}}
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card dashboard-stat-card stat-coupons">
                                    <div class="body">
                                        <div class="stat-card-content">
                                            <div class="stat-icon-box">
                                                <i class="zmdi zmdi-ticket-star"></i>
                                            </div>
                                            <div class="stat-details">
                                                <span class="stat-title">Total Coupons</span>
                                                <h2>{{ number_format($totalCoupons ?? 0) }}</h2>
                                                <div class="stat-subtitle coupon-text">
                                                    <i class="zmdi zmdi-verified"></i>
                                                    {{ number_format($activeCoupons ?? 0) }} Active
                                                </div>
                                            </div>
                                            <div class="stat-bg-icon">
                                                <i class="zmdi zmdi-ticket-star"></i>
                                            </div>
                                        </div>
                                        <div class="stat-sparkline sparkline-orange">
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Total Offers --}}
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card dashboard-stat-card stat-offers">
                                    <div class="body">
                                        <div class="stat-card-content">
                                            <div class="stat-icon-box">
                                                <i class="zmdi zmdi-local-offer"></i>
                                            </div>
                                            <div class="stat-details">
                                                <span class="stat-title">Total Offers</span>
                                                <h2>{{ number_format($totalOffers ?? 0) }}</h2>
                                                <div class="stat-subtitle active-text">
                                                    <i class="zmdi zmdi-trending-up"></i>
                                                    {{ number_format($activeOffers ?? 0) }} Active
                                                </div>
                                            </div>
                                            <div class="stat-bg-icon">
                                                <i class="zmdi zmdi-gift"></i>
                                            </div>
                                        </div>
                                        <div class="stat-sparkline sparkline-yellow">
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Total Stock --}}
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card dashboard-stat-card stat-stock">
                                    <div class="body">
                                        <div class="stat-card-content">
                                            <div class="stat-icon-box">
                                                <i class="zmdi zmdi-storage"></i>
                                            </div>
                                            <div class="stat-details">
                                                <span class="stat-title">Total Stock</span>
                                                <h2>{{ number_format($totalStock ?? 0) }}</h2>
                                                <div class="stat-subtitle">
                                                    Available Units
                                                </div>
                                            </div>
                                            <div class="stat-bg-icon">
                                                <i class="zmdi zmdi-archive"></i>
                                            </div>
                                        </div>
                                        <div class="stat-sparkline sparkline-cyan">
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                            <span></span><span></span><span></span><span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Average Rating --}}
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card dashboard-stat-card stat-rating">
                                    <div class="body">
                                        <div class="stat-card-content">
                                            <div class="stat-icon-box">
                                                <i class="zmdi zmdi-star"></i>
                                            </div>
                                            <div class="stat-details">
                                                <span class="stat-title">Average Rating</span>
                                                <h2>
                                                    {{ number_format($averageRating ?? 0, 1) }}
                                                    <small>/ 5</small>
                                                </h2>
                                                <div class="stat-subtitle">
                                                    {{ number_format($totalRatings ?? 0) }}
                                                    {{ ($totalRatings ?? 0) == 1 ? 'Rating' : 'Ratings' }}
                                                </div>
                                            </div>
                                            <div class="stat-bg-icon">
                                                <i class="zmdi zmdi-star"></i>
                                            </div>
                                        </div>

                                        @php
                                            $rating = min(5, max(0, round($averageRating ?? 0)));
                                            $decimal = ($averageRating ?? 0) - floor($averageRating ?? 0);
                                        @endphp

                                        <div class="rating-stars">

                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= floor($averageRating ?? 0))
                                                    <i class="zmdi zmdi-star"></i>
                                                @elseif($i == ceil($averageRating ?? 0) && $decimal >= 0.3)
                                                    <i class="zmdi zmdi-star-half"></i>
                                                @else
                                                    <i class="zmdi zmdi-star-outline"></i>
                                                @endif
                                            @endfor

                                            <span class="rating-count">
                                                ({{ number_format($totalRatings ?? 0) }})
                                            </span>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <a href="{{ route('admin.contact-submissions.index') }}" class="text-decoration-none">
                            <div class="stat-card-content"
                                style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);padding:20px;border-radius:12px;color:#fff;">
                                <div class="stat-icon-box">
                                    <i class="zmdi zmdi-email"></i>
                                </div>
                                <div class="stat-details">
                                    <span class="stat-title" style="opacity:0.9;color:white; margin-bottom:2rem">Contact
                                        Submissions</span>
                                    <h2 style="margin:8px 0;font-size:32px;">
                                        {{ number_format($contactSubmission->count() ?? 0) }}</h2>
                                    <div class="stat-subtitle active-text"
                                        style="opacity:0.8;display:flex;align-items:center;gap:5px;">
                                        <i class="zmdi zmdi-arrow-right"></i> View All
                                    </div>
                                </div>
                                <div class="stat-bg-icon"
                                    style="position:absolute;right:5px;bottom:0;font-size:70px;opacity:0.1;">
                                    <i class="zmdi zmdi-email"></i>
                                </div>
                            </div>
                        </a>

                        {{-- ============================================
                        INVENTORY OVERVIEW
                        ============================================ --}}
                        <div class="row clearfix">

                            <div class="col-lg-8 col-md-12">

                                <div class="card inventory-card">
                                    <div class="header">
                                        <h2>
                                            <i class="zmdi zmdi-storage"></i>
                                            <strong>Inventory</strong> Overview
                                        </h2>
                                        <div class="header-actions">
                                            <span class="badge bg-soft-primary">Live</span>
                                        </div>
                                    </div>

                                    <div class="body">

                                        <div class="row">

                                            {{-- Stock In --}}
                                            <div class="col-md-4 col-sm-6 mb-3">
                                                <div class="inventory-stat-box inventory-in">
                                                    <div class="inventory-stat-icon">
                                                        <i class="zmdi zmdi-trending-up"></i>
                                                    </div>
                                                    <div class="inventory-stat-info">
                                                        <span class="inventory-stat-label">Total Stock In</span>
                                                        <h3 class="inventory-stat-value">{{ number_format($totalStockIn ?? 0) }}
                                                        </h3>
                                                        <span class="inventory-stat-sub">
                                                            <i class="zmdi zmdi-trending-up"></i>
                                                            Today: {{ number_format($todayStockIn ?? 0) }}
                                                        </span>
                                                    </div>
                                                    <div class="inventory-stat-progress">
                                                        <div class="progress-bar" style="width: 75%;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Stock Out --}}
                                            <div class="col-md-4 col-sm-6 mb-3">
                                                <div class="inventory-stat-box inventory-out">
                                                    <div class="inventory-stat-icon">
                                                        <i class="zmdi zmdi-trending-down"></i>
                                                    </div>
                                                    <div class="inventory-stat-info">
                                                        <span class="inventory-stat-label">Total Stock Out</span>
                                                        <h3 class="inventory-stat-value">
                                                            {{ number_format($totalStockOut ?? 0) }}
                                                        </h3>
                                                        <span class="inventory-stat-sub">
                                                            <i class="zmdi zmdi-trending-down"></i>
                                                            Today: {{ number_format($todayStockOut ?? 0) }}
                                                        </span>
                                                    </div>
                                                    <div class="inventory-stat-progress">
                                                        <div class="progress-bar" style="width: 25%;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Low Stock --}}
                                            <div class="col-md-4 col-sm-6 mb-3">
                                                <div class="inventory-stat-box inventory-low">
                                                    <div class="inventory-stat-icon">
                                                        <i class="zmdi zmdi-alert-circle"></i>
                                                    </div>
                                                    <div class="inventory-stat-info">
                                                        <span class="inventory-stat-label">Low Stock Alert</span>
                                                        <h3 class="inventory-stat-value">
                                                            {{ number_format($lowStockProducts ?? 0) }}
                                                        </h3>
                                                        <span class="inventory-stat-sub">
                                                            <i class="zmdi zmdi-alert-triangle"></i>
                                                            Needs attention
                                                        </span>
                                                    </div>
                                                    <div class="inventory-stat-progress">
                                                        <div class="progress-bar" style="width: 15%;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row mt-3">

                                            {{-- Available Stock --}}
                                            <div class="col-md-6">
                                                <div class="stock-summary-item stock-available">
                                                    <div class="stock-summary-icon">
                                                        <i class="zmdi zmdi-check-circle"></i>
                                                    </div>
                                                    <div class="stock-summary-info">
                                                        <span class="stock-summary-label">Available Stock</span>
                                                        <strong
                                                            class="stock-summary-value">{{ number_format($totalStock ?? 0) }}</strong>
                                                    </div>
                                                    <div class="stock-summary-trend">
                                                        <span class="trend-up">
                                                            <i class="zmdi zmdi-trending-up"></i> +12%
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Out of Stock --}}
                                            <div class="col-md-6">
                                                <div class="stock-summary-item stock-out">
                                                    <div class="stock-summary-icon">
                                                        <i class="zmdi zmdi-close-circle"></i>
                                                    </div>
                                                    <div class="stock-summary-info">
                                                        <span class="stock-summary-label">Out of Stock</span>
                                                        <strong
                                                            class="stock-summary-value">{{ number_format($outOfStockProducts ?? 0) }}</strong>
                                                    </div>
                                                    <div class="stock-summary-trend">
                                                        <span class="trend-down">
                                                            <i class="zmdi zmdi-trending-down"></i> -3%
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>


                            {{-- QUICK ACTIONS --}}
                            <div class="col-lg-4 col-md-12">

                                <div class="card quick-actions-card">
                                    <div class="header">
                                        <h2>
                                            <i class="zmdi zmdi-view-dashboard"></i>
                                            <strong>Quick</strong> Actions
                                        </h2>
                                        <div class="header-actions">
                                            <span class="badge bg-soft-success">Shortcuts</span>
                                        </div>
                                    </div>

                                    <div class="body">

                                        @if(Route::has('products.index'))
                                            <a href="{{ route('products.index') }}" class="quick-action-item">
                                                <span class="quick-action-icon bg-soft-blue">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                </span>
                                                <span class="quick-action-text">Manage Products</span>
                                                <span class="quick-action-arrow">
                                                    <i class="zmdi zmdi-arrow-right"></i>
                                                </span>
                                            </a>
                                        @endif

                                        @if(Route::has('brands.index'))
                                            <a href="{{ route('brands.index') }}" class="quick-action-item">
                                                <span class="quick-action-icon bg-soft-purple">
                                                    <i class="zmdi zmdi-label"></i>
                                                </span>
                                                <span class="quick-action-text">Manage Brands</span>
                                                <span class="quick-action-arrow">
                                                    <i class="zmdi zmdi-arrow-right"></i>
                                                </span>
                                            </a>
                                        @endif

                                        @if(Route::has('coupons.index'))
                                            <a href="{{ route('coupons.index') }}" class="quick-action-item">
                                                <span class="quick-action-icon bg-soft-orange">
                                                    <i class="zmdi zmdi-ticket-star"></i>
                                                </span>
                                                <span class="quick-action-text">Manage Coupons</span>
                                                <span class="quick-action-arrow">
                                                    <i class="zmdi zmdi-arrow-right"></i>
                                                </span>
                                            </a>
                                        @endif

                                        @if(Route::has('offers.index'))
                                            <a href="{{ route('offers.index') }}" class="quick-action-item">
                                                <span class="quick-action-icon bg-soft-yellow">
                                                    <i class="zmdi zmdi-local-offer"></i>
                                                </span>
                                                <span class="quick-action-text">Manage Offers</span>
                                                <span class="quick-action-arrow">
                                                    <i class="zmdi zmdi-arrow-right"></i>
                                                </span>
                                            </a>
                                        @endif

                                        @if(Route::has('orders.index'))
                                            <a href="{{ route('orders.index') }}" class="quick-action-item">
                                                <span class="quick-action-icon bg-soft-green">
                                                    <i class="zmdi zmdi-assignment"></i>
                                                </span>
                                                <span class="quick-action-text">Manage Orders</span>
                                                <span class="quick-action-arrow">
                                                    <i class="zmdi zmdi-arrow-right"></i>
                                                </span>
                                            </a>
                                        @endif

                                    </div>

                                    <div class="quick-actions-footer">
                                        <span class="footer-text">
                                            <i class="zmdi zmdi-time"></i>
                                            Quick access to most used features
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>


                        {{-- ============================================
                        CHARTS
                        ============================================= --}}
                        <div class="row clearfix">

                            {{-- MONTHLY PRODUCTS --}}
                            <div class="col-lg-7 col-md-12">

                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <strong>Monthly Product</strong> Report
                                        </h2>
                                    </div>

                                    <div class="body">
                                        <div class="chart-container">
                                            <canvas id="monthlyProductsChart"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            {{-- CATEGORY WISE --}}
                            <div class="col-lg-5 col-md-12">

                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <strong>Category Wise</strong> Products
                                        </h2>
                                    </div>

                                    <div class="body">
                                        <div class="chart-container small-chart">
                                            <canvas id="categoryProductsChart"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                        {{-- ============================================
                        BRAND REPORT + TOP RATED PRODUCTS
                        ============================================= --}}
                        <div class="row clearfix">

                            {{-- BRAND WISE PRODUCTS --}}
                            <div class="col-lg-6 col-md-12">

                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <strong>Brand Wise</strong> Products
                                        </h2>
                                    </div>

                                    <div class="body p-0">

                                        <div class="table-responsive">
                                            <table class="table dashboard-table mb-0">

                                                <thead>
                                                    <tr>
                                                        <th>SrNo.</th>
                                                        <th>Brand</th>
                                                        <th class="text-right">
                                                            Products
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @forelse($brandWiseProducts ?? [] as $index => $brand)

                                                        <tr>
                                                            <td>
                                                                {{ $index + 1 }}
                                                            </td>

                                                            <td>
                                                                <strong>
                                                                    {{ $brand->name }}
                                                                </strong>
                                                            </td>

                                                            <td class="text-right">
                                                                <span class="count-badge">
                                                                    {{ $brand->total_products }}
                                                                </span>
                                                            </td>
                                                        </tr>

                                                    @empty

                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted py-4">
                                                                No brand data available.
                                                            </td>
                                                        </tr>

                                                    @endforelse

                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>


                            {{-- TOP RATED PRODUCTS --}}
                            <div class="col-lg-6 col-md-12">

                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            <strong>Top Rated</strong> Products
                                        </h2>
                                    </div>

                                    <div class="body p-0">

                                        <div class="table-responsive">
                                            <table class="table dashboard-table mb-0">

                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Rating</th>
                                                        <th class="text-right">
                                                            Reviews
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @forelse($topRatedProducts ?? [] as $product)

                                                        <tr>

                                                            <td>
                                                                <div class="product-table-info">

                                                                    @php
                                                                        $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                                                        $firstImage = $images[0] ?? null;
                                                                        if ($firstImage) {
                                                                            $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                                                            $imgUrl = asset($firstImage);
                                                                        } else {
                                                                            $imgUrl = null;
                                                                        }
                                                                    @endphp

                                                                    @if($imgUrl)
                                                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                                                            class="product-table-img"
                                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                                                        <div class="product-table-placeholder" style="display:none;">
                                                                            <i class="zmdi zmdi-image"></i>
                                                                        </div>
                                                                    @else
                                                                        <div class="product-table-placeholder">
                                                                            <i class="zmdi zmdi-image"></i>
                                                                        </div>
                                                                    @endif

                                                                    <div class="product-table-details">
                                                                        <strong>
                                                                            {{ \Illuminate\Support\Str::limit($product->name, 30) }}
                                                                        </strong>

                                                                        <small>
                                                                            ₹{{ number_format($product->price ?? 0, 2) }}
                                                                        </small>
                                                                    </div>

                                                                </div>
                                                            </td>


                                                            <td>
                                                                <span class="rating-badge">
                                                                    <i class="zmdi zmdi-star"></i>
                                                                    {{ number_format($product->average_rating ?? 0, 1) }}
                                                                </span>
                                                            </td>


                                                            <td class="text-right">
                                                                {{ $product->total_reviews ?? 0 }}
                                                            </td>

                                                        </tr>

                                                    @empty

                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted py-4">
                                                                No ratings available.
                                                            </td>
                                                        </tr>

                                                    @endforelse

                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>


                        {{-- ============================================
                        RECENT PRODUCTS + LOW STOCK
                        ============================================= --}}
                        <div class="row clearfix">

                            {{-- RECENT PRODUCTS --}}
                            <div class="col-lg-7 col-md-12">

                                <div class="card">

                                    <div class="header">
                                        <h2>
                                            <strong>Recent</strong> Products
                                        </h2>
                                    </div>

                                    <div class="body p-0">

                                        <div class="table-responsive">
                                            <table class="table dashboard-table mb-0">

                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Category</th>
                                                        <th>Price</th>
                                                        <th>Stock</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @forelse($recentProducts ?? [] as $product)

                                                        <tr>

                                                            <td>
                                                                <div class="product-table-info">
                                                                    @php
                                                                        $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                                                        $firstImage = $images[0] ?? null;
                                                                        if ($firstImage) {
                                                                            $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                                                            $imgUrl = asset($firstImage);
                                                                        } else {
                                                                            $imgUrl = null;
                                                                        }
                                                                    @endphp

                                                                    @if($imgUrl)
                                                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                                                            class="product-table-img"
                                                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                                                        <div class="product-table-placeholder" style="display:none;">
                                                                            <i class="zmdi zmdi-image"></i>
                                                                        </div>
                                                                    @else
                                                                        <div class="product-table-placeholder">
                                                                            <i class="zmdi zmdi-image"></i>
                                                                        </div>
                                                                    @endif

                                                                    <strong>
                                                                        {{ \Illuminate\Support\Str::limit($product->name, 30) }}
                                                                    </strong>

                                                                </div>
                                                            </td>


                                                            <td>
                                                                {{ $product->category->name ?? '-' }}
                                                            </td>


                                                            <td>
                                                                ₹{{ number_format($product->price ?? 0, 2) }}
                                                            </td>


                                                            <td>
                                                                {{ $product->stock ?? 0 }}
                                                            </td>


                                                            <td>
                                                                @if($product->status == 1)
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

                                                    @empty

                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted py-4">
                                                                No products available.
                                                            </td>
                                                        </tr>

                                                    @endforelse

                                                </tbody>

                                            </table>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- LOW STOCK --}}
                            <div class="col-lg-5 col-md-12">

                                <div class="card">

                                    <div class="header">
                                        <h2>
                                            <strong>Low Stock</strong> Alert
                                        </h2>
                                    </div>

                                    <div class="body low-stock-list">

                                        @forelse($lowStockProductList ?? [] as $product)

                                            <div class="low-stock-item">

                                                <div class="low-stock-product">

                                                    <div class="low-stock-icon">
                                                        <i class="zmdi zmdi-shopping-basket"></i>
                                                    </div>

                                                    <div>
                                                        <strong>
                                                            {{ \Illuminate\Support\Str::limit($product->name, 30) }}
                                                        </strong>

                                                        <small>
                                                            {{ $product->category->name ?? 'No Category' }}
                                                        </small>
                                                    </div>

                                                </div>


                                                <div class="stock-number">
                                                    {{ $product->stock ?? 0 }}
                                                    <small>Units</small>
                                                </div>

                                            </div>

                                        @empty

                                            <div class="dashboard-empty-message">
                                                <i class="zmdi zmdi-check-circle"></i>
                                                <h5>Stock is Looking Good!</h5>
                                                <p>No low stock products found.</p>
                                            </div>

                                        @endforelse

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ============================================
                        RECENT INVENTORY TRANSACTIONS
                        ============================================= --}}
                        <div class="row clearfix">

                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="header">
                                        <h2>
                                            <strong>Recent Inventory</strong> Transactions
                                        </h2>
                                    </div>

                                    <div class="body p-0">

                                        <div class="table-responsive">

                                            <table class="table dashboard-table mb-0">

                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Type</th>
                                                        <th>Quantity</th>
                                                        <th>Before</th>
                                                        <th>After</th>
                                                        <th>Created By</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @forelse($recentInventoryTransactions ?? [] as $transaction)

                                                        <tr>

                                                            <td>
                                                                <strong>
                                                                    {{ $transaction->product->name ?? 'Product Deleted' }}
                                                                </strong>
                                                            </td>


                                                            <td>
                                                                @if($transaction->type === 'stock_in')

                                                                    <span class="badge badge-success">
                                                                        <i class="zmdi zmdi-arrow-downward"></i>
                                                                        Stock In
                                                                    </span>

                                                                @else

                                                                    <span class="badge badge-danger">
                                                                        <i class="zmdi zmdi-arrow-upward"></i>
                                                                        Stock Out
                                                                    </span>

                                                                @endif
                                                            </td>


                                                            <td>
                                                                <strong>
                                                                    {{ $transaction->quantity ?? 0 }}
                                                                </strong>
                                                            </td>


                                                            <td>
                                                                {{ $transaction->stock_before ?? 0 }}
                                                            </td>


                                                            <td>
                                                                {{ $transaction->stock_after ?? 0 }}
                                                            </td>


                                                            <td>
                                                                {{ $transaction->creator->name ?? '-' }}
                                                            </td>


                                                            <td>
                                                                {{ optional($transaction->created_at)->format('d M Y, h:i A') }}
                                                            </td>

                                                        </tr>

                                                    @empty

                                                        <tr>
                                                            <td colspan="7" class="text-center text-muted py-4">
                                                                No inventory transactions available.
                                                            </td>
                                                        </tr>

                                                    @endforelse

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="row clearfix">

                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="header">
                                        <h2>
                                            <strong>Administrator</strong> Information
                                        </h2>
                                    </div>

                                    <div class="body">

                                        <div class="row">

                                            <div class="col-lg-4 col-md-4 mb-3">
                                                <div class="info-box">
                                                    <small>Name</small>
                                                    <h6>{{ $user->name ?? '-' }}</h6>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 col-md-4 mb-3">
                                                <div class="info-box">
                                                    <small>Email</small>
                                                    <h6>{{ $user->email ?? '-' }}</h6>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 col-md-4 mb-3">
                                                <div class="info-box">
                                                    <small>Role</small>
                                                    <h6>
                                                        <span class="badge badge-danger">
                                                            {{ $roleName ?? 'No Role' }}
                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @elseif($roleName === 'customer')

                        <div class="row clearfix">

                            <div class="col-lg-12">

                                <div class="card customer-welcome-card">

                                    <div class="body">

                                        <div class="row align-items-center">

                                            <div class="col-lg-8 col-md-8">

                                                <div class="customer-welcome-content">

                                                    <div class="customer-avatar">
                                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                                    </div>

                                                    <div>
                                                        <h3>
                                                            Hello, {{ $user->name ?? 'Customer' }}! 👋
                                                        </h3>

                                                        <p class="mb-0">
                                                            Welcome back! Explore your wishlist and discover more products.
                                                        </p>
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="col-lg-4 col-md-4 text-md-right mt-3 mt-md-0">

                                                @if(Route::has('shop'))
                                                    <a href="{{ route('shop') }}" class="btn btn-primary">
                                                        <i class="zmdi zmdi-shopping-cart"></i>
                                                        Shop Now
                                                    </a>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- CUSTOMER STATS --}}
                        <div class="row clearfix">

                            <div class="col-lg-4 col-md-6 col-sm-6">

                                <div class="card dashboard-stat-card">
                                    <div class="body text-center">

                                        <div class="stat-icon bg-red-soft">
                                            <i class="zmdi zmdi-favorite"></i>
                                        </div>

                                        <p class="stat-title">
                                            Wishlist Items
                                        </p>

                                        <h3 class="stat-value">
                                            {{ $wishlistCount ?? 0 }}
                                        </h3>

                                        <small class="text-muted">
                                            Your saved products
                                        </small>

                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-4 col-md-6 col-sm-6">

                                <div class="card dashboard-stat-card">
                                    <div class="body text-center">

                                        <div class="stat-icon bg-blue-soft">
                                            <i class="zmdi zmdi-calendar"></i>
                                        </div>

                                        <p class="stat-title">
                                            Member Since
                                        </p>

                                        <h5 class="stat-value-name">
                                            {{ optional($user->created_at)->format('d M Y') }}
                                        </h5>

                                        <small class="text-muted">
                                            Account created date
                                        </small>

                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-4 col-md-6 col-sm-6">

                                <div class="card dashboard-stat-card">
                                    <div class="body text-center">

                                        <div class="stat-icon bg-green-soft">
                                            <i class="zmdi zmdi-check-circle"></i>
                                        </div>

                                        <p class="stat-title">
                                            Account Status
                                        </p>

                                        <h5 class="stat-value-name">
                                            {{ ($user->status ?? 1) == 1 ? 'Active' : 'Inactive' }}
                                        </h5>

                                        <small class="text-muted">
                                            Customer Account
                                        </small>

                                    </div>
                                </div>

                            </div>

                        </div>


                        {{-- WISHLIST PRODUCTS --}}
                        <div class="row clearfix">

                            <div class="col-lg-12">

                                <div class="card">

                                    <div class="header">

                                        <h2>
                                            <strong>My</strong> Wishlist
                                        </h2>

                                        @if(Route::has('customer.wishlist'))
                                            <ul class="header-dropdown">
                                                <li>
                                                    <a href="{{ route('customer.wishlist') }}" class="btn btn-sm btn-primary">
                                                        View All
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif

                                    </div>


                                    <div class="body">

                                        @if(isset($wishlistProducts) && $wishlistProducts->count() > 0)

                                            <div class="row">

                                                @foreach($wishlistProducts->take(8) as $item)

                                                    @if($item->product)

                                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">

                                                            <div class="wishlist-product-card">

                                                                <div class="wishlist-product-image">

                                                                    @if(!empty($item->product->image))

                                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                                            alt="{{ $item->product->name }}">

                                                                    @else

                                                                        <div class="no-product-image">
                                                                            <i class="zmdi zmdi-image"></i>
                                                                        </div>

                                                                    @endif

                                                                </div>


                                                                <div class="wishlist-product-body">

                                                                    <h6>
                                                                        {{ $item->product->name }}
                                                                    </h6>

                                                                    <h5>
                                                                        ₹{{ number_format($item->product->price ?? 0, 2) }}
                                                                    </h5>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    @endif

                                                @endforeach

                                            </div>

                                        @else

                                            <div class="empty-wishlist">

                                                <div class="empty-wishlist-icon">
                                                    <i class="zmdi zmdi-favorite-outline"></i>
                                                </div>

                                                <h4>Your Wishlist is Empty</h4>

                                                <p>
                                                    Save your favorite products here and view them anytime.
                                                </p>

                                                @if(Route::has('shop'))
                                                    <a href="{{ route('shop') }}" class="btn btn-primary">
                                                        <i class="zmdi zmdi-shopping-cart"></i>
                                                        Start Shopping
                                                    </a>
                                                @endif

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- ============================================
                        OTHER ROLES
                        ============================================= --}}
                    @else

                        <div class="card dashboard-empty-card">

                            <div class="body">

                                <div class="empty-content">

                                    <div class="empty-icon">
                                        <i class="zmdi zmdi-info-outline"></i>
                                    </div>

                                    <h4>Dashboard Content Not Configured</h4>

                                    <p class="text-muted">
                                        Your current role is:
                                        <strong>
                                            {{ $roleName ?? 'No Role Assigned' }}
                                        </strong>
                                    </p>

                                    @if(Route::has('home'))
                                        <a href="{{ route('home') }}" class="btn btn-primary">
                                            <i class="zmdi zmdi-home"></i>
                                            Go to Home
                                        </a>
                                    @endif

                                </div>

                            </div>

                        </div>

                    @endif

                </div>
            </div>

        </div>
    </section>

@endsection




@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | MONTHLY PRODUCT CHART
            |--------------------------------------------------------------------------
            */

            const monthlyProductsChart = document.getElementById('monthlyProductsChart');

            if (monthlyProductsChart) {

                new Chart(monthlyProductsChart, {

                    type: 'line',

                    data: {
                        labels: @json($monthlyProductLabels ?? []),

                        datasets: [{
                            label: 'Products Added',

                            data: @json($monthlyProductData ?? []),

                            borderColor: '#00adef',

                            backgroundColor: 'rgba(0, 173, 239, 0.10)',

                            borderWidth: 3,

                            fill: true,

                            tension: 0.4,

                            pointRadius: 4,

                            pointHoverRadius: 6
                        }]
                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        plugins: {
                            legend: {
                                display: false
                            }
                        },

                        scales: {

                            y: {
                                beginAtZero: true,

                                ticks: {
                                    precision: 0
                                },

                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            },

                            x: {
                                grid: {
                                    display: false
                                }
                            }

                        }

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | CATEGORY WISE PRODUCTS CHART
            |--------------------------------------------------------------------------
            */

            const categoryProductsChart =
                document.getElementById('categoryProductsChart');

            if (categoryProductsChart) {

                new Chart(categoryProductsChart, {

                    type: 'doughnut',

                    data: {

                        labels: @json(($categoryWiseProducts ?? collect())->pluck('name')->values()),

                        datasets: [{

                            data: @json(($categoryWiseProducts ?? collect())->pluck('total_products')->values()),

                            backgroundColor: [
                                '#00adef',
                                '#8f78db',
                                '#28a745',
                                '#ff8a00',
                                '#dc3545',
                                '#17a2b8',
                                '#ffc107',
                                '#4b7bec'
                            ],

                            borderWidth: 0
                        }]

                    },

                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        cutout: '68%',

                        plugins: {

                            legend: {
                                position: 'bottom',

                                labels: {
                                    padding: 15,
                                    usePointStyle: true
                                }
                            }

                        }

                    }

                });

            }

        });

    </script>

@endpush
