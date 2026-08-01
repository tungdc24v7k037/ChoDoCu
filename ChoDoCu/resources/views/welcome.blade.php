<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Green Header</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

<div class="hero">

    <div class="navbar">

        <div class="left">
            <div class="logo">GREEN MART</div>

            <div class="menu">
                <a href="#">Trang chủ</a>
                <a href="#">Sản phẩm</a>
                <a href="#">Khuyến mãi</a>
                <a href="#">Liên hệ</a>
            </div>
        </div>

        <div class="right">
            <div class="icon">♡</div>
            <div class="icon">🔔</div>

          <button
    class="login"
    onclick="window.location='{{ route('login') }}'">
    Đăng nhập
</button>
           <button
    type="button"
    class="post"
    onclick="window.location.href='{{ route('createnews') }}'"
>
    Đăng tin
</button>
        </div>

    </div>

    <div class="title">
        Giá tốt • Gần bạn • Mua bán nhanh
    </div>
</div>
 <div class="search-box">

        <div class="search-input">
            🔍
            <input type="text" placeholder="Tìm sản phẩm...">
        </div>

        <div class="location">
            📍 Cần Thơ
        </div>

        <button class="search-btn">
            Tìm kiếm
        </button>

    </div>



    <div class="category-slider">
    <!-- <button
        type="button"
        class="category-nav category-nav-left"
        onclick="scrollCategories(-1)"
        aria-label="Danh mục trước"
    >
        ‹
    </button> -->

    <div class="category-scroll" id="categoryScroll">
        @foreach ($categories as $item)
            <a
                href="{{ route('categories.show', $item->slug) }}"
                class="category-item"
            >
                @if (!empty($item->image))
                    <img
                        src="{{ asset('storage/' . $item->image) }}"
                        alt="{{ $item->name }}"
                    >
                @endif

                <span>{{ $item->name }}</span>
            </a>
        @endforeach
    </div>

    <!-- <button
        type="button"
        class="category-nav category-nav-right"
        onclick="scrollCategories(1)"
        aria-label="Danh mục tiếp theo"
    >
        ›
    </button> -->
</div>
<div class="page">
    <section class="listing-section">
    <div class="listing-container">

        <div class="listing-tabs">
            <button class="listing-tab active" type="button">
                Dành cho bạn
            </button>

            <button class="listing-tab" type="button">
                Mới nhất
            </button>

            <button class="listing-tab" type="button">
                Video <sup>✦</sup>
            </button>
        </div>

        @if ($listings->count() > 0)
            <div class="listing-grid">

                @foreach ($listings as $listing)
                    <article class="listing-card">

                        <a href="#"
                           class="listing-image-wrapper">

                            @if ($listing->primaryImage)
                                <img
                                    src="{{ asset('storage/' . $listing->primaryImage->image_path) }}"
                                    alt="{{ $listing->title }}"
                                    class="listing-image"
                                >
                            @else
                                <div class="listing-placeholder">
                                    Không có ảnh
                                </div>
                            @endif

                            <button
                                type="button"
                                class="favorite-button"
                                onclick="event.preventDefault();"
                                aria-label="Yêu thích"
                            >
                                ♡
                            </button>

                            <span class="listing-time">
                                {{ $listing->created_at->diffForHumans() }}
                            </span>
                        </a>

                        <div class="listing-content">

                            <a href="#"
                               class="listing-title">
                                {{ $listing->title }}
                            </a>

                            @if (!empty($listing->category))
                                <div class="listing-category">
                                    {{ $listing->category->name }}
                                </div>
                            @endif

                            <div class="listing-price">
                                {{ number_format($listing->price, 0, ',', '.') }} đ
                            </div>

                            <div class="listing-footer">
                                <div class="listing-location">
                                    <span>⌖</span>

                                    <div>
                                        @if (!empty($listing->district))
                                            <div>{{ $listing->district }}</div>
                                        @endif

                                        @if (!empty($listing->ward))
                                            <div>{{ $listing->ward }}</div>
                                        @endif
                                    </div>
                                </div>

                                <button
                                    type="button"
                                    class="listing-more"
                                    aria-label="Tùy chọn"
                                >
                                    ⋮
                                </button>
                            </div>

                        </div>
                    </article>
                @endforeach

            </div>

            <div class="listing-pagination">
                {{ $listings->links() }}
            </div>
        @else
            <div class="listing-empty">
                Chưa có sản phẩm nào trong danh mục này.
            </div>
        @endif

    </div>
</section>

@include('main.introduce')
@include('main.footer')
</div>

</body>
</html>



