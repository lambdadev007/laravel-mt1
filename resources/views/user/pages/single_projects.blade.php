@extends('user.layout')



@php

    use Jenssegers\Agent\Agent;

    use App\Http\Controllers\TranslationsCT;



    $tranCT = new TranslationsCT();

    $agent = new Agent();

@endphp



@php    

    $single_projects_image = $single_projects->section_items;

    $area = json_decode($single_projects_image, true);



    $single_projects_video = $single_projects->section_items;

    $video = json_decode($single_projects_video, true);



    $single_projects_categories = $single_projects->categories;

    $category = json_decode($single_projects_categories, true);



    $single_projects_title = $single_projects->title;

    $title = json_decode($single_projects_title, true);

    $address = json_decode($single_projects->project_address, true);

    $card_img=json_decode($single_projects->card_image,true);

    

    $single_projects_social = $single_projects->social;

    $title_soc = $single_projects->title;  

@endphp



<?php

    // print_r($single_projects_video);

    // echo "<pre>";

    // print_r($single_projects);

    // echo "</pre>"; 

    $flage=0;



?>

@foreach($area as $i => $v)

    @foreach($v as $key => $val)

        @if ($key == "is_feature" && $val == "1")

            <?php   $feature_img = $v['location'];

                    break;

            ?>

        @endif

    @endforeach

    @if ( $agent->isMobile() )

            @if(!empty($v['code']) && $v['type']=='mobile_video')

                <?php

                    $flage++;

                ?>

                

                    

            @endif

    @else

        @if(!empty($v['code']) && $v['type']=='video')

                <?php

                    $flage++;

                ?>

                

                    

            @endif

    @endif

@endforeach



@if (empty($feature_img))     

    <?php $feature_img = 'images/logos/logo.png'; ?>

@endif



@section('meta')

    @if ( $data['exists'] )

        <meta property="og:url" content="{{ url()->current() }}"/>

        <meta property="og:type" content="website"/>

        <meta property="og:title" content="{{ $title['ka'] }}"/>

        <meta property="og:image" content="{{ asset($feature_img) }}"/>

        <meta name="description" content="{{ $data['raw']['meta_description'] }}">

    @endif

@endsection



@section('content')

<style>

   .myprojectfontstyle{

    background: #f2f2f2 !important;

    color: rgb(var(--metrix-yellow-accent)) !important;

    }

    .myprojectfontstyle:hover{

    background: rgb(var(--metrix-yellow-accent)) !important;

    color: #f2f2f2 !important;

    }

    .myh3style{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 16px;

        font-weight: 700;

        line-height: 22px;

    }

    .single-project-font-style-name{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 28px;

        font-weight: 700;

        line-height: 34px;

        letter-spacing: 0em;

        color: #151515;

    }

    .single-project-font-style-in-span{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 28px;

        font-weight: 400;

        line-height: 34px;

        letter-spacing: 0em;

    }

    .single-project-font-style-category{

        font-family: FiraGO;

        font-size: 16px;

        font-style: italic;

        font-weight: 400;

        line-height: 19px;

        letter-spacing: 0em;

        opacity: 0.6;

        color: #151515;

    }

    .single-project-font-style-id{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 16px;

        font-weight: 400;

        line-height: 19px;

        letter-spacing: 0em;

        color: #151515;

    }

    .single-project-font-style-company{

        /* font-family: FiraGO; */

        font-size: 16px;

        font-style: italic;

        font-weight: 400;

        line-height: 19px;

        letter-spacing: 0em;

    }

    .single-project-font-style-address{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 14px;

        font-weight: 400;

        line-height: 17px;

        letter-spacing: 0em;



    }

    .single-project-top-header-style{

        /* height:137px; */

        background:#D9D9D9;

    }

    .single-project-image-style{

        height: 424px;

        width: 100%;

    }

    .single-project-font-before-style{

        color: #151515;

        font-size: 20px;

        font-weight: 800;

        line-height: 24px;

        /* padding-top:80px; */

        letter-spacing: 0em;

    }

    .single-project-image-gallery-style{

        /* height: 228px; */

        height: 160px;

        /* width: 276px; */

        width: 100%;

        border-radius: 0px;

        Opacity:90%;

        /* padding:11px; */

    }

    .gallery-projects-style{

        /* padding:6px; */

        background:#F2F2F2;



    }

    .gallery-projects-font-font-style{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 20px;

        font-weight: 700;

        line-height: 24px;

        margin-top:72px;

        margin-bottom:-30px;

        letter-spacing: 0em;

        color: black;

    }

    

    button#copy-url:hover {

    color: #fbb040;

    }

    

    .projects-do-you-like{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 15px;

        font-weight: 700;

        line-height: 17px;

        letter-spacing: 0em;

        /* color:#151515; */

        color: black;

        margin-top:40px;

    }

    .projects-sharing{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 14px;

        color:#151515;

        font-weight: 400;

        line-height: 17px;

        letter-spacing: 0em;

    }

    .single-project-font-style-note{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 20px;

        font-weight: 700;

        line-height: 24px;

        letter-spacing: 0em;

        color:#F1571E;

    }

    .single-project-font-style-note-para{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 14px;

        font-weight: 400;

        line-height: 17px;

        letter-spacing: 0em;

        color:#151515;

    }

    .single-project-top-note-header-style{

        /* height:237px; */

        background:#F6F6F6;

        padding: 34px 0px;

    }

    .single-project-font-style-note-div{

        display:flex;

        padding-top: 14px; 

    }

    .single-project-font-style-note-invoice{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 14px;

        font-weight: normal;

        line-height: 17px;

        letter-spacing: 0em;

        color:#FFFFFF;

    }

    .single-project-font-style-note-invoice-btn{

        background:#FBB040;

        margin-right:15px;



    }

    .single-project-font-style-note-mobile{

        /* font-family: Helvetica Neue LT GEO; */

        font-size: 14px;

        font-weight: 400;

        line-height: 17px;

        letter-spacing: 0em;

        color:#414141;



    }

    .single-project-font-style-similer-para{

        padding-top: 8px;

    }

    .single-project-font-style-similer-para-span-1{

        /* font-family: Helvetica Neue LT GEO; */

            font-size: 16px;

            font-weight: 700;

            line-height: 22px;

            letter-spacing: 0em;

            color:#000000;

            width:80%;

            float:left;

    }

    .single-project-font-style-similer-para-span-2{

        /* font-family: Helvetica Neue LT GEO; */

            font-size: 14px;

            font-weight: 400;

            line-height: 22px;

            letter-spacing: 0em;

            color:#000000;

    }

    .single-project-top-header-logo-style{

        vertical-align:super;

        /* height:20px;

        width:80px; */

        height: 30px;

        width:130px;
    }

    .single-video-icon{

        height: 40px !important;

        position: absolute;

        top: 48%;

        left: 47%;

    }

    .calculate-box-custom{

        position: fixed;

        left: 50%;

        transform : translate(-50%,0);

        top: 30px;

    }

   

