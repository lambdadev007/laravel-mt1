@php
    use Jenssegers\Agent\Agent;
    $agent = new Agent;

    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'confedentiality'               => 'კონფედენციალურობა',
            'rights'                        => 'ყველა უფლება დაცულია',
        ],
        'en' => [
            'confedentiality'               => 'Confedentiality',
            'rights'                        => 'All rights reserved',
        ]
    ]
@endphp

<div class="footer container-fluid mt-5 d-md-flex">
    <div class="footer-segment fs-logo">
        <img class="lazy" src="{{ asset('images/logos/Logo-Eng.svg') }}" alt="ლოგო">
    </div>
    <div class="footer-segment footer-pseudo-border">
        <ul>
            <li><a href="/about-us">{{ $TC->TG('company') }}</a></li>
            <li><a href="/about-us">{{ $TC->TG('team') }}</a></li>
            <li><a href="/about-us">{{ $TC->TG('mission') }}</a></li>
            <li><a href="/projects">{{ $TC->TG('projects') }}</a></li>
            <li><a href="/vacancies">{{ $TC->TG('vacancies') }}</a></li>
            <li><a href="/">{{ $TC->T($local, 'confedentiality') }}</a></li>
        </ul>
    </div>
    <div class="footer-segment footer-pseudo-border">
        <ul>
            <li><a href="/consultation">{{ $TC->TG('consultation') }}</a></li>
            <li><a href="/design">{{ $TC->TG('designer') }}</a></li>
            <li><a href="/repairs">{{ $TC->TG('repairs') }}</a></li>
            <li><a href="/furniture">{{ $TC->TG('furniture') }}</a></li>
            <li><a href="/vip-master">{{ $TC->TG('vip_master') }}</a></li>
            <li><a href="/cleaning">{{ $TC->TG('cleaning') }}</a></li>
        </ul>
    </div>
    <div class="footer-segment footer-pseudo-border fs-wide">
        <ul>
            <li><a href="/">{{ $TC->TG('online_market') }}</a></li>
            <li><a href="/offers">{{ $TC->TG('offers') }}</a></li>
            <li><a href="/articles">{{ $TC->TG('articles') }}</a></li>
            <li><a href="/payment">{{ $TC->TG('terms_of_payment') }}</a></li>
            <li><a href="/delivery">{{ $TC->TG('delivery_conditions') }}</a></li>
            <li><a href="/supplier">{{ $TC->TG('how_to_become_a_supplier') }}</a></li>
        </ul>
    </div>
    <div class="footer-segment fs-social">
        <div class="soc-icons">
            <a href="https://www.instagram.com/" target="_blank">
                <img class="lazy" src="{{ asset('images/logos/instagram_logo.svg') }}" alt="icon">
            </a>
            <a href="https://www.facebook.com/" target="_blank">
                <img class="lazy" src="{{ asset('images/logos/fb_logo.svg') }}" alt="icon">
            </a>
            <a href="" target="_blank">
                <img class="lazy" src="{{ asset('images/logos/youtube_logo.svg') }}" alt="icon">
            </a>
        </div>
        <div class="footer-contact">
            <div class="phone-numbers">
                <div class="phone-index">
                    <span>(597)</span>
                </div>
                <div class="phone-number">70 10 10</div>
            </div>
            <span><a href="#">{{ $TC->TG('contact_information') }}</a></span>
        </div>
    </div>
</div>
<div class="copyright d-none d-sm-none d-md-block" {{ ($agent->isMobile()) ? 'hidden' : '' }}>
    {{-- TOP.GE ASYNC COUNTER CODE --}}
        <div id="top-ge-counter-container" data-site-id="112437"></div>
        <script async defer src="https://counter.top.ge/counter.js"></script>
    {{-- END OF TOP.GE COUNTER CODE  --}}
    metrix.ge - 2018-2019 - © {{ $TC->T($local, 'rights') }}
</div>