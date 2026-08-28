<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - All Jewellery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #faf7f2;
            color: #2c2416;
        }

        /* HEADER / NAV */
        .top-nav {
            background: #ffffff;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e8d9c0;
            flex-wrap: wrap;
            gap: 15px;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #2c2416;
            text-decoration: none;
        }

        .logo span {
            color: #b18a45;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: #4a4035;
            font-size: 15px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #b18a45;
        }

        /* SHOP HEADER */
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

        /* SHOP LAYOUT */
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

        /* SIDEBAR FILTERS */
        .sidebar {
            position: sticky;
            top: 30px;
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

        /* PRODUCTS HEADER */
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

        /* PRODUCTS GRID */
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

        /* PAGINATION */
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

        /* NO PRODUCTS */
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

        /* RESPONSIVE */
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
            .top-nav {
                padding: 15px 20px;
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                gap: 20px;
                flex-wrap: wrap;
            }

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
</head>

<body>

    <!-- NAVBAR -->
    <nav class="top-nav">
        <a href="/" class="logo">Lumina<span>.</span></a>
        <div class="nav-links">
            <a href="/">Home</a>
            <a href="/about-us">About</a>
            <a href="/shop" class="active">Shop</a>
            <a href="/contact">Contact</a>
        </div>
    </nav>

    <!-- SHOP HEADER -->
    <section class="shop-header">
        <h1><i class="fas fa-store"></i> All Jewellery</h1>
        <p>Discover our curated collection of timeless pieces</p>
        <div class="breadcrumb">
            <a href="/">Home</a> / Shop
            @if(request('category'))
                / {{ $categories->where('id', request('category'))->first()->name ?? '' }}
            @endif
        </div>
    </section>

    <!-- SHOP CONTENT -->
    <div class="shop-container">
        <div class="shop-layout">

            <!-- SIDEBAR FILTERS -->
            <aside class="sidebar">
                <form method="GET" action="{{ route('shop.index') }}" id="filter-form">

                    <!-- CATEGORIES -->
                    <div class="filter-section">
                        <h3><i class="fas fa-tags"></i> Categories</h3>
                        <div class="filter-group">
                            <select name="category" id="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group" id="subCategoryGroup" style="{{ request('category') ? '' : 'display:none;' }}">
                            <label for="sub_category">Sub Category</label>
                            <select name="sub_category" id="sub_category">
                                <option value="">All Sub Categories</option>
                            </select>
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
                                        <option value="{{ $brand->id }}"
                                            {{ request('brand') == $brand->id ? 'selected' : '' }}>
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
                                        <option value="{{ $material }}"
                                            {{ request('material') == $material ? 'selected' : '' }}>
                                            {{ $material }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="filter-group">
                            <label>Price Range</label>
                            <div class="price-range">
                                <input type="number" name="min_price"
                                    placeholder="Min"
                                    value="{{ request('min_price') }}"
                                    min="0" max="{{ $priceRange['max'] }}">
                                <input type="number" name="max_price"
                                    placeholder="Max"
                                    value="{{ request('max_price') }}"
                                    min="0" max="{{ $priceRange['max'] }}">
                            </div>
                        </div>

                        <div class="filter-group">
                            <label for="search">Search</label>
                            <input type="text" name="search" id="search"
                                placeholder="Search products..."
                                value="{{ request('search') }}">
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn-filter btn-filter-primary">
                                <i class="fas fa-search"></i> Apply
                            </button>
                            <a href="{{ route('shop.index') }}" class="btn-filter btn-filter-secondary">
                                <i class="fas fa-undo"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </aside>

            <!-- PRODUCTS -->
            <main>

                <!-- Products Header -->
                <div class="products-header">
                    <div class="products-count">
                        <strong>{{ $products->total() }}</strong> products found
                    </div>

                    <div class="sort-control">
                        <label for="sort">Sort by:</label>
                        <select name="sort" id="sort">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                @if($products->isEmpty())
                    <div class="no-products">
                        <i class="fas fa-box-open"></i>
                        <h3>No products found</h3>
                        <p>Try adjusting your filters or search terms.</p>
                    </div>
                @else
                    <div class="products-grid">
                        @foreach($products as $product)
                            <div class="product-card">
                                <div class="product-image">
                                    @php
                                        $images = $product->image ? explode(',', $product->image) : [];
                                        $firstImage = !empty($images) ? $images[0] : null;
                                    @endphp
                                    @if($firstImage)
                                        <img src="{{ asset($firstImage) }}" alt="{{ $product->name }}" loading="lazy">
                                    @else
                                        <img src="https://via.placeholder.com/400x400/f0e8dc/8a7a6a?text=No+Image" alt="No image" loading="lazy">
                                    @endif

                                    @if($product->is_featured == 2)
                                        <span class="product-badge featured">Featured</span>
                                    @elseif($product->is_featured == 1)
                                        <span class="product-badge">Popular</span>
                                    @endif
                                </div>

                                <div class="product-info">
                                    <div class="product-category">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </div>
                                    <div class="product-name">
                                        <a href="{{ route('shop.show', $product->id) }}">{{ $product->name }}</a>
                                    </div>
                                    <div class="product-meta">
                                        @if($product->brand)
                                            <span><i class="fas fa-tag"></i> {{ $product->brand->name }}</span>
                                        @endif
                                        @if($product->variants)
                                            <span><i class="fas fa-gem"></i> {{ $product->variants }}</span>
                                        @endif
                                    </div>
                                    <div class="product-price">
                                        <span class="current">₹{{ number_format($product->price, 2) }}</span>
                                    </div>
                                    <div class="product-stock {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                        <i class="fas fa-{{ $product->stock > 0 ? 'check-circle' : 'times-circle' }}"></i>
                                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                        @if($product->stock > 0 && $product->stock < 10)
                                            ({{ $product->stock }} left)
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        @if($products->onFirstPage())
                            <span class="disabled"><i class="fas fa-chevron-left"></i></span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                        @endif

                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if($page == $products->currentPage())
                                <span class="active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                        @else
                            <span class="disabled"><i class="fas fa-chevron-right"></i></span>
                        @endif
                    </div>
                @endif

            </main>
        </div>
    </div>

    <script>
        // Auto-submit on filter change
        document.querySelectorAll('#category, #brand, #material, #sort').forEach(select => {
            select.addEventListener('change', function() {
                if (this.id === 'sort') {
                    // Build URL with all current filters and new sort
                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', this.value);
                    window.location.href = url.toString();
                } else {
                    document.getElementById('filter-form').submit();
                }
            });
        });

        // Load subcategories when category changes
        document.getElementById('category').addEventListener('change', function() {
            const categoryId = this.value;
            const subCategorySelect = document.getElementById('sub_category');
            const subCategoryGroup = document.getElementById('subCategoryGroup');

            if (!categoryId) {
                subCategoryGroup.style.display = 'none';
                subCategorySelect.innerHTML = '<option value="">All Sub Categories</option>';
                return;
            }

            subCategoryGroup.style.display = 'block';
            subCategorySelect.innerHTML = '<option value="">Loading...</option>';

            fetch('/get-subcategories/' + categoryId)
                .then(response => response.json())
                .then(data => {
                    subCategorySelect.innerHTML = '<option value="">All Sub Categories</option>';
                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        if (option.value == '{{ request('sub_category') }}') {
                            option.selected = true;
                        }
                        subCategorySelect.appendChild(option);
                    });
                })
                .catch(() => {
                    subCategorySelect.innerHTML = '<option value="">Error loading</option>';
                });
        });

        // Trigger initial subcategory load if category is selected
        @if(request('category'))
            document.getElementById('category').dispatchEvent(new Event('change'));
        @endif

        // Price range - submit after user stops typing
        let priceTimeout;
        document.querySelectorAll('.price-range input').forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(priceTimeout);
                priceTimeout = setTimeout(() => {
                    document.getElementById('filter-form').submit();
                }, 500);
            });
        });
    </script>

</body>

</html>
