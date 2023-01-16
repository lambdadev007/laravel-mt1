<h5 class="my-4 text-center">დააჭირეთ სურათი რომ შეცვალოთ / რეკომენდირებული ასპექტია 16:9</h5>

<div class="furniture-wrapper">
    <div class="furniture-links-wrapper">
        <button type="button" data-category="kitchen"           {{ $data['category'] == 'kitchen'           ? 'class="active"' : '' }}>სამზარეულო</button>
        <button type="button" data-category="reception"         {{ $data['category'] == 'reception'         ? 'class="active"' : '' }}>მისაღები</button>
        <button type="button" data-category="sleeping_room"     {{ $data['category'] == 'sleeping_room'     ? 'class="active"' : '' }}>საძინებელი</button>
        <button type="button" data-category="childrens_room"    {{ $data['category'] == 'childrens_room'    ? 'class="active"' : '' }}>საბავშვო</button>
        <button type="button" data-category="office_furniture"  {{ $data['category'] == 'office_furniture'  ? 'class="active"' : '' }}>საოფისე</button>
        <button type="button" data-category="soft_furniture"    {{ $data['category'] == 'soft_furniture'    ? 'class="active"' : '' }}>რბილი ავეჯი</button>
    </div>
</div>

<button type="button" class="split-button mt-3" id="add-furniture-gallery-image" data-category="kitchen">
    <span class="w-100">სურათის დამატება</span>
</button>

<div class="furniture-gallery-wrapper">
    <div class="furniture-gallery">
        @foreach ($data['gallery'] as $index => $gallery)
            <div class="furniture-gallery-item {{ $gallery['category'] }} {{ $gallery['category'] == 'kitchen' ? 'show' : '' }}">
                <button type="button" class="remove-this-gallery-item">X</button>
                <label for="gallery-image-{{ $index }}" class="admin-image-wrapper d-flex">
                    <img class="ajax-image w-100" src="{{ asset($gallery['image']) }}">
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="gallery_images[]" id="gallery-image-{{ $index }}">
                    <input type="hidden" name="category[]" value="{{ $gallery['category'] }}">
                    <input type="hidden" name="existing_gallery_image[]" value="{{ $gallery['image'] }}">
                    <input type="hidden" name="amount_of_images[]" value="{{ $index }}">
                </label>
            </div>
        @endforeach
    </div>
</div>