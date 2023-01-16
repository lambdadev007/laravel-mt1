@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

<h2 class="section-title">{{ $TC->TG('partners-title') }}</h2>
<div class="container-fluid">
    <div class="partners">
        <div class="owl-carousel" id="partners">
            @foreach ($data['partners'] as $partner)
                <div class="carousel-block">
                    <img class="lazy" src="{{ asset($partner['image']) }}" alt="{{ $partner['title'] }}">
                    <span>{{ $partner['title'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>