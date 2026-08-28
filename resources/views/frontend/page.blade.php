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


    <!-- =============================================
        NAVBAR
    ============================================= -->
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
                <li><a href={{ route('shop.index') }}>Shop</a></li>

                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
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
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>

                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>



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
                    <h2 class="section-title">Shop by Category</h2>
                    <p class="section-subtitle">Find the perfect piece from our curated collections</p>
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
                                    <img src="{{ asset($primaryImage) }}" alt="{{ $product->name }}"
                                        class="product-image-compact" loading="lazy">
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
                <div class="row" style="display:flex;flex-wrap:wrap;margin:0 -5px;">
                    @foreach($availableProducts as $product)
                        <div class="product-col-compact">
                            <div class="product-card-compact" onclick="openProductDetail({{ $product->id }})"
                                style="cursor:pointer;">
                                <div class="product-image-wrapper-compact">
                                    @php
                                        $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                        $primaryImage = !empty($images) ? $images[0] : null;
                                    @endphp
                                    @if($primaryImage)
                                        <img src="{{ asset($primaryImage) }}" alt="{{ $product->name }}"
                                            class="product-image-compact" loading="lazy">
                                    @else
                                        <div class="product-image-placeholder-compact"><i class="bi bi-image"></i></div>
                                    @endif
                                    <span class="product-badge-compact new-badge-compact"><i class="bi bi-fire"
                                            style="font-size:8px;"></i></span>
                                    <span class="stock-badge-compact in-stock-compact">In</span>
                                </div>
                                <div class="product-body-compact">
                                    @if($product->brand)
                                        <div class="product-brand-compact">{{ $product->brand->name }}</div>
                                    @endif
                                    <h5 class="product-title-compact">{{ Str::limit($product->name, 20) }}</h5>
                                    <div class="product-price-compact">₹{{ number_format($product->price, 0) }}</div>
                                    <div class="product-action-compact">
                                        <button type="button" class="btn-add-cart-compact add-to-cart-btn"
                                            data-product-id="{{ $product->id }}" onclick="event.stopPropagation();">
                                            <i class="bi bi-cart-plus" style="font-size:12px;"></i>
                                        </button>
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
    @endif

    <!-- ========== PRODUCT DETAIL MODAL ========== -->
    <div id="productModal"
        style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;justify-content:center;align-items:center;padding:20px;">
        <div
            style="background:#fff;border-radius:16px;max-width:900px;width:100%;max-height:90vh;overflow-y:auto;padding:30px;position:relative;">
            <button onclick="closeProductDetail()"
                style="position:absolute;top:15px;right:20px;background:none;border:none;font-size:28px;cursor:pointer;color:#999;">&times;</button>
            <div id="productDetailContent">
                <div style="text-align:center;padding:40px 0;">
                    <i class="bi bi-hourglass-split" style="font-size:40px;color:#B8944C;"></i>
                    <p style="margin-top:10px;color:#888;">Loading product details...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Open product detail modal
        function openProductDetail(productId) {
            const modal = document.getElementById('productModal');
            const content = document.getElementById('productDetailContent');

            // Show loading
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

            // Fetch product details
            fetch(`/customer/product-detail/${productId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const p = data.product;
                        const images = p.image ? p.image.split(',').map(s => s.trim()) : [];
                        const firstImage = images.length > 0 ? images[0] : null;

                        const stockClass = p.stock > 0 ? 'in' : 'out';
                        const stockText = p.stock > 0 ? 'In Stock' : 'Out of Stock';
                        const stockIcon = p.stock > 0 ? 'check-circle-fill' : 'x-circle-fill';
                        const btnDisabled = p.stock < 1 ? 'disabled' : '';
                        const btnText = p.stock > 0 ? 'Add to Cart' : 'Out of Stock';
                        const btnIcon = p.stock > 0 ? 'cart-plus' : 'x-circle';

                        content.innerHTML = `
                        <div class="product-detail-grid">
                            <div>
                                ${firstImage ?
                                `<img src="${firstImage}" alt="${p.name}" class="gallery-img">` :
                                `<div class="gallery-img" style="display:flex;align-items:center;justify-content:center;color:#D5CFC5;">
                                        <i class="bi bi-image" style="font-size:50px;"></i>
                                    </div>`
                            }
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
                                <button class="btn-add" ${btnDisabled}>
                                    <i class="bi bi-${btnIcon}"></i>
                                    ${btnText}
                                </button>
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

        // Close product detail modal
        function closeProductDetail() {
            document.getElementById('productModal').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        // Close on background click
        document.getElementById('productModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeProductDetail();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeProductDetail();
            }
        });
    </script>

    {{-- =============================================
    ABOUT SECTION — Home Page (Image Left, Content Right on all screens)
    ============================================= --}}
    @if(isset($aboutUs) && $aboutUs)
        <section class="about-section-home py-4">
            <div class="container">
                <div class="about-wrapper">
                    @if($aboutUs->about_image)
                        {{-- IMAGE - LEFT on desktop, TOP on mobile --}}
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

                    {{-- CONTENT - RIGHT on desktop, BOTTOM on mobile --}}
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
                <!-- Custom Design -->
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

                <!-- Repair & Restoration -->
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

                <!-- Certification -->
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
    WHY CHOOSE US
    ============================================= --}}

    <section class="why-section">

        <div class="why-container">

            <!-- Section Header -->
            <div class="why-header">

                <span class="why-subtitle">
                    Why Choose Us
                </span>

                <h2 class="why-title">
                    The Reasons Behind Our Sparkle
                </h2>

                <div class="why-divider"></div>

            </div>


            <!-- Why Choose Us Grid -->
            <div class="why-grid">


                {{-- 01 - Certified Purity --}}
                <div class="why-card">

                    <img src="assets/admin/images/why-1.jpg" alt="Certified Jewellery Purity" class="why-card-image"
                        loading="lazy">

                    <div class="why-card-overlay"></div>

                    <div class="why-card-content">

                        <div class="why-card-top">

                            <div class="why-icon">
                                <i class="bi bi-award"></i>
                            </div>

                            <div class="why-card-number">
                                01
                            </div>

                        </div>

                        <div class="why-card-details">

                            <h3 class="why-card-title">
                                Certified Purity
                            </h3>

                            <p class="why-card-text">
                                Every piece is hallmarked and certified for
                                purity, quality and authenticity, giving you
                                complete confidence in every purchase.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- 02 - Expert Craftsmanship --}}
                <div class="why-card">

                    <img src="assets/admin/images/why-2.jpg" alt="Expert Jewellery Craftsmanship" class="why-card-image"
                        loading="lazy">

                    <div class="why-card-overlay"></div>

                    <div class="why-card-content">

                        <div class="why-card-top">

                            <div class="why-icon">
                                <i class="bi bi-tools"></i>
                            </div>

                            <div class="why-card-number">
                                02
                            </div>

                        </div>

                        <div class="why-card-details">

                            <h3 class="why-card-title">
                                Expert Craftsmanship
                            </h3>

                            <p class="why-card-text">
                                Handcrafted by skilled master artisans who
                                combine traditional techniques with modern
                                jewellery craftsmanship.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- 03 - Timeless Designs --}}
                <div class="why-card">

                    <img src="assets/admin/images/why-3.jpg" alt="Timeless Jewellery Designs" class="why-card-image"
                        loading="lazy">

                    <div class="why-card-overlay"></div>

                    <div class="why-card-content">

                        <div class="why-card-top">

                            <div class="why-icon">
                                <i class="bi bi-gem"></i>
                            </div>

                            <div class="why-card-number">
                                03
                            </div>

                        </div>

                        <div class="why-card-details">

                            <h3 class="why-card-title">
                                Timeless Designs
                            </h3>

                            <p class="why-card-text">
                                Discover elegant designs ranging from classic
                                heritage pieces to contemporary styles made
                                to remain beautiful for generations.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- 04 - Trusted Legacy --}}
                <div class="why-card">

                    <img src="assets/admin/images/why-4.jpg" alt="Trusted Jewellery Legacy" class="why-card-image"
                        loading="lazy">

                    <div class="why-card-overlay"></div>

                    <div class="why-card-content">

                        <div class="why-card-top">

                            <div class="why-icon">
                                <i class="bi bi-hand-thumbs-up"></i>
                            </div>

                            <div class="why-card-number">
                                04
                            </div>

                        </div>

                        <div class="why-card-details">

                            <h3 class="why-card-title">
                                Trusted Legacy
                            </h3>

                            <p class="why-card-text">
                                Built on trust, transparency and exceptional
                                service, we proudly serve customers and families
                                with jewellery they can cherish.
                            </p>

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

            <!-- Header -->
            <div class="testimonials-header">

                <span class="testimonials-subtitle">
                    Testimonials
                </span>

                <h2 class="testimonials-title">
                    What Our Customers Say
                </h2>

                <div class="testimonials-divider"></div>

            </div>


            <!-- Testimonials Grid -->
            <div class="testimonials-grid">


                {{-- TESTIMONIAL 1 --}}
                <div class="testimonial-card testimonial-image-card">

                    <img src="assets/admin/images/per1.jpg" alt="Priya Sharma" class="testimonial-person-image">

                    <!-- Dark Overlay -->
                    <div class="testimonial-overlay"></div>

                    <!-- Content shown on hover -->
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

                        <p class="testimonial-text">
                            The craftsmanship is exceptional. I bought a
                            diamond necklace for my anniversary and it exceeded
                            all expectations. Truly premium quality!
                        </p>

                    </div>

                    <!-- Author -->
                    <div class="testimonial-author">

                        <div class="author-info">

                            <h4>
                                Priya Sharma
                            </h4>

                            <span>
                                Mumbai
                            </span>

                        </div>

                    </div>

                </div>


                {{-- TESTIMONIAL 2 --}}
                <div class="testimonial-card testimonial-image-card">

                    <img src="assets/admin/images/per2.jpg" alt="Ananya Patel" class="testimonial-person-image">

                    <!-- Dark Overlay -->
                    <div class="testimonial-overlay"></div>

                    <!-- Content shown on hover -->
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

                        <p class="testimonial-text">
                            Bought my bridal set from here. The attention
                            to detail and personalized service made the
                            experience truly special. Thank you!
                        </p>

                    </div>

                    <!-- Author -->
                    <div class="testimonial-author">

                        <div class="author-info">

                            <h4>
                                Ananya Patel
                            </h4>

                            <span>
                                Ahmedabad
                            </span>

                        </div>

                    </div>

                </div>


                {{-- TESTIMONIAL 3 --}}
                <div class="testimonial-card testimonial-image-card">

                    <img src="assets/admin/images/per3.jpg" alt="Rahul Mehta" class="testimonial-person-image">

                    <!-- Dark Overlay -->
                    <div class="testimonial-overlay"></div>

                    <!-- Content shown on hover -->
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

                        <p class="testimonial-text">
                            I've been a loyal customer for over 8 years.
                            Their designs are timeless and the purity of gold
                            is always guaranteed. Highly recommended!
                        </p>

                    </div>

                    <!-- Author -->
                    <div class="testimonial-author">

                        <div class="author-info">

                            <h4>
                                Rahul Mehta
                            </h4>

                            <span>
                                Delhi
                            </span>

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

            {{-- Section Header --}}
            <div class="faq-header text-center">
                <span class="faq-eyebrow">FAQ</span>
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <p class="faq-subtitle">Find answers to common questions about our products, jewellery care, shipping
                    and services.</p>
            </div>

            {{-- FAQ Content --}}
            <div class="faq-wrapper">
                <div class="faq-card">

                    {{-- FAQ 1 --}}
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
                                We offer a 30-day return policy on all items. If you're not completely satisfied with
                                your purchase, you can return it within 30 days of delivery for a full refund or
                                exchange. Items must be in their original condition with all packaging and
                                documentation.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 2 --}}
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
                                Yes, we specialize in custom jewellery design. Our expert designers work closely with
                                you to create a unique piece that reflects your personal style. From concept to
                                creation, we'll guide you through every step.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 3 --}}
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
                                To keep your jewellery looking its best, clean it regularly with a soft cloth and mild
                                soap solution. Avoid exposing it to harsh chemicals, perfumes or lotions. Store each
                                piece separately in a soft pouch or jewellery box to prevent scratches.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 4 --}}
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
                                Standard shipping within India typically takes 5–7 business days. International shipping
                                generally takes 10–14 business days. All orders are shipped with tracking for your peace
                                of mind.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 5 --}}
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
                                Selected jewellery pieces come with applicable authenticity and certification
                                documentation. Product-specific certification details are provided on the respective
                                product page.
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

            <!-- HEADER SECTION – refined -->
            <div class="text-center max-w-2xl mx-auto mb-14">
                <p class="text-[11px] uppercase tracking-[0.3em] text-brand-gold font-semibold mb-2">We’re Here To Help
                </p>
                <h1 class="font-serif text-4xl sm:text-5xl font-medium tracking-wide mb-4 text-white">Let’s Connect With
                    Us</h1>
                <div class="flex items-center justify-center space-x-3 mb-5">
                    <span class="h-[1px] w-12 bg-brand-gold/40"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-gold/60"></span>
                    <span class="h-[1px] w-12 bg-brand-gold/40"></span>
                </div>
                <p class="text-sm sm:text-base text-brand-gold font-light leading-relaxed max-w-xl mx-auto">
                    Have a question about our jewelry, orders, shipping, or anything else? Our expert team is always
                    happy to assist. Reach out, and we’ll be delighted to help you find the perfect piece or resolve
                    your query.
                </p>
            </div>

            <!-- MAIN GRID CONTAINER -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- LEFT COLUMN: Support Channels & Map Section -->
                <div class="lg:col-span-7 space-y-6">

                    <!-- Support Channels Row – professional cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                        <!-- WhatsApp Support -->
                        <div
                            class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                            <div
                                class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.124-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                            </div>
                            <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">
                                WhatsApp</h3>
                            <p class="text-sm font-medium text-brand-dark">+91 98765 43210</p>
                        </div>

                        <!-- Call Support -->
                        <div
                            class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                            <div
                                class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">Call Us
                            </h3>
                            <p class="text-sm font-medium text-brand-dark">+91 98765 43210</p>
                        </div>

                        <!-- Email Support -->
                        <div
                            class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                            <div
                                class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">Email
                            </h3>
                            <p class="text-xs font-medium text-brand-dark truncate max-w-full">support@aethelweave.com
                            </p>
                        </div>

                    </div>

                    <!-- Map & Boutique Location – polished -->
                    <div
                        class="bg-brand-card p-6 rounded-xl border border-brand-border shadow-card hover:shadow-card-hover transition">
                        <div class="flex items-center justify-between mb-4">
                            <h3
                                class="text-[10px] font-semibold uppercase tracking-[0.2em] text-brand-gold bg-brand-bg px-3 py-1 rounded border border-brand-border/60">
                                Find Us On Map</h3>
                            <a href="https://maps.google.com" target="_blank"
                                class="text-xs text-brand-gold underline hover:text-brand-dark transition">Open in
                                Maps</a>
                        </div>

                        <!-- Google Map Embedded iframe – refined container -->
                        <div
                            class="map-container w-full h-56 bg-gray-100 rounded-lg mb-4 border border-brand-border/60">
                            <iframe width="100%" height="100%" frameborder="0" style="border:0" loading="lazy"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.5936087570146!2d73.8870!3d18.5362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTjCsDMyJzEwLjQiTiA3M8KwNTMnMTMuMiJF!5e0!3m2!1sen!2sin!4v1620000000000"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <div class="text-center">
                            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-semibold mb-1">Visit Our
                                Boutique</p>
                            <p class="text-xs text-brand-dark font-medium">123, Jewelry Lane, Koregaon Park, Pune,
                                Maharashtra 411001, India</p>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN: Contact Form – elevated design -->
                <div
                    class="lg:col-span-5 bg-brand-card p-8 rounded-xl border border-brand-border shadow-card hover:shadow-card-hover transition">
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
                                <label
                                    class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">First
                                    Name *</label>
                                <input type="text" name="first_name" required placeholder="Enter your first name"
                                    class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                            </div>
                            <div>
                                <label
                                    class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Last
                                    Name *</label>
                                <input type="text" name="last_name" required placeholder="Enter your last name"
                                    class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Email
                                Address *</label>
                            <input type="email" name="email" required placeholder="Enter your email"
                                class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">I
                                am Interested In... *</label>
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
                            <label
                                class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Tell
                                us your enquiry *</label>
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

            <!-- tiny footer note (clean) -->
            <div
                class="text-center mt-12 text-[10px] text-white tracking-widest uppercase border-t border-brand-border/40 pt-6">
                <span class="text-brand-gold/60">✦</span> Aethelweave · artisan jewellery
            </div>
        </div>
    </section>
    {{-- =============================================
    SCRIPTS
    ============================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // =============================================
            // HERO SLIDER
            // =============================================
            function initHeroSlider() {
                const container = document.querySelector('.hero-slider-container');
                if (!container) return;

                const slides = container.querySelectorAll('.hero-slide');
                const dots = document.querySelectorAll('.hero-dot');
                const prevBtn = document.querySelector('.hero-slider-arrow.prev');
                const nextBtn = document.querySelector('.hero-slider-arrow.next');

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

            // =============================================
            // BANNER CAROUSEL
            // =============================================
            function initBannerCarousel() {
                const container = document.querySelector('.banner-carousel-container');
                if (!container) return;

                const slides = container.querySelectorAll('.banner-carousel-slide');
                const dots = container.querySelectorAll('.banner-carousel-dot');
                const prevBtn = container.querySelector('.banner-carousel-arrow.prev');
                const nextBtn = container.querySelector('.banner-carousel-arrow.next');

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
                    autoplayInterval = setInterval(nextSlide, 4000);
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
            function initCategorySlider() {
                const container = document.querySelector('.category-slider-container');
                if (!container) return;

                const slides = container.querySelectorAll('.category-slide');
                if (slides.length <= 4) {
                    const arrows = document.querySelectorAll('.category-slider-arrow');
                    arrows.forEach(a => a.style.display = 'none');
                    return;
                }

                const prevBtn = document.querySelector('.category-slider-arrow.prev');
                const nextBtn = document.querySelector('.category-slider-arrow.next');

                if (nextBtn) {
                    nextBtn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        container.scrollBy({ left: 200, behavior: 'smooth' });
                    });
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        container.scrollBy({ left: -200, behavior: 'smooth' });
                    });
                }

                let touchStartX = 0;
                container.addEventListener('touchstart', function (e) {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                container.addEventListener('touchend', function (e) {
                    const diff = touchStartX - e.changedTouches[0].screenX;
                    if (Math.abs(diff) > 30) {
                        if (diff > 0) {
                            container.scrollBy({ left: 200, behavior: 'smooth' });
                        } else {
                            container.scrollBy({ left: -200, behavior: 'smooth' });
                        }
                    }
                }, { passive: true });
            }
            window.toggleFaq = function (element) {
                const currentItem = element.closest('.faq-item-modern');
                const isActive = currentItem.classList.contains('active');

                document.querySelectorAll('.faq-item-modern').forEach(item => {
                    item.classList.remove('active');
                    item.querySelector('.faq-answer-modern').classList.remove('open');
                });

                if (!isActive) {
                    currentItem.classList.add('active');
                    currentItem.querySelector('.faq-answer-modern').classList.add('open');
                }
            }
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    e.preventDefault();
                    window.location.href = '/login';
                });
            });
            const newsletterForm = document.getElementById('newsletterForm');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const input = this.querySelector('.cta-input');
                    const email = input.value.trim();

                    if (email && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                        alert('Thank you for subscribing to our newsletter!');
                        input.value = '';
                    } else {
                        alert('Please enter a valid email address.');
                    }
                });
            }

            // Initialize all sliders
            initHeroSlider();
            initBannerCarousel();
            initCategorySlider();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(function (item) {

                const button = item.querySelector('.faq-question');

                button.addEventListener('click', function () {

                    const isActive = item.classList.contains('active');

                    faqItems.forEach(function (faqItem) {
                        faqItem.classList.remove('active');

                        const faqButton = faqItem.querySelector('.faq-question');

                        if (faqButton) {
                            faqButton.setAttribute('aria-expanded', 'false');
                        }
                    });

                    if (!isActive) {
                        item.classList.add('active');
                        button.setAttribute('aria-expanded', 'true');
                    }

                });

            });

        });
    </script>
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
                        navbar.style.background = 'rgba(253, 251, 247, 0.98)';
                        navbar.style.boxShadow = '0 2px 24px rgba(44, 42, 41, 0.06)';
                    } else {
                        navbar.style.background = 'rgba(253, 251, 247, 0.92)';
                        navbar.style.boxShadow = 'none';
                    }
                });
            }

            // Show desktop nav links on larger screens
            const mediaQuery = window.matchMedia('(min-width: 768px)');
            const navLinks = document.querySelector('.nav-links-desktop');
            const hamburgerBtn = document.querySelector('.hamburger-btn');

            function handleScreenChange(e) {
                if (e.matches) {
                    if (navLinks) navLinks.style.display = 'flex';
                    if (hamburgerBtn) hamburgerBtn.style.display = 'none';
                    if (mobileMenu) mobileMenu.style.display = 'none';
                } else {
                    if (navLinks) navLinks.style.display = 'none';
                    if (hamburgerBtn) hamburgerBtn.style.display = 'flex';
                }
            }

            mediaQuery.addEventListener('change', handleScreenChange);
            handleScreenChange(mediaQuery);
        });
    </script>

@endsection