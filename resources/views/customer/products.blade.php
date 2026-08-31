@extends('frontend.layouts.customer-layout')

@section('title', 'My Wishlist - ShopEase')

@section('styles')
    <style>
        /* ==========================================
       WISHLIST PAGE - PROFESSIONAL DESIGN
    ========================================== */

        .wishlist-page {
            padding: 30px 0 50px;
            background: #f8fafc;
            min-height: 100vh;
        }

        /* ==========================================
       WISHLIST HEADER
    ========================================== */

        .wishlist-header-section {
            background: #ffffff;
            border-radius: 16px;
            padding: 28px 32px;
            margin-bottom: 30px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #eef2f6;
        }

        .wishlist-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .wishlist-title-area {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .wishlist-title-icon {
            width: 52px;
            height: 52px;
            min-width: 52px;
            border-radius: 14px;
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #ef4444;
        }

        .wishlist-title-area h2 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 4px;
        }

        .wishlist-title-area p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .wishlist-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .wishlist-action-btn {
            padding: 10px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #ffffff;
            color: #334155;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .wishlist-action-btn:hover {
            border-color: #3b82f6;
            color: #3b82f6;
            background: #f8faff;
            transform: translateY(-1px);
        }

        .wishlist-action-btn.danger:hover {
            border-color: #ef4444;
            color: #ef4444;
            background: #fef2f2;
        }

        /* ==========================================
       WISHLIST PRODUCT CARD
    ========================================== */

        .wishlist-product-card {
            background: #ffffff;
            border: 1px solid #eef2f6;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            gap: 0;
            transition: all 0.3s ease;
            height: 100%;
            min-height: 280px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .wishlist-product-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border-color: #dbeafe;
            transform: translateY(-3px);
        }

        /* Product Image */
        .wishlist-product-image {
            width: 260px;
            min-width: 260px;
            height: 280px;
            position: relative;
            background: #fafcff;
            overflow: hidden;
            flex-shrink: 0;
        }

        .wishlist-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .wishlist-product-card:hover .wishlist-product-image img {
            transform: scale(1.03);
        }

        .wishlist-no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 48px;
            background: #f1f5f9;
        }

        /* ==========================================
       PRODUCT BADGES
    ========================================== */

        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff;
            z-index: 5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
        }

        .offer-badge {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .futured-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .new-badge {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .stock-badge {
            position: absolute;
            bottom: 12px;
            right: 12px;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            color: #ffffff;
            z-index: 5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.10);
        }

        .stock-badge.in-stock {
            background: #22c55e;
        }

        .stock-badge.out-of-stock {
            background: #ef4444;
        }

        .category-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 9px;
            font-weight: 600;
            color: #ffffff;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(4px);
            z-index: 5;
            max-width: 80%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Heart Button */
        .heart-display {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.92);
            color: #ef4444;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 6;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .heart-display:hover {
            background: #ffffff;
            transform: scale(1.08);
            box-shadow: 0 4px 16px rgba(239, 68, 68, 0.15);
        }

        /* ==========================================
       PRODUCT DETAILS
    ========================================== */

        .wishlist-product-details {
            flex: 1;
            padding: 20px 24px 24px;
            display: flex;
            flex-direction: column;
        }

        .product-category {
            font-size: 11px;
            font-weight: 600;
            color: #8b5cf6;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }

        .wishlist-product-name {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .wishlist-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .wishlist-rating .stars {
            color: #fbbf24;
            font-size: 14px;
        }

        .wishlist-rating .stars i {
            margin-right: 1px;
        }

        .wishlist-rating .review-count {
            color: #94a3b8;
            font-size: 13px;
        }

        .wishlist-price {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 14px;
        }

        .wishlist-price .original-price {
            font-size: 14px;
            color: #94a3b8;
            text-decoration: line-through;
            margin-left: 8px;
            font-weight: 500;
        }

        .wishlist-price .discount-badge {
            font-size: 12px;
            font-weight: 700;
            color: #ef4444;
            margin-left: 8px;
        }

        /* Features */
        .wishlist-features {
            list-style: none;
            padding: 0;
            margin: 0 0 16px;
        }

        .wishlist-features li {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-size: 13px;
            padding: 3px 0;
        }

        .wishlist-features li i {
            color: #3b82f6;
            font-size: 15px;
            width: 20px;
        }

        /* Buttons */
        .wishlist-product-buttons {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }

        .btn-wishlist-cart {
            flex: 1;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            background: #0f172a;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-wishlist-cart:hover:not(:disabled) {
            background: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.15);
        }

        .btn-wishlist-cart:disabled {
            background: #94a3b8;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .btn-wishlist-cart.btn-futured {
            background: linear-gradient(135deg, #92400e, #78350f);
            color: #fbbf24;
        }

        .btn-wishlist-cart.btn-futured:hover {
            background: linear-gradient(135deg, #78350f, #5a2d0a);
        }

        .btn-remove-wishlist {
            padding: 10px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #ffffff;
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-remove-wishlist:hover {
            border-color: #ef4444;
            color: #ef4444;
            background: #fef2f2;
        }

        /* ==========================================
       EMPTY STATE
    ========================================== */

        .empty-products {
            text-align: center;
            padding: 80px 20px;
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #eef2f6;
        }

        .empty-products i {
            font-size: 64px;
            color: #dbeafe;
            display: block;
            margin-bottom: 16px;
        }

        .empty-products h4 {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .empty-products p {
            color: #94a3b8;
            font-size: 15px;
            margin-bottom: 20px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 32px;
            border-radius: 10px;
            background: #3b82f6;
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.25);
            color: #ffffff;
        }

        /* ==========================================
       RECOMMENDED SECTION
    ========================================== */

        .recommended-header {
            margin: 40px 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .recommended-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .recommend-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #d97706;
        }

        .recommended-title h4 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 2px;
        }

        .recommended-title p {
            color: #94a3b8;
            font-size: 13px;
            margin: 0;
        }

        /* ==========================================
       RECOMMENDED PRODUCT CARD
    ========================================== */

        .rec-product-card {
            background: #ffffff;
            border: 1px solid #eef2f6;
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .rec-product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border-color: #dbeafe;
        }

        .rec-product-img {
            height: 200px;
            background: #fafcff;
            position: relative;
            overflow: hidden;
        }

        .rec-product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .rec-product-card:hover .rec-product-img img {
            transform: scale(1.05);
        }

        .rec-product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 3px 10px;
            border-radius: 5px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            color: #ffffff;
            z-index: 5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .rec-stock-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            padding: 3px 10px;
            border-radius: 5px;
            font-size: 9px;
            font-weight: 700;
            color: #ffffff;
            z-index: 5;
        }

        .rec-stock-badge.in-stock {
            background: #22c55e;
        }

        .rec-stock-badge.out-of-stock {
            background: #ef4444;
        }

        .rec-heart {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.92);
            color: #94a3b8;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .rec-heart:hover {
            background: #ffffff;
            transform: scale(1.08);
        }

        .rec-heart.active {
            color: #ef4444;
        }

        .rec-product-info {
            padding: 14px 16px 16px;
        }

        .rec-category {
            font-size: 10px;
            font-weight: 600;
            color: #8b5cf6;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .rec-product-info h6 {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin: 0 0 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rec-price {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .rec-price .original-price {
            font-size: 12px;
            color: #94a3b8;
            text-decoration: line-through;
            margin-left: 6px;
            font-weight: 500;
        }

        .rec-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #fbbf24;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .rec-rating span {
            color: #94a3b8;
            font-size: 12px;
        }

        .rec-add-cart {
            width: 100%;
            padding: 8px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #ffffff;
            color: #0f172a;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .rec-add-cart:hover:not(:disabled) {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        .rec-add-cart:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .rec-add-cart.btn-futured {
            background: linear-gradient(135deg, #92400e, #78350f);
            color: #fbbf24;
            border-color: #78350f;
        }

        .rec-add-cart.btn-futured:hover {
            background: linear-gradient(135deg, #78350f, #5a2d0a);
        }

        /* ==========================================
       MODAL STYLES
    ========================================== */

        .product-details-modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .product-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.92);
            color: #475569;
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .product-modal-close:hover {
            background: #ffffff;
            transform: rotate(90deg);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.10);
        }

        .product-modal-loader {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 480px;
        }

        .product-modal-loader .spinner-border {
            width: 48px;
            height: 48px;
            color: #3b82f6;
        }

        .product-modal-image-wrap {
            background: #fafcff;
            padding: 20px;
            min-height: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-modal-image-wrap img {
            width: 100%;
            height: 100%;
            max-height: 460px;
            object-fit: contain;
        }

        .product-modal-details {
            padding: 32px 30px 30px;
            min-height: 480px;
            overflow-y: auto;
        }

        .product-modal-details::-webkit-scrollbar {
            width: 4px;
        }

        .product-modal-details::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .product-modal-category {
            display: inline-block;
            background: #f1f5f9;
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .product-modal-details h3 {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .product-modal-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .product-modal-rating .stars {
            color: #fbbf24;
            font-size: 14px;
        }

        .product-modal-rating span {
            color: #94a3b8;
            font-size: 13px;
        }

        .product-modal-price {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 16px;
        }

        .product-modal-price .original-price {
            font-size: 18px;
            color: #94a3b8;
            text-decoration: line-through;
            margin-left: 10px;
            font-weight: 500;
        }

        .product-modal-description {
            color: #475569;
            font-size: 14px;
            line-height: 1.7;
            padding: 16px 0;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 18px;
        }

        .product-modal-description p {
            margin: 0;
        }

        .product-modal-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 16px;
            margin-bottom: 20px;
        }

        .product-modal-info div {
            display: flex;
            flex-direction: column;
        }

        .product-modal-info div span {
            color: #94a3b8;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            font-weight: 600;
        }

        .product-modal-info div strong {
            color: #0f172a;
            font-size: 14px;
            font-weight: 600;
        }

        .product-modal-action {
            margin-top: 4px;
        }

        .product-modal-add-cart,
        .product-modal-notify {
            width: 100%;
            padding: 14px 24px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .product-modal-add-cart {
            background: #0f172a;
            color: #ffffff;
        }

        .product-modal-add-cart:hover:not(:disabled) {
            background: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.15);
        }

        .product-modal-add-cart:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .product-modal-notify {
            background: linear-gradient(135deg, #92400e, #78350f);
            color: #fbbf24;
        }

        .product-modal-notify:hover {
            background: linear-gradient(135deg, #78350f, #5a2d0a);
            transform: translateY(-2px);
        }

        /* ==========================================
       RESPONSIVE
    ========================================== */

        @media (max-width: 992px) {
            .wishlist-product-card {
                flex-direction: column;
                min-height: auto;
            }

            .wishlist-product-image {
                width: 100%;
                min-width: 100%;
                height: 240px;
            }

            .product-modal-image-wrap {
                min-height: 300px;
            }

            .product-modal-image-wrap img {
                max-height: 260px;
            }

            .product-modal-details {
                min-height: auto;
                max-height: 400px;
                padding: 24px 20px 20px;
            }
        }

        @media (max-width: 768px) {
            .wishlist-page {
                padding: 16px 0 30px;
            }

            .wishlist-header-section {
                padding: 20px;
            }

            .wishlist-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .wishlist-actions {
                width: 100%;
            }

            .wishlist-action-btn {
                flex: 1;
                justify-content: center;
                font-size: 12px;
                padding: 8px 14px;
            }

            .wishlist-title-area h2 {
                font-size: 20px;
            }

            .wishlist-title-icon {
                width: 44px;
                height: 44px;
                min-width: 44px;
                font-size: 20px;
            }

            .wishlist-product-image {
                height: 200px;
            }

            .wishlist-product-details {
                padding: 16px 18px 18px;
            }

            .wishlist-product-name {
                font-size: 16px;
            }

            .wishlist-price {
                font-size: 18px;
            }

            .wishlist-features li {
                font-size: 12px;
            }

            .recommended-title h4 {
                font-size: 17px;
            }

            .rec-product-img {
                height: 160px;
            }
        }

        @media (max-width: 576px) {
            .wishlist-header-section {
                padding: 16px;
                border-radius: 12px;
            }

            .wishlist-title-area h2 {
                font-size: 18px;
            }

            .wishlist-title-area p {
                font-size: 13px;
            }

            .wishlist-action-btn {
                font-size: 11px;
                padding: 6px 12px;
            }

            .wishlist-product-image {
                height: 180px;
            }

            .wishlist-product-details {
                padding: 14px 14px 16px;
            }

            .wishlist-product-name {
                font-size: 14px;
            }

            .wishlist-price {
                font-size: 16px;
            }

            .wishlist-product-buttons {
                flex-direction: column;
            }

            .btn-wishlist-cart {
                padding: 8px 16px;
                font-size: 12px;
            }

            .btn-remove-wishlist {
                padding: 8px 14px;
                font-size: 12px;
                justify-content: center;
            }

            .empty-products {
                padding: 50px 16px;
            }

            .empty-products i {
                font-size: 48px;
            }

            .empty-products h4 {
                font-size: 18px;
            }

            .rec-product-img {
                height: 140px;
            }

            .rec-product-info {
                padding: 10px 12px 14px;
            }

            .rec-product-info h6 {
                font-size: 13px;
            }

            .rec-price {
                font-size: 15px;
            }

            .product-modal-image-wrap {
                min-height: 220px;
                padding: 12px;
            }

            .product-modal-image-wrap img {
                max-height: 200px;
            }

            .product-modal-details {
                padding: 16px 14px 18px;
                max-height: 300px;
            }

            .product-modal-details h3 {
                font-size: 18px;
            }

            .product-modal-price {
                font-size: 22px;
            }

            .product-modal-info {
                grid-template-columns: 1fr;
                gap: 6px;
            }

            .product-modal-add-cart,
            .product-modal-notify {
                font-size: 13px;
                padding: 12px 18px;
            }
        }

        /* ==========================================
       TOAST STYLES
    ========================================== */

        .sidebar-toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 99999;
            width: 380px;
            max-width: calc(100vw - 40px);
            pointer-events: none;
        }

        .sidebar-toast {
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
            margin-bottom: 12px;
            overflow: hidden;
            transform: translateX(120%);
            opacity: 0;
            pointer-events: auto;
            transition: transform 0.4s ease, opacity 0.4s ease;
            border-left: 4px solid #3b82f6;
        }

        .sidebar-toast.show {
            transform: translateX(0);
            opacity: 1;
        }

        .sidebar-toast.hide {
            transform: translateX(120%);
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
            border-left-color: #3b82f6;
        }

        .sidebar-toast-content {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px 18px;
        }

        .sidebar-toast-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .sidebar-toast.success .sidebar-toast-icon {
            background: #dcfce7;
            color: #22c55e;
        }

        .sidebar-toast.error .sidebar-toast-icon {
            background: #fee2e2;
            color: #ef4444;
        }

        .sidebar-toast.warning .sidebar-toast-icon {
            background: #fef3c7;
            color: #f59e0b;
        }

        .sidebar-toast.info .sidebar-toast-icon {
            background: #dbeafe;
            color: #3b82f6;
        }

        .sidebar-toast-body {
            flex: 1;
            min-width: 0;
        }

        .sidebar-toast-title {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 3px;
        }

        .sidebar-toast-message {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
        }

        .sidebar-toast-close {
            border: none;
            background: transparent;
            color: #94a3b8;
            padding: 0;
            font-size: 16px;
            cursor: pointer;
            line-height: 1;
        }

        .sidebar-toast-close:hover {
            color: #475569;
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
            background: #3b82f6;
        }

        @keyframes toastProgress {
            from {
                transform: scaleX(1);
            }

            to {
                transform: scaleX(0);
            }
        }

        @media (max-width: 576px) {
            .sidebar-toast-container {
                top: 70px;
                right: 10px;
                width: calc(100vw - 20px);
            }
        }
    </style>
@endsection

@section('content')

    <div class="wishlist-page">
        <div class="container">

            {{-- Wishlist Header --}}
            <div class="wishlist-header-section">
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
                        <button type="button" class="wishlist-action-btn" onclick="shareWishlist()">
                            <i class="bi bi-share"></i> Share
                        </button>
                        <button type="button" class="wishlist-action-btn danger" onclick="clearWishlist()">
                            <i class="bi bi-trash"></i> Clear All
                        </button>
                    </div>
                </div>
            </div>

            {{-- Wishlist Products --}}
            @if(isset($wishlistProducts) && $wishlistProducts->count() > 0)

                <div class="row g-4 wishlist-products-row">
                    @foreach($wishlistProducts as $wishlist)
                        @php
                            $product = $wishlist->product;
                            if ($product) {
                                $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                                $firstImage = $images[0] ?? null;
                                if ($firstImage) {
                                    $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                    $imgUrl = asset($firstImage);
                                } else {
                                    $imgUrl = null;
                                }
                                $isFutured = isset($product->is_futured) && $product->is_futured == 1;
                                $isNew = isset($product->is_futured) && $product->is_futured == 2;
                                $isOutOfStock = $product->stock !== null && $product->stock <= 0;
                                $isLowStock = $product->stock !== null && $product->stock > 0 && $product->stock <= 5;
                                $activeOffer = $product->active_offer ?? null;
                                $originalPrice = $product->price ?? 0;
                                $discountedPrice = $originalPrice;
                                if ($activeOffer) {
                                    if ($activeOffer->discount_type === 'percentage') {
                                        $discountedPrice = $originalPrice - ($originalPrice * $activeOffer->discount_value / 100);
                                    } else {
                                        $discountedPrice = max(0, $originalPrice - $activeOffer->discount_value);
                                    }
                                }
                            }
                        @endphp

                        @if($product)
                            <div class="col-xl-6">
                                <div class="wishlist-product-card product-details-trigger" data-product-id="{{ $product->id }}"
                                    style="cursor: pointer;">

                                    {{-- Product Image --}}
                                    <div class="wishlist-product-image">
                                        @if($imgUrl)
                                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}"
                                                onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                        @else
                                            <div class="wishlist-no-image">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif

                                        {{-- Offer / Product Badge --}}
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
                                                <i class="bi bi-star-fill"></i> Featured
                                            </span>
                                        @elseif($isNew)
                                            <span class="product-badge new-badge">
                                                <i class="bi bi-fire"></i> New
                                            </span>
                                        @endif

                                        {{-- Stock Badge --}}
                                        @if($product->stock !== null)
                                            <span class="stock-badge {{ $isOutOfStock ? 'out-of-stock' : 'in-stock' }}">
                                                {{ $isOutOfStock ? 'Out of Stock' : 'In Stock' }}
                                            </span>
                                        @endif

                                        {{-- Category Badge --}}
                                        @if($product->category)
                                            <span class="category-badge">{{ $product->category->name }}</span>
                                        @endif

                                        {{-- Heart Button --}}
                                        <button class="heart-display" data-product-id="{{ $product->id }}"
                                            onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist(this)">
                                            <i class="bi bi-heart-fill"></i>
                                        </button>
                                    </div>

                                    {{-- Product Details --}}
                                    <div class="wishlist-product-details">
                                        <div class="product-category">{{ $product->category->name ?? 'Jewellery' }}</div>
                                        <div class="wishlist-product-name">{{ $product->name }}</div>

                                        {{-- Rating --}}
                                        <div class="wishlist-rating">
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </div>
                                            <span class="review-count">(128 Reviews)</span>
                                        </div>

                                        {{-- Price --}}
                                        <div class="wishlist-price">
                                            @if($activeOffer)
                                                <span>₹{{ number_format($discountedPrice, 0) }}</span>
                                                <span class="original-price">₹{{ number_format($originalPrice, 0) }}</span>
                                                @php
                                                    $discountPercent = round((($originalPrice - $discountedPrice) / $originalPrice) * 100);
                                                @endphp
                                                <span class="discount-badge">({{ $discountPercent }}% OFF)</span>
                                            @else
                                                ₹{{ number_format($originalPrice, 0) }}
                                            @endif
                                        </div>

                                        {{-- Features --}}
                                        <ul class="wishlist-features">
                                            <li><i class="bi bi-gem"></i> Premium Quality</li>
                                            <li><i class="bi bi-shield-check"></i> Quality Guaranteed</li>
                                            <li><i class="bi bi-arrow-counterclockwise"></i> Easy 7-Day Returns</li>
                                        </ul>

                                        {{-- Action Buttons --}}
                                        <div class="wishlist-product-buttons">
                                            @if($isFutured)
                                                <button type="button" class="btn-wishlist-cart btn-futured w-100 notify-me-btn"
                                                    data-product-id="{{ $product->id }}"
                                                    onclick="event.preventDefault(); event.stopPropagation();">
                                                    <i class="bi bi-bell"></i> Notify Me
                                                </button>
                                            @elseif($isOutOfStock)
                                                <button type="button" class="btn-wishlist-cart w-100" disabled>
                                                    <i class="bi bi-x-circle"></i> Out of Stock
                                                </button>
                                            @else
                                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1"
                                                    onclick="event.stopPropagation();">
                                                    @csrf
                                                    <button type="submit" class="btn-wishlist-cart w-100">
                                                        <i class="bi bi-cart3"></i> Add to Cart
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

                {{-- Empty Wishlist --}}
                <div class="empty-products">
                    <i class="bi bi-heart"></i>
                    <h4>Your wishlist is empty</h4>
                    <p>Start adding your favorite products to your wishlist!</p>
                    <a href="{{ route('customer.products') }}" class="btn-primary">
                        <i class="bi bi-shop"></i> Start Shopping
                    </a>
                </div>

            @endif

            {{-- Recommended Section --}}
            @if(isset($recommendedProducts) && $recommendedProducts->count() > 0)
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
                    @foreach($recommendedProducts as $product)
                        @php
                            $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                            $firstImage = $images[0] ?? null;
                            if ($firstImage) {
                                $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                $imgUrl = asset($firstImage);
                            } else {
                                $imgUrl = null;
                            }
                            $activeOffer = $product->active_offer ?? null;
                            $originalPrice = $product->price ?? 0;
                            $discountedPrice = $originalPrice;
                            if ($activeOffer) {
                                if ($activeOffer->discount_type === 'percentage') {
                                    $discountedPrice = $originalPrice - ($originalPrice * $activeOffer->discount_value / 100);
                                } else {
                                    $discountedPrice = max(0, $originalPrice - $activeOffer->discount_value);
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
                                            <i class="bi bi-star-fill"></i> Featured
                                        </span>
                                    @elseif($isNew)
                                        <span class="rec-product-badge new-badge">
                                            <i class="bi bi-fire"></i> New
                                        </span>
                                    @endif

                                    @if($product->stock !== null)
                                        <span class="rec-stock-badge {{ $isOutOfStock ? 'out-of-stock' : 'in-stock' }}">
                                            {{ $isOutOfStock ? 'Out of Stock' : 'In Stock' }}
                                        </span>
                                    @endif

                                    <button class="rec-heart wishlist-btn" data-product-id="{{ $product->id }}"
                                        onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist(this)">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>

                                <div class="rec-product-info">
                                    <div class="rec-category">{{ $product->category->name ?? 'Product' }}</div>
                                    <h6 title="{{ $product->name }}">{{ Str::limit($product->name, 25) }}</h6>
                                    <div class="rec-price">
                                        ₹{{ number_format($originalPrice, 0) }}
                                    </div>
                                    <div class="rec-rating">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <span>(96)</span>
                                    </div>

                                    @if($isFutured)
                                        <button type="button" class="rec-add-cart btn-futured notify-me-btn"
                                            data-product-id="{{ $product->id }}">
                                            <i class="bi bi-bell"></i> Notify Me
                                        </button>
                                    @elseif($isOutOfStock)
                                        <button type="button" class="rec-add-cart" disabled>
                                            <i class="bi bi-x-circle"></i> Out of Stock
                                        </button>
                                    @else
                                        <form class="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST"
                                            onclick="event.stopPropagation();">
                                            @csrf
                                            <button type="submit" class="rec-add-cart">
                                                <i class="bi bi-cart3"></i> Add to Cart
                                            </button>
                                        </form>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    {{-- Product Details Modal --}}
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
                            <div class="col-md-6">
                                <div class="product-modal-image-wrap">
                                    <img id="modalProductImage" src="" alt="Product Image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-modal-details">
                                    <div id="modalProductCategory" class="product-modal-category"></div>
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
                                    <div id="modalProductPrice" class="product-modal-price"></div>
                                    <div id="modalProductDescription" class="product-modal-description"></div>
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
                                    <div id="modalProductAction" class="product-modal-action"></div>
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
        // Wishlist Toggle
        function toggleWishlist(button) {
            if (!button) return;
            const productId = button.dataset.productId;
            if (!productId) return;
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
                    if (!response.ok) throw new Error(data.message || 'Failed');
                    return data;
                })
                .then(data => {
                    if (data.success) {
                        const icon = button.querySelector('i');
                        if (icon) {
                            if (data.is_in_wishlist) {
                                icon.classList.remove('bi-heart');
                                icon.classList.add('bi-heart-fill');
                            } else {
                                icon.classList.remove('bi-heart-fill');
                                icon.classList.add('bi-heart');
                            }
                        }
                        if (!data.is_in_wishlist && button.classList.contains('heart-display')) {
                            const card = button.closest('.col-xl-6');
                            if (card) {
                                card.style.transition = 'all 0.3s ease';
                                card.style.opacity = '0';
                                card.style.transform = 'scale(0.95)';
                                setTimeout(() => {
                                    card.remove();
                                    const countText = document.querySelector('.wishlist-title-area p');
                                    if (countText) {
                                        const remaining = document.querySelectorAll('.wishlist-product-card').length;
                                        countText.textContent = remaining + ' products saved for later';
                                    }
                                    if (document.querySelectorAll('.wishlist-product-card').length === 0) {
                                        location.reload();
                                    }
                                }, 300);
                            }
                        }
                    }
                })
                .catch(error => console.error('Wishlist Error:', error))
                .finally(() => button.disabled = false);
        }

        // Clear Wishlist
        function clearWishlist() {
            if (!confirm('Are you sure you want to clear your entire wishlist?')) return;
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
                    if (!response.ok) throw new Error(data.message || 'Failed');
                    return data;
                })
                .then(data => {
                    if (data.success) location.reload();
                })
                .catch(error => {
                    console.error('Clear wishlist error:', error);
                    alert('Failed to clear wishlist. Please try again.');
                });
        }

        // Share Wishlist
        function shareWishlist() {
            if (navigator.share) {
                navigator.share({
                    title: 'My Wishlist',
                    text: 'Check out my wishlist!',
                    url: window.location.href
                }).catch(() => { });
            } else {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link copied to clipboard!');
                }).catch(() => {
                    alert('Share this link: ' + window.location.href);
                });
            }
        }
    </script>

    <script>
        // Notify Me functionality
        const notifyMeUrl = "{{ route('customer.notify-me') }}";
        const currentUserEmail = @json(auth()->user()->email ?? null);

        document.addEventListener('click', function (e) {
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
                    <div class="sidebar-toast-icon"><i class="bi ${icons[type] || icons.info}"></i></div>
                    <div class="sidebar-toast-body">
                        <div class="sidebar-toast-title">${title}</div>
                        <div class="sidebar-toast-message">${message}</div>
                    </div>
                    <button type="button" class="sidebar-toast-close" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="sidebar-toast-progress"></div>
            `;
                container.appendChild(toast);
                setTimeout(() => toast.classList.add('show'), 50);
                let removed = false;
                function removeToast() {
                    if (removed) return;
                    removed = true;
                    toast.classList.remove('show');
                    toast.classList.add('hide');
                    setTimeout(() => toast.remove(), 450);
                }
                toast.querySelector('.sidebar-toast-close').addEventListener('click', removeToast);
                setTimeout(removeToast, 5000);
            }

            const button = e.target.closest('.notify-me-btn');
            if (!button) return;
            const productId = button.dataset.productId;
            if (currentUserEmail) {
                button.disabled = true;
                fetch(notifyMeUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                    .then(async response => {
                        const data = await response.json();
                        if (!response.ok) throw new Error(data.message || 'Something went wrong');
                        return data;
                    })
                    .then(data => {
                        showSidebarToast('success', 'Notify Me', data.message);
                    })
                    .catch(error => {
                        console.error(error);
                        showSidebarToast('error', 'Error', error.message || 'Something went wrong.');
                    })
                    .finally(() => button.disabled = false);
                return;
            }
            const email = prompt('Please enter your email address:');
            if (!email) return;
            button.disabled = true;
            fetch(notifyMeUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ product_id: productId, email: email })
            })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) throw new Error(data.message || 'Invalid email address');
                    return data;
                })
                .then(data => {
                    showSidebarToast('success', 'Notify Me', data.message);
                })
                .catch(error => {
                    console.error(error);
                    showSidebarToast('error', 'Error', error.message || 'Something went wrong.');
                })
                .finally(() => button.disabled = false);
        });
    </script>

    <script>
        // Product Details Modal
        document.addEventListener('DOMContentLoaded', function () {
            const modalElement = document.getElementById('productDetailsModal');
            const productModal = new bootstrap.Modal(modalElement);
            const detailsUrl = "{{ url('/customer/product-details') }}";

            document.addEventListener('click', function (e) {
                const card = e.target.closest('.product-details-trigger');
                if (!card) return;
                if (e.target.closest('button') || e.target.closest('form') || e.target.closest('a')) return;
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
                        if (!response.ok) throw new Error(data.message || 'Failed to load');
                        return data;
                    })
                    .then(data => {
                        if (!data.success || !data.product) throw new Error('Product not found');
                        const product = data.product;
                        document.getElementById('modalProductImage').src = product.image || '{{ asset('images/placeholder.png') }}';
                        document.getElementById('modalProductCategory').textContent = product.category || 'Product';
                        document.getElementById('modalProductCategoryInfo').textContent = product.category || 'Product';
                        document.getElementById('modalProductName').textContent = product.name || 'Product';
                        document.getElementById('modalProductPrice').textContent = product.formatted_price || '₹0.00';
                        document.getElementById('modalProductDescription').innerHTML = product.description || 'No description available.';

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

                        const action = document.getElementById('modalProductAction');
                        if (!action) return;
                        if (product.is_futured) {
                            action.innerHTML = `<button type="button" class="product-modal-notify notify-me-btn" data-product-id="${product.id}"><i class="bi bi-bell"></i> Notify Me</button>`;
                        } else if (product.is_out_of_stock) {
                            action.innerHTML = `<button type="button" class="product-modal-add-cart" disabled><i class="bi bi-x-circle"></i> Out of Stock</button>`;
                        } else {

                        }

                        if (loader) loader.style.display = 'none';
                        if (content) content.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Product Details Error:', error);
                        productModal.hide();
                        alert(error.message || 'Failed to load product details.');
                    });
            });
        });
    </script>
@endsection