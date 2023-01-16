@php
use Jenssegers\Agent\Agent;
use App\Http\Controllers\TranslationsCT;

use App\Models\CompanyHotline;
use App\Models\Contact;

$mail = '';
if ( Contact::where('id', 1)->exists() ) {
$mail = Contact::find(1)->mail;
}

$company_hotline = [
'call_phone_number' => '+995592104040',
'visible_phone_number' => '592 10 40 40'
];

if ( CompanyHotline::where('id', 1)->exists() && !isset($data['is_vip_number']) ) {
$company_hotline = CompanyHotline::where('id', 1)->get(['call_phone_number', 'visible_phone_number'])->first()->toArray();
} elseif ( isset($data['is_vip_number']) ) {
$company_hotline = CompanyHotline::where('id', 1)->get(['call_phone_vip_number', 'visible_phone_vip_number'])->first()->toArray();
$company_hotline = [
'call_phone_number' => $company_hotline['call_phone_vip_number'],
'visible_phone_number' => $company_hotline['visible_phone_vip_number']
];
}

$tranCT = new TranslationsCT();
$agent = new Agent();
@endphp

<div class="footer-wrapper">
<div class="container-1280">
@if ( Session::get('locale') != 'ka' )
<div class="logo d-fc w-100 h-100">
<img src="{{ asset('images/logos/Logo-Eng.svg') }}" style="width: 220px; margin-top: 80px;" class="mx-auto">
<span class="gray-text text-center mt-3">All Rights Reserved © {{ date("Y") }}</span>
</div>
@else
<div class="logo d-fc">
<img src="{{ asset('images/logos/Logo-Geo.svg') }}">
<span class="gray-text">{{ $tranCT->translate('all_rights_reserved') }} © {{ date("Y") }}</span>
</div>
@if ( !$agent->isMobile() ) {{-- Needs to be reverse --}}
<div class="left">
<div class="links d-fc">
<h5><img src="{{ asset('images/homepage/pin.svg') }}" class="icon"> <span>{{ $tranCT->translate('how_to_contact_us') }}</span></h5>
<a href="#" role="button" class="gray-text">ადამ მიცკევიჩის 29 ბ</a>
@if ( Session::get('locale') == 'it' )
<a href="tel:+393518911175" role="button" class="gray-text">+39 351 891 11 75</a>
@else
<a href="tel:{{ $company_hotline['call_phone_number'] }}" role="button" class="gray-text">+995 {{ $company_hotline['visible_phone_number'] }}</a>
@endif
<a href="#" role="button" class="gray-text">{{ $mail }}</a>
<a href="/contact" class="colored">{{ $tranCT->translate('contact_form') }}</a>
</div>
</div>
<div class="middle">
<div class="links d-fc">
<h5><img src="{{ asset('images/homepage/cog-wheel.svg') }}" class="icon"> <span>{{ $tranCT->translate('what_do_we_provide') }}</span></h5>
<a href="/repairs" class="gray-text">{{ $tranCT->translate('designer') }}</a>
<a href="/designer" class="gray-text">{{ $tranCT->translate('repairs') }}</a>
<a href="/furniture" class="gray-text">{{ $tranCT->translate('furniture_crafting') }}</a>
<a href="/vip-master" class="gray-text">{{ $tranCT->translate('vip_master') }}</a>
</div>
</div>
@endif
<div class="right">
<div class="links d-fc">
@if ( $agent->isMobile() )
<div class="d-flex">
<div class="left">
<a href="/about" class="gray-text mg">{{ $tranCT->translate('about_us') }}</a>
<a href="#" role="button" data-toggle="modal" data-target="#terms-modal" class="gray-text mg">{{ $tranCT->translate('terms_of_service') }}</a>
</div>
<div class="right">
<a href="/vacancies" class="gray-text">{{ $tranCT->translate('vacancies') }}</a>
<a href="/blog" class="gray-text">{{ $tranCT->translate('blog') }}</a>
</div>
</div>
<div class="icon-links">
<a href="https://www.facebook.com/metrixgeorgia/"><img src="{{ asset('images/homepage/facebook-gray.svg') }}"></a>
<a href="#"><img src="{{ asset('images/homepage/instagram-gray.svg') }}"></a>
</div>
@else
<a href="/about" class="gray-text">{{ $tranCT->translate('about_us') }}</a>
<a href="/vacancies" class="gray-text">{{ $tranCT->translate('vacancies') }}</a>
<a href="#" role="button" data-toggle="modal" data-target="#terms-modal" class="gray-text">{{ $tranCT->translate('terms_of_service') }}</a>
<a href="/blog" class="gray-text">{{ $tranCT->translate('blog') }}</a>
<div class="icon-links">
<a href="https://www.facebook.com/metrixgeorgia/"><img src="{{ asset('images/homepage/facebook-gray.svg') }}"></a>
<a href="#"><img src="{{ asset('images/homepage/instagram-gray.svg') }}"></a>
</div>
@endif
</div>
</div>
@endif
</div>
</div>