@extends('frontend.layouts.app')

@section('title', 'Privacy Policy - Aethelweave')

@push('styles')
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        /* =============================================
                PRIVACY POLICY
            ============================================= */
        .privacy-page {
            padding: 70px 20px 40px;
        }

        .privacy-container {
            max-width: 1100px;
            margin: auto;
        }

        .privacy-header {
            text-align: center;
            margin-bottom: 55px;
        }

        .privacy-header .subtitle {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 13px;
            color: #b08d57;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .privacy-header h1 {
            font-size: 42px;
            margin: 0 0 15px;
            font-weight: 500;
            color: #292929;
            font-family: 'Cormorant Garamond', serif;
        }

        .privacy-header p {
            font-size: 16px;
            color: #777;
            margin: 0;
        }

        .privacy-section {
            background: #fff;
            border-radius: 12px;
            padding: 35px;
            margin-bottom: 25px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .05);
        }

        .privacy-section-content {
            display: flex;
            gap: 35px;
            align-items: flex-start;
        }

        .privacy-image {
            width: 280px;
            flex: 0 0 280px;
        }

        .privacy-image img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .privacy-content {
            flex: 1;
        }

        .privacy-content .section-subtitle {
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #b08d57;
            font-size: 12px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .privacy-content h2 {
            font-size: 26px;
            margin: 0 0 18px;
            color: #292929;
            font-family: 'Cormorant Garamond', serif;
        }

        .privacy-description {
            font-size: 15px;
            line-height: 1.8;
            color: #666;
        }

        .privacy-description p {
            margin-bottom: 12px;
        }

        .privacy-description ul,
        .privacy-description ol {
            padding-left: 22px;
            margin-bottom: 12px;
        }

        .privacy-description li {
            margin-bottom: 6px;
        }

        @media (max-width: 480px) {
            .privacy-page {
                padding: 45px 15px 30px;
            }

            .privacy-header h1 {
                font-size: 32px;
            }

            .privacy-section {
                padding: 25px;
            }

            .privacy-section-content {
                display: block;
            }

            .privacy-image {
                width: 100%;
                margin-bottom: 25px;
            }

            .privacy-image img {
                height: 200px;
            }
        }
    </style>
@endpush

@section('content')

    <!-- =============================================
            PRIVACY POLICY CONTENT
        ============================================= -->
    <section class="privacy-page">
        <div class="privacy-container">
            <div class="privacy-header">
                <div class="subtitle">Your Privacy Matters</div>
                <h1>Privacy Policy</h1>
                <p>Learn how we protect and handle your information.</p>
            </div>
            @forelse($privacyPolicies as $privacyPolicy)
                <div class="privacy-section">
                    <div class="privacy-section-content">
                        @if($privacyPolicy->privacy_policy_image)
                            <div class="privacy-image">
                                <img src="{{ asset('storage/' . $privacyPolicy->privacy_policy_image) }}"
                                    alt="{{ $privacyPolicy->privacy_policy_title }}">
                            </div>
                        @endif
                        <div class="privacy-content">
                            @if($privacyPolicy->privacy_policy_subtitle)
                                <div class="section-subtitle">{{ $privacyPolicy->privacy_policy_subtitle }}</div>
                            @endif
                            <h2>{{ $privacyPolicy->privacy_policy_title }}</h2>
                            <div class="privacy-description">
                                {!! $privacyPolicy->privacy_policy_description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="privacy-section">
                    <div class="privacy-content">
                        <h2>Privacy Policy</h2>
                        <p>No Privacy Policy content available at the moment.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

@endsection