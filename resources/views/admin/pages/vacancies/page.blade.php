@extends('admin.layout')

@php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
@endphp

@section('content')
    <form class="d-fc" action="/enter/vacancies/update/null" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        {{-- Meta --}}
            <div class="container-800 d-fc">
                <button class="s-collapse" type="button" data-target="#meta">მეტა ინფორმაცია</button>
                <div class="s-collapse d-fc" id="meta">
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_title" placeholder="სათაური" value="{{ ($data['exists']) ? $data['raw']['meta_title'] : '' }}" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/135</span>
                        <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="135" required>{{ ($data['exists']) ? $data['raw']['meta_description'] : '' }}</textarea>
                    </div>
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ ($data['exists']) ? $data['raw']['meta_keywords'] : '' }}" maxlength="60" required>
                    </div>
                </div>
            </div>
        {{-- Meta --}}

        {{-- About Services --}}
            <button class="s-collapse active" type="button" data-target="#page">ვაკანსიები</button>
            <div class="s-collapse d-fc show" id="page">
                <div class="vacancies-wrapper d-fc container-1280">
                    <div class="top d-fc">
                        <div class="sunken-title">
                            <h1>ვაკანსიები</h1> <i class="square"></i> @if ( !$agent->isMobile() && !$agent->isTablet() ) <i id="question-mark"></i> @endif <a href="#">როგორ დავრეგისტრირდე</a>
                        </div>
                        <div class="sunken-title-line"></div>
                        <div class="category-buttons">
                            <button type="button" class="active" data-group="repairs"><i id="paint-roller"></i> <p>რემონტი</p></button>
                            <button type="button" class="" data-group="vip"><i id="wrench"></i> <p>ვიპ-მასტერი</p></button>
                            <button type="button" class="" data-group="design"><i id="paint-brush"></i> <p>დიზაინერი</p></button>
                            <button type="button" class="" data-group="furniture"><i id="couch"></i> <p>ავეჯის დამზადება</p></button>
                            <button type="button" class="" data-group="legal-entity"><i id="legal-entity"></i> <p>იურიდიული პირებისთვის</p></button>
                        </div>
                    </div>
                    <div class="bottom">
                        @foreach (['furniture', 'vip', 'design', 'repairs', 'legal-entity'] as $group)
                            <div class="left w-100 d-fc {{ ($group != 'repairs') ? 'd-none' : '' }}" id="{{ $group }}">
                                <div class="vacancies-dropdowns-header">
                                    <span class="justify-content-start"><i class="dark" id="user"></i> ვაკანსიის დასახელება</span>
                                    <span class=""><i class="dark" id="calendar"></i> ბოლო ვადა</span>
                                    <span><i class="dark" id="pin"></i> სამუშაო არეალი</span>
                                    <span></span>
                                </div>
                                <button type="button" class="universal-button add-category w-100 mb-3" data-belongs="furniture">კატეგორიის დამატება</button>
                                @if ( $data['exists'] )
                                    @foreach ( $data['categories'] as $category )
                                        @if ( $category['belongs'] == $group )
                                            <div class="universal-dropdowns">
                                                <button type="button" data-toggle="collapse" data-target="#vacancies-dropdown-{{ $category['has'] }}" aria-expanded="false" aria-controls="vacancies-dropdown-{{ $category['has'] }}">
                                                    <div class="d-flex justify-content-start col-3">
                                                        <input type="text" name="category_titles[]" value="{{ $category['title'] }}" placeholder="ვაკანსიის დასახელება" required>
                                                    </div>
                                                    <div class="d-flex justify-content-center col-3">
                                                        <input type="text" class="text-center" name="category_final_date[]" value="{{ $category['final_date'] }}" placeholder="ბოლო ვადა" required>
                                                    </div>
                                                    <div class="d-flex justify-content-center col-3">
                                                        <input type="text" class="text-center" name="category_area_of_expertise[]" value="{{ $category['area_of_expertise'] }}" placeholder="სამუშაო არეალი" required>
                                                    </div>
                                                    <div class="col-3 d-flex justify-content-end">
                                                        <span class="icon-wrapper"><i class="white" id="nav-arrow"></i></span>
                                                        <span class="icon-wrapper remove-this-category ml-3 mr-5" data-target="vacancies-dropdown-{{ $category['has'] }}"><i class="dark" id="times"></i></span>
                                                    </div>
                                                </button>
                                                <div class="collapse" id="vacancies-dropdown-{{ $category['has'] }}">
                                                    <div class="universal-dropdown-items d-fc">
                                                        <button type="button" class="universal-button add-sub-category w-100 mb-3" data-belongs="{{ $category['has'] }}">ქვე-კატეგორიის დამატება</button>
                                                        @foreach ( $data['sub_categories'] as $sub_category )
                                                            @if ( $sub_category['belongs'] == $category['has'] )
                                                                <div class="universal-dropdown-item">
                                                                    <input type="text" name="sub_category_titles[]" value="{{ $sub_category['title'] }}" placeholder="ქვე-კატეგორია" required>
                                                                    <span class="remove-this-sub-category ml-3"><i class="orange" id="times"></i></span>
                                                                    <input type="hidden" name="amount_of_sub_categories[]" value="null" required>
                                                                    <input type="hidden" name="sub_category_belongs[]" value="{{ $sub_category['belongs'] }}" required>
                                                                    <input type="hidden" name="sub_category_ids[]" value="{{ $sub_category['id'] }}" required>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <input type="hidden" name="amount_of_categories[]" value="null" required>
                                                    <input type="hidden" name="category_belongs[]" value="{{ $category['belongs'] }}" required>
                                                    <input type="hidden" name="category_has[]" value="{{ $category['has'] }}" required>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        {{-- About Services --}}
        
        <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
    </form>
