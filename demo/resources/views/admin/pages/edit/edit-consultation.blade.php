@php
    use App\Http\Controllers\HelpersCT;

    $locale_array = [
        'ka',
        'en',
    ];

    $cleaning_buttons = [
        'ka' => 'ქართული',
        'en' => 'ინგლისური',
    ];
@endphp

<button type="button" class="split-button mb-3" id="add-consultation-service">
    <span class="w-100">დამატება</span>
</button>

@foreach ($locale_array as $locale_index => $locale)
    <button class="locale-collapser" type="button" data-toggle="collapse" data-target="#{{ $locale }}-consultation-services" aria-expanded="{{ $locale_index == 0 ? 'true' : 'false' }}" aria-controls="{{ $locale }}-consultation-services">
        <span>{{ $cleaning_buttons[$locale] }}</span>
        <span class="dire-right-arrow-s"></span>
    </button>

    <div id="{{ $locale }}-consultation-services" class="collapse {{ $locale_index == 0 ? 'show' : '' }}">
        <div class="services-wrapper consultation-wrapper">
            <div class="services">
                @foreach ($data['content'] as $index => $db_service)                    
                    <div class="admin-service-wrapper">
                        <div class="important-text-wrapper my-3">
                            <h5 class="important-text" contenteditable="true" data-text-to-value="#title-{{ $locale .'-'. $index }}">{{ $db_service['title_' . $locale] }}</h5>
                            <button class="btn btn-danger remove-this-service" type="button">სერვისის წაშლა</button>
                        </div>

                        <div class="consultation-service">
                            <div class="service-left">
                                <ul class="service-list">
                                    <textarea class="text-editor" name="description_{{ $locale }}[]">{!! $db_service['description_' . $locale] !!}</textarea>
                                </ul>
                            </div>

                            @if ( $locale == 'ka' )
                                <div class="service-right">
                                    <span class="service-price" contenteditable="true" data-numbers-only="true" data-text-to-value="#price-{{ $index }}">{{ $db_service['price'] }}<span class="dire-lari"></span></span>
                                </div>
                            @endif
                        </div>

                        @if ( HelpersCT::is_admin() && $locale == 'ka' )
                            <div class="metrix-selector-wrapper my-3">
                                <select class="form-control" name="group" required>
                                    <option disabled value="">აირჩიეთ კატეგორია</option>
                                    <option value="design">დიზაინის ჯგუფი</option>
                                    <option value="repairs">რემონტის ჯგუფი</option>
                                    <option value="furniture">ავეჯის ჯგუფი</option>
                                </select>
                            </div>
                        @endif

                        <input id="title-{{ $locale .'-'. $index }}" type="hidden" name="title_{{ $locale }}[]" value="{{ $db_service['title_' . $locale] }}">
                        @if ( $locale == 'ka' )
                            <input id="price-{{ $index }}" type="hidden" name="price[]" value="{{ $db_service['price'] }}">
                            <input type="hidden" name="amount_of_services[]" value="{{ $index }}">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach