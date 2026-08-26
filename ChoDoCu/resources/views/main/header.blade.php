<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<style>
.header {
    width: 100%;
    height: 64px;

    display: flex;
    align-items: center;
    gap: 10px;

    padding: 8px 24px;

    background: #fff;
    border-bottom: 1px solid #eeeeee;

    position: fixed;
    top: 0;
    left: 0;

    z-index: 9999;
}

.logo {
    width: 110px;
    flex-shrink: 0;
}

.location {
    height: 44px;
    padding: 0 18px;

    border: none;
    border-radius: 24px;

    background: #f4f4f4;

    font-weight: 600;
    white-space: nowrap;
}

.search-box {
    height: 44px;

    flex: 1;

    display: flex;
    align-items: center;

    background: #f4f4f4;
    border-radius: 24px;

    overflow: hidden;
}

.search-input {
    flex: 1;
    height: 100%;

    display: flex;
    align-items: center;
    gap: 10px;

    padding: 0 16px;
}

.search-input input {
    width: 100%;
    border: none;
    outline: none;

    background: transparent;

    font-size: 15px;
}

.search-btn {
    width: 38px;
    height: 38px;

    margin-right: 3px;

    border: none;
    border-radius: 50%;

    background: #16a34a;
    color: white;

    cursor: pointer;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 7px;

    margin-left: 4px;
}

.icon-btn {
    width: 42px;
    height: 42px;

    border: none;
    border-radius: 50%;

    background: transparent;

    font-size: 19px;

    cursor: pointer;
}

.icon-btn:hover {
    background: #f4f4f4;
}

.contact-btn,
.manage-btn {
    height: 44px;

    padding: 0 18px;

    border: 1px solid #e5e5e5;
    border-radius: 24px;

    background: #fff;

    font-weight: 600;
    white-space: nowrap;
}

.post-btn {
    height: 44px;
    padding: 0 21px;
    border: none;
    border-radius: 24px;
    background: #16a34a;
    color: #fff;
    font-weight: 700;
    cursor: pointer;
}

.post-btn a {
    color: #fff;
    font-weight: 700;
    cursor: pointer;
    text-decoration: none;
}

.profile {
    height: 44px;

    display: flex;
    align-items: center;
    gap: 8px;

    padding: 4px 10px 4px 4px;

    border: 1px solid #e5e5e5;
    border-radius: 24px;

    background: white;
}

.profile img {
    width: 34px;
    height: 34px;

    object-fit: cover;
    border-radius: 50%;
}
</style>
<header class="header">


    <a href="{{ route('home') }}">
        <img src="/img/logo.png" class="logo" alt="Chợ Đồ Cũ">
    </a>

    <button class="location">
        <i class="fa-solid fa-location-dot"></i>
        Cần Thơ

    </button>

    <form class="search-box">

        <div class="search-input">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text" placeholder="Tìm sản phẩm">
        </div>

        <button class="search-btn">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

    </form>

    <div class="header-actions">

        <button class="icon-btn">
            <i class="fa-regular fa-heart"></i>
        </button>

        <button class="icon-btn">
            <i class="fa-regular fa-bell"></i>
        </button>

        <button class="contact-btn">
            <i class="fa-regular fa-comment"></i>
            Liên hệ
        </button>

        <button class="manage-btn">
            Quản lý tin
        </button>

        <button class="post-btn">
            <a href="{{  route('createnews')  }}" class="login-btn">
                Đăng tin
            </a>
        </button>

        @auth
        <button class="profile">
            <img src="/images/avatar.jpg" alt="Avatar">
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        @else
        <button class="post-btn">
            <a href="{{ route('login') }}" class="login-btn">
                Đăng nhập
            </a>
        </button>

        @endauth

    </div>

</header>