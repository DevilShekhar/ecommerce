@extends('frontend.layouts.customer-layout')

@section('title', 'My Wishlist - ShopEase')

@section('styles')
    <style>
        .wishlist-page {
            padding: 10px 0 30px;
        }

        /* Page Header */
        .wishlist-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .wishlist-title-area {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .wishlist-title-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #1d2b44;
        }

        .wishlist-title-area h2 {
            font-size: 25px;
            font-weight: 700;
            color: #1d2b44;
            margin: 0 0 5px;
        }

        .wishlist-title-area p {
            margin: 0;
            color: #64748b;
            font-size: 15px;
        }

        .wishlist-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .wishlist-action-btn {
            min-height: 44px;
            padding: 0 20px;
            border: 1px solid #dbe2ea;
            border-radius: 6px;
            background: #fff;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            transition: all .25s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .wishlist-action-btn:hover {
            border-color: #1d3557;
            color: #1d3557;
            background: #f8fafc;
        }

        .wishlist-action-btn.primary {
            background: #142b4a;
            border-color: #142b4a;
            color: #fff;
            min-width: 145px;
        }

        .wishlist-action-btn.primary:hover {
            background: #0d2039;
            border-color: #0d2039;
            color: #fff;
        }


        /* ==========================================
                                                                           WISHLIST PRODUCT GRID
                                                                        ========================================== */

        .wishlist-products-row {
            margin-bottom: 28px;
        }

        .wishlist-product-card {
            background: #fff;
            border: 1px solid #e9edf2;
            border-radius: 14px;
            padding: 20px;
            height: auto !important;
            min-height: 290px;
            display: flex;
            gap: 24px;
            transition: all .25s ease;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
        }

        .wishlist-product-card:hover {
            box-shadow: 0 12px 30px rgba(15, 23, 42, .09);
            transform: translateY(-3px);
        }

        /* Product Image */
        .wishlist-product-image {
            width: 220px;
            min-width: 220px;
            height: 250px;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            background: #f8fafc;
        }

        .wishlist-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .wishlist-no-image {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 50px;
        }

        .heart-display {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1d2b44;
            font-size: 21px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .10);
            cursor: pointer;
            transition: all .2s ease;
            z-index: 3;
        }

        .heart-display:hover {
            color: #e11d48;
            transform: scale(1.06);
        }

        /* Product Badges */
        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 50px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 6;
            display: flex;
            align-items: center;
            gap: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            animation: pulseBadge 2s infinite;
        }

        @keyframes pulseBadge {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .futured-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .new-badge {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .stock-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 50px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            z-index: 5;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .stock-badge.in-stock {
            background: #22c55e;
        }

        .stock-badge.out-of-stock {
            background: #ef4444;
        }

        .category-badge {
            position: absolute;
            bottom: 10px;
            left: 10px;
            font-size: 9px;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 50px;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            backdrop-filter: blur(4px);
            z-index: 5;
            max-width: 80%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Product Details */
        .wishlist-product-details {
            flex: 1;
            min-width: 0;
            padding: 2px 0;
            display: flex;
            flex-direction: column;
        }

        .product-category {
            color: #b8862d;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .wishlist-product-name {
            color: #1d2b44;
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .wishlist-rating {
            display: flex;
            align-items: center;
            gap: 3px;
            margin-bottom: 14px;
        }

        .wishlist-rating .stars {
            color: #d69e2e;
            font-size: 14px;
        }

        .wishlist-rating .review-count {
            margin-left: 7px;
            color: #64748b;
            font-size: 13px;
        }

        .wishlist-price {
            color: #1d2b44;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .wishlist-features {
            list-style: none;
            padding: 0;
            margin: 0 0 18px;
        }

        .wishlist-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #526174;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .wishlist-features li i {
            color: #526174;
            width: 16px;
        }

        .wishlist-product-buttons {
            display: flex;
            gap: 12px;
            margin-top: auto;
        }

        .btn-remove-wishlist,
        .btn-wishlist-cart {
            height: 44px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all .25s ease;
        }

        .btn-remove-wishlist {
            background: #fff;
            border: 1px solid #d8dee7;
            color: #334155;
            min-width: 140px;
        }

        .btn-remove-wishlist:hover {
            background: #fff5f5;
            color: #dc2626;
            border-color: #fecaca;
        }

        .btn-wishlist-cart {
            flex: 1;
            background: #142b4a;
            border: 1px solid #142b4a;
            color: #fff;
        }

        .btn-wishlist-cart:hover {
            background: #0d2039;
            border-color: #0d2039;
            color: #fff;
        }

        .btn-wishlist-cart:disabled {
            background: #94a3b8;
            border-color: #94a3b8;
            cursor: not-allowed;
            opacity: .7;
        }

        .btn-wishlist-cart.btn-futured {
            background: linear-gradient(135deg, #92400e, #78350f) !important;
            border-color: #78350f !important;
            color: #fbbf24 !important;
        }

        .btn-wishlist-cart.btn-futured i {
            color: #fbbf24;
        }

        /* ==========================================
                                                                           RECOMMENDED SECTION
                                                                        ========================================== */

        .recommended-section {
            background: #fff;
            border: 1px solid #e9edf2;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, .04);
        }

        .recommended-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .recommended-title {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .recommended-title .recommend-icon {
            color: #c69231;
            font-size: 24px;
            line-height: 1;
        }

        .recommended-title h4 {
            color: #1d2b44;
            font-size: 19px;
            font-weight: 700;
            margin: 0 0 3px;
        }

        .recommended-title p {
            margin: 0;
            color: #64748b;
            font-size: 12px;
        }

        .recommended-view-all {
            color: #1d2b44;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .recommended-view-all:hover {
            color: #b8862d;
        }


        /* Recommended Product Card */
        .rec-product-card {
            background: #fff;
            border: 1px solid #e8edf3;
            border-radius: 10px;
            overflow: hidden;
            height: 100%;
            transition: all .25s ease;
            position: relative;
        }

        .rec-product-card:hover {
            box-shadow: 0 10px 24px rgba(15, 23, 42, .10);
            transform: translateY(-4px);
        }

        .rec-product-img {
            height: 190px;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .rec-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .rec-heart {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .95);
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 18px;
            cursor: pointer;
            transition: .2s ease;
            z-index: 5;
        }

        .rec-heart:hover,
        .rec-heart.active {
            color: #e11d48;
        }

        .rec-product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 9px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 50px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            animation: pulseBadge 2s infinite;
        }

        .rec-product-badge.futured-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .rec-product-badge.new-badge {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .rec-stock-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 8px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 50px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            z-index: 5;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .rec-stock-badge.in-stock {
            background: #22c55e;
        }

        .rec-stock-badge.out-of-stock {
            background: #ef4444;
        }

        .rec-product-info {
            padding: 14px;
        }

        .rec-category {
            color: #b8862d;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .rec-product-info h6 {
            color: #1d2b44;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 7px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rec-price {
            color: #1d2b44;
            font-size: 16px;
            font-weight: 700;
        }

        .rec-rating {
            color: #d69e2e;
            font-size: 12px;
            margin-top: 8px;
        }

        .rec-rating span {
            color: #64748b;
            margin-left: 5px;
        }

        .rec-add-cart {
            width: 100%;
            margin-top: 14px;
            height: 40px;
            background: #fff;
            color: #1d2b44;
            border: 1px solid #d8dee7;
            border-radius: 5px;
            font-size: 13px;
            font-weight: 600;
            transition: all .25s ease;
            cursor: pointer;
        }

        .rec-add-cart:hover:not(:disabled) {
            background: #142b4a;
            border-color: #142b4a;
            color: #fff;
        }

        .rec-add-cart:disabled {
            background: #94a3b8;
            border-color: #94a3b8;
            color: #fff;
            cursor: not-allowed;
            opacity: .7;
        }

        .rec-add-cart.btn-futured {
            background: linear-gradient(135deg, #92400e, #78350f) !important;
            border-color: #78350f !important;
            color: #fbbf24 !important;
        }

        .rec-add-cart.btn-futured i {
            color: #fbbf24;
        }


        /* Empty State */
        .empty-products {
            text-align: center;
            padding: 70px 20px;
            background: #fff;
            border: 1px solid #e9edf2;
            border-radius: 14px;
            margin-bottom: 10px;
        }

        .empty-products i {
            font-size: 60px;
            color: #cbd5e1;
            display: block;
            margin-bottom: 15px;
        }

        .empty-products h4 {
            color: #1d2b44;
            font-weight: 700;
        }

        .empty-products p {
            color: #64748b;
        }


        /* Responsive */
        @media (max-width: 1199px) {
            .wishlist-product-image {
                width: 180px;
                min-width: 180px;
                height: 220px;
            }
        }

        @media (max-width: 991px) {
            .wishlist-top {
                flex-direction: column;
            }

            .wishlist-actions {
                width: 100%;
            }
        }

        @media (max-width: 767px) {
            .wishlist-product-card {
                flex-direction: column;
            }

            .wishlist-product-image {
                width: 100%;
                min-width: 100%;
                height: 260px;
            }

            .wishlist-actions {
                gap: 8px;
            }

            .wishlist-action-btn {
                padding: 0 14px;
            }

            .wishlist-product-buttons {
                flex-direction: column;
            }

            .btn-remove-wishlist {
                width: 100%;
            }

            .rec-product-img {
                height: 210px;
            }
        }

        @media (max-width: 575px) {
            .wishlist-title-area h2 {
                font-size: 21px;
            }

            .wishlist-actions {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .wishlist-action-btn.primary {
                grid-column: span 2;
            }

            .recommended-header {
                align-items: flex-start;
                gap: 15px;
            }
        }

        /* ==========================================
                                                   RIGHT SIDE SIDEBAR TOASTER
                                                ========================================== */

        .sidebar-toast-container {
            position: fixed;
            top: 90px;
            right: 0;
            width: 380px;
            max-width: calc(100vw - 30px);
            z-index: 99999;
            pointer-events: none;
        }

        .sidebar-toast {
            width: 100%;
            background: #fff;
            border-radius: 10px 0 0 10px;
            box-shadow: 0 12px 35px rgba(15, 23, 42, .18);
            margin-bottom: 12px;
            overflow: hidden;
            transform: translateX(110%);
            opacity: 0;
            pointer-events: auto;
            transition: transform .45s ease, opacity .45s ease;
            border-left: 5px solid #22c55e;
        }

        .sidebar-toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .sidebar-toast.hide {
            transform: translateX(110%);
            opacity: 0;
        }

        .sidebar-toast.success {
            border-left-color: #22c55e;
        }

        .sidebar-toast.error {
            border-left-color: #ef4444;
        }

        .sidebar-toast.warning {
            border-left-color: #f59e0b;
        }

        .sidebar-toast.info {
            border-left-color: #2878f0;
        }

        .sidebar-toast-content {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 16px 18px;
        }

        .sidebar-toast-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .sidebar-toast.success .sidebar-toast-icon {
            background: #dcfce7;
            color: #16a34a;
        }

        .sidebar-toast.error .sidebar-toast-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .sidebar-toast.warning .sidebar-toast-icon {
            background: #fef3c7;
            color: #d97706;
        }

        .sidebar-toast.info .sidebar-toast-icon {
            background: #dbeafe;
            color: #2563eb;
        }

        .sidebar-toast-body {
            flex: 1;
            min-width: 0;
        }

        .sidebar-toast-title {
            font-size: 14px;
            font-weight: 700;
            color: #1d2b44;
            margin-bottom: 4px;
        }

        .sidebar-toast-message {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        .sidebar-toast-close {
            border: 0;
            background: transparent;
            color: #94a3b8;
            padding: 0;
            font-size: 18px;
            cursor: pointer;
            line-height: 1;
        }

        .sidebar-toast-close:hover {
            color: #1d2b44;
        }

        .sidebar-toast-progress {
            height: 3px;
            width: 100%;
            transform-origin: left;
            animation: toastProgress 5s linear forwards;
        }

        .sidebar-toast.success .sidebar-toast-progress {
            background: #22c55e;
        }

        .sidebar-toast.error .sidebar-toast-progress {
            background: #ef4444;
        }

        .sidebar-toast.warning .sidebar-toast-progress {
            background: #f59e0b;
        }

        .sidebar-toast.info .sidebar-toast-progress {
            background: #2878f0;
        }

        @keyframes toastProgress {
            from {
                transform: scaleX(1);
            }

            to {
                transform: scaleX(0);
            }
        }

        @media (max-width: 575px) {
            .sidebar-toast-container {
                top: 75px;
                width: calc(100vw - 15px);
            }

            .sidebar-toast {
                border-radius: 8px 0 0 8px;
            }
        }

        /* ==========================================
                               PRODUCT DETAILS MODAL
                            ========================================== */

        .product-details-modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 60px rgba(15, 23, 42, .18);
        }

        .product-modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #1d2b44;
            z-index: 20;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .25s ease;
        }

        .product-modal-close:hover {
            background: #142b4a;
            color: #fff;
            transform: rotate(90deg);
        }

        .product-modal-loader {
            min-height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-modal-image-wrap {
            height: 100%;
            min-height: 480px;
            background: #f8fafc;
            padding: 20px;
        }

        .product-modal-image-wrap img {
            width: 100%;
            height: 100%;
            min-height: 440px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-modal-details {
            padding: 38px 32px 32px;
            height: 100%;
        }

        .product-modal-category {
            color: #b8862d;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 10px;
        }

        .product-modal-details h3 {
            color: #1d2b44;
            font-size: 25px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 12px;
        }

        .product-modal-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .product-modal-rating .stars {
            color: #d69e2e;
        }

        .product-modal-price {
            font-size: 28px;
            font-weight: 700;
            color: #1d2b44;
            margin-bottom: 18px;
        }

        .product-modal-description {
            color: #64748b;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 22px;
        }

        .product-modal-info {
            border-top: 1px solid #e9edf2;
            border-bottom: 1px solid #e9edf2;
            padding: 15px 0;
            margin-bottom: 22px;
        }

        .product-modal-info div {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 7px 0;
        }

        .product-modal-info span {
            color: #64748b;
            font-size: 13px;
        }

        .product-modal-info strong {
            color: #1d2b44;
            font-size: 13px;
        }

        .product-modal-action form {
            width: 100%;
        }

        .product-modal-add-cart,
        .product-modal-notify {
            width: 100%;
            height: 48px;
            border-radius: 7px;
            border: 0;
            font-size: 15px;
            font-weight: 600;
            transition: .25s ease;
        }

        .product-modal-add-cart {
            background: #142b4a;
            color: #fff;
        }

        .product-modal-add-cart:hover {
            background: #0d2039;
        }

        .product-modal-notify {
            background: linear-gradient(135deg, #92400e, #78350f);
            color: #fbbf24;
        }

        @media (max-width: 767px) {

            .product-modal-image-wrap {
                min-height: 300px;
            }

            .product-modal-image-wrap img {
                min-height: 260px;
            }

            .product-modal-details {
                padding: 28px 22px;
            }
        }

        .offer-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ef4444;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 9px;
            border-radius: 4px;
            z-index: 6;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .offer-badge.fixed {
            background: #f59e0b;
        }
    </style>
@endsection

@section('content')

    <div class="wishlist-page">
        <div class="wishlist-top">

            <div class="wishlist-title-area">
                <div class="wishlist-title-icon">
                    <i class="bi bi-heart"></i>
                </div>

                <div>
                    <h2>My Wishlist</h2>
                    <p>{{ $wishlistCount ?? 0 }} products saved for later</p>
                </div>
            </div>

            <div class="wishlist-actions">

                <button type="button" class="wishlist-action-btn">
                    <i class="bi bi-share"></i>
                    Share Wishlist
                </button>

                <button type="button" class="wishlist-action-btn" onclick="clearWishlist()">
                    <i class="bi bi-trash"></i>
                    Clear Wishlist
                </button>

            </div>
        </div>


        <!-- ======================================
                    WISHLIST PRODUCTS
            ======================================= -->
        @if(isset($wishlistProducts) && $wishlistProducts->count() > 0)

            <div class="row g-4 wishlist-products-row">

                @foreach($wishlistProducts as $wishlist)

                    @php
                        $product = $wishlist->product;

                        if ($product) {

                            /*
                             * PRODUCT IMAGE
                             */
                            $images = $product->image
                                ? array_map('trim', explode(',', $product->image))
                                : [];

                            $firstImage = $images[0] ?? null;

                            if ($firstImage) {
                                $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                $imgUrl = asset($firstImage);
                            } else {
                                $imgUrl = null;
                            }


                            /*
                             * PRODUCT STATUS
                             */
                            $isFutured = isset($product->is_futured) && $product->is_futured == 1;
                            $isNew = isset($product->is_futured) && $product->is_futured == 2;

                            $isOutOfStock = $product->stock !== null && $product->stock <= 0;

                            $isLowStock = $product->stock !== null
                                && $product->stock > 0
                                && $product->stock <= 5;


                            /*
                             * ACTIVE OFFER
                             */
                            $activeOffer = $product->active_offer ?? null;

                            $originalPrice = $product->price ?? 0;
                            $discountedPrice = $originalPrice;

                            if ($activeOffer) {

                                if ($activeOffer->discount_type === 'percentage') {

                                    $discountedPrice = $originalPrice -
                                        ($originalPrice * $activeOffer->discount_value / 100);

                                } else {

                                    $discountedPrice = max(
                                        0,
                                        $originalPrice - $activeOffer->discount_value
                                    );

                                }

                            }
                        }
                    @endphp


                    @if($product)

                        <div class="col-xl-6">

                            <div class="wishlist-product-card product-details-trigger" data-product-id="{{ $product->id }}"
                                style="cursor: pointer;">


                                <!-- =========================
                                                             PRODUCT IMAGE
                                                        ========================== -->
                                <div class="wishlist-product-image">

                                    @if($imgUrl)

                                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                            onerror="this.src='{{ asset('images/placeholder.png') }}'">

                                    @else

                                        <div class="wishlist-no-image">
                                            <i class="bi bi-image"></i>
                                        </div>

                                    @endif


                                    <!-- =========================
                                                                 OFFER / PRODUCT BADGE
                                                            ========================== -->

                                    @if($activeOffer)

                                        <span class="product-badge offer-badge">

                                            @if($activeOffer->discount_type === 'percentage')

                                                {{ rtrim(rtrim(number_format($activeOffer->discount_value, 2), '0'), '.') }}% OFF

                                            @else

                                                ₹{{ number_format($activeOffer->discount_value, 0) }} OFF

                                            @endif

                                        </span>

                                    @elseif($isFutured)

                                        <span class="product-badge futured-badge">
                                            <i class="bi bi-star-fill"></i>
                                            Futured
                                        </span>

                                    @elseif($isNew)

                                        <span class="product-badge new-badge">
                                            <i class="bi bi-fire"></i>
                                            New
                                        </span>

                                    @endif


                                    <!-- =========================
                                                                 STOCK BADGE
                                                            ========================== -->

                                    @if($product->stock !== null)

                                        <span class="stock-badge {{ $isOutOfStock ? 'out-of-stock' : 'in-stock' }}">
                                            {{ $isOutOfStock ? 'Out of Stock' : 'In Stock' }}
                                        </span>

                                    @endif


                                    <!-- =========================
                                                                 CATEGORY BADGE
                                                            ========================== -->

                                    @if($product->category)

                                        <span class="category-badge">
                                            {{ $product->category->name }}
                                        </span>

                                    @endif


                                    <!-- =========================
                                                                 WISHLIST BUTTON
                                                            ========================== -->

                                    <button class="heart-display" data-product-id="{{ $product->id }}"
                                        onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist(this)">

                                        <i class="bi bi-heart-fill"></i>

                                    </button>

                                </div>



                                <!-- =========================
                                                             PRODUCT DETAILS
                                                        ========================== -->

                                <div class="wishlist-product-details">


                                    <!-- Category -->
                                    <div class="product-category">
                                        {{ $product->category->name ?? 'Jewellery' }}
                                    </div>


                                    <!-- Product Name -->
                                    <div class="wishlist-product-name">
                                        {{ $product->name }}
                                    </div>


                                    <!-- Rating -->
                                    <div class="wishlist-rating">

                                        <div class="stars">

                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>

                                        </div>

                                        <span class="review-count">
                                            (128)
                                        </span>

                                    </div>


                                    <!-- =========================
                                                                 PRICE
                                                            ========================== -->

                                    <div class="wishlist-price">

                                        @if($activeOffer)

                                            <span style="color:#ef4444; font-weight:700;">
                                                ₹{{ number_format($discountedPrice, 0) }}
                                            </span>

                                            <span style="
                                                                                font-size:13px;
                                                                                color:#94a3b8;
                                                                                text-decoration:line-through;
                                                                                margin-left:6px;
                                                                            ">
                                                ₹{{ number_format($originalPrice, 0) }}
                                            </span>

                                        @else

                                            ₹{{ number_format($originalPrice, 0) }}

                                        @endif

                                    </div>


                                    <!-- =========================
                                                                 PRODUCT FEATURES
                                                            ========================== -->

                                    <ul class="wishlist-features">

                                        <li>
                                            <i class="bi bi-gem"></i>
                                            Premium Quality Product
                                        </li>

                                        <li>
                                            <i class="bi bi-shield-check"></i>
                                            Quality Guaranteed
                                        </li>

                                        <li>
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            Easy 7-Day Returns
                                        </li>

                                    </ul>


                                    <!-- =========================
                                                                 ACTION BUTTONS
                                                            ========================== -->

                                    <div class="wishlist-product-buttons">

                                        @if($isFutured)

                                            <button type="button" class="btn btn-wishlist-cart btn-futured w-100"
                                                onclick="event.preventDefault(); event.stopPropagation(); notifyMe({{ $product->id }})">

                                                <i class="bi bi-bell"></i>
                                                Notify Me

                                            </button>


                                        @elseif($isOutOfStock)

                                            <button type="button" class="btn btn-wishlist-cart w-100" disabled>

                                                <i class="bi bi-x-circle"></i>
                                                Out of Stock

                                            </button>


                                        @else

                                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1"
                                                onclick="event.stopPropagation();">

                                                @csrf

                                                <button type="submit" class="btn btn-wishlist-cart w-100">

                                                    <i class="bi bi-cart3"></i>
                                                    Add to Cart

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>


        @else

            <!-- =========================
                         EMPTY WISHLIST
                    ========================== -->

            <div class="empty-products">

                <i class="bi bi-heart"></i>

                <h4>
                    Your wishlist is empty
                </h4>

                <p>
                    Start adding your favorite products to your wishlist!
                </p>

                <a href="{{ route('customer.products') }}" class="btn btn-primary mt-3">

                    <i class="bi bi-shop"></i>
                    Start Shopping

                </a>

            </div>

        @endif

        <div class="recommended-header">
            <div class="recommended-title">

                <div class="recommend-icon">
                    <i class="bi bi-stars"></i>
                </div>

                <div>
                    <h4>Recommended for You</h4>
                    <p>Handpicked products just for you</p>
                </div>

            </div>

        </div>


        <div class="row g-4">

            @forelse($recommendedProducts ?? [] as $product)

                @php
                    $images = $product->image
                        ? array_map('trim', explode(',', $product->image))
                        : [];

                    $firstImage = $images[0] ?? null;

                    if ($firstImage) {
                        $firstImage = preg_replace('#^storage/#', '', $firstImage);
                        $imgUrl = asset($firstImage);
                    } else {
                        $imgUrl = null;
                    }

                    /*
                     * ACTIVE OFFER
                     */
                    $activeOffer = $product->active_offer ?? null;

                    $originalPrice = $product->price ?? 0;
                    $discountedPrice = $originalPrice;

                    if ($activeOffer) {
                        if ($activeOffer->discount_type === 'percentage') {
                            $discountedPrice = $originalPrice -
                                ($originalPrice * $activeOffer->discount_value / 100);
                        } else {
                            $discountedPrice = max(
                                0,
                                $originalPrice - $activeOffer->discount_value
                            );
                        }
                    }

                    $isFutured = isset($product->is_futured) && $product->is_futured == 1;
                    $isNew = isset($product->is_futured) && $product->is_futured == 2;

                    $isOutOfStock = $product->stock !== null && $product->stock <= 0;
                @endphp


                <div class="col-xl col-lg-3 col-md-4 col-sm-6">

                    <div class="rec-product-card product-details-trigger" data-product-id="{{ $product->id }}"
                        style="cursor: pointer;">

                        <div class="rec-product-img">

                            @if($imgUrl)
                                <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                    onerror="this.src='{{ asset('images/placeholder.png') }}'">
                            @else
                                <div class="wishlist-no-image">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif


                            {{-- OFFER BADGE --}}
                            @if($activeOffer)

                                <span class="rec-product-badge offer-badge">
                                    @if($activeOffer->discount_type === 'percentage')
                                        {{ rtrim(rtrim(number_format($activeOffer->discount_value, 2), '0'), '.') }}% OFF
                                    @else
                                        ₹{{ number_format($activeOffer->discount_value, 0) }} OFF
                                    @endif
                                </span>

                            @elseif($isFutured)

                                <span class="rec-product-badge futured-badge">
                                    <i class="bi bi-star-fill"></i> Futured
                                </span>

                            @elseif($isNew)

                                <span class="rec-product-badge new-badge">
                                    <i class="bi bi-fire"></i> New
                                </span>

                            @endif


                            {{-- STOCK BADGE --}}
                            @if($product->stock !== null)
                                <span class="rec-stock-badge {{ $isOutOfStock ? 'out-of-stock' : 'in-stock' }}">
                                    {{ $isOutOfStock ? 'Out of Stock' : 'In Stock' }}
                                </span>
                            @endif


                            {{-- WISHLIST --}}
                            <button class="rec-heart wishlist-btn" data-product-id="{{ $product->id }}"
                                onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist(this)">
                                <i class="bi bi-heart"></i>
                            </button>

                        </div>


                        <div class="rec-product-info">

                            {{-- CATEGORY --}}
                            <div class="rec-category">
                                {{ $product->category->name ?? 'Product' }}
                            </div>


                            {{-- PRODUCT NAME --}}
                            <h6 title="{{ $product->name }}">
                                {{ Str::limit($product->name, 25) }}
                            </h6>


                            {{-- PRICE --}}
                            <div class="rec-price">

                                @if($activeOffer)

                                    <span style="color:#ef4444; font-weight:700;">
                                        ₹{{ number_format($discountedPrice, 0) }}
                                    </span>

                                    <span style="
                                                                    font-size:12px;
                                                                    color:#94a3b8;
                                                                    text-decoration:line-through;
                                                                    margin-left:6px;
                                                                ">
                                        ₹{{ number_format($originalPrice, 0) }}
                                    </span>

                                @else

                                    ₹{{ number_format($originalPrice, 0) }}

                                @endif

                            </div>


                            {{-- RATING --}}
                            <div class="rec-rating">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>

                                <span>(96)</span>
                            </div>


                            {{-- ADD TO CART --}}
                            @if($isFutured)

                                <button type="button" class="rec-add-cart btn-futured notify-me-btn"
                                    data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                                    <i class="bi bi-bell"></i>
                                    Notify Me
                                </button>

                            @elseif($isOutOfStock)

                                <button type="button" class="rec-add-cart" disabled>
                                    <i class="bi bi-x-circle"></i>
                                    Out of Stock
                                </button>

                            @else

                                <form class="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST"
                                    onclick="event.stopPropagation();">

                                    @csrf

                                    <button type="submit" class="rec-add-cart">
                                        <i class="bi bi-cart3 me-1"></i>
                                        Add to Cart
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12 text-center py-4 text-muted">
                    No recommended products available.
                </div>

            @endforelse

        </div>

    </div>

    </div>
    <!-- PRODUCT DETAILS MODAL -->
    <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content product-details-modal-content">

                <button type="button" class="product-modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>

                <div class="modal-body p-0">

                    <div id="productModalLoader" class="product-modal-loader">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>

                    <div id="productModalContent" style="display:none;">

                        <div class="row g-0">

                            <!-- IMAGE -->
                            <div class="col-md-6">
                                <div class="product-modal-image-wrap"
                                    style="height:500px; min-height:500px; max-height:500px; overflow:hidden; display:flex; align-items:center; justify-content:center;">

                                    <img id="modalProductImage" src="" alt="Product Image"
                                        style="width:100%; height:500px; object-fit:contain; display:block;">
                                </div>
                            </div>

                            <!-- DETAILS -->
                            <div class="col-md-6">
                                <div class="product-modal-details" style="height:500px; overflow-y:auto; padding:30px;">

                                    <div id="modalProductCategory" class="product-modal-category">
                                    </div>

                                    <h3 id="modalProductName"></h3>

                                    <div class="product-modal-rating">
                                        <span class="stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </span>
                                        <span>(128 Reviews)</span>
                                    </div>

                                    <div id="modalProductPrice" class="product-modal-price">
                                    </div>

                                    <div id="modalProductDescription" class="product-modal-description">
                                    </div>

                                    <div class="product-modal-info">
                                        <div>
                                            <span>Availability</span>
                                            <strong id="modalProductStock"></strong>
                                        </div>

                                        <div>
                                            <span>Category</span>
                                            <strong id="modalProductCategoryInfo"></strong>
                                        </div>
                                    </div>

                                    <div id="modalProductAction" class="product-modal-action">
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // =============================================
        // WISHLIST TOGGLE
        // =============================================
        function toggleWishlist(button) {
            if (!button) {
                console.error('Wishlist button is missing');
                return;
            }

            const productId = button.dataset.productId;
            if (!productId) {
                console.error('Product ID not found on button');
                return;
            }

            const url = "{{ url('/customer/wishlist/toggle') }}/" + productId;
            button.disabled = true;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Wishlist request failed');
                    }
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        // For heart-display buttons (main wishlist page)
                        const icon = button.querySelector('i');
                        if (icon) {
                            if (data.is_in_wishlist) {
                                icon.classList.remove('bi-heart');
                                icon.classList.add('bi-heart-fill');
                                button.classList.add('active');
                            } else {
                                icon.classList.remove('bi-heart-fill');
                                icon.classList.add('bi-heart');
                                button.classList.remove('active');
                            }
                        }

                        // For rec-heart buttons (recommended section)
                        const recIcon = button.querySelector('i');
                        if (recIcon) {
                            if (data.is_in_wishlist) {
                                recIcon.classList.remove('bi-heart');
                                recIcon.classList.add('bi-heart-fill');
                                button.classList.add('active');
                            } else {
                                recIcon.classList.remove('bi-heart-fill');
                                recIcon.classList.add('bi-heart');
                                button.classList.remove('active');
                            }
                        }

                        // Update wishlist count in header
                        document.querySelectorAll('.wishlist-badge').forEach(el => {
                            const link = el.closest('a');
                            if (link && link.href && link.href.includes('/customer/wishlist')) {
                                el.textContent = data.wishlist_count;
                                if (data.wishlist_count > 0) {
                                    el.classList.remove('d-none');
                                } else {
                                    el.classList.add('d-none');
                                }
                            }
                        });

                        // Update wishlist count in stat box (dashboard)
                        const wishlistStat = document.getElementById('wishlistCountDisplay');
                        if (wishlistStat) {
                            wishlistStat.textContent = data.wishlist_count;
                        }

                        // Reload page if removing from wishlist page
                        if (data.is_in_wishlist === false) {
                            // Check if we're on the wishlist page (the button is a heart-display)
                            if (button.classList.contains('heart-display')) {
                                // Remove the product card with animation
                                const card = button.closest('.col-xl-6');
                                if (card) {
                                    card.style.transition = 'all 0.3s ease';
                                    card.style.opacity = '0';
                                    card.style.transform = 'scale(0.95)';
                                    setTimeout(() => {
                                        card.remove();
                                        // Update the wishlist count text
                                        const countText = document.querySelector('.wishlist-title-area p');
                                        if (countText) {
                                            const remainingItems = document.querySelectorAll('.wishlist-product-card')
                                                .length;
                                            countText.textContent = remainingItems + ' products saved for later';
                                        }
                                        // If no items left, show empty state
                                        if (document.querySelectorAll('.wishlist-product-card').length === 0) {
                                            location.reload();
                                        }
                                    }, 300);
                                }
                            }
                        }

                        console.log(data.message);
                    }
                })
                .catch(error => {
                    console.error('Wishlist Error:', error);
                })
                .finally(() => {
                    button.disabled = false;
                });
        }

        // =============================================
        // CLEAR WISHLIST
        // =============================================
        function clearWishlist() {
            if (!confirm('Are you sure you want to clear your entire wishlist?')) {
                return;
            }

            const url = "{{ route('wishlist.add') }}";

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Failed to clear wishlist');
                    }
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Clear wishlist error:', error);
                    alert('Failed to clear wishlist. Please try again.');
                });
        }

        // =============================================
        // ADD ALL TO CART
        // =============================================
        function addAllToCart() {
            const productIds = [];
            document.querySelectorAll('.wishlist-product-card').forEach(card => {
                const form = card.querySelector('form');
                if (form) {
                    const action = form.getAttribute('action');
                    const id = action.split('/').pop();
                    if (id) productIds.push(id);
                }
            });

            if (productIds.length === 0) {
                alert('No products available to add to cart.');
                return;
            }

            const url = "{{ route('wishlist.add') }}";

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_ids: productIds })
            })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Failed to add products to cart');
                    }
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        alert(data.message || 'All products added to cart successfully!');
                        // Update cart count
                        if (data.cart_count !== undefined) {
                            document.querySelectorAll('.cart-badge').forEach(el => {
                                el.textContent = data.cart_count;
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Add all to cart error:', error);
                    alert('Failed to add products to cart. Please try again.');
                });
        }
    </script>
    <script>
        const notifyMeUrl = "{{ route('customer.notify-me') }}";
        const currentUserEmail = @json(auth()->user()->email ?? null);

        document.addEventListener('click', function (e) {
            // =============================================
            // RIGHT SIDEBAR TOAST
            // =============================================
            function showSidebarToast(type = 'info', title = 'Notification', message = '') {

                let container = document.getElementById('sidebarToastContainer');

                if (!container) {
                    container = document.createElement('div');
                    container.id = 'sidebarToastContainer';
                    container.className = 'sidebar-toast-container';
                    document.body.appendChild(container);
                }

                const icons = {
                    success: 'bi-check-circle-fill',
                    error: 'bi-x-circle-fill',
                    warning: 'bi-exclamation-triangle-fill',
                    info: 'bi-info-circle-fill'
                };

                const toast = document.createElement('div');

                toast.className = `sidebar-toast ${type}`;

                toast.innerHTML = `
                                                    <div class="sidebar-toast-content">

                                                        <div class="sidebar-toast-icon">
                                                            <i class="bi ${icons[type] || icons.info}"></i>
                                                        </div>

                                                        <div class="sidebar-toast-body">
                                                            <div class="sidebar-toast-title">${title}</div>
                                                            <div class="sidebar-toast-message">${message}</div>
                                                        </div>

                                                        <button type="button"
                                                                class="sidebar-toast-close"
                                                                aria-label="Close">
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>

                                                    </div>

                                                    <div class="sidebar-toast-progress"></div>
                                                `;

                container.appendChild(toast);

                // Trigger slide-in animation
                setTimeout(() => {
                    toast.classList.add('show');
                }, 50);

                let removed = false;

                function removeToast() {

                    if (removed) return;

                    removed = true;

                    toast.classList.remove('show');
                    toast.classList.add('hide');

                    setTimeout(() => {
                        toast.remove();
                    }, 450);
                }

                // Close button
                toast.querySelector('.sidebar-toast-close')
                    .addEventListener('click', removeToast);

                // Auto close after 5 seconds
                setTimeout(removeToast, 5000);
            }

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
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const modalElement = document.getElementById('productDetailsModal');
            const productModal = new bootstrap.Modal(modalElement);

            const detailsUrl = "{{ url('/customer/product-details') }}";

            // Define these outside so they're available in the closure
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            const addToCartBaseUrl = "{{ url('/cart/add') }}";

            document.addEventListener('click', function (e) {

                const card = e.target.closest('.product-details-trigger');

                if (!card) return;

                // Don't open modal when clicking buttons/forms/links
                if (
                    e.target.closest('button') ||
                    e.target.closest('form') ||
                    e.target.closest('a')
                ) {
                    return;
                }

                const productId = card.dataset.productId;

                if (!productId) return;

                const loader = document.getElementById('productModalLoader');
                const content = document.getElementById('productModalContent');

                if (loader) loader.style.display = 'flex';
                if (content) content.style.display = 'none';

                productModal.show();

                fetch(detailsUrl + '/' + productId, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(async response => {
                        const data = await response.json();
                        if (!response.ok) {
                            throw new Error(data.message || 'Failed to load product details');
                        }
                        return data;
                    })
                    .then(data => {

                        if (!data.success || !data.product) {
                            throw new Error('Product details not found');
                        }

                        const product = data.product;

                        // Set image
                        const img = document.getElementById('modalProductImage');
                        if (img) {
                            img.src = product.image || '{{ asset('images/placeholder.png') }}';
                            img.alt = product.name || 'Product';
                        }

                        // Set category
                        const category = document.getElementById('modalProductCategory');
                        if (category) category.textContent = product.category || 'Product';

                        const categoryInfo = document.getElementById('modalProductCategoryInfo');
                        if (categoryInfo) categoryInfo.textContent = product.category || 'Product';

                        // Set name
                        const name = document.getElementById('modalProductName');
                        if (name) name.textContent = product.name || 'Product';

                        // Set price
                        const price = document.getElementById('modalProductPrice');
                        if (price) price.textContent = product.formatted_price || '₹0.00';

                        // Set description
                        const desc = document.getElementById('modalProductDescription');
                        if (desc) desc.innerHTML = product.description || 'No description available.';

                        // Set stock
                        const stock = document.getElementById('modalProductStock');
                        if (stock) {
                            if (product.is_out_of_stock) {
                                stock.textContent = 'Out of Stock';
                                stock.style.color = '#dc2626';
                            } else {
                                stock.textContent = 'In Stock';
                                stock.style.color = '#16a34a';
                            }
                        }

                        const actionContainer = document.getElementById('modalProductAction');
                        if (!actionContainer) return;

                        // FUTURED PRODUCT → NOTIFY ME
                        if (product.is_futured) {
                            actionContainer.innerHTML = `
                            <button type="button"
                                    class="product-modal-notify notify-me-btn"
                                    data-product-id="${product.id}">
                                <i class="bi bi-bell me-2"></i>
                                Notify Me
                            </button>
                        `;
                        }
                        // OUT OF STOCK
                        else if (product.is_out_of_stock) {
                            actionContainer.innerHTML = `
                            <button type="button"
                                    class="product-modal-add-cart"
                                    disabled>
                                <i class="bi bi-x-circle me-2"></i>
                                Out of Stock
                            </button>
                        `;
                        }
                        // ADD TO CART - FIXED: Use JavaScript variables, not Blade syntax
                        else {
                            // Build the URL using JavaScript concatenation
                            const addToCartUrl = addToCartBaseUrl + '/' + product.id;

                            actionContainer.innerHTML = `
                            <form action="${addToCartUrl}" method="POST" class="flex-grow-1">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <button type="submit" class="btn btn-wishlist-cart w-100">
                                    <i class="bi bi-cart3"></i>
                                    Add to Cart
                                </button>
                            </form>
                        `;
                        }

                        // Hide loader, show content
                        if (loader) loader.style.display = 'none';
                        if (content) content.style.display = 'block';

                    })
                    .catch(error => {

                        console.error('Product Details Error:', error);

                        productModal.hide();

                        // Use the existing toast function if available
                        if (typeof showSidebarToast === 'function') {
                            showSidebarToast(
                                'error',
                                'Error',
                                error.message || 'Failed to load product details.'
                            );
                        } else if (typeof showToast === 'function') {
                            showToast(
                                'error',
                                'Error',
                                error.message || 'Failed to load product details.'
                            );
                        }
                    });

            });

        });
    </script>
@endsection
