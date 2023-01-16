$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).ready(function(){
    // ! Initial Load
        Waves.init()
        Waves.attach('.waves-button')

        $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
        })
    // ! Initial Load

    // ! Countdown
        // if ( $('#countdown').length > 0 ) {
        //     let distance = 431999000
        //     let x = setInterval(function() {
        //         let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //         let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        //         let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        //         distance = distance - 1000
                    
        //         if ( $('#countdown').hasClass('vacancies') ) {
        //             $('#countdown').html(`${hours}:${minutes}:${seconds}`)
        //         } else {
        //             $('#countdown').html(`სესია მოკვდება ${hours}:${minutes}:${seconds} საათში`)
        //         }
                    
        //         if (distance < 0) {
        //             clearInterval(x);
        //             alert('სესია ამოიწურა გთხოვთ გვერდი დაარეფრეშოთ');
        //         }
        //     }, 1000);
        // }
    // ! Countdown

    // ! Navbar Checkbox
        $('#admin-nav-checkbox').change(function() {
            $('.admin-panel-sidebar').toggleClass('active')
        })

        $('.admin-content-darkener').click(function () {
            $('#admin-nav-checkbox').prop('checked') ? $('#admin-nav-checkbox').prop('checked', false).change() : $('#admin-nav-checkbox').prop('checked', true).change()
        })

        $('.admin-nav-toggle-right-section').click(function () {
            $('.admin-panel-navbar').toggleClass('show-right-section')
        })
    // ! Navbar Checkbox

    // ! Generate Deletion id's
        $('.check-for-action-checkbox').change(function(){
            let id_array = []
            let id_string = ''

            if ( $(this).prop('checked') ) {
                $(this).siblings('.check-for-action-label').addClass('active')
                $(this).siblings('.check-for-action-label').html('მონიშნულია')
            } else {
                $(this).siblings('.check-for-action-label').removeClass('active')
                $(this).siblings('.check-for-action-label').html('მონიშვნა')
            }

            if ( $('.check-for-action-checkbox:checked').length >= 1 ) {
                $('.action-modal-caller button').prop('disabled', false)
            } else {
                $('.action-modal-caller button').prop('disabled', true)
            }

            $('.check-for-action-checkbox:checked').each(function(){
                id_array.push($(this).data('id'))
            })

            id_string = id_array.join('-')

            $('input[name="id_string"]').val(id_string)
        })
    // ! Generate Deletion id's

    // ! Filereader
        $('body').on('change', '.image-input', function (e) {
            var $input = $(this)
            let inputFiles = this.files
            if (inputFiles == undefined || inputFiles.length == 0) return
            let inputFile = inputFiles[0]

            let reader = new FileReader()
            reader.onload = function (event) {
                $input.siblings('.image-loader').attr("src", event.target.result)
            }
            reader.onerror = function (event) {
                alert("I AM ERROR: " + event.target.error.code)
            }
            reader.readAsDataURL(inputFile)
        })
    // ! Filereader

    // ! Admins
        $('.form-checks .form-check input[type="checkbox"]').change(function () {
            if ($(this).prop('checked') != true) {
                $(this).attr('value', 'false')
            } else {
                $(this).attr('value', 'true')
            }
        })
    // ! Admins

    // ! ContentEditable
        $('body').on('focus blur click keyup paste', '*[contenteditable="true"]', function(e){
            e.stopPropagation()

            if ($(this).data('text-to-value')) {
                $($(this).data('text-to-value')).val($(this).text())
            }

            if ($(this).data('text-to-text')) {
                $($(this).data('text-to-text')).text($(this).text())
            }

            if ($(this).data('value-to-text')) {
                $($(this).data('value-to-text')).text($(this).val())
            }

            if ($(this).data('html-to-value')) {
                $($(this).data('html-to-value')).val($(this).html())
            }

            if ($(this).data('numbers-only')) {
                if (isNaN(String.fromCharCode(e.which))) alert('გთხოვთ მხოლოდ რიცხვები გამოიყენოთ')
            }
        })
    // ! ContentEditable

    // ! Cut-Text
        if ( $(window).width() < 977 ) {
            $('.cut-text-lg').each(function() {
                if ($(this).text().length > 35) {
                    $(this).text($(this).text().substring(0,35) + '...')
                }
            })
            $('.cut-text').each(function() {
                if ( $(this).text().length > 15 ) {
                    $(this).text($(this).text().substring(0,15) + '...')
                }
            })
        }

        $('.cut-article-description').each(function() {
            if ( $(this).text().length > 40 ) {
                $(this).text($(this).text().substring(0,40) + '...')
            }
        })

        $('.log span.action').each(function() {
            if ( $(this).text().length > 30 ) {
                $(this).text($(this).text().substring(0,30) + '...')
            }
        })
    // ! Cut-Text

    // ! Create Random String
        function generate_random_string(length) {
            let result = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        $('.string-generator').click(function() {
            let string = generate_random_string(12)
            $('#generate-here').val(string)
            $('#generate-here').text(string)
        })
    // ! Create Random String

    // ! Alert Missing Input
        $('button[type="submit"]').click(function() {
            let length = 0
            $('input[type="file"][required]').each(function() {
                if ( !$(this).val() ) {
                    if ( $(this).data('special-alert') ) alert($(this).data('special-alert'))
                    length++
                }
            })
            // alert(`თქვენ გაქვთ ${length} სურათი აუტვირთელი`)
        })
    // ! Alert Missing Input

    // ! S-Collapse
        $('button.s-collapse').click(function() {
            $(this).toggleClass('active')
            $($(this).data('target')).toggleClass('show')
        })
    // ! S-Collapse

    // ! Letter Counter
        $('input[maxlength], textarea[maxlength]').each(function() {
            $(this).siblings('.letter-counter').text(`${$(this).val().length}/${$(this).attr('maxlength')}`)
            $(this).on('focus blur click keyup paste', function() {
                $(this).siblings('.letter-counter').text(`${$(this).val().length}/${$(this).attr('maxlength')}`)
            })
        })
    // ! Letter Counter

})