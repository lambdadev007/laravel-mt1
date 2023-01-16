@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

<h2 class="section-title">{{ $TC->TG('articles-title') }}</h2>
<div class="articles-wrapper container-fluid">
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