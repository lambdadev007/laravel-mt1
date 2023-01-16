@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'if_profile'                => 'თუ უკვე გაქვთ პირადი პროფილი შეგიძლიათ გაიაროთ',
            'authorize'                 => 'ავტორიზაცია',
            'personal_data'             => 'პირადი მონაცემები',
            'number_used'               => 'ნომერი უკვე მოხმარებაშია',
            'password_missmatch'        => 'პაროლები ერთმანეთს არ ემთხვევა',
            'password_confirmation'     => 'პაროლის დადასტურება',
            'repeat_password'           => 'გაიმეორეთ პაროლი',
        ],
        'en' => [
            'if_profile'                => 'If you already have a profile you can',
            'authorize'                 => 'Login',
            'personal_data'             => 'Personal Data',
            'number_used'               => 'Number is already in use',
            'password_missmatch'        => 'Password do not match',
            'password_confirmation'     => 'Password confirmation',
            'repeat_password'           => 'Repeat password',
        ]
    ];
@endphp

@section('meta')
    <meta name="keywords" content="რეგისტრაცია, registracia, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix">
    <meta name="description" content="რეგისტრაცია, registracia, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ხელოსანი გამოძახებით, მწვანე კარკასი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>რეგისტრაცია, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->TG('register') }}</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/register">{{ $TC->TG('register') }}</a>
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
        <form class="form-field" method="post" action="/register">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <span class="register-info-span">{{ $TC->T($local, 'if_profile') }} <a href="/login">{{ $TC->T($local, 'authorize') }}</a></span>
                </div>

                <div class="col-sm-12">
                    <h5>{{ $TC->T($local, 'personal_data') }}</h5>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="f_name">{{ $TC->TG('name') }}<b>*</b></label>
                    <input type="text" name="f_name" id="f_name" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('name') }}" required>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="l_name">{{ $TC->TG('lname') }}<b>*</b></label>
                    <input type="text" name="l_name" id="l_name" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('lname') }}" required>
                </div>

                @if ( Session::has('number_taken') )
                    <div class="col-sm-12">
                        <div class="alert alert-warning">{{ $TC->T($local, 'number_used') }}</div>
                    </div>
                @endif

                <div class="col-sm-12">
                    <label for="number">{{ $TC->TG('number') }}<b>*</b></label>
                    <input class="validate-number" type="number" name="number" id="number" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" required>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label>{{ $TC->TG('city') }}<b>*</b></label>
                    <div class="metrix-selector-wrapper">
                        <select class="w-100" name="city" required>
                            <option selected value="თბილისი">თბილისი</option>
                            <option value="ბათუმი">ბათუმი</option>
                            <option value="გორი">გორი</option>
                            <option value="ზუგდიდი">ზუგდიდი</option>
                            <option value="თელავი">თელავი</option>
                            <option value="რუსთავი">რუსთავი</option>
                            <option value="ფოთი">ფოთი</option>
                            <option value="ქუთაისი">ქუთაისი</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label>{{ $TC->TG('region') }}<b>*</b></label>
                    <div class="metrix-selector-wrapper">
                        <select class="w-100" name="region" required>
                            <option value="ავლაბარი">ავლაბარი</option>
                            <option value="ავჭალა">ავჭალა</option>
                            <option value="აღმაშენებლის ხეივანი">აღმაშენებლის ხეივანი</option>
                            <option value="ბაგები">ბაგები</option>
                            <option value="გლდანი">გლდანი</option>
                            <option value="დიდი დიღომი">დიდი დიღომი</option>
                            <option value="დიდუბე">დიდუბე</option>
                            <option value="დიღმის მასივი">დიღმის მასივი</option>
                            <option value="ვაკე">ვაკე</option>
                            <option value="ვარკეთილი">ვარკეთილი</option>
                            <option value="ვეძისი">ვეძისი</option>
                            <option value="ისანი">ისანი</option>
                            <option value="კრწანისი">კრწანისი</option>
                            <option value="მთაწმინდა">მთაწმინდა</option>
                            <option value="ნაძალადევი">ნაძალადევი</option>
                            <option value="სამგორი">სამგორი</option>
                            <option value="სანზონა">სანზონა</option>
                            <option value="ჩუღურეთი">ჩუღურეთი</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="address">{{ $TC->TG('address') }}<b>*</b></label>
                    <textarea class="mb-0" name="address" id="address" required>{{ $TC->TG('address_info') }}</textarea>
                </div>

                <div class="col-sm-12"><h5>{{ $TC->TG('password') }}</h5></div>

                @if ( Session::has('password_mismatch') )
                    <div class="col-sm-12">
                        <div class="alert alert-warning">{{ $TC->T($local, 'password_missmatch') }}</div>
                    </div>
                @endif

                <div class="col-sm-12 col-md-6">
                    <label for="password">{{ $TC->TG('password') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('password') }}" type="password" name="password" id="password">
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="password_check">{{ $TC->T($local, 'password_confirmation') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->T($local, 'repeat_password') }}" type="password" name="password_check" id="password_check">
                </div>
                
                <div class="col-sm-12">
                    <span class="is-necessary">{{ $TC->TG('required_inputs') }}</span>
                </div>

                <div class="col-sm-12 mt-2 d-flex">
                    <label for="terms_of_service">
                        <input type="checkbox" name="terms_of_service" value="agreed" id="terms_of_service" required>
                        <span class="register-info-span">{{ $TC->TG('i_agree_to_register') }} <a href="/">{{ $TC->TG('these_terms_and_conditions') }}</a></span>
                    </label>
                </div>

                <div class="col-sm-12 d-flex justify-content-center">
                    <button class="split-button" type="submit">
                        <span class="dire-right-arrow"></span>
                        <span>{{ $TC->TG('register') }}</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    @include('user.components.offers')
@endsection