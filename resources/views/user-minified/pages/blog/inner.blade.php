@extends('user.layout')

@php
use Jenssegers\Agent\Agent;
use App\Http\Controllers\TranslationsCT;

$tranCT = new TranslationsCT();
$agent = new Agent();

$content = json_decode($data['article']['content'], true);
@endphp

@section('meta')
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="{{ $data['article']['meta_title'] }}"/>
<meta property="og:description" content="{{ $data['article']['meta_description'] }}"/>
<meta property="og:image" content="{{ asset($data['article']['card_image']) }}""/>

<title>{{ $data['article']['meta_title'] }}</title>
<meta name="keywords" content="{{ $data['article']['meta_keywords'] }}">
<meta name="description" content="{{ $data['article']['meta_description'] }}">
@endsection

@section('sdk')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ka_GE/sdk.js#xfbml=1&version=v3.0"></script>
<script>
window.twttr = (function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0],
t = window.twttr || {}
if (d.getElementById(id)) return t
js = d.createElement(s)
js.id = id
js.src = "https://platform.twitter.com/widgets.js"
fjs.parentNode.insertBefore(js, fjs)

t._e = []
t.ready = function(f) {
t._e.push(f)
}

return t
}(document, "script", "twitter-wjs"))
</script>
<script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: ka_GE</script>
@endsection

@section('content')
<style type="text/css">
@media(max-width: 1366px) {
.image-block {
/* justify-content: center; */
}

.image-block .magnify-icon {
width: 100% !important;
}

.image-block .magnify-icon img {
width: 100%;
height: auto;
max-height: 350px;
}
}
</style>

<style type="text/css">
.paragraph-block img {
width: 100% !important;
height: auto !important;
}
</style>

<div class="article-wrapper">
@if ( !$agent->isMobile() && !$agent->isTablet() ) {{-- Needs to be reverse --}}
<div class="side-block category-buttons">
<a href="{{ json_decode($data['article']['sidebar_links'])->furniture }}" class="{{ ($data['article']['category'] == 'furniture') ? 'active' : '' }}">
<i class="yellow" id="arrow-right"></i>
<i class="icon" id="couch"></i>
<p>{{ $tranCT->translate('furniture_crafting') }}</p>
</a>
<a href="{{ json_decode($data['article']['sidebar_links'])->vip }}" class="{{ ($data['article']['category'] == 'vip') ? 'active' : '' }}">
<i class="yellow" id="arrow-right"></i>
<i class="icon" id="wrench"></i>
<p>{{ $tranCT->translate('vip_master') }}</p>
</a>
<a href="{{ json_decode($data['article']['sidebar_links'])->design }}" class="{{ ($data['article']['category'] == 'design') ? 'active' : '' }}">
<i class="yellow" id="arrow-right"></i>
<i class="icon" id="paint-brush"></i>
<p>{{ $tranCT->translate('designer') }}</p>
</a>
<a href="{{ json_decode($data['article']['sidebar_links'])->repairs }}" class="{{ ($data['article']['category'] == 'repairs') ? 'active' : '' }}">
<i class="yellow" id="arrow-right"></i>
<i class="icon" id="paint-roller"></i>
<p>{{ $tranCT->translate('repairs') }}</p>
</a>
</div>
@endif

<div class="article container-800">
<div class="article-banner">
<img src="{{ asset( $data['article']['banner'] ) }}" alt="{{ $data['article']['title'] }}">
<div class="background-layer"></div>
<span class="floating-category yellow">{{ $tranCT->translate($data['article']['category']) }}</span>
<h1>{{ $data['article']['title'] }}</h1>
</div>

@if ( $agent->isMobile() || $agent->isTablet() )
<div class="category-buttons">
<a href="{{ json_decode($data['article']['sidebar_links'])->vip }}" class="{{ ($data['article']['category'] == 'vip') ? 'active' : '' }}">
<i class="yellow" id="arrow-right"></i>
<i class="icon" id="couch"></i>
<p>{{ $tranCT->translate('vip_master') }}</p>
</a>
<a href="{{ json_decode($data['article']['sidebar_links'])->design }}" class="{{ ($data['article']['category'] == 'design') ? 'active' : '' }}">
<i class="yellow" id="arrow-right"></i>
<i class="icon" id="wrench"></i>
<p>{{ $tranCT->translate('designer') }}</p>
</a>
<a href="{{ json_decode($data['article']['sidebar_links'])->furniture }}" class="{{ ($data['article']['category'] == 'furniture') ? 'active' : '' }}">
<i class="yellow" id="arrow-right"></i>
<i class="icon" id="paint-brush"></i>
<p>{{ $tranCT->translate('furniture_crafting') }}</p>
</a>
<a href="{{ json_decode($data['article']['sidebar_links'])->repairs }}" class="{{ ($data['article']['category'] == 'repairs') ? 'active' : '' }}">
<i class="yellow" id="arrow-right"></i>
<i class="icon" id="paint-roller"></i>
<p>{{ $tranCT->translate('repairs') }}</p>
</a>
</div>
@endif

