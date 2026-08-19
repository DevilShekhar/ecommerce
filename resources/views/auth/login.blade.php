<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} | Login</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/admin/images/favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #1949a5;
            --primary-dark: #133b89;
            --text: #20334f;
            --muted: #667085;
            --gold: #b68a2b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            background:
                linear-gradient(rgba(239, 244, 251, .84), rgba(239, 244, 251, .84)),
                url('{{ asset('assets/admin/images/signin.png') }}') center/cover no-repeat;
            color: var(--text);
        }

        .login-page {
            min-height: 100vh;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1480px;
            min-height: 900px;
            background: rgba(255, 255, 255, .60);
            border: 1px solid rgba(255, 255, 255, .9);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(26, 50, 90, .15);
            backdrop-filter: blur(8px);
            display: flex;
            flex-direction: column;
        }

        .login-main {
            flex: 1;
            display: grid;
            grid-template-columns: 57% 43%;
            min-height: 790px;
        }

        /* ================= LEFT SIDE ================= */

        .login-left {
            position: relative;
            overflow: hidden;
            padding: 60px;
            background:
                linear-gradient(90deg, rgba(240, 246, 255, .96) 0%, rgba(232, 240, 251, .75) 42%, rgba(222, 232, 247, .12) 100%),
                url('{{ asset('assets/admin/images/signin.png') }}') center/cover no-repeat;
        }

        .login-left::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg,
                    rgba(255, 255, 255, .04),
                    rgba(22, 59, 117, .12));
            pointer-events: none;
        }

        .brand-area,
        .hero-content {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .brand-logo img {
            max-width: 300px;
            max-height: 95px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        .hero-content {
            margin-top: 80px;
            max-width: 520px;
        }

        .hero-content h1 {
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(42px, 4vw, 58px);
            line-height: 1.1;
            font-weight: 500;
            margin: 0 0 25px;
            color: #243854;
            letter-spacing: .5px;
        }

        .hero-content h1 span {
            display: block;
            color: #22478f;
            margin-top: 6px;
        }

        .gold-line {
            width: 85px;
            height: 3px;
            background: linear-gradient(to right, var(--gold) 50%, #d8dde4 50%);
            margin-bottom: 22px;
        }

        .hero-content p {
            max-width: 400px;
            font-size: 18px;
            line-height: 1.65;
            color: #475569;
            margin-bottom: 30px;
        }

        .trust-points {
            display: flex;
            gap: 38px;
            flex-wrap: wrap;
        }

        .trust-point {
            min-width: 85px;
            text-align: center;
        }

        .trust-icon {
            width: 66px;
            height: 66px;
            margin: 0 auto 10px;
            border-radius: 50%;
            background: rgba(228, 236, 248, .75);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #214785;
        }

        .trust-point span {
            display: block;
            font-size: 15px;
            line-height: 1.4;
            color: #34435b;
        }

        /* ================= RIGHT SIDE ================= */

        .login-right {
            padding: 50px 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(246, 248, 252, .82);
        }

        .login-card {
            width: 100%;
            max-width: 565px;
            background: rgba(255, 255, 255, .78);
            border: 1px solid rgba(220, 225, 235, .8);
            border-radius: 18px;
            padding: 58px 56px 42px;
            box-shadow: 0 12px 35px rgba(34, 57, 95, .08);
        }

        .login-heading {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-heading h2 {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 34px;
            font-weight: 600;
            color: #243854;
            margin-bottom: 14px;
        }

        .heading-line {
            width: 48px;
            height: 3px;
            background: var(--gold);
            margin: 0 auto 18px;
            border-radius: 10px;
        }

        .login-heading p {
            color: #475569;
            font-size: 16px;
            margin: 0;
        }

        .form-group-custom {
            margin-bottom: 24px;
        }

        .form-group-custom label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: #34435b;
            margin-bottom: 10px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap>i {
            position: absolute;
            left: 19px;
            top: 50%;
            transform: translateY(-50%);
            color: #657080;
            font-size: 20px;
            z-index: 2;
        }

        .input-wrap .form-control {
            height: 58px;
            border-radius: 10px;
            border: 1px solid #d5dae2;
            padding: 0 52px;
            font-size: 16px;
            color: #334155;
            box-shadow: none;
            background: rgba(255, 255, 255, .72);
        }

        .input-wrap .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(25, 73, 165, .08);
        }

        .password-toggle {
            position: absolute;
            right: 17px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #657080;
            font-size: 20px;
            cursor: pointer;
            z-index: 5;
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: -4px 0 26px;
        }

        .remember-check {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #526176;
            cursor: pointer;
        }

        .remember-check input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
        }

        .login-btn {
            width: 100%;
            height: 59px;
            border: 0;
            border-radius: 9px;
            color: #fff;
            font-size: 19px;
            font-weight: 600;
            background: linear-gradient(90deg, #173f8d, #2460ce);
            box-shadow: 0 8px 18px rgba(25, 73, 165, .18);
        }

        .login-btn:hover {
            color: #fff;
            background: linear-gradient(90deg, #133778, #1f56b9);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 30px 0 24px;
            color: #56657a;
            font-size: 14px;
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            flex: 1;
            background: #e0e5ec;
        }

        .social-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .social-btn {
            height: 56px;
            border: 1px solid #d8dde5;
            border-radius: 10px;
            background: #fff;
            color: #34435b;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: .2s ease;
        }

        .social-btn:hover {
            color: #1e448c;
            border-color: #aebbd0;
            transform: translateY(-1px);
        }

        .google-icon {
            font-size: 23px;
            font-weight: 700;
            color: #4285f4;
        }

        .facebook-icon {
            color: #1877f2;
            font-size: 23px;
        }

        .create-account {
            text-align: center;
            margin: 38px 0 0;
            color: #536176;
            font-size: 16px;
        }

        .create-account a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }

        /* ================= BOTTOM BENEFITS ================= */

        .bottom-benefits {
            min-height: 106px;
            background: rgba(255, 255, 255, .78);
            border-top: 1px solid rgba(220, 225, 234, .8);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            align-items: center;
            padding: 15px 8%;
        }

        .bottom-benefit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 17px;
        }

        .bottom-benefit>i {
            font-size: 31px;
            color: #29466f;
        }

        .bottom-benefit strong {
            display: block;
            color: #34445d;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .bottom-benefit span {
            display: block;
            color: #667085;
            font-size: 14px;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 1199px) {
            .login-left {
                padding: 45px;
            }

            .login-card {
                padding: 45px 38px;
            }
        }

        @media (max-width: 991px) {
            .login-page {
                padding: 15px;
            }

            .login-wrapper {
                min-height: auto;
            }

            .login-main {
                grid-template-columns: 1fr;
            }

            .login-left {
                min-height: 450px;
            }

            .login-right {
                padding: 40px 20px;
            }

            .login-card {
                max-width: 650px;
            }

            .bottom-benefits {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
                padding: 25px;
            }
        }

        @media (max-width: 576px) {
            .login-page {
                padding: 0;
            }

            .login-wrapper {
                border-radius: 0;
                border: 0;
            }

            .login-left {
                min-height: 420px;
                padding: 30px 25px;
            }

            .brand-logo img {
                max-width: 230px;
            }

            .hero-content {
                margin-top: 55px;
            }

            .hero-content h1 {
                font-size: 38px;
            }

            .hero-content p {
                font-size: 16px;
            }

            .trust-points {
                gap: 18px;
            }

            .trust-icon {
                width: 55px;
                height: 55px;
                font-size: 25px;
            }

            .login-right {
                padding: 25px 15px;
            }

            .login-card {
                padding: 38px 22px 30px;
                border-radius: 14px;
            }

            .login-heading h2 {
                font-size: 29px;
            }

            .login-options {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .social-buttons {
                grid-template-columns: 1fr;
            }

            .bottom-benefits {
                grid-template-columns: 1fr;
                padding: 25px;
            }

            .bottom-benefit {
                justify-content: flex-start;
            }
        }
    </style>
</head>

<body>

    <div class="login-page">

        <div class="login-wrapper">

            <div class="login-main">

                <!-- LEFT SIDE -->
                <div class="login-left">

                    <div class="brand-area">
                        <a href="{{ url('/') }}" class="brand-logo">
                            {{-- Change this path if your logo.svg is stored elsewhere --}}
                            <img src="{{ asset('assets/admin/images/logo.svg') }}"
                                alt="{{ config('app.name') }}">
                        </a>
                    </div>

                    <div class="hero-content">
                        <h1>
                            Timeless Elegance,
                            <span>Made for You ✨</span>
                        </h1>

                        <div class="gold-line"></div>

                        <p>
                            Discover exquisite collections crafted with passion and precision.
                        </p>

                        <div class="trust-points">
                            <div class="trust-point">
                                <div class="trust-icon">
                                    <i class="bi bi-award"></i>
                                </div>
                                <span>Certified<br>Jewellery</span>
                            </div>

                            <div class="trust-point">
                                <div class="trust-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <span>Secure<br>Shopping</span>
                            </div>

                            <div class="trust-point">
                                <div class="trust-icon">
                                    <i class="bi bi-gem"></i>
                                </div>
                                <span>Premium<br>Quality</span>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- RIGHT SIDE -->
                <div class="login-right">

                    <form method="POST"
                        action="{{ route('login') }}"
                        class="login-card">

                        @csrf

                        <div class="login-heading">
                            <h2>Welcome Back!</h2>
                            <div class="heading-line"></div>
                            <p>Login to continue to your account</p>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Email -->
                        <div class="form-group-custom">
                            <label>Email Address</label>

                            <div class="input-wrap">
                                <i class="bi bi-envelope"></i>

                                <input type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter your email"
                                    required
                                    autofocus>
                            </div>

                            @error('email')
                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <!-- Password -->
                        <div class="form-group-custom">
                            <label>Password</label>

                            <div class="input-wrap">
                                <i class="bi bi-lock"></i>

                                <input type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password"
                                    required>

                                <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword()"
                                    aria-label="Show password">

                                    <i class="bi bi-eye" id="passwordIcon"></i>
                                </button>
                            </div>

                            @error('password')
                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <!-- Remember + Forgot -->
                        <div class="login-options">

                            <label class="remember-check">
                                <input type="checkbox"
                                    id="remember_me"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <span>Remember Me</span>
                            </label>

                            @if(Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="forgot-link">
                                    Forgot Password?
                                </a>
                            @endif

                        </div>


                        <!-- Login -->
                        <button type="submit" class="login-btn">
                            Login
                        </button>


                        <!-- Divider -->
                        <div class="divider">
                            <span>or continue with</span>
                        </div>


                        <!-- Social Login -->
                        <div class="social-buttons">

                            <a href="{{ route('google.login') }}"
                                class="social-btn">
                                <span class="google-icon">G</span>
                                <span>Google</span>
                            </a>

                            <a href="{{ route('facebook.login') }}"
                                class="social-btn">
                                <i class="bi bi-facebook facebook-icon"></i>
                                <span>Facebook</span>
                            </a>

                        </div>


                        <!-- Register -->
                        @if(Route::has('register'))
                            <p class="create-account">
                                Don’t have an account?
                                <a href="{{ route('register') }}">
                                    Create Account
                                </a>
                            </p>
                        @endif

                    </form>

                </div>

            </div>


            <!-- BOTTOM BENEFITS -->
            <div class="bottom-benefits">

                <div class="bottom-benefit">
                    <i class="bi bi-truck"></i>
                    <div>
                        <strong>Free Shipping</strong>
                        <span>On orders above ₹999</span>
                    </div>
                </div>

                <div class="bottom-benefit">
                    <i class="bi bi-arrow-repeat"></i>
                    <div>
                        <strong>Easy Returns</strong>
                        <span>30 days return policy</span>
                    </div>
                </div>

                <div class="bottom-benefit">
                    <i class="bi bi-shield-check"></i>
                    <div>
                        <strong>Secure Payments</strong>
                        <span>100% secure checkout</span>
                    </div>
                </div>

                <div class="bottom-benefit">
                    <i class="bi bi-headset"></i>
                    <div>
                        <strong>24/7 Support</strong>
                        <span>We're here to help</span>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>

</body>

</html>
