<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f3f4f6;
        min-height: 100%;
        height: auto;
        overflow-y: auto !important;
        overflow-x: hidden;
    }

    .manage-page {
        max-width: 1000px;
        margin: 60px auto;
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .manage-top {
        position: relative;

        background: #fff;
        padding: 18px;

        border-radius: 12px 12px 0 0;
    }

    .breadcrumb {
        margin-bottom: 25px;
        font-size: 13px;
        color: #777;
    }

    .breadcrumb a {
        color: #777;
        text-decoration: none;
    }

    .manage-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .manage-user img,
    .manage-avatar-default {
        width: 52px;
        height: 52px;

        border-radius: 50%;
        object-fit: cover;
    }

    .manage-avatar-default {
        display: flex;
        align-items: center;
        justify-content: center;

        background: #16a34a;
        color: white;

        font-weight: 700;
    }

    .manage-user strong {
        display: block;
        font-size: 18px;
    }

    .manage-user a {
        display: block;
        margin-top: 5px;

        color: #2563eb;
        text-decoration: none;

        font-size: 13px;
    }

    .manage-search {
        position: absolute;

        right: 18px;
        top: 50px;

        width: 270px;
        height: 44px;

        display: flex;
        align-items: center;
        gap: 10px;

        border: 1px solid #ddd;
        border-radius: 10px;

        padding: 0 14px;
    }

    .manage-search input {
        width: 100%;
        border: 0;
        outline: none;
    }

    .manage-tabs {
        display: flex;
        overflow-x: auto;

        background: #fff;

        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .manage-tabs a {
        flex: 1;
        min-width: 120px;

        padding: 16px 10px;

        text-align: center;

        color: #555;
        text-decoration: none;

        font-size: 13px;

        border-bottom: 3px solid transparent;
    }

    .manage-tabs a.active {
        color: #111;
        font-weight: 700;

        border-bottom-color: #16a34a;
    }

    .manage-content {
        min-height: 500px;
        background: #f5f5f5;

        padding: 22px 0;
    }

    .manage-listing-card {
        background: #fff;

        display: flex;
        align-items: center;
        gap: 18px;

        margin-bottom: 12px;
        padding: 15px;

        border-radius: 10px;
    }

    .manage-listing-image {
        width: 120px;
        height: 120px;

        object-fit: cover;
        border-radius: 8px;
    }

    .manage-listing-info {
        flex: 1;
    }

    .manage-listing-title {
        color: #111;
        text-decoration: none;

        font-size: 16px;
        font-weight: 600;
    }

    .manage-price {
        margin-top: 8px;

        color: #f5223b;
        font-weight: 700;
    }

    .manage-meta {
        margin-top: 12px;

        color: #999;
        font-size: 13px;
    }

    .manage-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .edit-listing-btn {
        padding: 9px 15px;

        border: 1px solid #ddd;
        border-radius: 20px;

        color: #111;
        text-decoration: none;

        font-size: 13px;
        font-weight: 600;
    }

    .more-btn {
        width: 36px;
        height: 36px;

        border: 0;
        border-radius: 50%;

        background: #f5f5f5;

        cursor: pointer;
    }

    .manage-empty {
        min-height: 400px;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        text-align: center;
    }

    .empty-icon {
        width: 80px;
        height: 80px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #fff;
        color: #16a34a;

        font-size: 34px;
    }

    .manage-empty h2 {
        margin: 18px 0 5px;
    }

    .manage-empty p {
        margin: 0;

        color: #777;
    }

    .manage-empty a {
        margin-top: 15px;

        padding: 11px 20px;

        border-radius: 8px;

        background: #16a34a;
        color: #111;

        text-decoration: none;
        font-weight: 700;
    }

    .manage-pagination {
        display: flex;
        align-items: center;
        justify-content: center;

        gap: 8px;

        padding: 24px 0;
    }


    .page-btn,
    .page-number {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #e5e5e5;
        border-radius: 8px;

        background: #fff;

        color: #333;
        text-decoration: none;

        font-size: 14px;
        font-weight: 600;

        cursor: pointer;

        transition: .2s ease;
    }


    .page-btn i {
        font-size: 13px;
    }


    .page-btn:hover,
    .page-number:hover {
        border-color: #16a34a;
        color: #16a34a;
    }


    .page-number.active {
        background: #16a34a;
        border-color: #16a34a;

        color: #fff;
    }


    .page-btn.disabled {
        opacity: .4;
        cursor: default;
    }
    </style>
</head>

<body>
    @include('main.header')
    <div class="manage-page">

        <div class="manage-top">

            <div class="breadcrumb">
                <a href="{{ route('home') }}">Chợ Đồ Cũ</a>
                /
                <span>Quản lý tin</span>
            </div>

            <div class="manage-user">
                @if(Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                @else
                <div class="manage-avatar-default">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                @endif

                <div>
                    <strong>{{ Auth::user()->name }}</strong>

                </div>
            </div>



        </div>


        <div class="manage-tabs">

            <a href="{{ route('listings.manage', ['status' => 'published']) }}"
                class="{{ $status === 'published' ? 'active' : '' }}">
                ĐANG HIỂN THỊ ({{ $counts->published ?? 0 }})
            </a>

            <a href="{{ route('listings.manage', ['status' => 'expired']) }}"
                class="{{ $status === 'expired' ? 'active' : '' }}">
                HẾT HẠN ({{ $counts->expired ?? 0 }})
            </a>

            <a href="{{ route('listings.manage', ['status' => 'rejected']) }}"
                class="{{ $status === 'rejected' ? 'active' : '' }}">
                BỊ TỪ CHỐI ({{ $counts->rejected ?? 0 }})
            </a>

            <a href="{{ route('listings.manage', ['status' => 'pending_payment']) }}"
                class="{{ $status === 'pending_payment' ? 'active' : '' }}">
                CẦN THANH TOÁN ({{ $counts->pending_payment ?? 0 }})
            </a>

            <a href="{{ route('listings.manage', ['status' => 'draft']) }}"
                class="{{ $status === 'draft' ? 'active' : '' }}">
                TIN NHÁP ({{ $counts->draft ?? 0 }})
            </a>

            <a href="{{ route('listings.manage', ['status' => 'pending']) }}"
                class="{{ $status === 'pending' ? 'active' : '' }}">
                CHỜ DUYỆT ({{ $counts->pending ?? 0 }})
            </a>

            <a href="{{ route('listings.manage', ['status' => 'hidden']) }}"
                class="{{ $status === 'hidden' ? 'active' : '' }}">
                ĐÃ ẨN ({{ $counts->hidden ?? 0 }})
            </a>

        </div>


        <div class="manage-content">

            @forelse($listings as $listing)

            <article class="manage-listing-card">

                @if($listing->primaryImage)
                <img src="{{ $listing->primaryImage->image_path }}" alt="{{ $listing->title }}"
                    class="manage-listing-image">
                @endif

                <div class="manage-listing-info">

                    <a href="{{ route('listings.show', $listing->slug) }}" class="manage-listing-title">
                        {{ $listing->title }}
                    </a>

                    <div class="manage-price">
                        {{ number_format($listing->price, 0, ',', '.') }} đ
                    </div>

                    <div class="manage-meta">
                        {{ $listing->district }}
                        @if($listing->province)
                        • {{ $listing->province }}
                        @endif
                    </div>

                </div>

                <div class="manage-actions">

                    <a href="{{ route('listings.edit', $listing->id) }}" class="edit-listing-btn">
                        Sửa tin
                    </a>

                    <button type="button" class="more-btn">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>

                </div>

            </article>

            @empty

            <div class="manage-empty">

                <div class="empty-icon">
                    <i class="fa-regular fa-file-lines"></i>
                </div>

                <h2>Không tìm thấy tin đăng</h2>

                <p>
                    Bạn hiện tại không có tin đăng nào cho trạng thái này
                </p>

                <a href="{{ route('createnews') }}">
                    Đăng tin
                </a>

            </div>

            @endforelse
            @if($listings->hasPages())

            <div class="manage-pagination">

                {{-- Previous --}}
                @if($listings->onFirstPage())

                <span class="page-btn disabled">
                    <i class="fa-solid fa-chevron-left"></i>
                </span>

                @else

                <a href="{{ $listings->previousPageUrl() }}" class="page-btn">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>

                @endif


                {{-- Số trang --}}
                @for($page = 1; $page <= $listings->lastPage(); $page++)

                    <a href="{{ $listings->url($page) }}" class="page-number
                {{ $listings->currentPage() == $page ? 'active' : '' }}">
                        {{ $page }}
                    </a>

                    @endfor


                    {{-- Next --}}
                    @if($listings->hasMorePages())

                    <a href="{{ $listings->nextPageUrl() }}" class="page-btn">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>

                    @else

                    <span class="page-btn disabled">
                        <i class="fa-solid fa-chevron-right"></i>
                    </span>

                    @endif

            </div>

            @endif
        </div>

    </div>
</body>

</html>