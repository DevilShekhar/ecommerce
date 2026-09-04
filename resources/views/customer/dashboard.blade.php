@extends('frontend.layouts.customer-layout')

@section('title', 'My Dashboard - Aethelweave')

@section('styles')
    <style>
        /* =========================================================
           DASHBOARD STYLES
        ========================================================= */
        .welcome-card h3 {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px
        }

        .dashboard-banner-img {
            height: 500px;
            object-fit: cover;
            border-radius: 8px;
        }

        .banner-link {
            display: block;
            text-decoration: none;
            position: relative;
        }

        .banner-overlay {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.6);
            padding: 10px 20px;
            border-radius: 8px;
            color: #fff;
        }

        .banner-overlay h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .category-icons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .cat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #334155;
            transition: all 0.2s;
            flex: 0 0 auto;
            min-width: 60px;
        }

        .cat-item:hover {
            color: #2878f0;
            transform: translateY(-2px);
        }

        .cat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #f1f6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #2878f0;
            margin-bottom: 6px;
            overflow: hidden;
        }

        .cat-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cat-item span {
            font-size: 11px;
            font-weight: 500;
            text-align: center;
        }

        .profile-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .profile-avatar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #2878f0;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit-profile-link {
            font-size: 12px;
            color: #2878f0;
            text-decoration: none;
        }

        .edit-profile-link:hover {
            text-decoration: underline;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        .stat-box {
            text-align: center;
            padding: 10px;
            background: #f8fafc;
            border-radius: 8px;
        }

        .stat-box h4 {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .stat-box span {
            font-size: 12px;
            color: #64748b;
            display: block;
        }

        .stat-box a {
            font-size: 11px;
            color: #2878f0;
            text-decoration: none;
        }

        .stat-box a:hover {
            text-decoration: underline;
        }

        .section-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-header h5 {
            font-weight: 700;
            margin: 0;
            font-size: 16px;
        }

        .view-all {
            font-size: 13px;
            color: #2878f0;
            text-decoration: none;
            font-weight: 500;
        }

        .view-all:hover {
            text-decoration: underline;
        }

        .order-status-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .order-status-item {
            text-align: center;
            padding: 10px;
            background: #f8fafc;
            border-radius: 8px;
        }

        .status-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 6px;
            font-size: 18px;
        }

        .status-icon.pending {
            background: #fef3c7;
            color: #d97706;
        }
        .status-icon.confirmed {
            background: #dbeafe;
            color: #2563eb;
        }
        .status-icon.shipped {
            background: #e0e7ff;
            color: #4f46e5;
        }
        .status-icon.delivered {
            background: #d1fae5;
            color: #059669;
        }
        .status-icon.cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-label {
            font-size: 11px;
            color: #64748b;
            display: block;
        }

        .order-status-item strong {
            font-size: 18px;
            display: block;
            color: #0f172a;
        }

        .top-categories {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .top-cat {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #f8fafc;
            border-radius: 8px;
            text-decoration: none;
            color: #334155;
            transition: all 0.2s;
        }

        .top-cat:hover {
            background: #f1f6ff;
            color: #2878f0;
            transform: translateX(4px);
        }

        .top-cat-placeholder {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #eef5ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2878f0;
            flex-shrink: 0;
            overflow: hidden;
        }

        .top-cat-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .top-cat span {
            font-size: 13px;
            font-weight: 500;
        }

        .product-slider {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 15px;
        }

        .product-card {
            background: #fff;
            border: 1px solid #e5eaf1;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.2s;
            position: relative;
        }

        .product-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .product-img {
            position: relative;
            height: 150px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-img {
            color: #94a3b8;
            font-size: 30px;
        }

        .wishlist-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 5;
        }

        .wishlist-btn:hover {
            background: #fff;
            transform: scale(1.1);
        }

        .wishlist-btn.active {
            color: #ef4444;
        }

        .wishlist-btn.active i {
            color: #ef4444;
        }

        .product-info {
            padding: 10px 12px 12px;
        }

        .product-info h6 {
            font-size: 13px;
            font-weight: 500;
            margin: 0 0 4px;
            color: #172033;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 36px;
        }

        .product-info .price .current {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }

        .benefits-bar {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 15px;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-top: 20px;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .benefit-item i {
            font-size: 24px;
            color: #2878f0;
        }

        .benefit-item div {
            display: flex;
            flex-direction: column;
        }

        .benefit-item strong {
            font-size: 13px;
            color: #0f172a;
        }

        .benefit-item small {
            font-size: 11px;
            color: #64748b;
        }

        .offer-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: #ef4444;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 4px;
            z-index: 6;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .offer-badge.fixed {
            background: #f59e0b;
        }

        @media (max-width: 992px) {
            .order-status-row {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 768px) {
            .order-status-row {
                grid-template-columns: repeat(3, 1fr);
            }
            .profile-stats {
                grid-template-columns: repeat(3, 1fr);
            }
            .benefits-bar {
                grid-template-columns: repeat(2, 1fr);
            }
            .product-slider {
                grid-template-columns: repeat(2, 1fr);
            }
            .top-categories {
                grid-template-columns: 1fr;
            }
            .category-icons {
                gap: 10px;
            }
            .cat-item {
                flex: 0 0 calc(20% - 10px);
            }
            .banner-overlay h4 {
                font-size: 14px;
            }
            .banner-overlay {
                padding: 6px 12px;
                bottom: 10px;
                left: 10px;
            }
        }

        @media (max-width: 576px) {
            .order-status-row {
                grid-template-columns: repeat(2, 1fr);
            }
            .benefits-bar {
                grid-template-columns: 1fr;
            }
            .product-slider {
                grid-template-columns: repeat(2, 1fr);
            }
            .cat-item {
                flex: 0 0 calc(25% - 10px);
            }
            .cat-icon {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            .cat-item span {
                font-size: 10px;
            }
            .dashboard-banner-img {
                height: 100px;
            }
            .profile-stats {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endsection

@section('content')

<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="welcome-card">
            <h3>Welcome back, {{ explode(' ', $user->name)[0] }}! 👋</h3>
            <p class="text-muted mb-3">What are you shopping for today?</p>

            <div class="category-icons">
                @foreach($categories as $cat)
                    <a href="{{ route('customer.products', ['category' => $cat->slug]) }}" class="cat-item">
                        <div class="cat-icon">
                            @if($cat->image)
                                <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}">
                            @else
                                <i class="bi bi-tag"></i>
                            @endif
                        </div>
                        <span>{{ $cat->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="profile-card">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="profile-avatar d-flex align-items-center justify-content-center">
                    {{ strtoupper(substr(trim($user->name), 0, 1)) }}
                </div>
                <div>
                    <h5 class="mb-0">{{ $user->name }}</h5>
                    <small class="text-muted">{{ $user->email }}</small>
                    <div>
                        <a href="{{ route('account.settings') }}" class="edit-profile-link">
                            <i class="bi bi-pencil"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
            <div class="profile-stats">
                <div class="stat-box">
                    <h4>{{ $orderCount ?? 0 }}</h4>
                    <span>Orders</span>
                    <a href="{{ route('customer.orders.index') }}">View all</a>
                </div>
                <div class="stat-box">
                    <h4 id="wishlistCountDisplay">{{ $wishlistCount }}</h4>
                    <span>Wishlist</span>
                    <a href="{{ route('customer.wishlist') }}">View all</a>
                </div>
                <div class="stat-box">
                    <h4>{{ $couponCount ?? 0 }}</h4>
                    <span>Coupons</span>
                    <a href="#">View all</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dynamic Banners -->
@if(isset($banners) && $banners->count() > 0)
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="section-card">
                <div class="section-header">
                    <h5><i class="bi bi-images"></i> Featured Offers</h5>
                </div>
                <div id="dashboardBannerCarousel" class="carousel slide" data-bs-ride="carousel">
                    @if($banners->count() > 1)
                        <div class="carousel-indicators">
                            @foreach($banners as $index => $banner)
                                <button type="button" data-bs-target="#dashboardBannerCarousel"
                                    data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    @endif
                    <div class="carousel-inner">
                        @foreach($banners as $index => $banner)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <a href="{{ $banner->link_url ?? '#' }}" class="banner-link" target="_blank">
                                    <img src="{{ asset('storage/' . $banner->image) }}"
                                        class="d-block w-100 dashboard-banner-img"
                                        alt="{{ $banner->title ?? 'Banner' }}">
                                    @if($banner->title)
                                        <div class="banner-overlay">
                                            <h4>{{ $banner->title }}</h4>
                                            @if($banner->subtitle)
                                                <p style="margin:0;font-size:12px;opacity:0.9;">{{ $banner->subtitle }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if($banners->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#dashboardBannerCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#dashboardBannerCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Sent Offers & Coupons -->
@if(isset($sentOffers) && $sentOffers->count() > 0)
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="section-card">
                <div class="section-header">
                    <div>
                        <h5>🎯 Offers & Coupons For You</h5>
                        <small class="text-muted">Exclusive offers and coupons sent to you</small>
                    </div>
                    <span style="background:#f1f6ff;color:#2878f0;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
                        {{ $sentOffers->count() }} Available
                    </span>
                </div>
                <div class="row g-3">
                    @foreach($sentOffers as $sentOffer)
                        @php $offer = $sentOffer->offer; @endphp
                        <div class="col-lg-4 col-md-6">
                            <div style="border:1px solid #e5eaf1;border-radius:12px;padding:18px;height:100%;background:#fff;position:relative;overflow:hidden;transition:all 0.3s ease;">
                                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg, #2878f0, #1a5fc7);"></div>
                                @if($offer)
                                    <div style="position:absolute;top:12px;right:12px;background:#ef4444;color:#fff;font-size:10px;font-weight:700;padding:3px 10px;border-radius:5px;">
                                        @if($offer->discount_type === 'percentage')
                                            {{ rtrim(rtrim(number_format($offer->discount_value, 2), '0'), '.') }}% OFF
                                        @else
                                            ₹{{ number_format($offer->discount_value, 0) }} OFF
                                        @endif
                                    </div>
                                    <div style="padding-right:75px;">
                                        <h6 style="margin:0 0 6px;font-size:15px;font-weight:700;color:#172033;">{{ $offer->title }}</h6>
                                        @if(!empty($offer->description))
                                            <p style="margin:0;font-size:12px;color:#64748b;">{{ Str::limit($offer->description, 100) }}</p>
                                        @endif
                                    </div>
                                @endif
                                @if($sentOffer->coupon_code)
                                    <div style="margin-top:15px;padding:10px 12px;background:#f8fafc;border:1px dashed #2878f0;border-radius:8px;display:flex;justify-content:space-between;align-items:center;">
                                        <div>
                                            <small style="display:block;font-size:9px;color:#64748b;margin-bottom:2px;">COUPON CODE</small>
                                            <strong style="font-size:14px;color:#2878f0;letter-spacing:1px;">{{ $sentOffer->coupon_code }}</strong>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="copyCoupon('{{ $sentOffer->coupon_code }}', this)" style="font-size:10px;padding:4px 10px;">
                                            <i class="bi bi-copy"></i> Copy
                                        </button>
                                    </div>
                                @endif
                                <div style="margin-top:12px;font-size:11px;color:#94a3b8;">
                                    <i class="bi bi-calendar3"></i> Sent {{ $sentOffer->sent_at ? $sentOffer->sent_at->format('d M Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Orders + Top Categories -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="section-card">
            <div class="section-header">
                <h5>📦 Your Orders</h5>
                <a href="{{ route('customer.orders.index') }}" class="view-all">View All <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="order-status-row">
                <div class="order-status-item">
                    <div class="status-icon pending"><i class="bi bi-clock"></i></div>
                    <span class="status-label">Pending</span>
                    <strong>{{ $orderStatusCounts['pending'] ?? 0 }}</strong>
                </div>
                <div class="order-status-item">
                    <div class="status-icon confirmed"><i class="bi bi-check-circle"></i></div>
                    <span class="status-label">Confirmed</span>
                    <strong>{{ $orderStatusCounts['confirmed'] ?? 0 }}</strong>
                </div>
                <div class="order-status-item">
                    <div class="status-icon shipped"><i class="bi bi-truck"></i></div>
                    <span class="status-label">Shipped</span>
                    <strong>{{ $orderStatusCounts['shipped'] ?? 0 }}</strong>
                </div>
                <div class="order-status-item">
                    <div class="status-icon delivered"><i class="bi bi-box-seam"></i></div>
                    <span class="status-label">Delivered</span>
                    <strong>{{ $orderStatusCounts['delivered'] ?? 0 }}</strong>
                </div>
            </div>
            @if(isset($recentOrders) && $recentOrders->count() > 0)
                <div style="margin-top:16px;border-top:1px solid #e5eaf1;padding-top:14px;">
                    <p style="font-size:13px;font-weight:600;color:#172033;margin-bottom:10px;">Recent Orders</p>
                    @foreach($recentOrders->take(3) as $order)
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid #f0f0f0;">
                            <div>
                                <span style="font-size:13px;font-weight:500;">Order #{{ $order->order_number }}</span>
                                <span style="font-size:11px;color:#64748b;display:block;">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div>
                                <span style="font-size:13px;font-weight:600;">₹{{ number_format($order->total_amount, 0) }}</span>
                                <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}" style="font-size:9px;margin-left:8px;padding:3px 8px;">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="text-align:center;color:#94a3b8;padding:20px 0;margin:0;">
                    <i class="bi bi-inbox" style="font-size:30px;display:block;margin-bottom:8px;"></i>
                    No orders yet. Start shopping!
                </p>
            @endif
        </div>
    </div>
    <div class="col-lg-5">
        <div class="section-card">
            <div class="section-header">
                <h5>🏷️ Top Categories</h5>
                <a href="{{ route('customer.products') }}" class="view-all">View All <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="top-categories">
                @foreach($categories->take(6) as $cat)
                    <a href="{{ route('customer.products', ['category' => $cat->slug]) }}" class="top-cat">
                        <div class="top-cat-placeholder">
                            @if($cat->image)
                                <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}">
                            @else
                                <i class="bi bi-tag"></i>
                            @endif
                        </div>
                        <span>{{ $cat->name }}</span>
                    </a>
                @endforeach
            </div>
            @if(isset($recentlyViewed) && $recentlyViewed->count() > 0)
                <div style="margin-top:16px;border-top:1px solid #e5eaf1;padding-top:14px;">
                    <p style="font-size:13px;font-weight:600;color:#172033;margin-bottom:10px;">👁️ Recently Viewed</p>
                    <div style="display:flex;gap:10px;overflow-x:auto;padding-bottom:5px;">
                        @foreach($recentlyViewed->take(4) as $product)
                            <a href="{{ route('customer.orders.show', $product->id) }}" style="text-decoration:none;flex:0 0 80px;text-align:center;">
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
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}" style="width:70px;height:70px;object-fit:cover;border-radius:8px;">
                                @else
                                    <div style="width:70px;height:70px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                                <span style="font-size:9px;color:#64748b;display:block;margin-top:4px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    {{ $product->name }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="section-card">
            <div class="section-header">
                <h5>⭐ Recommended for You</h5>
                <a href="{{ route('customer.products') }}" class="view-all">View All <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="product-slider">
                @forelse($recommendedProducts as $product)
                    @php
                        $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                        $firstImage = $images[0] ?? null;
                        if ($firstImage) {
                            $firstImage = preg_replace('#^storage/#', '', $firstImage);
                            $imgUrl = asset($firstImage);
                        } else {
                            $imgUrl = null;
                        }
                        $sellingPrice = $product->selling_price ?? $product->price ?? 0;
                        $originalPrice = $product->price ?? 0;
                        $hasDiscount = $originalPrice > $sellingPrice;
                        $hasActiveOffer = isset($product->active_offer) && $product->active_offer;
                        $discountPercent = $hasDiscount ? round((($originalPrice - $sellingPrice) / $originalPrice) * 100) : 0;
                        if ($hasActiveOffer) {
                            $offerDiscount = 0;
                            if ($product->active_offer->discount_type === 'percentage') {
                                $offerDiscount = round($product->active_offer->discount_value);
                            } else {
                                $offerDiscount = round(($product->active_offer->discount_value / $originalPrice) * 100);
                            }
                        }
                        $inCart = false;
                    @endphp
                    <div class="product-card" data-product-id="{{ $product->id }}" style="position:relative;">
                        <a href="{{ route('customer.products.detail', $product->slug) }}" style="text-decoration:none;color:inherit;">
                            <div class="product-img">
                                @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                @else
                                    <div class="no-img"><i class="bi bi-image"></i></div>
                                @endif

                                <!-- Discount Badge -->
                                @if($hasDiscount)
                                    <div class="offer-badge">
                                        {{ $discountPercent }}% OFF
                                    </div>
                                @elseif($hasActiveOffer)
                                    <div class="offer-badge {{ $product->active_offer->discount_type === 'fixed' ? 'fixed' : '' }}">
                                        @if($product->active_offer->discount_type === 'percentage')
                                            {{ rtrim(rtrim(number_format($product->active_offer->discount_value, 2), '0'), '.') }}% OFF
                                        @else
                                            ₹{{ number_format($product->active_offer->discount_value, 0) }} OFF
                                        @endif
                                    </div>
                                @endif

                                <button class="wishlist-btn" data-product-id="{{ $product->id }}" onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist(this)">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="product-info">
                                <h6>{{ $product->name }}</h6>
                                <div class="price">
                                    @if($hasDiscount)
                                        <!-- Show selling price and original price -->
                                        <span class="current" style="color:#198754;font-weight:700;">
                                            ₹{{ number_format($sellingPrice, 0) }}
                                        </span>
                                        <span style="font-size:11px;color:#94a3b8;text-decoration:line-through;margin-left:4px;">
                                            ₹{{ number_format($originalPrice, 0) }}
                                        </span>
                                        <span style="font-size:10px;color:#ef4444;font-weight:600;background:#fef0ef;padding:1px 6px;border-radius:3px;margin-left:4px;">
                                            {{ $discountPercent }}% OFF
                                        </span>
                                    @elseif($hasActiveOffer)
                                        <!-- Active offer logic -->
                                        @php
                                            $original = $product->price;
                                            if ($product->active_offer->discount_type === 'percentage') {
                                                $discounted = $original - ($original * $product->active_offer->discount_value / 100);
                                            } else {
                                                $discounted = max(0, $original - $product->active_offer->discount_value);
                                            }
                                        @endphp
                                        <span class="current" style="color:#ef4444;">₹{{ number_format($discounted, 0) }}</span>
                                        <span style="font-size:11px;color:#94a3b8;text-decoration:line-through;margin-left:4px;">₹{{ number_format($original, 0) }}</span>
                                    @else
                                        <!-- No discount -->
                                        <span class="current">₹{{ number_format($product->price, 0) }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>

                        <!-- ============================================= -->
                        <!-- ADD TO CART BUTTON - INSIDE PRODUCT CARD      -->
                        <!-- ============================================= -->
                        <div style="padding:0 12px 12px 12px;margin-top:-4px;">
                            <button type="button" class="add-to-cart-btn"
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ addslashes($product->name) }}"
                                data-product-price="{{ $sellingPrice }}"
                                data-product-slug="{{ $product->slug }}"
                                data-product-image="{{ $imgUrl ?? '' }}"
                                onclick="event.stopPropagation(); addToCartFromCard(this, {{ $product->id }}, '{{ addslashes($product->name) }}', {{ $sellingPrice }}, '{{ $product->slug }}', '{{ $imgUrl ?? '' }}', {{ $originalPrice }});"
                                style="width:100%;padding:6px 12px;background:#3b82f6;color:#fff;border:none;border-radius:6px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;cursor:pointer;transition:all 0.3s ease;display:flex;align-items:center;justify-content:center;gap:4px;">
                                <i class="bi bi-cart-plus" style="font-size:12px;"></i>
                                <span class="btn-text">Add to Cart</span>
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-muted" style="grid-column:1/-1;text-align:center;padding:40px 0;">
                        <i class="bi bi-box" style="font-size:30px;display:block;margin-bottom:8px;"></i>
                        No products available.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Benefits -->
<div class="row g-4">
    <div class="col-12">
        <div class="benefits-bar">
            <div class="benefit-item">
                <i class="bi bi-truck"></i>
                <div><strong>Free Shipping</strong><small>On orders above ₹999</small></div>
            </div>
            <div class="benefit-item">
                <i class="bi bi-arrow-repeat"></i>
                <div><strong>30 Days Returns</strong><small>Easy returns & refunds</small></div>
            </div>
            <div class="benefit-item">
                <i class="bi bi-shield-check"></i>
                <div><strong>Secure Payments</strong><small>100% secure payments</small></div>
            </div>
            <div class="benefit-item">
                <i class="bi bi-headset"></i>
                <div><strong>24/7 Support</strong><small>We're here to help</small></div>
            </div>
            <div class="benefit-item">
                <i class="bi bi-tag"></i>
                <div><strong>Best Prices</strong><small>Guaranteed best prices</small></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        let wishlist = new Set();

        function loadWishlist() {
            const stored = localStorage.getItem('wishlist');
            if (stored) {
                try {
                    const arr = JSON.parse(stored);
                    wishlist = new Set(arr);
                } catch (e) { wishlist = new Set(); }
            }
            updateUI();
        }

        function saveWishlist() {
            localStorage.setItem('wishlist', JSON.stringify(Array.from(wishlist)));
        }

        function toggleWishlist(button) {
            if (!button) {
                console.error('Wishlist button is missing');
                return;
            }

            const productId = button.dataset.productId;
            if (!productId) {
                console.error('Product ID not found on button');
                return;
            }

            const url = "{{ url('/customer/wishlist/toggle') }}/" + productId;
            button.disabled = true;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Wishlist request failed');
                    }
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        const icon = button.querySelector('i');
                        if (data.is_in_wishlist) {
                            icon.classList.remove('bi-heart');
                            icon.classList.add('bi-heart-fill');
                            button.classList.add('active');
                            wishlist.add(productId);
                        } else {
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                            button.classList.remove('active');
                            wishlist.delete(productId);
                        }
                        saveWishlist();

                        document.querySelectorAll('.badge-count').forEach(el => {
                            const link = el.closest('a');
                            if (link && link.href && link.href.includes('/customer/wishlist')) {
                                el.textContent = data.wishlist_count;
                            }
                        });

                        const wishlistStat = document.getElementById('wishlistCountDisplay');
                        if (wishlistStat) {
                            wishlistStat.textContent = data.wishlist_count;
                        }

                        console.log(data.message);
                    }
                })
                .catch(error => {
                    console.error('Wishlist Error:', error);
                })
                .finally(() => {
                    button.disabled = false;
                });
        }

        function updateUI() {
            const count = wishlist.size;
            document.querySelectorAll('.header-actions .badge-count').forEach(badge => {
                if (badge.closest('.action-item') && badge.closest('.action-item').querySelector('i.bi-heart')) {
                    badge.textContent = count;
                }
            });
            const sidebarBadge = document.querySelector('.sidebar-menu .badge');
            if (sidebarBadge) sidebarBadge.textContent = count;
            const wishlistStat = document.getElementById('wishlistCountDisplay');
            if (wishlistStat) wishlistStat.textContent = count;
            document.querySelectorAll('.wishlist-btn').forEach(btn => {
                const pid = btn.getAttribute('data-product-id');
                const icon = btn.querySelector('i');
                if (pid && wishlist.has(pid)) {
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                    btn.classList.add('active');
                } else {
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                    btn.classList.remove('active');
                }
            });
        }

        function copyCoupon(code, button) {
            navigator.clipboard.writeText(code).then(() => {
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="bi bi-check"></i> Copied!';
                button.style.background = '#22c55e';
                button.style.color = '#fff';
                button.style.borderColor = '#22c55e';
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.style.background = '';
                    button.style.color = '';
                    button.style.borderColor = '';
                }, 2000);
            }).catch(() => {
                alert('Copy: ' + code);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            loadWishlist();
        });

        window.toggleWishlist = toggleWishlist;
        window.copyCoupon = copyCoupon;
        function addToCartFromCard(button, productId, productName, productPrice, productSlug, productImage, originalPrice = null) {
            event.stopPropagation();

            let cart = getCart();
            const existingIndex = cart.findIndex(item => item.id == productId);

            const originalText = button.innerHTML;
            button.innerHTML = '<i class="bi bi-arrow-repeat" style="font-size:12px;animation:spin 1s linear infinite;"></i> Adding...';
            button.style.opacity = '0.7';
            button.disabled = true;

            setTimeout(() => {
                const sellingPriceValue = Number(productPrice);
                const originalPriceValue = (originalPrice !== null && originalPrice !== undefined)
                    ? Number(originalPrice)
                    : sellingPriceValue;

                console.log('Adding to cart:', {
                    productId,
                    productName,
                    selling_price: sellingPriceValue,
                    price: originalPriceValue,
                    hasDiscount: originalPriceValue > sellingPriceValue
                });

                if (existingIndex > -1) {
                    cart[existingIndex].quantity = (cart[existingIndex].quantity || 1) + 1;
                    cart[existingIndex].selling_price = sellingPriceValue;
                    cart[existingIndex].price = originalPriceValue;
                    showToast('Quantity updated in cart', 'added');
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        selling_price: sellingPriceValue,
                        price: originalPriceValue,
                        slug: productSlug,
                        image: productImage,
                        quantity: 1
                    });
                    showToast('Added to cart 🛒', 'added');
                }

                saveCart(cart);

                button.innerHTML = '<i class="bi bi-check-lg" style="font-size:12px;"></i> In Cart';
                button.style.background = '#27ae60';
                button.disabled = false;
                button.style.opacity = '1';

                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.style.background = '#B89B5E';
                }, 2000);

                if (document.getElementById('cartPanel')?.classList.contains('open')) {
                    renderCartPanel();
                }
            }, 400);
        }
        function getCart() {
            try {
                const cart = localStorage.getItem('cart');
                return cart ? JSON.parse(cart) : [];
            } catch (e) {
                return [];
            }
        }
        function showToast(message, type) {
            let toastContainer = document.getElementById('wishlist-toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'wishlist-toast-container';
                toastContainer.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 350px;
            width: 100%;
        `;
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            const bgColor = type === 'added' ? '#27ae60' : '#e74c3c';
            toast.style.cssText = `
        background: #fff;
        padding: 12px 18px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        border-left: 4px solid ${bgColor};
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideInRight 0.3s ease;
        font-size: 14px;
        color: #292725;
        font-family: 'Plus Jakarta Sans', sans-serif;
    `;

            const icon = document.createElement('i');
            icon.className = type === 'added' ? 'bi bi-heart-fill' : 'bi bi-heart';
            icon.style.color = bgColor;
            icon.style.fontSize = '18px';

            const text = document.createElement('span');
            text.textContent = message;

            toast.appendChild(icon);
            toast.appendChild(text);
            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease forwards';
                setTimeout(() => {
                    if (toast.parentNode) toast.parentNode.removeChild(toast);
                }, 300);
            }, 3000);
        }
        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }

        function updateCartCount() {
            const cart = getCart();
            const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);

            const cartCount = document.getElementById('cartCount');
            if (cartCount) cartCount.textContent = totalItems;

            const mobileCartCount = document.getElementById('mobileCartCount');
            if (mobileCartCount) mobileCartCount.textContent = totalItems;
        }

        function addToCartFromWishlist(productId) {
            event.stopPropagation();

            const wishlist = getWishlist();
            const product = wishlist.find(item => item.id == productId);

            if (!product) {
                showToast('Product not found', 'removed');
                return;
            }

            let cart = getCart();
            const existingIndex = cart.findIndex(item => item.id == productId);

            if (existingIndex > -1) {
                cart[existingIndex].quantity = (cart[existingIndex].quantity || 1) + 1;
                showToast('Quantity updated in cart', 'added');
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    selling_price: Number(product.selling_price || product.price || 0),
                    price: Number(product.price || product.selling_price || 0),
                    slug: product.slug,
                    image: product.image,
                    quantity: 1
                });
                showToast('Added to cart 🛒', 'added');
            }

            saveCart(cart);

            if (document.getElementById('cartPanel')?.classList.contains('open')) {
                renderCartPanel();
            }
        }
    </script>
@endsection
