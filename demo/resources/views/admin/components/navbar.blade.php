@php
    use App\Http\Controllers\HelpersCT;

    $category_lang = [
        'admin'         => 'ადმინისტრატორი',
        'executable'    => 'შეტყობინებების კოდი',
        'design'        => 'დიზაინი',
        'repairs'       => 'რემონტი',
        'furniture'     => 'ავეჯი',
        'cleaning'      => 'დასუფთავება',
        'articles'      => 'სტატიების მწერალი',
    ];

    $manager = '';

    if ( HelpersCT::is_manager() ) {
        $manager = ' - მენეჯერი';
    }
@endphp

{{-- Navbar --}}
    <div class="admin-panel-navbar">
        <div class="left-section">
            <a href="/admin">
                <img src="{{ asset('images/logos/Logo-Eng.svg') }}">
            </a>
            <label class="close-sidebar switch" for="admin-nav-checkbox">
                <input type="checkbox" id="admin-nav-checkbox" {{ Session::has('navbar.checked') ? 'checked' : '' }}>
                <div class="slider"></div>
            </label>
        </div>
        <div class="right-section dropdown">
            <span class="admin-user-text mr-4">{{ Session::get('admin.info.name') .' - '. $category_lang[Session::get('admin.info.category')] . $manager }}</span>

            {{-- Admin Language Dropdown --}}
                <div class="navbar-click-dropdown-wrapper mr-3">
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
                            <img class="lazy" src="{{ asset('images/svg_language_icons/united-kingdom.svg') }}" alt="ლოგო">
                        </button>

                        <div class="navbar-click-dropdown navbar-click-dropdown-language dropdown-triangle lower" aria-labelledby="dropdown-language">
                            <a href="/locale/ka">
                                <img class="lazy mb-0" src="{{ asset('images/svg_language_icons/georgia.svg') }}" alt="ლოგო">
                            </a>
                        </div>
                    @endif
                </div>
            {{-- Admin Language Dropdown --}}
            
            <button class="admin-nav-toggle-right-section waves-button" type="button" id="admin-navbar-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
            
            <form class="dropdown-menu" aria-labelledby="admin-navbar-dropdown" action="/admin/logout" method="post">
                @csrf
                <a href="/admin/personal-edit" class="split-button w-100 justify-content-end my-2">
                    <span class="w-100">პაროლის შეცვლა</span>
                    <span class="dire-left-arrow"></span>
                </a>

                <a href="/" class="split-button w-100 justify-content-end my-2">
                    <span class="w-100">საიტზე დაბრუნება</span>
                    <span class="dire-left-arrow"></span>
                </a>

                <button type="submit" class="split-button w-100 justify-content-end my-2">
                    <span class="w-100">გამოსვლა</span>
                    <span class="dire-left-arrow"></span>
                </button>
            </form>
        </div>
    </div>
{{-- Navbar --}}