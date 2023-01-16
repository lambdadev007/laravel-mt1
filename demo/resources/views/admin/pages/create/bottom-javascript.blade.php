<script type="text/javascript">
    $(document).ready(function() {
        function initEditor() {
            return $('.text-editor').ckeditor()
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

        {{-- /* Slides */ --}}
            @if ( isset($form_data['has_slides']) )
                let si = 100000

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

                $('.add-slide').click(function(){
                    $('#slides .row').append(slideMarkup(si))
                    si++
                })
        
                $('#slides').on('click', '.remove-this-slide', function(){
                    $(this).closest('.slide-wrapper').remove()
                })
            @endif
        {{-- /* Slides */ --}}

        {{-- /* Article Sub Sections */ --}} 
            @if ( $form_data['model_name'] == 'article')
                let i = 10000

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
        {{-- /* Article Sub Sections */ --}} 
    })
</script>