</style>    



    <div class="main-single-project-box">

       

        @if($flage !=1)

       

        <div class="p-4 single-project-top-header-style container-1200">

            <div class="d-flex justify-content-between flex-wrap">

                <div class="single-header-left">

                    <p class="single-project-font-style-name">{{$title['ka']}}</p>

                    <p class="single-project-font-style-category">@foreach($category as $i => $v){{$tranCT->translate($v)}}@endforeach</p>

                    <p class="single-project-font-style-id">პროექტის ID: {{$single_projects->id}}</p>

                </div>

                <div class="single-header-right">

                    <p class="single-project-font-style-company m-0 pb-2">{{  $single_projects->customer }}</p>

                    @if(!empty($card_img))

                        <image class="single-project-top-header-logo-style" src="{{ asset($card_img['location']) }}" alt="{{ $card_img['alt'] }}">

                    @endif

                    @if(!empty($address['ka']))

                    <p class="single-project-font-style-address">მისამართი: <?= $address['ka']??'' ?></p>

                    @endif

                </div>

            </div>

        </div>    

       

        @endif





        

        





            

                

                

        @if ( $agent->isMobile() )

        <!-- test01 -->

        

            

            <div class="container-1200">

                <div class="row video-box-space two-video">

                    

               @if($flage==2)

               <div class="mob-button-video d-flex justify-content-between">

                        <div class="two-video-button">

                        <button id="before" class="mob-repair-button mob-before-repair-button">რემონტამდე</button>

                        </div>

                        <div id="after" class="two-video-button">

                        <button class="mob-repair-button mob-after-repair-button">რემონტის შემდეგ</button>

                        </div>

                    </div>    

                    <?php $x=1;?> 

                @foreach($area as $index => $v)

                           

                            @if(!empty($v['code']) && $v['type']=="mobile_video")

                            



                            <div class="col-md-6 video-col" id="video_<?=$x++?>" >

                                @if($v['item-number'] == '0')

                                <p class="single-project-font-before-style">რემონტამდე</p><!-- before repair text -->

                                <a href="javascript:void(0)">

                                    <p class="single-video-a-hide-1 single-video-icon-hide-1 ">

                                        <img class="my class w-100 for-video-1" src="/images/projects/video1.png" alt="test11-regular-0" width="50%" >  

                                        <img class="single-video-icon single-video-icon-hide-1" src="/images/developer-images/video-single-1.png" alt="">

                                    </p>

                                </a>  

                                <p class="single-video-show-1">{!! html_entity_decode($v['code']) !!}</p>

                                @elseif($v['item-number'] == '1')

                                <p class="single-project-font-before-style">რემონტის შემდეგ</p><!-- after repair text -->

                                <a href="javascript:void(0)">

                                    <p class="single-video-a-hide-2 single-video-icon-hide-2">

                                        <img class="my class w-100 for-video-1" src="/images/projects/video2.png" alt="test11-regular-0" width="50%" >  

                                        <img class="single-video-icon single-video-icon-hide-2" src="/images/developer-images/video-single-2.png" alt=""> 

                                    </p>

                                </a> 

                                <p class="single-video-show-2">{!! html_entity_decode($v['code']) !!}</p>



                                @endif

                                <!-- <video class="single-project-image-style two-video-2" width="320" height="240" controls>

                                        <source src="{{ $v['code'] }}" type="video/mp4">

                                    </video> -->

                                    

                                <!-- <image class="single-project-image-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">     -->

                            </div>

                              

                            @endif

                @endforeach

                

                @elseif($flage==1)

                

                            <!-- <h1>one</h1> -->

                            <!-- one -->

                            <div class="container-1200 one-video">

                                <div class="row video-box-space">

                                    <div class="col-md-6 video-col">

                                        <div class="p-4 single-project-top-header1">

                                            <div class="d-flex justify-content-start flex-wrap flex-column">

                                                <div class="single-header-left">

                                                    <p class="single-project-font-style-name">{{$title['ka']}}</p>

                                                    <p class="single-project-font-style-category">@foreach($category as $i => $v){{$tranCT->translate($v)}}@endforeach</p>

                                                    <p class="single-project-font-style-id">პროექტის ID: {{$single_projects->id}}</p>

                                                </div>

                                                <div>

                                                <div class="single-project-border"></div>

                                                </div>

                                                <div class="single-header-right">

                                                    <p class="single-project-font-style-company m-0 pb-2">კომპანია</p>

                                                    @if(!empty($card_img))

                                                        <image class="single-project-top-header-logo-style" src="{{ asset($card_img['location']) }}" alt="{{ $card_img['alt'] }}">

                                                    @endif

                                                    <p class="single-project-font-style-address">მისამართი: <?= $address['ka']??'' ?></p>

                                                </div>

                                            </div>

                                        </div>  

                                    </div>

                                    <!-- <div class="mob-button-video d-flex justify-content-between">

                                        <div class="two-video-button">

                                        <button id="before" class="mob-repair-button mob-before-repair-button">რემონტამდე</button>

                                        </div>

                                        <div class="two-video-button">

                                        <button id="after" class="mob-repair-button mob-after-repair-button">რემონტის შემდეგ</button>

                                        </div>

                                    </div>  -->

                                 

                                    @foreach($area as $i => $v)

                                    <?php 

                            // echo "<pre>";

                            // print_r($area);

                            // echo "</pre>"; 

                            ?>

                                        @if(!empty($v['code']))

                                    <div class="col-md-6 video-col">

                                        <p class="single-project-font-before-style">რემონტამდე</p><!-- before repair text -->

                                        {{--!! html_entity_decode($v['code']) !!--}}

                                        <p class="single-video-a-hide-2">

                                            <img class="my class w-100" src="/images/projects/video1.png" alt="test11-regular-0" width="50%" >  

                                            <a href="javascript:void(0)"><img class="single-video-icon single-video-icon-hide-2" src="/images/developer-images/video-single-1.png" alt=""></a>  

                                        </p>

                                        <p class="single-video-show-2">{!! html_entity_decode($v['code']) !!}</p>

                                        <!-- <iframe class="single-project-image-style" width="320" height="240"  src="https://www.youtube.com/embed/{{ $v['code'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->



                                            <!-- <video class="single-project-image-style" width="320" height="240" controls>

                                                <source src="{{ $v['code'] }}" type="video/mp4">

                                            </video> -->

                                            

                                        <!-- <image class="single-project-image-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">     -->

                                    </div>

                                        @endif

                                    @endforeach

                                </div>

                            </div>

                           

                            

                            

                            

                @endif

                </div>

            </div>

            

        @else

        

           

            <!-- test -->

            <div class="container-1200">

                <div class="row video-box-space two-video">

                    

               @if($flage==2)

               <!-- <div class="mob-button-video d-flex justify-content-between">

                        <div class="two-video-button">

                        <button id="before" class="mob-repair-button mob-before-repair-button">რემონტამდე</button>

                        </div>

                        <div id="after" class="two-video-button">

                        <button class="mob-repair-button mob-after-repair-button">რემონტის შემდეგ</button>

                        </div>

                    </div>     -->

                    <?php $x=1;?> 

                @foreach($area as $index => $v)

                           

                            @if(!empty($v['code']) && $v['type']=="video")

                            



                            <div class="col-md-6 video-col" id="video_<?=$x++?>" >

                                @if($v['item-number'] == '0')

                                <p class="single-project-font-before-style">რემონტამდე</p><!-- before repair text -->

                                <a href="javascript:void(0)">

                                    <p class="single-video-a-hide-1 single-video-icon-hide-1 ">

                                        <img class="my class w-100 for-video-1" src="/images/projects/video1.png" alt="test11-regular-0" width="50%" >  

                                        <img class="single-video-icon single-video-icon-hide-1" src="/images/developer-images/video-single-1.png" alt="">

                                    </p>

                                </a>  

                                <p class="single-video-show-1">{!! html_entity_decode($v['code']) !!}</p>

                                @elseif($v['item-number'] == '1')

                                <p class="single-project-font-before-style">რემონტის შემდეგ</p><!-- after repair text -->

                                <a href="javascript:void(0)">

                                    <p class="single-video-a-hide-2 single-video-icon-hide-2">

                                        <img class="my class w-100 for-video-1" src="/images/projects/video2.png" alt="test11-regular-0" width="50%" >  

                                        <img class="single-video-icon single-video-icon-hide-2" src="/images/developer-images/video-single-2.png" alt=""> 

                                    </p>

                                </a> 

                                <p class="single-video-show-2">{!! html_entity_decode($v['code']) !!}</p>



                                @endif

                                <!-- <video class="single-project-image-style two-video-2" width="320" height="240" controls>

                                        <source src="{{ $v['code'] }}" type="video/mp4">

                                    </video> -->

                                    

                                <!-- <image class="single-project-image-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">     -->

                            </div>

                              

                            @endif

                @endforeach

                

                @elseif($flage==1)

                

                            <!-- <h1>one</h1> -->

                            <!-- one -->

                            <div class="container-1200 one-video">

                                <div class="row video-box-space">

                                    <div class="col-md-6 video-col">

                                        <div class="p-4 single-project-top-header1">

                                            <div class="d-flex justify-content-start flex-wrap flex-column">

                                                <div class="single-header-left">

                                                    <p class="single-project-font-style-name">{{$title['ka']}}</p>

                                                    <p class="single-project-font-style-category">@foreach($category as $i => $v){{$tranCT->translate($v)}}@endforeach</p>

                                                    <p class="single-project-font-style-id">პროექტის ID: {{$single_projects->id}}</p>

                                                </div>

                                                <div>

                                                <div class="single-project-border"></div>

                                                </div>

                                                <div class="single-header-right">

                                                    <p class="single-project-font-style-company m-0 pb-2">კომპანია</p>

                                                    @if(!empty($card_img))

                                                        <image class="single-project-top-header-logo-style" src="{{ asset($card_img['location']) }}" alt="{{ $card_img['alt'] }}">

                                                    @endif
                                                    <p class="single-project-font-style-address">მისამართი: <?= $address['ka']??'' ?></p>

                                                </div>

                                            </div>

                                        </div>  

                                    </div>

                                    <!-- <div class="mob-button-video d-flex justify-content-between">

                                        <div class="two-video-button">

                                        <button id="before" class="mob-repair-button mob-before-repair-button">რემონტამდე</button>

                                        </div>

                                        <div class="two-video-button">

                                        <button id="after" class="mob-repair-button mob-after-repair-button">რემონტის შემდეგ</button>

                                        </div>

                                    </div>  -->

                                 

                                    @foreach($area as $i => $v)

                                    <?php 

                            // echo "<pre>";

                            // print_r($area);

                            // echo "</pre>"; 

                            ?>

                                        @if(!empty($v['code']))

                                    <div class="col-md-6 video-col">

                                        <p class="single-project-font-before-style">რემონტამდე</p><!-- before repair text -->

                                        {{--!! html_entity_decode($v['code']) !!--}}

                                        <p class="single-video-a-hide-2">

                                            <img class="my class w-100" src="/images/projects/video1.png" alt="test11-regular-0" width="50%" >  

                                            <a href="javascript:void(0)"><img class="single-video-icon single-video-icon-hide-2" src="/images/developer-images/video-single-1.png" alt=""></a>  

                                        </p>

                                        <p class="single-video-show-2">{!! html_entity_decode($v['code']) !!}</p>

                                        <!-- <iframe class="single-project-image-style" width="320" height="240"  src="https://www.youtube.com/embed/{{ $v['code'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->



                                            <!-- <video class="single-project-image-style" width="320" height="240" controls>

                                                <source src="{{ $v['code'] }}" type="video/mp4">

                                            </video> -->

                                            

                                        <!-- <image class="single-project-image-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">     -->

                                    </div>

                                        @endif

                                    @endforeach

                                </div>

                            </div>

                           

                            

                            

                            

                @endif

                </div>

            </div>

            

        @endif    

            <!-- video end -->

                

            <div class="container-1200 single-mob-space-container">

                <p class="gallery-projects-font-font-style">ფოტოგალერეა </p>

                <div class="row pt-5">

                @foreach($area as $i => $val)

                @if ( $agent->isMobile() )

                                                

                    @if($val['type']=='mobile_image' && !empty($val['location']))

                        

                            

                                    <div class="col-lg-3 col-md-6 col-sm-6 single-pro-pad mob-2-col">

                                    

                                                                        <!-- <img class="image-loader" src="{{ asset( $section_item['thumbnail'] ) }}" alt="{{ $section_item['alt'] }}">

                                                                    </a> -->

                                        <div class="gallery-projects-style p-3 single-gallery-mobile">

                                            <a class="magnify-icon" data-fancybox="project-gallery" href="{{ asset( $val['location'] ) }}">

                                                <img class="single-project-image-gallery-style" src="{{ asset($val['thumbnail']) }}" alt="{{ $val['alt'] }}" />    

                                            </a>

                                        </div>

                                    </div>

                                    <img style="display:none" src="{{ asset($val['location']) }}" alt="{{ $val['alt'] }}" />   

                    @endif

                @else

                        @if ($val['type'] == 'image' && !empty($val['location']))

                    

                            <div class="col-lg-3 col-md-6 col-sm-6 px-3 single-pro-pad mob-2-col">

                            

                                                                <!-- <img class="image-loader" src="{{ asset( $section_item['thumbnail'] ) }}" alt="{{ $section_item['alt'] }}">

                                                            </a> -->

                                <div class="gallery-projects-style p-3 single-gallery-mobile">

                                    <a class="magnify-icon" data-fancybox="project-gallery" href="{{ asset( $val['location']) }}">

                                        <img class="single-project-image-gallery-style" src="{{ asset($val['thumbnail']) }}" alt="{{ $val['alt'] }}" />    

                                    </a>

                                </div>

                            </div>

                            <img style="display:none" src="{{ asset($val['location']) }}" alt="{{ $val['alt'] }}" />  

                        @endif

                @endif        

                @endforeach

                </div>

            </div> 

                

            <div class="container-1200 single-mob-space-cont2">

                <p class="projects-do-you-like">მოგეწონა პროექტი?</p>

                <p class="projects-sharing">გაზიარება</p>

                <p class="projects-social-media-icons">

                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']?>"><img src="/images/developer-images/facebook-icon.png" height="25px" target="_blank" alt=""></a>

                    <a href="https://www.instagram.com/sharer.php?u=<?=$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']?>"><img src="/images/developer-images/instra-icon.png" alt="" target="_blank" height="25px"></a>

                    <a href="http://pinterest.com/pin/create/button/?url=<?=$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI']?>"><img src="/images/developer-images/pintrest-icon.png" alt="" target="_blank" height="25px"></a>

                </p>

                

                <button id="copy-url" onclick="copyUrl();">ბმულის კოპირება</button>

                

            </div>









            <div class="single-project-top-note-header-style mt-5">

                <div class="row container-1200 row-target">

                    <div class="col-12 p-0">

                        <p class="single-project-font-style-note">შენიშვნა</p>

                        <div class="single-project-font-style-note-para d-flex">

                            <div class="check-image">

                                <img src="/images/developer-images/check-projects.png" height="25px" alt="">

                            </div>

                            <div class="check-text">

                                <p>ხარჯთაღრიცხვა არ ითვალისწინებს აქსესუარების ფასს, ვინაიდან ვთვლით რომ ეს დამკვეთის ინდივიდუალური გადაწყვეტილებაა</p>

                            </div>

                        </div>

                        <div class="single-project-font-style-note-para d-flex">

                            <div class="check-image">

                                <img src="/images/developer-images/check-projects.png" height="25px" alt="">

                            </div>

                            <div class="check-text">

                                <p>ხარჯთაღრიცხვა არ ითვალისწინებს აქსესუარების ფასს, ვინაიდან ვთვლით რომ ეს დამკვეთის ინდივიდუალური გადაწყვეტილებაა</p>

                            </div>

                        </div>

                        <!-- <p class="single-project-font-style-note-para mb-3">

                            <img src="/images/developer-images/check-projects.png" alt="">&nbsp;&nbsp;

                            სარე,პმტპ ხარჯთაღრიცხვა ითვალისწინებს მხოლოდ იმ სპეციფიკის სამუშაოებს რომლებიც ეხება რემონტს

                        </p> -->

                        <div class="single-project-font-style-note-div">

                                <button class="btn single-project-font-style-note-invoice-btn" type="button" data-target="#project-modal-form-projects" data-toggle="modal">

                                    <span class="single-project-font-style-note-invoice">ინვოისის ჩამოტვირთვა</span>

                                </button>

                                <a href="tel:592104040" class="single-tel-btn-anhor"><button class="btn single-tel-btn" type="button">

                                    <img src="/images/developer-images/mobile-projects.png" height="25px" alt="">

                                    <span class="single-project-font-style-note-mobile">

                                        592 10 40 40

                                    </span>

                                </button></a>

                        </div>

                    </div>

                </div>

            </div>  

            <!-- similar projects -->

            <div class="container-1200 single-mob-space-container">

                <p class="gallery-projects-font-font-style">მსგავსი პროექტები</p>

            

                <div class=" @if ( $agent->isMobile() ) owl-carousel projects-slider-component similar-slider-mob @else row @endif pt-5" @if ( $agent->isMobile() ) id="p-s-c-b" @endif>

                    @foreach($similar_projects as $index => $project)

                        @php

                            $card_img=json_decode($project['card_image'],true);

                            $title=json_decode($project['title'],true);

                            $categories=json_decode($project['categories'],true);

                            $section_items = json_decode($project['section_items'], true);

                            if(!empty($section_items)){

                                $section_items=array_reverse($section_items);



                            }                

                            $in_progress = json_decode($project['in_progress']);

                            $video=false;

                        @endphp

                        <div class=" @if ( $agent->isMobile() ) carousel-block text-center pt-3 @else col-md-6 col-sm-6 col-lg-3 single-pro-pad mob-2-col @endif">

                            <div class="gallery-projects-style p-3" style="position:relative">

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

                                                    <img class="my class w-100 similar-slide-img" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" width="250px" height="180px">

                                                    @if($video)

                                                        <img class="video-icon" src="/images/developer-images/video.png" alt="" >

                                                    @endif

                                                </a>

                                            @else

                                                <a href="/projects/single/{{ $project['id'] }}">

                                                    <img class="my class w-100 similar-slide-img" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" width="250px" height="180px">

                                                    @if($video)

                                                        <img class="video-icon" src="/images/developer-images/video.png" alt="" >

                                                    @endif



                                                </a>

                                                

                                            @endif

                                            @break

                                        @endif

                                    @else

                                        @if($item['type']=='image' )

                                            

                                            @if($item['is_feature']=='1')

                                                <a href="/projects/single/{{ $project['id'] }}">

                                                    <img class="my class w-100 similar-slide-img" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" width="250px" height="180px">

                                                    @if($video)

                                                        <img class="video-icon" src="/images/developer-images/video.png" alt="" >

                                                    @endif



                                                </a>

                                            @else

                                                <a href="/projects/single/{{ $project['id'] }}">

                                                    <img class="my class w-100 similar-slide-img" src="{{ asset($item['thumbnail']) }}" alt="{{ $item['alt'] }}" width="250px" height="180px">

                                                    @if($video)

                                                        <img class="video-icon" src="/images/developer-images/video.png" alt="" >

                                                    @endif



                                                </a>

                                                

                                            @endif

                                            @break

                                        @endif

                                    @endif

                                @endforeach

                                <a href="/projects/single/{{ $project['id'] }}" style="text-decoration:none;" class="similar-link-text">

                                    <div class="single-project-font-style-similer-para d-flex justify-content-between">

                                        <div class="similar-text">

                                            <h3 class="myh3style text-left pro-style">{{ $title['ka'] }}</h3>

                                            <span class="single-project-font-style-similer-para-span-2">@foreach ($categories as $ci => $category) {{ $tranCT->translate($category) }}{{ (array_key_last($categories) == $ci) ? '' : ',' }} @endforeach</span>

                                        </div>

                                        <div>

                                            <img class="similar-arrow" src="/images/developer-images/Send.png" alt="" height="18px">

                                        </div>    

                                    </div>

                                </a>

                                @if($in_progress == "true")

                                    <div class="project-in-progress"> 

                                        <img src="https://metrix.ge/images/homepage/in-progress-cog.svg" style="opacity: 1;"> 

                                        <span>

                                            <font style="vertical-align: inherit;">

                                                <font style="vertical-align: inherit;">მიმდინარე

                                                </font>

                                            </font>

                                        </span> 

                                    </div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                    

                    



                    <!-- <div class="col-md-6 col-sm-6 col-lg-3 single-pro-pad mob-2-col">

                        <div class="gallery-projects-style p-3">

                            <image class="single-project-image-gallery-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">

                                <div class="single-project-font-style-similer-para d-flex justify-content-between">

                                    <div>

                                        <span class="single-project-font-style-similer-para-span-1">ახალი ხედვა</span><br>

                                        <span class="single-project-font-style-similer-para-span-2">"ოფისის რემონტი"</span>

                                    </div>

                                    <div>

                                        <img class="" src="/images/developer-images/Send.png" alt="">

                                    </div>

                                </div>    



                        </div>

                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-3 single-pro-pad mob-2-col">

                        <div class="gallery-projects-style p-3">

                            <image class="single-project-image-gallery-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">

                                <div class="single-project-font-style-similer-para d-flex justify-content-between">

                                    <div class="single-text">

                                        <span class="single-project-font-style-similer-para-span-1">ახალი ხედვა</span><br>

                                        <span class="single-project-font-style-similer-para-span-2">"ოფისის რემონტი"</span>

                                    </div>

                                    <div class="single-link">

                                        <img class="" src="/images/developer-images/Send.png" alt="">

                                    </div>

                                </div>     

                

                        </div>

                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-3 single-pro-pad mob-2-col">

                        <div class="gallery-projects-style p-3">

                            <image class="single-project-image-gallery-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">

                                <div class="single-project-font-style-similer-para d-flex justify-content-between">

                                    <div>

                                        <span class="single-project-font-style-similer-para-span-1">ახალი ხედვა</span><br>

                                        <span class="single-project-font-style-similer-para-span-2">"ოფისის რემონტი"</span>

                                    </div>

                                    <div>

                                        <img class="" src="/images/developer-images/Send.png" alt="">

                                    </div>

                                </div>    



                        </div>

                    </div> -->

                <!-- </div>

            </div>    -->

            

        </div><br><br><br>

           <!-- start form homepage -->

           <div class="modal fade modal-background show" id="project-modal-form-projects" data-toggle="modal" tabindex="-1" role="dialog" aria-labelledby="project-modal-label" aria-hidden="true">

                <div class="modal-dialog modal-custom modal-1160 modal-projects modal-dialog-centered" role="document">

                    <div class="modal-content">

                        @if ( $data['exists'] )

                            <?php $i=0;?>

                            <div class="">

                                <!-- --------------first------------------ -->

                                <div class="calculate-box calculate-box-custom for-desktop" id="desktop-dnone">

                                    <form action="/sliderform" method="post" >

                                        <div class="cal-form-1">

                                            <div class="calculate-box-top">

                                                <div class="box-calculate"><img src="{{ asset('images/homepage/calculator-1.png') }}" height="25px"></div>

                                                <div class="calculate-top-text"><p>დათვალე რემონტის ხარჯები</p></div>

                                                <div class="box-logo"><img src="{{ asset('images/logos/form-logo-1.png') }}" height="25px"></div>

                                            </div>

                                            <div class="calculate-mid">

                                                @csrf

                                                <p class="mid-top-text">მოითხოვე პროექტის ხარჯთაღრიცხვა </p>

                                                <div class="bars-div">

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                </div>

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">რამდენი კვადრატია თქვენი ფართი?<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="მიუთითეთ" name="calculate_form" required />

                                                </div>

                                                <div class="checkbox-div">

                                                    <input type="checkbox" name="is_company" class="cal1-input-check">

                                                    <label class="check-label">მონიშნეთ კომპანიის შემთხვევაში</label>

                                                </div>

                                                <div class="arrow-right">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                </div>

                                                <div class="cal-submit-div">

                                                    <button type="button" class="calculate-sub">გაგრძელება</button>

                                                </div>

                                            </div>                        

                                        </div>

                                        <div class="cal-step-2">

                                            <div class="step2-top d-flex justify-content-between align-items-center">

                                                <div class="">

                                                    <p class="form2-top-all">სულ: <span class="first-price">₾1240.00</span></p>

                                                </div>

                                                <div class="bars-div">

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                </div>

                                            </div>

                                            <div class="form2-mid" id="fields">

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">სახელი და გვარი<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="ჩაწერეთ სახელი და გვარი" name="full_name2"  autocomplete="new-password" required />

                                                </div>

                                                

                                                

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">ელ.ფოსტა</p>

                                                    <input class="cal-input-area" type="text" placeholder="ჩაწერეთ ელ.ფოსტა" name="email2" autocomplete="new-password" required />

                                                </div>

                                                

                                                    <div class="text-input-div">

                                                    <p class="cal-input-text">ტელეფონის ნომერი<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="მიუთითეთ ტელეფონის ნომერი" name="phone_number2" autocomplete="new-password" required />

                                                </div>

                                                

                                                

                                                <div class="d-flex justify-content-between mt-4">

                                                    <div class="checkbox-div">

                                                        <input type="checkbox" name="terms" required class="cal1-input-check" >

                                                        <label class="check-label">გავეცანი <span><a href="#" role="button" data-toggle="modal" data-target="#terms-modal"><span>წესებს</span> და <span class="">პირობებს</span></a></span></label>

                                                    </div>

                                                    <div class="arrow-right">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    </div>

                                                </div>

                                                <div class="cal-submit-div">

                                                    <button type="submit" disabled class="calculate-sub-2 download-btn btn"><img src="{{ asset('images/xd-icons/white/cloud-download-1.png') }}" height="25px">ინვოისის ჩამორვირთვა</button>

                                                </div>

                                            </div>

                                            <!-- <div class="form2-mid" id="company" style="display: none;">

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">კომპანიის ნომერი<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის ტელეფონის ნომერი" name="phone_number" required />

                                                </div>

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">კომპანიის ნომერი<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის სახელი" name="full_name" required />

                                                </div>

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">კომპანიის ელფოსტა</p>

                                                    <input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის ელექტრონული ფოსტის მისამართი" name="email" required />

                                                </div>

                                                <div class="d-flex justify-content-between mt-4">

                                                    <div class="checkbox-div">

                                                        <input type="checkbox" name="terms" required class="cal1-input-check" >

                                                        <label class="check-label">გავეცანი <span><a href="#" role="button" data-toggle="modal" data-target="#terms-modal"><span>წესებს</span> და <span class="">პირობებს</span></a></span></label>

                                                    </div>

                                                    <div class="arrow-right">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    </div>

                                                </div>

                                                <div class="cal-submit-div">

                                                    <button type="submit" disabled class="calculate-sub-2 download-btn btn"><img src="{{ asset('images/xd-icons/white/cloud-download.png') }}">ინვოისის ჩამორვირთვა</button>

                                                </div>

                                            </div> -->

                                        </div>

                                    </form>

                                </div>

                                <!-- -----------------------second-------------------- -->

                                <div class="accordion-div" style="top:-180px !important;">

                                    <button class="accordion calculate-box-top ">

                                        <!-- <div class="calculate-box-top"> -->

                                            <div class="box-calculate"><img src="{{ asset('images/homepage/calculator-1.png') }}" height="25px"></div>

                                            <div class="calculate-top-text"><p>დათვალე რემონტის ხარჯები</p></div>

                                            <!-- <div class="box-logo"><img src="{{ asset('images/logos/form-logo.png') }}"></div> -->

                                        <!-- </div> -->

                                    </button>

                                    <div class="panel">

                                    <form action="/sliderform" method="post">



                                    <div class="calculate-box for-mobile">

                                    <div class="calculate-mid accord-cal-mid">

                                    

                                    @csrf

                                        <p class="mid-top-text">მოითხოვე პროექტის ხარჯთაღრიცხვა </p>

                                        <div class="bars-div">

                                            <span class="bars-area-l"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area-l"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area-l"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                            <span class="bars-area"></span>

                                        </div>

                                        <div class="text-input-div">

                                            <p class="cal-input-text">tრამდენი კვადრატია თქვენი ფართი?<span class="red-color">*</span></p>

                                            <input class="cal-input-area" type="text" placeholder="მიუთითეთ" name="calculate_form" required />

                                        </div>

                                        <div class="checkbox-div">

                                            <input type="checkbox" name="is_company" class="cal1-input-check">

                                            <label class="check-label">მონიშნეთ კომპანიის შემთხვევაში</label>

                                        </div>

                                        <div class="arrow-right">

                                            <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                    </div>

                                        <div class="cal-submit-div">

                                            <button type="button" class="accordion-calculate-sub">გაგრძელება</button>

                                        </div>

                                    

                                    </div>

                                    <div class="accord-cal-step2">

                                            <div class="step2-top d-flex justify-content-between align-items-center">

                                                <div class="">

                                                    <p class="form2-top-all">სულ: <span class="first-price">₾1240.00</span></p>

                                                </div>

                                                <div class="bars-div">

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area-l"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                    <span class="bars-area"></span>

                                                </div>

                                            </div>

                                            <div class="form2-mid" id="fields-mob">

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">სახელი და გვარი<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="ჩაწერეთ სახელი და გვარი" name="full_name" required />

                                                </div>

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">ტელეფონის ნომერი<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="მიუთითეთ ტელეფონის ნომერი" name="phone_number2" required />

                                                </div>

                                                

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">ელ.ფოსტა</p>

                                                    <input class="cal-input-area" type="text" placeholder="ჩაწერეთ ელ.ფოსტა" name="email" required />

                                                </div>

                                                <div class="d-flex justify-content-between mt-4">

                                                    <div class="checkbox-div">

                                                        <input type="checkbox" name="terms" required class="cal1-input-check">

                                                        <label class="check-label">გავეცანი <span><a href="#" role="button" data-toggle="modal" data-target="#terms-modal"><span>წესებს</span> და <span class="">პირობებს</span></a></span></label>

                                                    </div>

                                                    <div class="arrow-right">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                </div>

                                                </div>

                                                <div class="cal-submit-div">

                                                    <button type="submit" disabled class="accord-calculate-sub-2 download-btn btn"><img src="{{ asset('images/xd-icons/white/cloud-download-1.png') }}" height="25px">ინვოისის ჩამორვირთვა</button>

                                                </div>

                                            </div>

                                            <!-- <div class="form2-mid" id="company" style="display: none;">

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">კომპანიის ნომერი<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის ტელეფონის ნომერი" name="phone_number" required />

                                                </div>

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">კომპანიის ნომერი<span class="red-color">*</span></p>

                                                    <input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის სახელი" name="full_name" required />

                                                </div>

                                                <div class="text-input-div">

                                                    <p class="cal-input-text">კომპანიის ელფოსტა</p>

                                                    <input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის ელექტრონული ფოსტის მისამართი" name="email" required />

                                                </div>

                                                <div class="d-flex justify-content-between mt-4">

                                                    <div class="checkbox-div">

                                                        <input type="checkbox" name="terms" required class="cal1-input-check" >

                                                        <label class="check-label">გავეცანი <span><a href="#" role="button" data-toggle="modal" data-target="#terms-modal"><span>წესებს</span> და <span class="">პირობებს</span></a></span></label>

                                                    </div>

                                                    <div class="arrow-right">

                                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" height="25px" class="right-chevron-style">

                                                </div>

                                                </div>

                                                <div class="cal-submit-div">

                                                    <button type="submit" disabled class="accord-calculate-sub-2 download-btn btn"><img src="{{ asset('images/xd-icons/white/cloud-download.png') }}">ინვოისის ჩამორვირთვა</button>

                                                </div>

                                            </div> -->

                                        </div>

                                        </div>

                                        </form>

                            </div>

                        @endif 

                    </div>

                </div>

            </div>

                   

                   <!-- end form homepage -->



                   <!-- <div class="col-md-6 col-sm-6 col-lg-3 single-pro-pad mob-2-col">

                       <div class="gallery-projects-style p-3">

                           <image class="single-project-image-gallery-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">

                               <div class="single-project-font-style-similer-para d-flex justify-content-between">

                                   <div>

                                       <span class="single-project-font-style-similer-para-span-1">ახალი ხედვა</span><br>

                                       <span class="single-project-font-style-similer-para-span-2">"ოფისის რემონტი"</span>

                                   </div>

                                   <div>

                                       <img class="" src="/images/developer-images/Send.png" alt="">

                                   </div>

                               </div>    



                       </div>

                   </div>

                   <div class="col-md-6 col-sm-6 col-lg-3 single-pro-pad mob-2-col">

                       <div class="gallery-projects-style p-3">

                           <image class="single-project-image-gallery-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">

                               <div class="single-project-font-style-similer-para d-flex justify-content-between">

                                   <div class="single-text">

                                       <span class="single-project-font-style-similer-para-span-1">ახალი ხედვა</span><br>

                                       <span class="single-project-font-style-similer-para-span-2">"ოფისის რემონტი"</span>

                                   </div>

                                   <div class="single-link">

                                       <img class="" src="/images/developer-images/Send.png" alt="">

                                   </div>

                               </div>     

               

                       </div>

                   </div>

                   <div class="col-md-6 col-sm-6 col-lg-3 single-pro-pad mob-2-col">

                       <div class="gallery-projects-style p-3">

                           <image class="single-project-image-gallery-style" src="https://www.metrix.skmeistore.us/images/projects/29/thumbnail-mdf-is-samzareulo-section-image-6.jpeg?1664388039">

                               <div class="single-project-font-style-similer-para d-flex justify-content-between">

                                   <div>

                                       <span class="single-project-font-style-similer-para-span-1">ახალი ხედვა</span><br>

                                       <span class="single-project-font-style-similer-para-span-2">"ოფისის რემონტი"</span>

                                   </div>

                                   <div>

                                       <img class="" src="/images/developer-images/Send.png" alt="">

                                   </div>

                               </div>    



                       </div>

                   </div> -->

               </div>

           </div>   

       </div><br><br><br>



      

   </div>

