<style>
.about-section {
    width: 100%;
    padding: 22px 24px;
    background: #ffffff;
    border-radius: 14px;
    box-sizing: border-box;
}

.about-section h2 {
    margin: 0 0 12px;
    font-size: 22px;
    line-height: 1.4;
    color: #222;
}

.about-content {
    position: relative;
    overflow: hidden;
    color: #666;
    font-size: 14px;
    line-height: 1.65;
    transition: max-height 0.35s ease;
}

.about-content p {
    margin: 0 0 8px;
}

.about-content strong {
    color: #444;
}

.about-content.collapsed {
    max-height: 145px;
}

.about-content.collapsed::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 55px;
    background: linear-gradient(
        to bottom,
        rgba(255, 255, 255, 0),
        #ffffff
    );
    pointer-events: none;
}

.about-content.expanded {
    max-height: 1200px;
}

.about-toggle {
    margin-top: 8px;
    padding: 7px 14px;
    border: 1px solid #d8d8d8;
    border-radius: 8px;
    background: #ffffff;
    color: #222;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.about-toggle:hover {
    background: #f3fff6;
    border-color: #169b4d;
    color: #169b4d;
}
</style>

<section class="about-section">
    <h2>Green Mart - Chợ Mua Bán Trực Tuyến Tiện Lợi Và Thân Thiện</h2>

    <div id="aboutContent" class="about-content collapsed">
        <p>
            Green Mart là nền tảng mua bán trực tuyến giúp kết nối người mua và người bán
            một cách nhanh chóng, thuận tiện và minh bạch. Tại đây, người dùng có thể dễ dàng
            đăng tin, tìm kiếm sản phẩm và trao đổi trực tiếp với nhau trong nhiều lĩnh vực khác nhau.
        </p>

        <p>
            Với giao diện đơn giản, dễ sử dụng, Green Mart hướng đến việc xây dựng một không gian
            mua bán hiện đại, phù hợp cho cả cá nhân lẫn cửa hàng nhỏ. Người dùng có thể tìm thấy
            nhiều sản phẩm đa dạng từ đồ điện tử, xe cộ, thời trang, đồ gia dụng, thú cưng,
            việc làm cho đến bất động sản.
        </p>

        <p>
            <strong>Đồ điện tử:</strong>
            Điện thoại, máy tính, laptop, tivi, loa, phụ kiện và nhiều thiết bị công nghệ khác.
        </p>

        <p>
            <strong>Xe cộ:</strong>
            Xe máy, ô tô, xe đạp và các loại phụ tùng, linh kiện phù hợp với nhiều nhu cầu sử dụng.
        </p>

        <p>
            <strong>Bất động sản:</strong>
            Nhà đất, căn hộ, phòng trọ, mặt bằng kinh doanh và các thông tin cho thuê đa dạng.
        </p>

        <p>
            <strong>Thời trang và đồ gia dụng:</strong>
            Quần áo, giày dép, túi xách, đồ nội thất, thiết bị gia đình và nhiều sản phẩm thiết yếu.
        </p>

        <p>
            <strong>Việc làm:</strong>
            Thông tin tuyển dụng, việc làm bán thời gian, toàn thời gian và các cơ hội nghề nghiệp phù hợp.
        </p>

        <p>
            Green Mart mong muốn mang đến trải nghiệm mua bán an toàn, dễ tiếp cận và tiết kiệm thời gian.
            Chỉ với vài thao tác đơn giản, bạn có thể đăng tin sản phẩm, tiếp cận người có nhu cầu
            và tìm kiếm những món đồ phù hợp với mức giá hợp lý.
        </p>

        <p>
            Chúng tôi luôn hướng đến việc xây dựng một cộng đồng mua bán văn minh, nơi thông tin
            được trình bày rõ ràng, người dùng chủ động trao đổi và mọi giao dịch đều trở nên thuận tiện hơn.
        </p>
    </div>

    <button
        type="button"
        id="aboutToggle"
        class="about-toggle"
        aria-expanded="false"
    >
        Mở rộng
    </button>
</section>
<script>
    const aboutContent = document.getElementById('aboutContent');
    const aboutToggle = document.getElementById('aboutToggle');

    aboutToggle.addEventListener('click', function () {
        const isExpanded = aboutContent.classList.contains('expanded');

        if (isExpanded) {
            aboutContent.classList.remove('expanded');
            aboutContent.classList.add('collapsed');

            aboutToggle.textContent = 'Mở rộng';
            aboutToggle.setAttribute('aria-expanded', 'false');
        } else {
            aboutContent.classList.remove('collapsed');
            aboutContent.classList.add('expanded');

            aboutToggle.textContent = 'Thu gọn';
            aboutToggle.setAttribute('aria-expanded', 'true');
        }
    });
</script>
