@php
use Jenssegers\Agent\Agent;

$agent = new Agent();

$locale_code = [
'ka' => 'ka-GE',
'it' => 'it-IT'
];
@endphp

<!doctype html>
<html lang="{{ $locale_code[Session::get('locale')] }}">
<head>
{{-- Meta --}}
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- <meta name="robots" content="noindex, nofollow">  --}}
<meta name="robots" content="index, all"> 
<meta name="resource-type" content="document">
<meta name="google-site-verification" content="1_5-TKWjTQCkSUevdrs802Csje3N9pwTRGkkGjxI1OU">
{{-- Meta --}}

@if ( View::hasSection('meta') )
@yield('meta')
@else
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="მეტრიქსი"/>
<meta property="og:description" content="მეტრიქსი"/>
<meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

<title>მეტრიქსი</title>
<meta name="keywords" content="მეტრიქსი">
<meta name="description" content="მეტრიქსი">
@endif

<link rel="icon" href="{{ asset('images/logos/logo.ico') }}">

{{-- CSS --}}
<link rel="stylesheet" href="{{ asset('masters/bootstrap-master/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('masters/fancybox-master/css/jquery.fancybox.min.css') }}">
<link rel="stylesheet" href="{{ asset('masters/noUiSlider-master/distribute/nouislider.min.css') }}">
@php
$load = 'desktop';
if ( $agent->isMobile() ) $load = 'mobile';
if ( $agent->isTablet() ) $load = 'tablet';
@endphp
<link rel="stylesheet" href="{{ asset('css/load-'. $load .'.css') }}">
{{-- CSS --}}

{{-- JS --}}
<script defer type="text/javascript" src="{{ asset('masters/owl-master/js/owl.carousel.min.js') }}"></script>
<script defer type="text/javascript" src="{{ asset('masters/fancybox-master/js/jquery.fancybox.min.js') }}"></script>
<script defer type="text/javascript" src="{{ asset('masters/noUiSlider-master/distribute/nouislider.min.js') }}"></script>
<script defer type="text/javascript" src="{{ asset('js/core.v026.js') }}"></script>
{{-- JS --}}
</head>

<body>
@yield('sdk')

@include('user.components.navbar')
@include('user.components.alerts')

<div class="toggle-market-dropdown"></div>

@yield('content')

@include('user.components.login-modal')
@include('user.components.cart-popup')
@include('user.components.terms-modal')
@include('user.components.market-modals')
@include('user.components.footer')


<script>
window.fbAsyncInit = function() {
FB.init({
appId      : '2741402162852590',
cookie     : true,
xfbml      : true,
version    : 'v8.0'
});

FB.AppEvents.logPageView();   

};

(function(d, s, id){
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function checkLoginState() {
FB.getLoginStatus(function(response) {
statusChangeCallback(response);
});
}

checkLoginState()

function getShareCount(){
url = $(".url").val();
api_url = 'https://graph.facebook.com/v3.0/?id='+url+'&fields=og_object{engagement}&access_token=2741402162852590|9b99c122df91489e6707290af32ea5c2';
$.ajax({
url:api_url,
type:'get',
success:function(res){
count = res.og_object.engagement.count;
text = res.og_object.engagement.social_sentence;
$(".result").html('<h3>'+count+' Shares<br>'+text+'</h3>');
closeSearch();
}
});
}
</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '2612653069042404');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=2612653069042404&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

{{-- <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-157511716-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-157511716-1');
</script> --}}

{{-- <div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
FB.init({
xfbml            : true,
version          : 'v7.0'
});
};

(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-customerchat"
attribution=setup_tool
page_id="102561327964627"
theme_color="#fbb040"
logged_in_greeting="მოგესალმებით! როგორ შეგვიძლია დაგეხმაროთ?"
logged_out_greeting="მოგესალმებით! როგორ შეგვიძლია დაგეხმაროთ?">
</div> --}}

{{-- JS --}}
<script type="text/javascript" src="{{ asset('masters/jquery-master/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/bootstrap.min.js') }}"></script>
@yield('js')
{{-- JS --}}
</body>
</html>