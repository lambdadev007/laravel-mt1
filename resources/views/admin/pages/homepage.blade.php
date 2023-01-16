@extends('admin.layout')

@section('content')
    <form class="d-fc" action="/enter/homepage/update/null" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        {{-- Meta --}}
        <?php 
    //     echo "<pre>";
    //     print_r($data);
    //  echo "</pre>";
    //     exit;
        ?>
            <div class="container-800 d-fc">
                <button class="s-collapse" type="button" data-target="#meta">მეტა ინფორმაცია</button>
                <div class="s-collapse d-fc" id="meta">
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_title" placeholder="სათაური" value="{{ ($data['exists']) ? $data['raw']['meta_title'] : '' }}" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/135</span>
                        <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="135" required>{{ ($data['exists']) ? $data['raw']['meta_description'] : '' }}</textarea>
                    </div>
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ ($data['exists']) ? $data['raw']['meta_keywords'] : '' }}" maxlength="60" required>
                    </div>
                </div>
            </div>
        {{-- Meta --}}

        {{-- Slider --}}
            <button class="s-collapse" type="button" data-target="#slider">სლაიდერი</button>
            <div class="s-collapse d-fc" id="slider">
                @if ( $data['exists'] )
                    <div class="homepage-slider-wrapper">
                        <div class="owl-carousel owl-theme" id="homepage-slider">
                            @foreach ( $data['slides'] as $slide )
                                <div class="carousel-block">
                                    <img class="owl-lazy" data-src="{{ asset($slide['location']) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <button type="button" class="universal-button w-100 mb-2" id="add-slides">სურათის დამატება</button>

                <div class="d-fc" id="slider-images">
                    @if ( $data['exists'] )
                    <?php $i=0;?>
                        @foreach ($data['slides'] as $index => $slide)
                        <?php
                            $text=explode(',',$data['raw']['text_add']);
                            $text_para=explode(',',$data['raw']['text_paragraph']);
                            $add_link=explode(',',$data['raw']['add_link']);
                            $add_button=explode(',',$data['raw']['add_button']);
                        
                        ?>
                            <label class="image-reader-wrapper d-fc w-100 mb-2" for="slide-{{ $index }}">
                            
                                <div class="remove-this-item slide">&times;</div>
                                <input class="form-control" type="text" name="text_add[]" placeholder="სათაური" value="{{ ($data['exists']) ? $text[$i] : '' }}"  >
                                <input class="form-control" type="text" name="text_paragraph[]" placeholder="სათაური" value="{{ ($data['exists']) ? $text_para[$i] : '' }}"  >
                                <input class="form-control" type="text" name="add_link[]" id="link-button" placeholder="Add link" value="{{ ($data['exists']) ? $add_link[$i] : '' }}">
                                <input class="form-control" type="text" name="add_button[]" id="add-button" placeholder="Button Text" value="{{ ($data['exists']) ? $add_button[$i] : '' }}">
                                <img class="image-loader" src="{{ asset($slide['location']) }}">
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="homepage_slides[]" id="slide-{{ $index }}">
                                <input type="text" class="text-center form-control" name="homepage_slide_alts[]" placeholder="სურათის ალტი" value="{{ $slide['alt'] }}" required>
                                <input type="hidden" name="existing_homepage_slides[]" value="{{ $slide['location'] }}">
                                <input type="hidden" name="amount_of_homepage_slides[]" value="null">
                            </label>
                          
                     <?php $i++ ?>
                        @endforeach
                    @endif
                </div>
            </div>
        {{-- Slider --}}

        {{-- Mob Slider --}}
            <button class="s-collapse" type="button" data-target="#mob-slider">მობილური სლაიდერი</button>
            <div class="s-collapse d-fc" id="mob-slider">
                @if ( $data['exists'] )
                    <div class="homepage-slider-wrapper mx-auto w-375">
                        <div class="owl-carousel owl-theme" id="homepage-slider">
                            @foreach ( $data['mob_slides'] as $slide )
                                <div class="carousel-block">
                                    <img class="owl-lazy" data-src="{{ asset($slide['location']) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <button type="button" class="universal-button w-100 mb-2" id="add-mob-slides">სურათის დამატება</button>

                <div class="d-flex flex-wrap" id="mob-slider-images">
                    @if ( $data['exists'] )
                        @foreach ($data['mob_slides'] as $index => $slide)
                            <label class="image-reader-wrapper d-fc w-375 mb-2 mx-3" for="mob-slide-{{ $index }}">
                                <div class="remove-this-item slide">&times;</div>
                                <img class="image-loader" src="{{ asset($slide['location']) }}">
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="mob_homepage_slides[]" id="mob-slide-{{ $index }}">
                                <input type="text" class="text-center form-control" name="mob_homepage_slide_alts[]" placeholder="სურათის ალტი" value="{{ $slide['alt'] }}" required>
                                <input type="hidden" name="existing_mob_homepage_slides[]" value="{{ $slide['location'] }}">
                                <input type="hidden" name="amount_of_mob_homepage_slides[]" value="null">
                            </label>
                        @endforeach
                    @endif
                </div>
            </div>
        {{-- Mob Slider --}}

        {{-- Video --}}
            <button class="s-collapse active" type="button" data-target="#video-ka">ვიდეო</button>
            <div class="s-collapse d-fc show" id="video-ka">
                <div class="homepage-video-wrapper">
                    <div class="video d-fc">
                        <div class="d-flex position-relative">
                            <iframe width="500" height="210" src="https://www.youtube.com/embed/{{ ($data['exists']) ? $data['video']['video_link'] : 'C3iI6S7TuCA' }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="right-block"></div>
                        </div>
                        <input type="text" name="video_link" class="form-control w-100 mt-2" placeholder="მხოლოდ კოდი - https://www.youtube.com/watch?v=0WfU2w-qB5I-ს კოდი არის 0WfU2w-qB5I წინააღმდეგ შემთხვევაში ვიდეო არ იმუშავებს" value="{{ ($data['exists']) ? $data['video']['video_link'] : 'C3iI6S7TuCA' }}" required>
                    </div>
                    <div class="text d-fc">
                        <div class="upper">
                            <p contenteditable="true" data-html-to-value="#video-text-input-ka">{!! ($data['exists']) ? $data['video']['video_text']['ka'] : '<strong>დააჭირეთ</strong> ტექსტი რომ შეცვალოთ' !!}</p>
                        </div>
                        <div class="lower">
                            <div class="left">
                                <button type="button" id="video-button-popup" class="universal-button w-100 px-3">{{ ($data['exists']) ? $data['video']['video_button_link'] : 'დააჭირეთ ლინკი რომ მიაბათ' }}</button>
                                <img src="{{ asset('images/xd-icons/colored/arrow-right-orange.svg') }}">
                            </div>
                            <div class="right">
                                <span>დაგვიმეგობრდი</span>
                                <a href="https://www.facebook.com/metrixgeorgia/"><img src="{{ asset('images/homepage/facebook.svg') }}"></a>
                                <a href="javascript:void(0)"><img src="{{ asset('images/homepage/instagram.svg') }}"></a>
                            </div>
                        </div>
                        <div class="bottom-line"></div>
                    </div>
                </div>
            </div>
        {{-- Video --}}

        {{-- About Services --}}
            <button class="s-collapse active" type="button" data-target="#about-ka">სერვისების შესახებ</button>
            <div class="s-collapse d-fc show" id="about-ka">
                <div class="about-service-wrapper d-fc">
                    <div class="about-service-guy">
                        <img src="{{ asset('images/homepage/about-service-guy.svg') }}">
                    </div>
                    <div class="category-buttons">
                        <a href="#avejis-damzadeba" id="furniture" class="active">
                            <i class="white" id="arrow-right"></i>
                            <i id="couch"></i>
                            <p>ავეჯის დამზადება</p>
                        </a>
                        <a href="#vip-masteri" id="vip-master" class="">
                            <i class="white" id="arrow-right"></i>
                            <i id="wrench"></i>
                            <p>ვიპ-მასტერი</p>
                        </a>
                        <a href="#dizaineri" id="designer" class="">
                            <i class="white reverse" id="arrow-right"></i>
                            <i id="paint-brush"></i>
                            <p>დიზაინერი</p>
                        </a>
                        <a href="#remonti" id="repairs" class="">
                            <i class="white reverse" id="arrow-right"></i>
                            <i id="paint-roller"></i>
                            <p>რემონტი</p>
                        </a>
                    </div>
                    <div class="service-text d-fc justify-content-center">
                        <span class="text-center"><strong>დააჭირეთ გვერდით ღილაკებს და შეცვალეთ ტექსტი ქვემოთ</strong></span>
                        <div class="upper">
                            <span>სერვისის შესახებ</span> <i class="square"></i> <strong>ავეჯის დამზადება</strong>
                        </div>
                        <div class="middle">
                            @foreach ( ['furniture', 'vip-master', 'designer', 'repairs'] as $index => $category )
                                <p class="{{ ($index != 0) ? 'd-none '. $category : $category }}" contenteditable="true" data-html-to-value="#about-text-input-ka-{{ $index }}">{!! ($data['exists']) ? $data['about']['ka']['text_'. $index] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}</p>
                            @endforeach
                        </div>
                        <div class="lower">
                            <a href="#" role="button" class="universal-button orange">დაწვრილებით</a>
                        </div>
                    </div>
                </div>
            </div>
        {{-- About Services --}}

        {{-- Italian --}}
                <button class="s-collapse" type="button" data-target="#it-wrapper" style="color: purple; border-color: purple;">იტალიანო</button>
                <div class="s-collapse d-fc" id="it-wrapper">
                    {{-- Video --}}
                        <button class="s-collapse mt-3" type="button" data-target="#video-it">ვიდეო</button>
                        <div class="s-collapse d-fc" id="video-it">
                            <div class="homepage-video-wrapper">
                                <div class="video d-fc">
                                    <div class="d-flex position-relative">
                                        <iframe width="500" height="210" src="https://www.youtube.com/embed/{{ ($data['exists']) ? $data['video']['video_link'] : 'C3iI6S7TuCA' }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <div class="right-block"></div>
                                    </div>
                                </div>
                                <div class="text d-fc">
                                    <div class="upper">
                                        <p contenteditable="true" data-html-to-value="#video-text-input-it">{!! ($data['exists']) ? $data['video']['video_text']['it'] : '<strong>დააჭირეთ</strong> ტექსტი რომ შეცვალოთ' !!}</p>
                                    </div>
                                    <div class="bottom-line"></div>
                                </div>
                            </div>
                        </div>
                    {{-- Video --}}

                    {{-- About Services --}}
                        <button class="s-collapse" type="button" data-target="#about-it">სერვისების შესახებ</button>
                        <div class="s-collapse d-fc" id="about-it">
                            <div class="about-service-wrapper d-fc">
                                <div class="about-service-guy">
                                    <img src="{{ asset('images/homepage/about-service-guy.svg') }}">
                                </div>
                                <div class="category-buttons">
                                    <a href="#avejis-damzadeba" id="furniture" class="active">
                                        <i class="white" id="arrow-right"></i>
                                        <i id="couch"></i>
                                        <p>ავეჯის დამზადება</p>
                                    </a>
                                    <a href="#vip-masteri" id="vip-master" class="">
                                        <i class="white" id="arrow-right"></i>
                                        <i id="wrench"></i>
                                        <p>ვიპ-მასტერი</p>
                                    </a>
                                    <a href="#dizaineri" id="designer" class="">
                                        <i class="white reverse" id="arrow-right"></i>
                                        <i id="paint-brush"></i>
                                        <p>დიზაინერი</p>
                                    </a>
                                    <a href="#remonti" id="repairs" class="">
                                        <i class="white reverse" id="arrow-right"></i>
                                        <i id="paint-roller"></i>
                                        <p>რემონტი</p>
                                    </a>
                                </div>
                                <div class="service-text d-fc justify-content-center">
                                    <span class="text-center"><strong>დააჭირეთ გვერდით ღილაკებს და შეცვალეთ ტექსტი ქვემოთ</strong></span>
                                    <div class="upper">
                                        <span>სერვისის შესახებ</span> <i class="square"></i> <strong>ავეჯის დამზადება</strong>
                                    </div>
                                    <div class="middle">
                                        @foreach ( ['furniture', 'vip-master', 'designer', 'repairs'] as $index => $category )
                                            <p class="{{ ($index != 0) ? 'd-none '. $category : $category }}" contenteditable="true" data-html-to-value="#about-text-input-it-{{ $index }}">{!! ($data['exists']) ? $data['about']['it']['text_'. $index] : 'დააჭირეთ რომ შეცვალოთ ტექსტი.' !!}</p>
                                        @endforeach
                                    </div>
                                    <div class="lower">
                                        <a href="#" role="button" class="universal-button orange">დაწვრილებით</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- About Services --}}
                </div>
        {{-- Italian --}}

        @foreach ( ['ka', 'it'] as $locale )
            <input type="hidden" id="video-text-input-{{ $locale }}" name="video_text_{{ $locale }}" value="{{ ($data['exists']) ? $data['video']['video_text'][$locale] : '<strong>დააჭირეთ</strong> ტექსტი რომ შეცვალოთ' }}">
            @for ($i = 0; $i < 4; $i++)
                <input type="hidden" name="about_text_{{ $locale }}_{{ $i }}" id="about-text-input-{{ $locale }}-{{ $i }}" value="{{ ($data['exists']) ? $data['about'][$locale]['text_'. $i] : '<strong>დააჭირეთ</strong> ტექსტი რომ შეცვალოთ.' }}">
            @endfor
        @endforeach
        <input type="hidden"  id="video-button-link" name="video_button_link" value="{{ ($data['exists']) ? $data['video']['video_button_link'] : '#' }}">
        
        <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
    </form>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            function generate_random_string(length) {
                let result = '';
                let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let charactersLength = characters.length;
                for (let i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            }
            function slide_markup(i) {
                return `<label class="image-reader-wrapper d-fc w-100 mb-2" for="slide-${i}">
                            <div class="remove-this-item slide">&times;</div>
                            <input class="form-control " type="text" name="text_add[]" placeholder="სათაურის ტექსტი" value=""  >
                            <input class="form-control " type="text" name="text_paragraph[]" placeholder="აბზაცის ტექსტი" value="" >
                            <input class="form-control" type="text" name="add_link[]" id="link-button" placeholder="ბმული" name="link_button" value="">
                            <input class="form-control" type="text" name="add_button[]" placeholder="ბმული ღილაკი" id="add-button" value="">
                            <img class="image-loader" src="{{ asset('images/enter/upload-homepage-slider.jpg') }}">
                            <span class="dire-edit"></span>
                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="homepage_slides[]" id="slide-${i}" required>
                            <input type="text" class="text-center form-control" name="homepage_slide_alts[]" placeholder="სურათის ალტი" required>
                            <input type="hidden" name="amount_of_homepage_slides[]" value="null">
                        </label>`
            }

            function mob_slide_markup(i) {
                return `<label class="image-reader-wrapper d-fc w-375 mb-2 mx-auto" for="mob-slide-${i}">
                            <div class="remove-this-item slide">&times;</div>
                            <img class="image-loader" src="{{ asset('images/enter/upload-375-200.jpg') }}">
                            <span class="dire-edit"></span>
                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="mob_homepage_slides[]" id="mob-slide-${i}" required>
                            <input type="text" class="text-center form-control" name="mob_homepage_slide_alts[]" placeholder="სურათის ალტი" required>
                            <input type="hidden" name="amount_of_mob_homepage_slides[]" value="null">
                        </label>`
            }

            $('#add-slides').click(function() {
                $('#slider-images').append(slide_markup(generate_random_string(16)))
            })
            $('#add-mob-slides').click(function() {
                $('#mob-slider-images').append(mob_slide_markup(generate_random_string(16)))
            })

            $('body').on('click', '.remove-this-item.slide', function() {
                $(this).parents('label').remove()
            })

            $('#video-button-popup').click(function() {
                let link = prompt("გთხოვთ აქ ლინკი ჩაწეროთ")

                if ( link == null || link == '' ) {
                    $(this).text('ლინკი არ იყო ჩაწერილი')
                } else {
                    $(this).text(link)
                    $('#video-button-link').val(link)
                }
            })

            $('.category-buttons a').each(function() {
                $(this).click(function() {
                    $(this).siblings('a').removeClass('active')
                    $(this).addClass('active')

                    if ( $(this).attr('id') == 'furniture' ) {
                        $('.service-text .upper strong').text('ავეჯის დამზადება')
                        $(`.service-text .middle p.${$(this).attr('id')}`).removeClass('d-none')
                        $(`.service-text .middle p.${$(this).attr('id')}`).siblings('p').addClass('d-none')
                    } else if ( $(this).attr('id') == 'vip-master' ) {
                        $('.service-text .upper strong').text('ვიპ-მასტერი')
                        $(`.service-text .middle p.${$(this).attr('id')}`).removeClass('d-none')
                        $(`.service-text .middle p.${$(this).attr('id')}`).siblings('p').addClass('d-none')
                    } else if ( $(this).attr('id') == 'designer' ) {
                        $('.service-text .upper strong').text('დიზაინერი')
                        $(`.service-text .middle p.${$(this).attr('id')}`).removeClass('d-none')
                        $(`.service-text .middle p.${$(this).attr('id')}`).siblings('p').addClass('d-none')
                    } else if ( $(this).attr('id') == 'repairs' ) {
                        $('.service-text .upper strong').text('რემონტი')
                        $(`.service-text .middle p.${$(this).attr('id')}`).removeClass('d-none')
                        $(`.service-text .middle p.${$(this).attr('id')}`).siblings('p').addClass('d-none')
                    }
                })
            })
        })
    </script>
@endsection