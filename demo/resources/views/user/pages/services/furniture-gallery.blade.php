@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="ავეჯის ნამუშევრები, avejis namushevrebi, მეტრიქსი, metrix">
    <meta name="description" content="ავეჯის ნამუშევრები, avejis namushevrebi, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>ავეჯის ნამუშევრები - {{ $TC->TG('html_title') }}</title>
@endsection

@section('css_extension')
    <link rel="stylesheet" href="{{ asset('masters/fancybox-master/css/jquery.fancybox.min.css') }}">
@endsection

@section('content')
    <div class="furniture-gallery-wrapper container-fluid">
        <div class="furniture-wrapper">
            <div class="furniture-links-wrapper">
                <a href="/furniture/gallery/kitchen"            {{ $data['category'] == 'kitchen'           ? 'class="active"' : '' }}>{{ $TC->TG('kitchen') }}</a>
                <a href="/furniture/gallery/reception"          {{ $data['category'] == 'reception'         ? 'class="active"' : '' }}>{{ $TC->TG('reception') }}</a>
                <a href="/furniture/gallery/childrens_room"     {{ $data['category'] == 'childrens_room'    ? 'class="active"' : '' }}>{{ $TC->TG('childrens_room') }}</a>
                <a href="/furniture/gallery/sleeping_room"      {{ $data['category'] == 'sleeping_room'     ? 'class="active"' : '' }}>{{ $TC->TG('sleeping_room') }}</a>
                <a href="/furniture/gallery/office_furniture"   {{ $data['category'] == 'office_furniture'  ? 'class="active"' : '' }}>{{ $TC->TG('office_furniture') }}</a>
                <a href="/furniture/gallery/soft_furniture"     {{ $data['category'] == 'soft_furniture'    ? 'class="active"' : '' }}>{{ $TC->TG('soft_furniture') }}</a>
            </div>
        </div>

        <div class="furniture-gallery">
            @foreach ($data['gallery'] as $gallery)
                <div class="furniture-gallery-item">
                    <a data-fancybox="furniture_gallery" href="{{ asset($gallery['image']) }}">
                        <img class="lazy" src="{{ asset($gallery['image']) }}" alt="{{ $TC->TG('furniture') .' '. $TC->TG('projects') }}">
                        <div><span class="dire-search"></span></div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('defer_js')
    <script defer type="text/javascript" src="{{ asset('masters/fancybox-master/js/jquery.fancybox.min.js') }}"></script>
@endsection

@section('bottom_js')
@endsection