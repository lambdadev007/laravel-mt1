{{-- Design Ad --}}
    <div class="form-section remove-on-mobile">
        <h5 class="mb-3 text-center">დააჭირეთ მარცხენა სურათს რომ შეცვალოთ / სურათის სიმაღლე უნდა იყოს 350 პიქსელი</h5>
        <div class="universal-slider">
            <div class="static-image">
                <label for="furniture-advert" class="admin-image-wrapper d-flex">
                    @if ( $data['advert'] != [] )
                        @foreach ( $data['advert'] as $advert )
                            <img class="ajax-image w-100" src="{{ asset($advert['image']) }}">
                        @endforeach
                    @else
                        <img class="ajax-image w-100" src="{{ asset('images/temp/no-image.jpg') }}">
                    @endif
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg, image/gif" class="ajax-input d-none" name="furniture_advert" id="furniture-advert">
                </label>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach ($data['slides'] as $slide)
                    <div class="carousel-block">
                        <img class="lazy" src="{{ asset($slide['image']) }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
{{-- Design Ad --}}

{{-- Divider Line --}}
    <div class="my-5 remove-on-mobile">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

{{-- Slides --}}
    <div class="form-section">
        <div class="slides-collapse-wrapper">
            <button class="slides-collapse" type="button" data-toggle="collapse" data-target="#slides" aria-expanded="true" aria-controls="slides">
                <span>სლაიდები / სურათის სიმაღლე უნდა იყოს 350 პიქსელი</span>
                <span class="dire-right-arrow-s"></span>
            </button>

            <div class="collapse show" id="slides">
                <div class="d-flex">
                    <button class="add-slide btn btn-primary w-100" type="button">სლაიდის დამატება</button>
                </div>
                
                <div class="row">
                    @foreach ($data['slides'] as $index => $slide)
                        <div class="slide-wrapper col-sm-12 col-md-6 my-3">
                            <button type="button" class="remove-this-slide btn btn-danger rounded-0">x</button>

                            <input type="hidden" name="amount_of_slides[]" value="{{ $index }}">

                            <label for="slide-{{ $index }}" class="admin-image-wrapper d-flex">
                                <img class="ajax-image w-100" src="{{ ($slide['image'] != null) ? asset($slide['image']) : asset('images/temp/no-image.jpg') }}">
                                <span class="hover-edit-notifier">
                                    <span class="dire-edit"></span>
                                </span>
                                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="slides[]" id="slide-{{ $index }}">
                                <input type="hidden" name="existing_slide[]" value="{{ $slide['image'] }}">
                            </label>

                            <input type="text" name="slide_link[]" value="{{ $slide['link'] }}" placeholder="ბმული">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
{{-- Slides --}}

{{-- Divider Line --}}
    <div class="my-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

{{-- Content --}}
    <h5 class="mb-3 text-center">მეტრიქსის უპირატესობები</h5>
    <div class="form-section">
        <div class="design-wrapper">
            <div class="design-top-section">
                <div class="design-information">
                    <ul class="category-selector">
                        <button type="button" class="split-button" id="add-design-category">
                            <span class="w-100">დამატება</span>
                        </button>
                        @foreach ($data['content'] as $index => $data_category)
                            <li class="{{ ($index == 0) ? 'active' : '' }}" data-index="{{ $index }}">
                                <input type="hidden" name="amount_of_sections[]" value="{{ $index }}">
                                <div style=""></div>
                                <span contenteditable="true" data-text-to-value="#category-input-{{ $index }}" data-text-to-text="#category-text-{{ $index }}" data-index="{{ $index }}">{{ $data_category['title'] }}</span>
                                <input type="hidden" id="category-input-{{ $index }}" name="title[]" value="{{ $data_category['title'] }}">
                                <button type="button" class="btn btn-danger" id="remove-design-category">X</button>
                            </li>
                        @endforeach
                    </ul>

                    <ul class="category-data">
                        @foreach ($data['content'] as $index => $data_content)
                            <li class="{{ ($index == 0) ? 'show' : '' }}" data-index="{{ $index }}">
                                <div class="important-text-wrapper">
                                    <h5 class="important-text" id="category-text-{{ $index }}"> {{ $data_content['title'] }} </h5>
                                </div>
                                <label for="design-header-image-{{ $index }}" class="admin-image-wrapper">
                                    <img class="ajax-image" src="{{ ($data_content['image'] != null) ? asset($data_content['image']) : asset('images/temp/no-image.jpg') }}">
                                    <span class="hover-edit-notifier">
                                        <span class="dire-edit"></span>
                                    </span>
                                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="image[]" id="design-header-image-{{ $index }}">
                                    <input type="hidden" name="existing_image[]" value="{{ $data_content['image'] }}">
                                </label>
                                <p>
                                    <textarea name="description[]" class="text-editor">{!! $data_content['description'] !!}</textarea>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
{{-- Content --}}

{{-- Divider Line --}}
    <div class="mt-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

<h5 class="my-4 text-center">დააჭირეთ სურათი რომ შეცვალოთ</h5>

<div class="furniture-wrapper">
    <div class="furniture-bottom-wrapper">
        <div>
            <label for="projects" class="admin-image-wrapper d-flex">
                <img class="ajax-image w-100" src="{{ asset('images/furniture/projects.jpg') }}">
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="projects_image" id="projects">
            </label>
            <a onclick="function(e){e.preventDefault()}">პროექტები და ნამუშევრები</a>
        </div>
        <div>
            <label for="furniture-and-materials" class="admin-image-wrapper d-flex">
                <img class="ajax-image w-100" src="{{ asset('images/furniture/furniture-and-materials.jpg') }}">
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="furniture_and_materials_image" id="furniture-and-materials">
            </label>
            <a onclick="function(e){e.preventDefault()}">ფურნიტურა და მასალები</a>
        </div>
    </div>
    <div class="furniture-bottom-links">
        <a class="split-button" href="/admin/pages/furniture-gallery">
            <span class="w-100">პროექტები და ნამუშევრები გვერდის რედაქტირება</span>
        </a>
        <a class="split-button" href="/admin/pages/furniture-materials">
            <span class="w-100">ფურნიტურა და მასალები გვერდის რედაქტირება</span>
        </a>
    </div>
</div>