@php
    use App\Http\Controllers\HelpersCT;

    $category_lang = [
        'admin'         => 'ადმინისტრატორი',
        'executable'    => 'შეტყობინებების კოდი',
        'design'        => 'დიზაინი',
        'repairs'       => 'რემონტი',
        'furniture'     => 'ავეჯი',
        'cleaning'      => 'დასუფთავება',
        'blogger'       => 'სტატიების მწერალი',
    ];

    $manager = '';

    if ( HelpersCT::is_manager() ) {
        $manager = ' - მენეჯერი';
    }
@endphp

{{-- Navbar --}}
    <div class="admin-panel-navbar">
        <div class="left-section">
            <a href="/enter">
                <img src="{{ asset('images/logos/Logo-Eng.svg') }}">
            </a>
            <label class="close-sidebar switch" for="admin-nav-checkbox">
                <input type="checkbox" id="admin-nav-checkbox" {{-- Session::has('navbar.checked')?'checked':'' --}}>
                <div class="slider"></div>
            </label>
        </div>
        <div class="right-section dropdown">
            <span class="admin-user-text mr-4">{{ HelpersCT::decode_cookie('admin_cookie')['info']['name'] .' - '. $category_lang[HelpersCT::decode_cookie('admin_cookie')['info']['category']] . $manager }}</span>
            
            <button class="admin-nav-toggle-right-section waves-button" type="button" id="admin-navbar-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
            
            <form class="dropdown-menu" aria-labelledby="admin-navbar-dropdown" action="/enter/logout" method="post">
                @csrf
                {{-- <a href="/enter/personal-edit" class="universal-button w-100 my-2">პაროლის შეცვლა</a> --}}

                <a href="/" class="universal-button w-100 my-2">საიტზე დაბრუნება</a>

                <button type="submit" class="universal-button w-100 my-2">გამოსვლა</button>
            </form>
        </div>
    </div>
{{-- Navbar --}}