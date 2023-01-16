@php
use Jenssegers\Agent\Agent;
use App\Http\Controllers\TranslationsCT;

use App\Models\CompanyHotline;

$company_hotline = [
'call_phone_number' => 'tel:+995597701010',
'visible_phone_number' => '592 10 40 40'
];

if ( CompanyHotline::where('id', 1)->exists() && !isset($data['is_vip_number']) ) {
$company_hotline = CompanyHotline::where('id', 1)->get(['call_phone_number', 'visible_phone_number'])->first()->toArray();
} elseif ( isset($data['is_vip_number']) ) {
$company_hotline = CompanyHotline::where('id', 1)->get(['call_phone_vip_number', 'visible_phone_vip_number'])->first()->toArray();
$company_hotline = [
'call_phone_number' => $company_hotline['call_phone_vip_number'],
'visible_phone_number' => $company_hotline['visible_phone_vip_number']
];
}

$tranCT = new TranslationsCT();
$agent = new Agent();
@endphp

<div class="navbar-wrapper d-fc">
@if ( !$agent->isMobile() ) {{-- Needs to be reverse --}}
<div class="upper" style="{{ (Session::get('locale') != 'ka') ? 'height: 90px;' : '' }}">
<div class="container-1280">
@if ( Session::get('locale') == 'it' )
<div class="logo d-flex align-items-center mr-auto h-100" style="width: 130px; height: 40px;">
<a href="/" class="d-flex"><img class="w-100 h-100" src="{{ asset('images/logos/Logo-Eng.svg') }}"></a>
</div>
@endif
<div class="upper-navbar-number">
<span class="dire-phone">592 10 40 40</span>
@if ( Session::get('locale') == 'it' )
<a href="tel:+393518911175">
<span class="mr-0">351 891 11 75</span>
</a>
@else
<a href="tel:{{ $company_hotline['call_phone_number'] }}">
<span class="mr-0">{{ $company_hotline['visible_phone_number'] }}</span>
</a>
@endif
</div>
<div class="upper-navbar-login-button">
@if ( Cookie::has('user_000') )
<a href="/profile">
<span class="user"></span>
<span>{{ $tranCT->translate('profile') }}</span>
</a>
@else
<button type="button" data-toggle="modal" data-target="#login-modal">
<span class="user"></span>
<span>{{ $tranCT->translate('login') }}</span>
</button>
@endif
</div>
@if ( Session::get('locale') == 'ka' )
<div class="upper-navbar-cart">
@if ( isset($compact) && $compact )
<button type="button" class="cart-button" data-toggle="modal" data-target="#cart-list-view">
<i class="dark" id="navbar-cart"></i>
<span class="counter" id="navbar-cart-counter"></span>
</button>
@else
<button type="button" class="cart-button toggle-cart-popup">
<i class="dark" id="navbar-cart"></i>
<span class="counter" id="navbar-cart-counter"></span>
</button>
@endif
</div>
@endif
<div class="upper-navbar-language-button">
@if ( Session::get('locale') == 'ka' )
<form action="/locale" method="post">
@csrf
<button type="submit">KA</button>
<input type="hidden" name="locale" value="it">
</form>
@else
<form action="/locale" method="post">
@csrf
<button type="submit">ITA</button>
<input type="hidden" name="locale" value="ka">
</form>
@endif
</div>
<div class="cart-notification-wrapper">

</div>
</div>
</div>

