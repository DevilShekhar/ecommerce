@extends('frontend.layouts.app')

@section('title', 'Shops · Aethelweave')
@section('content')
    @push('styles')
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            brand: {
                                bg: '#FDFBF7',
                                dark: '#2C2A29',
                                gold: '#A58B54',
                                goldDark: '#8F753D',
                                card: '#FFFFFF',
                                border: '#E8E2D2'
                            }
                        },
                        fontFamily: {
                            serif: ['"Cormorant Garamond"', 'serif'],
                            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    @endpush
    {{-- =============================================
    STYLES
    ============================================= --}}
    <style>
        /* Product Card Hover Effects */
        .product-card-compact:hover .hover-image {
            opacity: 1 !important;
        }

        .product-card-compact:hover .main-image {
            opacity: 0;
        }

        .product-card-compact {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card-compact:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .product-image-wrapper-compact img {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }

        /* Product Detail Gallery Styles */
        .product-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 20px 0;
        }

        .gallery-section {
            position: relative;
        }

        .main-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            background: #FDFBF7;
            aspect-ratio: 1/1;
        }

        .main-display-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .gallery-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.9);
            border: 1px solid #E8E2D2;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 5;
            opacity: 0;
        }

        .main-image-container:hover .gallery-nav {
            opacity: 1;
        }

        .gallery-nav:hover {
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
        }

        .gallery-nav.prev {
            left: 10px;
        }

        .gallery-nav.next {
            right: 10px;
        }

        .gallery-nav i {
            font-size: 18px;
            color: #2C2A29;
        }

        .image-counter {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: rgba(0,0,0,0.7);
            color: #fff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            z-index: 5;
        }

        .thumbnail-container {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            overflow-x: auto;
            padding: 5px 0;
        }

        .thumbnail-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .thumbnail-img:hover {
            border-color: #D5CFC5;
            transform: scale(1.05);
        }

        .thumbnail-img.active {
            border-color: #A58B54;
            box-shadow: 0 0 0 3px rgba(165, 139, 84, 0.2);
        }

        .info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cat {
            font-size: 12px;
            font-weight: 600;
            color: #A58B54;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .info h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 500;
            color: #2C2A29;
            margin: 0;
        }

        .price {
            font-size: 24px;
            font-weight: 700;
            color: #2C2A29;
        }

        .price .original {
            font-size: 18px;
            font-weight: 400;
            color: #999;
            text-decoration: line-through;
            margin-left: 10px;
        }

        .stock-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            width: fit-content;
        }

        .stock-status.in {
            background: #E8F5E9;
            color: #27AE60;
        }

        .stock-status.out {
            background: #FFEBEE;
            color: #C62828;
        }

        .desc {
            font-size: 14px;
            color: #6B6A69;
            line-height: 1.6;
            margin: 5px 0;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 20px;
            background: #F8F6F1;
            padding: 16px;
            border-radius: 8px;
        }

        .meta-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .meta-item strong {
            font-size: 11px;
            color: #A58B54;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .meta-item span {
            font-size: 14px;
            color: #2C2A29;
        }

        .btn-add {
            padding: 14px 32px;
            background: #A58B54;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            width: fit-content;
        }

        .btn-add:hover:not(:disabled) {
            background: #8A7344;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(165, 139, 84, 0.3);
        }

        .btn-add:disabled {
            background: #ccc;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .btn-add i {
            font-size: 18px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-detail-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .thumbnail-img {
                width: 60px;
                height: 60px;
            }

            .gallery-nav {
                width: 32px;
                height: 32px;
                opacity: 1;
            }

            .gallery-nav i {
                font-size: 14px;
            }
        }

        /* Modal styles */
        .modal-open {
            overflow: hidden;
        }

        #productModal {
            backdrop-filter: blur(4px);
        }

        /* Image counter on product cards */
        .image-counter {
            font-weight: 500;
        }

        /* Dot active state */
        .dot.active {
            background: #A58B54 !important;
            transform: scale(1.2);
        }
    </style>
    {{-- =============================================
    HERO SECTION
    ============================================= --}}
    <section class="hero-section-modern">
        <div class="hero-slider-container">
            <div class="hero-slide active"
                style="background-image: url('https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=1920&h=1080&fit=crop');">
                <div class="hero-overlay"></div>
            </div>
            <div class="hero-slide"
                style="background-image: url('https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?w=1920&h=1080&fit=crop');">
                <div class="hero-overlay"></div>
            </div>
            <div class="hero-slide"
                style="background-image: url('https://images.unsplash.com/photo-1589674781759-c21c37956a44?w=1920&h=1080&fit=crop');">
                <div class="hero-overlay"></div>
            </div>
        </div>

        <div class="container"
            style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;position:relative;z-index:2;">
            <div class="hero-content text-center text-white">
                <span class="hero-subtitle">Exquisite Craftsmanship</span>
                <h1 class="hero-title">Discover Timeless Elegance</h1>
                <div class="hero-description">
                    <p>Explore our curated collection of artisan jewellery, each piece crafted with precision and
                        passion.</p>
                </div>
                <a href="#" class="btn-hero">
                    Shop Now <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="hero-slider-dots">
            <span class="hero-dot active" data-slide="0"></span>
            <span class="hero-dot" data-slide="1"></span>
            <span class="hero-dot" data-slide="2"></span>
        </div>
        <button class="hero-slider-arrow prev" type="button" aria-label="Previous">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="hero-slider-arrow next" type="button" aria-label="Next">
            <i class="bi bi-chevron-right"></i>
        </button>
    </section>

    {{-- =============================================
    CATEGORY SLIDER — Dynamic from Backend
    ============================================= --}}
    @if(isset($categories) && $categories->count() > 0)
        <section class="category-slider-section py-5">
            <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">
                <div class="section-header text-center mb-4">
                    <span class="section-badge">Categories</span>
                    <h2 class="section-title">
                        Shop by Category
                    </h2>
                    <p class="section-subtitle">
                        Find the perfect piece from our curated collections
                    </p>
                </div>
                <div class="category-slider-wrapper position-relative">
                    <div class="category-slider-container">
                        @foreach($categories as $category)
                            <div class="category-slide">
                                <a href="{{ route('shop', ['category' => $category->slug]) }}" class="category-card">
                                    <div class="category-card-image">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                                loading="lazy">
                                        @else
                                            <div class="category-placeholder">
                                                <i class="bi bi-folder"></i>
                                            </div>
                                        @endif
                                        <span class="category-product-count">{{ $category->products_count ?? 0 }}
                                            Products</span>
                                    </div>
                                    <div class="category-card-body">
                                        <h5 class="category-card-name">{{ $category->name }}</h5>
                                        @if($category->description)
                                            <p class="category-card-desc">{{ Str::limit($category->description, 40) }}</p>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    @if($categories->count() > 4)
                        <button class="category-slider-arrow prev" type="button">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <button class="category-slider-arrow next" type="button">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- =============================================
    BANNER CAROUSEL — Dynamic from Backend
    ============================================= --}}
    @if(isset($banners) && $banners->count() > 0)
        <section class="banner-carousel-section py-5">
            <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">
                <div class="banner-carousel-wrapper">
                    <div class="banner-carousel-container">
                        @foreach($banners as $index => $banner)
                            <div class="banner-carousel-slide {{ $index === 0 ? 'active' : '' }}"
                                style="background-image: url('{{ asset('storage/' . $banner->image) }}');">
                                <div class="banner-carousel-overlay"></div>
                                <div class="banner-carousel-content">
                                    <div class="banner-carousel-text">
                                        @if($banner->title)
                                            <h3 class="banner-carousel-title">{{ $banner->title }}</h3>
                                        @endif
                                        @if($banner->subtitle)
                                            <p class="banner-carousel-subtitle">{{ $banner->subtitle }}</p>
                                        @endif
                                        <a href="{{ $banner->link_url ?? '#' }}" class="banner-btn">
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

    {{-- =============================================
    FEATURED PRODUCTS — Compact Grid with 1:1 Images
    ============================================= --}}
    <section class="products-section-compact py-4 bg-brand-bg">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">
            <div class="section-header-compact text-center mb-3">
                <span class="section-badge-compact"
                    style="display:inline-block;padding:2px 12px;background:#F5EEDC;color:#A58B54;font-size:0.6rem;font-weight:600;text-transform:uppercase;letter-spacing:0.12em;border-radius:50px;margin-bottom:4px;">Featured</span>
                <h2 class="section-title-compact"
                    style="font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:500;color:#2C2A29;margin-bottom:2px;">
                    Best Sellers</h2>
                <p class="section-subtitle-compact" style="font-size:0.8rem;color:#6B6A69;margin-bottom:0;">Our most
                    loved pieces</p>
            </div>

            <div class="row" style="display:flex;flex-wrap:wrap;margin:0 -5px;">
                @foreach($featuredProducts as $product)
                    <div class="product-col-compact">
                        <div class="product-card-compact">
                            <div class="product-image-wrapper-compact">
                                @php
                                    $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                    $primaryImage = !empty($images) ? $images[0] : null;
                                @endphp

                                @if($primaryImage)
                                    <img src="{{ asset($primaryImage) }}" alt="{{ $product->name }}" class="product-image-compact"
                                        loading="lazy">
                                @else
                                    <div class="product-image-placeholder-compact">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif

                                <span class="product-badge-compact futured-badge-compact">
                                    <i class="bi bi-star-fill" style="font-size:8px;"></i>
                                </span>

                                @if($product->stock !== null && $product->stock <= 0)
                                    <span class="stock-badge-compact out-of-stock-compact">Out</span>
                                @else
                                    <span class="stock-badge-compact in-stock-compact">In</span>
                                @endif
                            </div>

                            <div class="product-body-compact">
                                @if($product->brand)
                                    <div class="product-brand-compact">{{ $product->brand->name }}</div>
                                @endif

                                <h5 class="product-title-compact">{{ Str::limit($product->name, 20) }}</h5>

                                <div class="product-price-compact">
                                    ₹{{ number_format($product->price, 0) }}
                                </div>

                                <div class="product-action-compact">
                                    @if($product->stock !== null && $product->stock <= 0)
                                        <button type="button" class="btn-add-cart-compact" disabled>
                                            <i class="bi bi-x-circle" style="font-size:12px;"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn-add-cart-compact add-to-cart-btn"
                                            data-product-id="{{ $product->id }}">
                                            <i class="bi bi-cart-plus" style="font-size:12px;"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('shop') }}" class="btn-view-all-compact">
                    View All <i class="bi bi-arrow-right" style="font-size:12px;"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- =============================================
    AVAILABLE PRODUCTS SLIDER
    ============================================= --}}
    @if(isset($availableProducts) && $availableProducts->count() > 0)
        <section class="products-section-compact py-4" style="background:#FFFFFF;">
            <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">
                <div class="section-header-compact text-center mb-3">
                    <span class="section-badge-compact"
                        style="display:inline-block;padding:2px 12px;background:#F5EEDC;color:#A58B54;font-size:0.6rem;font-weight:600;text-transform:uppercase;letter-spacing:0.12em;border-radius:50px;margin-bottom:4px;">Available</span>
                    <h2 class="section-title-compact"
                        style="font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:500;color:#2C2A29;margin-bottom:2px;">
                        Available Products</h2>
                    <p class="section-subtitle-compact" style="font-size:0.8rem;color:#6B6A69;margin-bottom:0;">Explore our
                        available jewellery collection</p>
                </div>

                <!-- Slider Container -->
                <div class="slider-container" style="position:relative;overflow:hidden;">
                    <div class="slider-track" id="availableSliderTrack"
                        style="display:flex;transition:transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);gap:15px;">
                        @foreach($availableProducts as $product)
                            <div class="slider-slide" style="flex:0 0 20%;min-width:200px;">
                                <div class="product-card-compact" onclick="openProductDetail({{ $product->id }})"
                                    style="cursor:pointer;background:#fff;border-radius:12px;overflow:hidden;border:1px solid #E8E2D2;transition:all 0.3s ease;height:100%;">
                                    <div class="product-image-wrapper-compact"
                                        style="position:relative;aspect-ratio:1/1;overflow:hidden;background:#FDFBF7;">
                                        @php
                                            $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                            $primaryImage = !empty($images) ? $images[0] : null;
                                            $hasMultipleImages = count($images) > 1;
                                        @endphp

                                        <!-- Main Image -->
                                        @if($primaryImage)
                                            <img src="{{ asset($primaryImage) }}" alt="{{ $product->name }}"
                                                class="product-image-compact main-image"
                                                style="width:100%;height:100%;object-fit:cover;transition:transform 0.5s ease;position:absolute;top:0;left:0;"
                                                loading="lazy">
                                        @else
                                            <div class="product-image-placeholder-compact"
                                                style="display:flex;align-items:center;justify-content:center;height:100%;color:#D5CFC5;">
                                                <i class="bi bi-image" style="font-size:40px;"></i>
                                            </div>
                                        @endif

                                        <!-- Hover Image (Second Image) -->
                                        @if($hasMultipleImages && isset($images[1]))
                                            <img src="{{ asset($images[1]) }}" alt="{{ $product->name }} - view 2"
                                                class="product-image-compact hover-image"
                                                style="width:100%;height:100%;object-fit:cover;transition:opacity 0.5s ease;position:absolute;top:0;left:0;opacity:0;"
                                                loading="lazy">
                                        @endif

                                        <span class="product-badge-compact"
                                            style="position:absolute;top:10px;left:10px;background:#2C2A29;color:#fff;padding:3px 10px;border-radius:20px;font-size:9px;font-weight:600;text-transform:uppercase;z-index:2;">
                                            <i class="bi bi-fire" style="font-size:8px;"></i>
                                        </span>
                                        <span class="stock-badge-compact"
                                            style="position:absolute;bottom:10px;right:10px;background:#E8F5E9;color:#27AE60;padding:2px 10px;border-radius:20px;font-size:9px;font-weight:600;z-index:2;">In</span>

                                    </div>
                                    <div class="product-body-compact" style="padding:12px 14px 16px;">
                                        @if($product->brand)
                                            <div class="product-brand-compact"
                                                style="font-size:10px;font-weight:600;color:#A58B54;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:2px;">
                                                {{ $product->brand->name }}</div>
                                        @endif
                                        <h5 class="product-title-compact"
                                            style="font-family:'Cormorant Garamond',serif;font-size:14px;font-weight:500;color:#2C2A29;margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            {{ Str::limit($product->name, 20) }}</h5>
                                        <div class="product-price-compact"
                                            style="font-size:16px;font-weight:700;color:#2C2A29;margin-bottom:8px;">
                                            ₹{{ number_format($product->price, 0) }}</div>
                                        <div class="product-action-compact">
                                            <button type="button" class="add-to-cart-btn" data-product-id="{{ $product->id }}"
                                                onclick="event.stopPropagation();"
                                                style="width:100%;padding:6px 12px;background:#A58B54;color:#fff;border:none;border-radius:6px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;cursor:pointer;transition:all 0.3s ease;display:flex;align-items:center;justify-content:center;gap:4px;">
                                                <i class="bi bi-cart-plus" style="font-size:12px;"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Buttons -->
                    <button class="slider-nav prev" onclick="slideProducts(-1)"
                        style="position:absolute;top:50%;left:5px;transform:translateY(-50%);z-index:10;background:rgba(255,255,255,0.95);border:1px solid #E8E2D2;border-radius:50%;width:38px;height:38px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.3s ease;box-shadow:0 2px 12px rgba(0,0,0,0.06);">
                        <i class="bi bi-chevron-left" style="font-size:18px;color:#2C2A29;"></i>
                    </button>
                    <button class="slider-nav next" onclick="slideProducts(1)"
                        style="position:absolute;top:50%;right:5px;transform:translateY(-50%);z-index:10;background:rgba(255,255,255,0.95);border:1px solid #E8E2D2;border-radius:50%;width:38px;height:38px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.3s ease;box-shadow:0 2px 12px rgba(0,0,0,0.06);">
                        <i class="bi bi-chevron-right" style="font-size:18px;color:#2C2A29;"></i>
                    </button>
                </div>

                <!-- Dots -->
                <div class="slider-dots" style="display:flex;justify-content:center;gap:8px;margin-top:16px;">
                    @php
                        $totalSlides = ceil($availableProducts->count() / 5);
                    @endphp
                    @for($i = 0; $i < $totalSlides; $i++)
                        <span class="dot" data-index="{{ $i }}" onclick="goToSlide({{ $i }})"
                            style="width:10px;height:10px;border-radius:50%;background:#D5CFC5;cursor:pointer;transition:all 0.3s ease;{{ $i === 0 ? 'background:#A58B54;transform:scale(1.2);' : '' }}"></span>
                    @endfor
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('shop') }}" class="btn-view-all"
                        style="display:inline-flex;align-items:center;gap:6px;padding:8px 24px;background:transparent;color:#A58B54;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;border:2px solid #A58B54;border-radius:50px;text-decoration:none;transition:all 0.3s ease;">
                        View All <i class="bi bi-arrow-right" style="font-size:12px;"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- =============================================
    ABOUT SECTION
    ============================================= --}}
    @if(isset($aboutUs) && $aboutUs)
        <section class="about-section-home py-4" style="background: #FCF8ED;">
            <div class="container">
                <div class="about-wrapper">
                    @if($aboutUs->about_image)
                        <div class="about-image-col">
                            <div class="about-image-wrapper">
                                <img src="{{ asset('storage/' . $aboutUs->about_image) }}"
                                    alt="{{ $aboutUs->about_title ?? 'About Us' }}" class="about-image" loading="lazy">
                                <div class="about-image-badge">
                                    <span>Since 2010</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="about-content-col">
                        @if($aboutUs->about_sub_title)
                            <span class="about-subtitle">{{ $aboutUs->about_sub_title }}</span>
                        @endif

                        @if($aboutUs->about_title)
                            <h2 class="about-title">{{ $aboutUs->about_title }}</h2>
                        @endif

                        @if($aboutUs->about_description)
                            <div class="about-description">
                                {{ Str::limit(strip_tags($aboutUs->about_description), 200) }}
                            </div>
                        @endif

                        <a href="{{ route('about-us') }}" class="btn-about">
                            Learn More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- =============================================
    SERVICES SECTION
    ============================================= --}}
    <section class="services-section-modern py-5">
        <div class="container">
            <div class="section-header text-center mb-4">
                <span class="section-badge">Services</span>
                <h2 class="section-title">Our Services</h2>
                <p class="section-subtitle">Experience the finest jewellery services tailored just for you</p>
            </div>

            <div class="services-grid">
                <div class="service-col">
                    <div class="service-card-modern">
                        <div class="service-icon-modern">
                            <i class="bi bi-gem"></i>
                        </div>
                        <h4 class="service-title-modern">Custom Design</h4>
                        <p class="service-description-modern">Create your dream jewellery piece with our expert
                            designers who bring your vision to life.</p>
                    </div>
                </div>

                <div class="service-col">
                    <div class="service-card-modern">
                        <div class="service-icon-modern">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h4 class="service-title-modern">Repair & Restoration</h4>
                        <p class="service-description-modern">Restore your cherished jewellery pieces with our expert
                            repair and restoration services.</p>
                    </div>
                </div>

                <div class="service-col">
                    <div class="service-card-modern">
                        <div class="service-icon-modern">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4 class="service-title-modern">Certification</h4>
                        <p class="service-description-modern">Get your jewellery certified with our authentic
                            certification services for peace of mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
    SHIPPING PROCESS
    ============================================= --}}
    <section class="shipping-process-section" style="background: #FCF8ED;">
        <div class="shipping-process-container">
            <div class="shipping-process-header">
                <div class="shipping-process-badge">
                    <span></span>
                    HOW IT WORKS
                    <span></span>
                </div>
                <h2 class="shipping-process-title">From Our Store to Your Door</h2>
                <div class="shipping-process-decoration">
                    <i class="bi bi-gem"></i>
                </div>
                <p class="shipping-process-subtitle">
                    We make every step of your shopping experience simple, secure and special.
                </p>
            </div>

            <div class="shipping-process-grid">
                <div class="shipping-step">
                    <div class="shipping-step-number">01</div>
                    <div class="shipping-step-icon">
                        <i class="bi bi-bag-check"></i>
                    </div>
                    <h3>Order Placed</h3>
                    <p>Choose your favorite products and securely place your order online.</p>
                </div>

                <div class="shipping-connector">
                    <span></span>
                </div>

                <div class="shipping-step">
                    <div class="shipping-step-number">02</div>
                    <div class="shipping-step-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h3>Packed with Care</h3>
                    <p>Your order is carefully checked and beautifully packed by our team.</p>
                </div>

                <div class="shipping-connector">
                    <span></span>
                </div>

                <div class="shipping-step">
                    <div class="shipping-step-number">03</div>
                    <div class="shipping-step-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h3>Shipped</h3>
                    <p>Your package is handed over to our trusted delivery partner for safe transportation.</p>
                </div>

                <div class="shipping-connector">
                    <span></span>
                </div>

                <div class="shipping-step">
                    <div class="shipping-step-number">04</div>
                    <div class="shipping-step-icon">
                        <i class="bi bi-house-heart"></i>
                    </div>
                    <h3>Delivered</h3>
                    <p>Sit back and enjoy your purchase when it arrives safely at your doorstep.</p>
                </div>
            </div>

            <div class="shipping-process-info">
                <div class="shipping-info-item">
                    <i class="bi bi-shield-check"></i>
                    <div>
                        <strong>Secure Packaging</strong>
                        <span>Your order is protected</span>
                    </div>
                </div>

                <div class="shipping-info-item">
                    <i class="bi bi-clock-history"></i>
                    <div>
                        <strong>Fast Delivery</strong>
                        <span>Quick and reliable shipping</span>
                    </div>
                </div>

                <div class="shipping-info-item">
                    <i class="bi bi-geo-alt"></i>
                    <div>
                        <strong>Track Your Order</strong>
                        <span>Stay updated every step</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
    WHY CHOOSE US
    ============================================= --}}
    <section class="why-section">
        <div class="why-container">
            <div class="why-header">
                <span class="why-subtitle">Why Choose Us</span>
                <h2 class="why-title">The Reasons Behind Our Sparkle</h2>
                <div class="why-divider"></div>
            </div>

            <div class="why-grid">
                <div class="why-card">
                    <img src="assets/admin/images/why-1.jpg" alt="Certified Jewellery Purity" class="why-card-image" loading="lazy">
                    <div class="why-card-overlay"></div>
                    <div class="why-card-content">
                        <div class="why-card-top">
                            <div class="why-icon">
                                <i class="bi bi-award"></i>
                            </div>
                            <div class="why-card-number">01</div>
                        </div>
                        <div class="why-card-details">
                            <h3 class="why-card-title">Certified Purity</h3>
                            <p class="why-card-text">Every piece is hallmarked and certified for purity, quality and authenticity.</p>
                        </div>
                    </div>
                </div>

                <div class="why-card">
                    <img src="assets/admin/images/why-2.jpg" alt="Expert Jewellery Craftsmanship" class="why-card-image" loading="lazy">
                    <div class="why-card-overlay"></div>
                    <div class="why-card-content">
                        <div class="why-card-top">
                            <div class="why-icon">
                                <i class="bi bi-tools"></i>
                            </div>
                            <div class="why-card-number">02</div>
                        </div>
                        <div class="why-card-details">
                            <h3 class="why-card-title">Expert Craftsmanship</h3>
                            <p class="why-card-text">Handcrafted by skilled master artisans who combine traditional techniques with modern craftsmanship.</p>
                        </div>
                    </div>
                </div>

                <div class="why-card">
                    <img src="assets/admin/images/why-3.jpg" alt="Timeless Jewellery Designs" class="why-card-image" loading="lazy">
                    <div class="why-card-overlay"></div>
                    <div class="why-card-content">
                        <div class="why-card-top">
                            <div class="why-icon">
                                <i class="bi bi-gem"></i>
                            </div>
                            <div class="why-card-number">03</div>
                        </div>
                        <div class="why-card-details">
                            <h3 class="why-card-title">Timeless Designs</h3>
                            <p class="why-card-text">Discover elegant designs ranging from classic heritage pieces to contemporary styles.</p>
                        </div>
                    </div>
                </div>

                <div class="why-card">
                    <img src="assets/admin/images/why-4.jpg" alt="Trusted Jewellery Legacy" class="why-card-image" loading="lazy">
                    <div class="why-card-overlay"></div>
                    <div class="why-card-content">
                        <div class="why-card-top">
                            <div class="why-icon">
                                <i class="bi bi-hand-thumbs-up"></i>
                            </div>
                            <div class="why-card-number">04</div>
                        </div>
                        <div class="why-card-details">
                            <h3 class="why-card-title">Trusted Legacy</h3>
                            <p class="why-card-text">Built on trust, transparency and exceptional service, we proudly serve customers with jewellery they can cherish.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
    TESTIMONIALS SECTION
    ============================================= --}}
    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="testimonials-header">
                <span class="testimonials-subtitle">Testimonials</span>
                <h2 class="testimonials-title">What Our Customers Say</h2>
                <div class="testimonials-divider"></div>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card testimonial-image-card">
                    <img src="assets/admin/images/per1.jpg" alt="Priya Sharma" class="testimonial-person-image">
                    <div class="testimonial-overlay"></div>
                    <div class="testimonial-hover-content">
                        <div class="testimonial-quote">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="testimonial-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">The craftsmanship is exceptional. I bought a diamond necklace for my anniversary and it exceeded all expectations.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-info">
                            <h4>Priya Sharma</h4>
                            <span>Mumbai</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card testimonial-image-card">
                    <img src="assets/admin/images/per2.jpg" alt="Ananya Patel" class="testimonial-person-image">
                    <div class="testimonial-overlay"></div>
                    <div class="testimonial-hover-content">
                        <div class="testimonial-quote">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="testimonial-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">Bought my bridal set from here. The attention to detail and personalized service made the experience truly special.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-info">
                            <h4>Ananya Patel</h4>
                            <span>Ahmedabad</span>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card testimonial-image-card">
                    <img src="assets/admin/images/per3.jpg" alt="Rahul Mehta" class="testimonial-person-image">
                    <div class="testimonial-overlay"></div>
                    <div class="testimonial-hover-content">
                        <div class="testimonial-quote">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="testimonial-stars">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">I've been a loyal customer for over 8 years. Their designs are timeless and the purity of gold is always guaranteed.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-info">
                            <h4>Rahul Mehta</h4>
                            <span>Delhi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
    FAQ SECTION
    ============================================= --}}
    <section class="faq-section-modern py-5">
        <div class="container">
            <div class="faq-header text-center">
                <span class="faq-eyebrow">FAQ</span>
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <p class="faq-subtitle">Find answers to common questions about our products, jewellery care, shipping and services.</p>
            </div>

            <div class="faq-wrapper">
                <div class="faq-card">
                    <div class="faq-item active">
                        <button type="button" class="faq-question" aria-expanded="true">
                            <span class="faq-question-left">
                                <span class="faq-number">01</span>
                                <span class="faq-question-text">What is your return policy?</span>
                            </span>
                            <span class="faq-toggle">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                We offer a 30-day return policy on all items. If you're not completely satisfied with your purchase, you can return it within 30 days of delivery for a full refund or exchange.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question" aria-expanded="false">
                            <span class="faq-question-left">
                                <span class="faq-number">02</span>
                                <span class="faq-question-text">Do you offer custom design services?</span>
                            </span>
                            <span class="faq-toggle">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Yes, we specialize in custom jewellery design. Our expert designers work closely with you to create a unique piece that reflects your personal style.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question" aria-expanded="false">
                            <span class="faq-question-left">
                                <span class="faq-number">03</span>
                                <span class="faq-question-text">How do I care for my jewellery?</span>
                            </span>
                            <span class="faq-toggle">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                To keep your jewellery looking its best, clean it regularly with a soft cloth and mild soap solution. Avoid exposing it to harsh chemicals, perfumes or lotions.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question" aria-expanded="false">
                            <span class="faq-question-left">
                                <span class="faq-number">04</span>
                                <span class="faq-question-text">How long does shipping take?</span>
                            </span>
                            <span class="faq-toggle">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Standard shipping within India typically takes 5–7 business days. International shipping generally takes 10–14 business days.
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button type="button" class="faq-question" aria-expanded="false">
                            <span class="faq-question-left">
                                <span class="faq-number">05</span>
                                <span class="faq-question-text">Are your jewellery pieces certified?</span>
                            </span>
                            <span class="faq-toggle">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </button>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                Selected jewellery pieces come with applicable authenticity and certification documentation. Product-specific certification details are provided on the respective product page.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
    CTA SECTION
    ============================================= --}}
    <section class="cta-section-modern py-5">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <p class="text-[11px] uppercase tracking-[0.3em] text-brand-gold font-semibold mb-2">We're Here To Help</p>
                <h1 class="font-serif text-4xl sm:text-5xl font-medium tracking-wide mb-4 text-white">Let's Connect With Us</h1>
                <div class="flex items-center justify-center space-x-3 mb-5">
                    <span class="h-[1px] w-12 bg-brand-gold/40"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-gold/60"></span>
                    <span class="h-[1px] w-12 bg-brand-gold/40"></span>
                </div>
                <p class="text-sm sm:text-base text-brand-gold font-light leading-relaxed max-w-xl mx-auto">
                    Have a question about our jewelry, orders, shipping, or anything else? Our expert team is always happy to assist.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-7 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                            <div class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.124-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                            </div>
                            <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">WhatsApp</h3>
                            <p class="text-sm font-medium text-brand-dark">+91 98765 43210</p>
                        </div>

                        <div class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                            <div class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">Call Us</h3>
                            <p class="text-sm font-medium text-brand-dark">+91 98765 43210</p>
                        </div>

                        <div class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                            <div class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">Email</h3>
                            <p class="text-xs font-medium text-brand-dark truncate max-w-full">support@aethelweave.com</p>
                        </div>
                    </div>

                    <div class="bg-brand-card p-6 rounded-xl border border-brand-border shadow-card hover:shadow-card-hover transition">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-[10px] font-semibold uppercase tracking-[0.2em] text-brand-gold bg-brand-bg px-3 py-1 rounded border border-brand-border/60">Find Us On Map</h3>
                            <a href="https://maps.google.com" target="_blank" class="text-xs text-brand-gold underline hover:text-brand-dark transition">Open in Maps</a>
                        </div>
                        <div class="map-container w-full h-56 bg-gray-100 rounded-lg mb-4 border border-brand-border/60">
                            <iframe width="100%" height="100%" frameborder="0" style="border:0" loading="lazy"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.5936087570146!2d73.8870!3d18.5362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTjCsDMyJzEwLjQiTiA3M8KwNTMnMTMuMiJF!5e0!3m2!1sen!2sin!4v1620000000000"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="text-center">
                            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-semibold mb-1">Visit Our Boutique</p>
                            <p class="text-xs text-brand-dark font-medium">123, Jewelry Lane, Koregaon Park, Pune, Maharashtra 411001, India</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-brand-card p-8 rounded-xl border border-brand-border shadow-card hover:shadow-card-hover transition">
                    <h2 class="text-xl font-serif font-medium text-brand-dark mb-1">Get In Touch</h2>
                    <p class="text-xs text-gray-500 mb-6">Speak with our jewellery consultant</p>

                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 text-xs rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact-inquiry.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">First Name *</label>
                                <input type="text" name="first_name" required placeholder="Enter your first name"
                                    class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Last Name *</label>
                                <input type="text" name="last_name" required placeholder="Enter your last name"
                                    class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Email Address *</label>
                            <input type="email" name="email" required placeholder="Enter your email"
                                class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">I am Interested In... *</label>
                            <select name="interest" required
                                class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold text-gray-600 transition">
                                <option value="" disabled selected>I am Interested In...</option>
                                <option value="Rings">Rings & Bands</option>
                                <option value="Necklaces">Necklaces & Chains</option>
                                <option value="Bracelets">Bracelets & Bangles</option>
                                <option value="Custom">Custom Design Consultation</option>
                                <option value="Other">General Inquiry</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Tell us your enquiry *</label>
                            <textarea name="message" rows="3" required placeholder="Enter your message"
                                class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold resize-none input-focus-ring transition"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-3.5 bg-brand-gold hover:bg-brand-goldDark text-white font-medium text-xs uppercase tracking-[0.2em] rounded-lg transition shadow-sm hover:shadow-md">
                            Submit Your Enquiry
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-12 text-[10px] text-white tracking-widest uppercase border-t border-brand-border/40 pt-6">
                <span class="text-brand-gold/60">✦</span> Aethelweave · artisan jewellery
            </div>
        </div>
    </section>

    {{-- =============================================
    PRODUCT DETAIL MODAL
    ============================================= --}}
    <div id="productModal" 
     style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:9999;justify-content:center;align-items:center;padding:10px;backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);">
    
    <div style="background:#ffffff;border-radius:16px;max-width:900px;width:100%;max-height:85vh;overflow-y:auto;padding:20px 25px 25px;position:relative;margin:10px;box-shadow:0 20px 60px rgba(0,0,0,0.3);animation:modalSlideIn 0.3s ease;">
        
        <!-- Close Button - Improved for mobile -->
        <button onclick="closeProductDetail()" 
                style="position:sticky;top:0;float:right;background:rgba(255,255,255,0.9);border:none;font-size:28px;cursor:pointer;color:#666;z-index:10;width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-bottom:10px;box-shadow:0 2px 8px rgba(0,0,0,0.1);transition:all 0.2s;"
                onmouseover="this.style.backgroundColor='#f0f0f0';this.style.color='#333';"
                onmouseout="this.style.backgroundColor='rgba(255,255,255,0.9)';this.style.color='#666';">
            &times;
        </button>
        
        <div id="productDetailContent" style="clear:both;">
            <!-- Loading State -->
            <div style="text-align:center;padding:30px 0;">
                <div style="display:inline-block;width:50px;height:50px;border:4px solid #f3f3f3;border-top:4px solid #B8944C;border-radius:50%;animation:spin 1s linear infinite;"></div>
                <p style="margin-top:15px;color:#888;font-size:14px;">Loading product details...</p>
            </div>
        </div>
    </div>
