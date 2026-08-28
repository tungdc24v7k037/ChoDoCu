<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gradient Wave Login Form</title>
    <meta name="description"
        content="Animated gradient login form with card-tilt parallax, ripple effects and drifting particles.">
    <meta name="author" content="Aigars Silkalns / Colorlib">
    <link rel="canonical" href="https://preview.colorlib.com/theme/login-forms/forms/gradient-wave/">
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='48' fill='%236366f1'/><text x='50' y='68' font-size='60' text-anchor='middle' fill='white' font-family='system-ui,sans-serif'>L</text></svg>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Gradient Wave Login Form">
    <meta property="og:description"
        content="Animated gradient login form with card-tilt parallax, ripple effects and drifting particles.">
    <meta property="og:url" content="https://preview.colorlib.com/theme/login-forms/forms/gradient-wave/">
    <meta property="og:image"
        content="https://preview.colorlib.com/theme/login-forms/assets/screenshots/gradient-wave.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Gradient Wave Login Form">
    <meta name="twitter:description"
        content="Animated gradient login form with card-tilt parallax, ripple effects and drifting particles.">
    <meta name="twitter:image"
        content="https://preview.colorlib.com/theme/login-forms/assets/screenshots/gradient-wave.png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('main.header')


    <div class="login-container">
        <div class="login-card">
            <div class="gradient-icon">
                <img src="{{ asset('img/logo.png') }}" class="login-logo">
            </div>
            <div class="card-glow"></div>
            <div class="login-header">
                <h1>Tạo tài khoản</h1>

                <p>
                    Đăng ký để bắt đầu mua bán trên Chợ Đồ Cũ
                </p>
            </div>

            <form class="login-form" id="loginForm" action="{{ route('register.submit') }}" method="POST" novalidate>
                @csrf

                {{-- HỌ VÀ TÊN --}}
                <div class="form-group">
                    <div class="input-container">
                        <div class="input-bg"></div>

                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                            placeholder=" ">

                        <label for="name">
                            Họ và tên
                        </label>

                        <div class="input-wave"></div>
                    </div>

                    @error('name')
                    <span class="error-message">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                {{-- EMAIL --}}
                <div class="form-group">
                    <div class="input-container">
                        <div class="input-bg"></div>

                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" placeholder=" ">

                        <label for="email">
                            Tài khoản Email
                        </label>

                        <div class="input-wave"></div>
                    </div>

                    @error('email')
                    <span class="error-message">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                {{-- MẬT KHẨU --}}
                <div class="form-group">
                    <div class="input-container password-container">
                        <div class="input-bg"></div>

                        <input type="password" id="password" name="password" required autocomplete="new-password"
                            placeholder=" ">

                        <label for="password">
                            Mật khẩu
                        </label>

                        <button type="button" class="password-toggle" id="passwordToggle"
                            aria-label="Hiện hoặc ẩn mật khẩu">
                            <div class="toggle-bg"></div>

                            <div class="toggle-icon">

                                <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>

                                <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>

                            </div>
                        </button>

                        <div class="input-wave"></div>
                    </div>

                    @error('password')
                    <span class="error-message">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                {{-- NHẬP LẠI MẬT KHẨU --}}
                <div class="form-group">
                    <div class="input-container password-container">
                        <div class="input-bg"></div>

                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            autocomplete="new-password" placeholder=" ">

                        <label for="password_confirmation">
                            Nhập lại mật khẩu
                        </label>

                        <button type="button" class="password-toggle" id="passwordConfirmationToggle"
                            aria-label="Hiện hoặc ẩn mật khẩu xác nhận">
                            <div class="toggle-bg"></div>

                            <div class="toggle-icon">
                                <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>

                                <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </div>
                        </button>

                        <div class="input-wave"></div>
                    </div>

                    @error('password_confirmation')
                    <span class="error-message">
                        {{ $message }}
                    </span>
                    @enderror
                </div>



                <button type="submit" class="gradient-button">
                    <div class="button-bg"></div>
                    <div class="button-content">
                        <span class="btn-text">Đăng ký</span>
                        <div class="btn-loader">
                            <div class="loader-wave"></div>
                            <div class="loader-wave"></div>
                            <div class="loader-wave"></div>
                        </div>
                    </div>
                    <div class="button-ripple"></div>
                </button>
            </form>


            <div class="success-message" id="successMessage">
                <div class="success-wave"></div>
                <div class="success-content">
                    <div class="success-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <h3>Welcome back!</h3>
                    <p>Redirecting to your dashboard...</p>
                </div>
            </div>
        </div>
    </div>
    <script src="../../shared/js/form-utils.js"></script>
    <script src="script.js"></script>
</body>

</html>