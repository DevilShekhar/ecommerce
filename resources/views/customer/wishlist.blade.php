@extends('frontend.layouts.customer-layout')
@section('title', 'My Wishlist - ShopHub')
@section('content')
    <div class="wishlist-page">
        <div class="wishlist-wrapper">
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
                    <button type="button" class="wishlist-action-btn wishlist-action-outline">
                        <i class="bi bi-share"></i>
                        Share Wishlist
                    </button>
                    <button type="button" class="wishlist-action-btn wishlist-action-primary">
                        <i class="bi bi-cart3"></i>
                        Move All to Cart
                    </button>
                </div>
            </div>
            @if(isset($wishlistItems) && $wishlistItems->count() > 0)
                <div class="wishlist-list" id="wishlistContainer">
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
                            <div class="wishlist-item product-details-trigger" data-wishlist-id="{{ $item->id }}" data-product-id="{{ $product->id }}">
                                <input type="checkbox" class="wishlist-checkbox" value="{{ $item->id }}">
                                <div class="wishlist-product-image">
                                    @if($imgUrl)
                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                            onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                    @else
                                        <div class="wishlist-no-image">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="wishlist-product-info">
                                    <h3 class="wishlist-product-name" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </h3>
                                    @if(isset($product->color))
                                        <div class="wishlist-product-variant">
                                            {{ $product->color }}
                                        </div>
                                    @else
                                        <div class="wishlist-product-variant">
                                            {{ $product->category->name ?? 'Product' }}
                                        </div>
                                    @endif
                                    <div class="stock-status">
                                        <i class="bi bi-check-circle-fill"></i>
                                        In Stock
                                    </div>
                                </div>
                                <div class="wishlist-price">
                                    <div class="current-price">
                                        ₹{{ number_format($product->price, 0) }}
                                    </div>
                                    @if($originalPrice && $originalPrice > $product->price)
                                        <span class="old-price">
                                            ₹{{ number_format($originalPrice, 0) }}
                                        </span>
                                        <span class="discount-badge">
                                            {{ $discount }}% OFF
                                        </span>
                                    @endif
                                </div>
                                <button type="button" class="move-cart-btn" data-product-id="{{ $product->id }}"
                                    data-cart-url="{{ route('cart.add', $product->id) }}">
                                    <i class="bi bi-cart3"></i>
                                    Move to Cart
                                </button>
                                <button type="button" class="delete-wishlist-btn remove-wishlist-btn" data-id="{{ $item->id }}"
                                    data-url="{{ route('customer.wishlist.remove', $item->id) }}" title="Remove from Wishlist">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $wishlistItems->links() }}
                </div>
                <div class="wishlist-features">
                    <div class="wishlist-feature">
                        <div class="feature-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Save Your Favorites</strong>
                            <span>Keep track of items you love</span>
                        </div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon">
                            <i class="bi bi-bell"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Price Drop Alerts</strong>
                            <span>Get notified when prices drop</span>
                        </div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Secure &amp; Private</strong>
                            <span>Your wishlist is private</span>
                        </div>
                    </div>
                    <div class="wishlist-feature">
                        <div class="feature-icon">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <div class="feature-text">
                            <strong>Across Devices</strong>
                            <span>Access anytime, anywhere</span>
                        </div>
                    </div>
                </div>
                @if(isset($recommendedProducts) && $recommendedProducts->count())
                    <div class="recommendation-section">
                        <div class="recommendation-title">
                            <h2>You May Also Like</h2>
                        </div>
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
                                            <button class="recommendation-heart">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                        </div>
                                        <div class="recommendation-info">
                                            <h6>
                                                {{ $recommended->name }}
                                            </h6>
                                            <div class="recommendation-price">
                                                ₹{{ number_format($recommended->price, 0) }}
                                            </div>
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
                    <p>
                        Save your favorite products here and view them anytime.
                    </p>
                    <a href="{{ route('customer.products') }}" class="btn btn-primary px-4">
                        <i class="bi bi-cart3 me-1"></i>
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>

        <!-- ==========================================
         PRODUCT DETAILS MODAL
        ========================================== -->
        <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content product-details-modal-content">

                    <button type="button" class="product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                    </button>

                    <div class="modal-body p-0">

                        <div id="productModalLoader" class="product-modal-loader">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>

                        <div id="productModalContent" style="display:none;">

                            <div class="row g-0">

                                <!-- IMAGE -->
                                <div class="col-md-6">
                                    <div class="product-modal-image-wrap"
                                        style="height:500px; min-height:500px; max-height:500px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                                        <img id="modalProductImage" src="" alt="Product Image"
                                            style="width:100%; height:500px; object-fit:contain; display:block;">
                                    </div>
                                </div>

                                <!-- DETAILS -->
                                <div class="col-md-6">
                                    <div class="product-modal-details" style="height:500px; overflow-y:auto; padding:30px;">

                                        <div id="modalProductCategory" class="product-modal-category"></div>

                                        <h3 id="modalProductName"></h3>

                                        <div class="product-modal-rating">
                                            <span class="stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </span>
                                            <span id="modalReviewCount">(0 Reviews)</span>
                                        </div>

                                        <div id="modalProductPrice" class="product-modal-price"></div>

                                        <div id="modalProductDescription" class="product-modal-description"></div>

                                        <div class="product-modal-info">
                                            <div>
                                                <span>Availability</span>
                                                <strong id="modalProductStock"></strong>
                                            </div>
                                            <div>
                                                <span>Category</span>
                                                <strong id="modalProductCategoryInfo"></strong>
                                            </div>
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
    <div class="toast-container" id="toastContainer">
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                console.error('CSRF token not found!');
            }
            document.querySelectorAll('.remove-wishlist-btn').forEach(button => {

                button.addEventListener('click', function (e) {

                    e.preventDefault();
                    e.stopPropagation();

                    const url = this.dataset.url;
                    const removeBtn = this;

                    if (!url) {
                        showToast(
                            'error',
                            'Error',
                            'Invalid wishlist URL.'
                        );
                        return;
                    }

                    // Disable button while request is processing
                    removeBtn.disabled = true;
                    removeBtn.innerHTML =
                        '<i class="bi bi-hourglass-split"></i>';

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

                            if (!response.ok) {
                                throw new Error(
                                    data.message ||
                                    `Request failed with status ${response.status}`
                                );
                            }

                            return data;
                        })

                        .then(data => {

                            console.log('Wishlist remove response:', data);

                            if (data.success) {

                                showToast(
                                    'success',
                                    'Removed from wishlist',
                                    data.message ||
                                    'Product has been removed from your wishlist.'
                                );

                                /*
                                |--------------------------------------------------------------------------
                                | REFRESH PAGE AFTER SUCCESS
                                |--------------------------------------------------------------------------
                                */
                                setTimeout(() => {
                                    window.location.reload();
                                }, 700);

                            } else {

                                showToast(
                                    'error',
                                    'Error',
                                    data.message ||
                                    'Failed to remove item from wishlist.'
                                );

                                restoreRemoveButton(removeBtn);
                            }
                        })

                        .catch(error => {

                            console.error(
                                'Wishlist remove error:',
                                error
                            );

                            showToast(
                                'error',
                                'Error',
                                error.message ||
                                'Something went wrong while removing the product.'
                            );

                            restoreRemoveButton(removeBtn);
                        });
                });

            });

            /*
            |--------------------------------------------------------------------------
            | MOVE TO CART (Single Item)
            |--------------------------------------------------------------------------
            */
            document.querySelectorAll('.move-cart-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const url = this.dataset.cartUrl;
                    const btn = this;

                    if (!url) {
                        showToast('error', 'Error', 'Cart URL not found.');
                        return;
                    }

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
                                showToast(
                                    'success',
                                    'Added to Cart',
                                    data.message || 'Product added to cart successfully.'
                                );

                                // Redirect to checkout
                                setTimeout(() => {
                                    window.location.href = "{{ route('checkout') }}";
                                }, 500);
                            } else {
                                showToast(
                                    'error',
                                    'Error',
                                    data.message || 'Failed to add product to cart.'
                                );
                                restoreCartButton(btn);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast(
                                'error',
                                'Error',
                                'Something went wrong while adding the product to cart.'
                            );
                            restoreCartButton(btn);
                        });
                });
            });

            /*
            |--------------------------------------------------------------------------
            | MOVE ALL TO CART
            |--------------------------------------------------------------------------
            */
            document.querySelector('.wishlist-action-primary')?.addEventListener('click', function () {
                const selectedItems = document.querySelectorAll('.wishlist-checkbox:checked');

                if (selectedItems.length === 0) {
                    showToast('info', 'Info', 'Please select at least one item to move to cart.');
                    return;
                }

                const btn = this;
                btn.disabled = true;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Moving...';

                const productIds = [];
                selectedItems.forEach(cb => {
                    const item = cb.closest('.wishlist-item');
                    const moveBtn = item?.querySelector('.move-cart-btn');
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

                let completed = 0;
                let errors = 0;

                productIds.forEach(productId => {
                    fetch(`/cart/add/${productId}`, {
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
                            if (!data.success) {
                                errors++;
                            }

                            if (completed === productIds.length) {
                                if (errors === 0) {
                                    showToast('success', 'Success', 'All selected items moved to cart successfully!');
                                    setTimeout(() => {
                                        window.location.href = "{{ route('checkout') }}";
                                    }, 1000);
                                } else {
                                    showToast('error', 'Error', `${errors} item(s) failed to move to cart.`);
                                    btn.disabled = false;
                                    btn.innerHTML = '<i class="bi bi-cart3"></i> Move All to Cart';
                                }
                            }
                        })
                        .catch(error => {
                            completed++;
                            errors++;
                            console.error('Error moving item:', error);
                            if (completed === productIds.length) {
                                showToast('error', 'Error', 'Some items failed to move to cart.');
                                btn.disabled = false;
                                btn.innerHTML = '<i class="bi bi-cart3"></i> Move All to Cart';
                            }
                        });
                });
            });

            /*
            |--------------------------------------------------------------------------
            | SHARE WISHLIST
            |--------------------------------------------------------------------------
            */
            document.querySelector('.wishlist-action-outline')?.addEventListener('click', function () {
                const url = window.location.href;

                if (navigator.share) {
                    navigator.share({
                        title: 'My Wishlist',
                        text: 'Check out my wishlist on ShopHub!',
                        url: url
                    }).catch(() => { });
                } else {
                    navigator.clipboard.writeText(url)
                        .then(() => {
                            showToast('success', 'Link Copied', 'Wishlist link copied to clipboard!');
                        })
                        .catch(() => {
                            const textArea = document.createElement('textarea');
                            textArea.value = url;
                            document.body.appendChild(textArea);
                            textArea.select();
                            document.execCommand('copy');
                            document.body.removeChild(textArea);
                            showToast('success', 'Link Copied', 'Wishlist link copied to clipboard!');
                        });
                }
            });

            /*
            |--------------------------------------------------------------------------
            | RECOMMENDATION HEART BUTTON
            |--------------------------------------------------------------------------
            */
            document.querySelectorAll('.recommendation-heart').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const icon = this.querySelector('i');

                    if (icon.classList.contains('bi-heart')) {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                        this.style.color = '#ef3340';
                        showToast('success', 'Added to Wishlist', 'Product added to your wishlist!');
                    } else {
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');
                        this.style.color = '#475569';
                        showToast('info', 'Removed', 'Product removed from wishlist.');
                    }
                });
            });

            /*
            |--------------------------------------------------------------------------
            | PRODUCT DETAILS MODAL
            |--------------------------------------------------------------------------
            */
            const modalElement = document.getElementById('productDetailsModal');

            // Only initialize if modal exists
            if (modalElement) {
                const productModal = new bootstrap.Modal(modalElement);
                const detailsUrl = "{{ url('/customer/product-details') }}";

                document.addEventListener('click', function (e) {
                    const card = e.target.closest('.product-details-trigger');

                    if (!card) return;

                    // Don't open modal when clicking buttons/forms/links/checkboxes
                    if (
                        e.target.closest('button') ||
                        e.target.closest('form') ||
                        e.target.closest('a') ||
                        e.target.closest('.wishlist-checkbox')
                    ) {
                        return;
                    }

                    const productId = card.dataset.productId;

                    if (!productId) return;

                    // Show loader, hide content
                    const loader = document.getElementById('productModalLoader');
                    const content = document.getElementById('productModalContent');
                    if (loader) loader.style.display = 'flex';
                    if (content) content.style.display = 'none';

                    productModal.show();

                    fetch(detailsUrl + '/' + productId, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                        .then(async response => {
                            const data = await response.json();
                            if (!response.ok) {
                                throw new Error(data.message || 'Failed to load product details');
                            }
                            return data;
                        })
                        .then(data => {
                            if (!data.success || !data.product) {
                                throw new Error('Product details not found');
                            }

                            const product = data.product;

                            // Set image
                            const img = document.getElementById('modalProductImage');
                            if (img) {
                                img.src = product.image || '{{ asset('images/placeholder.png') }}';
                                img.alt = product.name;
                            }

                            // Set category
                            const category = document.getElementById('modalProductCategory');
                            if (category) category.textContent = product.category || 'Product';

                            const categoryInfo = document.getElementById('modalProductCategoryInfo');
                            if (categoryInfo) categoryInfo.textContent = product.category || 'Product';

                            // Set name
                            const name = document.getElementById('modalProductName');
                            if (name) name.textContent = product.name;

                            // Set price
                            const price = document.getElementById('modalProductPrice');
                            if (price) price.textContent = product.formatted_price || '₹' + product.price;

                            // Set description
                            const desc = document.getElementById('modalProductDescription');
                            if (desc) desc.innerHTML = product.description || 'No description available.';

                            // Set stock
                            const stock = document.getElementById('modalProductStock');
                            if (stock) {
                                if (product.is_out_of_stock) {
                                    stock.textContent = 'Out of Stock';
                                    stock.style.color = '#dc2626';
                                } else {
                                    stock.textContent = product.stock !== null ? 'In Stock' : 'In Stock';
                                    stock.style.color = '#16a34a';
                                }
                            }

                            // Set review count
                            const reviewCount = document.getElementById('modalReviewCount');
                            if (reviewCount) {
                                reviewCount.textContent = `(${product.reviews_count || 0} Reviews)`;
                            }

                            // Set action buttons
                            const actionContainer = document.getElementById('modalProductAction');
                            if (actionContainer) {
                                // FUTURED PRODUCT → NOTIFY ME
                                if (product.is_futured) {
                                    actionContainer.innerHTML = `
                                        <button type="button"
                                                class="product-modal-notify notify-me-btn"
                                                data-product-id="${product.id}">
                                            <i class="bi bi-bell me-2"></i>
                                            Notify Me
                                        </button>
                                    `;
                                }
                                // OUT OF STOCK
                                else if (product.is_out_of_stock) {
                                    actionContainer.innerHTML = `
                                        <button type="button"
                                                class="product-modal-add-cart"
                                                disabled>
                                            <i class="bi bi-x-circle me-2"></i>
                                            Out of Stock
                                        </button>
                                    `;
                                }
                                // ADD TO CART
                                else {
                                    actionContainer.innerHTML = `
                                        <form action="{{ url('/cart/add') }}/${product.id}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="product-modal-add-cart">
                                                <i class="bi bi-cart3 me-2"></i>
                                                Add to Cart
                                            </button>
                                        </form>
                                    `;
                                }
                            }

                            // Show content, hide loader
                            if (loader) loader.style.display = 'none';
                            if (content) content.style.display = 'block';

                        })
                        .catch(error => {
                            console.error('Product Details Error:', error);
                            productModal.hide();
                            if (typeof showToast === 'function') {
                                showToast('error', 'Error', error.message || 'Failed to load product details.');
                            }
                        });
                });
            }
        });

        /*
        |--------------------------------------------------------------------------
        | UTILITY FUNCTIONS
        |--------------------------------------------------------------------------
        */
        function updateWishlistCounts(count) {
            const headerBadge = document.getElementById('headerWishlistCount');
            const sidebarBadge = document.getElementById('sidebarWishlistCount');
            const countDisplay = document.getElementById('wishlistCountDisplay');

            if (headerBadge) {
                headerBadge.textContent = count;
                if (count > 0) {
                    headerBadge.style.display = 'inline';
                } else {
                    headerBadge.style.display = 'none';
                }
            }

            if (sidebarBadge) {
                sidebarBadge.textContent = count;
                if (count > 0) {
                    sidebarBadge.style.display = 'inline';
                } else {
                    sidebarBadge.style.display = 'none';
                }
            }

            if (countDisplay) {
                countDisplay.textContent = count + ' items';
            }
        }

        function restoreRemoveButton(button) {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-trash3"></i>';
        }

        function restoreCartButton(button) {
            button.disabled = false;
            button.innerHTML = '<i class="bi bi-cart3"></i> Move to Cart';
        }

        /*
        |--------------------------------------------------------------------------
        | TOAST NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        function showToast(type, title, message) {
            let container = document.getElementById('toastContainer');

            if (!container) {
                container = document.createElement('div');
                container.className = 'toast-container';
                container.id = 'toastContainer';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;

            const icons = {
                success: 'bi bi-check-circle-fill',
                error: 'bi bi-x-circle-fill',
                info: 'bi bi-info-circle-fill',
                warning: 'bi bi-exclamation-triangle-fill'
            };

            const colors = {
                success: '#22c55e',
                error: '#ef4444',
                info: '#3b82f6',
                warning: '#f59e0b'
            };

            toast.innerHTML = `
                        <i class="${icons[type] || icons.info}" style="color: ${colors[type] || colors.info}; font-size: 20px;"></i>
                        <div style="flex: 1;">
                            <strong style="display: block; margin-bottom: 2px;">${title}</strong>
                            <div style="font-size: 13px; color: #64748b;">${message}</div>
                        </div>
                        <button class="close-toast" style="background: none; border: 0; color: #94a3b8; font-size: 20px; cursor: pointer; padding: 0 0 0 10px;">&times;</button>
                    `;

            container.appendChild(toast);

            const timeoutId = setTimeout(() => closeToast(toast), 4000);

            toast.querySelector('.close-toast').addEventListener('click', function () {
                clearTimeout(timeoutId);
                closeToast(toast);
            });
        }

        function closeToast(toast) {
            toast.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 300);
        }

        /*
        |--------------------------------------------------------------------------
        | TOAST STYLES
        |--------------------------------------------------------------------------
        */
        const styleSheet = document.createElement("style");
        styleSheet.textContent = `
                    .toast-container {
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        z-index: 99999;
                        max-width: 400px;
                        width: 100%;
                    }

                    .toast {
                        background: #fff;
                        border-radius: 8px;
                        padding: 15px 20px;
                        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
                        margin-bottom: 10px;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        animation: slideIn 0.3s ease;
                        border-left: 4px solid #ccc;
                    }

                    .toast-success {
                        border-left-color: #22c55e;
                    }

                    .toast-error {
                        border-left-color: #ef4444;
                    }

                    .toast-info {
                        border-left-color: #3b82f6;
                    }

                    .toast-warning {
                        border-left-color: #f59e0b;
                    }

                    @keyframes slideIn {
                        from {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }

                    @keyframes slideOut {
                        from {
                            transform: translateX(0);
                            opacity: 1;
                        }
                        to {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                    }

                    @media (max-width: 576px) {
                        .toast-container {
                            top: 10px;
                            right: 10px;
                            left: 10px;
                            max-width: none;
                        }

                        .toast {
                            padding: 12px 15px;
                            font-size: 14px;
                        }
                    }
                `;
        document.head.appendChild(styleSheet);

        console.log('Wishlist script loaded successfully!');
    </script>
@endsection
