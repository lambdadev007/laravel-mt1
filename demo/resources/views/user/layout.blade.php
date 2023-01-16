@php
    use Jenssegers\Agent\Agent;

    $agent = new Agent;
@endphp

<!doctype html>
<html lang="{{ Session::get('locale') }}">
    <head>
        {{-- Meta --}}
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            @yield('meta')

            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="robots" content="noindex, nofollow"> 
            <meta name="resource-type" content="document">
            <meta name="google-site-verification" content="1_5-TKWjTQCkSUevdrs802Csje3N9pwTRGkkGjxI1OU">

            @if ( View::hasSection('og_meta') )
                @yield('og_meta')
            @else
                <meta property="og:title" content="მეტრიქსი, სამშენებლო სარემონტო კომპანია, გაზომე ხარისხი, metrix"/>
                <meta property="og:description" content="რემონტი, remonti, მეტრიქსი სარემონტო კომპანია, ბინის რემონტი, ევრო რემონტი, ხელოსანი გამოძახებით, მწვანე კარკასი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები,remonti, saremonto kompania, dizaineri, dasuftaveba, aveji, samsheneblo masalebi">    	
                <meta property="og:url" content="{{ url()->current() }}"/>
                <meta property="og:type" content="website">
                <meta property="og:image" content="{{ asset('images/logos/logo.ico') }}">
                <meta property="og:site_name" content="metrix.ge">
            @endif
        {{-- Meta --}}

        <link rel="icon" href="{{ asset('images/logos/logo.ico') }}">

        {{-- CSS --}}
            <link rel="stylesheet" href="{{ asset('masters/bootstrap-master/css/bootstrap.min.css') }}">
            @yield('css_extension')
            <link rel="stylesheet" href="{{ asset('css/main.loader.css?110') }}">
            @yield('root_colors')
            @if ( Session::get('locale') == 'en' )
                <style type="text/css">
                    :root {
                        --Regular: 'Nunito';
                        --Bold: 'Nunito Bold';
                        --BoldSpecial: 'Nunito Black';
                    }
                </style>
            @endif
        {{-- CSS --}}

        {{-- JS --}}
            <script type="text/javascript" defer src="{{ asset('masters/lazy-master/jquery.lazy.min.js') }}"></script>
            <script type="text/javascript" defer src="{{ asset('js/core.js?110') }}"></script>
        {{-- JS --}}
        @yield('defer_js')
    </head>

    <body>
        {{-- Facebook SDK --}}
            @yield('fb_sdk')
        {{-- Facebook SDK --}}

        @include('user.components.navbar')

        @include('user.components.alerts')

        @yield('content')

        @include('user.components.call')

        @include('user.components.cookies')

        @include('user.components.footer')

        {{-- JS --}}
            <script type="text/javascript" src="{{ asset('masters/jquery-master/js/jquery.js') }}"></script>
            <script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/popper.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/bootstrap.min.js') }}"></script>
            <script defer type="text/javascript">
                $(document).ready(function(){
                    // $(document).keydown(function(e) {
                    //     if (e.keyCode == 123) {
                    //         e.preventDefault()
                    //     } else if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {      
                    //         e.preventDefault()
                    //     } else if (e.ctrlKey && e.keyCode == 85) {
                    //         e.preventDefault()
                    //     }
                    // })

                    // $(document).on("contextmenu", function(e) {        
                    //     e.preventDefault()
                    // })

                    setTimeout(function () { $('.hide-alert').addClass('hide') }, 2500)
                    setTimeout(function () { $('.hide-alert').remove() }, 3000)

                    $(function() {
                        $('.lazy').Lazy({
                            scrollDirection: 'vertical',
                            effect: 'fadeIn',
                            visibleOnly: true,
                        })
                    })

                })
            </script>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-157511716-1"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-157511716-1');
            </script>
            @yield('bottom_js')
            {{-- <script>
                grecaptcha.ready(function() {
                    grecaptcha.execute('6LdnHLoUAAAAAMLuI__hsdKvHf6s0XznfJcAM_4r', {action: 'homepage'}).then(function(token) {
                        console.log(token)
                    })
                })
            </script> --}}
        {{-- JS --}}
    </body>
</html>