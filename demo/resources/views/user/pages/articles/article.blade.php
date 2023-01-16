@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="{{ $article['seo_keywords'] }}">
    <meta name="description" content="{{ $article['seo_description'] }}">
    <title>{{ $article['title'] }}</title>
@endsection

@section('og_meta')
    <meta property="og:title" content="{{ $article['title'] }}"/>
    <meta property="og:description" content="{{ $article['seo_description'] }}">    	
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset($article['card_image']) }}">
    <meta property="og:site_name" content="metrix.ge">
@endsection

@section('fb_sdk')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ka_GE/sdk.js#xfbml=1&version=v5.0"></script>
@endsection

@section('content')
    <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('articles') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Article Header --}}
        <div class="article-header container-fluid">
            <span class="article-category">{{ $TC->TG($article['category']) }}</span>

            {{-- Phone Call Modal --}}
                <button class="split-button pulse-button p-0" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-phone"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal --}}
        </div>
    {{-- Article Header --}}

    {{-- Article Content --}}
        <div class="article-wrapper container-fluid">
            <div class="article-top-section">
                <div class="article-image">
                    <img class="lazy" src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}">
                </div>
                <div class="article-text">
                    <h1 class="article-title">{{ $article['title'] }}</h1>
                    <div class="d-table">
                        <span class="article-date-author">{{ $article['created_at'] }} | {{ $TC->TG('author') }}: {{ $author }}</span>
                    </div>
                    <div 
                        class="fb-like mb-3" 
                        data-href="{{ url()->current() }}"
                        data-width="50" 
                        data-layout="button_count"
                        data-action="like" 
                        data-size="large" 
                        data-share="true"
                    ></div>
                    <div class="article-description">
                        {!! $article['description'] !!}
                    </div>
                </div>
            </div>

            <div class="article-content">
                @foreach ($article_sections as $section)
                    <div class="article-content-section">
                        <button class="article-content-collapse" type="button" data-toggle="collapse" data-target="#article-section-{{ $section['id'] }}" aria-expanded="true" aria-controls="article-section-{{ $section['id'] }}">
                            <span>{{ $section['title'] }}</span>
                            <span class="dire-right-arrow-s"></span>
                        </button>

                        <div class="collapse show" id="article-section-{{ $section['id'] }}">
                            @if ( $section['image'] != null )
                                <div class="article-content-image">
                                    <img class="lazy" src="{{ asset($section['image']) }}" alt="{{ $section['title'] }}">
                                </div>
                            @endif
                            
                            <div class="article-content-text">
                                {!! $section['description'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    {{-- Article Content --}}

    {{-- Divider Line --}}
        <div class="container-fluid mt-5">
            <div class="divider-line"></div>
        </div>
    {{-- Divider Line --}}

    {{-- Similar Articles --}}
        <h2 class="section-title">{{ $TC->TG('similar') .' '. $TC->TG('articles') }}</h2>
        <div class="articles-wrapper container-fluid bg-transparent">
            @foreach ($articles as $article_item)
                @if ($article_item['id'] != $article['id'])
                    <div class="article-card">
                        <span class="views">{{ $article_item['views'] }} {{ $TC->TG('views') }}</span>
                        <div class="article-image-wrapper">
                            <img class="lazy" src="{{ asset( $article_item['card_image'] ) }}" alt="{{ $article_item['title'] }}">
                        </div>
                        <div class="article-content">
                            <div class="article-text">
                                <span class="article-date"><b>{{ $article_item['created_at'] }}</b></span>
                                <span class="article-description">{{ $article_item['seo_description'] }}</span>
                            </div>
                            <a href="/article/{{ $article_item['category'] }}/{{ $article_item['slug'] }}" class="split-button">
                                <span class="dire-right-arrow-s"></span>
                                <span>{{ $TC->TG('read_more') }}</span>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    {{-- Similar Articles --}}
@endsection