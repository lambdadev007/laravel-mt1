@php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
@endphp

<div class="similar-products d-fc">
    <h5 class="container-1280"><i class="square"></i> მსგავსი პროდუქცია</h5>
    <div class="container-1280 market-items-grid">
        @foreach ($similar_products as $similar_product)
            <div class="market-item d-fc">
                <a href="/market/product/{{ $similar_product['slug'] }}" class="d-fc">
                    <h5>{{ $similar_product['brand'] }}</h5>
                    <img src="{{ asset($similar_product['card_image']) }}" alt="{{ $similar_product['card_image_alt'] }}">
                    <p>{{ $similar_product['card_description'] }}</p>
                    @php
                        $price = $similar_product['price'];
                        if ( $similar_product['discount'] == 'true' ) $similar_product['price'] * $similar_product['discount_amount'];
                    @endphp
                    <span class="price"><strong>₾ {{ number_format(round($price, 2), 2, '.', '') }}</strong> /ცალი</span>
                </a>
                <div class="actions">
                    <button type="button" class="cart-action no-reload" data-key="{{ $similar_product['id'] }}" data-action="add" data-amount="null"><i class="dark" id="market-cart-empty"></i></button>
                </div>
            </div>
        @endforeach
    </div>
</div>