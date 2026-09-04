@extends('frontend.layouts.app')
@section('title', $product->name . ' - Aethelweave')
@push('styles')
    <style>
        :root {
            --gold: #C9A96E;
            --gold-light: #F5EDE0;
            --gold-dark: #B8944C;
            --gold-glow: rgba(201, 169, 110, 0.15);
            --cream: #FDFBF7;
            --cream-dark: #F8F4EC;
            --border: #E8E0D4;
            --text: #2C2A29;
            --text-light: #7A7268;
            --white: #FFFFFF;
            --shadow: 0 8px 40px rgba(44, 42, 41, 0.06);
            --shadow-hover: 0 12px 60px rgba(201, 169, 110, 0.12)
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        .page-container {
            max-width: 1380px;
            margin: auto;
            padding: 20px 35px 80px
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            padding: 10px 0 30px;
            font-size: 11px;
            color: #A0988E;
            letter-spacing: .03em
        }

        .breadcrumb a {
            color: var(--gold);
            text-decoration: none;
            transition: .25s;
            font-weight: 500
        }

        .breadcrumb a:hover {
            color: var(--gold-dark)
        }

        .breadcrumb .current {
            color: var(--text);
            font-weight: 600
        }

        .breadcrumb .separator {
            color: #D5CDC2
        }

        .product-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border)
        }

        .gallery {
            display: grid;
            grid-template-columns: 80px 1fr;
            gap: 18px;
            position: sticky;
            top: 100px
        }

        .thumbnail-column {
            display: flex;
            flex-direction: column;
            gap: 10px
        }

        .thumbnail {
            width: 80px;
            height: 90px;
            border: 2px solid transparent;
            background: var(--cream-dark);
            cursor: pointer;
            overflow: hidden;
            border-radius: 10px;
            transition: .3s;
            position: relative
        }

        .thumbnail:hover {
            border-color: var(--gold-light)
        }

        .thumbnail.active {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px var(--gold-glow)
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .thumbnail-empty {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #CFC7BA;
            font-size: 24px
        }

        .main-gallery {
            position: relative;
            background: var(--cream-dark);
            border-radius: 16px;
            overflow: hidden
        }

        .main-gallery-image {
            width: 100%;
            height: 580px;
            object-fit: cover;
            transition: opacity .3s ease
        }

        .gallery-badge {
            position: absolute;
            top: 18px;
            left: 18px;
            background: var(--gold);
            color: var(--white);
            padding: 6px 16px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .15em;
            font-weight: 700;
            border-radius: 50px
        }

        .gallery-badge.featured {
            background: #2C3E50
        }

        .gallery-badge.popular {
            background: var(--gold)
        }

        .gallery-badge.new {
            background: var(--text)
        }

        /* Gallery Wishlist Button */
        .gallery-wishlist {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 5;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #E8E1D7;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 0;
            color: #77736D;
        }

        .gallery-wishlist:hover {
            background: #fff;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .gallery-wishlist i {
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .gallery-wishlist.active {
            border-color: #e74c3c;
            background: #fff;
        }

        .gallery-wishlist.active i {
            color: #e74c3c;
        }

        .gallery-wishlist.wishlist-active {
            border-color: #e74c3c;
            background: #fff;
        }

        .gallery-wishlist.wishlist-active i {
            color: #e74c3c;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .gallery-wishlist {
                top: 10px;
                right: 10px;
                width: 32px;
                height: 32px;
            }

            .gallery-wishlist i {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .gallery-wishlist {
                top: 8px;
                right: 8px;
                width: 28px;
                height: 28px;
            }

            .gallery-wishlist i {
                font-size: 12px;
            }
        }

        .gallery-expand {
            position: absolute;
            bottom: 16px;
            right: 16px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, .95);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .3s;
            color: var(--text-light)
        }

        .gallery-expand:hover {
            color: var(--gold);
            border-color: var(--gold)
        }

        .gallery-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, .95);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: .3s;
            color: var(--text)
        }

        .main-gallery:hover .gallery-arrow {
            opacity: 1
        }

        .gallery-arrow:hover {
            color: var(--gold);
            border-color: var(--gold)
        }

        .gallery-arrow.prev {
            left: 14px
        }

        .gallery-arrow.next {
            right: 14px
        }

        .product-info {
            padding-top: 4px
        }

        .product-label {
            display: inline-block;
            font-size: 10px;
            color: var(--gold-dark);
            text-transform: uppercase;
            letter-spacing: .2em;
            font-weight: 700;
            background: var(--gold-light);
            padding: 4px 14px;
            border-radius: 50px;
            margin-bottom: 12px
        }

        .product-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 36px;
            line-height: 1.08;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 6px
        }

        .product-sku {
            font-size: 11px;
            color: var(--text-light);
            margin-bottom: 14px;
            letter-spacing: .05em
        }

        .rating-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            font-size: 12px
        }

        .stars {
            color: var(--gold);
            letter-spacing: 3px;
            font-size: 15px
        }

        .rating-number {
            font-weight: 600;
            color: var(--text)
        }

        .review-link {
            color: var(--text-light);
            text-decoration: underline;
            font-weight: 400
        }

        .review-link:hover {
            color: var(--gold)
        }

        .price-row {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 6px;
            padding: 16px 0 12px;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border)
        }

        .product-price {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -.5px
        }

        .original-price {
            font-size: 17px;
            color: #B0A89C;
            text-decoration: line-through;
            font-weight: 400
        }

        .discount-badge {
            background: #FDF0E8;
            color: #B85C3A;
            padding: 3px 12px;
            font-size: 11px;
            font-weight: 700;
            border-radius: 50px
        }

        .payment-note {
            font-size: 12px;
            color: var(--text-light);
            margin: 8px 0 6px
        }

        .certified-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #E8F5E9;
            color: #2E7D32;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 600;
            margin: 4px 0 10px
        }

        .certified-badge i {
            font-size: 14px
        }

        .info-divider {
            height: 1px;
            background: var(--border);
            margin: 18px 0
        }

        .option-group {
            margin-bottom: 18px
        }

        .option-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px
        }

        .option-label span {
            font-weight: 400;
            color: var(--text-light)
        }

        .size-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px
        }

        .size-button {
            min-width: 52px;
            padding: 10px 16px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 11px;
            font-weight: 500;
            cursor: pointer;
            transition: .3s;
            color: var(--text)
        }

        .size-button:hover {
            border-color: var(--gold);
            color: var(--gold)
        }

        .size-button.active {
            background: var(--gold);
            color: var(--white);
            border-color: var(--gold)
        }

        .stock-status {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
            padding: 8px 14px;
            border-radius: 8px;
            width: fit-content
        }

        .stock-status.in {
            background: #E8F5E9;
            color: #2E7D32
        }

        .stock-status.out {
            background: #FDE8E8;
            color: #C0392B
        }

        .stock-status i {
            font-size: 16px
        }

        .quantity-area {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px
        }

        .quantity-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--text)
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid var(--border);
            border-radius: 8px;
            height: 42px;
            overflow: hidden
        }

        .quantity-control button {
            width: 36px;
            height: 100%;
            background: var(--white);
            border: 0;
            cursor: pointer;
            font-size: 16px;
            color: var(--text);
            transition: .2s
        }

        .quantity-control button:hover {
            background: var(--gold-light);
            color: var(--gold)
        }

        .quantity-control input {
            width: 44px;
            height: 100%;
            border: 0;
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            text-align: center;
            outline: none;
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
            background: var(--white)
        }

        .purchase-row {
            display: grid;
            grid-template-columns: 1fr 52px;
            gap: 10px;
            margin-bottom: 10px
        }

        .btn-add-cart {
            height: 52px;
            background: var(--gold);
            color: var(--white);
            border: 0;
            border-radius: 10px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: .12em;
            font-size: 12px;
            font-weight: 700;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px
        }

        .btn-add-cart:hover:not(:disabled) {
            background: var(--gold-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(201, 169, 110, 0.3)
        }

        .btn-add-cart:disabled {
            opacity: .5;
            cursor: not-allowed;
            transform: none !important
        }

        .btn-wishlist {
            height: 52px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 20px;
            cursor: pointer;
            transition: .3s;
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center
        }

        .btn-wishlist:hover {
            color: var(--gold);
            border-color: var(--gold);
            transform: translateY(-2px)
        }

        .btn-store {
            width: 100%;
            height: 44px;
            background: var(--cream-dark);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            text-transform: uppercase;
            letter-spacing: .08em;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px
        }

        .btn-store:hover {
            background: var(--gold-light);
            border-color: var(--gold);
            color: var(--gold-dark)
        }

        .view-count {
            text-align: center;
            font-size: 11px;
            color: var(--text-light);
            margin: 14px 0 0
        }

        .view-count i {
            margin-right: 4px
        }

        .quick-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px 20px;
            padding: 14px 0;
            border-top: 1px solid var(--border);
            margin-top: 6px
        }

        .quick-info-item {
            font-size: 11px;
            color: var(--text-light);
            display: flex;
            gap: 6px
        }

        .quick-info-item strong {
            color: var(--text);
            font-weight: 600
        }

        .benefits-bar {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 40px
        }

        .benefit-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden
        }

        .benefit-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gold);
            opacity: 0;
            transition: opacity 0.3s ease
        }

        .benefit-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(201, 169, 110, 0.12);
            border-color: var(--gold)
        }

        .benefit-card:hover::before {
            opacity: 1
        }

        .benefit-icon {
            width: 48px;
            height: 48px;
            min-width: 48px;
            background: var(--gold-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--gold);
            transition: all 0.3s ease
        }

        .benefit-card:hover .benefit-icon {
            background: var(--gold);
            color: var(--white);
            transform: scale(1.05)
        }

        .benefit-content {
            display: flex;
            flex-direction: column;
            gap: 2px
        }

        .benefit-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: 0.02em
        }

        .benefit-text {
            font-size: 11px;
            color: var(--text-light);
            font-weight: 400
        }

        .details-section {
            margin-top: 50px
        }

        .details-tabs {
            display: flex;
            gap: 8px;
            border-bottom: 2px solid var(--border);
            margin-bottom: 30px;
            overflow-x: auto;
            padding: 0 4px;
            background: var(--cream);
            border-radius: 14px 14px 0 0;
            padding: 6px 6px 0
        }

        .details-tab {
            padding: 14px 24px;
            border: 0;
            background: transparent;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: .08em;
            cursor: pointer;
            white-space: nowrap;
            position: relative;
            transition: all 0.3s ease;
            border-radius: 10px 10px 0 0;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .details-tab i {
            font-size: 14px
        }

        .details-tab[data-tab="specification"]:hover,
        .details-tab[data-tab="specification"].active {
            color: #B8944C;
            background: rgba(184, 148, 76, 0.08)
        }

        .details-tab[data-tab="specification"].active::after {
            background: #B8944C
        }

        .details-tab[data-tab="description"]:hover,
        .details-tab[data-tab="description"].active {
            color: #C9A96E;
            background: rgba(201, 169, 110, 0.08)
        }

        .details-tab[data-tab="description"].active::after {
            background: #C9A96E
        }

        .details-tab[data-tab="shipping"]:hover,
        .details-tab[data-tab="shipping"].active {
            color: #A58B54;
            background: rgba(165, 139, 84, 0.08)
        }

        .details-tab[data-tab="shipping"].active::after {
            background: #A58B54
        }

        .details-tab[data-tab="reviews"]:hover,
        .details-tab[data-tab="reviews"].active {
            color: #C89D91;
            background: rgba(200, 157, 145, 0.08)
        }

        .details-tab[data-tab="reviews"].active::after {
            background: #C89D91
        }

        .details-tab::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            right: 50%;
            height: 3px;
            border-radius: 3px 3px 0 0;
            transition: all 0.3s ease
        }

        .details-tab.active::after {
            left: 0;
            right: 0
        }

        .details-tab:hover::after {
            left: 10%;
            right: 10%
        }

        .tab-content {
            display: none;
            animation: fadeInTab 0.4s ease
        }

        .tab-content.active {
            display: block
        }

        @keyframes fadeInTab {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .details-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px
        }

        .description-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 28px 30px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03)
        }

        .description-card:hover {
            box-shadow: 0 8px 30px rgba(201, 169, 110, 0.08);
            border-color: var(--gold)
        }

        .description-card h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 24px;
            margin-bottom: 14px;
            color: var(--text)
        }

        .description-card .product-description {
            font-size: 13px;
            color: #5F5A55;
            line-height: 1.9
        }

        .description-card .product-description p {
            margin-bottom: 14px
        }

        .description-card .product-description ul,
        .description-card .product-description ol {
            padding-left: 22px;
            margin-top: 8px
        }

        .description-card .product-description li {
            margin-bottom: 6px
        }

        .spec-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 28px 30px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03)
        }

        .spec-card:hover {
            box-shadow: 0 8px 30px rgba(201, 169, 110, 0.08);
            border-color: var(--gold)
        }

        .spec-card h4 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 18px;
            margin-bottom: 16px;
            color: var(--text)
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 11px 0;
            border-bottom: 1px solid #F0EBE3
        }

        .spec-item:last-child {
            border-bottom: 0
        }

        .spec-icon {
            width: 28px;
            font-size: 18px;
            color: var(--gold);
            flex-shrink: 0
        }

        .spec-label {
            font-size: 10px;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 600
        }

        .spec-value {
            font-size: 12px;
            color: var(--text);
            font-weight: 500;
            margin-top: 2px
        }

        .review-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 24px;
            transition: all 0.3s ease
        }

        .review-card:hover {
            border-color: var(--gold);
            box-shadow: 0 4px 20px rgba(201, 169, 110, 0.08)
        }

        .review-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            flex-wrap: wrap;
            gap: 8px
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .reviewer-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text)
        }

        .review-date {
            font-size: 11px;
            color: var(--text-light)
        }

        .review-stars {
            color: var(--gold);
            font-size: 14px;
            letter-spacing: 2px
        }

        .review-text {
            font-size: 13px;
            color: #5F5A55;
            line-height: 1.7;
            margin: 0
        }

        .reviews-container {
            padding: 10px 0
        }

        .reviews-header {
            margin-bottom: 30px
        }

        .reviews-summary h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px;
            color: var(--text);
            margin-bottom: 8px
        }

        .reviews-rating {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .reviews-rating .stars {
            color: var(--gold);
            font-size: 20px;
            letter-spacing: 4px
        }

        .reviews-rating .rating-number {
            font-size: 18px;
            font-weight: 700;
            color: var(--text)
        }

        .reviews-rating .rating-total {
            font-size: 13px;
            color: var(--text-light)
        }

        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 16px
        }

        .related-section {
            margin-top: 60px
        }

        .related-heading {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 28px
        }

        .related-heading-left small {
            display: block;
            color: var(--gold);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .2em;
            font-weight: 700
        }

        .related-heading-left h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 32px;
            font-weight: 500;
            color: var(--text);
            margin-top: 2px
        }

        .view-all-link {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
            transition: .3s;
            border-bottom: 2px solid transparent;
            padding-bottom: 2px
        }

        .view-all-link:hover {
            border-bottom-color: var(--gold)
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px
        }

        .related-card {
            background: var(--white);
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: .3s
        }

        .related-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
            border-color: var(--gold)
        }

        .related-image {
            position: relative;
            aspect-ratio: 1/1.1;
            overflow: hidden;
            background: var(--cream-dark)
        }

        .related-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s ease
        }

        .related-card:hover .related-image img {
            transform: scale(1.06)
        }

        .related-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--gold);
            color: var(--white);
            padding: 4px 12px;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: .12em;
            font-weight: 700;
            border-radius: 50px
        }

        .related-wishlist {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: rgba(255, 255, 255, .95);
            cursor: pointer;
            font-size: 14px;
            color: var(--text-light);
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .related-wishlist:hover {
            color: var(--gold);
            border-color: var(--gold)
        }

        .related-content {
            padding: 14px 16px 18px
        }

        .related-category {
            font-size: 9px;
            color: var(--gold-dark);
            text-transform: uppercase;
            letter-spacing: .15em;
            font-weight: 700
        }

        .related-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 17px;
            font-weight: 600;
            margin: 3px 0 4px
        }

        .related-title a {
            color: var(--text);
            text-decoration: none;
            transition: .3s
        }

        .related-title a:hover {
            color: var(--gold)
        }

        .related-price {
            font-size: 14px;
            font-weight: 700;
            color: var(--text)
        }

        .related-original {
            font-size: 12px;
            color: #B0A89C;
            text-decoration: line-through;
            font-weight: 400;
            margin-left: 6px
        }

        .bottom-services {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-top: 60px;
            padding: 24px 30px;
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border)
        }

        .bottom-service {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px
        }

        .bottom-service i {
            font-size: 24px;
            color: var(--gold)
        }

        .bottom-service strong {
            display: block;
            font-size: 12px;
            color: var(--text)
        }

        .bottom-service span {
            font-size: 10px;
            color: var(--text-light)
        }

        .image-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .9);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 30px;
            backdrop-filter: blur(4px)
        }

        .image-modal.show {
            display: flex
        }

        .image-modal img {
            max-width: 92vw;
            max-height: 92vh;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 20px 80px rgba(0, 0, 0, .4)
        }

        .modal-close {
            position: absolute;
            top: 30px;
            right: 40px;
            color: #fff;
            font-size: 32px;
            cursor: pointer;
            opacity: .7;
            transition: .3s
        }

        .modal-close:hover {
            opacity: 1;
            transform: rotate(90deg)
        }

        @media(max-width:1100px) {
            .product-layout {
                padding: 30px;
                gap: 40px
            }

            .main-gallery-image {
                height: 500px
            }

            .product-title {
                font-size: 32px
            }

            .related-grid {
                grid-template-columns: repeat(3, 1fr)
            }
        }

        @media(max-width:900px) {
            .product-layout {
                grid-template-columns: 1fr;
                padding: 24px;
                gap: 30px
            }

            .gallery {
                position: relative;
                top: auto;
                grid-template-columns: 70px 1fr
            }

            .main-gallery-image {
                height: 480px
            }

            .thumbnail {
                width: 70px;
                height: 80px
            }

            .benefits-bar {
                grid-template-columns: repeat(2, 1fr)
            }

            .details-content {
                grid-template-columns: 1fr
            }

            .related-grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .bottom-services {
                grid-template-columns: 1fr
            }
        }

        @media(max-width:600px) {
            .page-container {
                padding: 10px 15px 40px
            }

            .breadcrumb {
                padding: 8px 0 20px;
                font-size: 10px
            }

            .product-layout {
                padding: 16px;
                border-radius: 12px
            }

            .gallery {
                display: flex;
                flex-direction: column-reverse;
                gap: 12px
            }

            .thumbnail-column {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 4px
            }

            .thumbnail {
                flex: 0 0 60px;
                width: 60px;
                height: 70px
            }

            .main-gallery-image {
                height: 360px
            }

            .product-title {
                font-size: 26px
            }

            .product-price {
                font-size: 22px
            }

            .price-row {
                flex-wrap: wrap;
                padding: 12px 0
            }

            .quick-info {
                grid-template-columns: 1fr
            }

            .benefits-bar {
                grid-template-columns: 1fr 1fr;
                padding: 16px 18px;
                gap: 14px
            }

            .details-tabs {
                gap: 4px;
                padding: 4px 4px 0;
                border-radius: 10px 10px 0 0
            }

            .details-tab {
                padding: 10px 14px;
                font-size: 9px;
                gap: 4px
            }

            .details-tab i {
                font-size: 11px
            }

            .description-card,
            .spec-card {
                padding: 18px 16px;
                border-radius: 10px
            }

            .review-card {
                padding: 16px 18px
            }

            .related-heading-left h2 {
                font-size: 24px
            }

            .related-grid {
                gap: 12px
            }

            .related-title {
                font-size: 14px
            }

            .related-price {
                font-size: 12px
            }

            .bottom-services {
                padding: 18px 16px;
                gap: 16px
            }

            .bottom-service {
                justify-content: flex-start
            }

            .purchase-row {
                grid-template-columns: 1fr
            }

            .btn-wishlist {
                height: 44px
            }
        }

        @media(max-width:400px) {
            .main-gallery-image {
                height: 300px
            }

            .product-title {
                font-size: 22px
            }

            .product-price {
                font-size: 20px
            }

            .size-button {
                min-width: 44px;
                padding: 8px 12px;
                font-size: 10px
            }

            .benefits-bar {
                grid-template-columns: 1fr
            }

            .related-grid {
                grid-template-columns: 1fr 1fr
            }

            .thumbnail {
                flex: 0 0 50px;
                width: 50px;
                height: 60px
            }

            .product-layout {
                padding: 12px
            }

            .details-tab {
                padding: 8px 10px;
                font-size: 8px
            }

            .details-tab i {
                font-size: 10px
            }

            .review-header {
                flex-direction: column;
                align-items: flex-start
            }

            .description-card,
            .spec-card {
                padding: 14px 12px
            }
        }
    </style>
