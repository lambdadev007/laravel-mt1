$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).ready(function(){
    //* Initial Load
        Waves.init()
        Waves.attach('.waves-button')

        // $('.text-editor').summernote({
        //     height: 300,
        //     fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Dejavu Sansbook', 'Dejavu Sansbold', 'BPG Nino Medium Capsregular', 'Nunito Regular', 'Nunito Bold', 'Nunito Black'],
        //     onPaste: function (e) {
        //         let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text')
        //         e.preventDefault()
        //         document.execCommand('insertText', false, bufferText)
        //     }
        // })

        $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 7000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
        })
    //* Initial Load

    //* Navbar Checkbox Ajax
        $('#admin-nav-checkbox').change(function() {
            $('.admin-panel-sidebar').toggleClass('active')

            // if ( $(this).prop('checked') ) {
            //     $.ajax({
            //         type: 'POST',
            //         url: '/ajax-admin-navbar',
            //         data: { checked : 'true' }
            //     })
            // } else {
            //     $.ajax({
            //         type: 'POST',
            //         url: '/ajax-admin-navbar',
            //         data: { checked: 'false' }
            //     })
            // }
        })

        $('.admin-content-darkener').click(function () {
            $('#admin-nav-checkbox').prop('checked') ? $('#admin-nav-checkbox').prop('checked', false).change() : $('#admin-nav-checkbox').prop('checked', true).change()
        })

        $('.admin-nav-toggle-right-section').click(function () {
            $('.admin-panel-navbar').toggleClass('show-right-section')
        })
    //* Navbar Checkbox Ajax
    
    $('.check-for-action-checkbox').change(function(){

        let idArray = []
        let idString = ''

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
            idArray.push($(this).data('id'))
        })

        idString = idArray.join('-')

        $('input[name="id_string"]').attr('value', idString)

    })

    //* Filereader
        $(document).on('change', '.ajax-input', function (e) {
            var $input = $(this);
            let inputFiles = this.files
            if (inputFiles == undefined || inputFiles.length == 0) return
            let inputFile = inputFiles[0]

            let reader = new FileReader()
            reader.onload = function (event) {
                $input.siblings('.ajax-image').attr("src", event.target.result)
            }
            reader.onerror = function (event) {
                alert("I AM ERROR: " + event.target.error.code)
            }
            reader.readAsDataURL(inputFile)
        })
    //* Filereader

    //* Admins
        $('.form-checks .form-check input[type="checkbox"]').change(function () {
            if ($(this).prop('checked') != true) {
                $(this).attr('value', 'false')
            } else {
                $(this).attr('value', 'true')
            }
        })
    //* Admins

    //* ContentEditable
        $(document).on('keyup', '*[contenteditable="true"]', function(e){
            if ($(this).data('text-to-value')) {
                $($(this).data('text-to-value')).val($(this).text())
            }

            if ($(this).data('text-to-text')) {
                $($(this).data('text-to-text')).text($(this).text())
            }

            if ($(this).data('value-to-text')) {
                $($(this).data('value-to-text')).text($(this).val())
            }

            if ($(this).data('numbers-only')) {
                if (isNaN(String.fromCharCode(e.which))) alert('გთხოვთ მხოლოდ რიცხვები გამოიყენოთ')
            }
        })
    //* ContentEditable

    //* Project Hiding
        $('input[data-project-hide]').change(function () {
            let wordArray = []
            let wordString = ''

            if ( $(this).prop('checked') ) {
                $(this).siblings('span').addClass('active')
                $(this).siblings('span').html('გამოჩენა')
            } else {
                $(this).siblings('span').removeClass('active')
                $(this).siblings('span').html('დამალვა')
            }

            $('input[data-project-hide]:checked').each(function () {
                wordArray.push($(this).data('project-hide'))
            })

            wordString = wordArray.join('-')

            $('input[name="hidden_fields"]').attr('value', wordString)
        })
    //* Project Hiding

    //* Cut-Text
        $(document).ready(function() {
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
        })
    //* Cut-Text

    //* Create Random String
        function generateRandomString(length) {
            let result = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        $('.string-generator').click(function() {
            let string = generateRandomString(12)
            $('#generate-here').val(string)
            $('#generate-here').text(string)
        })
    //* Create Random String
})