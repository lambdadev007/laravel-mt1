<div class="furniture-materials-wrapper">
    <div class="content-wrapper">
        @if ( $data['content'] != [] )
            <label for="furniture-materials-banner" class="admin-image-wrapper d-flex">
                <img class="ajax-image image" src="{{ asset('images/furniture-materials/furniture-materials-banner.jpg') }}">
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="furniture_materials_banner" id="furniture-materials-banner">
            </label>
            <textarea class="text-editor" name="description" required>{{ $data['content'][0]['description'] }}</textarea>
        @else
            <label for="furniture-materials-banner" class="admin-image-wrapper d-flex">
                <img class="ajax-image image" src="{{ asset('images/furniture-materials/furniture-materials-banner.jpg') }}">
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="furniture_materials_banner" id="furniture-materials-banner">
            </label>
            <textarea class="text-editor" name="description" required>ტექსტი</textarea>
        @endif
    </div>
</div>

<div class="furniture-materials-wrapper">
    <h2 class="section-title mb-5">კატალოგები / დააჭირეთ მარჯვენა სურათს ფაილი რომ დაამატოთ</h2>

    <button class="split-button mb-5" type="button" id="add-catalogue">
        <span class="w-100">დამატება</span>
    </button>

    <div class="catalogue-wrapper">
        @foreach ($data['catalogue'] as $index => $catalogue)
            <div class="catalogue">
                <button type="button" class="remove-catalogue">X</button>

                <label for="catalogue-image-{{ $index }}" class="admin-image-wrapper d-flex">
                    <img class="ajax-image image" src="{{ asset($catalogue['image']) }}">
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="catalogue_image[]" id="catalogue-image-{{ $index }}">
                    <input type="hidden" name="existing_catalogue_image[]" value="{{ $catalogue['image'] }}">
                </label>

                <a onclick="function(e){e.preventDefault()}" contenteditable="true" data-text-to-value="#catalogue-title-{{ $index }}">{{ $catalogue['title'] }}</a>

                <label for="catalogue-file-{{ $index }}" class="admin-image-wrapper d-flex">
                    <img class="ajax-image pdf_icon" src="{{ asset('images/svg_icons/pdf_icon.png') }}" alt="Pdf">
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="application/pdf" class="ajax-input d-none" name="catalogue_file[]" id="catalogue-file-{{ $index }}">
                    <input type="hidden" name="existing_catalogue_file[]" value="{{ $catalogue['link'] }}">
                </label>

                <input type="hidden" name="amount_of_catalogues[]" value="{{ $index }}">
                <input type="hidden" name="catalogue_title[]" id="catalogue-title-{{ $index }}" value="{{ $catalogue['title'] }}">
            </div>
        @endforeach
    </div>
</div>