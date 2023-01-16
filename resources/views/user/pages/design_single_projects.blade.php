@extends('user.layout')

@section('meta')
    @if ( $data['exists'] )
        <meta property="og:url" content="{{ url()->current() }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{ $data['raw']['meta_title'] }}"/>
        <meta property="og:description" content="{{ $data['raw']['meta_description'] }}"/>
        <meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

        <title>{{ $data['raw']['meta_title'] }}</title>
        <meta name="keywords" content="{{ $data['raw']['meta_keywords'] }}">
        <meta name="description" content="{{ $data['raw']['meta_description'] }}">
    @endif
@endsection

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();
@endphp

@section('content')
    <div class="projects-page-wrapper d-fc">
        <div class="universal-banner-wrapper">
            <div class="image-wrapper">
                @if ( @data['exists'] )
                    @php
                        $banner = $data['raw']['banner'];
                        if ( $agent->isMobile() ) $banner = $data['raw']['mob_banner'];
                    @endphp
                    <img src="{{ asset($banner) }}" alt="ნამუშევრები">
                @endif
                {{-- <div class="background-layer"></div> --}}
            </div>
            <div class="text-wrapper">
                {{-- <h1>ნამუშევრები</h1> --}}
                @if ( $agent->isMobile() )
                    <div class="select-wrapper">
                        <select>
                            <option {{ ($data['filter'] == 'designer') ? 'selected' : '' }} value="projects?filter=designer">{{ $tranCT->translate('designer') }}</option>
                            <option {{ ($data['filter'] == 'repairs') ? 'selected' : '' }} value="projects?filter=repairs">{{ $tranCT->translate('repairs') }}</option>
                            <option {{ ($data['filter'] == 'furniture') ? 'selected' : '' }} value="projects?filter=furniture">{{ $tranCT->translate('furniture') }}</option>
                            <option {{ ($data['filter'] == 'vip') ? 'selected' : '' }} value="projects?filter=vip">{{ $tranCT->translate('vip') }}</option>
                            <option {{ ($data['filter'] == 'all') ? 'selected' : '' }} value="projects">{{ $tranCT->translate('all') }}</option>
                        </select>
                        <i class="dark" id="nav-arrow"></i>
                    </div>
                @else    
                    <div class="projects-category-selectors">
                        <a href="/projects?filter=designer">{{ $tranCT->translate('designer') }}</a>
                        <a href="/projects?filter=repairs">{{ $tranCT->translate('repairs') }}</a>
                        <a href="/projects?filter=furniture">{{ $tranCT->translate('furniture') }}</a>
                        <a href="/projects?filter=vip">{{ $tranCT->translate('vip') }}</a>
                        <a href="/projects">{{ $tranCT->translate('all') }}</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="projects-wrapper d-fc container-1280">
            @foreach ($data['projects']->items() as $i => $project)
                @php
                    $section_items = array_reverse(json_decode($project['section_items'], true));
                    $amount = count($section_items);
                    $upper_items = array_slice($section_items, 0, $amount / 2);
                    $lower_items = array_slice($section_items, $amount / 2);

                    $project['categories'] = json_decode($project['categories'], true);
                    $project['title'] = json_decode($project['title'], true)[Session::get('locale')];
                @endphp
                <div class="project-wrapper d-fc" id="{{ $project['id'] }}">
                    <div class="text-wrapper d-fc">
                        <h3>{{ $project['title'] }}</h3>
                        <p>@foreach ($project['categories'] as $ci => $category) {{ $tranCT->translate($category) }}{{ (array_key_last($project['categories']) == $ci) ? '' : ',' }} @endforeach</p>
                    </div>
                    <div class="images-wrapper">
                        @for ($in = 0; $in < 2; $in++)
                            @if ( $agent->isMobile() || $agent->isTablet() )
                                <div class="projects-outer-gallery {{ ( $in == 0 ) ? 'mb-3' : 'short' }}">
                                    @if ( $in == 0 )
                                        @foreach ($upper_items as $item)
                                            @if ( $item['type'] == 'image' )
                                                <button class="carousel-block project-item magnify-icon" data-fancybox="{{ $project['title']. '-' .$project['id'] }}" href="{{ asset($item['location']) }}">
                                                    <img src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}">
                                                </button>
                                            @elseif ( $item['type'] == 'video' )
                                                <div class="carousel-block">
                                                    <iframe src="https://www.youtube.com/embed/{{ $item['code'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($lower_items as $item)
                                            @if ( $item['type'] == 'image' )
                                                <button class="carousel-block project-item magnify-icon" data-fancybox="{{ $project['title']. '-' .$project['id'] }}" href="{{ asset($item['location']) }}">
                                                    <img src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}">
                                                </button>
                                            @elseif ( $item['type'] == 'video' )
                                                <div class="carousel-block">
                                                    <iframe src="https://www.youtube.com/embed/{{ $item['code'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <div class="owl-carousel {{ ($in == 1) ? 'projects-slider-outer-reverse' : 'projects-slider-outer' }}" style="width: 100%">
                                    @if ( $in == 0 )
                                        @foreach ($upper_items as $index => $item)
                                            @if ( $item['type'] == 'image' || $item['type'] == 'mobile_image' )
                                                <button class="carousel-block project-item magnify-icon" data-fancybox="{{ $project['title']. '-' .$project['id'] }}" href="{{ asset($item['location']) }}" id="{{ $project['id']. '-' .$index }}">
                                                    <img class="owl-lazy" data-src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}">
                                                </button>
                                            @elseif ( $item['type'] == 'video' )
                                                <div class="carousel-block">
                                                    <iframe src="https://www.youtube.com/embed/{{ $item['code'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($lower_items as $item)
                                            @if ( $item['type'] == 'image' || $item['type'] == 'mobile_image' )
                                                <button class="carousel-block project-item magnify-icon" data-fancybox="{{ $project['title']. '-' .$project['id'] }}" href="{{ asset($item['location']) }}">
                                                    <img class="owl-lazy" data-src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}">
                                                </button>
                                            @elseif ( $item['type'] == 'video' )
                                                <div class="carousel-block">
                                                    <iframe src="https://www.youtube.com/embed/{{ $item['code'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endif
                        @endfor
                        @if ( !$agent->isMobile() && !$agent->isTablet() )
                            <button type="button" class="expand-project d-fc" data-target="{{ $project['id'] }}">
                                <span>+{{ $amount }}</span>
                                <p>ყველას ნახვა</p>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
            {{ $data['projects']->render() }}
        </div>

        @foreach ($data['projects']->items() as $project)
            @php
                $project['card_image'] = json_decode($project['card_image'], true);
                $project['banner'] = json_decode($project['banner'], true);
                $project['sections'] = json_decode($project['sections'], true);
                $project['section_items'] = array_reverse(json_decode($project['section_items'], true));
            @endphp
            {{-- <div class="modal fade modal-background" id="project-modal-{{ $project['id'] }}" tabindex="-1" role="dialog" aria-labelledby="project-modal-{{ $project['id'] }}-label" aria-hidden="true">
                <div class="modal-dialog modal-custom modal-1160 modal-projects modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="top-misc">
                            <h3 class="modal-title">ნამუშევრის შესახებ</h3>
                            <span class="close-modal" data-dismiss="modal">&times</span>
                        </div>

                        <div class="universal-banner-wrapper">
                            <div class="image-wrapper">
                                <img class="image-loader" src="{{ asset( $project['banner']['location'] ) }}" alt="{{ $project['banner']['alt'] }}">
                                <div class="background-layer"></div>
                            </div>
                            <div class="text-wrapper">
                                <h2>{{ json_decode($project['title'], true)[Session::get('locale')] }}</h2>
                                <p>@foreach ($project['categories'] as $i => $category) {{ $tranCT->translate($category) }}{{ (array_key_last($project['categories']) == $i) ? '' : ',' }} @endforeach</p>
                            </div>
                        </div>

                        <div class="project-information container-1020">
                            {!! json_decode($project['information'], true)[Session::get('locale')] !!}
                        </div>

                        <div class="project-gallery container-1020">
                            @foreach ($project['sections'] as $section)
                                <div class="gallery-wrapper d-fc">
                                    <div class="title-wrapper">
                                        <i class="square"></i>
                                        <h3>{{ $section['titles'][Session::get('locale')] }}</h3>
                                    </div>
                                    <div class="gallery" id="gallery-{{ $section['has'] }}">
                                        @foreach ($project['section_items'] as $i => $section_item)
                                            @if ( $section_item['belongs'] == $section['has'] )
                                                @if ( $section_item['type'] == 'image' )
                                                    <a class="magnify-icon" data-fancybox="project-gallery-{{ $section_item['belongs'] }}" href="{{ asset( $section_item['location'] ) }}">
                                                        <img class="image-loader" src="{{ asset( $section_item['thumbnail'] ) }}" alt="{{ $section_item['alt'] }}">
                                                    </a>
                                                @elseif ( $section_item['type'] == 'video' )
                                                    <iframe  src="https://www.youtube.com/embed/{{ $section_item['code'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> --}}
        @endforeach
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.expand-project').click(function() {
                $(`#${$(this).data('target')}-0`).click()
            })

            @if ( $data['open'] != false )
                $('#{{ $data['open'] }}-0').click()
            @endif

            @if ( $agent->isMobile() )
                $('.select-wrapper select').change(function() {
                    window.location.href = `${window.location.protocol}//${window.location.hostname}/${$(this).val()}`
                })
            @endif
        })
    </script>
@endsection