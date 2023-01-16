@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'contact_us'                 => 'დაგვიკავშირდით',
            'general_information'        => 'ზოგადი ინფორმაციისთვის',
            'rep_mats_vip'               => 'რემონტი, მასალები, ვიპ-მასტერი',
            'interior_designer'          => 'ინტერიერის დიზაინერი',
            'furniture_production'       => 'ავეჯის დამზადება',
        ],
        'en' => [
            'contact_us'                 => 'Contact Us',
            'general_information'        => 'For general information',
            'rep_mats_vip'               => 'Repairs, Materials, VIP-Master',
            'interior_designer'          => 'Interior Designer',
            'furniture_production'       => 'Furniture Production',
        ]
    ];
@endphp

{{-- Phone Call Modal --}}
    <div class="modal fade" id="phone-call-modal" tabindex="-1" role="dialog" aria-labelledby="phone-call-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="phoneCallModalLabel">{{ $TC->T($local, 'contact_us') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="modal-body-header">
                        {{-- <div class="number-row">
                            <span class="number-row-text">{{ $TC->T($local, 'general_information') }}</span>
                            <span class="number-row-number bold">2 11 20 80</span>
                        </div> --}}
                        <div class="number-row">
                            <span class="number-row-text">{{ $TC->T($local, 'rep_mats_vip') }}</span>
                            <span class="number-row-number bold">597 70 10 10</span>
                        </div>
                        <div class="number-row">
                            <span class="number-row-text">{{ $TC->T($local, 'interior_designer') }}</span>
                            <span class="number-row-number">592 10 40 40</span>
                        </div>
                        <div class="number-row">
                            <span class="number-row-text">{{ $TC->T($local, 'furniture_production') }}</span>
                            <span class="number-row-number">592 10 60 60</span>
                        </div>
                        <div class="number-row">
                            <span class="number-row-text">{{ $TC->TG('cleaning') }}</span>
                            <span class="number-row-number">592 10 80 80</span>
                        </div>
                    </div>

                    <div class="modal-body-content">
                        <form action="/notification" method="POST">
                            @csrf
                            <div class="call-inputs-text-wrapper">
                                <div class="call-inputs-text">
                                    <span>{{ $TC->TG('call_request') }}</span>
                                </div>

                                <div class="call-inputs">
                                    <div class="call-input">
                                        <input type="text" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('name') }}" name="requester_name" id="call-name" required>
                                    </div>

                                    <div class="call-input">
                                        <input class="validate-number" type="number" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" name="requester_number" id="call-number" required>
                                    </div>
                                </div>
                            </div>

                            {{-- Phone Call Modal Radios --}}
                                <div class="radios-wrapper">
                                    <label for="repairs" class="radio-wrapper">
                                        <input type="radio" hidden name="call_request_category" value="{{ Crypt::encrypt('repairs') }}" id="repairs" required checked>
                                        <div class="custom-checkbox"><span></span></div>
                                        <p>{{ $TC->TG('repairs') }}</p>
                                    </label>
                                    <label for="cleaning" class="radio-wrapper">
                                        <input type="radio" hidden name="call_request_category" value="{{ Crypt::encrypt('cleaning') }}" id="cleaning" required>
                                        <div class="custom-checkbox"><span></span></div>
                                        <p>{{ $TC->TG('cleaning') }}</p>
                                    </label>
                                    <label for="materials" class="radio-wrapper">
                                        <input type="radio" hidden name="call_request_category" value="{{ Crypt::encrypt('materials') }}" id="materials" required>
                                        <div class="custom-checkbox"><span></span></div>
                                        <p>{{ $TC->TG('materials') }}</p>
                                    </label>
                                    <label for="master" class="radio-wrapper">
                                        <input type="radio" hidden name="call_request_category" value="{{ Crypt::encrypt('vip_master') }}" id="master" required>
                                        <div class="custom-checkbox"><span></span></div>
                                        <p>{{ $TC->TG('vip_master') }}</p>
                                    </label>
                                    <label for="design" class="radio-wrapper">
                                        <input type="radio" hidden name="call_request_category" value="{{ Crypt::encrypt('designer') }}" id="design" required>
                                        <div class="custom-checkbox"><span></span></div>
                                        <p>{{ $TC->TG('designer') }}</p>
                                    </label>
                                    <label for="furniture" class="radio-wrapper">
                                        <input type="radio" hidden name="call_request_category" value="{{ Crypt::encrypt('furniture') }}" id="furniture" required>
                                        <div class="custom-checkbox"><span></span></div>
                                        <p>{{ $TC->TG('furniture') }}</p>
                                    </label>
                                </div>
                            {{-- Phone Call Modal Radios --}}

                            <div class="submition">
                                <div class="left">
                                    <button class="envelope" type="button" data-number="#call-number" data-toggle="tooltip" data-placement="top" title="თქვენს ნომერზე სმს-ი გაიგზავნება ვალიდაციის კოდით"><img src="{{ asset('images/svg_icons/envelope.svg') }}"></button>
                                    <input type="number" name="validation_code" placeholder="{{ $TC->TG('input_code') }}" required>
                                </div>
                                <button type="submit" class="split-button px-0">
                                    <span class="dire-phone"></span>
                                    <span class="w-100">{{ $TC->TG('finish_request') }}</span>
                                </button>
                            </div>

                            <input type="hidden" name="type" value="{{ Crypt::encrypt('call_request') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- Phone Call Modal --}}