@extends('user.layout')

@php
use Jenssegers\Agent\Agent;

$agent = new Agent();
@endphp

@section('content')
@if ( $agent->isMobile() || $agent->isTablet() )
<div class="market-wrapper purchase-history no-bg d-fc d-none" id="sort">
<div class="top container-1280">
<div class="select-wrapper">
<select id="change-page">
<option value="profile">მომხმარებლის პროფილი</option>
<option value="purchase-history" selected>შეკვეთების ისტორია</option>
</select>
<i class="orange" id="market-arrow"></i>
</div>
<button type="button" class="toggle-mobile-market" data-target="#main"><i class="orange" id="times"></i></button>
</div>
<div class="right container-1280">
<div class="select-wrapper">
<select name="" class="market-top-filter">
<option value="" selected>დან</option>
</select>
<i class="dark-gray" id="market-arrow"></i>
</div>
<div class="select-wrapper">
<select name="" class="market-top-filter">
<option value="" selected>მდე</option>
</select>
<i class="dark-gray" id="market-arrow"></i>
</div>
<div class="select-wrapper">
<select name="" class="market-top-filter">
<option value="" selected>შეკვეთის სტატუსი</option>
</select>
<i class="dark-gray" id="market-arrow"></i>
</div>
<div class="purchase-history-search">
<input type="text" name="" placeholder="შეკვეთის კოდი">
<div class="icon-wrapper">
<i class="white" id="market-magnifying-glass"></i>
</div>
</div>
</div>
</div>
@endif

<div class="market-wrapper purchase-history no-bg d-fc" id="main">
<div class="top container-1280">
@if ( $agent->isMobile() || $agent->isTablet() )
<div class="select-wrapper">
<select id="change-page">
<option value="profile">მომხმარებლის პროფილი</option>
<option value="purchase-history" selected>შეკვეთების ისტორია</option>
</select>
<i class="orange" id="market-arrow"></i>
</div>
<button type="button" class="toggle-mobile-market" data-target="#sort"><i class="orange" id="mobile-sort"></i></button>
@else
<div class="left">
<button type="button" class="toggle-market-all-categories-popup"><i class="orange" id="market-bars"></i> ყველა კატეგორია</button>
<div class="market-crumbs">
<a href="/purchase-history">შეკვეთების ისტორია</a>
</div>
</div>
@endif
@if ( !$agent->isMobile() && !$agent->isTablet() )
<div class="right">
<div class="select-wrapper">
<select name="" class="market-top-filter">
<option value="" selected>დან</option>
</select>
<i class="dark-gray" id="market-arrow"></i>
</div>
<div class="select-wrapper">
<select name="" class="market-top-filter">
<option value="" selected>მდე</option>
</select>
<i class="dark-gray" id="market-arrow"></i>
</div>
<div class="select-wrapper">
<select name="" class="market-top-filter">
<option value="" selected>შეკვეთის სტატუსი</option>
</select>
<i class="dark-gray" id="market-arrow"></i>
</div>
<div class="purchase-history-search">
<input type="text" name="" placeholder="შეკვეთის კოდი">
<div class="icon-wrapper">
<i class="white" id="market-magnifying-glass"></i>
</div>
</div>
</div>
@endif
</div>
<div class="middle container-1280">
@if ( !$agent->isMobile() && !$agent->isTablet() )
<div class="left">
<div class="top">
<a class="item" href="/profile">მომხმარებლის პროფილი</a>
<a class="item active" href="/purchase-history">შეკვეთების ისტორია</a>
<a class="item" href="/cart" class="active">კალათა</a>
</div>
</div>
@endif
<div class="middle d-fc">
<div class="top">
<span>შეკვეთის თარიღი</span>
<span>შეკვეთის კოდი</span>
<span>შეკვეთის სტატუსი</span>
<span>ჯამი</span>
<span>ინვოისი</span>
</div>
<div class="list d-fc">
<div class="item">
<span class="i-1">4/17/{{ date("Y") }}</span>
<span class="i-2">#1515448</span>
<span class="i-3 in-progress">მიმდინარე</span>
<span class="i-4">₾ 52.00</span>
<a href="#" class="i-5">გადმოწერა</a>
</div>
<div class="item">
<span class="i-1">4/17/{{ date("Y") }}</span>
<span class="i-2">#1515448</span>
<span class="i-3 complete">მიმდინარე</span>
<span class="i-4">₾ 52.00</span>
<a href="#" class="i-5">გადმოწერა</a>
</div>
</div>
</div>
</div>
</div>

@include('user.components.all-categories-popup')
@endsection