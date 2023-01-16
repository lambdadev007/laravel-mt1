@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'catalogues'                => 'კატალოგები'
        ],
        'en' => [
            'catalogues'                => 'Catalogues'
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
        <h3 class="page-title">{{ $TC->TG('furniture_materials') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/furniture">{{ $TC->TG('services') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/furniture">{{ $TC->TG('furniture') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/furniture-materials">{{ $TC->TG('furniture_materials') }}</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    <div class="furniture-materials-wrapper container-fluid">
        <div class="content-wrapper">
            @if ( $data['content'] != [] )
                <img src="{{ asset('images/furniture-materials/furniture-materials-banner.jpg') }}" alt="furniture-materials">
                <p>{!! $data['content'][0]['description'] !!}</p>
            @else
                <img src="{{ asset('images/furniture-materials/furniture-materials-banner.jpg') }}" alt="furniture-materials">
            @endif
        </div>

        <h2 class="section-title">{{ $TC->T($local, 'catalogues') }}</h2>

        <div class="catalogue-wrapper">
            @foreach ($data['catalogue'] as $catalogue)
                <div class="catalogue">
                    <img class="image" src="{{ asset($catalogue['image']) }}" alt="Catalogue Icon">
                    <a href="{{ asset($catalogue['link']) }}">{{ $catalogue['title'] }}</a>
                    <a class="pdf-icon-wrapper" href="{{ asset($catalogue['link']) }}"><img class="pdf_icon" src="{{ asset('images/svg_icons/pdf_icon.png') }}" alt="Pdf"></a>
                </div>
            @endforeach
        </div>
    </div>

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
        })
    </script>
@endsection