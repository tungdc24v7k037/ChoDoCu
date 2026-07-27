<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Green Header</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

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

            <button class="login">Đăng nhập</button>
            <button class="post">Đăng tin</button>
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
    <button
        type="button"
        class="category-nav category-nav-left"
        onclick="scrollCategories(-1)"
        aria-label="Danh mục trước"
    >
        ‹
    </button>

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

    <button
        type="button"
        class="category-nav category-nav-right"
        onclick="scrollCategories(1)"
        aria-label="Danh mục tiếp theo"
    >
        ›
    </button>
</div>
<div class="page"></div>

</body>
</html>



