@extends('frontend.layouts.customer-layout')
@section('title', $product->name . ' - Aethelweave')
@section('content')
    <style>
        :root {
            --blue: #2563eb;
            --blue-dark: #1e3a8a;
            --blue-light: #eff6ff;
            --blue-soft: #f8fbff;
            --blue-border: #dbeafe;
            --ink: #172033;
            --muted: #64748b;
            --white: #fff
        }

        .product-page {
            background: var(--blue-soft);
            color: var(--ink);
            font-family: "Plus Jakarta Sans", sans-serif
        }

        .product-page .container {
            max-width: 1280px
        }

        .product-main {
            background: #fff;
            border: 1px solid var(--blue-border);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 10px 40px rgba(30, 58, 138, .06)
        }

        .product-gallery {
            position: sticky;
            top: 25px
        }

        .main-image-wrapper {
            position: relative;
            background: linear-gradient(145deg, #f8fbff, #edf5ff);
            border-radius: 20px;
            overflow: hidden;
            height: 570px
        }

        .main-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: opacity .3s;
            padding: 25px
        }

        .gallery-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            border: 1px solid var(--blue-border);
            border-radius: 50%;
            background: rgba(255, 255, 255, .95);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(37, 99, 235, .12);
            opacity: 0;
            z-index: 5;
            transition: .25s;
            color: var(--blue-dark)
        }

        .gallery-arrow.prev {
            left: 18px
        }

        .gallery-arrow.next {
            right: 18px
        }

        .main-image-wrapper:hover .gallery-arrow {
            opacity: 1
        }

        .gallery-arrow:hover {
            background: var(--blue);
            color: #fff;
            border-color: var(--blue);
            transform: translateY(-50%) scale(1.06)
        }

        .product-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: var(--blue);
            color: #fff;
            padding: 7px 15px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            border-radius: 30px;
            z-index: 6;
            box-shadow: 0 5px 15px rgba(37, 99, 235, .2)
        }

        .thumbnail-wrapper {
            overflow-x: auto;
            padding: 12px 2px 5px
        }

        .thumbnail-item {
            width: 82px;
            height: 92px;
            border: 1px solid var(--blue-border);
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            flex-shrink: 0;
            transition: .25s;
            background: #fff
        }

        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .thumbnail-item:hover,
        .thumbnail-item.active {
            border-color: var(--blue) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .12)
        }

        .product-info {
            padding: 12px 12px 12px 20px
        }

        .product-category {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--blue);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase
        }

        .product-category:before {
            content: "";
            width: 25px;
            height: 1px;
            background: var(--blue)
        }

        .product-title {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 42px;
            line-height: 1.15;
            font-weight: 500;
            margin: 12px 0 8px;
            color: var(--ink)
        }

        .product-sku {
            font-size: 11px;
            color: #94a3b8;
            letter-spacing: .05em
        }

        .rating-row {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 18px 0
        }

        .rating-stars {
            color: #f59e0b;
            letter-spacing: 2px;
            font-size: 14px
        }

        .rating-number {
            font-weight: 700;
            font-size: 13px
        }

        .rating-reviews {
            font-size: 12px;
            color: #94a3b8
        }

        .price-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            padding: 20px 0;
            border-top: 1px solid var(--blue-border);
            border-bottom: 1px solid var(--blue-border)
        }

        .current-price {
            font-size: 30px;
            font-weight: 700;
            color: var(--blue-dark)
        }

        .old-price {
            font-size: 15px;
            color: #94a3b8
        }

        .discount-tag {
            background: var(--blue-light);
            color: var(--blue);
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700
        }

        .stock-area {
            margin: 18px 0
        }

        .stock-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 13px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700
        }

        .stock-in {
            background: #ecfdf5;
            color: #059669
        }

        .stock-out {
            background: #fef2f2;
            color: #dc2626
        }

        .product-description {
            font-size: 13px;
            line-height: 1.9;
            color: var(--muted);
            max-height: 130px;
            overflow-y: auto;
            margin-bottom: 18px
        }

        .quick-specs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-top: 1px solid var(--blue-border);
            border-bottom: 1px solid var(--blue-border);
            margin-bottom: 22px
        }

        .spec-item {
            padding: 13px 0
        }

        .spec-label {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 4px
        }

        .spec-value {
            font-size: 12px;
            font-weight: 700;
            color: var(--ink)
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr 55px;
            gap: 10px
        }

        .add-to-cart-btn,
        .out-stock-btn {
            height: 54px !important;
            border-radius: 9px !important;
            border: 0 !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            letter-spacing: .04em;
            text-transform: uppercase
        }

        .add-to-cart-btn {
            background: linear-gradient(135deg, var(--blue), var(--blue-dark)) !important;
            color: #fff !important;
            transition: .25s
        }

        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #172554) !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(37, 99, 235, .28)
        }

        .out-stock-btn {
            background: #e2e8f0 !important;
            color: #64748b !important
        }

        .wishlist-btn {
            height: 54px !important;
            border: 1px solid var(--blue-border) !important;
            border-radius: 9px !important;
            color: var(--blue) !important;
            background: #fff !important;
            display: flex !important;
            align-items: center;
            justify-content: center;
            font-size: 20px !important;
            transition: .25s
        }

        .wishlist-btn:hover {
            background: var(--blue) !important;
            color: #fff !important;
            border-color: var(--blue) !important
        }

        .view-count {
            font-size: 11px;
            color: #94a3b8;
            text-align: center;
            margin-top: 14px
        }

        .details-section {
            margin-top: 45px
        }

        .product-tabs {
            border-bottom: 1px solid var(--blue-border) !important;
            gap: 5px
        }

        .product-tabs .nav-link {
            border: 0 !important;
            background: transparent !important;
            color: #64748b !important;
            padding: 15px 22px !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: .05em;
            border-radius: 0 !important
        }

        .product-tabs .nav-link:hover,
        .product-tabs .nav-link.active {
            color: var(--blue) !important
        }

        .product-tabs .nav-link.active {
            border-bottom: 2px solid var(--blue) !important
        }

        .tab-content {
            background: #fff !important;
            border: 1px solid var(--blue-border) !important;
            border-top: 0 !important;
            border-radius: 0 0 16px 16px !important;
            padding: 30px !important;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.9
        }

        .tab-content h5 {
            font-family: Georgia, serif;
            color: var(--ink);
            font-size: 20px
        }

        .shipping-list {
            list-style: none;
            padding: 0;
            margin: 0
        }

        .shipping-list li {
            padding: 13px 0;
            border-bottom: 1px solid #edf2f7
        }

        .shipping-list li:last-child {
            border-bottom: 0
        }

        .shipping-list i {
            color: var(--blue);
            margin-right: 8px
        }

        .review-summary {
            display: flex;
            align-items: center;
            gap: 18px
        }

        .review-score {
            font-family: Georgia, serif;
            font-size: 38px;
            font-weight: 500;
            color: var(--ink)
        }

        .review-stars {
            color: #f59e0b;
            font-size: 18px
        }

        .review-item {
            background: var(--blue-soft);
            border: 1px solid var(--blue-border);
            border-radius: 12px;
            padding: 18px !important
        }

        .review-item strong {
            font-size: 13px
        }

        .review-item p {
            font-size: 13px;
            color: var(--muted)
        }

        .related-section {
            margin-top: 50px
        }

        .section-heading {
            font-family: Georgia, serif;
            font-size: 30px;
            font-weight: 500;
            color: var(--ink);
            margin-bottom: 22px
        }

        .section-heading span {
            color: var(--blue)
        }

        .related-card {
            border: 1px solid var(--blue-border) !important;
            border-radius: 15px !important;
            overflow: hidden;
            cursor: pointer;
            background: #fff;
            transition: .3s !important
        }

        .related-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(37, 99, 235, .12);
            border-color: #93c5fd !important
        }

        .related-image {
            height: 230px;
            width: 100%;
            object-fit: cover;
            background: #eff6ff
        }

        .related-body {
            padding: 16px !important
        }

        .related-category {
            font-size: 9px;
            letter-spacing: .13em;
            text-transform: uppercase;
            color: var(--blue)
        }

        .related-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            margin: 5px 0
        }

        .related-price {
            font-size: 14px;
            font-weight: 700;
            color: var(--blue-dark)
        }

        .benefits-section {
            margin-top: 45px
        }

        .benefit-card {
            height: 100%;
            background: #fff;
            border: 1px solid var(--blue-border);
            border-radius: 14px;
            padding: 22px 12px;
            text-align: center;
            transition: .25s
        }

        .benefit-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, .08);
            border-color: #93c5fd
        }

        .benefit-icon {
            font-size: 24px;
            color: var(--blue);
            margin-bottom: 8px
        }

        .benefit-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--ink)
        }

        @media(max-width:991px) {
            .product-main {
                padding: 18px
            }

            .product-gallery {
                position: static
            }

            .product-info {
                padding: 25px 5px 5px
            }

            .product-title {
                font-size: 35px
            }
        }

        @media(max-width:768px) {
            .main-image-wrapper {
                height: 430px
            }

            .gallery-arrow {
                opacity: 1
            }

            .product-title {
                font-size: 30px
            }

            .quick-specs {
                grid-template-columns: 1fr
            }

            .product-tabs {
                overflow-x: auto;
                flex-wrap: nowrap
            }

            .product-tabs .nav-link {
                white-space: nowrap;
                padding: 13px 15px !important
            }

            .tab-content {
                padding: 20px !important
            }
        }

        @media(max-width:576px) {
            .main-image-wrapper {
                height: 320px
            }

            .thumbnail-item {
                width: 65px;
                height: 75px
            }

            .product-title {
                font-size: 26px
            }

            .current-price {
                font-size: 25px
            }

            .product-main {
                border-radius: 15px;
                padding: 12px
            }

            .related-image {
                height: 180px
            }

            .section-heading {
                font-size: 25px
            }
        }
    </style>
    <div class="product-page">
        <div class="container py-4">
            <div class="product-main">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="product-gallery">
                            <div class="main-image-wrapper">
                                <img id="mainProductImage" src="{{ $imageUrls[0] ?? asset('images/placeholder.png') }}"
                                    alt="{{ $product->name }}">
                                @if(count($imageUrls) > 1)
                                    <button class="gallery-arrow prev" onclick="changeImage(-1)" aria-label="Previous image"><i
                                            class="bi bi-chevron-left"></i></button>
                                    <button class="gallery-arrow next" onclick="changeImage(1)" aria-label="Next image"><i
                                            class="bi bi-chevron-right"></i></button>
                                @endif
                                @if($offer)
                                    <span class="product-badge">
                                        @if($offer->discount_type === 'percentage'){{ rtrim(rtrim(number_format($offer->discount_value, 2), '0'), '.') }}%
                                            OFF
                                        @else₹{{ number_format($offer->discount_value, 0) }} OFF
                                        @endif
                                    </span>
                                @elseif($product->is_futured == 2)
                                    <span class="product-badge">Featured</span>
                                @elseif($product->is_futured == 1)
                                    <span class="product-badge">Popular</span>
                                @endif
                            </div>
                            <div class="thumbnail-wrapper d-flex gap-2">
                                @foreach($imageUrls as $index => $img)
                                    <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}"
                                        onclick="setImage({{ $index }})">
                                        <img src="{{ $img }}" alt="Thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-info">
                            <span class="product-category">{{ $product->category->name ?? 'Fine Jewellery' }}</span>
                            <h1 class="product-title">{{ $product->name }}</h1>
                            @if($product->sku)
                            <div class="product-sku">SKU: {{ $product->sku }}</div>@endif
                            <div class="rating-row">
                                <span class="rating-stars">★★★★★</span>
                                <span class="rating-number">4.9</span>
                                <span class="rating-reviews">(120 Reviews)</span>
                            </div>
                            <div class="price-row">
                                <span
                                    class="current-price">₹{{ number_format($product->calculated_selling_price, 0) }}</span>
                                @if($product->has_discount)
                                    <span
                                        class="old-price text-decoration-line-through">₹{{ number_format($product->calculated_original_price, 0) }}</span>
                                    <span class="discount-tag">{{ $product->discount_percent }}% OFF</span>
                                @endif
                            </div>
                            <div class="stock-area">
                                @if($product->stock > 0)
                                    <span class="stock-badge stock-in"><i class="bi bi-check-circle-fill"></i> In Stock
                                        @if($product->stock < 10) — Only {{ $product->stock }} left @endif</span>
                                @else
                                    <span class="stock-badge stock-out"><i class="bi bi-x-circle-fill"></i> Out of Stock</span>
                                @endif
                            </div>
                            @if($product->description)
                                <div class="product-description">{!! $product->description !!}</div>
                            @endif
                            <div class="quick-specs">
                                @if($product->variants)
                                    <div class="spec-item"><span class="spec-label">Material</span><span
                                            class="spec-value">{{ $product->variants }}</span></div>
                                @endif
                                @if($product->brand)
                                    <div class="spec-item"><span class="spec-label">Brand</span><span
                                            class="spec-value">{{ $product->brand->name }}</span></div>
                                @endif
                                @if($product->category)
                                    <div class="spec-item"><span class="spec-label">Category</span><span
                                            class="spec-value">{{ $product->category->name }}</span></div>
                                @endif
                                <div class="spec-item"><span class="spec-label">Shipping</span><span class="spec-value">Free
                                        over ₹999</span></div>
                            </div>
                            <div class="actions">
                                @if($product->stock > 0)
                                    <button class="btn add-to-cart-btn" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ addslashes($product->name) }}"
                                        data-product-price="{{ $product->calculated_selling_price }}"
                                        data-product-slug="{{ $product->slug }}" data-product-image="{{ $imageUrls[0] ?? '' }}"
                                        onclick="addToCartFromCard(this,{{ $product->id }},'{{ addslashes($product->name) }}',{{ $product->calculated_selling_price }},'{{ $product->slug }}','{{ $imageUrls[0] ?? '' }}',{{ $product->calculated_original_price }});"><i
                                            class="bi bi-bag-plus me-2"></i>Add to Cart</button>
                                @else
                                    <button class="btn out-stock-btn" disabled>Out of Stock</button>
                                @endif
                                <button class="btn wishlist-btn" data-product-id="{{ $product->id }}"
                                    data-product-name="{{ addslashes($product->name) }}"
                                    data-product-price="{{ $product->calculated_selling_price }}"
                                    data-product-slug="{{ $product->slug }}" data-product-image="{{ $imageUrls[0] ?? '' }}"
                                    onclick="toggleWishlist(this,{{ $product->id }},'{{ addslashes($product->name) }}',{{ $product->calculated_selling_price }},'{{ $product->slug }}','{{ $imageUrls[0] ?? '' }}',{{ $product->calculated_original_price }});"><i
                                        class="bi bi-heart"></i></button>
                            </div>
                            <div class="view-count"><i class="bi bi-eye me-1"></i><span id="viewCount"></span> people are
                                viewing this item</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="details-section">
                <ul class="nav nav-tabs product-tabs" id="productTabs" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#specs"
                            type="button"><i class="bi bi-file-text me-1"></i>Specifications</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#desc"
                            type="button"><i class="bi bi-list-ul me-1"></i>Description</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping"
                            type="button"><i class="bi bi-truck me-1"></i>Shipping & Returns</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews"
                            type="button"><i class="bi bi-star me-1"></i>Reviews</button></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="specs">
                        @if($product->specification)
                        <div>{!! $product->specification !!}</div>@else<p class="text-muted">No specifications available.
                        </p>@endif
                    </div>
                    <div class="tab-pane fade" id="desc">
                        @if($product->description)
                        <div>{!! $product->description !!}</div>@else<p class="text-muted">No description available.</p>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="shipping">
                        <h5 class="mb-3">Shipping & Returns</h5>
                        <ul class="shipping-list">
                            <li><i class="bi bi-check-circle-fill"></i><strong>Free Shipping</strong> — On all orders across
                                India</li>
                            <li><i class="bi bi-check-circle-fill"></i><strong>Secure Packaging</strong> — Orders are
                                carefully packed</li>
                            <li><i class="bi bi-check-circle-fill"></i><strong>Easy Returns</strong> — 15-day return policy
                            </li>
                            <li><i class="bi bi-check-circle-fill"></i><strong>Estimated Delivery:</strong> 5-7 business
                                days</li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="reviews">
                        <div class="review-summary mb-4">
                            <span class="review-score">4.9</span>
                            <div>
                                <div class="review-stars">★★★★★</div><span class="text-muted small">120 Reviews</span>
                            </div>
                        </div>
                        <div class="review-item mb-3">
                            <div class="d-flex justify-content-between"><strong>Priya S.</strong><span
                                    class="review-stars">★★★★★</span></div>
                            <small class="text-muted">2 weeks ago</small>
                            <p class="mt-2 mb-0">"Absolutely stunning piece! The craftsmanship is exceptional."</p>
                        </div>
                        <div class="review-item mb-3">
                            <div class="d-flex justify-content-between"><strong>Rahul M.</strong><span
                                    class="review-stars">★★★★★</span></div>
                            <small class="text-muted">1 month ago</small>
                            <p class="mt-2 mb-0">"Perfect ring for my engagement! The diamond sparkles beautifully."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($relatedProducts->count() > 0)
            <div class="related-section">
                <h3 class="section-heading"><span>✦</span> You May Also Like</h3>
                <div class="row g-3">
                    @foreach($relatedProducts as $related)
                        <div class="col-6 col-md-3">
                            <div class="card h-100 related-card"
                                onclick="window.location.href='{{ route('product.show', $related->slug) }}'">
                                @php
                                    $relImages = $related->image ? array_map('trim', explode(',', $related->image)) : [];
                                    $relImg = !empty($relImages) ? asset(str_replace('storage/', '', $relImages[0])) : asset('images/placeholder.png');
                                @endphp
                                <img class="related-image" src="{{ $relImg }}" alt="{{ $related->name }}">
                                <div class="related-body">
                                    <div class="related-category">{{ $related->category->name ?? 'Product' }}</div>
                                    <h6 class="related-name">{{ $related->name }}</h6>
                                    <div>
                                        <span
                                            class="related-price">₹{{ number_format($related->selling_price ?? $related->price ?? 0, 0) }}</span>
                                        @if(($related->price ?? 0) > ($related->selling_price ?? 0))
                                            <span class="text-decoration-line-through text-muted ms-1"
                                                style="font-size:11px">₹{{ number_format($related->price ?? 0, 0) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="benefits-section">
            <div class="row g-3">
                <div class="col-md-3 col-6">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="bi bi-shield-check"></i></div>
                        <div class="benefit-title">BIS Hallmarked</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="bi bi-truck"></i></div>
                        <div class="benefit-title">Free Shipping</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="bi bi-arrow-return-left"></i></div>
                        <div class="benefit-title">Easy Returns</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="bi bi-gem"></i></div>
                        <div class="benefit-title">Premium Quality</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        const productImages = @json($imageUrls);
        let currentIndex = 0;
        function setImage(index) {
            if (index < 0 || index >= productImages.length) return;
            currentIndex = index;
            const main = document.getElementById('mainProductImage');
            main.style.opacity = '0';
            setTimeout(() => {
                main.src = productImages[index];
                main.onload = () => main.style.opacity = '1';
            }, 150);
            document.querySelectorAll('.thumbnail-item').forEach((el, i) => el.classList.toggle('active', i === index));
        }
        function changeImage(direction) {
            if (productImages.length <= 1) return;
            setImage((currentIndex + direction + productImages.length) % productImages.length);
        }
        let views = parseInt(localStorage.getItem('productViewCount')) || 12;
        views += Math.floor(Math.random() * 3) + 1;
        document.getElementById('viewCount').textContent = views;
        localStorage.setItem('productViewCount', views);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowLeft') changeImage(-1);
            else if (e.key === 'ArrowRight') changeImage(1);
        });
    </script>
    <script>
        // Add to Cart Function with Page Refresh
        function addToCartFromCard(button, productId, productName, productPrice, productSlug, productImage, originalPrice) {
            event.stopPropagation();

            let cart = getCart();
            const existingIndex = cart.findIndex(item => item.id == productId);

            const originalText = button.innerHTML;
            button.innerHTML = '<i class="bi bi-arrow-repeat" style="font-size:12px;animation:spin 1s linear infinite;"></i> Adding...';
            button.style.opacity = '0.7';
            button.disabled = true;

            setTimeout(() => {
                const sellingPriceValue = Number(productPrice);
                const originalPriceValue = (originalPrice !== null && originalPrice !== undefined) ? Number(originalPrice) : sellingPriceValue;

                if (existingIndex > -1) {
                    cart[existingIndex].quantity = (cart[existingIndex].quantity || 1) + 1;
                    cart[existingIndex].selling_price = sellingPriceValue;
                    cart[existingIndex].price = originalPriceValue;
                } else {
                    cart.push({
                        id: productId,
                        name: productName,
                        selling_price: sellingPriceValue,
                        price: originalPriceValue,
                        slug: productSlug,
                        image: productImage,
                        quantity: 1
                    });
                }

                saveCart(cart);

                // Show toast message
                showToast(existingIndex > -1 ? 'Quantity updated in cart' : 'Added to cart 🛒', 'added');

                // Refresh page after 500ms
                setTimeout(() => {
                    location.reload();
                }, 500);

            }, 400);
        }

        // Get Cart
        function getCart() {
            try {
                const cart = localStorage.getItem('cart');
                return cart ? JSON.parse(cart) : [];
            } catch (e) {
                return [];
            }
        }

        // Save Cart
        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }

        // Update Cart Count
        function updateCartCount() {
            const cart = getCart();
            const totalItems = cart.reduce((sum, item) => sum + (item.quantity || 1), 0);

            const cartCount = document.getElementById('cartCount');
            if (cartCount) cartCount.textContent = totalItems;

            const mobileCartCount = document.getElementById('mobileCartCount');
            if (mobileCartCount) mobileCartCount.textContent = totalItems;
        }

        // Toast Notification
        function showToast(message, type) {
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.style.cssText = 'position:fixed;bottom:20px;right:20px;z-index:99999;display:flex;flex-direction:column;gap:10px;max-width:350px;width:100%;';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            const bgColor = type === 'added' ? '#27ae60' : '#e74c3c';
            toast.style.cssText = 'background:#fff;padding:12px 18px;border-radius:10px;box-shadow:0 4px 20px rgba(0,0,0,0.15);border-left:4px solid ' + bgColor + ';display:flex;align-items:center;gap:12px;animation:slideInRight 0.3s ease;font-size:14px;color:#292725;font-family:sans-serif;';

            const icon = document.createElement('i');
            icon.className = type === 'added' ? 'bi bi-check-circle-fill' : 'bi bi-exclamation-circle';
            icon.style.color = bgColor;
            icon.style.fontSize = '18px';

            const text = document.createElement('span');
            text.textContent = message;

            toast.appendChild(icon);
            toast.appendChild(text);
            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease forwards';
                setTimeout(() => {
                    if (toast.parentNode) toast.parentNode.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Add spin animation for loading
        const style = document.createElement('style');
        style.textContent = '@keyframes spin{to{transform:rotate(360deg)}}@keyframes slideInRight{from{transform:translateX(100%);opacity:0}to{transform:translateX(0);opacity:1}}@keyframes slideOutRight{from{transform:translateX(0);opacity:1}to{transform:translateX(100%);opacity:0}}';
        document.head.appendChild(style);

        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', function () {
            updateCartCount();
        });
    </script>
@endsection