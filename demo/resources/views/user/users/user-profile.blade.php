@extends('user.layout')

@php
    use App\Http\Controllers\HelpersCT;

    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'user_profile'              => 'მომხმარებლის პროფილი',
            'number_used'               => 'ნომერი უკვე მოხმარებაშია',
            'edit'                      => 'რედაქტირება',
            'cart'                      => 'კალათა',
            'purchase_history'          => 'შეკვეთების ისტორია',
            'change_password'           => 'პაროლის შეცვლა',
            'wishlist'                  => 'სურვილების სია',
        ],
        'en' => [
            'user_profile'              => 'User Profile',
            'number_used'               => 'Number is already in use',
            'edit'                      => 'Edit',
            'cart'                      => 'Cart',
            'purchase_history'          => 'Purchase History',
            'change_password'           => 'Change Password',
            'wishlist'                  => 'Wishlist',
        ]
    ];

    $city = $data['user']['city'];
    $region = $data['user']['region'];
@endphp

@section('meta')
    <title>მომხმარებლის პროფილი, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->TG('user_profile') }}</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid py-3">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/user/profile">{{ $TC->TG('user_profile') }}</a>
            </div>
        </div>
    {{-- Link Path --}}

    <div class="user-profile-wrapper container-fluid">
        <form class="form-field" method="post" action="/user/update-profile">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <label for="f_name">{{ $TC->TG('name') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('name') }}" type="text" name="f_name" id="f_name" value="{{ $data['user']['f_name'] }}">
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="l_name">{{ $TC->TG('lname') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('lname') }}" type="text" name="l_name" id="l_name" value="{{ $data['user']['l_name'] }}">
                </div>

                @if ( Session::has('number_taken') )
                    <div class="col-sm-12">
                        <div class="alert alert-warning">{{ $TC->T($local, 'number_used') }}</div>
                    </div>
                @endif

                <div class="col-sm-12">
                    <label for="number">{{ $TC->TG('number') }}<b>*</b></label>
                    <input required placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" type="number" name="number" id="number" value="{{ substr($data['user']['number'], 4) }}">
                </div>

                <div class="col-sm-12 col-md-6">
                    <label>{{ $TC->TG('city') }}<b>*</b></label>
                    <div class="metrix-selector-wrapper">
                        <select class="w-100" name="city" required>
                            <option {{ ($city == 'თბილისი') ? 'selected' : ''}} value="თბილისი">თბილისი</option>
                            <option {{ ($city == 'ბათუმი') ? 'selected' : ''}} value="ბათუმი">ბათუმი</option>
                            <option {{ ($city == 'გორი') ? 'selected' : ''}} value="გორი">გორი</option>
                            <option {{ ($city == 'ზუგდიდი') ? 'selected' : ''}} value="ზუგდიდი">ზუგდიდი</option>
                            <option {{ ($city == 'თელავი') ? 'selected' : ''}} value="თელავი">თელავი</option>
                            <option {{ ($city == 'რუსთავი') ? 'selected' : ''}} value="რუსთავი">რუსთავი</option>
                            <option {{ ($city == 'ფოთი') ? 'selected' : ''}} value="ფოთი">ფოთი</option>
                            <option {{ ($city == 'ქუთაისი') ? 'selected' : ''}} value="ქუთაისი">ქუთაისი</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label>{{ $TC->TG('region') }}<b>*</b></label>
                    <div class="metrix-selector-wrapper">
                        <select class="w-100" name="region" required>
                            <option {{ ($region == 'ავლაბარი') ? 'selected' : '' }} value="ავლაბარი">ავლაბარი</option>
                            <option {{ ($region == 'ავჭალა') ? 'selected' : '' }} value="ავჭალა">ავჭალა</option>
                            <option {{ ($region == 'აღმაშენებლის ხეივანი') ? 'selected' : '' }} value="აღმაშენებლის ხეივანი">აღმაშენებლის ხეივანი</option>
                            <option {{ ($region == 'ბაგები') ? 'selected' : '' }} value="ბაგები">ბაგები</option>
                            <option {{ ($region == 'გლდანი') ? 'selected' : '' }} value="გლდანი">გლდანი</option>
                            <option {{ ($region == 'დიდი დიღომი') ? 'selected' : '' }} value="დიდი დიღომი">დიდი დიღომი</option>
                            <option {{ ($region == 'დიდუბე') ? 'selected' : '' }} value="დიდუბე">დიდუბე</option>
                            <option {{ ($region == 'დიღმის მასივი') ? 'selected' : '' }} value="დიღმის მასივი">დიღმის მასივი</option>
                            <option {{ ($region == 'ვაკე') ? 'selected' : '' }} value="ვაკე">ვაკე</option>
                            <option {{ ($region == 'ვარკეთილი') ? 'selected' : '' }} value="ვარკეთილი">ვარკეთილი</option>
                            <option {{ ($region == 'ვეძისი') ? 'selected' : '' }} value="ვეძისი">ვეძისი</option>
                            <option {{ ($region == 'ისანი') ? 'selected' : '' }} value="ისანი">ისანი</option>
                            <option {{ ($region == 'კრწანისი') ? 'selected' : '' }} value="კრწანისი">კრწანისი</option>
                            <option {{ ($region == 'მთაწმინდა') ? 'selected' : '' }} value="მთაწმინდა">მთაწმინდა</option>
                            <option {{ ($region == 'ნაძალადევი') ? 'selected' : '' }} value="ნაძალადევი">ნაძალადევი</option>
                            <option {{ ($region == 'სამგორი') ? 'selected' : '' }} value="სამგორი">სამგორი</option>
                            <option {{ ($region == 'სანზონა') ? 'selected' : '' }} value="სანზონა">სანზონა</option>
                            <option {{ ($region == 'ჩუღურეთი') ? 'selected' : '' }} value="ჩუღურეთი">ჩუღურეთი</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label for="address">{{ $TC->TG('address') }}<b>*</b></label>
                    <textarea class="mb-0" name="address" id="address" required>{{ $data['user']['address'] }}</textarea>
                </div>
                
                <div class="col-sm-12">
                    <span class="is-necessary">{{ $TC->TG('required_inputs') }}</span>
                </div>

                <div class="col-sm-12 d-flex justify-content-center">
                    <button class="split-button" type="submit">
                        <span class="dire-right-arrow"></span>
                        <span>{{ $TC->T($local, 'edit') }}</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="sidebar-wrapper">
            <a href="">{{ $TC->T($local, 'cart') }}</a>
            <a href="/user/history">{{ $TC->T($local, 'purchase_history') }}</a>
            <a href="/user/change-password">{{ $TC->T($local, 'change_password') }}</a>
            <a href="/user/wishlist">{{ $TC->T($local, 'wishlist') }}</a>
        </div>
    </div>

    @include('user.components.offers')
@endsection