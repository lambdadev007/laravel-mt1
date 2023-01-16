@extends('user.layout')

@section('content')
<div class="market-wrapper cart no-bg d-fc">
<div class="top container-1280">
<div class="left">
<button type="button" class="toggle-market-all-categories-popup"><i class="orange" id="market-bars"></i> ყველა კატეგორია</button>
<div class="market-crumbs">
<a href="/cart">კალათა</a>
</div>
</div>
</div>
<div class="middle container-1280">
<div class="left">
<div class="top">
<a class="item" href="/profile">მომხმარებლის პროფილი</a>
<a class="item" href="/purchase-history">შეკვეთების ისტორია</a>
<a class="item active" href="/cart" class="active">კალათა</a>
</div>
<div class="total d-fc">
@php
$total_price = 0;
@endphp
@foreach ( $products_cookie as $item )
@php
$price = $item['price'];
if ( $item['discount'] == 'true' ) $price = $item['price'] * $item['discount_amount'];

if ( $item['has_variants'] == 'true' ) {
foreach (json_decode(Cookie::get('products_cookie_000'), true)[$item['id']]['variants'] as $cookie_variant_id) {
foreach ( json_decode($item['variants'], true) as $variant_index => $variant ) {
if ( $variant_index == $cookie_variant_id ) {
$variant_prices[$cookie_variant_id] = $variant['prices'];
if ( $item['discount'] == 'true' ) $variant_prices[$cookie_variant_id] = $variant['prices'] * $item['discount_amount'];
}
}
$total_price += $variant_prices[$cookie_variant_id];
}
} else {
$total_price += $price;
}

$total_price = number_format(round($total_price, 2), 2, '.', '');
@endphp
@endforeach
<span>სულ:<strong id="product-page-total">₾ {{ number_format(round($total_price, 2), 2, '.', '') }}</strong></span>
<button class="market-buy" data-toggle="modal" data-target="#choose-address">ყიდვა <i class="white" id="arrow-right"></i></button>
</div>
<div class="product-navigation">
<div class="price d-fc">
<span>ან განვადებით თვეში</span>
<p>₾ 28.00 <span>- დან</span></p>
</div>
<a href="#" class="tbc-sakhartvelo" id="tbc"><i id="market-tbc"></i> <strong>თიბისი</strong> ბანკი <i class="blue" id="arrow-right"></i></a>
<a href="#" class="tbc-sakhartvelo" id="sakhartvelo"><i id="market-sakhartvelo"></i> <strong>საქართველოს</strong> ბანკი <i class="orange" id="arrow-right"></i></a>
<button type="button">წესები და პირობები</button>
</div>
</div>
<div class="middle d-fc">
<div class="top d-flex">
<span class="left">ნივთი</span>
<span class="middle">რაოდენობა</span>
<span class="right">ფასი სულ</span>
</div>
<div class="line"></div>
<div class="list d-fc">
@foreach (json_decode(Cookie::get('products_cookie_000'), true)[$item['id']]['variants'] as $cookie_variant_id)
@foreach ( json_decode($item['variants'], true) as $variant_index => $variant )
<div class="item d-flex">
<div class="left d-flex">
<img src="{{ asset($item['image']) }}" alt="{{ $item['image_alt'] }}">
<div class="d-fc">
<p class="company">{{ $item['brand'] }}</p>
<p class="name">{!! $item['name'] !!}</p>
@if ( $item['has_variants'] == 'true' )
<div class="select-wrapper market">
<select class="variant-select" id="product-page-variant-select-{{ $item['id'] }}-{{ $cookie_variant_id }}" data-counter="#product-page-counter-{{ $item['id'] }}-{{ $cookie_variant_id }}">
@foreach ( json_decode($item['variants'], true) as $variant_index => $variant )
<option value="{{ $variant['prices'] }}" {{ ($variant_index == $cookie_variant_id) ? 'selected' : '' }}>{{ $variant['weights'] }}{{ $item['measuring'] }}</option>
@endforeach
</select>
<i class="dark" id="market-arrow"></i>
</div>
@endif
</div>
</div>

<div class="middle">
<div 
class="counter market" 
id="product-page-counter-{{ $item['id'] }}-{{ $cookie_variant_id }}"
data-amount="1" 
data-price="{{ $item['price'] }}"
data-discount="{{ $item['discount'] }}" 
data-discount-amount="{{ $item['discount_amount'] }}" 
data-has-variants="{{ $item['has_variants'] }}" 
data-variant-select="#product-page-variant-select-{{ $item['id'] }}-{{ $cookie_variant_id }}" 
data-target="#cart-total-price-{{ $item['id'] }}-{{ $cookie_variant_id }}" 
data-total="#product-page-total" 
data-total-type="page">
<i class="orange reverse" id="market-arrow"></i>
<span>1</span>
<i class="orange" id="market-arrow"></i>
</div>
</div>

<div class="right">
@php
$price = $variant['prices'];
if ( $item['discount'] == 'true' ) $price = $variant['prices'] * $item['discount_amount'];
$price = number_format(round($price, 2), 2, '.', '');
@endphp
<p class="price" id="cart-total-price-{{ $item['id'] }}-{{ $cookie_variant_id }}" data-price="{{ $price }}">₾ {{ $price }}</p>
<button class="remove-this-item cart-action {{ (Request::path() == 'cart' || Request::path() == 'market') ? '' : 'no-reload' }}" data-parent=".item" data-key="{{ $item['id'] }}" data-action="remove" data-amount="single">&times</button>
</div>
</div>
@endforeach
@endforeach
</div>
</div>
</div>
</div>

@include('user.components.all-categories-popup')
@endsection