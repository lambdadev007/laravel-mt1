@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'service_prices'                => 'ხელობის ფასები',
            'work_type'                     => 'სამუშაოს ტიპი',
            'general_pricing'                 => 'საშუალოდ ფასი',
        ],
        'en' => [
            'service_prices'                => 'Service Prices',
            'work_type'                     => 'Work type',
            'general_pricing'                 => 'General pricing',
        ]
    ];
@endphp

@section('meta')
    <meta name="keywords" content="რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>რემონტი - {{ $TC->TG('html_title') }}</title>
@endsection

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.theme.default.min.css') }}">
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('repairs') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/consultacion">{{ $TC->TG('services') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/repairs">{{ $TC->TG('repairs') }}</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    {{-- Owl Slider --}}
        <div class="universal-slider container-fluid mb-2">
            <div class="static-image with-important-text">
                @foreach ( $data['advert'] as $advert)
                        <img class="lazy" src="{{ asset($advert['image']) }}" alt="{{ $TC->TG('repairs') }}">
                    @endforeach
                <div class="important-text-wrapper">
                    <span class="important-text mx-auto" data-scroll-to=".info-box-wrapper">{{ $TC->T($local, 'service_prices') }}</span>
                </div>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach ($data['slides'] as $slide)
                    <div class="carousel-block">
                        <img class="lazy" src="{{ asset($slide['image']) }}" alt="{{ $TC->TG('repairs') }}">
                    </div>
                @endforeach
            </div>
        </div>
    {{-- Owl Slider --}}

    <div class="repairs-wrapper container-fluid">
        {{-- Colored Sections --}}
            <div class="row mb-4">
                @foreach (['first', 'second', 'third'] as $numbers_index => $numbers)
                    <div class="{{ $numbers }} col-sm-12 col-md-4">
                        <div class="category-wrapper">
                            @if ( array_key_exists($numbers_index, $data['category']) )
                                <h5>{{ $data['category'][$numbers_index]['title'] }}</h5>
                                <span>{{ $data['category'][$numbers_index]['price'] }}-<span class="dire-lari"></span></span>
                                <p>{{ $data['category'][$numbers_index]['description'] }}</p>
                            @else
                                <h5>{{ $TC->TG('title') }}</h5>
                                <span>{{ $TC->TG('price') }}-<span class="dire-lari"></span></span>
                                <p>{{ $TC->TG('description') }}</p>
                            @endif
                        </div>
                        
                        <div class="sub-category-wrapper">
                            @foreach ($data['sub_category'][$numbers] as $sub_category_index => $sub_category)
                                <div class="sub-category">
                                    <span class="title">{{ $sub_category['title'] }}</span>

                                    <div class="sub-category-text-wrapper">
                                        @foreach ($data['sub_category_text'] as $sub_category_text_index => $sub_category_text)
                                            @if ( $sub_category['has'] == $sub_category_text['belongs'] )
                                                <div class="sub-category-text">
                                                    <span>{{ $sub_category_text['description'] }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        {{-- Colored Sections --}}

        {{-- Info Box --}}
            <div class="info-box-wrapper">
                <div class="info-box-top repairs">
                    <span>{{ $TC->T($local, 'work_type') }}</span>
                    <span class="info-box-media-title">{{ $TC->TG('description') }}</span>
                    <span class="info-box-last-title">{{ $TC->T($local, 'general_pricing') }}</span>
                </div>
                
                <div class="info-box-body">
                    @foreach ($data['prices'] as $index => $price)
                        <div class="info-box">
                            <div class="info-box-bold">
                                <span>{{ $price['title'] }}</span>
                            </div>

                            <div class="info-box-text">
                                <p>{{ $price['description'] }}</p>
                            </div>

                            <div class="info-box-price">
                                <span>{{ $price['price'] }} <span class="dire-lari"></span></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        {{-- Info Box --}}
    </div>

    @include('user.components.offers')
@endsection

@section('defer_js')
    <script defer type="text/javascript" src="{{ asset('masters/owl-master/js/owl.carousel.min.js') }}"></script>    
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 7000,
                autoplayHoverPause: true,
                smartSpeed: 1000,
                dots: true
            })
            
            $('.design-information .category-selector li').click(function(){
                $('.design-information .category-selector li').removeClass('active')
                $('.design-information .category-data li').removeClass('show')
                $(this).addClass('active')
                $(`.design-information .category-data li[data-index="${$(this).data('index')}"]`).addClass('show')
            })

        })

    </script>
@endsection
