@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'design'        => 'დიზაინის',
            'repairs'       => 'რემონტის',
            'furniture'     => 'ავეჯის',
            'cleaning'      => 'დასუფთავების',
            'team'          => 'ჯგუფი',
        ],
        'en' => [
            'design'        => 'Design',
            'repairs'       => 'Repairs',
            'furniture'     => 'Furniture',
            'cleaning'      => 'Cleaning',
            'team'          => 'Team',
        ]
    ];

    $locale_buttons = [
        'ka' => 'ქართულად',
        'en' => 'ინგლისურად'
    ];
@endphp

    @foreach (['ka', 'en'] as $locale_index => $locale)
        <button class="locale-collapser" type="button" data-toggle="collapse" data-target="#{{ $locale }}-contacts" aria-expanded="{{ $locale_index == 0 ? 'true' : 'false' }}" aria-controls="{{ $locale }}-contacts">
            <span>{{ $locale_buttons[$locale] }}</span>
            <span class="dire-right-arrow-s"></span>
        </button>

        <div id="{{ $locale }}-contacts" class="collapse {{ $locale_index == 0 ? 'show' : '' }}">
            <div class="contact-wrapper">
                <div class="contact-left-segment">
                    @foreach (['design', 'repairs', 'furniture', 'cleaning'] as $team)                    
                        <div class="contact-left-segment-section {{ $locale }} {{ $team }}">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5>{{ $TC->T($local, $team) .' '. $TC->T($local, 'team') }}</h5>
                                @if ($locale == 'ka')
                                    <button type="button" class="split-button add-contact" data-team="{{ $team }}">
                                        <span>დამატება</span>
                                    </button>
                                @endif
                            </div>
                            @foreach ($data[$team] as $index => $contact)  
                                <div class="contact-link-wrapper {{ $index }}">
                                    @if ($locale == 'ka')
                                        <div class="d-flex">
                                            <button type="button" class="remove-this-contact" data-remove="{{ $index }}">X</button>
                                            <a href="javascript:void(0)" contenteditable="true" data-text-to-value="#contact-number-{{ $index }}" data-numbers-only="true">{{ $contact['number'] }}</a>
                                        </div>

                                        <div class="d-flex">
                                            <span contenteditable="true" data-text-to-value="#contact-{{ $locale }}-profession-{{ $index }}">{{ $contact['profession_ka'] }}</span> 
                                            <span>:</span>
                                            <span contenteditable="true" data-text-to-value="#contact-{{ $locale }}-name-{{ $index }}"><b>{{ $contact['name_ka'] }}</b></span>
                                        </div>

                                        <input type="hidden" id="contact-number-{{ $index }}" name="number[]" value="{{ $contact['number'] }}">
                                        <input type="hidden" name="belongs[]" value="{{ $contact['belongs'] }}">
                                        <input type="hidden" name="amount_of_contacts[]" value="{{ $index }}">
                                        <input type="hidden" id="contact-{{ $locale }}-profession-{{ $index }}" name="profession_ka[]" value="{{ $contact['profession_ka'] }}">
                                        <input type="hidden" id="contact-{{ $locale }}-name-{{ $index }}" name="name_ka[]" value="{{ $contact['name_ka'] }}">
                                    @else
                                        <a href="javascript:void(0)">{{ $contact['number'] }}</a>

                                        <div class="d-flex">
                                            <span contenteditable="true" data-text-to-value="#contact-{{ $locale }}-profession-{{ $index }}">{{ $contact['profession_en'] }}</span> 
                                            <span>:</span>
                                            <span contenteditable="true" data-text-to-value="#contact-{{ $locale }}-name-{{ $index }}"><b>{{ $contact['name_en'] }}</b></span>
                                        </div>

                                        <input type="hidden" id="contact-{{ $locale }}-profession-{{ $index }}" name="profession_en[]" value="{{ $contact['profession_en'] }}">
                                        <input type="hidden" id="contact-{{ $locale }}-name-{{ $index }}" name="name_en[]" value="{{ $contact['name_en'] }}">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach