@extends('frontend.layouts.customer-layout')

@section('title', 'My Orders - ShopEase')

@section('styles')
    <style>
        :root {
            --primary: #2878f0;
            --primary-dark: #1765d1;
            --text: #172033;
            --muted: #64748b;
            --border: #e5eaf1;
            --bg: #f6f8fc;
            --success: #168a4a;
            --danger: #dc3545;
            --warning: #d97706;
        }

        .orders-page {
            padding: 30px 0 60px;
            background: var(--bg);
            min-height: 100vh;
        }

        .orders-header {
            margin-bottom: 24px;
        }

        .orders-header h2 {
            font-size: 26px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }

        .orders-header p {
            color: var(--muted);
            margin: 0;
        }

        .orders-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .order-row {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .order-row:last-child {
            border-bottom: 0;
        }

        .order-icon {
            width: 52px;
            height: 52px;
            min-width: 52px;
            border-radius: 12px;
            background: #eef5ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .order-main {
            flex: 1;
            min-width: 190px;
        }

        .order-number {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 5px;
        }

        .order-date {
            font-size: 13px;
            color: var(--muted);
        }

        .order-meta {
            display: flex;
            align-items: center;
            gap: 28px;
            flex-wrap: wrap;
        }

        .order-meta-label {
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .order-meta-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fff7e6;
            color: var(--warning);
        }

        .status-processing {
            background: #eaf3ff;
            color: var(--primary);
        }

        .status-delivered {
            background: #eafaf1;
            color: var(--success);
        }

        .status-cancelled {
            background: #fff0f0;
            color: var(--danger);
        }

        .status-returned {
            background: #fff7e6;
            color: #c56a00;
        }

        .status-refunded {
            background: #eefbf3;
            color: var(--success);
        }

        .status-refunded {
            background: #eefbf3;
            color: var(--warning);
        }

        .order-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .track-order-btn {
            border: 1px solid var(--primary);
            color: var(--primary);
            background: #fff;
            border-radius: 9px;
            padding: 9px 16px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .track-order-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        .empty-orders {
            text-align: center;
            padding: 70px 20px;
        }

        .empty-orders i {
            font-size: 55px;
            color: #cbd5e1;
        }

        .empty-orders h4 {
            margin-top: 15px;
            font-weight: 700;
            color: var(--text);
        }

        .empty-orders p {
            color: var(--muted);
        }

        .track-popup {
            display: none;
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, .65);
            z-index: 9990;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .track-popup.show {
            display: flex;
        }

        #productDetailsModal {
            z-index: 10000;
        }

        .modal-backdrop {
            z-index: 9999;
        }

        .track-popup-content {
            width: 100%;
            max-width: 760px;
            max-height: 92vh;
            overflow-y: auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, .25);
            animation: trackPopupIn .25s ease;
        }

        @keyframes trackPopupIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .track-popup-content::-webkit-scrollbar {
            width: 6px;
        }

        .track-popup-content::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 20px;
        }

        .track-popup-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
        }

        .track-popup-header h4 {
            margin: 0 0 4px;
            color: var(--text);
            font-weight: 700;
            font-size: 20px;
        }

        .track-popup-header span {
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
        }

        .track-popup-close {
            width: 38px;
            height: 38px;
            border: 0;
            background: #f1f5f9;
            color: #475569;
            border-radius: 50%;
            font-size: 24px;
            line-height: 1;
            cursor: pointer;
            transition: .2s;
        }

        .track-popup-close:hover {
            background: #e2e8f0;
        }

        .track-popup-body {
            padding: 24px;
        }

        .tracking-status-overview {
            padding: 18px;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 24px;
        }

        .tracking-status-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .tracking-status-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            background: #eaf3ff;
            color: var(--primary);
        }

        .tracking-status-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .tracking-status-description {
            font-size: 12px;
            color: var(--muted);
        }

        .tracking-section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 18px;
        }

        .tracking-timeline {
            margin-bottom: 28px;
        }

        .tracking-item {
            display: flex;
            gap: 15px;
            min-height: 84px;
        }

        .tracking-line-wrapper {
            width: 42px;
            min-width: 42px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tracking-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            position: relative;
            z-index: 2;
        }

        .tracking-line {
            width: 2px;
            flex: 1;
            min-height: 40px;
            background: #e2e8f0;
        }

        .tracking-item.completed .tracking-icon {
            background: #eaf3ff;
            color: var(--primary);
        }

        .tracking-item.completed .tracking-line {
            background: var(--primary);
        }

        .tracking-item.current .tracking-icon {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 0 0 5px rgba(40, 120, 240, .12);
        }

        .tracking-info {
            padding-top: 2px;
            flex: 1;
            padding-bottom: 15px;
        }

        .tracking-info h5 {
            margin: 0 0 5px;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        .tracking-info p {
            margin: 0 0 5px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .tracking-info small {
            color: #94a3b8;
            font-size: 11px;
        }

        .tracking-item.completed .tracking-info small {
            color: var(--success);
        }

        .tracking-item.current .tracking-info small {
            color: var(--primary);
            font-weight: 600;
        }

        .tracking-current {
            display: inline-block;
            margin-left: 6px;
            padding: 3px 7px;
            border-radius: 10px;
            background: #eaf3ff;
            color: var(--primary);
            font-size: 9px;
            vertical-align: middle;
        }

        .tracking-products {
            margin-top: 24px;
            margin-bottom: 24px;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .tracking-products-header {
            padding: 15px 18px;
            border-bottom: 1px solid var(--border);
            background: #fafcff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .tracking-products-header h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }

        .tracking-products-header span {
            font-size: 12px;
            color: var(--muted);
        }

        .tracking-product-item {
            display: flex;
            gap: 15px;
            padding: 16px 18px;
            border-bottom: 1px solid var(--border);
            align-items: center;
        }

        .tracking-product-item:last-child {
            border-bottom: 0;
        }

        .tracking-product-image {
            width: 72px;
            height: 72px;
            min-width: 72px;
            border-radius: 10px;
            overflow: hidden;
            background: #f1f5f9;
            border: 1px solid var(--border);
            position: relative;
            cursor: pointer;
        }

        .tracking-product-image .product-image-overlay {
            position: absolute;
            inset: 0;
            background: rgba(23, 32, 51, 0.58);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            opacity: 0;
            transition: opacity .2s ease;
            font-size: 11px;
            font-weight: 600;
            border-radius: 10px;
        }

        .tracking-product-image .product-image-overlay i {
            font-size: 20px;
        }

        .tracking-product-image:hover .product-image-overlay {
            opacity: 1;
        }

        .tracking-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .tracking-product-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 25px;
        }

        .tracking-product-details {
            flex: 1;
            min-width: 0;
        }

        .tracking-product-name {
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .tracking-product-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 11px;
        }

        .tracking-product-price {
            text-align: right;
            min-width: 115px;
        }

        .tracking-product-price strong {
            display: block;
            color: var(--text);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .tracking-product-price span {
            color: var(--muted);
            font-size: 11px;
        }

        .tracking-action-section {
            margin-bottom: 24px;
            padding: 17px;
            border: 1px solid #fecaca;
            background: #fffafa;
            border-radius: 14px;
        }

        .tracking-action-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .tracking-action-info h6 {
            margin: 0 0 5px;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        .tracking-action-info p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .cancel-order-btn {
            flex-shrink: 0;
            border: 1px solid var(--danger);
            color: var(--danger);
            background: #fff;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .cancel-order-btn:hover {
            background: var(--danger);
            color: #fff;
        }

        .cancel-confirmation {
            display: none;
            margin-bottom: 24px;
        }

        .cancel-confirmation.show {
            display: block;
        }

        .cancel-confirmation-content {
            padding: 22px;
            border: 1px solid #fecaca;
            background: #fffafa;
            border-radius: 14px;
            text-align: center;
        }

        .cancel-confirmation-icon {
            width: 55px;
            height: 55px;
            margin: 0 auto 13px;
            border-radius: 50%;
            background: #fff0f0;
            color: var(--danger);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .cancel-confirmation-content h5 {
            margin-bottom: 7px;
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
        }

        .cancel-confirmation-content p {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 18px;
        }

        .cancel-confirmation-content .form-label {
            color: var(--text);
            font-size: 12px;
            font-weight: 600;
        }

        .cancel-confirmation-content .form-select {
            border-radius: 8px;
            border-color: var(--border);
            padding: 10px 12px;
            font-size: 13px;
        }

        .cancel-confirmation-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 18px;
        }

        .confirm-cancel-btn {
            border: 0;
            background: var(--danger);
            color: #fff;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .tracking-special-box {
            padding: 20px;
            border-radius: 14px;
            margin-bottom: 24px;
        }

        .tracking-special-box.cancelled {
            background: #fff7f7;
            border: 1px solid #ffd7d7;
        }

        .tracking-special-box.returned {
            background: #fffaf0;
            border: 1px solid #fde7b2;
        }

        .tracking-special-box.refunded {
            background: #f0fbf5;
            border: 1px solid #c7efd8;
        }

        .tracking-special-top {
            display: flex;
            gap: 14px;
            align-items: flex-start;
        }

        .tracking-special-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .cancelled .tracking-special-icon {
            background: #fff0f0;
            color: var(--danger);
        }

        .returned .tracking-special-icon {
            background: #fff4d6;
            color: var(--warning);
        }

        .refunded .tracking-special-icon {
            background: #eafaf1;
            color: var(--success);
        }

        .tracking-special-content h5 {
            margin: 0 0 5px;
            color: var(--text);
            font-weight: 700;
            font-size: 16px;
        }

        .tracking-special-content p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .tracking-reason {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid rgba(0, 0, 0, .07);
        }

        .tracking-reason span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 5px;
        }

        .tracking-reason strong {
            color: var(--text);
            font-size: 13px;
        }

        .tracking-summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
        }

        .tracking-summary-item {
            padding: 15px 17px;
            border-bottom: 1px solid var(--border);
        }

        .tracking-summary-item:nth-child(odd) {
            border-right: 1px solid var(--border);
        }

        .tracking-summary-item:nth-last-child(-n+2) {
            border-bottom: 0;
        }

        .tracking-summary-item span {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .tracking-summary-item strong {
            color: var(--text);
            font-size: 13px;
            word-break: break-word;
        }

        .track-popup-footer {
            padding: 15px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            position: sticky;
            bottom: 0;
            background: #fff;
        }

        body.track-popup-open {
            overflow: hidden;
        }

        /* ============================================
                                                                   PRODUCT DETAILS MODAL STYLES
                                                           ============================================ */

        .product-details-modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            background: #fff;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .25);
        }

        .product-modal-close {
            position: absolute;
            top: 18px;
            right: 18px;
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 50%;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(4px);
            color: #475569;
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
        }

        .product-modal-close:hover {
            background: #fff;
            color: #1e293b;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .15);
            transform: scale(1.05);
        }

        .product-modal-loader {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 500px;
            width: 100%;
            background: #fafcff;
        }

        .product-modal-loader .spinner-border {
            width: 50px;
            height: 50px;
            color: var(--primary);
        }

        .product-modal-image-wrap {
            background: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .product-modal-image-wrap img {
            width: 100%;
            height: 500px;
            object-fit: contain;
            display: block;
            background: #f8fafc;
            padding: 20px;
            transition: transform .3s ease;
        }

        .product-modal-image-wrap img:hover {
            transform: scale(1.02);
        }

        .product-modal-details {
            height: 500px;
            overflow-y: auto;
            padding: 30px 30px 20px;
            background: #fff;
        }

        .product-modal-details::-webkit-scrollbar {
            width: 4px;
        }

        .product-modal-details::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 20px;
        }

        .product-modal-details::-webkit-scrollbar-track {
            background: transparent;
        }

        .product-modal-category {
            display: inline-block;
            background: #eef5ff;
            color: var(--primary);
            font-size: 11px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 12px;
        }

        .product-modal-details h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 10px;
            line-height: 1.3;
        }

        .product-modal-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
        }

        .product-modal-rating .stars {
            color: #f59e0b;
            font-size: 14px;
        }

        .product-modal-rating .stars i {
            margin-right: 2px;
        }

        .product-modal-rating span:last-child {
            color: var(--muted);
            font-size: 13px;
        }

        .product-modal-price {
            font-size: 26px;
            font-weight: 800;
            color: var(--primary);
            margin: 12px 0 16px;
            padding: 0;
        }

        .product-modal-description {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 20px;
            padding: 16px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .product-modal-description p {
            margin: 0;
        }

        .product-modal-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 16px;
            margin-bottom: 22px;
        }

        .product-modal-info div {
            display: flex;
            flex-direction: column;
        }

        .product-modal-info div span {
            color: var(--muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 2px;
        }

        .product-modal-info div strong {
            color: var(--text);
            font-size: 14px;
            font-weight: 600;
        }

        .product-modal-action {
            margin-top: 8px;
        }

        .product-modal-action .add-to-cart-form {
            display: inline-block;
            width: 100%;
        }

        .product-modal-action .rec-add-cart {
            width: 100%;
            padding: 14px 24px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .product-modal-action .rec-add-cart:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(40, 120, 240, .3);
        }

        .product-modal-action .rec-add-cart:active {
            transform: translateY(0);
        }

        .product-modal-action .product-modal-add-cart {
            width: 100%;
            padding: 14px 24px;
            background: #e2e8f0;
            color: #94a3b8;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: not-allowed;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .product-modal-action .product-modal-notify {
            width: 100%;
            padding: 14px 24px;
            background: #f59e0b;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .product-modal-action .product-modal-notify:hover {
            background: #d97706;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(245, 158, 11, .3);
        }

        .product-modal-action .product-modal-notify:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .order-row {
                align-items: flex-start;
            }

            .order-meta {
                gap: 18px;
            }

            .order-actions {
                width: 100%;
            }

            .track-order-btn {
                width: 100%;
                justify-content: center;
            }

            .tracking-status-overview {
                align-items: flex-start;
                flex-direction: column;
            }

            .tracking-product-price {
                min-width: 90px;
            }

            .product-modal-image-wrap {
                height: 300px;
                min-height: 300px;
                max-height: 300px;
            }

            .product-modal-image-wrap img {
                height: 300px;
                padding: 15px;
            }

            .product-modal-details {
                height: auto;
                max-height: 400px;
                padding: 24px 20px 20px;
            }

            .product-modal-loader {
                min-height: 300px;
            }

            .product-modal-details h3 {
                font-size: 18px;
            }

            .product-modal-price {
                font-size: 22px;
            }

            .product-modal-info {
                grid-template-columns: 1fr 1fr;
                gap: 6px 12px;
            }

            .product-modal-close {
                top: 12px;
                right: 12px;
                width: 34px;
                height: 34px;
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .track-popup {
                padding: 8px;
            }

            .track-popup-content {
                max-height: 96vh;
                border-radius: 14px;
            }

            .track-popup-header {
                padding: 16px;
            }

            .track-popup-body {
                padding: 16px;
            }

            .tracking-action-info {
                flex-direction: column;
                align-items: stretch;
            }

            .cancel-order-btn {
                width: 100%;
            }

            .tracking-product-item {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .tracking-product-details {
                width: calc(100% - 87px);
            }

            .tracking-product-price {
                width: 100%;
                text-align: left;
                padding-left: 87px;
            }

            .tracking-summary {
                grid-template-columns: 1fr;
            }

            .tracking-summary-item,
            .tracking-summary-item:nth-child(odd) {
                border-right: 0;
            }

            .tracking-summary-item:nth-last-child(-n+2) {
                border-bottom: 1px solid var(--border);
            }

            .tracking-summary-item:last-child {
                border-bottom: 0;
            }

            .cancel-confirmation-actions {
                flex-direction: column;
            }

            .cancel-confirmation-actions button {
                width: 100%;
            }

            .product-modal-image-wrap {
                height: 240px;
                min-height: 240px;
                max-height: 240px;
            }

            .product-modal-image-wrap img {
                height: 240px;
                padding: 10px;
            }

            .product-modal-details {
                padding: 18px 16px 16px;
                max-height: 350px;
            }

            .product-modal-details h3 {
                font-size: 16px;
            }

            .product-modal-price {
                font-size: 20px;
            }

            .product-modal-info {
                grid-template-columns: 1fr 1fr;
                gap: 4px 8px;
            }

            .product-modal-info div strong {
                font-size: 13px;
            }

            .product-modal-action .rec-add-cart,
            .product-modal-action .product-modal-add-cart,
            .product-modal-action .product-modal-notify {
                font-size: 14px;
                padding: 12px 18px;
            }

            .product-details-modal-content {
                border-radius: 16px;
            }
        }

        /* ============================================
                                                   HORIZONTAL TIMELINE
                                                ============================================ */

        .tracking-timeline-horizontal {
            display: flex;
            align-items: flex-start;
            gap: 0;
            padding: 20px 10px 10px;
            overflow-x: auto;
            margin-bottom: 28px;
            position: relative;
        }

        .tracking-timeline-horizontal::-webkit-scrollbar {
            height: 4px;
        }

        .tracking-timeline-horizontal::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 20px;
        }

        .tracking-timeline-horizontal::-webkit-scrollbar-track {
            background: transparent;
        }

        .tracking-horizontal-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            min-width: 120px;
            max-width: 180px;
            position: relative;
        }

        .tracking-horizontal-icon-wrapper {
            display: flex;
            align-items: center;
            width: 100%;
            position: relative;
            margin-bottom: 12px;
        }

        .tracking-horizontal-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            position: relative;
            z-index: 2;
            transition: all .3s ease;
            border: 3px solid #e2e8f0;
        }

        .tracking-horizontal-item.completed .tracking-horizontal-icon {
            background: #eaf3ff;
            color: var(--primary);
            border-color: var(--primary);
        }

        .tracking-horizontal-item.current .tracking-horizontal-icon {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 5px rgba(40, 120, 240, .15);
            transform: scale(1.05);
        }

        .tracking-horizontal-line {
            flex: 1;
            height: 3px;
            background: #e2e8f0;
            margin: 0 -2px;
            transition: background .3s ease;
        }

        .tracking-horizontal-line.completed {
            background: var(--primary);
        }

        .tracking-horizontal-item:first-child .tracking-horizontal-line {
            margin-left: 0;
        }

        .tracking-horizontal-item:last-child .tracking-horizontal-line {
            display: none;
        }

        .tracking-horizontal-info {
            text-align: center;
            padding: 0 4px;
        }

        .tracking-horizontal-info h5 {
            margin: 0 0 4px;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.3;
        }

        .tracking-horizontal-info .tracking-current {
            display: inline-block;
            margin-left: 4px;
            padding: 2px 6px;
            border-radius: 8px;
            background: #eaf3ff;
            color: var(--primary);
            font-size: 8px;
            vertical-align: middle;
            font-weight: 700;
        }

        .tracking-horizontal-info p {
            margin: 0 0 4px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .tracking-horizontal-info small {
            color: #94a3b8;
            font-size: 9px;
            font-weight: 600;
        }

        .tracking-horizontal-item.completed .tracking-horizontal-info small {
            color: var(--success);
        }

        .tracking-horizontal-item.current .tracking-horizontal-info small {
            color: var(--primary);
            font-weight: 700;
        }

        .tracking-horizontal-item:not(.completed) .tracking-horizontal-info h5 {
            color: #94a3b8;
        }

        .tracking-horizontal-item:not(.completed) .tracking-horizontal-info p {
            color: #cbd5e1;
        }

        /* ============================================
                                                   MOBILE RESPONSIVE
                                                ============================================ */

        @media (max-width: 768px) {
            .tracking-timeline-horizontal {
                padding: 15px 5px 5px;
                gap: 0;
            }

            .tracking-horizontal-item {
                min-width: 100px;
                max-width: 140px;
            }

            .tracking-horizontal-icon {
                width: 38px;
                height: 38px;
                min-width: 38px;
                font-size: 15px;
            }

            .tracking-horizontal-info h5 {
                font-size: 11px;
            }

            .tracking-horizontal-info p {
                font-size: 9px;
            }

            .tracking-horizontal-info small {
                font-size: 8px;
            }
        }

        @media (max-width: 576px) {
            .tracking-timeline-horizontal {
                padding: 10px 2px 5px;
                gap: 0;
            }

            .tracking-horizontal-item {
                min-width: 80px;
                max-width: 110px;
            }

            .tracking-horizontal-icon {
                width: 32px;
                height: 32px;
                min-width: 32px;
                font-size: 13px;
                border-width: 2px;
            }

            .tracking-horizontal-info h5 {
                font-size: 10px;
            }

            .tracking-horizontal-info .tracking-current {
                font-size: 7px;
                padding: 1px 5px;
            }

            .tracking-horizontal-info p {
                font-size: 8px;
                -webkit-line-clamp: 1;
            }

            .tracking-horizontal-info small {
                font-size: 7px;
            }

            .tracking-horizontal-line {
                height: 2px;
            }
        }

        /* ============================================
                                                   RETURN ORDER STYLES
                                                ============================================ */

        .tracking-return-section {
            border: 1px solid #b7d7ff;
            background: #f5faff;
        }

        .return-order-btn {
            flex-shrink: 0;
            border: 1px solid var(--primary);
            color: var(--primary);
            background: #fff;
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .return-order-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        .return-confirmation {
            display: none;
            margin-bottom: 24px;
        }

        .return-confirmation.show {
            display: block;
        }

        .return-confirmation-content {
            padding: 22px;
            border: 1px solid #b7d7ff;
            background: #f5faff;
            border-radius: 14px;
            text-align: center;
        }

        .return-confirmation-icon {
            width: 55px;
            height: 55px;
            margin: 0 auto 13px;
            border-radius: 50%;
            background: #eaf3ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .return-confirmation-content h5 {
            margin-bottom: 7px;
            font-size: 17px;
            font-weight: 700;
            color: var(--text);
        }

        .return-confirmation-content p {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 18px;
        }

        .return-confirmation-content .form-label {
            color: var(--text);
            font-size: 12px;
            font-weight: 600;
        }

        .return-confirmation-content .form-control {
            border-radius: 8px;
            border-color: var(--border);
            padding: 10px 12px;
            font-size: 13px;
            resize: vertical;
        }

        .return-confirmation-content .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(40, 120, 240, .1);
        }

        .return-confirmation-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 18px;
        }

        .confirm-return-btn {
            border: 0;
            background: var(--primary);
            color: #fff;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .confirm-return-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 120, 240, .3);
        }

        .confirm-return-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 576px) {
            .return-confirmation-actions {
                flex-direction: column;
            }

            .return-confirmation-actions button {
                width: 100%;
            }
        }

        .order-rating-section {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5eaf1;
        }

        .rating-stars {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .rating-stars .star {
            font-size: 32px;
            color: #d1d5db;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .rating-stars .star:hover,
        .rating-stars .star.active {
            color: #fbbf24;
            transform: scale(1.1);
        }

        .rating-text {
            margin: 8px 0 0;
            font-size: 13px;
            color: #64748b;
        }
    </style>
@endsection

@section('content')
    <div class="orders-page">
        <div class="container">
            <div class="orders-header">
                <h2>My Orders</h2>
                <p>View, track and manage all your orders.</p>
            </div>
            <div class="orders-card">
                @forelse($orders as $order)
                    @php
                        $trackingStatus = strtolower($order->order_status ?? 'pending');
                        if ($trackingStatus === 'completed') {
                            $trackingStatus = 'delivered';
                        }
                        $statusClass = match ($trackingStatus) {
                            'confirmed',
                            'processing',
                            'packed',
                            'shipped',
                            'out_for_delivery' => 'status-processing',
                            'delivered' => 'status-delivered',
                            'return_requested' => 'status-return-requested',
                            'returned' => 'status-returned',
                            'refunded' => 'status-refunded',
                            'cancelled',
                            'failed' => 'status-cancelled',
                            default => 'status-pending',
                        };
                        $steps = [
                            'pending' => [
                                'title' => 'Order Placed',
                                'description' => 'Your order has been successfully placed.',
                                'icon' => 'bi-bag-check',
                            ],
                            'confirmed' => [
                                'title' => 'Order Confirmed',
                                'description' => 'Your order has been confirmed.',
                                'icon' => 'bi-patch-check',
                            ],
                            'processing' => [
                                'title' => 'Processing',
                                'description' => 'Your order is being prepared.',
                                'icon' => 'bi-gear',
                            ],
                            'packed' => [
                                'title' => 'Packed',
                                'description' => 'Your order has been packed and is ready for shipping.',
                                'icon' => 'bi-box-seam',
                            ],
                            'shipped' => [
                                'title' => 'Shipped',
                                'description' => 'Your order has been handed over for delivery.',
                                'icon' => 'bi-truck',
                            ],
                            'out_for_delivery' => [
                                'title' => 'Out For Delivery',
                                'description' => 'Your order is on the way to your address.',
                                'icon' => 'bi-truck-front',
                            ],
                            'delivered' => [
                                'title' => 'Delivered',
                                'description' => 'Your order has been successfully delivered.',
                                'icon' => 'bi-house-check',
                            ],
                        ];
                        $statusOrder = [
                            'pending' => 1,
                            'confirmed' => 2,
                            'processing' => 3,
                            'packed' => 4,
                            'shipped' => 5,
                            'out_for_delivery' => 6,
                            'delivered' => 7,
                        ];
                        $currentStep = $statusOrder[$trackingStatus] ?? 1;
                        $cancellationReason = $order->cancellation_reason ?? $order->cancel_reason ?? null;
                        $returnReason = $order->returned_reason ?? $order->return_reason ?? null;
                        $refundReason = $order->refund_reason ?? null;
                        $currentStatusData = $steps[$trackingStatus] ?? [
                            'title' => ucwords(str_replace('_', ' ', $trackingStatus)),
                            'description' => 'Your order status has been updated.',
                            'icon' => 'bi-info-circle',
                        ];
                    @endphp
                    <div class="order-row">
                        <div class="order-icon">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <div class="order-main">
                            <div class="order-number">
                                {{ $order->order_number }}
                            </div>
                            <div class="order-date">
                                Ordered on {{ $order->created_at?->format('d M Y, h:i A') }}
                            </div>
                        </div>
                        <div class="order-meta">
                            <div>
                                <div class="order-meta-label">Items</div>
                                <div class="order-meta-value">
                                    {{ $order->items_count ?? ($order->items?->count() ?? 0) }}
                                </div>
                            </div>
                            <div>
                                <div class="order-meta-label">Total</div>
                                <div class="order-meta-value">
                                    ₹{{ number_format($order->total ?? 0, 2) }}
                                </div>
                            </div>
                            <div>
                                <div class="order-meta-label">Status</div>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ ucwords(str_replace('_', ' ', $trackingStatus)) }}
                                </span>
                            </div>
                        </div>
                        <div class="order-actions">
                            <button type="button" class="track-order-btn" onclick="openTrackOrderModal({{ $order->id }})">
                                <i class="bi bi-truck"></i>
                                Track Order
                            </button>
                        </div>
                    </div>
                    <div class="track-popup" id="trackOrderPopup{{ $order->id }}"
                        onclick="closeTrackOrderOnOverlay(event, {{ $order->id }})">
                        <div class="track-popup-content">
                            <div class="track-popup-header">
                                <div>
                                    <h4>Track Order</h4>
                                    <span>
                                        {{ $order->order_number }}
                                    </span>
                                </div>
                                <button type="button" class="track-popup-close"
                                    onclick="closeTrackOrderModal({{ $order->id }})">
                                    &times;
                                </button>
                            </div>
                            <div class="track-popup-body">
                                <div class="tracking-status-overview">
                                    <div class="tracking-status-left">
                                        <div class="tracking-status-icon">
                                            <i class="bi {{ $currentStatusData['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <div class="tracking-status-title">
                                                {{ $currentStatusData['title'] }}
                                            </div>
                                            <div class="tracking-status-description">
                                                {{ $currentStatusData['description'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ ucwords(str_replace('_', ' ', $trackingStatus)) }}
                                    </span>
                                </div>
                                @if($trackingStatus === 'pending')
                                    <div class="tracking-action-section">
                                        <div class="tracking-action-info">
                                            <div>
                                                <h6>Need to cancel this order?</h6>
                                                <p>
                                                    You can cancel this order before it is confirmed and processed.
                                                </p>
                                            </div>
                                            <button type="button" class="cancel-order-btn"
                                                onclick="showCancelConfirmation({{ $order->id }})">
                                                <i class="bi bi-x-circle"></i>
                                                Cancel Order
                                            </button>
                                        </div>
                                    </div>
                                    <div class="cancel-confirmation" id="cancelConfirmation{{ $order->id }}">
                                        <div class="cancel-confirmation-content">
                                            <div class="cancel-confirmation-icon">
                                                <i class="bi bi-exclamation-triangle"></i>
                                            </div>
                                            <h5>Cancel this order?</h5>
                                            <p>
                                                Please select a reason before cancelling your order.
                                            </p>
                                            <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-3 text-start">
                                                    <label class="form-label">
                                                        Cancellation Reason
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="cancellation_reason" class="form-select" required>
                                                        <option value="">Select cancellation reason</option>
                                                        <option value="Changed my mind">Changed my mind</option>
                                                        <option value="Ordered by mistake">Ordered by mistake</option>
                                                        <option value="Found a better price">Found a better price</option>
                                                        <option value="Delivery time is too long">Delivery time is too long</option>
                                                        <option value="Incorrect address">Incorrect address</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="cancel-confirmation-actions">
                                                    <button type="button" class="btn btn-light"
                                                        onclick="hideCancelConfirmation({{ $order->id }})">
                                                        Keep Order
                                                    </button>
                                                    <button type="submit" class="confirm-cancel-btn">
                                                        <i class="bi bi-x-circle"></i>
                                                        Yes, Cancel Order
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $canReturn = false;

                                    if ($order->order_status === 'delivered' && $order->status_updated_at) {
                                        $canReturn = now()->lte(
                                            \Carbon\Carbon::parse($order->status_updated_at)->addDays(7)
                                        );
                                    }
                                @endphp
                                @if($trackingStatus === 'delivered')
                                    @if($canReturn)
                                        <div class="tracking-action-section tracking-return-section">
                                            <div class="tracking-action-info">
                                                <div>
                                                    <h6>Need to return this order?</h6>
                                                    <p>
                                                        You can request a return within 7 days of delivery.
                                                    </p>
                                                </div>

                                                <button type="button" class="return-order-btn"
                                                    onclick="showReturnConfirmation({{ $order->id }})">
                                                    <i class="bi bi-arrow-return-left"></i>
                                                    Return Order
                                                </button>

                                            </div>
                                        </div>
                                    @endif

                                    {{-- RETURN CONFIRMATION --}}
                                    <div class="return-confirmation" id="returnConfirmation{{ $order->id }}">
                                        <div class="return-confirmation-content">
                                            <div class="return-confirmation-icon">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </div>
                                            <h5>Request Return?</h5>
                                            <p>
                                                Please select a reason for returning this order.
                                            </p>
                                            <form action="{{ route('customer.orders.return', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="mb-3 text-start">
                                                    <label class="form-label">
                                                        Return Reason
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select name="return_reason" class="form-select" required>
                                                        <option value="">Select return reason</option>
                                                        <option value="Damaged product">Damaged product</option>
                                                        <option value="Wrong item sent">Wrong item sent</option>
                                                        <option value="Product not as described">Product not as described</option>
                                                        <option value="Size/color mismatch">Size/color mismatch</option>
                                                        <option value="Defective product">Defective product</option>
                                                        <option value="Changed mind">Changed mind</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 text-start">
                                                    <label class="form-label">Additional Notes (Optional)</label>
                                                    <textarea name="return_notes" class="form-control" rows="2"
                                                        placeholder="Please provide any additional details about your return request."></textarea>
                                                </div>
                                                <div class="return-confirmation-actions">
                                                    <button type="button" class="btn btn-light"
                                                        onclick="hideReturnConfirmation({{ $order->id }})">
                                                        Keep Order
                                                    </button>
                                                    <button type="submit" class="confirm-return-btn">
                                                        <i class="bi bi-arrow-return-left"></i>
                                                        Submit Return Request
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                @if($trackingStatus === 'return_requested')
                                    <div class="tracking-special-box returned">
                                        <div class="tracking-special-top">
                                            <div class="tracking-special-icon">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </div>

                                            <div class="tracking-special-content">
                                                <h5>Return Request Submitted</h5>

                                                <p>
                                                    Your return request has been submitted successfully.
                                                    Our team will review your request and update the return status.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="tracking-reason">
                                            <span>Return Reason</span>

                                            <strong>
                                                {{ $returnReason ?: 'No return reason was provided.' }}
                                            </strong>
                                        </div>

                                        @if($order->return_notes)
                                            <div class="tracking-reason">
                                                <span>Additional Notes</span>

                                                <strong>
                                                    {{ $order->return_notes }}
                                                </strong>
                                            </div>
                                        @endif

                                        @if($order->return_requested_at)
                                            <div class="tracking-reason">
                                                <span>Requested On</span>

                                                <strong>
                                                    {{ $order->return_requested_at->format('d M Y, h:i A') }}
                                                </strong>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if(in_array($trackingStatus, ['cancelled', 'failed']))
                                    <div class="tracking-special-box cancelled">
                                        <div class="tracking-special-top">
                                            <div class="tracking-special-icon">
                                                <i class="bi bi-x-circle"></i>
                                            </div>
                                            <div class="tracking-special-content">
                                                <h5>
                                                    Order {{ ucwords(str_replace('_', ' ', $trackingStatus)) }}
                                                </h5>
                                                <p>
                                                    This order is no longer being processed.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tracking-reason">
                                            <span>Cancellation Reason</span>
                                            <strong>
                                                {{ $cancellationReason ?: 'No cancellation reason was provided.' }}
                                            </strong>
                                        </div>
                                    </div>
                                @elseif($trackingStatus === 'returned')
                                    <div class="tracking-special-box returned">
                                        <div class="tracking-special-top">
                                            <div class="tracking-special-icon">
                                                <i class="bi bi-arrow-return-left"></i>
                                            </div>
                                            <div class="tracking-special-content">
                                                <h5>Order Returned</h5>
                                                <p>
                                                    Your order has been successfully returned.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tracking-reason">
                                            <span>Return Reason</span>
                                            <strong>
                                                {{ $returnReason ?: 'No return reason was provided.' }}
                                            </strong>
                                        </div>
                                    </div>
                                @elseif($trackingStatus === 'refunded')
                                    <div class="tracking-special-box refunded">
                                        <div class="tracking-special-top">
                                            <div class="tracking-special-icon">
                                                <i class="bi bi-cash-stack"></i>
                                            </div>
                                            <div class="tracking-special-content">
                                                <h5>Refund Processed</h5>
                                                <p>
                                                    Your refund has been successfully processed.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tracking-reason">
                                            <span>Refund Details</span>
                                            <strong>
                                                {{ $refundReason ?: 'Refund has been processed for this order.' }}
                                            </strong>
                                        </div>
                                    </div>
                                @endif
                                @if(
                                        !in_array($trackingStatus, [
                                            'cancelled',
                                            'failed',
                                            'return_requested',
                                            'returned',
                                            'refunded'
                                        ])
                                    )
                                    <h5 class="tracking-section-title">Order Status</h5>
                                    <div class="tracking-timeline-horizontal">
                                        @foreach($steps as $key => $step)
                                            @php
                                                $stepNumber = $statusOrder[$key];
                                                $isCompleted = $stepNumber <= $currentStep;
                                                $isCurrent = $stepNumber === $currentStep;
                                            @endphp
                                            <div
                                                class="tracking-horizontal-item {{ $isCompleted ? 'completed' : '' }} {{ $isCurrent ? 'current' : '' }}">
                                                <div class="tracking-horizontal-icon-wrapper">
                                                    <div class="tracking-horizontal-icon">
                                                        <i class="bi {{ $step['icon'] }}"></i>
                                                    </div>
                                                    @if(!$loop->last)
                                                        <div class="tracking-horizontal-line {{ $isCompleted ? 'completed' : '' }}"></div>
                                                    @endif
                                                </div>
                                                <div class="tracking-horizontal-info">
                                                    <h5>
                                                        {{ $step['title'] }}
                                                        @if($isCurrent)
                                                            <span class="tracking-current">Current</span>
                                                        @endif
                                                    </h5>
                                                    <p>{{ $step['description'] }}</p>
                                                    @if($isCompleted)
                                                        <small><i class="bi bi-check-circle"></i>
                                                            {{ $isCurrent ? 'Current Status' : 'Completed' }}</small>
                                                    @else
                                                        <small>Pending</small>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="tracking-products">
                                    <div class="tracking-products-header">
                                        <h5>
                                            <i class="bi bi-box-seam me-1"></i>
                                            Ordered Products
                                        </h5>
                                        <span>
                                            {{ $order->items_count ?? ($order->items?->count() ?? 0) }} Item(s)
                                        </span>
                                    </div>
                                    @forelse($order->items ?? [] as $item)
                                        @php
                                            $product = $item->product ?? null;
                                            $productName = $product->name ?? $item->product_name ?? $item->name ?? 'Product';
                                            $productSku = $product->sku ?? $item->sku ?? null;
                                            $quantity = $item->quantity ?? $item->qty ?? 1;
                                            $unitPrice = $item->price ?? $item->unit_price ?? 0;
                                            $subtotal = $item->subtotal ?? $item->total ?? ($unitPrice * $quantity);
                                            $productImage = $product->image ?? $product->image_path ?? $product->thumbnail ?? $item->image ?? null;
                                            if ($productImage && !\Illuminate\Support\Str::startsWith($productImage, ['http://', 'https://'])) {
                                                $productImage = asset('storage/' . ltrim($productImage, '/'));
                                            }
                                        @endphp
                                        <div class="tracking-product-item">
                                            @php
                                                $imageValue = $item->image;
                                                if (!$imageValue && $item->product) {
                                                    $imageValue = $item->product->image;
                                                }
                                                $images = $imageValue ? array_map('trim', explode(',', $imageValue)) : [];
                                                $firstImage = $images[0] ?? null;
                                                if ($firstImage) {
                                                    $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                                    $imgUrl = asset($firstImage);
                                                } else {
                                                    $imgUrl = null;
                                                }
                                            @endphp
                                            <div class="tracking-product-image product-details-trigger"
                                                data-product-id="{{ $product?->id }}" role="button" tabindex="0"
                                                title="View Product Details">

                                                @if($imgUrl)
                                                    <img src="{{ $imgUrl }}" alt="{{ $productName }}"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    <div class="tracking-product-placeholder" style="display:none;">
                                                        <i class="bi bi-image"></i>
                                                    </div>
                                                @else
                                                    <div class="tracking-product-placeholder">
                                                        <i class="bi bi-image"></i>
                                                    </div>
                                                @endif

                                                <div class="product-image-overlay">
                                                    <i class="bi bi-eye"></i>
                                                    <span>View</span>
                                                </div>
                                            </div>
                                            <div class="tracking-product-details">
                                                <div class="tracking-product-name">
                                                    {{ $productName }}
                                                </div>
                                                <div class="tracking-product-meta">
                                                    @if($productSku)
                                                        <span>
                                                            SKU: {{ $productSku }}
                                                        </span>
                                                    @endif
                                                    <span>
                                                        Qty: {{ $quantity }}
                                                    </span>
                                                    <span>
                                                        ₹{{ number_format($unitPrice, 2) }} each
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="tracking-product-price">
                                                <strong>
                                                    ₹{{ number_format($subtotal, 2) }}
                                                </strong>
                                                <span>
                                                    Subtotal
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="p-4 text-center text-muted">
                                            Product information is not available.
                                        </div>
                                    @endforelse
                                </div>
                                <h5 class="tracking-section-title">
                                    Order Details
                                </h5>
                                <div class="tracking-summary">
                                    <div class="tracking-summary-item">
                                        <span>Order Number</span>
                                        <strong>
                                            {{ $order->order_number }}
                                        </strong>
                                    </div>
                                    <div class="tracking-summary-item">
                                        <span>Order Date</span>
                                        <strong>
                                            {{ $order->created_at?->format('d M Y, h:i A') }}
                                        </strong>
                                    </div>
                                    <div class="tracking-summary-item">
                                        <span>Total Items</span>
                                        <strong>
                                            {{ $order->items_count ?? ($order->items?->count() ?? 0) }}
                                        </strong>
                                    </div>

                                    <div class="tracking-summary-item">
                                        <span>Total Qty</span>
                                        <strong>
                                            {{ $order->items?->sum('quantity') ?? 0 }}
                                        </strong>
                                    </div>
                                    <div class="tracking-summary-item">
                                        <span>Total Amount</span>
                                        <strong>
                                            ₹{{ number_format($order->total ?? 0, 2) }}
                                        </strong>
                                    </div>
                                    <div class="tracking-summary-item">
                                        <span>Current Status</span>
                                        <strong>
                                            {{ ucwords(str_replace('_', ' ', $trackingStatus)) }}
                                        </strong>
                                    </div>
                                    @if(in_array($trackingStatus, ['cancelled', 'failed']))
                                        <div class="tracking-summary-item">
                                            <span>Cancellation Reason</span>
                                            <strong>
                                                {{ $cancellationReason ?: 'Not provided' }}
                                            </strong>
                                        </div>
                                    @elseif($trackingStatus === 'returned')
                                        <div class="tracking-summary-item">
                                            <span>Return Reason</span>
                                            <strong>
                                                {{ $returnReason ?: 'Not provided' }}
                                            </strong>
                                        </div>
                                    @elseif($trackingStatus === 'refunded')
                                        <div class="tracking-summary-item">
                                            <span>Refund Status</span>
                                            <strong>
                                                Refund Processed
                                            </strong>
                                        </div>
                                    @endif
                                </div>

                                @if($trackingStatus === 'delivered')
                                    @if($item->rating)
                                        {{-- ALREADY RATED --}}
                                        <div class="order-rating-section">
                                            <h5 class="tracking-section-title">
                                                Your Rating for {{ $productName }}
                                            </h5>

                                            <div class="rating-stars saved-rating">
                                                @for($star = 1; $star <= 5; $star++)
                                                    <span class="star {{ $star <= $item->rating->rating ? 'active' : '' }}">
                                                        ★
                                                    </span>
                                                @endfor
                                            </div>

                                            <p class="rating-text">
                                                You rated this product {{ $item->rating->rating }} out of 5 stars.
                                            </p>
                                        </div>
                                    @else
                                        {{-- NOT RATED YET --}}
                                        <div class="order-rating-section">
                                            <h5 class="tracking-section-title">
                                                Rate {{ $productName }}
                                            </h5>

                                            <form action="{{ route('customer.orders.rating') }}" method="POST" class="rating-form">

                                                @csrf

                                                <input type="hidden" name="product_id" value="{{ $product?->id }}">
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <input type="hidden" name="order_item_id" value="{{ $item->id }}">
                                                <input type="hidden" name="rating" class="rating-input">

                                                <div class="rating-stars">
                                                    @for($star = 1; $star <= 5; $star++)
                                                        <span class="star" data-rating="{{ $star }}">★</span>
                                                    @endfor
                                                </div>

                                                <p class="rating-text">
                                                    Click on a star to rate this product
                                                </p>

                                                <button type="submit" class="btn btn-primary btn-sm mt-2 rating-submit-btn"
                                                    style="display:none;">
                                                    Submit Rating
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endif

                            </div>
                            <div class="track-popup-footer">
                                <button type="button" class="btn btn-light" onclick="closeTrackOrderModal({{ $order->id }})">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-orders">
                        <i class="bi bi-bag-x"></i>
                        <h4>No Orders Yet</h4>
                        <p>You haven't placed any orders yet.</p>
                        <a href="{{ route('customer.products') }}" class="btn btn-primary mt-2">
                            Start Shopping
                        </a>
                    </div>
                @endforelse
            </div>
            @if($orders->hasPages())
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

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

                        <div class="col-md-6">
                            <div class="product-modal-image-wrap">
                                <img id="modalProductImage" src="" alt="Product Image">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="product-modal-details">

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

@section('scripts')
    <script>
        function openTrackOrderModal(orderId) {
            const popup = document.getElementById('trackOrderPopup' + orderId);
            if (!popup) {
                console.error('Tracking popup not found:', orderId);
                return;
            }
            popup.classList.add('show');
            document.body.classList.add('track-popup-open');
        }

        function closeTrackOrderModal(orderId) {
            const popup = document.getElementById('trackOrderPopup' + orderId);
            if (!popup) {
                return;
            }
            popup.classList.remove('show');
            document.body.classList.remove('track-popup-open');
            hideCancelConfirmation(orderId);
        }

        function closeTrackOrderOnOverlay(event, orderId) {
            if (event.target === event.currentTarget) {
                closeTrackOrderModal(orderId);
            }
        }

        function showCancelConfirmation(orderId) {
            const confirmation = document.getElementById('cancelConfirmation' + orderId);
            if (confirmation) {
                confirmation.classList.add('show');
                confirmation.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }

        function hideCancelConfirmation(orderId) {
            const confirmation = document.getElementById('cancelConfirmation' + orderId);
            if (confirmation) {
                confirmation.classList.remove('show');
            }
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.track-popup.show').forEach(function (popup) {
                    popup.classList.remove('show');
                });
                document.querySelectorAll('.cancel-confirmation.show').forEach(function (confirmation) {
                    confirmation.classList.remove('show');
                });
                document.body.classList.remove('track-popup-open');
            }
        });

        document.addEventListener('DOMContentLoaded', function () {

            const modalElement = document.getElementById('productDetailsModal');

            if (!modalElement) {
                console.error('Product details modal not found.');
                return;
            }

            const productModal = new bootstrap.Modal(modalElement);

            const detailsUrl = "{{ url('/customer/product-details') }}";

            const loader = document.getElementById('productModalLoader');
            const content = document.getElementById('productModalContent');
            const image = document.getElementById('modalProductImage');
            const category = document.getElementById('modalProductCategory');
            const categoryInfo = document.getElementById('modalProductCategoryInfo');
            const name = document.getElementById('modalProductName');
            const price = document.getElementById('modalProductPrice');
            const description = document.getElementById('modalProductDescription');
            const stock = document.getElementById('modalProductStock');
            const action = document.getElementById('modalProductAction');

            document.addEventListener('click', function (event) {
                const trigger = event.target.closest('.product-details-trigger');
                if (!trigger) {
                    return;
                }
                const productId = trigger.dataset.productId;
                if (!productId) {
                    console.error('Product ID not found.');
                    return;
                }
                loadProductDetails(productId);
            });

            document.addEventListener('keydown', function (event) {
                if (event.key !== 'Enter' && event.key !== ' ') {
                    return;
                }
                const trigger = event.target.closest('.product-details-trigger');
                if (!trigger) {
                    return;
                }
                event.preventDefault();
                const productId = trigger.dataset.productId;
                if (!productId) {
                    return;
                }
                loadProductDetails(productId);
            });

            function loadProductDetails(productId) {

                loader.style.display = 'flex';
                content.style.display = 'none';

                image.src = '';
                image.alt = 'Product Image';
                category.textContent = '';
                categoryInfo.textContent = '';
                name.textContent = '';
                price.textContent = '';
                description.innerHTML = '';
                stock.textContent = '';
                action.innerHTML = '';

                productModal.show();

                fetch(detailsUrl + '/' + encodeURIComponent(productId), {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(async response => {
                        const contentType = response.headers.get('content-type') || '';
                        if (!contentType.includes('application/json')) {
                            throw new Error(
                                'Server returned an invalid response. Please check the product details route.'
                            );
                        }
                        const data = await response.json();
                        if (!response.ok) {
                            throw new Error(
                                data.message || 'Failed to load product details.'
                            );
                        }
                        return data;
                    })
                    .then(data => {
                        if (!data.success || !data.product) {
                            throw new Error('Product details not found.');
                        }

                        const product = data.product;

                        if (product.image) {
                            image.src = product.image;
                            image.alt = product.name || 'Product Image';
                            image.onerror = function () {
                                this.src = "{{ asset('images/no-image.png') }}";
                            };
                        } else {
                            image.src = "{{ asset('images/no-image.png') }}";
                            image.alt = 'No Image';
                        }

                        category.textContent = product.category || 'Product';
                        categoryInfo.textContent = product.category || 'N/A';
                        name.textContent = product.name || 'Product';
                        price.textContent = product.formatted_price || '₹0.00';
                        description.innerHTML = product.description || '<p>No description available.</p>';

                        if (product.is_out_of_stock) {
                            stock.textContent = 'Out of Stock';
                            stock.style.color = '#dc2626';
                        } else {
                            stock.textContent = 'In Stock';
                            stock.style.color = '#16a34a';
                        }

                        if (product.is_futured) {
                            action.innerHTML = `
                                                                                <button type="button"
                                                                                    class="product-modal-notify notify-me-btn"
                                                                                    data-product-id="${product.id}">
                                                                                    <i class="bi bi-bell me-2"></i>
                                                                                    Notify Me
                                                                                </button>
                                                                            `;
                        } else if (product.is_out_of_stock) {
                            action.innerHTML = `
                                                                                <button type="button"
                                                                                    class="product-modal-add-cart"
                                                                                    disabled>
                                                                                    <i class="bi bi-x-circle me-2"></i>
                                                                                    Out of Stock
                                                                                </button>
                                                                            `;
                        } else {
                            action.innerHTML = `
                                                                                <form class="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST">
                                                                                        @csrf

                                                                                        <button type="submit" class="rec-add-cart">
                                                                                            <i class="bi bi-cart3 me-1"></i>
                                                                                            Add to Cart
                                                                                        </button>
                                                                                    </form>
                                                                            `;
                        }

                        loader.style.display = 'none';
                        content.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Product Details Error:', error);
                        loader.style.display = 'none';
                        content.style.display = 'none';
                        productModal.hide();
                        if (typeof showSidebarToast === 'function') {
                            showSidebarToast(
                                'error',
                                'Error',
                                error.message || 'Failed to load product details.'
                            );
                        } else {
                            alert(
                                error.message || 'Failed to load product details.'
                            );
                        }
                    });
            }
        });
        function showReturnConfirmation(orderId) {
            const confirmation = document.getElementById('returnConfirmation' + orderId);
            if (confirmation) {
                confirmation.classList.add('show');
                confirmation.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }

        function hideReturnConfirmation(orderId) {
            const confirmation = document.getElementById('returnConfirmation' + orderId);
            if (confirmation) {
                confirmation.classList.remove('show');
            }
        }

        // Update the ESC key handler to also close return confirmation
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.track-popup.show').forEach(function (popup) {
                    popup.classList.remove('show');
                });
                document.querySelectorAll('.cancel-confirmation.show').forEach(function (confirmation) {
                    confirmation.classList.remove('show');
                });
                document.querySelectorAll('.return-confirmation.show').forEach(function (confirmation) {
                    confirmation.classList.remove('show');
                });
                document.body.classList.remove('track-popup-open');
            }
        });

        // Update closeTrackOrderModal to also hide return confirmation
        function closeTrackOrderModal(orderId) {
            const popup = document.getElementById('trackOrderPopup' + orderId);
            if (!popup) {
                return;
            }
            popup.classList.remove('show');
            document.body.classList.remove('track-popup-open');
            hideCancelConfirmation(orderId);
            hideReturnConfirmation(orderId);
        }
    </script>
    <script>
        document.querySelectorAll('.rating-form').forEach(form => {
            const stars = form.querySelectorAll('.star');
            const ratingInput = form.querySelector('.rating-input');
            const submitButton = form.querySelector('.rating-submit-btn');
            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const rating = parseInt(this.dataset.rating);
                    ratingInput.value = rating;
                    stars.forEach(item => {
                        item.classList.toggle(
                            'active',
                            parseInt(item.dataset.rating) <= rating
                        );
                    });
                    submitButton.style.display = 'inline-block';
                });
            });
        });
    </script>
@endsection
