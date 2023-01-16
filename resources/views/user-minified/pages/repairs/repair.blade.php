@extends('user.layout')

@php
use Jenssegers\Agent\Agent;
use App\Http\Controllers\TranslationsCT;

use App\Models\CompanyHotline;

$tranCT = new TranslationsCT();
$agent = new Agent();

$company_hotline = [
'call_phone_number' => 'tel:+995597701010',
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
<div class="repairs-wrapper d-fc">
<div class="universal-banner-wrapper darker">
<div class="image-wrapper">
{{-- @if ( @data['exists'] )
@php
$banner = $data['raw']['banner'];
if ( $agent->isMobile() ) $banner = $data['raw']['mob_banner'];
@endphp
<img src="{{ asset($banner) }}" alt="რემონტი">
@endif --}}
{{-- <div class="background-layer"></div> --}}
</div>
<div class="text-wrapper">
{{-- <h1>რემონტი</h1> --}}
{{-- <p>{{ ($data['exists']) ? $data['banner_text'][Session::get('locale')] : '' }}</p> --}}
</div>
</div>


</div>

<div id="modals-wrapper">
@if ( $data['exists'] && $data['content'] != [] )
<div class="modal-custom modal-service">
<div class="universal-banner-wrapper">
<div class="image-wrapper">
<img src="{{ asset($data['content']['modal']['banner_location']) }}" alt="{{ $data['content']['modal']['banner_alt'] }}">
<div class="background-layer"></div>
</div>
<div class="text-wrapper">
<h2>{{ $data['content']['modal']['title'] }}</h2>
<p>{{ $data['content']['modal']['description'] }}</p>
</div>
</div>

<p class="information container-1000">{!! $data['content']['modal']['information'] !!}</p>

<div class="lists d-fc {{ $agent->isDesktop() ? 'container-1000' : '' }}">
@if ( array_key_exists('modal_lists', $data['content']) )
@foreach ( $data['content']['modal_lists'] as $list )
@if ( $list['belongs'] == $data['content']['modal']['has'] )
@if ( $list['has_stages'] == 'true' )
<div class="list-wrapper d-fc w-100">
<div class="title has-stages">
<h3>{{ $list['title'] }}</h3> @if ( !$agent->isMobile() && !$agent->isTablet() ) <i class="square"></i> @endif
@if ( array_key_exists('modal_stages', $data['content']) )
<div class="stages-wrapper">
@foreach ( $data['content']['modal_stages'] as $stage_index => $stage )        
@if ( $list['has'] == $stage['belongs'] )
<button class="user-service-stage-toggle {{ $stage['first'] == 'true' ? 'active' : '' }}" data-target="{{ $stage['has'] }}">{{ $stage['name'] }}</button>
@endif
@endforeach
</div>
@endif
</div>
<div class="list d-fc">
@if ( array_key_exists('modal_list_items', $data['content']) )
@foreach ( $data['content']['modal_list_items'] as $index => $list_item)
@if ( $list_item['belongs'] == $list['has'] )
@if ( $list_item['type'] == 'double' )
<div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
<p>{!! $list_item['left_text'] !!}</p>
<span>{!! $list_item['right_text'] !!}</span>
</div>
@elseif ( $list_item['type'] == 'red' )
<div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
<p>{!! $list_item['left_text'] !!}</p>
<span><i class="red" id="times"></i></span>
</div>
@elseif ( $list_item['type'] == 'green' )
<div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
<p>{!! $list_item['left_text'] !!}</p>
<span><i class="green" id="checkmark"></i></span>
</div>
@endif
@endif
@endforeach
@endif
</div>
</div>
@else
<div class="list-wrapper d-fc w-100">
<div class="title">
<h3 class="{{ !$agent->isDesktop() ? 'ml-2' : '' }}">{{ $list['title'] }}</h3>
</div>
<div class="list d-fc">
@if ( array_key_exists('modal_list_items', $data['content']) )
@foreach ( $data['content']['modal_list_items'] as $index => $list_item)
@if ( $list_item['belongs'] == $list['has'] )
@if ( $list_item['type'] == 'double' )
<div class="item">
<p>{!! $list_item['left_text'] !!}</p>
<span>{!! $list_item['right_text'] !!}</span>
</div>
@elseif ( $list_item['type'] == 'red' )
<div class="item">
<p>{!! $list_item['left_text'] !!}</p>
<span><i class="red" id="times"></i></span>
</div>
@elseif ( $list_item['type'] == 'green' )
<div class="item">
<p>{!! $list_item['left_text'] !!}</p>
<span><i class="green" id="checkmark"></i></span>
</div>
@endif
@endif
@endforeach
@endif
</div>
</div>
@endif
@endif
@endforeach
@endif
</div>
<div class="bottom-buttons justify-content-center">
<a href="tel:{{ $company_hotline['call_phone_number'] }}"><i class="dark" id="awesome-phone"></i> {{ $company_hotline['visible_phone_number'] }}</a>
<button type="button">{{ $tranCT->translate('order') }}</button>
</div>
</div>
@endif
</div>

@include('user.components.projects')
@include('user.components.partners')
@endsection