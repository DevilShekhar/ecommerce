<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name') }} | Login</title>
    <link rel="icon" href="{{ asset('assets/admin/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ============================================
                   ROOT VARIABLES
                   ============================================ */
        :root {
            --gold: #c79532;
            --gold-light: #e8d5a3;
            --gold-dark: #a87820;
            --gold-gradient: linear-gradient(135deg, #c79532 0%, #a87820 100%);
            --gold-gradient-light: linear-gradient(135deg, #dba84a 0%, #c79532 100%);
            --cream: #faf7f1;
            --cream-light: #fffdf9;
            --cream-dark: #f0ebe3;
            --text-dark: #1a1a1a;
            --text-primary: #2C2A29;
            --text-secondary: #6B6A69;
            --text-muted: #999793;
            --border-light: #e8e2da;
            --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 8px 40px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 20px 60px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 30px 80px rgba(0, 0, 0, 0.15);
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 28px;
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* ============================================
                   RESET & BASE
                   ============================================ */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100vh;
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            background: #f5efe5;
            color: var(--text-primary);
        }

        /* ============================================
                   MAIN CONTAINER
                   ============================================ */
        .login-container {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5efe5;
            padding: 20px;
        }

        .login-wrapper-modern {
            width: 100%;
            max-width: 1400px;
            min-height: 90vh;
            background: var(--cream-light);
            border-radius: var(--radius-lg);
            overflow: hidden;
            display: grid;
            grid-template-columns: 55% 45%;
            box-shadow: var(--shadow-xl);
            position: relative;
        }

        /* ============================================
                   LEFT PANEL - IMAGE & HERO
                   ============================================ */
        .login-hero-panel {
            position: relative;
            overflow: hidden;
            background: url('{{ asset('assets/admin/images/login.png') }}') center center/cover no-repeat;
            min-height: 600px;
            display: flex;
            align-items: flex-end;
            padding: 50px 45px;
        }

        /* Overlay Gradient */
        .login-hero-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg,
                    rgba(44, 42, 41, 0.1) 0%,
                    rgba(44, 42, 41, 0.3) 40%,
                    rgba(44, 42, 41, 0.7) 80%,
                    rgba(44, 42, 41, 0.85) 100%);
            z-index: 1;
        }

        /* Decorative Gold Accent */
        .login-hero-panel .gold-accent {
            position: absolute;
            top: -150px;
            right: -150px;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(199, 149, 50, 0.08), transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        .login-hero-panel .gold-accent-bottom {
            position: absolute;
            bottom: -200px;
            left: -200px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(199, 149, 50, 0.05), transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        /* Floating Decorative Elements */
        .login-hero-panel .float-element {
            position: absolute;
            z-index: 1;
            opacity: 0.15;
            color: #fff;
            font-size: 80px;
            pointer-events: none;
        }

        .login-hero-panel .float-element.e1 {
            top: 12%;
            left: 8%;
            animation: floatAnim 8s ease-in-out infinite;
        }

        .login-hero-panel .float-element.e2 {
            top: 25%;
            right: 12%;
            font-size: 50px;
            animation: floatAnim 10s ease-in-out infinite reverse;
        }

        .login-hero-panel .float-element.e3 {
            bottom: 30%;
            left: 15%;
            font-size: 40px;
            animation: floatAnim 7s ease-in-out infinite 2s;
        }

        @keyframes floatAnim {
            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* Hero Content */
        .hero-content-modern {
            position: relative;
            z-index: 2;
            color: #fff;
            max-width: 480px;
            width: 100%;
        }

        .hero-content-modern .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 6px 18px 6px 14px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold-light);
            margin-bottom: 20px;
        }

        .hero-content-modern .hero-badge i {
            font-size: 12px;
        }

        .hero-content-modern .hero-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(36px, 4vw, 56px);
            font-weight: 700;
            line-height: 1.08;
            margin: 0 0 16px;
            text-shadow: 0 2px 30px rgba(0, 0, 0, 0.3);
        }

        .hero-content-modern .hero-title .highlight {
            color: var(--gold-light);
            position: relative;
        }

        .hero-content-modern .hero-title .highlight::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
            opacity: 0.5;
        }

        .hero-content-modern .hero-desc {
            font-size: 16px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 300;
            margin: 0 0 28px;
            max-width: 400px;
            text-shadow: 0 1px 12px rgba(0, 0, 0, 0.2);
        }

        .hero-content-modern .hero-divider {
            width: 50px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
            margin-bottom: 20px;
        }

        /* Trust Features */
        .trust-features {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .trust-feature {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .trust-feature .tf-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #fff;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(8px);
            transition: var(--transition);
        }

        .trust-feature:hover .tf-icon {
            background: rgba(199, 149, 50, 0.3);
            border-color: var(--gold);
            transform: scale(1.05);
        }

        .trust-feature .tf-text {
            display: flex;
            flex-direction: column;
        }

        .trust-feature .tf-text strong {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
        }

        .trust-feature .tf-text span {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 300;
        }

        /* ============================================
                   RIGHT PANEL - LOGIN FORM
                   ============================================ */
        .login-form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px 50px;
            background: var(--cream-light);
            position: relative;
            overflow: hidden;
        }

        /* Decorative Background Elements */
        .login-form-panel .bg-deco {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .login-form-panel .bg-deco.d1 {
            top: -120px;
            right: -120px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(199, 149, 50, 0.04), transparent 70%);
        }

        .login-form-panel .bg-deco.d2 {
            bottom: -100px;
            left: -100px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(199, 149, 50, 0.03), transparent 70%);
        }

        .login-form-panel .bg-deco.d3 {
            top: 50%;
            right: 20px;
            width: 120px;
            height: 120px;
            border: 1px solid rgba(199, 149, 50, 0.06);
            transform: translateY(-50%);
        }

        /* Form Container */
        .form-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 440px;
        }

        /* Brand */
        .form-brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-brand .brand-logo {
            display: inline-block;
            margin-bottom: 6px;
        }

        .form-brand .brand-logo img {
            max-width: 200px;
            max-height: 70px;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: var(--transition);
        }

        .form-brand .brand-logo img:hover {
            transform: scale(1.03);
        }

        .form-brand .brand-name {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--gold-dark);
            letter-spacing: 3px;
        }

        .form-brand .brand-tagline {
            font-size: 10px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--text-muted);
            font-weight: 400;
        }

        /* Form Header */
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 28px;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 4px;
        }

        .form-header .form-subtitle {
            font-size: 14px;
            color: var(--text-secondary);
            margin: 0;
            font-weight: 400;
        }

        .form-header .header-line {
            width: 50px;
            height: 2px;
            background: var(--gold-gradient);
            margin: 12px auto 10px;
            border-radius: 2px;
            position: relative;
        }

        .form-header .header-line::before {
            content: '◆';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: var(--gold);
            font-size: 8px;
            background: var(--cream-light);
            padding: 0 6px;
        }

        /* Alerts */
        .alert-modern {
            border-radius: var(--radius-sm);
            font-size: 13px;
            padding: 12px 18px;
            border: none;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-modern.alert-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .alert-modern.alert-success i {
            color: #4caf50;
        }

        .alert-modern.alert-error {
            background: #ffebee;
            color: #c62828;
        }

        .alert-modern.alert-error i {
            color: #ef5350;
        }

        /* Form Groups */
        .form-group-premium {
            margin-bottom: 20px;
        }

        .form-group-premium label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .form-group-premium label .required {
            color: #dc3545;
            margin-left: 2px;
        }

        .input-wrapper-premium {
            position: relative;
        }

        .input-wrapper-premium .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 17px;
            color: var(--text-muted);
            z-index: 2;
            transition: var(--transition);
        }

        .input-wrapper-premium .form-control-premium {
            width: 100%;
            height: 52px;
            border: 2px solid var(--border-light);
            border-radius: var(--radius-sm);
            padding: 0 48px;
            background: #fff;
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 400;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .input-wrapper-premium .form-control-premium::placeholder {
            color: #bbb6b0;
            font-weight: 300;
        }

        .input-wrapper-premium .form-control-premium:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(199, 149, 50, 0.08);
            outline: none;
        }

        .input-wrapper-premium .form-control-premium:focus~.input-icon {
            color: var(--gold);
        }

        .input-wrapper-premium .form-control-premium.is-invalid {
            border-color: #dc3545;
        }

        .input-wrapper-premium .form-control-premium.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.08);
        }

        .input-wrapper-premium .password-toggle-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: var(--text-muted);
            font-size: 17px;
            cursor: pointer;
            z-index: 5;
            padding: 6px;
            border-radius: 6px;
            transition: var(--transition);
        }

        .input-wrapper-premium .password-toggle-btn:hover {
            color: var(--text-primary);
            background: rgba(0, 0, 0, 0.04);
        }

        .error-text {
            font-size: 12px;
            color: #dc3545;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Form Options */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 4px 0 24px;
        }

        .remember-check-premium {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: var(--text-secondary);
            cursor: pointer;
            font-weight: 400;
        }

        .remember-check-premium input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--gold);
            border-radius: 4px;
            cursor: pointer;
            flex-shrink: 0;
            border: 2px solid var(--border-light);
            transition: var(--transition);
        }

        .remember-check-premium input[type="checkbox"]:checked {
            border-color: var(--gold);
        }

        .forgot-link-premium {
            color: var(--gold-dark);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: var(--transition);
        }

        .forgot-link-premium:hover {
            color: #8f621b;
            text-decoration: underline;
        }

        /* Login Button */
        .btn-login-premium {
            width: 100%;
            height: 54px;
            border: 0;
            border-radius: var(--radius-sm);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            background: var(--gold-gradient);
            box-shadow: 0 6px 24px rgba(181, 129, 37, 0.25);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .btn-login-premium::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), transparent 50%);
            pointer-events: none;
        }

        .btn-login-premium::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--gold-gradient-light));
            opacity: 0;
            transition: var(--transition);
        }

        .btn-login-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(181, 129, 37, 0.35);
        }

        .btn-login-premium:hover::after {
            opacity: 1;
        }

        .btn-login-premium span {
            position: relative;
            z-index: 1;
        }

        .btn-login-premium:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider-premium {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0 20px;
            color: var(--text-muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .divider-premium::before,
        .divider-premium::after {
            content: '';
            height: 1px;
            flex: 1;
            background: linear-gradient(to right, transparent, var(--border-light), transparent);
        }

        /* Social Buttons */
        .social-login-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-social-premium {
            height: 50px;
            border: 2px solid var(--border-light);
            border-radius: var(--radius-sm);
            background: #fff;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
        }

        .btn-social-premium:hover {
            border-color: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(199, 149, 50, 0.1);
            color: var(--gold-dark);
        }

        .btn-social-premium .social-icon {
            font-size: 19px;
        }

        .btn-social-premium .social-icon.google {
            color: #4285f4;
            font-weight: 700;
        }

        .btn-social-premium .social-icon.facebook {
            color: #1877f2;
        }

        .btn-social-premium .social-icon.apple {
            color: #000;
        }

        /* Register Link */
        .register-link-premium {
            text-align: center;
            margin: 24px 0 0;
            color: var(--text-secondary);
            font-size: 14px;
        }

        .register-link-premium a {
            color: var(--gold-dark);
            text-decoration: none;
            font-weight: 600;
            margin-left: 4px;
            transition: var(--transition);
        }

        .register-link-premium a:hover {
            color: #8f621b;
            text-decoration: underline;
        }

        /* ============================================
                   BOTTOM BAR
                   ============================================ */
        .login-bottom-bar {
            display: none;
        }

        /* ============================================
                   RESPONSIVE DESIGN
                   ============================================ */

        /* Large Desktops */
        @media (max-width: 1200px) {
            .login-wrapper-modern {
                grid-template-columns: 52% 48%;
                min-height: 85vh;
            }

            .login-hero-panel {
                padding: 40px 35px;
                min-height: 550px;
            }

            .login-form-panel {
                padding: 40px 35px;
            }

            .hero-content-modern .hero-title {
                font-size: clamp(32px, 3.5vw, 44px);
            }
        }

        /* Tablets & Small Desktops */
        @media (max-width: 992px) {
            .login-wrapper-modern {
                grid-template-columns: 1fr;
                min-height: auto;
                border-radius: var(--radius-md);
            }

            .login-hero-panel {
                min-height: 340px;
                padding: 30px 35px;
                align-items: flex-end;
            }

            .login-hero-panel .float-element {
                display: none;
            }

            .login-hero-panel .gold-accent {
                width: 300px;
                height: 300px;
                top: -100px;
                right: -100px;
            }

            .hero-content-modern .hero-title {
                font-size: 32px;
            }

            .hero-content-modern .hero-desc {
                font-size: 14px;
                max-width: 100%;
            }

            .trust-features {
                gap: 20px;
            }

            .trust-feature .tf-icon {
                width: 36px;
                height: 36px;
                font-size: 14px;
            }

            .trust-feature .tf-text strong {
                font-size: 12px;
            }

            .login-form-panel {
                padding: 35px 30px;
            }

            .form-container {
                max-width: 450px;
            }

            .form-brand .brand-logo img {
                max-width: 170px;
                max-height: 60px;
            }

            .form-header h2 {
                font-size: 26px;
            }
        }

        /* Mobile Phones */
        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }

            .login-wrapper-modern {
                border-radius: var(--radius-sm);
                min-height: auto;
            }

            .login-hero-panel {
                min-height: 260px;
                padding: 20px 22px;
            }

            .hero-content-modern .hero-badge {
                font-size: 8px;
                padding: 4px 14px 4px 10px;
                margin-bottom: 12px;
            }

            .hero-content-modern .hero-title {
                font-size: 24px;
                margin-bottom: 10px;
            }

            .hero-content-modern .hero-desc {
                font-size: 13px;
                margin-bottom: 18px;
                line-height: 1.6;
            }

            .hero-content-modern .hero-divider {
                width: 35px;
                margin-bottom: 14px;
            }

            .trust-features {
                gap: 14px;
            }

            .trust-feature .tf-icon {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .trust-feature .tf-text strong {
                font-size: 11px;
            }

            .trust-feature .tf-text span {
                font-size: 9px;
            }

            .login-form-panel {
                padding: 25px 18px;
            }

            .form-brand {
                margin-bottom: 20px;
            }

            .form-brand .brand-logo img {
                max-width: 140px;
                max-height: 50px;
            }

            .form-brand .brand-name {
                font-size: 18px;
                letter-spacing: 2px;
            }

            .form-brand .brand-tagline {
                font-size: 8px;
                letter-spacing: 3px;
            }

            .form-header {
                margin-bottom: 22px;
            }

            .form-header h2 {
                font-size: 22px;
            }

            .form-header .form-subtitle {
                font-size: 13px;
            }

            .form-header .header-line {
                width: 40px;
                margin: 10px auto 8px;
            }

            .form-group-premium {
                margin-bottom: 16px;
            }

            .form-group-premium label {
                font-size: 11px;
            }

            .input-wrapper-premium .form-control-premium {
                height: 46px;
                font-size: 13px;
                padding: 0 42px;
            }

            .input-wrapper-premium .input-icon {
                font-size: 15px;
                left: 14px;
            }

            .input-wrapper-premium .password-toggle-btn {
                font-size: 15px;
                right: 12px;
            }

            .form-options {
                flex-wrap: wrap;
                gap: 10px;
                margin: 2px 0 18px;
            }

            .remember-check-premium {
                font-size: 12px;
            }

            .remember-check-premium input[type="checkbox"] {
                width: 16px;
                height: 16px;
            }

            .forgot-link-premium {
                font-size: 12px;
            }

            .btn-login-premium {
                height: 48px;
                font-size: 13px;
                letter-spacing: 0.8px;
            }

            .divider-premium {
                font-size: 10px;
                margin: 18px 0 16px;
                gap: 12px;
            }

            .social-login-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .btn-social-premium {
                height: 44px;
                font-size: 12px;
                gap: 8px;
            }

            .btn-social-premium .social-icon {
                font-size: 16px;
            }

            .register-link-premium {
                font-size: 13px;
                margin-top: 18px;
            }

            .alert-modern {
                font-size: 12px;
                padding: 10px 14px;
                margin-bottom: 16px;
            }
        }

        /* Extra Small Phones */
        @media (max-width: 380px) {
            .login-hero-panel {
                min-height: 220px;
                padding: 16px 18px;
            }

            .hero-content-modern .hero-title {
                font-size: 20px;
            }

            .hero-content-modern .hero-desc {
                font-size: 12px;
                margin-bottom: 14px;
            }

            .trust-features {
                gap: 10px;
            }

            .trust-feature .tf-icon {
                width: 26px;
                height: 26px;
                font-size: 10px;
            }

            .trust-feature .tf-text strong {
                font-size: 10px;
            }

            .trust-feature .tf-text span {
                font-size: 8px;
            }

            .login-form-panel {
                padding: 20px 14px;
            }

            .form-brand .brand-logo img {
                max-width: 120px;
                max-height: 40px;
            }

            .form-header h2 {
                font-size: 20px;
            }

            .social-login-grid {
                grid-template-columns: 1fr;
            }

            .btn-social-premium {
                height: 42px;
            }
        }

        /* Landscape Phones */
        @media (max-height: 600px) and (orientation: landscape) {
            .login-wrapper-modern {
                min-height: auto;
            }

            .login-hero-panel {
                min-height: 200px;
                padding: 20px 25px;
            }

            .hero-content-modern .hero-title {
                font-size: 22px;
            }

            .hero-content-modern .hero-desc {
                font-size: 12px;
                margin-bottom: 12px;
            }

            .trust-features {
                gap: 12px;
            }

            .trust-feature .tf-icon {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .login-form-panel {
                padding: 20px 25px;
            }

            .form-brand {
                margin-bottom: 14px;
            }

            .form-brand .brand-logo img {
                max-width: 130px;
                max-height: 45px;
            }

            .form-header {
                margin-bottom: 16px;
            }

            .form-header h2 {
                font-size: 20px;
            }

            .form-group-premium {
                margin-bottom: 12px;
            }

            .input-wrapper-premium .form-control-premium {
                height: 40px;
                font-size: 12px;
                padding: 0 38px;
            }

            .btn-login-premium {
                height: 42px;
                font-size: 12px;
            }

            .social-login-grid .btn-social-premium {
                height: 38px;
                font-size: 11px;
            }

            .register-link-premium {
                margin-top: 12px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-wrapper-modern">

            <!-- ==========================================
            LEFT PANEL - HERO IMAGE
            ========================================== -->
            <div class="login-hero-panel">
                <!-- Decorative Elements -->
                <div class="gold-accent"></div>
                <div class="gold-accent-bottom"></div>
                <div class="float-element e1">✦</div>
                <div class="float-element e2">◆</div>
                <div class="float-element e3">✧</div>

                <!-- Hero Content -->
                <div class="hero-content-modern">
                    <div class="hero-badge">
                        <i class="bi bi-gem"></i>
                        Premium Collection
                    </div>
                    <div class="hero-divider"></div>
                    <h1 class="hero-title">
                        Welcome to<br>
                        <span class="highlight">Aethelweave</span>
                    </h1>
                    <p class="hero-desc">
                        Discover timeless elegance with our curated collection of artisan jewellery, crafted with precision and passion.
                    </p>
                    <div class="trust-features">
                        <div class="trust-feature">
                            <div class="tf-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="tf-text">
                                <strong>Authentic</strong>
                                <span>100% Genuine</span>
                            </div>
                        </div>
                        <div class="trust-feature">
                            <div class="tf-icon">
                                <i class="bi bi-gem"></i>
                            </div>
                            <div class="tf-text">
                                <strong>Certified</strong>
                                <span>Hallmarked</span>
                            </div>
                        </div>
                        <div class="trust-feature">
                            <div class="tf-icon">
                                <i class="bi bi-star"></i>
                            </div>
                            <div class="tf-text">
                                <strong>Premium</strong>
                                <span>Luxury Quality</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==========================================
            RIGHT PANEL - LOGIN FORM
            ========================================== -->
            <div class="login-form-panel">
                <!-- Decorative Background -->
                <div class="bg-deco d1"></div>
                <div class="bg-deco d2"></div>
                <div class="bg-deco d3"></div>

                <!-- Form Container -->
                <div class="form-container">

                    <!-- Brand -->
                    <div class="form-brand">
                        <a href="{{ url('/') }}" class="brand-logo">
                            <img src="{{ asset('assets/admin/images/logo.svg') }}" alt="{{ config('app.name') }}">
                        </a>
                        <div class="brand-name">{{ config('app.name') }}</div>
                        <div class="brand-tagline">Fine Jewellery Since 2010</div>
                    </div>

                    <!-- Form Header -->
                    <div class="form-header">
                        <h2>Welcome Back</h2>
                        <div class="header-line"></div>
                        <p class="form-subtitle">Login to access your account</p>
                    </div>
                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="form-group-premium">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <div class="input-wrapper-premium">
                                <i class="bi bi-envelope input-icon"></i>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control-premium @error('email') is-invalid @enderror"
                                    placeholder="Enter your email address" required autofocus>
                            </div>
                            @error('email')
                                <div class="error-text">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group-premium">
                            <label for="password">Password <span class="required">*</span></label>
                            <div class="input-wrapper-premium">
                                <i class="bi bi-lock input-icon"></i>
                                <input type="password" id="password" name="password"
                                    class="form-control-premium @error('password') is-invalid @enderror"
                                    placeholder="Enter your password" required>
                                <button type="button" class="password-toggle-btn" onclick="togglePassword()"
                                    aria-label="Toggle password visibility">
                                    <i class="bi bi-eye" id="passwordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="error-text">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Options -->
                        <div class="form-options">
                            <label class="remember-check-premium">
                                <input type="checkbox" id="remember_me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember me</span>
                            </label>
                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link-premium">Forgot Password?</a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-login-premium">
                            <span>Sign In</span>
                        </button>

                        <!-- Divider -->
                        <div class="divider-premium">
                            <span>or continue with</span>
                        </div>

                        <!-- Social Login -->
                        <div class="social-login-grid">
                            <a href="{{ route('google.login') }}" class="btn-social-premium">
                                <span class="social-icon google">G</span>
                                <span>Google</span>
                            </a>
                            <a href="{{ route('facebook.login') }}" class="btn-social-premium">
                                <i class="bi bi-facebook social-icon facebook"></i>
                                <span>Facebook</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ==========================================
    SCRIPTS
    ========================================== -->
    <script>
        /**
         * Toggle password visibility
         */
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        /**
         * Auto-dismiss alerts after 5 seconds
         */
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-modern');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.style.display = 'none';
                        }
                    }, 500);
                }, 5000);
            });
        });

        /**
         * Smooth scroll to top on form submit (optional)
         */
        document.querySelector('form')?.addEventListener('submit', function() {
            // Small delay to allow the page to reload naturally
            // This ensures any error messages are visible
        });
    </script>
</body>

</html>
