@php
    use Jenssegers\Agent\Agent;
    $agent = new Agent;

    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

<div class="index-slider container-fluid px-0">
    {{-- Owl Slider --}}
        <div class="universal-slider container-fluid">
            @if ( !$agent->isMobile() )
                <div class="static-image">
                    @foreach ( $data['advert'] as $advert)
                        <img class="lazy" src="{{ asset($advert['image']) }}" alt="{{ $TC->TG('homepage') }}">
                    @endforeach
                </div>
            @endif
            <div class="owl-carousel owl-theme" id="index-slider">
                @foreach ($data['slides'] as $slide)
                    <div class="carousel-block">
                        <img class="lazy" src="{{ asset($slide['image']) }}" alt="{{ $TC->TG('homepage') }}">
                    </div>
                @endforeach
            </div>
        </div>
    {{-- Owl Slider --}}

    {{-- Slider Bottom --}}
        <div class="container-fluid index-slider-bottom px-0">
            <div class="row index-slider-navigation">
                <div class="col-12 px-0 index-slider-navigation-top-border"></div>

                <div class="col-12 index-slider-links-wrapper">
                    <a href="/" data-slide="market" class="index-slider-link">
                        <div class="index-slider-icon-wrapper">
                            <span class="dire-shop-online-s"></span>
                        </div>
                        <div class="index-slider-slide-title">{{ $TC->TG('online_market') }}</div>
                    </a>
                    <a href="/consultation" data-slide="consultation" class="index-slider-link">
                        <div class="index-slider-icon-wrapper">
                            <span class="dire-consulting-s"></span>
                        </div>
                        <div class="index-slider-slide-title">{{ $TC->TG('consultation') }}</div>
                    </a>
                    <a href="/design" data-slide="design" class="index-slider-link">
                        <div class="index-slider-icon-wrapper">
                            <span class="dire-design-s"></span>
                        </div>
                        <div class="index-slider-slide-title">{{ $TC->TG('designer') }}</div>
                    </a>
                    <a href="/repairs" data-slide="repairs" class="index-slider-link">
                        <div class="index-slider-icon-wrapper">
                            <span class="dire-renovation-s"></span>
                        </div>
                        <div class="index-slider-slide-title">{{ $TC->TG('repairs') }}</div>
                    </a>
                    <a href="/furniture" data-slide="furniture" class="index-slider-link">
                        <div class="index-slider-icon-wrapper">
                            <span class="dire-furniture-s"></span>
                        </div>
                        <div class="index-slider-slide-title">{{ $TC->TG('furniture') }}</div>
                    </a>
                    <a href="/vip-master" data-slide="master" class="index-slider-link">
                        <div class="index-slider-icon-wrapper">
                            <span class="dire-master-s"></span>
                        </div>
                        <div class="index-slider-slide-title">{{ $TC->TG('vip_master') }}</div>
                    </a>
                    <a href="/cleaning" data-slide="cleaning" class="index-slider-link">
                        <div class="index-slider-icon-wrapper border-0">
                            <span class="dire-cleaning-s"></span>
                        </div>
                        <div class="index-slider-slide-title">{{ $TC->TG('cleaning') }}</div>
                    </a>
                </div>

                <div class="index-slider-navigation-bg">
                    <div class="upper-bg"></div>
                    <div class="middle-bg"></div>
                    <div class="lower-bg"></div>
                </div>
            </div>
        </div>
    {{-- Slider Bottom --}}
</div>