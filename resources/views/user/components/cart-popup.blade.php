@php
    use Jenssegers\Agent\Agent;
    use App\Http\Controllers\TranslationsCT;

    $tranCT = new TranslationsCT();
    $agent = new Agent();

    $products_cookie_brands = [];

    foreach ( $products_cookie as $item ) {
        $products_cookie_brands[] = $item['brand'];
    }

    $products_cookie_brands = array_unique($products_cookie_brands);
@endphp

<div class="cart-popup-wrapper hidden">
    <div class="inner d-fc">
        <div class="top">
            <h5>{{ $tranCT->translate('cart') }} <i class="square"></i> <span id="cart-counter">{{ count($products_cookie) }} {{ $tranCT->translate('products') }}</span></h5>
            @if ( $agent->isMobile() || $agent->isTablet() )
                <button type="button" class="cart-button toggle-cart-popup">
                    <i class="dark" id="times"></i>
                </button>
            @else
                <a href="/cart">{{ $tranCT->translate('full_view') }}</a>
            @endif
        </div>
        <div class="list d-fc">
            @php
                $total_price = 0;
            @endphp
            @foreach ( $products_cookie as $item )
                @php
                    $price = $item['price'];
                    if ( $item['discount'] == 'true' ) $price = $item['price'] * $item['discount_amount'];

                    if ( $item['has_variants'] == 'true' ) {
                        foreach (json_decode(Cookie::get('products_cookie_000'), true)[$item['id']]['variants'] as $cookie_variant_id) {
                            foreach ( json_decode($item['variants'], true) as $variant_index => $variant ) {
                                if ( $variant_index == $cookie_variant_id ) {
                                    $variant_prices[$cookie_variant_id] = $variant['prices'];
                                    if ( $item['discount'] == 'true' ) $variant_prices[$cookie_variant_id] = $variant['prices'] * $item['discount_amount'];
                                }
                            }
                            $total_price += $variant_prices[$cookie_variant_id];
                        }
                    } else {
                        $total_price += $price;
                    }

                    $total_price = number_format(round($total_price, 2), 2, '.', '');
                @endphp
                @if ( $item['has_variants'] == 'true' )
                    <div class="item d-item-{{ $item['id'] }}" id="cart-popup-item-{{ $item['id'] }}">
                        <div class="left">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['image_alt'] }}">
                        </div>
                        <div class="right d-fc">
                            <div class="d-flex manufacturer-wrapper">
                                <span class="item-manufacturer">{{ $item['brand'] }}</span>
                                <button class="remove-this-item cart-action {{ (Request::path() == 'cart') ? '' : 'no-reload' }}" data-action="remove" data-key="{{ $item['id'] }}" data-has-variants="false"><i class="dark-gray" id="times"></i></button>
                            </div>
                            <div class="item-name-wrapper">
                                <p class="item-name">{!! $item['name'] !!}</p>
                                @if ( $item['has_variants'] == 'true' )
                                    <button type="button" class="cart-variant-dropdown-toggle"></button>
                                    <div class="cart-variant-dropdown d-none">
                                        @foreach ( json_decode($item['variants'], true) as $variant_index => $variant )
                                            @if ( !in_array($variant_index, json_decode(Cookie::get('products_cookie_000'), true)[$item['id']]['variants']) )
                                                <button class="cart-action no-reload self-delete" type="button" data-action="add" data-key="{{ $item['id'] }}" data-has-variants="{{ $item['has_variants'] }}" data-variant-id="{{ $variant_index }}">{{ $item['name'] }} - {{ $variant['weights'] }} {{ $item['measuring'] }}</button>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            @foreach (json_decode(Cookie::get('products_cookie_000'), true)[$item['id']]['variants'] as $cookie_variant_id)
                                @foreach ( json_decode($item['variants'], true) as $variant_index => $variant )
                                    @if ( $variant_index == $cookie_variant_id )
                                        <div class="variant-and-amount d-item-{{ $item['id'] .'-'. $cookie_variant_id }}">
                                            <div class="left">
                                                @php
                                                    $price = $variant['prices'];
                                                    if ( $item['discount'] == 'true' ) $price = $variant['prices'] * $item['discount_amount'];
                                                    $price = number_format(round($price, 2), 2, '.', '');
                                                @endphp
                                                <div 
                                                    class="counter market counter-{{ $cookie_variant_id .'-'. $item['id'] }}" 
                                                    id="cart-popup-counter-{{ $cookie_variant_id .'-'. $item['id'] }}" 
                                                    data-sync="counter-{{ $cookie_variant_id .'-'. $item['id'] }}"
                                                    data-amount="1" 
                                                    data-price="{{ $variant['prices'] }}"
                                                    data-discount="{{ $item['discount'] }}" 
                                                    data-discount-amount="{{ $item['discount_amount'] }}" 
                                                    data-has-variants="false" 
                                                    data-variant-select="null"
                                                    data-target=".popup-cart-price-{{ $cookie_variant_id .'-'. $item['id'] }}" 
                                                    data-total=".cart-popup-total" 
                                                    data-total-type="popup">
                                                    <i class="dark reverse" id="market-arrow"></i>
                                                    <input class="counter-input w-100 text-center" type="number" value="1">
                                                    <i class="dark" id="market-arrow"></i>
                                                </div>
                                                
                                                <span class="mx-auto">{{ $variant['weights'] }} {{ $item['measuring'] }}</span>

                                                <span class="price popup-cart-price-{{ $cookie_variant_id .'-'. $item['id'] }}" data-price="{{ $price }}">₾ {{ $price }}</span>
                                            </div>

                                            <div class="right">
                                                <button class="remove-this-item cart-action {{ (Request::path() == 'cart') ? '' : 'no-reload' }}" data-action="remove" data-key="{{ $item['id'] }}" data-has-variants="true" data-variant-id="{{ $cookie_variant_id }}"><i class="gray" id="small-times"></i></button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="item d-item-{{ $item['id'] }}" id="cart-popup-item-{{ $item['id'] }}">
                        <div class="left">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['image_alt'] }}">
                        </div>
                        <div class="right d-fc">
                            <div class="d-flex manufacturer-wrapper">
                                <span class="item-manufacturer">{{ $item['brand'] }}</span>
                                <button class="remove-this-item cart-action {{ (Request::path() == 'cart') ? '' : 'no-reload' }}" data-action="remove" data-key="{{ $item['id'] }}" data-has-variants="false"><i class="dark-gray" id="times"></i></button>
                            </div>
                            <div class="item-name-wrapper">
                                <p class="item-name">{!! $item['name'] !!}</p>
                            </div>
                            <div class="variant-and-amount">
                                <div class="left">
                                    @php
                                        $price = number_format(round($price, 2), 2, '.', '');
                                    @endphp
                                    <div 
                                        class="counter market counter-{{ $item['id'] }}" 
                                        id="cart-popup-counter-{{ $item['id'] }}" 
                                        data-sync="counter-{{ $item['id'] }}"
                                        data-amount="1" 
                                        data-price="{{ $item['price'] }}"
                                        data-discount="{{ $item['discount'] }}" 
                                        data-discount-amount="{{ $item['discount_amount'] }}" 
                                        data-has-variants="false" 
                                        data-variant-select="null"
                                        data-target=".popup-cart-price-{{ $item['id'] }}"
                                        data-total=".cart-popup-total" 
                                        data-total-type="popup">
                                        <i class="dark reverse" id="market-arrow"></i>
                                        <input class="counter-input w-100 text-center" type="number" value="1">
                                        <i class="dark" id="market-arrow"></i>
                                    </div>

                                    <span class="price popup-cart-price-{{ $item['id'] }}" data-price="{{ $price }}">₾ {{ $price }}</span>
                                </div>

                                <div class="right">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="cart-popup-bottom">
            <span class="price">{{ $tranCT->translate('total') }}: <strong class="cart-popup-total">₾ {{ $total_price }}</strong></span>
            <div class="d-flex">
                @if ( !$agent->isMobile() && !$agent->isTablet() )
                    @if ( isset($compact) && $compact )
                        <button type="button" class="list-view toggle-cart-popup" data-toggle="modal" data-target="#cart-list-view"><i class="dark" id="cart-popup-list"></i></button>
                    @else
                        <button type="button" class="list-view" data-toggle="modal" data-target="#cart-list-view"><i class="dark" id="cart-popup-list"></i></button>
                    @endif
                @endif
                <button type="button" class="market-buy" data-toggle="modal" data-target="#choose-address">{{ $tranCT->translate('purchase') }} <i class="white" id="arrow-right"></i></button>
            </div>
        </div>
    </div>
    @if ( !$agent->isMobile() && !$agent->isTablet() )
        <div class="outer toggle-cart-popup" data-target="cart"></div>
        <span class="toggle-cart-popup" data-target="cart">&times</span>
    @endif
