<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif
        }

        .about-section {
            padding: 80px 0;
            background: #faf7f2
        }

        .about-container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 30px
        }

        .about-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center
        }

        .about-content {
            padding: 10px 0
        }

        .about-subtitle {
            display: inline-block;
            margin-bottom: 12px;
            color: #b18a45;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px
        }

        .about-title {
            margin: 0;
            color: #2c2416;
            font-size: 42px;
            font-weight: 700;
            line-height: 1.25;
            max-width: 650px
        }

        .about-divider {
            width: 55px;
            height: 3px;
            background: #b18a45;
            margin: 22px 0 20px
        }

        .about-description {
            color: #4a4035;
            font-size: 16px;
            line-height: 1.8;
            max-width: 650px
        }

        .about-image-wrapper {
            width: 100%
        }

        .about-image {
            width: 100%;
            height: 430px;
            object-fit: cover;
            display: block;
            border-radius: 0
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            margin-top: 42px
        }

        .about-stat {
            text-align: center;
            padding: 0 18px;
            border-right: 1px solid #e8d9c0
        }

        .about-stat:first-child {
            padding-left: 0
        }

        .about-stat:last-child {
            border-right: none;
            padding-right: 0
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8efe0;
            border-radius: 50%;
            color: #b18a45;
            font-size: 25px
        }

        .stat-number {
            display: block;
            color: #b18a45;
            font-size: 25px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 7px
        }

        .stat-label {
            display: block;
            color: #2c2416;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap
        }

        .content-section {
            padding: 90px 0;
            background: #ffffff
        }

        .mission-section {
            background: #f8f5ef
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px
        }

        .content-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 70px;
            align-items: center
        }

        .content-text {
            padding: 10px
        }

        .content-subtitle {
            display: inline-block;
            margin-bottom: 12px;
            color: #b18a45;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px
        }

        .content-title {
            margin: 0;
            color: #2c2416;
            font-size: 42px;
            font-weight: 700;
            line-height: 1.3
        }

        .content-divider {
            width: 55px;
            height: 2px;
            background: #b18a45;
            margin: 22px 0 25px
        }

        .content-description {
            color: #666;
            font-size: 16px;
            line-height: 1.9
        }

        .content-image {
            width: 100%;
            height: 500px;
            display: block;
            object-fit: cover;
            border-radius: 6px
        }

        /* WHY CHOOSE US */
        .why-section {
            padding: 90px 0;
            background: #ffffff
        }

        .why-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px
        }

        .why-header {
            text-align: center;
            margin-bottom: 55px
        }

        .why-subtitle {
            display: inline-block;
            margin-bottom: 12px;
            color: #b18a45;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px
        }

        .why-title {
            margin: 0;
            color: #2c2416;
            font-size: 38px;
            font-weight: 700;
            line-height: 1.3
        }

        .why-divider {
            width: 55px;
            height: 3px;
            background: #b18a45;
            margin: 18px auto 0
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px
        }

        .why-card {
            background: #faf7f2;
            border-radius: 12px;
            padding: 35px 25px;
            text-align: center;
            transition: transform .3s ease, box-shadow .3s ease
        }

        .why-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(177, 138, 69, 0.12)
        }

        .why-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8efe0;
            border-radius: 50%;
            font-size: 30px;
            color: #b18a45
        }

        .why-card-title {
            margin: 0 0 12px;
            color: #2c2416;
            font-size: 18px;
            font-weight: 700
        }

        .why-card-text {
            margin: 0;
            color: #666;
            font-size: 14px;
            line-height: 1.7
        }

        /* TESTIMONIALS */
        .testimonials-section {
            padding: 90px 0;
            background: #faf7f2
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px
        }

        .testimonials-header {
            text-align: center;
            margin-bottom: 55px
        }

        .testimonials-subtitle {
            display: inline-block;
            margin-bottom: 12px;
            color: #b18a45;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px
        }

        .testimonials-title {
            margin: 0;
            color: #2c2416;
            font-size: 38px;
            font-weight: 700;
            line-height: 1.3
        }

        .testimonials-divider {
            width: 55px;
            height: 3px;
            background: #b18a45;
            margin: 18px auto 0
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px
        }

        .testimonial-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 35px 28px;
            box-shadow: 0 8px 25px rgba(177, 138, 69, 0.08);
            position: relative
        }

        .testimonial-card::before {
            content: '“';
            position: absolute;
            top: 20px;
            left: 25px;
            font-size: 60px;
            color: #f0e0c0;
            font-family: Georgia, serif;
            line-height: 1
        }

        .testimonial-text {
            color: #555;
            font-size: 15px;
            line-height: 1.8;
            margin: 25px 0 25px;
            position: relative;
            z-index: 1
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 14px
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #f8efe0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #b18a45;
            flex-shrink: 0
        }

        .author-info h4 {
            margin: 0 0 3px;
            color: #2c2416;
            font-size: 16px;
            font-weight: 700
        }

        .author-info span {
            color: #b18a45;
            font-size: 13px
        }

        @media (max-width:991px) {
            .about-row {
                grid-template-columns: 1fr;
                gap: 40px
            }

            .about-image {
                height: 400px
            }

            .about-title {
                font-size: 36px
            }

            .about-stats {
                grid-template-columns: repeat(4, 1fr)
            }

            .about-stat {
                padding: 0 10px
            }

            .stat-number {
                font-size: 22px
            }

            .stat-label {
                font-size: 11px
            }

            .content-row {
                grid-template-columns: 1fr;
                gap: 40px
            }

            .content-title {
                font-size: 34px
            }

            .content-image {
                height: 400px
            }

            .why-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px
            }

            .why-title {
                font-size: 32px
            }

            .testimonials-grid {
                grid-template-columns: 1fr 1fr;
                gap: 25px
            }

            .testimonials-title {
                font-size: 32px
            }
        }

        @media (max-width:575px) {
            .about-section {
                padding: 55px 0
            }

            .about-container {
                padding: 0 18px
            }

            .about-title {
                font-size: 30px
            }

            .about-description {
                font-size: 15px
            }

            .about-image {
                height: 300px
            }

            .about-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px 0
            }

            .about-stat {
                border-right: 1px solid #e8d9c0
            }

            .about-stat:nth-child(2) {
                border-right: none
            }

            .about-stat:nth-child(3),
            .about-stat:nth-child(4) {
                border-top: 1px solid #e8d9c0;
                padding-top: 25px
            }

            .about-stat:nth-child(4) {
                border-right: none
            }

            .stat-number {
                font-size: 22px
            }

            .stat-label {
                font-size: 12px
            }

            .content-section {
                padding: 60px 0
            }

            .content-title {
                font-size: 30px
            }

            .content-description {
                font-size: 15px
            }

            .content-image {
                height: 300px
            }

            .why-section {
                padding: 60px 0
            }

            .why-grid {
                grid-template-columns: 1fr;
                gap: 20px
            }

            .why-title {
                font-size: 28px
            }

            .testimonials-section {
                padding: 60px 0
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
                gap: 20px
            }

            .testimonials-title {
                font-size: 28px
            }
        }
    </style>
