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
<div class="designer-wrapper d-fc">
<div class="universal-banner-wrapper darker">
<div class="image-wrapper">
@if ( @data['exists'] )
@php
$banner = $data['raw']['banner'];
if ( $agent->isMobile() ) $banner = $data['raw']['mob_banner'];
@endphp
<img src="{{ asset($banner) }}" alt="დიზაინერი">
@endif
{{-- <div class="background-layer"></div> --}}
</div>
<div class="text-wrapper">
{{-- <h1>დიზაინერი</h1> --}}
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
<button type="button" class="bottom-button" data-toggle="modal" data-target="#card-modal-{{ $index }}">{{ $tranCT->translate('detailed') }}</button>
</div>
@endforeach
@endif
</div>

<div class="middle d-fc container-1280">
<div class="categories">
@if ( $data['exists'] && $data['tabs'] != [] )
@foreach ( $data['tabs'] as $index => $tab )
<button type="button" class="designer-tab-buttons {{ ($index == 0) ? 'active' : '' }}" id="designer-tab-button-{{ $index }}" data-target="#designer-tab-{{ $index }}">{{ $tab[Session::get('locale')]['title'] }}</button>
@endforeach
@endif
</div>
<div class="information position-relative">
@if ( $data['exists'] && $data['tabs'] != [] )
@foreach ( $data['tabs'] as $index => $tab )
<div class="tab {{ ($index == 0) ? '' : 'hidden' }}" id="designer-tab-{{ $index }}">
<div class="left">
<img src="{{ asset($tab['image_location']) }}" alt="{{ $tab['image_alt'] }}">
<div class="background-layer"></div>
</div>
<div class="right d-fc">
<div class="title">
<h3>{{ $tranCT->translate('design_style') }}</h3>
<i class="square"></i>
<span>{{ $tab[Session::get('locale')]['title'] }}</span>
</div>

<div class="text">{!! $tab[Session::get('locale')]['text'] !!}</div>
</div>
</div>
@endforeach
@endif
</div>
</div>

@if ( $data['exists'] )
<div class="bottom d-fc container-1280">
<div class="section-title">
<i class="square"></i> <h2>{{ $tranCT->translate('from_render_to_reality') }}</h2>
</div>

<div class="images">
@foreach (['left', 'right'] as $direction)
<div class="{{ $direction }}">
@php
$i = [];
if ( $direction == 'left' ) $i = [0,1];
if ( $direction == 'right' ) $i = [2,3];
@endphp
@foreach ($i as $in) 
<button class="magnify-icon" data-fancybox="render-reality" href="{{ asset($data['render'][$in]['location']) }}"><img src="{{ asset($data['render'][$in]['location']) }}" alt="{{ asset($data['render'][$in]['alt']) }}"></button>
@endforeach
<div class="floating-text">
<p>{{ $tranCT->translate('render') }}</p>
<div class="line"></div>
<p>{{ $tranCT->translate('reality') }}</p>
</div>
</div>
@endforeach
</div>
</div>
@endif
</div>

@include('user.components.service-modal')

@include('user.components.projects')
@include('user.components.partners')
@endsection