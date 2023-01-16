@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'door_window'       => 'კარ-ფანჯარა და საკეტები',
            'electricity'       => 'ელექტროობა',
            'sewage'            => 'კანალიზაცია',
            'plumbing'          => 'სანტექნიკა',
            'conditioning'      => 'გათბობა / გაგრილება',
            'house_tech'        => 'საყოფაცხოვრებო ტექნიკა',
            'universal'         => 'უნივერსალური სამუშაოები',
            'open_all'          => 'ყველას გაღება',
            'close_all'         => 'ყველას დახურვა',

            'active'            => 'აქტიური',

            'yellow_color'      => 'ყვითელი ფერით მონიშნულია მოცემულ სფეროში მომუშავე და ამჟამად თავისუფალი სპეციალისტების ჯგუფი.',
        ],
        'en' => [
            'door_window'       => 'Doors, windows and locks',
            'electricity'       => 'Electricity',
            'sewage'            => 'Sewage',
            'plumbing'          => 'Plumbing',
            'conditioning'      => 'Conditioning',
            'house_tech'        => 'House Tech',
            'universal'         => 'Universal works',
            'open_all'          => 'Open All',
            'close_all'         => 'Close All',

            'active'            => 'active',

            'yellow_color'      => 'Free specialists working in this field are colored in yellow.',
        ]
    ];

    $locale_to_datepicker = [
        'ka' => 'ka-GE',
        'en' => 'en-US',
    ];

    if (Session::has('cart.vip_master.services') && Session::get('cart.vip_master.services') != []) {
        $button = true;
    } else {
        $button = false;
    }

    $category_array = ['door-window', 'electricity', 'pipes', 'water-supply', 'conditioning', 'house-technic', 'universal'];
@endphp

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/datepicker-master/css/bootstrap-datepicker3.min.css') }}">
@endsection

