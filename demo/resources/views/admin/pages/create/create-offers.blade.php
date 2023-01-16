{{-- Divider Line --}}
    <div class="my-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

<div class="form-section">
    <h5>ქარდის სურათი / არ არის აუცილებელი / ზომები 430x240</h5>
    <div class="special-offers-wrapper">
        <div class="offer-card-wrapper">
            <span class="offer-validity">ძალაშია:</span>
            <div class="offer-banner-container">
                <label for="offer-card-image" class="admin-image-wrapper">
                    <img class="ajax-image" src="{{ asset('images/temp/upload.jpg') }}">
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="card_image" id="offer-card-image">
                </label>
            </div>
            <div class="offer-footer">
                <a id="offer-footer-text" contenteditable="true" data-text-to-text="#form-offer-footer-title" data-text-to-value="#form-offer-footer-title-input" onclick="function(e){e.preventDefault()}">სათაური</a>
                <a onclick="function(e){e.preventDefault()}" class="metrix-button metrix-button-light"><span class="dire-right-arrow"></span></a>
            </div>
        </div>
    </div>
</div>

<div class="offer-wrapper">
    <div class="offer-left-section">
        <div class="offer-image">
            <label for="offer-header-image" class="admin-image-wrapper">
                <img class="ajax-image" src="{{ asset('images/temp/upload.jpg') }}">
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="image" id="offer-header-image">
            </label>
        </div>
    </div>

    <span class="offer-right-section">
        <h2 class="offer-title" id="form-offer-footer-title" contenteditable="true" data-text-to-text="#offer-footer-text" data-text-to-value="#form-offer-footer-title-input">სათაური</h2>
        <span class="offer-validity">ძალაშია: <input class="form-control datepicker-location" type="text" name="valid" placeholder="დააწექით კალენდარი რომ გამოვიდეს" autocomplete="off" required></span>
        <div class="offer-description">
            <h4>აქციის პირობები</h4>
            <textarea name="description" class="text-editor"><p>აღწერა</p></textarea>
        </div>
        <input class="form-control" id="form-offer-footer-title-input" type="hidden" name="title" value="სათაური">
    </span>
</div>