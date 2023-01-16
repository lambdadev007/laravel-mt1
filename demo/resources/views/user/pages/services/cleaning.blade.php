@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'square_meter'          => 'კვ.მ',
            'upload_image_i'        => 'ატვირთეთ სასურველი დიზაინის ფოტო და დააზუსტეთ დამზადების ფასი.',
            'upload_image_ii'       => 'ასატვირთი ფოტოების მაქსიმალური რადენობა 5. ფაილის მაქსიმალური ზომა 1 mb.',
            'upload_image_iii'      => 'ფოტოების არჩევა',
            'cleaning_area'         => 'დასასუფთავებელი ფართობი',
            'in_square_meters'      => 'კვ. მეტრებში',
        ],
        'en' => [
            'square_meter'          => 'Sq.M',
            'upload_image_i'        => 'Upload a photo with desired design',
            'upload_image_ii'       => 'Maximum amount of photos 5, maximum size 1mb.',
            'upload_image_iii'      => 'Select Photos',
            'cleaning_area'         => 'Cleaning Area',
            'in_square_meters'      => 'In square meters',
        ]
    ];

    $locale_to_datepicker = [
        'ka' => 'ka-GE',
        'en' => 'en-US',
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

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/datepicker-master/css/bootstrap-datepicker3.min.css') }}">
@endsection

@section('meta')
    <meta name="keywords" content="დასუფთავება, dasuftaveba, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="დასუფთავება, dasuftaveba, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>დასუფთავება, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('cleaning') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/cleaning">{{ $TC->TG('services') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/cleaning">{{ $TC->TG('cleaning') }}</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">592 10 80 80</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    {{-- Services + Modal --}}
        <div class="services-wrapper cleaning-wrapper container-fluid">
            <div class="services">
                {{-- Navigation --}}
                    <div class="services-top-section">
                        <div class="jumper-navigation">
                            <div class="top">
                                <button class="active" data-category="after-renovation">    <span class="dire-after_renovation"></span>     </button>
                                <button class="" data-category="during-renovation">         <span class="dire-during_renovation"></span>    </button>
                                <button class="" data-category="facade-cleaning">           <span class="dire-facade_cleaning"></span>      </button>
                                <button class="" data-category="window-cleaning">           <span class="dire-window_cleaning"></span>      </button>
                                <button class="" data-category="every-day-cleaning">        <span class="dire-every_day_cleaning"></span>   </button>
                                <button class="" data-category="complex-cleaning">          <span class="dire-complex_cleaning"></span>     </button>
                                <button class="" data-category="cleaner-woman">             <span class="dire-cleaner_woman"></span>        </button>
                            </div>
                        </div>
                    </div>
                {{-- Navigation --}}

                {{-- Top Services --}}
                    <div class="top-services">
                        @foreach ($category_array as $category_index => $category)
                            @foreach ($data['top_services'][$category] as $top_service)
                                <div class="top-service {{ $category }} {{ $category_index == 0 ? 'show' : '' }}">
                                    <div class="left">
                                        <img src="{{ asset($top_service['image']) }}" alt="{{ $top_service['title_' . Session::get('locale')] }}">
                                    </div>

                                    <div class="right">
                                        <div class="important-text-wrapper">
                                            <h5 class="important-text">{{ $top_service['title_' . Session::get('locale')] }}</h5>
                                        </div>

                                        <p>{!! $top_service['description_' . Session::get('locale')] !!}</p>

                                        <div class="cleaning-service-price-wrapper">
                                            <div class="top-area-price">
                                                <span class="area">{{ $TC->TG('price') .': 1 '. $TC->T($local, 'square_meter') }}</span>
                                                <span class="price">{{ $top_service['price'] }} <span class="dire-lari"></span></span>
                                            </div>
                                            <button class="split-button cleaning"
                                            data-toggle="modal" 
                                            data-target="#service-modal" 
                                            data-title="{{ $top_service['title_' . Session::get('locale')] }}" 
                                            data-price="{{ $top_service['price'] }}" 
                                            data-service-id="{{ $top_service['id'] }}" 
                                            data-table="top">
                                                <span class="dire-right-arrow"></span>
                                                <span>{{ $TC->TG('order_product') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                {{-- Top Services --}}

                {{-- Bottom Services --}}
                    <div class="cleaning-bottom-wrapper">
                        <div class="bottom-services">
                            @foreach ($data['bottom_services'] as $bottom_service)
                                <div class="bottom-service">
                                    <div class="top">
                                        <div class="important-text-wrapper">
                                            <h5 class="important-text">{{ $bottom_service['title_' . Session::get('locale')] }}</h5>
                                        </div>
                                        <div class="dire-down-arrow-s"></div>
                                    </div>

                                    <div class="bottom">
                                        <div class="left">{{ $bottom_service['description_' . Session::get('locale')] }}</div>

                                        <div class="right">
                                            <div class="cleaning-service-price-wrapper">
                                                <span class="area">{{ $TC->TG('price') .': 1 '. $TC->T($local, 'square_meter') }}</span>
                                                <span class="price">{{ $bottom_service['price'] }} <span class="dire-lari"></span></span>
                                            </div>
                                            <button class="split-button cleaning" 
                                            data-toggle="modal" 
                                            data-target="#service-modal" 
                                            data-title="{{ $bottom_service['title_' . Session::get('locale')] }}" 
                                            data-service-id="{{ $bottom_service['id'] }}" 
                                            data-price="{{ $bottom_service['price'] }}" 
                                            data-table="bottom">
                                                <span class="dire-right-arrow"></span>
                                                <span>{{ $TC->TG('order_product') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="bottom-sidebar">
                            <a href="/articles/cleaning" class="split-button w-100">
                                <span class="dire-right-arrow"></span>
                                <span class="w-100">სტატიები ავეჯზე</span>
                            </a>
                        </div> --}}
                    </div>
                {{-- Bottom Services --}}
            </div>
        </div>

        {{-- Modal --}}
            <div class="modal fade" id="service-modal" tabindex="-1" role="dialog" aria-labelledby="service-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="service-modal-label">{{ $TC->TG('order_product') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="/notification" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="modal-body cleaning">
                                <div class="important-text-and-price">
                                    <div class="important-text-wrapper mb-3">
                                        <h5 class="important-text"></h5>
                                    </div>
                                    <div class="price">
                                        <span>{{ $TC->TG('price') .': 1 '. $TC->T($local, 'square_meter') }} <b></b> <span class="dire-lari"></span></span>
                                        <input type="hidden" name="square_price" required>
                                    </div>
                                </div>
                                
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
                                            <input placeholder="{{ $TC->TG('specify') .' '. $TC->TG('address') }}" type="text" name="address" id="address" required>
                                        </li>
                                        
                                        <li>
                                            <label for="number">{{ $TC->TG('number') }}<b>*</b></label>
                                            <input placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" type="number" name="number" id="number" required>
                                        </li>

                                        <li class="d-flex w-100 mt-3">
                                            <button class="envelope h37" type="button" data-toggle="tooltip" data-placement="top" title="თქვენს ნომერზე სმს-ი გაიგზავნება ვალიდაციის კოდით"><img src="{{ asset('images/svg_icons/envelope.svg') }}"></button>
                                            <input class="validate-number" placeholder="შეიყვანეთ კოდი *" type="number" name="validation_code" required>
                                        </li>
                                    </ul>
                                </div>

                                <div class="date-and-terms">
                                    <div class="date">
                                        <div class="form-field h-100">
                                            <h5 class="service-prices-header">{{ $TC->TG('get_in_touch') }}</h5>
                                            <ul class="date-radios h-100">
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
                                        <div class="images-description">
                                            {{ $TC->T($local, 'upload_image_i') }} <br>
                                            {{ $TC->T($local, 'upload_image_ii') }}

                                            <label for="cleaning-images" class="split-button mt-3 w-100">
                                                    <span class="dire-right-arrow"></span>
                                                    <span class="w-100">{{ $TC->T($local, 'upload_image_iii') }}</span>

                                                <input class="d-none" hidden type="file" name="images[]" id="cleaning-images" multiple accept="image/gif, image/jpeg, image/png">
                                            </label>    
                                        </div>

                                        <div class="area-wrapper">
                                            <span>{{ $TC->T($local, 'cleaning_area') }}</span>
                                            <input type="number" placeholder="{{ $TC->T($local, 'in_square_meters') }}" name="area" required>
                                        </div>
                                        
                                        <label for="terms" class="accept-terms-of-service">
                                            <input type="checkbox" id="terms" name="terms-of-service" required>
                                            <span>{{ $TC->TG('i_agree_to') }} <a href="/"><b>{{ $TC->TG('these_terms_and_conditions') }}</b></a></span>
                                        </label>

                                        <p>{{ $TC->TG('required_inputs') }}</p>

                                        <input type="hidden" name="type" value="{{ Crypt::encrypt('cleaning') }}">
                                        <input type="hidden" name="table">
                                        <input type="hidden" name="id">

                                        <button type="submit" class="split-button w-100 mt-auto">
                                            <span class="dire-right-arrow"></span>
                                            <span class="w-100">{{ $TC->TG('order_product') }}</span>
                                        </button>
                                    </div>
                                </div>
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

                $('.services-wrapper .top-services .top-service').removeClass('show')
                $(selector).addClass('show clicked')

                setTimeout(function() {
                    $(selector).removeClass('clicked')
                }, 100)
            })

            $('.services-wrapper.cleaning-wrapper .cleaning-bottom-wrapper .bottom-services .bottom-service .top').click(function() {
                $(this).parent('.bottom-service').toggleClass('active')
            })

            $('.split-button.cleaning').click(function() {
                $('.modal .important-text-wrapper > .important-text').text($(this).data('title'))
                $('.modal-body.cleaning .important-text-and-price .price span strong').text($(this).data('price'))
                $('.modal-body.cleaning .important-text-and-price .price input').val($(this).data('price'))
                $('.modal-body.cleaning .date-and-terms .terms input[name="table"]').val($(this).data('table'))
                $('.modal-body.cleaning .date-and-terms .terms input[name="id"]').val($(this).data('service-id'))
            })

            $("#cleaning-images").on("change", function() {
                if ($("#cleaning-images")[0].files.length > 5) {
                    alert("ასატვირთი ფოტოების მაქსიმალური რადენობა არის 5")
                    $('button[type="submit"]').addClass('disabled')
                    $('button[type="submit"]').attr('disabled', true)
                } else {
                    $('button[type="submit"]').removeClass('disabled')
                    $('button[type="submit"]').attr('disabled', false)
                }
            })
        })
    </script>
@endsection