@endsection

@section('js')
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

            function category_markup(belongs, i = generate_random_string(32)) {
                return `<div class="universal-dropdowns">
                            <button type="button" data-toggle="collapse" data-target="#vacancies-dropdown-${i}" aria-expanded="false" aria-controls="vacancies-dropdown-${i}">
                                <div class="d-flex justify-content-start col-3">
                                    <input type="text" name="category_titles[]" placeholder="ვაკანსიის დასახელება" required>
                                </div>
                                <div class="d-flex justify-content-center col-3">
                                    <input type="text" class="text-center" name="category_final_date[]" placeholder="ბოლო ვადა" required>
                                </div>
                                <div class="d-flex justify-content-center col-3">
                                    <input type="text" class="text-center" name="category_area_of_expertise[]" placeholder="სამუშაო არეალი" required>
                                </div>
                                <div class="col-3 d-flex justify-content-end">
                                    <span class="icon-wrapper"><i class="white" id="nav-arrow"></i></span>
                                    <span class="icon-wrapper remove-this-category ml-3"><i class="dark" id="times"></i></span>
                                </div>
                            </button>
                            <div class="collapse" id="vacancies-dropdown-${i}">
                                <div class="universal-dropdown-items d-fc">
                                    <button type="button" class="universal-button add-sub-category w-100 mb-3" data-belongs="${i}">ქვე-კატეგორიის დამატება</button>
                                </div>
                            </div>
                            <input type="hidden" name="amount_of_categories[]" value="null" required>
                            <input type="hidden" name="category_belongs[]" value="${belongs}" required>
                            <input type="hidden" name="category_has[]" value="${i}" required>
                        </div>`
            }

            function sub_category_markup(belongs, i = generate_random_string(32)) {
                return `<div class="universal-dropdown-item">
                            <input type="text" name="sub_category_titles[]" placeholder="ქვე-კატეგორია" required>
                            <span class="remove-this-sub-category ml-3"><i class="orange" id="times"></i></span>
                            <input type="hidden" name="amount_of_sub_categories[]" value="null" required>
                            <input type="hidden" name="sub_category_belongs[]" value="${belongs}" required>
                            <input type="hidden" name="sub_category_ids[]" value="${i}" required>
                        </div>`
            }

            $('.vacancies-wrapper').on('click', 'input[type="text"]', function(e) {
                e.stopPropagation()
            })

            $('.add-category').click(function() {
                $(this).parent('.left').append(category_markup($(this).data('belongs')))
            })

            $('.vacancies-wrapper').on('click', '.add-sub-category', function() {
                $(this).parent('.universal-dropdown-items').append(sub_category_markup($(this).data('belongs')))
            })

            $('.vacancies-wrapper').on('click', '.remove-this-category', function() {
                let confirmation =  confirm('დარწმუნებული ხართ?')
                let target = $(this).data('target')
                if ( confirmation ) {
                    $(`button[aria-controls="${target}"]`).remove()
                    $(`#${target}`).remove()
                }
            })
            $('.vacancies-wrapper').on('click', '.remove-this-sub-category', function() {
                let confirmation =  confirm('დარწმუნებული ხართ?')
                if ( confirmation ) {
                    $(this).parent('.universal-dropdown-item').remove()
                }
            })
        })
    </script>
@endsection