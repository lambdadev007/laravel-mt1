@php
    use App\Models\Partners;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $partners = [];
    if ( Partners::where('id', 1)->exists() ) $partners = Partners::find(1)->get()->toArray()[0];
@endphp

<div class="projects-slider-component-wrapper my-0">
    <div class="header container-1280 pl-3">
        <span class="title">{{ $tranCT->translate('brands') }}</span>
    </div>
</div>
<div class="partners-slider-wrapper">
    <div class="owl-carousel" id="partners-slider">
        @foreach ( json_decode($partners['slides'], true) as $partner )
            <div class="carousel-block">
                <img class="owl-lazy" data-src="{{ asset($partner['location']) }}" alt="{{ $partner['alt'] }}" loading="lazy">
            </div>
        @endforeach
    </div>
</div>