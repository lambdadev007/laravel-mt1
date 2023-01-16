@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="ადგილზე მიტანის პირობები, adgilze mitanis pirobebi, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="ადგილზე მიტანის პირობები, adgilze mitanis pirobebi, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>ადგილზე მიტანის პირობები, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">ადგილზე მიტანის პირობები</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">მთავარი გვერდი</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/delivery">ადგილზე მიტანის პირობები</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}
     
    <div class="delivery-range-wrapper container-fluid">
        <div class="rate-wrapper">
            <label class="split-button">
                <span class="active">სტანდარტული</span>
                <input type="radio" name="delivery-rate" value="5" checked>
            </label>
            <label class="split-button">
                <span class="">სწრაფი</span>
                <input type="radio" name="delivery-rate" value="3.3333333">
            </label>
        </div>

        <input class="range-start" type="range" min="0" max="2500" step="50" value="0">

        <div class="range-info">
            <span class="weight">წონა: <b>0</b> კგ</span>
            <div class="range-divider"></div>
            <span class="price">ფასი: <b>0</b> <span class="dire-lari"></span></span>
        </div>
    </div>

    @include('user.components.offers')

@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            let rate = 5
            let rangeValue = 0
            let price = 0

            $('input[name="delivery-rate"]').change(function(){
                $('.rate-wrapper .split-button span').removeClass('active')
                $(this).siblings('span').addClass('active')

                rate = parseFloat($(this).val())
                price = rangeValue / rate
                price = price.toFixed()

                $('.range-info .weight strong').text(rangeValue)
                $('.range-info .price strong').text(price)
            })

            $('.delivery-range-wrapper input[type="range"]').on('input', function(){
                rangeValue = parseInt($(this).val())
                price = rangeValue / rate
                price = price.toFixed()

                if ( rangeValue == 2500 ) {
                    $(this).removeClass('range-start')
                    $(this).addClass('range-end')
                } else {
                    $(this).removeClass('range-end')
                    $(this).addClass('range-start')
                }

                $('.range-info .weight strong').text(rangeValue)
                $('.range-info .price strong').text(price)

            })
        })
    </script>
@endsection