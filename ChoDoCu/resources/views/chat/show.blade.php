<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        height: 100vh;
        display: grid;
        grid-template-columns: 380px 1fr;
    }

    /* SIDEBAR */

    .chat-sidebar {
        background: #fff;
        border-right: 1px solid #e5e5e5;
        overflow-y: auto;
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
        border-radius: 10px;
        padding: 12px;
    }

    .search-box input {
        width: 100%;
        border: 0;
        outline: none;
    }

    .filters {
        display: flex;
        gap: 8px;

        padding: 15px 20px;
        border-bottom: 1px solid #eee;
    }

    .filters button {
        background: #fff;
        border: 1px solid #ddd;

        padding: 7px 12px;
        border-radius: 20px;
        cursor: pointer;
    }

    .conversation-item {
        display: flex;
        gap: 12px;

        padding: 14px 18px;

        color: #111;
        text-decoration: none;

        border-bottom: 1px solid #f2f2f2;
    }

    .conversation-item:hover,
    .conversation-item.active {
        background: #f3f3f3;
    }

    .conversation-avatar {
        width: 50px;
        height: 50px;

        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .conversation-info {
        min-width: 0;
        flex: 1;
    }

    .conversation-info strong {
        display: block;
        margin-bottom: 5px;
    }

    .conversation-info p {
        margin: 0;

        color: #777;
        font-size: 13px;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* MAIN CHAT */

    .chat-main {
        background: #fff;

        display: flex;
        flex-direction: column;

        min-width: 0;
    }

    .chat-topbar {
        height: 72px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 22px;
        border-bottom: 1px solid #eee;
    }

    .chat-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-user img {
        width: 44px;
        height: 44px;

        border-radius: 50%;
        object-fit: cover;
    }

    .chat-user-name {
        font-weight: 700;
    }

    .online {
        margin-top: 3px;
        font-size: 12px;
        color: #16a34a;
    }

    /* PRODUCT INFO */

    .chat-product {
        display: flex;
        align-items: center;
        gap: 12px;

        padding: 12px 20px;

        background: #fafafa;
        border-bottom: 1px solid #eee;
    }

    .chat-product img {
        width: 60px;
        height: 60px;

        object-fit: cover;
        border-radius: 8px;
    }

    .product-title {
        font-weight: 600;
    }

    .product-price {
        margin-top: 5px;
        color: #f5223b;
        font-weight: 700;
    }

    /* MESSAGE AREA */

    .messages {
        flex: 1;

        padding: 24px;

        overflow-y: auto;
        background: #f7f7f7;
    }

    .message-row {
        display: flex;
        margin-bottom: 12px;
    }

    .message-row.mine {
        justify-content: flex-end;
    }

    .message-row.theirs {
        justify-content: flex-start;
    }

    .bubble {
        max-width: 65%;

        padding: 10px 14px;
        border-radius: 16px;

        line-height: 1.4;
        word-break: break-word;
    }

    .mine .bubble {
        background: #ffd400;
        color: #111;

        border-bottom-right-radius: 4px;
    }

    .theirs .bubble {
        background: #fff;
        border: 1px solid #ddd;

        border-bottom-left-radius: 4px;
    }

    .message-time {
        margin-top: 5px;
        font-size: 11px;
        color: #999;
    }

    /* INPUT */

    .message-form {
        display: flex;
        align-items: center;
        gap: 10px;

        padding: 14px 18px;

        border-top: 1px solid #eee;
        background: #fff;
    }

    .message-form textarea {
        flex: 1;

        height: 48px;
        max-height: 120px;

        resize: none;

        border: 1px solid #ddd;
        border-radius: 24px;

        padding: 13px 18px;
        outline: none;

        font-family: inherit;
    }

    .message-form button {
        width: 48px;
        height: 48px;

        border: 0;
        border-radius: 50%;

        background: #ffd400;
        cursor: pointer;

        font-size: 18px;
    }

    @media (max-width: 800px) {
        .chat-layout {
            grid-template-columns: 1fr;
        }

        .chat-sidebar {
            display: none;
        }
    }
    </style>
</head>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const messages = document.getElementById('messages');

    if (!messageForm) {
        console.log('Không tìm thấy messageForm');
        return;
    }

    messageForm.addEventListener('submit', async function(e) {

        // QUAN TRỌNG: không cho form chuyển trang
        e.preventDefault();

        const text = messageInput.value.trim();

        if (!text) {
            return;
        }

        const csrfToken = messageForm.querySelector(
            'input[name="_token"]'
        ).value;

        try {

            const response = await fetch(messageForm.action, {
                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({
                    message: text
                })
            });

            const data = await response.json();

            if (!response.ok) {
                console.error(data);
                return;
            }

            // Thêm tin vừa gửi vào giao diện
            const messageRow = document.createElement('div');
            messageRow.className = 'message-row mine';

            const bubble = document.createElement('div');
            bubble.className = 'bubble';

            const messageText = document.createElement('div');
            messageText.textContent = data.message.text;

            const messageTime = document.createElement('div');
            messageTime.className = 'message-time';
            messageTime.textContent = data.message.time;

            bubble.appendChild(messageText);
            bubble.appendChild(messageTime);

            messageRow.appendChild(bubble);

            if (messages) {
                messages.appendChild(messageRow);
                messages.scrollTop = messages.scrollHeight;
            }

            // Xóa nội dung input
            messageInput.value = '';
            messageInput.focus();

        } catch (error) {
            console.error('Lỗi gửi tin nhắn:', error);
        }

    });

});
</script>