</head>

<body>
    {{-- ABOUT US + STATS --}}
    <section class="about-section">
        <div class="about-container">
            <div class="about-row">
                <div class="about-content">
                    @if($aboutUs)
                        @if($aboutUs->about_sub_title)
                            <span class="about-subtitle">{{ $aboutUs->about_sub_title }}</span>
                        @endif
                        <h1 class="about-title">{{ $aboutUs->about_title }}</h1>
                        <div class="about-divider"></div>
                        <div class="about-description">{!! nl2br(e($aboutUs->about_description)) !!}</div>
                        <div class="about-stats">
                            <div class="about-stat">
                                <div class="stat-icon">💎</div>
                                <span class="stat-number">25+</span>
                                <span class="stat-label">Years of Excellence</span>
                            </div>
                            <div class="about-stat">
                                <div class="stat-icon">👥</div>
                                <span class="stat-number">50K+</span>
                                <span class="stat-label">Happy Customers</span>
                            </div>
                            <div class="about-stat">
                                <div class="stat-icon">✨</div>
                                <span class="stat-number">10K+</span>
                                <span class="stat-label">Unique Designs</span>
                            </div>
                            <div class="about-stat">
                                <div class="stat-icon">🏅</div>
                                <span class="stat-number">100%</span>
                                <span class="stat-label">Certified Jewellery</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="about-image-wrapper">
                    @if($aboutUs && $aboutUs->about_image)
                        <img src="{{ asset('storage/' . $aboutUs->about_image) }}" alt="{{ $aboutUs->about_title }}"
                            class="about-image">
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- OUR MISSION --}}
    <section class="content-section mission-section">
        <div class="content-container">
            <div class="content-row">
                <div class="content-text">
                    @if($aboutUs)
                        @if($aboutUs->mission_sub_title)
                            <span class="content-subtitle">{{ $aboutUs->mission_sub_title }}</span>
                        @endif
                        <h2 class="content-title">{{ $aboutUs->mission_title }}</h2>
                        <div class="content-divider"></div>
                        <div class="content-description">{!! nl2br(e($aboutUs->mission_description)) !!}</div>
                    @endif
                </div>
                <div>
                    @if($aboutUs && $aboutUs->mission_image)
                        <img src="{{ asset('storage/' . $aboutUs->mission_image) }}" alt="{{ $aboutUs->mission_title }}"
                            class="content-image">
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- OUR VISION --}}
    <section class="content-section">
        <div class="content-container">
            <div class="content-row">
                <div>
                    @if($aboutUs && $aboutUs->vision_image)
                        <img src="{{ asset('storage/' . $aboutUs->vision_image) }}" alt="{{ $aboutUs->vision_title }}"
                            class="content-image">
                    @endif
                </div>
                <div class="content-text">
                    @if($aboutUs)
                        @if($aboutUs->vision_sub_title)
                            <span class="content-subtitle">{{ $aboutUs->vision_sub_title }}</span>
                        @endif
                        <h2 class="content-title">{{ $aboutUs->vision_title }}</h2>
                        <div class="content-divider"></div>
                        <div class="content-description">{!! nl2br(e($aboutUs->vision_description)) !!}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- WHY CHOOSE US --}}
    <section class="why-section">
        <div class="why-container">
            <div class="why-header">
                <span class="why-subtitle">Why Choose Us</span>
                <h2 class="why-title">The Reasons Behind Our Sparkle</h2>
                <div class="why-divider"></div>
            </div>
            <div class="why-grid">
                <div class="why-card">
                    <div class="why-icon">🏆</div>
                    <h3 class="why-card-title">Certified Purity</h3>
                    <p class="why-card-text">Every piece is hallmarked and certified for 100% purity and authenticity.
                    </p>
                </div>
                <div class="why-card">
                    <div class="why-icon">🛠️</div>
                    <h3 class="why-card-title">Expert Craftsmanship</h3>
                    <p class="why-card-text">Handcrafted by master artisans with decades of traditional expertise.</p>
                </div>
                <div class="why-card">
                    <div class="why-icon">💎</div>
                    <h3 class="why-card-title">Timeless Designs</h3>
                    <p class="why-card-text">From classic heritage to modern elegance – designs that never go out of
                        style.</p>
                </div>
                <div class="why-card">
                    <div class="why-icon">🤝</div>
                    <h3 class="why-card-title">Trusted Legacy</h3>
                    <p class="why-card-text">Serving generations of families with honesty, quality and unmatched
                        service.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- TESTIMONIALS --}}
    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="testimonials-header">
                <span class="testimonials-subtitle">Testimonials</span>
                <h2 class="testimonials-title">What Our Customers Say</h2>
                <div class="testimonials-divider"></div>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">The craftsmanship is exceptional. I bought a diamond necklace for my
                        anniversary and it exceeded all expectations. Truly premium quality!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">👩</div>
                        <div class="author-info">
                            <h4>Priya Sharma</h4>
                            <span>Mumbai</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">I’ve been a loyal customer for over 8 years. Their designs are timeless
                        and the purity of gold is always guaranteed. Highly recommended!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">👨</div>
                        <div class="author-info">
                            <h4>Rahul Mehta</h4>
                            <span>Delhi</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">Bought my bridal set from here. The attention to detail and personalized
                        service made the experience truly special. Thank you!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">👰</div>
                        <div class="author-info">
                            <h4>Ananya Patel</h4>
                            <span>Ahmedabad</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