@if ( Session::get('locale') == 'ka' )
<div class="lower container-1280">
<div class="wrap">
<div class="logo">
<a href="/"><img src="{{ asset('images/logos/Logo-Geo.svg') }}"></a>
</div>
<form class="search" method="get" action="/search">
<input type="text" name="keyword" placeholder="{{ $tranCT->translate('looking_for_something') }}" value="{{ $data['search_keyword'] ?? '' }}">
<button type="submit"><img src="{{ asset('images/xd-icons/colored/arrow-right-yellow.svg') }}"></button>
</form>
<div class="links">
<div class="link-dropdown">
<p class="{{ (isset($current_page) && $current_page == 'services') ? 'active' : '' }}">{{ $tranCT->translate('services') }}</p>
<div class="bridge"></div>
<div class="dropdown">
<a href="/designer">{{ $tranCT->translate('designer') }}</a>
<a href="/repairs">{{ $tranCT->translate('repairs') }}</a>
<a href="/furniture">{{ $tranCT->translate('furniture_crafting') }}</a>
<a href="/vip-master">{{ $tranCT->translate('vip_master') }}</a>
</div>
</div>
<a href="/market" class="{{ (isset($current_page) && $current_page == 'market') ? 'active' : '' }}">{{ $tranCT->translate('materials') }}</a>
{{-- <div class="link-dropdown market d-fc ml-auto">
<p class="toggle-market-dropdown {{ (isset($current_page) && $current_page == 'market') ? 'active' : '' }}">მასალები</p>
@if ( $product_categories['exists'] )
<div class="dropdown click">
<div class="left">
@foreach ( $product_categories['main'] as $main_index => $main )
<div class="{{ $main['has'] }} {{ ($main_index == 0) ? 'active' : '' }}">
<button type="button" class="toggle-all-categories-navbar" data-target="{{ $main['has'] }}">{{ $main['title'] }}</button>
</div>
@endforeach
</div>
<div class="right">
@foreach ( $product_categories['main'] as $main_index => $main )
<div class="groups-wrapper {{ $main['has'] }} {{ ($main_index == 0) ? '' : 'd-none' }}">
@foreach ( $product_categories['groups'] as $group_index => $group )
@if ( $group['belongs'] == $main['has'] )
<div class="category">
<div class="title">
<a href="/market?group={{ $group['has'] }}">{{ $group['title'] }}</a>
<div class="underline"></div>
</div>
<div class="links d-fc">
@foreach ( $product_categories['sub_groups'] as $sub_group_index => $sub_group )
@if ( $sub_group['belongs'] == $group['has'] )
<a href="/market?group={{ $sub_group['belongs'] }}&category={{ $sub_group['search_id'] }}">{{ $sub_group['title'] }}</a>
@endif
@endforeach
</div>
</div>
@endif
@endforeach
</div>
@endforeach
</div>
</div>
@endif
</div> --}}
<a class="{{ (isset($current_page) && $current_page == 'projects') ? 'active' : '' }}" href="/projects">{{ $tranCT->translate('featured_works') }}</a>
<a class="{{ (isset($current_page) && $current_page == 'blog') ? 'active' : '' }}" href="/blog">{{ $tranCT->translate('blog') }}</a>
<a class="{{ (isset($current_page) && $current_page == 'contact') ? 'active' : '' }}" href="/contact">{{ $tranCT->translate('contact') }}</a>
</div>
</div>
</div>
@endif
@endif
{{-- Mobile --}}
@if ( $agent->isMobile() || $agent->isTablet() )
<div class="container-1280">
<div class="left">
@php
$logo = 'images/logos/Logo-Geo.svg';
if ( Session::get('locale') != 'ka' ) $logo = 'images/logos/Logo-Eng.svg';
@endphp
<button type="button" class="toggle-mobile-navbar-general"><i class="orange" id="market-bars"></i></button>
<a href="/" class="logo"><img src="{{ asset($logo) }}"></a>
</div>
<div class="right">
@if ( $agent->isTablet() )
<a href="#"><i class="yellow" id="mobile-market-magnifying-glass"></i></a>
@endif
<a href="tel:{{ $company_hotline['call_phone_number'] }}" class="{{ (Session::get('locale') != 'ka') ? 'mr-0' : '' }}"><i class="yellow" id="awesome-phone"></i></a>
@if ( Session::get('locale') == 'ka' )
<div class="upper-navbar-cart">
<button type="button" class="cart-button toggle-cart-popup">
<i class="dark" id="navbar-cart"></i>
<span class="counter" id="navbar-cart-counter">{{ count($products_cookie) }}</span>
</button>
</div>
@endif
</div>
</div>
@endif
{{-- Mobile --}}
</div>

