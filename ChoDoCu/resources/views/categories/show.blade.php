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
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
    }

    .container {
        padding-top: 80px;
        max-width: 1200px;
        margin: auto;
    }

    .products {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .product {
        background: white;
        padding: 15px;
        border-radius: 8px;
        text-decoration: none;
        color: #222;
    }

    .product img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 6px;
    }

    .product h3 {
        font-size: 17px;
        margin: 12px 0;
    }

    .price {
        color: #d70018;
        font-weight: bold;
    }

    .empty {
        background: white;
        padding: 30px;
        border-radius: 8px;
    }
    </style>
</head>

<body>
    @include('main.headermain')
    <div class="category-slider">

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


    </div>
    <div class="container">

        <p>
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

                @if ($listing->primaryImage)
                <img src="{{ $listing->primaryImage->image_path }}" alt="{{ $listing->title }}" class="listing-image">
                @else
                <div class="listing-placeholder">
                    Không có ảnh
                </div>
                @endif

                <h3>{{ $listing->title }}</h3>

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

</body>

</html>