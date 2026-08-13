<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Forbidden Access | ShopKart</title>
    <!-- Google Font & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f7faff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            color: #121c2d;
        }

        .container {
            max-width: 1100px;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        /* Left Section */
        .left-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2.5rem;
        }

        .logo-icon {
            color: #1a62ff;
            font-size: 2.2rem;
        }

        .logo-text h2 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0d1e3d;
            line-height: 1;
        }

        .logo-text span {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: #5a6e85;
            display: block;
            margin-top: 4px;
        }

        .error-code {
            font-size: 9rem;
            font-weight: 800;
            line-height: 0.9;
            background: linear-gradient(180deg, #2b73ff 0%, #1552d6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        .error-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #0d1e3d;
            margin-bottom: 1rem;
        }

        .error-desc {
            color: #607289;
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 2rem;
        }

        .divider-container {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            margin-bottom: 2rem;
        }

        .divider-line {
            height: 2px;
            background-color: #2b73ff;
            width: 30px;
        }

        .divider-text {
            color: #1a62ff;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            width: 100%;
        }

        .btn {
            padding: 0.8rem 1.8rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #1a62ff;
            color: #ffffff;
            border: 2px solid #1a62ff;
            box-shadow: 0 4px 12px rgba(26, 98, 255, 0.25);
        }

        .btn-primary:hover {
            background-color: #004de6;
            border-color: #004de6;
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #1a62ff;
            border: 2px solid #1a62ff;
        }

        .btn-secondary:hover {
            background-color: #f0f5ff;
        }

        /* Right Section (Illustration Placeholder) */
        .right-content {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .illustration-wrapper {
            width: 100%;
            max-width: 480px;
            position: relative;
        }

        .illustration-wrapper img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Mobile Responsive */
        @media (max-width: 850px) {
            .container {
                grid-template-columns: 1fr;
                gap: 2.5rem;
                text-align: center;
            }

            .left-content {
                align-items: center;
            }

            .error-code {
                font-size: 7rem;
            }

            .error-title {
                font-size: 1.8rem;
            }

            .action-buttons {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Left Column: Branding & Text -->
        <div class="left-content">
            <div class="logo">
                <i class="fa-solid fa-cart-shopping logo-icon"></i>
                <div class="logo-text">
                    <h2>ShopKart</h2>
                    <span>SHOP • SAVE • SMILE</span>
                </div>
            </div>

            <h1 class="error-code">403</h1>
            <h2 class="error-title">Access Forbidden</h2>
            <p class="error-desc">
                Sorry, you don't have permission to access<br>this page or resource.
            </p>

            <div class="divider-container">
                <div class="divider-line"></div>
                <span class="divider-text">Let's get you back on track</span>
                <div class="divider-line"></div>
            </div>

            <div class="action-buttons">
                <a href="/" class="btn btn-primary">
                    <i class="fa-solid fa-house"></i> Go to Homepage
                </a>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Go Back
                </a>
            </div>
        </div>

        <!-- Right Column: Illustration -->
        <div class="right-content">
            <div class="illustration-wrapper">
                <!-- Replace src below with the actual exported image asset path for 403 page -->
                <img src="{{ asset('assets/admin/images/403.png') }}" alt="403 Illustration">
            </div>
        </div>
    </div>

</body>

</html>
