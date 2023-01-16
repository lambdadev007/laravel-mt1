@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();
@endphp

@section('content')
    <div class="search-wrapper d-fc container-1280">
        <div class="top d-fc">
            <div class="sunken-title"><h1>{{ $tranCT->translate('search_result') }}</h1> <i class="square"></i> <span>მზადაა {{ $data['amount_of_results'] }} რეზულტატი</span></div>
            <div class="sunken-title-line"></div>
        </div>

        <div class="middle">
            @if ( $data['articles'] != [] )
                <div class="section-title">
                    <i class="square"></i> <h2>{{ $tranCT->translate('blog') }}</h2>
                </div>

                <div class="blog-articles container-1280 flex-column">
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
                </div>
            @endif

            @if ( $data['products'] != [] )
                <div class="section-title">
                    <i class="square"></i> <h2>{{ $tranCT->translate('materials') }}</h2>
                </div>

                <div class="market-items-grid mb-5">
                    @foreach ( $data['products'] as $product )
                        <div class="market-item d-fc">
                            @if ( $agent->isMobile() || $agent->isTablet() )
                                <a href="/market/product/{{ $product['slug'] }}" class="d-fc">
                                    <img src="{{ asset($product['card_image']) }}" alt="{{ $product['card_image_alt'] }}">
                                    <div class="d-fc">
                                        <h5>{{ $product['brand'] }}</h5>
                                        <p>{!! $product['card_description'] !!}</p>
                                        @php
                                            $price = $product['price'];
                                            if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                            $price = number_format(round($price, 2), 2, '.', '');
                                        @endphp
                                        <span class="price"><strong>₾ {{ $price }}</strong> /ცალი</span>
                                    </div>
                                </a>
                                <div class="actions">
                                    <button type="button" class="cart-action no-reload" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id={{ ($product['has_variants'] == 'true') ? 0 : 'null' }}><i class="dark" id="market-cart-empty"></i></button>
                                </div>
                            @else
                                <a href="/market/product/{{ $product['slug'] }}" class="d-fc">
                                    <h5>{{ $product['brand'] }}</h5>
                                    <img src="{{ asset($product['card_image']) }}" alt="{{ $product['card_image_alt'] }}">
                                    <p>{!! $product['card_description'] !!}</p>
                                    @php
                                        $price = $product['price'];
                                        if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                        $price = number_format(round($price, 2), 2, '.', '');
                                    @endphp
                                    <span class="price"><strong>₾ {{ $price }}</strong> /ცალი</span>
                                </a>
                                <div class="actions">
                                    <button type="button" class="cart-action no-reload" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id={{ ($product['has_variants'] == 'true') ? 0 : 'null' }}><i class="dark" id="market-cart-empty"></i></button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection