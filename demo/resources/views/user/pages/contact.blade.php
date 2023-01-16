@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;

    $local = [
        'ka' => [
            'design'        => 'დიზაინის',
            'repairs'       => 'რემონტის',
            'furniture'     => 'ავეჯის',
            'cleaning'      => 'დასუფთავების',
            'team'          => 'ჯგუფი',
        ],
        'en' => [
            'design'        => 'Design',
            'repairs'       => 'Repairs',
            'furniture'     => 'Furniture',
            'cleaning'      => 'Cleaning',
            'team'          => 'Team',
        ]
    ];
@endphp

@section('meta')
    <meta name="keywords" content="კონტაქტი, kontaqti, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="კონტაქტი, kontaqti, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>კონტაქტი, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

    <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->TG('contact') }}</h3>
         <div class="page-title-line"></div>
     </div>
    
    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/contact">{{ $TC->TG('contact') }}</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    <div class="contact-wrapper container-fluid">
        <div class="contact-left-segment">
            @foreach (['design', 'repairs', 'furniture', 'cleaning'] as $team)                    
                @if ( $data[$team] != [] )
                    <div class="contact-left-segment-section">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5>{{ $TC->T($local, $team) .' '. $TC->T($local, 'team') }}</h5>
                        </div>
                        @foreach ($data[$team] as $index => $contact)  
                            <div class="contact-link-wrapper {{ $index }}">
                                <a href="tel:{{ $contact['number'] }}">{{ $contact['number'] }}</a>
                                <span>{{ $contact['profession_'. Session::get('locale')] }}: <b>{{ $contact['name_'. Session::get('locale')] }}</b></span> 
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>

        <div class="contact-right-segment">
            <form action="/notification" method="post">
            @csrf
                <div class="form-field">
                    <label for="team">განყოფილება<b>*</b></label>
                    <div class="metrix-selector-wrapper mb-3">
                        <select required name="team" id="team" class="metrix-selector">
                            <option value="ონლაინ გაყიდვების განყოფილება">ონლაინ გაყიდვების განყოფილება</option>
                            <option value="დიზაინის განყოფილება">დიზაინის განყოფილება</option>
                            <option value="სარემონტო ჯგუფი">სარემონტო ჯგუფი</option>
                            <option value="ავეჯის საწარმო">ავეჯის საწარმო</option>
                            <option value="VIP-მასტერი">VIP-მასტერი</option>
                            <option value="დასუფთავების სამსახური">დასუფთავების სამსახური</option>
                        </select>
                    </div>

                    {{-- <label for="name">სახელი<b>*</b></label> --}}
                    <input type="text" name="name" id="name" placeholder="მიუთითეთ სახელი *" required>

                    {{-- <label for="number">ტელეფონი<b>*</b></label> --}}
                    <input class="validate-number" type="text" name="number" id="number" placeholder="მიუთითეთ ტელეფონი *" required>

                   <div class="d-flex">
                        <button class="envelope h37" type="button" data-toggle="tooltip" data-placement="top" title="თქვენს ნომერზე სმს-ი გაიგზავნება ვალიდაციის კოდით"><img src="{{ asset('images/svg_icons/envelope.svg') }}"></button>
                        <input class="validate-number" placeholder="შეიყვანეთ კოდი *" type="number" name="validation_code" required>
                    </div>

                    {{-- <label for="topic">თემა<b>*</b></label> --}}
                    <input type="text" name="topic" id="topic" placeholder="მიუთითეთ შეტყობინების თემა *" required>

                    {{-- <label for="message">შეტყობინება<b>*</b></label> --}}
                    <textarea name="message" id="message" placeholder="შეიყვანეთ შეტყობინების ტექსტი *" required></textarea>

                    <input type="hidden" name="type" value="{{ Crypt::encrypt('contact') }}">
                    
                    <span class="is-necessary">*-ით მონიშნული ველების შევსება აუცილებელია.</span>
                    <button type="submit" class="split-button align-self-end">
                        <span class="dire-right-arrow"></span>
                        <span class="px-3">შეტყობინების გაგზავნა</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('user.components.offers')
@endsection