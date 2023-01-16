@php
use Jenssegers\Agent\Agent;
use App\Http\Controllers\TranslationsCT;

$tranCT = new TranslationsCT();
$agent = new Agent();

$amount = count($data['projects']);
$upper_items = array_slice($data['projects'], 0, $amount / 2);
$lower_items = array_slice($data['projects'], $amount / 2);
@endphp

<div class="projects-slider-component-wrapper d-fc">
<div class="header container-1280">
<span class="title">{{ $tranCT->translate('featured_works') }}</span>
<i class="square"></i>
<div class="categories">
@if ( $agent->isMobile() )
<select>
<option value="" selected>{{ $tranCT->translate('all') }}</option>
<option value="">{{ $tranCT->translate('designer') }}</option>
<option value="">{{ $tranCT->translate('repairs') }}</option>
<option value="">{{ $tranCT->translate('furniture_crafting') }}</option>
<option value="">{{ $tranCT->translate('vip_master') }}</option>
</select>
<i class="gray" id="arrow-right"></i>
@else
<button type="button">{{ $tranCT->translate('designer') }}</button>
<button type="button">{{ $tranCT->translate('repairs') }}</button>
<button type="button">{{ $tranCT->translate('furniture_crafting') }}</button>
<button type="button">{{ $tranCT->translate('vip_master') }}</button>
<button type="button" class="active">{{ $tranCT->translate('all') }}</button>
@endif
</div>
</div>

<div class="owl-carousel projects-slider-component top" id="p-s-c-t">
@foreach ($upper_items as $item)
@php
$item['categories'] = json_decode($item['categories']);
$title = json_decode($item['title'], true)[Session::get('locale')];
@endphp
<div class="carousel-block">
<img class="owl-lazy" data-src="{{ asset(json_decode($item['card_image'])->location) }}" alt="{{ json_decode($item['card_image'])->alt }}">
<div class="background-layer"></div>
<span class="title">{{ $title }}</span>
<span class="category">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</span>
@if ( $item['in_progress'] == 'true' )
<div class="in-progress">
<img src="{{ asset('images/homepage/in-progress-cog.svg') }}">
<span>{{ $tranCT->translate('ongoing') }}</span>
</div>
@endif
<div class="hover-layer d-fc">
<span class="title">{{ $title }}</span>
{{-- <span class="category">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</span> --}}
{{-- <p class="description">{{ json_decode($item['card_info'], true)[Session::get('locale')] }}</p> --}}
<p class="description">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</p>
<a href="/projects?open={{ $item['id'] }}">
<span>{{ $tranCT->translate('detailed') }}</span>
<img src="{{ asset('images/xd-icons/white/arrow-right.svg') }}">
</a>
</div>
</div>
@endforeach
</div>

<div class="owl-carousel projects-slider-component bottom" id="p-s-c-b">
@foreach ($lower_items as $item)
@php
$item['categories'] = json_decode($item['categories']);
$title = json_decode($item['title'], true)[Session::get('locale')];
@endphp
<div class="carousel-block">
<img class="owl-lazy" data-src="{{ asset(json_decode($item['card_image'])->location) }}" alt="{{ json_decode($item['card_image'])->alt }}">
<div class="background-layer"></div>
<span class="title">{{ $title }}</span>
<span class="category">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</span>
@if ( $item['in_progress'] == 'true' )
<div class="in-progress">
<img src="{{ asset('images/homepage/in-progress-cog.svg') }}">
<span>{{ $tranCT->translate('ongoing') }}</span>
</div>
@endif
<div class="hover-layer d-fc">
<span class="title">{{ $title }}</span>
{{-- <span class="category">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</span> --}}
{{-- <p class="description">{{ json_decode($item['card_info'], true)[Session::get('locale')] }}</p> --}}
<p class="description">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</p>
<a href="/projects?open={{ $item['id'] }}">
<span>{{ $tranCT->translate('detailed') }}</span>
<img src="{{ asset('images/xd-icons/white/arrow-right.svg') }}">
</a>
</div>
</div>
@endforeach
</div>
</div>