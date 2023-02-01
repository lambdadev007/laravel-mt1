@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    use App\Models\CompanyHotline;
    use App\Models\Contact;

    $mail = '';
    if ( Contact::where('id', 1)->exists() ) {
        $mail = Contact::find(1)->mail;
    }

    $company_hotline = [
        'call_phone_number' => '+995592104040',
        'visible_phone_number' => '592 10 40 40'
    ];

    if ( CompanyHotline::where('id', 1)->exists() && !isset($data['is_vip_number']) ) {
        $company_hotline = CompanyHotline::where('id', 1)->get(['call_phone_number', 'visible_phone_number'])->first()->toArray();
    } else if ( isset($data['is_vip_number']) ) {
        $company_hotline = CompanyHotline::where('id', 1)->get(['call_phone_vip_number', 'visible_phone_vip_number'])->first()->toArray();
        $company_hotline = [
            'call_phone_number' => $company_hotline['call_phone_vip_number'],
            'visible_phone_number' => $company_hotline['visible_phone_vip_number']
        ];
    }

    $agent = new Agent();
    $tranCT = new TranslationsCT();
@endphp


    
    
@section('meta')
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ $data['service']->meta_title }}"/>
    <meta property="og:description" content="{{ $data['service']->meta_description }}"/>
    <meta property="og:image" content="{{ asset($data['service']->image) }}""/>

    <title>{{ $data['service']->meta_title }}</title>
    <meta name="keywords" content="{{ $data['service']->meta_keywords }}"/>
    <meta name="description" content="{{ $data['service']->meta_description }}"/>
@endsection


@section('sdk')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0"></script>
    <script>
        window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {}
        if (d.getElementById(id)) return t
        js = d.createElement(s)
        js.id = id
        js.src = "https://platform.twitter.com/widgets.js"
        fjs.parentNode.insertBefore(js, fjs)

        t._e = []
        t.ready = function(f) {
            t._e.push(f)
        }

        return t
        }(document, "script", "twitter-wjs"))
    </script>
    <script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: ka_GE</script>
    <style>
        .upper-navbar-number {
            display : none!important;
        }
        .container-1280 .right > a {
            display : none!important;
        }
    </style>
@endsection

