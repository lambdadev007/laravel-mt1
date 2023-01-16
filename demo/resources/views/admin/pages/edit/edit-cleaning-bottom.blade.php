@php
    $locale_array = [
        'ka',
        'en',
    ];

    $cleaning_buttons = [
        'ka' => 'ქართული',
        'en' => 'ინგლისური',
    ];
@endphp
    
{{-- Services + Modal --}}
    <div class="services-wrapper cleaning-wrapper">
        <div class="services">
            {{-- Bottom Services --}}
                @foreach ($locale_array as $locale_index => $locale)
                    <button class="locale-collapser" type="button" data-toggle="collapse" data-target="#{{ $locale }}-bottom-services" aria-expanded="{{ $locale_index == 0 ? 'true' : 'false' }}" aria-controls="{{ $locale }}-bottom-services">
                        <span>{{ $cleaning_buttons[$locale] }}</span>
                        <span class="dire-right-arrow-s"></span>
                    </button>

                    <div id="{{ $locale }}-bottom-services" class="collapse {{ $locale_index == 0 ? 'show' : '' }}">
                        <div class="cleaning-bottom-wrapper">
                            <div class="bottom-services {{ $locale }} w-100">
                                @if ( $locale == 'ka' )
                                    <button type="button" class="add-bottom-service split-button w-100 mb-3"data-locale="{{ $locale }}">
                                        <span class="w-100">სერვისის დამატება</span>
                                    </button>
                                @endif

                                @foreach ($data['bottom_services'] as $bottom_service)
                                    <div class="bottom-service {{ $bottom_service['id'] }}">
                                        @if ( $locale == 'ka' )
                                            <button type="button" class="remove-this-bottom-service btn btn-danger" data-id="{{ $bottom_service['id'] }}">X</button>
                                        @endif
                                        <div class="top">
                                            <div class="important-text-wrapper">
                                                <h5 contenteditable="true" data-text-to-value="#{{ $locale_index }}-{{ $bottom_service['id'] }}-title" class="important-text">{{ $bottom_service['title_' . $locale] }}</h5>
                                                <input type="hidden" id="{{ $locale_index }}-{{ $bottom_service['id'] }}-title" name="bottom_service_titles_{{ $locale }}[]"  value="{{ $bottom_service['title_' . $locale] }}">
                                            </div>
                                            <div class="dire-down-arrow-s"></div>
                                        </div>

                                        <div class="bottom">
                                            <div contenteditable="true" data-text-to-value="#{{ $locale_index }}-{{ $bottom_service['id'] }}-description" class="left">{{ $bottom_service['description_' . $locale] }}</div>
                                            <input type="hidden" id="{{ $locale_index }}-{{ $bottom_service['id'] }}-description" name="bottom_service_descriptions_{{ $locale }}[]" value="{{ $bottom_service['description_' . $locale] }}">

                                            @if ( $locale == 'ka' )
                                                <div class="right">
                                                    <div class="cleaning-service-price-wrapper">
                                                        <span class="area">ფასი: 1 კვ.მ</span>
                                                        <span contenteditable="true" data-text-to-value="#{{ $locale_index }}-{{ $bottom_service['id'] }}-price" class="{{ $locale_index }}-{{ $bottom_service['id'] }}-price">{{ $bottom_service['price'] }}</span>
                                                        <input type="hidden" id="{{ $locale_index }}-{{ $bottom_service['id'] }}-price" name="bottom_prices[]" value="{{ $bottom_service['price'] }}">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <input type="hidden" name="amount_of_bottom_services[]" value="{{ $bottom_service['id'] }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            {{-- Bottom Services --}}
        </div>
    </div>
{{-- Services + Modal --}}