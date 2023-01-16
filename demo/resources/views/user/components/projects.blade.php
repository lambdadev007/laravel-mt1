@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

<div class="projects-wrapper container-fluid">
    @foreach ($projects as $project)
        <a href="/project/{{ $project['slug'] }}" class="project-card">
            <div class="views">{{ $project['views'] .' '. $TC->TG('views') }}</div>
            <div class="status">{{ $project['status'] }}</div>
            <div class="project-card-image-wrapper">
                <img class="lazy" src="{{ asset( $project['card_image'] ) }}"  alt="{{ $project['title'] }}" title="{{ $project['title'] }}">
            </div>
            <div class="project-card-title">{{ $project['title'] }}</div>
        </a>
    @endforeach
</div>