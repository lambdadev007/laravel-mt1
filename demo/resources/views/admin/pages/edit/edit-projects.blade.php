{{-- Divider Line --}}
    <div class="my-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

<div class="form-section">
    <h5 class="mb-3">ქარდის სურათი / ზომები: 320x240 პიქსელი</h5>
    <div class="projects-wrapper">
        <div class="project-card">
            <div class="views">{{ $data['views'] }} ნახვა</div>
            <div class="status" contenteditable="true" data-text-to-value="#status-input">{{ $data['status'] }}</div>
            <input type="hidden" id="status-input" name="status" value="{{ $data['status'] }}">
            <div class="project-card-image-wrapper">
                <label for="main-project-image" class="admin-image-wrapper d-flex">
                    <img class="ajax-image mx-auto" src="{{ ($data['card_image'] != null) ? asset($data['card_image']) : asset('images/temp/no-image.jpg') }}">
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="card_image" id="main-project-image">
                </label>
            </div>
            <div class="project-card-title" contenteditable="true" data-text-to-value="#project-title-input" data-text-to-text="#project-title">{{ $data['title'] }}</div>
        </div>
    </div>
</div>

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
                @foreach ($slides as $index => $slide)
                    <div class="slide-wrapper col-sm-12 col-md-6 my-3">
                        <button type="button" class="remove-this-slide btn btn-danger rounded-0">x</button>

                        <input type="hidden" name="amount_of_slides[]" value="{{ $index }}">

                        <label for="slide-{{ $index }}" class="admin-image-wrapper d-flex">
                            <img class="ajax-image w-100" src="{{ ($slide != null) ? asset($slide) : asset('images/temp/no-image.jpg') }}">
                            <span class="hover-edit-notifier">
                                <span class="dire-edit"></span>
                            </span>
                            <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="slides[]" id="slide-{{ $index }}">
                            <input type="hidden" name="existing_slide[]" value="{{ $slide }}">
                        </label>
                    </div>
                @endforeach
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
            <h2 id="project-title" contenteditable="true" data-text-to-value="#project-title" data-text-to-text=".project-card-title">{{ $data['title'] }}</h2>
            <input id="project-title-input" type="hidden" name="title" value="{{ $data['title'] }}">

            {{-- Project Data --}}
                <div class="project-data-wrapper">
                    <span class="project-data-uncolored">
                        <span class="dire-pin"></span>
                        მდებარეობა:
                    </span>
                    <span class="project-data-colored">
                        <input type="text" value="{{ $data['location'] }}" name="location" placeholder="არ არის აუცილებელი">
                        <label for="project-location">
                            <span class="{{ in_array('location', $hidden_fields) ? 'active' : '' }}">{{ in_array('location', $hidden_fields) ? 'გამოჩენა' : 'დამალვა' }}</span>
                            <input type="checkbox" id="project-location" data-project-hide="location" {{ in_array('location', $hidden_fields) ? 'checked' : '' }}>
                        </label>
                    </span>
                </div>

                <div class="project-data-wrapper">
                    <span class="project-data-uncolored">
                        <span class="dire-area"></span>
                        ფართობი:
                    </span>
                    <span class="project-data-colored">
                        <input class="mr-3" type="number" value="{{ $data['area'] }}" name="area" placeholder="არ არის აუცილებელი"> 
                        კვ. მ
                        <label for="project-area">
                            <span class="{{ in_array('area', $hidden_fields) ? 'active' : '' }}">{{ in_array('area', $hidden_fields) ? 'გამოჩენა' : 'დამალვა' }}</span>
                            <input type="checkbox" id="project-area" data-project-hide="area" {{ in_array('area', $hidden_fields) ? 'checked' : '' }}>
                        </label>
                    </span>
                </div>

                <div class="project-data-wrapper">
                    <span class="project-data-uncolored">
                        <span class="dire-clock"></span>
                        ხანგრძლივობა:
                    </span>
                    <span class="project-data-colored">
                        <input class="mr-3" type="number" value="{{ $data['duration'] }}" name="duration" placeholder="არ არის აუცილებელი"> 
                        სამუშაო დღე
                        <label for="project-duration">
                            <span class="{{ in_array('duration', $hidden_fields) ? 'active' : '' }}">{{ in_array('duration', $hidden_fields) ? 'გამოჩენა' : 'დამალვა' }}</span>
                            <input type="checkbox" id="project-duration" data-project-hide="duration" {{ in_array('duration', $hidden_fields) ? 'checked' : '' }}>
                        </label>
                    </span>
                </div>

                <div class="project-data-wrapper">
                    <span class="project-data-uncolored">
                        <span class="dire-date"></span>
                        დაწყება-დასრულება:
                    </span>
                    <span class="project-data-colored">
                        <input class="datepicker-location" type="text" name="starts" value="{{ $data['starts'] }}" placeholder="დააწექით კალენდარი რომ გამოვიდეს" autocomplete="off">
                        /
                        <input class="datepicker-location" type="text" name="ends" value="{{ $data['ends'] }}" placeholder="არ არის აუცილებელი" autocomplete="off">
                        <label for="project-start_end">
                            <span class="{{ in_array('start_end', $hidden_fields) ? 'active' : '' }}">{{ in_array('start_end', $hidden_fields) ? 'გამოჩენა' : 'დამალვა' }}</span>
                            <input type="checkbox" id="project-start_end" data-project-hide="start_end" {{ in_array('start_end', $hidden_fields) ? 'checked' : '' }}>
                        </label>
                    </span>
                </div>
            {{-- Project Data --}}

            {{-- Project Price --}}
                <div class="project-price-wrapper">
                    <span>ღირებულება</span>
                    <div>
                        <input type="number" name="price" placeholder="არ არის აუცილებელი" value="{{ $data['price'] }}">
                        <span class="dire-lari"></span> 
                        <label for="project-price">
                            <span class="{{ in_array('price', $hidden_fields) ? 'active' : '' }}">{{ in_array('price', $hidden_fields) ? 'გამოჩენა' : 'დამალვა' }}</span>
                            <input type="checkbox" id="project-price" data-project-hide="price" {{ in_array('price', $hidden_fields) ? 'checked' : '' }}>
                        </label>
                    </div>
                </div>
            {{-- Project Price --}}

            {{-- Project Materials Used --}}
                <div class="project-materials-wrapper">
                    <span>
                        დამატებითი კომენტარი
                        <label for="project-materials">
                            <span class="{{ in_array('materials', $hidden_fields) ? 'active' : '' }}">{{ in_array('materials', $hidden_fields) ? 'გამოჩენა' : 'დამალვა' }}</span>
                            <input type="checkbox" id="project-materials" data-project-hide="materials" {{ in_array('materials', $hidden_fields) ? 'checked' : '' }}>
                        </label>
                    </span>
                </div>
                <textarea class="text-editor" name="materials" cols="30" rows="10">{!! $data['materials'] !!}</textarea>
            {{-- Project Materials Used --}}

            {{-- Project Hide --}}
                <input type="hidden" name="hidden_fields" value="{{ $data['hidden_fields'] }}">
            {{-- Project Hide --}}
        </div>
    </div>
{{-- Project Content --}}