@extends('frontend.layouts.customer-layout')
@section('title', 'My Wishlist - ShopHub')
@section('content')
<style>
.wishlist-page{background:#f8fafc;padding:30px 0;min-height:100vh}
.wishlist-wrapper{max-width:1200px;margin:0 auto;padding:0 20px}

/* Header */
.wishlist-header{display:flex;justify-content:space-between;align-items:center;background:#fff;padding:16px 20px;border-radius:10px;margin-bottom:20px;box-shadow:0 1px 3px rgba(0,0,0,0.06)}
.wishlist-title-area{display:flex;align-items:center;gap:12px}
.wishlist-title-icon{width:44px;height:44px;border-radius:50%;background:#fee2e2;color:#ef4444;display:flex;align-items:center;justify-content:center;font-size:20px}
.wishlist-title h1{font-size:22px;font-weight:700;color:#0f172a;margin:0}
.wishlist-title p{font-size:13px;color:#64748b;margin:0}
.wishlist-actions{display:flex;gap:8px}
.wishlist-action-btn{padding:8px 16px;border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;transition:all .2s;display:flex;align-items:center;gap:6px;border:none}
.wishlist-action-outline{background:transparent;color:#475569;border:1px solid #e2e8f0}
.wishlist-action-outline:hover{background:#f1f5f9}
.wishlist-action-primary{background:#3b82f6;color:#fff}
.wishlist-action-primary:hover{background:#2563eb}

/* Table */
.wishlist-table-wrapper{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.06)}
.wishlist-table{width:100%;border-collapse:collapse}
.wishlist-table thead{background:#f8fafc;border-bottom:1px solid #e2e8f0}
.wishlist-table thead th{padding:12px 14px;text-align:left;font-size:11px;font-weight:600;text-transform:uppercase;color:#64748b;letter-spacing:.5px}
.wishlist-table tbody tr{border-bottom:1px solid #f1f5f9;transition:background .2s}
.wishlist-table tbody tr:hover{background:#fafbfc}
.wishlist-table tbody tr:last-child{border-bottom:none}
.wishlist-table tbody td{padding:12px 14px;vertical-align:middle}

/* Product Info */
.wishlist-product-info{display:flex;align-items:center;gap:12px}
.wishlist-product-image{width:60px;height:60px;border-radius:6px;overflow:hidden;background:#f1f5f9;flex-shrink:0;display:flex;align-items:center;justify-content:center}
.wishlist-product-image img{width:100%;height:100%;object-fit:cover}
.wishlist-product-image i{font-size:24px;color:#94a3b8}
.wishlist-product-name{font-size:14px;font-weight:600;color:#0f172a}
.wishlist-product-variant{font-size:12px;color:#64748b}

/* Price */
.wishlist-price{display:flex;align-items:center;flex-wrap:wrap;gap:4px}
.current-price{font-size:15px;font-weight:700;color:#0f172a}
.old-price{font-size:12px;color:#94a3b8;text-decoration:line-through}
.discount-badge{background:#fef2f2;color:#ef4444;font-size:10px;font-weight:700;padding:2px 6px;border-radius:3px}

/* Stock */
.stock-status{display:flex;align-items:center;gap:4px;font-size:12px;font-weight:500;color:#16a34a}
.stock-status i{color:#22c55e;font-size:14px}

/* Buttons */
.move-cart-btn{padding:5px 12px;background:#3b82f6;color:#fff;border:none;border-radius:5px;font-size:11px;font-weight:600;cursor:pointer;transition:all .2s;display:flex;align-items:center;gap:4px}
.move-cart-btn:hover{background:#2563eb}
.delete-wishlist-btn{width:32px;height:32px;border-radius:50%;background:transparent;border:1px solid #e2e8f0;color:#94a3b8;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center}
.delete-wishlist-btn:hover{background:#fef2f2;color:#ef4444;border-color:#fecaca}

/* Checkbox */
.wishlist-checkbox{width:16px;height:16px;cursor:pointer;accent-color:#3b82f6}

/* Features */
.wishlist-features{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:20px}
.wishlist-feature{background:#fff;border-radius:10px;padding:14px;display:flex;align-items:center;gap:12px;box-shadow:0 1px 3px rgba(0,0,0,0.06)}
.feature-icon{width:36px;height:36px;border-radius:50%;background:#eff6ff;color:#3b82f6;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
.feature-text strong{display:block;font-size:12px;color:#0f172a}
.feature-text span{font-size:11px;color:#64748b}

/* Empty */
.empty-wishlist{background:#fff;border-radius:10px;padding:60px 20px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,0.06)}
.empty-wishlist i{font-size:56px;color:#e2e8f0;display:block;margin-bottom:12px}
.empty-wishlist h4{font-size:22px;color:#0f172a;margin-bottom:6px}
.empty-wishlist p{font-size:14px;color:#64748b;margin-bottom:16px}

/* Recommended */
.recommendation-section{margin-top:24px}
.recommendation-title h2{font-size:20px;font-weight:700;color:#0f172a;margin-bottom:12px}
.recommendation-card{background:#fff;border-radius:8px;overflow:hidden;transition:all .3s;box-shadow:0 1px 3px rgba(0,0,0,0.06)}
.recommendation-card:hover{transform:translateY(-3px);box-shadow:0 8px 20px rgba(0,0,0,0.08)}
.recommendation-image{position:relative;height:160px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;overflow:hidden}
.recommendation-image img{width:100%;height:100%;object-fit:cover}
.recommendation-heart{position:absolute;top:8px;right:8px;width:30px;height:30px;border-radius:50%;background:rgba(255,255,255,0.9);border:none;color:#475569;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center}
.recommendation-heart:hover{background:#fff;transform:scale(1.05)}
.recommendation-info{padding:10px 12px}
.recommendation-info h6{font-size:12px;font-weight:500;color:#0f172a;margin:0 0 3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.recommendation-price{font-size:13px;font-weight:700;color:#0f172a}

/* Responsive */
@media(max-width:992px){.wishlist-features{grid-template-columns:repeat(2,1fr)}}
@media(max-width:768px){
    .wishlist-header{flex-direction:column;align-items:flex-start;gap:12px}
    .wishlist-actions{width:100%}
    .wishlist-actions button{flex:1;justify-content:center}
    .wishlist-table-wrapper{overflow-x:auto}
    .wishlist-table{min-width:650px}
    .wishlist-features{grid-template-columns:1fr 1fr}
}
@media(max-width:576px){
    .wishlist-features{grid-template-columns:1fr}
    .wishlist-header{padding:14px}
    .wishlist-title-icon{width:36px;height:36px;font-size:16px}
    .wishlist-title h1{font-size:18px}
}
</style>
    <div class="wishlist-page">
        <div class="wishlist-wrapper">
            <!-- Header -->
            <div class="wishlist-header">
                <div class="wishlist-title-area">
                    <div class="wishlist-title-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="wishlist-title">
                        <h1>My Wishlist</h1>
                        <p id="wishlistCountDisplay">
                            {{ isset($wishlistItems) ? $wishlistItems->total() : 0 }} items
                        </p>
                    </div>
                </div>
                <div class="wishlist-actions">
                    <button type="button" class="wishlist-action-btn wishlist-action-outline" onclick="shareWishlist()">
                        <i class="bi bi-share"></i> Share
                    </button>
                    <button type="button" class="wishlist-action-btn wishlist-action-primary" id="moveAllToCart">
                        <i class="bi bi-cart3"></i> Move All to Cart
                    </button>
                </div>
            </div>

            @if(isset($wishlistItems) && $wishlistItems->count() > 0)
                <!-- Table -->
                <div class="wishlist-table-wrapper">
                    <table class="wishlist-table">
                        <thead>
                            <tr>
                                <th width="40"><input type="checkbox" id="selectAllCheckbox"></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody id="wishlistContainer">
                            @foreach($wishlistItems as $item)
                                @php
                                    $product = $item->product;
                                    $imgUrl = null;
                                    if ($product) {
                                        $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                        $firstImage = $images[0] ?? null;
                                        if ($firstImage) {
                                            $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                            $imgUrl = asset($firstImage);
                                        }
                                    }
                                    $originalPrice = $product->original_price ?? null;
                                    $discount = null;
                                    if ($originalPrice && $originalPrice > $product->price) {
                                        $discount = round((($originalPrice - $product->price) / $originalPrice) * 100);
                                    }
                                @endphp
                                @if($product)
                                    <tr class="wishlist-item product-details-trigger" data-wishlist-id="{{ $item->id }}" data-product-id="{{ $product->id }}">
                                        <td><input type="checkbox" class="wishlist-checkbox" value="{{ $item->id }}"></td>
                                        <td>
                                            <div class="wishlist-product-info">
                                                <div class="wishlist-product-image">
                                                    @if($imgUrl)
                                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                                    @else
                                                        <i class="bi bi-image"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="wishlist-product-name">{{ $product->name }}</div>
                                                    <div class="wishlist-product-variant">{{ $product->category->name ?? 'Product' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="wishlist-price">
                                                <span class="current-price">₹{{ number_format($product->price, 0) }}</span>
                                                @if($originalPrice && $originalPrice > $product->price)
                                                    <span class="old-price">₹{{ number_format($originalPrice, 0) }}</span>
                                                    <span class="discount-badge">{{ $discount }}% OFF</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="stock-status in-stock">
                                                <i class="bi bi-check-circle-fill"></i> In Stock
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="move-cart-btn" data-product-id="{{ $product->id }}"
                                                data-cart-url="{{ route('cart.add', $product->id) }}">
                                                <i class="bi bi-cart3"></i> Move to Cart
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="delete-wishlist-btn remove-wishlist-btn" data-id="{{ $item->id }}"
                                                data-url="{{ route('customer.wishlist.remove', $item->id) }}">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $wishlistItems->links() }}
                </div>

                <!-- Features -->
                <div class="wishlist-features">
                    <div class="wishlist-feature">
                        <div class="feature-icon"><i class="bi bi-heart"></i></div>
                        <div class="feature-text"><strong>Save Favorites</strong><span>Keep track of items you love</span></div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon"><i class="bi bi-bell"></i></div>
                        <div class="feature-text"><strong>Price Alerts</strong><span>Get notified when prices drop</span></div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                        <div class="feature-text"><strong>Secure & Private</strong><span>Your wishlist is private</span></div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon"><i class="bi bi-laptop"></i></div>
                        <div class="feature-text"><strong>Across Devices</strong><span>Access anytime, anywhere</span></div>
                    </div>
                </div>

                <!-- Recommended -->
                @if(isset($recommendedProducts) && $recommendedProducts->count())
                    <div class="recommendation-section">
                        <div class="recommendation-title"><h2>You May Also Like</h2></div>
                        <div class="row g-3">
                            @foreach($recommendedProducts as $recommended)
                                @php
                                    $recImage = null;
                                    if ($recommended->image) {
                                        $recImages = array_map('trim', explode(',', $recommended->image));
                                        $recImage = $recImages[0] ?? null;
                                        if ($recImage) {
                                            $recImage = preg_replace('#^storage/#', '', $recImage);
                                            $recImage = asset($recImage);
                                        }
                                    }
                                @endphp
                                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                                    <div class="recommendation-card">
                                        <div class="recommendation-image">
                                            @if($recImage)
                                                <img src="{{ $recImage }}" alt="{{ $recommended->name }}">
                                            @else
                                                <i class="bi bi-image" style="font-size:45px;color:#cbd5e1"></i>
                                            @endif
                                            <button class="recommendation-heart"><i class="bi bi-heart"></i></button>
                                        </div>
                                        <div class="recommendation-info">
                                            <h6>{{ $recommended->name }}</h6>
                                            <div class="recommendation-price">₹{{ number_format($recommended->price, 0) }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <div class="empty-wishlist">
                    <i class="bi bi-heart"></i>
                    <h4>Your Wishlist is Empty</h4>
                    <p>Save your favorite products here and view them anytime.</p>
                    <a href="{{ route('customer.products') }}" class="btn btn-primary px-4"><i class="bi bi-cart3 me-1"></i> Start Shopping</a>
                </div>
            @endif
        </div>

        <!-- Product Details Modal -->
        <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content product-details-modal-content">
                    <button type="button" class="product-modal-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    <div class="modal-body p-0">
                        <div id="productModalLoader" class="product-modal-loader">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>
                        <div id="productModalContent" style="display:none;">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="product-modal-image-wrap" style="height:500px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                                        <img id="modalProductImage" src="" alt="Product Image" style="width:100%; height:500px; object-fit:contain;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-modal-details" style="height:500px; overflow-y:auto; padding:30px;">
                                        <div id="modalProductCategory" class="product-modal-category"></div>
                                        <h3 id="modalProductName"></h3>
                                        <div class="product-modal-rating">
                                            <span class="stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></span>
                                            <span id="modalReviewCount">(0 Reviews)</span>
                                        </div>
                                        <div id="modalProductPrice" class="product-modal-price"></div>
                                        <div id="modalProductDescription" class="product-modal-description"></div>
                                        <div class="product-modal-info">
                                            <div><span>Availability</span><strong id="modalProductStock"></strong></div>
                                            <div><span>Category</span><strong id="modalProductCategoryInfo"></strong></div>
                                        </div>
                                        <div id="modalProductAction" class="product-modal-action"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container" id="toastContainer"></div>
@endsection



@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Select All
            document.getElementById('selectAllCheckbox')?.addEventListener('change', function() {
                document.querySelectorAll('.wishlist-checkbox').forEach(cb => cb.checked = this.checked);
            });

            // Remove from wishlist
            document.querySelectorAll('.remove-wishlist-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const url = this.dataset.url;
                    const removeBtn = this;
                    if (!url) { showToast('error', 'Error', 'Invalid URL.'); return; }

                    removeBtn.disabled = true;
                    removeBtn.innerHTML = '<i class="bi bi-hourglass-split"></i>';

                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(async response => {
                        const data = await response.json().catch(() => ({}));
                        if (!response.ok) throw new Error(data.message || `Request failed`);
                        return data;
                    })
                    .then(data => {
                        if (data.success) {
                            showToast('success', 'Removed', data.message || 'Product removed.');
                            setTimeout(() => window.location.reload(), 700);
                        } else {
                            showToast('error', 'Error', data.message || 'Failed to remove.');
                            removeBtn.disabled = false;
                            removeBtn.innerHTML = '<i class="bi bi-trash3"></i>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('error', 'Error', error.message || 'Something went wrong.');
                        removeBtn.disabled = false;
                        removeBtn.innerHTML = '<i class="bi bi-trash3"></i>';
                    });
                });
            });

            // Move to Cart
            document.querySelectorAll('.move-cart-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const url = this.dataset.cartUrl;
                    const btn = this;
                    if (!url) { showToast('error', 'Error', 'Cart URL not found.'); return; }

                    btn.disabled = true;
                    btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast('success', 'Added', data.message || 'Product added to cart.');
                            setTimeout(() => window.location.href = "{{ route('checkout') }}", 500);
                        } else {
                            showToast('error', 'Error', data.message || 'Failed to add.');
                            btn.disabled = false;
                            btn.innerHTML = '<i class="bi bi-cart3"></i> Move to Cart';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('error', 'Error', 'Something went wrong.');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-cart3"></i> Move to Cart';
                    });
                });
            });

            // Move All to Cart
            document.getElementById('moveAllToCart')?.addEventListener('click', function () {
                const selected = document.querySelectorAll('.wishlist-checkbox:checked');
                if (selected.length === 0) { showToast('info', 'Info', 'Please select at least one item.'); return; }

                const btn = this;
                btn.disabled = true;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Moving...';

                const productIds = [];
                selected.forEach(cb => {
                    const moveBtn = cb.closest('.wishlist-item')?.querySelector('.move-cart-btn');
                    if (moveBtn) {
                        const pid = moveBtn.getAttribute('data-product-id');
                        if (pid) productIds.push(pid);
                    }
                });

                if (productIds.length === 0) {
                    showToast('error', 'Error', 'No valid products found.');
                    btn.disabled = false;
                    btn.innerHTML = '<i class="bi bi-cart3"></i> Move All to Cart';
                    return;
                }

                let completed = 0, errors = 0;
                productIds.forEach(pid => {
                    fetch(`/cart/add/${pid}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        completed++;
                        if (!data.success) errors++;
                        if (completed === productIds.length) {
                            if (errors === 0) {
                                showToast('success', 'Success', 'All items moved to cart!');
                                setTimeout(() => window.location.href = "{{ route('checkout') }}", 1000);
                            } else {
                                showToast('error', 'Error', `${errors} item(s) failed.`);
                                btn.disabled = false;
                                btn.innerHTML = '<i class="bi bi-cart3"></i> Move All to Cart';
                            }
                        }
                    })
                    .catch(() => { completed++; errors++; if (completed === productIds.length) {
                        showToast('error', 'Error', 'Some items failed.');
                        btn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-cart3"></i> Move All to Cart';
                    }});
                });
            });

            // Share
            window.shareWishlist = function() {
                const url = window.location.href;
                if (navigator.share) {
                    navigator.share({ title: 'My Wishlist', text: 'Check out my wishlist!', url: url }).catch(() => {});
                } else {
                    navigator.clipboard.writeText(url).then(() => {
                        showToast('success', 'Copied', 'Wishlist link copied!');
                    }).catch(() => {
                        const ta = document.createElement('textarea');
                        ta.value = url;
                        document.body.appendChild(ta);
                        ta.select();
                        document.execCommand('copy');
                        document.body.removeChild(ta);
                        showToast('success', 'Copied', 'Wishlist link copied!');
                    });
                }
            };

            // Toast
            window.showToast = function(type, title, message) {
                let container = document.getElementById('toastContainer');
                if (!container) {
                    container = document.createElement('div');
                    container.className = 'toast-container';
                    container.id = 'toastContainer';
                    document.body.appendChild(container);
                }
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                const icons = { success: 'bi bi-check-circle-fill', error: 'bi bi-x-circle-fill', info: 'bi bi-info-circle-fill' };
                const colors = { success: '#22c55e', error: '#ef4444', info: '#3b82f6' };
                toast.innerHTML = `
                    <i class="${icons[type] || icons.info}" style="color:${colors[type] || colors.info};font-size:18px;"></i>
                    <div style="flex:1;"><strong style="display:block;margin-bottom:2px;">${title}</strong><div style="font-size:12px;color:#64748b;">${message}</div></div>
                    <button class="close-toast" style="background:none;border:0;color:#94a3b8;font-size:18px;cursor:pointer;">&times;</button>
                `;
                container.appendChild(toast);
                const tid = setTimeout(() => { toast.style.animation = 'slideOut 0.3s ease forwards'; setTimeout(() => toast.remove(), 300); }, 4000);
                toast.querySelector('.close-toast').addEventListener('click', function() {
                    clearTimeout(tid);
                    toast.style.animation = 'slideOut 0.3s ease forwards';
                    setTimeout(() => toast.remove(), 300);
                });
            };

            // Product Modal
            const modalEl = document.getElementById('productDetailsModal');
            if (modalEl) {
                const productModal = new bootstrap.Modal(modalEl);
                document.addEventListener('click', function (e) {
                    const card = e.target.closest('.product-details-trigger');
                    if (!card) return;
                    if (e.target.closest('button') || e.target.closest('form') || e.target.closest('a') || e.target.closest('.wishlist-checkbox')) return;
                    const pid = card.dataset.productId;
                    if (!pid) return;

                    const loader = document.getElementById('productModalLoader');
                    const content = document.getElementById('productModalContent');
                    if (loader) loader.style.display = 'flex';
                    if (content) content.style.display = 'none';
                    productModal.show();

                    fetch(`/customer/product-details/${pid}`, { headers: { 'Accept': 'application/json' } })
                    .then(async res => {
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Failed');
                        return data;
                    })
                    .then(data => {
                        if (!data.success || !data.product) throw new Error('Product not found');
                        const p = data.product;
                        document.getElementById('modalProductImage').src = p.image || '{{ asset('images/placeholder.png') }}';
                        document.getElementById('modalProductCategory').textContent = p.category || 'Product';
                        document.getElementById('modalProductCategoryInfo').textContent = p.category || 'Product';
                        document.getElementById('modalProductName').textContent = p.name;
                        document.getElementById('modalProductPrice').textContent = p.formatted_price || '₹' + p.price;
                        document.getElementById('modalProductDescription').innerHTML = p.description || 'No description.';
                        const stk = document.getElementById('modalProductStock');
                        if (stk) {
                            if (p.is_out_of_stock) { stk.textContent = 'Out of Stock'; stk.style.color = '#dc2626'; }
                            else { stk.textContent = 'In Stock'; stk.style.color = '#16a34a'; }
                        }
                        document.getElementById('modalReviewCount').textContent = `(${p.reviews_count || 0} Reviews)`;
                        const action = document.getElementById('modalProductAction');
                        if (action) {
                            if (p.is_futured) {
                                action.innerHTML = `<button class="product-modal-notify"><i class="bi bi-bell me-2"></i> Notify Me</button>`;
                            } else if (p.is_out_of_stock) {
                                action.innerHTML = `<button class="product-modal-add-cart" disabled><i class="bi bi-x-circle me-2"></i> Out of Stock</button>`;
                            } else {
                                action.innerHTML = `<form action="{{ url('/cart/add') }}/${p.id}" method="POST"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="product-modal-add-cart"><i class="bi bi-cart3 me-2"></i> Add to Cart</button></form>`;
                            }
                        }
                        if (loader) loader.style.display = 'none';
                        if (content) content.style.display = 'block';
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        productModal.hide();
                        showToast('error', 'Error', err.message || 'Failed to load details.');
                    });
                });
            }
        });
    </script>
@endsection