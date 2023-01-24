@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();

    $locale_code = [
        'ka' => 'ka-GE',
        'it' => 'it-IT'
    ];
@endphp

<!doctype html>
<html lang="{{ $locale_code[Session::get('locale')] }}">
    <head>
        {{-- Meta --}}
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            {{-- <meta name="robots" content="noindex, nofollow">  --}}
            <meta name="robots" content="index, all"> 
            <meta name="resource-type" content="document">
            <meta name="google-site-verification" content="1_5-TKWjTQCkSUevdrs802Csje3N9pwTRGkkGjxI1OU">
        {{-- Meta --}}

        @if ( View::hasSection('meta') )
            @yield('meta')
        @else
            <meta property="og:url" content="{{ url()->current() }}"/>
            <meta property="og:type" content="website"/>
            <meta property="og:title" content="მეტრიქსი"/>
            <meta property="og:description" content="მეტრიქსი"/>
            <meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

            <title>მეტრიქსი</title>
            <meta name="keywords" content="მეტრიქსი">
            <meta name="description" content="მეტრიქსი">
        @endif

        <link rel="icon" href="{{ asset('images/logos/logo.ico') }}">

        {{-- CSS --}}
            <link rel="stylesheet" href="{{ asset('masters/bootstrap-master/css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.carousel.min.css') }}" preload>
            <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.theme.default.min.css') }}" preload>
            <link rel="stylesheet" href="{{ asset('masters/fancybox-master/css/jquery.fancybox.min.css') }}" preload>
            <link rel="stylesheet" href="{{ asset('masters/noUiSlider-master/distribute/nouislider.min.css') }}" preload>
            @php
                $load = 'desktop';
                if ( $agent->isMobile() ) $load = 'mobile';
                if ( $agent->isTablet() ) $load = 'tablet';
            @endphp
            <link rel="stylesheet" href="{{ asset('css/load-'. $load .'.css') }}">
        {{-- CSS --}}

        {{-- JS --}}
            <script defer type="text/javascript" src="{{ asset('masters/owl-master/js/owl.carousel.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/fancybox-master/js/jquery.fancybox.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('masters/noUiSlider-master/distribute/nouislider.min.js') }}"></script>
            <script defer type="text/javascript" src="{{ asset('js/core.v026.js') }}"></script>
        {{-- JS --}}
        <style>
   .myprojectfontstyle{
    background: #f2f2f2 !important;
    color: rgb(var(--metrix-yellow-accent)) !important;
    }
    .myprojectfontstyle:hover{
    background: rgb(var(--metrix-yellow-accent)) !important;
    color: #f2f2f2 !important;
    }
    /* font-family: Helvetica Neue LT GEO; */
    .myh3style{
        
        font-size: 16px;
        font-weight: 700;
        line-height: 22px;
    }
     a .myh3style{
    color: black;
    text-decoration: none;
}
.video-icon{
    height: 40px !important;
    position: absolute;
    top: 35%;
    left: 40%;
}
i.square {
    width: 8px;
    height: 8px;
    background: #000;
}
span.border-bott {
    border-bottom: 2px solid #959595;
}
.check-label a {
    color: #fbb040;
}
</style>
    </head>

    <body>
        @yield('sdk')

        @include('user.components.navbar')
        @include('user.components.alerts')

        <div class="toggle-market-dropdown"></div>

        @yield('content')
        
        @include('user.components.login-modal')
        @include('user.components.cart-popup')
        @include('user.components.terms-modal')
        @include('user.components.market-modals')
        @include('user.components.footer')

        
        {{-- <script>
            window.fbAsyncInit = function() {
                FB.init({
                appId      : '2741402162852590',
                cookie     : true,
                xfbml      : true,
                version    : 'v8.0'
                });
                
                FB.AppEvents.logPageView();   
                
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            function checkLoginState() {
                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);
                });
            }

            checkLoginState()

            function getShareCount(){
                url = $(".url").val();
                api_url = 'https://graph.facebook.com/v3.0/?id='+url+'&fields=og_object{engagement}&access_token=2741402162852590|9b99c122df91489e6707290af32ea5c2';
                $.ajax({
                    url:api_url,
                    type:'get',
                    success:function(res){
                    count = res.og_object.engagement.count;
                    text = res.og_object.engagement.social_sentence;
                    $(".result").html('<h3>'+count+' Shares<br>'+text+'</h3>');
                    closeSearch();
                    }
                });
            }
        </script> --}}

        <!-- Facebook Pixel Code -->
            {{-- <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '2612653069042404');
            fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=2612653069042404&ev=PageView&noscript=1"
            /></noscript> --}}
        <!-- End Facebook Pixel Code -->

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-KL1TW8EQEF"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-KL1TW8EQEF');
        </script>

        {{-- <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                xfbml            : true,
                version          : 'v7.0'
                });
            };

            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <div class="fb-customerchat"
        attribution=setup_tool
        page_id="102561327964627"
        theme_color="#fbb040"
        logged_in_greeting="მოგესალმებით! როგორ შეგვიძლია დაგეხმაროთ?"
        logged_out_greeting="მოგესალმებით! როგორ შეგვიძლია დაგეხმაროთ?">
        </div> --}}

        {{-- JS --}}
            <script type="text/javascript" src="{{ asset('masters/jquery-master/js/jquery.js') }}"></script>
            <script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/popper.min.js') }}"></script>
            <script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/bootstrap.min.js') }}"></script>
            @yield('js')
            <script>
           
                jQuery(document).ready(function(){
                    jQuery('[data-fancybox="project-gallery"]').fancybox({
                        baseClass: 'gallery-projects-style',
                        thumbs: {
                            autoStart: true,
                            axis: 'x',
                            zoom:true
                        },
                        animationEffect : "fade",
                    }); 
                    console.log(jQuery('input[type="checkbox"]'));
                    checkbox=jQuery('input[type="checkbox"]');
                    var btn=jQuery('.bottom , .site-terms , .check-label').find('span a');
                    if(checkbox.length>0){
                        if(!checkbox.is(':checked')){
                            btn.removeAttr('data-target');
                            console.log(btn);
                        }
                        jQuery(checkbox).change(function(){
                            if(jQuery(this).is(":checked")){
                                btn.attr('data-target','#terms-modal');
                            }else{
                                btn.removeAttr('data-target');
                            }
                        });
                    }

                    
                });
                console.log("accordion");
                var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                    } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                    } 
                });
                }
                $(".single-project-font-style-note-invoice-btn").click(function(){
                    var acc = document.getElementsByClassName("accordion");
                var i;

                for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                    } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                    } 
                });
                }
                    console.log("on click");
                    setTimeout(function() {
                    var acc = document.getElementsByClassName("accordion");
                    var i;
                    console.log("on click 2");
                    for (i = 0; i < acc.length; i++) {
                    var panel = acc[i].nextElementSibling;
                    panel.style.maxHeight = panel.scrollHeight + "px";
                    acc[i].onclick = function() {
                        this.classList.toggle("active");
                        var panel = this.nextElementSibling;
                        if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                        } else {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                        }
                    }
                    }
                    }, 500);
                    console.log("on click3");
                });
             
        </script>
         <script type="text/javascript">
        $(document).ready(function(){
            $btn_verify=false;
            otp();
            $('.download-btn').attr('disabled','disabled');
            function otp(){
                $('input[name="phone_number2"]').blur(function(){
                    console.log("blur1");
                    var number=$(this).val();
                    
                    $('.download-btn').attr('disabled','disabled');
                    if( number !='' && number.length>=9 && !$(this).attr('readonly') ){
                        $(this).attr('readonly','readonly');
                        $(this).parent('div').find('#verify').remove();
                        $(this).parent('div').append('<button type="button" class="btn btn-warning btn-sm text-white" id="verify">ნომრის ვერიფიკაცია</button>');
                        $('#verify').click(function(){
                            console.log(number);
                            $.ajax({
                                url:"/verify-number",
                                type:"POST",
                                data:{action:"verify",number:number},
                                success:function(data){
                                    
                                    var res = jQuery.parseJSON(data);
                                    console.log(res,"data");
                                    if(res.Success==true){
                                        console.log("success");
                                        
                                        $('#otp').remove();
                                        $('#verify').parent('div').append('<div id="otp"><input class="cal-input-area w-40" type="text" placeholder="შეიყვანეთ სმს კოდი" name="submit_opt"  /><button type="button" class="btn btn-warning btn-sm text-white" id="submit_otp">დადასტურება</button></div>');
                                        $('#verify').remove();

                                        $('#submit_otp').click(function(){
                                            var otp=$('input[name="submit_opt"]').val();
                                            console.log(otp);
                                            $.ajax({
                                                url:"/verify-number",
                                                type:"POST",
                                                data:{action:"submit_otp",otp:otp},
                                                success:function(data){
                                                    console.log(data);
                                                    var res = jQuery.parseJSON(data);
                                                    if(res.status=="success"){
                                                        console.log(res.msg);
                                                        $('input[name="phone_number2"]').addClass('border-success');
                                                        $('#otp').remove();
                                                        // $('.download-btn').removeAttr('disabled','disabled');
                                                        $btn_verify=true;
                                                        if($('input[name="terms"]').is(':checked') && $btn_verify!=false){
                                                            $('.download-btn').removeAttr('disabled');  

                                                        }
                                                    }else{
                                                        alert(res.msg);
                                                        $('input[name="submit_opt"]').val('');
                                                    }
                                                },
                                            });
                                        });
                                    }else{
                                        alert(res.message);
                                        $('input[name="phone_number2"]').removeAttr('readonly');
                                        $('#verify').remove();
                                    }

                                },
                                error:function(data){
                                    // console.log(data.responseJSON.message,"error");
                                    alert(data.responseJSON.message);
                                    $('input[name="phone_number2"]').removeAttr('readonly');
                                    $('#verify').remove();
                                }
                            });
                        });
                    }
                    
                });
            }
            @if ( $agent->isMobile() )
                $('.calculate-box.for-desktop').hide()
            @endif
            $('input[name="is_company"]').change(function(){
                if($(this).is(':checked')){
                    $('#fields').html(
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">კომპანიის დასახელება<span class="red-color">*</span></p>'+
                                    '<input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის სახელი" name="full_name2"  autocomplete="new-password" required />'+
                                '</div>'+
                               
                                '<div class="text-input-div">'+
                                   '<p class="cal-input-text">კომპანიის ელფოსტა</p>'+
                                    '<input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის ელექტრონული ფოსტის მისამართი" name="email2" autocomplete="new-password" required />'+
                                '</div>'+
                                
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">კომპანიის ნომერი<span class="red-color">*</span></p>'+
                                    '<input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის ტელეფონის ნომერი" name="phone_number2" autocomplete="new-password" required />'+
                                '</div>'+
                               
                                '<div class="d-flex justify-content-between mt-4">'+
                                    '<div class="checkbox-div">'+
                                        '<input type="checkbox" name="terms" required class="cal1-input-check" >'+
                                        '<label class="check-label">გავეცანი <span><a href="#" role="button" data-toggle="modal" data-target="#terms-modal"><span>წესებს</span> და <span class="">პირობებს</span></a></span></label>'+
                                    '</div>'+
                                    '<div class="arrow-right">'+
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                    '</div>'+
                                '</div>'+
                                '<div class="cal-submit-div">'+
                                    '<div class="cal-sub-div"><button type="submit" disabled class="calculate-sub-2 download-btn btn"><img src="{{ asset("images/xd-icons/white/cloud-download-1.png") }}" height="25px">ინვოისის ჩამორვირთვა</button></div>'+
                                    '<a href="javascript:void(0)" class="cal-refresh-div"><img src="{{ asset("images/homepage/reload.png") }}" class="refresh_icon"></a>'+
                                '</div>');
                               
                               
                                $('#fields-mob').html(
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">კომპანიის დასახელება<span class="red-color">*</span></p>'+
                                    '<input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის სახელი" name="full_name2" autocomplete="new-password" required />'+
                                '</div>'+
                                
                               '<div class="text-input-div">'+
                                   '<p class="cal-input-text">კომპანიის ელფოსტა</p>'+
                                    '<input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის ელექტრონული ფოსტის მისამართი" name="email2" autocomplete="new-password" required />'+
                                '</div>'+
                              
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">კომპანიის ნომერი<span class="red-color">*</span></p>'+
                                    '<input class="cal-input-area" type="text" placeholder="შეიყვანეთ კომპანიის ტელეფონის ნომერი" name="phone_number2" autocomplete="new-password" required />'+
                                '</div>'+
                                
                               
                                '<div class="d-flex justify-content-between mt-4">'+
                                    '<div class="checkbox-div">'+
                                        '<input type="checkbox" name="terms" required class="cal1-input-check" >'+
                                        '<label class="check-label">გავეცანი <span><a href="#" role="button" data-toggle="modal" data-target="#terms-modal"><span>წესებს</span> და <span class="">პირობებს</span></a></span></label>'+
                                    '</div>'+
                                    '<div class="arrow-right">'+
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                    '</div>'+
                                '</div>'+
                                '<div class="cal-submit-div">'+
                                    '<div class="cal-sub-div"><button type="submit" disabled class="accord-calculate-sub-2 download-btn btn"><img src="{{ asset("images/xd-icons/white/cloud-download-1.png") }}" height="25px">ინვოისის ჩამორვირთვა</button></div>'+
                                    '<a href="javascript:void(0)" class="cal-refresh-div"><img src="{{ asset("images/homepage/reload.png") }}" class="refresh_icon"></a>'+
                                '</div>');
                    // $('#standard').hide();
                    // $('#company').show();
                }else{
                    $('#fields').html(
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">სახელი და გვარი<span class="red-color">*</span></p>'+
                                    '<input class="cal-input-area" type="text" placeholder="ჩაწერეთ სახელი და გვარი" name="full_name2" autocomplete="new-password" required />'+
                                '</div>'+  
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">ელ.ფოსტა</p>'+
                                    '<input class="cal-input-area" type="text" placeholder="ჩაწერეთ ელ.ფოსტა" name="email"  autocomplete="new-password" required />'+
                                '</div>'+
                                 '<div class="text-input-div">'+
                                    '<p class="cal-input-text">ტელეფონის ნომერი<span class="red-color">*</span></p>'+
                                    '<input class="cal-input-area" type="text" placeholder="მიუთითეთ ტელეფონის ნომერი" name="phone_number2" autocomplete="new-password" required />'+
                                '</div>'+
                                '<div class="d-flex justify-content-between mt-4">'+
                                    '<div class="checkbox-div">'+
                                        '<input type="checkbox" name="terms" required class="cal1-input-check" >'+
                                        '<label class="check-label">გავეცანი <span><a href="#" role="button" data-toggle="modal" data-target="#terms-modal"><span>წესებს</span> და <span class="">პირობებს</span></a></span></label>'+
                                    '</div>'+
                                    '<div class="arrow-right">'+
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                    '</div>'+
                                '</div>'+
                                '<div class="cal-submit-div">'+
                                    '<div class="cal-sub-div"><button type="submit" disabled class="calculate-sub-2 download-btn btn"><img src="{{ asset("images/xd-icons/white/cloud-download-1.png") }}" height="25px">ინვოისის ჩამორვირთვა</button></div>'+
                                    '<a href="javascript:void(0)" class="cal-refresh-div"><img src="{{ asset("images/homepage/reload.png") }}" class="refresh_icon"></a>'+
                                '</div>')


                                $('#fields-mob').html(
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">სახელი და გვარი<span class="red-color">*</span></p>'+
                                    '<input class="cal-input-area" type="text" placeholder="ჩაწერეთ სახელი და გვარი" name="full_name2" autocomplete="new-password" required />'+
                                '</div>'+
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">ტელეფონის ნომერი<span class="red-color">*</span></p>'+
                                    '<input class="cal-input-area" type="text" placeholder="მიუთითეთ ტელეფონის ნომერი" name="phone_number2" autocomplete="new-password" required />'+
                                '</div>'+
                                
                                '<div class="text-input-div">'+
                                    '<p class="cal-input-text">ელ.ფოსტა</p>'+
                                    '<input class="cal-input-area" type="text" placeholder="ჩაწერეთ ელ.ფოსტა" name="email"  autocomplete="new-password" required />'+
                                '</div>'+
                                '<div class="d-flex justify-content-between mt-4">'+
                                    '<div class="checkbox-div">'+
                                        '<input type="checkbox" name="terms" required class="cal1-input-check" >'+
                                        '<label class="check-label">გავეცანი <span><a href="#" role="button" data-toggle="modal" data-target="#terms-modal"><span>წესებს</span> და <span class="">პირობებს</span></a></span></label>'+
                                    '</div>'+
                                    '<div class="arrow-right">'+
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                        '<img src="{{ asset("images/homepage/right-chevron-1.png") }}" height="25px" class="right-chevron-style">' +
                                    '</div>'+
                                '</div>'+
                                '<div class="cal-submit-div">'+
                                    '<div class="cal-sub-div"><button type="submit" disabled class="accord-calculate-sub-2 download-btn btn"><img src="{{ asset("images/xd-icons/white/cloud-download-1.png") }}" height="25px">ინვოისის ჩამორვირთვა</button></div>'+
                                    '<a href="javascript:void(0)" class="cal-refresh-div"><img src="{{ asset("images/homepage/reload.png") }}" class="refresh_icon"></a>'+
                                '</div>');
                    // $('#standard').show();
                    // $('#company').hide();
                }
                otp();
                $('input[name="terms"]').change(function(){
                    console.log("clicked");
                    if($(this).is(':checked') && $btn_verify!=false){
                        $('.download-btn').removeAttr('disabled');  

                    }else{
                        $('.download-btn').attr('disabled','disabled');
                    }
                });

                $('form#form_1,form#form_2').submit(function(e) {
                    e.preventDefault(); // don't submit multiple times
                    this.submit(); // use the native submit method of the form element
                    $('button[type=submit]').prop('disabled', true);
                    $(".download-btn").InnerHTML = "იტვირთება";
                    setTimeout(function () {
                        $('button[type=submit]').removeAttr('disabled'); 
                        $('.download-btn').html(`<img src="{{ asset("images/xd-icons/white/cloud-download-1.png") }}" height='25px'>ინვოისის ჩამორვირთვა`);
                        back();
                    }, 3900);
                });
                // $("form#form_1").submit(function () {
                
                
                // });


                $(".cal-refresh-div").click(function(){
                back();
                    
                });
            });
            // $('.download-btn').attr('disabled','disabled');
            // $('.download-btn').AddClass('disabled');
            $('.services-btn').click(function(){
                $('.services-btn').removeClass('active');
                $(this).addClass('active');
                var name=$(this).data('name');
                $('.ser').hide();
                $('#service-'+name).show();
            });
            $('input[name="terms"]').change(function(){
                console.log("clicked");
                if($(this).is(':checked') && $btn_verify!=false){
                    $('.download-btn').removeAttr('disabled');  

                }else{
                    $('.download-btn').attr('disabled','disabled');
                }
            });
            $(".cal-step-2").hide();
            $(".calculate-sub").click(function(){
                console.log("click d");
                var meters=jQuery('input[name="calculate_form2"]').val();
                if(meters==''){
                    jQuery('input[name="calculate_form2"]').addClass('border-danger');
                    return false;
                }else{
                    jQuery('input[name="calculate_form2"]').removeClass('border-danger');
                }
                        var type=false;
                        if(jQuery('input[name="is_company"]').is(':checked')){
                            type=true;
                        }
                        console.log(type);
                        jQuery.ajax({
                            url:'/sliderform',
                            type:'POST',
                            data:{action:'first_form',calculate_form:meters,is_company:type},
                            success:function(data){
                                // console.log(data);
                                var res=jQuery.parseJSON(data);
                                if(res.status=="success"){
                                    jQuery('.first-price').text('₾ '+res.price);
                                    $(".cal-form-1").fadeToggle(0);

                                    $(".cal-step-2").fadeToggle(1500);
                                }
                                
                            },
                        });
              
            });
            $(".cal-refresh-div").click(function(){
               back();
                
            });
            $('form#form_1,form#form_2').submit(function(e) {
                e.preventDefault(); // don't submit multiple times
                this.submit(); // use the native submit method of the form element
                $('button[type=submit]').prop('disabled', true);
                $(".download-btn").html("იტვირთება");
                setTimeout(function () {
                    $('button[type=submit]').removeAttr('disabled'); 
                    $('.download-btn').html(`<img src="{{ asset("images/xd-icons/white/cloud-download-1.png") }}" height='25px'>ინვოისის ჩამოტვირთვა`);
                    back();
                }, 3900);
            });
            function back(){
                console.log($('input'),"ASd");
                jQuery(".cal-form-1").fadeToggle(1000);
                jQuery(".cal-step-2").fadeToggle(0);
                $(".accord-cal-mid").show();
                $(".accord-cal-step2").hide();
                jQuery("#form_1 input").val('');
                jQuery("#form_2 input").val('');

                jQuery('input[name="phone_number2"]').removeClass('border-success');
                $('#verify').remove();
                $('input[name="phone_number2"]').removeAttr('readonly');
                // const form1 = document.getElementById('form_1');
                // const form2 = document.getElementById('form_2');
                // form1.reset();
                // form2.reset();
               
                console.log("test");
            }
            $(".accord-cal-step2").hide();
            $(".accordion-calculate-sub").click(function(){
                console.log("click M",jQuery('input[name="is_company"]'));
                var meters=jQuery('input[name="calculate_form2"]')[1].value;
                console.log(meters,"mm");
                if(meters==''){
                    jQuery('input[name="calculate_form2"]').addClass('border-danger');
                    return false;
                }else{
                    jQuery('input[name="calculate_form2"]').removeClass('border-danger');
                }
                        var type=false;
                        if(jQuery('input[name="is_company"]').is(':checked')){
                            type=true;
                        }
                        jQuery.ajax({
                            url:'/sliderform',
                            type:'POST',
                            data:{action:'first_form',calculate_form:meters,is_company:type},
                            success:function(data){
                                // console.log(data);
                                var res=jQuery.parseJSON(data);
                                if(res.status=="success"){
                                    jQuery('.first-price').text('₾ '+res.price);
                                    $(".accord-cal-mid").hide();
                                    $(".accord-cal-step2").show();
                                    $('.accordion.calculate-box-top').click();
                                    $('.accordion.calculate-box-top').click();
                                    $(".container-1200.form_1.mb-5").hide();
                                    $(".container-1200.form_2.mb-5").show();
                                    
                                }
                                
                            },
                        });
               
            });

            $('.similar-slider-mob').owlCarousel({
                // loop:true,
                margin:10,
                ltr:true,
                // nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                }
            });

            $('.projects-slider-component').owlCarousel({
                // loop:true,
                margin:10,
                ltr:true,
                // nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:4
                    },
                }
            });

            $('.services-slider-projects').owlCarousel({
                // loop:true,
                margin:10,
                ltr:true,
                // nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:4
                    },
                }
            });
            
            // $('#p-s-c-b').owlCarousel({
            //     loop:true,
            //     margin:10,
            //     // nav:true,
            //     responsive:{
            //         0:{
            //             items:1
            //         },
            //         540:{
            //             items:1
            //         }
            //         768:{
            //             items:4
            //         }
            //         1200:{
            //             items:4
            //         }
            //         1600:{
            //             items:4
            //         }
            //     }
            // });
            if (window.location.href.indexOf("?filter") > -1) {
                if(window.location.href.indexOf("#") < 0) 
                    setTimeout(()=>{ window.location.href += "#project-slider-filter"; }, 500);
            }           
        })
    </script>
        {{-- JS --}}
    
    </body>
</html>