@extends('frontend.layouts.app')

@section('title', 'My Wishlist')

@section('content')
    <section class="wishlist-section">
        <div class="container">
            <div class="section-heading">
                <h2 class="section-title">My Wishlist</h2>
                <p class="section-content">Your favorite products</p>
            </div>

            @auth
                @if($wishlistItems->count())
                    <div class="row g-4 wishlist-grid" id="authWishlistGrid">
                        @foreach($wishlistItems as $item)
                            @if($item->product)
                                <div class="col-lg-3 col-md-4 col-6 wishlist-item" data-id="{{ $item->id }}">
                                    <div class="product-card">
                                        <div class="product-image-wrapper">
                                            @php
                                                $image = $item->product->image ? trim(explode(',', $item->product->image)[0]) : '';
                                                $image = $image && !preg_match('/^(https?:\/\/|\/)/', '' . $image) ? '/' . $image : $image;
                                            @endphp
                                            @if($image)
                                                <img src="{{ $image }}" alt="{{ $item->product->name }}" class="product-image" loading="lazy"
                                                    onerror="this.src='/images/placeholder.png'">
                                            @else
                                                <div class="product-image-placeholder"><i class="bi bi-image"></i></div>
                                            @endif
                                            <button type="button" class="remove-wishlist-btn auth-remove-btn" data-id="{{ $item->id }}">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                        <div class="product-body">
                                            <h5 class="product-title">{{ $item->product->name }}</h5>
                                            <div class="product-price">₹{{ number_format($item->product->price, 2) }}</div>
                                            <button type="button" class="btn-add-cart add-to-cart"
                                                data-product-id="{{ $item->product->id }}">
                                                <i class="bi bi-cart-plus"></i> Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="empty-wishlist">
                        <i class="bi bi-heart"></i>
                        <h4>Your wishlist is empty</h4>
                        <p>Start adding items to your wishlist</p>
                        <a href="{{ url('/all-product') }}" class="btn-main">Browse Products</a>
                    </div>
                @endif
            @else
                <div id="guestWishlistContainer">
                    <div class="row g-4 wishlist-grid" id="guestWishlistGrid"></div>
                    <div class="empty-wishlist" id="guestEmptyWishlist" style="display:none;">
                        <i class="bi bi-heart"></i>
                        <h4>Your wishlist is empty</h4>
                        <p>Start adding items to your wishlist</p>
                        <a href="{{ url('/all-product') }}" class="btn-main">Browse Products</a>
                    </div>
                </div>
            @endauth
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .wishlist-section{padding:60px 0;background:#f8fafc;min-height:500px}
        .section-heading{text-align:center;margin-bottom:40px}
        .section-title{color:#0f172a;font-weight:700;margin-bottom:8px}
        .section-content{color:#64748b;margin-bottom:0}
        .wishlist-item{transition:all .3s ease}
        .wishlist-item.removing{opacity:0;transform:scale(.8)}
        .product-card{background:#fff;border-radius:14px;overflow:hidden;height:100%;transition:all .3s ease;border:1px solid #e2e8f0}
        .product-card:hover{transform:translateY(-4px);box-shadow:0 10px 30px rgba(15,23,42,.08)}
        .product-image-wrapper{position:relative;width:100%;height:260px;background:#f8fafc;overflow:hidden}
        .product-image{width:100%;height:100%;object-fit:cover;display:block}
        .product-image-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#cbd5e1;font-size:45px}
        .remove-wishlist-btn{position:absolute;top:10px;right:10px;width:34px;height:34px;border:0;border-radius:50%;background:rgba(239,68,68,.95);color:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .3s ease;z-index:5}
        .remove-wishlist-btn:hover{background:#dc2626;transform:scale(1.1)}
        .remove-wishlist-btn i{font-size:12px}
        .product-body{padding:18px}
        .product-title{color:#0f172a;font-size:16px;font-weight:600;margin-bottom:10px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
        .product-price{color:#0f172a;font-size:18px;font-weight:700;margin-bottom:15px}
        .btn-add-cart{width:100%;border:0;border-radius:8px;padding:10px 14px;background:#0f172a;color:#fff;font-size:14px;font-weight:600;cursor:pointer;transition:all .3s ease}
        .btn-add-cart:hover{background:#2563eb}
        .empty-wishlist{text-align:center;padding:70px 20px}
        .empty-wishlist i{font-size:55px;color:#cbd5e1;margin-bottom:18px;display:block}
        .empty-wishlist h4{color:#0f172a;font-weight:600;margin-bottom:8px}
        .empty-wishlist p{color:#94a3b8;margin-bottom:20px}
        .btn-main{display:inline-block;padding:11px 22px;border-radius:8px;background:#0f172a;color:#fff;text-decoration:none;font-weight:600;transition:all .3s ease}
        .btn-main:hover{background:#2563eb;color:#fff}
        .spinner-border{width:3rem;height:3rem}
        @media(max-width:768px){.wishlist-section{padding:40px 0}.product-image-wrapper{height:210px}.product-body{padding:13px}.product-title{font-size:14px}.product-price{font-size:16px}.btn-add-cart{font-size:13px;padding:9px}}
        @media(max-width:576px){.product-image-wrapper{height:180px}}
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =============================================
            // HELPERS
            // =============================================
            function getWishlist() {
                try {
                    return JSON.parse(localStorage.getItem('guest_wishlist') || '[]');
                } catch (e) {
                    return [];
                }
            }

            function saveWishlist(data) {
                localStorage.setItem('guest_wishlist', JSON.stringify(data));
            }

            function getCart() {
                try {
                    return JSON.parse(localStorage.getItem('guest_cart') || '[]');
                } catch (e) {
                    return [];
                }
            }

            function saveCart(data) {
                localStorage.setItem('guest_cart', JSON.stringify(data));
            }

            function escapeHtml(text) {
                var div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // =============================================
            // UPDATE BADGES
            // =============================================
            function updateGuestBadge() {
                var count = getWishlist().length;
                var badge = document.getElementById('guestWishlistBadge');
                var mobile = document.getElementById('guestMobileWishlistBadge');
                if (badge) {
                    badge.textContent = count;
                    badge.style.display = count ? 'inline' : 'none';
                }
                if (mobile) {
                    mobile.textContent = count;
                    mobile.style.display = count ? 'inline' : 'none';
                }
            }

            function updateAuthBadge(count) {
                var badge = document.querySelector('.wishlist-badge');
                if (badge) {
                    badge.textContent = count;
                    badge.style.display = count ? 'inline' : 'none';
                }
            }

            // =============================================
            // AUTHENTICATED USER - REMOVE
            // =============================================
            document.querySelectorAll('.auth-remove-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var item = this.closest('.wishlist-item');
                    if (!id || !confirm('Remove this item from wishlist?')) return;

                    fetch('{{ url('/wishlist') }}/' + id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(function(r) {
                            if (!r.ok) throw new Error('Request failed');
                            return r.json();
                        })
                        .then(function(data) {
                            if (data.success) {
                                item.classList.add('removing');
                                setTimeout(function() {
                                    item.remove();
                                    updateAuthBadge(data.wishlist_count);
                                    if (!document.querySelector('#authWishlistGrid .wishlist-item'))
                                        location.reload();
                                }, 300);
                            } else {
                                alert(data.message || 'Failed to remove item');
                            }
                        })
                        .catch(function(e) {
                            console.error(e);
                            alert('Something went wrong');
                        });
                });
            });

            // =============================================
            // GUEST USER - LOAD WISHLIST
            // =============================================
            var guestGrid = document.getElementById('guestWishlistGrid');
            if (guestGrid) {
                loadGuestWishlist();
            }

            function loadGuestWishlist() {
                var wishlist = getWishlist();
                var empty = document.getElementById('guestEmptyWishlist');

                if (!wishlist.length) {
                    guestGrid.innerHTML = '';
                    if (empty) empty.style.display = 'block';
                    updateGuestBadge();
                    return;
                }

                // Show loading
                guestGrid.innerHTML =
                    '<div class="col-12 text-center py-5"><div class="spinner-border text-primary" role="status"></div></div>';

                fetch('{{ route('wishlist.guest') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ product_ids: wishlist })
                    })
                    .then(function(r) {
                        if (!r.ok) throw new Error('Request failed: ' + r.status);
                        return r.json();
                    })
                    .then(function(data) {
                        if (data.success && data.items && data.items.length) {
                            if (empty) empty.style.display = 'none';
                            renderGuestWishlist(data.items);
                        } else {
                            guestGrid.innerHTML = '';
                            if (empty) empty.style.display = 'block';
                        }
                        updateGuestBadge();
                    })
                    .catch(function(e) {
                        console.error('Error:', e);
                        guestGrid.innerHTML = '';
                        if (empty) empty.style.display = 'block';
                    });
            }

            // =============================================
            // RENDER GUEST WISHLIST
            // =============================================
            function renderGuestWishlist(products) {
                guestGrid.innerHTML = '';

                products.forEach(function(product) {
                    var imageUrl = '/images/placeholder.png';

                    if (product.image) {
                        var images = String(product.image).split(',').map(function(img) { return img.trim(); })
                            .filter(Boolean);
                        if (images.length) {
                            imageUrl = images[0];
                            if (!imageUrl.startsWith('http://') && !imageUrl.startsWith('https://') &&
                                !imageUrl.startsWith('/')) {
                                imageUrl = '/' + imageUrl;
                            }
                        }
                    }

                    var col = document.createElement('div');
                    col.className = 'col-lg-3 col-md-4 col-6 wishlist-item';
                    col.dataset.productId = product.id;

                    var productName = escapeHtml(product.name || 'Product');
                    var price = parseFloat(product.price || 0).toFixed(2);

                    col.innerHTML = `
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <img src="${imageUrl}" alt="${productName}" class="product-image" loading="lazy" onerror="this.src='/images/placeholder.png'">
                                <button type="button" class="remove-wishlist-btn guest-remove-btn" data-product-id="${product.id}">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                            <div class="product-body">
                                <h5 class="product-title">${productName}</h5>
                                <div class="product-price">₹${price}</div>
                                <button type="button" class="btn-add-cart guest-add-cart" data-product-id="${product.id}">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    `;

                    guestGrid.appendChild(col);
                });

                // Guest remove buttons
                guestGrid.querySelectorAll('.guest-remove-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var productId = parseInt(this.dataset.productId);
                        var item = this.closest('.wishlist-item');
                        var wishlist = getWishlist().filter(function(id) {
                            return parseInt(id) !== productId;
                        });

                        saveWishlist(wishlist);
                        item.classList.add('removing');

                        setTimeout(function() {
                            item.remove();
                            updateGuestBadge();

                            if (!guestGrid.querySelector('.wishlist-item')) {
                                var empty = document.getElementById('guestEmptyWishlist');
                                if (empty) empty.style.display = 'block';
                            }
                        }, 300);
                    });
                });

                // Guest add to cart
                guestGrid.querySelectorAll('.guest-add-cart').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var productId = parseInt(this.dataset.productId);
                        var cart = getCart();
                        var existing = cart.find(function(item) {
                            return parseInt(item.product_id) === productId;
                        });

                        if (existing) {
                            existing.quantity = (existing.quantity || 1) + 1;
                        } else {
                            cart.push({ product_id: productId, quantity: 1 });
                        }

                        saveCart(cart);

                        if (typeof showToast === 'function') {
                            showToast('Added to cart!');
                        } else {
                            alert('Added to cart!');
                        }
                    });
                });
            }

            // =============================================
            // INITIALIZE
            // =============================================
            updateGuestBadge();
        });
    </script>
@endpush
