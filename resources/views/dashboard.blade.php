

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
                                Aero
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ul>

                    <button class="btn btn-primary btn-icon mobile_menu"
                            type="button">
                        <i class="zmdi zmdi-sort-amount-desc"></i>
                    </button>
                </div>

                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn"
                            type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>

            </div>
        </div>


        <div class="container-fluid">
            <div class="dashboard-wrapper">


                {{-- ============================================
                    SUPER ADMIN DASHBOARD
                ============================================= --}}
                @if($roleName === 'SuperAdmin')

                    {{-- TOP STATISTICS --}}
                    <div class="row clearfix">

                        {{-- Total Customers --}}
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="card dashboard-stat-card">
                                <div class="body text-center">

                                    <div class="stat-icon bg-blue-soft">
                                        <i class="zmdi zmdi-accounts"></i>
                                    </div>

                                    <p class="stat-title">
                                        Total Customers
                                    </p>

                                    <h3 class="stat-value">
                                        {{ $totalCustomers ?? 0 }}
                                    </h3>

                                    <small class="text-muted">
                                        Registered Customers
                                    </small>

                                </div>
                            </div>
                        </div>


                        {{-- Total Products --}}
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="card dashboard-stat-card">
                                <div class="body text-center">

                                    <div class="stat-icon bg-red-soft">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>

                                    <p class="stat-title">
                                        Total Products
                                    </p>

                                    <h3 class="stat-value">
                                        {{ $totalProducts ?? 0 }}
                                    </h3>

                                    <small class="text-muted">
                                        Available Products
                                    </small>

                                </div>
                            </div>
                        </div>


                        {{-- Wishlist --}}
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="card dashboard-stat-card">
                                <div class="body text-center">

                                    <div class="stat-icon bg-purple-soft">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </div>

                                    <p class="stat-title">
                                        Wishlist Items
                                    </p>

                                    <h3 class="stat-value">
                                        {{ $totalWishlist ?? 0 }}
                                    </h3>

                                    <small class="text-muted">
                                        All Customer Wishlist
                                    </small>

                                </div>
                            </div>
                        </div>


                        {{-- Admin --}}
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="card dashboard-stat-card">
                                <div class="body text-center">

                                    <div class="stat-icon bg-green-soft">
                                        <i class="zmdi zmdi-account"></i>
                                    </div>

                                    <p class="stat-title">
                                        Logged In As
                                    </p>

                                    <h5 class="stat-value-name">
                                        {{ $user->name }}
                                    </h5>

                                    <small class="text-muted">
                                        Super Administrator
                                    </small>

                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- ADMIN OVERVIEW --}}
                    <div class="row clearfix">

                        <div class="col-lg-8 col-md-12">

                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Dashboard</strong> Overview
                                    </h2>
                                </div>

                                <div class="body">

                                    <div class="row">

                                        <div class="col-md-4 col-sm-4 text-center mb-4">
                                            <div class="overview-item">
                                                <div class="overview-icon">
                                                    <i class="zmdi zmdi-accounts"></i>
                                                </div>

                                                <h3>
                                                    {{ $totalCustomers ?? 0 }}
                                                </h3>

                                                <span>
                                                    Customers
                                                </span>
                                            </div>
                                        </div>


                                        <div class="col-md-4 col-sm-4 text-center mb-4">
                                            <div class="overview-item">
                                                <div class="overview-icon">
                                                    <i class="zmdi zmdi-shopping-basket"></i>
                                                </div>

                                                <h3>
                                                    {{ $totalProducts ?? 0 }}
                                                </h3>

                                                <span>
                                                    Products
                                                </span>
                                            </div>
                                        </div>


                                        <div class="col-md-4 col-sm-4 text-center mb-4">
                                            <div class="overview-item">
                                                <div class="overview-icon">
                                                    <i class="zmdi zmdi-favorite"></i>
                                                </div>

                                                <h3>
                                                    {{ $totalWishlist ?? 0 }}
                                                </h3>

                                                <span>
                                                    Wishlist Items
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>


                        {{-- QUICK ACTIONS --}}
                        <div class="col-lg-4 col-md-12">

                            <div class="card">
                                <div class="header">
                                    <h2>
                                        <strong>Quick</strong> Actions
                                    </h2>
                                </div>

                                <div class="body">

                                    @if(Route::has('users.index'))
                                        <a href="{{ route('users.index') }}"
                                           class="quick-action-btn">
                                            <span>
                                                <i class="zmdi zmdi-accounts"></i>
                                                Manage Users
                                            </span>

                                            <i class="zmdi zmdi-arrow-right"></i>
                                        </a>
                                    @endif


                                    @if(Route::has('products.index'))
                                        <a href="{{ route('products.index') }}"
                                           class="quick-action-btn">
                                            <span>
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                                Manage Products
                                            </span>

                                            <i class="zmdi zmdi-arrow-right"></i>
                                        </a>
                                    @endif


                                    @if(Route::has('product_categories.index'))
                                        <a href="{{ route('product_categories.index') }}"
                                           class="quick-action-btn">
                                            <span>
                                                <i class="zmdi zmdi-view-list"></i>
                                                Categories
                                            </span>

                                            <i class="zmdi zmdi-arrow-right"></i>
                                        </a>
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- ADMIN INFORMATION --}}
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
                                                <h6>{{ $user->name }}</h6>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 mb-3">
                                            <div class="info-box">
                                                <small>Email</small>
                                                <h6>{{ $user->email }}</h6>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 mb-3">
                                            <div class="info-box">
                                                <small>Role</small>
                                                <h6>
                                                    <span class="badge badge-danger">
                                                        {{ $roleName }}
                                                    </span>
                                                </h6>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>



                {{-- ============================================
                    CUSTOMER DASHBOARD
                ============================================= --}}
                @elseif($roleName === 'customer')

                    {{-- CUSTOMER WELCOME --}}
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
                                                        Hello, {{ $user->name }}! 👋
                                                    </h3>

                                                    <p class="mb-0">
                                                        Welcome back! Explore your wishlist and discover more products.
                                                    </p>
                                                </div>

                                            </div>

                                        </div>


                                        <div class="col-lg-4 col-md-4 text-md-right mt-3 mt-md-0">

                                            @if(Route::has('shop'))
                                                <a href="{{ route('shop') }}"
                                                   class="btn btn-primary">
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

                        {{-- Wishlist Count --}}
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


                        {{-- Member Since --}}
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


                        {{-- Account Status --}}
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
                                        Active
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
                                                <a href="{{ route('customer.wishlist') }}"
                                                   class="btn btn-sm btn-primary">
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

                                                            {{-- Product Image --}}
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


                                                            {{-- Product Details --}}
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

                                        {{-- EMPTY WISHLIST --}}
                                        <div class="empty-wishlist">

                                            <div class="empty-wishlist-icon">
                                                <i class="zmdi zmdi-favorite-outline"></i>
                                            </div>

                                            <h4>Your Wishlist is Empty</h4>

                                            <p>
                                                Save your favorite products here and view them anytime.
                                            </p>

                                            @if(Route::has('shop'))
                                                <a href="{{ route('shop') }}"
                                                   class="btn btn-primary">
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
                                    <strong>{{ $roleName ?? 'No Role Assigned' }}</strong>
                                </p>

                                @if(Route::has('home'))
                                    <a href="{{ route('home') }}"
                                       class="btn btn-primary">
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


