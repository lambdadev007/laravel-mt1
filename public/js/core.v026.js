$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).ready(function () {
    let locale = $('html').attr('lang')

    // ! Blog
        let target = 1
        
        $('.blog-top-component .button-wrapper button').click(function() {
            $('.blog-top-component .button-wrapper button').removeClass('active')
            $(this).addClass('active')
            $('div[id^="header-article"]').removeClass('show')
            $(`#header-article-${$(this).data('target')}`).addClass('show')
            target = parseInt($(this).data('target'))
            target++
            if ( target == 4 ) target = 3
        })

        $('.floating-article-checkboxes .universal-radio-wrapper input').change(function() {
            $('div[id^="header-article"]').removeClass('show')
            $(`#header-article-${$(this).data('target')}`).addClass('show')
            target = parseInt($(this).data('target'))
            target++
            if ( target == 4 ) target = 3
        })

        if ( $('.blog-top-component').length > 0 ) {
            setInterval(() => {
                $('div[id^="header-article"]').removeClass('show')
                $(`#header-article-${target}`).addClass('show')
                if ( $('.floating-article-checkboxes').length > 0 ) {
                    $(`input[data-target="${target}"]`).prop('checked', true).change()
                } else {
                    $('.blog-top-component .button-wrapper button').removeClass('active')
                    $(`button[data-target="${target}"]`).addClass('active')
                }

                target++

                if ( target == 4 ) target = 0
            }, 5000)
        }
    // ! Blog

    // ! Designer Tabs
        $('.designer-wrapper .information').css({'height': $(`.tab:not(.hidden)`).height()})
        $('body').on('click', '.designer-tab-buttons', function() {
            $('.categories button').removeClass('active')
            $(this).addClass('active')
            $('.information .tab').addClass('hidden')
            $($(this).data('target')).removeClass('hidden')
            $('.designer-wrapper .information').css({'height': $($(this).data('target')).height()})
        })
    // ! Designer Tabs

    // ! VIP - Master Buttons
        $('.vip-master-wrapper .content .left .top button.navigation').mouseenter(function() {
            $(this).find('i.gray').addClass('yellow')
        })
        $('.vip-master-wrapper .content .left .top button.navigation').mouseleave(function() {
            $(this).find('i.gray').removeClass('yellow')
        })
        $('.vip-master-wrapper .content .left .top button.navigation').click(function() {
            $(this).siblings('button.navigation').removeClass('active')
            $(this).addClass('active')
            $(this).siblings('button.navigation').find('i').removeClass('white')
            $(this).find('i').addClass('white')

            $('.vip-master-wrapper .content .right .category').addClass('d-none')
            $(`#${$(this).data('has')}`).removeClass('d-none')
        })

        $('#vip-master-change-category').change(function() {
            window.location.href = `../vip-master/${$(this).val()}`
        })
    // ! VIP - Master Buttons

    // ! VIP - Master Modal
        $('button[data-target="#vip-modal"]').click(function() {
            $('input[name="service_id"]').val($(this).data('id'))
        })
    // ! VIP - Master Modal

    // ! Market
        // * Init
            $('#cart-counter').text(`${$('.cart-popup-wrapper .inner .list .item > .right .variant-and-amount').length} პროდუქტი`)
            $('#navbar-cart-counter').text($('.cart-popup-wrapper .inner .list .item > .right .variant-and-amount').length)
        // * Init

        // * Get Price
            function get_price(baseline, discount, discount_amount, amount) {
                if ( discount ) {
                    price = discount_amount * baseline * amount
                } else {
                    price = baseline * amount
                }

                price = Math.round((price + Number.EPSILON) * 100) / 100

                let dec = String(price).split('.')[1]
                let len = dec && dec.length > 2 ? dec.length : 2
                return Number(price).toFixed(len)
            }

            function getTotalPrice(type) {
                let total_price = 0
                let total_selector = null

                if ( type == 'popup' ) {
                    total_selector = '.cart-popup-wrapper .list span.price'
                } else if ( type == 'page' ) {
                    total_selector = '.market-wrapper.cart .list p.price'
                }

                $(total_selector).each(function() {
                    total_price += parseFloat($(this).data('price'))
                })

                total_price = Math.round((total_price + Number.EPSILON) * 100) / 100

                let dec = String(total_price).split('.')[1]
                let len = dec && dec.length > 2 ? dec.length : 2
                return Number(total_price).toFixed(len)
            }
        // * Get Price

        // * Variant Select
            $('body').on('change', '.variant-select', function() {
                let price = 0
                let counter = $($(this).data('counter'))
                let amount = parseInt(counter.data('amount'))
                
                price = get_price($(this).val(), counter.data('discount'), counter.data('discount-amount'), amount)

                $(counter.data('target')).text(`₾ ${price}`)
                if ( counter.data('discount-target') ) $(counter.data('discount-target')).text(`₾ ${$(this).val() * amount}.00`)

                if ( counter.data('total') ) {
                    $(counter.data('target')).data('price', parseFloat(price))
                    $(counter.data('total')).text(`₾ ${getTotalPrice(counter.data('total-type'))}`)
                }
            })
        // * Variant Select

        // * Counter
            function counter_function(price, variant_select, counter, amount, arg_this) {
                if ( counter.data('sync') ) {
                    $(`.${counter.data('sync')}`).find('.counter-input').val(amount)
                    $(`.${counter.data('sync')}`).data('amount', amount)
                } else {
                    arg_this.siblings('.counter-input').val(amount)
                    arg_this.parent('.counter').data('amount', amount)
                }

                if ( variant_select != null ) {
                    price = get_price(variant_select.val(), counter.data('discount'), counter.data('discount-amount'), amount)
                } else {
                    price = get_price(counter.data('price'), counter.data('discount'), counter.data('discount-amount'), amount)
                }

                $(counter.data('target')).text(`₾ ${price}`)

                if ( variant_select != null ) {
                    if ( counter.data('discount-target') ) $(counter.data('discount-target')).text(`₾ ${get_price(variant_select.val(), false, 0, amount)}`)
                } else {
                    if ( counter.data('discount-target') ) $(counter.data('discount-target')).text(`₾ ${get_price(counter.data('price'), false, 0, amount)}`)
                }

                if ( counter.data('total') ) {
                    $(counter.data('target')).data('price', parseFloat(price))
                    $(counter.data('total')).text(`₾ ${getTotalPrice(counter.data('total-type'))}`)
                }
            }

            $('body').on('click', '.counter i', function() {
                let price = 0
                let action = 'add'
                let arg_this = $(this)
                let counter = arg_this.parent('.counter')
                let variant_select = null
                if ( counter.data('has-variants') == true ) variant_select = $(counter.data('variant-select'))
                let amount = parseInt(counter.data('amount'))

                if ( arg_this.hasClass('reverse') ) action = 'subtract'
                if ( action == 'add' ) {
                    amount++
                } else {
                    amount--
                    if ( amount <= 1 ) amount = 1
                }

                counter_function(price, variant_select, counter, amount, arg_this)
            })

            $('body').on('keyup keydown', '.counter .counter-input', function() {
                let price = 0
                let arg_this = $(this)
                let counter = arg_this.parent('.counter')
                let variant_select = null
                if ( counter.data('has-variants') == true ) variant_select = $(counter.data('variant-select'))
                let amount = parseInt(counter.data('amount'))

                amount = arg_this.val()

                if ( arg_this.val() <= 0 ) amount = 0

                counter_function(price, variant_select, counter, amount, arg_this)
            })
        // * Counter

        // * Sorting
            let range_changed = false

            function sort(keywords, values) {
                let _sort = {
                    'values': values,
                    'keywords': keywords,
                }

                return $.ajax({
                    type: 'POST',
                    url: '/market-sorting-ajax',
                    data: { sort: _sort }
                })
            }

            $('#select-amount').change(function() {sort(['amount'], [$(this).val()]).then(() => {location.reload()})})
            $('#sort-price').click(function() {sort(['sort'], [$(this).data('val')]).then(() => {location.reload()})})


            if ( $('.range').length > 0 ) {
                range = document.querySelector('#price-range-slider')
                noUiSlider.create(range, {
                    start: [ $('#price-range-min').val(), $('#price-range-max').val() ],
                    connect: true,
                    range: {
                        'min': 0,
                        'max': 400
                    },
                    step: 1,
                })
                
                range.noUiSlider.on('update', function (values) {
                    if ( $("#price-range-min").val() != Math.round(values[0]) || $("#price-range-max").val() != Math.round(values[1]) ) range_changed = true
                    $("#price-range-min").val(Math.round(values[0]))
                    $("#price-range-max").val(Math.round(values[1]))
                })

                $('body').mouseup(function(){
                    if ( range_changed == true ) {
                        sort(['price-range-min', 'price-range-max'], [$('#price-range-min').val(), $('#price-range-max').val()]).then(() => {location.reload()})
                    }
                })

                if ( $('#submit-filters').length > 0 ) {
                    $('#submit-filters').click(function() {
                        sort(['price-range-min', 'price-range-max'], [$('#price-range-min').val(), $('#price-range-max').val()]).then(() => {location.reload()})
                    })
                }
            }

            $('.filter label.universal-checkbox-wrapper input[type="checkbox"]').each(function() {
                $(this).change(function() {
                    $(this).parent('label').siblings('p').toggleClass('active')
                    if ( $( window ).width() < 900 ) {
                        sort($(this).data('type'), $(this).val())
                    } else {
                        sort($(this).data('type'), $(this).val()).then(() => {location.reload()})
                    }
                })
            })
        // * Sorting

        // * Market Modals
            $('.modal-checkout .modal-content > .middle.new-address > .top button').click(function() {
                let html = ''
                if ( $(this).data('toggle') == 'physical' ) {
                    html = `<input type="text" class="w-100" placeholder="სახელი">
                            <input type="text" class="small" placeholder="პირადი ნომერი">
                            <input type="text" class="small" placeholder="ტელეფონის ნომერი">`
                } else if ( $(this).data('toggle') == 'legal' ) {
                    html = `<input type="text" class="w-100" placeholder="ორგანიზაციის დასახელება">
                            <input type="text" class="small" placeholder="საიდენტიფიკაციო კოდი">
                            <input type="text" class="small" placeholder="ტელეფონის ნომერი">`
                }

                $(this).parent().siblings('.form').html(html)
            })
        // * Market Modals

        // * Market Categories
            $('.toggle-market-all-categories-popup').click(function() {
                if ( !$('.all-categories-popup').hasClass('hidden') ) {
                    $('.all-categories-popup').addClass('hiding')
                    setTimeout(() => {
                        $('.all-categories-popup').removeClass('hiding')
                        $('.all-categories-popup').toggleClass('hidden')
                    }, 300)
                } else {
                    $('.all-categories-popup').toggleClass('hidden')
                }
            })

            $('.toggle-all-categories-popup').click(function() {
                $(this).parent('div').siblings('div').removeClass('active')
                $(this).parent('div').addClass('active')
                $('.all-categories-popup .right .groups-wrapper').addClass('hidding')
                $(`.all-categories-popup .right .groups-wrapper.${$(this).data('target')}`).removeClass('hidding')
                if ( $(this).hasClass('no-delay') ) {
                    $('.toggle-all-categories-popup.no-delay').removeClass('no-delay')
                    $('.all-categories-popup .right .groups-wrapper').addClass('hidden')
                    $(`.all-categories-popup .right .groups-wrapper.${$(this).data('target')}`).removeClass('hidden')
                } else {
                    setTimeout(() => {
                        $('.all-categories-popup .right .groups-wrapper').addClass('hidden')
                        $(`.all-categories-popup .right .groups-wrapper.${$(this).data('target')}`).removeClass('hidden')
                    }, 300)
                }
            })

            $('.toggle-all-categories-navbar').click(function() {
                $(this).parent('div').siblings('div').removeClass('active')
                $(this).parent('div').addClass('active')
                $('.navbar-wrapper .groups-wrapper').addClass('d-none')
                $(`.navbar-wrapper .groups-wrapper.${$(this).data('target')}`).removeClass('d-none')
            })
        // * Market Categories
    
        // * Cart
            // * Ajax
                function product_cookie(key, action, has_variants, variant_id) {
                    let _data = {
                        'key': key,
                        'action': action,
                        'has_variants': has_variants,
                        'variant_id': variant_id
                    }

                    return $.ajax({
                        type: 'POST',
                        url: '/market-product-cookie',
                        data: { data: _data },
                    })
                }

                function find_product(key) {
                    return $.ajax({
                        type: 'POST',
                        url: '/market-find-product',
                        data: { key: key },
                    })
                }
            // * Ajax

            // * Markup
                function product_markup(item, variant_id) {
                    let markup =    `<div class="item d-item-${item.raw.id}" id="cart-popup-item-${item.raw.id}">
                                        <div class="left">
                                            <img src="${window.location.protocol}//${window.location.hostname}/${item.raw.image}" alt="${item.raw.image_alt}">
                                        </div>
                                        <div class="right d-fc">
                                            <div class="d-flex manufacturer-wrapper">
                                                <span class="item-manufacturer">${item.raw.brand}</span>
                                                <button class="remove-this-item cart-action no-reload" data-action="remove" data-key="${item.raw.id}" data-has-variants="false"><i class="dark-gray" id="times"></i></button>
                                            </div>
                                            <div class="item-name-wrapper">
                                                <p class="item-name">${item.raw.name}</p>`
                                                if ( item.raw.has_variants == 'true' ) {
                                                                                        markup += `<button type="button" class="cart-variant-dropdown-toggle"></button>
                                                                                                    <div class="cart-variant-dropdown d-none">`
                                                                                                        item.variants.forEach((options, index) => {
                                                                                                            if ( index != variant_id ) markup += `<button class="cart-action no-reload self-delete" type="button" data-action="add" data-key="${item.raw.id}" data-has-variants="${item.raw.has_variants}" data-variant-id="${index}">${item.raw.name} - ${options.weights} ${item.raw.measuring}</button>`
                                                                                                        })
                                                                                        markup += `</div>`
                                                }
                                markup += `</div>`
                                            markup += variant_markup(item, variant_id)
                            markup += `</div>`
                            
                        markup += `</div>`
                    return markup
                }
                
                function variant_markup(item, variant_id = null) {
                    let d_item = `d-item-${item.raw.id}`
                    let destination = item.raw.id
                    let price = item.raw.price
                    if ( variant_id != null ) {
                        d_item = `d-item-${item.raw.id}-${variant_id}`
                        destination = `${variant_id}-${item.raw.id}`
                        price = item.variants[variant_id].prices
                    }
                    let markup = `<div class="variant-and-amount ${d_item}">
                                    <div class="left">
                                        <div 
                                            class="counter market counter-${destination}" 
                                            id="cart-popup-counter-${destination}" 
                                            data-sync="counter-${destination}"
                                            data-amount="1" 
                                            data-price="${price}"
                                            data-discount="${item.raw.discount}" 
                                            data-discount-amount="${item.raw.discount_amount}" 
                                            data-has-variants="false" 
                                            data-variant-select="null" 
                                            data-target=".popup-cart-price-${destination}" 
                                            data-total=".cart-popup-total" 
                                            data-total-type="popup">
                                                <i class="dark reverse" id="market-arrow"></i>
                                                <input class="counter-input w-100 text-center" type="number" value="1">
                                                <i class="dark" id="market-arrow"></i>
                                        </div>`

                                        if ( item.raw.has_variants == 'true' ) {
                                            markup +=  `<span class="mx-auto">${item.variants[variant_id].weights}${item.raw.measuring}</span>`
                                        }

                                        if ( item.raw.has_variants == 'canceled-feature' ) {
                                            markup += `<div class="select-wrapper market">
                                                <select class="variant-select" id="cart-popup-variant-select-${i}-${item.raw.id}" data-counter="#cart-popup-counter-${i}-${item.raw.id}">
                                                    <option value="0" selected disabled>აირჩიეთ ვარიანტი</option>`

                                                    item.variants.forEach((options) => {
                                                        markup +=  `<option value="${options.prices}">${options.weights}${item.raw.measuring}</option>`
                                                    })
                                                
                                            markup += `</select>
                                                        <i class="dark" id="market-arrow"></i>
                                                    </div>`
                                        }

                                        if ( item.raw.has_variants == 'canceled-feature' ) {
                                            markup += `<span class="price" id="popup-cart-price-${i}-${item.raw.id}" data-price="0.00">₾ 0.00</span>`
                                        } else {
                                            if ( item.raw.discount == 'true' ) {
                                                let formated_price = get_price(price, item.raw.discount, item.raw.discount_amount, 1)
                                                markup += `<span class="price popup-cart-price-${destination}" data-price="${formated_price}">₾ ${formated_price}</span>`
                                            } else {
                                                let formated_price = get_price(price, false, 0, 1)
                                                markup += `<span class="price popup-cart-price-${destination}" data-price="${formated_price}">₾ ${formated_price}</span>`
                                            }
                                        }

                            markup += `</div>`

                            markup += `<div class="right">`
                                if ( item.raw.has_variants == 'true' ) markup += `<button class="remove-this-item cart-action no-reload" data-key="${item.raw.id}" data-action="remove" data-has-variants="true" data-variant-id="${variant_id}"><i class="gray" id="small-times"></button>`
                            markup += `</div>`
                        markup += `</div>`
                    return markup
                }

                function product_table_markup(brand) {
                    return `<div class="product-table ${brand} d-fc mb-5">
                                <div class="top-row product-table-row">
                                    <div class="brand-space">
                                        <div class="brand">${brand}</div>
                                    </div>
                                    <div class="top-section section weight-section">ზომის ერთ</div>
                                    <div class="top-section section price-section">ფასი</div>
                                    <div class="top-section section amount-section w-20">რაოდენობა</div>
                                </div>
                            </div>`
                }

                function product_table_row_markup(item, has_variants, variant_id = null) {
                    if ( has_variants ) {
                        let variant = item.variants[variant_id]
                        let price = 0
                        if ( item.raw.discount == 'true' ) {
                            price = get_price(variant.prices, item.raw.discount, item.raw.discount_amount, 1)
                        } else {
                            price = get_price(variant.prices, false, 0, 1)
                        }
                        return `<div class="product-table-row d-item-${item.raw.id}-${variant_id}">
                                    <div class="section variant justify-content-start px-3">${item.raw.name}</div>
                                    <div class="section weight-section">
                                        <span class="d-flex justify-content-center align-items-center w-50 h-100 border-right">${variant.weights}</span>
                                        <span class="d-flex justify-content-center align-items-center w-50 h-100">${item.raw.measuring}</span>
                                    </div>
                                    <div class="section price-section popup-cart-price-${variant_id}-${item.raw.id}" data-price="${price}">₾ ${price}</div>
                                    <div class="section amount-section mx-0 w-20">
                                        <div 
                                        class="counter market counter-${variant_id}-${item.raw.id} border-0 w-50" 
                                        id="cart-popup-counter-${variant_id}-${item.raw.id}" 
                                        data-sync="counter-${variant_id}-${item.raw.id}"
                                        data-amount="1" 
                                        data-price="${variant.prices}"
                                        data-discount="${item.raw.discount}" 
                                        data-discount-amount="${item.raw.discount_amount}" 
                                        data-has-variants="false" 
                                        data-variant-select="null" 
                                        data-target=".popup-cart-price-${variant_id}-${item.raw.id}" 
                                        data-total=".cart-popup-total" 
                                        data-total-type="popup">
                                            <i class="dark reverse" id="market-arrow"></i>
                                            <input class="counter-input w-100 text-center" type="number" value="1">
                                            <i class="dark" id="market-arrow"></i>
                                        </div>
                                    </div>
                                </div>`
                    } else {
                        let price = 0
                        if ( item.raw.discount == 'true' ) {
                            price = get_price(item.raw.price, item.raw.discount, item.raw.discount_amount, 1)
                        } else {
                            price = get_price(item.raw.price, false, 0, 1)
                        }
                        return `<div class="product-table-row d-item-${item.raw.id}">
                                    <div class="section variant justify-content-start px-3">${item.raw.name}</div>
                                    <div class="section weight-section">${item.raw.measuring}</div>
                                    <div class="section price-section popup-cart-price-${item.raw.id}" data-price="${price}">₾ ${price}</div>
                                    <div class="section amount-section mx-0 w-20">
                                        <div 
                                        class="counter market counter-${item.raw.id} border-0 w-50" 
                                        id="product-table-counter-${item.raw.id}" 
                                        data-sync="counter-${item.raw.id}"
                                        data-amount="1" 
                                        data-price="${item.raw.price}"
                                        data-discount="${item.raw.discount}" 
                                        data-discount-amount="${item.raw.discount_amount}" 
                                        data-has-variants="false" 
                                        data-variant-select="null" 
                                        data-target=".popup-cart-price-${item.raw.id}" 
                                        data-total=".cart-popup-total" 
                                        data-total-type="popup">
                                            <i class="dark reverse" id="market-arrow"></i>
                                            <input class="counter-input w-100 text-center" type="number" value="1">
                                            <i class="dark" id="market-arrow"></i>
                                        </div>
                                    </div>
                                </div>`
                    }
                }

                function cart_notification_markup(alert) {
                    if ( $('.cart-notification').length > 2 ) $('.cart-notification:first-child').remove()
                    let markup = ``
                    let id = generate_random_string(4)

                    markup = `<div class="cart-notification ${alert}" id="${id}">
                                        <div class="lifetime"></div>`

                    switch (alert) {
                        case 'add':
                            markup += `<span class="exclamation"><i class="white" id="checkmark-cart-notification"></i></span>
                                        <span class="text">პროდუქტი დაემატა კალათაში!</span>`
                            break;
                        case 'specify':
                            markup += `<span class="exclamation">!</span>
                                        <span class="text">მიუთითე დამატებითი პარამეტრი!</span>`
                            break;
                        case 'exists':
                            markup += `<span class="exclamation">!</span>
                                        <span class="text">პროდუქტი არსებობს კალათაში!</span>`
                            break;
                    }

                    markup += `<i class="gray" id="times"></i>
                            </div>`

                    $('.navbar-wrapper .cart-notification-wrapper').append(markup)

                    setTimeout(() => {$(`.navbar-wrapper .cart-notification#${id}`).addClass('lifetime')}, 100)
                    setTimeout(() => {$(`.navbar-wrapper .cart-notification#${id}`).remove()}, 4000)
                }
            // * Markup

            $('body').on('click', '.cart-variant-dropdown-toggle', function() {
                $(this).siblings('.cart-variant-dropdown').toggleClass('d-none')
            })

            $('body').on('click', '.cart-action', function() {
                let reload = true

                if ( $(this).hasClass('no-reload') ) reload = false

                if ( $(this).data('action') == 'remove' ) {
                    product_cookie($(this).data('key'), $(this).data('action'), $(this).data('has-variants'), $(this).data('variant-id')).then((response) => {
                        if ( response == 'already-exists' ) cart_notification_markup('exists')
                        if ( reload ) location.reload()
                    })

                    let key = $(this).data('key')
                    let variant_id = null
                    if ( $(this).data('has-variants') ) {
                        variant_id = $(this).data('variant-id')
                        find_product(key).then((response) => {
                            $(`#cart-popup-item-${response.raw.id} .cart-variant-dropdown`).append(`<button class="cart-action no-reload self-delete" type="button" data-key="${response.raw.id}" data-action="add" data-has-variants="${response.raw.has_variants}" data-variant-id="${variant_id}">${response.raw.name} - ${response.variants[variant_id].weights} ${response.raw.measuring}</button>`)
                        })
                    }

                    ( $(this).data('has-variants') ) ? $(`.d-item-${key}-${variant_id}`).remove() : $(`div[class*="d-item-${key}"]`).remove()

                    $('.cart-popup-wrapper .list .item').each(function() {
                        if ( $(this).find('.variant-and-amount').length < 1 ) $(this).remove()
                    })
                    $('#cart-list-view .product-table').each(function() {
                        if ( $(this).find('.product-table-row:not(.top-row)').length < 1 ) $(this).remove()
                    })

                    $('#cart-counter').text(`${$('.cart-popup-wrapper .inner .list .item > .right .variant-and-amount').length} პროდუქტი`)
                    $('#navbar-cart-counter').text($('.cart-popup-wrapper .inner .list .item > .right .variant-and-amount').length)
                    $('.cart-popup-total').text(`₾ ${getTotalPrice('popup')}`)
                } else if ( $(this).data('action') == 'add' ) {
                    find_product($(this).data('key')).then((p_response) => {
                        product_cookie($(this).data('key'), $(this).data('action'), $(this).data('has-variants'), $(this).data('variant-id')).then((c_response) => {
                            if ( c_response == 'already-exists' ) {
                                cart_notification_markup('exists')
                            } else {
                                cart_notification_markup('add')
                                if ( $(`#cart-popup-item-${p_response.raw.id}`).length > 0 ) {
                                    $(`.cart-popup-wrapper .list #cart-popup-item-${p_response.raw.id} > .right`).append(variant_markup(p_response, $(this).data('variant-id')))
                                } else {
                                    $('.cart-popup-wrapper .list').append(product_markup(p_response, $(this).data('variant-id')))
                                }
                                if ( $(`.product-table.${p_response.raw.brand}`).length == 0 ) $('#cart-list-view .product-tables').append(product_table_markup(p_response.raw.brand))
                                $(`.product-table.${p_response.raw.brand}`).append(product_table_row_markup(p_response, $(this).data('has-variants'), $(this).data('variant-id')))

                                $('#cart-counter').text(`${$('.cart-popup-wrapper .inner .list .item > .right .variant-and-amount').length} პროდუქტი`)
                                $('#navbar-cart-counter').text($('.cart-popup-wrapper .inner .list .item > .right .variant-and-amount').length)
                                $('.cart-popup-total').text(`₾ ${getTotalPrice('popup')}`)
                            }
                            if ( reload ) location.reload()
                        })

                    })
                }

                if ( $(this).hasClass('self-delete') ) {
                    if ( $(this).parent('.cart-variant-dropdown') ) $(this).parent('.cart-variant-dropdown').addClass('d-none')
                    $(this).remove()
                }
            })

            $('body').on('click', '.cart-notification #times', function() {
                $(this).parent('.cart-notification').addClass('d-none')
            })
        // * Cart

        // * Favorites
            function favorites(key, variant_index = null) {
                let _key = key
                let _variant_index = variant_index

                return $.ajax({
                    type: 'POST',
                    url: '/market-favorites',
                    data: { key: _key, variant_index : _variant_index },
                })
            }
            $('.favorites-checkbox').change(function() {
                favorites($(this).data('key'), $(this).data('variant-index')).then((e) => {window.location.reload()})
            })
        // * Favorites

        // * Compact
            function market_style(style) {
                let _style = style

                return $.ajax({
                    type: 'POST',
                    url: '/market-style',
                    data: { style: _style },
                })
            }
            $('.market-wrapper #market-compact').click(function() {
                market_style($(this).data('style')).then((e) => {window.location.reload()})
            })
        // * Compact
    // ! Market

    // ! Profile
        function grab_user(index) {
            let _index = index
            return $.ajax({
                type: 'POST',
                url: '/grab-user',
                data: { index: _index },
            })
        }

        function address_general_markup(response) {
            return `<div class="profile-item d-fc">
                            <p class="name">${response.name}</p>
                            <p class="number">${response.number}</p>
                            <p class="address"><strong>${response.city}</strong> / ${response.street}</p>
                            <button type="button" class="remove-this-item"><i class="gray" id="times"></i></button>
                            <button type="button" class="edit-this-item" data-index="${response.index}"><i class="gray" id="market-special-pen"></i></button>
                        </div>`
        }
        
        function address_inputs_markup(fresh = true, response) {
            if ( fresh ) {
                return `<div class="profile-item d-fc h-auto pt-5">
                                <input type="text" name="profile_address_names[]" placeholder="სახელი" required>
                                <input type="number" name="profile_address_numbers[]" placeholder="ნომერი" required>
                                <input type="text" name="profile_address_cities[]" placeholder="ქალაქი" required>
                                <input type="text" name="profile_address_streets[]" placeholder="ქუჩა" required>
                                <button type="button" class="remove-this-item"><i class="gray" id="times"></i></button>
                                <input type="hidden" name="index[]" value="${generate_random_string(32)}">
                            </div>`
            } if ( !fresh) {
                return `<div class="profile-item d-fc h-auto pt-5">
                                <input type="text" name="profile_address_names[]" placeholder="სახელი" required>
                                <input type="number" name="profile_address_numbers[]" placeholder="ნომერი" required>
                                <input type="text" name="profile_address_cities[]" placeholder="ქალაქი" required>
                                <input type="text" name="profile_address_streets[]" placeholder="ქუჩა" required>
                                <button type="button" class="remove-this-item"><i class="gray" id="times"></i></button>
                                <button type="button" class="edit-this-item" data-index="${response.index}"><i class="gray" id="market-special-pen"></i></button>
                                <input type="hidden" name="index[]" value="${response.index}">
                            </div>`
            }
        }

        $('#profile-add-address').click(function() {
            $(this).parents('.s-2').find('.profile-items-wrapper').append(address_inputs_markup())
        })

        $('.profile-items-wrapper').on('click', '.remove-this-item', function() {
            $(this).parent('.profile-item').remove()
        })

        $('.profile-items-wrapper').on('click', '.edit-this-item', function() {
            if ( $(this).hasClass('address') ) {
                if ( $(this).hasClass('general') ) {
                    grab_user($(this).data()).then((response) => {
            
                    })
                }
            }
        })
    // ! Profile

    // ! Navbar Market
        $('div.toggle-market-dropdown').css('height', parseInt($(document).height() - 190))

        $('.toggle-market-dropdown').click(function () {
            $('.link-dropdown.market, .toggle-market-dropdown').toggleClass('active')
        })

        $('.navbar-wrapper .lower .links .link-dropdown.market .dropdown .left div button').click(function() {
            $('.navbar-wrapper .lower .links .link-dropdown.market .dropdown .left div').removeClass('active')
            $('.navbar-wrapper .lower .links .link-dropdown.market .dropdown .right div').removeClass('active')
            $(`.${$(this).data('id')}`).addClass('active')
        })

        $('.toggle-cart-popup').click(function() {
            $('body').toggleClass('overflow-hidden')
            if ( !$('.cart-popup-wrapper').hasClass('hidden') ) {
                $('.cart-popup-wrapper').addClass('hiding')
                setTimeout(() => {
                    $('.cart-popup-wrapper').removeClass('hiding')
                    $('.cart-popup-wrapper').toggleClass('hidden')
                }, 300)
            } else {
                $('.cart-popup-wrapper').toggleClass('hidden')
            }

            if ( $(this).hasClass('list-view') ) $('#cart-list-view').modal('hide')
        })

    // ! Navbar Market

    // ! Vacancies
        if ( $('#refresh-vacancies').length > 0 ) {
            let distance = 3599500
            let x = setInterval(function() {
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                distance = distance - 1000
                    
                if (distance < 0) location.reload()
            }, 1000);
        }

        // <input type="text" placeholder="SMS კოდი" required>
        let card_worker = `<p class="top-text">თქვენ გაქვთ მონიშნული <br> <strong>0 ვაკანსია</strong></p>
                            <input type="text" name="name" value="" placeholder="სახელი" required>
                            <input type="text" name="last_name" value="" placeholder="გვარი" required>
                            <div class="select-wrapper">
                                <select name="amount_of_workers">
                                    <option disabled selected>თანამშრომლების რაოდენობა</option>
                                    <option value="alone">ვმუშაობ მარტო</option>
                                    <option value="small_group">ვმუშაობთ 2-3 კაცი</option>
                                    <option value="group">ვმუშაობთ ჯგუფი</option>
                                </select>
                                <i class="orange" id="nav-arrow"></i>
                            </div>
                            <div class="number-input-wrapper"><input type="number" name="phone_number" value="" placeholder="ტელეფონის ნომერი" required> <div class="icon-wrapper"><i class="white" id="envelope"></i></div></div>
                            <p class="bottom-text">გაგზავნის ღილაკზე დაჭერით ეთანხმებით <br> <a href="#">საიტის წესებს</a></p>
                            <input type="hidden" name="selected_vacancies" value="" required>
                            <input type="hidden" name="type" value="worker" required>
                            <button type="submit" class="bottom-button">გაგზავნა</button>`

        let card_legal = `<p class="top-text">თქვენ გაქვთ მონიშნული <br> <strong>0 ვაკანსია</strong></p>
                            <input type="text" name="company_name" placeholder="კომპანიის დასახელება" required>
                            <input type="text" name="identification_code" placeholder="საიდენტიფიკაციო ნომერი" required>
                            <input type="text" name="legal_entity_name" placeholder="საკონტაქტო პირის სახელი" required>
                            <input type="text" name="shop_address" placeholder="მაღაზიის მისამართი" required>
                            <input type="email" name="mail" placeholder="მეილი" required>
                            <div class="number-input-wrapper"><input type="number" name="phone_number" placeholder="ტელეფონის ნომერი" required> <div class="icon-wrapper"><i class="white" id="envelope"></i></div></div>
                            <p class="bottom-text">გაგზავნის ღილაკზე დაჭერით ეთანხმებით <br> <a href="#">საიტის წესებს</a></p>
                            <input type="hidden" name="selected_vacancies" value="" required>
                            <input type="hidden" name="type" value="legal-entity" required>
                            <button type="submit" class="bottom-button">გაგზავნა</button>`


        $('.vacancies-wrapper .universal-checkbox-wrapper input').change(function() {
            let count = String($('.vacancies-wrapper .universal-checkbox-wrapper input:checked').length)
            let id_array = []
            let id_string = ''

            if ( count > 0 ) {
                $('.vacancies-wrapper .universal-card .bottom-button[type="submit"]').prop('disabled', false)
            } else {
                $('.vacancies-wrapper .universal-card .bottom-button[type="submit"]').prop('disabled', true)
            }

            $('.universal-card .top-text strong').text(`${count} ვაკანსია`)

            $('.vacancies-wrapper .universal-checkbox-wrapper input:checked').each(function() {
                id_array.push($(this).val())
            })

            id_string = id_array.join('-')

            $('input[name="selected_vacancies"]').val(id_string)
        })

        $('.vacancies-wrapper .category-buttons button').click(function() {
            if ( $('.vacancies-wrapper .category-buttons button[data-group="legal-entity"].active').length > 0 || $(this).data('group') == 'legal-entity' ) {
                $('.vacancies-wrapper .universal-checkbox-wrapper input:checked').prop('checked', false).change()
                $('.universal-card').data('type', 'legal')
                $('.universal-card').html(card_legal)
            }

            if ( $(this).data('group') != 'legal-entity' ) {
                if ( $('.universal-card').data('type') != 'worker' ) {
                    $('.universal-card').data('type', 'worker')
                    $('.universal-card').html(card_worker)
                }
            }

            $(this).siblings().removeClass('active')
            $(this).addClass('active')
            $('.vacancies-wrapper .bottom .left').addClass('d-none')
            $(`.vacancies-wrapper .bottom .left#${$(this).data('group')}`).removeClass('d-none')

            if ( $('.add-category').length > 0 ) {
                $('.add-category').data('belongs', $(this).data('group'))
            }
        })
    // ! Vacancies

    // ! Mobile Market
        $('.toggle-mobile-market').click(function() {
            $('.market-wrapper').addClass('d-none')
            $(`.market-wrapper${$(this).data('target')}`).removeClass('d-none')
        })

        // * Change Page with Select
            $('select#change-page').change(function() {
                window.location.href = `${window.location.protocol}//${window.location.hostname}/${$(this).val()}`
            })
        // * Change Page with Select
    // ! Mobile Market

    // ! Mobile Navbar
        $('.toggle-mobile-navbar-general').click(function() {
            $('.mobile-navigation-wrapper#general').toggleClass('d-none')
        })
        $('.toggle-mobile-navbar-market').click(function() {
            $('.mobile-navigation-wrapper#market').toggleClass('d-none')
        })

        $('.toggle-mobile-search#mobile-market-magnifying-glass').click(function() {
            let target = $(this).siblings('form')
            target.hasClass('d-flex') ? target.removeClass('d-flex') : target.addClass('d-flex')
        })
    // ! Mobile Navbar

    // ! Smooth Scroll
        $('*[data-scroll-to]').click(function() {
            if ( $(this).data('scroll-to') ) {
                window.scroll({
                    top: $($(this).data('scroll-to')).offset().top,
                    left: 0,
                    behavior: 'smooth'
                })
            }
        })
    // ! Smooth Scroll

    // ! Static Sliders
        $("#homepage-slider").owlCarousel({
            items: 1,
            lazyLoad: true,
            rewind: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            dots: true,
            nav: true
        })

        $(".projects-slider-outer").owlCarousel({
            lazyLoad: true,
            rewind: true,
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            dots: false,
            nav: false,
            autoWidth:true,
            responsive: {
                900: {
                    items: 4,
                    margin: 16
                },
                1920: {
                    items: 4,
                    margin: 26
                }
            }
        })

        $(".projects-slider-outer-reverse").owlCarousel({
            // rtl: true,
            lazyLoad: true,
            rewind: true,
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            dots: false,
            nav: false,
            autoWidth:true,
            responsive: {
                900: {
                    items: 4,
                    margin: 16
                },
                1920: {
                    items: 4,
                    margin: 26
                }
            }
        })

        $("#p-s-c-t").owlCarousel({
            items: 5,
            lazyLoad: true,
            rewind: true,
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            dots: false,
            nav: false,
            autoWidth:true,
            margin: 20
        })

        $("#p-s-c-b").owlCarousel({
            items: 5,
            rtl: true,
            lazyLoad: true,
            rewind: true,
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            dots: false,
            nav: false,
            autoWidth:true,
            margin: 20
        })

        $("#partners-slider").owlCarousel({
            lazyLoad: true,
            rewind: true,
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            dots: false,
            nav: false,
            responsive: {
                375: {
                    items: 3,
                    margin: 10
                },
                900: {
                    items: 5,
                    margin: 20
                }
            }
        })
    // ! Static Sliders

    // ! Service Modal Stages
        $('.modal-service .user-service-stage-toggle').click(function() {
            $(this).addClass('active')
            $(this).siblings('button').removeClass('active')
            $(this).parents('.title').siblings('.list').find('.item').addClass('d-none')
            $(this).parents('.title').siblings('.list').find(`.${$(this).data('target')}`).removeClass('d-none')
        })
    // ! Service Modal Stages

    // ! Remove Alerts
        if ( $('.alert').length > 0 ) {
            setTimeout(() => {
                $('.alert').addClass('hide')
            }, 1500)

            setTimeout(() => {
                $('.alert').remove()
            }, 2000)
        }
    // ! Remove Alerts

    // ! General Functions
        function generate_random_string(length) {
            let result = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
    // ! General Functions
})