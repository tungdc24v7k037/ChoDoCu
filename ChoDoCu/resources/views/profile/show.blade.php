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
    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Hồ sơ cá nhân</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

        <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            margin: 0;
            background: #f3f3f3;
            font-family: Arial, sans-serif;
            color: #222;
        }

        .profile-page {
            width: min(1100px, calc(100% - 30px));
            margin: 20px auto 40px;
        }

        .profile-card,
        .section-card {
            background: #fff;
            border-radius: 14px;
            margin-bottom: 18px;
        }

        /* PROFILE HEADER */
        .profile-card {
            overflow: hidden;
        }

        .profile-cover {
            height: 110px;
            background:
                #16a34a
        }

        .profile-content {
            padding: 0 24px 22px;
        }

        .profile-main {
            display: flex;
            align-items: flex-start;
            gap: 18px;
            margin-top: -50px;
        }

        .avatar-wrap {
            position: relative;
            width: 105px;
            height: 105px;
            flex-shrink: 0;
        }

        .profile-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            background: #eee;
        }

        .avatar-edit {
            position: absolute;
            right: 0;
            bottom: 2px;

            width: 32px;
            height: 32px;

            border: 0;
            border-radius: 50%;

            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);

            cursor: pointer;
        }

        .profile-info {
            flex: 1;
            padding-top: 55px;
        }

        .profile-info h1 {
            margin: 0 0 10px;
            font-size: 24px;
        }

        .profile-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 18px;
            color: #666;
            font-size: 14px;
            margin-bottom: 14px;
        }

        .profile-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .profile-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .profile-actions a,
        .profile-actions button {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            height: 38px;
            padding: 0 15px;

            border: 1px solid #ddd;
            border-radius: 20px;

            background: #fff;
            color: #222;

            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }

        .profile-avatar-info {
            position: absolute;
            left: 0;
            top: 63%;

            width: 100px;
            height: 100px;

            border-radius: 50%;
            background: #16a34a;
        }

        .profile-avatar-info img {
            width: 100%;
            height: 100%;
            display: block;

            object-fit: cover;
            border-radius: 50%;

            border: 3px solid #fff;
        }

        .profile-avatar-info>span {
            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            color: white;
            font-size: 30px;
            font-weight: 700;
        }

        .avatar-camera {
            position: absolute;
            right: 0;
            bottom: 2px;

            width: 30px;
            height: 30px;

            border: 2px solid white;
            border-radius: 50%;

            background: white;
            cursor: pointer;

            box-shadow: 0 2px 6px rgba(0, 0, 0, .15);
        }

        .profile-info h1 {
            margin-top: 0;
        }

        .avatar-label {
            width: 100%;
            height: 100%;

            position: relative;
            display: block;

            border-radius: 50%;
            overflow: hidden;

            cursor: pointer;
        }

        .avatar-image,
        .avatar-fallback {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .avatar-image {
            display: block;
            object-fit: cover;
        }

        .avatar-fallback {
            display: flex;
            align-items: center;
            justify-content: center;

            background: #16a34a;
            color: #fff;

            font-size: 30px;
            font-weight: 700;
        }

        .avatar-overlay {
            position: absolute;
            inset: 0;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 4px;

            border-radius: 50%;

            background: rgba(0, 0, 0, 0.45);
            color: #fff;

            opacity: 0;
            transition: 0.2s ease;
        }

        .avatar-overlay i {
            font-size: 22px;
        }

        .avatar-overlay span {
            font-size: 11px;
        }

        .avatar-label:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-label:hover .avatar-image {
            filter: brightness(0.65);
        }

        /* SECTIONS */
        .section-card {
            padding: 22px;
        }

        .section-title {
            margin: 0 0 16px;
            font-size: 19px;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 22px;
        }

        .tab {
            border: 0;
            border-radius: 20px;
            background: #f4f4f4;

            padding: 9px 15px;
            cursor: pointer;
            font-weight: 600;
        }

        .tab.active {
            background: #222;
            color: #fff;
        }

        /* LISTINGS */
        .listing-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .listing-card {
            min-width: 0;
        }

        .listing-image {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-radius: 12px;
        }

        .listing-title {
            margin: 9px 0 6px;
            font-size: 15px;
            line-height: 1.4;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .listing-price {
            color: #f5223b;
            font-weight: 700;
        }

        /* EMPTY */
        .empty-state {
            min-height: 300px;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            text-align: center;
            color: #777;
        }

        .empty-icon {
            width: 100px;
            height: 100px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #fff2b5;
            border-radius: 50%;

            font-size: 45px;
            margin-bottom: 15px;
        }

        .post-now {
            margin-top: 12px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            height: 42px;
            padding: 0 20px;

            background: #ffd400;
            color: #111;

            text-decoration: none;
            font-weight: 700;

            border-radius: 8px;
        }

        /* REVIEWS */
        .review-filters {
            margin-bottom: 20px;
        }

        .review-note {
            color: #777;
            margin-bottom: 14px;
        }

        @media (max-width: 900px) {
            .listing-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .profile-main {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-info {
                padding-top: 0;
            }

            .profile-meta,
            .profile-actions {
                justify-content: center;
            }

            .listing-grid {
                grid-template-columns: 1fr;
            }
        }

        .profile-product-image {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 10px;
        }

        .profile-product-image img {
            display: block;
            width: 100%;
            height: 215px;
            object-fit: cover;
        }

        /* lớp tối */
        .listing-status-overlay {
            position: absolute;
            inset: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(0, 0, 0, 0.55);

            z-index: 5;
        }

        /* chữ ĐÃ BÁN / ĐÃ ẨN */
        .listing-status-overlay span {
            padding: 9px 18px;

            background: rgba(0, 0, 0, 0.72);
            color: #fff;

            border: 2px solid rgba(255, 255, 255, 0.9);
            border-radius: 6px;

            font-size: 17px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .profile-listing-tabs {
            display: flex;
            gap: 10px;

            margin-bottom: 20px;
        }

        .profile-tab {
            padding: 8px 14px;

            border: 0;
            border-radius: 18px;

            background: #f3f3f3;
            color: #222;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;
        }

        .profile-tab.active {
            background: #222;
            color: #fff;
        }


        .profile-listing-group {
            display: none;
        }

        .profile-listing-group.active {
            display: block;
        }

        /* ===============================
   TAB PROFILE
================================ */

        .profile-listing-tabs {
            display: flex;
            align-items: center;
            gap: 10px;

            margin: 10px 0 20px;
        }

        .profile-tab {
            padding: 8px 14px;

            border: none;
            border-radius: 20px;

            background: #f3f3f3;
            color: #222;

            font-size: 13px;
            font-weight: 600;

            cursor: pointer;
        }

        .profile-tab.active {
            background: #222;
            color: #fff;
        }


        /* ===============================
   NHÓM SẢN PHẨM
================================ */

        .profile-listing-group {
            display: none;
        }

        .profile-listing-group.active {
            display: block;
        }


        /* ===============================
   GRID SẢN PHẨM
================================ */

        .profile-products {
            display: grid;

            grid-template-columns: repeat(4, minmax(0, 1fr));

            gap: 18px;

            width: 100%;
        }


        /* ===============================
   CARD
================================ */

        .profile-product-card {
            display: block;

            min-width: 0;

            color: #222;
            text-decoration: none !important;

            background: transparent;

            border-radius: 10px;

            overflow: hidden;
        }

        .profile-product-card:hover {
            text-decoration: none !important;
        }


        /* ===============================
   ẢNH
================================ */

        .profile-product-image {
            position: relative;

            width: 100%;
            height: 215px;

            overflow: hidden;

            background: #f2f2f2;

            border-radius: 10px;
        }

        .profile-product-image img {
            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;

            transition: transform .2s ease;
        }

        .profile-product-card:hover .profile-product-image img {
            transform: scale(1.02);
        }


        /* ===============================
   TITLE
================================ */

        .profile-product-title {
            margin-top: 10px;

            color: #222;

            font-size: 15px;
            font-weight: 500;
            line-height: 1.35;

            text-decoration: none !important;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            overflow: hidden;

            min-height: 40px;
        }


        /* ===============================
   GIÁ
================================ */

        .profile-product-price {
            margin-top: 6px;

            color: #ff1f2d;

            font-size: 15px;
            font-weight: 700;

            text-decoration: none !important;
        }


        /* ===============================
   OVERLAY ĐÃ BÁN / ĐÃ ẨN
================================ */

        .listing-status-overlay {
            position: absolute;
            inset: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: rgba(0, 0, 0, .55);

            z-index: 5;
        }

        .listing-status-overlay span {
            padding: 9px 18px;

            background: rgba(0, 0, 0, .72);
            color: #fff;

            border: 2px solid rgba(255, 255, 255, .9);
            border-radius: 6px;

            font-size: 16px;
            font-weight: 800;
            letter-spacing: 1px;
        }


        /* ===============================
   EMPTY
================================ */

        .profile-empty {
            grid-column: 1 / -1;

            padding: 60px 20px;

            text-align: center;

            color: #888;
        }


        /* ===============================
   RESPONSIVE
================================ */

        @media (max-width: 1000px) {

            .profile-products {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

        }

        @media (max-width: 768px) {

            .profile-products {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .profile-product-image {
                height: 180px;
            }

        }

        @media (max-width: 480px) {

            .profile-products {
                grid-template-columns: 1fr;
            }

        }
        </style>
    </head>

    <body>

        <div class="profile-page">

            {{-- HEADER PROFILE --}}
            <section class="profile-card">

                <div class="profile-cover"></div>

                <div class="profile-content">

                    <div class="profile-main">

                        <div class="avatar-wrap">
                            @if(auth()->check() && auth()->id() === $user->id)

                            {{-- Chính chủ: cho phép đổi avatar --}}
                            <div class="profile-avatar-info">

                                <label for="avatarInput" class="avatar-label">

                                    @if($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar-image">
                                    @else
                                    <span class="avatar-fallback">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                    @endif

                                    <div class="avatar-overlay">
                                        <i class="fa-solid fa-camera"></i>
                                        <span>Đổi ảnh</span>
                                    </div>

                                </label>

                                <input type="file" id="avatarInput" name="avatar" accept="image/*" hidden>

                            </div>

                            @else

                            {{-- Người khác xem: chỉ hiện avatar --}}
                            <div class="profile-avatar-info">

                                @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar-image">
                                @else
                                <span class="avatar-fallback">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                                @endif

                            </div>

                            @endif

                        </div>

                        <div class="profile-info">

                            <h1>{{ $user->name }}</h1>

                            <div class="profile-meta">

                                <span>
                                    Người theo dõi: 0
                                </span>

                                <span>
                                    <i class="fa-regular fa-calendar"></i>

                                    Đã tham gia:
                                    {{ $user->created_at->diffForHumans() }}
                                </span>

                                <span>
                                    <i class="fa-solid fa-location-dot"></i>

                                    Chưa cung cấp
                                </span>

                            </div>

                            <div class="profile-actions">

                                @if(auth()->check() && auth()->id() === $user->id)
                                <a href="{{ route('profile.edit') }}">
                                    <i class="fa-solid fa-gear"></i>
                                    Chỉnh sửa trang
                                </a>
                                @endif

                                <button type="button">
                                    <i class="fa-solid fa-share"></i>
                                    Chia sẻ
                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- TẤT CẢ TIN ĐĂNG --}}
            <section class="section-card">

                <h2 class="section-title">
                    Tất cả tin đăng ({{ $listings->count() }})
                </h2>
                <div class="profile-listing-tabs">

                    <button type="button" class="profile-tab active" data-status="published">
                        Tin đang hoạt động
                        ({{ $publishedListings->count() }})
                    </button>

                    <button type="button" class="profile-tab" data-status="sold">
                        Đã bán
                        ({{ $soldListings->count() }})
                    </button>

                    @if(auth()->check() && auth()->id() === $user->id)
                    <button type="button" class="profile-tab" data-status="hidden">
                        Đã ẩn
                        ({{ $hiddenListings->count() }})
                    </button>
                    @endif

                </div>
                <div class="profile-listing-group" data-group="sold">

                    <div class="profile-products">

                        @forelse($soldListings as $listing)

                        <a href="{{ route('listings.show', $listing->slug) }}" class="profile-product-card">

                            <div class="profile-product-image">

                                @if($listing->primaryImage)
                                <img src="{{ $listing->primaryImage->image_path }}" alt="{{ $listing->title }}">
                                @endif

                                <div class="listing-status-overlay">
                                    <span>ĐÃ BÁN</span>
                                </div>

                            </div>

                            <div class="profile-product-title">
                                {{ $listing->title }}
                            </div>

                            <div class="profile-product-price">
                                {{ number_format($listing->price, 0, ',', '.') }} đ
                            </div>

                        </a>

                        @empty

                        <div class="profile-empty">
                            Chưa có tin đã bán
                        </div>

                        @endforelse

                    </div>

                </div>
                @if(auth()->check() && auth()->id() === $user->id)

                <div class="profile-listing-group" data-group="hidden">

                    <div class="profile-products">

                        @forelse($hiddenListings as $listing)

                        <div class="profile-product-card">

                            <div class="profile-product-image">

                                @if($listing->primaryImage)
                                <img src="{{ $listing->primaryImage->image_path }}" alt="{{ $listing->title }}">
                                @endif

                                <div class="listing-status-overlay">
                                    <span>ĐÃ ẨN</span>
                                </div>

                            </div>

                            <div class="profile-product-title">
                                {{ $listing->title }}
                            </div>

                            <div class="profile-product-price">
                                {{ number_format($listing->price, 0, ',', '.') }} đ
                            </div>

                        </div>

                        @empty

                        <div class="profile-empty">
                            Chưa có tin đã ẩn
                        </div>

                        @endforelse

                    </div>

                </div>

                @endif
                <div class="profile-listing-group active" data-group="published">

                    <div class="profile-products">

                        @forelse($publishedListings as $listing)

                        <a href="{{ route('listings.show', $listing->slug) }}" class="profile-product-card">

                            <div class="profile-product-image">

                                @if($listing->primaryImage)
                                <img src="{{ $listing->primaryImage->image_path }}" alt="{{ $listing->title }}">
                                @endif

                            </div>

                            <div class="profile-product-title">
                                {{ $listing->title }}
                            </div>

                            <div class="profile-product-price">
                                {{ number_format($listing->price, 0, ',', '.') }} đ
                            </div>

                        </a>

                        @empty

                        <div class="profile-empty">
                            Chưa có tin đang hoạt động
                        </div>

                        @endforelse

                    </div>

                </div>

            </section>


            <!-- {{-- ĐÁNH GIÁ --}}
            <section class="section-card">

                <h2 class="section-title">
                    Đánh giá
                </h2>

                <div class="review-note">
                    Chưa có đánh giá
                </div>

                <div class="review-filters">

                    <div class="tabs">

                        <button class="tab active">
                            Tất cả (0)
                        </button>

                        <button class="tab">
                            Từ người mua (0)
                        </button>

                        <button class="tab">
                            Từ người bán (0)
                        </button>

                    </div>

                </div>

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="fa-regular fa-star"></i>
                    </div>

                    <div>
                        Chưa có đánh giá từ người bán
                    </div>

                </div>

            </section> -->

        </div>

    </body>

    </html>
</body>
<script>
const avatarInput = document.getElementById('avatarInput');

avatarInput?.addEventListener('change', function() {
    const file = this.files[0];

    if (!file) return;

    const reader = new FileReader();

    reader.onload = function(e) {
        let image = document.querySelector('.avatar-image');
        const fallback = document.querySelector('.avatar-fallback');

        if (!image) {
            image = document.createElement('img');
            image.className = 'avatar-image';

            document
                .querySelector('.avatar-label')
                .prepend(image);

            fallback?.remove();
        }

        image.src = e.target.result;
    };

    reader.readAsDataURL(file);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const tabs =
        document.querySelectorAll('.profile-tab');

    const groups =
        document.querySelectorAll('.profile-listing-group');


    tabs.forEach(function(tab) {

        tab.addEventListener('click', function() {

            const status =
                this.dataset.status;


            tabs.forEach(function(item) {
                item.classList.remove('active');
            });


            groups.forEach(function(group) {
                group.classList.remove('active');
            });


            this.classList.add('active');


            const target =
                document.querySelector(
                    `.profile-listing-group[data-group="${status}"]`
                );

            if (target) {
                target.classList.add('active');
            }

        });

    });

});
</script>

</html>