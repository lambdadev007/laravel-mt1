@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="გადახდის პირობები, gadaxdis pirobebi, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="გადახდის პირობები, gadaxdis pirobebi, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>გადახდის პირობები, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">გადახდის პირობები</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">მთავარი გვერდი</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/payment">გადახდის პირობები</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

     <div class="payment-content container-fluid">
        <div class="text-page">
            <h2>გადახდის პირობები</h2> <br>
            <p>metrix ჯგუფი მომხმარებლის ინტერესებზე მიმართული კომპანია, რომლის პრიორიტეტია პროფესიონალურ დონეზე მართოს საკუთარი სერვისი.</p>
        </div>
    </div>

    @include('user.components.offers')



@endsection