@push('css')
<style>

    /* ==========================================
       MAIN BACKGROUND
    ========================================== */

    .content {
        background:
            radial-gradient(circle at top right, rgba(0, 173, 239, 0.10), transparent 35%),
            radial-gradient(circle at bottom left, rgba(143, 120, 219, 0.08), transparent 40%),
            linear-gradient(135deg, #f5f7fb 0%, #eef2f7 100%);
        min-height: 100vh;
    }

    .body_scroll {
        min-height: 100vh;
        padding-bottom: 30px;
    }


    /* ==========================================
       MAIN WRAPPER
    ========================================== */

    .dashboard-wrapper {
        background: rgba(255, 255, 255, 0.65);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 30px rgba(30, 50, 80, 0.06);
    }


    /* ==========================================
       CARDS
    ========================================== */

    .dashboard-wrapper .card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .dashboard-wrapper .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.10);
    }


    /* ==========================================
       HEADER
    ========================================== */

    .block-header h2 {
        font-weight: 700;
        color: #2c3e50;
    }


    /* ==========================================
       STATISTICS
    ========================================== */

    .dashboard-stat-card {
        height: 100%;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        border-radius: 15px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 26px;
    }

    .bg-blue-soft {
        background: rgba(0, 173, 239, 0.12);
        color: #00adef;
    }

    .bg-red-soft {
        background: rgba(238, 37, 88, 0.12);
        color: #ee2558;
    }

    .bg-purple-soft {
        background: rgba(143, 120, 219, 0.12);
        color: #8f78db;
    }

    .bg-green-soft {
        background: rgba(40, 167, 69, 0.12);
        color: #28a745;
    }

    .stat-title {
        color: #7b8794;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .stat-value-name {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 5px;
    }


    /* ==========================================
       OVERVIEW
    ========================================== */

    .overview-item {
        padding: 20px 10px;
        border-radius: 12px;
        background: #f8faff;
    }

    .overview-icon {
        font-size: 25px;
        margin-bottom: 10px;
        color: #00adef;
    }

    .overview-item h3 {
        margin-bottom: 5px;
        font-weight: 700;
    }

    .overview-item span {
        color: #8a94a6;
        font-size: 13px;
    }


    /* ==========================================
       QUICK ACTIONS
    ========================================== */

    .quick-action-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 13px 15px;
        margin-bottom: 10px;

        border-radius: 10px;
        background: #f7f9fc;

        color: #4b5563;
        text-decoration: none;

        transition: all 0.25s ease;
    }

    .quick-action-btn:hover {
        background: #00adef;
        color: #ffffff;
        text-decoration: none;
    }

    .quick-action-btn span i {
        margin-right: 8px;
    }


    /* ==========================================
       ADMIN INFO
    ========================================== */

    .info-box {
        padding: 15px;
        background: #f8faff;
        border-radius: 10px;
        height: 100%;
    }

    .info-box small {
        color: #8a94a6;
        display: block;
        margin-bottom: 5px;
    }


    /* ==========================================
       CUSTOMER WELCOME
    ========================================== */

    .customer-welcome-card {
        background:
            linear-gradient(
                135deg,
                rgba(0, 173, 239, 0.08),
                rgba(143, 120, 219, 0.08)
            );
    }

    .customer-welcome-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .customer-avatar {
        width: 65px;
        height: 65px;
        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: linear-gradient(135deg, #00adef, #4b7bec);

        color: #ffffff;
        font-size: 25px;
        font-weight: 700;

        flex-shrink: 0;
    }

    .customer-welcome-content h3 {
        margin-bottom: 5px;
        color: #2c3e50;
        font-weight: 700;
    }

    .customer-welcome-content p {
        color: #7b8794;
    }


    /* ==========================================
       WISHLIST PRODUCT
    ========================================== */

    .wishlist-product-card {
        height: 100%;
        border-radius: 12px;
        overflow: hidden;

        background: #ffffff;
        border: 1px solid #edf0f5;

        transition: all 0.3s ease;
    }

    .wishlist-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .wishlist-product-image {
        height: 190px;
        background: #f7f9fc;

        display: flex;
        align-items: center;
        justify-content: center;

        overflow: hidden;
    }

    .wishlist-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-product-image {
        font-size: 45px;
        color: #c4cbd4;
    }

    .wishlist-product-body {
        padding: 15px;
    }

    .wishlist-product-body h6 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 10px;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .wishlist-product-body h5 {
        color: #00adef;
        font-weight: 700;
        margin-bottom: 0;
    }


    /* ==========================================
       EMPTY WISHLIST
    ========================================== */

    .empty-wishlist {
        text-align: center;
        padding: 45px 20px;
    }

    .empty-wishlist-icon {
        width: 80px;
        height: 80px;

        margin: 0 auto 20px;
        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(238, 37, 88, 0.08);
        color: #ee2558;

        font-size: 35px;
    }

    .empty-wishlist h4 {
        color: #2c3e50;
        font-weight: 700;
    }

    .empty-wishlist p {
        color: #8a94a6;
    }


    /* ==========================================
       EMPTY ROLE DASHBOARD
    ========================================== */

    .dashboard-empty-card {
        min-height: 330px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: linear-gradient(
            135deg,
            #ffffff 0%,
            #f8faff 100%
        );
    }

    .dashboard-empty-card .empty-content {
        text-align: center;
    }

    .dashboard-empty-card .empty-icon {
        width: 75px;
        height: 75px;

        margin: 0 auto 20px;
        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: linear-gradient(135deg, #eef5ff, #e5edff);
        color: #4b7bec;

        font-size: 32px;
    }


    /* ==========================================
       RESPONSIVE
    ========================================== */

    @media (max-width: 767px) {

        .dashboard-wrapper {
            padding: 12px;
        }

        .customer-welcome-content {
            align-items: flex-start;
        }

        .stat-value {
            font-size: 22px;
        }

        .wishlist-product-image {
            height: 160px;
        }
    }

</style>
@endpush
