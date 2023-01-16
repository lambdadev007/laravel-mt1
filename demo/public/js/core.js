$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).ready(function () {
    let locale = $('html').attr('lang')

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    // ! Get Content Category
        $('.category-selector button').click(function() {
            let page_ = $(this).data('page')
            let category_ = $(this).data('category')

            $.ajax({
                type: 'POST',
                url: '/ajax-get-category',
                data: { page: page_, category: category_},
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Error')
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
                },
                success: function (data, status, jqXHR) {
                    // console.log(data)
                    // console.log('status:' + status + '; jqXHR:' + jqXHR)

                    location.reload()
                }
            })
        })
    // ! Get Content Category

    // ! Cart Ajax
        let total_price = parseInt($('.services-wrapper .service-prices .service-total .service-price').data('total-price'))

        
        if ( locale == 'ka' ) {
            $('.services-wrapper .services .service-right input[type="checkbox"]:checked').siblings('.split-button').find('span:not([class])').text('დამატებულია')
        } else if ( locale == 'en' ) {
            $('.services-wrapper .services .service-right input[type="checkbox"]:checked').siblings('.split-button').find('span:not([class])').text('Added')
        }

        function insertServicePriceBox(id, visible_name, price) {
            return `<div class="service-price-box" data-id="${id}">
                        <span class="dire-close"></span>
                        <span>${visible_name}</span>
                        <span class="service-price">${price} <span class="dire-lari"></span></span>
                        <input type="hidden" name="service_ids[]" value="${id}">
                    </div>`
        }

        $('.services-wrapper .services .service-right input[type="checkbox"]').change(function() {
            total_price = parseInt($('.services-wrapper .service-prices .service-total .service-price').data('total-price'))

            if ( $(this).prop('checked') ) {
                if ( locale == 'ka' ) {
                    $(this).siblings('.split-button').find('span:not([class])').text('დამატებულია')
                } else if ( locale == 'en' ) {
                    $(this).siblings('.split-button').find('span:not([class])').text('Added')
                }
                $('.service-prices .service-price-box-wrapper').append(insertServicePriceBox($(this).data('id'), $(this).data('visible-name'), $(this).data('price')))

                total_price = total_price + parseInt($(this).data('price'))
                $('.service-prices .service-total .service-price').data('total-price', total_price)
                $('.service-prices .service-total input[name="total_price"]').val(total_price)
                $('.service-prices .service-total .service-price').html(total_price + '<span class="dire-lari"></span>')

                $.ajax({
                    type: 'POST',
                    url: '/ajax-add-cart',
                    data: { id: $(this).data('id'), price: $(this).data('price'), visible_name: $(this).data('visible-name'), category: $(this).data('category'), total_price: total_price },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert('Error')
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
                    }
                })

            } else {
                let id = $(this).data('id')

                if ( locale == 'ka' ) {
                    $(this).siblings('.split-button').find('span:not([class])').text('დამატება')
                } else if ( locale == 'en' ) {
                    $(this).siblings('.split-button').find('span:not([class])').text('Add')
                }
                $(`.service-prices .service-price-box-wrapper .service-price-box[data-id="${id}"]`).remove()

                total_price = total_price - parseInt($(this).data('price'))
                $('.service-prices .service-total .service-price').data('total-price', total_price)
                $('.service-prices .service-total input[name="total_price"]').val(total_price)
                $('.service-prices .service-total .service-price').html(total_price + '<span class="dire-lari"></span>')

                $.ajax({
                    type: 'POST',
                    url: '/ajax-remove-cart',
                    data: { id: $(this).data('id'), category: $(this).data('category'), total_price: total_price },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert('Error')
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
                    }
                })
            }

            $('.services-wrapper .service-prices .service-prices-header').addClass('added')
            setTimeout(function () { $('.services-wrapper .service-prices .service-prices-header').removeClass('added') } , 220)
        })

        $('.service-prices .service-price-box-wrapper').on('click', '.service-price-box .dire-close', function(){
            let id = $(this).parent('.service-price-box').data('id')
            
            $(`.services-wrapper .services .service-right input[data-id="${id}"]`).prop('checked', false).change()
            $(this).parent('.service-price-box').remove()
        })
    // ! Cart Ajax

    // ! Search
        $('input.search').focusout(function() {
            if ( !$(this).parent().siblings('.search-popup').is(':hover') ) {
                $(this).parent().siblings('.search-popup').removeClass('active')
            }
        })

        $('input.search').keyup(function() {
            let selector = `.search-popup.${$(this).data('search')}`
            $(selector).addClass('active')
            $(selector).children('a').remove()
            let keyword = $(this).val()

            $.ajax({
                type: 'POST',
                url: '/ajax-search',
                data: { keyword_: keyword },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Error')
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
                },
                success: function (data, status, jqXHR) {
                    // console.log(data)
                    // console.log('status:' + status + '; jqXHR:' + jqXHR)

                    $('.search-popup').children('a').remove()
                    let array = Object.values(data)
                    
                    array.forEach (e => {
                        let title = e.title
                        let tooltip = ''
                        if (e.title.length > 55) {
                            title = e.title.substring(0, 55) + '...'
                            tooltip = `title="${e.title}"`
                        }
                        let link = `<a href="${e.link}" ${tooltip}>${title}</a>`
                        $('.search-popup').append(link)
                    })

                    $('[data-toggle="tooltip"]').tooltip()
                }
            })
        })
    // ! Search

    // ! Vacancies
        function checkbox_check() {
            if ($('.checkbox-item input:checked').length > 0) {
                $('.vacancies-right-segment button[type="submit"]').prop('disabled', false)
                $('.vacancies-right-segment button[type="submit"]').removeClass('disabled')
            } else {
                $('.vacancies-right-segment button[type="submit"]').prop('disabled', true)
                $('.vacancies-right-segment button[type="submit"]').addClass('disabled')
            }
        }

        $('.checkbox-item input').change(function () {
            checkbox_check()
        })

        $('.checkbox-item.select-all').click(function () {
            $(this).siblings('.checkbox-item').children('input').prop('checked', true)
            checkbox_check()
        })
    // ! Vacancies

    // ! Navbar Scroll
        if ( $('.container-fluid.static-navbar-wrapper').length > 0 ) {
            function scrollFunction() {
                if (window.pageYOffset >= $('.container-fluid.static-navbar-wrapper').offset().top + 150) {
                    $('.container-fluid.fixed-navbar-wrapper').addClass('active')
                    $('.container-fluid.fixed-navbar-wrapper').attr('aria-hidden', false)
                    $('.static-navbar-wrapper .show').removeClass('show')
                    $('.static-navbar-wrapper .show').attr('aria-hidden', true)
                } else {
                    $('.container-fluid.fixed-navbar-wrapper').removeClass('active')
                    $('.container-fluid.fixed-navbar-wrapper').attr('aria-hidden', true)
                    $('.fixed-navbar-wrapper .show').removeClass('show')
                    $('.fixed-navbar-wrapper .show').attr('aria-hidden', false)
                }
            }

            $(window).scroll(function () {
                scrollFunction()
            })

            scrollFunction()
        }
    // ! Navbar Scroll

    // ! Number validator
        $(document).on('keyup', '.validate-number', function() {
            let value = $(this).val()
            
            if ( value.length > 9 ) {
                $(this).addClass('border-danger')
                $(this).attr('data-original-title', 'ნომერი უნდა იყოს ქართული რეგიონის (+995-ს ჩაწერა არ არის საჭირო) და 9 ციფრი')
                $(this).tooltip('show')
            } else {
                $(this).removeClass('border-danger')
                $(this).removeAttr('data-original-title')
            }
        })
    // ! Number validator

    // ! Dropdowns
        $('.navbar-hover-dropdown-wrapper').mouseover(function () {
            let id = $(this).children('[data-dropdown="hover"]').attr('id')

            $(this).children('[data-dropdown="hover"]').attr('aria-expanded', 'true')
            $(this).children(`[aria-labelledby="${id}"]`).addClass('show')
        })

        $('.navbar-hover-dropdown-wrapper').mouseout(function () {
            let id = $(this).children('[data-dropdown="hover"]').attr('id')

            $(this).children('[data-dropdown="hover"]').attr('aria-expanded', 'false')
            $(this).children(`[aria-labelledby="${id}"]`).removeClass('show')
        })

        $('[data-dropdown="click"]').click(function () {
            if ($(this).siblings().hasClass('show') == false) {
                $('[data-dropdown="click"]').attr('aria-expanded', 'false')
                $(this).attr('aria-expanded', 'true')

                $('.static-navbar-wrapper .show, .fixed-navbar-wrapper .show').removeClass('show')
                $(`[aria-labelledby="${$(this).attr('id')}"]`).addClass('show')
            } else {
                $(`[aria-labelledby="${$(this).attr('id')}"]`).removeClass('show')
                $(this).attr('aria-expanded', 'false')
            }
        })

        // ! Market Dropdown
            $('.dropdown-market-wrapper .categories ul li').mouseover(function () {
                $('.dropdown-market-wrapper .categories ul li').removeClass('active')
                $(this).addClass('active')

                $(`.dropdown-market-wrapper .sub-categories ul li[aria-labelledby]`).removeClass('active')
                $(`.dropdown-market-wrapper .sub-categories ul li[aria-labelledby="${$(this).attr('id')}"]`).addClass('active')
            })
        // ! Market Dropdown
    // ! Dropdowns

    // ! Cookies Agreement
        $('.cookies-popup-wrapper .cookies-popup-buttons > button').click(function() {
            $.ajax({
                type: 'POST',
                url: '/ajax-cookies-agreement',
                data: { cookies_agreement: 'true' },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
                }
            })

            $(this).parents('.cookies-popup-wrapper').remove()
        })
    // ! Cookies Agreement

    // ! Validate Number Ajax
        $('.envelope').click(function() {
            let selector = $(this).data('number')
            let number_ = $(selector).val()
            
            $.ajax({
                type: 'POST',
                url: '/ajax-validate-number',
                data: { number: number_ },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Error')
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText)
                },
                success: function ( data ) {
                    if ( data == 'Failure' ) {
                        $(selector).attr('data-original-title', 'ნომერი უნდა იყოს ქართული რეგიონის (+995-ს ჩაწერა არ არის საჭირო) და 9 ციფრი')
                        $(selector).tooltip('show')
                    }
                }
            })
        })
    // ! Validate Number Ajax
    
    // ! Text Cutter
        $('.cut-text').each(function() {
            if ( $(this).text().length > 40 ) {
                $(this).text($(this).text().substring(0,40) + '...')
            }
        })
    // ! Text Cutter

    // ! Burger
        $('.burger-wrapper').click(function(){
            $(this).toggleClass('active')
            $('.mobile-navbar-body').toggleClass('show')
        })
    // ! Burger

    // ! Special Offers
        $('.offer-card-wrapper').mouseover(function(){
            $(this).addClass('hovered')
        })

        $('.offer-card-wrapper').mouseout(function(){
            $(this).removeClass('hovered')
        })
    // ! Special Offers

    // ! Products
        $('.our-production .categories li').click(function(){
            let id = $(this).attr('id')
            
            $(this).siblings().removeClass('active')
            $(this).addClass('active')

            $('.content-segment').removeClass('show')
            $('.content-segment').attr('aria-hidden', 'true')
            $(`[aria-labelledby="${id}"]`).addClass('show')
            $(`[aria-labelledby="${id}"]`).attr('aria-hidden', 'false')
        })

        $('.our-product').mouseover(function(){
            $(this).addClass('hovered')
        })

        $('.our-product').mouseout(function(){
            $(this).removeClass('hovered')
        })
    // ! Products

    // ! Quantity Button
        $('.product-quantity .decrease').click(function(){
            $(this).siblings('input').val(function(index, value){
                if (value != 0) {
                    return --value
                } else {
                    return value = 0
                }
            })
        })

        $('.product-quantity .increase').click(function(){
            $(this).siblings('input').val(function(index, value){
                return ++value
            })
        })
    // ! Quantity Button

    // ! Proficiency Selectors
        $('.info-box-checker input[type="checkbox"]').change(function(){
            if ( $(this).prop('checked') ) {
                $(this).closest('.info-box').find('.metrix-selector-wrapper').removeClass('disabled')
                $(this).closest('.info-box').find('.metrix-selector-wrapper select').prop('disabled', false)
            } else {
                $(this).closest('.info-box').find('.metrix-selector-wrapper').addClass('disabled')
                $(this).closest('.info-box').find('.metrix-selector-wrapper select').prop('disabled', true)
            }

            if ( $('.info-box-checker input[type="checkbox"]:checked').length > 0 ) {
                $('.vacancies-right-segment > button[type="submit"]').prop('disabled', false)
                $('.vacancies-right-segment > button[type="submit"]').removeClass('disabled')
            } else {
                $('.vacancies-right-segment > button[type="submit"]').prop('disabled', true)
                $('.vacancies-right-segment > button[type="submit"]').addClass('disabled')
            }
        })
    // ! Proficiency Selectors

    // ! Consultation and VIP Master Cart Button Disabler
        $('.services-wrapper .service-right input[type="checkbox"]').change(function() {
            if ( $('.services-wrapper .services .service-right input[type="checkbox"]:checked').length > 0 ) {
                $('.services-wrapper .service-prices button[data-target="#service-modal"]').prop('disabled', false)
                $('.services-wrapper .service-prices button[data-target="#service-modal"]').removeClass('disabled')
            } else {
                $('.services-wrapper .service-prices button[data-target="#service-modal"]').prop('disabled', true)
                $('.services-wrapper .service-prices button[data-target="#service-modal"]').addClass('disabled')
            }
        })
    // ! Consultation and VIP Master Cart Button Disabler

    // ! Scroll Button
        $('*[data-scroll-to]').click(function() {
            if ( $(this).data('scroll-to') ) {
                window.scroll({
                    top: document.querySelector($(this).data('scroll-to')).offsetTop - 100,
                    left: 0,
                    behavior: 'smooth'
                })
            }
        })
    // ! Scroll Button

    // ! Design Information Div Height
        $('.design-information:not(".admin") ul.category-selector li').each(function(){
            $(this).css('height', $(this).children('span').outerHeight().toString())
        })

        $(window).resize(function() {
            $('.design-information:not(".admin") ul.category-selector li').each(function () {
                $(this).css('height', $(this).children('span').outerHeight().toString())
            })
        })
    // ! Design Information Div Height
})