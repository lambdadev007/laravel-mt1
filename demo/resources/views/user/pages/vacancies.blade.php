@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="ვაკანსიები, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია">
    <meta name="description" content="ვაკანსიები, vakansiebi, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, დიზაინერი, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>ვაკანსიები, მეტრიქსი - სამშენებლო სარემონტო კომპანია</title>
@endsection

@section('content')
     <div class="page-title-wrapper container-fluid mb-1">
         <div class="page-title-line"></div>
         <h3 class="page-title">{{ $TC->TG('vacancies') }}</h3>
         <div class="page-title-line"></div>
     </div>

    {{-- Link Path --}}
        <div class="link-path-wrapper container-fluid">
            <div class="link-path">
                <a class="link-path-item" href="/">{{ $TC->TG('homepage') }}</a>
                <span class="link-path-item dire-right-arrow"></span>
                <a class="link-path-item" href="/vacancies">{{ $TC->TG('vacancies') }}</a>
            </div>

            {{-- Phone Call Modal Button --}}
                <button class="split-button pulse-button p-0 ml-auto" data-toggle="modal" data-target="#phone-call-modal">
                    <span class="dire-right-arrow"></span>
                    <span class="anchor-text">597 70 10 10</span>
                </button>
            {{-- Phone Call Modal Button --}}
        </div>
    {{-- Link Path --}}

    <div class="vacancies-wrapper container-fluid">
        <form action="/notification" method="post">
            @csrf
            <div class="vacancies-left-segment">
                <div class="vacancies-top-categories">
                    <button type="button" data-type="employee">წესები თანამშრომლებისთვის</button>
                    <button type="button" data-type="legal-entity">იურიდიული პირის რეგისტრაცია</button>
                </div>

                <div class="instructional-banner">
                    @foreach ( $data['employees_banner'] as $employees_banner)
                        <img class="employee" src="{{ asset($employees_banner['image']) }}">
                    @endforeach
                    @foreach ( $data['legal_entities_banner'] as $legal_entities_banner)
                        <img class="legal-entity" src="{{ asset($legal_entities_banner['image']) }}">
                    @endforeach
                </div>

                <div class="vacancies-tabs">
                    @foreach ( $data['G'] as $Gi => $G )
                        {{-- Group --}}
                            <div class="group">
                                {{-- Group items --}}
                                    <div class="group-items-wrapper">
                                        @foreach ( $data['GI'] as $GIi => $GI )
                                            @if ( $GI['belongs'] == $G['has'] )
                                                <div class="group-item-wrapper {{ $GI['child_type'] }}">
                                                    <button class="group-item" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="group-item-{{ $GIi }}" data-target="#group-item-{{ $GIi }}">
                                                        <div class="outer">
                                                            <img src="{{ asset($GI['image']) }}">
                                                        </div>
                                                        <div class="inner">
                                                            <p>{{ $GI['title_'. Session::get('locale')] }}</p>
                                                            <div><span class="dire-right-arrow"></span></div>
                                                        </div>
                                                    </button>

                                                    <div class="collapse group-item" id="group-item-{{ $GIi }}">
                                                        @if ( $GI['child_type'] == 'sub_group' )
                                                            <div class="sub-groups-wrapper">
                                                                @foreach ( $data['SG'] as $SGi => $SG )
                                                                    @if ( $SG['belongs'] == $GI['has'] )
                                                                        {{-- Sub groups --}}
                                                                            <div class="sub-group">
                                                                                <button class="sub-group-item" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="sub-group-item-{{ $SGi }}" data-target="#sub-group-item-{{ $SGi }}">
                                                                                    <div class="outer">
                                                                                        <img src="{{ asset($SG['image']) }}">
                                                                                    </div>
                                                                                    <div class="inner">
                                                                                        <p>{{ $SG['title_'. Session::get('locale')] }}</p>
                                                                                        <div><span class="dire-right-arrow"></span></div>
                                                                                    </div>
                                                                                </button>

                                                                                <div class="collapse sub-group-item" id="sub-group-item-{{ $SGi }}">
                                                                                    <div class="checkbox-items-wrapper">
                                                                                        <div class="checkbox-item select-all">
                                                                                            <label>ყველას მონიშვნა</label>
                                                                                        </div>
                                                                                        @foreach ( $data['SGI'] as $SGIi => $SGI )
                                                                                            @if ( $SGI['belongs'] == $SG['has'] )
                                                                                                {{-- Sub group items--}}
                                                                                                    <div class="checkbox-item">
                                                                                                        <label for="{{ $SGIi }}">{{ $SGI['title_'. Session::get('locale')] }}</label>
                                                                                                        <input type="checkbox" id="{{ $SGIi }}" name="SGI[]" value="{{ $SGI['id'] }}">
                                                                                                    </div>
                                                                                                {{-- Sub group items--}}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        {{-- Sub groups --}}
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <div class="checkbox-items-wrapper">
                                                                <div class="checkbox-item select-all">
                                                                    <label>ყველას მონიშვნა</label>
                                                                </div>
                                                                @foreach ( $data['SGI'] as $SGIi => $SGI )
                                                                    @if ( $SGI['belongs'] == $GI['has'] )
                                                                        {{-- Sub group items--}}
                                                                            <div class="checkbox-item">
                                                                                <label for="{{ $SGIi }}">{{ $SGI['title_'. Session::get('locale')] }}</label>
                                                                                <input type="checkbox" id="{{ $SGIi }}" name="SGI[]" value="{{ $SGI['id'] }}">
                                                                            </div>
                                                                        {{-- Sub group items--}}
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                {{-- Group items --}}
                            </div>
                        {{-- Group --}}
                    @endforeach
                </div>
            </div>

            <div class="vacancies-right-segment">
                <div class="form-field">
                    <input placeholder="მიუთითეთ სახელი *" type="text" name="f_name" required>
                    <input placeholder="მიუთითეთ გვარი *" type="text" name="l_name" required>

                    <label for="how-many">თანამშრომლების რაოდენობა<b>*</b></label>
                    <select name="how_many" id="how-many" required>
                        @foreach ( $data['employees'] as $employee )
                            <option value="{{ $employee['id'] }}">{{ $employee['title_'. Session::get('locale')] }}</option>
                        @endforeach
                    </select>

                    <input class="validate-number mt-3" placeholder="მიუთითეთ ტელეფონი *" type="number" name="number" required>
                    <div class="d-flex">
                        <button class="envelope h37" type="button" data-toggle="tooltip" data-placement="top" title="თქვენს ნომერზე სმს-ი გაიგზავნება ვალიდაციის კოდით"><img src="{{ asset('images/svg_icons/envelope.svg') }}"></button>
                        <input class="validate-number" placeholder="შეიყვანეთ კოდი *" type="number" name="validation_code" required>
                    </div>
                    <input type="hidden" name="vacancy_type" value="{{ Crypt::encrypt('employee') }}">
                </div>
                <span class="is-necessary">*-ით მონიშნული ველების შევსება აუცილებელია.</span>
                <button disabled type="submit" class="split-button disabled">
                    <span class="dire-right-arrow"></span>
                    <span class="w-100">გაგზავნა</span>
                </button>
            </div>

            <input type="hidden" name="type" value="{{ Crypt::encrypt('vacancy') }}">
        </form>
    </div>
        

    @include('user.components.offers')
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function(){
            function employeeMarkup() {
                return `
                        <input placeholder="მიუთითეთ სახელი *" type="text" name="f_name" required>
                        <input placeholder="მიუთითეთ გვარი *" type="text" name="l_name" required>

                        <label for="how-many">თანამშრომლების რაოდენობა<b>*</b></label>
                        <select name="how_many" id="how-many" required>
                            @foreach ( $data['employees'] as $employee )
                                <option value="{{ $employee['id'] }}">{{ $employee['title_'. Session::get('locale')] }}</option>
                            @endforeach
                        </select>

                        <input class="validate-number mt-3" placeholder="მიუთითეთ ტელეფონი *" type="number" name="number" required>
                        <div class="d-flex">
                            <button class="envelope h37" type="button" data-toggle="tooltip" data-placement="top" title="თქვენს ნომერზე სმს-ი გაიგზავნება ვალიდაციის კოდით"><img src="{{ asset('images/svg_icons/envelope.svg') }}"></button>
                            <input class="validate-number" placeholder="შეიყვანეთ კოდი *" type="number" name="validation_code" required>
                        </div>
                        <input type="hidden" name="vacancy_type" value="{{ Crypt::encrypt('employee') }}">
                `
            }

            function legalEntityMarkup() {
                return `
                        <input placeholder="კომპანიის დასახელება *" type="text" name="company_name" id="company_name" required>
                        <input placeholder="საიდენტიფიკაციო კოდი *" type="text" name="identification_code" id="identification_code" required>
                        <input placeholder="საკონტაქტო მეილი *" type="email" name="mail" id="mail" required>
                        <input class="validate-number" placeholder="საკონტაქტო ნომერი *" type="number" name="number" id="number" required>
                        <div class="d-flex">
                            <button class="envelope h37" type="button" data-toggle="tooltip" data-placement="top" title="თქვენს ნომერზე სმს-ი გაიგზავნება ვალიდაციის კოდით"><img src="{{ asset('images/svg_icons/envelope.svg') }}"></button>
                            <input class="validate-number" placeholder="შეიყვანეთ კოდი *" type="number" name="validation_code" required>
                        </div>
                        <input type="hidden" name="vacancy_type" value="{{ Crypt::encrypt('legal_entity') }}">

                        <label for="field-of-activity">მაღაზიის საქმიანობის სფერო<b>*</b></label>
                        <select name="field_of_activity" id="field-of-activity">
                            @foreach ( $data['legal_entities'] as $legal_entity )
                                <option value="{{ $legal_entity['id'] }}">{{ $legal_entity['title_'. Session::get('locale')] }}</option>
                            @endforeach
                        </select>
                `
            }

            function tabsMarkup() {
                return `
                    <div class="vacancies-tabs">
                        @foreach ( $data['G'] as $Gi => $G )
                            {{-- GROUP --}}
                                <div class="group">
                                    {{-- Group items --}}
                                        <div class="group-items-wrapper">
                                            @foreach ( $data['GI'] as $GIi => $GI )
                                                @if ( $GI['belongs'] == $G['has'] )
                                                    <div class="group-item-wrapper {{ $GI['child_type'] }}">
                                                        <button class="group-item" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="group-item-{{ $GIi }}" data-target="#group-item-{{ $GIi }}">
                                                            <div class="outer">
                                                                <img src="{{ asset($GI['image']) }}">
                                                            </div>
                                                            <div class="inner">
                                                                <p>{{ $GI['title_'. Session::get('locale')] }}</p>
                                                                <div><span class="dire-right-arrow"></span></div>
                                                            </div>
                                                        </button>

                                                        <div class="collapse group-item" id="group-item-{{ $GIi }}">
                                                            @if ( $GI['child_type'] == 'sub_group' )
                                                                <div class="sub-groups-wrapper">
                                                                    @foreach ( $data['SG'] as $SGi => $SG )
                                                                        @if ( $SG['belongs'] == $GI['has'] )
                                                                            {{-- Sub groups --}}
                                                                                <div class="sub-group">
                                                                                    <button class="sub-group-item" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="sub-group-item-{{ $SGi }}" data-target="#sub-group-item-{{ $SGi }}">
                                                                                        <div class="outer">
                                                                                            <img src="{{ asset($SG['image']) }}">
                                                                                        </div>
                                                                                        <div class="inner">
                                                                                            <p>{{ $SG['title_'. Session::get('locale')] }}</p>
                                                                                            <div><span class="dire-right-arrow"></span></div>
                                                                                        </div>
                                                                                    </button>

                                                                                    <div class="collapse sub-group-item" id="sub-group-item-{{ $SGi }}">
                                                                                        <div class="checkbox-items-wrapper">
                                                                                            <div class="checkbox-item select-all">
                                                                                                <label>ყველას მონიშვნა</label>
                                                                                            </div>
                                                                                            @foreach ( $data['SGI'] as $SGIi => $SGI )
                                                                                                @if ( $SGI['belongs'] == $SG['has'] )
                                                                                                    {{-- Sub group items--}}
                                                                                                            <div class="checkbox-item">
                                                                                                                <label for="{{ $SGIi }}">{{ $SGI['title_'. Session::get('locale')] }}</label>
                                                                                                                <input type="checkbox" id="{{ $SGIi }}" name="SGI[]" value="{{ $SGI['id'] }}">
                                                                                                            </div>
                                                                                                    {{-- Sub group items--}}
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            {{-- Sub groups --}}
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <div class="checkbox-items-wrapper">
                                                                    <div class="checkbox-item select-all">
                                                                        <label>ყველას მონიშვნა</label>
                                                                    </div>
                                                                    @foreach ( $data['SGI'] as $SGIi => $SGI )
                                                                        @if ( $SGI['belongs'] == $GI['has'] )
                                                                            {{-- Sub group items--}}
                                                                                    <div class="checkbox-item">
                                                                                        <label for="{{ $SGIi }}">{{ $SGI['title_'. Session::get('locale')] }}</label>
                                                                                        <input type="checkbox" id="{{ $SGIi }}" name="SGI[]" value="{{ $SGI['id'] }}">
                                                                                    </div>
                                                                            {{-- Sub group items--}}
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    {{-- Group items --}}
                                </div>
                            {{-- GROUP --}}
                        @endforeach
                    </div>
                `
            }

            $('.vacancies-top-categories button').click(function () {
                let type = $(this).data('type')

                if ( $('.instructional-banner').hasClass(`${type}`) ) {
                    $('.instructional-banner').removeClass(`show ${type}`)
                } else {
                    $('.instructional-banner').removeClass('show opacity employee legal-entity')
                    $('.instructional-banner').addClass(`show ${type}`)
                    setTimeout(function () { $('.instructional-banner').addClass(`opacity`) }, 300);
                }

                if ( type == 'employee' ) {
                    $('.vacancies-right-segment .form-field').children().remove()
                    $('.vacancies-right-segment .form-field').prepend(employeeMarkup())
                    if ( $('.vacancies-tabs').length == 0 ) {
                        $('.vacancies-left-segment').append(tabsMarkup())
                        
                        $('.vacancies-right-segment button[type="submit"]').prop('disabled', true)
                        $('.vacancies-right-segment button[type="submit"]').addClass('disabled')
                    }
                } else {
                    $('.vacancies-right-segment .form-field').children().remove()
                    $('.vacancies-right-segment .form-field').prepend(legalEntityMarkup())
                    if ( $('.vacancies-tabs').length > 0 ) {
                        $('.vacancies-tabs').remove()

                        $('.vacancies-right-segment button[type="submit"]').prop('disabled', false)
                        $('.vacancies-right-segment button[type="submit"]').removeClass('disabled')
                    }
                }
            })
        })
    </script>
@endsection