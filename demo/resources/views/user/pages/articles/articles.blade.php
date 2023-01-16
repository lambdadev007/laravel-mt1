@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    // dd(session()->all());
@endphp

@section('meta')
    <title>სტატიები, {{ $TC->TG('html_title') }}</title>
    <meta name="keywords" content="სტატიები, statiebi, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია"/>
    <meta name="description" content="სტატიები, statiebi, statiebi, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები"/>
@endsection

@section('content')
    <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('articles') }}</h3>
        <div class="page-title-line"></div>
    </div>

    <div class="category-selector-wrapper container-fluid">
        <div class="category-selector">
            <button class="{{ $category == 'all' ? 'active' : '' }}"        data-page="articles" data-category="all">{{ $TC->TG('all') }}</button>
            <button class="{{ $category == 'design' ? 'active' : '' }}"     data-page="articles" data-category="design">{{ $TC->TG('design') }}</button>
            <button class="{{ $category == 'repairs' ? 'active' : '' }}"    data-page="articles" data-category="repairs">{{ $TC->TG('repairs') }}</button>
            <button class="{{ $category == 'furniture' ? 'active' : '' }}"  data-page="articles" data-category="furniture">{{ $TC->TG('furniture') }}</button>
            <button class="{{ $category == 'cleaning' ? 'active' : '' }}"   data-page="articles" data-category="cleaning">{{ $TC->TG('cleaning') }}</button>
        </div>

        {{-- Phone Call Modal Button --}}
            <button class="split-button pulse-button p-0" data-toggle="modal" data-target="#phone-call-modal">
                <span class="dire-right-arrow"></span>
                <span class="anchor-text">597 70 10 10</span>
            </button>
        {{-- Phone Call Modal Button --}}
    </div>

    {{-- <h2 class="section-title">{{ $TC->TG('articles-title') }}</h2> --}}
    <div class="articles-wrapper container-fluid no-bg">
        @foreach ($articles as $article)
            <div class="article-card">
                <span class="views">{{ $article['views'] .' '. $TC->TG('views') }}</span>
                <div class="article-image-wrapper">
                    <img class="lazy" src="{{ asset( $article['card_image'] ) }}" alt="{{ $article['title'] }}">
                </div>
                <div class="article-content">
                    <div class="article-text">
                        <span class="article-date"><b>{{ $article['created_at'] }}</b></span>
                        <span class="article-description cut-text" data-toggle="tooltip" data-placement="top" title="{{ $article['seo_description'] }}">{{ $article['seo_description'] }}</span>
                    </div>
                    <a href="/article/{{ $article['category'] }}/{{ $article['slug'] }}" class="split-button">
                        <span class="dire-right-arrow-s"></span>
                        <span>{{ $TC->TG('read_more') }}</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    @include('user.components.offers')
@endsection
