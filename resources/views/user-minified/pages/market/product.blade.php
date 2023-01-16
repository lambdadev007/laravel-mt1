@extends('user.layout')

@php
use Jenssegers\Agent\Agent;

$agent = new Agent();
@endphp

@section('meta')
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="{{ $product['meta_title'] }}"/>
<meta property="og:description" content="{{ $product['meta_description'] }}"/>
<meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

<title>{{ $product['meta_title'] }}</title>
<meta name="keywords" content="{{ $product['meta_keywords'] }}">
<meta name="description" content="{{ $product['meta_description'] }}">
@endsection

@section('content')
<div class="market-wrapper d-fc product">
<div class="top container-1280">
@if ( $agent->isMobile() )

@else
<div class="left">
<button type="button" class="toggle-market-all-categories-popup"><i class="orange" id="market-bars"></i> ყველა კატეგორია</button>
<div class="market-crumbs">
<a href="/market?group={{ $product['belongs_category'] }}">ლაქ-საღებავები</a>
<i class="dark-gray" id="market-arrow"></i>
<a href="/market?group={{ $product['belongs_category'] }}&category={{ $product['belongs_sub_category'] }}">საღებავი</a>
<i class="dark-gray" id="market-arrow"></i>
<a href="#">{{ $product['card_description'] }}</a>
</div>
</div>
@endif
</div>
<div class="middle container-1280">
<div class="left d-fc">
<img src="{{ asset($product['image']) }}" alt="{{ $product['image_alt'] }}">
</div>
<div class="middle d-fc">
<div class="layer-0">
<p class="company-name">{{ $product['brand'] }}</p>
<p class="item-id">ID: #{{ $product['id'] }}</p>
</div>
<div class="layer-1">
<h1>{{ $product['name'] }}</h1>
@if ( $product['has_variants'] == 'true' )
<div class="select-wrapper market">
<select class="variant-select" id="product-variant-select" data-counter="#product-counter">
@foreach ( json_decode($product['variants'], true) as $variant )
<option value="{{ $variant['prices'] }}">{{ $variant['weights'] }}{{ $product['measuring'] }}</option>
@endforeach
</select>
<i class="dark" id="market-arrow"></i>
</div>
@endif
</div>
<div class="layer-2">
@php
$price = $product['price'];
if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
$price = number_format(round($price, 2), 2, '.', '');
@endphp
@if ( $agent->isMobile() )
<div 
class="counter market" 
id="product-counter" 
data-amount="1" 
data-price="{{ $product['price'] }}"
data-discount="{{ $product['discount'] }}" 
data-discount-amount="{{ $product['discount_amount'] }}" 
data-has-variants="{{ $product['has_variants'] }}" 
data-variant-select="#product-variant-select" 
data-target="#product-inner-price" 
data-discount-target="#product-inner-discount">
<i class="dark reverse" id="market-arrow"></i>
<input class="counter-input w-100 text-center border-0" type="number" value="1">
<i class="dark" id="market-arrow"></i>
</div>
@endif
<p class="price" id="product-inner-price">₾ {{ $price }}</p>
@if ( $product['discount'] == 'true' )
<p class="discount" id="product-inner-discount">₾ {{ number_format(round($product['price'], 2), 2, '.', '') }}</p>
@endif
</div>
<div class="layer-3 d-fc">
<span class="item-description-header">პროდუქტის მოკლე აღწერა:</span>
<p class="item-description">{!! $product['description'] !!}</p>
</div>
@if ( !$agent->isMobile() )
<div class="layer-4">
<div 
class="counter market" 
id="product-counter" 
data-amount="1" 
data-price="{{ $product['price'] }}"
data-discount="{{ $product['discount'] }}" 
data-discount-amount="{{ $product['discount_amount'] }}" 
data-has-variants="{{ $product['has_variants'] }}" 
data-variant-select="#product-variant-select" 
data-target="#product-inner-price" 
data-discount-target="#product-inner-discount">
<i class="dark reverse" id="market-arrow"></i>
<input class="counter-input w-100 text-center border-0" type="number" value="1">
<i class="dark" id="market-arrow"></i>
</div>
<button type="button" class="market-buy" data-toggle="modal" data-target="#choose-address">ყიდვა <i class="white" id="arrow-right"></i></button>
</div>
@endif
</div>
@if ( !$agent->isMobile() )
<div class="product-navigation d-fc">
<div class="split-button">
<button type="button" class="cart-action no-reload" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id={{ ($product['has_variants'] == 'true') ? 0 : 'null' }}><i class="dark" id="market-cart-empty"></i> კალათაში დამატება</button>
</div>
<div class="price d-fc">
<span>ან განვადებით თვეში</span>
<p>₾ 28.00 <span>- დან</span></p>
</div>
<a href="#" class="tbc-sakhartvelo" id="tbc"><i id="market-tbc"></i> <strong>თიბისი</strong> ბანკი <i class="blue" id="arrow-right"></i></a>
<a href="#" class="tbc-sakhartvelo" id="sakhartvelo"><i id="market-sakhartvelo"></i> <strong>საქართველოს</strong> ბანკი <i class="orange" id="arrow-right"></i></a>
<button type="button">წესები და პირობები</button>
</div>
@endif
</div>
<div class="bottom d-fc container-1280">
<h5><i class="square"></i> დამატებითი ინფორმაცია</h5>
<div class="additional-information-wrapper d-fc">
@foreach ( json_decode($product['additional_information'], true) as $additional_information )
<div class="additional-information">
<p>{!! $additional_information['left'] !!}</p>
<p>{!! $additional_information['right'] !!}</p>
</div>
@endforeach
</div>
</div>
@if ( $agent->isMobile() )
<div class="buy-cart container-1280">
<button type="button" class="market-buy" data-toggle="modal" data-target="#choose-address">ყიდვა <i class="white" id="arrow-right"></i></button>
<button type="button" class="cart-action no-reload" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id={{ ($product['has_variants'] == 'true') ? 0 : 'null' }}><i class="dark" id="market-cart-empty"></i></button>
</div>
@endif
</div>

@include('user.components.similar-products')
@if ( !$agent->isMobile() )
@include('user.components.all-categories-popup')
@endif
@endsection