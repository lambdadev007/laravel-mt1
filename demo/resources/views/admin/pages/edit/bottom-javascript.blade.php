@php
    use App\Http\Controllers\HelpersCT;
@endphp

<script type="text/javascript">
    $(document).ready(function() {
        function initEditor() {
            return $('.text-editor').ckeditor()
        }

        function generateRandomString(length) {
            let result = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        {{-- /* Slug */ --}}
            @if ( isset($form_data['has_seo']) )
                let slugs = '{{ implode('+', $slugs) }}'
                let ogSlugs = '{{ implode('+', $og_slugs) }}'

                let slugsArr = slugs.split('+')
                let ogSlugsArr = ogSlugs.split('+')

                $('input[name="slug"]').keyup(function(){
                    if ( slugsArr.includes($(this).val()) ) {
                        $(this).siblings('h5').text('ბმული მოხმარებაშია')
                        $(this).addClass('slug-in-use')
                    } else if ( ogSlugsArr.includes($(this).val()) ) { 
                        $(this).siblings('h5').text('ბმული მოხმარებაშია')
                        $(this).addClass('slug-in-use')
                    } else {
                        $(this).siblings('h5').text('ბმული / აუცილებელია და უნდა იყოს უნიკალური')
                        $(this).removeClass('slug-in-use')
                    }
                })
            @endif
        {{-- /* Slug */ --}}

        {{-- /* Sorting */ --}}
            let sort = 'all'
            
            $('.admin-sort-wrapper select').change(function(){
                let sort = $(this).find(':selected').data('sort')
                if ( sort == 'all' ) {
                    $('.admin-sort-item').removeClass('d-none')
                } else {
                    $('.admin-sort-item').removeClass('d-none')
                    $(`.admin-sort-item:not(.${sort})`).addClass('d-none')
                }
            })
        {{-- /* Sorting */ --}}

        {{-- /* Slides */ --}}
            @if ( isset($form_data['has_slides']) )
                let si = 100000

                @if ( $form_data['model_name'] == 'furniture' )
                    function slideMarkup(i) {
                        return `
                                <div class="slide-wrapper col-sm-12 col-md-6 my-3">
                                    <button type="button" class="remove-this-slide btn btn-danger rounded-0">x</button>

                                    <input type="hidden" name="amount_of_slides[]" value="${i}">

                                    <label for="slide-${i}" class="admin-image-wrapper d-flex">
                                        <img class="ajax-image w-100" src="{{ asset('images/temp/upload.jpg') }}">
                                        <span class="hover-edit-notifier">
                                            <span class="dire-edit"></span>
                                        </span>
                                        <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="slides[]" id="slide-${i}">
                                        <input type="hidden" name="existing_slide[]">
                                    </label>

                                    <input type="text" name="slide_link[]" placeholder="ბმული">
                                </div>
                            `
                    }
                @elseif ( $form_data['model_name'] == 'partners' )
                    function slideMarkup(i) {
                        return `
                                <div class="slide-wrapper col-sm-12 col-md-6 my-3">
                                    <button type="button" class="remove-this-slide btn btn-danger rounded-0">x</button>

                                    <input type="hidden" name="amount_of_slides[]" value="${i}">

                                    <label for="slide-${i}" class="admin-image-wrapper d-flex">
                                        <img class="ajax-image w-100" src="{{ asset('images/temp/upload.jpg') }}">
                                        <span class="hover-edit-notifier">
                                            <span class="dire-edit"></span>
                                        </span>
                                        <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="slides[]" id="slide-${i}">
                                        <input type="hidden" name="existing_slide[]">
                                    </label>

                                    <input type="text" name="slide_title[]" placeholder="სათაური">
                                </div>
                            `
                    }
                @else
                    function slideMarkup(i) {
                        return `
                                <div class="slide-wrapper col-sm-12 col-md-6 my-3">
                                    <button type="button" class="remove-this-slide btn btn-danger rounded-0">x</button>

                                    <input type="hidden" name="amount_of_slides[]" value="${i}">

                                    <label for="slide-${i}" class="admin-image-wrapper d-flex">
                                        <img class="ajax-image w-100" src="{{ asset('images/temp/upload.jpg') }}">
                                        <span class="hover-edit-notifier">
                                            <span class="dire-edit"></span>
                                        </span>
                                        <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="slides[]" id="slide-${i}">
                                        <input type="hidden" name="existing_slide[]">
                                    </label>
                                </div>
                            `
                    }
                @endif

                $('.add-slide').click(function(){
                    $('#slides .row').append(slideMarkup(si))
                    si++
                })
        
                $('#slides').on('click', '.remove-this-slide', function(){
                    $(this).closest('.slide-wrapper').remove()
                })
            @endif
        {{-- /* Slides */ --}}

        {{-- /* About Us */ --}}
            @if ( $form_data['model_name'] == 'about_us' )
                $('.category-selector > button').click(function(){
                    let selector = `.${$(this).data('category')}-wrapper`
                    $(this).siblings('button').removeClass('active')
                    $(this).addClass('active')
                    $('.about-content-wrapper > div').removeClass('show')
                    $(selector).addClass('show clicked')

                    setTimeout(function() {
                        $(selector).removeClass('clicked')
                    }, 100)
                })

                let i = 1000000

                function teamBlockMarkup(i) {
                    return `
                        <div class="team-block">
                            <label for="team-image-${i}" class="admin-image-wrapper d-flex member-img">
                                <img class="ajax-image mx-auto" src="{{ asset('images/temp/no-image.jpg') }}">
                                <span class="hover-edit-notifier">
                                    <span class="dire-edit"></span>
                                </span>
                                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="team_images[]" id="team-image-${i}">
                            </label>
                            <div class="member-name" contenteditable="true" data-text-to-value="#member-name-input-${i}">სახელი</div>
                            <div class="member-position" contenteditable="true" data-text-to-value="#member-profession-input-${i}">პროფესია</div>

                            <button type="button" class="split-button w-100 remove-team-member">
                                <span class="w-100">წაშლა</span>
                            </button>

                            <input type="hidden" name="existing_member_image[]">
                            <input id="member-name-input-${i}" type="hidden" name="member_name[]" value="სახელი">
                            <input id="member-profession-input-${i}" type="hidden" name="member_profession[]" value="პროფესია">
                            <input type="hidden" name="amount_of_team_members[]" value="${i}">
                        </div>
                    `
                }

                $('.add-team-members').click(function() {
                    $('.team-wrapper .team-bloks').append(teamBlockMarkup(i))
                    i++
                })

                $('.team-bloks').on('click', '.remove-team-member', function() {
                    $(this).parent('.team-block').remove()
                })
            @endif
        {{-- /* About Us */ --}}

        {{-- /* Vacancies */ --}}
            @if ( $form_data['model_name'] == 'vacancies' )
                let Gi = 1000000
                let GIi = 1000000
                let SGi = 1000000
                let SGIi = 1000000

                function groupMarkup(Gi, group_has) {
                    return `
                        <div class="group">
                            <div class="buttons-wrapper">
                                <button type="button" class="delete-button delete-group">ჯგუფის წაშლა</button>
                                <button type="button" class="add-group-item split-button w-100" data-has="${group_has}" data-child-type="sub_group">
                                    <span class="w-100">ჯგუფის შვილის დამატება ქვე ჯგუფებით</span>
                                </button>
                                <button type="button" class="add-group-item split-button w-100" data-has="${group_has}" data-child-type="checkbox_item">
                                    <span class="w-100">ჯგუფის შვილის დამატება ქვე ჯგუფების გარეშე</span>
                                </button>
                            </div>

                            <div class="group-items-wrapper"></div>

                            <input type="hidden" name="amount_of_groups[]" value="${Gi}">
                            <input type="hidden" name="group_has[]" value="${group_has}">
                        </div>
                    `
                }

                function groupItemMarkup(GIi, group_item_belongs, group_item_has, group_item_child_type) {
                    if ( group_item_child_type == 'sub_group' ) {
                        return `
                                <div class="group-item-wrapper ${group_item_child_type}">
                                    <button class="group-item" type="button" data-toggle="collapse" aria-expanded="true" aria-controls="group-item-${GIi}" data-target="#group-item-${GIi}">
                                        <div class="outer">
                                            <label for="group-item-image-${GIi}" class="admin-image-wrapper">
                                                <img class="ajax-image" src="{{ asset('images/temp/no-image.jpg') }}">
                                                <span class="hover-edit-notifier">
                                                    <span class="dire-edit"></span>
                                                </span>
                                                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="GI_image[]" id="group-item-image-${GIi}">
                                            </label>
                                        </div>
                                        <div class="inner">
                                            <div class="d-flex flex-column w-100">
                                                <input type="text" name="group_item_title_ka[]" placeholder="სათაური" required>
                                                <input type="text" name="group_item_title_en[]" placeholder="Title" required>
                                            </div>
                                            <div><span class="dire-right-arrow"></span></div>
                                        </div>
                                    </button>

                                    <div class="collapse group-item show" id="group-item-${GIi}">
                                        <div class="buttons-wrapper">
                                            <button type="button" class="delete-button delete-group-item">ჯგუფის შვილის წაშლა</button>
                                            <button type="button" class="add-sub-group split-button w-100" data-has="${group_item_has}">
                                                <span class="w-100">ქვე ჯგუფის დამატება</span>
                                            </button>
                                        </div>

                                        <div class="sub-groups-wrapper">
                                    
                                        </div>
                                    </div>

                                    <input type="hidden" name="amount_of_group_items[]" value="${GIi}">
                                    <input type="hidden" name="group_item_belongs[]" value="${group_item_belongs}">
                                    <input type="hidden" name="group_item_has[]" value="${group_item_has}">
                                    <input type="hidden" name="group_item_child_type[]" value="${group_item_child_type}">
                                </div>
                        `
                    } else {
                        return `
                                <div class="group-item-wrapper ${group_item_child_type}">
                                    <button class="group-item" type="button" data-toggle="collapse" aria-expanded="true" aria-controls="group-item-${GIi}" data-target="#group-item-${GIi}">
                                        <div class="outer">
                                            <label for="group-item-image-${GIi}" class="admin-image-wrapper">
                                                <img class="ajax-image" src="{{ asset('images/temp/no-image.jpg') }}">
                                                <span class="hover-edit-notifier">
                                                    <span class="dire-edit"></span>
                                                </span>
                                                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="GI_image[]" id="group-item-image-${GIi}">
                                            </label>
                                        </div>
                                        <div class="inner">
                                            <div class="d-flex flex-column w-100">
                                                <input type="text" name="group_item_title_ka[]" placeholder="სათაური" required>
                                                <input type="text" name="group_item_title_en[]" placeholder="Title" required>
                                            </div>
                                            <div><span class="dire-right-arrow"></span></div>
                                        </div>
                                    </button>

                                    <div class="collapse group-item show" id="group-item-${GIi}">
                                        <div class="buttons-wrapper">
                                            <button type="button" class="delete-button delete-group-item">ჯგუფის შვილის წაშლა</button>
                                            <button type="button" class="add-checkbox-item split-button w-100" data-has="${group_item_has}">
                                                <span class="w-100">ჩექბოქსის დამატება</span>
                                            </button>
                                        </div>

                                        <div class="checkbox-items-wrapper">

                                        </div>
                                    </div>

                                    <input type="hidden" name="amount_of_group_items[]" value="${GIi}">
                                    <input type="hidden" name="group_item_belongs[]" value="${group_item_belongs}">
                                    <input type="hidden" name="group_item_has[]" value="${group_item_has}">
                                    <input type="hidden" name="group_item_child_type[]" value="${group_item_child_type}">
                                </div>
                        `
                    }
                }

                function subGroupMarkup(SGi, sub_group_belongs, sub_group_has) {
                    return `
                        <div class="sub-group">
                            <button class="sub-group-item" type="button" data-toggle="collapse" aria-expanded="true" aria-controls="sub-group-item-${SGi}" data-target="#sub-group-item-${SGi}">
                                <div class="outer">
                                    <label for="sub-group-image-${SGi}" class="admin-image-wrapper">
                                        <img class="ajax-image" src="{{ asset('images/temp/no-image.jpg') }}">
                                        <span class="hover-edit-notifier">
                                            <span class="dire-edit"></span>
                                        </span>
                                        <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="SG_image[]" id="sub-group-image-${SGi}">
                                    </label>
                                </div>
                                <div class="inner">
                                    <div class="d-flex flex-column w-100">
                                        <input type="text" name="sub_group_title_ka[]" placeholder="სათაური" required>
                                        <input type="text" name="sub_group_title_en[]" placeholder="Title" required>
                                    </div>
                                    <div><span class="dire-right-arrow"></span></div>
                                </div>
                            </button>

                            <div class="collapse sub-group-item show" id="sub-group-item-${SGi}">
                                <div class="buttons-wrapper">
                                    <button type="button" class="delete-button delete-sub-group">ქვე ჯგუფის წაშლა</button>
                                    <button type="button" class="add-checkbox-item split-button w-100" data-has="${sub_group_has}">
                                        <span class="w-100">ჩექბოქსის დამატება</span>
                                    </button>
                                </div>

                                <div class="checkbox-items-wrapper">
                                </div>
                            </div>

                            <input type="hidden" name="amount_of_sub_groups[]" value="${SGi}">
                            <input type="hidden" name="sub_group_belongs[]" value="${sub_group_belongs}">
                            <input type="hidden" name="sub_group_has[]" value="${sub_group_has}">
                        </div>
                    `
                }

                function checkboxItemMarkup(SGIi, checkbox_item_belongs) {
                    return `
                        <div class="checkbox-item">
                            <div class="d-flex flex-column w-100">
                                <input type="text" name="sub_group_item_title_ka[]" placeholder="სათაური" required>
                                <input type="text" name="sub_group_item_title_en[]" placeholder="Title" required>
                            </div>
                            <button type="button" class="remove-this-checkbox-item">X</button>
                            <input type="hidden" name="amount_of_sub_group_items[]" value="${SGIi}">
                            <input type="hidden" name="sub_group_item_belongs[]" value="${checkbox_item_belongs}">
                        </div>
                    `
                }

                {{-- /* Appends */ --}}
                    $('.add-group').click(function() {
                        let group_has = generateRandomString('50')
                        $('.vacancies-tabs').append(groupMarkup(Gi, group_has))
                        Gi++
                    })

                    $('.vacancies-tabs').on('click', '.add-group-item', function() {
                        let group_item_child_type = $(this).data('child-type')
                        let group_item_belongs = $(this).data('has')
                        let group_item_has = generateRandomString('50')
                        $(this).parents('.buttons-wrapper').siblings('.group-items-wrapper').append(groupItemMarkup(GIi, group_item_belongs, group_item_has, group_item_child_type))
                        GIi++
                    })

                    $('.vacancies-tabs').on('click', '.add-sub-group', function() {
                        let sub_group_belongs = $(this).data('has')
                        let sub_group_has = generateRandomString('50')
                        $(this).parents('.buttons-wrapper').siblings('.sub-groups-wrapper').append(subGroupMarkup(SGi, sub_group_belongs, sub_group_has))
                        SGi++
                    })

                    $('.vacancies-tabs').on('click', '.add-checkbox-item', function() {
                        let checkbox_item_belongs = $(this).data('has')
                        $(this).parents('.buttons-wrapper').siblings('.checkbox-items-wrapper').append(checkboxItemMarkup(SGIi, checkbox_item_belongs))
                        SGIi++
                    })
                {{-- /* Appends */ --}}

                {{-- /* Removal */ --}}
                    $('.vacancies-tabs').on('dblclick', '.delete-group', function() {
                        $(this).parents('.group').remove()
                    })

                    $('.vacancies-tabs').on('dblclick', '.delete-group-item', function() {
                        $(this).parents('.group-item-wrapper').remove()
                    })

                    $('.vacancies-tabs').on('dblclick', '.delete-sub-group', function() {
                        $(this).parents('.sub-group').remove()
                    })
                    
                    $('.vacancies-tabs').on('dblclick', '.remove-this-checkbox-item', function() {
                        $(this).parents('.checkbox-item').remove()
                    })
                {{-- /* Removal */ --}}

                {{-- /* Propagation */ --}}
                    $('.vacancies-tabs').on('click', 'button.group-item .inner input', function(e) {
                        e.stopPropagation()
                    })

                    $('.vacancies-tabs').on('click', 'button.group-item .outer label', function(e) {
                        e.stopPropagation()
                    })

                    $('.vacancies-tabs').on('click', 'button.sub-group-item .inner input', function(e) {
                        e.stopPropagation()
                    })
                    
                    $('.vacancies-tabs').on('click', 'button.sub-group-item .outer label', function(e) {
                        e.stopPropagation()
                    })
                {{-- /* Propagation */ --}}
            @endif
        {{-- /* Vacancies */ --}}

        {{-- /* Vacancies Selects */ --}}
            @if ( $form_data['model_name'] == 'vacancies_selects' )
                let i = 1000000

                function employeeMarkup(i) {
                    return `
                        <div class="selects-item">
                            <button type="button" class="remove-this-employee">X</button>
                            <input class="mb-1" type="text" name="employee_ka[]" placeholder="ქართულად" required>
                            <input type="text" name="employee_en[]" placeholder="ინგლისურად" required>
                            <input type="hidden" name="amount_of_employees[]" value="${i}">
                        </div>
                    `
                }

                function legalEntityMarkup(i) {
                    return `
                        <div class="selects-item">
                            <button type="button" class="remove-this-legal-entity">X</button>
                            <input class="mb-1" type="text" name="legal_entity_ka[]" placeholder="ქართულად" required>
                            <input type="text" name="legal_entity_en[]" placeholder="ინგლისურად" required>
                            <input type="hidden" name="amount_of_legal_entities[]" value="${i}">
                        </div>
                    `
                }

                $('.add-employee').click(function() {
                    $(this).parent('#employee').append(employeeMarkup(i))
                    i++
                })

                $('.add-legal-entity').click(function() {
                    $(this).parent('#legal-entity').append(legalEntityMarkup(i))
                    i++
                })

                $('#employee').on('click', '.remove-this-employee', function() {
                    $(this).parent('.selects-item').remove()
                })
                
                $('#legal-entity').on('click', '.remove-this-legal-entity', function() {
                    $(this).parent('.selects-item').remove()
                })
            @endif
        {{-- /* Vacancies Selects */ --}}

        {{-- /* Vacancies Banners */ --}}
            @if ( $form_data['model_name'] == 'vacancies_banners' )
                $('.vacancies-top-categories button').click(function () {
                    let type = $(this).data('type')

                    if ( $('.instructional-banner').hasClass(`${type}`) ) {
                        $('.instructional-banner').removeClass(`show ${type}`)
                    } else {
                        $('.instructional-banner').removeClass('show opacity employee legal-entity')
                        $('.instructional-banner').addClass(`show ${type}`)
                        setTimeout(function () { $('.instructional-banner').addClass(`opacity`) }, 300);
                    }
                })
            @endif
        {{-- /* Vacancies Banners */ --}}

        {{-- /* Contact */ --}}
            @if ( $form_data['model_name'] == 'contact' )
                let i = 1000000

                function contactMarkupKa(i, belongs) {
                    return `
                        <div class="contact-link-wrapper ${i}">
                            <div class="d-flex">
                                <button type="button" class="remove-this-contact" data-remove="${i}">X</button>
                                <a href="javascript:void(0)" contenteditable="true" data-text-to-value="#contact-number-${i}" data-numbers-only="true">+995</a>
                            </div>

                            <div class="d-flex">
                                <span contenteditable="true" data-text-to-value="#contact-ka-profession-${i}">პროფესია</span> 
                                <span>:</span>
                                <span contenteditable="true" data-text-to-value="#contact-ka-name-${i}"><b>სახელი</b></span>
                            </div>

                            <input type="hidden" id="contact-number-${i}" name="number[]" value="+995">
                            <input type="hidden" name="belongs[]" value="${belongs}">
                            <input type="hidden" name="amount_of_contacts[]" value="${i}">
                            <input type="hidden" id="contact-ka-profession-${i}" name="profession_ka[]" value="პროფესია">
                            <input type="hidden" id="contact-ka-name-${i}" name="name_ka[]" value="სახელი">
                        </div>
                    `
                }

                function contactMarkupEn(i, belongs) {
                    return `
                        <div class="contact-link-wrapper ${i}">
                            <a href="javascript:void(0)">+995</a>

                            <div class="d-flex">
                                <span contenteditable="true" data-text-to-value="#contact-en-profession-${i}">Profession</span> 
                                <span>:</span>
                                <span contenteditable="true" data-text-to-value="#contact-en-name-${i}"><b>Name</b></span>
                            </div>

                            <input type="hidden" id="contact-en-profession-${i}" name="profession_en[]" value="Profession">
                            <input type="hidden" id="contact-en-name-${i}" name="name_en[]" value="Name">
                        </div>
                    `
                }

                $('.add-contact').click(function() {
                    let belongs = $(this).data('team')
                    $(`.contact-left-segment-section.ka.${belongs}`).append(contactMarkupKa(i, belongs))
                    $(`.contact-left-segment-section.en.${belongs}`).append(contactMarkupEn(i, belongs))
                    i++
                })

                $('.contact-wrapper').on('click', '.remove-this-contact', function() {
                    $(`.contact-link-wrapper.${$(this).data('remove')}`).remove()
                })
            @endif
        {{-- /* Contact */ --}}

        {{-- /* Article */ --}}
            @if ( $form_data['model_name'] == 'article' )
                let i = 100000

                function subSectionMarkup(i) {
                    return `
                            <div class="form-sub-section form-section">
                                <button class="sub-section-collapse" type="button" data-toggle="collapse" data-target="#article-section-${i}" aria-expanded="false" aria-controls="article-section-${i}">
                                    <span>სექციის სათაური</span>
                                    <span class="dire-right-arrow-s"></span>
                                </button>

                                <div class="collapse" id="article-section-${i}">
                                    <input type="hidden" name="amount_of_sections[]" value="${i}">

                                    <button type="button" class="remove-this-article-section btn btn-danger rounded-0">ქვე სექციის წაშლა</button>

                                    <div class="form-section">
                                        <h5>სათაური / არ არის აუცილებელი</h5>
                                        <input class="form-control" type="text" name="section_title[]" value="სექციის სათაური" placeholder="{{ $placeholders[0] }}" maxlength="60">
                                    </div>

                                    <div class="form-section">
                                        <h5>სურათი / არ არის აუცილებელი - შეფარდება: 16:9</h5>
                                        <label for="article-section-header-image-${i}" class="admin-image-wrapper d-flex mx-auto w-75">
                                            <img class="ajax-image mx-auto w-100" src="{{ asset('images/temp/upload.jpg') }}">
                                            <span class="hover-edit-notifier">
                                                <span class="dire-edit"></span>
                                            </span>
                                            <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="section_images[]" id="article-section-header-image-${i}">
                                        </label>
                                    </div>

                                    <div class="form-section">
                                        <h5>სტატიის აღწერა / არ არის აუცილებელი</h5>
                                        <textarea class="text-editor" name="section_description[]"></textarea>
                                    </div>
                                </div>
                            </div>
                        `
                }

                $('.add-article-section').click(function(){
                    $('.form-sub-section-wrapper').append(subSectionMarkup(i))
                    initEditor()
                    i++
                })

                $('.form-sub-section-wrapper').on('click', '.remove-this-article-section', function(){
                    $(this).closest('.form-sub-section').remove()
                })

                $('.form-sub-section-wrapper').on('keyup', '.collapse .form-section input[name="section_title[]"]', function(e){
                    $(this).closest('.form-sub-section').find('.sub-section-collapse span:not(.dire-right-arrow-s)').text($(this).val())
                })
            @endif
        {{-- /* Article */ --}}

        {{-- /* Services */ --}}
            {{-- /* Consultation */ --}}
                @if ( $form_data['model_name'] == 'consultation' )
                    let i = 100000

                    function consultationServiceMarkupKa(i) {
                        return `
                            <div class="admin-service-wrapper mt-3">
                                <div class="important-text-wrapper my-3">
                                    <h5 class="important-text" contenteditable="true" data-text-to-value="#title-ka-${i}">სათაური</h5>
                                    <button class="btn btn-danger remove-this-service" type="button">სერვისის წაშლა</button>
                                </div>

                                <div class="consultation-service">
                                    <div class="service-sale-left">
                                        <ul class="service-list">
                                            <textarea class="text-editor" name="description_ka[]">აღწერა</textarea>
                                        </ul>
                                    </div>

                                    <div class="service-sale-right">
                                        <span class="service-price" contenteditable="true" data-numbers-only="true" data-text-to-value="#price-${i}">0<span class="dire-lari"></span></span>
                                    </div>
                                </div>

                                @if ( HelpersCT::is_admin() )
                                    <div class="metrix-selector-wrapper my-3">
                                        <select class="form-control" name="group" required>
                                            <option disabled value="">აირჩიეთ კატეგორია</option>
                                            <option value="design">დიზაინის ჯგუფი</option>
                                            <option value="repairs">რემონტის ჯგუფი</option>
                                            <option value="furniture">ავეჯის ჯგუფი</option>
                                        </select>
                                    </div>
                                @endif

                                <input id="title-ka-${i}" type="hidden" name="title_ka[]" value="სათაური">
                                <input id="price-${i}" type="hidden" name="price[]" value="0">
                                <input type="hidden" name="amount_of_services[]" value="${i}">
                            </div>
                        `
                    }

                    function consultationServiceMarkupEn(i) {
                        return `
                            <div class="admin-service-wrapper mt-3">
                                <div class="important-text-wrapper my-3">
                                    <h5 class="important-text" contenteditable="true" data-text-to-value="#title-en-${i}">სათაური</h5>
                                </div>

                                <div class="consultation-service">
                                    <div class="service-sale-left">
                                        <ul class="service-list">
                                            <textarea class="text-editor" name="description_en[]">აღწერა</textarea>
                                        </ul>
                                    </div>
                                </div>

                                <input id="title-en-${i}" type="hidden" name="title_en[]" value="სათაური">
                            </div>
                        `
                    }

                    $('#add-consultation-service').click(function() {
                        $('#ka-consultation-services .services').append(consultationServiceMarkupKa(i))
                        $('#en-consultation-services .services').append(consultationServiceMarkupEn(i))
                        initEditor()
                        i++
                    })

                    $('.services').on('click', '.remove-this-service', function(){
                        $(this).parents('.admin-service-wrapper').remove()
                    })
                @endif
            {{-- /* Consultation */ --}}

            {{-- /* Design || Furniture */ --}}
                @if ( $form_data['model_name'] == 'design' || $form_data['model_name'] == 'furniture' )
                    let i = 100000

                    function categoryMarkup(i) { 
                        return `
                        <li class="" data-index="${i}">
                            <input type="hidden" name="amount_of_sections[]" value="${i}">
                            <div></div>
                            <span contenteditable="true" data-text-to-value="#category-input-${i}" data-text-to-text="#category-text-${i}" data-index="${i}">სათაური</span>
                            <input type="hidden" id="category-input-${i}" name="title[]" value="სათაური">
                            <button type="button" class="btn btn-danger" id="remove-design-category">X</button>
                        </li>`
                    }

                    function dataMarkup(i) {
                        return `
                        <li class="" data-index="${i}">
                            <div class="important-text-wrapper">
                                <h5 class="important-text" id="category-text-${i}">სათაური</h5>
                            </div>
                            <label for="design-header-image-${i}" class="admin-image-wrapper">
                                <img class="ajax-image" src="{{ asset('images/temp/upload.jpg') }}">
                                <span class="hover-edit-notifier">
                                    <span class="dire-edit"></span>
                                </span>
                                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="image[]" id="design-header-image-${i}">
                                <input type="hidden" name="existing_image[]">
                            </label>
                            <p>
                                <textarea name="description[]" class="text-editor"><p>აღწერა</p></textarea>
                            </p>
                        </li>`
                    }

                    $('#add-design-category').click(function(){
                        $('.design-wrapper .design-top-section .design-information .category-selector').append(categoryMarkup(i))
                        $('.design-wrapper .design-top-section .design-information .category-data').append(dataMarkup(i))
                        i++
                        initEditor()
                    })

                    $(document).on('click', '#remove-design-category', function(){
                        $(`.category-data li[data-index="${$(this).parents('li').data('index')}"]`).remove()
                        $(this).parents('li').remove()
                    })

                    $('.design-wrapper .design-top-section .design-information .category-selector').on('click', 'li span', function(){
                        $('.design-information .category-selector li').removeClass('active')
                        $('.design-information .category-data li').removeClass('show')
                        $(this).parents('li').addClass('active')
                        $(`.design-information .category-data li[data-index="${$(this).data('index')}"]`).addClass('show')
                    })
                @endif
            {{-- /* Design || Furniture */ --}}

            {{-- /* Repairs */ --}}
                @if ( $form_data['model_name'] == 'repairs' )
                    // sci = Sub Category Index
                    // scti = Sub Category Text Index
                    // ibi = Info Box Index

                    let sci     = 100000
                    let scti    = 100000
                    let ibi     = 100000
                
                    function repairsSubCategoryMarkup(segment,has,sci) {
                        return `
                            <div class="sub-category" data-sub-category-has="${has}">
                                <button type="button" class="remove-this-sub-category">x</button>

                                <span contenteditable="true" data-text-to-value="#${segment}-sub-category-title-${sci}" class="title">სათაური</span>

                                <div class="sub-category-text-wrapper">
                                    <button type="button" class="split-button w-100 add-sub-category-text">
                                        <span class="w-100">ტექსტის დამატება</span>
                                    </button>
                                </div>

                                <input type="hidden" id="${segment}-sub-category-title-${sci}" name="${segment}_sub_category_title[]" value="სათაური">
                                <input type="hidden" name="${segment}_sub_sections_has[]" value="${has}">
                                <input type="hidden" name="amount_of_${segment}_sub_sections[]" value="${sci}">
                            </div>
                            `
                    }

                    function repairsSubCategoryTextMarkup(belongs,scti) {
                        return `
                            <div class="sub-category-text">
                                <button class="remove-this-sub-category-text">x</button>
                                <span contenteditable="true" data-text-to-value="#sub-category-text-${scti}">აღწერა</span>
                                <input type="hidden" id="sub-category-text-${scti}" name="sub_category_descriptions[]" value="აღწერა">
                                <input type="hidden" name="sub_section_text_belongs[]" value="${belongs}">
                                <input type="hidden" name="amount_of_sub_section_texts[]" value="${scti}">
                            </div>
                            `
                    }

                    function infoBoxMarkup(ibi) {
                        return `
                            <div class="info-box">
                                <button type="button" class="remove-this-info-box">x</button>

                                <div class="info-box-bold">
                                    <span contenteditable="true" data-text-to-value="#info-box-title-${ibi}">სათაური</span>
                                </div>

                                <div class="info-box-text">
                                    <p contenteditable="true" data-text-to-value="#info-box-description-${ibi}">აღწერა</p>
                                </div>

                                <div class="info-box-price">
                                    <span contenteditable="true" data-text-to-value="#info-box-price-${ibi}">ფასი</span>
                                </div>

                                <input type="hidden" name="amount_of_info_boxes[]" value="${ibi}">
                                <input type="hidden" name="info_box_title[]" value="სათაური" id="info-box-title-${ibi}">
                                <input type="hidden" name="info_box_description[]" value="აღწერა" id="info-box-description-${ibi}">
                                <input type="hidden" name="info_box_price[]" value="0" id="info-box-price-${ibi}">
                            </div>
                        `
                    }

                    $('.repairs-wrapper .row .col-sm-12 .sub-category-wrapper .add-sub-category').click(function(){
                        let has = generateRandomString('50')
                        $(`.repairs-wrapper .row .${$(this).data('segment')}.col-sm-12 .sub-category-wrapper`).append(repairsSubCategoryMarkup($(this).data('segment'), has, sci))
                        sci++
                    })

                    $('.repairs-wrapper .row .col-sm-12 .sub-category-wrapper').on('click', '.add-sub-category-text', function(){
                        let belongs = $(this).parents('.sub-category').data('sub-category-has')
                        $(this).parent('.sub-category-text-wrapper').append(repairsSubCategoryTextMarkup(belongs, scti))
                        scti++
                    })

                    $('.admin-content-wrapper .info-box-wrapper > .split-button').click(function(){
                        $(`.admin-content-wrapper .info-box-wrapper .info-box-body`).append(infoBoxMarkup(ibi))
                        ibi++
                    })

                    $('.repairs-wrapper .row .col-sm-12 .sub-category-wrapper').on('click', '.remove-this-sub-category', function(){
                        $(this).parents('.sub-category').remove()
                    })

                    $('.repairs-wrapper .row .col-sm-12 .sub-category-wrapper').on('click', '.remove-this-sub-category-text', function(){
                        $(this).parents('.sub-category-text').remove()
                    })
                    
                    $('.admin-content-wrapper .info-box-wrapper .info-box-body').on('click', '.remove-this-info-box', function(){
                        $(this).parents('.info-box').remove()
                    })

                    $(document).keydown(function(e) {
                        if (e.keyCode == 186) {
                            e.preventDefault()
                        }
                    })
                @endif
            {{-- /* Repairs */ --}}

            {{-- /* Furniture Materials */ --}}
                @if ( $form_data['model_name'] == 'furniture_materials' )
                    let i = 100000

                    function catalogueMarkup(i) {
                        return `
                            <div class="catalogue">
                                <button type="button" class="remove-catalogue">X</button>

                                    <label for="catalogue-image-${i}" class="admin-image-wrapper d-flex">
                                    <img class="ajax-image image" src="{{ asset('images/temp/upload.jpg') }}">
                                    <span class="hover-edit-notifier">
                                        <span class="dire-edit"></span>
                                    </span>
                                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="catalogue_image[]" id="catalogue-image-${i}">
                                    <input type="hidden" name="existing_catalogue_image[]">
                                </label>

                                <a onclick="function(e){e.preventDefault()}" contenteditable="true" data-text-to-value="#catalogue-title-${i}">სათაური</a>

                                <label for="catalogue-file-${i}" class="admin-image-wrapper d-flex">
                                    <img class="ajax-image pdf_icon" src="{{ asset('images/svg_icons/pdf_icon.png') }}" alt="Pdf">
                                    <span class="hover-edit-notifier">
                                        <span class="dire-edit"></span>
                                    </span>
                                    <input type="file" accept="application/pdf" class="ajax-input d-none" name="catalogue_file[]" id="catalogue-file-${i}">
                                    <input type="hidden" name="existing_catalogue_file[]">
                                </label>

                                <input type="hidden" name="amount_of_catalogues[]" value="${i}">
                                <input type="hidden" name="catalogue_title[]" id="catalogue-title-${i}" value="სათაური">
                            </div>
                        `
                    }

                    $('.catalogue-wrapper').on('click', '.remove-catalogue' , function() {
                        $(this).closest('.catalogue').remove()
                    })

                    $('#add-catalogue').click(function() {
                        $('.catalogue-wrapper').append(catalogueMarkup(i))
                        i++
                    })
                @endif
            {{-- /* Furniture Materials */ --}}

            {{-- /* Furniture Gallery */ --}}
                @if ( $form_data['model_name'] == 'furniture_gallery' )
                    let i = 100000

                    function furnitureGalleryImageMarkup(category, i) {
                        return `
                            <div class="furniture-gallery-item ${category} show">
                                <button type="button" class="remove-this-gallery-item">X</button>
                                <label for="gallery-image-${i}" class="admin-image-wrapper d-flex">
                                    <img class="ajax-image w-100" src="{{ asset('images/temp/upload.jpg') }}">
                                    <span class="hover-edit-notifier">
                                        <span class="dire-edit"></span>
                                    </span>
                                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="gallery_images[]" id="gallery-image-${i}" required>
                                    <input type="hidden" name="category[]" value="${category}">
                                    <input type="hidden" name="existing_gallery_image[]">
                                    <input type="hidden" name="amount_of_images[]" value="${i}">
                                </label>
                            </div>
                        `
                    }

                    $('.furniture-wrapper .furniture-links-wrapper button').click(function() {
                        $(this).siblings().removeClass('active')
                        $(this).addClass('active')
                        $('#add-furniture-gallery-image').data('category', $(this).data('category'))
                        $('.furniture-gallery-item').removeClass('show')
                        $(`.furniture-gallery-item.${$(this).data('category')}`).addClass('show')
                    })

                    $('#add-furniture-gallery-image').click(function(){
                        let category = $(this).data('category')
                        $('.furniture-gallery').append(furnitureGalleryImageMarkup(category, i))
                        i++
                    })

                    $('.furniture-gallery-wrapper').on('click', '.remove-this-gallery-item', function() {
                        $(this).closest('.furniture-gallery-item').remove()
                    })
                @endif
            {{-- /* Furniture Gallery */ --}}

            {{-- /* Vip-Master */ --}}
                @if ( $form_data['model_name'] == 'vip_master' )
                    $('.services-top-section .jumper-navigation .top button').click(function(){
                        let category = `${$(this).data('category')}`
                        $(`.services-top-section .jumper-navigation .top button`).removeClass('active')
                        $(`.services-top-section .jumper-navigation .top button[data-category="${category}"]`).addClass('active')

                        $('button[data-open-all-category]').data('open-all-category', $(this).data('category'))
                        $('button[data-close-all-category]').data('close-all-category', $(this).data('category'))

                        $(`.services-top-section .jumper-navigation .bottom .important-text-wrapper`).removeClass('show')
                        $('.services-wrapper .categories').removeClass('show')
                        $(`.${category}`).addClass('show clicked')

                        setTimeout(function() {
                            $(`.${category}`).removeClass('clicked')
                        }, 100)
                    })

                    $('.services-wrapper').on('click', '.services .categories .sub-category .top', function() {
                        $(this).parents('.sub-category').toggleClass('show')
                        $(this).children('span').toggleClass('dire-up-arrow')
                        $(this).children('span').toggleClass('dire-down-arrow')
                    })

                    $('.services-wrapper').on('click', '.services .categories .sub-category .top h5, .vip-master-wrapper .services .categories .sub-category .top h5', function(e) {
                        e.stopPropagation()
                    })

                    $('button[data-open-all-category]').click(function() {
                        $(`.services-wrapper .services .categories.${$(this).data('open-all-category')} .sub-category`).addClass('show')
                        $('.vip-master-wrapper .services .categories .sub-category .top span').removeClass('dire-down-arrow')
                        $('.vip-master-wrapper .services .categories .sub-category .top span').addClass('dire-up-arrow')
                    })

                    $('button[data-close-all-category]').click(function() {
                        $(`.services-wrapper .services .categories.${$(this).data('close-all-category')} .sub-category`).removeClass('show')
                        $('.vip-master-wrapper .services .categories .sub-category .top span').removeClass('dire-up-arrow')
                        $('.vip-master-wrapper .services .categories .sub-category .top span').addClass('dire-down-arrow')
                    })

                    $('.vip-master-wrapper').on('click', '.remove-this-sub-category', function() {
                        $(`.sub-category.${$(this).data('remove-id')}`).remove()
                    })

                    $('.vip-master-wrapper').on('click', '.remove-this-service', function() {
                        $(`.vip-master-service.${$(this).data('remove-id')}`).remove()
                    })

                    let sci = 1000000
                    let si = 1000000

                    {{-- /* Sub Categories */ --}}
                        function subCategoryMarkupKa(sci, has, belongs) {
                            return `
                                <div class="sub-category show ${sci}">
                                    <div class="top">
                                        <h5 contenteditable="true" data-text-to-value="#sub_category_title_ka_${sci}">ქვე-კატეგორია</h5>
                                        <button type="button" class="remove-this-sub-category btn btn-danger" data-remove-id="${sci}">X</button>
                                    </div>

                                    <div class="bottom">
                                        {{-- Add Service Button --}}
                                            <button type="button" class="add-service split-button w-100 mt-3" data-service-belongs="${has}" data-append-id="${sci}">
                                                <span class="w-100">სერვისის დამატება</span>
                                            </button>
                                        {{-- Add Service Button --}}
                                    </div>

                                    <input type="hidden" name="sub_category_titles_ka[]" value="ქვე-კატეგორია" id="sub_category_title_ka_${sci}">
                                    <input type="hidden" name="amount_of_sub_categories[]" value="${sci}">
                                    <input type="hidden" name="belongs_category[]" value="${belongs}">
                                    <input type="hidden" name="has[]" value="${has}">
                                </div>
                            `
                        }

                        function subCategoryMarkupRu(sci) {
                            return `
                                <div class="sub-category show ${sci}">
                                    <div class="top">
                                        <h5 contenteditable="true" data-text-to-value="#sub_category_title_ru_${sci}">ქვე-კატეგორია</h5>
                                    </div>

                                    <div class="bottom">
                                    </div>

                                    <input type="hidden" name="sub_category_titles_ru[]" value="ქვე-კატეგორია" id="sub_category_title_ru_${sci}">
                                </div>
                            `
                        }

                        $('.vip-master-wrapper').on('click', '.add-sub-category', function() {
                            let has = generateRandomString('50')
                            $(`#ka-services .categories.${$(this).data('sub-category-belongs')}`).append(subCategoryMarkupKa(sci, has, $(this).data('sub-category-belongs')))
                            $(`#ru-services .categories.${$(this).data('sub-category-belongs')}`).append(subCategoryMarkupRu(sci))
                            sci++
                        })
                    {{-- /* Sub Categories */ --}}

                    {{-- /* Services */ --}}
                        function serviceMarkupKa(si, belongs) {
                            return `
                                <div class="vip-master-service ${si}">
                                    <div class="service-left">
                                        <span contenteditable="true" data-text-to-value="#service-title-ka-${si}">სერვისი</span>
                                    </div>

                                    <div class="service-right">
                                        <span class="service-price ${si}" contenteditable="true" data-text-to-value="#service-price-${si}">0</span></span> 
                                        <button type="button" class="remove-this-service btn btn-danger" data-remove-id="${si}">X</button>
                                    </div>

                                    <input type="hidden" name="service_title_ka[]" value="სერვისი" id="service-title-ka-${si}">
                                    <input type="hidden" name="service_price[]" value="0" id="service-price-${si}">
                                    <input type="hidden" name="amount_of_services[]" value="${si}">
                                    <input type="hidden" name="belongs_sub_category[]" value="${belongs}">
                                </div>
                            `
                        }

                        function serviceMarkupRu(si) {
                            return `
                                <div class="vip-master-service ${si}">
                                    <div class="service-left">
                                        <span contenteditable="true" data-text-to-value="#service-title-ru-${si}">სერვისი</span>
                                    </div>

                                    <input type="hidden" name="service_title_ru[]" value="სერვისი" id="service-title-ru-${si}">
                                </div>
                            `
                        }

                        $('.vip-master-wrapper').on('click', '.add-service', function() {
                            $(`#ka-services .sub-category.${$(this).data('append-id')} .bottom`).append(serviceMarkupKa(si, $(this).data('service-belongs')))
                            $(`#ru-services .sub-category.${$(this).data('append-id')} .bottom`).append(serviceMarkupRu(si))
                            si++
                        })
                    {{-- /* Services */ --}}
                @endif
            {{-- /* Vip-Master */ --}}

            {{-- /* Cleaning */ --}}
                @if ( $form_data['model_name'] == 'cleaning_top' || $form_data['model_name'] == 'cleaning_bottom' )
                    $('.services-wrapper .services-top-section .jumper-navigation .top button').click(function(){
                        let selector = `.${$(this).data('category')}`
                        $(this).siblings('button').removeClass('active')
                        $(this).addClass('active')

                        $('.services-wrapper .top-services .top-service').removeClass('show')
                        $(selector).addClass('show clicked')

                        setTimeout(function() {
                            $(selector).removeClass('clicked')
                        }, 100)
                    })

                    $(document).on('click', '.services-wrapper.cleaning-wrapper .cleaning-bottom-wrapper .bottom-services .bottom-service .top', function() {
                        $(this).parent('.bottom-service').toggleClass('active')
                    })

                    $(document).on('click', '.services-wrapper.cleaning-wrapper .cleaning-bottom-wrapper .bottom-services .bottom-service .top .important-text-wrapper h5', function(e) {
                        e.stopPropagation()
                    })

                    let id = 1000000
                    let i = 1000000

                    function bottomServiceMarkupKa(id, i) {
                            return `
                                <div class="bottom-service ${id}">
                                    <button type="button" class="remove-this-bottom-service btn btn-danger" data-id="${id}">X</button>
                                    <div class="top">
                                        <div class="important-text-wrapper">
                                            <h5 contenteditable="true" data-text-to-value="#0-${i}-title" class="important-text">სათაური</h5>
                                            <input type="hidden" id="0-${i}-title" name="bottom_service_titles_ka[]" value="სათაური">
                                        </div>
                                        <div class="dire-down-arrow-s"></div>
                                    </div>

                                    <div class="bottom">
                                        <div contenteditable="true" data-text-to-value="#0-${i}-description" class="left">აღწერა</div>
                                        <input type="hidden" id="0-${i}-description" name="bottom_service_descriptions_ka[]" value="აღწერა">

                                        <div class="right">
                                            <div class="cleaning-service-price-wrapper">
                                                <span class="area">ფასი: 1 კვ.მ</span>
                                                <span contenteditable="true" data-text-to-value="#0-${i}-price" class="0-${i}-price">0</span>
                                                <input type="hidden" id="0-${i}-price" name="bottom_prices[]" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="amount_of_bottom_services[]" value="${i}">
                            `
                        }

                    function bottomServiceMarkupEn(id, i) {
                        return `
                                <div class="bottom-service ${id}">
                                    <div class="top">
                                        <div class="important-text-wrapper">
                                            <h5 contenteditable="true" data-text-to-value="#1-${i}-title" class="important-text">Title</h5>
                                            <input type="hidden" id="1-${i}-title" name="bottom_service_titles_en[]" value="Title">
                                        </div>
                                        <div class="dire-down-arrow-s"></div>
                                    </div>

                                    <div class="bottom">
                                        <div contenteditable="true" data-text-to-value="#1-${i}-description" class="left">Description</div>
                                        <input type="hidden" id="1-${i}-description" name="bottom_service_descriptions_en[]" value="Description">
                                    </div>
                                </div>
                            `
                    }

                    $('.add-bottom-service').click(function() {
                        $('.bottom-services.ka').append(bottomServiceMarkupKa(id, i))
                        i++
                        $('.bottom-services.en').append(bottomServiceMarkupEn(id, i))
                        i++
                        id++
                    })

                    $(document).on('click', '.remove-this-bottom-service', function() {
                        $(`.bottom-service.${$(this).data('id')}`).remove()
                    })
                @endif
            {{-- /* Cleaning */ --}}
        {{-- /* Services */ --}}
    })
</script>