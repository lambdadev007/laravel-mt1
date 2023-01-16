@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
@endphp

@section('content')
    <div class="market-wrapper profile no-bg d-fc">
        <div class="top container-1280">
            @if ( $agent->isMobile() || $agent->isTablet() )
               <div class="select-wrapper">
                    <select id="change-page">
                        <option value="profile" selected>მომხმარებლის პროფილი</option>
                        <option value="purchase-history">შეკვეთების ისტორია</option>
                    </select>
                    <i class="orange" id="market-arrow"></i>
                </div>
            @else
                <div class="left">
                    <button type="button" class="toggle-market-all-categories-popup"><i class="orange" id="market-bars"></i> ყველა კატეგორია</button>
                    <div class="market-crumbs">
                        <a href="/profile">მომხმარებლის პროფილი</a>
                    </div>
                </div>
            @endif
        </div>
        <div class="middle container-1280">
            @if ( !$agent->isMobile() && !$agent->isTablet() )
                <div class="left">
                    <div class="top">
                        <a class="item active" href="/profile">მომხმარებლის პროფილი</a>
                        <a class="item" href="/purchase-history">შეკვეთების ისტორია</a>
                        <a class="item" href="/cart" class="active">კალათა</a>
                    </div>
                </div>
            @endif
            <form class="middle d-fc" method="post" action="/user/update">
                <div class="s-0 d-fc w-i">
                    <h5><i class="square"></i> მომხმარებლის ინფორმაცია</h5>
                    <div class="d-flex">
                        <input type="text" name="username" value="{{ $data['username'] }}" placeholder="სახელი">
                        <input type="text" name="last_name" value="{{ $data['last_name'] }}" placeholder="გვარი">
                        <input type="text" name="email" value="{{ $data['email'] }}" placeholder="მაილი">
                        <input type="number" name="phone_number" value="{{ $data['phone_number'] }}" placeholder="{{ ( $agent->isMobile() || $agent->isTablet() ) ? 'ტელ. ნომერი' : 'ტელეფონის ნომერი' }}">
                    </div>
                </div>
                <div class="s-1 d-fc w-i">
                    <h5><i class="square"></i> პაროლი</h5>
                    <div class="d-flex">
                        <input type="password" name="current_password" placeholder="მიმდინარე პაროლი" id="current" required>
                        <input type="password" name="new_password" placeholder="ახალი პაროლი" required>
                        <input type="password" name="repeat_new_password" placeholder="{{ ( $agent->isMobile() || $agent->isTablet() ) ? 'გაიმეროეთ' : 'გაიმეორეთ ახალი პაროლი' }}" required>
                    </div>
                </div>
                <div class="s-2 d-fc">
                    <h5><i class="square"></i> მისამართები <button type="button" id="profile-add-address"><i class="gray" id="market-add-special"></i></button></h5>
                    <div class="d-flex flex-wrap profile-items-wrapper">
                        <div class="profile-item {{-- active --}} d-fc h-auto pt-5">
                            <input type="text" name="profile_address_names[]" placeholder="სახელი" required>
                            <input type="number" name="profile_address_numbers[]" placeholder="ნომერი" required>
                            <input type="text" name="profile_address_cities[]" placeholder="ქალაქი" required>
                            <input type="text" name="profile_address_streets[]" placeholder="ქუჩა" required>
                            {{-- <p class="name">შალვა მჭედლიშვილი</p>
                            <p class="number">599 156 156</p>
                            <p class="address"><strong>თბილისი</strong> / საბურთალო, ვაჟა ფშაველას 76</p> --}}
                            <button type="button" class="remove-this-item"><i class="gray" id="times"></i></button>
                            <button type="button" class="edit-this-item address general"><i class="gray" id="market-special-pen"></i></button>
                            <input type="hidden" name="index[]" value="null">
                        </div>
                    </div>
                </div>
                <div class="s-3 d-fc">
                    <h5><i class="square"></i> ბარათები <button type="button" id="profile-add-card"><i class="gray" id="market-add-special"></i></button></h5>
                    <div class="d-flex profile-items-wrapper">
                        <div class="profile-item profile-card {{-- active --}} d-flex">
                            <div class="left d-fc">
                                <p class="name">SHALVA MCHEDLISHVILI</p>
                                <p class="number">5992 **** **** 0027</p>
                                <p class="address"><strong>12/23</strong></p>
                            </div>
                            <div class="right">
                                <img src="{{ asset('images/logos/VISA-logo.png') }}" alt="">
                            </div>
                            <button type="button" class="remove-this-item"><i class="gray" id="times"></i></button>
                            <button type="button" class="edit-this-item"><i class="gray" id="market-special-pen"></i></button>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <button type="submit" id="save">დამახსოვრება</button>
                    {{-- <button type="submit" id="clear">გასუფთავება</button> --}}
                    <form id="logout_form" action="/user/logout" method="post">
                        @csrf
                        <button type="submit" form="logout_form" id="save">გამოსვლა</button>
                    </form>
                </div>
            </form>
        </div>
    </div>

    @include('user.components.all-categories-popup')
@endsection