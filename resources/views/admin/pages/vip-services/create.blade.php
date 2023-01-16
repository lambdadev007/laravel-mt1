@extends('admin.layout')

@php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
@endphp

@section('content')
    <form class="container-1280 d-fc" action="/enter/vip-services/store" method="post" enctype="multipart/form-data">
        @csrf
        {{-- Meta --}}
            <div class="container-800 d-fc">
                <button class="s-collapse active" type="button" data-target="#meta">მეტა ინფორმაცია</button>
                <div class="s-collapse d-fc show" id="meta">
                    <div class="form-section d-fc">
                        <h5>სეო სათაური</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_title" placeholder="სეო სათაური" value="" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">ვიპ მასტერის გვერდის სათაური</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="outside_title" placeholder="ვიპ მასტერის გვერდის სათაური" value="" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">გვერდის სათაური</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="inner_title" placeholder="გვერდის სათაური" value="" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">აღწერა</h5>
                        <span class="letter-counter">0/</span>
                        <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="" required></textarea>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">ბმული</h5>
                        <span class="letter-counter">0/191</span>
                        <input class="form-control" type="text" placeholder="ბმული" name="slug" value="" maxlength="191" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">ქივორდები</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="" maxlength="60" required>
                    </div>
                </div>
            </div>
        {{-- Meta --}}

        <div class="vip-services-wrapper container-1280 {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'd-fc' : 'd-flex' }} mt-5">
            <div class="{{ ( $agent->isMobile() || $agent->isTablet() ) ? 'col-md-12 px-0' : 'col-md-9' }} mx-auto">
                <div class="header-section {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'd-fc' : 'd-flex' }}">
                    <div class="col-md-3 px-0 position-relative">
                        <label class="image-reader-wrapper" for="image">
                            <img class="image-loader" src="{{ asset('images/admin/upload.jpg') }}" alt="">
                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" id="image" name="image">
                            <input type="hidden" name="existing_image" value="">
                            <div class="background-layer"></div>
                        </label>
                    </div>
                    <div class="col-md-9 {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'px-0' : '' }} d-fc">
                        <div class="header-title-top-wrapper d-flex align-items-center {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'my-3' : 'mb-3' }}">
                            <i id="vip-service-clock" class="orange mr-1"></i>
                            <span class="mr-3">24/7</span>
                            <div class="d-flex stars">
                                <i id="vip-service-star" class="orange full"></i>
                                <i id="vip-service-star" class="orange full"></i>
                                <i id="vip-service-star" class="orange full"></i>
                                <i id="vip-service-star" class="orange full"></i>
                                <i id="vip-service-star" class="orange empty"></i>
                            </div>
                        </div>
                        <h1 class="service-title"></h1>
                        <p class="service-short-description" contenteditable="true" data-html-to-value="#short-description">მოკლე აღწერა</p>
                        <input type="hidden" name="description" id="short-description">
                        <div class="d-flex align-items-center {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'mb-4' : '' }}">
                            @if ( !$agent->isMobile() || $agent->isTablet() )
                                <div class="d-flex mr-4">
                                    <button type="button" data-scroll-to=".description-section" class="view-rest d-flex align-items-center"><span class="mr-3">სრულად</span> <i id="nav-arrow" class="orange" style="transform: rotate(90deg);"></i></button>
                                </div>
                            @endif
                            <div class="d-flex align-items-center">
                                <i id="vip-service-workers" class="orange mr-2"></i>
                                <div class="vip-service-workers-text d-fc">
                                    @if ( $agent->isMobile() || $agent->isTablet() )
                                        <span>ხელმისაწვდომია X სპეციალისტი</span>
                                    @else
                                        <small>ხელმისაწვდომია</small>
                                        <span>X სპეციალისტი</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ( $agent->isMobile() || $agent->isTablet() )
                    <div class="col-md-12 px-0">
                        <div class="vip-service-card">
                            <div class="top d-flex px-0">
                                <a href="tel:+995597701010" role="button"><i id="vip-service-headphones" class="gray"></i></a>
                                <a href="tel:+995597701010" class="d-flex justify-content-start orange">
                                    <i id="vip-service-phone" class="white mr-3"></i>
                                    <div class="d-fc">
                                        <span>დარეკე ახლავე</span>
                                        <small>597 70 10 10</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                @if ( $agent->isMobile() || $agent->isTablet() )
                    <div class="social-section d-flex justify-content-between mt-3">
                        <div class="d-flex">
                            <div class="icon-wrapper"><i id="vip-service-comment" class="orange"></i></div>
                            <div class="d-fc justify-content-center">
                                <span>გამოიძახე ხელოსანი <strong>კომენტარით</strong></span>
                                <small>დაწერეთ კომენტარის სახით, თუ რა გაქვთ გასაკეთებელი და <br> მიიღეთ <strong>10% ფასდაკლება</strong> სპეციალისტის მომსახურებაზე!</small>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="social-section d-flex justify-content-between mt-3">
                        <div class="d-flex">
                            <div class="icon-wrapper"><i id="vip-service-comment" class="orange"></i></div>
                            <div class="d-fc justify-content-center">
                                <span>გამოიძახე ხელოსანი <strong>კომენტარით</strong></span>
                                <small>დაწერეთ კომენტარის სახით, თუ რა გაქვთ გასაკეთებელი და <br> მიიღეთ <strong>10% ფასდაკლება</strong> სპეციალისტის მომსახურებაზე!</small>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="description-section d-fc">
                    <textarea class="text-editor" name="description_lg" id=""></textarea>
                </div>
            </div>
        </div>

        <input type="hidden" name="belongs" value="{{ $data['belongs'] }}">
        <input type="hidden" name="locale" value="{{ $data['locale'] }}">

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

            $('')
        })
    </script>
@endsection