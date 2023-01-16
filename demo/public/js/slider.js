$(document).ready(function () {
    $('.index-slider-links-wrapper a').mouseover(function (e) {
        if ($(this).data("slide") === 'market')       slideTo(0)
        if ($(this).data("slide") === 'consultation') slideTo(1)
        if ($(this).data("slide") === 'design')       slideTo(2)
        if ($(this).data("slide") === 'repairs')      slideTo(3)
        if ($(this).data("slide") === 'furniture')    slideTo(4)
        if ($(this).data("slide") === 'master')       slideTo(5)
        if ($(this).data("slide") === 'cleaning')     slideTo(6)
    })

    function slideTo(slideArg) {
        data = 'market'

        if (slideArg === 0) { data = 'market' }
        else if (slideArg === 1) { data = 'consultation' }
        else if (slideArg === 2) { data = 'design' }
        else if (slideArg === 3) { data = 'repairs' }
        else if (slideArg === 4) { data = 'furniture' }
        else if (slideArg === 5) { data = 'master' }
        else if (slideArg === 6) { data = 'cleaning' }

        $('.index-slider-icon-wrapper').removeClass('active')
        $('.index-slider-slide-title').removeClass('active')
        $(`.index-slider-links-wrapper a[data-slide=${data}] .index-slider-icon-wrapper`).addClass('active')
        $(`.index-slider-links-wrapper a[data-slide=${data}] .index-slider-slide-title`).addClass('active')
        slide = slideArg
    }

    $('.index-slider-links-wrapper a').mouseout(function() {
        $('.index-slider-icon-wrapper').removeClass('active')
        $('.index-slider-slide-title').removeClass('active')
    })
})