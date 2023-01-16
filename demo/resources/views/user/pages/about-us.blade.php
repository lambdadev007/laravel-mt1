@extends('user.layout')

@php
    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

@section('meta')
    <meta name="keywords" content="ჩვენს შესახებ, chvens shesaxeb, რემონტი, remonti, მეტრიქსი, metrix">
    <meta name="description" content="ჩვენს შესახებ, chvens shesaxeb, რემონტი, remonti, მეტრიქსი, metrix, სარემონტო კომპანია, metrix, ბინის რემონტი, ევრო რემონტი, ავეჯი, ავეჯის დამზადება, დასუფთავება, ინტერიერის დიზაინი,მასალები, სამშენებლო მასალები">
    <title>ჩვენს შესახებ, {{ $TC->TG('html_title') }}</title>
@endsection

@section('content')

     <div class="page-title-wrapper container-fluid">
        <div class="page-title-line"></div>
        <h3 class="page-title">{{ $TC->TG('about_us') }}</h3>
        <div class="page-title-line"></div>
    </div>
    
    <div class="category-selector-wrapper container-fluid">
        <div class="category-selector w-100">
            <div class="about-us-main-wrapper">
                 {{-- About Left Side --}}
                    <div class="about-left-side-wrapper m-0">
                        <div class="category-selector">
                            <button class="{{ ($data['page'] == 'company') ? 'active' : '' }}" data-category="company">{{ $TC->TG('company') }}</button>
                            <button class="{{ ($data['page'] == 'team') ? 'active' : '' }}" data-category="team">{{ $TC->TG('team') }}</button>
                            <button class="{{ ($data['page'] == 'mission') ? 'active' : '' }}" data-category="mission">{{ $TC->TG('mission') }}</button>
                        </div>

                        <div class="about-content-wrapper">
                            {{-- Company --}}
                                <div class="company-wrapper {{ ($data['page'] == 'company') ? 'show' : '' }}">
                                    <div class="company-img-wrapper">
                                        <img class="lazy" src="{{ asset('images/about-us/about-us.jpg') }}" alt="ჩვენს შესახებ">
                                    </div>
                                    <div class="company-description">
                                        @if ( $data['text'] != [] )
                                            {!! $data['text'][0]['company_description'] !!}
                                            <span class="company-footer">{{ $data['text'][0]['company_footer'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            {{-- Company --}}

                            {{-- Team --}}
                                <div class="team-wrapper {{ ($data['page'] == 'team') ? 'show' : '' }}">
                                    <div class="team-text">
                                        @if ( $data['text'] != [] )
                                            <p>{{ $data['text'][0]['team_header'] }}</p>
                                        @endif
                                    </div>
                                    <div class="team-bloks">
                                        @foreach ( $data['team'] as $team )
                                            <div class="team-block">
                                                <div class="member-img"><img class="lazy" src="{{ asset($team['image']) }}" alt="{{ $team['name'] }}"></div>
                                                <div class="member-name">{{ $team['name'] }}</div>
                                                <div class="member-position">{{ $team['profession'] }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            {{-- Team --}}

                            {{-- Mission --}}
                                <div class="mission-wrapper {{ ($data['page'] == 'mission') ? 'show' : '' }}">
                                    @if ( $data['text'] != [] )
                                        <h3>{{ $data['text'][0]['mission_header'] }}</h3>
                                        <p>{{ $data['text'][0]['mission_description'] }}</p>
                                        <div class="mission-btn">
                                            <span>{{ $data['text'][0]['mission_footer_header'] }}</span>
                                            <p>{{ $data['text'][0]['mission_footer_description'] }}</p>
                                        </div>
                                    @endif
                                </div>
                            {{-- Mission --}}
                        </div>
                    </div>
                 {{-- About Left Side --}}

                 {{-- About Right Side --}}
                    <div class="about-right-side-wrapper mx-0">
                        <div class="about-right-navigation">
                            <a class="about-navigation-item" href="/">
                               <span class="dire-shop-online"></span>
                               <p>{{ $TC->TG('online_market') }}</p>
                            </a>
                            <a class="about-navigation-item" href="/consultation">
                                <span class="dire-consulting"></span>
                                <p>{{ $TC->TG('consultation') }}</p>
                            </a>
                            <a class="about-navigation-item" href="/design">
                                <span class="dire-design"></span>
                                <p>{{ $TC->TG('designer') }}</p>
                            </a>
                            <a class="about-navigation-item" href="/repairs">
                                <span class="dire-renovation"></span>
                                <p>{{ $TC->TG('repairs') }}</p>
                            </a>
                            <a class="about-navigation-item" href="/furniture">
                                <span class="dire-furniture"></span>
                                <p>{{ $TC->TG('furniture') }}</p>
                            </a>
                            <a class="about-navigation-item" href="/vip-master">
                                <span class="dire-master"></span>
                                <p>{{ $TC->TG('vip_master') }}</p>
                            </a>
                            <a class="about-navigation-item" href="/cleaning">
                                <span class="dire-cleaning"></span>
                                <p>{{ $TC->TG('cleaning') }}</p>
                            </a>
                        </div>
                    </div>
                 {{-- About Right Side --}}
            </div>
        </div>
    </div>

    @include('user.components.offers')

@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.category-selector > button').click(function(){
                let selector = `.${$(this).data('category')}-wrapper`
                $(this).siblings('button').removeClass('active')
                $(this).addClass('active')
                $('.about-content-wrapper > div').removeClass('show')
                $(selector).addClass('show clicked')

                setTimeout(function() {
                    $(selector).removeClass('clicked')
                }, 100)
            })
        })
    </script>
@endsection