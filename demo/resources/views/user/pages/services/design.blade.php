@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'render'                    => 'რენდერი',
            'reality'                   => 'რეალობა',
            'articles_about_design'     => 'სტატიები და რჩევები დიზაინის სფეროში',
        ],
        'en' => [
            'render'                    => 'Render',
            'reality'                   => 'Reality',
            'articles_about_design'     => 'Articles and tips about design',
        ]
    ];
@endphp

@section('meta')
    <meta name="keywords" content="დიზაინერი, dizaineri, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="დიზაინერი, dizaineri, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>დიზაინერი, {{ $TC->TG('html_title') }}</title>
@endsection

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.theme.default.min.css') }}">
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('design') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/consultacion">{{ $TC->TG('services') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/design">{{ $TC->TG('design') }}</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">592 10 40 40</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    <div class="design-wrapper container-fluid">
        {{-- Design Top --}}
            <div class="design-top-section">
                {{-- Owl Slider --}}
                    <div class="universal-slider">
                        <div class="static-image">
                            @foreach ( $data['advert'] as $advert)
                                <img class="lazy" src="{{ asset($advert['image']) }}" alt="{{ $TC->TG('design') }}">
                            @endforeach
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach ($data['slides'] as $slide)
                                <div class="carousel-block">
                                    <img class="lazy" src="{{ asset($slide['image']) }}" alt="დიზაინი">
                                </div>
                            @endforeach
                        </div>
                    </div>
                {{-- Owl Slider --}}

                <div class="design-information">
                    <ul class="category-selector">
                        @foreach ($data['content'] as $index => $data_category)
                            <li class="{{ ($index == 0) ? 'active' : '' }}" data-index="{{ $index }}">
                                <div style=""></div>
                                <span>{{ $data_category['title'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="category-data">
                        @foreach ($data['content'] as $index => $data_content)
                            <li class="{{ ($index == 0) ? 'show' : '' }}" data-index="{{ $index }}">
                                <div class="important-text-wrapper">
                                    <h5 class="important-text"> {{ $data_content['title'] }} </h5>
                                </div>
                                <img class="lazy" src="{{ asset($data_content['image']) }}" alt="დიზაინი">
                                <p>{!! $data_content['description'] !!}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        {{-- Design Top --}}

        {{-- Design Bottom --}}
            <div class="design-bottom-section">
                @if ( $data['bottom_text'] != [] )
                    <div class="important-text-wrapper">
                        <h5 class="important-text">{{ $data['bottom_text'][0]['title'] }}</h5>
                    </div>
                    <p>{{ $data['bottom_text'][0]['text'] }}</p>
                @else
                    <div class="important-text-wrapper">
                        <h5 class="important-text">{{ $TC->TG('title') }}</h5>
                    </div>
                    <p>{{ $TC->TG('description') }}</p>
                @endif
                <div class="bottom-images-wrapper">
                    <div>
                        @foreach ( $data['design_left_pic'] as $left_pic)
                            <img class="lazy" src="{{ asset($left_pic['image']) }}" alt="რენდერი">
                        @endforeach
                        <span>{{ $TC->T($local, 'render') }}</span>
                    </div>
                    <div>
                        @foreach ( $data['design_right_pic'] as $right_pic)
                            <img class="lazy" src="{{ asset($right_pic['image']) }}" alt="რეალობა">
                        @endforeach
                        <span>{{ $TC->T($local, 'reality') }}</span>
                    </div>
                </div>
                <a href="/articles/design" class="split-button mx-auto mt-md-5 mt-4">
                    <span class="dire-right-arrow-s"></span>
                    <span>{{ $TC->T($local, 'articles_about_design') }}</span>
                </a>
            </div>
        {{-- Design Bottom --}}
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
