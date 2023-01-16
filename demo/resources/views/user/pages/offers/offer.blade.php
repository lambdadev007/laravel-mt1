@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'offer_conditions'           => 'აქციის პირობები'
        ],
        'en' => [
            'offer_conditions'           => 'Offer conditions'
        ]
    ]
@endphp

@section('meta')
        <meta name="keywords" content="{{ $offer['seo_keywords'] }}">
        <meta name="description" content="{{ $offer['seo_description'] }}">
        <title>{{ $offer['title'] }}</title>
@endsection

@section('content')
    <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('offers') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Offer Header --}}
        <div class="article-header container-fluid">
            <span class="article-category">{{ $TC->TG($offer['category']) }}</span>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Offer Header --}}

    {{-- Offer Content --}}
        <div class="offer-wrapper container-fluid">
            <div class="offer-left-section">
                <div class="offer-image">
                    <img class="lazy" src="{{ asset($offer['image']) }}" alt="{{ $offer['title'] }}">
                </div>
            </div>

            <span class="offer-right-section">
                <h2 class="offer-title">{{ $offer['title'] }}</h2>
                <div class="d-table">
                    <span class="offer-validity">{{ $TC->TG('valid') }}: {{ $offer['valid'] }}</span>
                </div>
                <div class="offer-description">
                    <h4>{{ $TC->T($local, 'offer_conditions') }}</h4>
                    {!! $offer['description'] !!}
                </div>
            </span>
        </div>
    {{-- Offer Content --}}

    {{-- Divider Line --}}
        <div class="container-fluid mt-5">
            <div class="divider-line"></div>
        </div>
    {{-- Divider Line --}}

    {{-- Similar Offers --}}
        <h2 class="section-title">{{ $TC->TG('similar') .' '. $TC->TG('offers') }}</h2>
        <div class="special-offers-wrapper container-fluid">
            @foreach ($offers as $item_offer)
                @if ( $item_offer['id'] != $offer['id'] )                    
                    <div class="offer-card-wrapper">
                        <span class="offer-validity">{{ $TC->TG('valid') }}: {{ $item_offer['valid'] }}</span>
                        <div class="offer-banner-container">
                            <img class="lazy" src="{{ asset($item_offer['image']) }}" alt="{{ $item_offer['title'] }}">
                        </div>
                        <div class="offer-footer">
                            <a href="/offer/{{ $item_offer['slug'] }}">{{ $item_offer['title'] }}</a>
                            <a href="/offer/{{ $item_offer['slug'] }}" class="metrix-button metrix-button-light"><span class="dire-right-arrow"></span></a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    {{-- Similar Offers --}}
@endsection