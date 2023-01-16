@extends('admin.layout')

@php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
@endphp

@section('content')
    <form class="container-1280 d-fc" action="/enter/vip-services/update/{{ $data['id'] }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- Meta --}}
            <div class="container-800 d-fc">
                <button class="s-collapse" type="button" data-target="#meta">მეტა ინფორმაცია</button>
                <div class="s-collapse d-fc" id="meta">
                    <div class="form-section d-fc">
                        <h5>სეო სათაური</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_title" placeholder="სეო სათაური" value="{{ $data['meta_title'] }}" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">ვიპ მასტერის გვერდის სათაური</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="outside_title" placeholder="ვიპ მასტერის გვერდის სათაური" value="{{ $data['outside_title'] }}" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">გვერდის სათაური</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="inner_title" placeholder="გვერდის სათაური" value="{{ $data['inner_title'] }}" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">აღწერა</h5>
                        <span class="letter-counter">0</span>
                        <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="" required>{{ $data['meta_description'] }}</textarea>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">ბმული</h5>
                        <span class="letter-counter">0/191</span>
                        <input class="form-control" type="text" placeholder="ბმული" name="slug" value="{{ $data['og_slug'] }}" maxlength="191" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">ქივორდები</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ $data['meta_keywords'] }}" maxlength="60" required>
                    </div>
                </div>
            </div>
        {{-- Meta --}}

        <div class="vip-services-wrapper container-1280 {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'd-fc' : 'd-flex' }} mt-5">
            <div class="{{ ( $agent->isMobile() || $agent->isTablet() ) ? 'col-md-12 px-0' : 'col-md-9' }} mx-auto">
                <div class="header-section {{ ( $agent->isMobile() || $agent->isTablet() ) ? 'd-fc' : 'd-flex' }}">
                    <div class="col-md-3 px-0 position-relative">
                        <label class="image-reader-wrapper" for="image">
                            <img class="image-loader" src="{{ asset($data['image']) }}" alt="{{ $data['meta_title'] }}">
                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" id="image" name="image">
                            <input type="hidden" name="existing_image" value="{{ $data['image'] }}">
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
                        <h1 class="service-title">{{ $data['inner_title'] }}</h1>
                        <p class="service-short-description" contenteditable="true" data-html-to-value="#short-description">{!! $data['description'] !!}</p>
                        <input type="hidden" name="description" id="short-description" value="{!! $data['description'] !!}">
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
                    <div class="social-section d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="icon-wrapper"><i id="vip-service-comment" class="orange"></i></div>
                            <div class="d-fc justify-content-center">
                                <span>გამოიძახე ხელოსანი <strong>კომენტარით</strong></span>
                                <small>დაწერეთ კომენტარის სახით, თუ რა გაქვთ გასაკეთებელი და <br> მიიღეთ <strong>10% ფასდაკლება</strong> სპეციალისტის მომსახურებაზე!</small>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="social-section d-flex justify-content-between">
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
                    <textarea class="text-editor" name="description_lg" id="">{!! $data['description_lg'] !!}</textarea>
                </div>
            </div>
        </div>

        <input type="hidden" name="belongs" value="{{ $data['belongs'] }}">
        <input type="hidden" name="locale" value="{{ $data['locale'] }}">

        <div class="d-flex align-self-end">
            <button type="submit" class="universal-button mr-3">ატვირთვა</button>
            <button type="submit" class="universal-button bg-danger" form="delete-form" onclick="return confirm('Are you sure you want to delete this?');"><span class="text-light">წაშლა</span></button>
        </div>
    </form>
    <form id="delete-form" action="/enter/vip-services/delete/hard" method="post">
        @csrf
        <input type="hidden" name="id_string" value="{{ $data['id'] }}">
    </form>
@endsection