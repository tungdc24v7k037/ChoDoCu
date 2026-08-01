  <link rel="stylesheet" href="{{ asset('css/news.css') }}">

<div class="post-page">
    <div class="post-layout">

        <!-- Cột trái -->
        <aside class="video-tip">
            <h3>Đừng quên đăng video!</h3>

            <p>
                <span>✓</span>
                Tăng đến <strong>x2 lượt xem</strong> tin đăng 🔥
            </p>

            <p>
                <span>✓</span>
                Xuất hiện miễn phí ở Green Mart Video
            </p>
        </aside>

        <!-- Nội dung chính -->
        <main class="post-content">
            
            <form action="#" method="POST" enctype="multipart/form-data">

                <!-- Khối ảnh/video -->
                <section class="form-card">
                    <div class="form-label-row">
                        <label>
                            Hình ảnh/Video
                            <small>(Tối đa 20 ảnh và 1 video)</small>
                            <span>*</span>
                        </label>

                        <span class="info-icon">i</span>
                    </div>

                    <label class="upload-box" for="mediaInput">
                        <input
                            type="file"
                            id="mediaInput"
                            name="media[]"
                            accept="image/*,video/*"
                            multiple
                            hidden
                        >

                        <div class="upload-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 6.5C4 5.67 4.67 5 5.5 5H12L14 7H18.5C19.33 7 20 7.67 20 8.5V17.5C20 18.33 19.33 19 18.5 19H5.5C4.67 19 4 18.33 4 17.5V6.5Z"
                                      stroke="currentColor"
                                      stroke-width="1.8"
                                      stroke-linejoin="round"/>

                                <circle cx="12" cy="13" r="3"
                                        stroke="currentColor"
                                        stroke-width="1.8"/>

                                <path d="M12 10V16M9 13H15"
                                      stroke="currentColor"
                                      stroke-width="1.8"
                                      stroke-linecap="round"/>
                            </svg>
                        </div>

                        <strong>Thêm ảnh/video</strong>
                    </label>

                    <div class="upload-error">
                        Vui lòng chọn ít nhất 1 ảnh
                    </div>

                    <!-- Xem trước ảnh -->
                    <div id="previewList" class="preview-list"></div>

                    <!-- Mô tả -->
                    <div class="description-box">
                        <label for="description">
                            Mô tả tin đăng <span>*</span>
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            maxlength="1500"
                            placeholder="Nhập mô tả chi tiết sản phẩm..."
                        ></textarea>

                        <button type="button" class="ai-button">
                            ✦ AI Viết giúp
                        </button>
                    </div>

                    <div class="character-count">
                        <span id="characterCurrent">0</span>/1500 kí tự
                    </div>

                    <div class="description-guide">
                        <strong>Mô tả tốt nên có:</strong>

                        <ul>
                            <li>Tên sản phẩm, thương hiệu và năm sản xuất</li>
                            <li>Tình trạng, thời gian sử dụng và giá bán</li>
                        </ul>
                    </div>
                    <div class="category-field">
    <label for="category_id">
        Danh mục sản phẩm <span>*</span>
    </label>

    <select
        id="category_id"
        name="category_id"
        required
    >
        <option value="">-- Chọn danh mục --</option>

        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <div class="field-error">
            {{ $message }}
        </div>
    @enderror
</div>
                </section>
                
                <!-- Thông tin chi tiết -->
                <section class="detail-card">
                    <div class="detail-icon">☷</div>

                    <div>
                        <h3>Thông tin chi tiết</h3>
                        <p>Vui lòng chọn ảnh và điền mô tả trước</p>
                    </div>
                </section>

            </form>
        </main>
    </div>

    <!-- Thanh nút dưới -->
    <div class="bottom-action">
        <button type="submit" class="submit-button">
            Đăng tin
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const mediaInput = document.getElementById('mediaInput');
    const previewList = document.getElementById('previewList');
    const uploadBox = document.querySelector('.upload-box');
    const uploadError = document.querySelector('.upload-error');

    const description = document.getElementById('description');
    const characterCurrent = document.getElementById('characterCurrent');

    let selectedFiles = [];

    // Đếm ký tự mô tả
    if (description && characterCurrent) {
        characterCurrent.textContent = description.value.length;

        description.addEventListener('input', function () {
            characterCurrent.textContent = this.value.length;
        });
    }

    if (!mediaInput || !previewList || !uploadBox) {
        console.error('Không tìm thấy mediaInput, previewList hoặc uploadBox.');
        return;
    }

    mediaInput.addEventListener('change', function () {
        const newFiles = Array.from(this.files);

        newFiles.forEach(function (file) {
            const isImage = file.type.startsWith('image/');
            const isVideo = file.type.startsWith('video/');

            if (!isImage && !isVideo) {
                return;
            }

            // Chỉ cho tối đa 1 video
            if (isVideo) {
                const alreadyHasVideo = selectedFiles.some(function (item) {
                    return item.type.startsWith('video/');
                });

                if (alreadyHasVideo) {
                    alert('Chỉ được chọn tối đa 1 video.');
                    return;
                }
            }

            // Tối đa 20 file
            if (selectedFiles.length >= 20) {
                alert('Chỉ được chọn tối đa 20 ảnh/video.');
                return;
            }

            selectedFiles.push(file);
        });

        syncInputFiles();
        renderPreview();

        // Cho phép chọn lại cùng một file sau khi đã xóa
        this.value = '';
    });

    function renderPreview() {
        previewList.innerHTML = '';

        if (selectedFiles.length === 0) {
            uploadBox.style.display = 'flex';

            if (uploadError) {
                uploadError.style.display = 'block';
            }

            return;
        }

        uploadBox.style.display = 'none';

        if (uploadError) {
            uploadError.style.display = 'none';
        }

        selectedFiles.forEach(function (file, index) {
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';

            const objectUrl = URL.createObjectURL(file);

            if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = objectUrl;
                video.controls = true;
                video.muted = true;
                video.preload = 'metadata';

                video.addEventListener('loadeddata', function () {
                    URL.revokeObjectURL(objectUrl);
                });

                previewItem.appendChild(video);
            } else {
                const image = document.createElement('img');
                image.src = objectUrl;
                image.alt = file.name || 'Ảnh sản phẩm';

                image.addEventListener('load', function () {
                    URL.revokeObjectURL(objectUrl);
                });

                previewItem.appendChild(image);
            }

            // Nút xóa
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-media';
            removeButton.innerHTML = '&times;';
            removeButton.setAttribute('aria-label', 'Xóa ảnh hoặc video');

            removeButton.addEventListener('click', function () {
                selectedFiles.splice(index, 1);

                syncInputFiles();
                renderPreview();
            });

            previewItem.appendChild(removeButton);

            // Ảnh đầu tiên là ảnh bìa
            if (index === 0 && file.type.startsWith('image/')) {
                const coverLabel = document.createElement('span');
                coverLabel.className = 'cover-label';
                coverLabel.textContent = 'Ảnh bìa';

                previewItem.appendChild(coverLabel);
            }

            previewList.appendChild(previewItem);
        });

        // Nút thêm ảnh nhỏ sau khi đã có ảnh
        if (selectedFiles.length < 20) {
            const addMoreLabel = document.createElement('label');
            addMoreLabel.className = 'add-more-media';
            addMoreLabel.setAttribute('for', 'mediaInput');

            addMoreLabel.innerHTML = `
                <span class="add-more-icon">+</span>
                <span>Thêm ảnh</span>
            `;

            previewList.appendChild(addMoreLabel);
        }
    }

    function syncInputFiles() {
        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });

        mediaInput.files = dataTransfer.files;
    }
});
</script>