@extends('frontend.layouts.customer-layout')

@section('title', 'Checkout - ShopEase')

@section('styles')
    <style>
        :root {
            --checkout-primary: #2878f0;
            --checkout-primary-dark: #1765d1;
            --checkout-text: #172033;
            --checkout-muted: #64748b;
            --checkout-border: #e5eaf1;
            --checkout-bg: #f8fafc;
            --checkout-green: #16a34a
        }

        .checkout-page {
            background: #f1f3f6;
            padding: 8px 0 35px
        }

        .checkout-header {
            background: #fff;
            padding: 14px 18px;
            margin-bottom: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08)
        }

        .checkout-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 42px
        }

        .continue-shopping {
            color: var(--checkout-primary);
            font-size: 13px;
            text-decoration: none
        }

        .continue-shopping:hover {
            color: var(--checkout-primary-dark)
        }

        .checkout-heading h1 {
            font-size: 20px;
            margin: 0;
            font-weight: 700
        }

        .secure-checkout {
            display: none
        }

        .checkout-steps {
            background: #fff;
            padding: 0 10px;
            margin-bottom: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        /* Mobile */
        @media (max-width: 576px) {
            .checkout-steps {
                padding: 0;
                margin-bottom: 8px;
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            .checkout-steps::-webkit-scrollbar {
                display: none;
            }

            .checkout-steps>* {
                min-width: max-content;
            }
        }

        .steps-wrapper {
            display: flex;
            gap: 0
        }

        .checkout-step {
            min-width: 180px;
            padding: 15px 35px 13px;
            border-bottom: 3px solid transparent;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkout-step:hover {
            background: #f8fafc;
        }

        .checkout-step.active {
            border-bottom-color: var(--checkout-primary)
        }

        .checkout-step.active .step-title {
            color: var(--checkout-primary)
        }

        .checkout-step.completed .step-title {
            color: var(--checkout-green)
        }

        .checkout-step.completed .step-number {
            background: var(--checkout-green);
            color: #fff;
        }

        .step-number {
            display: none
        }

        .step-title {
            font-size: 14px;
            color: #212121;
            font-weight: 600
        }

        .step-subtitle {
            display: none
        }

        .checkout-page>.row {
            max-width: 1200px;
            margin: auto
        }

        .checkout-card,
        .summary-card,
        .side-benefits,
        .checkout-benefits {
            background: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08)
        }

        .checkout-card {
            padding: 0;
            margin-bottom: 8px
        }

        .checkout-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 48px;
            padding: 14px 16px;
            margin: 0;
            border-bottom: 1px solid #f0f0f0
        }

        .checkout-card-icon {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #eef5ff;
            color: var(--checkout-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px
        }

        .checkout-card-header h5 {
            font-size: 15px;
            margin: 0;
            font-weight: 700
        }

        /* Payment Section */
        .payment-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .payment-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .address-section {
            padding: 12px 16px
        }

        .address-list {
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .address-card {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 16px;
            border: 2px solid #e5eaf1;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            position: relative
        }

        .address-card:hover {
            border-color: #b8d1ff;
            background: #f8fbff
        }

        .address-card.selected {
            border-color: var(--checkout-primary);
            background: #f8fbff;
            box-shadow: 0 0 0 3px rgba(40, 120, 240, 0.1)
        }

        .address-card .radio-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #d7d7d7;
            flex-shrink: 0;
            margin-top: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s
        }

        .address-card.selected .radio-indicator {
            border-color: var(--checkout-primary)
        }

        .address-card.selected .radio-indicator::after {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--checkout-primary)
        }

        .address-card .address-details {
            flex: 1;
            min-width: 0
        }

        .address-card .address-details .name {
            font-size: 14px;
            font-weight: 700;
            color: #212121;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .address-card .address-details .name .badge {
            font-size: 10px;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 12px;
            background: #f0f5ff;
            color: var(--checkout-primary)
        }

        .address-card .address-details .badge-default {
            background: #e8f5e9;
            color: #2e7d32
        }

        .address-card .address-details .address-line {
            font-size: 13px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 2px
        }

        .address-card .address-details .address-line .label {
            color: #888;
            font-weight: 500
        }

        .address-card .address-details .phone {
            font-size: 13px;
            color: #555;
            margin-top: 3px
        }

        .address-card .address-details .phone .label {
            color: #888;
            font-weight: 500
        }

        .address-card .address-actions {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
            margin-left: auto
        }

        .address-card .address-actions button {
            border: 0;
            background: transparent;
            padding: 4px 8px;
            font-size: 12px;
            color: var(--checkout-muted);
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.2s
        }

        .address-card .address-actions button:hover {
            background: #f0f0f0;
            color: var(--checkout-primary)
        }

        .address-card .address-actions .edit-btn {
            color: var(--checkout-primary)
        }

        .address-card .address-actions .edit-btn:hover {
            background: #e8f0fe
        }

        .address-card .address-actions .delete-btn {
            color: #ef4444
        }

        .address-card .address-actions .delete-btn:hover {
            background: #fef2f2
        }

        .address-card .address-tag {
            position: absolute;
            top: -8px;
            right: 16px;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 12px;
            border-radius: 12px;
            background: var(--checkout-primary);
            color: #fff
        }

        .no-address {
            text-align: center;
            padding: 40px 20px;
            color: var(--checkout-muted)
        }

        .no-address i {
            font-size: 40px;
            display: block;
            margin-bottom: 12px;
            color: #dce3ec
        }

        .no-address h6 {
            color: #212121;
            font-weight: 600;
            margin-bottom: 5px
        }

        .add-address-btn {
            margin: 0;
            padding: 0 16px 15px 44px;
            border: 0;
            background: transparent;
            color: var(--checkout-primary);
            cursor: pointer;
            font-weight: 600
        }

        .add-address-btn:hover {
            text-decoration: underline
        }

        .payment-method {
            display: flex;
            align-items: center;
            margin: 0 16px 10px;
            padding: 10px 14px;
            border: 1px solid var(--checkout-border);
            border-radius: 8px;
            cursor: pointer;
            transition: all .2s
        }

        .payment-method:hover {
            border-color: #b8d1ff
        }

        .payment-method.selected {
            border-color: #7aaafa;
            background: #fbfdff
        }

        .payment-radio {
            width: 16px;
            height: 16px;
            margin-right: 12px;
            accent-color: var(--checkout-primary)
        }

        .payment-method-info {
            flex: 1
        }

        .payment-method-title {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 2px
        }

        .payment-method-subtitle {
            font-size: 11px;
            color: var(--checkout-muted)
        }

        .payment-logos {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 700
        }

        .payment-logo-gpay {
            color: #4285f4
        }

        .payment-logo-phonepe {
            color: #6739b7
        }

        .payment-logo-paytm {
            color: #00a9e0
        }

        .payment-logo-visa {
            color: #1a3f8f
        }

        .payment-logo-mastercard {
            color: #e65a31
        }

        .payment-logo-rupay {
            color: #1556a5
        }

        .cart-item {
            display: grid;
            grid-template-columns: 85px minmax(0, 1fr) auto;
            gap: 12px;
            padding: 15px 12px;
            border-bottom: 1px solid #f0f0f0;
            align-items: center
        }

        .cart-item:last-child {
            border-bottom: 0
        }

        .cart-item-image {
            width: 85px;
            height: 95px;
            border: 1px solid #f0f0f0;
            border-radius: 4px;
            overflow: hidden;
            background: #fff
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .cart-item-info {
            min-width: 0
        }

        .cart-item-name {
            font-size: 14px;
            font-weight: 500;
            color: #212121;
            margin-bottom: 4px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden
        }

        .cart-item-price {
            font-size: 14px;
            font-weight: 600;
            color: #212121
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap
        }

        .cart-item-qty-select {
            height: 32px;
            border: 1px solid #d7d7d7;
            border-radius: 4px;
            padding: 0 8px;
            font-size: 13px;
            background: #fff;
            cursor: pointer;
            min-width: 60px
        }

        .cart-item-qty-select:focus {
            outline: none;
            border-color: var(--checkout-primary)
        }

        .cart-item-total {
            font-size: 14px;
            font-weight: 700;
            color: #212121;
            min-width: 80px;
            text-align: right
        }

        .remove-cart-btn {
            width: 30px;
            height: 30px;
            border: 0;
            background: transparent;
            color: #94a3b8;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s
        }

        .remove-cart-btn:hover {
            background: #fff1f2;
            color: #ef4444
        }

        .remove-cart-btn.loading {
            opacity: .5;
            pointer-events: none
        }

        .free-delivery-box {
            margin: 0;
            border-radius: 0;
            background: #f7fbff;
            border-top: 1px solid #f0f0f0;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px
        }

        .free-delivery-box i {
            color: var(--checkout-primary);
            font-size: 16px
        }

        .free-delivery-box strong {
            color: var(--checkout-primary);
            display: block;
            font-size: 12px
        }

        .free-delivery-box span {
            color: #5d7cad;
            display: block;
            font-size: 11px
        }

        .summary-card {
            padding: 0;
            position: sticky;
            top: 15px;
            overflow: hidden
        }

        .summary-header {
            padding: 14px 16px;
            margin: 0;
            border-bottom: 1px solid #eee;
            background: #fafafa
        }

        .summary-header h5 {
            font-size: 15px;
            margin: 0
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 16px;
            margin-bottom: 12px;
            font-size: 13px;
            color: #475569
        }

        .summary-row:first-of-type {
            margin-top: 15px
        }

        .summary-row strong {
            font-weight: 500;
            color: #212121
        }

        .free-shipping {
            color: var(--checkout-green);
            font-weight: 700
        }

        .discount-value {
            color: var(--checkout-green);
            font-weight: 700
        }

        .coupon-wrapper {
            padding: 0 16px;
            margin: 15px 0;
            display: flex;
            gap: 7px
        }

        .coupon-wrapper input {
            height: 38px;
            border: 1px solid #dbe2ea;
            border-radius: 2px;
            font-size: 12px;
            box-shadow: none
        }

        .coupon-wrapper input:focus {
            border-color: #7aaafa;
            box-shadow: 0 0 0 2px rgba(40, 120, 240, 0.08)
        }

        .coupon-wrapper button {
            height: 38px;
            border-radius: 2px;
            font-size: 12px;
            padding: 0 14px;
            white-space: nowrap
        }

        .summary-divider {
            margin: 0;
            border-top: 1px dashed #ddd
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 16px;
            margin: 0
        }

        .summary-total span {
            font-size: 14px;
            font-weight: 700
        }

        .summary-total strong {
            color: #212121;
            font-size: 18px;
            font-weight: 700
        }

        .tax-note {
            padding: 0 16px 15px;
            color: var(--checkout-muted);
            font-size: 11px
        }

        .continue-btn {
            width: 100%;
            margin: 0;
            border-radius: 0;
            height: 50px;
            background: #ffb300;
            color: #212121;
            box-shadow: none;
            font-size: 14px;
            font-weight: 700;
            border: 0;
            transition: .2s;
            cursor: pointer
        }

        .continue-btn:hover {
            background: #ffa000
        }

        .continue-btn:disabled {
            opacity: .7
        }

        .payment-btn {
            width: 100%;
            margin: 0;
            border-radius: 0;
            height: 50px;
            background: #2878f0;
            color: #fff;
            box-shadow: none;
            font-size: 14px;
            font-weight: 700;
            border: 0;
            transition: .2s;
            cursor: pointer
        }

        .payment-btn:hover {
            background: #1765d1
        }

        .payment-btn:disabled {
            opacity: .7
        }

        .side-benefits {
            padding: 16px
        }

        .side-benefit {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px
        }

        .side-benefit:last-child {
            margin-bottom: 0
        }

        .side-benefit-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f1f6ff;
            color: var(--checkout-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .side-benefit strong {
            display: block;
            font-size: 12px;
            color: #334155
        }

        .side-benefit span {
            display: block;
            font-size: 10px;
            color: var(--checkout-muted)
        }

        .checkout-benefits {
            max-width: 1200px;
            margin: 8px auto 0;
            padding: 15px
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .benefit-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #f1f6ff;
            color: var(--checkout-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0
        }

        .benefit-item strong {
            display: block;
            font-size: 12px;
            color: #334155
        }

        .benefit-item span {
            display: block;
            font-size: 10px;
            color: var(--checkout-muted)
        }

        .empty-cart {
            text-align: center;
            padding: 80px 20px
        }

        .empty-cart i {
            font-size: 60px;
            color: #dce3ec;
            display: block;
            margin-bottom: 15px
        }

        .empty-cart h4 {
            font-weight: 700;
            margin-bottom: 8px
        }

        .empty-cart p {
            color: var(--checkout-muted);
            font-size: 14px;
            margin-bottom: 20px
        }

        .toast-container-custom {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99999;
            max-width: 400px;
            width: calc(100% - 40px)
        }

        .toast-custom {
            background: #fff;
            border-radius: 8px;
            padding: 14px 17px;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.15);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 11px;
            animation: slideIn .3s ease;
            border-left: 4px solid #ccc
        }

        .toast-custom-success {
            border-left-color: #22c55e
        }

        .toast-custom-error {
            border-left-color: #ef4444
        }

        .toast-custom-info {
            border-left-color: #3b82f6
        }

        .toast-custom i {
            font-size: 19px
        }

        .toast-custom-success i {
            color: #22c55e
        }

        .toast-custom-error i {
            color: #ef4444
        }

        .toast-custom-info i {
            color: #3b82f6
        }

        .toast-close {
            background: none;
            border: 0;
            margin-left: auto;
            color: #94a3b8;
            font-size: 20px;
            cursor: pointer;
            padding: 0 0 0 8px
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0
            }

            to {
                transform: translateX(0);
                opacity: 1
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1
            }

            to {
                transform: translateX(100%);
                opacity: 0
            }
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99998;
            display: none;
            align-items: center;
            justify-content: center
        }

        .modal-overlay.active {
            display: flex
        }

        .modal-box {
            background: #fff;
            border-radius: 8px;
            padding: 24px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2)
        }

        .modal-box h4 {
            margin: 0 0 15px;
            font-weight: 700
        }

        .modal-box input {
            width: 100%;
            height: 44px;
            border: 1px solid #dbe2ea;
            border-radius: 4px;
            padding: 0 12px;
            font-size: 14px
        }

        .modal-box input:focus {
            outline: none;
            border-color: var(--checkout-primary)
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px
        }

        .modal-actions button {
            flex: 1;
            padding: 10px;
            border: 0;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer
        }

        .modal-actions .btn-primary {
            background: var(--checkout-primary);
            color: #fff
        }

        .modal-actions .btn-secondary {
            background: #e5eaf1;
            color: #212121
        }

        .current-location-box {
            margin: 0 16px 15px;
            padding: 14px;
            border: 1px solid #b8d1ff;
            border-radius: 8px;
            background: #f8fbff;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .current-location-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e8f1ff;
            color: var(--checkout-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 17px;
        }

        .current-location-content {
            flex: 1;
            min-width: 0;
        }

        .current-location-content>strong {
            display: block;
            font-size: 13px;
            color: #172033;
            margin-bottom: 3px;
        }

        .current-location-content>span {
            display: block;
            font-size: 11px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .location-coordinates {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 10px;
        }

        .location-coordinates small {
            font-size: 10px;
            color: #64748b;
        }

        .location-coordinates strong {
            color: #172033;
        }

        .use-location-btn {
            border: 0;
            background: var(--checkout-primary);
            color: #fff;
            border-radius: 5px;
            padding: 7px 12px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
        }

        .use-location-btn:hover {
            background: var(--checkout-primary-dark);
        }

        .address-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            backdrop-filter: blur(3px);
        }

        .address-modal-overlay.active {
            display: flex;
        }

        .address-modal {
            width: 100%;
            max-width: 500px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.25);
            overflow: hidden;
            animation: addressModalIn .25s ease;
        }

        @keyframes addressModalIn {
            from {
                opacity: 0;
                transform: translateY(15px) scale(.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .address-modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 20px 22px;
            border-bottom: 1px solid #eef0f3;
        }

        .address-modal-header h5 {
            margin: 0 0 4px;
            font-size: 17px;
            font-weight: 700;
            color: #172033;
        }

        .address-modal-header p {
            margin: 0;
            font-size: 12px;
            color: #64748b;
        }

        .address-modal-close {
            width: 32px;
            height: 32px;
            border: 0;
            border-radius: 6px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .address-modal-close:hover {
            background: #e2e8f0;
            color: #172033;
        }

        .address-options {
            padding: 16px;
        }

        .address-option {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 14px;
            text-align: left;
            border: 1px solid #e5eaf1;
            background: #fff;
            border-radius: 9px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all .2s ease;
        }

        .address-option:last-child {
            margin-bottom: 0;
        }

        .address-option:hover {
            border-color: #9fc1fa;
            background: #f8fbff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 120, 240, .08);
        }

        .address-option-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }

        .address-option-icon.location {
            background: #eaf2ff;
            color: var(--checkout-primary);
        }

        .address-option-icon.manual {
            background: #f1f5f9;
            color: #475569;
        }

        .address-option-content {
            flex: 1;
            min-width: 0;
        }

        .address-option-content strong {
            display: block;
            color: #172033;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .address-option-content span {
            display: block;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        .address-option-arrow {
            color: #94a3b8;
            font-size: 14px;
        }

        .location-result {
            padding: 18px 20px 20px;
            border-top: 1px solid #eef0f3;
        }

        .location-result-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .location-result-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #eaf2ff;
            color: var(--checkout-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .location-result-header strong {
            display: block;
            color: #172033;
            font-size: 13px;
            margin-bottom: 3px;
        }

        .location-result-header span {
            display: block;
            color: #64748b;
            font-size: 11px;
        }

        .detected-address {
            padding: 13px 14px;
            background: #f8fafc;
            border: 1px solid #e5eaf1;
            border-radius: 7px;
            color: #172033;
            font-size: 13px;
            line-height: 1.6;
            min-height: 48px;
        }

        .location-result-actions {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .location-cancel-btn,
        .use-location-btn {
            height: 40px;
            border-radius: 6px;
            padding: 0 15px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .location-cancel-btn {
            border: 1px solid #dbe2ea;
            background: #fff;
            color: #475569;
        }

        .location-cancel-btn:hover {
            background: #f8fafc;
        }

        .use-location-btn {
            flex: 1;
            border: 0;
            background: var(--checkout-primary);
            color: #fff;
        }

        .use-location-btn:hover {
            background: var(--checkout-primary-dark);
        }

        .use-location-btn:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .select-address-btn {
            border: 1px solid #dbe2ea;
            background: #fff;
            color: var(--checkout-primary);
            border-radius: 5px;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
        }

        .address-card.selected .select-address-btn {
            background: var(--checkout-primary);
            color: #fff;
            border-color: var(--checkout-primary);
        }

        @media(max-width:767px) {
            .checkout-heading {
                display: none
            }

            .checkout-step {
                min-width: 145px;
                padding: 13px 20px
            }

            .cart-item {
                grid-template-columns: 70px minmax(0, 1fr);
                padding: 12px 10px
            }

            .cart-item-image {
                width: 70px;
                height: 80px
            }

            .cart-item-name {
                font-size: 12px
            }

            .cart-item-price {
                font-size: 13px
            }

            .summary-card {
                position: static
            }

            .benefits-grid {
                grid-template-columns: 1fr 1fr
            }

            .payment-logos {
                display: none
            }

            .cart-item-actions {
                flex-wrap: wrap
            }

            .address-card {
                flex-wrap: wrap
            }

            .address-card .address-actions {
                width: 100%;
                justify-content: flex-end;
                margin-top: 5px
            }
        }

        @media(max-width:575px) {
            .secure-checkout {
                display: none
            }

            .step-subtitle {
                display: none
            }

            .address-content {
                padding-right: 0
            }

            .edit-address-btn {
                position: static;
                display: inline-block;
                margin-left: 32px;
                margin-top: 7px
            }

            .cart-item-image {
                width: 55px;
                height: 65px
            }

            .cart-item-name {
                font-size: 11px
            }

            .benefits-grid {
                grid-template-columns: 1fr
            }

            .address-modal-overlay {
                padding: 12px;
                align-items: flex-end;
            }

            .address-modal {
                border-radius: 14px 14px 8px 8px;
                max-width: 100%;
            }

            .address-modal-header {
                padding: 17px;
            }

            .address-options {
                padding: 12px;
            }

            .location-result {
                padding: 15px;
            }

            .location-result-actions {
                flex-direction: column;
            }

            .location-cancel-btn,
            .use-location-btn {
                width: 100%;
            }
        }

        /* Continue Button Disabled State */
        .continue-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #e5e7eb;
            color: #9ca3af;
        }

        .continue-btn:disabled:hover {
            background: #e5e7eb;
            color: #9ca3af;
        }

        /* Stock Status Styles */
        .stock-status {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 2px;
            margin-bottom: 6px;
        }

        .stock-status i {
            font-size: 14px;
        }

        .stock-status.in-stock {
            color: #16a34a;
        }

        .stock-status.low-stock {
            color: #f59e0b;
        }

        .stock-status.out-of-stock {
            color: #ef4444;
        }

        .cart-item-qty-select:disabled {
            background: #f3f4f6;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .cart-item-qty-select option:disabled {
            color: #9ca3af;
        }

        /* Out of stock item styling */
        .cart-item.out-of-stock-item {
            opacity: 0.6;
            background: #fef2f2;
        }

        .cart-item.out-of-stock-item .cart-item-name {
            color: #dc2626;
        }

        /* Confirmation Modal Styles */
        #confirmModal .modal-box {
            max-width: 450px !important;
            padding: 28px !important;
        }

        #confirmModal .modal-box h4 {
            margin: 0 0 8px !important;
            font-weight: 700 !important;
            color: #172033 !important;
        }

        #confirmModal .modal-box p {
            color: #64748b !important;
            font-size: 14px !important;
            margin: 0 !important;
        }

        #confirmModal .btn-secondary {
            flex: 1;
            padding: 12px;
            border: 1px solid #dbe2ea;
            background: #fff;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            color: #475569;
            transition: all 0.2s;
        }

        #confirmModal .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        #confirmModal .btn-primary {
            flex: 2;
            padding: 12px;
            border: 0;
            background: #2878f0;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            color: #fff;
            transition: all 0.2s;
        }

        #confirmModal .btn-primary:hover {
            background: #1765d1;
        }

        #confirmModal .btn-primary:disabled,
        #confirmModal .btn-secondary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')
    <div class="checkout-page">
        <div class="checkout-header">
            <div class="checkout-header-inner">
                <a href="{{ route('customer.products') }}" class="continue-shopping">
                    <i class="bi bi-arrow-left"></i> Continue Shopping
                </a>
                <div class="checkout-heading">
                    <h1>Checkout</h1>
                </div>
                <div class="secure-checkout">
                    <div class="secure-icon"><i class="bi bi-lock-fill"></i></div>
                    <div><strong>100% Secure Checkout</strong><span>SSL Encrypted</span></div>
                </div>
            </div>
        </div>

        {{-- STEPS --}}
        <div class="checkout-steps">
            <div class="steps-wrapper">
                <div class="checkout-step active" data-step="1" onclick="goToStep(1)">
                    <div class="step-number">1</div>
                    <div class="step-title">Delivery</div>
                    <div class="step-subtitle">Shipping Address</div>
                </div>
                <div class="checkout-step" data-step="2" onclick="goToStep(2)">
                    <div class="step-number">2</div>
                    <div class="step-title">Payment</div>
                    <div class="step-subtitle">Payment Method</div>
                </div>
                <div class="checkout-step" data-step="3" onclick="goToStep(3)">
                    <div class="step-number">3</div>
                    <div class="step-title">Review</div>
                    <div class="step-subtitle">Review Your Order</div>
                </div>
                <div class="checkout-step" data-step="4" onclick="goToStep(4)">
                    <div class="step-number">4</div>
                    <div class="step-title">Confirmation</div>
                    <div class="step-subtitle">Order Complete</div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-3">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-3">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if(!empty($cart) && count($cart) > 0)
            <div class="row g-3">
                <div class="col-lg-8">
                    {{-- DELIVERY ADDRESS SECTION --}}
                    <div id="deliverySection">
                        <div class="checkout-card">
                            <div class="checkout-card-header">
                                <div class="checkout-card-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <h5>Delivery Address</h5>
                            </div>
                            <div class="address-section">
                                @if(!empty($addresses) && count($addresses) > 0)
                                    <div class="address-list">
                                        @foreach($addresses as $address)
                                            @php
                                                $addressText = $address['address'] ?? '';
                                                if (is_array($addressText)) {
                                                    $addressText = implode(', ', array_filter($addressText));
                                                }
                                            @endphp
                                            <div class="address-card {{ !empty($address['is_default']) ? 'selected' : '' }}"
                                                data-address-id="{{ $address['id'] ?? '' }}">
                                                <div class="radio-indicator"></div>
                                                <div class="address-details">
                                                    <div class="name">
                                                        {{ $address['name'] ?? ($user->name ?? 'Customer') }}
                                                        @if(!empty($address['type']))
                                                            <span class="badge">{{ $address['type'] }}</span>
                                                        @endif
                                                        @if(!empty($address['is_default']))
                                                            <span class="badge badge-default">Default</span>
                                                        @endif
                                                    </div>
                                                    @if(!empty($address['mobile']))
                                                        <div class="phone">
                                                            <span class="label">Mobile:</span> {{ $address['mobile'] }}
                                                        </div>
                                                    @endif
                                                    @if(!empty($addressText))
                                                        <div class="address-line">{{ $addressText }}</div>
                                                    @endif
                                                    @if(!empty($address['city']) || !empty($address['state']))
                                                        <div class="address-line">
                                                            {{ $address['city'] ?? '' }}@if(!empty($address['city']) && !empty($address['state'])),
                                                            @endif{{ $address['state'] ?? '' }}
                                                        </div>
                                                    @endif
                                                    @if(!empty($address['country']) || !empty($address['pincode']))
                                                        <div class="address-line">
                                                            {{ $address['country'] ?? '' }}@if(!empty($address['country']) && !empty($address['pincode']))
                                                            - @endif{{ $address['pincode'] ?? '' }}
                                                        </div>
                                                    @endif
                                                </div>
                                                @if(!empty($address['is_default']))
                                                    <div class="address-tag">Selected</div>
                                                @endif
                                                <div class="address-actions">
                                                    <button type="button" class="select-address-btn"
                                                        data-address-id="{{ $address['id'] ?? '' }}">
                                                        <i class="bi bi-check-circle"></i> Select
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="no-address">
                                        <i class="bi bi-geo-alt"></i>
                                        <h6>No Saved Address</h6>
                                        <p>Add a delivery address to continue with your order.</p>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="add-address-btn" id="addAddressBtn">
                                <i class="bi bi-plus-lg"></i> Add Address
                            </button>
                        </div>

                        {{-- CART ITEMS --}}
                        <div class="checkout-card">
                            <div class="checkout-card-header">
                                <div class="checkout-card-icon">
                                    <i class="bi bi-bag-fill"></i>
                                </div>
                                <h5>Items in Your Cart ({{ $cartCount ?? count($cart) }})</h5>
                            </div>
                            <div id="cartItemsContainer">
                                @php
                                    $hasOutOfStock = false;
                                    $hasLowStock = false;
                                @endphp
                                @foreach($cart as $key => $item)
                                    @php
                                        // Get product from database to check stock
                                        $product = \App\Models\Product::find($item['id'] ?? null);
                                        $stock = $product ? $product->stock : 0;
                                        $isLowStock = $stock > 0 && $stock <= 5;
                                        $isOutOfStock = $stock <= 0;
                                        $currentQty = $item['quantity'] ?? 1;
                                        $canAddMore = $stock > $currentQty;

                                        if ($isOutOfStock) {
                                            $hasOutOfStock = true;
                                        }
                                        if ($isLowStock) {
                                            $hasLowStock = true;
                                        }
                                    @endphp
                                    <div class="cart-item" data-cart-key="{{ $key }}" data-price="{{ $item['price'] ?? 0 }}"
                                        data-stock="{{ $stock }}">
                                        <div class="cart-item-image">
                                            @php
                                                $imgUrl = null;
                                                if (isset($item['image'])) {
                                                    $images = is_array($item['image']) ? $item['image'] : array_map('trim', explode(',', $item['image']));
                                                    $firstImage = $images[0] ?? null;
                                                    if ($firstImage) {
                                                        $firstImage = preg_replace('#^storage/#', '', $firstImage);
                                                        $imgUrl = asset($firstImage);
                                                    }
                                                }
                                            @endphp
                                            @if($imgUrl)
                                                <img src="{{ $imgUrl }}" alt="{{ $item['name'] ?? 'Product' }}"
                                                    onerror="this.src='{{ asset('images/placeholder.png') }}'">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="cart-item-info">
                                            <div class="cart-item-name">{{ $item['name'] ?? 'Product' }}</div>
                                            <div class="cart-item-price">₹{{ number_format($item['price'] ?? 0, 0) }} per item</div>

                                            {{-- Stock Status --}}
                                            @if($isOutOfStock)
                                                <div class="stock-status out-of-stock">
                                                    <i class="bi bi-x-circle-fill"></i>
                                                    <span style="color: #ef4444; font-size: 12px; font-weight: 600;">Out of Stock</span>
                                                </div>
                                            @elseif($isLowStock)
                                                <div class="stock-status low-stock">
                                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                                    <span style="color: #f59e0b; font-size: 12px; font-weight: 600;">
                                                        Only {{ $stock }} {{ $stock == 1 ? 'item' : 'items' }} left in stock
                                                    </span>
                                                </div>
                                            @else
                                                <div class="stock-status in-stock">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span style="color: #16a34a; font-size: 12px; font-weight: 600;">In Stock</span>
                                                </div>
                                            @endif

                                            <div class="cart-item-actions">
                                                <select class="cart-item-qty-select" data-cart-key="{{ $key }}" {{ $isOutOfStock ? 'disabled' : '' }} data-max-stock="{{ $stock }}">
                                                    @if($isOutOfStock)
                                                        <option value="0" selected>Out of Stock</option>
                                                    @else
                                                        @php
                                                            $maxQty = min(5, $stock);
                                                        @endphp
                                                        @for($i = 1; $i <= $maxQty; $i++)
                                                            <option value="{{ $i }}" {{ ($item['quantity'] ?? 1) == $i ? 'selected' : '' }}>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                        @if($stock > 5)
                                                            <option value="more">More...</option>
                                                        @endif
                                                    @endif
                                                </select>
                                                <button type="button" class="remove-cart-btn" data-cart-key="{{ $key }}"
                                                    title="Remove from cart">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="cart-item-total" id="itemTotal-{{ $key }}">
                                            @if($isOutOfStock)
                                                <span style="color: #ef4444;">Unavailable</span>
                                            @else
                                                ₹{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 0) }}
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="free-delivery-box">
                                <i class="bi bi-truck"></i>
                                <div>
                                    <strong>Free Delivery on orders above ₹999</strong>
                                    <span>Yay! You've unlocked FREE shipping.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PAYMENT SECTION --}}
                    <div id="paymentSection" class="payment-section">
                        <div class="checkout-card">
                            <div class="checkout-card-header">
                                <div class="checkout-card-icon">
                                    <i class="bi bi-credit-card-fill"></i>
                                </div>
                                <h5>Payment Method</h5>
                            </div>

                            {{-- UPI --}}
                            <label class="payment-method selected">
                                <input type="radio" name="payment_method" value="upi" class="payment-radio" checked>
                                <div class="payment-method-info">
                                    <div class="payment-method-title">UPI / QR Code</div>
                                    <div class="payment-method-subtitle">Pay using any UPI app</div>
                                </div>
                                <div class="payment-logos">
                                    <span class="payment-logo-gpay">G Pay</span>
                                    <span class="payment-logo-phonepe">●</span>
                                    <span class="payment-logo-paytm">paytm</span>
                                </div>
                            </label>

                            {{-- Credit/Debit Card --}}
                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="card" class="payment-radio">
                                <div class="payment-method-info">
                                    <div class="payment-method-title">Credit / Debit Card</div>
                                    <div class="payment-method-subtitle">Visa, Mastercard, Rupay & more</div>
                                </div>
                                <div class="payment-logos">
                                    <span class="payment-logo-visa">VISA</span>
                                    <span class="payment-logo-mastercard">●●</span>
                                    <span class="payment-logo-rupay">RuPay</span>
                                </div>
                            </label>

                            {{-- Net Banking --}}
                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="netbanking" class="payment-radio">
                                <div class="payment-method-info">
                                    <div class="payment-method-title">Net Banking</div>
                                    <div class="payment-method-subtitle">All major banks</div>
                                </div>
                                <div class="payment-logos">
                                    <span>SBI</span>
                                    <span>HDFC</span>
                                    <span>ICICI</span>
                                </div>
                            </label>

                            {{-- Cash on Delivery --}}
                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="cod" class="payment-radio">
                                <div class="payment-method-info">
                                    <div class="payment-method-title">Cash on Delivery</div>
                                    <div class="payment-method-subtitle">Pay when you receive</div>
                                </div>
                                <div class="payment-logos">
                                    <i class="bi bi-cash-coin fs-5 text-success"></i>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div class="col-lg-4">
                    <div class="summary-card">
                        <div class="summary-header">
                            <h5>Price Details</h5>
                        </div>
                        <div class="summary-row">
                            <span>Price ({{ $cartCount ?? count($cart) }} items)</span>
                            <strong id="subtotalDisplay">₹{{ number_format($subtotal ?? 0, 0) }}</strong>
                        </div>
                        @php
                            $shippingAmount = $shipping ?? 0;
                            $discountAmount = $discount ?? 0;
                            $finalTotal = max(0, ($subtotal ?? 0) + $shippingAmount - $discountAmount);
                        @endphp
                        <div class="summary-row">
                            <span>Delivery Charges</span>
                            @if($shippingAmount > 0)
                                <strong>₹{{ number_format($shippingAmount, 0) }}</strong>
                            @else
                                <span class="free-shipping">FREE</span>
                            @endif
                        </div>
                        @if($discountAmount > 0)
                            <div class="summary-row">
                                <span>Discount</span>
                                <span class="discount-value">-₹{{ number_format($discountAmount, 0) }}</span>
                            </div>
                        @endif
                        <div class="coupon-wrapper">
                            <input type="text" id="couponCode" class="form-control" placeholder="Enter coupon code">
                            <button type="button" class="btn btn-outline-primary" id="applyCouponBtn">Apply</button>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-total">
                            <span>Subtotal</span>
                            <strong id="subtotalDisplay2">₹{{ number_format($finalTotal, 0) }}</strong>
                        </div>

                        <div class="summary-total coupon-discount-row" id="couponDiscountRow" style="display: none;">
                            <span>
                                Coupon Discount
                                <small id="appliedCouponCode"></small>
                            </span>
                            <strong class="text-success" id="discountDisplay">- ₹0</strong>
                        </div>

                        <div class="summary-total">
                            <span>Total Amount</span>
                            <strong id="totalDisplay" data-original-total="{{ $finalTotal }}">
                                ₹{{ number_format($finalTotal, 0) }}
                            </strong>
                        </div>
                        <div class="tax-note">Inclusive of applicable taxes</div>

                        {{-- CONTINUE BUTTON --}}
                        @php
                            $hasOutOfStock = false;
                            foreach ($cart as $item) {
                                $product = \App\Models\Product::find($item['id'] ?? null);
                                if ($product && $product->stock <= 0) {
                                    $hasOutOfStock = true;
                                    break;
                                }
                            }
                        @endphp

                        <button class="continue-btn" id="continueBtn" type="button" {{ $hasOutOfStock ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '' }}>
                            <i class="bi bi-arrow-right me-2"></i>
                            @if($hasOutOfStock)
                                Out of Stock Items in Cart
                            @else
                                Continue
                            @endif
                        </button>

                        @if($hasOutOfStock)
                            <div
                                style="padding: 8px 16px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 4px; margin-top: 10px; font-size: 12px; color: #dc2626;">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                Please remove out of stock items to proceed with checkout.
                            </div>
                        @endif

                        {{-- PLACE ORDER BUTTON --}}
                        <button class="payment-btn" id="placeOrderBtn" type="button" style="display:none;">
                            <i class="bi bi-lock-fill me-2"></i>Place Order
                        </button>

                        <div class="secure-note text-center text-muted small mt-3">
                            <i class="bi bi-shield-check me-1"></i>Safe and secure payments
                        </div>
                    </div>
                    <div class="side-benefits">
                        <div class="side-benefit">
                            <div class="side-benefit-icon"><i class="bi bi-shield-check"></i></div>
                            <div><strong>Secure Payments</strong><span>Your payment information is protected</span></div>
                        </div>
                        <div class="side-benefit">
                            <div class="side-benefit-icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                            <div><strong>Easy Returns</strong><span>Return options available as per product policy</span></div>
                        </div>
                        <div class="side-benefit">
                            <div class="side-benefit-icon"><i class="bi bi-headset"></i></div>
                            <div><strong>Customer Support</strong><span>We're here to help with your order</span></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BOTTOM BENEFITS --}}
            <div class="checkout-benefits">
                <div class="benefits-grid">
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="bi bi-truck"></i></div>
                        <div><strong>Free Shipping</strong><span>On orders above ₹999</span></div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="bi bi-arrow-repeat"></i></div>
                        <div><strong>7 Days Return</strong><span>Easy returns & refunds</span></div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="bi bi-lock"></i></div>
                        <div><strong>Secure Checkout</strong><span>100% protected payments</span></div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="bi bi-award"></i></div>
                        <div><strong>Best Quality</strong><span>Premium products only</span></div>
                    </div>
                </div>
            </div>
        @else
            <div class="checkout-card">
                <div class="empty-cart">
                    <i class="bi bi-cart-x"></i>
                    <h4>Your Cart is Empty</h4>
                    <p>Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('customer.products') }}" class="btn btn-primary">
                        <i class="bi bi-cart me-1"></i>Start Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>

    {{-- QUANTITY MODAL --}}
    <div class="modal-overlay" id="qtyModal">
        <div class="modal-box">
            <h4>Enter Quantity</h4>
            <input type="number" id="qtyInput" min="1" max="999" value="1">
            <div class="modal-actions">
                <button class="btn-secondary" id="qtyCancelBtn">Cancel</button>
                <button class="btn-primary" id="qtyConfirmBtn">Confirm</button>
            </div>
        </div>
    </div>

    {{-- TOAST --}}
    <div class="toast-container-custom" id="toastContainer"></div>
    {{-- CONFIRMATION MODAL --}}
    <div class="modal-overlay" id="confirmModal">
        <div class="modal-box" style="max-width: 450px;">
            <div style="text-align: center; margin-bottom: 20px;">
                <div
                    style="width: 60px; height: 60px; border-radius: 50%; background: #fef3c7; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 30px; color: #d97706;"></i>
                </div>
                <h4 style="margin: 0 0 8px; font-weight: 700; color: #172033;">Confirm Your Order</h4>
                <p style="color: #64748b; font-size: 14px; margin: 0;">Please review your order details before placing.</p>
            </div>

            <div style="background: #f8fafc; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                <div
                    style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e5eaf1;">
                    <span style="color: #64748b; font-size: 13px;">Items</span>
                    <span style="font-weight: 600; color: #172033; font-size: 13px;"
                        id="confirmItems">{{ $cartCount ?? 0 }}</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e5eaf1;">
                    <span style="color: #64748b; font-size: 13px;">Subtotal</span>
                    <span style="font-weight: 600; color: #172033; font-size: 13px;"
                        id="confirmSubtotal">₹{{ number_format($subtotal ?? 0, 0) }}</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e5eaf1;">
                    <span style="color: #64748b; font-size: 13px;">Delivery Charges</span>
                    <span style="font-weight: 600; color: #172033; font-size: 13px;" id="confirmShipping">FREE</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e5eaf1;">
                    <span style="color: #64748b; font-size: 13px;">Coupon Discount</span>
                    <span style="font-weight: 600; color: #16a34a; font-size: 13px;" id="confirmDiscount">- ₹0</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 10px 0;">
                    <span style="font-weight: 700; color: #172033; font-size: 15px;">Total Amount</span>
                    <span style="font-weight: 700; color: #2878f0; font-size: 18px;"
                        id="confirmTotal">₹{{ number_format($total ?? 0, 0) }}</span>
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <button class="btn-secondary" id="cancelOrderBtn"
                    style="flex: 1; padding: 12px; border: 1px solid #dbe2ea; background: #fff; border-radius: 6px; font-weight: 600; cursor: pointer; color: #475569;">
                    <i class="bi bi-x-lg me-1"></i> Cancel
                </button>
                <button class="btn-primary" id="confirmOrderBtn"
                    style="flex: 2; padding: 12px; border: 0; background: #2878f0; border-radius: 6px; font-weight: 600; cursor: pointer; color: #fff;">
                    <i class="bi bi-check-lg me-1"></i> Confirm Order
                </button>
            </div>
        </div>
    </div>

    {{-- ADD ADDRESS MODAL --}}
    <div class="address-modal-overlay" id="addressChoiceModal">
        <div class="address-modal">
            <div class="address-modal-header">
                <div>
                    <h5>Add Delivery Address</h5>
                    <p>Choose how you want to add your delivery address.</p>
                </div>
                <button type="button" class="address-modal-close" id="closeAddressModal">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="address-options" id="addressOptions">
                <button type="button" class="address-option" id="currentLocationOption">
                    <div class="address-option-icon location">
                        <i class="bi bi-crosshair"></i>
                    </div>
                    <div class="address-option-content">
                        <strong>Use Current Location</strong>
                        <span>Automatically detect your current area and address.</span>
                    </div>
                    <i class="bi bi-chevron-right address-option-arrow"></i>
                </button>
                <button type="button" class="address-option" id="manualAddressOption">
                    <div class="address-option-icon manual">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div class="address-option-content">
                        <strong>Enter Address Manually</strong>
                        <span>Add or manage your address from Account Settings.</span>
                    </div>
                    <i class="bi bi-chevron-right address-option-arrow"></i>
                </button>
            </div>
            <div class="location-result" id="locationResult" style="display:none;">
                <div class="location-result-header">
                    <div class="location-result-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <strong id="locationResultTitle">Current Location Found</strong>
                        <span id="modalLocationStatus">Finding your location...</span>
                    </div>
                </div>
                <div class="detected-address" id="modalDetectedAddress">
                    Detecting your address...
                </div>
                <div class="location-coordinates" id="modalLocationCoordinates" style="display:none;">
                    <span>Latitude: <strong id="modalLatitude"></strong></span>
                    <span>Longitude: <strong id="modalLongitude"></strong></span>
                </div>
                <div class="location-result-actions">
                    <button type="button" class="location-cancel-btn" id="locationBackBtn">
                        <i class="bi bi-arrow-left me-1"></i>Back
                    </button>
                    <button type="button" class="use-location-btn" id="modalUseLocationBtn" disabled>
                        <i class="bi bi-check-circle me-1"></i>Use This Location
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            var pendingQtyKey = null;
            var currentStep = 1;
            var isProcessingOrder = false;

            // ============================================================
            // TOAST NOTIFICATIONS
            // ============================================================
            function showToast(type, title, message) {
                var container = document.getElementById('toastContainer');
                if (!container) return;

                var toast = document.createElement('div');
                toast.className = 'toast-custom toast-custom-' + type;

                var icons = {
                    success: 'bi bi-check-circle-fill',
                    error: 'bi bi-exclamation-circle-fill',
                    info: 'bi bi-info-circle-fill'
                };

                toast.innerHTML =
                    '<i class="' + (icons[type] || icons.info) + '"></i>' +
                    '<div style="flex:1;"><strong style="display:block;margin-bottom:2px;">' + title + '</strong>' +
                    '<div style="font-size:13px;color:#64748b;">' + message + '</div></div>' +
                    '<button type="button" class="toast-close">&times;</button>';

                container.appendChild(toast);

                var closeBtn = toast.querySelector('.toast-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function () {
                        toast.remove();
                    });
                }

                setTimeout(function () {
                    if (toast.parentNode) {
                        toast.style.animation = 'slideOut 0.3s ease forwards';
                        setTimeout(function () { toast.remove(); }, 300);
                    }
                }, 4000);
            }

            // ============================================================
            // STEP NAVIGATION
            // ============================================================
            function goToStep(step) {
                currentStep = step;
                var deliverySection = document.getElementById('deliverySection');
                var paymentSection = document.getElementById('paymentSection');
                var continueBtn = document.getElementById('continueBtn');
                var placeOrderBtn = document.getElementById('placeOrderBtn');

                document.querySelectorAll('.checkout-step').forEach(function (el) {
                    var stepNum = parseInt(el.dataset.step);
                    el.classList.remove('active', 'completed');
                    if (stepNum < step) {
                        el.classList.add('completed');
                    } else if (stepNum === step) {
                        el.classList.add('active');
                    }
                });

                if (step === 1) {
                    deliverySection.style.display = 'block';
                    paymentSection.classList.remove('active');
                    continueBtn.style.display = 'block';
                    placeOrderBtn.style.display = 'none';
                } else if (step === 2) {
                    deliverySection.style.display = 'block';
                    paymentSection.classList.add('active');
                    continueBtn.style.display = 'none';
                    placeOrderBtn.style.display = 'block';
                }
            }

            window.goToStep = goToStep;

            // ============================================================
            // CONTINUE BUTTON
            // ============================================================
            var continueBtn = document.getElementById('continueBtn');
            if (continueBtn) {
                continueBtn.addEventListener('click', function () {
                    var selectedAddress = document.querySelector('.address-card.selected');
                    if (!selectedAddress) {
                        showToast('error', 'Address Required', 'Please select a delivery address.');
                        return;
                    }
                    goToStep(2);
                    showToast('success', 'Step 2', 'Proceed to payment method.');
                });
            }

            // ============================================================
            // ADDRESS SELECTION
            // ============================================================
            document.querySelectorAll('.address-card').forEach(function (card) {
                card.addEventListener('click', function (e) {
                    if (e.target.closest('.address-actions')) {
                        return;
                    }
                    document.querySelectorAll('.address-card').forEach(function (item) {
                        item.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    showToast('success', 'Address Selected', 'This address will be used for your delivery.');
                });
            });

            document.querySelectorAll('.select-address-btn').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var card = this.closest('.address-card');
                    if (!card) return;
                    document.querySelectorAll('.address-card').forEach(function (item) {
                        item.classList.remove('selected');
                    });
                    card.classList.add('selected');
                    showToast('success', 'Address Selected', 'This address will be used for your delivery.');
                });
            });

            // ============================================================
            // QUANTITY DROPDOWN
            // ============================================================
            document.querySelectorAll('.cart-item-qty-select').forEach(function (select) {
                select.addEventListener('change', function () {
                    var value = this.value;
                    var cartKey = this.dataset.cartKey;

                    if (value === 'more') {
                        pendingQtyKey = cartKey;
                        var modal = document.getElementById('qtyModal');
                        var input = document.getElementById('qtyInput');
                        if (modal) modal.classList.add('active');
                        if (input) input.value = 1;
                        this.value = 1;
                        return;
                    }

                    updateCartQuantity(cartKey, parseInt(value));
                });
            });

            // ============================================================
            // QUANTITY MODAL
            // ============================================================
            var qtyModal = document.getElementById('qtyModal');
            var qtyInput = document.getElementById('qtyInput');
            var qtyCancelBtn = document.getElementById('qtyCancelBtn');
            var qtyConfirmBtn = document.getElementById('qtyConfirmBtn');

            if (qtyCancelBtn) {
                qtyCancelBtn.addEventListener('click', function () {
                    if (qtyModal) qtyModal.classList.remove('active');
                    pendingQtyKey = null;
                });
            }

            if (qtyConfirmBtn) {
                qtyConfirmBtn.addEventListener('click', function () {
                    var qty = parseInt(qtyInput ? qtyInput.value : 1) || 1;
                    if (qty < 1) qty = 1;

                    if (pendingQtyKey) {
                        updateCartQuantity(pendingQtyKey, qty);

                        var select = document.querySelector('.cart-item-qty-select[data-cart-key="' + pendingQtyKey + '"]');
                        if (select) {
                            var optionExists = false;
                            select.querySelectorAll('option').forEach(function (opt) {
                                if (parseInt(opt.value) === qty) optionExists = true;
                            });
                            if (!optionExists) {
                                var newOption = document.createElement('option');
                                newOption.value = qty;
                                newOption.textContent = qty;
                                select.appendChild(newOption);
                            }
                            select.value = qty;
                        }
                    }

                    if (qtyModal) qtyModal.classList.remove('active');
                    pendingQtyKey = null;
                });
            }

            if (qtyModal) {
                qtyModal.addEventListener('click', function (e) {
                    if (e.target === this) {
                        this.classList.remove('active');
                        pendingQtyKey = null;
                    }
                });
            }

            // ============================================================
            // UPDATE CART QUANTITY
            // ============================================================
            function updateCartQuantity(cartKey, qty) {
                var row = document.querySelector('.cart-item[data-cart-key="' + cartKey + '"]');
                if (!row) return;

                var price = parseFloat(row.dataset.price) || 0;
                var total = price * qty;

                var totalElement = document.getElementById('itemTotal-' + cartKey);
                if (totalElement) {
                    totalElement.textContent = '₹' + total.toLocaleString('en-IN');
                }

                fetch('/cart/update/' + cartKey, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ quantity: qty })
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        if (data.success) {
                            if (data.subtotal !== undefined) updateTotals(data.subtotal);
                            if (data.cart_count !== undefined) updateCartCount(data.cart_count);
                            showToast('success', 'Updated', 'Quantity updated successfully.');
                        } else {
                            showToast('error', 'Error', data.message || 'Failed to update quantity.');
                        }
                    })
                    .catch(function (error) {
                        console.error('Update error:', error);
                        showToast('error', 'Error', 'Something went wrong.');
                    });
            }

            // ============================================================
            // REMOVE CART ITEM
            // ============================================================
            document.querySelectorAll('.remove-cart-btn').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var cartKey = this.dataset.cartKey;
                    var btn = this;
                    var row = this.closest('.cart-item');

                    if (!cartKey) {
                        showToast('error', 'Error', 'Invalid product key.');
                        return;
                    }

                    btn.disabled = true;
                    btn.classList.add('loading');
                    btn.innerHTML = '<i class="bi bi-hourglass-split"></i>';

                    fetch('/cart/remove/' + cartKey, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(function (response) {
                            if (!response.ok) {
                                return response.json().then(function (data) {
                                    throw new Error(data.message || 'Failed to remove item.');
                                });
                            }
                            return response.json();
                        })
                        .then(function (data) {
                            if (data.success) {
                                row.style.transition = 'all 0.3s ease';
                                row.style.opacity = '0';
                                row.style.transform = 'translateX(30px)';

                                setTimeout(function () {
                                    row.remove();
                                    showToast('success', 'Removed', 'Product removed from cart.');

                                    if (data.cart_count !== undefined) updateCartCount(data.cart_count);
                                    if (data.subtotal !== undefined) updateTotals(data.subtotal);

                                    if (document.querySelectorAll('.cart-item').length === 0) {
                                        showToast('info', 'Cart Empty', 'Your cart is empty. Redirecting...');
                                        setTimeout(function () {
                                            window.location.href = "{{ route('customer.products') }}";
                                        }, 800);
                                    }
                                }, 300);
                            } else {
                                showToast('error', 'Error', data.message || 'Failed to remove item.');
                                restoreRemoveButton(btn);
                            }
                        })
                        .catch(function (error) {
                            console.error('Cart remove error:', error);
                            showToast('error', 'Error', error.message || 'Something went wrong.');
                            restoreRemoveButton(btn);
                        });
                });
            });

            function restoreRemoveButton(button) {
                button.disabled = false;
                button.classList.remove('loading');
                button.innerHTML = '<i class="bi bi-trash3"></i>';
            }

            // ============================================================
            // UPDATE TOTALS
            // ============================================================
            function updateCartCount(count) {
                document.querySelectorAll('.checkout-card h5').forEach(function (title) {
                    if (title.textContent.includes('Items in Your Cart')) {
                        title.textContent = 'Items in Your Cart (' + count + ')';
                    }
                });
            }

            function updateTotals(subtotal) {
                var subtotalDisplay = document.getElementById('subtotalDisplay');
                var subtotalDisplay2 = document.getElementById('subtotalDisplay2');
                var totalDisplay = document.getElementById('totalDisplay');
                var formatted = Number(subtotal).toLocaleString('en-IN');
                if (subtotalDisplay) subtotalDisplay.textContent = '₹' + formatted;
                if (subtotalDisplay2) subtotalDisplay2.textContent = '₹' + formatted;
                if (totalDisplay) totalDisplay.textContent = '₹' + formatted;
            }

            // ============================================================
            // PAYMENT METHOD SELECTION
            // ============================================================
            document.querySelectorAll('.payment-method').forEach(function (method) {
                method.addEventListener('click', function () {
                    document.querySelectorAll('.payment-method').forEach(function (item) {
                        item.classList.remove('selected');
                    });
                    this.classList.add('selected');
                    var radio = this.querySelector('.payment-radio');
                    if (radio) radio.checked = true;
                });
            });

            // ============================================================
            // CONFIRMATION MODAL
            // ============================================================
            var confirmModal = document.getElementById('confirmModal');
            var cancelOrderBtn = document.getElementById('cancelOrderBtn');
            var confirmOrderBtn = document.getElementById('confirmOrderBtn');

            function showConfirmModal() {
                if (confirmModal) {
                    var subtotalEl = document.getElementById('subtotalDisplay');
                    var totalEl = document.getElementById('totalDisplay');
                    var discountEl = document.getElementById('discountDisplay');
                    var couponRow = document.getElementById('couponDiscountRow');

                    var confirmItems = document.getElementById('confirmItems');
                    var confirmSubtotal = document.getElementById('confirmSubtotal');
                    var confirmTotal = document.getElementById('confirmTotal');
                    var confirmDiscount = document.getElementById('confirmDiscount');

                    if (confirmItems) {
                        var itemsCount = document.querySelectorAll('.cart-item').length;
                        confirmItems.textContent = itemsCount;
                    }

                    if (confirmSubtotal && subtotalEl) {
                        confirmSubtotal.textContent = subtotalEl.textContent;
                    }

                    if (confirmTotal && totalEl) {
                        confirmTotal.textContent = totalEl.textContent;
                    }

                    if (confirmDiscount) {
                        if (couponRow && couponRow.style.display !== 'none' && discountEl) {
                            confirmDiscount.textContent = discountEl.textContent;
                            confirmDiscount.style.display = 'block';
                        } else {
                            confirmDiscount.textContent = '- ₹0';
                        }
                    }

                    confirmModal.classList.add('active');
                }
            }

            function closeConfirmModal() {
                if (confirmModal) {
                    confirmModal.classList.remove('active');
                }
            }

            if (cancelOrderBtn) {
                cancelOrderBtn.addEventListener('click', function () {
                    closeConfirmModal();
                });
            }

            if (confirmModal) {
                confirmModal.addEventListener('click', function (e) {
                    if (e.target === confirmModal) {
                        closeConfirmModal();
                    }
                });
            }

            // ============================================================
            // PLACE ORDER - Show Confirmation Modal
            // ============================================================
            var placeBtn = document.getElementById('placeOrderBtn');
            if (placeBtn) {
                placeBtn.addEventListener('click', function () {
                    showConfirmModal();
                });
            }

            // ============================================================
            // CONFIRM ORDER - Place the actual order
            // ============================================================
            if (confirmOrderBtn) {
                confirmOrderBtn.addEventListener('click', function () {
                    if (isProcessingOrder) return;

                    var btn = confirmOrderBtn;
                    var cancelBtn = cancelOrderBtn;

                    btn.disabled = true;
                    cancelBtn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

                    var selectedAddress = document.querySelector('.address-card.selected');
                    var addressId = selectedAddress ? selectedAddress.dataset.addressId : null;

                    var selectedPayment = document.querySelector('.payment-method.selected');
                    var paymentMethod = selectedPayment ? selectedPayment.querySelector('.payment-radio').value : 'upi';

                    if (!addressId) {
                        showToast('error', 'Error', 'Please select a delivery address.');
                        btn.disabled = false;
                        cancelBtn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Confirm Order';
                        return;
                    }

                    // For COD - place order directly
                    if (paymentMethod === 'cod') {
                        placeCodOrder(addressId, paymentMethod, btn, cancelBtn);
                    } else {
                        // For online payments (upi, card, netbanking) - create Razorpay order
                        // Pass the actual payment method to Razorpay
                        createRazorpayOrder(addressId, paymentMethod, btn, cancelBtn);
                    }
                });
            }

            // ============================================================
            // PLACE COD ORDER
            // ============================================================
            function placeCodOrder(addressId, paymentMethod, btn, cancelBtn) {
                var orderData = {
                    address_id: addressId,
                    payment_method: paymentMethod,
                    notes: ''
                };

                fetch('{{ route("checkout.place") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(orderData)
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        if (data.success) {
                            closeConfirmModal();
                            showToast('success', 'Success!', data.message);
                            setTimeout(function () {
                                window.location.href = data.redirect_url || '{{ route("customer.dashboard") }}';
                            }, 2000);
                        } else {
                            showToast('error', 'Error!', data.message || 'Failed to place order.');
                            btn.disabled = false;
                            cancelBtn.disabled = false;
                            btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Confirm Order';
                        }
                    })
                    .catch(function (error) {
                        console.error('Order error:', error);
                        showToast('error', 'Error!', 'Something went wrong. Please try again.');
                        btn.disabled = false;
                        cancelBtn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Confirm Order';
                    });
            }

            // ============================================================
            // CREATE RAZORPAY ORDER
            // ============================================================
            function createRazorpayOrder(addressId, paymentMethod, btn, cancelBtn) {
                isProcessingOrder = true;

                fetch('{{ route("checkout.create.razorpay.order") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        if (data.success) {
                            closeConfirmModal();
                            // Pass the payment method to Razorpay checkout
                            openRazorpayCheckout(data, addressId, paymentMethod);

                            setTimeout(function () {
                                btn.disabled = false;
                                cancelBtn.disabled = false;
                                btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Confirm Order';
                                isProcessingOrder = false;
                            }, 500);
                        } else {
                            showToast('error', 'Error!', data.message || 'Failed to initialize payment.');
                            btn.disabled = false;
                            cancelBtn.disabled = false;
                            btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Confirm Order';
                            isProcessingOrder = false;
                        }
                    })
                    .catch(function (error) {
                        console.error('Razorpay error:', error);
                        showToast('error', 'Error!', 'Something went wrong. Please try again.');
                        btn.disabled = false;
                        cancelBtn.disabled = false;
                        btn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Confirm Order';
                        isProcessingOrder = false;
                    });
            }


            // ============================================================
            // OPEN RAZORPAY CHECKOUT
            // ============================================================
            function openRazorpayCheckout(data, addressId, paymentMethod) {
                var options = {
                    key: data.key,
                    amount: data.amount,
                    currency: data.currency,
                    name: data.name,
                    description: data.description,
                    order_id: data.razorpay_order_id,
                    prefill: {
                        name: data.prefill.name,
                        email: data.prefill.email,
                        contact: data.prefill.contact
                    },
                    notes: data.notes,
                    handler: function (response) {
                        // Payment successful - verify
                        verifyRazorpayPayment(response, addressId, paymentMethod);
                    },
                    modal: {
                        ondismiss: function () {
                            isProcessingOrder = false;
                            var confirmBtn = document.getElementById('confirmOrderBtn');
                            var cancelBtn = document.getElementById('cancelOrderBtn');
                            if (confirmBtn) {
                                confirmBtn.disabled = false;
                                confirmBtn.innerHTML = '<i class="bi bi-check-lg me-1"></i> Confirm Order';
                            }
                            if (cancelBtn) {
                                cancelBtn.disabled = false;
                            }
                            showToast('info', 'Payment Cancelled', 'You cancelled the payment. You can try again.');
                        }
                    },
                    theme: {
                        color: '#2878f0'
                    }
                };

                var rzp = new Razorpay(options);
                rzp.open();
            }

            // ============================================================
            // VERIFY RAZORPAY PAYMENT
            // ============================================================
            function verifyRazorpayPayment(response, addressId, paymentMethod) {
                var placeBtn = document.getElementById('placeOrderBtn');
                if (placeBtn) {
                    placeBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Verifying...';
                }

                fetch('{{ route("checkout.verify.razorpay") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        address_id: addressId,
                        payment_method: paymentMethod // This will be 'razorpay'
                    })
                })
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        if (data.success) {
                            showToast('success', 'Payment Success!', data.message);
                            setTimeout(function () {
                                window.location.href = data.redirect_url || '{{ route("customer.dashboard") }}';
                            }, 2000);
                        } else {
                            showToast('error', 'Payment Failed!', data.message || 'Payment verification failed.');
                            if (placeBtn) {
                                placeBtn.disabled = false;
                                placeBtn.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Place Order';
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error('Verification error:', error);
                        showToast('error', 'Error!', 'Payment verification failed. Please contact support.');
                        if (placeBtn) {
                            placeBtn.disabled = false;
                            placeBtn.innerHTML = '<i class="bi bi-lock-fill me-2"></i>Place Order';
                        }
                    });
            }

            // ============================================================
            // COUPON APPLY
            // ============================================================
            const couponCodeInput = document.getElementById('couponCode');
            const applyCouponBtn = document.getElementById('applyCouponBtn');
            const totalDisplay = document.getElementById('totalDisplay');
            const discountDisplay = document.getElementById('discountDisplay');
            const couponDiscountRow = document.getElementById('couponDiscountRow');
            const appliedCouponCode = document.getElementById('appliedCouponCode');
            const originalTotal = parseFloat(totalDisplay.dataset.originalTotal) || 0;

            function formatAmount(amount) {
                return new Intl.NumberFormat('en-IN', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                }).format(amount);
            }

            if (applyCouponBtn) {
                applyCouponBtn.addEventListener('click', function () {
                    const couponCode = couponCodeInput.value.trim();

                    if (!couponCode) {
                        showToast('error', 'Coupon Required', 'Please enter a coupon code.');
                        return;
                    }

                    applyCouponBtn.disabled = true;
                    applyCouponBtn.innerHTML = 'Applying...';

                    fetch("{{ route('checkout.applyCoupon') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            coupon_code: couponCode,
                            order_amount: originalTotal
                        })
                    })
                        .then(response => {
                            return response.json().then(data => {
                                if (!response.ok) {
                                    throw new Error(data.message || 'Failed to apply coupon.');
                                }
                                return data;
                            });
                        })
                        .then(data => {
                            if (data.success) {
                                totalDisplay.textContent = '₹' + formatAmount(data.final_amount);
                                discountDisplay.textContent = '- ₹' + formatAmount(data.discount_amount);
                                couponDiscountRow.style.display = 'flex';
                                appliedCouponCode.textContent = '(' + data.coupon.code + ')';
                                couponCodeInput.value = data.coupon.code;
                                couponCodeInput.setAttribute('readonly', true);
                                applyCouponBtn.innerHTML = 'Applied ✅';
                                applyCouponBtn.classList.remove('btn-outline-primary');
                                applyCouponBtn.classList.add('btn-success');
                                showToast('success', 'Coupon Applied!', data.message);
                            } else {
                                showToast('error', 'Error', data.message || 'Failed to apply coupon.');
                                applyCouponBtn.disabled = false;
                                applyCouponBtn.innerHTML = 'Apply';
                            }
                        })
                        .catch(error => {
                            console.error('Coupon error:', error);
                            showToast('error', 'Coupon Error', error.message || 'Something went wrong while applying the coupon.');
                            applyCouponBtn.disabled = false;
                            applyCouponBtn.innerHTML = 'Apply';
                        });
                });
            }

            // ============================================================
            // ADDRESS MODAL
            // ============================================================
            var addAddressBtn = document.getElementById('addAddressBtn');
            var addressChoiceModal = document.getElementById('addressChoiceModal');
            var closeAddressModal = document.getElementById('closeAddressModal');
            var currentLocationOption = document.getElementById('currentLocationOption');
            var manualAddressOption = document.getElementById('manualAddressOption');
            var addressOptions = document.getElementById('addressOptions');
            var locationResult = document.getElementById('locationResult');
            var locationBackBtn = document.getElementById('locationBackBtn');
            var modalUseLocationBtn = document.getElementById('modalUseLocationBtn');
            var detectedLatitude = null;
            var detectedLongitude = null;
            var detectedLocationData = {
                address: '',
                city: '',
                state: '',
                country: '',
                pincode: ''
            };

            function closeAddressChoiceModal() {
                if (addressChoiceModal) {
                    addressChoiceModal.classList.remove('active');
                }
                if (addressOptions) {
                    addressOptions.style.display = 'block';
                }
                if (locationResult) {
                    locationResult.style.display = 'none';
                }
            }

            if (addAddressBtn) {
                addAddressBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    if (addressChoiceModal) {
                        addressChoiceModal.classList.add('active');
                    }
                    if (addressOptions) {
                        addressOptions.style.display = 'block';
                    }
                    if (locationResult) {
                        locationResult.style.display = 'none';
                    }
                });
            }

            if (closeAddressModal) {
                closeAddressModal.addEventListener('click', function () {
                    closeAddressChoiceModal();
                });
            }

            if (addressChoiceModal) {
                addressChoiceModal.addEventListener('click', function (e) {
                    if (e.target === addressChoiceModal) {
                        closeAddressChoiceModal();
                    }
                });
            }

            if (manualAddressOption) {
                manualAddressOption.addEventListener('click', function () {
                    window.location.href = "{{ route('account.settings') }}";
                });
            }

            if (currentLocationOption) {
                currentLocationOption.addEventListener('click', function () {
                    if (addressOptions) {
                        addressOptions.style.display = 'none';
                    }
                    if (locationResult) {
                        locationResult.style.display = 'block';
                    }
                    detectCurrentLocation();
                });
            }

            if (locationBackBtn) {
                locationBackBtn.addEventListener('click', function () {
                    if (locationResult) {
                        locationResult.style.display = 'none';
                    }
                    if (addressOptions) {
                        addressOptions.style.display = 'block';
                    }
                });
            }

            function detectCurrentLocation() {
                if (!navigator.geolocation) {
                    showToast('error', 'Location Not Supported', 'Your browser does not support location services.');
                    return;
                }

                var modalStatus = document.getElementById('modalLocationStatus');
                var modalAddress = document.getElementById('modalDetectedAddress');
                var modalUseBtn = document.getElementById('modalUseLocationBtn');

                if (modalStatus) {
                    modalStatus.textContent = 'Finding your current location...';
                }
                if (modalAddress) {
                    modalAddress.textContent = 'Please wait...';
                }
                if (modalUseBtn) {
                    modalUseBtn.disabled = true;
                    modalUseBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Detecting...';
                }

                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        detectedLatitude = position.coords.latitude;
                        detectedLongitude = position.coords.longitude;

                        var modalLat = document.getElementById('modalLatitude');
                        var modalLng = document.getElementById('modalLongitude');
                        var modalCoords = document.getElementById('modalLocationCoordinates');

                        if (modalLat) modalLat.textContent = detectedLatitude.toFixed(7);
                        if (modalLng) modalLng.textContent = detectedLongitude.toFixed(7);
                        if (modalCoords) modalCoords.style.display = 'flex';

                        if (modalStatus) {
                            modalStatus.textContent = 'GPS location detected. Finding address...';
                        }
                        if (modalAddress) {
                            modalAddress.textContent = 'Finding your address...';
                        }

                        var url = 'https://nominatim.openstreetmap.org/reverse' +
                            '?format=jsonv2' +
                            '&lat=' + encodeURIComponent(detectedLatitude) +
                            '&lon=' + encodeURIComponent(detectedLongitude) +
                            '&zoom=18' +
                            '&addressdetails=1';

                        fetch(url, {
                            headers: { 'Accept': 'application/json' }
                        })
                            .then(function (response) { return response.json(); })
                            .then(function (data) {
                                if (data && data.address) {
                                    var address = data.address;
                                    var area = address.suburb || address.neighbourhood || address.quarter || address.residential || address.village || '';
                                    var city = address.city || address.town || address.municipality || address.city_district || address.county || '';
                                    var state = address.state || '';
                                    var country = address.country || '';
                                    var pincode = address.postcode || '';

                                    var parts = [area, city, state, country, pincode].filter(Boolean);
                                    var readableAddress = parts.join(', ') || data.display_name || '';

                                    detectedLocationData = {
                                        address: readableAddress,
                                        city: city,
                                        state: state,
                                        country: country,
                                        pincode: pincode
                                    };

                                    if (modalStatus) {
                                        modalStatus.textContent = 'Address successfully determined.';
                                    }
                                    if (modalAddress) {
                                        modalAddress.textContent = readableAddress;
                                    }
                                    if (modalUseBtn) {
                                        modalUseBtn.disabled = false;
                                        modalUseBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i>Use This Location';
                                    }

                                    showToast('success', 'Location Found', 'Your address has been detected successfully.');
                                } else {
                                    throw new Error('Address could not be determined.');
                                }
                            })
                            .catch(function (error) {
                                if (modalStatus) {
                                    modalStatus.textContent = 'GPS detected but address could not be found.';
                                }
                                if (modalAddress) {
                                    modalAddress.textContent = 'Your GPS location was detected, but we could not determine the address. You can still use the GPS coordinates.';
                                }
                                if (modalUseBtn) {
                                    modalUseBtn.disabled = false;
                                    modalUseBtn.innerHTML = '<i class="bi bi-geo-alt-fill me-1"></i>Use GPS Location';
                                }
                                showToast('info', 'GPS Location', 'GPS detected but address could not be determined. You can still use the GPS coordinates.');
                            });
                    },
                    function (error) {
                        if (error.code === error.PERMISSION_DENIED) {
                            showToast('error', 'Location Permission', 'Please allow location access in your browser.');
                        } else if (error.code === error.POSITION_UNAVAILABLE) {
                            showToast('error', 'Location Unavailable', 'Unable to determine your current location.');
                        } else if (error.code === error.TIMEOUT) {
                            showToast('error', 'Location Timeout', 'Location detection took too long. Please try again.');
                        } else {
                            showToast('error', 'Location Error', 'Unable to detect your current location.');
                        }

                        if (modalUseBtn) {
                            modalUseBtn.disabled = false;
                            modalUseBtn.innerHTML = '<i class="bi bi-geo-alt-fill me-1"></i>Try Again';
                        }
                    }, {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }
                );
            }

            if (modalUseLocationBtn) {
                modalUseLocationBtn.addEventListener('click', function () {
                    if (detectedLatitude !== null && detectedLongitude !== null) {
                        var addressCard = document.querySelector('.address-card.selected');
                        if (addressCard) {
                            addressCard.classList.remove('selected');
                        }

                        var addressList = document.querySelector('.address-list');
                        if (addressList) {
                            var tempCard = document.createElement('div');
                            tempCard.className = 'address-card selected';
                            tempCard.dataset.addressId = 'current_location';
                            tempCard.innerHTML =
                                '<div class="radio-indicator"></div>' +
                                '<div class="address-details">' +
                                '<div class="name">' +
                                'Current Location' +
                                '<span class="badge">GPS</span>' +
                                '<span class="badge badge-default">Selected</span>' +
                                '</div>' +
                                '<div class="address-line">' + (detectedLocationData.address || 'GPS Location') +
                                '</div>' +
                                (detectedLocationData.city ? '<div class="address-line">' + detectedLocationData.city + '</div>' : '') +
                                (detectedLocationData.state ? '<div class="address-line">' + detectedLocationData.state + '</div>' : '') +
                                (detectedLocationData.pincode ? '<div class="address-line">Pincode: ' + detectedLocationData.pincode + '</div>' : '') +
                                '<div class="phone">Lat: ' + detectedLatitude.toFixed(6) + ', Lng: ' + detectedLongitude.toFixed(6) + '</div>' +
                                '</div>' +
                                '<div class="address-tag">Selected</div>';

                            addressList.appendChild(tempCard);

                            document.querySelectorAll('.address-card').forEach(function (card) {
                                if (card !== tempCard) {
                                    card.classList.remove('selected');
                                }
                            });
                        }

                        showToast('success', 'Location Selected', 'Your current location has been set as delivery address.');
                        closeAddressChoiceModal();
                    } else {
                        showToast('error', 'Error', 'Please detect your location first.');
                    }
                });
            }

            console.log('Checkout loaded successfully!');
        });
    </script>
@endsection
