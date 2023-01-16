@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'authorisation'                 => 'ავტორიზაცია',
        ],
        'en' => [
            'authorisation'                 => 'Authorisation',
        ]
    ];
@endphp

@section('meta')
    <meta name="keywords" content="ავტორიზაცია, avtorizacia, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix">
    <meta name="description" content="ავტორიზაცია, avtorizacia, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ხელოსანი გამოძახებით, მწვანე კარკასი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>ავტორიზაცია, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->T($local, 'authorisation') }}</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">

                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/login">{{ $TC->T($local, 'authorisation') }}</a>

            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    <div class="user-form-wrapper container-fluid">
        <form class="form-field" method="post" action="/login">
            @csrf
            <div class="login row">

                <div class="col-sm-12">
                    <label for="number">{{ $TC->TG('number') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" type="number" name="number" id="number">
                </div>

                <div class="col-sm-12">
                    <label for="password">{{ $TC->TG('password') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('password') }}" type="password" name="password" id="password">
                </div>

                <div class="col-sm-12 col-md-6 mt-2 d-flex">
                    <label for="remember-token">
                        <input type="checkbox" name="remember_token" value="true" id="remember-token">
                        <span class="register-info-span">{{ $TC->TG('remember_me') }}</span>
                    </label>
                </div>

                <div class="col-sm-12 col-md-6 mt-2 d-flex justify-content-end">
                    <a href="/password-recovery">{{ $TC->TG('forgot_password') }}</a>
                </div>

                <div class="col-sm-12 d-flex justify-content-center">
                    <button class="split-button" type="submit">
                        <span class="dire-right-arrow"></span>
                        <span class="px-4">{{ $TC->TG('login') }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @include('user.components.offers')
@endsection