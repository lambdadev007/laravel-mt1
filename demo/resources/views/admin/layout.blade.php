@php
    use App\Http\Controllers\HelpersCT;

    $locale_to_datepicker = [
        'ka' => 'ka-GE',
        'en' => 'en-US',
    ];
@endphp

<!doctype html>
<html lang="{{ Session::get('locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>მეტრიქს ადმინ პანელი</title>
        <link rel="icon" href="{{ asset('images/logos/logo.ico') }}">

        <link rel="stylesheet" href="{{ asset('masters/bootstrap-master/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('masters/waves-master/css/waves.min.css') }}">
        <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('masters/owl-master/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('masters/datepicker-master/css/bootstrap-datepicker3.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/main.loader.css?110') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.loader.css?110') }}">

        <style>
            :root {
                --metrix-main-accent: 66,165,245;
                --metrix-secondary-accent: 38,53,68;
            }
        </style>

        <script defer type="text/javascript" src="{{ asset('masters/waves-master/js/waves.min.js') }}"></script>
        <script defer type="text/javascript" src="{{ asset('masters/owl-master/js/owl.carousel.min.js') }}"></script>
        <script defer type="text/javascript" src="{{ asset('masters/ckeditor-master/ckeditor.js') }}"></script>
        <script defer type="text/javascript" src="{{ asset('masters/ckeditor-master/adapters/jquery.js') }}"></script>
        <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
        <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/locales/bootstrap-datepicker.ka.min.js') }}"></script>
        <script defer type="text/javascript" src="{{ asset('masters/datepicker-master/locales/bootstrap-datepicker.ru.min.js') }}"></script>
        <script defer type="text/javascript" src="{{ asset('js/core.js?110') }}"></script>
        <script defer type="text/javascript" src="{{ asset('js/admin.js?110') }}"></script>
    </head>
    
    <body class="{{ (Session::has('admin.info.logged')) ? 'panel-body' : 'form-body' }}">
        @if ( Session::has('admin.info.logged' ))
            @include('admin.components.navbar')

            @include('admin.components.sidebar')

            {{-- Content --}}
                <div class="admin-content-darkener"></div>
                <div class="admin-content-wrapper">
                    @include('admin.components.alerts')

                    @if( View::hasSection('content') )
                        @yield('content')
                    @else
                        <div class="container-fluid d-flex justify-content-center">
                            <img class="mt-5 w-100" src="{{ asset('images/logos/Logo-Eng.svg') }}">
                        </div>
                    @endif
                </div>
            {{-- Content --}}
        @else
            <div class="form-logo">
                <img src="{{ asset('images/logos/Logo-Eng.svg') }}" alt="ლოგო">
            </div>

            <div class="admin-login-form container-fluid">
                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <div class="form-card card card-body">
                            <form action="/admin/login" method="post">
                                @csrf
                                {{-- Alerts --}}
                                    @if (Session::has('logout_successful'))
                                        <div class="alert alert-success">გამოსვლა მოხდა წარმატებულად</div>
                                    @endif
                                    @if (Session::has('login_error'))
                                        <div class="alert alert-danger">ლოგინი ან პაროლი არასწორია</div>
                                    @endif
                                    @if (Session::has('user_deleted'))
                                        <div class="alert alert-danger">მომხმარებელი დაბლოკილია</div>
                                    @endif
                                {{-- Alerts --}}

                                <div class="form-group">
                                    <input type="text" name="login" value="{{  old('name') }}" class="form-control form-control-lg" placeholder="ლოგინი">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="პაროლი">
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="/" class="split-button pulse-button p-0">
                                        <span>საიტზე დაბრუნება</span>
                                        <span class="dire-left-arrow"></span>
                                    </a>
                                    <button type="submit" class="split-button pulse-button p-0">
                                        <span>შესვლა</span>
                                        <span class="dire-right-arrow"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <script type="text/javascript" src="{{ asset('masters/jquery-master/js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('masters/bootstrap-master/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.datepicker-location').datepicker({
                    maxViewMode: 1,
                    todayBtn: "linked",
                    clearBtn: true,
                    orientation: "auto",
                    daysOfWeekHighlighted: "0,6",
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd/mm/yyyy',
                    language: '{{ $locale_to_datepicker[Session::get('locale')] }}'
                })

                $('.text-editor').ckeditor()
            })
        </script>
        @yield('bottom_js')
    </body>
</html>