@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'finishing_registration'               => 'რეგისტრაციის დამთავრება',
            'sms_sent'                             => 'თქვენს ნომერზე გაიგზავნა სმს-ი დადასტურების კოდით',
            'incorrect_code'                       => 'კოდი არასწორია',
            'input_code'                           => 'გთხოვთ შეიყვანოთ კოდი',
            'specify_code'                         => 'მიუთითეთ კოდი',
            'finish_registration'                  => 'დამთავრება',
            'send_again'                           => 'კოდის თავიდან გაგზავნა',
        ],
        'en' => [
            'finishing_registration'               => 'Finishing Registration',
            'sms_sent'                             => 'A verification code has been sent to your number via sms',
            'incorrect_code'                       => 'Incorrect code',
            'input_code'                           => 'Please input code',
            'specify_code'                         => 'Specify Code',
            'finish_registration'                  => 'Finish registration',
            'send_again'                           => 'Send again',
        ]
    ];
@endphp

@section('meta')
    <meta name="keywords" content="რეგისტრაციის დამთავრება, registraciis damtavreba, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix">
    <meta name="description" content="რეგისტრაციის დამთავრება, registraciis damtavreba, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ხელოსანი გამოძახებით, მწვანე კარკასი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>რეგისტრაციის დამთავრება, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->T($local, 'finishing_registration') }}</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/register">{{ $TC->TG('register') }}</a>
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
        <form class="form-field" method="post" action="/register/confirm">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="text-center">{{ $TC->T($local, 'sms_sent') }}</h5>
                </div>

                <div class="col-sm-12 d-flex my-3">
                    <span class="mx-auto"><b>{{ Session::get('temp_reg.confirmation') }}</b></span>
                </div>

                @if ( Session::has('incorrect_code') )
                    <div class="col-sm-12 d-flex my-3">
                        <div class="alert alert-warning w-100 text-center">{{ $TC->T($local, 'incorrect_code') }}</div>
                    </div>
                @endif

                <div class="col-sm-12 d-flex flex-column">
                    <label class="mx-auto" for="confirmation">{{ $TC->TG('input_code') }}</label>
                    <input class="text-center" required placeholder="{{ $TC->T($local, 'specify_code') }}" type="number" name="confirmation" id="confirmation">
                </div>
                
                <div class="col-sm-12 d-flex justify-content-center">
                    <button class="split-button" type="submit">
                        <span class="dire-right-arrow"></span>
                        <span>{{ $TC->T($local, 'finish_registration') }}</span>
                    </button>
                </div>
            </div>
        </form>

        <form class="form-field" method="post" action="/register">
            @csrf
            <div class="col-sm-12 d-flex justify-content-center">
                <button class="split-button" type="submit">
                    <span class="dire-right-arrow"></span>
                    <span>{{ $TC->T($local, 'send_again') }}</span>
                </button>
            </div>
        </form>
    </div>

    @include('user.components.offers')
@endsection