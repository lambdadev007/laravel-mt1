@extends('admin.layout')

@section('content')
    <form class="container-1280 d-fc" action="/enter/product-categories/update/null" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        <div class="modal-content modal-custom modal-1160 modal-projects mx-auto my-3 pb-3">
            <p class="text-center my-3"><strong>რედაქტირება რომ დაიწყოთ დააჭირეთ ზოგადი კატეგორიების რომელიმე ღილაკს</strong></p>
            <div class="all-categories-popup-buttons">
                <button type="button" class="add-main universal-button">ზოგადი კატეგორიების დამატება</button>
                <button type="button" class="add-category-group universal-button" data-target="" disabled>კატეგორიების ჯგუფის დამატება</button>
            </div>
            <div class="all-categories-popup page my-3">
                <div class="inner m-auto">
                    <div class="left d-fc">
                        @if ( $data['exists'] )
                            @foreach ( $data['main'] as $main_index => $main )
                                <div class="{{ $main['has'] }}">
                                    <button type="button" class="toggle-main-category" data-target="{{ $main['has'] }}">
                                        <input type="text" name="main_category_titles[]" placeholder="კატეგორიის სახელი" value="{{ $main['title'] }}" required>
                                        <span class="remove-this-item main-category" data-target="{{ $main['has'] }}">&times</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="right">
                        @if ( $data['exists'] )
                            @foreach ( $data['main'] as $main_index => $main )
                                <div class="groups-wrapper {{ $main['has'] }} d-none position-static">
                                    @foreach ( $data['groups'] as $group_index => $group )
                                        @if ( $group['belongs'] == $main['has'] )
                                            <div class="category">
                                                <div class="title">
                                                    <h5>
                                                        <input type="text" name="category_group_titles[]" value="{{ $group['title'] }}" placeholder="ჯგუფის სახელი" required>
                                                        <button type="button" class="add-sub-group" data-category-group-id="{{ $group['has'] }}">+</button>
                                                        <button type="button" class="remove-this-group">&times</button>
                                                    </h5>
                                                    <div class="underline"></div>
                                                </div>
                                                <div class="links d-fc">
                                                    @foreach ( $data['sub_groups'] as $sub_category_index => $sub_group )
                                                        @if ( $sub_group['belongs'] == $group['has'] )
                                                            <div class="mb-1">
                                                                <input type="text" name="sub_group_titles[]" value="{{ $sub_group['title'] }}" placeholder="კატეგორიის სახელი" required>
                                                                <button type="button" class="remove-this-sub-group">&times</button>
                                                                <input type="hidden" name="amount_of_sub_groups[]" value="null" required>
                                                                <input type="hidden" name="sub_group_search_ids[]" value="{{ $sub_group['search_id'] }}" required>
                                                                <input type="hidden" name="sub_group_belongs[]" value="{{ $sub_group['belongs'] }}" required>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="amount_of_category_groups[]" value="null" required>
                                                <input type="hidden" name="category_group_belongs[]" value="{{ $group['belongs'] }}" required>
                                                <input type="hidden" name="category_group_has[]" value="{{ $group['has'] }}" required>
                                            </div>
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="amount_of_main_groups[]" value="null" required>
                                    <input type="hidden" name="main_group_has[]" value="{{ $main['has'] }}" required>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="outer toggle-market-all-categories-popup"></div>
                <span class="toggle-market-all-categories-popup">&times</span>
            </div>
        </div>

        <div class="modal-content border-0 modal-1160 mx-auto">
            <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
        </div>
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

            function main_category_markup(main_category_id, category_group_id) {
                let data = {
                    button: `<div class="${main_category_id}">
                                    <button type="button" class="toggle-main-category" data-target="${main_category_id}">
                                        <input type="text" name="main_category_titles[]" placeholder="კატეგორიის სახელი" value="" required>
                                        <span class="remove-this-item main-category" data-target="${main_category_id}">&times</span>
                                    </button>
                                </div>`,
                    wrapper: `<div class="groups-wrapper ${main_category_id} d-none">
                                    <div class="category">
                                        <div class="title">
                                            <h5>
                                                <input type="text" name="category_group_titles[]" value="" placeholder="ჯგუფის სახელი" required>
                                                <button type="button" class="add-sub-group" data-category-group-id="${category_group_id}">+</button>
                                                <button type="button" class="remove-this-group">&times</button>
                                            </h5>
                                            <div class="underline"></div>
                                        </div>
                                        <div class="links d-fc">
                                        </div>
                                        <input type="hidden" name="amount_of_category_groups[]" value="null" required>
                                        <input type="hidden" name="category_group_belongs[]" value="${main_category_id}" required>
                                        <input type="hidden" name="category_group_has[]" value="${category_group_id}" required>
                                    </div>
                                    <input type="hidden" name="amount_of_main_groups[]" value="null" required>
                                    <input type="hidden" name="main_group_has[]" value="${main_category_id}" required>
                                </div>`
                }
                return data
            }

            function category_group_markup(main_category_id, category_group_id) {
                return `<div class="category">
                            <div class="title">
                                <h5>
                                    <input type="text" name="category_group_titles[]" value="" placeholder="ჯგუფის სახელი" required>
                                    <button type="button" class="add-sub-group" data-category-group-id="${category_group_id}">+</button>
                                    <button type="button" class="remove-this-group">&times</button>
                                </h5>
                                <div class="underline"></div>
                            </div>
                            <div class="links d-fc">
                            </div>
                            <input type="hidden" name="amount_of_category_groups[]" value="null" required>
                            <input type="hidden" name="category_group_belongs[]" value="${main_category_id}" required>
                            <input type="hidden" name="category_group_has[]" value="${category_group_id}" required>
                        </div>`
            }

            function sub_category_markup(category_group_id, sub_category_id) {
                return `<div class="mb-1">
                            <input type="text" name="sub_group_titles[]" value="" placeholder="კატეგორიის სახელი" required>
                            <button type="button" class="remove-this-sub-group">&times</button>
                            <input type="hidden" name="amount_of_sub_groups[]" value="null" required>
                            <input type="hidden" name="sub_group_search_ids[]" value="${sub_category_id}" required>
                            <input type="hidden" name="sub_group_belongs[]" value="${category_group_id}" required>
                        </div>`
            }

            $('.add-main').click(function() {
                let data = main_category_markup(generate_random_string(32), generate_random_string(32), generate_random_string(32))
                $('.all-categories-popup .inner .left').append(data.button)
                $('.all-categories-popup .inner .right').append(data.wrapper)
            })

            $('body').on('click', '.add-category-group', function() {
                $(`.groups-wrapper.${$(this).data('target')}`).append(category_group_markup($(this).data('target'), generate_random_string(32)))
            })

            $('body').on('click', '.add-sub-group', function() {
                $(this).parents('.title').siblings('.links').append(sub_category_markup($(this).data('category-group-id'), generate_random_string(32)))
            })

            $('body').on('click', '.toggle-main-category', function() {
                $(this).parent('div').siblings('div').removeClass('active')
                $(this).parent('div').addClass('active')
                $('.all-categories-popup .inner .right .groups-wrapper').addClass('d-none')
                $(`.all-categories-popup .inner .right .${$(this).data('target')}`).removeClass('d-none')
                $('.add-category-group').prop('disabled', false)
                $('.add-category-group').data('target', $(this).data('target'))
            })

            $('body').on('click', '.remove-this-item.main-category', function() {$(`.${$(this).data('target')}`).remove()})
            $('body').on('click', '.remove-this-group', function() {$(this).parents('.category').remove()})
            $('body').on('click', '.remove-this-sub-group', function() {$(this).parent('div').remove()})
        })
    </script>
@endsection