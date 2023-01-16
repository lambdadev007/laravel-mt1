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
<style>
    /* .video-icon{
        top:38% !important;
        left:45% !important;
    } */
    </style>
    <div class="projects-page-wrapper d-fc">
        <div class="universal-banner-wrapper">
            <div class="lower main-container container-1200 contain-custom">
                 <!-- <h1>ნამუშევრები</h1>  -->
                 <h3 class="lower complete-project pt-5">დასრულებული პროექტები</h3>
                 <p class="lower project-category text-dark text-left pb-2">აირჩიეთ სასურველი კატეგორია</p>
               
                @if ( $agent->isMobile() )
                    <!-- <div class="select-wrapper">
                        <select>
                            <option {{ ($data['filter'] == 'designer') ? 'selected' : '' }} value="projects?filter=designer">{{ $tranCT->translate('designer') }}</option>
                            <option {{ ($data['filter'] == 'repairs') ? 'selected' : '' }} value="projects?filter=repairs">{{ $tranCT->translate('repairs') }}</option>
                            <option {{ ($data['filter'] == 'furniture') ? 'selected' : '' }} value="projects?filter=furniture">{{ $tranCT->translate('furniture') }}</option>
                            <option {{ ($data['filter'] == 'vip') ? 'selected' : '' }} value="projects?filter=vip">{{ $tranCT->translate('vip') }}</option>
                            <option {{ ($data['filter'] == 'all') ? 'selected' : '' }} value="projects">{{ $tranCT->translate('all') }}</option>
                        </select>
                        <i class="dark" id="nav-arrow"></i>
                    </div> -->

                    <div class="projects-category-selectors w-100">
                       <a href="/projects" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('all') }}</a>
                        <a href="/projects?filter=designer" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('designer') }}</a>
                        <a href="/projects?filter=repairs" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('repairs') }}</a>
                        <a href="/projects?filter=furniture" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('furniture') }}</a>
                        <a href="/projects?filter=vip" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('vip') }}</a>
                        
                    </div>
                @else    
                    <div class="projects-category-selectors w-100">
                       <a href="/projects" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('all') }}</a>
                        <a href="/projects?filter=designer" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('designer') }}</a>
                        <a href="/projects?filter=repairs" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('repairs') }}</a>
                        <a href="/projects?filter=furniture" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('furniture') }}</a>
                        <a href="/projects?filter=vip" class="myprojectfontstyle cat-projects">{{ $tranCT->translate('vip') }}</a>
                        
                    </div>
                @endif
            </div>
        </div>

        <div class="projects-wrapper d-fc ">
        <div class="container-1200">
        <div class="row mob-work">
            @foreach ($data['projects'] as $i => $project)
                @php
                    $section_items = json_decode($project['section_items'], true);
                    if(!empty($section_items)){
                        $amount = count($section_items);
                        $upper_items = array_slice($section_items, 0, $amount / 2);
                        $lower_items = array_slice($section_items, $amount / 2);
                        $less = array_slice($section_items, 0,1,$amount / 2);
                        $section_items=array_reverse($section_items);
                    }
                    

                    $project['categories'] = json_decode($project['categories'], true);
                    $project['title'] = json_decode($project['title'], true)[Session::get('locale')];
                    $imsge = json_decode($project['card_image'], true);
                    if(empty($imsge)){
                        $imsge['location']="images/admin/no-image.jpg";
                        $imsge['alt']="no-image";

                    }
                    $video=false;
                @endphp
                
                        
                            <div class="col-3 text-center pt-3" >
                              <div class ="p-3 p-2 project-img" style="background-color:#F2F2F2;">
                                    @foreach($section_items as $index => $item)
                                            
                                        @if($item['type']=='video' && !empty($item['code']))
                                            @php
                                                $video=true;
                                            @endphp
                                        @endif
                                        @if ( $agent->isMobile() )
                                            
                                            @if($item['type']=='mobile_image')
                                                @if($item['is_feature']=='1')
                                                    <a class="main-project-image" href="/projects/single/{{ $project['id'] }}">
                                                        <img class="my class" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" width="260px" height="324px">
                                                        @if($video)
                                                            <img class="video-icon" src="/images/developer-images/video.png" alt="" >
                                                        @endif
                                                    </a>
                                                <!-- @else
                                                    <a class="main-project-image" href="/projects/single/{{ $project['id'] }}">
                                                        <img class="my class" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" width="260px" height="324px">
                                                        @if($video)
                                                            <img class="video-icon" src="/images/developer-images/video.png" alt="" >
                                                        @endif

                                                    </a> -->
                                                    
                                                @endif
                                                <!-- @break -->
                                            @endif
                                        @else
                                            @if($item['type']=='image' )
                                                
                                                @if($item['is_feature']=='1')
                                                    <a class="main-project-image" href="/projects/single/{{ $project['id'] }}">
                                                        <img class="my class" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" >
                                                        @if($video)
                                                            <img class="video-icon" src="/images/developer-images/video.png" alt="" >
                                                        @endif

                                                    </a>
                                                <!-- @else
                                                    <a class="main-project-image" href="/projects/single/{{ $project['id'] }}">
                                                        <img class="my class" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" >
                                                        @if($video)
                                                            <img class="video-icon" src="/images/developer-images/video.png" alt="" >
                                                        @endif

                                                    </a> -->
                                                    
                                                @endif
                                                <!-- @break -->
                                            @endif
                                        @endif
                                    @endforeach
                                    <div class="d-flex justify-content-between mt-3">
                                      <div class="text-projects">
                                        
                                            <h3 class="myh3style text-left pro-style"><a href="/projects/single/{{ $project['id'] }}">{{ $project['title'] }}</a></h3>
                                        
                                         <p class="text-left m-0">@foreach ($project['categories'] as $ci => $category) {{ $tranCT->translate($category) }}{{ (array_key_last($project['categories']) == $ci) ? '' : ',' }} @endforeach</p>
                                        </div>
                                        <div class="arrow-top">
                                            <a class="project-arrow-top" href="/projects/single/{{ $project['id'] }}"><img class="my class" src="{{ asset('/images/developer-images/Send.png') }}" height="18px"></a>
                                          </div>
                                       </div>
                                     
                                     
                            
                            </div>
                            </div>
                        
                       
                    
            @endforeach
                </div>
                
                <div class="container-1200 d-flex justify-content-start div-show-more pt-5">
                    @if($data['total_counts'] > $data['total_showed'])
                        @if($data['total_showed'] > 16)
                            <!-- <a href="/projects?page=<?//=($_GET['page']??'1')-1?>" class="btn btn-warning show-more rounded-0">Დაბრუნდი</a> -->
                        @endif
                            <a href="/projects?page=<?=($_GET['page']??'1')+1?>" class="btn btn-warning show-more rounded-0">მეტის ჩვენება</a>

                            <!-- <a href="javascript:void(0);" class="btn btn-warning show-more rounded-0">მეტის ჩვენება</a> -->

                    @else
                        <!-- <a href="/projects?page=<?//=($_GET['page']??'1')-1?>" class="btn btn-warning show-more rounded-0">Დაბრუნდი</a> -->
                    @endif    
                </div>
            </div>
            

        </div>

        @foreach ($data['projects'] as $project)
            @php
                $imsge = json_decode($project['card_image'], true);
                    if(empty($imsge)){
                        $imsge['location']="images/admin/no-image.jpg";
                        $imsge['alt']="no-image";

                    }
                $project['banner'] = json_decode($project['banner'], true);
                $project['sections'] = json_decode($project['sections'], true);
                if(!empty($project['section_items'])){
                    $project['section_items'] = array_reverse(json_decode($project['section_items'], true));
                }
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
                                                    <a class="magnify-icon" data-fancybox="project-gallery-{{ $section_item['belongs'] }}" data-thumbnail="{{ asset( $section_item['location'] ) }}" href="{{ asset( $section_item['location'] ) }}">
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

        jQuery(function($) {
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('.projects-category-selectors a').each(function() {
        if (this.href === path) {
        $(this).addClass('active');
        }
        });
        });

        $(document).ready(function() {
            $('.expand-project').click(function() {
                $(`#${$(this).data('target')}-0`).click()
            });
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