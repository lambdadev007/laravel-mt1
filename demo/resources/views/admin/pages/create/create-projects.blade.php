{{-- Divider Line --}}
    <div class="my-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

<div class="form-section">
    <h5 class="mb-3">ქარდის სურათი / ზომები 320x240 / სტატუსი აქვე შეცვალეთ</h5>
    <div class="projects-wrapper">
        <div class="project-card">
            <div class="views">0 ნახვა</div>
            <div class="status" contenteditable="true" data-text-to-value="#status-input">სტატუსი</div>
            <input type="hidden" id="status-input" name="status" value="სტატუსი">
            <div class="project-card-image-wrapper">
                <label for="main-project-image" class="admin-image-wrapper d-flex">
                    <img class="ajax-image" src="{{ asset('images/temp/upload.jpg') }}">
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="card_image" id="main-project-image">
                </label>
            </div>
            <div class="project-card-title" contenteditable="true" data-text-to-value="#project-title" data-text-to-text="#project-title">სათაური</div>
        </div>
    </div>
</div>

{{-- Divider Line --}}
    <div class="my-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

<div class="form-section">
    <div class="slides-collapse-wrapper">
        <button class="slides-collapse" type="button" data-toggle="collapse" data-target="#slides" aria-expanded="true" aria-controls="slides">
            <span>სლაიდები / შეფარდება: 8:6</span>
            <span class="dire-right-arrow-s"></span>
        </button>

        <div class="collapse show" id="slides">
            <div class="d-flex">
                <button class="add-slide btn btn-primary w-100" type="button">სლაიდის დამატება</button>
            </div>
            
            <div class="row">
            </div>
        </div>
    </div>
</div>

{{-- Divider Line --}}
    <div class="my-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

{{-- Project Content --}}
    <div class="project-wrapper">
        <div class="project-right-section">
            <h2 id="project-title" contenteditable="true" data-text-to-value="#project-title" data-text-to-text=".project-card-title">სათაური</h2>
            <input id="project-title-input" type="hidden" name="title" value="სათაური">

            {{-- Project Data --}}
                <div class="project-data-wrapper">
                    <span class="project-data-uncolored">
                        <span class="dire-pin"></span>
                        მდებარეობა:
                    </span>
                    <span class="project-data-colored">
                        <input type="text" name="location" placeholder="არ არის აუცილებელი">
                        <label for="project-location">
                            <span>დამალვა</span>
                            <input type="checkbox" id="project-location" data-project-hide="location">
                        </label>
                    </span>
                </div>

                <div class="project-data-wrapper">
                    <span class="project-data-uncolored">
                        <span class="dire-area"></span>
                        ფართობი:
                    </span>
                    <span class="project-data-colored">
                        <input class="mr-3" type="number" name="area" placeholder="არ არის აუცილებელი"> 
                        კვ. მ 
                        <label for="project-area">
                            <span>დამალვა</span>
                            <input type="checkbox" id="project-area" data-project-hide="area">
                        </label>
                    </span>
                </div>

                <div class="project-data-wrapper">
                    <span class="project-data-uncolored">
                        <span class="dire-clock"></span>
                        ხანგრძლივობა:
                    </span>
                    <span class="project-data-colored">
                        <input class="mr-3" type="number" name="duration" placeholder="არ არის აუცილებელი">
                        სამუშაო დღე 
                        <label for="project-duration">
                            <span>დამალვა</span>
                            <input type="checkbox" id="project-duration" data-project-hide="duration">
                        </label>
                    </span>
                </div>

                <div class="project-data-wrapper">
                    <span class="project-data-uncolored">
                        <span class="dire-date"></span>
                        დაწყება-დასრულება:
                    </span>
                    <span class="project-data-colored">
                        <input class="datepicker-location" type="text" name="starts" placeholder="დააწექით კალენდარი რომ გამოვიდეს" autocomplete="off">
                        /
                        <input class="datepicker-location" type="text" name="ends" placeholder="არ არის აუცილებელი" autocomplete="off"> 
                        <label for="project-start_end">
                            <span>დამალვა</span>
                            <input type="checkbox" id="project-start_end" data-project-hide="start_end">
                        </label>
                    </span>
                </div>
            {{-- Project Data --}}

            {{-- Project Price --}}
                <div class="project-price-wrapper">
                    <span>ღირებულება</span>
                    <div>
                        <input type="number" name="price" placeholder="არ არის აუცილებელი">
                        <span class="dire-lari"></span> 
                        <label for="project-price">
                            <span>დამალვა</span>
                            <input type="checkbox" id="project-price" data-project-hide="price">
                        </label>
                    </div>
                </div>
            {{-- Project Price --}}

            {{-- Project Materials Used --}}
                <div class="project-materials-wrapper">
                    <span>
                        დამატებითი კომენტარი
                        <label for="project-materials">
                            <span>დამალვა</span>
                            <input type="checkbox" id="project-materials" data-project-hide="materials" >
                        </label>
                    </span>
                </div>
                <textarea class="text-editor" name="materials"><p>თქვენი კომენტარი</p></textarea>
            {{-- Project Materials Used --}}

            {{-- Project Hide --}}
                <input type="hidden" name="hidden_fields">
            {{-- Project Hide --}}
        </div>
    </div>
{{-- Project Content --}}