@if ( $agent->isMobile() || $agent->isTablet() )
<div class="mobile-navigation-wrapper d-fc d-none" id="general">
<div class="layer-0 container-1280">
<button type="button" class="lg toggle-mobile-navbar-general ml-0"><i class="white" id="times"></i></button>
@if ( Session::get('locale') == 'ka' )
<form action="/locale" method="post">
@csrf
<button type="submit" id="change-language">KA</button>
<input type="hidden" name="locale" value="it">
</form>
@else
<form action="/locale" method="post">
@csrf
<button type="submit" id="change-language">ITA</button>
<input type="hidden" name="locale" value="ka">
</form>
@endif
@if ( Session::get('locale') == 'ka' )
<button type="button"><i class="yellow" id="navbar-user"></i></button>
<div class="pseudo-button position-relative">
<i class="white toggle-mobile-search" id="mobile-market-magnifying-glass"></i>
<form class="mobile-search d-none" method="get" action="/search" style="width: 330px; position: absolute; top: 50px; left: 0; transform:translateX(-50%); padding: 0 0 30px 20px; background-color: rgb(var(--metrix-dark-accent))">
<input type="text" name="keyword" placeholder="{{ $tranCT->translate('looking_for_something') }}" value="{{ $data['search_keyword'] ?? '' }}" style="width: calc(100% - 70px); height: 40px">
<button type="submit"><img src="{{ asset('images/xd-icons/colored/arrow-right-yellow.svg') }}"></button>
</form>
</div>
@endif
<a href="tel:{{ $company_hotline['call_phone_number'] }}"><i class="yellow" id="awesome-phone"></i></a>
@if ( Session::get('locale') == 'ka' )
<div class="upper-navbar-cart">
<button type="button" class="cart-button toggle-cart-popup lg">
<i class="white" id="market-cart-empty"></i>
<span class="counter" id="navbar-cart-counter">{{ count($products_cookie) }}</span>
</button>
</div>
@endif
</div>
<div class="layer-1 container-1280 d-fc">
<button type="button" data-toggle="collapse" data-target="#mobile-navbar-services-collapse" aria-expanded="false" aria-controls="mobile-navbar-services-collapse">{{ $tranCT->translate('services') }}</button>
<div class="collapse mobile-navbar-collapse-0" id="mobile-navbar-services-collapse">
<a href="/designer">{{ $tranCT->translate('designer') }}</a>
<a href="/repairs">{{ $tranCT->translate('repairs') }}</a>
<a href="/furniture">{{ $tranCT->translate('furniture_crafting') }}</a>
<a href="/vip-master">{{ $tranCT->translate('vip_master') }}</a>
</div>
<a href="/projects">{{ $tranCT->translate('featured_works') }}</a>
<a href="/market">{{ $tranCT->translate('materials') }}</a>
{{-- <button type="button" class="toggle-mobile-navbar-market">მასალები</button> --}}
<a href="/blog">{{ $tranCT->translate('blog') }}</a>
<a href="/contact">{{ $tranCT->translate('contact') }}</a>
</div>
@if ( $agent->isMobile() )
<div class="layer-2">
<div class="footer-wrapper">
<div class="container-1280">
@if ( Session::get('locale') != 'ka' )
<div class="logo d-fc w-100 h-100">
<img src="{{ asset('images/logos/Logo-Eng-White.svg') }}" style="width: 220px; margin-top: 80px;" class="mx-auto">
<span class="gray-text text-center mt-3">All Rights Reserved © {{ date("Y") }}</span>
</div>
@else
<div class="logo d-fc">
<img src="{{ asset('images/logos/Logo-Geo-White.svg') }}">
<span class="white-text">{{ $tranCT->translate('all_rights_reserved') }} © {{ date("Y") }}</span>
</div>
<div class="right">
<div class="links d-fc">
<div class="d-flex">
<div class="left">
<a href="/about" class="gray-text mg">{{ $tranCT->translate('about_us') }}</a>
<a href="#" role="button" data-toggle="modal" data-target="#terms-modal" class="gray-text mg">{{ $tranCT->translate('terms_of_service') }}</a>
</div>
<div class="right">
<a href="/vacancies" class="gray-text">{{ $tranCT->translate('vacancies') }}</a>
<a href="/blog" class="gray-text">{{ $tranCT->translate('blog') }}</a>
</div>
</div>
<div class="icon-links">
<a href="https://www.facebook.com/metrixgeorgia/"><img src="{{ asset('images/homepage/facebook-white.svg') }}"></a>
<a href="#"><img src="{{ asset('images/homepage/instagram-white.svg') }}"></a>
</div>
</div>
</div>
@endif
</div>
</div>
</div>
@endif
</div>