<div class="top-info">
<div class="views">
<img src="{{ asset('images/articles/icon-views-yellow.svg') }}">
<span>{{ $data['article']['views'] }}</span>
</div>
<div class="shares">
<img src="{{ asset('images/articles/icon-share-yellow.svg') }}">
<span>76</span>
</div>
<span class="date">{{ $data['article']['date_created'] }}</span>
<span class="date ml-auto mr-0 d-flex align-items-center"><span class="mr-3">ავტორი:</span> <b style="font-family: var(--MyriadBold); display:inline;">{{ $data['article']['author'] }}</b></span>
</div>

<div class="article-content">
@if ( $agent->isMobile() || $agent->isTablet() )
<div class="right">
<div class="enlarge-text flex-column">
<div class="d-fc flex-row">
<button data-size="increase">+</button>
<button data-size="decrease">-</button>
</div>
<div class="line"></div>
</div>
</div>
<div class="left">
@isset ( $content['paragraph_block_0'] )
<div class="paragraph-block">
{!! $content['paragraph_block_0'] !!}
</div>
@endisset
<a href="{{ $content['spec_deal_url'] }}" class="special-deal">
<p class="static-size">{!! $content['spec_deal_text'] !!}</p>
@if ( $agent->isTablet() )
<button type="button" class="universal-button">{{ $tranCT->translate('learn_more') }}</button>
@else
<button type="button" class="universal-button"><i class="white" id="arrow-right"></i></button>
@endif
</a>
@isset ( $content['paragraph_block_1'] )
<div class="paragraph-block">
{!! $content['paragraph_block_1'] !!}
</div>
@endisset
<div class="image-block">
@if ( $data['article']['inner_images'] != 'null' )
@foreach (json_decode($data['article']['inner_images'], true) as $index => $value)
<button class="magnify-icon mb-4" data-fancybox="article-gallery" href="{{ asset($value) }}"><img src="{{ asset($value) }}" alt="{{ $data['article']['inner_image_alts'][$index] }}"></button>
@endforeach
@endif
</div>
@isset ( $content['paragraph_block_2'] )
<div class="paragraph-block">
{!! $content['paragraph_block_2'] !!}
</div>
@endisset
</div>

@else
@isset ( $content['paragraph_block_0'] )
<div class="paragraph-block">
{!! $content['paragraph_block_0'] !!}
</div>
@endisset
<a href="{{ $content['spec_deal_url'] }}" class="special-deal">
<p class="static-size">{!! $content['spec_deal_text'] !!}</p>
<button type="button" class="universal-button">{{ $tranCT->translate('learn_more') }}</button>
</a>
@isset ( $content['paragraph_block_1'] )
<div class="paragraph-block">
{!! $content['paragraph_block_1'] !!}
</div>
@endisset
<div class="image-block">
@if ( $data['article']['inner_images'] != 'null' )
@foreach (json_decode($data['article']['inner_images'], true) as $index => $value)
<button class="magnify-icon mb-4" data-fancybox="article-gallery" href="{{ asset($value) }}"><img src="{{ asset($value) }}" alt="{{ $data['article']['inner_image_alts'][$index] }}"></button>
@endforeach
@endif
</div>
@isset ( $content['paragraph_block_2'] )
<div class="paragraph-block">
{!! $content['paragraph_block_2'] !!}
</div>
@endisset
@endif
</div>
</div>

{{-- Enlarge Text Non Mobile --}}
@if ( !$agent->isMobile() && !$agent->isTablet() ) {{-- Needs to be reverse --}}
<div class="side-block right">
<div class="enlarge-text">
<div class="line"></div>
<div class="d-fc">
<button data-size="increase">+</button>
<button data-size="decrease">-</button>
</div>
</div>
</div>
@endif
{{-- Enlarge Text Non Mobile --}}
</div>

