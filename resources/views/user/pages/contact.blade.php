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
    <div class="contact-wrapper d-fc container-1280">
        <div class="top d-fc">
            <div class="sunken-title"><h1>{{ $tranCT->translate('contact') }}</h1></div>
            <div class="sunken-title-line"></div>
        </div>

        <div class="middle">
            <form class="left d-fc" action="/sendsms/contact" method="post">
                @csrf
                <div class="d-flex justify-content-between">
                    <input type="text" placeholder="{{ $tranCT->translate('your_name') }}" name="name" value="{{ old('name') }}" required>
                    <input type="email" placeholder="{{ $tranCT->translate('email') }}" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="select-wrapper">
                    <select name="service_type" required>
                        <option disabled selected>{{ $tranCT->translate('choose_service') }}</option>
                        @if ( $data['exists'] )
                            @foreach ( $data['services'] as $service )
                                <option value="{{ $service }}">{{ $service }}</option>
                            @endforeach
                        @endif
                    </select>
                    <i class="orange" id="nav-arrow"></i>
                </div>
                <textarea name="message" placeholder="{{ $tranCT->translate('message') }}" required>{{ old('message') }}</textarea>
                <div class="bottom">
                    <label class="universal-checkbox-wrapper terms"><input type="checkbox" required> <div class="before"></div> <div class="after"></div></label>
                    <span>{{ $tranCT->translate('i_agree') }} <a href="#" role="button" data-toggle="modal" data-target="#terms-modal">{{ $tranCT->translate('website_rules') }}</a></span>
                    <button type="submit" class="universal-button orange">{{ $tranCT->translate('send') }}</button>
                </div>
            </form>

            @if ( !$agent->isMobile() && !$agent->isTablet() ) {{-- Needs to be reverse --}}
                <div class="center-line"></div>
            @endif

            <div class="right d-fc">
                <div class="top d-fc">
                    <h3>{{ $tranCT->translate('how_to_contact_us') }}</h3>
                    <div class="information">
                        @if ( $data['exists'] )
                            <span><i class="orange" id="pin"></i> {{ $data['raw']['address'] }}</span>
                            <span><i class="orange" id="contact-phone-icon"></i> {{ $data['raw']['mobile_number'] }}</span>
                            <span><i class="orange" id="old-telephone"></i> {{ $data['raw']['house_number'] }}</span>
                            <span><i class="orange" id="contact-envelope"></i> {{ $data['raw']['mail'] }}</span>
                        @endif
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2977.799703273925!2d44.75967821615417!3d41.724840782968876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4044732016f7d331%3A0xaa2f9b46bd7975a!2s29%20Adam%20Mitskevichi%20St%2C%20T&#39;bilisi!5e0!3m2!1sen!2sge!4v1617342972055!5m2!1sen!2sge" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection