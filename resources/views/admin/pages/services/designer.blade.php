@extends('admin.layout')

@section('content')
    <form class="container-1280 d-fc" action="/enter/designer/update/null" method="post" enctype="multipart/form-data">
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
                        <span class="letter-counter">0</span>
                        <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="" required>{{ ($data['exists']) ? $data['raw']['meta_description'] : '' }}</textarea>
                    </div>
                    <div class="form-section d-fc">
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ ($data['exists']) ? $data['raw']['meta_keywords'] : '' }}" maxlength="60" required>
                    </div>
                </div>
            </div>
        {{-- Meta --}}

        <div class="designer-wrapper d-fc">
            {{-- Banner --}}
                <button class="s-collapse" type="button" data-target="#banner-wrapper">ბანერი</button>
                <div class="s-collapse d-fc" id="banner-wrapper">
                    <div class="universal-banner-wrapper darker">
                        <div class="image-wrapper">
                            <label class="image-reader-wrapper w-100" for="banner">
                                @if ( $data['exists'] )
                                    <img class="image-loader" src="{{ asset($data['raw']['banner']) }}">
                                    <input type="hidden" name="existing_banner" value="{{ $data['raw']['banner'] }}" required>
                                @else
                                    <img class="image-loader" src="{{ asset('images/designer/lorem/main-banner.png') }}">
                                @endif
                                {{-- <div class="background-layer"></div> --}}
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="banner" id="banner">
                            </label>
                        </div>
                        <div class="text-wrapper">
                            {{-- <h1>დიზაინერი</h1> --}}
                            <p contenteditable="true" data-text-to-value="#banner-text-ka">{{ ($data['exists']) ? $data['banner_text']['ka'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}</p>
                        </div>
                    </div>
                </div>
            {{-- Banner --}}

            {{-- Mob Banner --}}
                <button class="s-collapse" type="button" data-target="#mob-banner-wrapper">მობილური ბანერი</button>
                <div class="s-collapse d-fc" id="mob-banner-wrapper">
                    <div class="universal-banner-wrapper darker w-375 mx-auto">
                        <div class="image-wrapper">
                            <label class="image-reader-wrapper w-100" for="mob-banner">
                                @if ( $data['exists'] )
                                    <img class="image-loader" src="{{ asset($data['raw']['mob_banner']) }}">
                                    <input type="hidden" name="existing_mob_banner" value="{{ $data['raw']['mob_banner'] }}" required>
                                @else
                                    <img class="image-loader" src="{{ asset('images/designer/lorem/mob-banner.png') }}">
                                @endif
                                {{-- <div class="background-layer"></div> --}}
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="mob_banner" id="mob-banner">
                            </label>
                        </div>
                    </div>
                </div>
            {{-- Mob Banner --}}

            {{-- Cards --}}
                <button class="s-collapse" type="button" data-target="#cards-wrapper">პაკეტები</button>
                <div class="s-collapse d-fc" id="cards-wrapper">
                    <div class="top container-1280" id="append-cards">
                        <div class="universal-button add-cards w-100 mb-3">პაკეტის დამატება</div>
                        @if ( $data['exists'] && $data['content'] != [] )
                            @foreach ( $data['content']['cards'] as $index => $card )
                                <div class="universal-card d-fc service">
                                    <span class="remove-this-item" data-target="#card-modal-{{ $index }}">&times</span>
                                    <h3 contenteditable="true" data-text-to-value="#card-title-{{ $index }}">{{ $card['title'] }}</h3>
                                    <p class="price">₾<strong contenteditable="true" data-text-to-value="#card-price-{{ $index }}">{{ $card['price'] }}</strong> <span>m2</span></p>
                                    <p class="description" contenteditable="true" data-text-to-value="#card-description-{{ $index }}">{{ $card['description'] }}</p>
                                    <button type="button" class="bottom-button" data-toggle="modal" data-target="#card-modal-{{ $index }}">დაწვრილებით</button>

                                    <input type="hidden" name="amount_of_cards[]" value="null">
                                    <input type="hidden" id="card-title-{{ $index }}" name="card_titles[]" value="{{ $card['title'] }}">
                                    <input type="hidden" id="card-price-{{ $index }}" name="card_prices[]" value="{{ $card['price'] }}">
                                    <input type="hidden" id="card-description-{{ $index }}" name="card_descriptions[]" value="{{ $card['description'] }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            {{-- Cards --}}

            {{-- Tabs --}}
                <button class="s-collapse" type="button" data-target="#tabs-wrapper-ka">დიზაინის სტილები</button>
                <div class="s-collapse" id="tabs-wrapper-ka">
                    <div class="middle d-fc container-1280">
                        <button type="button" class="universal-button w-100 my-3" id="add-tabs">დიზაინის სტილის დამატება</button>
                        <div class="categories">
                            @if ( $data['exists'] && $data['tabs'] != [] )
                                @foreach ( $data['tabs'] as $index => $tab )
                                    <button type="button" class="designer-tab-buttons {{ $index }} {{ ($index == 0) ? 'active' : '' }}" id="designer-tab-button-ka-{{ $index }}" data-target="#designer-tab-ka-{{ $index }}">{{ $tab['ka']['title'] }}</button>
                                @endforeach
                            @endif
                        </div>
                        <div class="information position-relative">
                            @if ( $data['exists'] && $data['tabs'] != [] )
                                @foreach ( $data['tabs'] as $index => $tab )
                                    <div class="tab {{ $index }} {{ ($index == 0) ? '' : 'hidden' }}" id="designer-tab-ka-{{ $index }}">
                                        <span class="remove-this-item" data-index="{{ $index }}">&times</span>
                                        <div class="left">
                                            <label class="image-reader-wrapper" for="designer-tab-image-{{ $index }}">
                                                <img class="image-loader" src="{{ asset($tab['image_location']) }}">
                                                <div class="background-layer"></div>
                                                <span class="dire-edit"></span>
                                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="designer_tab_images[]" id="designer-tab-image-{{ $index }}">
                                                <input type="hidden" name="existing_designer_tab_images[]" value="{{ $tab['image_location'] }}" required>
                                            </label>
                                            <input type="text" class="form-control text-center w-100" name="designer_tab_image_alts[]" placeholder="სურათის ალტი" value="{{ $tab['image_alt'] }}" required>
                                        </div>
                                        <div class="right d-fc">
                                            <div class="title">
                                                <h3>დიზაინის სტილი</h3>
                                                <i class="square"></i>
                                                <span contenteditable="true" data-text-to-value="#designer-tab-title-ka-{{ $index }}" data-text-to-text="#designer-tab-button-ka-{{ $index }}">{{ $tab['ka']['title'] }}</span>
                                            </div>

                                            <div class="text" contenteditable="true" data-html-to-value="#designer-tab-text-ka-{{ $index }}">{!! $tab['ka']['text'] !!}</div>
                                        </div>
                                        <input type="hidden" name="amount_of_designer_tabs[]" value="null" required>
                                        <input type="hidden" id="designer-tab-title-ka-{{ $index }}" name="designer_tab_titles_ka[]" value="{{ $tab['ka']['title'] }}" required>
                                        <input type="hidden" id="designer-tab-text-ka-{{ $index }}" name="designer_tab_texts_ka[]" value="{{ $tab['ka']['text'] }}" required>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            {{-- Tabs --}}

            {{-- Render --}}
                <button class="s-collapse" type="button" data-target="#render-wrapper">სურათები</button>
                <div class="s-collapse d-fc" id="render-wrapper">
                    <div class="bottom d-fc container-1280">
                        <div class="section-title">
                            <i class="square"></i> <h2>რენდერიდან რეალურ შესრულებამდე</h2>
                        </div>
                                                
                        <div class="images">
                            @foreach (['left', 'right'] as $direction)
                                <div class="{{ $direction }}">
                                    @php
                                        $i = [];
                                        if ( $direction == 'left' ) $i = [0,1];
                                        if ( $direction == 'right' ) $i = [2,3];
                                    @endphp
                                    @foreach ($i as $in) 
                                        <div class="d-fc">
                                            <label class="image-reader-wrapper" for="designer-render-{{ $in }}">
                                                @if ( $data['exists'] )
                                                    <img class="image-loader" src="{{ asset($data['render'][$in]['location']) }}">
                                                    <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="designer_render_images[]" id="designer-render-{{ $in }}">
                                                    <input type="hidden" name="existing_designer_render_images[]" value="{{ $data['render'][$in]['location'] }}" required>
                                                @else
                                                    <img class="image-loader" src="{{ asset('images/admin/upload-299-220.jpg') }}">
                                                    <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="designer_render_images[]" id="designer-render-{{ $in }}" required>
                                                @endif
                                                <div class="background-layer"></div>
                                                <span class="dire-edit"></span>
                                            </label>
                                            <input type="text" class="form-control text-center w-100" name="designer_render_image_alts[]" placeholder="სურათის ალტი" value="{{ ($data['exists']) ? $data['render'][$in]['alt'] : '' }}" required>
                                        </div>
                                    @endforeach
                                    <div class="floating-text">
                                        <p>რენდერი</p>
                                        <div class="line"></div>
                                        <p>რეალობა</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            {{-- Render --}}

            {{-- Italian --}}
                <button class="s-collapse" type="button" data-target="#it-wrapper" style="color: purple; border-color: purple;">იტალიანო</button>
                <div class="s-collapse d-fc" id="it-wrapper">
                    {{-- Banner --}}
                        <button class="s-collapse mt-3" type="button" data-target="#banner-wrapper-it">ბანერი</button>
                        <div class="s-collapse d-fc" id="banner-wrapper-it">
                            <div class="universal-banner-wrapper darker">
                                <div class="image-wrapper">
                                    @if ( $data['exists'] )
                                        <img class="image-loader" src="{{ asset($data['raw']['banner']) }}">
                                    @else
                                        <img class="image-loader" src="{{ asset('images/designer/lorem/main-banner.png') }}">
                                    @endif
                                </div>
                                <div class="text-wrapper">
                                    {{-- <h1>დიზაინერი</h1> --}}
                                    <p contenteditable="true" data-text-to-value="#banner-text-it">{{ ($data['exists']) ? $data['banner_text']['it'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}</p>
                                </div>
                            </div>
                        </div>
                    {{-- Banner --}}

                    {{-- Tabs --}}
                        <button class="s-collapse" type="button" data-target="#tabs-wrapper-it">დიზაინის სტილები</button>
                        <div class="s-collapse" id="tabs-wrapper-it">
                            <div class="middle d-fc container-1280">
                                <div class="categories">
                                    @if ( $data['exists'] && $data['tabs'] != [] )
                                        @foreach ( $data['tabs'] as $index => $tab )
                                            <button type="button" class="designer-tab-buttons {{ $index }} {{ ($index == 0) ? 'active' : '' }}" id="designer-tab-button-it-{{ $index }}" data-target="#designer-tab-it-{{ $index }}">{{ $tab['it']['title'] }}</button>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="information position-relative">
                                    @if ( $data['exists'] && $data['tabs'] != [] )
                                        @foreach ( $data['tabs'] as $index => $tab )
                                            <div class="tab {{ $index }} {{ ($index == 0) ? '' : 'hidden' }}" id="designer-tab-it-{{ $index }}">
                                                <div class="left">
                                                    <label class="image-reader-wrapper" for="designer-tab-image-{{ $index }}">
                                                        <img class="image-loader" src="{{ asset($tab['image_location']) }}">
                                                        <div class="background-layer"></div>
                                                    </label>
                                                    <input type="text" class="form-control text-center w-100" name="designer_tab_image_alts[]" placeholder="სურათის ალტი" value="{{ $tab['image_alt'] }}" required>
                                                </div>
                                                <div class="right d-fc">
                                                    <div class="title">
                                                        <h3>დიზაინის სტილი</h3>
                                                        <i class="square"></i>
                                                        <span contenteditable="true" data-text-to-value="#designer-tab-title-it-{{ $index }}" data-text-to-text="#designer-tab-button-it-{{ $index }}">{{ $tab['it']['title'] }}</span>
                                                    </div>

                                                    <div class="text" contenteditable="true" data-html-to-value="#designer-tab-text-it-{{ $index }}">{!! $tab['it']['text'] !!}</div>
                                                </div>
                                                <input type="hidden" id="designer-tab-title-it-{{ $index }}" name="designer_tab_titles_it[]" value="{{ $tab['it']['title'] }}" required>
                                                <input type="hidden" id="designer-tab-text-it-{{ $index }}" name="designer_tab_texts_it[]" value="{{ $tab['it']['text'] }}" required>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    {{-- Tabs --}}
                </div>
            {{-- Italian --}}
        </div>

        @include('admin.components.service-modal')

        @foreach ( ['ka', 'it'] as $locale )
            <input type="hidden" name="banner_text_{{ $locale }}" id="banner-text-{{ $locale }}" value="{{ ($data['exists']) ? $data['banner_text'][$locale] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}">
        @endforeach

        <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
    </form>
@endsection

@section('js')
    @include('admin.components.service-script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Tabs
                function generate_random_string(length) {
                    let result = '';
                    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    let charactersLength = characters.length;
                    for (let i = 0; i < length; i++) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return result;
                }

                function tab_button_markup(i, locale) {
                    return `<button type="button" class="designer-tab-buttons active" id="designer-tab-button-${locale}-${i}" data-target="#designer-tab-${locale}-${i}">ლორემ</button>`
                }

                function tab_content_markup_ka(i) {
                    return `<div class="tab ${i}" id="designer-tab-ka-${i}">
                                <span class="remove-this-item" data-index="${i}">&times</span>
                                <div class="left">
                                    <label class="image-reader-wrapper" for="designer-tab-image-${i}">
                                        <img class="image-loader" src="{{ asset('images/admin/upload-507-205.jpg') }}">
                                        <div class="background-layer"></div>
                                        <span class="dire-edit"></span>
                                        <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="designer_tab_images[]" id="designer-tab-image-${i}"  data-special-alert="დიზაინის სტილებში სურათი აკლია" required>
                                    </label>
                                    <input type="text" class="form-control text-center w-100" name="designer_tab_image_alts[]" placeholder="სურათის ალტი" required>
                                </div>
                                <div class="right d-fc">
                                    <div class="title">
                                        <h3>დიზაინის სტილი</h3>
                                        <i class="square"></i>
                                        <span contenteditable="true" data-text-to-value="#designer-tab-title-ka-${i}" data-text-to-text="#designer-tab-button-ka-${i}">ლორემ</span>
                                    </div>

                                    <div class="text" contenteditable="true" data-html-to-value="#designer-tab-text-ka-${i}">
                                        <p>დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                                    </div>
                                </div>
                                <input type="hidden" name="amount_of_designer_tabs[]" value="null" required>
                                <input type="hidden" id="designer-tab-title-ka-${i}" name="designer_tab_titles_ka[]" value="ლორემ" required>
                                <input type="hidden" id="designer-tab-text-ka-${i}" name="designer_tab_texts_ka[]" value="<p>დააჭირეთ რედაქტირება რომ დაიწყოთ</p>" required>
                            </div>`
                }

                function tab_content_markup_locale(i, locale) {
                    return `<div class="tab ${i}" id="designer-tab-${locale}-${i}">
                                <div class="left">
                                    <img class="image-loader" src="{{ asset('images/admin/upload-507-205.jpg') }}">
                                </div>
                                <div class="right d-fc">
                                    <div class="title">
                                        <h3>დიზაინის სტილი</h3>
                                        <i class="square"></i>
                                        <span contenteditable="true" data-text-to-value="#designer-tab-title-${locale}-${i}" data-text-to-text="#designer-tab-button-${locale}-${i}">ლორემ</span>
                                    </div>

                                    <div class="text" contenteditable="true" data-html-to-value="#designer-tab-text-${locale}-${i}">
                                        <p>დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                                    </div>
                                </div>
                                <input type="hidden" id="designer-tab-title-${locale}-${i}" name="designer_tab_titles_${locale}[]" value="ლორემ" required>
                                <input type="hidden" id="designer-tab-text-${locale}-${i}" name="designer_tab_texts_${locale}[]" value="<p>დააჭირეთ რედაქტირება რომ დაიწყოთ</p>" required>
                            </div>`
                }

                $('#add-tabs').click(function() {
                    let i = generate_random_string(16)
                    $(this).siblings('.categories').append(tab_button_markup(i, 'ka'))
                    $(this).siblings('.information').append(tab_content_markup_ka(i))
                    $('#it-wrapper .categories').append(tab_button_markup(i, 'it'))
                    $('#tabs-wrapper-it .information').append(tab_content_markup_locale(i, 'it'))
                })

                $('body').on('click', '.tab > .remove-this-item', function() {
                    $(`.designer-tab-buttons.${$(this).data('index')}`).remove()
                    $(`.tab.${$(this).data('index')}`).remove()
                })
            // Tabs
        })
    </script>
@endsection