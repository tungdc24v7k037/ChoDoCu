   <div class="hero">

       <div class="navbar">

           <div class="left">
               <div class="header-logo">
                   <a href="{{ route('home') }}">
                       <img src="{{ asset('img/logo.png') }}" alt="Chợ Đồ Cũ">
                   </a>
               </div>

               <button class="login" onclick="window.location.href='{{ route('chat.index') }}'">
                   Liên hệ
               </button>
           </div>

           <div class="right">
               <div class="icon">♡</div>
               <div class="icon">🔔</div>

               @auth
               <div class="user-profile">
                   <div class="user-avatar">
                       {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                   </div>

                   <span class="user-name">
                       <a href="{{ route('profile') }}">
                           {{ Auth::user()->name }}
                       </a>
                   </span>

                   <form action="{{ route('logout') }}" method="POST">
                       @csrf

                       <button type="submit" class="logout-btn">
                           <i class="fa-solid fa-right-from-bracket"></i>
                           Đăng xuất
                       </button>
                   </form>
               </div>
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