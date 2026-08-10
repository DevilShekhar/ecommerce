@extends('frontend.layouts.app')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? '')

@section('content')

    @php
        use Illuminate\Support\Facades\Storage;
    @endphp

    @foreach($page->sections->where('status', 1)->sortBy('sort_order') as $section)

        {{-- =========================================================
        HERO SECTION
        ========================================================== --}}
        @if($section->section_type === 'hero')

            <section class="hero-section" style="--hero-image: url('{{ $section->image ? Storage::url($section->image) : '' }}');">

                <div class="hero-overlay"></div>

                <div class="container position-relative">
                    <div class="hero-content">

                        @if($section->sub_title)
                            <span class="hero-subtitle">
                                {{ $section->sub_title }}
                            </span>
                        @endif

                        @if($section->title)
                            <h1 class="hero-title">
                                {{ $section->title }}
                            </h1>
                        @endif

                        @if($section->content)
                            <div class="hero-description">
                                {!! $section->content !!}
                            </div>
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
                                    <div class="section-subtitle">
                                        {{ $section->sub_title }}
                                    </div>
                                @endif

                                @if($section->title)
                                    <h2 class="section-title">
                                        {{ $section->title }}
                                    </h2>
                                @endif

                                @if($section->content)
                                    <div class="section-content about-description">
                                        {!! $section->content !!}
                                    </div>
                                @endif

                                @if($section->button_text && $section->button_url)

                                    <div class="section-action">

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
                                                     alt="{{ $testimonial['name'] ?? 'Customer' }}"
                                                     class="testimonial-avatar">
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
            PRODUCTS SECTION
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

                        <div class="filter-bar">
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
                                                    <input type="number" id="priceMin" value="{{ $minPrice }}" min="{{ $minPrice }}" max="{{ $maxPrice }}">
                                                </div>
                                                <div class="price-input">
                                                    <label>Max</label>
                                                    <input type="number" id="priceMax" value="{{ $maxPrice }}" min="{{ $minPrice }}" max="{{ $maxPrice }}">
                                                </div>
                                            </div>
                                            <div class="price-slider-wrapper">
                                                <input type="range" id="priceSliderMin" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $minPrice }}">
                                                <input type="range" id="priceSliderMax" min="{{ $minPrice }}" max="{{ $maxPrice }}" value="{{ $maxPrice }}">
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

                        <div class="row g-2 g-sm-3 products-grid">
                            @foreach($section->products as $product)
                                <div class="col-6 col-sm-6 col-md-4 col-lg-3 product-item"
                                     data-category="{{ $product->category_id ?? '' }}"
                                     data-brand="{{ $product->brand_id ?? '' }}"
                                     data-price="{{ $product->price ?? 0 }}"
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
                                                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                                                 class="product-image" loading="lazy"
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
                                                <div class="product-brand"><i class="bi bi-building"></i> {{ $product->brand->name }}</div>
                                            @endif
                                            @if($product->name)
                                                <h5 class="product-title">{{ $product->name }}</h5>
                                            @endif
                                            @if($product->price !== null)
                                                <div class="product-price">₹{{ number_format($product->price, 2) }}</div>
                                            @endif
                                            @if($product->sku)
                                                <div class="product-sku"><i class="bi bi-upc"></i> {{ $product->sku }}</div>
                                            @endif
                                            @if($product->subCategory)
                                                <div class="product-subcategory"><i class="bi bi-folder-open"></i> {{ $product->subCategory->name }}</div>
                                            @endif
                                            <div class="product-action">
                                                @if($product->stock !== null && $product->stock <= 0)
                                                    <button type="button" class="btn-add-cart" disabled>
                                                        <i class="bi bi-x-circle"></i> Out of Stock
                                                    </button>
                                                @else
                                                    <button type="button" class="btn-add-cart">
                                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                                    </button>
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

        @endif

    @endforeach

@endsection


