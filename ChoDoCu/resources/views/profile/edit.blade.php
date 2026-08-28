<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chỉnh sửa hồ sơ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        min-height: 100%;
        overflow-x: hidden;
        overflow-y: auto;
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        color: #222;
    }

    .settings-page {
        max-width: 1100px;
        margin: 68px auto;
        padding: 0 15px;

        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 18px;
    }

    /* SIDEBAR */

    .settings-sidebar {
        background: #fff;
        border-radius: 12px;
        padding: 18px;
        height: fit-content;
    }

    .settings-sidebar h2 {
        margin: 0 0 18px;
        font-size: 20px;
    }

    .settings-link {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 12px;
        border-radius: 8px;

        color: #333;
        text-decoration: none;
        font-size: 14px;
    }

    .settings-link:hover {
        background: #f5f5f5;
    }

    .settings-link.active {
        background: #f0f0f0;
        font-weight: 700;
    }

    /* CONTENT */

    .settings-content {
        background: #fff;
        border-radius: 12px;
        padding: 22px;
    }

    .settings-tabs {
        border-bottom: 1px solid #ddd;
        margin-bottom: 25px;
    }

    .settings-tabs span {
        display: inline-block;
        padding-bottom: 12px;

        color: #2563eb;
        border-bottom: 2px solid #2563eb;

        font-weight: 600;
    }

    .settings-content h1 {
        font-size: 22px;
        margin: 0 0 20px;
    }

    /* AVATAR */

    .avatar-edit-row {
        display: flex;
        align-items: center;
        gap: 16px;

        margin-bottom: 25px;
    }

    .edit-avatar {
        position: relative;

        width: 90px;
        height: 90px;

        border-radius: 50%;
        overflow: hidden;

        cursor: pointer;
    }

    .edit-avatar img {
        width: 100%;
        height: 100%;

        object-fit: cover;
        display: block;
    }

    .edit-avatar-fallback {
        width: 100%;
        height: 100%;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #16a34a;
        color: #fff;

        font-size: 30px;
        font-weight: 700;
    }

    .edit-avatar-overlay {
        position: absolute;
        inset: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        background: rgba(0, 0, 0, .45);
        color: #fff;

        opacity: 0;
        transition: .2s;
    }

    .edit-avatar:hover .edit-avatar-overlay {
        opacity: 1;
    }

    .avatar-text strong {
        display: block;
        margin-bottom: 5px;
    }

    .avatar-text span {
        color: #777;
        font-size: 13px;
    }

    /* FORM */

    .form-group {
        margin-bottom: 14px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;

        font-size: 13px;
        font-weight: 600;
    }

    .form-control {
        width: 100%;
        min-height: 46px;

        padding: 12px 14px;

        border: 1px solid #ddd;
        border-radius: 9px;

        font-size: 14px;
        outline: none;
    }

    .form-control:focus {
        border-color: #16a34a;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .form-note {
        margin-top: 5px;
        color: #888;
        font-size: 12px;
    }

    .security-title {
        margin-top: 30px;
        margin-bottom: 8px;

        font-size: 20px;
    }

    .security-note {
        color: #777;
        font-size: 13px;
        margin-bottom: 18px;
    }

    .security-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .security-row .form-control {
        background: #f5f5f5;
    }

    .change-btn {
        flex-shrink: 0;

        border: 0;
        background: transparent;

        font-weight: 700;
        cursor: pointer;
    }

    .submit-area {
        margin-top: 25px;
        display: flex;
        justify-content: flex-end;
    }

    .save-btn {
        min-width: 130px;
        height: 44px;

        border: 0;
        border-radius: 8px;

        background: #16a34a;
        color: #fff;

        font-weight: 700;
        cursor: pointer;
    }

    .save-btn:hover {
        background: #128a3e;
    }

    .error {
        color: #e53935;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 800px) {
        .settings-page {
            grid-template-columns: 1fr;
        }
    }

    .settings-sidebar button.settings-link {
        width: 100%;
        border: 0;
        background: transparent;
        cursor: pointer;
        text-align: left;
    }

    .settings-link.active {
        background: #f0f0f0 !important;
        font-weight: 700;
    }

    .settings-panel {
        display: none;
    }

    .settings-panel.active {
        display: block;
    }


    /* ACCOUNT */

    .account-title {
        margin: 0 0 20px;
        font-size: 22px;
    }

    .password-form {
        background: #fff;
    }

    .account-input {
        margin-bottom: 14px;
    }

    .account-input input {
        width: 100%;
        height: 48px;

        border: 1px solid #ddd;
        border-radius: 10px;

        padding: 0 14px;

        font-size: 14px;
        outline: none;
    }

    .account-input input:focus {
        border-color: #16a34a;
    }

    .password-rules {
        display: grid;
        grid-template-columns: 1fr 1fr;

        gap: 8px 30px;

        margin: 5px 0 18px;

        font-size: 13px;
        color: #555;
    }

    .change-password-btn {
        height: 42px;

        padding: 0 22px;

        border: 0;
        border-radius: 22px;

        background: #16a34a;
        color: #fff;

        font-weight: 700;
        cursor: pointer;
    }

    .account-section {
        margin-top: 24px;
        padding: 20px;

        border-radius: 12px;

        background: #fff;
        border: 1px solid #eee;

        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .account-section h3 {
        margin: 0 0 8px;
    }

    .account-section p {
        margin: 0;
        color: #777;
        font-size: 14px;
    }


    /* SWITCH */

    .switch {
        position: relative;

        width: 48px;
        height: 26px;

        flex-shrink: 0;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        inset: 0;

        background: #ccc;
        border-radius: 30px;

        cursor: pointer;
        transition: .2s;
    }

    .slider::before {
        content: "";

        position: absolute;

        width: 20px;
        height: 20px;

        left: 3px;
        top: 3px;

        border-radius: 50%;

        background: #fff;

        transition: .2s;
    }

    .switch input:checked+.slider {
        background: #16a34a;
    }

    .switch input:checked+.slider::before {
        transform: translateX(22px);
    }

    .delete-request-btn {
        border: 1px solid #ddd;
        background: #fff;

        padding: 9px 18px;

        border-radius: 20px;

        cursor: pointer;
        font-weight: 600;
    }
    </style>
</head>

<body>
    @include('main.header')
    <div class="settings-page">

        <aside class="settings-sidebar">

            <h2>Thiết lập hồ sơ</h2>

            <button type="button" class="settings-link active" data-target="profilePanel" data-title="Hồ sơ cá nhân">

                <i class="fa-regular fa-circle-user"></i>
                Cá nhân, chuyên trang
            </button>

            <button type="button" class="settings-link" data-target="accountPanel" data-title="Cài đặt tài khoản">

                <i class="fa-solid fa-lock"></i>
                Cài đặt tài khoản
            </button>
        </aside>


        <main class="settings-content">

            <div class="settings-tabs">
                <span id="settingsTitle">Hồ sơ cá nhân</span>
            </div>
            <div id="profilePanel" class="settings-panel active">
                <h1>Hồ sơ cá nhân</h1>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Avatar --}}
                    <div class="avatar-edit-row">

                        <label for="avatar" class="edit-avatar">

                            @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" id="avatarPreview">
                            @else
                            <div class="edit-avatar-fallback" id="avatarFallback">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            @endif

                            <div class="edit-avatar-overlay">
                                <i class="fa-solid fa-camera"></i>
                            </div>

                        </label>

                        <input type="file" id="avatar" name="avatar" accept="image/*" hidden>

                        <div class="avatar-text">
                            <strong>Ảnh đại diện</strong>
                            <span>Nhấn vào ảnh để thay đổi</span>
                        </div>

                    </div>


                    {{-- Name --}}
                    <div class="form-group">

                        <label for="name">
                            Họ và tên
                        </label>

                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name', $user->name) }}" required>

                        @error('name')
                        <div class="error">{{ $message }}</div>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div class="form-group">

                        <label for="phone">
                            Số điện thoại
                        </label>

                        <input type="text" id="phone" name="phone" class="form-control"
                            value="{{ old('phone', $user->phone ?? '') }}" placeholder="Thêm số điện thoại">

                    </div>


                    {{-- Address --}}
                    <div class="form-group">

                        <label for="address">
                            Địa chỉ
                        </label>

                        <input type="text" id="address" name="address" class="form-control"
                            value="{{ old('address', $user->address ?? '') }}" placeholder="Nhập địa chỉ">

                    </div>


                    {{-- Bio --}}
                    <div class="form-group">

                        <label for="bio">
                            Giới thiệu về trang
                        </label>

                        <textarea id="bio" name="bio" class="form-control" maxlength="300"
                            placeholder="Giới thiệu ngắn về bạn...">{{ old('bio', $user->bio ?? '') }}</textarea>

                        <div class="form-note">
                            Tối đa 300 ký tự
                        </div>

                    </div>


                    {{-- Username --}}
                    <div class="form-group">

                        <label for="username">
                            Tên gợi nhớ
                        </label>

                        <input type="text" id="username" name="username" class="form-control"
                            value="{{ old('username', $user->username ?? '') }}" placeholder="Ví dụ: test-user">

                    </div>


                    <h2 class="security-title">
                        Thông tin bảo mật
                    </h2>

                    <div class="security-note">
                        Những thông tin dưới đây mang tính bảo mật.
                    </div>


                    {{-- Email --}}
                    <div class="form-group">

                        <label>Email</label>

                        <div class="security-row">

                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>

                            <button type="button" class="change-btn">
                                Thay đổi
                            </button>

                        </div>

                    </div>


                    <div class="submit-area">
                        <button type="submit" class="save-btn">
                            Lưu thay đổi
                        </button>
                    </div>

                </form>
            </div>


            <div id="accountPanel" class="settings-panel">

                <h2 class="account-title">
                    Thay đổi mật khẩu
                </h2>

                <form action="" method="POST" class="password-form">

                    @csrf
                    @method('PUT')

                    <div class="account-input">
                        <input type="password" name="current_password" placeholder="Mật khẩu hiện tại" required>
                    </div>

                    <div class="account-input">
                        <input type="password" name="password" id="newPassword" placeholder="Mật khẩu mới" required>
                    </div>

                    <div class="password-rules">
                        <span>● Giới hạn từ 8-32 ký tự.</span>
                        <span>● Tối thiểu 01 ký tự IN HOA.</span>
                        <span>● Tối thiểu 01 ký tự in thường.</span>
                        <span>● Tối thiểu 01 chữ số.</span>
                    </div>

                    <div class="account-input">
                        <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu mới"
                            required>
                    </div>

                    <button type="submit" class="change-password-btn">
                        Đổi mật khẩu
                    </button>

                </form>


                <div class="account-section">

                    <div>
                        <h3>Liên lạc qua số điện thoại</h3>

                        <p>
                            Cho phép người mua liên lạc qua số điện thoại của bạn
                        </p>
                    </div>

                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>

                </div>


                <div class="account-section danger-section">

                    <div>
                        <h3>Yêu cầu chấm dứt tài khoản</h3>

                        <p>
                            Gửi yêu cầu nếu bạn muốn ngừng sử dụng tài khoản.
                        </p>
                    </div>

                    <button type="button" class="delete-request-btn">
                        Gửi yêu cầu
                    </button>

                </div>

            </div>
        </main>

    </div>


    <script>
    const avatarInput = document.getElementById('avatar');

    avatarInput?.addEventListener('change', function() {

        const file = this.files[0];

        if (!file) return;

        const reader = new FileReader();

        reader.onload = function(e) {

            let preview = document.getElementById('avatarPreview');

            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'avatarPreview';

                const label = document.querySelector('.edit-avatar');

                label.prepend(preview);

                document.getElementById('avatarFallback')?.remove();
            }

            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });

    const settingLinks = document.querySelectorAll(
        '.settings-link[data-target]'
    );

    const settingPanels = document.querySelectorAll('.settings-panel');
    const settingsTitle = document.getElementById('settingsTitle');

    settingLinks.forEach(link => {

        link.addEventListener('click', function() {

            const targetId = this.dataset.target;
            const title = this.dataset.title;

            settingLinks.forEach(item => {
                item.classList.remove('active');
            });

            settingPanels.forEach(panel => {
                panel.classList.remove('active');
            });

            this.classList.add('active');

            document
                .getElementById(targetId)
                ?.classList.add('active');

            // Đổi tiêu đề phía trên
            if (settingsTitle) {
                settingsTitle.textContent = title;
            }
        });

    });
    </script>

</body>

</html>