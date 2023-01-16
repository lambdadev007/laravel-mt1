@extends('admin.layout')

@php
    $category_translation = [
        'designer' => 'დიზაინერი',
        'repairs' => 'რემონტი',
        'furniture' => 'ავეჯის დამზადება',
        'vip' => 'VIP - მასტერი'
    ];
@endphp

@section('content')
    <form class="container-800 flex-column" action="/enter/blog/update/{{ $data['raw']['id'] }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        {{-- Meta --}}
            <button class="s-collapse active" type="button" data-target="#meta">მეტა ინფორმაცია</button>
            <div class="s-collapse d-fc show" id="meta">
                <div class="form-section d-fc">
                    <span class="letter-counter">0/60</span>
                    <input class="form-control" type="text" name="meta_title" placeholder="სათაური" value="{{ $data['raw']['meta_title'] }}" maxlength="60" required>
                </div>
                <div class="form-section d-fc">
                    <span class="letter-counter">0/135</span>
                    <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="135" required>{{ $data['raw']['meta_description'] }}</textarea>
                    {{-- <input class="form-control" type="text" name="meta_description" placeholder="აღწერა" value="{{ $data['raw']['meta_description'] }}" maxlength="155" required> --}}
                </div>
                <div class="form-section d-fc">
                    <span class="letter-counter">0/191</span>
                    <input class="form-control" type="text" placeholder="ბმული" name="slug" value="{{ $data['raw']['og_slug'] }}" maxlength="191" required>
                </div>
                <div class="form-section d-fc">
                    <span class="letter-counter">0/60</span>
                    <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ $data['raw']['meta_keywords'] }}" maxlength="60" required>
                </div>
                <div class="form-section d-fc">
                    <p>ლოკალიზაცია</p>
                    <div class="d-flex justify-content-around w-100">
                        <label class="d-fc align-items-center">
                            <span>KA</span>
                            <input type="radio" name="locale" value="ka" id="locale" {{ ($data['raw']['locale'] == 'ka') ? 'checked' : '' }}>
                        </label>
                        <label class="d-fc align-items-center">
                            <span>ITA</span>
                            <input type="radio" name="locale" value="it" id="locale" {{ ($data['raw']['locale'] == 'it') ? 'checked' : '' }}>
                        </label>
                    </div>
                </div>
            </div>
        {{-- Meta --}}

        {{-- Article Card --}}
            <button class="s-collapse active" type="button" data-target="#card">გარე სტატია</button>
            <div class="s-collapse d-fc show" id="card">
                <div class="article-cards admin">
                    <div class="universal-card d-fc article-card">
                        <div class="top">
                            <label class="image-reader-wrapper" for="article-card-image">
                                <img class="image-loader" src="{{ asset($data['raw']['card_image']) }}">
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" id="article-card-image" name="card_image">
                                <div class="background-layer"></div>
                            </label>
                            <span class="floating-category orange">{{ $category_translation[$data['raw']['category']] }}</span>
                            <h5 class="title">{{ $data['raw']['title'] }}</h5>
                        </div>
                        <div class="bottom d-fc">
                            <div class="top-info">
                                <div class="views">
                                    <img src="{{ asset('images/blog/icon-views-orange.svg') }}">
                                    <span>263</span>
                                </div>
                                <div class="shares">
                                    <img src="{{ asset('images/blog/icon-share-orange.svg') }}">
                                    <span>76</span>
                                </div>
                                <span class="date">{{ $data['raw']['date_created'] }}</span>
                            </div>
                            <p class="description" contenteditable="true" data-text-to-value="#card-description">{{ $data['raw']['card_description'] }}</p>
                            <a class="bottom-button" href="javascript:void(0)">დაწვრილებით</a>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Article Card --}}

        {{-- Article Sidebar --}}
            @php
                $sidebar_links = json_decode($data['raw']['sidebar_links'], true);
            @endphp

            <button class="s-collapse active" type="button" data-target="#sidebar-buttons">სტატიის გვერდითი ღილაკები</button>
            <div class="s-collapse d-fc show" id="sidebar-buttons">
                <div class="category-buttons admin">
                    <a href="javascript:void(0)">
                        <i class="icon" id="wrench"></i>
                        <span>VIP მასტერი</span>
                        <input type="text" class="form-control w-75" name="sidebar_link_vip" value="{{ $sidebar_links['vip'] }}" placeholder="ლინკი" required>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="icon" id="paint-brush"></i>
                        <span>დიზაინერი</span>
                        <input type="text" class="form-control w-75" name="sidebar_link_design" value="{{ $sidebar_links['design'] }}" placeholder="ლინკი" required>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="icon" id="couch"></i>
                        <span>ავეჯის დამზადება</span>
                        <input type="text" class="form-control w-75" name="sidebar_link_furniture" value="{{ $sidebar_links['furniture'] }}" placeholder="ლინკი" required>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="icon" id="paint-roller"></i>
                        <span>რემონტი</span>
                        <input type="text" class="form-control w-75" name="sidebar_link_repairs" value="{{ $sidebar_links['repairs'] }}" placeholder="ლინკი" required>
                    </a>
                </div>
            </div>
        {{-- Article Sidebar --}}

        {{-- Article--}}
            @php
                $content = null;

                if ( $data['raw']['content'] != 'null' ) {
                    $content = json_decode($data['raw']['content'], true);
                }
            @endphp

            <button class="s-collapse active" type="button" data-target="#article">შიდა სტატია</button>
            <div class="s-collapse d-fc show" id="article">
                <div class="article-wrapper admin">
                    <div class="article w-100">
                        <div class="article-banner">
                            <label class="image-reader-wrapper" for="article-banner">
                                <img class="image-loader" src="{{ asset($data['raw']['banner']) }}">
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="banner" id="article-banner">
                                <div class="background-layer"></div>
                            </label>
                            <span class="floating-category yellow">
                                <select name="category">
                                    <option {{ ($data['raw']['category'] == 'designer') ? 'selected' : '' }} value="designer">დიზაინი</option>
                                    <option {{ ($data['raw']['category'] == 'repairs') ? 'selected' : '' }} value="repairs">რემონტი</option>
                                    <option {{ ($data['raw']['category'] == 'furniture') ? 'selected' : '' }} value="furniture">ავეჯი</option>
                                    <option {{ ($data['raw']['category'] == 'vip') ? 'selected' : '' }} value="vip">VIP - მასტერი</option>
                                </select>
                            </span>
                            <h1 contenteditable="true" data-text-to-value="#article-title">{{ $data['raw']['title'] }}</h1>
                        </div>
                        <div class="top-info">
                            <div class="views">
                                <img src="{{ asset('images/articles/icon-views-yellow.svg') }}">
                                <span>263</span>
                            </div>
                            <div class="shares">
                                <img src="{{ asset('images/articles/icon-share-yellow.svg') }}">
                                <span>76</span>
                            </div>
                            <span class="date">{{ $data['raw']['date_created'] }}</span>
                        </div>
                        <div class="article-content">
                            <div class="paragraph-block" contenteditable="true" data-html-to-value="#paragraph-block-input-0">
                                {!! $content['paragraph_block_0'] ?? '<p>ეს ტექსტის ბლოკი გამოყენებაში არ არის, <strong>არ შეეხოთ თუ არ გჭირდებათ</strong></p>' !!}
                            </div>

                            <a href="javascript:void(0)" class="special-deal">
                                <p contenteditable="true" data-html-to-value="#spec-deal-text">{!! $content['spec_deal_text'] !!}</p>
                                <button type="button" class="universal-button" id="link-popup">{{ $content['spec_deal_url'] }}</button>
                            </a>

                            <div class="paragraph-block" contenteditable="true" data-html-to-value="#paragraph-block-input-1">
                                {!! $content['paragraph_block_1'] ?? '<p>ეს ტექსტის ბლოკი გამოყენებაში არ არის, <strong>არ შეეხოთ თუ არ გჭირდებათ</strong></p>' !!}
                            </div>

                            <button type="button" class="universal-button w-100 mb-3" id="add-more-article-images">დააჭირეთ რომ სურათები დაამატოთ</button>
                            <div class="image-block">
                                @if ( $data['raw']['inner_images'] != 'null' )
                                    @foreach (json_decode($data['raw']['inner_images'], true) as $index => $value)
                                        <label class="image-reader-wrapper d-fc" for="inner-image-{{ $index }}">
                                            <div class="remove-this-item">&times;</div>
                                            <img class="image-loader" src="{{ asset($value) }}">
                                            <span class="dire-edit"></span>
                                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="inner_images[]" id="inner-image-{{ $index }}">
                                            <input type="text" class="form-control text-center" name="inner_image_alts[]" value="{{ json_decode($data['raw']['inner_image_alts'], true)[$index] }}" placeholder="სურათის alt ინფორმაცია" required>
                                            <input type="hidden" name="existing_inner_images[]" value="{{ asset($value) }}">
                                            <input type="hidden" name="amount_of_inner_images[]" value="null">
                                        </label>
                                    @endforeach
                                @endif
                            </div>

                            <div class="paragraph-block" contenteditable="true" data-html-to-value="#paragraph-block-input-2">
                                {!! $content['paragraph_block_2'] ?? '<p>ეს ტექსტის ბლოკი გამოყენებაში არ არის, <strong>არ შეეხოთ თუ არ გჭირდებათ</strong></p>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Article--}}

        <input type="hidden" name="card_description" id="card-description" value="{{ $data['raw']['card_description'] }}">
        <input type="hidden" name="title" id="article-title" value="{{ $data['raw']['title'] }}">
        <input type="hidden" name="paragraph_block_0" id="paragraph-block-input-0" value="{{ $content['paragraph_block_0'] ?? '' }}">
        <input type="hidden" name="paragraph_block_1" id="paragraph-block-input-1" value="{{ $content['paragraph_block_1'] ?? '' }}">
        <input type="hidden" name="paragraph_block_2" id="paragraph-block-input-2" value="{{ $content['paragraph_block_2'] ?? '' }}">
        <input type="hidden" name="spec_deal_text" id="spec-deal-text" value="{{ $content['spec_deal_text'] }}">
        <input type="hidden" name="spec_deal_url" id="spec-deal-url" value="{{ $content['spec_deal_url'] }}">
        
        <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
    </form>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#link-popup').click(function() {
                let link = prompt("გთხოვთ აქ ლინკი ჩაწეროთ")

                if ( link == null || link == '' ) {
                    $(this).text('ლინკი არ იყო ჩაწერილი')
                } else {
                    $(this).text(link)
                    $('#spec-deal-url').val(link)
                }
            })

            let i = 1000000
            function image_markup(i) {
                return `<label class="image-reader-wrapper d-fc" for="inner-image-${i}">
                            <div class="remove-this-item">&times;</div>
                            <img class="image-loader" src="{{ asset('images/enter/upload-article-inner.jpg') }}">
                            <span class="dire-edit"></span>
                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="inner_images[]" id="inner-image-${i}" required>
                            <input type="text" class="form-control text-center" name="inner_image_alts[]" placeholder="სურათის alt ინფორმაცია" required>
                            <input type="hidden" name="amount_of_inner_images[]" value="null">
                        </label>`
            }

            $('#add-more-article-images').click(function() {
                $('.image-block').append(image_markup(i))
                i++
            })

            $('.image-block').on('click', '.remove-this-item', function() {
                $(this).parents('label').remove()
            })
        })
    </script>
@endsection