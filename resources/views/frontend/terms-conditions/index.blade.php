<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions</title>
    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #faf7f2;
            color: #2c2416
        }

        .terms-section {
            padding: 80px 0;
            background: #faf7f2
        }

        .terms-container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 30px
        }

        .terms-wrapper {
            background: #ffffff;
            padding: 60px 70px;
            border-radius: 8px;
            box-shadow: 0 8px 30px rgba(177, 138, 69, 0.08)
        }

        .terms-header {
            text-align: center;
            margin-bottom: 45px
        }

        .terms-category {
            display: inline-block;
            margin-bottom: 12px;
            color: #b18a45;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px
        }

        .terms-subtitle {
            display: block;
            margin-bottom: 12px;
            color: #777;
            font-size: 15px;
            line-height: 1.6
        }

        .terms-title {
            margin: 0;
            color: #2c2416;
            font-size: 42px;
            font-weight: 700;
            line-height: 1.25
        }

        .terms-divider {
            width: 55px;
            height: 3px;
            background: #b18a45;
            margin: 20px auto 0
        }

        .terms-image-wrapper {
            margin-bottom: 45px
        }

        .terms-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
            border-radius: 6px
        }

        .terms-content-layout {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 55px;
            align-items: start
        }

        .terms-content-layout.no-image {
            display: block
        }

        .terms-content-wrapper {
            width: 100%
        }

        .terms-content {
            color: #555;
            font-size: 16px;
            line-height: 1.9
        }

        .terms-content h1,
        .terms-content h2,
        .terms-content h3,
        .terms-content h4,
        .terms-content h5,
        .terms-content h6 {
            color: #2c2416;
            line-height: 1.4;
            margin-top: 35px;
            margin-bottom: 15px
        }

        .terms-content h1 {
            font-size: 32px
        }

        .terms-content h2 {
            font-size: 28px
        }

        .terms-content h3 {
            font-size: 23px
        }

        .terms-content h4 {
            font-size: 19px
        }

        .terms-content p {
            margin: 0 0 18px
        }

        .terms-content ul,
        .terms-content ol {
            margin: 15px 0 25px;
            padding-left: 28px
        }

        .terms-content li {
            margin-bottom: 10px;
            padding-left: 5px
        }

        .terms-content strong,
        .terms-content b {
            color: #2c2416
        }

        .terms-content a {
            color: #b18a45;
            text-decoration: none
        }

        .terms-content a:hover {
            text-decoration: underline
        }

        .terms-content blockquote {
            margin: 25px 0;
            padding: 20px 25px;
            background: #faf7f2;
            border-left: 4px solid #b18a45;
            color: #555
        }

        .terms-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0
        }

        .terms-content table th,
        .terms-content table td {
            border: 1px solid #e8d9c0;
            padding: 12px 15px;
            text-align: left
        }

        .terms-content table th {
            background: #faf7f2;
            color: #2c2416;
            font-weight: 600
        }

        .terms-side-image-wrapper {
            position: sticky;
            top: 30px
        }

        .terms-side-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
            border-radius: 6px
        }

        .terms-info-box {
            margin-top: 45px;
            padding: 25px 30px;
            background: #faf7f2;
            border-left: 4px solid #b18a45;
            border-radius: 4px
        }

        .terms-info-title {
            margin: 0 0 8px;
            color: #2c2416;
            font-size: 18px;
            font-weight: 700
        }

        .terms-info-text {
            margin: 0;
            color: #666;
            font-size: 14px;
            line-height: 1.7
        }

        .terms-empty {
            text-align: center;
            padding: 100px 20px
        }

        .terms-empty-icon {
            width: 75px;
            height: 75px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8efe0;
            border-radius: 50%;
            font-size: 32px
        }

        .terms-empty h3 {
            margin: 0 0 10px;
            color: #2c2416;
            font-size: 24px
        }

        .terms-empty p {
            margin: 0;
            color: #777;
            font-size: 15px
        }

        .terms-breadcrumb {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            padding: 10px 0;
            border-bottom: 1px solid #f0e8dc
        }

        .terms-breadcrumb-item {
            color: #8a7a6a;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px
        }

        .terms-breadcrumb-item a {
            color: #b18a45;
            text-decoration: none;
            transition: color 0.2s
        }

        .terms-breadcrumb-item a:hover {
            color: #8a6a3a;
            text-decoration: underline
        }

        .terms-breadcrumb-separator {
            color: #d5c8b8;
            font-size: 12px
        }

        .terms-breadcrumb-item.active {
            color: #2c2416;
            font-weight: 600
        }

        /* Category Navigation Tabs */
        .terms-category-nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 35px;
            padding: 15px 0;
            border-bottom: 2px solid #f0e8dc;
        }

        .terms-category-nav .cat-btn {
            padding: 10px 28px;
            border: 2px solid #e8d9c0;
            border-radius: 50px;
            background: transparent;
            color: #6b5a4a;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: inherit;
        }

        .terms-category-nav .cat-btn:hover {
            border-color: #b18a45;
            color: #b18a45;
            background: #f8efe0;
            transform: translateY(-2px);
        }

        .terms-category-nav .cat-btn.active {
            background: #b18a45;
            color: #ffffff;
            border-color: #b18a45;
            box-shadow: 0 4px 15px rgba(177, 138, 69, 0.3);
        }

        .terms-category-nav .cat-btn.active:hover {
            background: #9a7a3a;
            border-color: #9a7a3a;
        }

        .terms-category-nav .cat-btn .badge-count {
            display: inline-block;
            background: rgba(177, 138, 69, 0.15);
            color: #b18a45;
            font-size: 11px;
            padding: 1px 10px;
            border-radius: 20px;
            margin-left: 6px;
            font-weight: 700;
        }

        .terms-category-nav .cat-btn.active .badge-count {
            background: rgba(255, 255, 255, 0.25);
            color: #ffffff;
        }

        /* Category Content */
        .terms-category-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .terms-category-content.active {
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

        .terms-category-wrapper {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px
        }

        .terms-category-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 18px;
            background: #f8efe0;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            color: #b18a45;
            text-transform: uppercase;
            letter-spacing: 1px
        }

        .terms-category-tag i {
            font-size: 16px
        }

        /* No content message */
        .no-content-message {
            text-align: center;
            padding: 40px 20px;
            color: #8a7a6a;
        }

        .no-content-message i {
            font-size: 48px;
            color: #d5c8b8;
            margin-bottom: 15px;
            display: block;
        }

        @media(max-width:991px) {
            .terms-section {
                padding: 60px 0
            }

            .terms-wrapper {
                padding: 45px 40px
            }

            .terms-title {
                font-size: 36px
            }

            .terms-content-layout {
                grid-template-columns: 1fr;
                gap: 40px
            }

            .terms-side-image-wrapper {
                position: static
            }

            .terms-side-image {
                height: 350px
            }

            .terms-category-nav .cat-btn {
                padding: 8px 20px;
                font-size: 12px;
            }
        }

        @media(max-width:575px) {
            .terms-section {
                padding: 40px 0
            }

            .terms-container {
                padding: 0 15px
            }

            .terms-wrapper {
                padding: 35px 22px;
                border-radius: 5px
            }

            .terms-category {
                font-size: 12px;
                letter-spacing: 1.5px
            }

            .terms-subtitle {
                font-size: 14px
            }

            .terms-title {
                font-size: 30px
            }

            .terms-divider {
                width: 45px
            }

            .terms-content {
                font-size: 15px;
                line-height: 1.8
            }

            .terms-content h1 {
                font-size: 28px
            }

            .terms-content h2 {
                font-size: 24px
            }

            .terms-content h3 {
                font-size: 21px
            }

            .terms-content h4 {
                font-size: 18px
            }

            .terms-content ul,
            .terms-content ol {
                padding-left: 22px
            }

            .terms-content table {
                display: block;
                overflow-x: auto;
                white-space: nowrap
            }

            .terms-side-image {
                height: 280px
            }

            .terms-info-box {
                padding: 20px
            }

            .terms-breadcrumb {
                font-size: 12px;
                gap: 8px
            }

            .terms-category-tag {
                font-size: 11px;
                padding: 4px 14px
            }

            .terms-category-nav {
                gap: 8px;
                padding: 10px 0;
            }

            .terms-category-nav .cat-btn {
                padding: 6px 14px;
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <section class="terms-section">
        <div class="terms-container">
            @if($termsConditions && $termsConditions->count() > 0)
                <div class="terms-wrapper">
                    <!-- Category Navigation Tabs -->
                    <div class="terms-category-nav" id="categoryNav">
                        @foreach($termsConditions as $index => $item)
                            <button class="cat-btn {{ $index === 0 ? 'active' : '' }}"
                                    data-target="category-{{ $index }}">
                                @if($item->terms_conditions_category)
                                    {{ $item->terms_conditions_category }}
                                @else
                                    Category {{ $index + 1 }}
                                @endif
                                <span class="badge-count">{{ $loop->iteration }}</span>
                            </button>
                        @endforeach
                    </div>

                    <!-- Category Content -->
                    @foreach($termsConditions as $index => $item)
                        <div class="terms-category-content {{ $index === 0 ? 'active' : '' }}"
                             id="category-{{ $index }}">

                            @if($item->terms_conditions_category)
                                <div class="terms-category-wrapper">
                                    <span class="terms-category-tag">
                                        <i>📂</i> {{ $item->terms_conditions_category }}
                                    </span>
                                </div>
                            @endif

                            <div class="terms-header">
                                @if($item->terms_conditions_subtitle)
                                    <span class="terms-subtitle">{{ $item->terms_conditions_subtitle }}</span>
                                @endif
                                <h1 class="terms-title">{{ $item->terms_conditions_title }}</h1>
                                <div class="terms-divider"></div>
                            </div>

                            @if($item->terms_conditions_iamage)
                                <div class="terms-content-layout">
                                    <div class="terms-content-wrapper">
                                        <div class="terms-content">{!! $item->terms_conditions_descripton !!}</div>
                                        <div class="terms-info-box">
                                            <h3 class="terms-info-title">Need Help?</h3>
                                            <p class="terms-info-text">If you have any questions regarding this policy, please contact our customer support team. Our team is always happy to assist you.</p>
                                        </div>
                                    </div>
                                    <div class="terms-side-image-wrapper">
                                        <img src="{{ asset('storage/' . $item->terms_conditions_iamage) }}"
                                            alt="{{ $item->terms_conditions_title }}" class="terms-side-image">
                                    </div>
                                </div>
                            @else
                                <div class="terms-content-layout no-image">
                                    <div class="terms-content-wrapper">
                                        <div class="terms-content">{!! $item->terms_conditions_descripton !!}</div>
                                        <div class="terms-info-box">
                                            <h3 class="terms-info-title">Need Help?</h3>
                                            <p class="terms-info-text">If you have any questions regarding this policy, please contact our customer support team. Our team is always happy to assist you.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="terms-wrapper">
                    <div class="terms-empty">
                        <div class="terms-empty-icon">📄</div>
                        <h3>Terms & Conditions Not Available</h3>
                        <p>Our Terms & Conditions information is currently unavailable.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.cat-btn');
            const contents = document.querySelectorAll('.terms-category-content');

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    buttons.forEach(function(btn) {
                        btn.classList.remove('active');
                    });

                    // Add active class to clicked button
                    this.classList.add('active');

                    // Hide all content
                    contents.forEach(function(content) {
                        content.classList.remove('active');
                    });

                    // Show target content
                    const targetId = this.getAttribute('data-target');
                    const targetContent = document.getElementById(targetId);
                    if (targetContent) {
                        targetContent.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>

</html>