</div>


    {{-- =============================================
    SCRIPTS
    ============================================= --}}
    <script>
        // =============================================
        // SLIDER FUNCTIONS
        // =============================================
        let currentSlide = 0;
        let totalSlides = {{ ceil(($availableProducts->count() ?? 0) / 5) }};
        const slidesToShow = 5;

        function slideProducts(direction) {
            currentSlide += direction;
            if (currentSlide < 0) currentSlide = 0;
            if (currentSlide >= totalSlides) currentSlide = totalSlides - 1;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        function updateSlider() {
            const track = document.getElementById('availableSliderTrack');
            if (!track) return;

            const slideWidth = document.querySelector('.slider-slide')?.offsetWidth || 200;
            const gap = 15;
            const offset = currentSlide * (slideWidth + gap) * slidesToShow;
            track.style.transform = `translateX(-${offset}px)`;

            document.querySelectorAll('.dot').forEach((dot, index) => {
                dot.style.background = index === currentSlide ? '#A58B54' : '#D5CFC5';
                dot.style.transform = index === currentSlide ? 'scale(1.2)' : 'scale(1)';
            });
        }

        let autoSlideInterval;

        function startAutoSlide() {
            if (autoSlideInterval) clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(() => {
                if (currentSlide < totalSlides - 1) {
                    slideProducts(1);
                } else {
                    goToSlide(0);
                }
            }, 5000);
        }

        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }

        // =============================================
        // PRODUCT DETAIL MODAL FUNCTIONS
        // =============================================
        let productImages = [];
        let currentImageIndex = 0;

        function changeMainImage(index) {
            const images = productImages || [];
            if (!images.length || index < 0 || index >= images.length) return;

            currentImageIndex = index;
            const mainImage = document.getElementById('mainDisplayImage');
            const counter = document.querySelector('.image-counter');
            const thumbnails = document.querySelectorAll('.thumbnail-img');

            if (mainImage) {
                mainImage.src = images[index];
            }

            if (counter) {
                counter.textContent = `${index + 1} / ${images.length}`;
            }

            thumbnails.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === index);
            });
        }

        function changeImage(direction) {
            const images = productImages || [];
            if (!images.length) return;

            let newIndex = currentImageIndex + direction;
            if (newIndex < 0) newIndex = images.length - 1;
            if (newIndex >= images.length) newIndex = 0;

            changeMainImage(newIndex);
        }

        function openProductDetail(productId) {
            const modal = document.getElementById('productModal');
            const content = document.getElementById('productDetailContent');

            content.innerHTML = `
                <div style="text-align:center;padding:40px 0;">
                    <i class="bi bi-hourglass-split" style="font-size:40px;color:#B8944C;animation:spin 1s linear infinite;"></i>
                    <p style="margin-top:10px;color:#888;">Loading product details...</p>
                </div>
                <style>
                    @keyframes spin {
                        from { transform: rotate(0deg); }
                        to { transform: rotate(360deg); }
                    }
                </style>
            `;

            modal.style.display = 'flex';
            document.body.classList.add('modal-open');

            fetch(`/customer/product-detail/${productId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const p = data.product;
                        const images = p.image ? p.image.split(',').map(s => s.trim()) : [];
                        const firstImage = images.length > 0 ? images[0] : null;
                        const hasMultipleImages = images.length > 1;

                        productImages = images;
                        currentImageIndex = 0;

                        const stockClass = p.stock > 0 ? 'in' : 'out';
                        const stockText = p.stock > 0 ? 'In Stock' : 'Out of Stock';
                        const stockIcon = p.stock > 0 ? 'check-circle-fill' : 'x-circle-fill';

                        let thumbnailsHTML = '';
                        if (hasMultipleImages) {
                            thumbnailsHTML = `
                                <div class="thumbnail-container">
                                    ${images.map((img, index) => `
                                        <img src="${img}" alt="${p.name} - view ${index + 1}"
                                             class="thumbnail-img ${index === 0 ? 'active' : ''}"
                                             data-index="${index}">
                                    `).join('')}
                                </div>
                            `;
                        }

                        let mainImageHTML = '';
                        if (firstImage) {
                            mainImageHTML = `
                                <div class="main-image-container">
                                    <img src="${firstImage}" alt="${p.name}" class="gallery-img main-display-image" id="mainDisplayImage">
                                    ${hasMultipleImages ? `
                                        <button class="gallery-nav prev" onclick="event.stopPropagation(); changeImage(-1)">
                                            <i class="bi bi-chevron-left"></i>
                                        </button>
                                        <button class="gallery-nav next" onclick="event.stopPropagation(); changeImage(1)">
                                            <i class="bi bi-chevron-right"></i>
                                        </button>
                                        <div class="image-counter">1 / ${images.length}</div>
                                    ` : ''}
                                </div>
                            `;
                        } else {
                            mainImageHTML = `
                                <div class="gallery-img" style="display:flex;align-items:center;justify-content:center;color:#D5CFC5;min-height:300px;">
                                    <i class="bi bi-image" style="font-size:50px;"></i>
                                </div>
                            `;
                        }

                        content.innerHTML = `
                            <div class="product-detail-grid">
                                <div class="gallery-section">
                                    ${mainImageHTML}
                                    ${thumbnailsHTML}
                                </div>
                                <div class="info">
                                    <div class="cat">${p.category ? p.category.name : 'Uncategorized'}</div>
                                    <h2>${p.name}</h2>
                                    <div class="price">
                                        ₹${parseFloat(p.price).toFixed(2)}
                                        ${p.compare_price && p.compare_price > p.price ?
                                            `<span class="original">₹${parseFloat(p.compare_price).toFixed(2)}</span>` : ''}
                                    </div>
                                    <div class="stock-status ${stockClass}">
                                        <i class="bi bi-${stockIcon}"></i>
                                        ${stockText}
                                        ${p.stock > 0 && p.stock < 10 ? `(Only ${p.stock} left)` : ''}
                                    </div>
                                    <div class="desc">${p.specification || p.description || ''}</div>
                                    <div class="meta-grid">
                                        ${p.sku ? `<div class="meta-item"><strong>SKU</strong><span>${p.sku}</span></div>` : ''}
                                        ${p.brand ? `<div class="meta-item"><strong>Brand</strong><span>${p.brand.name}</span></div>` : ''}
                                        ${p.sub_category ? `<div class="meta-item"><strong>Sub Category</strong><span>${p.sub_category.name}</span></div>` : ''}
                                        ${p.variants ? `<div class="meta-item"><strong>Material</strong><span>${p.variants}</span></div>` : ''}
                                    </div>
                                    ${p.stock > 0 ? `
                                        <button class="btn-add" onclick="event.stopPropagation(); addToCart(${p.id})">
                                            <i class="bi bi-cart-plus"></i>
                                            Add to Cart
                                        </button>
                                    ` : `
                                        <button class="btn-add" disabled>
                                            <i class="bi bi-x-circle"></i>
                                            Out of Stock
                                        </button>
                                    `}
                                </div>
                            </div>
                        `;

                    } else {
                        content.innerHTML = `
                            <div style="text-align:center;padding:40px 0;color:#C0392B;">
                                <i class="bi bi-exclamation-circle" style="font-size:40px;"></i>
                                <p style="margin-top:10px;">${data.message || 'Product not found'}</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    content.innerHTML = `
                        <div style="text-align:center;padding:40px 0;color:#C0392B;">
                            <i class="bi bi-exclamation-triangle" style="font-size:40px;"></i>
                            <p style="margin-top:10px;">Error loading product details. Please try again.</p>
                        </div>
                    `;
                    console.error('Error:', error);
                });
        }

        function closeProductDetail() {
            document.getElementById('productModal').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        function addToCart(productId) {
            alert('Product ' + productId + ' added to cart!');
            // You can replace this with your actual add to cart logic
        }

        // =============================================
        // EVENT LISTENERS
        // =============================================
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-slide
            startAutoSlide();

            // Stop auto-slide on hover
            const sliderContainer = document.querySelector('.slider-container');
            if (sliderContainer) {
                sliderContainer.addEventListener('mouseenter', stopAutoSlide);
                sliderContainer.addEventListener('mouseleave', startAutoSlide);
            }

            // Handle window resize
            window.addEventListener('resize', function() {
                updateSlider();
            });

            // Modal close on background click
            document.getElementById('productModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeProductDetail();
                }
            });

            // Modal close on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeProductDetail();
                }
            });

            // Thumbnail click delegation
            document.addEventListener('click', function(e) {
                const thumbnail = e.target.closest('.thumbnail-img');
                if (thumbnail) {
                    const index = parseInt(thumbnail.dataset.index);
                    if (!isNaN(index)) {
                        changeMainImage(index);
                    }
                }

                // Navigation button clicks
                const navBtn = e.target.closest('.gallery-nav');
                if (navBtn) {
                    if (navBtn.classList.contains('prev')) {
                        changeImage(-1);
                    } else if (navBtn.classList.contains('next')) {
                        changeImage(1);
                    }
                }
            });

            // FAQ toggle
            document.querySelectorAll('.faq-question').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('.faq-item');
                    const isActive = item.classList.contains('active');

                    document.querySelectorAll('.faq-item').forEach(faqItem => {
                        faqItem.classList.remove('active');
                        const btn = faqItem.querySelector('.faq-question');
                        if (btn) btn.setAttribute('aria-expanded', 'false');
                    });

                    if (!isActive) {
                        item.classList.add('active');
                        this.setAttribute('aria-expanded', 'true');
                    }
                });
            });
        });

        // Update total slides when window loads
        window.addEventListener('load', function() {
            const slideCount = document.querySelectorAll('.slider-slide').length;
            if (slideCount > 0) {
                totalSlides = Math.ceil(slideCount / 5);
                updateSlider();
            }
        });
    </script>

@endsection