@endpush
@section('content')
    <main class="page-container">
        <div class="breadcrumb">
            <a href="/">Home</a>
            <span class="separator">/</span>
            <a href="{{ route('shop.index') }}">Shop</a>
            @if($product->category)
                <span class="separator">/</span>
                <a href="{{ route('shop.index', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a>
            @endif
            <span class="separator">/</span>
            <span class="current">{{ $product->name }}</span>
        </div>
        <div class="product-layout">
            <div class="gallery">
                @php
                    $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                    $images = array_values(array_filter($images));
                    $firstImage = $images[0] ?? null;
                @endphp
                <div class="thumbnail-column">
                    @if(count($images))
                        @foreach($images as $index => $image)
                            <div class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                                onclick="changeProductImage('{{ asset($image) }}',this)">
                                <img src="{{ asset($image) }}" alt="{{ $product->name }}" loading="lazy">
                            </div>
                        @endforeach
                    @else
                        <div class="thumbnail">
                            <div class="thumbnail-empty"><i class="bi bi-image"></i></div>
                        </div>
                    @endif
                </div>
                <div class="main-gallery">
                    @if($firstImage)
                        <img id="mainProductImage" src="{{ asset($firstImage) }}" alt="{{ $product->name }}"
                            class="main-gallery-image">
                    @else
                        <div class="main-gallery-image" style="display:flex;align-items:center;justify-content:center;"><i
                                class="bi bi-image" style="font-size:60px;color:#D5CFC5;"></i></div>
                    @endif
                    @if($product->is_featured == 2)
                        <span class="gallery-badge featured">Featured</span>
                    @elseif($product->is_featured == 1)
                        <span class="gallery-badge popular">Popular</span>
                    @elseif($product->created_at >= now()->subDays(30))
                        <span class="gallery-badge new">New</span>
                    @endif
                    @php
                        $productId = $product->id;
                        $productName = $product->name;
                        $productPrice = $product->price;
                        $productSlug = $product->slug;
                        $images = $product->image ? array_map('trim', explode(',', $product->image)) : [];
                        $primaryImage = !empty($images) ? $images[0] : null;
                    @endphp
                    <button class="gallery-wishlist wishlist-btn" data-product-id="{{ $product->id }}"
                        data-product-name="{{ $product->name }}" data-product-price="{{ $product->selling_price }}"
                        data-product-slug="{{ $product->slug }}" data-product-image="{{ $primaryImage }}"
                        onclick="event.stopPropagation(); toggleWishlist(this, {{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->selling_price }}, '{{ $product->slug }}', '{{ $primaryImage }}', {{ $product->price }});"
                        aria-label="Add to wishlist">
                        <i class="bi bi-heart"></i>
                    </button>
                    @if(count($images) > 1)
                        <button class="gallery-arrow prev" onclick="previousImage()"><i class="bi bi-chevron-left"></i></button>
                        <button class="gallery-arrow next" onclick="nextImage()"><i class="bi bi-chevron-right"></i></button>
                    @endif
                    <button class="gallery-expand" onclick="openImageModal()"><i
                            class="bi bi-arrows-fullscreen"></i></button>
                </div>
            </div>
            <div class="product-info">
                <span class="product-label">{{ $product->category->name ?? 'Fine Jewellery' }}</span>
                <h1 class="product-title">{{ $product->name }}</h1>
                @if($product->sku)
                <div class="product-sku">SKU: {{ $product->sku }}</div>@endif
                <div class="rating-row">
                    <span class="stars">★★★★★</span>
                    <span class="rating-number">4.9</span>
                    <a href="#reviews" class="review-link">(120 Reviews)</a>
                </div>
                <div class="price-row">
                    {{-- Selling Price --}}
                    <span class="product-price" style="color:#198754;font-weight:700;">
                        ₹{{ number_format($product->selling_price, 2) }}
                    </span>

                    {{-- Original Price --}}
                    @if($product->price > $product->selling_price)
                        <span class="original-price" style="
                                                    color:#888;
                                                    text-decoration:line-through;
                                                    text-decoration-thickness:1px;
                                                    margin-left:6px;
                                                    font-size:13px;
                                                ">
                            ₹{{ number_format($product->price, 2) }}
                        </span>
                    @endif
                </div>
                <div class="certified-badge"><i class="bi bi-check-circle-fill"></i> BIS Hallmarked & Certified</div>
                <div class="payment-note"><i class="bi bi-shield-check"></i> Secure & trusted checkout</div>
                <div class="info-divider"></div>
                <div class="option-group">
                    <div class="option-label">Material <span>{{ $product->variants ?? 'Premium Jewellery' }}</span></div>
                </div>
                <div class="stock-status {{ $product->stock > 0 ? 'in' : 'out' }}">
                    <i class="bi bi-{{ $product->stock > 0 ? 'check-circle-fill' : 'x-circle-fill' }}"></i>
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    @if($product->stock > 0 && $product->stock < 10) — Only {{ $product->stock }} left @endif
                </div>
                <div class="purchase-row">
                    @if($product->stock > 0)
                        @auth
                            <button type="button" class="btn-add-cart add-to-cart-btn" data-product-id="{{ $product->id }}"
                                data-product-name="{{ addslashes($product->name) }}"
                                data-product-price="{{ $product->selling_price }}" data-product-slug="{{ $product->slug }}"
                                data-product-image="{{ $primaryImage }}"
                                onclick="event.stopPropagation(); addToCartFromCard(this, {{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->selling_price }}, '{{ $product->slug }}', '{{ $primaryImage }}', {{ $product->price }});">
                                <i class="bi bi-bag-plus"></i> <span class="btn-text">Make It Yours</span>
                            </button>
                        @else
                            <button type="button" class="btn-add-cart" onclick="window.location.href='{{ route('login') }}'">
                                <i class="bi bi-bag-plus"></i> Login to Buy
                            </button>
                        @endauth
                    @else
                        <button type="button" class="btn-add-cart" disabled>
                            Out of Stock
                        </button>
                    @endif
                </div>
                <div class="view-count">
                    <i class="bi bi-eye"></i>
                    <span id="viewCount"></span> people are viewing this item
                </div>
                <script>
                    let previous = parseInt(localStorage.getItem('viewCount')) || 10;
                    let current = previous + Math.floor(Math.random() * 2) + 2;
                    document.getElementById('viewCount').textContent = current;
                    localStorage.setItem('viewCount', current);
                </script>
                <div class="quick-info">
                    @if($product->brand)
                    <div class="quick-info-item"><strong>Brand:</strong> {{ $product->brand->name }}</div>@endif
                    @if($product->subCategory)
                    <div class="quick-info-item"><strong>Collection:</strong> {{ $product->subCategory->name }}</div>@endif
                    <div class="quick-info-item"><strong>Category:</strong>
                        {{ $product->category->name ?? 'Premium Rings' }}
                    </div>
                    <div class="quick-info-item"><strong>Shipping:</strong> Free over ₹999</div>
                </div>
            </div>
        </div>
        <div class="benefits-bar">
            <div class="benefit-card">
                <div class="benefit-icon"><i class="bi bi-shield-check"></i></div>
                <div class="benefit-content"><span class="benefit-title">BIS Hallmarked</span><span
                        class="benefit-text">Certified Jewellery</span></div>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon"><i class="bi bi-truck"></i></div>
                <div class="benefit-content"><span class="benefit-title">Free Shipping</span><span class="benefit-text">On
                        All Orders</span></div>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon"><i class="bi bi-arrow-return-left"></i></div>
                <div class="benefit-content"><span class="benefit-title">Easy Returns</span><span
                        class="benefit-text">15-Day Return Policy</span></div>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon"><i class="bi bi-gem"></i></div>
                <div class="benefit-content"><span class="benefit-title">Premium Quality</span><span
                        class="benefit-text">Crafted With Perfection</span></div>
            </div>
        </div>
        <section class="details-section" id="details">
            <div class="details-tabs">
                <button class="details-tab active" data-tab="specification" onclick="showTab('specification',this)"><i
                        class="bi bi-file-text"></i> Specification</button>
                <button class="details-tab" data-tab="description" onclick="showTab('description',this)"><i
                        class="bi bi-list-ul"></i> Description</button>
                <button class="details-tab" data-tab="shipping" onclick="showTab('shipping',this)"><i
                        class="bi bi-truck"></i> Shipping & Returns</button>
                <button class="details-tab" data-tab="reviews" onclick="showTab('reviews',this)"><i class="bi bi-star"></i>
                    Reviews (120)</button>
            </div>

            <!-- Specification Tab -->
            <div id="specification" class="tab-content active">
                <div class="details-content">
                    <div class="spec-card">
                        <h4>Product Specifications</h4>
                        @if($product->specification)
                            <div class="product-description" style="font-size:13px;color:#5F5A55;line-height:1.9;">
                                {!! $product->specification !!}
                            </div>
                        @else
                            <div class="spec-value">No specification available.</div>
                        @endif
                    </div>
                    <div class="spec-card">
                        <h4>Product Details</h4>
                        @if($product->variants)
                            <div class="spec-item">
                                <div class="spec-icon"><i class="bi bi-stars"></i></div>
                                <div>
                                    <div class="spec-label">Material</div>
                                    <div class="spec-value">{{ $product->variants }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-gem"></i></div>
                            <div>
                                <div class="spec-label">Stone Type</div>
                                <div class="spec-value">Premium Diamond</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-palette"></i></div>
                            <div>
                                <div class="spec-label">Metal Color</div>
                                <div class="spec-value">Gold</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-ring"></i></div>
                            <div>
                                <div class="spec-label">Ring Type</div>
                                <div class="spec-value">Diamond Ring</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-brush"></i></div>
                            <div>
                                <div class="spec-label">Finish</div>
                                <div class="spec-value">High Polish</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-stars"></i></div>
                            <div>
                                <div class="spec-label">Design</div>
                                <div class="spec-value">Elegant Solitaire Inspired Design</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-calendar-event"></i></div>
                            <div>
                                <div class="spec-label">Occasion</div>
                                <div class="spec-value">Engagement, Wedding, Party & Everyday Wear</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-person"></i></div>
                            <div>
                                <div class="spec-label">Gender</div>
                                <div class="spec-value">Women</div>
                            </div>
                        </div>
                        @if($product->sku)
                            <div class="spec-item">
                                <div class="spec-icon"><i class="bi bi-upc-scan"></i></div>
                                <div>
                                    <div class="spec-label">Item Code</div>
                                    <div class="spec-value">{{ $product->sku }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-weight-scale"></i></div>
                            <div>
                                <div class="spec-label">Weight</div>
                                <div class="spec-value">Approx. 2.5 g</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-globe2"></i></div>
                            <div>
                                <div class="spec-label">Country of Origin</div>
                                <div class="spec-value">India</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-info-circle"></i></div>
                            <div>
                                <div class="spec-label">Care Instructions</div>
                                <div class="spec-value">Avoid contact with perfumes, chemicals and moisture. Store in a
                                    jewellery box when not in use.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Tab -->
            <div id="description" class="tab-content" style="display:none;">
                <div class="details-content">
                    <div class="description-card">
                        <h3>Product Description</h3>
                        @if($product->description)
                            <div class="product-description">
                                {!! $product->description !!}
                            </div>
                        @else
                            <p>No description available.</p>
                        @endif
                    </div>
                    <div class="spec-card">
                        <h4>Why Choose This Piece</h4>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-award"></i></div>
                            <div>
                                <div class="spec-label">Quality</div>
                                <div class="spec-value">Premium certified jewellery</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-hand-index"></i></div>
                            <div>
                                <div class="spec-label">Craftsmanship</div>
                                <div class="spec-value">Expertly handcrafted</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-clock"></i></div>
                            <div>
                                <div class="spec-label">Durability</div>
                                <div class="spec-value">Long-lasting premium finish</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-heart"></i></div>
                            <div>
                                <div class="spec-label">Gift Ready</div>
                                <div class="spec-value">Perfect for special occasions</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Tab -->
            <div id="shipping" class="tab-content" style="display:none;">
                <div class="details-content">
                    <div class="description-card">
                        <h3>Shipping & Returns</h3>
                        <p>We carefully pack every order to make sure your jewellery reaches you safely and beautifully.</p>
                        <ul>
                            <li><strong>Free Shipping</strong> — On all orders across India</li>
                            <li><strong>Secure Packaging</strong> — Orders are carefully packed</li>
                            <li><strong>Pan India Delivery</strong> — Available across India</li>
                            <li><strong>Tracking</strong> — Details shared after dispatch</li>
                            <li><strong>Easy Returns</strong> — 15-day return policy</li>
                        </ul>
                        <p style="margin-top:12px;"><strong>Estimated Delivery:</strong> 5-7 business days</p>
                    </div>
                    <div class="spec-card">
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-box-seam"></i></div>
                            <div>
                                <div class="spec-label">Packaging</div>
                                <div class="spec-value">Premium Jewellery Box</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-arrow-counterclockwise"></i></div>
                            <div>
                                <div class="spec-label">Returns</div>
                                <div class="spec-value">Easy returns within 15 days</div>
                            </div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-icon"><i class="bi bi-headset"></i></div>
                            <div>
                                <div class="spec-label">Support</div>
                                <div class="spec-value">Available 24/7 for assistance</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="reviews" class="tab-content" style="display:none;">
                <div class="reviews-container">
                    <div class="reviews-header">
                        <div class="reviews-summary">
                            <h3>Customer Reviews</h3>
                            <div class="reviews-rating">
                                <span class="stars">★★★★★</span>
                                <span class="rating-number">4.9</span>
                                <span class="rating-total">(120 Reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="reviews-list">
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info"><span class="reviewer-name">Priya S.</span><span
                                        class="review-date">2 weeks ago</span></div>
                                <span class="review-stars">★★★★★</span>
                            </div>
                            <p class="review-text">"Absolutely stunning piece! The craftsmanship is exceptional and it looks
                                even more beautiful in person. Highly recommend!"</p>
                        </div>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info"><span class="reviewer-name">Rahul M.</span><span
                                        class="review-date">1 month ago</span></div>
                                <span class="review-stars">★★★★★</span>
                            </div>
                            <p class="review-text">"Perfect ring for my engagement! The diamond sparkles beautifully and the
                                gold finish is flawless. Love it!"</p>
                        </div>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-info"><span class="reviewer-name">Ananya P.</span><span
                                        class="review-date">2 months ago</span></div>
                                <span class="review-stars">★★★★★</span>
                            </div>
                            <p class="review-text">"The quality exceeded my expectations. Beautifully packaged and delivered
                                on time. Will definitely buy again!"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @php
            $recommendations = $relatedProducts ?? collect();
            if ($recommendations->count() < 4) {
                $additional = \App\Models\Product::where('id', '!=', $product->id)->where('stock', '>', 0)->when($product->category_id, fn($q) => $q->where('category_id', $product->category_id))->latest()->take(4 - $recommendations->count())->get();
                $recommendations = $recommendations->merge($additional);
            }
            $recommendations = $recommendations->where('id', '!=', $product->id)->where('stock', '>', 0)->unique('id')->take(4);
        @endphp
        @if($recommendations->count())
            <section class="related-section">
                <div class="related-heading">
                    <div class="related-heading-left">
                        <small>Curated For You</small>
                        <h2>You May Also Like</h2>
                    </div>
                    <a href="{{ route('shop.index') }}" class="view-all-link">View All →</a>
                </div>
                <div class="related-grid">
                    @foreach($recommendations as $related)
                        @php
                            $relImages = $related->image ? array_map('trim', explode(',', $related->image)) : [];
                            $relFirst = $relImages[0] ?? null;
                            $productId = $related->id;
                            $productName = $related->name;
                            $productPrice = $related->price;
                            $productSlug = $related->slug;
                        @endphp
                        <!-- Entire card is clickable -->
                        <div class="related-card" style="position:relative;cursor:pointer;"
                            onclick="window.location.href='{{ route('shop.show', $related->slug) }}'">
                            <div class="related-image" style="position:relative;">
                                @if($relFirst)
                                    <img src="{{ asset($relFirst) }}" alt="{{ $related->name }}" loading="lazy">
                                @else
                                    <div
                                        style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#D5CFC5;">
                                        <i class="bi bi-image" style="font-size:40px;"></i>
                                    </div>
                                @endif
                                @if($related->created_at >= now()->subDays(30))
                                    <span class="related-badge">New</span>
                                @endif

                                <!-- Wishlist Button (stops propagation to prevent redirect) -->
                                <button class="related-wishlist wishlist-btn" data-product-id="{{ $productId }}"
                                    data-product-name="{{ addslashes($productName) }}"
                                    data-product-selling-price="{{ $related->selling_price }}"
                                    data-product-slug="{{ $productSlug }}" data-product-image="{{ $relFirst }}"
                                    onclick="event.stopPropagation(); toggleWishlist(this, {{ $productId }}, '{{ addslashes($productName) }}', {{ $related->selling_price }}, '{{ $productSlug }}', '{{ $relFirst }}', {{ $related->price }});"
                                    aria-label="Add to wishlist">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </div>
                            <div class="related-content">
                                <div class="related-category">{{ $related->category->name ?? 'Jewellery' }}</div>
                                <h3 class="related-title">
                                    {{ Str::limit($related->name, 32) }}
                                </h3>
                                <div class="related-price">
                                    <span style="color:#198754;font-weight:700;">
                                        ₹{{ number_format($related->selling_price, 2) }}
                                    </span>

                                    @if($related->price > $related->selling_price)
                                        <span class="related-original" style="
                                                                                            color:#888;
                                                                                            text-decoration:line-through;
                                                                                            text-decoration-thickness:1px;
                                                                                            margin-left:6px;
                                                                                            font-size:13px;
                                                                                        ">
                                            ₹{{ number_format($related->price, 2) }}
                                        </span>
                                    @endif
                                </div>
                                <!-- Add to Cart Button (stops propagation to prevent redirect) -->
                                <button type="button" class="btn-add-cart-compact add-to-cart-btn"
                                    data-product-id="{{ $productId }}" data-product-name="{{ addslashes($productName) }}"
                                    data-product-price="{{ $related->selling_price }}" data-product-slug="{{ $productSlug }}"
                                    data-product-image="{{ $relFirst }}"
                                    onclick="event.stopPropagation(); addToCartFromCard(this, {{ $productId }}, '{{ addslashes($productName) }}', {{ $related->selling_price }}, '{{ $productSlug }}', '{{ $relFirst }}', {{ $related->price }});">
                                    <i class="bi bi-cart-plus"></i>
                                    <span class="btn-text">Add to Cart</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
        <div class="bottom-services">
            <div class="bottom-service">
                <i class="bi bi-lock"></i>
                <div>
                    <strong>Pay Securely</strong>
                    <span>100% Safe & Secure Payments</span>
                </div>
            </div>

            <div class="bottom-service">
                <i class="bi bi-gift"></i>
                <div>
                    <strong>Gift-Ready Packaging</strong>
                    <span>Premium Packaging Included</span>
                </div>
            </div>

            <div class="bottom-service">
                <i class="bi bi-headset"></i>
                <div>
                    <strong>Need Help?</strong>
                    <span>Contact Us Anytime</span>
                </div>
            </div>
        </div>

        <style>
            .bottom-services {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 15px;
                margin-top: 20px;
            }

            .bottom-service {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 16px;
                background: #FBF7E8;
                border: 1px solid #E9DDB8;
                border-radius: 12px;
            }

            .bottom-service>i {
                color: #B8953E;
                font-size: 22px;
            }

            .bottom-service strong,
            .bottom-service span {
                display: block;
            }

            .bottom-service strong {
                color: #2B2418;
                font-size: 14px;
            }

            .bottom-service span {
                color: #756B58;
                font-size: 12px;
                margin-top: 3px;
            }

            @media (max-width: 768px) {
                .bottom-services {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <div class="image-modal" id="imageModal" onclick="closeImageModal()">
            <span class="modal-close" onclick="closeImageModal()"><i class="bi bi-x-lg"></i></span>
            <img id="modalImage" src="" alt="" onclick="event.stopPropagation()">
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        const productImages = @json(collect($images ?? [])->map(fn($image) => asset($image))->values());
        let currentImageIndex = 0;
        function changeProductImage(src, element) {
            const mainImage = document.getElementById('mainProductImage');
            if (!mainImage) return;
            mainImage.style.opacity = '0';
            setTimeout(function () {
                mainImage.src = src;
                mainImage.onload = function () { mainImage.style.opacity = '1'; };
            }, 150);
            document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
                thumbnail.classList.remove('active');
            });
            if (element) element.classList.add('active');
            currentImageIndex = productImages.indexOf(src);
            if (currentImageIndex < 0) currentImageIndex = 0;
        }
        function nextImage() {
            if (!productImages.length) return;
            currentImageIndex = (currentImageIndex + 1) % productImages.length;
            const thumbnails = document.querySelectorAll('.thumbnail');
            changeProductImage(productImages[currentImageIndex], thumbnails[currentImageIndex]);
        }
        function previousImage() {
            if (!productImages.length) return;
            currentImageIndex = (currentImageIndex - 1 + productImages.length) % productImages.length;
            const thumbnails = document.querySelectorAll('.thumbnail');
            changeProductImage(productImages[currentImageIndex], thumbnails[currentImageIndex]);
        }
        function increaseQuantity() {
            const input = document.getElementById('quantity');
            if (!input) return;
            const max = parseInt(input.max || 999);
            let value = parseInt(input.value || 1);
            if (value < max) input.value = value + 1;
        }
        function decreaseQuantity() {
            const input = document.getElementById('quantity');
            if (!input) return;
            let value = parseInt(input.value || 1);
            if (value > 1) input.value = value - 1;
        }
        document.querySelectorAll('.size-button').forEach(function (button) {
            button.addEventListener('click', function () {
                document.querySelectorAll('.size-button').forEach(function (item) {
                    item.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
        function showTab(id, button) {
            document.querySelectorAll('.tab-content').forEach(function (content) {
                content.style.display = 'none';
            });
            document.querySelectorAll('.details-tab').forEach(function (tab) {
                tab.classList.remove('active');
            });
            const selected = document.getElementById(id);
            if (selected) selected.style.display = 'block';
            if (button) button.classList.add('active');
        }
        function openImageModal() {
            const main = document.getElementById('mainProductImage');
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            if (!main || !modalImage) return;
            modalImage.src = main.src;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') closeImageModal();
        });
        function doSearch(query) {
            const results = document.getElementById('searchResults');
            const clearBtn = document.getElementById('clearBtn');
            const links = document.getElementById('categoryLinks');
            const hint = document.getElementById('searchHint');

            if (!results) return;

            query = query.trim();

            // Empty search
            if (query.length === 0) {
                if (clearBtn) clearBtn.style.display = 'none';
                results.style.display = 'none';
                results.innerHTML = '';
                if (links) links.style.display = 'flex';
                if (hint) hint.style.display = 'block';
                clearTimeout(searchTimeout);
                return;
            }

            // Search started
            if (clearBtn) clearBtn.style.display = 'flex';
            if (links) links.style.display = 'none';
            if (hint) hint.style.display = 'none';

            results.style.display = 'block';
            results.innerHTML = `
            <div class="search-loading">
                <i class="bi bi-hourglass-split"></i>
                Searching...
            </div>
        `;

            // Clear previous timeout
            clearTimeout(searchTimeout);

            // Delay search by 300ms
            searchTimeout = setTimeout(() => {
                const searchUrl = `/search?q=${encodeURIComponent(query)}`;

                fetch(searchUrl, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Search request failed');
                        }
                        return response.json();
                    })
                    .then(data => {
                        let html = '';

                        // ==========================================
                        // CATEGORIES
                        // ==========================================
                        if (data.categories && data.categories.length > 0) {
                            html += `
                        <div class="search-categories">
                            <h4 class="search-section-title">Categories</h4>
                            <div class="search-cat-pills">
                    `;

                            data.categories.forEach(category => {
                                html += `
                            <a href="/shop?category=${encodeURIComponent(category.slug)}" class="search-cat-pill">
                                ${escapeHtml(category.name)}
                            </a>
                        `;
                            });

                            html += `
                            </div>
                        </div>
                    `;
                        }

                        // ==========================================
                        // PRODUCTS - UPDATED WITH BOTH PRICES
                        // ==========================================
                        if (data.products && data.products.length > 0) {
                            html += `
                        <div class="search-products">
                            <h4 class="search-section-title">Products</h4>
                    `;

                            data.products.forEach(product => {
                                // ==========================================
                                // GET ONLY FIRST IMAGE
                                // ==========================================
                                let imageUrl = '';

                                if (product.image) {
                                    const imagesArray = product.image
                                        .split(',')
                                        .map(s => s.trim())
                                        .filter(Boolean);

                                    const firstImage = imagesArray[0] || '';

                                    if (firstImage) {
                                        if (firstImage.startsWith('/storage/')) {
                                            imageUrl = firstImage;
                                        } else if (firstImage.startsWith('storage/')) {
                                            imageUrl = '/' + firstImage;
                                        } else {
                                            imageUrl = '/storage/' + firstImage.replace(/^\/+/, '');
                                        }
                                    }
                                }

                                // ==========================================
                                // GET PRICES - SELLING & ORIGINAL
                                // ==========================================
                                const sellingPrice = product.selling_price || product.price || 0;
                                const originalPrice = product.price || 0;
                                const hasDiscount = parseFloat(originalPrice) > parseFloat(sellingPrice);

                                html += `
                            <a href="/shop/${encodeURIComponent(product.slug)}" class="search-product-item">
                        `;

                                // Product Image
                                if (imageUrl) {
                                    html += `
                                <img
                                    src="${imageUrl}"
                                    alt="${escapeHtml(product.name ?? '')}"
                                    class="search-product-img"
                                    loading="lazy"
                                    onerror="
                                        this.onerror=null;
                                        this.style.display='none';
                                        this.nextElementSibling.style.display='flex';
                                    "
                                >
                                <div class="search-product-img-placeholder" style="display:none;">
                                    <i class="bi bi-gem"></i>
                                </div>
                            `;
                                } else {
                                    html += `
                                <div class="search-product-img-placeholder">
                                    <i class="bi bi-gem"></i>
                                </div>
                            `;
                                }

                                // ==========================================
                                // PRODUCT DETAILS WITH BOTH PRICES
                                // ==========================================
                                html += `
                                <div class="search-product-info">
                                    <div class="search-product-name">
                                        ${escapeHtml(product.name ?? '')}
                                    </div>
                                    <div class="search-product-price">
                                        <span style="color:#198754;font-weight:700;">
                                            ₹${formatPrice(sellingPrice)}
                                        </span>
                                        ${hasDiscount ? `
                                            <span style="
                                                color:#888;
                                                font-size:12px;
                                                margin-left:5px;
                                                text-decoration:line-through;
                                                text-decoration-thickness:1px;
                                            ">
                                                ₹${formatPrice(originalPrice)}
                                            </span>
                                            <span style="
                                                color:#e74c3c;
                                                font-size:10px;
                                                margin-left:5px;
                                                font-weight:600;
                                                background:#fef0ef;
                                                padding:1px 6px;
                                                border-radius:3px;
                                            ">
                                                ${Math.round(((parseFloat(originalPrice) - parseFloat(sellingPrice)) / parseFloat(originalPrice)) * 100)}% OFF
                                            </span>
                                        ` : ''}
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        `;
                            });

                            html += `
                        </div>
                    `;
                        }

                        // ==========================================
                        // NO RESULTS
                        // ==========================================
                        if (!html) {
                            html = `
                        <div class="search-empty">
                            <i class="bi bi-search"></i>
                            <span>No results found for “${escapeHtml(query)}”</span>
                        </div>
                    `;
                        }
                        results.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Search error:', error);
                        results.innerHTML = `
                    <div class="search-error">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>Unable to load search results. Please try again.</span>
                    </div>
                `;
                    });
            }, 300);
        }
    </script>
@endpush
