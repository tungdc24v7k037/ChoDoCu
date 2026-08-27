<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Header</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    @include('main.headermain')
    <div class="product-detail">

        <div class="product-gallery">
            <div class="main-image">
                <img src="{{ $listing->primaryImage->image_path ?? asset('img/no-image.png') }}"
                    alt="{{ $listing->title }}">

                <button class="nav prev">‹</button>
                <button class="nav next">›</button>
            </div>

            <div class="thumbnail-list">
                @foreach($listing->images as $image)
                <img src="{{ $image->image_path }}" alt="" class="thumbnail">
                @endforeach
            </div>
        </div>

        <div class="product-info">

            <div class="product-heading">
                <div>
                    <h1>{{ $listing->title }}</h1>

                    <p class="meta">
                        {{ $listing->category->name ?? '' }}
                        • {{ $listing->condition ?? 'Đã qua sử dụng' }}
                    </p>
                </div>

                <button class="save-btn">
                    ♡ Lưu
                </button>
            </div>

            <div class="price">
                {{ number_format($listing->price, 0, ',', '.') }} đ
            </div>

            <div class="address">
                <i class="fa-solid fa-location-dot"></i>

                <div>
                    <div>
                        {{ $listing->address }}
                    </div>

                    <small>
                        {{ $listing->ward }},
                        {{ $listing->district }},
                        {{ $listing->province }}
                    </small>
                </div>
            </div>

            <div class="updated">
                <i class="fa-regular fa-clock"></i>
                Cập nhật {{ $listing->updated_at->diffForHumans() }}
            </div>

            <div class="market-price">
                <strong>Khoảng giá thị trường</strong>

                <div class="price-line">
                    <span></span>
                </div>

                <div class="market-values">
                    <span>12.38 tr</span>
                    <span>15.13 tr</span>
                    <span>17.5 tr</span>
                </div>
            </div>

            <div class="action-row">
                <button class="phone-btn">
                    Hiện số {{ substr($listing->phone, 0, 5) }}****
                </button>

                @auth
                <button class="chat-btn" onclick="window.location.href='{{ route('chat.index') }}'">
                    <i class="fa-regular fa-comment"></i>
                    Chat
                </button>
                @else
                <button class="chat-btn" onclick="window.location.href='{{ route('login') }}'">
                    <i class="fa-regular fa-comment"></i>
                    Đăng nhập để Chat
                </button>
                @endauth
            </div>

            <div class="seller-card">
                <div class="seller-left">
                    <img src="{{ asset('img/avatar-default.png') }}" class="seller-avatar">

                    <div>
                        <strong>{{ $listing->user->name ?? 'Người bán' }}</strong>
                        <div class="seller-status">● Đang hoạt động</div>
                    </div>
                </div>

                <a href="#" class="seller-page">
                    Xem trang
                </a>
            </div>

            <div class="message-box">
                <input type="text" placeholder="Đăng nhập để gửi tin nhắn">

                <button>Gửi</button>
            </div>

            <div class="policy">
                <i class="fa-solid fa-circle-info"></i>
                Chính sách của cửa hàng
            </div>

            <div class="offer">
                <strong>Deal giá</strong>

                <div class="offer-row">
                    <input type="number" placeholder="Nhập giá bạn mong muốn">

                    <button>Trả giá</button>
                </div>

                <small>
                    Giá gốc:
                    {{ number_format($listing->price, 0, ',', '.') }} đ
                </small>
            </div>

        </div>

    </div>
    <div class="detail_product">
        @include('main.introduce')
    </div>
    <section class="similar-section">

        <h2>Tin đăng tương tự</h2>

        <div class="similar-list">

            @forelse($similarListings as $item)

            <article class="similar-card">

                <a href="{{ route('listings.show', $item->slug) }}">

                    @if($item->primaryImage)
                    <img src="{{ $item->primaryImage->image_path }}" alt="{{ $item->title }}" class="similar-image">
                    @else
                    <div class="no-image">
                        Không có ảnh
                    </div>
                    @endif

                    <h3>
                        {{ $item->title }}
                    </h3>

                </a>

                <p class="similar-category">
                    {{ $item->category->name ?? '' }}
                </p>

                <div class="similar-price">
                    {{ number_format($item->price, 0, ',', '.') }} đ
                </div>

                <div class="similar-location">
                    <i class="fa-solid fa-location-dot"></i>

                    {{ $item->district }}

                    @if($item->province)
                    • {{ $item->province }}
                    @endif
                </div>

            </article>

            @empty

            <p>Chưa có tin đăng tương tự.</p>

            @endforelse

        </div>

    </section>
    @include('main.footer')
</body>

</html>