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

                   <span>Liên hệ</span>

                   @if($unreadMessages > 0)
                   <span class="message-badge">
                       {{ $unreadMessages > 99 ? '99+' : $unreadMessages }}
                   </span>
                   @endif

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
           <input type="text" placeholder="Tìm sản phẩm...">
       </div>

       <div class="location">
           📍 Cần Thơ
       </div>

       <button class="search-btn">
           Tìm kiếm
       </button>

   </div>