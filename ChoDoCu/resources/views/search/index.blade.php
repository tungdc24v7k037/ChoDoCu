<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">

    <title>Tìm kiếm - {{ $keyword }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
    html,
    body {
        margin: 0;
        min-height: 100%;
        background: #f5f5f5 !important;
    }

    .search-page {
        width: calc(100% - 30px);
        max-width: 1200px;

        margin: 28px auto 60px;
    }

    .search-result-box {
        width: 100%;

        background: #fff;

        padding: 24px;

        border-radius: 14px;

        box-sizing: border-box;
    }

    .search-result-header {
        margin-bottom: 22px;
    }

    .search-result-header h1 {
        margin: 0;

        color: #222;

        font-size: 21px;
        font-weight: 700;
    }

    .search-result-header h1 span {
        color: #16a34a;
    }

    .result-count {
        margin: 7px 0 0;

        color: #888;

        font-size: 13px;
    }


    /* PRODUCTS */

    .search-products {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 18px;
    }


    /* CARD */

    .search-product-card {
        display: block;

        min-width: 0;

        background: #fff;

        border: 1px solid #ececec;
        border-radius: 10px;

        overflow: hidden;

        color: #222;
        text-decoration: none !important;

        transition:
            box-shadow .2s ease,
            transform .2s ease;
    }

    .search-product-card:hover {
        transform: translateY(-2px);

        box-shadow:
            0 6px 18px rgba(0, 0, 0, .08);
    }


    /* IMAGE */

    .search-product-image {
        width: 100%;
        aspect-ratio: 1 / 1;

        background: #f2f2f2;

        overflow: hidden;
    }

    .search-product-image img {
        width: 100%;
        height: 100%;

        display: block;

        object-fit: cover;
    }


    /* INFO */

    .search-product-info {
        padding: 11px 12px 13px;
    }

    .search-product-title {
        min-height: 40px;

        color: #222;

        font-size: 14px;
        line-height: 1.4;

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;

        overflow: hidden;
    }

    .search-product-price {
        margin-top: 6px;

        color: #ff1f2d;

        font-size: 15px;
        font-weight: 700;
    }

    .search-product-location {
        margin-top: 10px;

        color: #999;

        font-size: 12px;
    }

    .search-product-location i {
        margin-right: 3px;
    }


    /* EMPTY */

    .search-empty {
        padding: 70px 20px;

        text-align: center;
    }

    .search-empty i {
        margin-bottom: 15px;

        color: #bbb;

        font-size: 40px;
    }

    .search-empty h2 {
        margin: 0 0 8px;
    }

    .search-empty p {
        margin: 0;
        color: #888;
    }


    /* RESPONSIVE */

    @media (max-width: 1000px) {

        .search-products {
            grid-template-columns:
                repeat(3, minmax(0, 1fr));
        }

    }

    @media (max-width: 700px) {

        .search-products {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

    }

    @media (max-width: 450px) {

        .search-products {
            grid-template-columns: 1fr;
        }

    }
    </style>
</head>

<body>

    @include('main.header')

    <main class="search-page">

        <section class="search-result-box">

            <div class="search-result-header">

                <div>
                    <h1>
                        Kết quả tìm kiếm cho:
                        <span>"{{ $keyword }}"</span>
                    </h1>

                    <p class="result-count">
                        Tìm thấy {{ $listings->total() }} sản phẩm
                    </p>
                </div>

            </div>


            @if($listings->count() > 0)

            <div class="search-products">

                @foreach($listings as $listing)

                <a href="{{ route('listings.show', $listing->slug) }}" class="search-product-card">

                    <div class="search-product-image">

                        @if($listing->primaryImage)

                        <img src="{{ $listing->primaryImage->image_path }}" alt="{{ $listing->title }}">

                        @else

                        <div class="no-image">
                            Không có ảnh
                        </div>

                        @endif

                    </div>


                    <div class="search-product-info">

                        <div class="search-product-title">
                            {{ $listing->title }}
                        </div>

                        <div class="search-product-price">
                            {{ number_format($listing->price, 0, ',', '.') }} đ
                        </div>

                        <div class="search-product-location">

                            <i class="fa-solid fa-location-dot"></i>

                            @if($listing->district)
                            {{ $listing->district }}
                            @endif

                            @if($listing->district && $listing->province)
                            •
                            @endif

                            @if($listing->province)
                            {{ $listing->province }}
                            @endif

                        </div>

                    </div>

                </a>

                @endforeach

            </div>


            @if($listings->hasPages())
            <div class="search-pagination">
                {{ $listings->links() }}
            </div>
            @endif

            @else

            <div class="search-empty">

                <i class="fa-solid fa-magnifying-glass"></i>

                <h2>Không tìm thấy sản phẩm</h2>

                <p>
                    Hãy thử tìm bằng từ khóa khác.
                </p>

            </div>

            @endif

        </section>

    </main>

</body>

</html>