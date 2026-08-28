@extends('frontend.layouts.app')

@section('title', $disclaimer->title ?? 'Disclaimer')

@push('styles')
    <style>
        * {
            box-sizing: border-box;
        }

        .disclaimer-section {
            padding: 90px 0;
            background: #faf7f2;
        }

        .disclaimer-container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 0 30px;
        }

        .disclaimer-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 70px;
            align-items: center;
        }

        .disclaimer-content {
            padding: 10px 0;
        }

        .disclaimer-subtitle {
            display: inline-block;
            margin-bottom: 12px;
            color: #b18a45;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .disclaimer-title {
            margin: 0;
            color: #2c2416;
            font-size: 44px;
            font-weight: 700;
            line-height: 1.25;
        }

        .disclaimer-divider {
            width: 55px;
            height: 3px;
            background: #b18a45;
            margin: 22px 0 25px;
        }

        .disclaimer-description {
            color: #555;
            font-size: 16px;
            line-height: 1.9;
        }

        .disclaimer-description p {
            margin: 0 0 18px;
        }

        .disclaimer-description ul,
        .disclaimer-description ol {
            padding-left: 22px;
        }

        .disclaimer-description li {
            margin-bottom: 10px;
        }

        .disclaimer-image-wrapper {
            width: 100%;
            position: relative;
        }

        .disclaimer-image-wrapper::before {
            content: "";
            position: absolute;
            top: -15px;
            right: -15px;
            width: 100%;
            height: 100%;
            border: 1px solid #d9bf91;
            z-index: 0;
        }

        .disclaimer-image {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 480px;
            object-fit: cover;
            display: block;
        }

        .disclaimer-image-placeholder {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 480px;
            background: #f8efe0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b18a45;
            font-size: 60px;
        }

        .disclaimer-bottom {
            margin-top: 60px;
            padding: 35px;
            background: #ffffff;
            border-left: 4px solid #b18a45;
            box-shadow: 0 8px 30px rgba(44, 36, 22, 0.06);
        }

        .disclaimer-bottom-title {
            margin: 0 0 10px;
            color: #2c2416;
            font-size: 20px;
            font-weight: 700;
        }

        .disclaimer-bottom-text {
            margin: 0;
            color: #666;
            font-size: 14px;
            line-height: 1.8;
        }

        @media (max-width: 991px) {

            .disclaimer-row {
                grid-template-columns: 1fr;
                gap: 50px;
            }

            .disclaimer-title {
                font-size: 38px;
            }

            .disclaimer-image {
                height: 400px;
            }

            .disclaimer-image-placeholder {
                height: 400px;
            }

        }

        @media (max-width: 575px) {

            .disclaimer-section {
                padding: 60px 0;
            }

            .disclaimer-container {
                padding: 0 18px;
            }

            .disclaimer-title {
                font-size: 30px;
            }

            .disclaimer-description {
                font-size: 15px;
                line-height: 1.8;
            }

            .disclaimer-image {
                height: 300px;
            }

            .disclaimer-image-placeholder {
                height: 300px;
            }

            .disclaimer-image-wrapper::before {
                top: -8px;
                right: -8px;
            }

            .disclaimer-bottom {
                margin-top: 40px;
                padding: 25px;
            }

        }
    </style>
@endpush

@section('content')

    @if($disclaimer)

        <section class="disclaimer-section">

            <div class="disclaimer-container">

                <div class="disclaimer-row">

                    {{-- Content --}}
                    <div class="disclaimer-content">

                        @if($disclaimer->subtitle)
                            <span class="disclaimer-subtitle">
                                {{ $disclaimer->subtitle }}
                            </span>
                        @endif

                        <h1 class="disclaimer-title">
                            {{ $disclaimer->title }}
                        </h1>

                        <div class="disclaimer-divider"></div>

                        <div class="disclaimer-description">
                            {!! nl2br(e($disclaimer->description)) !!}
                        </div>

                    </div>

                    {{-- Image --}}
                    <div class="disclaimer-image-wrapper">

                        @if($disclaimer->section_image)
                            <img src="{{ asset($disclaimer->section_image) }}" alt="{{ $disclaimer->title }}"
                                class="disclaimer-image">
                        @else
                            <div class="disclaimer-image-placeholder">
                                ⚖
                            </div>
                        @endif

                    </div>

                </div>

                {{-- Bottom Information --}}
                <div class="disclaimer-bottom">

                    <h3 class="disclaimer-bottom-title">
                        Important Information
                    </h3>

                    <p class="disclaimer-bottom-text">
                        Please review the information provided on this page carefully.
                        Product details, pricing, availability and other information
                        displayed on this website may be updated from time to time.
                    </p>

                </div>

            </div>

        </section>

    @else

        <section class="disclaimer-section">

            <div class="disclaimer-container">

                <div class="disclaimer-bottom">

                    <h3 class="disclaimer-bottom-title">
                        Disclaimer
                    </h3>

                    <p class="disclaimer-bottom-text">
                        Disclaimer information is currently unavailable.
                    </p>

                </div>

            </div>

        </section>

    @endif

@endsection