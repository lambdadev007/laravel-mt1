@php
    use Jenssegers\Agent\Agent;
    $agent = new Agent;

    use App\Http\Controllers\TranslationCT;
    $TC = new TranslationCT;
@endphp

<div class="main-top-bar"></div>

@if ( $agent->isMobile() )
    {{-- Mobile Navbar --}}
        <div class="mobile-navbar-top-bar"></div>
        <div class="mobile-navbar-wrapper container-fluid">
            <div class="mobile-navbar-top">
                <a href="/"><img class="lazy" src="{{ asset('images/logos/Logo-Eng.svg') }}" alt="Metrix Brand Logo"></a>
                <div>
                    <button data-toggle="modal" data-target="#phone-call-modal"><span class="dire-phone"></span></button>
                    <button><span class="dire-cart_new"><span class="mobile-cart-number">3</span></span></button>
                    <button class="burger-wrapper">
                        <span class="burger burger-top"></span>
                        <span class="burger burger-center"></span>
                        <span class="burger burger-bottom"></span>
                    </button>
                </div>
            </div>

            <div class="mobile-navbar-body">
                <form class="mobile-search-form" action="/" method="post">
                    <span class="dire-search"></span>
                    <input type="text" placeholder="{{ $TC->TG('search_word') }}">
                </form>

                <div class="mobile-category-links top">
                    <div class="mobile-category-link-wrapper">
                        <button type="button" data-toggle="collapse" data-target="#market-collapse" aria-expanded="false" aria-controls="market-collapse">
                            <span class="dire-right-arrow-s"></span>
                            {{ $TC->TG('online_market') }}
                            <span class="rotate-arrow dire-right-arrow"></span>
                        </button>
                        <div class="dropdown-toggler-content collapse" id="market-collapse">
                            <button type="button" data-toggle="collapse" data-target="#materials-collapse" aria-expanded="false" aria-controls="materials-collapse">
                                სამშენებლო მასალები 
                                <span class="rotate-arrow dire-right-arrow"></span>
                            </button>
                            <div class="collapse" id="materials-collapse">
                                <a href="/">ბლოკი-აგური</a>
                                <a href="/">მშრალი შენაერთები</a>
                                <a href="/">თაბაშირ–მუყაო</a>
                            </div>
                            <a href="/">ლაქ-საღებავები</a>
                            <a href="/">მოსაპირკეთებელი მასალები</a>
                            <a href="/">სანტექნიკა</a>
                            <a href="/">გათბობა კონდენცირება</a>
                            <a href="/">ელექტროობა</a>
                            <a href="/">კარ-ფანჯარა</a>
                            <a href="/">სახურავი</a>
                            <a href="/">ინსტრუმენტები</a>
                            <a href="/">სახარჯი მასალები</a>
                            <a href="/">ექსტერიერი</a>
                        </div>
                    </div>

                    <div class="mobile-category-link-wrapper">
                        <button type="button" data-toggle="collapse" data-target="#offers-collapse" aria-expanded="false" aria-controls="offers-collapse">
                            <span class="dire-right-arrow-s"></span>
                            {{ $TC->TG('services') }}
                            <span class="rotate-arrow dire-right-arrow"></span>
                        </button>
                        <div class="dropdown-toggler-content collapse" id="offers-collapse">
                            <a href="/consultation">{{ $TC->TG('consultation') }}</a>
                            <a href="/design">{{ $TC->TG('designer') }}</a>
                            <a href="/repairs">{{ $TC->TG('repairs') }}</a>
                            <a href="/furniture">{{ $TC->TG('furniture') }}</a>
                            <a href="/vip-master">{{ $TC->TG('vip_master') }}</a>
                            <a href="/cleaning">{{ $TC->TG('cleaning') }}</a>
                        </div>
                    </div>

                    <div class="mobile-category-link-wrapper">
                        <a href="/offers">
                            <span class="dire-right-arrow-s"></span>
                            {{ $TC->TG('offers') }}
                        </a>
                    </div>

                    <div class="mobile-category-link-wrapper">
                        <a href="/articles">
                            <span class="dire-right-arrow-s"></span>
                            {{ $TC->TG('articles') }}
                        </a>
                    </div>

                    <div class="mobile-category-link-wrapper">
                        <a href="/projects">
                            <span class="dire-right-arrow-s"></span>
                            {{ $TC->TG('projects') }}
                        </a>
                    </div>
                </div>

                <div class="mobile-category-links middle">
                    <div class="mobile-category-link-wrapper">
                        <button type="button" data-toggle="collapse" data-target="#about-collapse" aria-expanded="false" aria-controls="about-collapse">
                            {{ $TC->TG('about_us') }}
                            <span class="rotate-arrow dire-right-arrow"></span>
                        </button>
                        <div class="dropdown-toggler-content collapse" id="about-collapse">
                            <a href="/about-us">{{ $TC->TG('company') }}</a>
                            <a href="/about-us">{{ $TC->TG('team') }}</a>
                            <a href="/about-us">{{ $TC->TG('mission') }}</a>
                        </div>
                    </div>
                    
                    <div class="mobile-category-link-wrapper">
                        <a href="/vacancies">
                            {{ $TC->TG('vacancies') }}
                        </a>
                    </div>
                    
                    <div class="mobile-category-link-wrapper">
                        <button type="button" data-toggle="collapse" data-target="#about-two-collapse" aria-expanded="false" aria-controls="about-two-collapse">
                            {{ $TC->TG('terms') }}
                            <span class="rotate-arrow dire-right-arrow"></span>
                        </button>
                        <div class="dropdown-toggler-content collapse" id="about-two-collapse">
                            <a href="/payment">{{ $TC->TG('terms_of_payment') }}</a>
                            <a href="/delivery">{{ $TC->TG('delivery_conditions') }}</a>
                            <a href="/supplier">{{ $TC->TG('how_to_become_a_supplier') }}</a>
                        </div>
                    </div>

                    
                    <div class="mobile-category-link-wrapper">
                        <a href="/">
                            {{ $TC->TG('contact_information') }}
                        </a>
                    </div>
                </div>

                <div class="mobile-category-links bottom">

                </div>
            </div>
        </div>
        
        <div class="mobile-navbar-divider"></div>
    {{-- Mobile Navbar --}}
