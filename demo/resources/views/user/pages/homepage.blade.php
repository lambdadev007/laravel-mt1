@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix">
    <meta name="description" content="რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ხელოსანი გამოძახებით, მწვანე კარკასი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>{{ $TC->TG('html_title') }}</title>
@endsection

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.theme.default.min.css') }}">
@endsection

@section('content')
    @include('user.components.slider')

    <div class="container-fluid px-0">
        {{-- Our Production --}}
            <div class="our-production-wrapper container-fluid">
                <h2 class="section-title">{{ $TC->TG('our_production') }}</h2>
                
                <div class="our-production">
                    <ul class="categories">
                        <li class="active" id="new-products">{{ $TC->TG('newly_added') }}</li>
                        <li id="discount-products">{{ $TC->TG('products_with_a_discount' ) }}</li>
                        <li id="popular-products">{{ $TC->TG('popular_products') }}</li>
                        <li id="last-seen-products">{{ $TC->TG('last_viewed') }}</li>
                        <li id="all-products">{{ $TC->TG('all_products') }}</li>
                    </ul>

                    <div class="content">
                        {{-- Content --}}
                            @foreach (['new-products', 'discount-products', 'popular-products', 'last-seen-products', 'all-products'] as $segment)                                
                                <div class="content-segment {{ $segment == 'new-products' ? 'show' : ''}}" aria-labelledby="{{ $segment }}" aria-hidden="{{ $segment == 'new-products' ? 'false' : 'true'}}">
                                    @for ($i = 0; $i < 5; $i++)
                                        {{-- Product --}}
                                            <div class="our-product">
                                                <div class="product-info">
                                                    <h5 class="product-name">CAPAROL</h5>
                                                    <div class="product-image">
                                                        <a href="/">
                                                            <img class="lazy" src="{{ asset('images/products/product_1.jpg') }}" alt="Product Image">
                                                        </a>
                                                    </div>
                                                    <div class="product-title">
                                                        <a href="/">წებო-ემულსია საფასადე. 20 ლ</a>
                                                    </div>
                                                    <div class="product-price">
                                                        <b>28.00</b> <span class="dire-lari"></span>/{{ $TC->TG('unit') }}
                                                    </div>
                                                    <form action="/cart" method="post">
                                                        <div class="product-quantity">
                                                            <button type="button" class="decrease">-</button>
                                                            <input type="text" name="item_quantity" value="1">
                                                            <button type="button" class="increase">+</button>
                                                        </div>
                                                        <div class="product-navigation">
                                                            <button type="submit" class="metrix-button metrix-button-light" title="კალათაში დამატება">
                                                                <span class="dire-add-to-cart"></span>
                                                            </button>
                                                            <button type="button" class="metrix-button metrix-button-dark" data-toggle="modal" data-target="#product-id-1" title="სწრაფი ნახვა">
                                                                <span class="dire-view"></span>
                                                            </button>
                                                            <a href="/" class="metrix-button metrix-button-dark" title="სასურველებში დამატება">
                                                                <span class="dire-wishlist"></span>
                                                            </a>
                                                            <a href="/" class="metrix-button metrix-button-dark" title="შედარება">
                                                                <span class="dire-compare"></span>
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        {{-- Product --}}
                                    @endfor
                                </div>
                            @endforeach
                        {{-- Content --}}

                        {{-- Modals --}}
                            <div class="modal fade" id="product-id-1" tabindex="-1" role="dialog" aria-labelledby="product-id-1-label" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="phoneCallModalLabel">წებო-ემულსია საფასადე. 20 ლ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">

                                                <div class="col-sm-12 col-md-6">
                                                    <div class="product-image">
                                                        <img class="lazy" src="{{ asset('images/products/product_1.jpg') }}" alt="Product Image">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6">
                                                    <div class="product-details-wrapper">
                                                        <span class="product-name mt-1">წებო-ემულსია საფასადე. 20 ლ</span>

                                                        <div class="product-details">
                                                            <span class="product-detail">
                                                                <span>{{ $TC->TG('manufacturer') }}:</span>
                                                                <span><b>CAPAROL</b></span>
                                                            </span>
                                                            <span class="product-detail">
                                                                <span>{{ $TC->TG('place_of_production') }}:</span>
                                                                <span><b>თურქეთი</b></span>
                                                            </span>
                                                            <span class="product-detail">
                                                                <span>{{ $TC->TG('volume') }}:</span>
                                                                <span><b>20 ლ</b></span>
                                                            </span>
                                                            <span class="product-detail">
                                                                <span>{{ $TC->TG('product_code') }}:</span>
                                                                <span><b>15261</b></span>
                                                            </span>
                                                        </div>

                                                        <div class="product-price">
                                                            <span>{{ $TC->TG('price') }}:</span>
                                                            <span class="d-flex flex-column">
                                                                <b>28.00</b>
                                                                <small class="d-flex">
                                                                    <span class="dire-lari"></span> <span>/{{ $TC->TG('unit') }}</span>
                                                                </small>
                                                            </span>
                                                        </div>

                                                        <div class="product-navigation">
                                                            <form class="h-100 mr-3" action="/cart" method="post">
                                                                <div class="product-quantity">
                                                                    <button type="button" class="decrease">-</button>
                                                                    <input type="text" name="item_quantity" value="1">
                                                                    <button type="button" class="increase">+</button>
                                                                </div>
                                                            </form>
                                                            <a href="/" class="metrix-button metrix-button-light"><span class="dire-add-to-cart"></span></a>
                                                            <a href="/" class="metrix-button metrix-button-dark ml-auto"><span class="dire-wishlist"></span></a>
                                                            <a href="/" class="metrix-button metrix-button-dark ml-2"><span class="dire-compare"></span></a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="product-description">
                                                        <span>{{ $TC->TG('product_description') }}:</span>
                                                        <p>გამოიყენება მშენებლობასა და სახლში ხის ნაკეთობების, პარკეტის, შპალერის და ა.შ. მიწებებისთვის. მისაწებებელი ზედაპირი უნდა იყო სუფთა, მშრალი, თავისუფალი მტვერის და ზეთოვანი ლაქებისაგან. შეინახოს დახურულ მდგომარეობაში არანაკლებ +5°C ტემპერატურის პირობებში.</p>
                                                        <a href="/">{{ $TC->TG('see_all') }}</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="delivery-conditions">
                                                        <span>{{ $TC->TG('terms_of_delivery_header') }}:</span>
                                                        <ul>
                                                            <li>{{ $TC->TG('terms_of_delivery_1') }}.</li>
                                                            <li>{{ $TC->TG('terms_of_delivery_2') }}.</li>
                                                            <li>{{ $TC->TG('terms_of_delivery_3') }}.</li>
                                                        </ul>
                                                        <p>{{ $TC->TG('terms_of_delivery_footer') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- Modals --}}
                    </div>
                </div>
            </div>
        {{-- Our Production --}}

        @include('user.components.offers')
        @include('user.components.articles')
        @include('user.components.partners')
    </div>
@endsection

@section('defer_js')
    <script defer type="text/javascript" src="{{ asset('js/slider.js') }}"></script>
    <script defer type="text/javascript" src="{{ asset('masters/owl-master/js/owl.carousel.min.js') }}"></script>
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#index-slider").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 7000,
                autoplayHoverPause: true,
                smartSpeed: 1000,
                dots: true
            })

            $("#partners").owlCarousel({
                items: 3,
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                smartSpeed: 500,
                margin: 40,
                responsive: {
                    1200 : {
                        items: 7
                    },
                    768 : {
                        items: 5
                    }
                }
            })
        })
    </script>
@endsection
