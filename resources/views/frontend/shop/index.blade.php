@extends('frontend.layouts.app')

@section('title', 'Shops · Aethelweave')
@section('content')
    <nav class="navbar-modern">
        <div class="navbar-container">
            <!-- Logo -->
            <a href="/" class="navbar-logo">
                <span class="navbar-logo-text">Aethelweave</span>
                <span class="navbar-logo-badge">Artisan</span>
            </a>

            <!-- Nav Links - Desktop -->
            <ul class="nav-links-desktop">
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('shop.index') }}" class="active">Shop</a></li>

                <li><a href={{ route('about-us') }}>About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

            <!-- Right Icons -->
            <div class="navbar-icons">
                <a href="#" class="navbar-icon">
                    <i class="bi bi-search"></i>
                </a>
               <a href="{{ route('login') }}" class="navbar-icon">
                    <i class="bi bi-person"></i>
                </a>
                <a href="#" class="navbar-icon">
                    <i class="bi bi-bag"></i>
                    <span class="navbar-cart-count">0</span>
                </a>
                <!-- Hamburger (Mobile) -->
                <button class="hamburger-btn" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('shop.index') }}" class="active">Shop</a></li>

                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- =============================================
        SHOP HEADER
    ============================================= -->
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

    <!-- =============================================
        SHOP CONTENT
    ============================================= -->
    <div class="shop-container">
        <div class="shop-layout">

            <!-- SIDEBAR FILTERS -->
            <aside class="sidebar">
                <form method="GET" action="{{ route('shop.index') }}" id="filter-form">

                    <!-- CATEGORIES -->
                    <div class="filter-section">
                        <h3><i class="fas fa-tags"></i> Categories</h3>
                        <div class="filter-group">
                            <select name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
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
                                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
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
                                        <option value="{{ $material }}" {{ request('material') == $material ? 'selected' : '' }}>
                                            {{ $material }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="filter-group">
                            <label>Price Range</label>
                            <div class="price-range">
                                <input type="number" name="min_price" placeholder="Min"
                                    value="{{ request('min_price') }}" min="0" max="{{ $priceRange['max'] }}">
                                <input type="number" name="max_price" placeholder="Max"
                                    value="{{ request('max_price') }}" min="0" max="{{ $priceRange['max'] }}">
                            </div>
                        </div>

                        <div class="filter-group">
                            <label for="search">Search</label>
                            <input type="text" name="search" id="search" placeholder="Search products..."
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
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to
                                High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High
                                to Low</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z
                            </option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A
                            </option>
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
                                        <img src="https://via.placeholder.com/400x400/f0e8dc/8a7a6a?text=No+Image" alt="No image"
                                            loading="lazy">
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

    <!-- =============================================
        SCRIPTS
    ============================================= -->
    <script>
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

            // Navbar scroll effect
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
        });

        // Auto-submit on filter change
        document.querySelectorAll('#category, #brand, #material, #sort').forEach(select => {
            select.addEventListener('change', function () {
                if (this.id === 'sort') {
                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', this.value);
                    window.location.href = url.toString();
                } else {
                    document.getElementById('filter-form').submit();
                }
            });
        });

        // Load subcategories when category changes
        document.getElementById('category').addEventListener('change', function () {
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
            input.addEventListener('input', function () {
                clearTimeout(priceTimeout);
                priceTimeout = setTimeout(() => {
                    document.getElementById('filter-form').submit();
                }, 500);
            });
        });
    </script>

@endsection