<div class="social container-800">
@if ( $agent->isMobile() )
<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="" data-layout="button" data-action="like" data-size="small" data-share="false"></div>
<div class="sharing">
<div class="icons">
<div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button" data-size="small"></div>

<a class="twitter-share-button" href="https://twitter.com/intent/tweet"></a>

<script type="IN/Share" data-url="{{ url()->current() }}"></script>
</div>
</div>
@else
<div class="fb-like" data-href="{{ url()->current() }}" data-layout="standard" data-action="like" data-show-faces="true"></div>
<div class="sharing">
@if ( !$agent->isTablet() )
<span class="text">{{ $tranCT->translate('share') }}: </span>
@endif
<div class="icons">
<div class="fb-share-button" data-href="{{ url()->current() }}" data-layout="button" data-size="small"></div>

<a class="twitter-share-button" href="https://twitter.com/intent/tweet"></a>

<script type="IN/Share" data-url="{{ url()->current() }}"></script>
</div>
</div>
@endif
</div>


@if ( $agent->isMobile() || $agent->isTablet() )
<div class="projects-slider-component-wrapper article">
<div class="opaque-slider article d-fc">
<span class="title container-800">{{ $tranCT->translate('similar_articles') }}</span>
<div class="similar-articles">
@foreach ($data['similar_articles'] as $similar_article)
<div class="carousel-block">
<a href="/blog/{{ $similar_article['slug'] }}">
<img src="{{ asset($similar_article['card_image']) }}">
<div class="background-layer"></div>
<span class="title">{{ $similar_article['title'] }}</span>
<span class="floating-category">{{ $tranCT->translate($similar_article['category']) }}</span>
</a>
</div>
@endforeach
</div>
</div>
</div>
@else
<div class="projects-slider-component-wrapper article">
<div class="opaque-slider article d-fc">
<span class="title container-800">{{ $tranCT->translate('similar_articles') }}</span>
<div class="carousel-wrapper">
<div class="owl-carousel projects-slider-component" id="articles">
@foreach ($data['similar_articles'] as $similar_article)
<div class="carousel-block">
<img src="{{ asset($similar_article['card_image']) }}" alt="{{ $similar_article['title'] }}">
<div class="background-layer"></div>
<span class="title">{{ $similar_article['title'] }}</span>
<div class="hover-layer d-fc">
<span class="title">{{ $similar_article['title'] }}</span>
{{-- <span class="category">{{ $category_translation[$similar_article['category']] }}</span> --}}
<p class="description">{{ $similar_article['card_description'] }}</p>
<a href="/blog/{{ $similar_article['slug'] }}">
<span>დაწვრილებით</span>
<img src="{{ asset('images/xd-icons/white/arrow-right.svg') }}">
</a>
</div>
</div>
@endforeach
</div>
<div class="opaque-blocks left"></div>
<div class="opaque-blocks right"></div>
</div>
</div>
</div>
@endif

<div class="comments container-800">
@if ( $agent->isMobile() )
<div class="fb-comments" data-href="{{ url()->current() }}" data-width="330" data-numposts="5" data-mobile="true"></div>
@elseif ( $agent->isTablet() )
<div class="fb-comments" data-href="{{ url()->current() }}" data-width="700" data-numposts="5" data-mobile="true"></div>
@else
<div class="fb-comments" data-href="{{ url()->current() }}" data-width="800" data-numposts="5"></div>
@endif
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function(){
$("#articles").owlCarousel({
rewind: true,
loop: true,
autoplay: true,
autoplayTimeout: 7000,
autoplayHoverPause: true,
smartSpeed: 1000,
dots: false,
nav: false,
autoWidth:false,
margin: 0,
responsive: {
1024: {
items: 5,
margin: 25
},
1920: {
items: 5,
margin: 50
}
}
})

$('.enlarge-text button').click(function() {
if ( $(this).data('size') == 'increase' ) {
$('.article-content h2, .article-content p:not(.static-size), .article-content span, .article-content li').each(function() {
$(this).css('font-size', parseInt($(this).css('font-size')) + 1)
})
} else if ( $(this).data('size') == 'decrease' ) {
$('.article-content h2, .article-content p:not(.static-size), .article-content span, .article-content li').each(function() {
$(this).css('font-size', parseInt($(this).css('font-size')) - 1)
})
}
})
})
</script>
@endsection