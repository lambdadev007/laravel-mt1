<script type="text/javascript">
    $(document).ready(function() {
        function generate_random_string(length) {
            let result = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        // Services
            let index = parseInt($('.universal-card').length + 1)

            function card_markup(index) {
                return `<div class="universal-card d-fc service">
                            <span class="remove-this-item" data-target="#card-modal-${index}">&times</span>
                            <h3 contenteditable="true" data-text-to-value="#card-title-${index}">დააჭირეთ რომ შეცვალოთ</h3>
                            <p class="price">₾<strong contenteditable="true" data-text-to-value="#card-price-${index}">136</strong> <span>m2</span></p>
                            <p class="description" contenteditable="true" data-text-to-value="#card-description-${index}">შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს, რეალურთან მაქსიმალურად მიახლოებული შაბლონი წარუდგინონ.</p>
                            <button type="button" class="bottom-button" data-toggle="modal" data-target="#card-modal-${index}">დაწვრილებით</button>

                            <input type="hidden" name="amount_of_cards[]" value="null">
                            <input type="hidden" id="card-title-${index}" name="card_titles[]" value="დააჭირეთ რომ შეცვალოთ">
                            <input type="hidden" id="card-price-${index}" name="card_prices[]" value="136">
                            <input type="hidden" id="card-description-${index}" name="card_descriptions[]" value="შემთხვევითად გენერირებული ტექსტი ეხმარება დიზაინერებს და ტიპოგრაფიული ნაწარმის შემქმნელებს, რეალურთან მაქსიმალურად მიახლოებული შაბლონი წარუდგინონ.">
                        </div>`
            }

            function modal_markup(index) {
                let modal_id = generate_random_string(16)
                return `<div class="modal fade modal-background" id="card-modal-${index}" tabindex="-1" role="dialog" aria-labelledby="card-modal-${index}-label" aria-hidden="true">
                            <div class="modal-dialog modal-custom modal-service modal-1160 modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="top-misc">
                                        <h3 class="modal-title">პაკეტის შესახებ</h3>
                                        <span class="close-modal" data-dismiss="modal">&times</span>
                                    </div>

                                    <div class="universal-banner-wrapper">
                                        <label class="image-reader-wrapper d-fc" for="modal-${index}">
                                            <div class="image-wrapper">
                                                <img class="image-loader" src="{{ asset('images/admin/upload-1160-290.jpg') }}">
                                                <div class="background-layer"></div>
                                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="modal_banners[]" id="modal-${index}" data-special-alert="გთხოვთ ატვირთეთ პაკეტის პოპაპის ბანერი" required>
                                            </div>
                                            <input type="text" class="form-control text-center" name="modal_banner_alts[]" placeholder="სურათის alt ინფორმაცია" required>
                                        </label>
                                        <div class="text-wrapper">
                                            <h2 contenteditable="true" data-text-to-value="#modal-title-${index}">პაკეტის სახელი</h2>
                                            <p contenteditable="true" data-text-to-value="#modal-description-${index}">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
                                        </div>
                                    </div>

                                    <p class="information container-1000" contenteditable="true" data-html-to-value="#modal-information-${index}">დააჭირეთ რედაქტირება რომ დაიწყოთ</p>

                                    <div class="lists d-fc container-1000">
                                        <button type="button" class="universal-button add-modal-list w-100 mb-3" data-has-stages="false" data-modal-id="${modal_id}">ჩამონათვალის დამატება</button>
                                        <button type="button" class="universal-button add-modal-list w-100 mb-3" data-has-stages="true" data-modal-id="${modal_id}">ჩამონათვალის დამატება ეტაპებით</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="modal_has[]" value="${modal_id}">
                            <input type="hidden" id="modal-title-${index}" name="modal_titles[]" value="პაკეტის სახელი">
                            <input type="hidden" id="modal-description-${index}" name="modal_descriptions[]" value="დააჭირეთ ტექსტი რომ შეცვალოთ">
                            <input type="hidden" id="modal-information-${index}" name="modal_informations[]" value="დააჭირეთ რედაქტირება რომ დაიწყოთ">
                        </div>`
            }

            function modal_list_markup(modal_id, stages) {
                let list_id = generate_random_string(12)
                let markup = ''
                if ( !stages ) {
                    markup = `<div class="list-wrapper d-fc w-100">
                                <span class="remove-this-item">&times</span>
                                <div class="title">
                                    <h3 contenteditable="true" data-text-to-value="#list-titles-${list_id}">დააჭირეთ ტექსტი რომ შეცვალოთ</h3>
                                </div>
                                <div class="list d-fc">
                                    <div class="d-flex mb-3">
                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="${list_id}" data-type="double" data-stage="false" data-stage-id="null">ტექსტი</button>
                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="${list_id}" data-type="red" data-stage="false" data-stage-id="null"><i class="red" id="times"></i></button>
                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="${list_id}" data-type="green" data-stage="false" data-stage-id="null"><span><i class="green" id="checkmark"></i></span></button>
                                    </div>
                                </div>
                                <input type="hidden" name="amount_of_lists[]" value="null" required>
                                <input type="hidden" id="list-titles-${list_id}" name="list_titles[]" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required>
                                <input type="hidden" name="list_has[]" value="${list_id}" required>
                                <input type="hidden" name="list_belongs[]" value="${modal_id}" required>
                                <input type="hidden" name="list_has_stages[]" value="false" required>
                            </div>`
                } else if ( stages ) {
                    let stage_id = generate_random_string(12)
                    markup = `<div class="list-wrapper d-fc w-100">
                                <span class="remove-this-item">&times</span>
                                <div class="title">
                                    <h3 contenteditable="true" data-text-to-value="#list-titles-${list_id}">დააჭირეთ ტექსტი რომ შეცვალოთ</h3>
                                </div>
                                <div class="list-stages d-fc mb-3">
                                    <button type="button" class="universal-button add-modal-stage w-100 mb-3" data-list-id="${list_id}">ეტაპის დამატება</button>
                                    <div class="stage-wrapper d-flex mb-3 ${stage_id}">
                                        <input type="text" class="pl-1 mr-3" name="stage_names[]" value="" placeholder="ეტაპის სახელი" required>
                                        <button type="button" class="admin-service-stage-toggle mr-3" data-target="${stage_id}" data-stage-first="true">ეტაპზე გადასვლა</button>
                                        <div class="stage-color"></div>
                                        <input type="hidden" name="amount_of_stages[]" value="null" required>
                                        <input type="hidden" name="stage_has[]" value="${stage_id}" required>
                                        <input type="hidden" name="stage_belongs[]" value="${list_id}" required>
                                        <input type="hidden" name="stage_first[]" value="true" required>
                                    </div>
                                </div>
                                <div class="list d-fc">
                                    <div class="d-flex mb-3">
                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="${list_id}" data-type="double" data-stage="true" data-stage-id="${stage_id}" data-stage-first="true">ტექსტი</button>
                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="${list_id}" data-type="red" data-stage="true" data-stage-id="${stage_id}" data-stage-first="true"><i class="red" id="times"></i></button>
                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="${list_id}" data-type="green" data-stage="true" data-stage-id="${stage_id}" data-stage-first="true"><span><i class="green" id="checkmark"></i></span></button>
                                    </div>
                                </div>
                                <input type="hidden" name="amount_of_lists[]" value="null" required>
                                <input type="hidden" id="list-titles-${list_id}" name="list_titles[]" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required>
                                <input type="hidden" name="list_has[]" value="${list_id}" required>
                                <input type="hidden" name="list_belongs[]" value="${modal_id}" required>
                                <input type="hidden" name="list_has_stages[]" value="true" required>
                            </div>`
                }
                return markup
            }

            function modal_list_stage_markup(list_id) {
                let stage_id = generate_random_string(12)
                return `<div class="stage-wrapper d-flex mb-3 ${stage_id}">
                            <input type="text" class="pl-1 mr-3" name="stage_names[]" value="" placeholder="ეტაპის სახელი" required>
                            <button type="button" class="admin-service-stage-toggle mr-3" data-target="${stage_id}" data-stage-first="false">ეტაპზე გადასვლა</button>
                            <button type="button" class="remove-this-stage mr-3" data-target=".${stage_id}">ეტაპის წაშლა</button>
                            <div class="stage-color inactive"></div>
                            <input type="hidden" name="amount_of_stages[]" value="null" required>
                            <input type="hidden" name="stage_has[]" value="${stage_id}" required>
                            <input type="hidden" name="stage_belongs[]" value="${list_id}" required>
                            <input type="hidden" name="stage_first[]" value="false" required>
                        </div>`
            }

            function modal_list_item_markup(list_id, type, stage, stage_id, stage_first) {
                let item_id = generate_random_string(12)
                let markup = ''

                if ( stage ) {
                    markup += `<div class="item ${stage_id}">`
                } else {
                    markup += `<div class="item">`
                }

                if ( type == 'double' ) {
                    markup += `<span class="remove-this-item">&times</span>
                                <p contenteditable="true" data-html-to-value="#list-item-left-text-${item_id}">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
                                <span contenteditable="true" data-html-to-value="#list-item-right-text-${item_id}">10₾</span>
                                <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                <input type="hidden" name="list_item_belongs[]" value="${list_id}" required>
                                <input type="hidden" name="list_item_type[]" value="double" required>
                                <input type="hidden" id="list-item-left-text-${item_id}" name="list_item_left_text[]" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required>
                                <input type="hidden" id="list-item-right-text-${item_id}" name="list_item_right_text[]" value="10₾" required>`
                } else if ( type == 'red' ) {
                    markup += `<span class="remove-this-item">&times</span>
                                <p contenteditable="true" data-html-to-value="#list-item-left-text-${item_id}">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
                                <span><i class="red" id="times"></i></span>
                                <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                <input type="hidden" name="list_item_belongs[]" value="${list_id}" required>
                                <input type="hidden" name="list_item_type[]" value="red" required>
                                <input type="hidden" id="list-item-left-text-${item_id}" name="list_item_left_text[]" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required>`
                } else if ( type == 'green' ) {
                    markup += `<span class="remove-this-item">&times</span>
                                <p contenteditable="true" data-html-to-value="#list-item-left-text-${item_id}">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
                                <span><i class="green" id="checkmark"></i></span>
                                <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                <input type="hidden" name="list_item_belongs[]" value="${list_id}" required>
                                <input type="hidden" name="list_item_type[]" value="green" required>
                                <input type="hidden" id="list-item-left-text-${item_id}" name="list_item_left_text[]" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required>`
                }

                if ( stage_first ) {
                    markup += `<input type="hidden" name="list_item_stage_first[]" value="true" required>`
                } else {
                    markup += `<input type="hidden" name="list_item_stage_first[]" value="false" required>`
                }

                if ( stage ) {
                    markup += `<input type="hidden" name="list_item_is_staged[]" value="true" required>
                                <input type="hidden" name="list_item_stage[]" value="${stage_id}" required>
                                </div>`
                } else {
                    markup += `<input type="hidden" name="list_item_is_staged[]" value="false" required>
                                <input type="hidden" name="list_item_stage[]" value="null" required>
                                </div>`
                }

                return markup
            }

            $('.add-cards').click(function() {
                $('#append-cards').append(card_markup(index))
                $('#modals-wrapper').append(modal_markup(index))
                index++
            })

            $('body').on('click', '.add-modal-list', function() {
                $(this).parent('.lists').append(modal_list_markup($(this).data('modal-id'), $(this).data('has-stages')))
            })

            $('body').on('click', '.add-modal-stage', function() {
                $(this).parent('.list-stages').append(modal_list_stage_markup($(this).data('list-id')))
            })

            $('body').on('click', '.add-modal-list-item', function() {
                let list_id = $(this).data('list-id')
                let type = $(this).data('type')
                let stage = $(this).data('stage')
                let stage_id = $(this).data('stage-id')
                let stage_first = $(this).data('stage-first')
                $(this).parents('.list').append(modal_list_item_markup(list_id, type, stage, stage_id, stage_first))
            })

            $('body').on('click', '.universal-card > .remove-this-item', function() {
                $($(this).data('target')).remove()
                $(this).parent('.universal-card').remove()
            })

            $('body').on('click', '.admin-service-stage-toggle', function() {
                $(this).parents('.list-stages').find('.stage-color').addClass('inactive')
                $(this).siblings('.stage-color').removeClass('inactive')
                $(this).parents('.list-stages').siblings('.list').find('.add-modal-list-item').data('stage-id', $(this).data('target'))
                $(this).parents('.list-stages').siblings('.list').find('.add-modal-list-item').data('stage-first', $(this).data('stage-first'))
                $(this).parents('.list-stages').siblings('.list').find('.item').addClass('d-none')
                $(this).parents('.list-stages').siblings('.list').find(`.${$(this).data('target')}`).removeClass('d-none')
            })

            $('body').on('click', '.list-wrapper > .remove-this-item', function() {$(this).parent('.list-wrapper').remove()})
            $('body').on('click', '.stage-wrapper > .remove-this-stage', function() {$($(this).data('target')).remove()})
            $('body').on('click', '.item > .remove-this-item', function() {$(this).parent('.item').remove()})
        // Services
    })
</script>