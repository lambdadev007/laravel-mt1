@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'location'              => 'მდებარეობა',
            'area'                  => 'ფართობი',
            'square_meter'          => 'კვ. მ',
            'duration'              => 'ხანგრძლივობა',
            'work_day'              => 'სამუშაო დღე',
            'begining_end'          => 'დაწყება-დასრულება',
            'price'                 => 'ღირებულება',
        ],
        'en' => [
            'location'              => 'Location',
            'area'                  => 'Area',
            'square_meter'          => 'Sq.M',
            'duration'              => 'Duration',
            'work_day'              => 'Work day(s)',
            'begining_end'          => 'Begining-End',
            'price'                 => 'Price',
        ]
    ];
@endphp

@section('meta')
        <meta name="keywords" content="{{ $project['seo_keywords'] }}">
        <meta name="description" content="{{ $project['seo_description'] }}">
        <title>{{ $project['title'] }}</title>
@endsection

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/fancybox-master/css/jquery.fancybox.min.css') }}">
@endsection

@section('content')
    
    <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('projects') }}</h3>
        <div class="page-title-line"></div>
    </div>

    {{-- Project Header --}}
        <div class="article-header container-fluid">
            <span class="article-category">{{ $TC->TG($project['category']) }}</span>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Project Header --}}

    {{-- Project Content --}}
        <div class="project-wrapper container-fluid">
            <div class="project-left-section">
                <div id="projects-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($slides as $index => $slide)
                            <li data-target="#projects-carousel" data-slide-to="{{ $index }}" class="{{ ($index == 0) ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($slides as $index => $slide)
                            <div class="carousel-item {{ ($index == 0) ? 'active' : '' }}">
                                <a data-fancybox="gallery" href="{{ asset($slide) }}"><img class="lazy" src="{{ asset($slide) }}" alt="{{ $project['title'] }}"></a>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#projects-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#projects-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="project-right-section">
                <h2>{{ $project['title'] }}</h2>

                {{-- Project Data --}}
                    @if ( !in_array('location', $hidden_fields) )
                        <div class="project-data-wrapper">
                            <span class="project-data-uncolored">
                                <span class="dire-pin"></span>
                                {{ $TC->T($local, 'location') }}:
                            </span>
                            <span class="project-data-colored">{{ $project['location'] }}</span>
                        </div>
                    @endif

                    @if ( !in_array('area', $hidden_fields) )
                        <div class="project-data-wrapper">
                            <span class="project-data-uncolored">
                                <span class="dire-area"></span>
                                {{ $TC->T($local, 'area') }}:
                            </span>
                            <span class="project-data-colored">{{ $project['area'] }} {{ $TC->T($local, 'square_meter') }}</span>
                        </div>
                    @endif

                    @if ( !in_array('duration', $hidden_fields) )
                        <div class="project-data-wrapper">
                            <span class="project-data-uncolored">
                                <span class="dire-clock"></span>
                                {{ $TC->T($local, 'duration') }}:
                            </span>
                            <span class="project-data-colored">{{ $project['duration'] }} {{ $TC->T($local, 'work_day') }}</span>
                        </div>
                    @endif

                    @if ( !in_array('start_end', $hidden_fields) )
                        <div class="project-data-wrapper">
                            <span class="project-data-uncolored">
                                <span class="dire-date"></span>
                                {{ $TC->T($local, 'begining_end') }}:
                            </span>
                            <span class="project-data-colored">{{ $project['starts'] . '/' . $project['starts'] }}</span>
                        </div>
                    @endif
                {{-- Project Data --}}

                {{-- Project Price --}}
                    @if ( !in_array('price', $hidden_fields) )
                        <div class="project-price-wrapper">
                            <span>{{ $TC->T($local, 'price') }}</span>
                            <div>
                                {{ $project['price'] }}
                                <span class="dire-lari"></span> 
                            </div>
                        </div>
                    @endif
                {{-- Project Price --}}

                {{-- Project Materials --}}
                    @if ( !in_array('materials', $hidden_fields) )
                        <div class="project-materials-wrapper">
                            <div>{!! $project['materials'] !!}</div>
                        </div>
                    @endif
                {{-- Project Materials --}}
            </div>
        </div>
    {{-- Project Content --}}

    @include('user.components.offers')
@endsection

@section('defer_js')
    <script defer type="text/javascript" src="{{ asset('masters/fancybox-master/js/jquery.fancybox.min.js') }}"></script>
@endsection