@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();
@endphp
<?php 
//  echo "<pre>";
//      print_r($data ['raw'] ['text_add']);
//   echo "</pre>";
//      exit;
?>
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
<style>
    .right-chevron-style{
        margin-left: -3px !important;
    }
    </style>
    <div class="homepage-wrapper d-fc">
        @if ( $data['exists'] )
        <?php $i=0;?>
            <div class="homepage-slider-wrapper">
                <div class="owl-carousel owl-theme" id="homepage-slider">
                    @php
                        $slides = $data['slides'];
                        if ( $agent->isMobile() ) $slides = $data['mob_slides'];
                        
                    @endphp
                    @foreach ( $slides as $index => $slide )
                    <?php
                            $text=explode(',',$data['raw']['text_add']);
                            $text_para=explode(',',$data['raw']['text_paragraph']); 
                            $add_link=explode(',',$data['raw']['add_link']); 
                            $add_button=explode(',',$data['raw']['add_button']); 
                           ?>
                        <div class="carousel-block">
                                <div class="float-right main-css carousel-textarea">
                                    @if(isset($text[$index]))
                                    <h1><?php echo $text[$index]?></h1>
                                    <p><?php echo $text_para[$index]?></p>
                                    <a class="btn button" href="<?php echo $add_link[$index]?>"><?php echo $add_button[$index]?></a>
                                    @endif
                                </div>
                            <img class="owl-lazy" alt="lazy-load" data-src="{{ asset($slide['location']) }}" alt="{{ $slide['alt'] }}" fetchpriority="high" style="background : url('/masters/owl-master/css/ajax-loader.gif') no-repeat; min-height : 500px;">
                        </div>
                            <?php $i++ ?>
                    @endforeach
                </div>
                <div class="calculate-box for-desktop">
                    <button class="accordion calculate-box-top">
                        <div class="box-calculate"><img src="{{ asset('images/homepage/calculator-1.png') }}" alt="calculator" height="25px"></div>
                        <div class="calculate-top-text"><p>დათვალე რემონტის ხარჯები</p></div>
                        <div class="box-logo"><img src="{{ asset('images/logos/form-logo-1.png') }}" "form-logo" height="25px"></div>
                    </button>
                    <div class="panel">
                        <form action="/sliderform" method="post" id="form_1">
                            <div class="cal-form-1">
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
                                    <input class="cal-input-area" type="text" placeholder="მიუთითეთ" name="calculate_form2" autocomplete="new-password" required />
                                </div>
                                <div class="checkbox-div">
                                    <input type="checkbox" name="is_company" class="cal1-input-check">
                                    <label class="check-label">მონიშნეთ კომპანიის შემთხვევაში</label>
                                </div>
                                <div class="arrow-right">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                </div>
                                <div class="cal-submit-div">
                                    <button type="button" class="calculate-sub">გაგრძელება</button>
                                </div>
                            </div>
                            <div class="cal-step-2" style="display: none;">
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
                                        <input class="cal-input-area" type="text" placeholder="ჩაწერეთ სახელი და გვარი" name="full_name2" autocomplete="new-password" required />
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
                                            <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron"  height="25px" class="right-chevron-style">
                                            <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                            <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                            <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                            <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron"  height="25px" class="right-chevron-style">
                                            <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                        </div>
                                    </div>
                                    <div class="cal-submit-div">
                                        <div class="cal-sub-div"><button type="submit" disabled class="calculate-sub-2 download-btn btn"><img src="{{ asset('images/xd-icons/white/cloud-download-1.png') }}" alt="download" height="25px">ინვოისის ჩამოტვირთვა</button></div>
                                        <a href="javascript:void(0)" class="cal-refresh-div"><img src="{{ asset("images/homepage/reload.png") }}" alt="refresh" class="refresh_icon"></a>
                                    </div>
                                </div>                               
                            </div>
                        </form> 
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
                <div class="accordion-div">
                    <button class="accordion calculate-box-top ">
                        <!-- <div class="calculate-box-top"> -->
                            <div class="box-calculate"><img src="{{ asset('images/homepage/calculator-1.png') }}" alt="calculator" height="25px"></div>
                            <div class="calculate-top-text"><p>დათვალე რემონტის ხარჯები</p></div>
                            <!-- <div class="box-logo"><img src="{{ asset('images/logos/form-logo.png') }}"></div> -->
                        <!-- </div> -->
                    </button>
                    <div class="panel">
                    <form action="/sliderform" method="post" id="form_2">
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
                                    <p class="cal-input-text">რამდენი კვადრატია თქვენი ფართი?<span class="red-color">*</span></p>
                                    <input class="cal-input-area" type="text" placeholder="მიუთითეთ" name="calculate_form2" autocomplete="new-password" required />
                                </div>
                                <div class="checkbox-div">
                                    <input type="checkbox" name="is_company" class="cal1-input-check">
                                    <label class="check-label">მონიშნეთ კომპანიის შემთხვევაში</label>
                                </div>
                                <div class="arrow-right">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
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
                                        <input class="cal-input-area" type="text" placeholder="ჩაწერეთ სახელი და გვარი" name="full_name2" required />
                                    </div>
                                    <div class="text-input-div">
                                        <p class="cal-input-text">ტელეფონის ნომერი<span class="red-color">*</span></p>
                                        <input class="cal-input-area" type="text" placeholder="მიუთითეთ ტელეფონის ნომერი" name="phone_number2" autocomplete="new-password" required />
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
                                            <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                        <img src="{{ asset('images/homepage/right-chevron-1.png') }}" alt="chevron" height="25px" class="right-chevron-style">
                                    </div>
                                    </div>
                                    <div class="cal-submit-div">
                                        <div class="cal-sub-div"><button type="submit" disabled class="accord-calculate-sub-2 download-btn btn"><img src="{{ asset('images/xd-icons/white/cloud-download-1.png') }}" alt="download" height="25px">ინვოისის ჩამოტვირთვა</button></div>
                                        <a href="javascript:void(0)" class="cal-refresh-div"><img src="{{ asset('images/homepage/reload.png') }}" alt="refresh" class="refresh_icon"></a></div>
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
            </div>
        @endif
    </div>    

        <div class="homepage-video-wrapper d-flex container-1280 new-section-home justify-content-around">
             
                <div class="video">
                    
                    <div class="right-block"></div>
                </div>
                        <div class="text d-fc">
                <div class="upper">
                    <h3><i class="square"></i> მეტრიქსის შესახებ</h3>
                    <p><br>სარემონტო კომპანია METRIX-ი ინტერიერის დიზაინი, რემონტი, ავეჯის დამზადება, ხელოსანი გამოძახებით, სამშენებლო მასალები online.</p>
                </div>
                <div class="lower">
                    <div class="left">
                        <a href="https://www.metrix.ge/about" class="universal-button orange">დაწვრილებით</a>
                        <i class="orange" id="arrow-right"></i>
                    </div>
                    <div class="right">
                        <span>დაგვიმეგობრდი</span>
                        <a class="fa" href="https://www.facebook.com/metrixgeorgia/"></a>
                    <a class="ig" href="#"></a> 
                    </div>
                </div>
                <div class="bottom-line"></div>
            </div>
        </div>

        <div class="homepage-video-wrapper d-flex container-1200  d-none-custom">
            @if ( !$agent->isMobile() ) {{-- Needs to be reverse --}}
                <div class="video">
                    {{-- <iframe src="https://www.youtube.com/embed/{{ ($data['exists']) ? $data['video']['video_link'] : 'C3iI6S7TuCA' }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                    <div class="right-block"></div>
                </div>
            @endif
            <div class="text d-fc">
                <div class="upper">
                    <h3><i class="square"></i> {{ $tranCT->translate('about_metrix') }}</h3>
                    <p>{!! ($data['exists']) ? $data['video']['video_text'][Session::get('locale')] : '<strong>დააჭირეთ</strong> ტექსტი რომ შეცვალოთ' !!}</p>
                </div>
                <div class="lower">
                    <div class="left">
                        <a href="{{ ($data['exists']) ? $data['video']['video_button_link'] : '#' }}" class="universal-button orange">{{ $tranCT->translate('detailed') }}</a>
                        <i class="orange" id="arrow-right"></i>
                    </div>
                    <div class="right">
                        <span>{{ $tranCT->translate('befriend_us') }}</span>
                        <a class="fa" href="https://www.facebook.com/metrixgeorgia/"></a>
                        <a class="ig" href="#"></a>
                    </div>
                </div>
                <div class="bottom-line"></div>
            </div>
        </div>

     <!--   <div class="container-1200 form_1 mb-5">
            <div class="inline-class">
                <span class="mobile-square"><i class="square"></i></span><p class="mobile-about">სერვისის შესახებ </p>
            </div>
            <div class="mobile-form-text">
                <p>სარემონტო კომპანია METRIX-ი ინტერიერის დიზაინი, რემონტი, ავეჯის დამზადება, ხელოსანი გამოძახებით, სამშენებლო მასალები online.</p>
            </div>
            <div class="mobile-detail-div">
                <a href="#" class="mobile-detail-button">დაწვრილებით</a>
            </div>
        </div>

        <div class="container-1200 form_2 mb-5">
            <div class="inline-class">
                <p class="mobile-potfolio">ჩვენი ნამუშევრები</p>
            </div>
            <div class="mobile-form2-text">
                <p>გაეცანით მიმდინარე და სარულებულ პროექტებს ჩვენი პორტფოლიოდან</p>
            </div>
            <div class="mobile-rate-div">
                <a href="#" class="mobile-rate-button">შეაფასე</a>
            </div>
        </div>
-->
        <div class="custom-digi-border"></div>
        <div class="d-flex container-1280 pt-5 pb-5 cat-div-mobile">
            <div class="row m-0 justify-content-around desktop-small">
                <div class="col-md-5 home-cat p-0">
                    <div class="cat-box row">
                       <div class="col-6 col-sm-6">
                            <a href="#remonti" class="active box-cat1 services-btn" data-name="repairs">
                                <!-- <i class="white reverse" id="arrow-right"></i> -->
                                <i id="paint-roller"></i>
                                <p>{{ $tranCT->translate('repairs') }}</p>
                            </a>
                        </div>  
                        <div class="col-6 col-sm-6">
                            <a href="#dizaineri" class="box-cat1 services-btn" data-name="designer">
                                <!-- <i class="white reverse" id="arrow-right"></i> -->
                                <i id="paint-brush"></i>
                                <p>{{ $tranCT->translate('designer') }}</p>
                            </a>
                        </div>
                        <div class="col-6 col-sm-6">
                            <a href="#avejis-damzadeba" class="box-cat1 services-btn" data-name="furniture">
                                <!-- <i class="white" id="arrow-right"></i> -->
                                <i id="couch"></i>
                                <p>{{ $tranCT->translate('furniture_crafting') }}</p>
                            </a>
                        </div>
                       
                       <div class="col-6 col-sm-6">
                            <a href="#vip-masteri" class="box-cat1 services-btn" data-name="vip">
                                <!-- <i class="white" id="arrow-right"></i> -->
                                <i id="wrench"></i>
                                <p>{{ $tranCT->translate('vip_master') }}</p>
                            </a>
                        </div>
                       
                       
                    </div>    
                <!-- <div class="box-cat1">
                    <img src="{{ asset('images/homepage/Path 7.png') }}">
                </div>
                <div class="box-cat2">
                    <img src="{{ asset('images/homepage/Path 22.png') }}">
                </div>
                <div class="box-cat2">
                    <img src="{{ asset('images/homepage/Path 15.png') }}">
                </div>
                <div class="box-cat2">
                    <img src="{{ asset('images/homepage/Path 17.png') }}">
                </div> -->
            </div>
            <!-- repairs -->
            <div class="col-md-5 home-cat ser" id="service-repairs">
                <div class="right-box  cat-rightbox-custom">
                    <div class="d-flex flex-wrap for-home-mobile-text">
                        <h4 class="text-warning"><strong>სერვისის შესახებ</strong></h4>
                        <p class="d-flex h4"><i class="square"></i><strong><span class="border-bott">{{ $tranCT->translate('repairs') }}</span></strong></p>
                    </div>
                    @if($data['has_repairs'])
                    @php
                        //print_r($data['repairs']['meta_description']);
                        //exit;
                    @endphp
                    
                    <div class="remove-padding">
                        <!--<p class="w-75 pt-4 m-0">{{ $data['repairs']['meta_description'] }}</p> -->
                    </div>
                    @endif
                    <div class="remove-padding">
                        <p class="w-75 pt-4 m-0">რემონტის წამოწყება უამრავ სირთულეს უკავშირდება - მაღაზიებში სირბილი, მასალის შერჩევა, კარგი ხელოსნის პოვნა, თვეობით გაწელილი ვადები და რემონტს შეწირული ნერვები. Metrix-თან თანამშრომლობისას მსგავსი შემთხვევებისგან სრულად ხართ დაცული. მეტრიქსი გამოცდილ და სანდო ხელოსნებს აერთიანებს. ისინი მზად არიან, რემონტთან დაკავშირებული ნებისმიერი უსიამოვნება საკუთარ თავზე აიღონ და დასრულებული პროექტი წინასწარ განსაზღვრულ ვადებში ჩაგაბარონ. </p>
                    </div>
                    <div class="remove-padding">
                        <p class="w-75 pt-3 ">Metrix-ის ხელოსნების გუნდი გთავაზობთ სრულ სარემონტო მომსახურებას ერთ სივრცეში: იატაკის დაგება, აბაზანის მოპირკეთება, სანტექნიკის მონტაჟი, შპალერის გაკვრა, კედლის შეღებვა, გათბობა/კონდიცირების სისტემის მონტაჟი, ელექტროგაყვანილობის დაგეგმვა, კედლებისა თუ იატაკის თბოიზოლაცია, შეკიდული ჭერის მონტაჟი და სხვა. .</p>
                    </div>
                    <div class=" home-button-space-bot">
                        <a href="/repairs" class="btn text-warning border bg-white border-warning detail-full-button">დაწვრილებით</a>
                    </div>
                    <div class="border-bottom  border-warning"></div>
                </div>
            </div>
          
           
            <!-- designer -->
            <div class="col-md-5 home-cat ser " id="service-designer" style="display: none;">
                <div class="right-box  cat-rightbox-custom">
                    <div class="d-flex flex-wrap for-home-mobile-text">
                        <h4 class="text-warning"><strong>სერვისის შესახებ</strong></h4>
                        <p class="d-flex h4"><i class="square"></i><strong><span class="border-bott">{{ $tranCT->translate('designer') }}</span></strong></p>
                    </div>
                    @if($data['has_designer'])
                    @php
                        //print_r($data['designer']['meta_description']);
                        //exit;
                    @endphp
                    
                    <div class="remove-padding">
                     <!--   <p class="w-75 pt-4 m-0"> {{ $data['designer']['meta_description'] }}</p> -->
                     
                    </div>
                    @endif
                    <div class="remove-padding">
                        <p class="w-75 pt-3 "></p>
                    </div> 
                    <div class="remove-padding">
                        <p class="w-75 pt-4 m-0">არასწორი დაპროექტებით თქვენი ბინა შესაძლოა, ნაკლებად ფუნქციური და არაესთეტიკური გამოჩნდეს. დიდია ალბათობა, რომ შეუსაბამო განათებამ, ცუდად დაგეგმილმა გაყვანილობებმა თუ შეუფერებელმა ავეჯმა თქვენი ინტერიერი ერთ დიდ გაუგებრობად აქციოს და ყოველდღიური ცხოვრება გაგირთულოთ. ინტერიერისა თუ ლანდშაპტის დიზაინერის მომსახურებით საცხოვრებელ სივრცეს უფრო კომფორტულსა და ადაპტირებულს გახდით. მისი დახმარებით თქვენს სურვილებსა თუ საჭიროებებს რეალობად აქცევთ და 3D დიზაინის სახით წინასწარაც შეავლებთ თვალს. 
</p>
                    </div> 
                    <div class="remove-padding">
                        <p class="w-75 pt-3 ">Metrix-ის დიზაინერი თქვენთან შეთანხმებით შეასრულებს აზომვით სამუშაოებს, უზრუნველყოფს სწორ დაგეგმარებას და თქვენი გემოვნების შესაბამისად შეარჩევს დიზაინის სტილს. რაც მთავარია, სურვილის შემთხვევაში, აქტიურად იქნება ჩართული მიმდინარე პროცესებში და საჭირო მასალის შეძენაშიც დაგეხმარებათ.</p>
                    </div> 
                    <div class="home-button-space-bot">
                        <a href="/designer" class="btn text-warning border bg-white border-warning detail-full-button">დაწვრილებით</a>
                    </div>
                    <div class="border-bottom  border-warning"></div>
                </div>
            </div>
            <!-- furniture -->
            <div class="col-md-5 home-cat ser" id="service-furniture" style="display: none;">
                <div class="right-box  cat-rightbox-custom">
                    <div class="d-flex flex-wrap for-home-mobile-text">
                        <h4 class="text-warning"><strong>სერვისის შესახებ</strong></h4>
                        <p class="d-flex h4"><i class="square"></i><strong><span class="border-bott">{{ $tranCT->translate('furniture_crafting') }}</span></strong></p>
                    </div>
                    @if($data['has_furniture'])
                    @php
                        //print_r($data['furniture']['meta_description']);
                        //exit;
                    @endphp
                    
                    <div class="remove-padding">
                       <!-- <p class="w-75 pt-4 m-0">{{ $data['furniture']['meta_description'] }}</p> -->
                    </div>
                    @endif
                  <div class="remove-padding">
                        <p class="w-75 pt-4 m-0">ზოგჯერ რთულია, თქვენთვის საჭირო თუ ინტერიერის შესაფერისი ავეჯი იაფად შეიძინოთ. ასეთ დროს ავეჯის დამზადება შეკვეთით საუკეთესო გამოსავალია. შეგიძლიათ, თავად დაგეგმოთ მისი დიზაინი, რომელიმე ჟურნალიდან მოიძიოთ იდეა ან ჩვენი ხელოსნის მიერ გაცემული რეკომენდაციები გაითვალისწინოთ და საქმე Metrix-ის გამოცდილ გუნდს მიანდოთ.
.</p>
                    </div> 
                    <div class="remove-padding">
                        <p class="w-75 pt-3 "> ავეჯი სამზარეულოსთვის, აბაზანისთვის, საძინებლისთვის, მისაღები ოთახისთვის, საბავშვო ოთახისთვის, ოფისისა და ეზოსთვის - ჩვენი პროფესიონალი ხელოსნები ნებისმიერი სირთულისა თუ მოცულობის შეკვეთას უნაკლოდ და დროულად დაგიმზადებენ. რაც მთავარია, თქვენ მიერ შეკვეთილი ავეჯი მაქსიმალურად იქნება მორგებული თქვენს ფინანსებზე, საჭიროებებსა და გემოვნებაზე. </p>
                    </div>
                    <div class="remove-padding">
                        <p class="w-75 pt-3 "></p>
                    </div> 
                    <div class=" home-button-space-bot">
                        <a href="/furniture" class="btn text-warning border bg-white border-warning detail-full-button">დაწვრილებით</a>
                    </div>
                    <div class="border-bottom  border-warning"></div>
                </div>
            </div>
          
 <!-- vip -->
            <div class="col-md-5 home-cat ser" id="service-vip"  style="display: none;">
                <div class="right-box  cat-rightbox-custom">
                    <div class="d-flex flex-wrap for-home-mobile-text">
                        <h4 class="text-warning"><strong>სერვისის შესახებ</strong></h4>
                        <p class="d-flex h4"><i class="square"></i><strong><span class="border-bott">VIP მასტერი</span></strong></p>
                    </div>
                    @if($data['has_vip'])
                    @php
                        $meta=json_decode($data['vip']['meta'],true);
                        //print_r($meta);

                        //exit;
                    @endphp
                    @foreach($meta as $item)
                  <!--  <div class="remove-padding">
                        <h6 class=" pt-2 m-0">{{ $item['meta_title'] }}</h6>
                        <p class="w-75 pl-1">{{ $item['meta_description'] }}</p>
                    </div> -->
                    @endforeach
                    @endif
                   <div class="remove-padding">
                        <p class="w-75 pt-4 m-0"> თანამედროვე სამყაროში მომსახურება, რომელიც დროსა და ენერგიას დაგიზოგავთ, ყველაზე მეტად ფასობს. დღეს აღარ გჭირდებათ, ხელოსნის მოსაძებნად ელიავაზე ირბინოთ. მისი გამოძახება Metrix-ის დახმარებით მეტად მარტივი და კომფორტულია. Metrix გთავაზობთ ხელოსნის გამოძახების სერვისს ნებისმიერი ტიპის სამუშაოსთვის. იქნება ის სანტექნიკა, გათბობა/კონდიცირება, ელექტროობა, საყოფაცხოვრებო ტექნიკა თუ სახლის კინოთეატრის მონტაჟი.   </p>

                    </div>
                    <div class="remove-padding">
                        <p class="w-75 pt-3 ">Metrix-ის VIP მასტერის გამოძახება 24/7-ზე თბილისის ნებისმიერ უბანშია შესაძლებელი. ისინი ნებისმიერი სირთულის სამუშაოს დროულად, ყოველგვარი გართულების გარეშე შეასრულებენ. რაც მთავარია, თქვენი თანხმობის შემთხვევაში სამუშაოსთვის საჭირო მასალას თავად შეიძენენ და ამ დისკომფორტსაც თავიდან აგაცილებენ.</p>
                    </div>
                    
                   
                    <div class=" home-button-space-bot">
                        <a href="/vip-master" class="btn text-warning border bg-white border-warning detail-full-button">დაწვრილებით</a>
                    </div>
                    <div class="border-bottom  border-warning"></div>
                </div>
            </div>

            </div>

            
        </div>
        <div class="d-flex justify-content-end">
            <span class="custom-digi-border custom-digi-border-2"></span>
        </div>
        <!-- <div class="about-service-wrapper d-fc">
            @if ( !$agent->isMobile() ) {{-- Needs to be reverse --}}
                <div class="about-service-guy">
                    <img src="{{ asset('images/homepage/about-service-guy.svg') }}">
                </div>
            @endif
            <div class="category-buttons">
                <a href="#avejis-damzadeba" id="furniture" class="">
                    <i class="white" id="arrow-right"></i>
                    <i id="couch"></i>
                    <p>{{ $tranCT->translate('furniture_crafting') }}</p>
                </a>
                <a href="#vip-masteri" id="vip-master" class="active">
                    <i class="white" id="arrow-right"></i>
                    <i id="wrench"></i>
                    <p>{{ $tranCT->translate('vip_master') }}</p>
                </a>
                <a href="#dizaineri" id="designer" class="">
                    <i class="white reverse" id="arrow-right"></i>
                    <i id="paint-brush"></i>
                    <p>{{ $tranCT->translate('designer') }}</p>
                </a>
                <a href="#remonti" id="repairs" class="">
                    <i class="white reverse" id="arrow-right"></i>
                    <i id="paint-roller"></i>
                    <p>{{ $tranCT->translate('repairs') }}</p>
                </a>
            </div>
            <div class="service-text d-fc justify-content-center">
                <div class="upper">
                    @if( !$agent->isMobile() ) {{-- Needs to be reverse --}} <span>{{ $tranCT->translate('about_service') }}</span> <i class="square"></i> @endif <strong>{{ $tranCT->translate('vip_master') }}</strong>
                </div>
                <div class="middle">
                    <p>{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_1'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}</p>
                </div>
                <div class="lower">
                    <a href="/vip-master" class="universal-button">{{ $tranCT->translate('detailed') }}</a>
                </div>
            </div>
        </div> -->

       
        @include('user.components.projects')

        @include('user.components.partners')
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){

        $('.about-service-wrapper .category-buttons > a').each(function() {
            $(this).click(function() {
                $(this).siblings('a').removeClass('active')
                $(this).addClass('active')

                if ( $(this).attr('id') == 'furniture' ) {
                    $('.service-text .upper strong').text('{{ $tranCT->translate('furniture_crafting') }}')
                    $('.service-text .middle p').html('{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_0'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}')
                    $('.service-text .lower a').attr('href', 'furniture')
                } else if ( $(this).attr('id') == 'vip-master' ) {
                    $('.service-text .upper strong').text('{{ $tranCT->translate('vip_master') }}')
                    $('.service-text .middle p').html('{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_1'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}')
                    $('.service-text .lower a').attr('href', 'vip-master')
                } else if ( $(this).attr('id') == 'designer' ) {
                    $('.service-text .upper strong').text('{{ $tranCT->translate('designer') }}')
                    $('.service-text .middle p').html('{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_2'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}')
                    $('.service-text .lower a').attr('href', 'designer')
                } else if ( $(this).attr('id') == 'repairs' ) {
                    $('.service-text .upper strong').text('{{ $tranCT->translate('repairs') }}')
                    $('.service-text .middle p').html('{!! ($data['exists']) ? $data['about'][Session::get('locale')]['text_3'] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}')
                    $('.service-text .lower a').attr('href', 'repairs')
                }
            })
        })

        $('.projects-slider-wrapper .header .categories button').click(function() {
            $(this).siblings('button').removeClass('active')
            $(this).addClass('active')
        })
        
        $('.for-desktop .accordion.calculate-box-top').click();
    })
</script>
@endsection