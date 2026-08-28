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

            <div class="gallery-main">

                <div class="gallery-track" id="galleryTrack">
                    @foreach($listing->images as $image)
                    <div class="gallery-slide">
                        <img src="{{ $image->image_path }}" alt="{{ $listing->title }}">
                    </div>
                    @endforeach
                </div>

                @if($listing->images->count() > 1)
                <button type="button" class="gallery-arrow gallery-prev" id="galleryPrev">
                    &#10094;
                </button>

                <button type="button" class="gallery-arrow gallery-next" id="galleryNext">
                    &#10095;
                </button>
                @endif

            </div>


            @if($listing->images->count() > 1)
            <div class="gallery-thumbnails">

                @foreach($listing->images as $index => $image)

                <button type="button" class="gallery-thumb {{ $index === 0 ? 'active' : '' }}"
                    data-index="{{ $index }}">
                    <img src="{{ $image->image_path }}" alt="Ảnh {{ $index + 1 }}">
                </button>

                @endforeach

            </div>
            @endif

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
                @if(auth()->id() != $listing->user_id)

                <form action="{{ route('chat.start', $listing->id) }}" method="POST">
                    @csrf

                    <button type="submit" class="chat-btn">
                        <i class="fa-regular fa-comment"></i>
                        Chat
                    </button>
                </form>

                @endif
                @else

                <button class="chat-btn" onclick="window.location.href='{{ route('login') }}'">
                    <i class="fa-regular fa-comment"></i>
                    Đăng nhập để Chat
                </button>

                @endauth
            </div>

            <div class="seller-card">
                <div class="seller-left">
                    @if($listing->user && $listing->user->avatar)
                    <img src="{{ $listing->user->avatar }}" alt="{{ $listing->user->name }}" class="seller-avatar">
                    @else
                    <div class="seller-avatar seller-avatar-default">
                        {{ strtoupper(substr($listing->user->name ?? 'N', 0, 1)) }}
                    </div>
                    @endif

                    <div>
                        <strong>{{ $listing->user->name ?? 'Người bán' }}</strong>
                        <div class="seller-status">● Đang hoạt động</div>
                    </div>
                </div>

                @if($listing->user)
                <a href="{{ route('profile.show', $listing->user->id) }}" class="seller-page">
                    Xem trang
                </a>
                @endif
            </div>


            <!-- <div class="policy">
                <i class="fa-solid fa-circle-info"></i>
                Chính sách của cửa hàng
            </div> -->

            <!-- <div class="offer">
                <strong>Deal giá</strong>

                <div class="offer-row">
                    <input type="number" placeholder="Nhập giá bạn mong muốn">

                    <button>Trả giá</button>
                </div>

                <small>
                    Giá gốc:
                    {{ number_format($listing->price, 0, ',', '.') }} đ
                </small>
            </div> -->

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
<script>
document.addEventListener('DOMContentLoaded', function() {

    const track = document.getElementById('galleryTrack');

    if (!track) {
        return;
    }

    const slides = track.querySelectorAll('.gallery-slide');

    const prevButton = document.getElementById('galleryPrev');
    const nextButton = document.getElementById('galleryNext');

    const thumbnails =
        document.querySelectorAll('.gallery-thumb');

    let currentIndex = 0;


    function showSlide(index) {

        if (index < 0) {
            index = slides.length - 1;
        }

        if (index >= slides.length) {
            index = 0;
        }

        currentIndex = index;

        // Lướt ảnh
        track.style.transform =
            `translateX(-${currentIndex * 100}%)`;


        // Active thumbnail
        thumbnails.forEach(function(thumb) {
            thumb.classList.remove('active');
        });

        if (thumbnails[currentIndex]) {

            thumbnails[currentIndex]
                .classList.add('active');

            // thumbnail tự chạy theo
            thumbnails[currentIndex]
                .scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
        }
    }


    // Nút qua trái
    if (prevButton) {

        prevButton.addEventListener('click', function() {

            showSlide(currentIndex - 1);

        });
    }


    // Nút qua phải
    if (nextButton) {

        nextButton.addEventListener('click', function() {

            showSlide(currentIndex + 1);

        });
    }


    // Click thumbnail
    thumbnails.forEach(function(thumb) {

        thumb.addEventListener('click', function() {

            const index =
                parseInt(this.dataset.index);

            showSlide(index);

        });

    });

});
</script>

</html>