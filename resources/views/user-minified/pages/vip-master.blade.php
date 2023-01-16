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
<meta property="og:title" content="{{ $data['meta'][$data['meta_index']]['meta_title'] }}"/>
<meta property="og:description" content="{{ $data['meta'][$data['meta_index']]['meta_description'] }}"/>
<meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

<title>{{ $data['meta'][$data['meta_index']]['meta_title'] }}</title>
<meta name="keywords" content="{{ $data['meta'][$data['meta_index']]['meta_keywords'] }}">
<meta name="description" content="{{ $data['meta'][$data['meta_index']]['meta_description'] }}">
@endsection
@endif

@section('content')
<div class="vip-master-wrapper d-fc">
<div class="universal-banner-wrapper">
<div class="image-wrapper">
@if ( $data['exists'] )
@php
$banner = $data['raw']['banner'];
if ( $agent->isMobile() ) $banner = $data['raw']['mob_banner'];
@endphp
<img src="{{ asset($banner) }}" alt="VIP მასტერი">
@endif
{{-- <div class="background-layer"></div> --}}
</div>
<div class="text-wrapper">
{{-- <h1>VIP - მასტერი</h1> --}}
<p>{{ ($data['exists']) ? $data['raw']['banner_text_'. Session::get('locale')] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}</p>
</div>
</div>

<div class="container-1280 content">
<div class="left d-fc">
<div class="sticky-wrapper">
@if ( $agent->isMobile() )
<div class="top d-fc">
<div class="select-wrapper">
<i class="gray white" id="glass"></i>
<select id="vip-master-change-category">
<option value="kar-fanjara-da-saketebi" data-icon="glass" {{ ($data['action'] == 'kar-fanjara-da-saketebi') ? 'selected' : '' }}>{{ $tranCT->translate('doors_windows_locks') }}</option>
<option value="eleqtrooba" data-icon="energy" {{ ($data['action'] == 'eleqtrooba') ? 'selected' : '' }}>{{ $tranCT->translate('electricity') }}</option>
<option value="kanalizacia" data-icon="pipe" {{ ($data['action'] == 'kanalizacia') ? 'selected' : '' }}>{{ $tranCT->translate('sewerage') }}</option>
<option value="santeqnika" data-icon="tap" {{ ($data['action'] == 'santeqnika') ? 'selected' : '' }}>{{ $tranCT->translate('plumbing') }}</option>
<option value="gatboba-kondicireba" data-icon="air-conditioner" {{ ($data['action'] == 'gatboba-kondicireba') ? 'selected' : '' }}>{{ $tranCT->translate('heating_conditioning') }}</option>
<option value="sakhopacxovrebo-teqnika" data-icon="washing-machine" {{ ($data['action'] == 'sakhopacxovrebo-teqnika') ? 'selected' : '' }}>{{ $tranCT->translate('home_appliances') }}</option>
<option value="universaluri-samushaoebi" data-icon="gear" {{ ($data['action'] == 'universaluri-samushaoebi') ? 'selected' : '' }}>{{ $tranCT->translate('universal_works') }}</option>
</select>
<i class="white" id="nav-arrow"></i>
</div>
</div>
@else
<div class="top d-fc">
{{-- <button class="navigation active" data-has="kar-fanjara-da-saketebi">
<span><i class="gray white" id="glass"></i> კარ-ფანჯარა და საკეტები</span> 
<i class="yellow white" id="nav-arrow"></i>
</button> --}}
@php
$categories = [
'kar-fanjara-da-saketebi' => $tranCT->translate('doors_windows_locks'),
'eleqtrooba' => $tranCT->translate('electricity'),
'kanalizacia' => $tranCT->translate('sewerage'),
'santeqnika' => $tranCT->translate('plumbing'),
'gatboba-kondicireba' => $tranCT->translate('heating_conditioning'),
'sakhopacxovrebo-teqnika' => $tranCT->translate('home_appliances'),
'universaluri-samushaoebi' => $tranCT->translate('universal_works')
];

$icons = [
'kar-fanjara-da-saketebi' => 'glass',
'eleqtrooba' => 'energy',
'kanalizacia' => 'pipe',
'santeqnika' => 'tap',
'gatboba-kondicireba' => 'air-conditioner',
'sakhopacxovrebo-teqnika' => 'washing-machine',
'universaluri-samushaoebi' => 'gear'
];
@endphp
@foreach ( $categories as $index => $category )    
<a class="navigation {{ ($data['action'] == $index) ? 'active' : '' }}" href="/vip-master/{{ $index }}">
<span><i class="gray {{ ($data['action'] == $index) ? 'white' : '' }}" id="{{ $icons[$index] }}"></i> {{ $category }}</span> 
<i class="yellow {{ ($data['action'] == $index) ? 'white' : '' }}" id="nav-arrow"></i>
</a>
@endforeach
</div>
<div class="bottom">
<div class="left"><i class="white" id="user"></i></div>
<div class="right"><p>{{ (!$agent->isTablet()) ? $tranCT->translate('available') : '' }} <strong>{{ $data['workforce_counter'] }} {{ $tranCT->translate('specialist') }}</strong></p></div>
</div>    
@endif
</div>
</div>

<div class="right d-fc">
@if ( $data['exists'] )
@foreach ( ['kar-fanjara-da-saketebi', 'eleqtrooba', 'kanalizacia', 'santeqnika', 'gatboba-kondicireba', 'sakhopacxovrebo-teqnika', 'universaluri-samushaoebi'] as $i => $item )
@if ( $data['action'] == $item )
<div class="category d-fc" id="{{ $item }}">
@foreach ( $data['dropdowns_'. Session::get('locale')] as $dropdown )
@if ( $dropdown['belongs'] == $i )
<div class="universal-dropdowns">
<button type="button" data-toggle="collapse" data-target="#vip-dropdown-{{ $dropdown['has'] }}" aria-expanded="true" aria-controls="vip-dropdown-{{ $dropdown['has'] }}">
<p>{{ $dropdown['text'] }}</p>
<span class="gray">{{ $dropdown['price'] }}</span>
<span class="icon-wrapper"><i class="white" id="nav-arrow"></i></span>
</button>
<div class="collapse show" id="vip-dropdown-{{ $dropdown['has'] }}">
<div class="universal-dropdown-items d-fc">
{{-- @foreach ( $data['services_'. Session::get('locale')] as $index => $service ) --}}
@foreach ( $data['services'] as $index => $service )
@if ( $service['belongs'] == $dropdown['has'] )
<div class="universal-dropdown-item">
<p>{{ $service['outside_title'] }}</p>
<a href="/vip-services/{{ $service['slug'] }}">{{ $tranCT->translate('order') }}</a>
{{-- <button type="button" data-toggle="modal" data-target="#vip-modal" data-id="{{ $service['id'] }}">{{ $tranCT->translate('order') }}</button> --}}
</div>
@endif
@endforeach
</div>
</div>
</div>
@endif
@endforeach
</div>
@endif
@endforeach
@endif
</div>
</div>

<div class="modal fade modal-background" id="vip-modal" tabindex="-1" role="dialog" aria-labelledby="vip-modal-label" aria-hidden="true">
<div class="modal-dialog modal-custom modal-vip-master modal-910 modal-dialog-centered" role="document">
<div class="modal-content">
<div class="top-misc">
<h3 class="modal-title">{{ $tranCT->translate('place_an_order') }}</h3>
<span class="close-modal" data-dismiss="modal">&times</span>
</div>
<form class="container-790 d-fc" method="post" action="/order/vip">
@csrf
<div class="top d-fc">
<div class="title">
<h3>{{ $tranCT->translate('vip_master') }}</h3> @if ( !$agent->isMobile() && !$agent->isTablet() ) <i class="square"></i> @endif <p>{{ $tranCT->translate('wooden_door_installation') }}</p>
</div>
<div class="inputs">
<input type="text" name="name" placeholder="{{ $tranCT->translate('your_name') }}" value="{{ old('name') }}">
<input type="text" name="last_name" placeholder="{{ $tranCT->translate('last_name') }}" value="{{ old('last_name') }}">
<div class="number-input-wrapper"><input type="number" name="phone_number" value="{{ old('phone_number') }}" placeholder="{{ $tranCT->translate('phone_number') }}"> <div class="icon-wrapper"><i class="white" id="envelope"></i></div></div>
<div class="select-wrapper">
<select name="city">
<option disabled selected>{{ $tranCT->translate('specify_city') }}</option>
@if ( $data['order_info']['exists'] )
@foreach ( $data['order_info']['content']['cities'] as $city )
<option value="{{ $city }}">{{ $city }}</option>
@endforeach
@endif
</select>
<i class="orange" id="nav-arrow"></i>
</div>
<div class="select-wrapper">
<select name="region">
<option disabled selected>{{ $tranCT->translate('region') }}</option>
@if ( $data['order_info']['exists'] )
@foreach ( $data['order_info']['content']['regions'] as $region )
<option value="{{ $region }}">{{ $region }}</option>
@endforeach
@endif
</select>
<i class="orange" id="nav-arrow"></i>
</div>
<input type="text" name="" placeholder="{{ $tranCT->translate('sms_code') }}" style="opacity:0;">
</div>
</div>

<div class="bottom d-fc">
<div class="title"><h3>{{ $tranCT->translate('when_should_we_contact_you') }}</h3></div>
<div class="inputs">
<div class="left">
<label class="d-flex align-items-center mb-0">
<label class="universal-radio-wrapper">
<input type="radio" name="date_type" value="any_time"> <div class="before"></div> <div class="after"></div>
</label>
<p>{{ $tranCT->translate('any_time') }}</p>    
</label>
</div>
<div class="right">
<label class="d-flex align-items-center mb-0">
<label class="universal-radio-wrapper"><input type="radio" name="date_type" value="defined_time" checked> <div class="before"></div> <div class="after"></div></label>
<p>{{ $tranCT->translate('specific_time') }}:</p>
</label>
<div class="d-flex ml-auto">
<div class="select-wrapper date">
<select name="date">
<option disabled selected>{{ $tranCT->translate('date') }}</option>
@if ( $data['order_info']['exists'] )
@foreach ( $data['order_info']['content']['dates'] as $date )
<option value="{{ $date }}">{{ $date }}</option>
@endforeach
@endif
</select>
<i class="yellow" id="nav-arrow"></i>
</div>
<div class="select-wrapper time">
<select name="time_frame">
<option disabled selected>{{ $tranCT->translate('time_frame') }}</option>
@if ( $data['order_info']['exists'] )
@foreach ( $data['order_info']['content']['time_frames'] as $time_frame )
<option value="{{ $time_frame }}">{{ $time_frame }}</option>
@endforeach
@endif
</select>
<i class="yellow" id="nav-arrow"></i>
</div>
</div>
</div>
</div>
</div>

<input type="hidden" name="service_id" value="" required>

<div class="submit-wrapper">
<label class="universal-checkbox-wrapper terms"><input type="checkbox" required> <div class="before"></div> <div class="after"></div></label>
<p>{{ $tranCT->translate('i_agree') }} <a href="#">{{ $tranCT->translate('website_rules') }}</a></p>
<button type="submit">{{ $tranCT->translate('order') }}</button>
</div>
</form>
</div>
</div>
</div>
</div>
@endsection