@php
    $locale_array = [
        'ka',
        'en',
    ];

    $cleaning_buttons = [
        'ka' => 'ქართული',
        'en' => 'ინგლისური',
    ];

    $category_array = [
        'after-renovation',
        'during-renovation',
        'facade-cleaning',
        'window-cleaning',
        'every-day-cleaning',
        'complex-cleaning',
        'cleaner-woman',
    ];
@endphp
    
{{-- Services + Modal --}}
    <div class="services-wrapper cleaning-wrapper">
        <div class="services">
            {{-- Navigation --}}
                <div class="services-top-section">
                    <div class="jumper-navigation">
                        <div class="top">
                            <button type="button" class="active" data-category="after-renovation">    <span class="dire-after_renovation"></span>     </button>
                            <button type="button" class="" data-category="during-renovation">         <span class="dire-during_renovation"></span>    </button>
                            <button type="button" class="" data-category="facade-cleaning">           <span class="dire-facade_cleaning"></span>      </button>
                            <button type="button" class="" data-category="window-cleaning">           <span class="dire-window_cleaning"></span>      </button>
                            <button type="button" class="" data-category="every-day-cleaning">        <span class="dire-every_day_cleaning"></span>   </button>
                            <button type="button" class="" data-category="complex-cleaning">          <span class="dire-complex_cleaning"></span>     </button>
                            <button type="button" class="" data-category="cleaner-woman">             <span class="dire-cleaner_woman"></span>        </button>
                        </div>
                    </div>
                </div>
            {{-- Navigation --}}

            {{-- Top Services --}}
                @foreach ($locale_array as $locale_index => $locale)
                    <button class="locale-collapser" type="button" data-toggle="collapse" data-target="#{{ $locale }}-top-services" aria-expanded="{{ $locale_index == 0 ? 'true' : 'false' }}" aria-controls="{{ $locale }}-top-services">
                        <span>{{ $cleaning_buttons[$locale] }}</span>
                        <span class="dire-right-arrow-s"></span>
                    </button>

                    <div id="{{ $locale }}-top-services" class="collapse {{ $locale_index == 0 ? 'show' : '' }}">
                        <div class="top-services">
                            @foreach ($category_array as $category_index => $category)
                                @if ( $data['top_services'][$category] != [] )
                                    @foreach ($data['top_services'][$category] as $top_service_index => $top_service)
                                        <div class="top-service {{ $category }} {{ $category_index == 0 ? 'show' : '' }}">
                                            <div class="left">
                                                @if ( $locale == 'ka' )
                                                    <label for="top-service-image-{{ $category }}" class="admin-image-wrapper d-flex">
                                                        <img class="ajax-image w-100" src="{{ asset($top_service['image']) }}">
                                                        <span class="hover-edit-notifier">
                                                            <span class="dire-edit"></span>
                                                        </span>
                                                        <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="top_service_images[]" id="top-service-image-{{ $category }}">
                                                        <input type="hidden" name="existing_top_service_image[]" value="{{ $top_service['image'] }}">
                                                    </label>
                                                @else 
                                                    <img src="{{ asset($top_service['image']) }}">
                                                @endif
                                            </div>

                                            <div class="right">
                                                <div class="important-text-wrapper">
                                                    <h5 contenteditable="true" data-text-to-value="#{{ $category . '-' . $locale }}-title" class="important-text">{{ $top_service['title_' . $locale] }}</h5>
                                                    <input type="hidden" id="{{ $category . '-' . $locale }}-title" name="top_titles_{{ $locale }}[]" value="{{ $top_service['title_' . $locale] }}">
                                                </div>

                                                <textarea name="top_descriptions_{{ $locale }}[]" class="text-editor">{{ $top_service['description_' . $locale] }}</textarea>

                                                @if ( $locale == 'ka' )
                                                    <div class="cleaning-service-price-wrapper">
                                                        <div class="top-area-price">
                                                            <span class="area">ფასი: 1 კვ.მ</span>
                                                            <span contenteditable="true" data-text-to-value="#{{ $category }}-price" class="price">{{ $top_service['price'] }}</span></span>
                                                        </div>
                                                        <input type="hidden" id="{{ $category }}-price" name="top_prices[]" value="{{ $top_service['price'] }}">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="top-service {{ $category }} {{ $category_index == 0 ? 'show' : '' }}">
                                        <div class="left">
                                            @if ( $locale == 'ka' )
                                                <label for="top-service-image-{{ $category }}" class="admin-image-wrapper d-flex">
                                                    <img class="ajax-image w-100" src="{{ asset('images/temp/no-image.jpg') }}">
                                                    <span class="hover-edit-notifier">
                                                        <span class="dire-edit"></span>
                                                    </span>
                                                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="top_service_images[]" id="top-service-image-{{ $category }}">
                                                    <input type="hidden" name="existing_top_service_image[]" value="{{ 'images/temp/no-image.jpg' }}">
                                                </label>
                                            @else 
                                                <img src="{{ asset('images/temp/no-image.jpg') }}">
                                            @endif
                                        </div>

                                        <div class="right">
                                            <div class="important-text-wrapper">
                                                <h5 contenteditable="true" class="important-text">სათაური</h5>
                                                <input type="hidden" id="{{ $category . '-' . $locale }}-title" name="top_titles_{{ $locale }}[]" value="სათაური">
                                            </div>

                                            <textarea name="top_descriptions_{{ $locale }}[]" class="text-editor">აღწერა</textarea>

                                            @if ( $locale == 'ka' )
                                                <div class="cleaning-service-price-wrapper">
                                                    <span class="area">ფასი: 1 კვ.მ</span>
                                                    <span contenteditable="true" data-text-to-value="#{{ $category }}-price" class="price">0</span></span>
                                                    <input type="hidden" id="{{ $category }}-price" name="top_prices[]" value="0">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            {{-- Top Services --}}
        </div>
    </div>
{{-- Services + Modal --}}