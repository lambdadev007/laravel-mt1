@extends('user.layout')

@php
use Jenssegers\Agent\Agent;

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
<div class="furniture-wrapper d-fc">
<div class="universal-banner-wrapper darker">
<div class="image-wrapper">
@if ( @data['exists'] )
@php
$banner = $data['raw']['banner'];
if ( $agent->isMobile() ) $banner = $data['raw']['mob_banner'];
@endphp
<img src="{{ asset($banner) }}" alt="ავეჯის დამზადება">
@endif
{{-- <div class="background-layer"></div> --}}
</div>
<div class="text-wrapper">
{{-- <h1>ავეჯის დამზადება</h1> --}}
<p>{{ ($data['exists']) ? $data['banner_text'][Session::get('locale')] : '' }}</p>
</div>
</div>

<div class="top container-1280">
@if ( $data['exists'] && $data['content'] != [] )
@foreach ( $data['content']['cards'] as $index => $card )
<div class="universal-card d-fc service {{ (count($data['content']['cards']) < 4) ? 'three' : '' }}">
<h3>{{ $card['title'] }}</h3>
<p class="price">₾{{ $card['price'] }} <span>m2</span></p>
<p class="description">{{ $card['description'] }}</p>
<button type="button" class="bottom-button orange" data-toggle="modal" data-target="#card-modal-{{ $index }}">დაწვრილებით</button>
</div>
@endforeach
@endif
</div>

<div class="bottom d-fc container-1280">
<div class="section-title">
<i class="square"></i> <h2>რატომ კომპანია მეტრიქსი?</h2>
</div>
<div class="simple-universal-cards">
@if ( $data['exists'] )
@foreach ( ['certified', 'guarantee', 'clock', 'van'] as $index => $icon)
<div class="simple-universal-card d-fc">
<i class="yellow" id="{{ $icon }}"></i>
<h3>{{ $data['bottom'][Session::get('locale')][$index]['title'] }}</h3>
@if ( !$agent->isMobile() && !$agent->isTablet() )
<p>{!! $data['bottom'][Session::get('locale')][$index]['text'] !!}</p>
@endif
</div>
@endforeach
@endif
</div>
</div>
</div>

@include('user.components.service-modal')

@include('user.components.projects')
@include('user.components.partners')
@endsection