@endsection



@section('js')

    <script type="text/javascript">

                    



        $(document).ready(function() {



            $(".cal-step-2").hide();

            $(".calculate-sub").click(function(){

                console.log("click d");

                var meters=jQuery('input[name="calculate_form"]').val();

                if(meters==''){

                    jQuery('input[name="calculate_form"]').addClass('border-danger');

                    return false;

                }else{

                    jQuery('input[name="calculate_form"]').removeClass('border-danger');

                }

                        var type=false;

                        if(jQuery('input[name="is_company"]').is(':checked')){

                            type=true;

                        }

                        console.log(type);

                        jQuery.ajax({

                            url:'/sliderform',

                            type:'POST',

                            data:{action:'first_form',calculate_form:meters,is_company:type},

                            success:function(data){

                                // console.log(data);

                                var res=jQuery.parseJSON(data);

                                if(res.status=="success"){

                                    jQuery('.first-price').text('₾ '+res.price);

                                    $(".cal-form-1").hide();

                                    $(".cal-step-2").show();

                                }

                                

                            },

                        });

              

            });

            $(".accord-cal-step2").hide();

            $(".accordion-calculate-sub").click(function(){

                console.log("click M",jQuery('input[name="is_company"]'));

                var meters=jQuery('input[name="calculate_form"]')[1].value;

                console.log(meters,"mm");

                if(meters==''){

                    jQuery('input[name="calculate_form"]').addClass('border-danger');

                    return false;

                }else{

                    jQuery('input[name="calculate_form"]').removeClass('border-danger');

                }

                        var type=false;

                        if(jQuery('input[name="is_company"]').is(':checked')){

                            type=true;

                        }

                        jQuery.ajax({

                            url:'/sliderform',

                            type:'POST',

                            data:{action:'first_form',calculate_form:meters,is_company:type},

                            success:function(data){

                                // console.log(data);

                                var res=jQuery.parseJSON(data);

                                if(res.status=="success"){

                                    jQuery('.first-price').text('₾ '+res.price);

                                    $(".accord-cal-mid").hide();

                                    $(".accord-cal-step2").show();

                                    $('.accordion.calculate-box-top').click();

                                    $('.accordion.calculate-box-top').click();

                                    $(".container-1200.form_1.mb-5").hide();

                                    $(".container-1200.form_2.mb-5").show();

                                    

                                }

                                

                            },

                        });

               

            });

            $(".single-video-show-1").hide();

            $(".single-video-show-2").hide();



            if ($(window).width() < 749) {

                $('#video_2').hide();

                $('.mob-before-repair-button').addClass('active');

                $(".mob-before-repair-button").click(function(){

                    $('#video_2').hide();

                    $('#video_1').show();

                    $('.mob-after-repair-button').removeClass('active');

                    $('.mob-before-repair-button').addClass('active');

                });

                $(".mob-after-repair-button").click(function(){

                    $('#video_1').hide();

                    $('#video_2').show();

                    $('.mob-after-repair-button').addClass('active');

                    $('.mob-before-repair-button').removeClass('active');

                });

            }

            

            // $('#before').click(function(){

               

            // });

            // $('#after').click(function(){

                

            // });





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



            $(".single-video-icon-hide-1").click(function(){

                $(".single-video-a-hide-1").hide();

                $(".single-video-show-1").show();

                $(".single-video-show-1 iframe")[0].src += "?autoplay=1";

                console.log('video first');

            });

            $(".single-video-icon-hide-2").click(function(){

                $(".single-video-a-hide-2").hide();

                $(".single-video-show-2").show();

                $(".single-video-show-2 iframe")[0].src += "?autoplay=1";

                console.log('video second');

            });

        });

    </script>

    

  



<script>



document.getElementById("copy-url").addEventListener("click", copyUrl);



  function copyUrl() {

    var currentUrl = document.location.href;

    navigator.clipboard.writeText(currentUrl).then(function() {

    console.log('Copied!');

}, function() {

    console.log('Copy error')

});

  }

  

</script>

<style>

    .project-img {

        position : relative;

    }

    .project-in-progress {

        display: flex;

        align-items: center;

        justify-content: center;

        direction: ltr;

        width: 105px;

        height: 30px;

        position: absolute;

        top: 25px;

        left: 25px;

        background-color: rgba(241,90,41,.5);

        z-index: 10;

    }

    .project-in-progress img {

        width: 15px!important;

        height: 15px;

        margin-right: 5px;

    }

    .project-in-progress span {

        font-size : 12px;

        color : white;

    }

</style>

@endsection