@extends('admin.layout')

@section('content')
    <form class="container-1280 d-fc" action="/enter/furniture/update/null" method="post" enctype="multipart/form-data">
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

        <div class="furniture-wrapper d-fc">
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
                                    <img class="image-loader" src="{{ asset('images/furniture/lorem/main-banner.png') }}">
                                @endif
                                {{-- <div class="background-layer"></div> --}}
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="banner" id="banner">
                            </label>
                        </div>
                        <div class="text-wrapper">
                            {{-- <h1>ავეჯის დამზადება</h1> --}}
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
                                    <img class="image-loader" src="{{ asset('images/furniture/lorem/mob-banner.png') }}">
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
                    <div class="top container-1280 flex-wrap" id="append-cards">
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

            {{-- Bottom --}}
                <button class="s-collapse" type="button" data-target="#bottom-wrapper-ka">ქვედა ნაწილი</button>
                <div class="s-collapse" id="bottom-wrapper-ka">
                    <div class="bottom d-fc container-1280 mt-3">
                        <div class="section-title">
                            <i class="square"></i> <h2>რატომ კომპანია მეტრიქსი?</h2>
                        </div>
                        <div class="simple-universal-cards">
                            @if ( $data['exists'] )
                                @foreach ( ['certified', 'guarantee', 'clock', 'van'] as $index => $icon)
                                    <div class="simple-universal-card d-fc">
                                        <i class="yellow" id="{{ $icon }}"></i>
                                        <h3 contenteditable="true" data-text-to-value="#bottom-title-ka-{{ $index }}">{{ $data['bottom']['ka'][$index]['title'] }}</h3>
                                        <p contenteditable="true" data-html-to-value="#bottom-text-ka-{{ $index }}">{!! $data['bottom']['ka'][$index]['text'] !!}</p>
                                    </div>
                                    <input type="hidden" id="bottom-title-ka-{{ $index }}" name="bottom_titles_ka[]" value="{{ $data['bottom']['ka'][$index]['title'] }}" required>
                                    <input type="hidden" id="bottom-text-ka-{{ $index }}" name="bottom_texts_ka[]" value="{{ $data['bottom']['ka'][$index]['text'] }}" required>
                                @endforeach
                            @else
                                @foreach ( ['certified', 'guarantee', 'clock', 'van'] as $index => $icon)
                                    <div class="simple-universal-card d-fc">
                                        <i class="yellow" id="{{ $icon }}"></i>
                                        <h3 contenteditable="true" data-text-to-value="#bottom-title-ka-{{ $index }}">დააჭირეთ რედაქტირება რომ დაიწყოთ</h3>
                                        <p contenteditable="true" data-html-to-value="#bottom-text-ka-{{ $index }}">დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                                    </div>
                                    <input type="hidden" id="bottom-title-ka-{{ $index }}" name="bottom_titles_ka[]" value="დააჭირეთ რედაქტირება რომ დაიწყოთ" required>
                                    <input type="hidden" id="bottom-text-ka-{{ $index }}" name="bottom_texts_ka[]" value="დააჭირეთ რედაქტირება რომ დაიწყოთ" required>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            {{-- Bottom --}}
        </div>

        {{-- Italian --}}
            <button class="s-collapse" type="button" data-target="#it-wrapper" style="color: purple; border-color: purple;">იტალიანო</button>
            <div class="s-collapse d-fc" id="it-wrapper">
                {{-- Banner --}}
                    <button class="s-collapse mt-3" type="button" data-target="#banner-wrapper-it">ბანერი</button>
                    <div class="s-collapse d-fc" id="banner-wrapper-it">
                        <div class="universal-banner-wrapper darker">
                            <div class="image-wrapper">
                                <img class="image-loader" src="{{ asset($data['raw']['banner']) }}">
                            </div>
                            <div class="text-wrapper">
                                <p contenteditable="true" data-text-to-value="#banner-text-it">{{ ($data['exists']) ? $data['banner_text']['it'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}</p>
                            </div>
                        </div>
                    </div>
                {{-- Banner --}}

                {{-- Bottom --}}
                    <button class="s-collapse" type="button" data-target="#bottom-wrapper-it">ქვედა ნაწილი</button>
                    <div class="s-collapse" id="bottom-wrapper-it">
                        <div class="bottom d-fc container-1280 mt-3">
                            <div class="section-title">
                                <i class="square"></i> <h2>რატომ კომპანია მეტრიქსი?</h2>
                            </div>
                            <div class="simple-universal-cards">
                                @if ( $data['exists'] )
                                    @foreach ( ['certified', 'guarantee', 'clock', 'van'] as $index => $icon)
                                        <div class="simple-universal-card d-fc">
                                            <i class="yellow" id="{{ $icon }}"></i>
                                            <h3 contenteditable="true" data-text-to-value="#bottom-title-it-{{ $index }}">{{ $data['bottom']['it'][$index]['title'] }}</h3>
                                            <p contenteditable="true" data-html-to-value="#bottom-text-it-{{ $index }}">{!! $data['bottom']['it'][$index]['text'] !!}</p>
                                        </div>
                                        <input type="hidden" id="bottom-title-it-{{ $index }}" name="bottom_titles_it[]" value="{{ $data['bottom']['it'][$index]['title'] }}" required>
                                        <input type="hidden" id="bottom-text-it-{{ $index }}" name="bottom_texts_it[]" value="{{ $data['bottom']['it'][$index]['text'] }}" required>
                                    @endforeach
                                @else
                                    @foreach ( ['certified', 'guarantee', 'clock', 'van'] as $index => $icon)
                                        <div class="simple-universal-card d-fc">
                                            <i class="yellow" id="{{ $icon }}"></i>
                                            <h3 contenteditable="true" data-text-to-value="#bottom-title-it-{{ $index }}">დააჭირეთ რედაქტირება რომ დაიწყოთ</h3>
                                            <p contenteditable="true" data-html-to-value="#bottom-text-it-{{ $index }}">დააჭირეთ რედაქტირება რომ დაიწყოთ</p>
                                        </div>
                                        <input type="hidden" id="bottom-title-it-{{ $index }}" name="bottom_titles_it[]" value="დააჭირეთ რედაქტირება რომ დაიწყოთ" required>
                                        <input type="hidden" id="bottom-text-it-{{ $index }}" name="bottom_texts_it[]" value="დააჭირეთ რედაქტირება რომ დაიწყოთ" required>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                {{-- Bottom --}}
            </div>
        {{-- Italian --}}

        @include('admin.components.service-modal')

        @foreach ( ['ka', 'it'] as $locale )
            <input type="hidden" name="banner_text_{{ $locale }}" id="banner-text-{{ $locale }}" value="{{ ($data['exists']) ? $data['banner_text'][$locale] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}">
        @endforeach

        <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
    </form>
@endsection

@section('js')
    @include('admin.components.service-script')
@endsection