@section('content')
    @if ( $agent->isMobile() )
        <div class="market-wrapper container-1280 mb-4" style="background: transparent; {{ ($agent->isMobile()) ? "overflow: auto;" : '' }}">
            <div class="top" style="height: auto">
                <div class="left">
                    <div class="market-crumbs ml-0" style="white-space: nowrap;">
                        <a href="/">მთავარი გვერდი</a>
                        <i class="dark-gray" id="market-arrow"></i>
                        <a href="/vip-master">ვიპ-მასტერი</a>
                        <i class="dark-gray" id="market-arrow"></i>
                        <a href="{{ $data['parent-info']['link'] }}#vip-dropdown-header-{{ $data['service']['belongs'] }}">{{ $data['parent-info']['name'] }}</a>
                        <i class="dark-gray" id="market-arrow"></i>
                        <a href="#">{{ $data['service']->outside_title }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="vip-services-wrapper container-1280 {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'd-fc' : 'd-flex' }}">
        <div class="{{ ( $agent->isMobile() || $agent->isTablet() ) ? 'col-md-12 px-0' : 'col-md-9' }}">
            <div class="header-section {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'd-fc' : 'd-flex' }}">
                <div class="col-md-3 px-0 position-relative">
                    <img src="{{ asset($data['service']->image) }}" alt="{{ $data['service']->meta_title }}">
                </div>
                <div class="col-md-9 {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'px-0' : '' }} d-fc">
                    <div class="header-title-top-wrapper d-flex align-items-center {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'my-3' : 'mb-3' }}">
                        <i id="vip-service-clock" class="orange mr-1"></i>
                        <span class="mr-3">24/7</span>
                        <div class="d-flex stars">
                            <i id="vip-service-star" class="orange full"></i>
                            <i id="vip-service-star" class="orange full"></i>
                            <i id="vip-service-star" class="orange full"></i>
                            <i id="vip-service-star" class="orange full"></i>
                            <i id="vip-service-star" class="orange empty"></i>
                        </div>
                        @if ( !$agent->isMobile() )
                            <div class="market-wrapper">
                                <div class="top" style="height: auto">
                                    <div class="left" style="height: auto">
                                        <div class="market-crumbs">
                                            <a href="/" style="font-size: 10px; margin-right: 8px">მთავარი გვერდი</a>
                                            <i class="dark-gray" id="market-arrow" style="transform: scale(0.7); margin-right: 8px"></i>
                                            <a href="/vip-master" style="font-size: 10px; margin-right: 8px">ვიპ-მასტერი</a>
                                            <i class="dark-gray" id="market-arrow" style="transform: scale(0.7); margin-right: 8px"></i>
                                            <a href="{{ $data['parent-info']['link'] }}#vip-dropdown-header-{{ $data['service']['belongs'] }}" style="font-size: 10px; margin-right: 8px">{{ $data['parent-info']['name'] }}</a>
                                            <i class="dark-gray" id="market-arrow" style="transform: scale(0.7); margin-right: 8px"></i>
                                            <a href="#" style="font-size: 10px; margin-right: 8px">{{ $data['service']->outside_title }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <h1 class="service-title">{{ $data['service']->inner_title }}</h1>
                    <p class="service-short-description">{!! $data['service']->description !!}</p>
                    <div class="d-flex align-items-center {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'mb-4' : '' }}">
                        @if ( !$agent->isMobile() || $agent->isTablet() )
                            <div class="d-flex mr-4">
                                <button type="button" data-scroll-to=".description-section" class="view-rest d-flex align-items-center"><span class="mr-3">სრულად</span> <i id="nav-arrow" class="orange" style="transform: rotate(90deg);"></i></button>
                            </div>
                        @endif
                        <div class="d-flex align-items-center">
                            <i id="vip-service-workers" class="orange mr-2"></i>
                            <div class="vip-service-workers-text d-fc">
                                @if ( $agent->isMobile() || $agent->isTablet() )
                                    <span>ხელმისაწვდომია {{ $data['workforce_counter'] }} სპეციალისტი</span>
                                @else
                                    <small>ხელმისაწვდომია</small>
                                    <span>{{ $data['workforce_counter'] }} სპეციალისტი</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ( $agent->isMobile() || $agent->isTablet() )
                <div class="col-md-12 px-0" style="position: fixed; bottom: 0; z-index: 200;">
                    <div class="vip-service-card">
                        <div class="top d-flex px-0">
                            <a href="tel:+995{{  str_replace(' ', '', $data['service']->phone_number) }}" role="button"><i id="vip-service-headphones" class="gray"></i></a>
                            <a href="tel:+995{{  str_replace(' ', '', $data['service']->phone_number) }}" class="d-flex justify-content-start orange">
                                <i id="vip-service-phone" class="white mr-3"></i>
                                <div class="d-fc">
                                    <span>დარეკე ახლავე</span>
                                    <small>{{  $data['service']->phone_number  }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mid-section d-flex flex-wrap justify-content-between">
                @if ( $agent->isMobile() || $agent->isTablet() )
                    @foreach ( $data['services'] as $service )
                        <a href="/vip-services/{{ $service['slug'] }}" class="mb-2"><span>{{ $service['title'] }}</span></a>
                    @endforeach
                @else
                    @foreach ( $data['services'] as $service )
                        <a href="/vip-services/{{ $service['slug'] }}" class="mb-2"><span>{{ $service['title'] }}</span> <i id="arrow-right" class="orange"></i></a>
                    @endforeach
                @endif
            </div>
            @if ( $agent->isMobile() || $agent->isTablet() )
                <div class="social-section d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="icon-wrapper"><i id="vip-service-comment" class="orange"></i></div>
                        <div class="d-fc justify-content-center">
                            <span>გამოიძახე ხელოსანი <strong>კომენტარით</strong></span>
                            <small>დაწერეთ კომენტარის სახით, თუ რა გაქვთ გასაკეთებელი და <br> მიიღეთ <strong>10% ფასდაკლება</strong> სპეციალისტის მომსახურებაზე!</small>
                        </div>
                    </div>
                </div>
            @else
                <div class="social-section d-flex justify-content-between">
                    <div class="d-flex">
                        <div class="icon-wrapper"><i id="vip-service-comment" class="orange"></i></div>
                        <div class="d-fc justify-content-center">
                            <span>გამოიძახე ხელოსანი <strong>კომენტარით</strong></span>
                            <small>დაწერეთ კომენტარის სახით, თუ რა გაქვთ გასაკეთებელი და <br> მიიღეთ <strong>10% ფასდაკლება</strong> სპეციალისტის მომსახურებაზე!</small>
                        </div>
                    </div>
                    <div class="social" style="margin: 0; margin-left: auto;">
                        <div class="sharing">
                            <span class="text">{{ $tranCT->translate('share') }}: </span>
                            <div class="icons">
                                <div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button" data-size="small"></div>

                                <div class="fb-like" data-href="{{ url()->current() }}" data-layout="button" data-action="like" data-show-faces="true" style="position: relative; top: 4px; left: 10px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="comments my-4">
                @if ( $agent->isMobile() || $agent->isTablet() )
                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="330" data-numposts="5" data-mobile="true"></div>
                @elseif ( $agent->isTablet() )
                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="700" data-numposts="5" data-mobile="true"></div>
                @else
                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="800" data-numposts="5"></div>
                @endif
            </div>
            <div class="description-section d-fc">
                {!! $data['service']->description_lg !!}
            </div>
        </div>
        @if ( !$agent->isMobile() && !$agent->isTablet() )
            <div class="col-md-3">
                <div class="vip-service-card">
                    <div class="top d-flex">
                        <a href="tel:+995{{ str_replace(' ', '', $data['service']->phone_number)  }}" role="button"><i id="vip-service-phone" class="white"></i></a>
                        <div class="d-fc">
                            <small>მოითხოვე სპეციალისტი</small>
                            <span>+995 {{ $data['service']->phone_number }}</span>
                        </div>
                    </div>
                    <div class="middle d-fc">
                        <input type="text" placeholder="თქვენი სახელი">
                        <input type="number" placeholder="ტელეფონის ნომერი">
                        <button type="button"><span class="mr-2">ზარის მოთხოვნა</span> <i id="arrow-right" class="white"></i></button>
                    </div>
                </div>
                <div class="right-info">
                    <div class="d-flex align-items-center">
                        <div><i id="vip-service-pin" class="white"></i></div>
                        <span>ადამ მიცკევიჩის 29 ბ</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div><i>@</i></div>
                        <span>{{ $mail }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection