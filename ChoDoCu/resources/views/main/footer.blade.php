<style>
    .footer{
    margin-top:60px;
    background:#fff;
    border-top:1px solid #ececec;
}

.footer-container{
    max-width:1200px;
    margin:auto;
    padding:40px 20px;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:70px;
}

.footer-column h4{
    margin-bottom:18px;
    color:#222;
    font-size:18px;
    font-weight:700;
}

.footer-column a{
    display:block;
    margin-bottom:12px;
    color:#666;
    text-decoration:none;
    transition:.2s;
}

.footer-column a:hover{
    color:#16a34a;
}

.footer-column p{
    margin-bottom:12px;
    color:#666;
    line-height:1.7;
}

.socials{
    display:flex;
    gap:12px;
    margin-bottom:18px;
}

.socials a{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#16a34a;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.socials a:hover{
    background:#12823d;
}

.footer-bottom{
    border-top:1px solid #ececec;
    padding:18px;
    text-align:center;
    color:#888;
    font-size:14px;
}

@media(max-width:768px){

    .footer-container{
        grid-template-columns:1fr;
        gap:35px;
    }

}
</style>

<footer class="footer">
    <div class="footer-container">

        <div class="footer-column">
            <h4>Hỗ trợ khách hàng</h4>

            <a href="#">Trung tâm trợ giúp</a>
            <a href="#">Hướng dẫn mua bán</a>
            <a href="#">Chính sách bảo mật</a>
            <a href="#">Liên hệ hỗ trợ</a>
        </div>

        <div class="footer-column">
            <h4>Về Green Mart</h4>

            <a href="#">Giới thiệu</a>
            <a href="#">Quy chế hoạt động</a>
            <a href="#">Điều khoản sử dụng</a>
            <a href="#">Tuyển dụng</a>
            <a href="#">Tin tức</a>
            <a href="#">Blog</a>
        </div>

        <div class="footer-column">
            <h4>Liên hệ</h4>

            <div class="socials">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>

            <p>Email: support@greenmart.vn</p>

            <p>Hotline: 1900 1234</p>

            <p>
                Địa chỉ:<br>
                123 Nguyễn Văn Linh,<br>
                Quận 7, TP. Hồ Chí Minh
            </p>
        </div>

    </div>

    <div class="footer-bottom">
        © {{ date('Y') }} Green Mart. All rights reserved.
    </div>
</footer>