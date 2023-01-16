@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'user_profile'                      => 'მომხმარებლის პროფილი',
            'wishlist'                          => 'სურვილების სია',
        ],
        'en' => [
            'user_profile'                      => 'User Profile',
            'wishlist'                          => 'Wishlist',
        ]
    ];
@endphp

@section('meta')
    <title>სურვილების სია, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->T($local, 'wishlist') }}</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/user/profile">{{ $TC->T($local, 'user_profile') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/user/profile">{{ $TC->T($local, 'wishlist') }}</a>
            </div>
            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    <div class="user-wishlist-wrapper container-fluid">
        <div class="our-production-wrapper no-bg py-0">
            <div class="our-production">
                <div class="content">                          
                    <div class="content-segment show">
                        @for ($i = 0; $i < 3; $i++)
                            {{-- Product --}}
                                <div class="our-product">
                                    <div class="product-info">
                                        <button type="button" class="remove-product"><span class="dire-close"></span></button>
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
    </div>

    @include('user.components.offers')
@endsection