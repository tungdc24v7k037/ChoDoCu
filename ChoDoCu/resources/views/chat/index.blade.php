<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chat</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f5f5f5;
    }

    .chat-layout {
        height: calc(100vh - 10px);
        display: grid;
        grid-template-columns: 325px 1fr;
        margin-top: 20px;

    }

    .chat-sidebar {
        background: #fff;
        border-right: 1px solid #eee;
    }

    .chat-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }

    .chat-header h2 {
        margin: 0 0 15px;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 10px;

        border: 1px solid #ddd;
        border-radius: 12px;

        padding: 12px;
    }

    .search-box input {
        flex: 1;
        border: 0;
        outline: 0;
    }

    .search-btn {
        width: 38px;
        height: 38px;
        margin-right: -10px !important;
        border: none;
        border-radius: 50%;
        background: #16a34a;
        color: white;
        cursor: pointer;
    }

    .filters {
        padding: 15px 20px;

        display: flex;
        gap: 10px;
    }

    .filters button {
        border: 1px solid #ddd;
        background: #fff;

        padding: 8px 14px;
        border-radius: 20px;
    }

    .conversation-item {
        display: flex;
        gap: 12px;

        padding: 15px 20px;

        color: #111;
        text-decoration: none;

        border-top: 1px solid #f2f2f2;
    }

    .conversation-item:hover {
        background: #f7f7f7;
    }

    .conversation-avatar {
        width: 50px;
        height: 50px;

        border-radius: 50%;
        object-fit: cover;
    }

    .conversation-info {
        flex: 1;
        min-width: 0;
    }

    .conversation-info strong {
        display: block;
    }

    .conversation-info p {
        margin: 6px 0 0;

        color: #777;
        font-size: 14px;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .chat-empty {
        display: flex;
        flex-direction: column;

        align-items: center;
        justify-content: center;

        text-align: center;
    }

    .chat-empty i {
        font-size: 70px;
        color: #16a34a;
    }

    .chat-empty h3 {
        margin-bottom: 5px;
    }

    .chat-empty p {
        color: #777;
    }

    .home-btn {
        margin-top: 15px;

        padding: 10px 20px;

        background: #16a34a;
        color: #111;

        border-radius: 8px;
        text-decoration: none;

        font-weight: 600;
    }
    </style>
    <meta name="twitter:image"
        content="https://preview.colorlib.com/theme/login-forms/assets/screenshots/gradient-wave.png">

</head>

<body>
    @include('main.header')
    <div class="chat-layout">

        <aside class="chat-sidebar">

            <div class="chat-header">

                <h2>Chat</h2>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="text" placeholder="Nhập 3 ký tự để bắt đầu tìm kiếm">
                </div>

            </div>

            <div class="filters">
                <button>Tất cả</button>
                <button>Chưa đọc</button>
                <button>Tin rác / Bỏ qua</button>
            </div>


            @foreach($conversations as $conversation)

            @php
            $otherUser =
            $conversation->buyer_id === auth()->id()
            ? $conversation->seller
            : $conversation->buyer;
            @endphp

            <a href="{{ route('chat.show', $conversation) }}" class="conversation-item">

                <img src="{{ $conversation->listing->primaryImage->image_path ?? asset('img/avatar-default.png') }}"
                    class="conversation-avatar" alt="">

                <div class="conversation-info">

                    <strong>
                        {{ $otherUser->name }}
                    </strong>

                    <p>
                        {{ $conversation->lastMessage?->message ?? $conversation->listing->title }}
                    </p>

                </div>

            </a>

            @endforeach

        </aside>


        <main class="chat-empty">

            <i class="fa-regular fa-comments"></i>

            <h3>
                Bạn chưa có cuộc trò chuyện nào!
            </h3>

            <p>
                Trải nghiệm chat để làm rõ thông tin về mặt hàng
                trước khi bắt đầu mua bán.
            </p>

            <a href="{{ route('home') }}" class="home-btn">
                Về trang chủ
            </a>

        </main>

    </div>

</body>

</html>