@else
    {{-- Static Navbar --}}
        <div class="static-navbar-wrapper container-fluid">
            {{-- Left Static Navigation --}}
                <div class="brand-logo-wrapper">
                    <div class="d-flex align-items-center mr-auto">
                        <a href="/">
                            <img class="lazy brand-img" src="{{ asset('images/logos/Logo-Eng.svg') }}" alt="Metrix Brand Logo">
                        </a>
                    </div>
                </div>
            {{-- Left Static Navigation --}}

            {{-- Right Static Navigation --}}
                <div class="d-flex flex-column w-100">
                    <div class="static-navbar-right-top d-flex justify-content-end">
                        {{-- Right Top Navigation Links --}}
                            <div class="d-flex py-1">
                                <div class="navigation-link">
                                    <a href="/about-us">{{ $TC->TG('about_us') }}</a>
                                </div>
                                <div class="navigation-link">
                                    <a href="/vacancies">{{ $TC->TG('vacancies') }}</a>
                                </div>
                                <div class="navigation-link">
                                    <a href="/contact">{{ $TC->TG('contact') }}</a>
                                </div>

                                {{-- Static User Cabinet --}}
                                    <div class="navbar-click-dropdown-wrapper dropdown-cabinet-wrapper">
                                        <button class="dropdown-cabinet-button" id="static-dropdown-cabinet" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                            <span class="dire-user"></span>
                                            <span>{{ (Session::has('user.logged')) ? Session::get('user.f_name') . ' ' . Session::get('user.l_name') : $TC->TG('private_cabinet') }}</span>
                                        </button>

                                        <div class="navbar-click-dropdown dropdown-triangle dropdown-cabinet" aria-labelledby="static-dropdown-cabinet">
                                            @if ( Session::has('user.logged') )
                                                <div class="dropdown-cabinet-logged">
                                                    <div class="cabinet-top-section">
                                                        <span class="user-name">{{ Session::get('user.f_name') . ' ' . Session::get('user.l_name') }}</span>
                                                        <a href="/user/profile">{{ $TC->TG('user_profile') }}</a>
                                                        <a href="/user/history">{{ $TC->TG('purchase_history') }}</a>
                                                        <a href="/change-password">{{ $TC->TG('change_password') }}</a>
                                                    </div>
                                                    <div class="cabinet-mid-section">
                                                        {{-- <a href="/compare"><span class="dire-compare"></span> {{ $TC->TG('compare_products') }}</a> --}}
                                                        <a href="/wishlist"><span class="dire-wishlist"></span> {{ $TC->TG('wishlist') }}</a>
                                                    </div>
                                                    <div class="cabinet-bottom-section">
                                                        <a href="/logout">{{ $TC->TG('logout') }}</a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="dropdown-cabinet-login">
                                                    <form method="post" action="/login">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="static-number">{{ $TC->TG('number') }}</label>
                                                            <input type="number" name="number" autocomplete="number" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" id="static-number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="static-password">{{ $TC->TG('password') }}</label>
                                                            <input type="password" name="password" autocomplete="password" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('password') }}" id="static-password">
                                                        </div>
                                                        <div class="remember-check">
                                                            <input type="checkbox" name="remember_token" id="static-remember-token">
                                                            <label for="static-remember-token">{{ $TC->TG('remember_me') }}</label>
                                                        </div>
                                                        <button type="submit" class="split-button w-100 p-0 my-2">
                                                            <span class="dire-right-arrow mt-1"></span>
                                                            <span class="w-100 mt-1">{{ $TC->TG('login') }}</span>
                                                        </button>
                                                    </form>
                                                    <a href="/password-recovery" class="border-bottom d-block w-100 py-2">{{ $TC->TG('forgot_password') }}</a>
                                                    <a href="/register" class="split-button w-100 p-0 my-2">
                                                        <span class="dire-right-arrow mt-1"></span>
                                                        <span class="mt-1 w-100 text-center">{{ $TC->TG('register') }}</span>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                {{-- Static User Cabinet --}}
                            </div>
                        {{-- Right Top Navigation Links --}}

                        {{-- Right Top Navigation Icons --}}
                            <div class="d-flex justify-content-between">
                                {{-- Static Phone Call Modal Button --}}
                                    <div>
                                        <button class="metrix-button metrix-button-light text-center mx-0" data-toggle="modal" data-target="#phone-call-modal">
                                            <span class="dire-phone"></span>
                                        </button>
                                    </div>
                                {{-- Static Phone Call Modal Button --}}

                                {{-- Static Search --}}
                                    <div class="navbar-click-dropdown-wrapper">
                                        <button class="metrix-button metrix-button-dark text-center mx-0" id="dropdown-search" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                            <span class="dire-search"></span>
                                        </button>

                                        <div class="navbar-click-dropdown dropdown-triangle left lower" aria-labelledby="dropdown-search">
                                            <div class="split-search">
                                                <input class="search" type="text" data-search="static" placeholder="{{ $TC->TG('specify') . ' ' . $TC->TG('search_word') }}">
                                                {{-- <button class="dire-left-arrow"></button> --}}
                                            </div>
                                            <div class="search-popup static">
                                                {{-- LINKS HERE --}}
                                            </div>
                                        </div>
                                    </div>
                                {{-- Static Search --}}

                                {{-- Static Language Dropdown --}}
                                    <div class="navbar-click-dropdown-wrapper">
                                        @if ( Session::get('locale') == null || Session::get('locale') == 'ka' )
                                            <button class="metrix-button metrix-button-dark text-center mx-0" id="dropdown-language" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                                <img class="lazy" src="{{ asset('images/svg_language_icons/georgia.svg') }}" alt="ლოგო">
                                            </button>

                                            <div class="navbar-click-dropdown navbar-click-dropdown-language dropdown-triangle lower" aria-labelledby="dropdown-language">
                                                <a href="/locale/en">
                                                    <img class="lazy" src="{{ asset('images/svg_language_icons/united-kingdom.svg') }}" alt="ლოგო">
                                                </a>
                                            </div>
                                        @elseif ( Session::get('locale') == 'en' )
                                            <button class="metrix-button metrix-button-dark text-center mx-0" id="dropdown-language" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                                <img class="lazy" src="{{ asset('images/svg_language_icons/united-kingdom.svg') }}" alt="logo">
                                            </button>

                                            <div class="navbar-click-dropdown navbar-click-dropdown-language dropdown-triangle lower" aria-labelledby="dropdown-language">
                                                <a href="/locale/ka">
                                                    <img class="lazy mb-0" src="{{ asset('images/svg_language_icons/georgia.svg') }}" alt="logo">
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                {{-- Static Language Dropdown --}}

                                {{-- Static Cart Dropdown --}}
                                    <div class="navbar-click-dropdown-wrapper mr-2">
                                        <button class="metrix-button metrix-button-dark shop-cart-button text-center mx-0" id="dropdown-cart" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                            <span class="dire-cart_new"></span>
                                            <span class="dire-cart_number"> 3 </span>
                                        </button>

                                        <div class="navbar-click-dropdown dropdown-triangle left lower" aria-labelledby="dropdown-cart">
                                            <ul class="dropdown-cart-items">
                                                <li class="items-image">
                                                    <img class="lazy" src="{{ asset('images/products/thumb_1.jpg') }}" alt="Cart Items">
                                                </li>

                                                <li class="items-text">
                                                    <div class="items-text-top">
                                                        <span>წებო-ემულსია საფასადე. 20</span>
                                                        <span class="dire-close"></span>
                                                    </div>
                                                    <div class="items-text-bottom">
                                                        <span>
                                                            <b>1 x 28.00</b>
                                                            <span class="dire-lari"></span>/{{ $TC->TG('unit') }}
                                                        </span>
                                                        <span>
                                                            {{ $TC->TG('sum') }}: <b>28.00</b>
                                                            <span class="dire-lari"></span>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>

                                            <ul class="dropdown-cart-items">
                                                <li class="items-image">
                                                    <img class="lazy" src="{{ asset('images/products/thumb_2.jpg') }}" alt="Cart Items">
                                                </li>

                                                <li class="items-text">
                                                    <div class="items-text-top">
                                                        <span>თაფაშირმუყაოს პროფილი. 50 მმ</span>
                                                        <span class="dire-close"></span>
                                                    </div>
                                                    <div class="items-text-bottom">
                                                        <span>
                                                            <b>5 x 4.50</b>
                                                            <span class="dire-lari"></span>/{{ $TC->TG('unit') }}
                                                        </span>
                                                        <span>
                                                            {{ $TC->TG('sum') }}: <b>22.50</b>
                                                            <span class="dire-lari"></span>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>

                                            <div class="dropdown-cart-footer">
                                                <div class="footer-price">
                                                    <p>{{ $TC->TG('total') }}: <b>45.50</b></p> <span class="dire-lari"></span>
                                                </div>

                                                <div class="footer-buttons">
                                                    <button class="split-button">
                                                        <span class="dire-cart_new"></span>
                                                        <span class="/">{{ $TC->TG('view') }}</span>
                                                    </button>

                                                    <button class="split-button">
                                                        <span class="dire-right-arrow-s"></span>
                                                        <span class="">{{ $TC->TG('payment') }}</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- Static Cart Dropdown --}}
                            </div>
                        {{-- Right Top Navigation Icons --}}
                    </div>

                    <div class="static-navbar-right-bottom">
                        {{-- Market Dropdown --}}
                            <div class="navbar-hover-dropdown-wrapper d-flex">
                                <button class="static-navbar-bottom-buttons navbar-hover-dropdown-button" type="button" id="market-dropdown" data-dropdown="hover" aria-haspopup="true" aria-expanded="false">{{ $TC->TG('online_market') }}</button>

                                <div class="navbar-hover-dropdown" aria-labelledby="market-dropdown">
                                    <div class="dropdown-market-wrapper">
                                        <div class="categories">
                                            <ul>
                                                <li class="active" id="building-materials">სამშენებლო მასალები</li>
                                                <li id="paints">ლაქ-საღებავები</li>
                                                <li id="facing">მოსაპირკეთებელი მასალები</li>
                                                <li id="plumbing">სანტექნიკა</li>
                                                <li id="conditioning">გათბობა კონდენცირება</li>
                                                <li id="electric">ელექტროობა</li>
                                                <li id="doors-windows">კარ-ფანჯარა</li>
                                                <li id="roofs">სახურავი</li>
                                                <li id="tools">ინსტრუმენტები</li>
                                                <li id="spending-materials">სახარჯი მასალები</li>
                                                <li id="exterior">ექსტერიერი</li>
                                            </ul>
                                        </div>

                                        <div class="sub-categories">
                                            <ul>
                                                <li class="active" aria-labelledby="building-materials">
                                                    <div class="sub-category">
                                                        <a href="/" class="sub-category-title">ბლოკი-აგური</a>
                                                        <img class="lazy" src="{{ asset('images/products/aguri.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category">
                                                            <li class="mt-3"><a href="/">აგური</a></li>
                                                            <li><a href="/">ბეტონის ბლოკი</a></li>
                                                            <li><a href="/">პემზის ბლოკი</a></li>
                                                            <li><a href="/">ბორდიური</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a hre="/" class="sub-category-title">მშრალი შენაერთები</a>
                                                        <img class="lazy" src="{{ asset('images/products/cementi.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category">
                                                            <li class="mt-3"><a href="/">ცემენტი</a></li>
                                                            <li><a href="/">წებოცემენტი</a></li>
                                                            <li><a href="/">ფითხი–შპაკლი</a></li>
                                                            <li><a href="/">თაბაშირი</a></li>
                                                            <li><a href="/">ქვიშა</a></li>
                                                            <li><a href="/">ღორღი</a></li>
                                                            <li><a href="/">გაჯი</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a hre="/" class="sub-category-title">თაბაშირ–მუყაო</a>
                                                        <img class="lazy" src="{{ asset('images/products/gips.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category">
                                                        </ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a hre="/" class="sub-category-title">იზოლაცია</a>
                                                        <img class="lazy" src="{{ asset('images/products/izolacia.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category">
                                                        </ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a hre="/" class="sub-category-title">ლითონი</a>
                                                        <img class="lazy" src="{{ asset('images/products/litoni.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category">
                                                        </ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a hre="/" class="sub-category-title">ხის მასალა</a>
                                                        <img class="lazy" src="{{ asset('images/products/xe.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category">
                                                        </ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a hre="/" class="sub-category-title">სამშენებლო ქიმია</a>
                                                        <img class="lazy" src="{{ asset('images/products/laqi.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category">
                                                        </ul>
                                                    </div>
                                                </li>

                                                <li aria-labelledby="paints">
                                                    <div class="sub-category">
                                                        <a href="/" class="sub-category-title">საღებავი</a>
                                                        <img class="lazy" src="{{ asset('images/products/aguri.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category"></ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a href="/" class="sub-category-title">ლაქი</a>
                                                        <img class="lazy" src="{{ asset('images/products/aguri.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category"></ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a href="/" class="sub-category-title">გრუნტი</a>
                                                        <img class="lazy" src="{{ asset('images/products/aguri.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category"></ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a href="/" class="sub-category-title">პიგმენტი</a>
                                                        <img class="lazy" src="{{ asset('images/products/aguri.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category"></ul>
                                                    </div>

                                                    <div class="sub-category">
                                                        <a href="/" class="sub-category-title">გამხსნელი</a>
                                                        <img class="lazy" src="{{ asset('images/products/aguri.png') }}" alt="Category Image" class="sub-category-image">
                                                        <ul class="sub-sub-category"></ul>
                                                    </div>
                                                </li>

                                                <li aria-labelledby="facing">

                                                </li>

                                                <li aria-labelledby="plumbing">

                                                </li>

                                                <li aria-labelledby="conditioning">

                                                </li>

                                                <li aria-labelledby="electric">

                                                </li>

                                                <li aria-labelledby="doors-windows">

                                                </li>

                                                <li aria-labelledby="roofs">

                                                </li>

                                                <li aria-labelledby="tools">

                                                </li>

                                                <li aria-labelledby="spending-materials">

                                                </li>

                                                <li aria-labelledby="exterior">

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- Market Dropdown --}}

                        {{-- Services dropdown --}}
                            <div class="navbar-hover-dropdown-wrapper d-flex">
                                <button class="static-navbar-bottom-buttons navbar-hover-dropdown-button" type="button" id="service-dropdown" data-dropdown="hover" aria-haspopup="true" aria-expanded="false">{{ $TC->TG('services') }}</button>

                                <div class="navbar-hover-dropdown" aria-labelledby="service-dropdown">
                                    <a class="service-dropdown-item" href="/consultation">
                                        <span class="dire-consulting"></span>
                                        <p>{{ $TC->TG('consultation') }}</p>
                                    </a>
                                    <a class="service-dropdown-item" href="/design">
                                        <span class="dire-design"></span>
                                        <p>{{ $TC->TG('designer') }}</p>
                                    </a>
                                    <a class="service-dropdown-item" href="/repairs">
                                        <span class="dire-renovation"></span>
                                        <p>{{ $TC->TG('repairs') }}</p>
                                    </a>
                                    <a class="service-dropdown-item" href="/furniture">
                                        <span class="dire-furniture"></span>
                                        <p>{{ $TC->TG('furniture') }}</p>
                                    </a>
                                    <a class="service-dropdown-item" href="/vip-master">
                                        <span class="dire-master"></span>
                                        <p>{{ $TC->TG('vip_master') }}</p>
                                    </a>
                                    <a class="service-dropdown-item" href="/cleaning">
                                        <span class="dire-cleaning"></span>
                                        <p>{{ $TC->TG('cleaning') }}</p>
                                    </a>
                                </div>
                            </div>
                        {{-- Services dropdown --}}

                        <a class="static-navbar-bottom-buttons" href="/offers">{{ $TC->TG('offers') }}</a>
                        <a class="static-navbar-bottom-buttons" href="/articles">{{ $TC->TG('articles') }}</a>
                        <a class="static-navbar-bottom-buttons mr-2" href="/projects">{{ $TC->TG('projects') }}</a>
                    </div>
                </div>
            {{-- Right Static Navigation --}}
        </div>
    {{-- Static Navbar --}}

    {{-- Fixed Navbar --}}
        <div class="fixed-navbar-wrapper container-fluid px-0">
            <div class="pt-1 bg-metrix-secondary"></div>
            <div class="fixed-navbar-content-wrapper">
                <div class="row mx-auto">
                    <div class="brand-logo-wrapper col-4">
                        <a href="/">
                            <img class="lazy brand-img" src="{{ asset('images/logos/Logo-Eng.svg') }}" alt="Metrix Brand Logo">
                        </a>
                    </div>
                    <div class="fixed-navbar-menu col-8">
                        {{-- Fixed User Cabinet --}}
                            <div class="navbar-click-dropdown-wrapper dropdown-cabinet-wrapper">
                                <button class="dropdown-cabinet-button d-block text-center" id="dropdown-cabinet" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                    <span class="dire-user"></span>
                                    <span>{{ (Session::has('user.logged')) ? Session::get('user.f_name') . ' ' . Session::get('user.l_name') : $TC->TG('private_cabinet') }}</span>
                                </button>

                                <div class="navbar-click-dropdown dropdown-triangle dropdown-cabinet" aria-labelledby="dropdown-cabinet">
                                    @if ( Session::has('user.logged') )
                                        <div class="dropdown-cabinet-logged">
                                            <div class="cabinet-top-section">
                                                <span class="user-name"> {{ Session::get('user.f_name') . ' ' . Session::get('user.l_name') }} </span>
                                                <a href="/user/profile">{{ $TC->TG('user_profile') }}</a>
                                                <a href="/history">{{ $TC->TG('purchase_history') }}</a>
                                                <a href="/change-password">{{ $TC->TG('change_password') }}</a>
                                            </div>
                                            <div class="cabinet-mid-section">
                                                {{-- <a href="/compare"><span class="dire-compare"></span> {{ $TC->TG('compare_products') }}</a> --}}
                                                <a href="/wishlist"><span class="dire-wishlist"></span> {{ $TC->TG('wishlist') }}</a>
                                            </div>
                                            <div class="cabinet-bottom-section">
                                                <a href="/logout">{{ $TC->TG('logout') }}</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="dropdown-cabinet-login">
                                            <form method="post" action="/login">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="static-number">{{ $TC->TG('number') }}</label>
                                                    <input type="number" name="number" autocomplete="number" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('number') }}" id="static-number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="static-password">{{ $TC->TG('password') }}</label>
                                                    <input type="password" name="password" autocomplete="password" placeholder="{{ $TC->TG('specify') .' '. $TC->TG('password') }}" id="static-password">
                                                </div>
                                                <div class="remember-check">
                                                    <input type="checkbox" name="remember-token" id="static-remember-me">
                                                    <label for="static-remember-me">{{ $TC->TG('remember_me') }}</label>
                                                </div>
                                                <button type="submit" class="split-button w-100 p-0 my-2">
                                                    <span class="dire-right-arrow mt-1"></span>
                                                    <span class="w-100 mt-1">{{ $TC->TG('login') }}</span>
                                                </button>
                                            </form>
                                            <a href="/password-recovery" class="border-bottom d-block w-100 py-2">{{ $TC->TG('forgot_password') }}</a>
                                            <a href="/register" class="split-button w-100 p-0 my-2">
                                                <span class="dire-right-arrow mt-1"></span>
                                                <span class="mt-1 w-100 text-center">{{ $TC->TG('register') }}</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        {{-- Fixed User Cabinet --}}

                        {{-- <div class="phone-numbers">
                            <div class="phone-index">
                                <span>(597)</span>
                            </div>
                            <div class="phone-number">70 10 10</div>
                        </div> --}}

                        {{-- Fixed Phone Call Modal Button --}}
                            <button class="split-button pulse-button p-0 mx-2" data-toggle="modal" data-target="#phone-call-modal">
                                <span class="dire-phone"></span>
                                <span class="anchor-text">597 70 10 10</span>
                            </button>
                        {{-- Fixed Phone Call Modal Button --}}

                        <div class="d-flex justify-content-between">
                            {{-- Fixed Search --}}
                                <div class="fixed-search-wrapper">
                                    <div class="form-group d-flex align-items-center">
                                        <input type="text" class="form-control search" data-search="fixed" placeholder="{{ $TC->TG('specify') . ' ' . $TC->TG('search_word') }}" autocomplete="off">
                                        {{-- <span class="dire-search metrix-button metrix-button-light"></span> --}}
                                    </div>
                                    <div class="search-popup fixed">
                                        {{-- LINKS HERE --}}
                                    </div>
                                </div>
                            {{-- Fixed Search --}}

                            {{-- Fixed Language Dropdown --}}
                                <div class="navbar-click-dropdown-wrapper">
                                    @if ( Session::get('locale') == null || Session::get('locale') == 'ka' )
                                        <button class="metrix-button metrix-button-dark text-center mx-0" id="dropdown-language" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                            <img class="lazy" src="{{ asset('images/svg_language_icons/georgia.svg') }}" alt="ლოგო">
                                        </button>

                                        <div class="navbar-click-dropdown navbar-click-dropdown-language dropdown-triangle lower" aria-labelledby="dropdown-language">
                                            <a href="/locale/en">
                                                <img class="lazy" src="{{ asset('images/svg_language_icons/united-kingdom.svg') }}" alt="ლოგო">
                                            </a>
                                        </div>
                                    @elseif ( Session::get('locale') == 'en' )
                                        <button class="metrix-button metrix-button-dark text-center mx-0" id="dropdown-language" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                            <img class="lazy" src="{{ asset('images/svg_language_icons/united-kingdom.svg') }}" alt="logo">
                                        </button>

                                        <div class="navbar-click-dropdown navbar-click-dropdown-language dropdown-triangle lower" aria-labelledby="dropdown-language">
                                            <a href="/locale/ka">
                                                <img class="lazy mb-0" src="{{ asset('images/svg_language_icons/georgia.svg') }}" alt="logo">
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            {{-- Fixed Language Dropdown --}}

                            {{-- Fixed Cart Dropdown --}}
                                <div class="navbar-click-dropdown-wrapper mr-2">
                                    <button class="metrix-button metrix-button-dark shop-cart-button text-center mx-0" id="fixed-dropdown-cart" data-dropdown="click" aria-haspopup="true" aria-expanded="false">
                                            <span class="dire-cart_new"></span>
                                            <span class="dire-cart_number"> 3 </span>
                                        </button>

                                    <div class="navbar-click-dropdown dropdown-triangle left lower" aria-labelledby="fixed-dropdown-cart">
                                        <ul class="dropdown-cart-items">
                                            <li class="items-image">
                                                <img class="lazy" src="{{ asset('images/products/thumb_1.jpg') }}" alt="Product Image">
                                            </li>

                                            <li class="items-text">
                                                <div class="items-text-top">
                                                    <span>წებო-ემულსია საფასადე. 20</span>
                                                    <span class="dire-close"></span>
                                                </div>
                                                <div class="items-text-bottom">
                                                    <span>
                                                        <b>1 x 28.00</b>
                                                        <span class="dire-lari"></span>/{{ $TC->TG('unit') }}
                                                    </span>
                                                    <span>
                                                        {{ $TC->TG('sum') }}: <b>28.00</b>
                                                        <span class="dire-lari"></span>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>

                                        <ul class="dropdown-cart-items">
                                            <li class="items-image">
                                                <img class="lazy" src="{{ asset('images/products/thumb_2.jpg') }}" alt="Product Image">
                                            </li>

                                            <li class="items-text">
                                                <div class="items-text-top">
                                                    <span>თაფაშირმუყაოს პროფილი. 50 მმ</span>
                                                    <span class="dire-close"></span>
                                                </div>
                                                <div class="items-text-bottom">
                                                    <span>
                                                        <b>5 x 4.50</b>
                                                        <span class="dire-lari"></span>/{{ $TC->TG('unit') }}
                                                    </span>
                                                    <span>
                                                        {{ $TC->TG('sum') }}: <b>22.50</b>
                                                        <span class="dire-lari"></span>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="dropdown-cart-footer">
                                            <div class="footer-price">
                                                <p>{{ $TC->TG('total') }}: <b>45.50</b></p> <span class="dire-lari"></span>
                                            </div>

                                            <div class="footer-buttons">
                                                <button class="split-button">
                                                    <span class="dire-cart_new"></span>
                                                    <span class="/">{{ $TC->TG('view') }}</span>
                                                </button>

                                                <button class="split-button">
                                                    <span class="dire-right-arrow-s"></span>
                                                    <span class="">{{ $TC->TG('payment') }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- Fixed Cart Dropdown --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Fixed Navbar --}}
@endif