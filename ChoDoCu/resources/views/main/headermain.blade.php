   <div class="hero">

       <div class="navbar">

           <div class="left">
               <div class="header-logo">
                   <a href="{{ route('home') }}">
                       <img src="{{ asset('img/logo.png') }}" alt="Chợ Đồ Cũ">
                   </a>
               </div>
               @auth
               @php
               $unreadMessages = \App\Models\Message::where('is_read', 0)
               ->where('sender_id', '!=', auth()->id())
               ->whereHas('conversation', function ($query) {
               $query->where('buyer_id', auth()->id())
               ->orWhere('seller_id', auth()->id());
               })
               ->count();
               @endphp

               <a href="{{ route('chat.index') }}" class="contact-btn">
                   <i class="fa-regular fa-comment"></i>
                   Liên hệ

                   <span id="messageBadge" class="message-badge" style="display:none;"></span>
               </a>
               @else

               <a href="{{ route('login') }}" class="contact-btn">
                   <i class="fa-regular fa-comment"></i>
                   <span>Liên hệ</span>
               </a>

               @endauth
               <!-- <button class="login" onclick="window.location.href='{{ route('chat.index') }}'">
                   Liên hệ
               </button> -->
           </div>

           <div class="right">

               <div class="icon">♡</div>
               <div class="icon">🔔</div>

               @auth
               <div class="user-profile">

                   {{-- Avatar --}}
                   <a href="{{ route('profile') }}" class="user-avatar">
                       @if(Auth::user()->avatar)
                       <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                       @else
                       <span>
                           {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                       </span>
                       @endif
                   </a>

                   {{-- Tên user --}}
                   <a href="{{ route('profile') }}" class="user-name">
                       {{ Auth::user()->name }}
                   </a>

                   {{-- Đăng xuất --}}
                   <form action="{{ route('logout') }}" method="POST">
                       @csrf

                       <button type="submit" class="logout-btn">
                           <i class="fa-solid fa-right-from-bracket"></i>
                       </button>
                   </form>

               </div>
               @else

               <button class="login" onclick="window.location='{{ route('login') }}'">
                   Đăng nhập
               </button>

               @endauth

               <button type="button" class="post" onclick="window.location.href='{{ route('createnews') }}'">
                   Đăng tin
               </button>

           </div>
       </div>

       <div class="title">
           Giá tốt • Gần bạn • Mua bán nhanh
       </div>
   </div>
   <div class="search-box">

       <div class="search-input">
           🔍
           <form action="{{ route('search') }}" method="GET" class="search-form">

               <input type="text" name="q" value="{{ request('q') }}" placeholder="Tìm sản phẩm..." autocomplete="off">
       </div>

       <div class="location">
           📍 Cần Thơ
       </div>

       <button class="search-btn">
           Tìm kiếm
       </button>
       </form>
   </div>
   @auth
   <script>
document.addEventListener('DOMContentLoaded', function() {

    const badge = document.getElementById('messageBadge');

    if (!badge) return;

    async function refreshUnreadCount() {
        try {
            const response = await fetch(
                "{{ route('chat.unreadCount') }}", {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    cache: 'no-store'
                }
            );

            if (!response.ok) return;

            const data = await response.json();

            const count = Number(data.count || 0);

            if (count > 0) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.style.display = 'flex';
            } else {
                badge.textContent = '';
                badge.style.display = 'none';
            }

        } catch (error) {
            console.error('Lỗi cập nhật tin nhắn:', error);
        }
    }

    // chạy ngay
    refreshUnreadCount();

    // tự cập nhật mỗi 3 giây
    setInterval(refreshUnreadCount, 3000);

});
   </script>
   @endauth