@if ( isset($current_page) && $current_page == 'market' )
<div class="mobile-navigation-wrapper d-fc d-none" id="market">
<div class="layer-0 container-1280">
<button type="button" class="lg toggle-mobile-navbar-market"><i class="white" id="times"></i></button>
</div>
<div class="layer-1 container-1280 d-fc">
@foreach ( $product_categories['main'] as $main_index => $main )
<button type="button" data-toggle="collapse" data-target="#mobile-navbar-market-0-collapse-{{ $main_index }}" aria-expanded="false" aria-controls="mobile-navbar-market-0-collapse-{{ $main_index }}">{{ $main['title'] }}</button>
<div class="collapse mobile-navbar-collapse-0" id="mobile-navbar-market-0-collapse-{{ $main_index }}">
@foreach ( $product_categories['groups'] as $group_index => $group )
@if ( $group['belongs'] == $main['has'] )
<button type="button" data-toggle="collapse" data-target="#mobile-navbar-market-1-collapse-{{ $group_index }}" aria-expanded="false" aria-controls="mobile-navbar-market-1-collapse-{{ $group_index }}">{{ $group['title'] }}</button>
<div class="collapse mobile-navbar-collapse-1" id="mobile-navbar-market-1-collapse-{{ $group_index }}">
@foreach ( $product_categories['sub_groups'] as $sub_group_index => $sub_group )
@if ( $sub_group['belongs'] == $group['has'] )
<a href="/market?group={{ $sub_group['belongs'] }}&category={{ $sub_group['search_id'] }}">{{ $sub_group['title'] }}</a>
@endif
@endforeach
</div>
@endif
@endforeach
</div>
@endforeach
</div>
@if ( $agent->isMobile() )
<div class="layer-2">
<div class="footer-wrapper">
<div class="container-1280">
@if ( Session::get('locale') != 'ka' )
<div class="logo d-fc w-100 h-100">
<img src="{{ asset('images/logos/Logo-Eng.svg') }}" style="width: 220px; margin-top: 80px;" class="mx-auto">
<span class="gray-text text-center mt-3">All Rights Reserved © {{ date("Y") }}</span>
</div>
@else
<div class="logo d-fc">
<img src="{{ asset('images/logos/Logo-Geo-White.svg') }}">
<span class="white-text">{{ $tranCT->translate('all_rights_reserved') }} © {{ date("Y") }}</span>
</div>
<div class="right">
<div class="links d-fc">
<div class="d-flex">
<div class="left">
<a href="/about" class="gray-text mg">{{ $tranCT->translate('about_us') }}</a>
<a href="#" role="button" data-toggle="modal" data-target="#terms-modal" class="gray-text mg">{{ $tranCT->translate('terms_of_service') }}</a>
</div>
<div class="right">
<a href="/vacancies" class="gray-text">{{ $tranCT->translate('vacancies') }}</a>
<a href="/blog" class="gray-text">{{ $tranCT->translate('blog') }}</a>
</div>
</div>
<div class="icon-links">
<a href="https://www.facebook.com/metrixgeorgia/"><img src="{{ asset('images/homepage/facebook-white.svg') }}"></a>
<a href="#"><img src="{{ asset('images/homepage/instagram-white.svg') }}"></a>
</div>
</div>
</div>
@endif
</div>
</div>
</div>
@endif
</div>
@endif
@endif