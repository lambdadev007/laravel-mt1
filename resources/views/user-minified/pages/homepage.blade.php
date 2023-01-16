@extends('user.layout')

@php
use Jenssegers\Agent\Agent;
use App\Http\Controllers\TranslationsCT;

$tranCT = new TranslationsCT();
$agent = new Agent();
@endphp

@if ( $data['exists'] )
@section('meta')
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="{{ $data['raw']['meta_title'] }}"/>
<meta property="og:description" content="{{ $data['raw']['meta_description'] }}"/>
<meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

<title>{{ $data['raw']['meta_title'] }}</title>
<meta name="keywords" content="{{ $data['raw']['meta_keywords'] }}">
<meta name="description" content="{{ $data['raw']['meta_description'] }}">
@endsection
@endif

@section('content')
<div class="homepage-wrapper d-fc">
@if ( $data['exists'] )
<div class="homepage-slider-wrapper">
<div class="owl-carousel owl-theme" id="homepage-slider">
@php
$slides = $data['slides'];
if ( $agent->isMobile() ) $slides = $data['mob_slides'];
@endphp
@foreach ( $slides as $slide )
<div class="carousel-block">
<img class="owl-lazy" data-src="{{ asset($slide['location']) }}" alt="{{ $slide['alt'] }}">
</div>
@endforeach
</div>
</div>
@endif

<div class="homepage-video-wrapper d-flex container-1280">
@if ( !$agent->isMobile() ) {{-- Needs to be reverse --}}
<div class="video">
{{-- <iframe src="https://www.youtube.com/embed/{{ ($data['exists']) ? $data['video']['video_link'] : 'C3iI6S7TuCA' }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
<div class="right-block"></div>
</div>
@endif
<div class="text d-fc">
<div class="upper">
<h3><i class="square"></i> {{ $tranCT->translate('about_metrix') }}</h3>
<p>{!! ($data['exists']) ? $data['video']['video_text'][Session::get('locale')] : '<strong>დააჭირეთ</strong> ტექსტი რომ შეცვალოთ' !!}</p>
</div>
<div class="lower">
<div class="left">
<a href="{{ ($data['exists']) ? $data['video']['video_button_link'] : '#' }}" class="universal-button orange">{{ $tranCT->translate('detailed') }}</a>
<i class="orange" id="arrow-right"></i>
</div>
<div class="right">
<span>{{ $tranCT->translate('befriend_us') }}</span>
<a class="fa" href="https://www.facebook.com/metrixgeorgia/"></a>
<a class="ig" href="#"></a>
</div>
</div>
<div class="bottom-line"></div>
</div>
</div>

<div class="about-service-wrapper d-fc">
@if ( !$agent->isMobile() ) {{-- Needs to be reverse --}}
<div class="about-service-guy">
<img src="{{ asset('images/homepage/about-service-guy.svg') }}">
</div>
@endif
<div class="category-buttons">
<a href="#avejis-damzadeba" id="furniture" class="">
<i class="white" id="arrow-right"></i>
<i id="couch"></i>
<p>{{ $tranCT->translate('furniture_crafting') }}</p>
</a>
<a href="#vip-masteri" id="vip-master" class="active">
<i class="white" id="arrow-right"></i>
<i id="wrench"></i>
<p>{{ $tranCT->translate('vip_master') }}</p>
</a>
<a href="#dizaineri" id="designer" class="">
<i class="white reverse" id="arrow-right"></i>
<i id="paint-brush"></i>
<p>{{ $tranCT->translate('designer') }}</p>
</a>
<a href="#remonti" id="repairs" class="">
<i class="white reverse" id="arrow-right"></i>
<i id="paint-roller"></i>
<p>{{ $tranCT->translate('repairs') }}</p>
</a>
</div>
<div class="service-text d-fc justify-content-center">
<div class="upper">
@if( !$agent->isMobile() ) {{-- Needs to be reverse --}} <span>{{ $tranCT->translate('about_service') }}</span> <i class="square"></i> @endif <strong>{{ $tranCT->translate('vip_master') }}</strong>
</div>
<div class="middle">
<p>{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_1'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}</p>
</div>
<div class="lower">
<a href="/vip-master" class="universal-button">{{ $tranCT->translate('detailed') }}</a>
</div>
</div>
</div>


@include('user.components.partners')
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function(){
$('.about-service-wrapper .category-buttons > a').each(function() {
$(this).click(function() {
$(this).siblings('a').removeClass('active')
$(this).addClass('active')

if ( $(this).attr('id') == 'furniture' ) {
$('.service-text .upper strong').text('{{ $tranCT->translate('furniture_crafting') }}')
$('.service-text .middle p').html('{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_0'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}')
$('.service-text .lower a').attr('href', 'furniture')
} else if ( $(this).attr('id') == 'vip-master' ) {
$('.service-text .upper strong').text('{{ $tranCT->translate('vip_master') }}')
$('.service-text .middle p').html('{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_1'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}')
$('.service-text .lower a').attr('href', 'vip-master')
} else if ( $(this).attr('id') == 'designer' ) {
$('.service-text .upper strong').text('{{ $tranCT->translate('designer') }}')
$('.service-text .middle p').html('{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_2'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}')
$('.service-text .lower a').attr('href', 'designer')
} else if ( $(this).attr('id') == 'repairs' ) {
$('.service-text .upper strong').text('{{ $tranCT->translate('repairs') }}')
$('.service-text .middle p').html('{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_3'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}')
$('.service-text .lower a').attr('href', 'repairs')
}
})
})

$('.projects-slider-wrapper .header .categories button').click(function() {
$(this).siblings('button').removeClass('active')
$(this).addClass('active')
})
})
</script>
@endsection