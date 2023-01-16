@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    // dd(session()->all());
@endphp

@section('meta')
    <meta name="keywords" content="აქციები, aqciebi, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix">
    <meta name="description" content="აქციები, aqciebi, statiebi, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>აქციები, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

    <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('offers') }}</h3>
        <div class="page-title-line"></div>
    </div>

    <div class="category-selector-wrapper container-fluid mb-3">
        <div class="category-selector">
            <button class="{{ $category == 'all' ? 'active' : '' }}"        data-page="offers" data-category="all">{{ $TC->TG('all') }}</button>
            <button class="{{ $category == 'materials' ? 'active' : '' }}"  data-page="offers" data-category="materials">{{ $TC->TG('materials') }}</button>
            <button class="{{ $category == 'design' ? 'active' : '' }}"     data-page="offers" data-category="design">{{ $TC->TG('design') }}</button>
            <button class="{{ $category == 'repairs' ? 'active' : '' }}"    data-page="offers" data-category="repairs">{{ $TC->TG('repairs') }}</button>
            <button class="{{ $category == 'furniture' ? 'active' : '' }}"  data-page="offers" data-category="furniture">{{ $TC->TG('furniture') }}</button>
            <button class="{{ $category == 'cleaning' ? 'active' : '' }}"   data-page="offers" data-category="cleaning">{{ $TC->TG('cleaning') }}</button>
        </div>
        {{-- Phone Call Modal Button --}}
            <button class="split-button pulse-button p-0" data-toggle="modal" data-target="#phone-call-modal">
                <span class="dire-right-arrow"></span>
                <span class="anchor-text">597 70 10 10</span>
            </button>
        {{-- Phone Call Modal Button --}}
    </div>

    @include('user.components.offers')
@endsection