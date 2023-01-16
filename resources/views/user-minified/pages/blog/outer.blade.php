@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();
@endphp

@if ( $data['meta']['exists'] )
    @section('meta')
        <meta property="og:url" content="{{ url()->current() }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{ $data['meta']['meta_title'] }}"/>
        <meta property="og:description" content="{{ $data['meta']['meta_description'] }}"/>
        <meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

        <title>{{ $data['meta']['meta_title'] }}</title>
        <meta name="keywords" content="{{ $data['meta']['meta_keywords'] }}">
        <meta name="description" content="{{ $data['meta']['meta_description'] }}">
    @endsection
@endif

@section('content')
    <div class="blog-wrapper container-1280 d-fc">
        @if ( $agent->isMobile() || $agent->isTablet() )
            <div class="blog-top-component d-flex justify-space-between">
                @foreach ( $data['header_articles'] as $index => $article )
                    <div class="left {{ ($index == 0) ? 'show' : '' }}" id="header-article-{{ $index }}">
                        <div class="article-banner">
                            <img src="{{ asset($article['banner']) }}">
                            <div class="background-layer"></div>
                            <div class="floating-category yellow">{{ $tranCT->translate($article['category']) }}</div>
                            <div class="title">{{ $article['title'] }}</div>
                            <div class="description">{{ $article['card_description'] }}</div>
                        </div>
                    </div>
                @endforeach
                <div class="floating-article-checkboxes">
                    @for ($i = 0;$i < 4;$i++)
                        <label class="universal-radio-wrapper {{ ($i == 4) ? 'mr-0' : '' }}">
                            <input type="radio" name="article-radio" data-target="{{ $i }}" {{ ($i == 0) ? 'checked' : '' }}> 
                            <div class="before"></div> 
                            <div class="after"></div>
                        </label>
                    @endfor
                </div>
            </div>
        @else
            <div class="blog-top-component d-flex justify-space-between">
                @foreach ( $data['header_articles'] as $index => $article )
                    <div class="left {{ ($index == 0) ? 'show' : '' }}" id="header-article-{{ $index }}">
                        <div class="article-banner">
                            <a href="/blog/{{ $article['slug'] }}">
                                <img src="{{ asset($article['banner']) }}">
                                <div class="background-layer"></div>
                                <div class="floating-category yellow">{{ $tranCT->translate($article['category']) }}</div>
                                <div class="title">{{ $article['title'] }}</div>
                                <div class="description">{{ $article['card_description'] }}</div>
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="right">
                    @foreach ( $data['header_articles'] as $index => $article )
                        <div class="button-wrapper">
                            <button class="{{ ($index != 0) ? '' : 'active' }}" data-target="{{ $index }}">
                                <h5 class="title">{{ $article['title'] }}</h5>
                                <p class="description">{{ $article['card_description'] }}</p>
                            </button>
                            <div class="color"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="blog-articles container-1280 flex-column">
            <div class="header">
                @if ( $agent->isMobile() || $agent->isTablet() )
                    <h4 class="title">{{ $tranCT->translate('blog') }}</h4>
                @else
                    <h4 class="title">{{ $tranCT->translate('blog_categories') }}</h4>
                @endif
                <i class="square"></i>
                <div class="categories">
                    @if ( $agent->isMobile() )
                        <select>
                            <option value="" selected>{{ $tranCT->translate('all') }}</option>
                            <option value="">{{ $tranCT->translate('designer') }}</option>
                            <option value="">{{ $tranCT->translate('repairs') }}</option>
                            <option value="">{{ $tranCT->translate('furniture_crafting') }}</option>
                            <option value="">{{ $tranCT->translate('vip_master') }}</option>
                        </select>
                        <i class="gray" id="arrow-right"></i>
                    @else
                        <button type="button" class="category">{{ $tranCT->translate('designer') }}</button>
                        <button type="button" class="category">{{ $tranCT->translate('repairs') }}</button>
                        <button type="button" class="category">{{ $tranCT->translate('furniture_crafting') }}</button>
                        <button type="button" class="category">{{ $tranCT->translate('vip_master') }}</button>
                        <button type="button" class="category">{{ $tranCT->translate('all') }}</button>
                    @endif
                </div>
            </div>
            <div class="article-cards">
                @if ( $agent->isMobile() )
                    @foreach ( $data['articles'] as $article )
                        <a href="/blog/{{ $article['slug'] }}" class="universal-card d-fc article-card">
                            <div class="top">
                                <img src="{{ asset($article['card_image']) }}">
                                <div class="background-layer"></div>
                                <span class="floating-category orange">{{ $tranCT->translate($article['category']) }}</span>
                            </div>
                            <div class="bottom d-fc">
                                <h5 class="title">{{ $article['title'] }}</h5>
                                <div class="top-info">
                                    <div class="views">
                                        <img src="{{ asset('images/blog/icon-views-orange.svg') }}">
                                        <span>{{ $article['views'] }}</span>
                                    </div>
                                    <div class="shares">
                                        <img src="{{ asset('images/blog/icon-share-orange.svg') }}">
                                        <span>76</span>
                                    </div>
                                    <span class="date">{{ $article['date_created'] }}</span>
                                </div>
                                <p class="description">{{ $article['card_description'] }}</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    @foreach ($data['articles'] as $article)
                        <div class="universal-card d-fc article-card">
                            <div class="top">
                                <img src="{{ asset($article['card_image']) }}">
                                <div class="background-layer"></div>
                                <span class="floating-category orange">{{ $tranCT->translate($article['category']) }}</span>
                                <h5 class="title">{{ $article['title'] }}</h5>
                            </div>
                            <div class="bottom d-fc">
                                <div class="top-info">
                                    <div class="views">
                                        <img src="{{ asset('images/blog/icon-views-orange.svg') }}">
                                        <span>{{ $article['views'] }}</span>
                                    </div>
                                    <div class="shares">
                                        <img src="{{ asset('images/blog/icon-share-orange.svg') }}">
                                        <span>76</span>
                                    </div>
                                    <span class="date">{{ $article['date_created'] }}</span>
                                </div>
                                <p class="description">{{ $article['card_description'] }}</p>
                                <a class="bottom-button" href="/blog/{{ $article['slug'] }}">{{ $tranCT->translate('detailed') }}</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{ $data['articles']->render() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.page-item.disabled').each(function() {
                if ( $(this).html() == '<span class="page-link">...</span>') {
                    $(this).html(`<div></div> <div></div> <div></div>`)
                }
            })
        })
    </script>
@endsection