<body>

    @php
    $otherUser =
    $conversation->buyer_id === auth()->id()
    ? $conversation->seller
    : $conversation->buyer;
    @endphp

    <div class="chat-layout">

        {{-- SIDEBAR --}}
        <aside class="chat-sidebar">

            <div class="chat-header">
                <h2>Chat</h2>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="text" placeholder="Tìm cuộc trò chuyện...">
                </div>
            </div>

            <div class="filters">
                <button>Tất cả</button>
                <button>Chưa đọc</button>
                <button>Tin rác / Bỏ qua</button>
            </div>

            @foreach($conversations as $item)

            @php
            $person =
            $item->buyer_id === auth()->id()
            ? $item->seller
            : $item->buyer;
            @endphp

            <a href="{{ route('chat.show', $item) }}" class="conversation-item
                {{ $item->id === $conversation->id ? 'active' : '' }}">

                <img src="{{ $item->listing->primaryImage->image_path ?? asset('img/avatar-default.png') }}"
                    class="conversation-avatar" alt="">

                <div class="conversation-info">

                    <strong>
                        {{ $person->name ?? 'Người dùng' }}
                    </strong>

                    <p>
                        {{ $item->lastMessage?->message ?? $item->listing->title }}
                    </p>

                </div>

            </a>

            @endforeach

        </aside>


        {{-- MAIN CHAT --}}
        <main class="chat-main">

            <div class="chat-topbar">

                <div class="chat-user">

                    <img src="{{ asset('img/avatar-default.png') }}" alt="">

                    <div>
                        <div class="chat-user-name">
                            {{ $otherUser->name ?? 'Người dùng' }}
                        </div>

                        <div class="online">
                            ● Đang hoạt động
                        </div>
                    </div>

                </div>

                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>
                </a>

            </div>


            {{-- SẢN PHẨM ĐANG CHAT --}}
            <div class="chat-product">

                @if($conversation->listing->primaryImage)
                <img src="{{ $conversation->listing->primaryImage->image_path }}"
                    alt="{{ $conversation->listing->title }}">
                @endif

                <div>
                    <div class="product-title">
                        {{ $conversation->listing->title }}
                    </div>

                    <div class="product-price">
                        {{ number_format(
                        $conversation->listing->price,
                        0,
                        ',',
                        '.'
                    ) }} đ
                    </div>
                </div>

            </div>


            {{-- MESSAGE LIST --}}
            <div class="messages" id="messages">

                @foreach($conversation->messages as $message)

                <div class="message-row
            {{ $message->sender_id === auth()->id()
                ? 'mine'
                : 'theirs' }}
        ">

                    <div class="bubble">

                        {{ $message->message }}

                        <div class="message-time">
                            {{ $message->created_at->format('H:i') }}
                        </div>

                    </div>

                </div>

                @endforeach

            </div>

            <form id="messageForm" action="{{ route('chat.send', $conversation) }}" method="POST" class="message-form">
                @csrf

                <textarea id="messageInput" name="message" placeholder="Nhập tin nhắn..." required></textarea>

                <button type="submit">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

        </main>

    </div>


    <script>
    const messages = document.getElementById('messages');

    if (messages) {
        messages.scrollTop = messages.scrollHeight;
    }
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const messages = document.getElementById('messages');

    messageForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const text = messageInput.value.trim();

        if (!text) return;

        const token = messageForm.querySelector(
            'input[name="_token"]'
        ).value;

        try {

            const response = await fetch(messageForm.action, {
                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({
                    message: text
                })
            });

            const data = await response.json();

            if (!response.ok) {
                return;
            }

            const row = document.createElement('div');
            row.className = 'message-row mine';

            const bubble = document.createElement('div');
            bubble.className = 'bubble';

            bubble.innerHTML = `
            ${escapeHtml(data.message.text)}
            <div class="message-time">
                ${data.message.time}
            </div>
        `;

            row.appendChild(bubble);
            messages.appendChild(row);

            messageInput.value = '';

            messages.scrollTop = messages.scrollHeight;

        } catch (error) {
            console.error(error);
        }
    });

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    messages.scrollTop = messages.scrollHeight;
    </script>

</body>

</html>