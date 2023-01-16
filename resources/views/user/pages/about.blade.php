@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();
@endphp

@if ( $data['exists'] )
    @section('meta')
        <meta property="og:url" content="{{ url()->current() }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{ $data['raw']['meta_title'] }}"/>
        <meta property="og:description" content="{{ $data['raw']['meta_description'] }}"/>
        <meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

        <title>{{ $data['raw']['meta_title'] }}</title>
        <meta name="keywords" content="{{ $data['raw']['meta_keywords'] }}">
        <meta name="description" content="{{ $data['raw']['meta_description'] }}">
    @endsection
@endif

@section('content')
    <div class="about-wrapper d-fc">
        <div class="top d-fc">
            <div class="darker-section">
                <div class="video-wrapper container-800">
                    {{-- <iframe src="https://www.youtube.com/embed/{{ ($data['exists']) ? $data['raw']['link'] : 'C3iI6S7TuCA' }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                </div>
            </div>
        </div>

        <div class="middle">
            @if ( !$agent->isMobile() && !$agent->isTablet() ) {{-- Needs to be reverse --}}
                <div class="side-block left">
                    <div class="about-sidebar-wrapper d-fc">
                        @for ($i = 0; $i < 5; $i++)  
                            <div>
                                <i class="square"></i>
                                <button data-scroll-to="#title-{{ $i }}">{!! ($data['exists']) ? $data['content'][Session::get('locale')]['title_'. $i] : 'სათაური' !!}</button>
                            </div>
                        @endfor
                    </div>
                </div>
            @endif

            <div class="center d-fc">
                <div class="ligher-section">
                    <div class="container-800 flex-column">
                        <div class="section-header">
                            <i class="square"></i>
                            <h2 class="static-size" id="title-0" >{!! ($data['exists']) ? $data['content'][Session::get('locale')]['title_0'] : 'სათაური' !!}</h2>
                        </div>
                        <div class="paragraph-block">
                            <p>{!! ($data['exists']) ? $data['content'][Session::get('locale')]['paragraph_block_0'] : '' !!}</p>
                        </div>
                        <div class="image-block">
                            @if ( $data['exists'] )
                                @if ( $data['inner_images'] != [] )
                                    @foreach ($data['inner_images'] as $index => $image)
                                        <a data-fancybox="article-gallery" href="{{ asset($image['location']) }}"><img src="{{ asset($image['location']) }}" alt="{{ $image['alt'] }}"></a>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="darker-section">
                    <div class="container-800 flex-column">
                        <div class="section-header">
                            <i class="square"></i>
                            <h2 class="static-size" id="title-1" >{!! ($data['exists']) ? $data['content'][Session::get('locale')]['title_1'] : 'სათაური' !!}</h2>
                        </div>
                        <div class="paragraph-block mb-2">
                            <p>{!! ($data['exists']) ? $data['content'][Session::get('locale')]['paragraph_block_1'] : '' !!}</p>
                        </div>
                        <div class="category-buttons">
                            <a href="{{ ($data['exists']) ? $data['links'][0] : 'https://www.metrix.ge/vip-master' }}" id="furniture" class="">
                                <i id="couch"></i>
                                <p class="static-size">ავეჯის დამზადება</p>
                                <i class="white" id="arrow-right"></i>
                            </a href="/">
                            <a href="{{ ($data['exists']) ? $data['links'][1] : 'https://www.metrix.ge/designer' }}" id="vip-master" class="">
                                <i id="wrench"></i>
                                <p class="static-size">ვიპ-მასტერი</p>
                                <i class="white" id="arrow-right"></i>
                            </a href="/">
                            <a href="{{ ($data['exists']) ? $data['links'][2] : 'https://www.metrix.ge/furniture' }}" id="designer" class="">
                                <i id="paint-brush"></i>
                                <p class="static-size">დიზაინერი</p>
                                <i class="white reverse" id="arrow-right"></i>
                            </a href="/">
                            <a href="{{ ($data['exists']) ? $data['links'][3] : 'https://www.metrix.ge/repairs' }}" id="repairs" class="">
                                <i id="paint-roller"></i>
                                <p class="static-size">რემონტი</p>
                                <i class="white reverse" id="arrow-right"></i>
                            </a href="/">
                        </div>
                    </div>
                </div>
                <div class="lighter-section">
                    <div class="container-800 flex-column">
                        <div class="section-header">
                            <i class="square"></i>
                            <h2 class="static-size" id="title-2" >{!! ($data['exists']) ? $data['content'][Session::get('locale')]['title_2'] : 'სათაური' !!}</h2>
                        </div>
                        <div class="paragraph-block">
                            <p>{!! ($data['exists']) ? $data['content'][Session::get('locale')]['paragraph_block_2'] : '' !!}</p>
                        </div>
                    </div>
                </div>
                <div class="darker-section">
                    <div class="container-800 flex-column">
                        <div class="section-header">
                            <i class="square"></i>
                            <h2 class="static-size" id="title-3" >{!! ($data['exists']) ? $data['content'][Session::get('locale')]['title_3'] : 'სათაური' !!}</h2>
                        </div>
                        <div class="paragraph-block">
                            <p>{!! ($data['exists']) ? $data['content'][Session::get('locale')]['paragraph_block_3'] : '' !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="side-block right">
                <div class="enlarge-text">
                    <div class="line"></div>
                    <div class="d-fc">
                        <button data-size="increase">+</button>
                        <button data-size="decrease">-</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom">
            <div class="lighter-section">
                <div class="container-800 flex-column">
                    <div class="section-header">
                        <i class="square"></i>
                        <h2 class="static-size" id="title-4" >{!! ($data['exists']) ? $data['content'][Session::get('locale')]['title_4'] : 'სათაური' !!}</h2>
                    </div>
                </div>
            </div>
            
            <div class="opaque-slider d-fc">
                @if ( $agent->isMobile() || $agent->isTablet() )
                    @if ( $data['exists'] )
                        @if ( $data['hr'] != [] )
                            @foreach ($data['hr'] as $index => $hr)
                                <div class="carousel-block">
                                    <div class="hr-block d-fc">
                                        <div class="image-wrapper">
                                            <img class="owl-lazy" data-src="{{ asset($hr['image']) }}" alt="{{ $hr['ka']['name'] }}">
                                            <div class="background-layer"></div>
                                        </div>
                                        <span class="name">{{ $hr[Session::get('locale')]['name'] }}</span>
                                        <span class="profession">{{ $hr[Session::get('locale')]['profession'] }}</span>
                                        <div class="bottom-border"></div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endif
                @else
                    <div class="carousel-wrapper">
                        <div class="owl-carousel" id="human-resources-slider">
                            @if ( $data['exists'] )
                                @if ( $data['hr'] != [] )
                                    @foreach ($data['hr'] as $index => $hr)
                                        <div class="carousel-block">
                                            <div class="hr-block d-fc">
                                                <div class="image-wrapper">
                                                    <img class="owl-lazy" data-src="{{ asset($hr['image']) }}" alt="{{ $hr['ka']['name'] }}">
                                                    <div class="background-layer"></div>
                                                </div>
                                                <span class="name">{{ $hr[Session::get('locale')]['name'] }}</span>
                                                <span class="profession">{{ $hr[Session::get('locale')]['profession'] }}</span>
                                                <div class="bottom-border"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                        <div class="opaque-blocks left"></div>
                        <div class="opaque-blocks right"></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#human-resources-slider").owlCarousel({
                rewind: true,
                loop: true,
                autoplay: true,
                autoplayTimeout: 7000,
                autoplayHoverPause: true,
                smartSpeed: 1000,
                dots: false,
                nav: false,
                autoWidth:false,
                responsive: {
                    900: {
                        items: 5,
                        margin: 25
                    },
                    1920: {
                        items: 5,
                        margin: 50
                    }
                }
            })

            $('.enlarge-text button').click(function() {
                if ( $(this).data('size') == 'increase' ) {
                    $('.about-wrapper .center h2:not(.static-size), .about-wrapper .center p:not(.static-size), .about-wrapper .center span, .about-wrapper .center li').each(function() {
                        $(this).css('font-size', parseInt($(this).css('font-size')) + 1)
                    })
                } else if ( $(this).data('size') == 'decrease' ) {
                    $('.about-wrapper .center h2:not(.static-size), .about-wrapper .center p:not(.static-size), .about-wrapper .center span, .about-wrapper .center li').each(function() {
                        $(this).css('font-size', parseInt($(this).css('font-size')) - 1)
                    })
                }
            })
        })
    </script>
@endsection