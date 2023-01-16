@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@if ($offers != [])
    @if ( !isset($offers_page) )
        <div class="page-title-wrapper container-fluid mt-5">
            <div class="page-title-line"></div>
            <div class="page-title-line"></div>
        </div>
        <h2 class="section-title">{{ $TC->TG('offers-title') }}</h2>
    @endif

    <div class="special-offers-wrapper container-fluid {{ (isset($offers_page)) ? 'mt-4' : '' }}">
        @foreach ($offers as $offer)
            <div class="offer-card-wrapper">
                <span class="offer-validity">{{ $TC->TG('valid') .': '. $offer['valid'] }}</span>
                <div class="offer-banner-container">
                    <img class="lazy" src="{{ asset( $offer['card_image'] ) }}" alt="{{ $offer['title'] }}">
                </div>
                <div class="offer-footer">
                    <a href="/offer/{{ $offer['slug'] }}">{{ $offer['title'] }}</a>
                    <a href="/offer/{{ $offer['slug'] }}" class="metrix-button metrix-button-light"><span class="dire-right-arrow"></span></a>
                </div>
            </div>
        @endforeach
    </div>
@endif