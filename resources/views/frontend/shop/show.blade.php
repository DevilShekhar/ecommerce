<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Lumina Jewellery</title>
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

        .nav-links a:hover {
            color: #b18a45;
        }

        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 30px 60px;
        }

        .breadcrumb {
            margin-bottom: 30px;
            color: #8a7a6a;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #b18a45;
            text-decoration: none;
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            background: #ffffff;
            border-radius: 16px;
            padding: 40px;
            border: 1px solid #e8d9c0;
            margin-bottom: 50px;
        }

        .product-gallery {
            position: relative;
        }

        .product-gallery .main-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 12px;
            background: #f5f0e8;
        }

        .product-gallery .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #b18a45;
            color: white;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .product-gallery .badge.sale {
            background: #c0392b;
        }

        .product-gallery .badge.featured {
            background: #2c3e50;
        }

        .product-info h1 {
            font-size: 30px;
            font-weight: 700;
            color: #2c2416;
            margin-bottom: 8px;
        }

        .product-info .category {
            color: #8a7a6a;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .product-info .price {
            font-size: 28px;
            font-weight: 700;
            color: #2c2416;
            margin-bottom: 15px;
        }

        .product-info .description {
            color: #4a4035;
            line-height: 1.8;
            margin-bottom: 20px;
            border-top: 1px solid #f0e8dc;
            padding-top: 20px;
        }

        .product-info .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }

        .product-info .meta-item {
            background: #faf7f2;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .product-info .meta-item strong {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            color: #8a7a6a;
            letter-spacing: 0.5px;
        }

        .product-info .meta-item span {
            font-size: 14px;
            font-weight: 500;
        }

        .product-info .stock-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .product-info .stock-status.in-stock {
            background: #e8f5e9;
            color: #27ae60;
        }

        .product-info .stock-status.out-of-stock {
            background: #fde8e8;
            color: #c0392b;
        }

        .btn-add-cart {
            width: 100%;
            padding: 14px;
            background: #b18a45;
            color: white;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-add-cart:hover {
            background: #9a7740;
        }

        .btn-add-cart:disabled {
            background: #c5b8a8;
            cursor: not-allowed;
        }

        /* RELATED PRODUCTS */
        .related-section h2 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #2c2416;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 25px;
        }

        .related-card {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e8d9c0;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(177, 138, 69, 0.1);
        }

        .related-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .related-card .info {
            padding: 15px 18px 18px;
        }

        .related-card .info h4 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .related-card .info h4 a {
            color: #2c2416;
            text-decoration: none;
        }

        .related-card .info h4 a:hover {
            color: #b18a45;
        }

        .related-card .info .price {
            font-weight: 700;
            color: #b18a45;
            font-size: 17px;
        }

        .related-card .info .category {
            font-size: 12px;
            color: #8a7a6a;
            text-transform: uppercase;
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

            .product-container {
                padding: 20px 15px 40px;
            }

            .product-detail {
                grid-template-columns: 1fr;
                padding: 20px;
                gap: 30px;
            }

            .product-gallery .main-image {
                height: 300px;
            }

            .product-info h1 {
                font-size: 24px;
            }

            .product-info .price {
                font-size: 24px;
            }

            .product-info .meta-grid {
                grid-template-columns: 1fr;
            }

            .related-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 15px;
            }

            .related-card img {
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            .product-detail {
                padding: 15px;
            }

            .product-gallery .main-image {
                height: 250px;
            }

            .related-grid {
                grid-template-columns: 1fr 1fr;
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
            <a href="/shop">Shop</a>
            <a href="/contact">Contact</a>
        </div>
    </nav>

    <!-- PRODUCT DETAIL -->
    <div class="product-container">

        <div class="breadcrumb">
            <a href="/">Home</a> /
            <a href="/shop">Shop</a> /
            @if($product->category)
                <a href="/shop?category={{ $product->category_id }}">{{ $product->category->name }}</a> /
            @endif
            {{ $product->name }}
        </div>

        <div class="product-detail">
            <div class="product-gallery">
                @php
                    $images = $product->image ? explode(',', $product->image) : [];
                    $firstImage = !empty($images) ? $images[0] : null;
                @endphp
                @if($firstImage)
                    <img src="{{ asset($firstImage) }}" alt="{{ $product->name }}" class="main-image">
                @else
                    <img src="https://via.placeholder.com/600x600/f0e8dc/8a7a6a?text=No+Image" alt="No image" class="main-image">
                @endif

                @if($product->is_featured == 2)
                    <span class="badge featured">Featured</span>
                @elseif($product->is_featured == 1)
                    <span class="badge">Popular</span>
                @endif
            </div>

            <div class="product-info">
                <div class="category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                <h1>{{ $product->name }}</h1>
                <div class="price">₹{{ number_format($product->price, 2) }}</div>

                <div class="stock-status {{ $product->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                    <i class="fas fa-{{ $product->stock > 0 ? 'check-circle' : 'times-circle' }}"></i>
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    @if($product->stock > 0 && $product->stock < 10)
                        (Only {{ $product->stock }} left)
                    @endif
                </div>

                <div class="description">
                    {!! nl2br(e($product->specification ?? $product->description ?? '')) !!}
                </div>

                <div class="meta-grid">
                    <div class="meta-item">
                        <strong>SKU</strong>
                        <span>{{ $product->sku }}</span>
                    </div>
                    @if($product->brand)
                        <div class="meta-item">
                            <strong>Brand</strong>
                            <span>{{ $product->brand->name }}</span>
                        </div>
                    @endif
                    @if($product->subCategory)
                        <div class="meta-item">
                            <strong>Sub Category</strong>
                            <span>{{ $product->subCategory->name }}</span>
                        </div>
                    @endif
                    @if($product->variants)
                        <div class="meta-item">
                            <strong>Material</strong>
                            <span>{{ $product->variants }}</span>
                        </div>
                    @endif
                </div>

                <button class="btn-add-cart" {{ $product->stock < 1 ? 'disabled' : '' }}>
                    <i class="fas fa-shopping-cart"></i>
                    {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                </button>
            </div>
        </div>

        <!-- RELATED PRODUCTS -->
        @if($relatedProducts->isNotEmpty())
            <div class="related-section">
                <h2>You may also like</h2>
                <div class="related-grid">
                    @foreach($relatedProducts as $related)
                        <div class="related-card">
                            @php
                                $relatedImages = $related->image ? explode(',', $related->image) : [];
                                $relatedFirst = !empty($relatedImages) ? $relatedImages[0] : null;
                            @endphp
                            @if($relatedFirst)
                                <img src="{{ asset($relatedFirst) }}" alt="{{ $related->name }}" loading="lazy">
                            @else
                                <img src="https://via.placeholder.com/300x300/f0e8dc/8a7a6a?text=No+Image" alt="No image" loading="lazy">
                            @endif
                            <div class="info">
                                <div class="category">{{ $related->category->name ?? '' }}</div>
                                <h4><a href="{{ route('shop.show', $related->id) }}">{{ $related->name }}</a></h4>
                                <div class="price">₹{{ number_format($related->price, 2) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

</body>

</html>
