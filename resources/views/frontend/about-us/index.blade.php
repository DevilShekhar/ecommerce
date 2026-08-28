<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Google Fonts: Cormorant Garamond for navbar -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/website.css') }}">
</head>

<body>

    <!-- =============================================
        NAVBAR
    ============================================= -->
    <nav class="navbar-modern">
        <div class="navbar-container">
            <!-- Logo -->
            <a href="/" class="navbar-logo">
                <span class="navbar-logo-text">Aethelweave</span>
                <span class="navbar-logo-badge">Artisan</span>
            </a>

            <!-- Nav Links - Desktop -->
            <ul class="nav-links-desktop">
                <li><a href="/">Home</a></li>
                <li><a href={{ route('shop.index') }}>Shop</a></li>
                <li><a href="#">Collections</a></li>
                <li><a href="{{ route('about-us') }}">About</a></li>
                <li><a href="{{ route('contact-us') }}">Contact</a></li>
            </ul>

            <!-- Right Icons -->
            <div class="navbar-icons">
                <a href="#" class="navbar-icon">
                    <i class="bi bi-search"></i>
                </a>
                <a href="#" class="navbar-icon">
                    <i class="bi bi-person"></i>
                </a>
                <a href="#" class="navbar-icon">
                    <i class="bi bi-bag"></i>
                    <span class="navbar-cart-count">0</span>
                </a>
                <!-- Hamburger (Mobile) -->
                <button class="hamburger-btn" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Collections</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

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
                            <img src="assets/admin/images/per1.jpg" alt="Priya Sharma">
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
                            <img src="assets/admin/images/per2.jpg" alt="Rahul Mehta">
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
                            <img src="assets/admin/images/per3.jpg" alt="Ananya Patel">
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

    {{-- =============================================
    FOOTER
    ============================================= --}}
    <footer class="footer-modern">
        <div class="container">
            <div class="footer-grid">
                <!-- Brand Column -->
                <div class="footer-col footer-brand-col">
                    <div class="footer-brand">Aethelweave</div>
                    <p class="footer-tagline">Artisan Jewellery · Since 2010</p>
                    <p class="footer-desc">Premium handcrafted jewellery for those who appreciate timeless elegance and
                        exceptional quality.</p>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" aria-label="Instagram" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" aria-label="YouTube" class="social-link"><i class="bi bi-youtube"></i></a>
                        <a href="#" aria-label="Pinterest" class="social-link"><i class="bi bi-pinterest"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about-us') }}">About Us</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                        <li><a href="#">Blogs</a></li>
                    </ul>
                </div>

                <!-- We Accept -->
                <div class="footer-col">
                    <h4 class="footer-heading">We Accept</h4>
                    <div class="footer-payment">
                        <span class="payment-icon"><i class="bi bi-credit-card"></i></span>
                        <span class="payment-icon"><i class="bi bi-paypal"></i></span>
                        <span class="payment-icon"><i class="bi bi-bank"></i></span>
                        <span class="payment-icon"><i class="bi bi-cash"></i></span>
                        <p class="payment-text">Secure payment options available</p>
                    </div>
                </div>

                <!-- Contact Us -->
                <div class="footer-col">
                    <h4 class="footer-heading">Contact Us</h4>
                    <ul class="footer-contact">
                        <li><i class="bi bi-envelope"></i> info@aethelweave.com</li>
                        <li><i class="bi bi-geo-alt"></i> 123, Jewelry Lane, Koregaon Park, Pune, Maharashtra 411001,
                            India</li>
                        <li><i class="bi bi-telephone"></i> +91 98765 43210</li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <hr class="footer-divider">
            <div class="footer-bottom">
                <p class="footer-copy">&copy; 2026 Aethelweave. All Rights Reserved.</p>
                <div class="footer-bottom-links">
                    <a href="{{ route('privacy-policy.index')}}">Privacy Policy</a>
                    <a href={{ route('terms-conditions') }}>Terms of Use</a>
                    <a href={{ route('disclaimer') }}>Disclaimer</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- =============================================
        SCRIPTS
    ============================================= -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.querySelector('.hamburger-btn');
            const mobileMenu = document.querySelector('.mobile-menu');

            if (hamburger && mobileMenu) {
                hamburger.addEventListener('click', function () {
                    const isOpen = mobileMenu.style.display === 'block';
                    mobileMenu.style.display = isOpen ? 'none' : 'block';
                });
            }

            // Navbar scroll effect
            const navbar = document.querySelector('.navbar-modern');
            if (navbar) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                });
            }
        });
    </script>

</body>

</html>
