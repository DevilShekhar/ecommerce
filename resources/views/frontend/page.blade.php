{{-- =============================================
MASTER LAYOUT: AETHELWEAVE HOMEPAGE
All images now use a uniform aspect ratio (1:1)
with object-fit: cover for perfect sizing.
Fully responsive for all screen types.
============================================= --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aethelweave - Premium Artisan Jewellery</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com">
    </script>
    <!-- Google Fonts: Cormorant Garamond & Plus Jakarta Sans -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
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
    <style>
        /* ============================================= 
    BASE STYLES 
    ============================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FDFBF7;
            color: #2C2A29;
            -webkit-font-smoothing: antialiased;
        }

        /* ============================================= 
    UNIFORM IMAGE CONTAINER — FIXED ASPECT RATIO 1:1 
    ALL images will be cropped to perfect squares. 
    ============================================= */
        .img-square {
            aspect-ratio: 1 / 1;
            width: 100%;
            height: auto;
            object-fit: cover;
            display: block;
            background: #FDFBF7;
        }

        .img-square-placeholder {
            aspect-ratio: 1 / 1;
            width: 100%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FDFBF7;
            color: #D5CFC5;
            font-size: 2.5rem;
        }

        /* ============================================= 
    HERO SECTION 
    ============================================= */
        .hero-section-modern {
            min-height: 80vh;
            display: flex;
            align-items: center;
            background: #2C2A29;
            position: relative;
        }

        .hero-slider-container {
            position: absolute;
            inset: 0;
            overflow: hidden;
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease;
            z-index: 0;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(44, 42, 41, 0.7) 0%, rgba(44, 42, 41, 0.3) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 100px 0;
        }

        .hero-subtitle {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.3em;
            color: #A58B54;
            background: rgba(255, 255, 255, 0.1);
            padding: 6px 20px;
            border-radius: 50px;
            margin-bottom: 20px;
            border: 1px solid rgba(165, 139, 84, 0.3);
        }

        .hero-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 4.5rem;
            font-weight: 500;
            color: #FFFFFF;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .hero-description {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            margin-bottom: 30px;
            max-width: 550px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-description p {
            margin-bottom: 0;
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            background: #A58B54;
            color: #FFFFFF;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-hero:hover {
            background: #8F753D;
            color: #FFFFFF;
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(165, 139, 84, 0.4);
        }

        .btn-hero i {
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .btn-hero:hover i {
            transform: translateX(4px);
        }

        .hero-slider-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 3;
        }

        .hero-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .hero-dot.active {
            background: #A58B54;
            border-color: #FFFFFF;
            transform: scale(1.15);
        }

        .hero-dot:hover {
            background: #A58B54;
        }

        .hero-slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 3;
        }

        .hero-slider-arrow:hover {
            background: #A58B54;
            border-color: #A58B54;
        }

        .hero-slider-arrow.prev {
            left: 20px;
        }

        .hero-slider-arrow.next {
            right: 20px;
        }

        /* ============================================= 
    SECTION HEADERS 
    ============================================= */
        .section-header {
            max-width: 700px;
            margin: 0 auto;
        }

        .section-badge {
            display: inline-block;
            padding: 4px 16px;
            background: #F5EEDC;
            color: #A58B54;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border-radius: 50px;
            margin-bottom: 8px;
        }

        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 500;
            color: #2C2A29;
            margin-bottom: 8px;
        }

        .section-subtitle {
            font-size: 1rem;
            color: #6B6A69;
            margin-bottom: 0;
        }

        .bg-brand-bg {
            background: #FDFBF7;
        }

        /* ============================================= 
    CATEGORY SLIDER 
    ============================================= */
        .category-slider-section {
            background: #FFFFFF;
        }

        .category-slider-wrapper {
            position: relative;
            overflow: hidden;
            padding: 0 40px;
        }

        .category-slider-container {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding: 10px 0;
        }

        .category-slider-container::-webkit-scrollbar {
            display: none;
        }

        .category-slide {
            flex: 0 0 180px;
            min-width: 180px;
        }

        .category-card {
            display: block;
            text-decoration: none;
            background: #FFFFFF;
            border-radius: 16px;
            border: 1px solid #E8E2D2;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(44, 42, 41, 0.08);
            border-color: #A58B54;
        }

        .category-card-image {
            position: relative;
            overflow: hidden;
            background: #FDFBF7;
            aspect-ratio: 1 / 1;
        }

        .category-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .category-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #D5CFC5;
        }

        .category-product-count {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: rgba(44, 42, 41, 0.8);
            backdrop-filter: blur(4px);
            color: #FFFFFF;
            font-size: 0.65rem;
            padding: 2px 10px;
            border-radius: 20px;
        }

        .category-card-body {
            padding: 12px 14px 14px;
        }

        .category-card-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: #2C2A29;
            margin-bottom: 2px;
        }

        .category-card-desc {
            font-size: 0.75rem;
            color: #6B6A69;
            margin-bottom: 0;
        }

        .category-slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #FFFFFF;
            border: 1px solid #E8E2D2;
            color: #2C2A29;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(44, 42, 41, 0.06);
            z-index: 2;
        }

        .category-slider-arrow:hover {
            background: #A58B54;
            color: #FFFFFF;
            border-color: #A58B54;
        }

        .category-slider-arrow.prev {
            left: 0;
        }

        .category-slider-arrow.next {
            right: 0;
        }

        /* ============================================= 
    PRODUCT CARDS — UNIFORM 1:1 IMAGES 
    ============================================= */
        .product-card {
            background: #FFFFFF;
            border-radius: 16px;
            border: 1px solid #E8E2D2;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(44, 42, 41, 0.08);
        }

        .product-image-wrapper {
            position: relative;
            overflow: hidden;
            background: #FDFBF7;
            aspect-ratio: 1 / 1;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-image-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #D5CFC5;
            background: #FDFBF7;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 3px 12px;
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            border-radius: 20px;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .futured-badge {
            background: #A58B54;
        }

        .new-badge {
            background: #2C2A29;
        }

        .stock-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 2px 10px;
            font-size: 0.6rem;
            font-weight: 500;
            border-radius: 20px;
            color: #FFFFFF;
        }

        .stock-badge.in-stock {
            background: #2D7D46;
        }

        .stock-badge.out-of-stock {
            background: #B94A4A;
        }

        .product-body {
            padding: 14px 16px 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-brand {
            font-size: 0.65rem;
            font-weight: 500;
            color: #A58B54;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 2px;
        }

        .product-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.05rem;
            font-weight: 500;
            color: #2C2A29;
            margin-bottom: 4px;
            line-height: 1.3;
        }

        .product-price {
            font-size: 1rem;
            font-weight: 600;
            color: #2C2A29;
            margin-bottom: 10px;
        }

        .product-action {
            margin-top: auto;
        }

        .btn-add-cart {
            width: 100%;
            padding: 8px 16px;
            background: #A58B54;
            color: #FFFFFF;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-add-cart:hover:not(:disabled) {
            background: #8F753D;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(165, 139, 84, 0.3);
        }

        .btn-add-cart:disabled {
            background: #D5CFC5;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .btn-add-cart i {
            font-size: 16px;
        }

        .btn-view-all {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 28px;
            background: transparent;
            color: #A58B54;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: 2px solid #A58B54;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-view-all:hover {
            background: #A58B54;
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(165, 139, 84, 0.3);
        }

        .btn-view-all i {
            transition: transform 0.3s ease;
        }

        .btn-view-all:hover i {
            transform: translateX(4px);
        }

        /* ============================================= 
    COMPACT PRODUCT CARDS (for grids) 
    ============================================= */
        .product-card-compact {
            background: #FFFFFF;
            border-radius: 10px;
            border: 1px solid #E8E2D2;
            overflow: hidden;
            transition: all 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            animation: fadeInScaleCard 0.45s ease both;
        }

        .product-card-compact:nth-child(1) {
            animation-delay: 0.02s;
        }

        .product-card-compact:nth-child(2) {
            animation-delay: 0.06s;
        }

        .product-card-compact:nth-child(3) {
            animation-delay: 0.10s;
        }

        .product-card-compact:nth-child(4) {
            animation-delay: 0.14s;
        }

        .product-card-compact:nth-child(5) {
            animation-delay: 0.18s;
        }

        .product-card-compact:nth-child(6) {
            animation-delay: 0.22s;
        }

        .product-card-compact:nth-child(7) {
            animation-delay: 0.26s;
        }

        .product-card-compact:nth-child(8) {
            animation-delay: 0.30s;
        }

        @keyframes fadeInScaleCard {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(8px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .product-card-compact:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 42, 41, 0.06);
        }

        .product-image-wrapper-compact {
            position: relative;
            overflow: hidden;
            background: #FDFBF7;
            aspect-ratio: 1 / 1;
        }

        .product-image-compact {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .product-card-compact:hover .product-image-compact {
            transform: scale(1.03);
        }

        .product-image-placeholder-compact {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D5CFC5;
            background: #FDFBF7;
            font-size: 2rem;
        }

        .product-badge-compact {
            position: absolute;
            top: 5px;
            left: 5px;
            padding: 2px 6px;
            font-size: 0.5rem;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 12px;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .futured-badge-compact {
            background: #A58B54;
        }

        .new-badge-compact {
            background: #2C2A29;
        }

        .stock-badge-compact {
            position: absolute;
            bottom: 5px;
            right: 5px;
            padding: 1px 6px;
            font-size: 0.5rem;
            font-weight: 600;
            border-radius: 10px;
            color: #FFFFFF;
        }

        .in-stock-compact {
            background: #2D7D46;
        }

        .out-of-stock-compact {
            background: #B94A4A;
        }

        .product-body-compact {
            padding: 8px 10px 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-brand-compact {
            font-size: 0.55rem;
            font-weight: 500;
            color: #A58B54;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 1px;
        }

        .product-title-compact {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.8rem;
            font-weight: 500;
            color: #2C2A29;
            margin-bottom: 2px;
            line-height: 1.2;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price-compact {
            font-size: 0.8rem;
            font-weight: 600;
            color: #2C2A29;
            margin-bottom: 4px;
        }

        .product-action-compact {
            margin-top: auto;
        }

        .btn-add-cart-compact {
            width: 100%;
            padding: 4px 8px;
            background: #A58B54;
            color: #FFFFFF;
            font-size: 0.6rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            border: none;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            transition: all 0.2s ease;
            cursor: pointer;
            min-height: 28px;
        }

        .btn-add-cart-compact:hover:not(:disabled) {
            background: #8F753D;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(165, 139, 84, 0.2);
        }

        .btn-add-cart-compact:disabled {
            background: #D5CFC5;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .btn-add-cart-compact i {
            font-size: 12px;
        }

        .btn-view-all-compact {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 20px;
            background: transparent;
            color: #A58B54;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            border: 1.5px solid #A58B54;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-view-all-compact:hover {
            background: #A58B54;
            color: #FFFFFF;
            transform: translateY(-1px);
            box-shadow: 0 3px 12px rgba(165, 139, 84, 0.2);
        }

        /* ============================================= 
    BANNER CAROUSEL 
    ============================================= */
        .banner-carousel-section {
            background: #FFFFFF;
        }

        .banner-carousel-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
        }

        .banner-carousel-container {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
        }

        .banner-carousel-slide {
            position: relative;
            min-height: 300px;
            background-size: cover;
            background-position: center;
            display: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .banner-carousel-slide.active {
            display: block;
        }

        .banner-carousel-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(44, 42, 41, 0.6) 0%, rgba(44, 42, 41, 0.2) 100%);
        }

        .banner-carousel-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            min-height: 300px;
            padding: 40px 50px;
        }

        .banner-carousel-text {
            max-width: 500px;
            color: #FFFFFF;
        }

        .banner-carousel-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .banner-carousel-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .banner-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 28px;
            background: #A58B54;
            color: #FFFFFF;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .banner-btn:hover {
            background: #8F753D;
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(165, 139, 84, 0.3);
        }

        .banner-btn i {
            transition: transform 0.3s ease;
        }

        .banner-btn:hover i {
            transform: translateX(4px);
        }

        .banner-carousel-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 2;
        }

        .banner-carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .banner-carousel-dot.active {
            background: #A58B54;
            transform: scale(1.2);
        }

        .banner-carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #FFFFFF;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .banner-carousel-arrow:hover {
            background: #A58B54;
            border-color: #A58B54;
        }

        .banner-carousel-arrow.prev {
            left: 16px;
        }

        .banner-carousel-arrow.next {
            right: 16px;
        }

        /* ============================================= 
    ABOUT SECTION 
    ============================================= */
        .about-section-modern {
            background: #FFFFFF;
        }

        .about-image-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 4 / 3;
        }

        .about-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .about-image-badge {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(165, 139, 84, 0.95);
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.1em;
        }

        .about-content {
            padding: 20px 0;
        }

        .about-description {
            font-size: 0.95rem;
            color: #6B6A69;
            line-height: 1.8;
            margin-bottom: 16px;
        }

        .about-features {
            display: flex;
            gap: 20px;
            margin: 20px 0 24px;
            flex-wrap: wrap;
        }

        .about-feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #2C2A29;
        }

        .about-feature-item i {
            color: #A58B54;
            font-size: 20px;
        }

        .btn-about {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 28px;
            background: #A58B54;
            color: #FFFFFF;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-about:hover {
            background: #8F753D;
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(165, 139, 84, 0.3);
        }

        .btn-about i {
            transition: transform 0.3s ease;
        }

        .btn-about:hover i {
            transform: translateX(4px);
        }

        /* ============================================= 
    SERVICES 
    ============================================= */
        .services-section-modern {
            background: #FDFBF7;
        }

        .service-card-modern {
            background: #FFFFFF;
            padding: 30px 24px;
            border-radius: 16px;
            border: 1px solid #E8E2D2;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .service-card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(44, 42, 41, 0.08);
            border-color: #A58B54;
        }

        .service-icon-modern {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            background: #F5EEDC;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #A58B54;
        }

        .service-title-modern {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.3rem;
            font-weight: 500;
            color: #2C2A29;
            margin-bottom: 8px;
        }

        .service-description-modern {
            font-size: 0.9rem;
            color: #6B6A69;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* ============================================= 
    FEATURES 
    ============================================= */
        .features-section-modern {
            background: #FFFFFF;
        }

        .feature-card-modern {
            padding: 24px 16px;
            border-radius: 16px;
            border: 1px solid #E8E2D2;
            transition: all 0.3s ease;
            height: 100%;
            background: #FFFFFF;
        }

        .feature-card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(44, 42, 41, 0.08);
            border-color: #A58B54;
        }

        .feature-icon-modern {
            font-size: 36px;
            color: #A58B54;
            margin-bottom: 12px;
            display: block;
        }

        .feature-title-modern {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: #2C2A29;
            margin-bottom: 6px;
        }

        .feature-description-modern {
            font-size: 0.85rem;
            color: #6B6A69;
            margin-bottom: 0;
            line-height: 1.5;
        }

        /* =============================================
    TESTIMONIALS SECTION
    ============================================= */
        .testimonials-section {
            width: 100%;
            padding: 75px 20px;
            background: #faf8f4;
        }

        .testimonials-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonials-header {
            text-align: center;
            margin-bottom: 45px;
        }

        .testimonials-subtitle {
            display: inline-block;
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #b08d57;
        }

        .testimonials-title {
            margin: 0;
            font-size: 34px;
            line-height: 1.3;
            font-weight: 700;
            color: #222;
        }

        .testimonials-divider {
            width: 55px;
            height: 3px;
            margin: 18px auto 0;
            background: #b08d57;
            border-radius: 20px;
        }

        .testimonials-grid {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
            align-items: stretch;
        }

        .testimonial-image-card {
            position: relative;
            width: 100%;
            height: 420px;
            padding: 0 !important;
            margin: 0;
            overflow: hidden;
            border-radius: 16px;
            background: #222;
            border: 1px solid #e6dccb;
            cursor: pointer;
            box-sizing: border-box;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
        }

        .testimonial-image-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.16);
        }

        .testimonial-person-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: center;
            transition: transform 0.7s ease;
        }

        .testimonial-image-card:hover .testimonial-person-image {
            transform: scale(1.06);
        }

        .testimonial-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.20) 35%, rgba(0, 0, 0, 0.88) 100%);
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .testimonial-image-card:hover .testimonial-overlay {
            opacity: 1;
        }

        .testimonial-hover-content {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 75px;
            z-index: 3;
            padding: 25px 28px;
            opacity: 0;
            transform: translateY(25px);
            transition: opacity 0.35s ease, transform 0.35s ease;
            box-sizing: border-box;
        }

        .testimonial-image-card:hover .testimonial-hover-content {
            opacity: 1;
            transform: translateY(0);
        }

        .testimonial-quote {
            position: absolute;
            top: -5px;
            right: 22px;
            z-index: 0;
            color: #ffffff;
            opacity: 0.18;
        }

        .testimonial-quote i {
            font-size: 55px;
            line-height: 1;
        }

        .testimonial-stars {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 15px;
            color: #d4a74f;
        }

        .testimonial-stars i {
            font-size: 13px;
            line-height: 1;
        }

        .testimonial-hover-content .testimonial-text {
            position: relative;
            z-index: 2;
            margin: 0;
            color: #ffffff;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.75;
            text-align: left;
        }

        .testimonial-image-card .testimonial-author {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 5;
            width: 100%;
            margin: 0 !important;
            padding: 18px 25px;
            box-sizing: border-box;
            border-top: 1px solid rgba(255, 255, 255, 0.20);
            background: rgba(0, 0, 0, 0.30);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
        }

        .testimonial-image-card:not(:hover) .testimonial-author {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.72), rgba(0, 0, 0, 0.15));
            border-top: none;
        }

        .testimonial-image-card:hover .testimonial-author {
            background: rgba(0, 0, 0, 0.35);
        }

        .testimonial-image-card .author-info {
            width: 100%;
        }

        .testimonial-image-card .author-info h4 {
            margin: 0 0 4px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            line-height: 1.3;
        }

        .testimonial-image-card .author-info span {
            display: block;
            color: rgba(255, 255, 255, 0.80);
            font-size: 12px;
            line-height: 1.4;
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #faf4e8;
            border: 1px solid #ead9ba;
            font-size: 20px;
        }

        .author-info h4 {
            margin: 0 0 4px;
            font-size: 15px;
            font-weight: 700;
        }

        .author-info span {
            font-size: 12px;
            opacity: 0.65;
        }

        /* ============================================= 
    CTA 
    ============================================= */
        .cta-section-modern {
            background: #2C2A29;
        }

        .cta-box {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .cta-badge {
            display: inline-block;
            padding: 4px 16px;
            background: rgba(165, 139, 84, 0.2);
            color: #A58B54;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border-radius: 50px;
            margin-bottom: 12px;
            border: 1px solid rgba(165, 139, 84, 0.2);
        }

        .cta-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            font-weight: 500;
            color: #FFFFFF;
            margin-bottom: 8px;
        }

        .cta-description {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 24px;
        }

        .cta-form {
            display: flex;
            justify-content: center;
        }

        .cta-form-group {
            display: flex;
            max-width: 480px;
            width: 100%;
            gap: 8px;
        }

        .cta-input {
            flex: 1;
            padding: 12px 18px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: #FFFFFF;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .cta-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .cta-input:focus {
            outline: none;
            border-color: #A58B54;
            background: rgba(255, 255, 255, 0.15);
        }

        .cta-btn {
            padding: 12px 24px;
            background: #A58B54;
            color: #FFFFFF;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border: none;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .cta-btn:hover {
            background: #8F753D;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(165, 139, 84, 0.3);
        }

        .cta-btn i {
            transition: transform 0.3s ease;
        }

        .cta-btn:hover i {
            transform: translateX(4px);
        }

        .cta-note {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 12px;
        }

        /* ============================================= 
    FAQ SECTION - FIXED 
    ============================================= */
        /* .faq-section-modern {
        background: #FFFFFF;
        padding: 60px 0;
    }

    .faq-image-wrapper-modern {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        aspect-ratio: 4 / 3;
        height: 100%;
        min-height: 400px;
    }

    .faq-image-modern {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .faq-image-overlay-modern {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(44, 42, 41, 0.7) 0%, rgba(44, 42, 41, 0.3) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
        text-align: center;
        color: #FFFFFF;
        flex-direction: column;
    }

    .faq-image-overlay-modern i {
        font-size: 48px;
        color: #A58B54;
        margin-bottom: 12px;
        display: block;
    }

    .faq-image-overlay-modern h4 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        font-weight: 500;
        margin-bottom: 6px;
        color: #FFFFFF;
    }

    .faq-image-overlay-modern p {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0;
        color: rgba(255, 255, 255, 0.9);
    }

    .faq-wrapper-modern {
        height: 100%;
        display: flex;
        align-items: center;
        padding: 0 10px;
    }

    .faq-container-modern {
        width: 100%;
    }

    .faq-item-modern {
        border-bottom: 1px solid #E8E2D2;
        padding: 0;
    }

    .faq-item-modern:last-child {
        border-bottom: none;
    }

    .faq-question-modern {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 0;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-weight: 500;
        color: #2C2A29;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }

    .faq-question-modern:hover {
        color: #A58B54;
    }

    .faq-question-modern span {
        flex: 1;
        padding-right: 15px;
    }

    .faq-icon-modern {
        transition: transform 0.3s ease;
        font-size: 20px;
        color: #A58B54;
        background: #F5EEDC;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #E8E2D2;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .faq-item-modern.active .faq-icon-modern {
        transform: rotate(180deg);
        background: #A58B54;
        color: #FFFFFF;
        border-color: #A58B54;
    }

    .faq-answer-modern {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.3s ease, opacity 0.3s ease;
        opacity: 0;
    }

    .faq-answer-modern.open {
        max-height: 500px;
        padding-bottom: 20px;
        opacity: 1;
    }

    .faq-answer-modern p {
        font-size: 0.95rem;
        color: #6B6A69;
        line-height: 1.7;
        margin-bottom: 0;
    } */

        /* =========================================================
   FAQ SECTION
========================================================= */

        .faq-section-modern {
            position: relative;
            overflow: hidden;
            background: #faf9f6;
            padding-top: 90px !important;
            padding-bottom: 90px !important;
        }


        /* Decorative Background */

        .faq-section-modern::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(165, 139, 84, 0.055);
            top: -220px;
            left: -180px;
            pointer-events: none;
        }

        .faq-section-modern::after {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: rgba(165, 139, 84, 0.045);
            bottom: -200px;
            right: -150px;
            pointer-events: none;
        }


        /* Header */

        .faq-header {
            position: relative;
            z-index: 2;
            max-width: 720px;
            margin: 0 auto 45px;
        }

        .faq-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            color: #a58b54;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .faq-eyebrow::before,
        .faq-eyebrow::after {
            content: "";
            width: 30px;
            height: 1px;
            background: #c9b58d;
        }

        .faq-title {
            margin: 0 0 12px;
            color: #2c2a29;
            font-family: "Cormorant Garamond", serif;
            font-size: clamp(34px, 4vw, 48px);
            font-weight: 500;
            line-height: 1.15;
        }

        .faq-subtitle {
            max-width: 650px;
            margin: 0 auto;
            color: #777472;
            font-size: 15px;
            line-height: 1.8;
        }


        /* FAQ Card */

        .faq-card {
            position: relative;
            z-index: 2;
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #e8e2d8;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(44, 42, 41, 0.07);
        }


        /* FAQ Item */

        .faq-item {
            position: relative;
            border-bottom: 1px solid #eee9e1;
            transition: background 0.35s ease;
        }

        .faq-item:last-child {
            border-bottom: 0;
        }

        .faq-item:hover {
            background: #fdfcf9;
        }

        .faq-item.active {
            background: #fdfbf7;
        }


        /* Question Button */

        .faq-question {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 24px 28px;
            border: 0;
            outline: none;
            background: transparent;
            color: #2c2a29;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .faq-question:focus {
            outline: none;
        }

        .faq-question-left {
            display: flex;
            align-items: center;
            gap: 20px;
            min-width: 0;
        }


        /* Number */

        .faq-number {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            border: 1px solid #ded3c1;
            border-radius: 50%;
            color: #a58b54;
            font-family: "Cormorant Garamond", serif;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.35s ease;
        }

        .faq-item:hover .faq-number,
        .faq-item.active .faq-number {
            background: #a58b54;
            border-color: #a58b54;
            color: #ffffff;
            transform: scale(1.05);
        }


        /* Question Text */

        .faq-question-text {
            font-family: "Cormorant Garamond", serif;
            font-size: 21px;
            font-weight: 500;
            line-height: 1.4;
            transition: color 0.3s ease;
        }

        .faq-item:hover .faq-question-text,
        .faq-item.active .faq-question-text {
            color: #a58b54;
        }


        /* Toggle */

        .faq-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 38px;
            width: 38px;
            height: 38px;
            border: 1px solid #ded3c1;
            border-radius: 50%;
            color: #a58b54;
            transition: all 0.4s ease;
        }

        .faq-toggle i {
            font-size: 13px;
            transition: transform 0.4s ease;
        }

        .faq-item.active .faq-toggle {
            background: #a58b54;
            border-color: #a58b54;
            color: #ffffff;
        }

        .faq-item.active .faq-toggle i {
            transform: rotate(180deg);
        }


        /* Answer */

        .faq-answer {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.45s ease;
        }

        .faq-answer-inner {
            overflow: hidden;
            padding: 0 28px 0 90px;
            color: #777472;
            font-size: 14px;
            line-height: 1.8;
            opacity: 0;
            transform: translateY(-8px);
            transition:
                opacity 0.35s ease,
                transform 0.4s ease,
                padding 0.45s ease;
        }

        .faq-item.active .faq-answer {
            grid-template-rows: 1fr;
        }

        .faq-item.active .faq-answer-inner {
            padding-bottom: 25px;
            opacity: 1;
            transform: translateY(0);
        }


        /* Hover line */

        .faq-item::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 0;
            background: #a58b54;
            transition: height 0.4s ease;
        }

        .faq-item:hover::before,
        .faq-item.active::before {
            height: 100%;
        }


        /* =========================================================
   RESPONSIVE
========================================================= */

        @media (max-width: 767px) {

            .faq-section-modern {
                padding-top: 65px !important;
                padding-bottom: 65px !important;
            }

            .faq-header {
                margin-bottom: 30px;
            }

            .faq-title {
                font-size: 36px;
            }

            .faq-subtitle {
                font-size: 14px;
                line-height: 1.7;
            }

            .faq-card {
                border-radius: 15px;
            }

            .faq-question {
                padding: 19px 17px;
                gap: 12px;
            }

            .faq-question-left {
                gap: 13px;
            }

            .faq-number {
                flex: 0 0 34px;
                width: 34px;
                height: 34px;
                font-size: 13px;
            }

            .faq-question-text {
                font-size: 18px;
            }

            .faq-toggle {
                flex: 0 0 32px;
                width: 32px;
                height: 32px;
            }

            .faq-toggle i {
                font-size: 11px;
            }

            .faq-answer-inner {
                padding-left: 64px;
                padding-right: 20px;
                font-size: 13px;
            }

            .faq-item.active .faq-answer-inner {
                padding-bottom: 20px;
            }
        }

        /* ============================================= 
    FOOTER 
    ============================================= */
        .footer-modern {
            background: #2C2A29;
            padding: 40px 0 20px;
            color: #FFFFFF;
        }

        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5rem;
            font-weight: 500;
            color: #A58B54;
            margin-bottom: 4px;
        }

        .footer-tagline {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.08);
            margin: 16px 0;
        }

        .footer-copy {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: 0.05em;
        }

        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            color: rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 16px;
        }

        .footer-social a:hover {
            background: #A58B54;
            color: #FFFFFF;
            transform: translateY(-2px);
        }

        /* ============================================= 
    WHY CHOOSE US - PREMIUM JEWELLERY DESIGN 
    ============================================= */
        .why-section {
            width: 100%;
            padding: 80px 20px;
            background: #fffdf9;
        }

        .why-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .why-header {
            text-align: center;
            margin-bottom: 45px;
        }

        .why-subtitle {
            display: inline-block;
            margin-bottom: 10px;
            color: #b08d57;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .why-title {
            margin: 0;
            color: #222;
            font-size: 35px;
            font-weight: 700;
            line-height: 1.3;
        }

        .why-divider {
            width: 55px;
            height: 3px;
            margin: 18px auto 0;
            background: #b08d57;
            border-radius: 50px;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            width: 100%;
        }

        .why-card {
            position: relative;
            width: 100%;
            height: 420px;
            overflow: hidden;
            border-radius: 16px;
            background: #222;
            border: 1px solid #e8dfd2;
            cursor: pointer;
            box-sizing: border-box;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .why-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.18);
        }

        .why-card::after {
            content: "";
            position: absolute;
            left: 22px;
            right: 22px;
            bottom: 0;
            height: 3px;
            z-index: 5;
            background: #b08d57;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.4s ease;
        }

        .why-card:hover::after {
            transform: scaleX(1);
        }

        .why-card-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transition: transform 0.7s ease;
        }

        .why-card:hover .why-card-image {
            transform: scale(1.08);
        }

        .why-card-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.18) 30%, rgba(0, 0, 0, 0.88) 100%);
            transition: background 0.4s ease;
        }

        .why-card:hover .why-card-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.18) 0%, rgba(0, 0, 0, 0.45) 40%, rgba(0, 0, 0, 0.95) 100%);
        }

        .why-card-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 22px;
            box-sizing: border-box;
        }

        .why-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .why-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #ffffff;
            background: rgba(176, 141, 87, 0.88);
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            font-size: 20px;
            transition: transform 0.35s ease, background 0.35s ease;
        }

        .why-card:hover .why-icon {
            transform: rotate(-5deg) scale(1.08);
            background: #b08d57;
        }

        .why-card-number {
            color: rgba(255, 255, 255, 0.85);
            font-size: 42px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -1px;
        }

        .why-card-details {
            transform: translateY(30px);
            transition: transform 0.45s ease;
        }

        .why-card:hover .why-card-details {
            transform: translateY(0);
        }

        .why-card-title {
            margin: 0 0 10px;
            color: #ffffff;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
        }

        .why-card-text {
            margin: 0;
            color: rgba(255, 255, 255, 0.86);
            font-size: 13px;
            line-height: 1.7;
            opacity: 0;
            transform: translateY(15px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .why-card:hover .why-card-text {
            opacity: 1;
            transform: translateY(0);
        }

        /* ============================================= 
    RESPONSIVE GRID — PRODUCT COLUMNS 
    ============================================= */
        .product-col-compact {
            padding: 0 5px;
            margin-bottom: 10px;
            flex: 0 0 50%;
            max-width: 50%;
        }

        @media (min-width: 480px) {
            .product-col-compact {
                flex: 0 0 33.333%;
                max-width: 33.333%;
            }
        }

        @media (min-width: 768px) {
            .product-col-compact {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        @media (min-width: 992px) {
            .product-col-compact {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }

        @media (min-width: 1200px) {
            .product-col-compact {
                flex: 0 0 16.666%;
                max-width: 16.666%;
            }
        }

        .product-col {
            padding: 0 8px;
            margin-bottom: 16px;
            flex: 0 0 50%;
            max-width: 50%;
        }

        @media (min-width: 576px) {
            .product-col {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (min-width: 768px) {
            .product-col {
                flex: 0 0 33.333%;
                max-width: 33.333%;
            }
        }

        @media (min-width: 992px) {
            .product-col {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        /* ============================================= 
    RESPONSIVE — TABLET 
    ============================================= */
        @media (max-width: 991px) {
            .hero-title {
                font-size: 3.2rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .testimonials-section {
                padding: 60px 20px;
            }

            .testimonials-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .testimonial-image-card {
                height: 400px;
            }

            .testimonials-title {
                font-size: 30px;
            }

            .why-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .why-card {
                height: 400px;
            }

            .why-title {
                font-size: 30px;
            }

            .col-lg-5,
            .col-lg-7 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }

            .faq-image-wrapper-modern {
                min-height: 400px !important;
                margin-bottom: 30px;
            }

            .faq-image-modern {
                min-height: 400px !important;
            }

            .section-title {
                font-size: 34px !important;
            }
        }

        /* ============================================= 
    RESPONSIVE — MOBILE 
    ============================================= */
        @media (max-width: 767px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-content {
                padding: 60px 0;
            }

            .hero-slider-arrow {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            .hero-slider-arrow.prev {
                left: 8px;
            }

            .hero-slider-arrow.next {
                right: 8px;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .cta-title {
                font-size: 1.8rem;
            }

            .cta-form-group {
                flex-direction: column;
            }

            .cta-btn {
                justify-content: center;
            }

            .about-image-wrapper {
                aspect-ratio: 4 / 3;
            }

            .faq-image-wrapper-modern {
                aspect-ratio: 4 / 3;
                min-height: 300px !important;
            }

            .faq-image-modern {
                min-height: 300px !important;
            }

            .faq-wrapper-modern {
                padding: 0;
            }

            .faq-container-modern {
                padding: 0 10px;
            }

            .faq-question-modern {
                font-size: 1rem;
                padding: 14px 0;
            }

            .faq-icon-modern {
                width: 28px;
                height: 28px;
                font-size: 16px;
            }

            .faq-answer-modern p {
                font-size: 0.9rem;
            }

            .testimonials-section {
                padding: 50px 15px;
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .testimonial-image-card {
                height: 400px;
            }

            .testimonials-title {
                font-size: 27px;
            }

            .testimonial-hover-content {
                padding: 22px;
            }

            .why-section {
                padding: 60px 15px;
            }

            .why-title {
                font-size: 28px;
            }

            .why-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .why-card {
                height: 390px;
            }

            .banner-carousel-slide {
                min-height: 220px;
            }

            .banner-carousel-content {
                padding: 30px 24px;
                min-height: 220px;
            }

            .banner-carousel-title {
                font-size: 1.6rem;
            }

            .category-slide {
                flex: 0 0 140px;
                min-width: 140px;
            }
        }

        /* ============================================= 
    RESPONSIVE — SMALL MOBILE 
    ============================================= */
        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 0.65rem;
            }

            .hero-slider-arrow {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .cta-title {
                font-size: 1.5rem;
            }

            .banner-carousel-slide {
                min-height: 180px;
            }

            .banner-carousel-content {
                padding: 20px 16px;
                min-height: 180px;
            }

            .banner-carousel-title {
                font-size: 1.3rem;
            }

            .banner-carousel-subtitle {
                font-size: 0.85rem;
            }

            .banner-carousel-arrow {
                width: 28px;
                height: 28px;
                font-size: 12px;
            }

            .product-title {
                font-size: 0.9rem;
            }

            .product-price {
                font-size: 0.85rem;
            }

            .btn-add-cart {
                font-size: 0.6rem;
                padding: 6px 12px;
            }

            .category-slide {
                flex: 0 0 120px;
                min-width: 120px;
            }

            .testimonial-image-card {
                height: 370px;
            }

            .testimonials-title {
                font-size: 24px;
            }

            .testimonial-hover-content .testimonial-text {
                font-size: 13px;
                line-height: 1.65;
            }

            .why-title {
                font-size: 24px;
            }

            .why-card {
                height: 370px;
            }

            .why-card-title {
                font-size: 18px;
            }

            .why-card-text {
                font-size: 12.5px;
            }

            .faq-image-wrapper-modern {
                min-height: 250px !important;
            }

            .faq-image-modern {
                min-height: 250px !important;
            }

            .faq-image-overlay-modern i {
                font-size: 36px;
            }

            .faq-image-overlay-modern h4 {
                font-size: 1.2rem;
            }

            .faq-container-modern {
                padding: 5px 15px !important;
            }

            .faq-question-modern {
                font-size: 0.95rem !important;
                padding: 14px 0 !important;
            }

            .faq-answer-modern p {
                font-size: 0.85rem !important;
            }

            .faq-icon-modern {
                width: 26px !important;
                height: 26px !important;
                font-size: 14px !important;
            }
        }

        /* ============================================= 
    RESPONSIVE — TABLET (FAQ) 
    ============================================= */
        @media (max-width: 991px) {

            .col-lg-5,
            .col-lg-7 {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }

            .faq-image-wrapper-modern {
                min-height: 400px !important;
                margin-bottom: 30px;
            }

            .faq-image-modern {
                min-height: 400px !important;
            }

            .section-title {
                font-size: 34px !important;
            }
        }

        /* ============================================= 
    RESPONSIVE — MOBILE (FAQ) 
    ============================================= */
        @media (max-width: 576px) {
            .faq-container-modern {
                padding: 5px 20px !important;
            }

            .faq-question-modern {
                font-size: 17px !important;
                padding: 17px 0 !important;
            }

            .faq-answer-modern p {
                font-size: 13px !important;
            }

            .faq-image-wrapper-modern {
                min-height: 350px !important;
            }

            .faq-image-modern {
                min-height: 350px !important;
            }
        }

        /* ============================================= 
    RESPONSIVE — CATEGORY SLIDER 
    ============================================= */
        @media (max-width: 768px) {
            .category-slide {
                flex: 0 0 140px;
                min-width: 140px;
            }
        }

        @media (max-width: 480px) {
            .category-slide {
                flex: 0 0 120px;
                min-width: 120px;
            }
        }

        /* ============================================= 
    RESPONSIVE — WHY CHOOSE US 
    ============================================= */
        @media (max-width: 1100px) {
            .why-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }

            .why-card {
                height: 400px;
            }
        }

        @media (max-width: 767px) {
            .why-section {
                padding: 60px 15px;
            }

            .why-title {
                font-size: 28px;
            }

            .why-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .why-card {
                height: 390px;
            }
        }

        @media (max-width: 400px) {
            .why-title {
                font-size: 24px;
            }

            .why-card {
                height: 370px;
            }

            .why-card-title {
                font-size: 18px;
            }

            .why-card-text {
                font-size: 12.5px;
            }
        }
    </style>
</head>

<body>

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

    {{-- =============================================
    NEW ARRIVALS — Compact Grid with 1:1 Images
    ============================================= --}}
    @if(isset($newProducts) && $newProducts->count() > 0)
        <section class="products-section-compact py-4 bg-brand-bg" style="background:#FFFFFF;">
            <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">
                <div class="section-header-compact text-center mb-3">
                    <span class="section-badge-compact"
                        style="display:inline-block;padding:2px 12px;background:#F5EEDC;color:#A58B54;font-size:0.6rem;font-weight:600;text-transform:uppercase;letter-spacing:0.12em;border-radius:50px;margin-bottom:4px;">New</span>
                    <h2 class="section-title-compact"
                        style="font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:500;color:#2C2A29;margin-bottom:2px;">
                        New Arrivals</h2>
                    <p class="section-subtitle-compact" style="font-size:0.8rem;color:#6B6A69;margin-bottom:0;">Discover our
                        newest creations</p>
                </div>

                <div class="row" style="display:flex;flex-wrap:wrap;margin:0 -5px;">
                    @foreach($newProducts as $product)
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

                                    <span class="product-badge-compact new-badge-compact">
                                        <i class="bi bi-fire" style="font-size:8px;"></i>
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
    @endif

    {{-- =============================================
    ABOUT SECTION — Home Page (Image Left, Content Right on all screens)
    ============================================= --}}
    @if(isset($aboutUs) && $aboutUs)
        <section class="about-section-home py-4" style="background:#FFFFFF;">
            <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">
                <div style="display:flex;flex-wrap:nowrap;align-items:center;gap:30px;">
                    @if($aboutUs->about_image)
                        {{-- IMAGE - ALWAYS LEFT --}}
                        <div style="flex:0 0 45%;max-width:45%;">
                            <div style="position:relative;border-radius:20px;overflow:hidden;aspect-ratio:4/3;">
                                <img src="{{ asset('storage/' . $aboutUs->about_image) }}"
                                    alt="{{ $aboutUs->about_title ?? 'About Us' }}"
                                    style="width:100%;height:100%;object-fit:cover;display:block;" loading="lazy">
                                <div
                                    style="position:absolute;bottom:20px;left:20px;background:rgba(165,139,84,0.95);color:#FFFFFF;padding:10px 20px;border-radius:12px;font-size:0.8rem;font-weight:600;letter-spacing:0.1em;">
                                    <span>Since 2010</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- CONTENT - ALWAYS RIGHT --}}
                    <div style="flex:1;padding:20px 0;">
                        @if($aboutUs->about_sub_title)
                            <span
                                style="display:inline-block;padding:4px 16px;background:#F5EEDC;color:#A58B54;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.15em;border-radius:50px;margin-bottom:8px;">{{ $aboutUs->about_sub_title }}</span>
                        @endif

                        @if($aboutUs->about_title)
                            <h2
                                style="font-family:'Cormorant Garamond',serif;font-size:2.5rem;font-weight:500;color:#2C2A29;margin-bottom:8px;">
                                {{ $aboutUs->about_title }}
                            </h2>
                        @endif

                        @if($aboutUs->about_description)
                            <div style="font-size:0.95rem;color:#6B6A69;line-height:1.8;margin-bottom:16px;">
                                {{ Str::limit(strip_tags($aboutUs->about_description), 200) }}
                            </div>
                        @endif

                        <a href="{{ route('about-us') }}"
                            style="display:inline-flex;align-items:center;gap:8px;padding:10px 28px;background:#A58B54;color:#FFFFFF;font-size:0.8rem;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;border-radius:50px;text-decoration:none;transition:all 0.3s ease;">
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

        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">

            <div class="section-header text-center mb-4">

                <span class="section-badge">
                    Services
                </span>

                <h2 class="section-title">
                    Our Services
                </h2>

                <p class="section-subtitle">
                    Experience the finest jewellery services tailored just for you
                </p>

            </div>


            <div class="row" style="display:flex;flex-wrap:wrap;margin:0 -12px;">


                <!-- Custom Design -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="
                    padding:0 12px;
                    margin-bottom:24px;
                    flex:0 0 33.333333%;
                    max-width:33.333333%;
                 ">

                    <div class="service-card-modern">

                        <div class="service-icon-modern">
                            <i class="bi bi-gem"></i>
                        </div>

                        <h4 class="service-title-modern">
                            Custom Design
                        </h4>

                        <p class="service-description-modern">
                            Create your dream jewellery piece with our expert
                            designers who bring your vision to life.
                        </p>

                    </div>

                </div>


                <!-- Repair & Restoration -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="
                    padding:0 12px;
                    margin-bottom:24px;
                    flex:0 0 33.333333%;
                    max-width:33.333333%;
                 ">

                    <div class="service-card-modern">

                        <div class="service-icon-modern">
                            <i class="bi bi-tools"></i>
                        </div>

                        <h4 class="service-title-modern">
                            Repair & Restoration
                        </h4>

                        <p class="service-description-modern">
                            Restore your cherished jewellery pieces with our
                            expert repair and restoration services.
                        </p>

                    </div>

                </div>


                <!-- Certification -->
                <div class="col-lg-4 col-md-6 col-sm-12" style="
                    padding:0 12px;
                    margin-bottom:24px;
                    flex:0 0 33.333333%;
                    max-width:33.333333%;
                 ">

                    <div class="service-card-modern">

                        <div class="service-icon-modern">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <h4 class="service-title-modern">
                            Certification
                        </h4>

                        <p class="service-description-modern">
                            Get your jewellery certified with our authentic
                            certification services for peace of mind.
                        </p>

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

                <h2 class="faq-title">
                    Frequently Asked Questions
                </h2>

                <p class="faq-subtitle">
                    Find answers to common questions about our products,
                    jewellery care, shipping and services.
                </p>
            </div>

            {{-- FAQ Content --}}
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <div class="faq-card">

                        {{-- FAQ 1 --}}
                        <div class="faq-item active">
                            <button type="button" class="faq-question" aria-expanded="true">
                                <span class="faq-question-left">
                                    <span class="faq-number">01</span>

                                    <span class="faq-question-text">
                                        What is your return policy?
                                    </span>
                                </span>

                                <span class="faq-toggle">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </button>

                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    We offer a 30-day return policy on all items.
                                    If you're not completely satisfied with your
                                    purchase, you can return it within 30 days of
                                    delivery for a full refund or exchange.
                                    Items must be in their original condition
                                    with all packaging and documentation.
                                </div>
                            </div>
                        </div>


                        {{-- FAQ 2 --}}
                        <div class="faq-item">
                            <button type="button" class="faq-question" aria-expanded="false">
                                <span class="faq-question-left">
                                    <span class="faq-number">02</span>

                                    <span class="faq-question-text">
                                        Do you offer custom design services?
                                    </span>
                                </span>

                                <span class="faq-toggle">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </button>

                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    Yes, we specialize in custom jewellery design.
                                    Our expert designers work closely with you to
                                    create a unique piece that reflects your
                                    personal style. From concept to creation,
                                    we'll guide you through every step.
                                </div>
                            </div>
                        </div>


                        {{-- FAQ 3 --}}
                        <div class="faq-item">
                            <button type="button" class="faq-question" aria-expanded="false">
                                <span class="faq-question-left">
                                    <span class="faq-number">03</span>

                                    <span class="faq-question-text">
                                        How do I care for my jewellery?
                                    </span>
                                </span>

                                <span class="faq-toggle">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </button>

                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    To keep your jewellery looking its best,
                                    clean it regularly with a soft cloth and mild
                                    soap solution. Avoid exposing it to harsh
                                    chemicals, perfumes or lotions. Store each
                                    piece separately in a soft pouch or jewellery
                                    box to prevent scratches.
                                </div>
                            </div>
                        </div>


                        {{-- FAQ 4 --}}
                        <div class="faq-item">
                            <button type="button" class="faq-question" aria-expanded="false">
                                <span class="faq-question-left">
                                    <span class="faq-number">04</span>

                                    <span class="faq-question-text">
                                        How long does shipping take?
                                    </span>
                                </span>

                                <span class="faq-toggle">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </button>

                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    Standard shipping within India typically
                                    takes 5–7 business days. International shipping
                                    generally takes 10–14 business days. All orders
                                    are shipped with tracking for your peace of mind.
                                </div>
                            </div>
                        </div>


                        {{-- FAQ 5 --}}
                        <div class="faq-item">
                            <button type="button" class="faq-question" aria-expanded="false">
                                <span class="faq-question-left">
                                    <span class="faq-number">05</span>

                                    <span class="faq-question-text">
                                        Are your jewellery pieces certified?
                                    </span>
                                </span>

                                <span class="faq-toggle">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                            </button>

                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    Selected jewellery pieces come with applicable
                                    authenticity and certification documentation.
                                    Product-specific certification details are
                                    provided on the respective product page.
                                </div>
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
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">
            <div class="cta-box text-center" style="max-width:600px;margin:0 auto;padding:20px 0;">
                <span class="cta-badge"
                    style="display:inline-block;padding:4px 16px;background:rgba(165,139,84,0.2);color:#A58B54;font-size:0.7rem;font-weight:600;text-transform:uppercase;letter-spacing:0.15em;border-radius:50px;margin-bottom:12px;border:1px solid rgba(165,139,84,0.2);">Exclusive
                    Offer</span>
                <h2 class="cta-title"
                    style="font-family:'Cormorant Garamond',serif;font-size:2.5rem;font-weight:500;color:#FFFFFF;margin-bottom:8px;">
                    Subscribe to Our Newsletter</h2>
                <p class="cta-description" style="font-size:1rem;color:rgba(255,255,255,0.7);margin-bottom:24px;">Be the
                    first to know about new arrivals, exclusive collections, and special
                    offers.</p>
                <form class="cta-form" id="newsletterForm" style="display:flex;justify-content:center;">
                    <div class="cta-form-group" style="display:flex;max-width:480px;width:100%;gap:8px;">
                        <input type="email" class="cta-input" placeholder="Enter your email address" required
                            style="flex:1;padding:12px 18px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);border-radius:50px;color:#FFFFFF;font-size:0.9rem;transition:all 0.3s ease;font-family:'Plus Jakarta Sans',sans-serif;">
                        <button type="submit" class="cta-btn"
                            style="padding:12px 24px;background:#A58B54;color:#FFFFFF;font-size:0.8rem;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;border:none;border-radius:50px;display:inline-flex;align-items:center;gap:8px;cursor:pointer;transition:all 0.3s ease;white-space:nowrap;font-family:'Plus Jakarta Sans',sans-serif;">Subscribe
                            <i class="bi bi-arrow-right"></i></button>
                    </div>
                </form>
                <p class="cta-note" style="font-size:0.7rem;color:rgba(255,255,255,0.4);margin-top:12px;">We respect
                    your privacy. Unsubscribe at any time.</p>
            </div>
        </div>
    </section>

    {{-- =============================================
    FOOTER
    ============================================= --}}
    <footer class="footer-modern" style="background:#2C2A29;padding:40px 0 20px;color:#FFFFFF;">
        <div class="container" style="max-width:1200px;margin:0 auto;padding:0 15px;width:100%;">
            <div class="row" style="display:flex;flex-wrap:wrap;margin:0 -15px;align-items:center;">
                <div class="col-md-6"
                    style="padding:0 15px;flex:0 0 100%;max-width:100%;text-align:center;margin-bottom:16px;">
                    <div class="footer-brand"
                        style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-weight:500;color:#A58B54;margin-bottom:4px;">
                        Aethelweave</div>
                    <p class="footer-tagline"
                        style="font-size:0.75rem;color:rgba(255,255,255,0.5);letter-spacing:0.2em;text-transform:uppercase;">
                        Artisan Jewellery · Since 2010</p>
                </div>
                <div class="col-md-6" style="padding:0 15px;flex:0 0 100%;max-width:100%;text-align:center;">
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook"
                            style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.5);transition:all 0.3s ease;text-decoration:none;font-size:16px;"><i
                                class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Instagram"
                            style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.5);transition:all 0.3s ease;text-decoration:none;font-size:16px;"><i
                                class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="YouTube"
                            style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.5);transition:all 0.3s ease;text-decoration:none;font-size:16px;"><i
                                class="bi bi-youtube"></i></a>
                        <a href="#" aria-label="Pinterest"
                            style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.5);transition:all 0.3s ease;text-decoration:none;font-size:16px;"><i
                                class="bi bi-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <hr class="footer-divider" style="border-color:rgba(255,255,255,0.08);margin:16px 0;">
            <div class="text-center">
                <p class="footer-copy" style="font-size:0.7rem;color:rgba(255,255,255,0.3);letter-spacing:0.05em;">
                    &copy; 2026 Aethelweave. All rights reserved.</p>
            </div>
        </div>
    </footer>

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

            // =============================================
            // CATEGORY SLIDER
            // =============================================
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

            // =============================================
            // FAQ ACCORDION
            // =============================================
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

            // =============================================
            // ADD TO CART BUTTONS
            // =============================================
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const productId = this.dataset.productId;
                    alert('Product ID ' + productId + ' added to cart! (Demo)');
                });
            });

            // =============================================
            // NEWSLETTER FORM
            // =============================================
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

</body>

</html>