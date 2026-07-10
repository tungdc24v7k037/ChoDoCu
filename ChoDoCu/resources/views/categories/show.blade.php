<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $category->name }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 30px;
        }

        .container {
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

<div class="container">

    <p>
        <a href="{{ url('/') }}">Trang chủ</a>
        /
        {{ $category->name }}
    </p>

    <h1>{{ $category->name }}</h1>

    @if($listings->count() > 0)

        <div class="products">

            @foreach($listings as $listing)

                <div class="product">

                    @if($listing->primaryImage)
                        <img
                            src="{{ asset('storage/' . $listing->primaryImage->image_path) }}"
                            alt="{{ $listing->title }}"
                        >
                    @else
                        <img
                            src="https://via.placeholder.com/300x200?text=Khong+co+anh"
                            alt="Không có ảnh"
                        >
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