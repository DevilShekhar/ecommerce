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
                        <img src="{{ asset('assets/admin/images/vision-default.jpg') }}" alt="Our Vision" class="content-image">
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