@section('meta')
    <meta name="keywords" content="VIP მასტერი, VIP masteri, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="VIP მასტერი, VIP masteri, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>VIP მასტერი, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('vip_master') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/vip-master">{{ $TC->TG('services') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/vip-master">{{ $TC->TG('vip_master') }}</a>
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
        <div class="services-wrapper vip-master-wrapper container-fluid">
            <div class="services">
                {{-- Navigation --}}
                    <div class="services-top-section">
                        <div class="jumper-navigation">
                            <div class="top">
                                <button class="active" data-category="door-window">     <span class="dire-door-window"></span>      </button>
                                <button class="" data-category="electricity">           <span class="dire-electricity"></span>      </button>
                                <button class="" data-category="pipes">                 <span class="dire-pipes"></span>            </button>
                                <button class="" data-category="water-supply">          <span class="dire-water-suply"></span>      </button>
                                <button class="" data-category="conditioning">          <span class="dire-conditioning"></span>     </button>
                                <button class="" data-category="house-technic">         <span class="dire-house-technic"></span>    </button>
                                <button class="" data-category="universal">             <span class="dire-universal"></span>        </button>
                            </div>

                            <div class="bottom">
                                <div class="important-text-wrapper door-window show">
                                    <h5 class="important-text mt-3">{{ $TC->T($local, 'door_window') }}</h5>
                                </div>
                                <div class="important-text-wrapper electricity">
                                    <h5 class="important-text mt-3">{{ $TC->T($local, 'electricity') }}</h5>
                                </div>
                                <div class="important-text-wrapper pipes">
                                    <h5 class="important-text mt-3">{{ $TC->T($local, 'sewage') }}</h5>
                                </div>
                                <div class="important-text-wrapper water-supply">
                                    <h5 class="important-text mt-3">{{ $TC->T($local, 'plumbing') }}</h5>
                                </div>
                                <div class="important-text-wrapper conditioning">
                                    <h5 class="important-text mt-3">{{ $TC->T($local, 'conditioning') }}</h5>
                                </div>
                                <div class="important-text-wrapper house-technic">
                                    <h5 class="important-text mt-3">{{ $TC->T($local, 'house_tech') }}</h5>
                                </div>
                                <div class="important-text-wrapper universal">
                                    <h5 class="important-text mt-3">{{ $TC->T($local, 'universal') }}</h5>
                                </div>
                                <div class="open-close">
                                    <button data-open-all-category="door-window">{{ $TC->T($local, 'open_all') }}</button> / <button data-close-all-category="door-window">{{ $TC->T($local, 'close_all') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- Navigation --}}

                @foreach ($category_array as $index => $category)
                    <div class="categories {{ $category }} {{ $index == '0' ? 'show' : '' }}">
                        @foreach ($data['categories'][$category] as $index => $sub_category)
                            <div class="sub-category show">
                                <div class="top">
                                    <h5>{{ $sub_category['title_' . Session::get('locale')] }}</h5>
                                    <span class="dire-up-arrow"></span>
                                </div>
                                <div class="bottom">
                                    @foreach ($data['services'] as $index => $db_service)
                                        @if ( $db_service['belongs'] == $sub_category['has'] )
                                            <div class="vip-master-service">
                                                <div class="service-left">
                                                    <span>{{ $db_service['title_' . Session::get('locale')] }}</span>
                                                </div>

                                                <div class="service-right">
                                                    <span class="service-price">{{ $db_service['price'] }} <span class="dire-lari"></span></span>
                                                    <label for="service-index-{{ $index }}">
                                                        <input 
                                                            type="checkbox" 
                                                            id="service-index-{{ $index }}" 
                                                            class="d-none"
                                                            hidden
                                                            {{ (Session::has('cart.vip_master.services.' . $db_service['id'])) ? 'checked' : '' }}
                                                            data-id="{{ $db_service['id'] }}" 
                                                            data-price="{{ $db_service['price'] }}"
                                                            data-category="vip_master" 
                                                            data-visible-name="{{ $db_service['title_' . Session::get('locale')] }}" 
                                                        >
                                                        <span class="split-button">
                                                            <span class="dire-right-arrow"></span>
                                                            <span>{{ $TC->TG('add') }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="service-prices">
                {{-- Workers --}}
                    <div class="vip-master-top-section">
                        <div class="vip-master-workers">
                            <div class="top">
                                <div class="total">
                                    <span class="dire-masters-icon"></span>
                                    <div class="counter">
                                        <span class="text">{{ $TC->TG('total') }}:</span>
                                        <span class="number">126</span>
                                    </div>
                                </div>

                                <div class="active">
                                    <span class="dire-master-icon flicker"></span>
                                    <div class="counter">
                                        <span class="text">{{ $TC->T($local, 'active') }}:</span>
                                        <span class="number">28</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom">
                                <p>{{ $TC->T($local, 'yellow_color') }}</p>
                            </div>
                        </div>
                    </div>
                {{-- Workers --}}

                <h5 class="service-prices-header">{{ $TC->TG('order_price') }}</h5>
                <div class="service-price-box-wrapper">
                    @if ( Session::has('cart.vip_master.services') )
                        @foreach ( Session::get('cart.vip_master.services') as $session_service)
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
                    <span class="service-price" data-total-price="{{ (Session::has('cart.vip_master.total_price')) ? Session::get('cart.vip_master.total_price') : '0' }}">{{ (Session::has('cart.vip_master.total_price')) ? Session::get('cart.vip_master.total_price') : '0' }} <span class="dire-lari"></span></span>
                </div>

                <button class="split-button {{ $button ? '' : 'disabled' }}" {{ $button ? '' : 'disabled' }} type="button" data-toggle="modal" data-target="#service-modal">
                    <span class="dire-right-arrow"></span>
                    <span>{{ $TC->TG('order_product') }}</span>
                </button>
            </div>
        </div>

        {{-- Modal --}}
            <div class="modal fade vip-master" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="service-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="service-modal-label">{{ $TC->TG('order_product') }}</h5>
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
                                                        <option selected value="თბილისი">თბილისი</option>
                                                        <option value="ბათუმი">ბათუმი</option>
                                                        <option value="გორი">გორი</option>
                                                        <option value="ზუგდიდი">ზუგდიდი</option>
                                                        <option value="თელავი">თელავი</option>
                                                        <option value="რუსთავი">რუსთავი</option>
                                                        <option value="ფოთი">ფოთი</option>
                                                        <option value="ქუთაისი">ქუთაისი</option>
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
                                            <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('address') }}" type="text" name="address" id="address" required>
                                        </li>

                                        <li>
                                            <label for="number">{{ $TC->TG('number') }}<b>*</b></label>
                                            <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" type="number" name="number" id="number" required>
                                        </li>

                                        <li class="d-flex w-100 mt-2">
                                            <button class="envelope h37" type="button" data-toggle="tooltip" data-placement="top" title="თქვენს ნომერზე სმს-ი გაიგზავნება ვალიდაციის კოდით"><img src="{{ asset('images/svg_icons/envelope.svg') }}"></button>
                                            <input class="validate-number" placeholder="შეიყვანეთ კოდი *" type="number" name="validation_code" required>
                                        </li>
                                    </ul>
                                </div>

                                <div class="service-prices static">
                                    <div class="service-price-box-wrapper">
                                        @if ( Session::has('cart.vip_master.services') )
                                            @foreach ( Session::get('cart.vip_master.services') as $session_service)
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
                                        <span class="service-price" data-total-price="{{ (Session::has('cart.vip_master.total_price')) ? Session::get('cart.vip_master.total_price') : '0' }}">{{ (Session::has('cart.vip_master.total_price')) ? Session::get('cart.vip_master.total_price') : '0' }} <span class="dire-lari"></span></span>
                                        <input type="hidden" name="total_price" value="{{ (Session::has('cart.vip_master.total_price')) ? Session::get('cart.vip_master.total_price') : '0' }}">
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

                                <input type="hidden" name="type" value="{{ Crypt::encrypt('vip_master') }}">

                                <button type="submit" class="split-button">
                                    <span class="dire-right-arrow"></span>
                                    <span>{{ $TC->TG('order_product') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        {{-- Modal --}}
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
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.services-wrapper .services-top-section .jumper-navigation .top button').click(function(){
                let selector = `.${$(this).data('category')}`
                $(this).siblings('button').removeClass('active')
                $(this).addClass('active')

                $('button[data-open-all-category]').data('open-all-category', $(this).data('category'))
                $('button[data-close-all-category]').data('close-all-category', $(this).data('category'))

                $(`.services-top-section .jumper-navigation .bottom .important-text-wrapper`).removeClass('show')
                $('.services-wrapper .categories').removeClass('show')
                $(selector).addClass('show clicked')

                setTimeout(function() {
                    $(selector).removeClass('clicked')
                }, 100)
            })

            $('.vip-master-wrapper .services .categories .sub-category .top').click(function() {
                $(this).parents('.sub-category').toggleClass('show')
                $(this).children('span').toggleClass('dire-up-arrow')
                $(this).children('span').toggleClass('dire-down-arrow')
            })

            $('button[data-open-all-category]').click(function() {
                $(`.services-wrapper .services .categories.${$(this).data('open-all-category')} .sub-category`).addClass('show')
                $('.services-wrapper .services .categories .sub-category .top span').removeClass('dire-down-arrow')
                $('.services-wrapper .services .categories .sub-category .top span').addClass('dire-up-arrow')
            })

            $('button[data-close-all-category]').click(function() {
                $(`.services-wrapper .services .categories.${$(this).data('close-all-category')} .sub-category`).removeClass('show')
                $('.services-wrapper .services .categories .sub-category .top span').removeClass('dire-up-arrow')
                $('.services-wrapper .services .categories .sub-category .top span').addClass('dire-down-arrow')
            })
        })
    </script>
@endsection