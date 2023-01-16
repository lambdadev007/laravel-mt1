@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="ავტორიზაცია, avtorizacia, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix">
    <meta name="description" content="ავტორიზაცია, avtorizacia, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ხელოსანი გამოძახებით, მწვანე კარკასი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>ავტორიზაცია, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">ავტორიზაცია</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">

                <a class="link-path-item" href="/">მთავარი გვერდი</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/login">ავტორიზაცია</a>

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
        <form class="form-field" method="post" action="/password-recovery">
            @csrf
            <div class="row">

                <div class="col-sm-12">
                    <p>პაროლის აღსადგენად შეიყვანეთ რეგისტრაციისას მითითებული ელ. ფოსტა. პაროლის აღსადგენი ბმული გამოიგზავნება აღნიშნულ ელ. ფოსტაზე.</p>
                </div>

                <div class="col-sm-12">
                    <label for="number">ტელეფონი<b>*</b></label>
                    <input required placeholder="მიუთითეთ ტელეფონი" type="number" name="number" id="number">
                </div>

                <div class="col-sm-12 d-flex justify-content-center">
                    <button class="split-button" type="submit">
                        <span class="dire-right-arrow"></span>
                        <span class="px-4">პაროლის აღდგენა</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @include('user.components.offers')
@endsection