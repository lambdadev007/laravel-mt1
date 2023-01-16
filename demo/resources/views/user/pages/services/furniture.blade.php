@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'metrix_superiority'            => 'მეტრიქსის უპირატესობები',
        ],
        'en' => [
            'metrix_superiority'            => 'Advantages of Metrix',
        ]
    ]
@endphp

@section('meta')
    <meta name="keywords" content="ავეჯის, aveji, მეტრიქსი, metrix">
    <meta name="description" content="ავეჯის, aveji, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>ავეჯი - {{ $TC->TG('html_title') }}</title>
@endsection

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.theme.default.min.css') }}">
@endsection

@section('defer_js')
    <script defer type="text/javascript" src="{{ asset('masters/owl-master/js/owl.carousel.min.js') }}"></script>    
@endsection

@section('content')
    
    <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('furniture') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/consultacion">{{ $TC->TG('services') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/furniture">{{ $TC->TG('furniture') }}</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">592 10 60 60</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    {{-- Owl Slider --}}
        <div class="universal-slider container-fluid">
            <div class="static-image">
                @foreach ( $data['advert'] as $advert)
                        <img class="lazy" src="{{ asset($advert['image']) }}" alt="{{ $TC->TG('furniture') }}">
                    @endforeach
            </div>
            <div class="owl-carousel owl-theme" id="owl-carousel">
                @foreach ($data['slides'] as $slide)
                    <div class="carousel-block">
                        <a href="{{ $slide['link'] }}">
                            <img class="lazy" src="{{ asset($slide['image']) }}" alt="{{ $TC->TG('furniture') }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    {{-- Owl Slider --}}

    <div class="furniture-wrapper container-fluid">
        <div class="furniture-links-wrapper">
            <a href="/furniture/gallery/kitchen">{{ $TC->TG('kitchen') }}</a>
            <a href="/furniture/gallery/reception">{{ $TC->TG('reception') }}</a>
            <a href="/furniture/gallery/childrens_room">{{ $TC->TG('childrens_room') }}</a>
            <a href="/furniture/gallery/sleeping_room">{{ $TC->TG('sleeping_room') }}</a>
            <a href="/furniture/gallery/office_furniture">{{ $TC->TG('office_furniture') }}</a>
            <a href="/furniture/gallery/soft_furniture">{{ $TC->TG('soft_furniture') }}</a>
        </div>

        <h2 class="section-title">{{ $TC->T($local, 'metrix_superiority') }}</h2>

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
                        <img class="lazy" src="{{ asset($data_content['image']) }}" alt="{{ $TC->TG('furniture') }}">
                        <p>{!! $data_content['description'] !!}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="furniture-bottom-wrapper">
            <div>
                <img src="{{ asset('images/furniture/projects.jpg') }}" alt="{{ $TC->TG('projects_works') }}">
                <a href="/projects/furniture">{{ $TC->TG('projects_works') }}</a>
            </div>
            <div>
                <img src="{{ asset('images/furniture/furniture-and-materials.jpg') }}" alt="{{ $TC->TG('furniture_materials') }}">
                <a href="/furniture/materials">{{ $TC->TG('furniture_materials') }}</a>
            </div>
        </div>
    </div>

    {{-- Divider Line --}}
        <div class="container-fluid mt-5">
            <div class="divider-line"></div>
        </div>
    {{-- Divider Line --}}

    @include('user.components.articles')

    @include('user.components.offers')

    {{-- Divider Line --}}
        <div class="container-fluid mt-5">
            <div class="divider-line"></div>
        </div>
    {{-- Divider Line --}}

    @include('user.components.partners')
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 7000,
                autoplayHoverPause: true,
                smartSpeed: 1000,
                dots: true
            })

            $("#partners").owlCarousel({
                items: 3,
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 500,
                margin: 40,
                responsive: {
                    1200 : {
                        items: 7
                    },
                    768 : {
                        items: 5
                    }
                }
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