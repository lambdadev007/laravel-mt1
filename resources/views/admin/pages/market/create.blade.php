@extends('admin.layout')

@section('content')
    <form class="container-1280 d-fc" action="/enter/product/store" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        {{-- Meta --}}
            <button class="s-collapse container-800 mx-auto active" type="button" data-target="#meta">მეტა ინფორმაცია</button>
            <div class="s-collapse container-800 mx-auto d-fc show" id="meta">
                <div class="form-section d-fc">
                    <span class="letter-counter">0/60</span>
                    <input class="form-control" type="text" name="meta_title" placeholder="სათაური" value="{{ old('meta_title') }}" maxlength="60" required>
                </div>
                <div class="form-section d-fc">
                    <span class="letter-counter">0/135</span>
                    <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="135" required>{{ old('meta_description') }}</textarea>
                </div>
                <div class="form-section d-fc">
                    <span class="letter-counter">0/191</span>
                    <input class="form-control" type="text" placeholder="ბმული" name="slug" value="{{ old('slug') }}" maxlength="191" required>
                </div>
                <div class="form-section d-fc">
                    <span class="letter-counter">0/60</span>
                    <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ old('meta_keywords') }}" maxlength="60" required>
                </div>
            </div>
        {{-- Meta --}}

        {{-- Misc --}}
            <button class="s-collapse container-800 mx-auto active" type="button" data-target="#misc">დამაკავშირებელი ინფორმაცია</button>
            <div class="s-collapse container-800 mx-auto d-fc show" id="misc">
                <div class="form-section d-fc">
                    {{-- <h5>რა კატეგორიას ეკუთვნის პროდუქტი</h5> --}}
                    <select name="belongs_category" class="custom-select">
                        @foreach ( $product_categories['groups'] as $group )
                            <option value="{{ $group['has'] }}" data-connector="{{ $group['has'] }}">{{ $group['title'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-section d-fc">
                    {{-- <h5>რა ქვე-კატეგორიას ეკუთვნის პროდუქტი</h5> --}}
                    <select name="belongs_sub_category" class="custom-select">
                        @foreach ( $product_categories['sub_groups'] as $sub_group )
                            <option value="{{ $sub_group['search_id'] }}" data-connector="{{ $sub_group['belongs'] }}">{{ $sub_group['title'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-section d-fc">
                    {{-- <h5>ბრენდი</h5> --}}
                    <input class="form-control" type="text" name="brand" placeholder="ბრენდი" value="{{ old('brand') }}" required>
                </div>
                <div class="form-section d-fc">
                    {{-- <h5>ქვეყანა</h5> --}}
                    <input class="form-control" type="text" name="country" placeholder="ქვეყანა" value="{{ old('country') }}" required>
                </div>
            </div>
        {{-- Misc --}}

        {{-- Price and Variants --}}
            <button class="s-collapse container-800 mx-auto active" type="button" data-target="#price-and-variants">ფასი და ვარიანტები</button>
            <div class="s-collapse container-800 mx-auto d-flex flex-wrap show" id="price-and-variants">
                <div class="form-section col-6 d-fc">
                    <h5>ფასი</h5>
                    <input type="number" class="form-control" name="price" step="0.01" min="0" required>
                </div>
                <div class="form-section col-6 d-fc justify-content-end">
                    <label class="d-flex align-items-center ml-3 mb-2" for="discount-checkbox">
                        <h5 class="mr-3 mb-0">ფასდაკლება</h5>
                        <input type="checkbox" name="discount" value="true" id="discount-checkbox">
                    </label>
                    <input type="number" class="form-control" name="discount_amount" disabled>
                </div>
                <div class="form-section col-12 d-fc">
                    <h5>ზომის ერთეული</h5>
                    <input type="text" class="form-control" name="measuring" placeholder="მაგ: კგ">
                </div>

                <div class="product-table d-fc mb-5">
                    <div class="top-row product-table-row">
                        <div class="brand-space">
                            <div class="brand">ბრენდი</div>
                            <div class="space">
                                <label class="d-flex align-items-center mr-3">
                                    <span class="mr-1">კი</span> <input type="radio" id="has-variants" name="has_variants" value="true">
                                </label>
                                <label class="d-flex align-items-center">
                                    <span class="mr-1">არა</span> <input type="radio" id="has-variants" name="has_variants" value="false" checked>
                                </label>
                            </div>
                        </div>
                        <div class="top-section section weight-section">ზომის ერთ</div>
                        <div class="top-section section price-section">ფასი</div>
                        <div class="top-section section amount-section">რაოდენობა</div>
                        <div class="top-section section checkbox-section"></div>
                    </div>
                </div>

                <div class="form-section d-fc">
                    <button type="button" class="universal-button w-100 add-variant" disabled>ვარიანტის დამატება</button>
                </div>
            </div>
        {{-- Price and Variants --}}

        {{-- Card --}}
            {{-- <button class="s-collapse container-800 mx-auto active" type="button" data-target="#outer-product">გარე პროდუქტი</button>
            <div class="s-collapse container-800 mx-auto d-fc show" id="outer-product">
                <div class="market-item d-fc">
                    <a href="javascript:void(0)" class="d-fc">
                        <h5>CAPAROL</h5>
                        <img src="{{ asset('images/admin/upload-130-130.jpg') }}">
                        <p contenteditable="true" data-html-to-value="#card-description">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
                        <span class="price"><strong>₾ 28.00</strong> /ცალი</span>
                    </a>
                    <div class="actions">
                        <button type="button"><i class="orange" id="market-heart-hollow"></i></button>
                        <button type="button"><i class="dark" id="market-cart-empty"></i></button>
                    </div>
                    <input type="hidden" id="card-description" name="card_description" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required>
                </div>
            </div> --}}
        {{-- Card --}}

        {{-- Main --}}
            <button class="s-collapse active" type="button" data-target="#main">შიდა პროდუქტი</button>
            <div class="s-collapse d-fc show" id="main">
                <div class="market-wrapper d-fc product">
                    <div class="middle container-1280">
                        <div class="left d-fc">
                            <label class="image-reader-wrapper" for="product-image">
                                <img class="image-loader" src="{{ asset('images/admin/upload-400-400.jpg') }}">
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="card_image" id="product-image" required>
                                <div class="background-layer"></div>
                                <span class="dire-edit"></span>
                            </label>
                            {{-- <input type="text" class="form-control text-center w-100" name="image_alt" placeholder="სურათის ალტი" value="" required> --}}
                        </div>
                        <div class="middle d-fc">
                            <div class="layer-1">
                                <h1 contenteditable="true" data-html-to-value="#product-name">პროდუქტის სახელი, დააჭირეთ რომ შეცვალოთ</h1>
                            </div>
                            <div class="layer-3 d-fc">
                                <span class="item-description-header">პროდუქტის მოკლე აღწერა:</span>
                                <p class="item-description" contenteditable="true" data-text-to-value="#product-description">დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                            </div>
                            <input type="hidden" id="product-name" name="product_name" value="პროდუქტის სახელი, დააჭირეთ რომ შეცვალოთ" required>
                            <input type="hidden" id="product-description" name="product_description" value="დააჭირეთ რედაქტირება რომ დაიწყოთ" required>
                        </div>
                    </div>
                    <div class="bottom d-fc container-1280">
                        <h5><i class="square"></i> დამატებითი ინფორმაცია</h5>
                        <div class="additional-information-wrapper d-fc">
                            <button type="button" class="universal-button w-100 add-additional-info">დამატებითი ინფორმაციის დამატება</button>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Main --}}
        
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

            let i = 10000000

            $('input[name="discount"]').change(function() {
                if ( $(this).is(':checked') ) {
                    $('input[name="discount_amount"]').prop('disabled', false)
                } else {
                    $('input[name="discount_amount"]').prop('disabled', true)
                }
            })

            $('input[name="has_variants"]').change(function() {
                if ( $(this).val() == 'true' ) {
                    $('.add-variant').prop('disabled', false)
                    // $('input[name="variant_weights[]"]').each(function() {
                    //     $(this).prop('disabled', false)
                    // })
                    // $('input[name="variant_prices[]"]').each(function() {
                    //     $(this).prop('disabled', false)
                    // })
                } else {
                    $('.add-variant').prop('disabled', true)
                    // $('input[name="variant_weights[]"]').each(function() {
                    //     $(this).prop('disabled', true)
                    // })
                    // $('input[name="variant_prices[]"]').each(function() {
                    //     $(this).prop('disabled', true)
                    // })
                }
            })

            $(`select[name="belongs_sub_category"] option`).each(function() {
                $(this).prop('disabled', true)
                if ( $(this).data('connector') == $('select[name="belongs_category"] option:selected').data('connector') ) {
                    $(this).prop('disabled', false)
                }
            })

            $('select[name="belongs_category"]').click(function() {
                let query = $(this).find('option:selected').data('connector')
                $(`select[name="belongs_sub_category"] option`).prop('disabled', true)
                $(`select[name="belongs_sub_category"] option[data-connector="${query}"]`).prop('disabled', false)
            })

            function variant_markup() {
                return `<div class="product-table-row">
                            <div class="section variant justify-content-start px-3"><input type="text" class="form-control" name="variant_weights[]" placeholder="ვარიანტის რაოდენობა" required></div>
                            <div class="section weight-section"></div>
                            <div class="section price-section"><input type="number" class="form-control" name="variant_prices[]" step="0.01" min="0"  placeholder="ვარ. ფასი" required></div>
                            <div class="section amount-section"></div>
                            <div class="section checkbox-section"><span class="remove-this-item variant position-relative">&times;</span></div>
                            <input type="hidden" name="amount_of_variants[]" value="null" required>
                        </div>`
            }

            function additional_info_markup(i) {
                return `<div class="additional-information position-relative">
                            <p contenteditable="true" data-html-to-value="#additional-information-left-${i}">დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                            <p contenteditable="true" data-html-to-value="#additional-information-right-${i}">დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                            <input type="hidden" name="amount_of_additional_info[]" value="null">
                            <input type="hidden" id="additional-information-left-${i}" name="additional_information_left[]" value="დააჭირეთ რედაქტირება რომ დაიწყოთ" required>
                            <input type="hidden" id="additional-information-right-${i}" name="additional_information_right[]" value="დააჭირეთ რედაქტირება რომ დაიწყოთ" required>
                            <span class="remove-this-item additional-info" style="top: 50%; transform: translateY(-50%)">&times</span>
                        </div>`
            }

            $('.add-variant').click(function() {$('.product-table').append(variant_markup())})
            $('.add-additional-info').click(function() {
                $(this).parent('.additional-information-wrapper').append(additional_info_markup(i))
                i++
            })

            $('body').on('click', '.remove-this-item.variant', function() {$(this).parents('.product-table-row').remove()})
            $('body').on('click', '.remove-this-item.additional-info', function() {$(this).parent('.additional-information').remove()})
        })
    </script>
@endsection