</div>

<div class="modal fade modal-background" id="cart-list-view" tabindex="-1" role="dialog" aria-labelledby="cart-list-view-label" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-service modal-1160 modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="top-misc">
                <h3 class="modal-title">{{ $tranCT->translate('product_list') }}</h3>
                <span class="close-modal" data-dismiss="modal">&times</span>
            </div>
            <div class="middle col-11 mx-auto">
                <div class="product-tables">
                    @foreach ( $products_cookie_brands as $u_brands )
                        <div class="product-table {{ $u_brands }} d-fc mb-5">
                            <div class="top-row product-table-row">
                                <div class="brand-space">
                                    <div class="brand">{{ $u_brands }}</div>
                                </div>
                                <div class="top-section section weight-section">{{ $tranCT->translate('measuring_unit') }}</div>
                                <div class="top-section section price-section">{{ $tranCT->translate('price') }}</div>
                                <div class="top-section section amount-section w-20">{{ $tranCT->translate('amount') }}</div>
                                {{-- <div class="top-section section checkbox-section"></div> --}}
                            </div>
                            @foreach ( $products_cookie as $item )
                                @if ( $item['brand'] == $u_brands )
                                    @if ( $item['has_variants'] == 'true' )
                                        @foreach ( json_decode($item['variants'], true) as $variant_index => $variant )
                                            @foreach (json_decode(Cookie::get('products_cookie_000'), true)[$item['id']]['variants'] as $cookie_variant_id)
                                                @if ( $variant_index == $cookie_variant_id )
                                                    @php
                                                        $price = $variant['prices'];
                                                        if ( $item['discount'] == 'true' ) $price = $variant['prices'] * $item['discount_amount'];
                                                        $price = number_format(round($price, 2), 2, '.', '');
                                                    @endphp
                                                    <div class="product-table-row d-item-{{ $item['id'] .'-'.  $cookie_variant_id }}">
                                                        <div class="section variant justify-content-start px-3">{{ $item['name'] }}</div>
                                                        <div class="section weight-section">
                                                            <span class="d-flex justify-content-center align-items-center w-50 h-100 border-right">{{ $variant['weights'] }}</span>
                                                            <span class="d-flex justify-content-center align-items-center w-50 h-100">{{ $item['measuring'] }}</span>
                                                        </div>
                                                        <div class="section price-section popup-cart-price-{{ $cookie_variant_id .'-'. $item['id'] }}" data-price="{{ $price }}">₾ {{ $price}}</div>
                                                        <div class="section amount-section mx-0 w-20">
                                                            <div 
                                                            class="counter market counter-{{ $cookie_variant_id .'-'. $item['id'] }} border-0 w-50" 
                                                            id="product-table-counter-{{ $variant_index .'-'. $item['id'] }}" 
                                                            data-sync="counter-{{ $cookie_variant_id .'-'. $item['id'] }}"
                                                            data-amount="1" 
                                                            data-price="{{ $variant['prices'] }}"
                                                            data-discount="{{ $item['discount'] }}" 
                                                            data-discount-amount="{{ $item['discount_amount'] }}" 
                                                            data-has-variants="false" 
                                                            data-variant-select="null" 
                                                            data-target=".popup-cart-price-{{ $cookie_variant_id .'-'. $item['id'] }}" 
                                                            data-total=".cart-popup-total" 
                                                            data-total-type="popup">
                                                                <i class="dark reverse" id="market-arrow"></i>
                                                                <input class="counter-input w-100 text-center" type="number" value="1">
                                                                <i class="dark" id="market-arrow"></i>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="section checkbox-section">
                                                            <button class="remove-this-item cart-action {{ (Request::path() == 'cart') ? '' : 'no-reload' }} h-100 justify-content-center p-0" data-parent=".product-table-row" data-key="{{ $item['id'] }}" data-action="remove" data-has-variants="true" data-variant-id="{{ $cookie_variant_id }}"><i class="gray" id="small-times"></i></button>
                                                        </div> --}}
                                                        <button class="remove-this-item cart-action {{ (Request::path() == 'cart') ? '' : 'no-reload' }} h-100 justify-content-center p-0" data-parent=".product-table-row" data-key="{{ $item['id'] }}" data-action="remove" data-has-variants="true" data-variant-id="{{ $cookie_variant_id }}"><i class="gray" id="small-times"></i></button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        @php
                                            $price = $item['price'];
                                            if ( $item['discount'] == 'true' ) $price = $item['price'] * $item['discount_amount'];
                                            $price = number_format(round($price, 2), 2, '.', '');
                                        @endphp
                                        <div class="product-table-row d-item-{{ $item['id'] }}">
                                            <div class="section variant justify-content-start px-3">{{ $item['name'] }}</div>
                                            <div class="section weight-section">{{ $item['measuring'] }}</div>
                                            <div class="section price-section popup-cart-price-{{ $item['id'] }}" data-price="{{ $price }}">₾ {{ $price }}</div>
                                            <div class="section amount-section mx-0 w-20">
                                                <div 
                                                class="counter market counter-{{ $item['id'] }} border-0 w-50" 
                                                id="product-table-counter-{{ $item['id'] }}"
                                                data-sync="counter-{{ $item['id'] }}"
                                                data-amount="1" 
                                                data-price="{{ $item['price'] }}"
                                                data-discount="{{ $item['discount'] }}" 
                                                data-discount-amount="{{ $item['discount_amount'] }}" 
                                                data-has-variants="false" 
                                                data-variant-select="null" 
                                                data-target=".popup-cart-price-{{ $item['id'] }}" 
                                                data-total=".cart-popup-total" 
                                                data-total-type="popup">
                                                    <i class="dark reverse" id="market-arrow"></i>
                                                    <input class="counter-input w-100 text-center" type="number" value="1">
                                                    <i class="dark" id="market-arrow"></i>
                                                </div>
                                            </div>
                                            {{-- <div class="section checkbox-section">
                                                <button class="remove-this-item cart-action {{ (Request::path() == 'cart') ? '' : 'no-reload' }} h-100 justify-content-center p-0" data-parent=".product-table-row" data-key="{{ $item['id'] }}" data-action="remove" data-has-variants="false" data-variant-id="null"><i class="gray" id="small-times"></i></button>
                                            </div> --}}
                                            <button class="remove-this-item cart-action {{ (Request::path() == 'cart') ? '' : 'no-reload' }} h-100 justify-content-center p-0" data-parent=".product-table-row" data-key="{{ $item['id'] }}" data-action="remove" data-has-variants="false" data-variant-id="null"><i class="gray" id="small-times"></i></button>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div> 
                    @endforeach
                </div>
                <div class="cart-popup-bottom">
                    <span class="price">{{ $tranCT->translate('total') }}: <strong class="cart-popup-total">₾ {{ $total_price }}</strong></span>
                    <div class="d-flex">
                        @if ( !$agent->isMobile() && !$agent->isTablet() )
                            <button type="button" class="list-view toggle-cart-popup"><i class="dark" id="cart-popup-list"></i></button>
                        @endif
                        <button type="button" class="market-buy" data-toggle="modal" data-target="#choose-address">{{ $tranCT->translate('purchase') }} <i class="white" id="arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>