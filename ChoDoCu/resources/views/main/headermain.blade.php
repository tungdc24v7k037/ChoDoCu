   <div class="hero">

       <div class="navbar">

           <div class="left">
               <div class="header-logo">
                   <a href="{{ route('home') }}">
                       <img src="{{ asset('img/logo.png') }}" alt="Chợ Đồ Cũ">
                   </a>
               </div>

               <div class="menu">
                   <a href="#">Liên hệ</a>
               </div>
           </div>

           <div class="right">
               <div class="icon">♡</div>
               <div class="icon">🔔</div>

               <button class="login" onclick="window.location='{{ route('login') }}'">
                   Đăng nhập
               </button>
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