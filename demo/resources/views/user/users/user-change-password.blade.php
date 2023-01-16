@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'change_password'           => 'პაროლის შეცვლა',
            'old_password_incorrect'    => 'ძველი პაროლი არასწორია',

            'if_profile'                => 'თუ უკვე გაქვთ პირადი პროფილი შეგიძლიათ გაიაროთ',
            'authorize'                 => 'ავტორიზაცია',
            'personal_data'             => 'პირადი მონაცემები',
            'number_used'               => 'ნომერი უკვე მოხმარებაშია',
            'password_missmatch'        => 'პაროლები ერთმანეთს არ ემთხვევა',
            'password_changed'          => 'პაროლი შეიცვალა წარმატებით!',
            'password_confirmation'     => 'პაროლის დადასტურება',
            'repeat_password'           => 'გაიმეორეთ პაროლი',
            'old_password'              => 'ძველი პაროლი',
        ],
        'en' => [
            'change_password'           => 'Change Password',
            'old_password_incorrect'    => 'Old password is incorrect',

            'if_profile'                => 'If you already have a profile you can',
            'authorize'                 => 'Login',
            'personal_data'             => 'Personal Data',
            'number_used'               => 'Number is already in use',
            'password_missmatch'        => 'Password do not match',
            'password_changed'          => 'Password changed successfuly',
            'password_confirmation'     => 'Password confirmation',
            'repeat_password'           => 'Repeat password',
            'old_password'              => 'Old password',
        ]
    ];
@endphp

@section('meta')
    <title>პაროლის შეცვლა, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->T($local, 'change_password') }}</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid py-3">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/user/profile">{{ $TC->TG('user_profile') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/user/change-password">{{ $TC->T($local, 'change_password') }}</a>
            </div>
        </div>
    {{-- Link Path --}}

    <div class="user-form-wrapper container-fluid">
        <form class="form-field" method="post" action="/user/update-password">
            @csrf
            <div class="row">
                @if ( Session::has('password_mismatch') )
                    <div class="col-sm-12">
                        <div class="alert alert-warning">{{ $TC->T($local, 'password_missmatch') }}</div>
                    </div>
                @endif

                @if ( Session::has('old_password_incorrect') )
                    <div class="col-sm-12">
                        <div class="alert alert-warning">{{ $TC->T($local, 'old_password_incorrect') }}</div>
                    </div>
                @endif

                @if ( Session::has('password_changed') )
                    <div class="col-sm-12">
                        <div class="alert alert-success">{{ $TC->T($local, 'password_changed') }}</div>
                    </div>
                @endif

                <div class="col-sm-12">
                    <label for="old-password">{{ $TC->T($local, 'old_password') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->TG('specify') .' '. $TC->T($local, 'old_password') }}" type="password" name="old_password" id="old-password">
                </div>

                <div class="col-sm-12">
                    <label for="password">{{ $TC->TG('password') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('password') }}" type="password" name="password" id="password">
                </div>

                <div class="col-sm-12">
                    <label for="password_check">{{ $TC->T($local, 'password_confirmation') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->T($local, 'repeat_password') }}" type="password" name="password_check" id="password_check">
                </div>

                <div class="col-sm-12 d-flex justify-content-center">
                    <button class="split-button" type="submit">
                        <span class="dire-right-arrow"></span>
                        <span>{{ $TC->T($local, 'change_password') }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @include('user.components.offers')
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.user-history-wrapper .purchase-list .purchase .top').click(function() {
                $(this).parents('.purchase').toggleClass('show')
                $(this).children('span').toggleClass('dire-up-arrow')
                $(this).children('span').toggleClass('dire-down-arrow')
            })
        })
    </script>
@endsection