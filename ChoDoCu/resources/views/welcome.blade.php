<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Header</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    @include('main.headermain')



    <div class="category-slider">
        <div class="category-scroll" id="categoryScroll">
            @foreach ($categories as $item)
            <a href="{{ route('categories.show', $item->slug) }}" class="category-item">
                @if (!empty($item->image))
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                @endif

                <span>{{ $item->name }}</span>
            </a>
            @endforeach
        </div>

    </div>
    <div class="page">
        <section class="listing-section">
            <div class="listing-container">

                <div class="listing-tabs">
                    <button class="listing-tab active" type="button">
                        Dành cho bạn
                    </button>


                </div>

                @if ($listings->count() > 0)
                <div class="listing-grid">

                    @foreach ($listings as $listing)
                    <article class="listing-card">

                        <a href="#" class="listing-image-wrapper">

                            @if ($listing->primaryImage)
                            <img src="{{ $listing->primaryImage->image_path }}" alt="{{ $listing->title }}"
                                class="listing-image">
                            @else
                            <div class="listing-placeholder">
                                Không có ảnh
                            </div>
                            @endif

                            <button type="button" class="favorite-button" onclick="event.preventDefault();"
                                aria-label="Yêu thích">
                                ♡
                            </button>

                            <span class="listing-time">
                                {{ $listing->created_at->diffForHumans() }}
                            </span>
                        </a>

                        <div class="listing-content">

                            <a href="{{ route('listings.show', $listing->slug) }}" class="listing-title">
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

                                <button type="button" class="listing-more" aria-label="Tùy chọn">
                                    ⋮
                                </button>
                            </div>

                        </div>
                    </article>
                    @endforeach

                </div>

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