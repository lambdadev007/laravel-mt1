@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="ნამუშევრები, namushevrebi, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="ნამუშევრები, namushevrebi, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>ნამუშევრები, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('projects') }}</h3>
        <div class="page-title-line"></div>
    </div>

    <div class="category-selector-wrapper container-fluid mb-3">
            <div class="category-selector project-category-selector">
                <a href="/projects/all"             class="{{ $category == 'all' ? 'active' : '' }}" data-page="projects" data-category="all">{{ $TC->TG('all') }}</a>
                <a href="/projects/design"          class="{{ $category == 'design' ? 'active' : '' }}" data-page="projects" data-category="design">{{ $TC->TG('design') }}</a>
                <a href="/projects/repairs"         class="{{ $category == 'repairs' ? 'active' : '' }}" data-page="projects" data-category="repairs">{{ $TC->TG('repairs') }}</a>
                <a href="/projects/furniture"       class="{{ $category == 'furniture' ? 'active' : '' }}" data-page="projects" data-category="furniture">{{ $TC->TG('furniture') }}</a>
            </div>

        {{-- Phone Call Modal Button --}}
            <button class="split-button pulse-button p-0" data-toggle="modal" data-target="#phone-call-modal">
                <span class="dire-right-arrow"></span>
                <span class="anchor-text">597 70 10 10</span>
            </button>
        {{-- Phone Call Modal Button --}}
     </div>

    @include('user.components.projects')

    @include('user.components.offers')
@endsection