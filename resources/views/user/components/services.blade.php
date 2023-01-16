@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();
    
    $amount = count($data['projects']);
    $upper_items = array_slice($data['projects'], 0, $amount / 2);
    $lower_items = array_slice($data['projects'], $amount / 2);
@endphp

<div class="projects-slider-component-wrapper d-fc">
    <div class="header container-1280">
        <span class="title">{{ $tranCT->translate('featured_works') }}</span>
        
    </div>
<div class="projects-wrapper d-fc container-1280">
    <div class="owl-carousel services-slider-projects" id="p-s-c-t">
    <?php
        
            ?>
        @foreach ($data['projects'] as $project)
        <?php
            
        
            ?>
            @php
                $project['categories'] = json_decode($project['categories']);
                $imsge = json_decode($project['card_image'], true);
                if(empty($imsge)){
                        $imsge['location']="images/admin/no-image.jpg";
                        $imsge['alt']="no-image";
                    }
                $title = json_decode($project['title'], true)[Session::get('locale')];
                $section_items = json_decode($project['section_items'], true);
                    if(!empty($section_items)){
                        $section_items=array_reverse($section_items);
                    }
                $video=false;




            @endphp
            
            <div class="carousel-block text-center pt-3" >
                <div class ="p-3 project-img carousel-project-response" style="background-color:#F2F2F2;">
                        <!-- @if ( $item['type'] == 'image' ) -->
                        <!-- <a href="/projects/single/{{ $item['id'] }}">
                            <img class="my class w-100" src="{{ asset($imsge['location']) }}" alt="" width="250px" height="220px">
                        </a> -->
                        @foreach($section_items as $index => $item)
                                            
                                        @if($item['type']=='video' && !empty($item['code']))
                                            @php
                                                $video=true;
                                            @endphp
                                        @endif
                                        @if ( $agent->isMobile() )
                                            
                                            @if($item['type']=='mobile_image')
                                                @if($item['is_feature']=='1')
                                                    <a href="/projects/single/{{ $project['id'] }}">
                                                        <img class="my class owl-lazy mobile-img-project-slide project-component-img" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}">
                                                        @if($video)
                                                            <img class="video-icon owl-lazy mobile-img-project-slide project-component-img" src="/images/developer-images/video.png" alt="" >
                                                        @endif
                                                    </a>
                                                @else
                                                    <a href="/projects/single/{{ $project['id'] }}">
                                                        <img class="my class owl-lazy desktop-img-project-slide project-component-img" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}">
                                                        @if($video)
                                                            <img class="video-icon owl-lazy desktop-img-project-slide project-component-img" src="/images/developer-images/video.png" alt="" >
                                                        @endif

                                                    </a>
                                                    
                                                @endif
                                                @break
                                            @endif
                                        @else
                                            @if($item['type']=='image' )
                                                
                                                @if($item['is_feature']=='1')
                                                    <a class="project-link-image" href="/projects/single/{{ $project['id'] }}">
                                                        <img class="my class owl-lazy" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" >
                                                        @if($video)
                                                            <img class="video-icon owl-lazy" src="/images/developer-images/video.png" alt="" >
                                                        @endif

                                                    </a>
                                                @else
                                                    <a class="project-link-image" href="/projects/single/{{ $project['id'] }}">
                                                        <img class="my class owl-lazy" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" >
                                                        @if($video)
                                                            <img class="video-icon owl-lazy" src="/images/developer-images/video.png" alt="" >
                                                        @endif

                                                    </a>
                                                    
                                                @endif
                                                @break
                                            @endif
                                        @endif
                                    @endforeach
                        <div class="d-flex justify-content-between mt-1">
                            <div class="mt-1">
                                
                                    <h5 class="myh3style  text-left pro-style"><a href="/projects/single/{{ $project['id'] }}">{{ $title }} </a></h5>
                               
                                <p class="text-left m-0">@foreach ($project['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($project['categories']) == $ci) ? '' : ',' }} @endforeach</p>
                            </div>
                            <div class="mt-2">
                                <a class="servie-project" href="/projects/single/{{ $project['id'] }}"><img class="my class owl-lazy" src="{{ asset('/images/projects/send.png') }}" width="" height=""></a>
                            </div>
                        </div>
                        <!-- @endif -->
                </div>
            </div>
                        @endforeach
</div>

    <!-- <div class="images-wrapper">
        <div class="projects-outer-gallery mb-3">
            
            <button class="carousel-block project-item magnify-icon" href="">
                <img src="">
            </button>
        </div>
    </div> -->


<div class="container-1280 d-flex justify-content-start div-show-more pt-5">
            <!-- <a href="/projects" class="btn btn-warning show-more rounded-0">მეტის ჩვენება</a> -->
                    
    </div>
</div>
            <!-- <div class="carousel-block">
                <img class="owl-lazy" data-src="{{ asset(json_decode($item['card_image'])->location) }}" alt="{{ json_decode($item['card_image'])->alt }}">
                <div class="background-layer"></div>
                <span class="title">{{ $title }}</span>
                <span class="category">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</span>
                @if ( $item['in_progress'] == 'true' )
                    <div class="in-progress">
                        <img src="{{ asset('images/homepage/in-progress-cog.svg') }}">
                        <span>{{ $tranCT->translate('ongoing') }}</span>
                    </div>
                @endif
                <div class="hover-layer d-fc">
                    <span class="title">{{ $title }}</span>
                    {{-- <span class="category">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</span> --}}
                    {{-- <p class="description">{{ json_decode($item['card_info'], true)[Session::get('locale')] }}</p> --}}
                    <p class="description">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</p>
                    <a href="/projects?open={{ $item['id'] }}">
                        <span>{{ $tranCT->translate('detailed') }}</span>
                        <img src="{{ asset('images/xd-icons/white/arrow-right.svg') }}">
                    </a>
                </div>
            </div> -->
        <!-- @endforeach -->
    <!-- </div> -->

    <!-- <div class="owl-carousel projects-slider-component bottom" id="p-s-c-b">
        @foreach ($lower_items as $item)
            @php
                $item['categories'] = json_decode($item['categories']);
                $title = json_decode($item['title'], true)[Session::get('locale')];
            @endphp
            <div class="carousel-block">
                @if( $item['card_image'] == null){

                }@else
                <img class="owl-lazy" data-src="{{ asset(json_decode($item['card_image'])->location) }}" alt="{{ json_decode($item['card_image'])->alt }}">
                @endif
                <div class="background-layer"></div>
                <span class="title">{{ $title }}</span>
                <span class="category">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</span>
                @if ( $item['in_progress'] == 'true' )
                    <div class="in-progress">
                        <img src="{{ asset('images/homepage/in-progress-cog.svg') }}">
                        <span>{{ $tranCT->translate('ongoing') }}</span>
                    </div>
                @endif
                <div class="hover-layer d-fc">
                    <span class="title">{{ $title }}</span>
                    {{-- <span class="category">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</span> --}}
                    {{-- <p class="description">{{ json_decode($item['card_info'], true)[Session::get('locale')] }}</p> --}}
                    <p class="description">@foreach ($item['categories'] as $ci => $category) {{  $tranCT->translate($category) }}{{ (array_key_last($item['categories']) == $ci) ? '' : ',' }} @endforeach</p>
                    <a href="/projects?open={{ $item['id'] }}">
                        <span>{{ $tranCT->translate('detailed') }}</span>
                        <img src="{{ asset('images/xd-icons/white/arrow-right.svg') }}">
                    </a>
                </div>
            </div> -->
        <!-- @endforeach -->
    <!-- </div> -->
    
</div>
<style>
    .projects-slider-component-wrapper .header .categories a {
    background: none;
    border: none;
    outline: none;
    color: rgb(var(--metrix-dark-gray-accent));
    position: relative;
    padding: 0;
    margin: auto 10px;
    transition: color .3s;
}
.projects-slider-component-wrapper .header .categories a:hover, .projects-slider-component-wrapper .header .categories a.active {
    color: rgb(var(--metrix-orange-accent));
}
</style>