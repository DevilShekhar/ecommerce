@extends('frontend.layouts.customer-layout')

@section('title', 'My Dashboard - ShopEase')

@section('styles')
    <style>
        .welcome-card h3 {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px
        }

        .dashboard-banner-img {
            height: 200px;
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
            gap: 20px;
            flex-wrap: wrap;
        }

        .cat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #334155;
            transition: all 0.2s;
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
        }

        .cat-item span {
            font-size: 12px;
            font-weight: 500;
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
            grid-template-columns: repeat(5, 1fr);
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
        }

        .top-cat span {
            font-size: 13px;
            font-weight: 500;
        }

        .product-slider {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
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
        }

    </style>
@endsection

@section('content')
    <!-- Welcome + Profile -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="welcome-card">
                <h3>Welcome back, {{ explode(' ', $user->name)[0] }}! 👋</h3>
                <p class="text-muted mb-4">What are you shopping for today?</p>

                <div class="category-icons">
                    @foreach($categories->take(6) as $cat)
                        <a href="{{ route('customer.products', ['category' => $cat->slug]) }}" class="cat-item">
                            <div class="cat-icon"><i class="bi bi-tag"></i></div>
                            <span>{{ $cat->name }}</span>
                        </a>
                    @endforeach
                    <a href="{{ route('customer.products') }}" class="cat-item">
                        <div class="cat-icon"><i class="bi bi-three-dots"></i></div>
                        <span>More Categories</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="profile-card">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="profile-avatar d-flex align-items-center justify-content-center">
                        {{ strtoupper(substr(trim($user->name), 0, 1)) }}
                    </div>

                    <div>
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <small class="text-muted">{{ $user->email }}</small>
                        <div>
                            <a href="{{ route('account.settings') }}" class="edit-profile-link">Edit Profile</a>
                        </div>
                    </div>
                </div>

                <div class="profile-stats">
                    <div class="stat-box">
                        <h4>{{ $orderCount ?? 0 }}</h4>
                        <span>Orders</span>
                        <a href="{{ route('customer.orders.index') }}">View all orders</a>
                    </div>
                    <div class="stat-box">
                        <h4 id="wishlistCountDisplay">{{ $wishlistCount }}</h4>
                        <span>Wishlist</span>
                        <a href="{{ route('customer.wishlist') }}">View wishlist</a>
                    </div>
                    <div class="stat-box">
                        <h4>{{ $couponCount ?? 0 }}</h4>
                        <span>Coupons</span>
                        <a href="#">View coupons</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Banners -->
    @if(isset($banners) && $banners->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-banner-slider">
                    <div id="dashboardBannerCarousel" class="carousel slide" data-bs-ride="carousel">

                        <!-- Indicators -->
                        @if($banners->count() > 1)
                            <div class="carousel-indicators">
                                @foreach($banners as $index => $banner)
                                    <button type="button"
                                        data-bs-target="#dashboardBannerCarousel"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"
                                        @if($index === 0) aria-current="true" @endif
                                        aria-label="Slide {{ $index + 1 }}">
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <!-- Banner Items -->
                        <div class="carousel-inner">
                            @foreach($banners as $index => $banner)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <a href="{{ $banner->link_url ?? '#' }}"
                                        class="banner-link"
                                        @if(($banner->link_type ?? '') === 'custom_url') target="_blank" @endif>

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

                        <!-- Controls -->
                        @if($banners->count() > 1)
                            <button class="carousel-control-prev"
                                type="button"
                                data-bs-target="#dashboardBannerCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next"
                                type="button"
                                data-bs-target="#dashboardBannerCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif

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
                    <h5>Your Orders</h5>
                    <a href="{{ route('customer.orders.index') }}" class="view-all">View All Orders</a>
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
                        <div class="status-icon confirmed"><i class="bi bi-check-circle"></i></div>
                        <span class="status-label">Processing</span>
                        <strong>{{ $orderStatusCounts['processing'] ?? 0 }}</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon confirmed"><i class="bi bi-check-circle"></i></div>
                        <span class="status-label">Packed</span>
                        <strong>{{ $orderStatusCounts['packed'] ?? 0 }}</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon shipped"><i class="bi bi-truck"></i></div>
                        <span class="status-label">Shipped</span>
                        <strong>{{ $orderStatusCounts['shipped'] ?? 0 }}</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon shipped"><i class="bi bi-truck"></i></div>
                        <span class="status-label">Out Of Delivery</span>
                        <strong>{{ $orderStatusCounts['out_for_delivery'] ?? 0 }}</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon delivered"><i class="bi bi-box-seam"></i></div>
                        <span class="status-label">Delivered</span>
                        <strong>{{ $orderStatusCounts['delivered'] ?? 0 }}</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon cancelled"><i class="bi bi-x-circle"></i></div>
                        <span class="status-label">Cancelled</span>
                        <strong>{{ $orderStatusCounts['cancelled'] ?? 0 }}</strong>
                    </div>
                </div>

                @if(isset($recentOrders) && $recentOrders->count() > 0)
                    <div style="margin-top: 15px; border-top: 1px solid #e5eaf1; padding-top: 15px;">
                        <p style="font-size: 13px; font-weight: 600; color: #172033; margin-bottom: 10px;">Recent Orders</p>
                        @foreach($recentOrders->take(3) as $order)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid #f0f0f0;">
                                <div>
                                    <span style="font-size: 13px; font-weight: 500;">Order #{{ $order->order_number }}</span>
                                    <span style="font-size: 12px; color: #64748b; display: block;">{{ $order->created_at->format('d M Y') }}</span>
                                </div>
                                <div>
                                    <span style="font-size: 13px; font-weight: 600;">₹{{ number_format($order->total_amount, 0) }}</span>
                                    <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}"
                                        style="font-size: 10px; margin-left: 8px;">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="text-align: center; color: #94a3b8; padding: 20px 0; margin: 0;">
                        <i class="bi bi-inbox" style="font-size: 30px; display: block; margin-bottom: 8px;"></i>
                        No orders yet. Start shopping!
                    </p>
                @endif
            </div>
        </div>

        <div class="col-lg-5">
            <div class="section-card">
                <div class="section-header">
                    <h5>Top Categories</h5>
                    <a href="{{ route('customer.products') }}" class="view-all">View All</a>
                </div>
                <div class="top-categories">
                    @foreach($categories->take(6) as $cat)
                        <a href="{{ route('customer.products', ['category' => $cat->slug]) }}" class="top-cat">
                            <div class="top-cat-placeholder"><i class="bi bi-tag"></i></div>
                            <span>{{ $cat->name }}</span>
                        </a>
                    @endforeach
                </div>

                @if(isset($recentlyViewed) && $recentlyViewed->count() > 0)
                    <div style="margin-top: 15px; border-top: 1px solid #e5eaf1; padding-top: 15px;">
                        <p style="font-size: 13px; font-weight: 600; color: #172033; margin-bottom: 10px;">Recently Viewed</p>
                        <div style="display: flex; gap: 10px; overflow-x: auto; padding-bottom: 5px;">
                            @foreach($recentlyViewed->take(4) as $product)
                                <a href="{{ route('customer.orders.show', $product->id) }}" style="text-decoration: none; flex: 0 0 80px; text-align: center;">
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
                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <div style="width: 70px; height: 70px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                    <span style="font-size: 10px; color: #64748b; display: block; margin-top: 4px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
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

    <!-- Recommended Products -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="section-card">
                <div class="section-header">
                    <h5>Recommended for You</h5>
                    <a href="{{ route('shop') }}" class="view-all">View All</a>
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
                        @endphp

                        <div class="product-card" data-product-id="{{ $product->id }}">
                            <a href="{{ route('customer.products', $product->id) }}" style="text-decoration: none; color: inherit;">
                                <div class="product-img">
                                    @if($imgUrl)
                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                            onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                    @else
                                        <div class="no-img"><i class="bi bi-image"></i></div>
                                    @endif
                                    <button class="wishlist-btn" data-product-id="{{ $product->id }}"
                                        onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist(this)">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>
                                <div class="product-info">
                                    <h6>{{ $product->name }}</h6>
                                    <div class="price"><span class="current">₹{{ number_format($product->price, 0) }}</span></div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-muted" style="grid-column: 1 / -1; text-align: center; padding: 40px 0;">
                            <i class="bi bi-box" style="font-size: 30px; display: block; margin-bottom: 8px;"></i>
                            No products available.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Benefits -->
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

                        // Update wishlist count in sidebar and stat box
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

        document.addEventListener('DOMContentLoaded', function () {
            loadWishlist();
        });

        window.toggleWishlist = toggleWishlist;
    </script>
@endsection