@push('styles')
<style>
/* ========== NAVBAR ========== */
.navbar-custom{background:#fff;border-bottom:1px solid #e2e8f0;padding:12px 0;position:sticky;top:0;z-index:1000}
.navbar-custom .container{display:flex;align-items:center;justify-content:space-between}
.navbar-logo{font-size:22px;font-weight:800;color:#0f172a;text-decoration:none;display:flex;align-items:center;gap:8px}
.navbar-logo i{color:#3b82f6}
.navbar-links{display:flex;align-items:center;gap:28px;list-style:none;margin:0;padding:0}
.navbar-links li a{color:#475569;text-decoration:none;font-size:14px;font-weight:500;transition:color .2s;position:relative}
.navbar-links li a:hover,.navbar-links li a.active{color:#3b82f6}
.navbar-links li a::after{content:'';position:absolute;bottom:-4px;left:0;width:0;height:2px;background:#3b82f6;transition:width .3s}
.navbar-links li a:hover::after,.navbar-links li a.active::after{width:100%}
.navbar-toggle{display:none;background:none;border:none;cursor:pointer;padding:10px;border-radius:8px}
.navbar-toggle:hover{background:#f1f5f9}
.navbar-toggle .dot{display:block;width:5px;height:5px;margin:3px 0;background:#0f172a;border-radius:50%;transition:all .3s}
.navbar-toggle.active .dot:nth-child(1){transform:translateY(8px) rotate(45deg);width:20px;height:2px;border-radius:2px}
.navbar-toggle.active .dot:nth-child(2){opacity:0}
.navbar-toggle.active .dot:nth-child(3){transform:translateY(-8px) rotate(-45deg);width:20px;height:2px;border-radius:2px}
.navbar-mobile-menu{display:none;background:#fff;padding:16px 20px;border-top:1px solid #e2e8f0}
.navbar-mobile-menu.open{display:block;animation:slideDown .3s ease}
@keyframes slideDown{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}
.navbar-mobile-menu ul{list-style:none;padding:0;margin:0}
.navbar-mobile-menu ul li a{display:block;padding:10px 12px;color:#475569;text-decoration:none;font-size:14px;font-weight:500;border-radius:8px;transition:all .2s}
.navbar-mobile-menu ul li a:hover{background:#f1f5f9;color:#3b82f6}
.navbar-mobile-menu ul li a i{margin-right:10px;width:20px;text-align:center}

/* ========== TESTIMONIALS ========== */
.testimonials-section{background:#f8fafc}
.testimonial-card{background:#fff;border-radius:12px;padding:24px;border:1px solid #e2e8f0;transition:all .3s;height:100%;display:flex;flex-direction:column}
.testimonial-card:hover{transform:translateY(-4px);box-shadow:0 10px 30px rgba(0,0,0,0.08);border-color:#3b82f6}
.testimonial-content{flex:1;position:relative;padding-top:10px}
.quote-icon{font-size:24px;color:#3b82f6;opacity:0.3;position:absolute;top:-5px;left:0}
.testimonial-content p{font-size:14px;line-height:1.7;color:#475569;margin:0;padding-left:32px}
.testimonial-author{display:flex;align-items:center;gap:14px;margin-top:18px;padding-top:16px;border-top:1px solid #f1f5f9}
.testimonial-avatar{width:48px;height:48px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0}
.testimonial-avatar-placeholder{width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:18px;border:2px solid #e2e8f0}
.testimonial-info h5{font-size:14px;font-weight:700;color:#0f172a;margin:0}
.testimonial-info span{font-size:12px;color:#94a3b8;display:block}
.testimonial-rating{display:flex;gap:2px;margin-top:4px}
.testimonial-rating i{font-size:12px;color:#f59e0b}
.testimonial-rating i.bi-star{color:#e2e8f0}

/* ========== SERVICES & FEATURES ========== */
.service-card{background:#fff;border-radius:12px;padding:30px;border:1px solid #e2e8f0;transition:all .3s;height:100%;text-align:center}
.service-card:hover{transform:translateY(-4px);box-shadow:0 10px 30px rgba(0,0,0,0.08);border-color:#3b82f6}
.service-icon{width:60px;height:60px;background:linear-gradient(135deg,#3b82f6,#60a5fa);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:24px;color:#fff;box-shadow:0 8px 20px rgba(59,130,246,0.25)}
.service-card h4{font-size:18px;font-weight:700;color:#0f172a;margin-bottom:12px}
.service-card p{font-size:14px;color:#64748b;line-height:1.7;margin:0}

.feature-card{background:#fff;border-radius:12px;padding:24px;border:1px solid #e2e8f0;transition:all .3s;height:100%}
.feature-card:hover{transform:translateY(-4px);box-shadow:0 10px 30px rgba(0,0,0,0.08)}
.feature-icon{font-size:32px;color:#3b82f6;margin-bottom:12px}
.feature-card h5{font-size:16px;font-weight:700;color:#0f172a;margin-bottom:8px}
.feature-card p{font-size:13px;color:#64748b;line-height:1.6;margin:0}

/* ========== FILTER BAR ========== */
.filter-bar{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:8px 12px;margin-bottom:20px}
.filter-row{display:flex;flex-wrap:wrap;align-items:center;gap:6px}
.filter-group{position:relative;display:inline-block}
.filter-toggle{padding:5px 12px;border:1px solid #e2e8f0;border-radius:20px;background:#f8fafc;color:#475569;font-size:12px;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:4px;white-space:nowrap;transition:all .2s}
.filter-toggle:hover{border-color:#3b82f6;color:#3b82f6;background:#eff6ff}
.filter-toggle.active{border-color:#3b82f6;background:#3b82f6;color:#fff}
.filter-dropdown{position:absolute;top:calc(100% + 6px);left:0;min-width:160px;background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:8px;box-shadow:0 10px 30px rgba(0,0,0,0.1);z-index:100;display:none;max-height:200px;overflow-y:auto}
.filter-dropdown.show{display:block}
.filter-option{display:flex;align-items:center;gap:8px;padding:4px 10px;border-radius:6px;cursor:pointer;font-size:12px;color:#475569;transition:background .2s}
.filter-option:hover{background:#f1f5f9}
.filter-option input[type="radio"],.filter-option input[type="checkbox"]{width:14px;height:14px;accent-color:#3b82f6;cursor:pointer}
.price-dropdown{min-width:240px;padding:12px}
.price-range-wrapper{display:flex;flex-direction:column;gap:10px}
.price-inputs{display:flex;gap:10px}
.price-input{flex:1}
.price-input label{font-size:10px;color:#94a3b8;display:block;margin-bottom:2px;font-weight:600;text-transform:uppercase}
.price-input input{width:100%;padding:4px 8px;border:1px solid #e2e8f0;border-radius:6px;font-size:12px}
.price-input input:focus{outline:none;border-color:#3b82f6}
.price-slider-wrapper{position:relative;height:20px;display:flex;align-items:center}
.price-slider-wrapper input[type="range"]{position:absolute;width:100%;height:4px;-webkit-appearance:none;background:transparent;pointer-events:none;margin:0}
.price-slider-wrapper input[type="range"]::-webkit-slider-runnable-track{height:4px;background:#e2e8f0;border-radius:4px}
.price-slider-wrapper input[type="range"]::-webkit-slider-thumb{-webkit-appearance:none;width:14px;height:14px;background:#3b82f6;border-radius:50%;cursor:pointer;pointer-events:auto;border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,0.15);margin-top:-5px}
.price-range-values{display:flex;justify-content:space-between;font-size:12px;font-weight:600;color:#0f172a}
.price-apply-btn{padding:4px 16px;background:#3b82f6;color:#fff;border:none;border-radius:6px;font-size:12px;font-weight:600;cursor:pointer;align-self:flex-end}
.price-apply-btn:hover{background:#2563eb}
.filter-clear-btn{padding:5px 12px;border:1px solid #e2e8f0;border-radius:20px;background:transparent;color:#94a3b8;font-size:12px;font-weight:500;cursor:pointer;display:flex;align-items:center;gap:4px;margin-left:auto;transition:all .2s}
.filter-clear-btn:hover{border-color:#ef4444;color:#ef4444;background:#fef2f2}

/* ========== PRODUCT CARDS ========== */
.product-card{background:#fff;border-radius:10px;border:1px solid #e2e8f0;overflow:hidden;transition:all .3s;display:flex;flex-direction:column;height:100%}
.product-card:hover{transform:translateY(-4px);box-shadow:0 10px 30px rgba(0,0,0,0.08);border-color:#3b82f6}
.product-image-wrapper{position:relative;background:#f8fafc;overflow:hidden;aspect-ratio:1/1}
.product-slider-container{position:relative;width:100%;height:100%;overflow:hidden}
.product-slide{position:absolute;top:0;left:0;width:100%;height:100%;opacity:0;transition:opacity .6s;z-index:0}
.product-slide.active{opacity:1;z-index:1}
.product-image{width:100%;height:100%;object-fit:cover;transition:transform .4s}
.product-card:hover .product-image{transform:scale(1.05)}
.product-image-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#f1f5f9;color:#cbd5e1;font-size:32px}
.category-badge{position:absolute;bottom:6px;left:6px;font-size:8px;font-weight:600;padding:2px 8px;border-radius:50px;background:rgba(0,0,0,0.7);color:#fff;backdrop-filter:blur(4px);z-index:5;max-width:80%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.stock-badge{position:absolute;top:6px;right:6px;font-size:8px;font-weight:700;padding:2px 8px;border-radius:50px;color:#fff;text-transform:uppercase;letter-spacing:.3px;z-index:5;box-shadow:0 2px 6px rgba(0,0,0,0.1)}
.stock-badge.in-stock{background:#22c55e}
.stock-badge.out-of-stock{background:#ef4444}
.slider-dots{position:absolute;bottom:6px;left:50%;transform:translateX(-50%);display:flex;gap:3px;z-index:10}
.slider-dots .dot{width:5px;height:5px;border-radius:50%;background:rgba(255,255,255,0.5);cursor:pointer;transition:all .3s}
.slider-dots .dot.active{background:#fff;width:14px;border-radius:3px}
.slider-arrow{position:absolute;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.8);border:none;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .3s;z-index:10;box-shadow:0 2px 6px rgba(0,0,0,0.08);opacity:0;font-size:14px;font-weight:700;color:#334155}
.product-card:hover .slider-arrow{opacity:1}
.slider-arrow.prev{left:4px}
.slider-arrow.next{right:4px}
.product-body{padding:10px;display:flex;flex-direction:column;flex-grow:1}
.product-brand{font-size:9px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.3px;margin-bottom:2px;display:flex;align-items:center;gap:3px}
.product-title{font-size:12px;font-weight:700;color:#0f172a;margin-bottom:3px;line-height:1.3;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;min-height:32px}
.product-price{font-size:15px;font-weight:800;color:#3b82f6;margin-bottom:4px}
.product-sku{font-size:9px;color:#94a3b8;display:flex;align-items:center;gap:3px;margin-bottom:2px}
.product-subcategory{font-size:9px;color:#64748b;padding:1px 6px;background:#f1f5f9;border-radius:50px;display:inline-flex;align-items:center;gap:3px;margin-bottom:6px;width:fit-content}
.product-action{margin-top:auto}
.btn-add-cart{width:100%;padding:6px;border:none;border-radius:6px;background:#0f172a;color:#fff;font-weight:600;font-size:10px;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:4px}
.btn-add-cart:hover:not(:disabled){background:#1e293b;transform:translateY(-2px)}
.btn-add-cart:disabled{background:#94a3b8;cursor:not-allowed;opacity:.7}

/* ========== RESPONSIVE ========== */
@media (max-width:768px){
.navbar-links{display:none}
.navbar-toggle{display:block}
.col-6{padding:4px}
.product-card{border-radius:8px}
.product-card:hover{transform:none;box-shadow:none}
.product-title{font-size:11px;min-height:28px}
.product-price{font-size:13px}
.btn-add-cart{padding:5px;font-size:9px}
.category-badge{font-size:7px;padding:1px 6px}
.stock-badge{font-size:7px;padding:1px 6px}
.slider-arrow{opacity:1;width:16px;height:16px;font-size:12px}
.filter-bar{display:none}
.testimonial-card{padding:16px}
.testimonial-content p{font-size:13px}
}

.filter-mobile-toggle{display:none;position:sticky;top:70px;z-index:50;background:#fff;padding:10px 0;border-bottom:1px solid #e2e8f0;margin-bottom:16px}
.filter-mobile-toggle .filter-btn{display:flex;align-items:center;gap:8px;padding:10px 20px;background:#0f172a;color:#fff;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;width:100%;justify-content:center}
@media (max-width:768px){.filter-mobile-toggle{display:block}}

.no-results-message{text-align:center;padding:30px 20px;display:none}
.no-results-message i{font-size:32px;color:#cbd5e1;display:block;margin-bottom:8px}
.no-results-message h5{color:#0f172a;font-weight:600;margin-bottom:2px;font-size:16px}
.no-results-message p{color:#94a3b8;font-size:13px}
.product-item{transition:all .3s}
.product-item.hidden{display:none}
.product-item.show{animation:fadeInUp .3s ease}
@keyframes fadeInUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.bg-light{background:#f8fafc!important}
</style>
@endpush


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded',function(){
// Navbar Toggle
const toggle=document.querySelector('.navbar-toggle'),menu=document.querySelector('.navbar-mobile-menu');
if(toggle&&menu){toggle.addEventListener('click',function(){this.classList.toggle('active');menu.classList.toggle('open')});
menu.querySelectorAll('a').forEach(l=>l.addEventListener('click',function(){toggle.classList.remove('active');menu.classList.remove('open')}))}

// Product Slider
document.querySelectorAll('.product-slider-container').forEach(function(c){
const s=c.querySelectorAll('.product-slide'),d=c.querySelectorAll('.dot'),p=c.querySelector('.prev'),n=c.querySelector('.next');
if(s.length<=1)return;let i=0,t=null;
function go(index){s.forEach(slide=>slide.classList.remove('active'));d.forEach(dot=>dot.classList.remove('active'));s[index].classList.add('active');d[index].classList.add('active');i=index}
function next(){go((i+1)%s.length)}
function start(){if(t)clearInterval(t);t=setInterval(next,4000)}
function stop(){if(t){clearInterval(t);t=null}}
d.forEach((dot,index)=>{dot.addEventListener('click',function(e){e.stopPropagation();stop();go(index);start()})});
if(n){n.addEventListener('click',function(e){e.stopPropagation();stop();next();start()})}
if(p){p.addEventListener('click',function(e){e.stopPropagation();stop();go((i-1+s.length)%s.length);start()})}
if(window.matchMedia('(hover:hover)').matches){c.addEventListener('mouseenter',stop);c.addEventListener('mouseleave',start)}
start()});

// Filter Dropdowns
document.querySelectorAll('.filter-toggle').forEach(function(t){
t.addEventListener('click',function(e){e.stopPropagation();const d=this.parentElement.querySelector('.filter-dropdown'),a=d.classList.contains('show');
document.querySelectorAll('.filter-dropdown').forEach(dd=>dd.classList.remove('show'));
document.querySelectorAll('.filter-toggle').forEach(tt=>tt.classList.remove('active'));
if(!a){d.classList.add('show');this.classList.add('active')}})});
document.addEventListener('click',function(){document.querySelectorAll('.filter-dropdown').forEach(d=>d.classList.remove('show'));document.querySelectorAll('.filter-toggle').forEach(t=>t.classList.remove('active'))});
document.querySelectorAll('.filter-dropdown').forEach(function(d){d.addEventListener('click',function(e){e.stopPropagation()})});

// Price Slider
const pMin=document.getElementById('priceMin'),pMax=document.getElementById('priceMax'),sMin=document.getElementById('priceSliderMin'),sMax=document.getElementById('priceSliderMax'),rMin=document.getElementById('rangeMinDisplay'),rMax=document.getElementById('rangeMaxDisplay');
if(pMin&&pMax&&sMin&&sMax){
function update(){let min=parseInt(sMin.value),max=parseInt(sMax.value);if(min>max){sMin.value=max;min=max}if(max<min){sMax.value=min;max=min}pMin.value=min;pMax.value=max;rMin.textContent=min;rMax.textContent=max}
sMin.addEventListener('input',update);sMax.addEventListener('input',update);
pMin.addEventListener('change',function(){let val=parseInt(this.value)||0,o=parseInt(pMax.value)||0;if(val>o)val=o;if(val<parseInt(sMin.min))val=parseInt(sMin.min);sMin.value=val;update()});
pMax.addEventListener('change',function(){let val=parseInt(this.value)||0,o=parseInt(pMin.value)||0;if(val<o)val=o;if(val>parseInt(sMax.max))val=parseInt(sMax.max);sMax.value=val;update()})}
document.getElementById('applyPriceFilter')?.addEventListener('click',function(){filter();const d=this.closest('.filter-dropdown');if(d)d.classList.remove('show');const t=d?.parentElement?.querySelector('.filter-toggle');if(t)t.classList.remove('active')});

// Filter
function filter(){const products=document.querySelectorAll('.product-item');let count=0;const cat=document.querySelector('input[name="category"]:checked'),sc=cat?cat.value:'all',min=parseInt(document.getElementById('priceMin')?.value)||0,max=parseInt(document.getElementById('priceMax')?.value)||999999,brands=Array.from(document.querySelectorAll('input[name="brand"]:checked')).map(c=>c.value),stocks=Array.from(document.querySelectorAll('input[name="stock"]:checked')).map(c=>c.value);
products.forEach(function(p){let show=true;if(sc!=='all'){const pc=p.dataset.category;if(pc!==sc)show=false}const pp=parseInt(p.dataset.price)||0;if(pp<min||pp>max)show=false;if(brands.length>0){const pb=p.dataset.brand;if(!brands.includes(pb))show=false}if(stocks.length>0){const ps=p.dataset.stock;if(!stocks.includes(ps))show=false}if(show){p.classList.remove('hidden');p.classList.add('show');count++}else{p.classList.add('hidden');p.classList.remove('show')}});const nr=document.getElementById('noResults');if(nr){nr.style.display=count===0?'block':'none'}}
document.querySelectorAll('input[name="category"]').forEach(r=>r.addEventListener('change',filter));
document.querySelectorAll('input[name="brand"]').forEach(c=>c.addEventListener('change',filter));
document.querySelectorAll('input[name="stock"]').forEach(c=>c.addEventListener('change',filter));

// Clear
document.getElementById('clearFilters')?.addEventListener('click',function(){
const all=document.querySelector('input[name="category"][value="all"]');if(all)all.checked=true;
const min=parseInt(document.getElementById('priceSliderMin')?.min)||0,max=parseInt(document.getElementById('priceSliderMax')?.max)||1000;
if(sMin)sMin.value=min;if(sMax)sMax.value=max;if(pMin)pMin.value=min;if(pMax)pMax.value=max;if(rMin)rMin.textContent=min;if(rMax)rMax.textContent=max;
document.querySelectorAll('input[name="brand"]').forEach(c=>c.checked=false);
document.querySelectorAll('input[name="stock"]').forEach(c=>c.checked=false);
filter()});
filter()});
</script>
@endpush
