<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <title>{{ $category->name }}</title>

    <style>
    * {
        box-sizing: border-box;
    }

    html,
    body {
        width: 100%;
        max-width: 100%;
        margin: 0;
        overflow-x: hidden;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
    }

    .hero {
        width: 100%;
        max-width: 100%;
        overflow: hidden;
    }

    .search-box {
        width: calc(100% - 30px);
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }

    .category-slider {
        position: relative;
        width: calc(100% - 30px);
        max-width: 997px;
        margin-bottom: 50px;
        padding: 12px 52px;
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
    }

    .category-scroll {
        width: 100%;
        min-width: 0;
        display: flex;
        align-items: stretch;
        gap: 10px;
        overflow-x: auto;
        overflow-y: hidden;
        scroll-behavior: smooth;
        scrollbar-width: none;
        -ms-overflow-style: none;
        overscroll-behavior-x: contain;
    }

    .category-scroll::-webkit-scrollbar {
        display: none;
    }

    .sub-category-item {
        flex: 0 0 110px;
        width: 110px;
        min-width: 110px;
        min-height: 62px;
        padding: 8px 9px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: #f7f7f7;
        border: 1px solid transparent;
        border-radius: 12px;
        color: #222;
        text-decoration: none !important;
        text-align: center;
        transition: background-color .2s ease, border-color .2s ease, color .2s ease;
    }

    .sub-category-item img {
        width: 36px;
        height: 36px;
        display: block;
        flex-shrink: 0;
        object-fit: contain;
    }

    .sub-category-item span {
        width: 100%;
        color: #222;
        text-decoration: none !important;
        font-size: 13px;
        font-weight: 500;
        line-height: 1.2;
        text-align: center;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
    }

    .sub-category-item:hover {
        background: #ecfdf3;
        border-color: #16a34a;
    }

    .sub-category-item:hover span {
        color: #16a34a;
    }

    .category-nav {
        position: absolute;
        top: 50%;
        width: 38px;
        height: 38px;
        padding: 0;
        display: flex !important;
        align-items: center;
        justify-content: center;
        border: 1px solid #e6e6e6;
        border-radius: 50%;
        background: #fff;
        color: #222;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .15);
        cursor: pointer;
        z-index: 20;
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(-50%);
        transition: background-color .2s ease, color .2s ease, border-color .2s ease;
    }

    .category-prev {
        left: 8px;
    }

    .category-next {
        right: 8px;
    }

    .category-nav:hover {
        background: #16a34a;
        border-color: #16a34a;
        color: #fff;
    }

    .category-nav:active {
        transform: translateY(-50%) scale(.94);
    }

    .container {
        width: calc(100% - 30px);
        max-width: 1200px;
        margin: 0 auto;
        padding-top: 45px;
        padding-bottom: 50px;
    }

    .breadcrumb {
        margin: 0 0 14px;
        color: #444;
        font-size: 14px;
    }

    .breadcrumb a {
        color: #333;
    }

    .products {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
    }

    .product {
        min-width: 0;
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #222;
    }

    .product img {
        width: 100%;
        height: 180px;
        display: block;
        object-fit: cover;
        border-radius: 6px;
    }

    .product h3 {
        margin: 12px 0;
        font-size: 17px;
    }

    .price {
        color: #d70018;
        font-weight: 700;
    }

    .empty {
        width: 100%;
        background: #fff;
        padding: 30px;
        border-radius: 8px;
    }

    @media (max-width: 992px) {
        .products {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .category-slider {
            width: calc(100% - 16px);
            margin-top: 12px;
            padding: 10px 44px;
            border-radius: 14px;
        }

        .category-scroll {
            gap: 8px;
        }

        .sub-category-item {
            flex-basis: 95px;
            width: 95px;
            min-width: 95px;
            min-height: 58px;
            padding: 7px;
        }

        .sub-category-item img {
            width: 32px;
            height: 32px;
        }

        .sub-category-item span {
            font-size: 12px;
        }

        .category-nav {
            width: 34px;
            height: 34px;
        }

        .category-prev {
            left: 5px;
        }

        .category-next {
            right: 5px;
        }

        .container {
            width: calc(100% - 16px);
            padding-top: 22px;
        }

        .products {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }
    }

    @media (max-width: 480px) {
        .products {
            grid-template-columns: 1fr;
        }
    }
    </style>
</head>

<body>

    @include('main.headermain')

    @if($subCategories->isNotEmpty())
    <div class="category-slider">

        <button type="button" class="category-nav category-prev" id="categoryPrev" aria-label="Danh mục trước">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <div class="category-scroll" id="categoryScroll">

            @foreach($subCategories as $subCategory)

            <a href="{{ route('categories.show', $subCategory->slug) }}" class="sub-category-item">

                @if($subCategory->icon)
                <img src="{{ asset('storage/' . $subCategory->icon) }}" alt="{{ $subCategory->name }}">
                @endif

                <span>{{ $subCategory->name }}</span>

            </a>

            @endforeach

        </div>

        <button type="button" class="category-nav category-next" id="categoryNext" aria-label="Danh mục tiếp theo">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

    </div>
    @endif

    <div class="container">

        <p class="breadcrumb">
            <a href="{{ url('/') }}">Trang chủ</a>

            @if($category->parent)
            /
            <a href="{{ route('categories.show', $category->parent->slug) }}">
                {{ $category->parent->name }}
            </a>
            @endif

            /

            {{ $category->name }}
        </p>

        @if($listings->count() > 0)

        <div class="products">

            @foreach($listings as $listing)

            <div class="product">

                @if($listing->primaryImage)
                <img src="{{ $listing->primaryImage->image_path }}" alt="{{ $listing->title }}" class="listing-image">
                @else
                <div class="listing-placeholder">
                    Không có ảnh
                </div>
                @endif

                <h3> <a href="{{ route('listings.show', $listing->slug) }}" class="listing-title">
                        {{ $listing->title }}
                    </a>
                </h3>
                <div class="price">
                    @if($listing->price !== null)
                    {{ number_format($listing->price, 0, ',', '.') }} đ
                    @else
                    Liên hệ
                    @endif
                </div>

                <p>{{ $listing->province }}</p>

            </div>

            @endforeach

        </div>

        <div style="margin-top: 30px;">
            {{ $listings->links() }}
        </div>

        @else

        <div class="empty">
            Chưa có sản phẩm nào trong danh mục này.
        </div>

        @endif

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const categoryScroll = document.getElementById('categoryScroll');
        const prevButton = document.getElementById('categoryPrev');
        const nextButton = document.getElementById('categoryNext');

        if (!categoryScroll || !prevButton || !nextButton) {
            return;
        }

        function getScrollAmount() {
            const firstItem = categoryScroll.querySelector('.sub-category-item');

            if (!firstItem) {
                return 360;
            }

            const styles = window.getComputedStyle(categoryScroll);
            const gap = parseFloat(styles.columnGap || styles.gap || 10);

            return (firstItem.offsetWidth + gap) * 3;
        }

        nextButton.addEventListener('click', function() {
            categoryScroll.scrollBy({
                left: getScrollAmount(),
                behavior: 'smooth'
            });
        });

        prevButton.addEventListener('click', function() {
            categoryScroll.scrollBy({
                left: -getScrollAmount(),
                behavior: 'smooth'
            });
        });

    });
    </script>

</body>

</html>