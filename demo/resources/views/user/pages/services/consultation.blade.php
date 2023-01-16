@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'service_price'              => 'შეკვეთის ღირებულება',
            'place_order'                => 'შეკვეთის გაფორმება',
        ],
        'en' => [
            'service_price'              => 'Service Price',
            'place_order'                => 'Place an order',
        ]
    ];
@endphp

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/datepicker-master/css/bootstrap-datepicker3.min.css') }}">
@endsection

@php
    $locale_to_datepicker = [
        'ka' => 'ka-GE',
        'en' => 'en-US',
    ];

    if (Session::has('cart.consultation.services') && Session::get('cart.consultation.services') != []) {
        $button = true;
    } else {
        $button = false;
    }
@endphp

@section('meta')
    <meta name="keywords" content="კონსულტაცია, konsultacia, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="კონსულტაცია, konsultacia, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>{{ $TC->TG('consultation') .', '. $TC->TG('html_title') }}</title>
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('consultation') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/consultacion">{{ $TC->TG('services') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/consultacion">{{ $TC->TG('consultation') }}</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    {{-- Services + Modal --}}
        <div class="services-wrapper consultation-wrapper container-fluid">
            <div class="services">
                @foreach ($data['services'] as $index => $db_service)                    
                    <div class="important-text-wrapper mt-3">
                        <h5 class="important-text">{{ $db_service['title_' . Session::get('locale')] }}</h5>
                    </div>

                    <div class="consultation-service">
                        <div class="service-left">
                            <ul class="service-list">
                                {!! $db_service['description_' . Session::get('locale')] !!}
                            </ul>
                        </div>

                        <div class="service-right">
                            <span class="service-price">{{ $db_service['price'] }} <span class="dire-lari"></span></span>
                            <label for="service-index-{{ $index }}">
                                <input 
                                    type="checkbox" 
                                    id="service-index-{{ $index }}" 
                                    class="d-none"
                                    hidden
                                    {{ (Session::has('cart.consultation.services.' . $db_service['id'])) ? 'checked' : '' }}
                                    data-id="{{ $db_service['id'] }}" 
                                    data-price="{{ $db_service['price'] }}"
                                    data-category="consultation" 
                                    data-visible-name="{{ $db_service['title_' . Session::get('locale')] }}" 
                                >
                                <span class="split-button">
                                    <span class="dire-right-arrow"></span>
                                    <span>{{ $TC->TG('add') }}</span>
                                </span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="service-prices">
                <h5 class="service-prices-header">{{ $TC->T($local, 'service_price') }}</h5>
                <div class="service-price-box-wrapper">
                    @if ( Session::has('cart.consultation.services') )
                        @foreach ( Session::get('cart.consultation.services') as $session_service)
                            <div class="service-price-box" data-id="{{ $session_service['id'] }}">
                                <span class="dire-close"></span>
                                <span>{{ $session_service['visible_name'] }}</span>
                                <span class="service-price">{{ $session_service['price'] }} <span class="dire-lari"></span></span>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="service-total">
                    <span>{{ $TC->TG('total') }}:</span>
                    <span class="service-price" data-total-price="{{ (Session::has('cart.consultation.total_price')) ? Session::get('cart.consultation.total_price') : '0' }}">{{ (Session::has('cart.consultation.total_price')) ? Session::get('cart.consultation.total_price') : '0' }} <span class="dire-lari"></span></span>
                </div>

                <button class="split-button {{ $button ? '' : 'disabled' }}" {{ $button ? '' : 'disabled' }} type="button" data-toggle="modal" data-target="#service-modal">
                    <span class="dire-right-arrow"></span>
                    <span>{{ $TC->T($local, 'place_order') }}</span>
                </button>
            </div>
        </div>

        <div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="service-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="service-modal-label">{{ $TC->T($local, 'place_order') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/notification" method="post">
                    @csrf
                        <div class="modal-body">
                            <div class="form-field">
                                <ul>
                                    <li>
                                        <label for="name">{{ $TC->TG('name') }}<b>*</b></label>
                                        <input placeholder="{{ $TC->TG('specify') .' '. $TC->TG('name') }}" type="text" name="name" id="name" required>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <div class="service-modal-li-item">
                                            <label for="city">{{ $TC->TG('city') }}<b>*</b></label>
                                            <div class="metrix-selector-wrapper">
                                                <select id="city" name="city" required>
                                                    <option value="თბილისი">თბილისი</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="service-modal-li-item">
                                            <label for="region">{{ $TC->TG('region') }}<b>*</b></label>
                                            <div class="metrix-selector-wrapper">
                                                <select id="region" name="region" required>
                                                    <option value="ავლაბარი">ავლაბარი</option>
                                                    <option value="ავჭალა">ავჭალა</option>
                                                    <option value="აღმაშენებლის ხეივანი">აღმაშენებლის ხეივანი</option>
                                                    <option value="ბაგები">ბაგები</option>
                                                    <option value="გლდანი">გლდანი</option>
                                                    <option value="დიდი დიღომი">დიდი დიღომი</option>
                                                    <option value="დიდუბე">დიდუბე</option>
                                                    <option value="დიღმის მასივი">დიღმის მასივი</option>
                                                    <option value="ვაკე">ვაკე</option>
                                                    <option value="ვარკეთილი">ვარკეთილი</option>
                                                    <option value="ვეძისი">ვეძისი</option>
                                                    <option value="ისანი">ისანი</option>
                                                    <option value="კრწანისი">კრწანისი</option>
                                                    <option value="მთაწმინდა">მთაწმინდა</option>
                                                    <option value="ნაძალადევი">ნაძალადევი</option>
                                                    <option value="სამგორი">სამგორი</option>
                                                    <option value="სანზონა">სანზონა</option>
                                                    <option value="ჩუღურეთი">ჩუღურეთი</option>
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="address">{{ $TC->TG('address') }}<b>*</b></label>
                                        <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('address') }}" type="text" name="address" id="address">
                                    </li>
                                    <li>
                                        <label for="number">{{ $TC->TG('number') }}<b>*</b></label>
                                        <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" type="number" name="number" id="number">
                                    </li>

                                    <li class="d-flex w-100 mt-2">
                                        <button class="envelope h37" type="button" data-toggle="tooltip" data-placement="top" title="თქვენს ნომერზე სმს-ი გაიგზავნება ვალიდაციის კოდით"><img src="{{ asset('images/svg_icons/envelope.svg') }}"></button>
                                        <input class="validate-number" placeholder="შეიყვანეთ კოდი *" type="number" name="validation_code" required>
                                    </li>
                                </ul>
                            </div>

                            <div class="service-prices static">
                                <div class="service-price-box-wrapper">
                                    @if ( Session::has('cart.consultation.services') )
                                        @foreach ( Session::get('cart.consultation.services') as $session_service)
                                            <div class="service-price-box" data-id="{{ $session_service['id'] }}">
                                                <span class="dire-close"></span>
                                                <span>{{ $session_service['visible_name'] }}</span>
                                                <span class="service-price">{{ $session_service['price'] }} <span class="dire-lari"></span></span>
                                                <input type="hidden" name="service_ids[]" value="{{ $session_service['id'] }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="service-total">
                                    <span>{{ $TC->TG('total') }}:</span>
                                    <span class="service-price" 
                                    data-total-price="{{ (Session::has('cart.consultation.total_price')) ? Session::get('cart.consultation.total_price') : '0' }}">{{ (Session::has('cart.consultation.total_price')) ? Session::get('cart.consultation.total_price') : '0' }} <span class="dire-lari"></span></span>
                                    <input type="hidden" name="total_price" value="{{ (Session::has('cart.consultation.total_price')) ? Session::get('cart.consultation.total_price') : '0' }}">
                                </div>
                            </div>

                            <div class="date-and-terms">
                                <div class="date">
                                    <div class="form-field">
                                        <h5 class="service-prices-header">{{ $TC->TG('get_in_touch') }}</h5>
                                        <ul class="date-radios">
                                            <li>
                                                <input type="radio" name="date" value="as_soon_as_possible" id="date-now" checked>
                                                <label for="date-now">{{ $TC->TG('asap') }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="date" value="before_visit" id="date-before-visit">
                                                <label for="date-before-visit">{{ $TC->TG('agreement_before_visiting') }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" name="date" value="{{ date('d.m.Y') }}" id="date-datepicker">
                                                <div class="d-flex">
                                                    <input type="text" class="datepicker-location" value="{{ date('d.m.Y') }}">
                                                    <span class="dire-date"></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="terms">
                                    <h5>{{ $TC->TG('terms_of_purchase') }}:</h5>
                                    <p class="mb-4">{{ $TC->TG('terms_of_purchase_text') }}</p>
                                    <p>{{ $TC->TG('required_inputs') }}</p>
                                </div>
                            </div>

                            <label for="terms" class="accept-terms-of-service">
                                <input type="checkbox" id="terms" name="terms-of-service" required>
                                <span>{{ $TC->TG('i_agree_to') }} <a href="/"><b>{{ $TC->TG('these_terms_and_conditions') }}</b></a></span>
                            </label>

                            <input type="hidden" name="type" value="{{ Crypt::encrypt('consultation') }}">

                            <button type="submit" class="split-button">
                                <span class="dire-right-arrow"></span>
                                <span>{{ $TC->TG('order_product') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    {{-- Services + Modal --}}

    @include('user.components.offers')

@endsection

@section('defer_js')
    <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/locales/bootstrap-datepicker.ka.min.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/locales/bootstrap-datepicker.ru.min.js') }}"></script>
@endsection

@section('bottom_js')
    {{-- Datepicker --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $('.datepicker-location').datepicker({
                    maxViewMode: 1,
                    todayBtn: "linked",
                    clearBtn: true,
                    orientation: "top auto",
                    daysOfWeekHighlighted: "0,6",
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd/mm/yyyy',
                    language: '{{ $locale_to_datepicker[Session::get('locale')] }}'
                })
            })
        </script>
    {{-- Datepicker --}}
@endsection