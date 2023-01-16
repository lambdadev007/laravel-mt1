{{-- Repairs Ad --}}
    <div class="form-section remove-on-mobile">
        <h5 class="mb-3 text-center">დააჭირეთ მარცხენა სურათს რომ შეცვალოთ / სურათის სიმაღლე უნდა იყოს 350 პიქსელი</h5>
        <div class="universal-slider">
            <div class="static-image">
                <label for="repairs-advert" class="admin-image-wrapper d-flex">
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
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="repairs_advert" id="repairs-advert">
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
{{-- Repairs Ad --}}

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

<div class="repairs-wrapper">
    <h5 class="mb-4 text-center">დააჭირეთ ტექსტი რომ შეცვალოთ</h5>
    {{-- Colored Sections --}}
        <div class="row">
            @foreach (['first', 'second', 'third'] as $numbers_index => $numbers)
                <div class="{{ $numbers }} col-sm-12 col-md-4">
                    <div class="category-wrapper">
                        @if ( array_key_exists($numbers_index, $data['category']) )
                            <h5 contenteditable="true" data-text-to-value="#{{ $numbers }}-category-title">{{ $data['category'][$numbers_index]['title'] }}</h5>
                            <span contenteditable="true" data-text-to-value="#{{ $numbers }}-category-price">{{ $data['category'][$numbers_index]['price'] }}</span>
                            <p contenteditable="true" data-text-to-value="#{{ $numbers }}-category-description">{{ $data['category'][$numbers_index]['description'] }}</p>

                            <input type="hidden" id="{{ $numbers }}-category-title" name="category_title[]" value="{{ $data['category'][$numbers_index]['title'] }}">
                            <input type="hidden" id="{{ $numbers }}-category-price" name="category_price[]" value="{{ $data['category'][$numbers_index]['price'] }}">
                            <input type="hidden" id="{{ $numbers }}-category-description" name="category_description[]" value="{{ $data['category'][$numbers_index]['description'] }}">
                        @else
                            <h5 contenteditable="true" data-text-to-value="#{{ $numbers }}-category-title">სათაური</h5>
                            <span contenteditable="true" data-text-to-value="#{{ $numbers }}-category-price">ფასი</span>
                            <p contenteditable="true" data-text-to-value="#{{ $numbers }}-category-description">აღწერა</p>

                            <input type="hidden" id="{{ $numbers }}-category-title" name="category_title[]" value="სათაური">
                            <input type="hidden" id="{{ $numbers }}-category-price" name="category_price[]" value="0">
                            <input type="hidden" id="{{ $numbers }}-category-description" name="category_description[]" value="აღწერა">
                        @endif
                    </div>
                    
                    <div class="sub-category-wrapper">
                        <button type="button" class="split-button add-sub-category" data-segment="{{ $numbers }}">
                            <span class="w-100">ქვე კატეგორიის დამატება</span>
                        </button>

                        @foreach ($data['sub_category'][$numbers] as $sub_category_index => $sub_category)                                        
                            <div class="sub-category" data-sub-category-has="{{ $sub_category['has'] }}">
                                <button type="button" class="remove-this-sub-category">x</button>

                                <span contenteditable="true" data-text-to-value="#{{ $numbers }}-sub-category-title-{{ $sub_category_index }}" class="title">{{ $sub_category['title'] }}</span>

                                <div class="sub-category-text-wrapper">
                                    <button type="button" class="split-button w-100 add-sub-category-text">
                                        <span class="w-100">ტექსტის დამატება</span>
                                    </button>

                                    @foreach ($data['sub_category_text'] as $sub_category_text_index => $sub_category_text)
                                        @if ( $sub_category['has'] == $sub_category_text['belongs'] )
                                            <div class="sub-category-text">
                                                <button class="remove-this-sub-category-text">x</button>
                                                <span contenteditable="true" data-text-to-value="#sub-category-text-{{ $sub_category_text_index }}">{{ $sub_category_text['description'] }}</span>
                                                <input type="hidden" id="sub-category-text-{{ $sub_category_text_index }}" name="sub_category_descriptions[]" value="{{ $sub_category_text['description'] }}">
                                                <input type="hidden" name="sub_section_text_belongs[]" value="{{ $sub_category_text['belongs'] }}">
                                                <input type="hidden" name="amount_of_sub_section_texts[]" value="{{ $sub_category_text_index }}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <input type="hidden" id="{{ $numbers }}-sub-category-title-{{ $sub_category_index }}" name="{{ $numbers }}_sub_category_title[]" value="{{ $sub_category['title'] }}">
                                <input type="hidden" name="{{ $numbers }}_sub_sections_has[]" value="{{ $sub_category['has'] }}">
                                <input type="hidden" name="amount_of_{{ $numbers }}_sub_sections[]" value="{{ $sub_category_index }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    {{-- Colored Sections --}}

    <div class="important-text-wrapper my-3">
        <span class="important-text mx-auto">ხელობის ფასები</span>
    </div>

    {{-- Info Box --}}
        <div class="info-box-wrapper">
            <div class="info-box-top repairs">
                <span>სამუშაოს ტიპი</span>
                <span>აღწერა</span>
                <span>საშუალოდ ფასი</span>
            </div>
            
            <button type="button" class="split-button mt-3">
                <span class="w-100">დამატება</span>
            </button>

            <div class="info-box-body">
                @foreach ($data['prices'] as $index => $price)
                    <div class="info-box">
                        <button type="button" class="remove-this-info-box">x</button>

                        <div class="info-box-bold">
                            <span contenteditable="true" data-text-to-value="#info-box-title-{{ $index }}">{{ $price['title'] }}</span>
                        </div>

                        <div class="info-box-text">
                            <p contenteditable="true" data-text-to-value="#info-box-description-{{ $index }}">{{ $price['description'] }}</p>
                        </div>

                        <div class="info-box-price">
                            <span contenteditable="true" data-text-to-value="#info-box-price-{{ $index }}">{{ $price['price'] }}</span>
                        </div>

                        <input type="hidden" name="amount_of_info_boxes[]" value="{{ $index }}">
                        <input type="hidden" name="info_box_title[]" id="info-box-title-{{ $index }}" value="{{ $price['title'] }}">
                        <input type="hidden" name="info_box_description[]" id="info-box-description-{{ $index }}" value="{{ $price['description'] }}">
                        <input type="hidden" name="info_box_price[]" id="info-box-price-{{ $index }}" value="{{ $price['price'] }}">
                    </div>
                @endforeach
            </div>
        </div>
    {{-- Info Box --}}
</div>