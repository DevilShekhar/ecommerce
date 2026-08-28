@extends('frontend.layouts.app')

@section('title', 'About Us')

@push('styles')
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
@endpush

@section('content')

    <!-- =============================================
        SHOP HEADER
    ============================================= -->
    <section class="shop-header">
        <h1><i class="fas fa-info-circle"></i> About Us</h1>
        <p>Discover the story, passion, and craftsmanship behind our jewellery</p>
        <div class="breadcrumb">
            <a href="/">Home</a> / About Us
            @if(request('category'))
                / {{ $categories->where('id', request('category'))->first()->name ?? '' }}
            @endif
        </div>
    </section>

    {{-- =============================================
    ABOUT US + STATS
    ============================================= --}}
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
                    @else
                        <img src="{{ asset('assets/admin/images/about-default.jpg') }}" alt="About Us" class="about-image">
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
    OUR MISSION
    ============================================= --}}
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
                    @else
                        <img src="{{ asset('assets/admin/images/mission-default.jpg') }}" alt="Our Mission"
                            class="content-image">
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- =============================================
    OUR VISION
    ============================================= --}}
    <section class="content-section">
        <div class="content-container">
            <div class="content-row">
                <div>
                    @if($aboutUs && $aboutUs->vision_image)
                        <img src="{{ asset('storage/' . $aboutUs->vision_image) }}" alt="{{ $aboutUs->vision_title }}"
                            class="content-image">
                    @else
                        <img src="{{ asset('assets/admin/images/vision-default.jpg') }}" alt="Our Vision"
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

    {{-- =============================================
    WHY CHOOSE US
    ============================================= --}}
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

    {{-- =============================================
    TESTIMONIALS - WITH IMAGES
    ============================================= --}}
    <section class="testimonials-section">
        <div class="testimonials-container">
            <div class="testimonials-header">
                <span class="testimonials-subtitle">Testimonials</span>
                <h2 class="testimonials-title">What Our Customers Say</h2>
                <div class="testimonials-divider"></div>
            </div>
            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <p class="testimonial-text">The craftsmanship is exceptional. I bought a diamond necklace for my
                        anniversary and it exceeded all expectations. Truly premium quality!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="{{ asset('assets/admin/images/per1.jpg') }}" alt="Priya Sharma">
                        </div>
                        <div class="author-info">
                            <h4>Priya Sharma</h4>
                            <span>Mumbai</span>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <p class="testimonial-text">I've been a loyal customer for over 8 years. Their designs are timeless
                        and the purity of gold is always guaranteed. Highly recommended!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="{{ asset('assets/admin/images/per2.jpg') }}" alt="Rahul Mehta">
                        </div>
                        <div class="author-info">
                            <h4>Rahul Mehta</h4>
                            <span>Delhi</span>
                        </div>
                    </div>
                </div>
                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <p class="testimonial-text">Bought my bridal set from here. The attention to detail and personalized
                        service made the experience truly special. Thank you!</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="{{ asset('assets/admin/images/per3.jpg') }}" alt="Ananya Patel">
                        </div>
                        <div class="author-info">
                            <h4>Ananya Patel</h4>
                            <span>Ahmedabad</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection