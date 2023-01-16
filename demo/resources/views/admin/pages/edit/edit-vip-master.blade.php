@php
    $category_array = [
        'door-window',
        'electricity',
        'pipes',
        'water-supply',
        'conditioning',
        'house-technic',
        'universal',
    ];

    $locale_array = [
        'ka',
        'en',
    ];

    $vip_master_buttons = [
        'ka' => 'ქართული',
        'en' => 'ინგლისური',
    ];
@endphp

{{-- Services + Modal --}}
    <div>
        <p>გამოყენების ინსტრუქცია:</p>
        <ol>
            <li>ქვე-კატეგორიების წაშლა ხდება მარტო ქართულ ენაში</li>
            <li>ქვე-კატეგორიის სერვისების წაშლა და ფასის შეცვლა ხდება მხოლოდ ქართულ ენაში</li>
            <li>ქვე-კატეგორიების და სერვისების დამატება ხდება მხოლოდ ქართულ ენაში</li>
            <li>დანარჩენ ენებში მხოლოდ იწერება თარგმნა</li>
            <li>მუშაობის გასამარტივებლად შეგიძლიათ</li>
        </ol>
    </div>

    <div class="services-wrapper vip-master-wrapper">
        <div class="trilingual-wrapper">
            @foreach ($locale_array as $locale_index => $locale)
                <button class="locale-collapser" type="button" data-toggle="collapse" data-target="#{{ $locale }}-services" aria-expanded="{{ $locale_index == 0 ? 'true' : 'false' }}" aria-controls="{{ $locale }}-services">
                    <span>{{ $vip_master_buttons[$locale] }}</span>
                    <span class="dire-right-arrow-s"></span>
                </button>

                <div id="{{ $locale }}-services" class="collapse {{ $locale_index == 0 ? 'show' : '' }}">
                    <div class="services">
                        {{-- Navigation --}}
                            <div class="services-top-section">
                                <div class="jumper-navigation">
                                    <div class="top">
                                        <button type="button" class="active" data-category="door-window"><span class="dire-door-window"></span></button>
                                        <button type="button" class="" data-category="electricity"><span class="dire-electricity"></span></button>
                                        <button type="button" class="" data-category="pipes"><span class="dire-pipes"></span></button>
                                        <button type="button" class="" data-category="water-supply"><span class="dire-water-suply"></span></button>
                                        <button type="button" class="" data-category="conditioning"><span class="dire-conditioning"></span></button>
                                        <button type="button" class="" data-category="house-technic"><span class="dire-house-technic"></span></button>
                                        <button type="button" class="" data-category="universal"><span class="dire-universal"></span></button>
                                    </div>

                                    <div class="bottom">
                                        <div class="important-text-wrapper door-window show">
                                            <h5 class="important-text mt-3">კარ-ფანჯარა და საკეტები</h5>
                                        </div>
                                        <div class="important-text-wrapper electricity">
                                            <h5 class="important-text mt-3">ელექტროობა</h5>
                                        </div>
                                        <div class="important-text-wrapper pipes">
                                            <h5 class="important-text mt-3">კანალიზაცია</h5>
                                        </div>
                                        <div class="important-text-wrapper water-supply">
                                            <h5 class="important-text mt-3">სანტექნიკა</h5>
                                        </div>
                                        <div class="important-text-wrapper conditioning">
                                            <h5 class="important-text mt-3">გათბობა / გაგრილება</h5>
                                        </div>
                                        <div class="important-text-wrapper house-technic">
                                            <h5 class="important-text mt-3">საყოფაცხოვრებო ტექნიკა</h5>
                                        </div>
                                        <div class="important-text-wrapper universal">
                                            <h5 class="important-text mt-3">უნივერსალური სამუშაოები</h5>
                                        </div>
                                        <div class="open-close">
                                            <button type="button" data-open-all-category="door-window">ყველას გახსნა</button> / <button type="button" data-close-all-category="door-window">ყვლას დახურვა</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- Navigation --}}

                        @foreach ($category_array as $category_index => $category)
                            <div class="categories {{ $category }} {{ $category_index == '0' ? 'show' : '' }}">
                                @if ( $locale == 'ka' )
                                    {{-- Add Sub-Category Button --}}
                                        <button type="button" class="add-sub-category split-button w-100 mb-3" data-sub-category-belongs="{{ $category }}">
                                            <span class="w-100 bg-success">ქვე-კატეგორიის დამატება</span>
                                        </button>
                                    {{-- Add Sub-Category Button --}}
                                @endif

                                @foreach ($data['categories'][$category] as $sub_category)
                                    <div class="sub-category show {{ $sub_category['id'] }}">
                                        <div class="top">
                                            <h5 contenteditable="true" data-text-to-value="#sub_category_title_{{ $locale }}_{{ $sub_category['id'] }}">{{ $sub_category['title_' . $locale] != null ?  $sub_category['title_' . $locale] : 'ქვე-კატეგორია' }}</h5>
                                            @if ( $locale == 'ka' )
                                                <button type="button" class="remove-this-sub-category btn btn-danger" data-remove-id="{{ $sub_category['id'] }}">X</button>
                                            @endif
                                        </div>

                                        <div class="bottom">
                                            @if ( $locale == 'ka' )
                                                {{-- Add Service Button --}}
                                                    <button type="button" class="add-service split-button w-100 mt-3" data-service-belongs="{{ $sub_category['has'] }}" data-append-id="{{ $sub_category['id'] }}">
                                                        <span class="w-100 bg-primary">სერვისის დამატება</span>
                                                    </button>
                                                {{-- Add Service Button --}}
                                            @endif

                                            @foreach ($data['services'] as $db_service)
                                                @if ( $db_service['belongs'] == $sub_category['has'] )
                                                    <div class="vip-master-service {{ $db_service['id'] }}">
                                                        <div class="service-left">
                                                            <span contenteditable="true" data-text-to-value="#service-title-{{ $locale }}-{{ $db_service['id'] }}">{{ $db_service['title_' . $locale] != null ?  $db_service['title_' . $locale] : 'სერვისი' }}</span>
                                                        </div>

                                                        <div class="service-right">
                                                            @if ( $locale == 'ka' )
                                                                <span class="service-price {{ $db_service['id'] }}" contenteditable="true" data-text-to-value="#service-price-{{ $db_service['id'] }}">{{ $db_service['price'] }}</span></span> 
                                                                <button type="button" class="remove-this-service btn btn-danger" data-remove-id="{{ $db_service['id'] }}">X</button>
                                                            @endif
                                                        </div>

                                                        <input type="hidden" name="service_title_{{ $locale }}[]" value="{{ $db_service['title_' . $locale]}}" id="service-title-{{ $locale }}-{{ $db_service['id'] }}">
                                                        @if ( $locale == 'ka' )
                                                            <input type="hidden" name="service_price[]" value="{{ $db_service['price'] }}" id="service-price-{{ $db_service['id'] }}">
                                                            <input type="hidden" name="amount_of_services[]" value="{{ $db_service['id'] }}">
                                                            <input type="hidden" name="belongs_sub_category[]" value="{{ $db_service['belongs'] }}">
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <input type="hidden" name="sub_category_titles_{{ $locale }}[]" value="{{ $sub_category['title_' . $locale] }}" id="sub_category_title_{{ $locale }}_{{ $sub_category['id'] }}">
                                        @if ( $locale == 'ka' )
                                            <input type="hidden" name="amount_of_sub_categories[]" value="{{ $sub_category['id'] }}">
                                            <input type="hidden" name="belongs_category[]" value="{{ $sub_category['belongs'] }}">
                                            <input type="hidden" name="has[]" value="{{ $sub_category['has'] }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
{{-- Services + Modal --}}