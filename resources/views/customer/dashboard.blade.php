@extends('frontend.layouts.customer-layout')

@section('title', 'My Dashboard - ShopEase')

@section('styles')
    <style>
        .welcome-card h3 {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px
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
                        <a href="#" class="cat-item">
                            <div class="cat-icon"><i class="bi bi-tag"></i></div>
                            <span>{{ $cat->name }}</span>
                        </a>
                    @endforeach
                    <a href="#" class="cat-item">
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
                        <h4>0</h4>
                        <span>Orders</span>
                        <a href="#">View all orders</a>
                    </div>
                    <div class="stat-box">
                        <h4>{{ $wishlistCount }}</h4>
                        <span>Wishlist</span>
                        <a href="{{ route('customer.wishlist') }}">View wishlist</a>
                    </div>
                    <div class="stat-box">
                        <h4>0</h4>
                        <span>Coupons</span>
                        <a href="#">View coupons</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders + Top Categories -->
    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="section-card">
                <div class="section-header">
                    <h5>Your Orders</h5>
                    <a href="#" class="view-all">View All Orders</a>
                </div>
                <div class="order-status-row">
                    <div class="order-status-item">
                        <div class="status-icon pending"><i class="bi bi-clock"></i></div>
                        <span class="status-label">Pending</span>
                        <strong>0</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon confirmed"><i class="bi bi-check-circle"></i></div>
                        <span class="status-label">Confirmed</span>
                        <strong>0</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon shipped"><i class="bi bi-truck"></i></div>
                        <span class="status-label">Shipped</span>
                        <strong>0</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon delivered"><i class="bi bi-box-seam"></i></div>
                        <span class="status-label">Delivered</span>
                        <strong>0</strong>
                    </div>
                    <div class="order-status-item">
                        <div class="status-icon cancelled"><i class="bi bi-x-circle"></i></div>
                        <span class="status-label">Cancelled</span>
                        <strong>0</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="section-card">
                <div class="section-header">
                    <h5>Top Categories</h5>
                    <a href="#" class="view-all">View All</a>
                </div>
                <div class="top-categories">
                    @foreach($categories->take(5) as $cat)
                        <a href="#" class="top-cat">
                            <div class="top-cat-placeholder"><i class="bi bi-tag"></i></div>
                            <span>{{ $cat->name }}</span>
                        </a>
                    @endforeach
                </div>
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
                            <div class="product-img">
                                @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                        onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                @else
                                    <div class="no-img"><i class="bi bi-image"></i></div>
                                @endif
                                <button class="wishlist-btn" data-product-id="{{ $product->id }}"
                                    onclick="toggleWishlist(this)">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="product-info">
                                <h6>{{ $product->name }}</h6>
                                <div class="price"><span class="current">₹{{ number_format($product->price, 0) }}</span></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No products available.</p>
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
                        } else {
                            icon.classList.remove('bi-heart-fill');
                            icon.classList.add('bi-heart');
                            button.classList.remove('active');
                        }

                        document.querySelectorAll('.badge-count').forEach(el => {
                            const link = el.closest('a');
                            if (link && link.href.includes('/customer/wishlist')) {
                                el.textContent = data.wishlist_count;
                            }
                        });

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
            const statBoxes = document.querySelectorAll('.stat-box h4');
            statBoxes.forEach(h4 => {
                const parent = h4.closest('.stat-box');
                if (parent && parent.querySelector('span') && parent.querySelector('span').textContent.trim() === 'Wishlist') {
                    h4.textContent = count;
                }
            });
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
