@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();

    $products_brands = [];

    foreach ( $products as $item ) {
        $products_brands[] = $item['brand'];
    }

    $products_brands = array_unique($products_brands);
@endphp

@if ($meta['exists'] )
    @section('meta')
        <meta property="og:url" content="{{ url()->current() }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{$meta['meta_title'] }}"/>
        <meta property="og:description" content="{{$meta['meta_description'] }}"/>
        <meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

        <title>{{$meta['meta_title'] }}</title>
        <meta name="keywords" content="{{$meta['meta_keywords'] }}">
        <meta name="description" content="{{$meta['meta_description'] }}">
    @endsection
@endif

@section('content')
    @if ( $agent->isMobile() )
        <div class="market-wrapper d-fc d-none" id="sort">
            <div class="top container-1280">
                <button type="button" class="toggle-mobile-navbar-market"><i class="dark" id="market-bars"></i> კატეგორიები</button>
                <button type="button" class="toggle-mobile-market" data-target="#main"><i class="orange" id="times"></i></button>
            </div>
            <div class="middle container-1280">
                <div class="range price d-fc">
                    <div class="top">
                        <p>ფასის ინტერვალი</p> 
                        <div>
                            <input type="number" value="{{ (Session::has('market.price-range-min')) ? Session::get('market.price-range-min') : '0' }}" id="price-range-min"> 
                            <span>-</span> 
                            <input type="number" value="{{ (Session::has('market.price-range-max')) ? Session::get('market.price-range-max') : '400' }}" id="price-range-max">
                        </div>
                    </div>
                    <div class="bottom">
                        <div id="price-range-slider"></div>
                        <input type="hidden">
                    </div>
                </div>
                <button type="button" class="toggle-mobile-market" data-target="#countries">
                    <div class="d-fc">
                        <strong>ქვეყნის ფილტაცია</strong>
                        <span>
                            @php
                                $filters_checked = false;
                                $filter_list = [];
                                foreach ( $filters['general']['country'] as $filter ) {
                                    if ( (in_array($filter, $filters['checked'])) ) {
                                        $filters_checked = true;
                                        $filter_list[] = $filter;
                                    }
                                }
                            @endphp
                            @foreach ( $filter_list as $filter_i => $filter )
                                {{ $filter }}{{ ($filter_i == array_key_last($filter_list)) ? '' : ',' }}
                            @endforeach
                            @if ( !$filters_checked )
                                ყველა
                            @endif
                        </span>
                    </div>
                    <i class="orange" id="nav-arrow"></i>
                </button>
                <button type="button" class="toggle-mobile-market" data-target="#brands">
                    <div class="d-fc">
                        <strong>ბრენდის ფილტრაცია</strong>
                        <span>
                            @php
                                $filters_checked = false;
                                $filter_list = [];
                                foreach ( $filters['general']['brand'] as $filter ) {
                                    if ( (in_array($filter, $filters['checked'])) ) {
                                        $filters_checked = true;
                                        $filter_list[] = $filter;
                                    }
                                }
                            @endphp
                            @foreach ( $filter_list as $filter_i => $filter )
                                {{ $filter }}{{ ($filter_i == array_key_last($filter_list)) ? '' : ',' }}
                            @endforeach
                            @if ( !$filters_checked )
                                ყველა
                            @endif
                        </span>
                    </div>
                    <i class="orange" id="nav-arrow"></i>
                </button>

                <button type="button" id="submit-filters">გაფილტრე</button>
            </div>
        </div>

        <div class="market-wrapper d-fc d-none" id="countries">
            <div class="top container-1280">
                <button type="button" class="toggle-mobile-navbar-market"><i class="dark" id="market-bars"></i> კატეგორიები</button>
                <button type="button" class="toggle-mobile-market" data-target="#sort"><i class="orange" id="nav-arrow"></i></button>
            </div>
            <div class="middle container-1280">
                <div class="filter">
                    <p>ქვეყნის ფილტრაცია</p>
                    <div class="checkboxes d-fc">
                        @foreach ( $filters['general']['country'] as $filter )
                            <label class="checkbox-wrapper">
                                <p class="{{ (in_array($filter, $filters['checked'])) ? 'active' : '' }}">{{ $filter }}</p>
                                <label class="universal-checkbox-wrapper"><input type="checkbox" data-type="country" value="{{ $filter }}" {{ (in_array($filter, $filters['checked'])) ? 'checked' : '' }}> <div class="before"></div> <div class="after"></div></label>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="button" id="submit-filters">გაფილტრე</button>
        </div>

        <div class="market-wrapper d-fc d-none" id="brands">
            <div class="top container-1280">
                <button type="button" class="toggle-mobile-navbar-market"><i class="dark" id="market-bars"></i> კატეგორიები</button>
                <button type="button" class="toggle-mobile-market" data-target="#sort"><i class="orange" id="nav-arrow"></i></button>
            </div>
            <div class="middle container-1280">
                <div class="filter">
                    <p>ბრენდის ფილტრაცია</p>
                    <div class="checkboxes d-fc">
                        @foreach ( $filters['general']['brand'] as $filter )
                            <label class="checkbox-wrapper">
                                <p class="{{ (in_array($filter, $filters['checked'])) ? 'active' : '' }}">{{ $filter }}</p>
                                <label class="universal-checkbox-wrapper"><input type="checkbox" data-type="brand" value="{{ $filter }}" {{ (in_array($filter, $filters['checked'])) ? 'checked' : '' }}> <div class="before"></div> <div class="after"></div></label>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="button" id="submit-filters">გაფილტრე</button>
        </div>
    @endif

    <div class="market-wrapper d-fc" id="main">
        @if ( $agent->isMobile() )
            <div class="top container-1280">
                <button type="button" class="toggle-mobile-navbar-market"><i class="dark" id="market-bars"></i> კატეგორიები</button>
                <button type="button" class="toggle-mobile-market" data-target="#sort"><i class="orange" id="mobile-sort"></i></button>
            </div>
        @else
            <div class="top container-1280">
                <div class="left">
                    <button type="button" class="toggle-market-all-categories-popup"><i class="orange" id="market-bars"></i> ყველა კატეგორია</button>
                    <div class="market-crumbs">
                        @if ( $get_data['has_group'] )
                            <a href="/market">ყველა</a>
                            <i class="dark-gray" id="market-arrow"></i>
                            <a href="/market?group={{ $get_data['group'] }}">{{ $get_data['current_group_name'] }}</a>
                            @if ( $get_data['has_category'] )
                                <i class="dark-gray" id="market-arrow"></i>
                                <a href="/market?group={{ $get_data['group'] }}&category={{ $get_data['category'] }}">{{ $get_data['current_category_name'] }}</a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="right">
                    @if ( !$agent->isTablet() )
                        <div class="select-wrapper">
                            <select class="market-top-filter" id="select-amount">
                                <option value="16" {{ (Session::get('market.amount') == '16' ? 'selected' : '')  }}>16 ნივთი ერთ გვერდზე</option>
                                <option value="24" {{ (Session::get('market.amount') == '24' ? 'selected' : '')  }}>24 ნივთი ერთ გვერდზე</option>
                                <option value="32" {{ (Session::get('market.amount') == '32' ? 'selected' : '')  }}>32 ნივთი ერთ გვერდზე</option>
                            </select>
                            <i class="dark-gray" id="market-arrow"></i>
                        </div>
                    @endif
                    @if ( Session::get('market.sort') == 'desc' )
                        <button type="button" id="sort-price" data-val="asc"><p><span>ფასი:</span> ზრდადობით</p><i class="yellow margined" id="market-arrow"></i></button>
                    @elseif ( Session::get('market.sort') == 'asc' )
                        <button type="button" id="sort-price" data-val="desc"><p><span>ფასი:</span> კლებადობით</p><i class="yellow margined" id="market-arrow"></i></button>
                    @else
                        <button type="button" id="sort-price" data-val="asc"><p><span>ფასი:</span> ზრდადობით</p><i class="yellow margined" id="market-arrow"></i></button>
                    @endif
                    @if ( $compact )
                        <button type="button" class="justify-content-center ml-3" id="market-compact" data-style="compact">სტილის შეცვლა</button>
                    @else
                        <button type="button" class="justify-content-center ml-3" id="market-compact" data-style="regular">სტილის შეცვლა</button>
                    @endif
                </div>
            </div>
        @endif

        <div class="middle container-1280">
            @if ( !$agent->isMobile() )
                <div class="left d-fc">
                    <div class="top d-fc">
                        @if ( $get_data['has_group'] )    
                            @foreach ( $product_categories['groups'] as $group )
                                @if ( $group['has'] == $get_data['group'] )
                                    @foreach ( $product_categories['sub_groups'] as $sub_group )
                                        @if ( $sub_group['belongs'] == $group['has'] )
                                            <a href="/market?group={{ $sub_group['belongs'] }}&category={{ $sub_group['search_id'] }}" class="item {{ ($sub_group['search_id'] == $get_data['category']) ? 'active' : '' }}">{{ $sub_group['title'] }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        {{-- @else
                            @foreach ( $product_categories['groups'] as $group )
                                @foreach ( $product_categories['sub_groups'] as $sub_group )
                                    <a href="/market?group={{ $sub_group['belongs'] }}&category={{ $sub_group['search_id'] }}" class="item {{ ($sub_group['search_id'] == $get_data['category']) ? 'active' : '' }}">{{ $sub_group['title'] }}</a>
                                @endforeach
                            @endforeach --}}
                        @endif
                    </div>

                    <div class="range price d-fc">
                        <div class="top">
                            <p>ფასის ინტერვალი</p> 
                            <div>
                                <input type="number" value="{{ (Session::has('market.price-range-min')) ? Session::get('market.price-range-min') : '0' }}" id="price-range-min"> 
                                <span>-</span> 
                                <input type="number" value="{{ (Session::has('market.price-range-max')) ? Session::get('market.price-range-max') : '400' }}" id="price-range-max">
                            </div>
                        </div>
                        <div class="bottom">
                            <div id="price-range-slider"></div>
                            <input type="hidden">
                        </div>
                    </div>

                    {{-- <div class="range weight d-fc">
                        <div class="top">
                            <p>წონის ინტერვალი</p>
                            <input type="number" value="{{ (Session::has('market.weight-range-min')) ? Session::get('market.weight-range-min') : '0' }}" id="weight-range-min">
                            <span>-</span>
                            <input type="number" value="{{ (Session::has('market.weight-range-max')) ? Session::get('market.weight-range-max') : '100' }}" id="weight-range-max">
                        </div>
                        <div class="bottom">
                            <div id="weight-range-slider"></div>
                            <input type="hidden">
                        </div>
                    </div> --}}

                    {{-- Filters --}}
                        <div class="filter">
                            <p>ქვეყნის ფილტრაცია</p>
                            <div class="checkboxes d-fc">
                                @foreach ( $filters['general']['country'] as $filter )
                                    <label class="checkbox-wrapper">
                                        <p class="{{ (in_array($filter, $filters['checked'])) ? 'active' : '' }}">{{ $filter }}</p>
                                        <label class="universal-checkbox-wrapper"><input type="checkbox" data-type="country" value="{{ $filter }}" {{ (in_array($filter, $filters['checked'])) ? 'checked' : '' }}> <div class="before"></div> <div class="after"></div></label>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="filter">
                            <p>ბრენდის ფილტრაცია</p>
                            <div class="checkboxes d-fc">
                                @foreach ( $filters['general']['brand'] as $filter )
                                    <label class="checkbox-wrapper">
                                        <p class="{{ (in_array($filter, $filters['checked'])) ? 'active' : '' }}">{{ $filter }}</p>
                                        <label class="universal-checkbox-wrapper"><input type="checkbox" data-type="brand" value="{{ $filter }}" {{ (in_array($filter, $filters['checked'])) ? 'checked' : '' }}> <div class="before"></div> <div class="after"></div></label>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    {{-- Filters --}}
                </div>
            @endif

            <div class="right d-fc">
                @if ( $compact )
                    @if ( !$get_data['has_group'] )
                        @if ( $favorites != [] )
                            <div class="product-table d-fc mb-5">
                                <div class="top-row product-table-row">
                                    <div class="brand-space">
                                        <div class="brand">მონიშნულები</div>
                                    </div>
                                    <div class="top-section section weight-section">ზომის ერთ</div>
                                    <div class="top-section section price-section">ფასი</div>
                                    <div class="top-section section amount-section">კალათა</div>
                                    <div class="top-section section checkbox-section"></div>
                                </div>
                                @foreach ( $favorites as $product )
                                    @if ( $product['has_variants'] == 'true' )
                                        @foreach ( json_decode($product['variants'], true) as $variant_index => $variant )
                                            @if ( in_array($variant_index, Session::get('favorites')[$product['id']]['variants']) )
                                                <div class="product-table-row">
                                                    <div class="section variant justify-content-start px-3"><a href="/market/product/{{ $product['slug'] }}">{{ $product['name'] }} - {{ $variant['weights'] }}</a></div>
                                                    <div class="section weight-section">{{ $product['measuring'] }}</div>
                                                    @php
                                                        $price = $variant['prices'];
                                                        if ( $product['discount'] == 'true' ) $price = $variant['prices'] * $product['discount_amount'];
                                                        $price = number_format(round($price, 2), 2, '.', '');
                                                    @endphp
                                                    <div class="section price-section">₾ {{ $price }}</div>
                                                    <div class="section amount-section">
                                                        <button type="button" class="cart-action no-reload h-100 justify-content-center" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id="{{ $variant_index }}"><i class="dark" id="market-cart-empty"></i></button>
                                                    </div>
                                                    <div class="section checkbox-section">
                                                        <label class="universal-checkbox-wrapper"><input class="favorites-checkbox" type="checkbox" data-key="{{ $product['id'] }}" data-variant-index="{{ $variant_index }}" checked> <div class="before"></div> <div class="after"></div></label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="product-table-row">
                                            <div class="section variant justify-content-start px-3"><a href="/market/product/{{ $product['slug'] }}">{{ $product['name'] }}</a></div>
                                            <div class="section weight-section">{{ $product['measuring'] }}</div>
                                            @php
                                                $price = $product['price'];
                                                if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                                $price = number_format(round($price, 2), 2, '.', '');
                                            @endphp
                                            <div class="section price-section">₾ {{ $price }}</div>
                                            <div class="section amount-section">
                                                <button type="button" class="cart-action no-reload h-100 justify-content-center" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}"><i class="dark" id="market-cart-empty"></i></button>
                                            </div>
                                            <div class="section checkbox-section">
                                                <label class="universal-checkbox-wrapper"><input class="favorites-checkbox" type="checkbox" data-key="{{ $product['id'] }}" checked> <div class="before"></div> <div class="after"></div></label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        @foreach ( $products_brands as $u_brands )
                            <div class="product-table d-fc mb-5">
                                <div class="top-row product-table-row">
                                    <div class="brand-space">
                                        <div class="brand">{{ $u_brands }}</div>
                                    </div>
                                    <div class="top-section section weight-section">ზომის ერთ</div>
                                    <div class="top-section section price-section">ფასი</div>
                                    <div class="top-section section amount-section">კალათა</div>
                                    <div class="top-section section checkbox-section"></div>
                                </div>
                                @foreach ( $products as $product )
                                    @if ( $product['brand'] == $u_brands )
                                        @if ( $product['has_variants'] == 'true' )
                                            @foreach ( json_decode($product['variants'], true) as $variant_index => $variant )
                                                <div class="product-table-row">
                                                    <div class="section variant justify-content-start px-3"><a href="/market/product/{{ $product['slug'] }}">{{ $product['name'] }} - {{ $variant['weights'] }}</a></div>
                                                    <div class="section weight-section">{{ $product['measuring'] }}</div>
                                                    @php
                                                        $price = $variant['prices'];
                                                        if ( $product['discount'] == 'true' ) $price = $variant['prices'] * $product['discount_amount'];
                                                        $price = number_format(round($price, 2), 2, '.', '');
                                                    @endphp
                                                    <div class="section price-section">₾ {{ $price }}</div>
                                                    <div class="section amount-section">
                                                        <button type="button" class="cart-action no-reload h-100 justify-content-center" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id="{{ $variant_index }}"><i class="dark" id="market-cart-empty"></i></button>
                                                    </div>
                                                    <div class="section checkbox-section">
                                                        <label class="universal-checkbox-wrapper"><input class="favorites-checkbox" type="checkbox" data-key="{{ $product['id'] }}" data-variant-index="{{ $variant_index }}"> <div class="before"></div> <div class="after"></div></label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="product-table-row">
                                                <div class="section variant justify-content-start px-3"><a href="/market/product/{{ $product['slug'] }}">{{ $product['name'] }}</a></div>
                                                <div class="section weight-section">{{ $product['measuring'] }}</div>
                                                @php
                                                    $price = $product['price'];
                                                    if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                                    $price = number_format(round($price, 2), 2, '.', '');
                                                @endphp
                                                <div class="section price-section">₾ {{ $price }}</div>
                                                <div class="section amount-section">
                                                    <button type="button" class="cart-action no-reload h-100 justify-content-center" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}"><i class="dark" id="market-cart-empty"></i></button>
                                                </div>
                                                <div class="section checkbox-section">
                                                    <label class="universal-checkbox-wrapper"><input class="favorites-checkbox" type="checkbox" data-key="{{ $product['id'] }}"> <div class="before"></div> <div class="after"></div></label>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div> 
                        @endforeach
                    @endif
                @else
                    <div class="market-items-grid">
                        @if ( !$get_data['has_group'] )
                            @foreach ( $favorites as $product )
                                <div class="market-item d-fc">
                                    @if ( $agent->isMobile() || $agent->isTablet() )
                                        <a href="/market/product/{{ $product['slug'] }}" class="d-fc">
                                            <img src="{{ asset($product['card_image']) }}" alt="{{ $product['card_image_alt'] }}">
                                            <div class="d-fc">
                                                <h5>{{ $product['brand'] }}</h5>
                                                <p>{!! $product['card_description'] !!}</p>
                                                @php
                                                    $price = $product['price'];
                                                    if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                                    $price = number_format(round($price, 2), 2, '.', '');
                                                @endphp
                                                <span class="price"><strong>₾ {{ $price }}</strong> /ცალი</span>
                                            </div>
                                        </a>
                                        <label class="universal-checkbox-wrapper d-flex"><input class="favorites-checkbox" type="checkbox" data-key="{{ $product['id'] }}" checked> <div class="before"></div> <div class="after"></div></label>
                                        <div class="actions">
                                            <button type="button" class="cart-action no-reload" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id={{ ($product['has_variants'] == 'true') ? 0 : 'null' }}><i class="dark" id="market-cart-empty"></i></button>
                                        </div>
                                    @else
                                        <a href="/market/product/{{ $product['slug'] }}" class="d-fc">
                                            <h5>{{ $product['brand'] }}</h5>
                                            <img src="{{ asset($product['card_image']) }}" alt="{{ $product['card_image_alt'] }}">
                                            <p>{!! $product['card_description'] !!}</p>
                                            @php
                                                $price = $product['price'];
                                                if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                                $price = number_format(round($price, 2), 2, '.', '');
                                            @endphp
                                            <span class="price"><strong>₾ {{ $price }}</strong> /ცალი</span>
                                        </a>
                                        <label class="universal-checkbox-wrapper d-flex"><input class="favorites-checkbox" type="checkbox" data-key="{{ $product['id'] }}" checked> <div class="before"></div> <div class="after"></div></label>
                                        <div class="actions">
                                            <button type="button" class="cart-action no-reload" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id={{ ($product['has_variants'] == 'true') ? 0 : 'null' }}><i class="dark" id="market-cart-empty"></i></button>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif

                        @foreach ( $products as $product )
                            @if ( !in_array($product['id'], Session::get('favorites')) )
                                <div class="market-item d-fc">
                                    @if ( $agent->isMobile() || $agent->isTablet() )
                                        <a href="/market/product/{{ $product['slug'] }}" class="d-fc">
                                            <img src="{{ asset($product['card_image']) }}" alt="{{ $product['card_image_alt'] }}">
                                            <div class="d-fc">
                                                <h5>{{ $product['brand'] }}</h5>
                                                <p>{!! $product['card_description'] !!}</p>
                                                @php
                                                    $price = $product['price'];
                                                    if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                                    $price = number_format(round($price, 2), 2, '.', '');
                                                @endphp
                                                <span class="price"><strong>₾ {{ $price }}</strong> /ცალი</span>
                                            </div>
                                        </a>
                                        <label class="universal-checkbox-wrapper"><input class="favorites-checkbox" class="favorites-checkbox" type="checkbox" data-key="{{ $product['id'] }}"> <div class="before"></div> <div class="after"></div></label>
                                        <div class="actions">
                                            <button type="button" class="cart-action no-reload" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id={{ ($product['has_variants'] == 'true') ? 0 : 'null' }}><i class="dark" id="market-cart-empty"></i></button>
                                        </div>
                                    @else
                                        <a href="/market/product/{{ $product['slug'] }}" class="d-fc">
                                            <h5>{{ $product['brand'] }}</h5>
                                            <img src="{{ asset($product['card_image']) }}" alt="{{ $product['card_image_alt'] }}">
                                            <p>{!! $product['card_description'] !!}</p>
                                            @php
                                                $price = $product['price'];
                                                if ( $product['discount'] == 'true' ) $price = $product['price'] * $product['discount_amount'];
                                                $price = number_format(round($price, 2), 2, '.', '');
                                            @endphp
                                            <span class="price"><strong>₾ {{ $price }}</strong> /ცალი</span>
                                        </a>
                                        <label class="universal-checkbox-wrapper"><input class="favorites-checkbox" class="favorites-checkbox" type="checkbox" data-key="{{ $product['id'] }}"> <div class="before"></div> <div class="after"></div></label>
                                        <div class="actions">
                                            <button type="button" class="cart-action no-reload" data-key="{{ $product['id'] }}" data-action="add" data-has-variants="{{ $product['has_variants'] }}" data-variant-id={{ ($product['has_variants'] == 'true') ? 0 : 'null' }}><i class="dark" id="market-cart-empty"></i></button>
                                            {{-- Icon Switch --}}
                                                {{-- (in_array($product['id'],$products_cookie_ids))?'market-cart-full':'market-cart-empty' --}}
                                            {{-- Icon Switch --}}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
                
                @if ( $get_data['has_group'] )
                    {{ $products->appends(['group' => $get_data['group']])->links() }}
                @elseif ( $get_data['has_category'] )
                    {{ $products->appends(['group' => $get_data['group'], 'category' => $get_data['category']])->links() }}
                @else
                    {{ $products->links() }}
                @endif
            </div>
        </div>
    </div>

    @include('user.components.all-categories-popup')
@endsection

@section('js')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.page-item.disabled').each(function() {
                if ( $(this).html() == '<span class="page-link">...</span>') {
                    $(this).html(`<div></div> <div></div> <div></div>`)
                }
            })
        })
  </script>
@endsection