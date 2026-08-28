<link rel="stylesheet" href="{{ asset('css/news.css') }}">

<div class="header">
    @include('main.header')
</div>

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

            <form id="createListingForm" action="{{ route('listings.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <!-- Khối ảnh -->
                <section class="form-card">
                    <div class="form-label-row">
                        <label>
                            Hình ảnh
                            <small>(Tối đa 6 ảnh)</small>
                            <span>*</span>
                        </label>

                        <span class="info-icon">i</span>
                    </div>

                    <label class="upload-box" for="mediaInput">
                        <input type="file" id="mediaInput" name="images[]" accept="image/*" multiple hidden>

                        <div class="upload-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M4 6.5C4 5.67 4.67 5 5.5 5H12L14 7H18.5C19.33 7 20 7.67 20 8.5V17.5C20 18.33 19.33 19 18.5 19H5.5C4.67 19 4 18.33 4 17.5V6.5Z"
                                    stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />

                                <circle cx="12" cy="13" r="3" stroke="currentColor" stroke-width="1.8" />

                                <path d="M12 10V16M9 13H15" stroke="currentColor" stroke-width="1.8"
                                    stroke-linecap="round" />
                            </svg>
                        </div>

                        <strong>Thêm ảnh</strong>
                    </label>

                    <div id="uploadError" class="upload-error"
                        style="{{ $errors->has('images') || $errors->has('images.*') ? '' : 'display:none;' }}">
                        @if($errors->has('images'))
                        {{ $errors->first('images') }}
                        @elseif($errors->has('images.*'))
                        {{ $errors->first('images.*') }}
                        @else
                        Vui lòng chọn ít nhất 1 ảnh
                        @endif
                    </div>

                    <!-- Xem trước ảnh -->
                    <div id="previewList" class="preview-list"></div>

                    <!-- Mô tả -->
                    <div class="description-box">
                        <label for="description">
                            Mô tả tin đăng <span>*</span>
                        </label>

                        <textarea id="description" name="description" maxlength="1500" required
                            placeholder="Nhập mô tả chi tiết sản phẩm...">{{ old('description') }}</textarea>

                        @error('description')
                        <div class="field-error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="character-count">
                        <span id="characterCurrent">{{ mb_strlen(old('description', '')) }}</span>/1500 kí tự
                    </div>

                    <div class="description-guide">
                        <strong>Mô tả tốt nên có:</strong>

                        <ul>
                            <li>Tên sản phẩm, thương hiệu và năm sản xuất</li>
                            <li>Tình trạng, thời gian sử dụng và giá bán</li>
                        </ul>
                    </div>

                    <!-- Danh mục -->
                    <div class="category-field">

                        <label for="parent_category_id">
                            Danh mục sản phẩm <span>*</span>
                        </label>

                        {{-- Danh mục cha --}}
                        <select id="parent_category_id" required>
                            <option value="">-- Chọn danh mục --</option>

                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>


                        {{-- Danh mục con --}}
                        <div id="subCategoryWrapper" style="display:none; margin-top:12px;">

                            <label for="category_id">
                                Danh mục chi tiết <span>*</span>
                            </label>

                            <select id="category_id" name="category_id">

                                <option value="">
                                    -- Chọn danh mục chi tiết --
                                </option>

                            </select>

                        </div>


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

                    <div class="detail-section">
                        <h3>Thông tin chi tiết</h3>

                        <div class="detail-fields">

                            {{-- Tên sản phẩm --}}
                            <div class="detail-field">
                                <label for="title">
                                    Tên sản phẩm <span>*</span>
                                </label>

                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                    placeholder="Nhập tên sản phẩm" required>

                                @error('title')
                                <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Tỉnh / Thành phố --}}
                            <div class="detail-field">
                                <label for="province">
                                    Tỉnh / Thành phố
                                </label>

                                <input type="text" id="province" name="province" value="{{ old('province') }}"
                                    placeholder="Nhập tỉnh / thành phố">

                                @error('province')
                                <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Tình trạng --}}
                            <div class="detail-field">
                                <label for="condition">
                                    Tình trạng <span>*</span>
                                </label>

                                <select id="condition" name="condition" required>
                                    <option value="">Chọn tình trạng</option>

                                    <option value="new" {{ old('condition') === 'new' ? 'selected' : '' }}>
                                        Mới
                                    </option>

                                    <option value="used" {{ old('condition') === 'used' ? 'selected' : '' }}>
                                        Đã sử dụng
                                    </option>
                                </select>

                                @error('condition')
                                <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Giá bán --}}
                            <div class="detail-field">
                                <label for="price">
                                    Giá bán <span>*</span>
                                </label>

                                <input type="number" id="price" name="price" value="{{ old('price') }}" min="0"
                                    placeholder="Nhập giá bán" required>

                                @error('price')
                                <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Số điện thoại --}}
                            <div class="detail-field">
                                <label for="phone">
                                    Số điện thoại
                                </label>

                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="Nhập số điện thoại">

                                @error('phone')
                                <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Quận / Huyện --}}
                            <div class="detail-field">
                                <label for="district">
                                    Quận / Huyện
                                </label>

                                <input type="text" id="district" name="district" value="{{ old('district') }}"
                                    placeholder="Nhập quận / huyện">

                                @error('district')
                                <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Phường / Xã --}}
                            <div class="detail-field">
                                <label for="ward">
                                    Phường / Xã
                                </label>

                                <input type="text" id="ward" name="ward" value="{{ old('ward') }}"
                                    placeholder="Nhập phường / xã">

                                @error('ward')
                                <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- Địa chỉ chi tiết --}}
                            <div class="detail-field">
                                <label for="address">
                                    Địa chỉ chi tiết
                                </label>

                                <input type="text" id="address" name="address" value="{{ old('address') }}"
                                    placeholder="Số nhà, tên đường...">

                                @error('address')
                                <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </section>

                <div class="bottom-action">
                    <button type="submit" class="submit-button">
                        Đăng tin
                    </button>
                </div>
            </form>

        </main>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createListingForm');
    const mediaInput = document.getElementById('mediaInput');
    const previewList = document.getElementById('previewList');
    const uploadBox = document.querySelector('.upload-box');
    const uploadError = document.getElementById('uploadError');

    const description = document.getElementById('description');
    const characterCurrent = document.getElementById('characterCurrent');

    let selectedFiles = [];

    // Đếm ký tự mô tả
    if (description && characterCurrent) {
        characterCurrent.textContent = description.value.length;

        description.addEventListener('input', function() {
            characterCurrent.textContent = this.value.length;
        });
    }

    if (!mediaInput || !previewList || !uploadBox || !form) {
        console.error('Không tìm thấy mediaInput, previewList, uploadBox hoặc form.');
        return;
    }

    mediaInput.addEventListener('change', function() {
        const newFiles = Array.from(this.files);

        newFiles.forEach(function(file) {
            if (!file.type.startsWith('image/')) {
                return;
            }

            // Không thêm trùng đúng cùng file
            const duplicate = selectedFiles.some(function(item) {
                return (
                    item.name === file.name &&
                    item.size === file.size &&
                    item.lastModified === file.lastModified
                );
            });

            if (duplicate) {
                return;
            }

            if (selectedFiles.length >= 6) {
                alert('Chỉ được chọn tối đa 6 ảnh.');
                return;
            }

            selectedFiles.push(file);
        });

        /*
         * Quan trọng:
         * Clear trước rồi sync lại bằng DataTransfer.
         * Không clear mediaInput sau sync vì sẽ làm mất file khi submit.
         */
        this.value = '';

        syncInputFiles();
        renderPreview();

        if (selectedFiles.length > 0 && uploadError) {
            uploadError.style.display = 'none';
        }
    });

    function renderPreview() {
        previewList.innerHTML = '';

        if (selectedFiles.length === 0) {
            uploadBox.style.display = 'flex';
            return;
        }

        uploadBox.style.display = 'none';

        selectedFiles.forEach(function(file, index) {
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';

            const objectUrl = URL.createObjectURL(file);

            const image = document.createElement('img');
            image.src = objectUrl;
            image.alt = file.name || 'Ảnh sản phẩm';

            image.addEventListener('load', function() {
                URL.revokeObjectURL(objectUrl);
            });

            previewItem.appendChild(image);

            // Nút xóa
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-media';
            removeButton.innerHTML = '&times;';
            removeButton.setAttribute('aria-label', 'Xóa ảnh');

            removeButton.addEventListener('click', function() {
                selectedFiles.splice(index, 1);

                syncInputFiles();
                renderPreview();

                if (selectedFiles.length === 0 && uploadError) {
                    uploadError.style.display = 'block';
                    uploadError.textContent = 'Vui lòng chọn ít nhất 1 ảnh';
                }
            });

            previewItem.appendChild(removeButton);

            // Ảnh đầu tiên là ảnh bìa
            if (index === 0) {
                const coverLabel = document.createElement('span');
                coverLabel.className = 'cover-label';
                coverLabel.textContent = 'Ảnh bìa';

                previewItem.appendChild(coverLabel);
            }

            previewList.appendChild(previewItem);
        });

        // Nút thêm ảnh nhỏ
        if (selectedFiles.length < 6) {
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

        selectedFiles.forEach(function(file) {
            dataTransfer.items.add(file);
        });

        mediaInput.files = dataTransfer.files;
    }

    // Chặn submit nếu chưa có ảnh
    form.addEventListener('submit', function(event) {
        syncInputFiles();

        if (selectedFiles.length === 0 || mediaInput.files.length === 0) {
            event.preventDefault();

            if (uploadError) {
                uploadError.style.display = 'block';
                uploadError.textContent = 'Vui lòng chọn ít nhất 1 ảnh';
            }

            uploadBox.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            return;
        }

        if (selectedFiles.length > 6) {
            event.preventDefault();

            if (uploadError) {
                uploadError.style.display = 'block';
                uploadError.textContent = 'Chỉ được chọn tối đa 6 ảnh';
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {

    const parentSelect =
        document.getElementById('parent_category_id');

    const childSelect =
        document.getElementById('category_id');

    const childWrapper =
        document.getElementById('subCategoryWrapper');


    parentSelect.addEventListener('change', async function() {

        const parentId = this.value;

        childSelect.innerHTML = `
            <option value="">
                -- Chọn danh mục chi tiết --
            </option>
        `;

        childWrapper.style.display = 'none';


        if (!parentId) {
            return;
        }


        try {

            const response = await fetch(
                `/categories/${parentId}/children`
            );

            const children = await response.json();


            /*
            |--------------------------------------------------------------------------
            | Nếu có danh mục con
            |--------------------------------------------------------------------------
            */

            if (children.length > 0) {

                children.forEach(function(category) {

                    const option =
                        document.createElement('option');

                    option.value = category.id;
                    option.textContent = category.name;

                    childSelect.appendChild(option);
                });

                childSelect.required = true;
                childWrapper.style.display = 'block';

            } else {

                /*
                |--------------------------------------------------------------------------
                | Không có danh mục con
                | Lưu luôn category cha
                |--------------------------------------------------------------------------
                */

                const option =
                    document.createElement('option');

                option.value = parentId;
                option.textContent =
                    parentSelect.options[
                        parentSelect.selectedIndex
                    ].text;

                childSelect.appendChild(option);

                childSelect.value = parentId;

                childSelect.required = false;
                childWrapper.style.display = 'none';
            }

        } catch (error) {

            console.error(
                'Không tải được danh mục con:',
                error
            );

        }

    });

});
</script>