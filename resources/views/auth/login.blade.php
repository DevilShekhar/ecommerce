<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>{{ config('app.name') }} | Login</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/admin/images/favicon.ico') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.min.css') }}">
</head>

<body class="theme-blush">

<div class="authentication">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-12">

                <form method="POST" action="{{ route('login') }}" class="card auth_form">
                    @csrf

                    <div class="header">
                        <img class="logo" src="{{ asset('assets/admin/images/logo.png') }}" alt="">
                        <h5>Login</h5>
                    </div>

                    <div class="body">

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="input-group mb-3">

                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Email Address"
                                   required
                                   autofocus>

                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="zmdi zmdi-email"></i>
                                </span>
                            </div>

                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="input-group mb-3">

                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password"
                                   required>

                            <div class="input-group-append">
                                <span class="input-group-text">

                                    @if(Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="forgot">
                                            <i class="zmdi zmdi-lock"></i>
                                        </a>
                                    @endif

                                </span>
                            </div>

                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="checkbox">
                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember">

                            <label for="remember_me">
                                Remember Me
                            </label>
                        </div>

                        <button type="submit"
                                class="btn btn-primary btn-block waves-effect waves-light">
                            SIGN IN
                        </button>

                    </div>
                </form>

                <div class="copyright text-center">
                    © {{ date('Y') }}
                    <span>{{ config('app.name') }}</span>
                </div>

            </div>

            <div class="col-lg-8 col-md-6 d-none d-lg-block">

                <div class="card">
                    <img src="{{ asset('assets/admin/images/signin.svg') }}" alt="Sign In">
                </div>

            </div>

        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('assets/admin/bundles/vendorscripts.bundle.js') }}"></script>

</body>
</html>