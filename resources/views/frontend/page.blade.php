@extends('frontend.layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? '')

@section('content')

    @php
        use Illuminate\Support\Facades\Storage;
    @endphp

    @foreach($page->sections->where('status', 1)->sortBy('sort_order') as $section)
        @if($section->section_type === 'hero')

            @php
                $heroImages = $section->images ? json_decode($section->images, true) : [];
                if (empty($heroImages) && $section->image) {
                    $heroImages = [$section->image];
                }
                $hasMultipleImages = count($heroImages) > 1;
            @endphp

            <section class="hero-section">
                <div class="hero-slider-container">
                    @if(!empty($heroImages))
                        @foreach($heroImages as $index => $image)
                            <div class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                                style="background-image: url('{{ asset('storage/' . $image) }}');">
                                <div class="hero-overlay"></div>
                            </div>
                        @endforeach

                        @if($hasMultipleImages)
                            <div class="hero-slider-dots">
                                @foreach($heroImages as $index => $image)
                                    <span class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></span>
                                @endforeach
                            </div>
                            <button class="hero-slider-arrow prev" type="button" aria-label="Previous">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="hero-slider-arrow next" type="button" aria-label="Next">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        @endif
                    @endif
                </div>

                <div class="container position-relative">
                    <div class="hero-content">
                        @if($section->sub_title)
                            <span class="hero-subtitle">{{ $section->sub_title }}</span>
                        @endif
                        @if($section->title)
                            <h1 class="hero-title">{{ $section->title }}</h1>
                        @endif
                        @if($section->content)
                            <div class="hero-description">{!! $section->content !!}</div>
                        @endif
                        @if($section->button_text && $section->button_url)
                            <a href="{{ url($section->button_url) }}" class="btn-main">
                                {{ $section->button_text }}
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </section>
            {{-- =========================================================
            ALL BANNERS CAROUSEL
            ========================================================== --}}
            @if(isset($banners) && $banners->count() > 0)
                <section class="banner-carousel-section small-banner-section">
                    <div class="container">
                        <div class="banner-carousel-wrapper">
                            <div class="banner-carousel-container">
                                @foreach($banners as $index => $banner)
                                    <div class="banner-carousel-slide {{ $index === 0 ? 'active' : '' }}"
                                        style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
                                        <div class="banner-carousel-content">
                                            <div class="banner-carousel-text">
                                                @if($banner->title)
                                                    <h3 class="banner-carousel-title">{{ $banner->title }}</h3>
                                                @endif
                                                @if($banner->banner_type)
                                                    <span
                                                        class="banner-carousel-badge">{{ ucfirst(str_replace('_', ' ', $banner->banner_type)) }}</span>
                                                @endif
                                                <a href="{{ $banner->link_url }}" class="banner-btn">
                                                    Shop Now <i class="bi bi-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if($banners->count() > 1)
                                    <div class="banner-carousel-dots">
                                        @foreach($banners as $index => $banner)
                                            <span class="banner-carousel-dot {{ $index === 0 ? 'active' : '' }}"
                                                data-slide="{{ $index }}"></span>
                                        @endforeach
                                    </div>
                                    <button class="banner-carousel-arrow prev" type="button">
                                        <i class="bi bi-chevron-left"></i>
                                    </button>
                                    <button class="banner-carousel-arrow next" type="button">
                                        <i class="bi bi-chevron-right"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            {{-- =========================================================
            ABOUT SECTION
            ========================================================== --}}
        @elseif($section->section_type === 'about')

            <section class="website-section about-section">
                <div class="container">
                    <div class="row align-items-center g-5">
                        @if($section->image)
                            <div class="col-lg-6">
                                <div class="about-image-wrapper">
                                    <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title ?? 'About Us' }}"
                                        class="about-image">
                                </div>
                            </div>
                        @endif
                        <div class="{{ $section->image ? 'col-lg-6' : 'col-lg-12' }}">
                            <div class="about-content">
                                @if($section->sub_title)
                                    <div class="section-subtitle">{{ $section->sub_title }}</div>
                                @endif
                                @if($section->title)
                                    <h2 class="section-title">{{ $section->title }}</h2>
                                @endif
                                @if($section->content)
                                    <div class="section-content about-description">{!! $section->content !!}</div>
                                @endif
                                @if($section->button_text && $section->button_url)
                                    <div class="section-action mt-3">
                                        <a href="{{ url($section->button_url) }}" class="btn-main">
                                            {{ $section->button_text }}
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- =========================================================
            SERVICES SECTION
            ========================================================== --}}
        @elseif($section->section_type === 'services')

            <section class="website-section">
                <div class="container">
                    <div class="section-heading">
                        @if($section->sub_title)
                            <div class="section-subtitle">{{ $section->sub_title }}</div>
                        @endif
                        @if($section->title)
                            <h2 class="section-title">{{ $section->title }}</h2>
                        @endif
                        @if($section->content)
                            <div class="section-content">{!! $section->content !!}</div>
                        @endif
                    </div>
                    <div class="row g-4">
                        @php
                            $services = json_decode($section->services, true) ?? [];
                        @endphp
                        @foreach($services as $service)
                            <div class="col-lg-4 col-md-6">
                                <div class="service-card">
                                    <div class="service-icon">
                                        <i class="{{ $service['icon'] ?? 'bi bi-star' }}"></i>
                                    </div>
                                    <h4>{{ $service['title'] ?? '' }}</h4>
                                    <p>{{ $service['description'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- =========================================================
            FEATURES SECTION
            ========================================================== --}}
        @elseif($section->section_type === 'features')

            <section class="website-section bg-light">
                <div class="container">
                    <div class="section-heading">
                        @if($section->sub_title)
                            <div class="section-subtitle">{{ $section->sub_title }}</div>
                        @endif
                        @if($section->title)
                            <h2 class="section-title">{{ $section->title }}</h2>
                        @endif
                        @if($section->content)
                            <div class="section-content">{!! $section->content !!}</div>
                        @endif
                    </div>
                    <div class="row g-4">
                        @php
                            $features = json_decode($section->features, true) ?? [];
                        @endphp
                        @foreach($features as $feature)
                            <div class="col-lg-3 col-md-6">
                                <div class="feature-card text-center">
                                    <div class="feature-icon">
                                        <i class="{{ $feature['icon'] ?? 'bi bi-check-circle' }}"></i>
                                    </div>
                                    <h5>{{ $feature['title'] ?? '' }}</h5>
                                    <p>{{ $feature['description'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- =========================================================
            TESTIMONIALS SECTION
            ========================================================== --}}
        @elseif($section->section_type === 'testimonials')

            <section class="website-section testimonials-section">
                <div class="container">
                    <div class="section-heading">
                        @if($section->sub_title)
                            <div class="section-subtitle">{{ $section->sub_title }}</div>
                        @endif
                        @if($section->title)
                            <h2 class="section-title">{{ $section->title }}</h2>
                        @endif
                        @if($section->content)
                            <div class="section-content">{!! $section->content !!}</div>
                        @endif
                    </div>
                    @php
                        $testimonials = $section->testimonials ? json_decode($section->testimonials, true) : [];
                    @endphp
                    @if(!empty($testimonials) && count($testimonials) > 0)
                        <div class="row g-4">
                            @foreach($testimonials as $testimonial)
                                <div class="col-lg-4 col-md-6">
                                    <div class="testimonial-card">
                                        <div class="testimonial-content">
                                            <i class="bi bi-quote quote-icon"></i>
                                            <p>{{ $testimonial['content'] ?? '' }}</p>
                                        </div>
                                        <div class="testimonial-author">
                                            @if(!empty($testimonial['image']))
                                                <img src="{{ asset('storage/' . $testimonial['image']) }}"
                                                    alt="{{ $testimonial['name'] ?? 'Customer' }}" class="testimonial-avatar">
                                            @else
                                                <div class="testimonial-avatar-placeholder">
                                                    {{ strtoupper(substr($testimonial['name'] ?? 'C', 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="testimonial-info">
                                                <h5>{{ $testimonial['name'] ?? 'Anonymous' }}</h5>
                                                <span>{{ $testimonial['designation'] ?? '' }}</span>
                                                @if(!empty($testimonial['rating']))
                                                    <div class="testimonial-rating">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="bi bi-star{{ $i <= $testimonial['rating'] ? '-fill' : '' }}"></i>
                                                        @endfor
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">No testimonials available.</p>
                        </div>
                    @endif
                    @if($section->button_text && $section->button_url)
                        <div class="text-center mt-4">
                            <a href="{{ url($section->button_url) }}" class="btn-main">
                                {{ $section->button_text }}
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            {{-- =========================================================
            CTA SECTION
            ========================================================== --}}
        @elseif($section->section_type === 'cta')

            <section class="cta-section">
                <div class="container">
                    <div class="cta-box text-center">
                        @if($section->sub_title)
                            <div class="cta-subtitle">{{ $section->sub_title }}</div>
                        @endif
                        @if($section->title)
                            <h2 class="cta-title">{{ $section->title }}</h2>
                        @endif
                        @if($section->content)
                            <div class="cta-content">{!! $section->content !!}</div>
                        @endif
                        @if($section->button_text && $section->button_url)
                            <a href="{{ url($section->button_url) }}" class="btn-main btn-main-light">
                                {{ $section->button_text }}
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </section>

            {{-- =========================================================
            PRODUCTS SECTION WITH SIDEBAR FILTER
            ========================================================== --}}
        @elseif($section->section_type === 'products')

            <section class="website-section products-section">
                <div class="container">
                    <div class="section-heading">
                        @if($section->sub_title)
                            <div class="section-subtitle">{{ $section->sub_title }}</div>
                        @endif
                        @if($section->title)
                            <h2 class="section-title">{{ $section->title }}</h2>
                        @endif
                        @if($section->content)
                            <div class="section-content">{!! $section->content !!}</div>
                        @endif
                    </div>

                    @if($section->products && $section->products->count())
                        @php
                            $categories = $section->products->pluck('category')->filter()->unique('id');
                            $minPrice = $section->products->min('price') ?? 0;
                            $maxPrice = $section->products->max('price') ?? 1000;
                            $brands = $section->products->pluck('brand')->filter()->unique('id');
                            $inStockCount = $section->products->where('stock', '>', 0)->count();
                            $outOfStockCount = $section->products->where('stock', '<=', 0)->count();
                        @endphp

                        {{-- MOBILE FILTER TOGGLE --}}
                        <div class="mobile-filter-toggle">
                            <button class="filter-toggle-btn" id="openFilterSidebar">
                                <i class="bi bi-funnel"></i> Filters
                            </button>
                            <span class="filter-result-count" id="filterResultCount"></span>
                        </div>

                        {{-- FILTER SIDEBAR OVERLAY --}}
                        <div class="filter-overlay" id="filterOverlay"></div>

                        {{-- FILTER SIDEBAR --}}
                        <div class="filter-sidebar" id="filterSidebar">
                            <div class="filter-sidebar-header">
                                <h5><i class="bi bi-funnel"></i> Filters</h5>
                                <button class="close-filter-btn" id="closeFilterSidebar">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>

                            <div class="filter-sidebar-body">
                                {{-- Category --}}
                                <div class="filter-section">
                                    <h6 class="filter-section-title">Category</h6>
                                    <div class="filter-options">
                                        <label class="filter-option">
                                            <input type="radio" name="category" value="all" checked>
                                            <span>All Categories</span>
                                        </label>
                                        @foreach($categories as $category)
                                            <label class="filter-option">
                                                <input type="radio" name="category" value="{{ $category->id }}">
                                                <span>{{ $category->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Price Range --}}
                                <div class="filter-section">
                                    <h6 class="filter-section-title">Price Range</h6>
                                    <div class="price-range-wrapper">
                                        <div class="price-inputs">
                                            <div class="price-input">
                                                <label>Min</label>
                                                <input type="number" id="priceMinSidebar" value="{{ $minPrice }}" min="{{ $minPrice }}"
                                                    max="{{ $maxPrice }}">
                                            </div>
                                            <div class="price-input">
                                                <label>Max</label>
                                                <input type="number" id="priceMaxSidebar" value="{{ $maxPrice }}" min="{{ $minPrice }}"
                                                    max="{{ $maxPrice }}">
                                            </div>
                                        </div>
                                        <div class="price-slider-wrapper">
                                            <input type="range" id="priceSliderMinSidebar" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                                value="{{ $minPrice }}">
                                            <input type="range" id="priceSliderMaxSidebar" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                                value="{{ $maxPrice }}">
                                        </div>
                                        <div class="price-range-values">
                                            <span>₹<span id="rangeMinDisplaySidebar">{{ $minPrice }}</span></span>
                                            <span>₹<span id="rangeMaxDisplaySidebar">{{ $maxPrice }}</span></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Brand --}}
                                @if($brands->count() > 0)
                                    <div class="filter-section">
                                        <h6 class="filter-section-title">Brand</h6>
                                        <div class="filter-options">
                                            @foreach($brands as $brand)
                                                <label class="filter-option">
                                                    <input type="checkbox" name="brand" value="{{ $brand->id }}">
                                                    <span>{{ $brand->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                {{-- Stock Status --}}
                                <div class="filter-section">
                                    <h6 class="filter-section-title">Stock Status</h6>
                                    <div class="filter-options">
                                        <label class="filter-option">
                                            <input type="checkbox" name="stock" value="in" checked>
                                            <span>In Stock ({{ $inStockCount }})</span>
                                        </label>
                                        <label class="filter-option">
                                            <input type="checkbox" name="stock" value="out">
                                            <span>Out of Stock ({{ $outOfStockCount }})</span>
                                        </label>
                                    </div>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="filter-sidebar-actions">
                                    <button class="filter-clear-btn-sidebar" id="clearFiltersSidebar">
                                        <i class="bi bi-x-circle"></i> Clear All
                                    </button>
                                    <button class="filter-apply-btn-sidebar" id="applyFiltersSidebar">
                                        <i class="bi bi-check-circle"></i> Apply Filters
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- DESKTOP FILTER BAR --}}
                        <div class="filter-bar desktop-filter">
                            <div class="filter-row">
                                <div class="filter-group">
                                    <button class="filter-toggle active" data-filter="category">
                                        <i class="bi bi-folder"></i> Category
                                    </button>
                                    <div class="filter-dropdown">
                                        <label class="filter-option">
                                            <input type="radio" name="category" value="all" checked>
                                            <span>All</span>
                                        </label>
                                        @foreach($categories as $category)
                                            <label class="filter-option">
                                                <input type="radio" name="category" value="{{ $category->id }}">
                                                <span>{{ $category->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="filter-group">
                                    <button class="filter-toggle" data-filter="price">
                                        <i class="bi bi-currency-rupee"></i> Price
                                    </button>
                                    <div class="filter-dropdown price-dropdown">
                                        <div class="price-range-wrapper">
                                            <div class="price-inputs">
                                                <div class="price-input">
                                                    <label>Min</label>
                                                    <input type="number" id="priceMin" value="{{ $minPrice }}" min="{{ $minPrice }}"
                                                        max="{{ $maxPrice }}">
                                                </div>
                                                <div class="price-input">
                                                    <label>Max</label>
                                                    <input type="number" id="priceMax" value="{{ $maxPrice }}" min="{{ $minPrice }}"
                                                        max="{{ $maxPrice }}">
                                                </div>
                                            </div>
                                            <div class="price-slider-wrapper">
                                                <input type="range" id="priceSliderMin" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                                    value="{{ $minPrice }}">
                                                <input type="range" id="priceSliderMax" min="{{ $minPrice }}" max="{{ $maxPrice }}"
                                                    value="{{ $maxPrice }}">
                                            </div>
                                            <div class="price-range-values">
                                                <span>₹<span id="rangeMinDisplay">{{ $minPrice }}</span></span>
                                                <span>₹<span id="rangeMaxDisplay">{{ $maxPrice }}</span></span>
                                            </div>
                                            <button class="price-apply-btn" id="applyPriceFilter">Apply</button>
                                        </div>
                                    </div>
                                </div>

                                @if($brands->count() > 0)
                                    <div class="filter-group">
                                        <button class="filter-toggle" data-filter="brand">
                                            <i class="bi bi-building"></i> Brand
                                        </button>
                                        <div class="filter-dropdown">
                                            @foreach($brands as $brand)
                                                <label class="filter-option">
                                                    <input type="checkbox" name="brand" value="{{ $brand->id }}">
                                                    <span>{{ $brand->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="filter-group">
                                    <button class="filter-toggle" data-filter="stock">
                                        <i class="bi bi-box"></i> Stock
                                    </button>
                                    <div class="filter-dropdown">
                                        <label class="filter-option">
                                            <input type="checkbox" name="stock" value="in" checked>
                                            <span>In Stock ({{ $inStockCount }})</span>
                                        </label>
                                        <label class="filter-option">
                                            <input type="checkbox" name="stock" value="out">
                                            <span>Out of Stock ({{ $outOfStockCount }})</span>
                                        </label>
                                    </div>
                                </div>

                                <button class="filter-clear-btn" id="clearFilters">
                                    <i class="bi bi-x-circle"></i> Clear
                                </button>
                            </div>
                        </div>

                        {{-- PRODUCTS GRID --}}
                        <div class="row g-2 g-sm-3 products-grid">
                            @foreach($section->products as $product)
                                @php
                                    $isFutured = isset($product->is_futured) && $product->is_futured == 1;
                                @endphp

                                <div class="col-6 col-sm-6 col-md-4 col-lg-3 product-item" data-category="{{ $product->category_id ?? '' }}"
                                    data-brand="{{ $product->brand_id ?? '' }}" data-price="{{ $product->price ?? 0 }}"
                                    data-stock="{{ $product->stock > 0 ? 'in' : 'out' }}">

                                    <div class="product-card h-100">
                                        <div class="product-image-wrapper">
                                            @php
                                                $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                                $hasMultipleImages = count($images) > 1;
                                            @endphp

                                            @if(!empty($images) && isset($images[0]) && !empty($images[0]))
                                                <div class="product-slider-container">
                                                    @foreach($images as $index => $img)
                                                        @php
                                                            $img = preg_replace('#^storage/#', '', $img);
                                                            $imgUrl = asset($img);
                                                        @endphp
                                                        <div class="product-slide {{ $index === 0 ? 'active' : '' }}">
                                                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="product-image" loading="lazy"
                                                                onerror="this.src='{{ asset('images/placeholder.png') }}';">
                                                        </div>
                                                    @endforeach
                                                    @if($hasMultipleImages)
                                                        <div class="slider-dots">
                                                            @foreach($images as $index => $img)
                                                                <span class="dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></span>
                                                            @endforeach
                                                        </div>
                                                        <button class="slider-arrow prev" type="button">‹</button>
                                                        <button class="slider-arrow next" type="button">›</button>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="product-image-placeholder">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            @endif

                                            @if(isset($product->is_futured))
                                                @if($product->is_futured == 1)
                                                    <span class="product-badge futured-badge">
                                                        <i class="bi bi-star-fill"></i> Futured
                                                    </span>
                                                @elseif($product->is_futured == 2)
                                                    <span class="product-badge new-badge">
                                                        <i class="bi bi-fire"></i> New
                                                    </span>
                                                @endif
                                            @endif

                                            @if($product->stock !== null)
                                                <span class="stock-badge {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                                </span>
                                            @endif

                                            @if($product->category)
                                                <span class="category-badge">{{ $product->category->name }}</span>
                                            @endif
                                        </div>

                                        <div class="product-body">
                                            @if($product->brand)
                                                <div class="product-brand">
                                                    <i class="bi bi-building"></i> {{ $product->brand->name }}
                                                </div>
                                            @endif

                                            @if($product->name)
                                                <h5 class="product-title">{{ $product->name }}</h5>
                                            @endif

                                            @if($product->price !== null)
                                                <div class="product-price">
                                                    ₹{{ number_format($product->price, 2) }}
                                                </div>
                                            @endif

                                            @if($product->sku)
                                                <div class="product-sku">
                                                    <i class="bi bi-upc"></i> {{ $product->sku }}
                                                </div>
                                            @endif

                                            @if($product->subCategory)
                                                <div class="product-subcategory">
                                                    <i class="bi bi-folder-open"></i> {{ $product->subCategory->name }}
                                                </div>
                                            @endif

                                            {{-- In your products section, replace the product action section --}}
                                            <div class="product-action">
                                                @if($isFutured)
                                                    <button type="button" class="rec-add-cart btn-futured notify-me-btn"
                                                        data-product-id="{{ $product->id }}">
                                                        <i class="bi bi-bell"></i> Notify Me
                                                    </button>
                                                @elseif($product->stock !== null && $product->stock <= 0)
                                                    <button type="button" class="btn-add-cart" disabled>
                                                        <i class="bi bi-x-circle"></i> Out of Stock
                                                    </button>
                                                @else
                                                    @auth
                                                        {{-- User is logged in - show add to cart button --}}
                                                        <button type="button" class="btn-add-cart add-to-cart-btn"
                                                            data-product-id="{{ $product->id }}" onclick="addToCart({{ $product->id }})">
                                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                                        </button>
                                                    @else
                                                        {{-- User is not logged in - show login required button --}}
                                                        <button type="button" class="btn-add-cart login-required-btn" onclick="redirectToLogin()"
                                                            data-product-id="{{ $product->id }}">
                                                            <i class="bi bi-box-arrow-in-right"></i> Login to Add
                                                        </button>
                                                    @endauth
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="no-results-message" id="noResults" style="display: none;">
                            <i class="bi bi-search"></i>
                            <h5>No products found</h5>
                            <p>Try adjusting your filters</p>
                        </div>

                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-box-seam display-4 text-muted"></i>
                            <h5 class="mt-3">No Products Available</h5>
                            <p class="text-muted mb-0">Products will appear here once they are added.</p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- =========================================================
            FAQ SECTION WITH IMAGE
            ========================================================== --}}
        @elseif($section->section_type === 'faq')

            <section class="website-section faq-section">
                <div class="container">
                    <div class="section-heading">
                        @if($section->sub_title)
                            <div class="section-subtitle">{{ $section->sub_title }}</div>
                        @endif
                        @if($section->title)
                            <h2 class="section-title">{{ $section->title }}</h2>
                        @endif
                        @if($section->content)
                            <div class="section-content">{!! $section->content !!}</div>
                        @endif
                    </div>

                    @php
                        $faqs = $section->faqs ? json_decode($section->faqs, true) : [];
                    @endphp

                    @if(!empty($faqs) && count($faqs) > 0)
                        <div class="row align-items-stretch g-4">
                            @if($section->image)
                                <div class="col-lg-5">
                                    <div class="faq-image-wrapper">
                                        <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title ?? 'FAQ' }}"
                                            class="faq-image">
                                        <div class="faq-image-overlay">
                                            <div class="overlay-content">
                                                <i class="bi bi-question-circle"></i>
                                                <h4>Frequently Asked Questions</h4>
                                                <p>Find answers to common questions about our products and services.</p>
                                                <div class="overlay-stats">
                                                    <div class="stat-item">
                                                        <i class="bi bi-check-circle"></i>
                                                        <span>Quick Answers</span>
                                                    </div>
                                                    <div class="stat-item">
                                                        <i class="bi bi-search"></i>
                                                        <span>Easy to Find</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="faq-wrapper">
                                        <div class="faq-container">
                                            @foreach($faqs as $index => $faq)
                                                <div class="faq-item {{ $index === 0 ? 'active' : '' }}">
                                                    <div class="faq-question" onclick="toggleFaq(this)">
                                                        <span>{{ $faq['question'] ?? '' }}</span>
                                                        <i class="bi bi-chevron-down faq-icon"></i>
                                                    </div>
                                                    <div class="faq-answer {{ $index === 0 ? 'open' : '' }}">
                                                        <p>{{ $faq['answer'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-12">
                                    <div class="faq-wrapper-full">
                                        <div class="faq-container">
                                            @foreach($faqs as $index => $faq)
                                                <div class="faq-item {{ $index === 0 ? 'active' : '' }}">
                                                    <div class="faq-question" onclick="toggleFaq(this)">
                                                        <span>{{ $faq['question'] ?? '' }}</span>
                                                        <i class="bi bi-chevron-down faq-icon"></i>
                                                    </div>
                                                    <div class="faq-answer {{ $index === 0 ? 'open' : '' }}">
                                                        <p>{{ $faq['answer'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">No FAQ items available.</p>
                        </div>
                    @endif

                    @if($section->button_text && $section->button_url)
                        <div class="text-center mt-4">
                            <a href="{{ url($section->button_url) }}" class="btn-main">
                                {{ $section->button_text }}
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            {{-- =========================================================
            CONTACT FORM SECTION WITH IMAGE
            ========================================================== --}}
        @elseif($section->section_type === 'contact')

            <section class="website-section contact-section">
                <div class="container">
                    <div class="section-heading">
                        @if($section->sub_title)
                            <div class="section-subtitle">{{ $section->sub_title }}</div>
                        @endif
                        @if($section->title)
                            <h2 class="section-title">{{ $section->title }}</h2>
                        @endif
                        @if($section->content)
                            <div class="section-content">{!! $section->content !!}</div>
                        @endif
                    </div>

                    @php
                        $formFields = is_array($section->form_fields) ? $section->form_fields : json_decode($section->form_fields ?? '[]', true);
                        $formAction = $section->form_action ?? '#';
                        $formMethod = $section->form_method ?? 'POST';
                    @endphp

                    <div class="row align-items-stretch g-4">
                        @if($section->image)
                            <div class="col-lg-5">
                                <div class="contact-image-wrapper">
                                    <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title ?? 'Contact Us' }}"
                                        class="contact-image">
                                    <div class="contact-image-overlay">
                                        <div class="overlay-content">
                                            <i class="bi bi-chat-dots"></i>
                                            <h4>We're Here to Help</h4>
                                            <p>Reach out to us. Our team is ready to assist you.</p>
                                            <div class="overlay-stats">
                                                <div class="stat-item">
                                                    <i class="bi bi-clock"></i>
                                                    <span>24/7 Support</span>
                                                </div>
                                                <div class="stat-item">
                                                    <i class="bi bi-envelope"></i>
                                                    <span>Quick Response</span>
                                                </div>
                                                <div class="stat-item">
                                                    <i class="bi bi-people"></i>
                                                    <span>Expert Team</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="contact-form-wrapper">
                        @else
                                    <div class="col-lg-12">
                                        <div class="contact-form-wrapper" style="max-width:800px;margin:0 auto;">
                                @endif

                                        @if(session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="bi bi-check-circle-fill"></i>
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="bi bi-exclamation-triangle-fill"></i>
                                                <ul class="mb-0 mt-1">
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if(!empty($formFields) && count($formFields) > 0)
                                            <form
                                                action="{{ route('frontend.contact.submit', ['page' => $page->id, 'section' => $section->id]) }}"
                                                method="{{ strtolower($formMethod) }}" enctype="multipart/form-data"
                                                class="contact-form">
                                                @csrf
                                                <div class="row g-3">
                                                    @foreach($formFields as $field)
                                                        @php
                                                            $name = $field['name'] ?? '';
                                                            $label = $field['label'] ?? '';
                                                            $type = $field['type'] ?? 'text';
                                                            $placeholder = $field['placeholder'] ?? '';
                                                            $required = !empty($field['required']);
                                                            $options = $field['options'] ?? [];
                                                            if (is_string($options)) {
                                                                $options = array_map('trim', explode(',', $options));
                                                            }
                                                            $colClass = in_array($type, ['textarea', 'file']) ? 'col-md-12' : 'col-md-6';
                                                        @endphp
                                                        @if(!$name) @continue @endif
                                                        <div class="{{ $colClass }}">
                                                            <div class="form-group">
                                                                <label for="{{ $name }}" class="form-label">
                                                                    {{ $label }}
                                                                    @if($required) <span class="text-danger">*</span> @endif
                                                                </label>
                                                                @if($type === 'textarea')
                                                                    <textarea name="{{ $name }}" id="{{ $name }}" class="form-control"
                                                                        placeholder="{{ $placeholder }}" rows="4" {{ $required ? 'required' : '' }}>{{ old($name) }}</textarea>
                                                                @elseif($type === 'select')
                                                                    <select name="{{ $name }}" id="{{ $name }}" class="form-control" {{ $required ? 'required' : '' }}>
                                                                        <option value="">Select {{ $label }}</option>
                                                                        @foreach($options as $option)
                                                                            <option value="{{ $option }}" {{ old($name) == $option ? 'selected' : '' }}>{{ $option }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @elseif($type === 'radio')
                                                                    <div class="radio-group">
                                                                        @foreach($options as $option)
                                                                            <div class="form-check">
                                                                                <input type="radio" class="form-check-input" name="{{ $name }}"
                                                                                    id="{{ $name }}_{{ Str::slug($option) }}" value="{{ $option }}"
                                                                                    {{ old($name) == $option ? 'checked' : '' }} {{ $required ? 'required' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="{{ $name }}_{{ Str::slug($option) }}">{{ $option }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @elseif($type === 'checkbox')
                                                                    <div class="checkbox-group">
                                                                        @foreach($options as $option)
                                                                            <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" name="{{ $name }}[]"
                                                                                    id="{{ $name }}_{{ Str::slug($option) }}" value="{{ $option }}"
                                                                                    {{ in_array($option, old($name, [])) ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="{{ $name }}_{{ Str::slug($option) }}">{{ $option }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                @elseif($type === 'file')
                                                                    <input type="file" name="{{ $name }}" id="{{ $name }}" class="form-control"
                                                                        {{ $required ? 'required' : '' }}>
                                                                @else
                                                                    <input type="{{ $type === 'phone' ? 'tel' : $type }}" name="{{ $name }}"
                                                                        id="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}"
                                                                        value="{{ old($name) }}" {{ $required ? 'required' : '' }}>
                                                                @endif
                                                                @error($name)
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn-main">
                                                            <i class="bi bi-send"></i>
                                                            {{ $section->button_text ?? 'Send Message' }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="text-center py-4">
                                                <i class="bi bi-info-circle display-6 text-muted"></i>
                                                <p class="text-muted mt-2">No form fields configured. Please contact the administrator.
                                                </p>
                                            </div>
                                        @endif

                                        @if($section->image)
                                                </div>
                                            </div>
                                        @else
                                        </div>
                                    </div>
                                @endif
                    </div>

                    @if($section->button_text && $section->button_url)
                        <div class="text-center mt-4">
                            <a href="{{ url($section->button_url) }}" class="btn-main">
                                {{ $section->button_text }}
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            {{-- =========================================================
            PRIVACY & POLICY SECTION WITH FULL-WIDTH IMAGE
            ========================================================== --}}
        @elseif($section->section_type === 'privacy_policy')

            {{-- Full Width Image Section --}}
            <section class="policy-image-section"
                style="background-image: url('{{ $section->image ? asset('storage/' . $section->image) : '' }}');">
                <div class="policy-image-overlay-full"></div>
                <div class="policy-image-content">
                    <div class="container">
                        <div class="policy-image-text">
                            @if($section->sub_title)
                                <span class="policy-image-subtitle">{{ $section->sub_title }}</span>
                            @endif
                            @if($section->title)
                                <h1 class="policy-image-title">{{ $section->title }}</h1>
                            @endif
                            @if($section->content)
                                <p class="policy-image-description">{!! $section->content !!}</p>
                            @endif
                            <div class="policy-image-stats">
                                <div class="stat-item">
                                    <i class="bi bi-lock"></i>
                                    <span>Secure</span>
                                </div>
                                <div class="stat-item">
                                    <i class="bi bi-shield"></i>
                                    <span>Protected</span>
                                </div>
                                <div class="stat-item">
                                    <i class="bi bi-check-circle"></i>
                                    <span>Trusted</span>
                                </div>
                            </div>
                            @if($section->button_text && $section->button_url)
                                <a href="{{ url($section->button_url) }}" class="btn-main">
                                    {{ $section->button_text }}
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            {{-- Content Section Below --}}
            <section class="policy-content-section">
                <div class="container">
                    <div class="policy-content-wrapper">
                        @php
                            $policySections = $section->policy_sections ? json_decode($section->policy_sections, true) : [];
                        @endphp

                        @if($section->privacy_content)
                            <div class="policy-block">
                                <h3><i class="bi bi-shield-lock"></i> Privacy Policy</h3>
                                <div class="policy-text">{!! nl2br(e($section->privacy_content)) !!}</div>
                            </div>
                        @endif

                        @if($section->terms_content)
                            <div class="policy-block">
                                <h3><i class="bi bi-file-text"></i> Terms & Conditions</h3>
                                <div class="policy-text">{!! nl2br(e($section->terms_content)) !!}</div>
                            </div>
                        @endif

                        @if($section->policy_content)
                            <div class="policy-block">
                                <h3><i class="bi bi-book"></i> Policy</h3>
                                <div class="policy-text">{!! nl2br(e($section->policy_content)) !!}</div>
                            </div>
                        @endif

                        @if(!empty($policySections))
                            <div class="policy-sections">
                                <h3 class="policy-sections-title"><i class="bi bi-list-ul"></i> Policy Sections</h3>
                                @foreach($policySections as $index => $sectionItem)
                                    <div class="policy-section-item">
                                        <h4>{{ $sectionItem['title'] ?? '' }}</h4>
                                        <p>{{ $sectionItem['content'] ?? '' }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            {{-- =========================================================
            FOOTER SECTION - REMOVED (Now in layouts/app.blade.php)
            ========================================================== --}}

        @endif
        {{-- =========================================================
        DISCLAIMER SECTION
        ========================================================== --}}
        @if($section->section_type === 'disclaimer')

            <section class="website-section disclaimer-section"
                style="background-image: url('{{ $section->image ? asset('storage/' . $section->image) : '' }}');">
                <div class="disclaimer-overlay"></div>
                <div class="container">
                    <div class="row align-items-center">
                        @if($section->image)
                            <div class="col-lg-5">
                                <div class="disclaimer-image-wrapper">
                                    <img src="{{ asset('storage/' . $section->image) }}"
                                        alt="{{ $section->disclaimer_title ?? 'Disclaimer' }}" class="disclaimer-image">
                                </div>
                            </div>
                        @endif
                        <div class="{{ $section->image ? 'col-lg-7' : 'col-lg-12' }}">
                            <div class="disclaimer-content">
                                @if($section->disclaimer_title)
                                    <h2 class="disclaimer-title">{{ $section->disclaimer_title }}</h2>
                                @endif
                                @if($section->disclaimer_description)
                                    <div class="disclaimer-description">
                                        {!! $section->disclaimer_description !!}
                                    </div>
                                @endif
                                @if($section->button_text && $section->button_url)
                                    <div class="mt-4">
                                        <a href="{{ url($section->button_url) }}" class="btn-main">
                                            {{ $section->button_text }}
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        @endif

    @endforeach

@endsection

@push('scripts')
    <script>
        // =============================================
        // FAQ ACCORDION
        // =============================================
        function toggleFaq(element) {
            const currentItem = element.closest('.faq-item');
            const isActive = currentItem.classList.contains('active');

            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
                item.querySelector('.faq-answer').classList.remove('open');
            });

            if (!isActive) {
                currentItem.classList.add('active');
                currentItem.querySelector('.faq-answer').classList.add('open');
            }
        }

        // =============================================
        // HERO SLIDER
        // =============================================
        function initHeroSlider() {
            const container = document.querySelector('.hero-slider-container');
            if (!container) return;

            const slides = container.querySelectorAll('.hero-slide');
            const dots = container.querySelectorAll('.hero-dot');
            const prevBtn = container.querySelector('.hero-slider-arrow.prev');
            const nextBtn = container.querySelector('.hero-slider-arrow.next');

            if (slides.length <= 1) return;

            let currentSlide = 0;
            let autoplayInterval = null;

            function goToSlide(index) {
                slides.forEach(s => s.classList.remove('active'));
                dots.forEach(d => d.classList.remove('active'));
                slides[index].classList.add('active');
                dots[index].classList.add('active');
                currentSlide = index;
            }

            function nextSlide() {
                goToSlide((currentSlide + 1) % slides.length);
            }

            function prevSlide() {
                goToSlide((currentSlide - 1 + slides.length) % slides.length);
            }

            function startAutoplay() {
                if (autoplayInterval) clearInterval(autoplayInterval);
                autoplayInterval = setInterval(nextSlide, 5000);
            }

            function stopAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', function () {
                    stopAutoplay();
                    goToSlide(index);
                    startAutoplay();
                });
            });

            if (nextBtn) {
                nextBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    stopAutoplay();
                    nextSlide();
                    startAutoplay();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    stopAutoplay();
                    prevSlide();
                    startAutoplay();
                });
            }

            container.addEventListener('mouseenter', stopAutoplay);
            container.addEventListener('mouseleave', startAutoplay);

            let touchStartX = 0;
            container.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            container.addEventListener('touchend', function (e) {
                const diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) {
                    stopAutoplay();
                    if (diff > 0) nextSlide();
                    else prevSlide();
                    startAutoplay();
                }
            }, { passive: true });

            startAutoplay();
        }

        // =============================================
        // PRODUCT SLIDER
        // =============================================
        document.querySelectorAll('.product-slider-container').forEach(function (c) {
            const s = c.querySelectorAll('.product-slide'), d = c.querySelectorAll('.dot'), p = c.querySelector('.prev'), n = c.querySelector('.next');
            if (s.length <= 1) return;
            let i = 0, t = null;

            function go(index) {
                s.forEach(slide => slide.classList.remove('active'));
                d.forEach(dot => dot.classList.remove('active'));
                s[index].classList.add('active');
                d[index].classList.add('active');
                i = index;
            }

            function next() { go((i + 1) % s.length); }
            function start() { if (t) clearInterval(t); t = setInterval(next, 4000); }
            function stop() { if (t) { clearInterval(t); t = null; } }

            d.forEach((dot, index) => {
                dot.addEventListener('click', function (e) {
                    e.stopPropagation();
                    stop();
                    go(index);
                    start();
                });
            });

            if (n) {
                n.addEventListener('click', function (e) {
                    e.stopPropagation();
                    stop();
                    next();
                    start();
                });
            }

            if (p) {
                p.addEventListener('click', function (e) {
                    e.stopPropagation();
                    stop();
                    go((i - 1 + s.length) % s.length);
                    start();
                });
            }

            if (window.matchMedia('(hover:hover)').matches) {
                c.addEventListener('mouseenter', stop);
                c.addEventListener('mouseleave', start);
            }
            start();
        });

        // =============================================
        // FILTER SIDEBAR
        // =============================================
        const sidebar = document.getElementById('filterSidebar');
        const overlay = document.getElementById('filterOverlay');
        const openBtn = document.getElementById('openFilterSidebar');
        const closeBtn = document.getElementById('closeFilterSidebar');

        function openSidebar() {
            if (window.innerWidth > 768) return;
            sidebar.classList.add('open');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (openBtn) openBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeSidebar();
        });

        // =============================================
        // FILTER DROPDOWNS (Desktop)
        // =============================================
        document.querySelectorAll('.desktop-filter .filter-toggle').forEach(function (t) {
            t.addEventListener('click', function (e) {
                e.stopPropagation();
                const d = this.parentElement.querySelector('.filter-dropdown');
                const isActive = d.classList.contains('show');

                document.querySelectorAll('.desktop-filter .filter-dropdown').forEach(dd => dd.classList.remove('show'));
                document.querySelectorAll('.desktop-filter .filter-toggle').forEach(tt => tt.classList.remove('active'));

                if (!isActive) {
                    d.classList.add('show');
                    this.classList.add('active');
                }
            });
        });

        document.addEventListener('click', function () {
            document.querySelectorAll('.desktop-filter .filter-dropdown').forEach(d => d.classList.remove('show'));
            document.querySelectorAll('.desktop-filter .filter-toggle').forEach(t => t.classList.remove('active'));
        });

        document.querySelectorAll('.desktop-filter .filter-dropdown').forEach(function (d) {
            d.addEventListener('click', function (e) { e.stopPropagation(); });
        });

        // =============================================
        // PRICE SLIDER (Desktop)
        // =============================================
        const dpMin = document.getElementById('priceMin'), dpMax = document.getElementById('priceMax');
        const dsMin = document.getElementById('priceSliderMin'), dsMax = document.getElementById('priceSliderMax');
        const drMin = document.getElementById('rangeMinDisplay'), drMax = document.getElementById('rangeMaxDisplay');

        if (dpMin && dpMax && dsMin && dsMax) {
            function updateDesktopPrice() {
                let min = parseInt(dsMin.value), max = parseInt(dsMax.value);
                if (min > max) { dsMin.value = max; min = max; }
                if (max < min) { dsMax.value = min; max = min; }
                dpMin.value = min; dpMax.value = max;
                drMin.textContent = min; drMax.textContent = max;
            }

            dsMin.addEventListener('input', updateDesktopPrice);
            dsMax.addEventListener('input', updateDesktopPrice);

            dpMin.addEventListener('change', function () {
                let val = parseInt(this.value) || 0;
                let max = parseInt(dpMax.value) || 0;
                if (val > max) val = max;
                if (val < parseInt(dsMin.min)) val = parseInt(dsMin.min);
                dsMin.value = val;
                updateDesktopPrice();
            });

            dpMax.addEventListener('change', function () {
                let val = parseInt(this.value) || 0;
                let min = parseInt(dpMin.value) || 0;
                if (val < min) val = min;
                if (val > parseInt(dsMax.max)) val = parseInt(dsMax.max);
                dsMax.value = val;
                updateDesktopPrice();
            });
        }

        document.getElementById('applyPriceFilter')?.addEventListener('click', function () {
            filterProducts();
            const d = this.closest('.filter-dropdown');
            if (d) d.classList.remove('show');
            const t = d?.parentElement?.querySelector('.filter-toggle');
            if (t) t.classList.remove('active');
        });

        // =============================================
        // PRICE SLIDER (Sidebar)
        // =============================================
        const spMin = document.getElementById('priceMinSidebar'), spMax = document.getElementById('priceMaxSidebar');
        const ssMin = document.getElementById('priceSliderMinSidebar'), ssMax = document.getElementById('priceSliderMaxSidebar');
        const srMin = document.getElementById('rangeMinDisplaySidebar'), srMax = document.getElementById('rangeMaxDisplaySidebar');

        if (spMin && spMax && ssMin && ssMax) {
            function updateSidebarPrice() {
                let min = parseInt(ssMin.value), max = parseInt(ssMax.value);
                if (min > max) { ssMin.value = max; min = max; }
                if (max < min) { ssMax.value = min; max = min; }
                spMin.value = min; spMax.value = max;
                srMin.textContent = min; srMax.textContent = max;
            }

            ssMin.addEventListener('input', updateSidebarPrice);
            ssMax.addEventListener('input', updateSidebarPrice);

            spMin.addEventListener('change', function () {
                let val = parseInt(this.value) || 0;
                let max = parseInt(spMax.value) || 0;
                if (val > max) val = max;
                if (val < parseInt(ssMin.min)) val = parseInt(ssMin.min);
                ssMin.value = val;
                updateSidebarPrice();
            });

            spMax.addEventListener('change', function () {
                let val = parseInt(this.value) || 0;
                let min = parseInt(spMin.value) || 0;
                if (val < min) val = min;
                if (val > parseInt(ssMax.max)) val = parseInt(ssMax.max);
                ssMax.value = val;
                updateSidebarPrice();
            });
        }

        // =============================================
        // FILTER PRODUCTS
        // =============================================
        function filterProducts() {
            const products = document.querySelectorAll('.product-item');
            let count = 0;

            const category = document.querySelector('input[name="category"]:checked');
            const selectedCategory = category ? category.value : 'all';

            // Get price from either desktop or sidebar
            const minPrice = parseInt(document.getElementById('priceMin')?.value) ||
                parseInt(document.getElementById('priceMinSidebar')?.value) || 0;
            const maxPrice = parseInt(document.getElementById('priceMax')?.value) ||
                parseInt(document.getElementById('priceMaxSidebar')?.value) || 999999;

            const brands = Array.from(document.querySelectorAll('input[name="brand"]:checked')).map(c => c.value);
            const stocks = Array.from(document.querySelectorAll('input[name="stock"]:checked')).map(c => c.value);

            products.forEach(function (p) {
                let show = true;

                if (selectedCategory !== 'all') {
                    const pc = p.dataset.category;
                    if (pc !== selectedCategory) show = false;
                }

                const price = parseInt(p.dataset.price) || 0;
                if (price < minPrice || price > maxPrice) show = false;

                if (brands.length > 0) {
                    const brand = p.dataset.brand;
                    if (!brands.includes(brand)) show = false;
                }

                if (stocks.length > 0) {
                    const stock = p.dataset.stock;
                    if (!stocks.includes(stock)) show = false;
                }

                if (show) {
                    p.classList.remove('hidden');
                    p.classList.add('show');
                    count++;
                } else {
                    p.classList.add('hidden');
                    p.classList.remove('show');
                }
            });

            // Update result count
            const resultCount = document.getElementById('filterResultCount');
            if (resultCount) {
                resultCount.textContent = count + ' products';
            }

            const noResults = document.getElementById('noResults');
            if (noResults) {
                noResults.style.display = count === 0 ? 'block' : 'none';
            }

            // Close sidebar after applying
            if (window.innerWidth <= 768) {
                closeSidebar();
            }
        }

        // =============================================
        // FILTER CHANGE EVENTS
        // =============================================
        document.querySelectorAll('input[name="category"]').forEach(r => r.addEventListener('change', filterProducts));
        document.querySelectorAll('input[name="brand"]').forEach(c => c.addEventListener('change', filterProducts));
        document.querySelectorAll('input[name="stock"]').forEach(c => c.addEventListener('change', filterProducts));

        // =============================================
        // CLEAR FILTERS
        // =============================================
        function clearFilters() {
            const all = document.querySelector('input[name="category"][value="all"]');
            if (all) all.checked = true;

            // Desktop
            const dMin = parseInt(document.getElementById('priceSliderMin')?.min) || 0;
            const dMax = parseInt(document.getElementById('priceSliderMax')?.max) || 1000;
            if (dsMin) dsMin.value = dMin;
            if (dsMax) dsMax.value = dMax;
            if (dpMin) dpMin.value = dMin;
            if (dpMax) dpMax.value = dMax;
            if (drMin) drMin.textContent = dMin;
            if (drMax) drMax.textContent = dMax;

            // Sidebar
            const sMin = parseInt(document.getElementById('priceSliderMinSidebar')?.min) || 0;
            const sMax = parseInt(document.getElementById('priceSliderMaxSidebar')?.max) || 1000;
            if (ssMin) ssMin.value = sMin;
            if (ssMax) ssMax.value = sMax;
            if (spMin) spMin.value = sMin;
            if (spMax) spMax.value = sMax;
            if (srMin) srMin.textContent = sMin;
            if (srMax) srMax.textContent = sMax;

            document.querySelectorAll('input[name="brand"]').forEach(c => c.checked = false);
            document.querySelectorAll('input[name="stock"]').forEach(c => c.checked = false);

            filterProducts();
        }

        document.getElementById('clearFilters')?.addEventListener('click', clearFilters);
        document.getElementById('clearFiltersSidebar')?.addEventListener('click', clearFilters);

        // =============================================
        // APPLY FILTERS (Sidebar)
        // =============================================
        document.getElementById('applyFiltersSidebar')?.addEventListener('click', filterProducts);

        // =============================================
        // INITIALIZE
        // =============================================
        // FAQ
        const firstFaq = document.querySelector('.faq-item');
        if (firstFaq) {
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
                item.querySelector('.faq-answer').classList.remove('open');
            });
            firstFaq.classList.add('active');
            firstFaq.querySelector('.faq-answer').classList.add('open');
        }

        // Hero Slider
        initHeroSlider();

        // Filter Products
        filterProducts();

        // Resize handler - close sidebar on desktop
        let resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            }, 250);
        });

        // =============================================
        // SMALL BANNER CAROUSEL
        // =============================================
        function initSmallBannerCarousel() {
            const container = document.querySelector('.banner-carousel-container');
            if (!container) return;

            const slides = container.querySelectorAll('.banner-carousel-slide');
            const dots = container.querySelectorAll('.banner-carousel-dot');
            const prevBtn = container.querySelector('.banner-carousel-arrow.prev');
            const nextBtn = container.querySelector('.banner-carousel-arrow.next');

            if (slides.length <= 1) return;

            let currentSlide = 0;
            let autoplayInterval = null;
            const autoplayDelay = 4000;

            function goToSlide(index) {
                slides.forEach(s => s.classList.remove('active'));
                dots.forEach(d => d.classList.remove('active'));
                slides[index].classList.add('active');
                dots[index].classList.add('active');
                currentSlide = index;
            }

            function nextSlide() {
                goToSlide((currentSlide + 1) % slides.length);
            }

            function prevSlide() {
                goToSlide((currentSlide - 1 + slides.length) % slides.length);
            }

            function startAutoplay() {
                if (autoplayInterval) clearInterval(autoplayInterval);
                autoplayInterval = setInterval(nextSlide, autoplayDelay);
            }

            function stopAutoplay() {
                if (autoplayInterval) {
                    clearInterval(autoplayInterval);
                    autoplayInterval = null;
                }
            }

            // Dot clicks
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function () {
                    stopAutoplay();
                    goToSlide(index);
                    startAutoplay();
                });
            });

            // Arrow clicks
            if (nextBtn) {
                nextBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    stopAutoplay();
                    nextSlide();
                    startAutoplay();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    stopAutoplay();
                    prevSlide();
                    startAutoplay();
                });
            }

            // Hover pause
            container.addEventListener('mouseenter', stopAutoplay);
            container.addEventListener('mouseleave', startAutoplay);

            // Touch support
            let touchStartX = 0;
            container.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            container.addEventListener('touchend', function (e) {
                const diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 30) {
                    stopAutoplay();
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                    startAutoplay();
                }
            }, { passive: true });

            startAutoplay();
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function () {
            initSmallBannerCarousel();
        });
        // =============================================
        // REDIRECT TO LOGIN
        // =============================================
        function redirectToLogin() {
            // Get the current URL to redirect back after login
            const currentUrl = window.location.href;
            // Redirect to login page with return URL
            window.location.href = '/login?redirect=' + encodeURIComponent(currentUrl);
        }
    </script>
    <script>
        const notifyMeUrl = "{{ route('customer.notify-me') }}";
        const currentUserEmail = @json(auth()->user()->email ?? null);

        document.addEventListener('click', function (e) {

            const button = e.target.closest('.notify-me-btn');

            if (!button) return;

            const productId = button.dataset.productId;

            // User email already exists
            if (currentUserEmail) {

                button.disabled = true;

                fetch(notifyMeUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                    .then(async response => {

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(
                                data.message || 'Something went wrong'
                            );
                        }

                        return data;
                    })
                    .then(data => {

                        if (data.success) {

                            showSidebarToast(
                                'success',
                                'Notify Me',
                                data.message
                            );

                        } else {

                            showSidebarToast(
                                'error',
                                'Error',
                                data.message || 'Something went wrong.'
                            );
                        }
                    })
                    .catch(error => {

                        console.error(error);

                        showSidebarToast(
                            'error',
                            'Error',
                            error.message || 'Something went wrong.'
                        );
                    })
                    .finally(() => {
                        button.disabled = false;
                    });

                return;
            }

            // No registered email → ask email
            const email = prompt('Please enter your email address:');

            if (!email) {
                return;
            }

            button.disabled = true;

            fetch(notifyMeUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]'
                    ).getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    email: email
                })
            })
                .then(async response => {
                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Invalid email address');
                    }

                    return data;
                })
                .then(data => {
                    showSidebarToast(
                        'success',
                        'Notify Me',
                        data.message
                    );
                })
                .catch(error => {
                    console.error(error);

                    showSidebarToast(
                        'error',
                        'Error',
                        error.message || 'Something went wrong.'
                    );
                })
                .finally(() => {
                    button.disabled = false;
                });

        });
    </script>
@endpush
