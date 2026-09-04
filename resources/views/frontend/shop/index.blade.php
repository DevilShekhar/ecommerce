@extends('frontend.layouts.app')

@section('title', 'Shops · Aethelweave')

@section('content')
    <style>
        /* ========== SHOP STYLES ========== */
        .shop-header {
            background: linear-gradient(135deg, #faf7f2 0%, #f0e8dc 100%);
            padding: 60px 40px 50px;
            text-align: center;
        }

        .shop-header h1 {
            font-size: 42px;
            font-weight: 700;
            color: #2c2416;
            margin-bottom: 10px;
        }

        .shop-header h1 i {
            color: #b18a45;
            margin-right: 12px;
        }

        .shop-header p {
            color: #6b5a4a;
            font-size: 17px;
        }

        .shop-header .breadcrumb {
            margin-top: 15px;
            color: #8a7a6a;
        }

        .shop-header .breadcrumb a {
            color: #b18a45;
            text-decoration: none;
        }

        .shop-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 30px 60px;
        }

        .shop-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 35px;
        }

        .sidebar {
            position: sticky;
            top: 100px;
            align-self: start;
        }

        .filter-section {
            background: #ffffff;
            border-radius: 16px;
            padding: 25px 22px;
            border: 1px solid #e8d9c0;
            margin-bottom: 20px;
        }

        .filter-section h3 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #6b5a4a;
            margin-bottom: 18px;
            font-weight: 600;
            border-bottom: 1px solid #f0e8dc;
            padding-bottom: 12px;
        }

        .filter-section h3 i {
            color: #b18a45;
            margin-right: 8px;
        }

        .filter-group {
            margin-bottom: 18px;
        }

        .filter-group:last-child {
            margin-bottom: 0;
        }

        .filter-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #4a4035;
            margin-bottom: 6px;
        }

        .filter-group select,
        .filter-group input[type="text"],
        .filter-group input[type="number"] {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #e0d5c8;
            border-radius: 8px;
            background: #faf7f2;
            font-family: inherit;
            font-size: 14px;
            color: #2c2416;
            transition: border-color 0.2s;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #b18a45;
        }

        .price-range {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .btn-filter {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
            text-align: center;
            text-decoration: none;
        }

        .btn-filter-primary {
            background: #b18a45;
            color: white;
        }

        .btn-filter-primary:hover {
            background: #9a7740;
        }

        .btn-filter-secondary {
            background: #f0e8dc;
            color: #2c2416;
        }

        .btn-filter-secondary:hover {
            background: #e0d5c8;
        }

        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .products-count {
            font-size: 15px;
            color: #6b5a4a;
        }

        .products-count strong {
            color: #2c2416;
        }

        .sort-control {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sort-control label {
            font-size: 14px;
            color: #6b5a4a;
        }

        .sort-control select {
            padding: 8px 14px;
            border: 1px solid #e0d5c8;
            border-radius: 8px;
            background: white;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }

        .product-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #f0e8dc;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(177, 138, 69, 0.12);
        }

        .product-image {
            width: 100%;
            height: 280px;
            overflow: hidden;
            background: #f5f0e8;
            position: relative;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .product-card:hover .product-image img {
            transform: scale(1.04);
        }

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #b18a45;
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .product-badge.sale {
            background: #c0392b;
        }

        .product-badge.featured {
            background: #2c3e50;
        }

        .product-info {
            padding: 16px 18px 20px;
        }

        .product-category {
            font-size: 12px;
            color: #8a7a6a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            pointer-events: none;
            cursor: default;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #2c2416;
        }

        .product-name a {
            text-decoration: none;
            color: inherit;
        }

        .product-name a:hover {
            color: #b18a45;
        }

        .product-meta {
            display: flex;
            gap: 12px;
            font-size: 13px;
            color: #6b5a4a;
            margin-bottom: 8px;
        }

        .product-meta i {
            margin-right: 4px;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-price .current {
            font-size: 20px;
            font-weight: 700;
            color: #2c2416;
        }

        .product-price .original {
            font-size: 15px;
            color: #a08878;
            text-decoration: line-through;
        }

        .product-stock {
            font-size: 13px;
            font-weight: 500;
        }

        .product-stock.in-stock {
            color: #27ae60;
        }

        .product-stock.out-of-stock {
            color: #c0392b;
        }

        .pagination {
            margin-top: 45px;
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 8px 16px;
            border: 1px solid #e0d5c8;
            border-radius: 8px;
            text-decoration: none;
            color: #2c2416;
            transition: all 0.2s;
            font-size: 14px;
            cursor: pointer;
        }

        .pagination a:hover {
            background: #b18a45;
            color: white;
            border-color: #b18a45;
        }

        .pagination .active {
            background: #b18a45;
            color: white;
            border-color: #b18a45;
        }

        .pagination .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .no-products {
            text-align: center;
            padding: 80px 20px;
        }

        .no-products i {
            font-size: 60px;
            color: #d5c8b8;
            margin-bottom: 20px;
        }

        .no-products h3 {
            font-size: 24px;
            color: #2c2416;
            margin-bottom: 10px;
        }

        .no-products p {
            color: #6b5a4a;
        }

        /* Loading Spinner */
        .loading-overlay {
            display: none;
            text-align: center;
            padding: 60px 20px;
        }

        .loading-overlay .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f0e8dc;
            border-top-color: #b18a45;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 1024px) {
            .shop-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .filter-section {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
                gap: 15px;
            }

            .filter-section h3 {
                grid-column: 1 / -1;
            }

            .filter-actions {
                grid-column: 1 / -1;
            }

            .filter-group {
                margin-bottom: 0;
            }
        }

        @media (max-width: 768px) {
            .shop-header {
                padding: 40px 20px 35px;
            }

            .shop-header h1 {
                font-size: 32px;
            }

            .shop-container {
                padding: 25px 15px 40px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 15px;
            }

            .product-image {
                height: 200px;
            }

            .products-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-section {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .product-image {
                height: 180px;
            }

            .product-info {
                padding: 12px 12px 16px;
            }

            .product-name {
                font-size: 14px;
            }

            .product-price .current {
                font-size: 16px;
            }

            .product-meta {
                font-size: 11px;
                flex-wrap: wrap;
            }
        }
    </style>

    <!-- =============================================
                        SHOP HEADER
                    ============================================= -->
    <section class="shop-header">
        <h1><i class="fas fa-store"></i> All Jewellery</h1>
        <p>Discover our curated collection of timeless pieces</p>
        <div class="breadcrumb">
            <a href="/">Home</a> / Shop
            <span id="breadcrumbCategory"></span>
        </div>
    </section>

    <!-- =============================================
                        SHOP CONTENT
                    ============================================= -->
    <div class="shop-container">
        <div class="shop-layout">

            <!-- SIDEBAR FILTERS -->
            <aside class="sidebar">
                <form id="filter-form" onsubmit="return false;">

                    <!-- CATEGORIES -->
                    <div class="filter-section">
                        <h3><i class="fas fa-tags"></i> Categories</h3>

                        <div class="filter-group">
                            <select name="category" id="category">
                                <option value="">All Categories</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                         <!-- Subcategories (dynamically loaded) -->
                        <div id="subcategoryContainer" style="display:none; margin-top: 12px;">
                            <div class="filter-group">
                                <label for="subcategory">Sub Category</label>
                                <select name="subcategory" id="subcategory" onchange="applyFilters()">
                                    <option value="">All Subcategories</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- FILTERS -->
                    <div class="filter-section">
                        <h3><i class="fas fa-filter"></i> Filters</h3>

                        @if($brands->isNotEmpty())
                            <div class="filter-group">
                                <label for="brand">Brand</label>
                                <select name="brand" id="brand">
                                    <option value="">All Brands</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if($materials->isNotEmpty())
                            <div class="filter-group">
                                <label for="material">Material</label>
                                <select name="material" id="material">
                                    <option value="">All Materials</option>
                                    @foreach($materials as $material)
                                        <option value="{{ $material }}">
                                            {{ $material }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="filter-group">
                            <label>Price Range</label>
                            <div class="price-range">
                                <input type="number" name="min_price" id="min_price" placeholder="Min" min="0">
                                <input type="number" name="max_price" id="max_price" placeholder="Max" min="0">
                            </div>
                        </div>

                        <div class="filter-group">
                            <label for="search">Search</label>
                            <input type="text" name="search" id="search" placeholder="Search products...">
                        </div>

                        <div class="filter-actions">
                            <button type="button" class="btn-filter btn-filter-primary" onclick="applyFilters()">
                                <i class="fas fa-search"></i> Apply
                            </button>
                            <button type="button" class="btn-filter btn-filter-secondary" onclick="resetFilters()">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                </form>
            </aside>

            <!-- PRODUCTS -->
            <main>

                <!-- Products Header -->
                <div class="products-header">
                    <div class="products-count">
                        <strong id="productCount">0</strong> products found
                    </div>

                    <div class="sort-control">
                        <label for="sort">Sort by:</label>
                        <select name="sort" id="sort" onchange="applyFilters()">
                            <option value="newest">Newest</option>
                            <option value="oldest">Oldest</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="name_asc">Name: A to Z</option>
                            <option value="name_desc">Name: Z to A</option>
                        </select>
                    </div>
                </div>

                <!-- Loading Spinner -->
                <div class="loading-overlay" id="loadingOverlay">
                    <div class="spinner"></div>
                    <p>Loading products...</p>
                </div>

                <!-- Products Grid -->
                <div id="productsContainer">
                    <!-- Products will be rendered here by JavaScript -->
                </div>

                <!-- Pagination -->
                <div id="paginationContainer">
                    <!-- Pagination will be rendered here by JavaScript -->
                </div>

            </main>
        </div>
    </div>

    <!-- =============================================
                        SCRIPTS
                    ============================================= -->
    <script>
        let currentPage = 1;
        let isLoading = false;

        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.querySelector('.hamburger-btn');
            const mobileMenu = document.querySelector('.mobile-menu');

            if (hamburger && mobileMenu) {
                hamburger.addEventListener('click', function () {
                    const isOpen = mobileMenu.style.display === 'block';
                    mobileMenu.style.display = isOpen ? 'none' : 'block';
                });
            }

            const navbar = document.querySelector('.navbar-modern');
            if (navbar) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }

            // Load initial products
            applyFilters();
        });

        // =============================================
// LOAD SUBCATEGORIES
// =============================================
function loadSubcategories(categorySlug) {
    const container = document.getElementById('subcategoryContainer');
    const subcategorySelect = document.getElementById('subcategory');

    if (!categorySlug) {
        container.style.display = 'none';
        subcategorySelect.innerHTML = '<option value="">All Subcategories</option>';
        applyFilters();
        return;
    }

    // Show loading state
    container.style.display = 'block';
    subcategorySelect.innerHTML = '<option value="">Loading...</option>';
    subcategorySelect.disabled = true;

    // Fetch subcategories
    fetch(`/get-subcategories/${categorySlug}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        subcategorySelect.innerHTML = '<option value="">All Subcategories</option>';

        if (data.success && data.subcategories.length > 0) {
            data.subcategories.forEach(sub => {
                const option = document.createElement('option');
                option.value = sub.slug;
                option.textContent = sub.name;
                subcategorySelect.appendChild(option);
            });
            subcategorySelect.disabled = false;
        } else {
            subcategorySelect.innerHTML = '<option value="">No Subcategories</option>';
            subcategorySelect.disabled = true;
        }

        // Apply filters to refresh products
        applyFilters();
    })
    .catch(error => {
        console.error('Error loading subcategories:', error);
        subcategorySelect.innerHTML = '<option value="">Error loading</option>';
        subcategorySelect.disabled = true;
    });
}

// Update getFilters function to include subcategory
function getFilters() {
    return {
        category: document.getElementById('category').value,
        subcategory: document.getElementById('subcategory') ? document.getElementById('subcategory').value : '',
        brand: document.getElementById('brand') ? document.getElementById('brand').value : '',
        material: document.getElementById('material') ? document.getElementById('material').value : '',
        min_price: document.getElementById('min_price').value,
        max_price: document.getElementById('max_price').value,
        search: document.getElementById('search').value,
        sort: document.getElementById('sort').value,
        page: currentPage
    };
}

// Update resetFilters function to reset subcategory
function resetFilters() {
    document.getElementById('category').value = '';
    document.getElementById('subcategory').value = '';
    document.getElementById('subcategoryContainer').style.display = 'none';
    if (document.getElementById('brand')) document.getElementById('brand').value = '';
    if (document.getElementById('material')) document.getElementById('material').value = '';
    document.getElementById('min_price').value = '';
    document.getElementById('max_price').value = '';
    document.getElementById('search').value = '';
    document.getElementById('sort').value = 'newest';
    currentPage = 1;
    applyFilters(1);
}

// On page load, check if a category is already selected
document.addEventListener('DOMContentLoaded', function() {
    const selectedCategory = document.getElementById('category').value;
    if (selectedCategory) {
        loadSubcategories(selectedCategory);
    }
});

        function applyFilters(page = 1) {
            if (page) currentPage = page;
            const filters = getFilters();
            const loading = document.getElementById('loadingOverlay');
            const container = document.getElementById('productsContainer');
            const pagination = document.getElementById('paginationContainer');

            // Show loading
            loading.style.display = 'block';
            container.innerHTML = '';
            pagination.innerHTML = '';

            // Build query string
            const params = new URLSearchParams();
            Object.keys(filters).forEach(key => {
                if (filters[key] !== '' && filters[key] !== null && filters[key] !== undefined) {
                    params.append(key, filters[key]);
                }
            });

            // AJAX request
            fetch(`/shops/filter?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    loading.style.display = 'none';

                    if (data.success) {
                        renderProducts(data.products);
                        renderPagination(data.current_page, data.last_page, data.total);
                        document.getElementById('productCount').textContent = data.total || 0;
                    } else {
                        container.innerHTML = `
                                            <div class="no-products">
                                                <i class="fas fa-box-open"></i>
                                                <h3>No products found</h3>
                                                <p>Try adjusting your filters or search terms.</p>
                                            </div>
                                        `;
                        document.getElementById('productCount').textContent = '0';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading.style.display = 'none';
                    container.innerHTML = `
                                        <div class="no-products">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <h3>Something went wrong</h3>
                                            <p>Please try again later.</p>
                                        </div>
                                    `;
                });
        }

        function renderProducts(products) {
            const container = document.getElementById('productsContainer');

            if (!products || products.length === 0) {
                container.innerHTML = `
                    <div class="no-products">
                        <i class="fas fa-box-open"></i>
                        <h3>No products found</h3>
                        <p>Try adjusting your filters or search terms.</p>
                    </div>
                `;
                return;
            }

            let html = '<div class="products-grid">';

            products.forEach(product => {
                const images = product.image ? product.image.split(',').map(s => s.trim()) : [];
                const firstImage = images.length > 0 ? images[0] : null;
                const imageHtml = firstImage ?
                    `<img src="${firstImage}" alt="${product.name}" loading="lazy">` :
                    `<img src="https://via.placeholder.com/400x400/f0e8dc/8a7a6a?text=No+Image" alt="No image" loading="lazy">`;

                const badgeHtml = product.is_featured == 2 ?
                    `<span class="product-badge featured">Featured</span>` :
                    product.is_featured == 1 ?
                        `<span class="product-badge">Popular</span>` :
                        '';

                const stockClass = product.stock > 0 ? 'in-stock' : 'out-of-stock';
                const stockIcon = product.stock > 0 ? 'check-circle' : 'times-circle';
                const stockText = product.stock > 0 ? 'In Stock' : 'Out of Stock';
                const stockExtra = product.stock > 0 && product.stock < 10 ? `(${product.stock} left)` : '';

                // Check if product is in wishlist
                const inWishlist = isInWishlist ? isInWishlist(product.id) : false;
                const heartIcon = inWishlist ? 'fas fa-heart' : 'far fa-heart';
                const heartColor = inWishlist ? '#e74c3c' : '#77736D';
                const heartBorder = inWishlist ? '#e74c3c' : '#E8E1D7';

                // Check if product is in cart
                const cart = getCart ? getCart() : [];
                const inCart = cart.some(item => item.id == product.id);

                html += `
                    <div class="product-card" style="position:relative;cursor:pointer;" onclick="window.location.href='/shop/${product.slug}'">
                        <div class="product-image" style="position:relative;">
                            ${imageHtml}
                            ${badgeHtml}

                            <!-- Wishlist Heart Button -->
                            <button type="button"
                                class="wishlist-btn"
                                data-product-id="${product.id}"
                                data-product-name="${product.name.replace(/'/g, "\\'")}"
                                data-product-price="${product.price}"
                                data-product-slug="${product.slug}"
                                data-product-image="${firstImage || ''}"
                                onclick="event.stopPropagation(); toggleWishlist(this, ${product.id}, '${product.name.replace(/'/g, "\\'")}', ${product.price}, '${product.slug}', '${firstImage || ''}');"
                                style="position:absolute;top:10px;right:10px;z-index:5;background:rgba(255,255,255,0.9);border:1px solid ${heartBorder};border-radius:50%;width:34px;height:34px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.3s ease;box-shadow:0 2px 8px rgba(0,0,0,0.08);padding:0;"
                                aria-label="Add to wishlist">
                                <i class="${heartIcon}" style="font-size:14px;color:${heartColor};transition:all 0.3s ease;"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <div class="product-category">${product.category ? product.category.name : 'Uncategorized'}</div>
                            <div class="product-name">
                                ${product.name}
                            </div>
                            <div class="product-meta">
                                ${product.brand ? `<span><i class="fas fa-tag"></i> ${product.brand.name}</span>` : ''}
                                ${product.variants ? `<span><i class="fas fa-gem"></i> ${product.variants}</span>` : ''}
                            </div>
                            <div class="product-price">
                                <span class="current">₹${parseFloat(product.price).toFixed(2)}</span>
                            </div>
                            <div class="product-stock ${stockClass}">
                                <i class="fas fa-${stockIcon}"></i>
                                ${stockText} ${stockExtra}
                            </div>
                            <div style="margin-top:10px;">
                                <button type="button"
                                    class="add-to-cart-btn"
                                    data-product-id="${product.id}"
                                    data-product-name="${product.name.replace(/'/g, "\\'")}"
                                    data-product-price="${product.price}"
                                    data-product-slug="${product.slug}"
                                    data-product-image="${firstImage || ''}"
                                    onclick="event.stopPropagation(); addToCartFromCard(this, ${product.id}, '${product.name.replace(/'/g, "\\'")}', ${product.price}, '${product.slug}', '${firstImage || ''}');"
                                    style="width:100%;padding:8px 16px;background:${inCart ? '#27ae60' : '#B89B5E'};color:#fff;border:none;border-radius:6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;cursor:pointer;transition:all 0.3s ease;display:flex;align-items:center;justify-content:center;gap:6px;">
                                    <i class="${inCart ? 'fas fa-check' : 'fas fa-cart-plus'}" style="font-size:12px;"></i>
                                    ${inCart ? 'In Cart' : 'Add to Cart'}
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });

            html += '</div>';
            container.innerHTML = html;

            // Re-initialize wishlist buttons after rendering
            if (typeof initWishlistButtons === 'function') {
                initWishlistButtons();
            }

            // Re-initialize cart button states after rendering
            if (typeof updateCartButtonStates === 'function') {
                updateCartButtonStates();
            }
        }

        function renderPagination(current, last, total) {
            const container = document.getElementById('paginationContainer');

            if (last <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '<div class="pagination">';

            // Previous
            if (current > 1) {
                html += `<a onclick="applyFilters(${current - 1})"><i class="fas fa-chevron-left"></i></a>`;
            } else {
                html += `<span class="disabled"><i class="fas fa-chevron-left"></i></span>`;
            }

            // Pages
            let start = Math.max(1, current - 2);
            let end = Math.min(last, current + 2);

            if (start > 1) {
                html += `<a onclick="applyFilters(1)">1</a>`;
                if (start > 2) html += `<span class="disabled">...</span>`;
            }

            for (let i = start; i <= end; i++) {
                if (i === current) {
                    html += `<span class="active">${i}</span>`;
                } else {
                    html += `<a onclick="applyFilters(${i})">${i}</a>`;
                }
            }

            if (end < last) {
                if (end < last - 1) html += `<span class="disabled">...</span>`;
                html += `<a onclick="applyFilters(${last})">${last}</a>`;
            }

            // Next
            if (current < last) {
                html += `<a onclick="applyFilters(${current + 1})"><i class="fas fa-chevron-right"></i></a>`;
            } else {
                html += `<span class="disabled"><i class="fas fa-chevron-right"></i></span>`;
            }

            html += '</div>';
            container.innerHTML = html;
        }

        function resetFilters() {
            document.getElementById('category').value = '';
            if (document.getElementById('brand')) document.getElementById('brand').value = '';
            if (document.getElementById('material')) document.getElementById('material').value = '';
            document.getElementById('min_price').value = '';
            document.getElementById('max_price').value = '';
            document.getElementById('search').value = '';
            document.getElementById('sort').value = 'newest';
            currentPage = 1;
            applyFilters(1);
        }

        // Enter key triggers search
        document.getElementById('search').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                applyFilters(1);
            }
        });

        // Auto-submit on filter change (except search and price)
        document.querySelectorAll('#category, #brand, #material, #sort').forEach(select => {
            if (select) {
                select.addEventListener('change', function () {
                    if (this.id === 'sort') {
                        applyFilters(1);
                    } else {
                        applyFilters(1);
                    }
                });
            }
        });

        // Price range - debounced
        let priceTimeout;
        document.querySelectorAll('.price-range input').forEach(input => {
            if (input) {
                input.addEventListener('input', function () {
                    clearTimeout(priceTimeout);
                    priceTimeout = setTimeout(() => {
                        applyFilters(1);
                    }, 500);
                });
            }
        });
    </script>

@endsection
