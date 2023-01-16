@extends('admin.layout')

@section('content')
    <form class="container-800 flex-column" action="/enter/blog/store" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        {{-- Meta --}}
            <button class="s-collapse active" type="button" data-target="#meta">მეტა ინფორმაცია</button>
            <div class="s-collapse d-fc show" id="meta">
                <div class="form-section d-fc">
                    {{-- <h5>ვებ გვერდის სათაური / აუცილებელია</h5> --}}
                    <span class="letter-counter">0/60</span>
                    <input class="form-control" type="text" name="meta_title" placeholder="სათაური" value="{{ old('meta_title') }}" maxlength="60" required>
                </div>
                <div class="form-section d-fc">
                    {{-- <h5>მეტა დესქრიპშენი / აუცილებელია</h5> --}}
                    <span class="letter-counter">0/135</span>
                    <textarea class="form-control" rows="2" name="meta_description" placeholder="აღწერა" maxlength="135" required>{{ old('meta_description') }}</textarea>
                    {{-- <input class="form-control" type="text" name="meta_description" placeholder="აღწერა" value="{{ old('meta_description') }}" maxlength="155" required> --}}
                </div>
                <div class="form-section d-fc">
                    {{-- <h5>ბმული / აუცილებელია და უნდა იყოს უნიკალური</h5> --}}
                    <span class="letter-counter">0/191</span>
                    <input class="form-control" type="text" placeholder="ბმული" name="slug" value="{{ old('slug') }}" maxlength="191" required>
                </div>
                <div class="form-section d-fc">
                    {{-- <h5>მეტა კეივორდები / აუცილებელია</h5> --}}
                    <span class="letter-counter">0/60</span>
                    <input class="form-control" type="text" name="meta_keywords" placeholder="ქივორდები" value="{{ old('meta_keywords') }}" maxlength="60" required>
                </div>
                <div class="form-section d-fc">
                    <p>ლოკალიზაცია</p>
                    <div class="d-flex justify-content-around w-100">
                        <label class="d-fc align-items-center">
                            <span>KA</span>
                            <input type="radio" name="locale" value="ka" id="locale" checked>
                        </label>
                        <label class="d-fc align-items-center">
                            <span>ITA</span>
                            <input type="radio" name="locale" value="it" id="locale">
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
                                <img class="image-loader" src="{{ asset('images/admin/upload-article-card.jpg') }}">
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" id="article-card-image" name="card_image">
                                <div class="background-layer"></div>
                            </label>
                            <span class="floating-category orange">რემონტი</span>
                            <h5 class="title">სტატიის დასახელება საცდელ ტექსტად უნდა იყოს</h5>
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
                                <span class="date">01.01.2020</span>
                            </div>
                            <p class="description" contenteditable="true" data-text-to-value="#card-description">დააჭირეთ რომ ტექსტი შეცვალოთ</p>
                            <a class="bottom-button" href="javascript:void(0)">დაწვრილებით</a>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Article Card --}}

        {{-- Article Sidebar --}}
            <button class="s-collapse active" type="button" data-target="#sidebar-buttons">სტატიის გვერდითი ღილაკები</button>
            <div class="s-collapse d-fc show" id="sidebar-buttons">
                <div class="category-buttons admin">
                    <a href="javascript:void(0)">
                        <i class="icon" id="wrench"></i>
                        <span>VIP მასტერი</span>
                        <input type="text" class="form-control w-75" name="sidebar_link_vip" placeholder="ლინკი" value="https://www.metrix.ge/vip-master" required>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="icon" id="paint-brush"></i>
                        <span>დიზაინერი</span>
                        <input type="text" class="form-control w-75" name="sidebar_link_design" placeholder="ლინკი" value="https://www.metrix.ge/designer" required>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="icon" id="couch"></i>
                        <span>ავეჯის დამზადება</span>
                        <input type="text" class="form-control w-75" name="sidebar_link_furniture" placeholder="ლინკი" value="https://www.metrix.ge/furniture" required>
                    </a>
                    <a href="javascript:void(0)">
                        <i class="icon" id="paint-roller"></i>
                        <span>რემონტი</span>
                        <input type="text" class="form-control w-75" name="sidebar_link_repairs" placeholder="ლინკი" value="https://www.metrix.ge/repairs" required>
                    </a>
                </div>
            </div>
        {{-- Article Sidebar --}}

        {{-- Article--}}
            <button class="s-collapse active" type="button" data-target="#article">შიდა სტატია</button>
            <div class="s-collapse d-fc show" id="article">
                <div class="article-wrapper admin">
                    <div class="article">
                        <div class="article-banner">
                            <label class="image-reader-wrapper" for="article-banner">
                                <img class="image-loader" src="{{ asset('images/admin/upload-article-banner.jpg') }}">
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="banner" id="article-banner">
                                <div class="background-layer"></div>
                            </label>
                            <span class="floating-category yellow">
                                <select name="category">
                                    <option value="designer">დიზაინერი</option>
                                    <option value="repairs">რემონტი</option>
                                    <option value="furniture">ავეჯის დამზადება</option>
                                    <option value="vip">ვიპ-მასტერი</option>
                                </select>
                            </span>
                            <h1 contenteditable="true" data-text-to-value="#article-title">სტატიის სათაური, დააჭირეთ რომ შეცვალოთ</h1>
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
                            <span class="date">01.01.2020</span>
                        </div>
                        <div class="article-content">
                            <div class="paragraph-block" contenteditable="true" data-html-to-value="#paragraph-block-input-0">
                                <h2>გამოიყენეთ მხოლოდ 'სათაური 2' სათაურად</h2>
                                <p>დააჭირეთ რომ დაიწყოთ ტექსტის რედაქტირება, <b>თუ აქ ტექსტი არ გინდათ არ შეეხოთ</b></p>
                            </div>

                            <a href="javascript:void(0)" class="special-deal">
                                <p contenteditable="true" data-html-to-value="#spec-deal-text">დააჭირეთ რომ ტექსტი შეცვალოთ</p>
                                <button type="button" class="universal-button" id="link-popup">დააჭირეთ აქ რომ ბმული მიაბათ</button>
                            </a>

                            <div class="paragraph-block" contenteditable="true" data-html-to-value="#paragraph-block-input-1">
                                <p>დააჭირეთ რომ დაიწყოთ ტექსტის რედაქტირება, <b>თუ აქ ტექსტი არ გინდათ არ შეეხოთ</b></p>
                            </div>

                            <button type="button" class="universal-button w-100 mb-3" id="add-more-article-images">დააჭირეთ რომ სურათები დაამატოთ</button>
                            <div class="image-block">

                            </div>

                            <div class="paragraph-block" contenteditable="true" data-html-to-value="#paragraph-block-input-2">
                                <p>დააჭირეთ რომ დაიწყოთ ტექსტის რედაქტირება, <b>თუ აქ ტექსტი არ გინდათ არ შეეხოთ</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- Article--}}

        <input type="hidden" name="card_description" id="card-description" value="დააჭირეთ რომ ტექსტი შეცვალოთ">
        <input type="hidden" name="title" id="article-title" value="სტატიის სათაური, დააჭირეთ რომ შეცვალოთ">
        <input type="hidden" name="paragraph_block_0" id="paragraph-block-input-0" value="<h2>გამოიყენეთ მხოლოდ 'სათაური 2' სათაურად</h2><p>დააჭირეთ რომ დაიწყოთ ტექსტის რედაქტირება, <b>თუ აქ ტექსტი არ გინდათ არ შეეხოთ</b></p>">
        <input type="hidden" name="paragraph_block_1" id="paragraph-block-input-1" value="<h2>გამოიყენეთ მხოლოდ 'სათაური 2' სათაურად</h2><p>დააჭირეთ რომ დაიწყოთ ტექსტის რედაქტირება, <b>თუ აქ ტექსტი არ გინდათ არ შეეხოთ</b></p>">
        <input type="hidden" name="paragraph_block_2" id="paragraph-block-input-2" value="<h2>გამოიყენეთ მხოლოდ 'სათაური 2' სათაურად</h2><p>დააჭირეთ რომ დაიწყოთ ტექსტის რედაქტირება, <b>თუ აქ ტექსტი არ გინდათ არ შეეხოთ</b></p>">
        <input type="hidden" name="spec_deal_text" id="spec-deal-text" value="დააჭირეთ რომ ტექსტი შეცვალოთ">
        <input type="hidden" name="spec_deal_url" id="spec-deal-url" value="https://metrix.ge">
        
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

            let i = 0
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