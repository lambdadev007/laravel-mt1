@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();
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
    <style type="text/css">
        .universal-card.service .bottom-button.active {
            color: rgb(var(--k-white));
            border-color: transparent;
            background-color: rgb(var(--k-white));
        }
        .universal-card.service .bottom-button.active::after {transform: scaleY(1);}
    </style>

    <div class="repairs-wrapper d-fc">
        <div class="universal-banner-wrapper darker">
            <div class="image-wrapper">
                @if ( @data['exists'] )
                    @php
                        $banner = $data['raw']['banner'];
                        if ( $agent->isMobile() ) $banner = $data['raw']['mob_banner'];
                    @endphp
                    <img src="{{ asset($banner) }}" alt="რემონტი">
                @endif
                {{-- <div class="background-layer"></div> --}}
            </div>
            <div class="text-wrapper">
                {{-- <h1>რემონტი</h1> --}}
                <p>{{ ($data['exists']) ? $data['banner_text'][Session::get('locale')] : '' }}</p>
            </div>
        </div>

        <div class="top container-1280">
            @if ( $data['exists'] && $data['content'] != [] )
                @foreach ( $data['content']['cards'] as $index => $card )
                    <div class="universal-card d-fc service {{ (count($data['content']['cards']) < 4) ? 'three' : '' }}">
                        <h3>{{ $card['title'] }}</h3>
                        @if ( $index === 0 )
                            <p class="price">₾{{ $card['price'] }} <i class="square ml-2" style="transform: scale(2)"></i></p>
                        @else
                            <p class="price">₾{{ $card['price'] }} <span>m2</span></p>
                        @endif
                        <p class="description">{{ $card['description'] }}</p>
                        {{-- <button type="button" class="bottom-button" data-toggle="modal" data-target="#card-modal-{{ $index }}">დაწვრილებით</button> --}}
                        <a href="/repair/{{ $index }}" class="bottom-button {{ $index }}">დაწვრილებით</a>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="middle d-fc container-1280">
            <div class="section-title">
                <i class="square"></i> <h2>რატომ კომპანია მეტრიქსი?</h2>
            </div>
            <div class="simple-universal-cards">
                @if ( $data['exists'] )
                    @foreach ( ['tablet-document', 'medal', 'hourglass', 'guarantee'] as $index => $icon)
                        <div class="simple-universal-card d-fc">
                            <i class="orange" id="{{ $icon }}"></i>
                            <h3>{{ $data['middle'][Session::get('locale')][$index]['title'] }}</h3>
                            @if ( !$agent->isMobile() )
                                <p>{!! $data['middle'][Session::get('locale')][$index]['text'] !!}</p>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="bottom d-fc container-1280">
            <div class="section-title">
                <i class="square"></i> <h2>როგორ ვმუშაობთ?</h2>
            </div>
            @if ( $data['exists'] )
                @if ( $agent->isMobile() )
                    <div class="simple-universal-tabs">
                        @foreach ( ['phone-call', 'ruler', 'color-wheel', 'paint-bucket', 'contract', 'handshake'] as $index => $icon )
                            <div class="carousel-block tab d-fc">
                                <i class="dark" id="{{ $icon }}"></i>
                                <p>{!! $data['bottom'][Session::get('locale')][$index]['text'] !!}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="simple-universal-tabs">
                        @if ( $data['exists'] )
                            @foreach ( ['phone-call', 'ruler', 'color-wheel', 'paint-bucket', 'contract', 'handshake'] as $index => $icon )
                                <div class="tab d-fc">
                                    <i class="dark" id="{{ $icon }}"></i>
                                    <p>{!! $data['bottom'][Session::get('locale')][$index]['text'] !!}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            @endif
        </div>
    </div>

    @include('user.components.service-modal')

    @include('user.components.services')
    @include('user.components.partners')
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).scroll(function() {
                let selector = '.universal-card.service .bottom-button.0'
                if ( $(window).scrollTop() > 300 ) {
                    if ( !$(selector).hasClass('active') ) $(selector).addClass('active')
                } else {
                    if ( $(selector).hasClass('active') ) $(selector).removeClass('active')
                }
            })
        })
    </script>
@endsection