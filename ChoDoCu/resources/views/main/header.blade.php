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

.contact-btn a {
    text-decoration: none;
    color: black;
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

.profile-dropdown {
    position: relative;
}

.profile-trigger {
    height: 44px;

    display: flex;
    align-items: center;
    gap: 8px;

    padding: 5px 12px 5px 6px;

    border: none;
    border-radius: 25px;

    background: #fff;
    cursor: pointer;
}

.profile-avatar {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #16a34a;
    color: #fff;

    font-size: 14px;
    font-weight: 700;
}

.profile-name {
    max-width: 110px;

    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;

    font-size: 14px;
    font-weight: 600;
    color: #222;
}

.profile-arrow {
    font-size: 11px;
    color: #777;
    transition: .2s;
}


/* MENU XỔ XUỐNG */

.profile-menu {
    position: absolute;

    top: calc(100% + 10px);
    right: 0;

    width: 210px;

    padding: 8px;

    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;

    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);

    display: none;

    z-index: 9999;
}

.profile-menu.show {
    display: block;
}

.profile-menu-item {
    width: 100%;

    display: flex;
    align-items: center;
    gap: 10px;

    padding: 11px 12px;

    border: none;
    border-radius: 8px;

    background: transparent;

    color: #222;
    text-decoration: none;
    font-size: 14px;

    cursor: pointer;
}

.profile-menu-item i {
    width: 18px;
    text-align: center;
}

.profile-menu-item:hover {
    background: #f5f5f5;
}

.profile-menu-divider {
    height: 1px;
    margin: 6px 4px;
    background: #eee;
}

.profile-menu form {
    margin: 0;
}

.logout-item {
    color: #e53935;
}


/* Khi mở menu */

.profile-dropdown.open .profile-arrow {
    transform: rotate(180deg);
}

.profile-avatar-header2 {
    width: 34px;
    height: 34px;
    flex: 0 0 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;
    overflow: hidden;

    background: #16a34a;
    color: #fff;

    font-size: 14px;
    font-weight: 700;
}

.profile-avatar-header2 img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.profile-avatar-header2 span {
    color: #fff;
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
            <a href="{{ route('chat.index') }}">
                <i class="fa-regular fa-comment"></i>
                Liên hệ
            </a>
        </button>


        <button class="contact-btn">
            <a href="{{ route('listings.manage') }}">
                <i class="fa-regular fa-rectangle-list"></i>
                Quản lý tin
            </a>
        </button>

        @auth
        <div class="profile-dropdown">

            <button type="button" class="profile-trigger" id="profileTrigger">

                <div class="profile-avatar-header2">
                    @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                    @else
                    <span>
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    @endif
                </div>

                <span class="profile-name">
                    {{ Auth::user()->name }}
                </span>

                <i class="fa-solid fa-chevron-down profile-arrow"></i>

            </button>

            <div class="profile-menu" id="profileMenu">

                <a href="{{ route('profile') }}" class="profile-menu-item">
                    <i class="fa-regular fa-user"></i>
                    Hồ sơ cá nhân
                </a>

                <a href="{{ route('listings.manage') }}" class="profile-menu-item">
                    <i class="fa-regular fa-rectangle-list"></i>
                    Quản lý tin
                </a>

                <div class="profile-menu-divider"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="profile-menu-item logout-item">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Đăng xuất
                    </button>
                </form>

            </div>

        </div>
        @endauth

    </div>

</header>
<script>
const profileTrigger = document.getElementById('profileTrigger');
const profileMenu = document.getElementById('profileMenu');

if (profileTrigger && profileMenu) {

    profileTrigger.addEventListener('click', function(event) {
        event.stopPropagation();

        profileMenu.classList.toggle('show');
        this.closest('.profile-dropdown').classList.toggle('open');
    });

    document.addEventListener('click', function() {
        profileMenu.classList.remove('show');

        document
            .querySelector('.profile-dropdown')
            ?.classList.remove('open');
    });

    profileMenu.addEventListener('click', function(event) {
        event.stopPropagation();
    });
}
</script>