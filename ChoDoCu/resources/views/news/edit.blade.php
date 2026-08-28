<link rel="stylesheet" href="{{ asset('css/news.css') }}">

<div class="header">
    @include('main.header')
</div>

<div class="post-page">
    <div class="post-layout">

        <aside class="video-tip">
            <h3>Chỉnh sửa tin đăng</h3>

            <p>
                <span>✓</span>
                Cập nhật thông tin sản phẩm
            </p>

            <p>
                <span>✓</span>
                Thay đổi hình ảnh nếu cần
            </p>
        </aside>


        <main class="post-content">

            <form action="{{ route('listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data"
                id="editListingForm">
                @csrf
                @method('PUT')


                {{-- =========================
                    ẢNH HIỆN TẠI
                ========================== --}}
                <section class="form-card">

                    <div class="form-label-row">
                        <label>
                            Hình ảnh sản phẩm
                            <small>(Tối đa 6 ảnh)</small>
                        </label>

                        <span class="info-icon">i</span>
                    </div>


                    <div class="existing-images" id="existingImages">

                        @foreach($listing->images as $image)

                        <div class="existing-image-item" data-image-id="{{ $image->id }}">
                            <img src="{{ $image->image_path }}" alt="{{ $listing->title }}">

                            @if($image->is_primary)
                            <span class="cover-label">
                                Ảnh bìa
                            </span>
                            @endif

                            <button type="button" class="remove-existing-image" data-image-id="{{ $image->id }}">
                                ×
                            </button>
                        </div>

                        @endforeach

                    </div>


                    {{-- ID ảnh muốn xóa --}}
                    <div id="deletedImageInputs"></div>


                    {{-- UPLOAD ẢNH MỚI --}}
                    <label class="upload-box" for="mediaInput">

                        <input type="file" id="mediaInput" name="images[]" accept="image/*" multiple hidden>

                        <div class="upload-icon">
                            <i class="fa-regular fa-image"></i>
                        </div>

                        <strong>Thêm ảnh mới</strong>

                    </label>




                    {{-- =========================
                        MÔ TẢ
                    ========================== --}}
                    <div class="description-box">

                        <label for="description">
                            Mô tả tin đăng <span>*</span>
                        </label>

                        <textarea id="description" name="description" maxlength="1500" required
                            placeholder="Nhập mô tả chi tiết sản phẩm...">{{ old('description', $listing->description) }}</textarea>

                        @error('description')
                        <div class="field-error">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="character-count">
                        <span id="characterCurrent">
                            {{ mb_strlen(old('description', $listing->description)) }}
                        </span>/1500 kí tự
                    </div>


                    {{-- =========================
                        CATEGORY CHA
                    ========================== --}}
                    <div class="category-field">

                        <label for="parent_category_id">
                            Danh mục sản phẩm <span>*</span>
                        </label>

                        <select id="parent_category_id" required>

                            <option value="">
                                -- Chọn danh mục --
                            </option>

                            @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ $parentCategoryId == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- =========================
                        CATEGORY CON
                    ========================== --}}
                    <div class="category-field" id="subCategoryWrapper"
                        style="{{ $subCategories->isNotEmpty() ? '' : 'display:none;' }}">

                        <label for="category_id">
                            Danh mục chi tiết
                        </label>

                        <select id="category_id" name="category_id">

                            <option value="">
                                -- Chọn danh mục chi tiết --
                            </option>

                            @foreach($subCategories as $sub)

                            <option value="{{ $sub->id }}"
                                {{ old('category_id', $listing->category_id) == $sub->id ? 'selected' : '' }}>
                                {{ $sub->name }}
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


                {{-- =========================
                    THÔNG TIN CHI TIẾT
                ========================== --}}
                <section class="detail-card">

                    <div class="detail-icon">
                        ☷
                    </div>

                    <div class="detail-section">

                        <h3>Thông tin chi tiết</h3>

                        <div class="detail-fields">


                            {{-- TITLE --}}
                            <div class="detail-field">

                                <label for="title">
                                    Tên sản phẩm <span>*</span>
                                </label>

                                <input type="text" id="title" name="title" value="{{ old('title', $listing->title) }}"
                                    placeholder="Nhập tên sản phẩm" required>

                                @error('title')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- CONDITION --}}
                            <div class="detail-field">

                                <label for="condition">
                                    Tình trạng <span>*</span>
                                </label>

                                <select id="condition" name="condition" required>

                                    <option value="">
                                        Chọn tình trạng
                                    </option>

                                    <option value="new"
                                        {{ old('condition', $listing->condition) === 'new' ? 'selected' : '' }}>
                                        Mới
                                    </option>

                                    <option value="used"
                                        {{ old('condition', $listing->condition) === 'used' ? 'selected' : '' }}>
                                        Đã sử dụng
                                    </option>

                                </select>

                            </div>


                            {{-- PRICE --}}
                            <div class="detail-field">

                                <label for="price">
                                    Giá bán <span>*</span>
                                </label>

                                <input type="number" id="price" name="price" value="{{ old('price', $listing->price) }}"
                                    min="0" placeholder="Nhập giá bán" required>

                                @error('price')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>


                            {{-- PHONE --}}
                            <div class="detail-field">

                                <label for="phone">
                                    Số điện thoại
                                </label>

                                <input type="text" id="phone" name="phone" value="{{ old('phone', $listing->phone) }}"
                                    placeholder="Nhập số điện thoại">

                            </div>


                            {{-- PROVINCE --}}
                            <div class="detail-field">

                                <label for="province">
                                    Tỉnh / Thành phố
                                </label>

                                <input type="text" id="province" name="province"
                                    value="{{ old('province', $listing->province) }}"
                                    placeholder="Nhập tỉnh / thành phố">

                            </div>


                            {{-- DISTRICT --}}
                            <div class="detail-field">

                                <label for="district">
                                    Quận / Huyện
                                </label>

                                <input type="text" id="district" name="district"
                                    value="{{ old('district', $listing->district) }}" placeholder="Nhập quận / huyện">

                            </div>


                            {{-- WARD --}}
                            <div class="detail-field">

                                <label for="ward">
                                    Phường / Xã
                                </label>

                                <input type="text" id="ward" name="ward" value="{{ old('ward', $listing->ward) }}"
                                    placeholder="Nhập phường / xã">

                            </div>


                            {{-- ADDRESS --}}
                            <div class="detail-field">

                                <label for="address">
                                    Địa chỉ
                                </label>

                                <input type="text" id="address" name="address"
                                    value="{{ old('address', $listing->address) }}" placeholder="Nhập địa chỉ">

                            </div>

                        </div>

                    </div>

                </section>


                {{-- ERROR --}}
                @if($errors->any())

                <div class="form-errors">

                    @foreach($errors->all() as $error)
                    <div>
                        {{ $error }}
                    </div>
                    @endforeach

                </div>

                @endif


                {{-- BUTTON --}}
                <div class="bottom-action">

                    <a href="{{ route('listings.manage') }}" class="cancel-button">
                        Hủy
                    </a>

                    <button type="submit" class="submit-button">
                        Lưu thay đổi
                    </button>

                </div>

            </form>

        </main>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const parentSelect =
        document.getElementById('parent_category_id');

    const childSelect =
        document.getElementById('category_id');

    const childWrapper =
        document.getElementById('subCategoryWrapper');


    parentSelect?.addEventListener('change', async function() {

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
            }

        } catch (error) {

            console.error(
                'Không tải được danh mục:',
                error
            );

        }

    });

});
document.addEventListener('DOMContentLoaded', function() {

    const deletedContainer =
        document.getElementById('deletedImageInputs');

    document
        .querySelectorAll('.remove-existing-image')
        .forEach(function(button) {

            button.addEventListener('click', function() {

                const imageId = this.dataset.imageId;

                const item = this.closest(
                    '.existing-image-item'
                );

                const input =
                    document.createElement('input');

                input.type = 'hidden';
                input.name = 'deleted_images[]';
                input.value = imageId;

                deletedContainer.appendChild(input);

                item.remove();

            });

        });

}); <
script >
    document.addEventListener('DOMContentLoaded', function() {

        const input = document.getElementById('mediaInput');
        const existingImages = document.getElementById('existingImages');

        let selectedFiles = [];

        input?.addEventListener('change', function() {

            const files = Array.from(this.files);

            files.forEach(function(file) {

                if (!file.type.startsWith('image/')) {
                    return;
                }

                const totalImages =
                    existingImages.querySelectorAll('.existing-image-item').length +
                    selectedFiles.length;

                if (totalImages >= 6) {
                    alert('Tối đa 6 ảnh');
                    return;
                }

                selectedFiles.push(file);
            });

            this.value = '';

            syncFiles();
            renderNewImages();
        });


        function syncFiles() {

            const dt = new DataTransfer();

            selectedFiles.forEach(function(file) {
                dt.items.add(file);
            });

            input.files = dt.files;
        }


        function renderNewImages() {

            // Xóa preview ảnh mới cũ trước khi render lại
            existingImages
                .querySelectorAll('.new-image-item')
                .forEach(function(item) {
                    item.remove();
                });


            selectedFiles.forEach(function(file, index) {

                const item = document.createElement('div');

                item.className =
                    'existing-image-item new-image-item';


                const image = document.createElement('img');

                const objectUrl =
                    URL.createObjectURL(file);

                image.src = objectUrl;
                image.alt = file.name;


                image.addEventListener('load', function() {
                    URL.revokeObjectURL(objectUrl);
                });


                const removeButton =
                    document.createElement('button');

                removeButton.type = 'button';
                removeButton.className = 'remove-existing-image';
                removeButton.innerHTML = '×';


                removeButton.addEventListener(
                    'click',
                    function() {

                        selectedFiles.splice(index, 1);

                        syncFiles();
                        renderNewImages();
                    }
                );


                item.appendChild(image);
                item.appendChild(removeButton);

                existingImages.appendChild(item);
            });
        }

    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const input = document.getElementById('mediaInput');
    const existingImages = document.getElementById('existingImages');

    let selectedFiles = [];

    input?.addEventListener('change', function() {

        const files = Array.from(this.files);

        files.forEach(function(file) {

            if (!file.type.startsWith('image/')) {
                return;
            }

            const totalImages =
                existingImages.querySelectorAll('.existing-image-item').length +
                selectedFiles.length;

            if (totalImages >= 6) {
                alert('Tối đa 6 ảnh');
                return;
            }

            selectedFiles.push(file);
        });

        this.value = '';

        syncFiles();
        renderNewImages();
    });


    function syncFiles() {

        const dt = new DataTransfer();

        selectedFiles.forEach(function(file) {
            dt.items.add(file);
        });

        input.files = dt.files;
    }


    function renderNewImages() {

        // Xóa preview ảnh mới cũ trước khi render lại
        existingImages
            .querySelectorAll('.new-image-item')
            .forEach(function(item) {
                item.remove();
            });


        selectedFiles.forEach(function(file, index) {

            const item = document.createElement('div');

            item.className =
                'existing-image-item new-image-item';


            const image = document.createElement('img');

            const objectUrl =
                URL.createObjectURL(file);

            image.src = objectUrl;
            image.alt = file.name;


            image.addEventListener('load', function() {
                URL.revokeObjectURL(objectUrl);
            });


            const removeButton =
                document.createElement('button');

            removeButton.type = 'button';
            removeButton.className = 'remove-existing-image';
            removeButton.innerHTML = '×';


            removeButton.addEventListener(
                'click',
                function() {

                    selectedFiles.splice(index, 1);

                    syncFiles();
                    renderNewImages();
                }
            );


            item.appendChild(image);
            item.appendChild(removeButton);

            existingImages.appendChild(item);
        });
    }

});
</script>