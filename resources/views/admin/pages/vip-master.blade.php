@extends('admin.layout')

@section('content')
    <form class="container-1280 d-fc" action="/enter/vip-master/update/null" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        {{-- Meta --}}
            <div class="container-800 d-fc">
                <button class="s-collapse" type="button" data-target="#meta">მეტა ინფორმაცია</button>
                <div class="s-collapse d-fc" id="meta">
                    @php
                        $categories = ['კარ-ფანჯარა და საკეტები','ელექტროობა','კანალიზაცია','სანტექნიკა','გათბობა/კონდიცირება','საყოფაცხოვრებო ტექნიკა','უნივერსალური სამუშაოები'];
                    @endphp
                    @foreach ( $categories as $index => $category )
                        <h5 class="text-center mt-5">{{ $category }}</h5>
                        <div class="form-section d-fc">
                            <span class="letter-counter">0/60</span>
                            <input class="form-control" type="text" name="meta_title[]" placeholder="სათაური" value="{{ ($data['exists']) ? $data['meta'][$index]['meta_title'] : '' }}" maxlength="60" required>
                        </div>
                        <div class="form-section d-fc">
                            <span class="letter-counter">0</span>
                            <textarea class="form-control" rows="2" name="meta_description[]" placeholder="აღწერა" maxlength="" required>{{ ($data['exists']) ? $data['meta'][$index]['meta_description'] : '' }}</textarea>
                        </div>
                        <div class="form-section d-fc">
                            <span class="letter-counter">0/60</span>
                            <input class="form-control" type="text" name="meta_keywords[]" placeholder="ქივორდები" value="{{ ($data['exists']) ? $data['meta'][$index]['meta_keywords'] : '' }}" maxlength="60" required>
                        </div>
                    @endforeach
                </div>
            </div>
        {{-- Meta --}}

        <div class="vip-master-wrapper d-fc">
            {{-- Banner --}}
                <button class="s-collapse active" type="button" data-target="#banner-wrapper">ბანერი</button>
                <div class="s-collapse d-fc show" id="banner-wrapper">
                    <div class="universal-banner-wrapper">
                        <div class="image-wrapper">
                            <label class="image-reader-wrapper w-100" for="banner">
                                @if ( $data['exists'] )
                                    <img class="image-loader" src="{{ asset($data['raw']['banner']) }}">
                                    <input type="hidden" name="existing_banner" value="{{ $data['raw']['banner'] }}" required>
                                @else
                                    <img class="image-loader" src="{{ asset('images/vip-master/lorem/main-banner.png') }}">
                                @endif
                                {{-- <div class="background-layer"></div> --}}
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="banner" id="banner">
                            </label>
                        </div>
                        <div class="text-wrapper">
                            {{-- <h1>VIP - მასტერი</h1> --}}
                            <p contenteditable="true" data-text-to-value="#banner-text-ka">{{ ($data['exists']) ? $data['raw']['banner_text_ka'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}</p>
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
                                    <img class="image-loader" src="{{ asset('images/vip-master/lorem/mob-banner.png') }}">
                                @endif
                                {{-- <div class="background-layer"></div> --}}
                                <span class="dire-edit"></span>
                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="mob_banner" id="mob-banner">
                            </label>
                        </div>
                    </div>
                </div>
            {{-- Mob Banner --}}

            {{-- Services --}}
                <button class="s-collapse active" type="button" data-target="#services">სერვისები</button>
                <div class="s-collapse d-fc show" id="services">
                    <div class="container-1280 content">
                        <div class="left d-fc">
                            <div class="top d-fc">
                                <button type="button" class="navigation active" data-has="category-0">
                                    <span><i class="gray white" id="glass"></i> კარ-ფანჯარა და საკეტები</span> 
                                    <i class="yellow white" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-1">
                                    <span><i class="gray" id="energy"></i> ელექტროობა</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-2">
                                    <span><i class="gray" id="pipe"></i> კანალიზაცია</span> 
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-3">
                                    <span><i class="gray" id="tap"></i> სანტექნიკა</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-4">
                                    <span><i class="gray" id="air-conditioner"></i> გათბობა/კონდიცირება</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-5">
                                    <span><i class="gray" id="washing-machine"></i> საყოფაცხოვრებო ტექნიკა</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-6">
                                    <span><i class="gray" id="gear"></i> უნივერსალური სამუშაოები</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                            </div>
                            <div class="bottom">
                                <div class="left"><i class="white" id="user"></i></div>
                                <div class="right"><p>ხელმისაწვდომია <strong>X სპეციალისტი</strong></p></div>
                            </div>
                        </div>

                        <div class="right d-fc">
                            @for ($i = 0; $i < 7; $i++)
                                <div class="category d-fc {{ ($i == 0) ? '' : 'd-none' }}" id="category-{{ $i }}">
                                    <button type="button" class="universal-button w-100 mb-3 add-dropdown" data-belongs="{{ $i }}" data-locale="ka">დროპდაუნის დამატება</button>
                                    @if ( $data['exists'] )
                                        @foreach ( $data['dropdowns_ka'] as $dropdown )
                                            @if ( $dropdown['belongs'] == $i )
                                                <div class="universal-dropdowns">
                                                    <button type="button" data-toggle="collapse" data-target="#vip-dropdown-{{ $dropdown['has'] }}" aria-expanded="true" aria-controls="vip-dropdown-{{ $dropdown['has'] }}">
                                                        <p contenteditable="true" data-text-to-value="#dropdown-text-{{ $dropdown['has'] }}">{{ $dropdown['text'] }}</p>
                                                        <span class="gray" contenteditable="true" data-text-to-value="#dropdown-price-{{ $dropdown['has'] }}">{{ $dropdown['price'] }}</span>
                                                        {{-- <span class="icon-wrapper"><i class="white" id="nav-arrow"></i></span> --}}
                                                        <span class="remove-this-item">&times</span>
                                                    </button>
                                                    
                                                    <div class="collapse show" id="vip-dropdown-{{ $dropdown['has'] }}">
                                                        <div class="universal-dropdown-items d-fc">
                                                            {{-- <button type="button" class="universal-button w-100 mb-3 add-service" data-belongs="{{ $dropdown['has'] }}" data-locale="ka">სერვისის დამატება</button> --}}
                                                            <a href="/enter/vip-services/create/{{ $dropdown['has'] }}/ka/null" class="universal-button w-100 mb-3">სერვისის დამატება</a>
                                                            @foreach ( $data['services'] as $index => $service )
                                                                @if ( $service['belongs'] == $dropdown['has'] )
                                                                    <div class="universal-dropdown-item">
                                                                        <p>{{ $service['outside_title'] }}</p>
                                                                        <a href="/enter/vip-services/edit/{{ $service['belongs'] }}/{{ $service['locale'] }}/{{ $service['id'] }}" class="ml-auto mr-3">რედაქტირება</a>
                                                                        {{-- <button type="button" class="remove-this-item">&times</button>
                                                                        <input type="hidden" name="amount_of_services_ka[]" value="null" required>
                                                                        <input type="hidden" name="ka_service_belongs[]" value="{{ $service['belongs'] }}" required>
                                                                        <input type="hidden" name="ka_service_id[]" value="{{ $service['id'] }}" required>
                                                                        <input type="hidden" name="ka_service_text[]" id="service-text-{{ $index }}" value="{{ $service['text'] }}" required> --}}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="amount_of_dropdowns_ka[]" value="null" required>
                                                    <input type="hidden" name="ka_dropdown_belongs[]" value="{{ $dropdown['belongs'] }}" required>
                                                    <input type="hidden" name="ka_dropdown_has[]" value="{{ $dropdown['has'] }}" required>
                                                    <input type="hidden" name="ka_dropdown_text[]" id="dropdown-text-{{ $dropdown['has'] }}" value="{{ $dropdown['text'] }}" required>
                                                    <input type="hidden" name="ka_dropdown_price[]" id="dropdown-price-{{ $dropdown['has'] }}" value="{{ $dropdown['price'] }}" required>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            {{-- Services --}}

            {{-- Italian --}}
                <button class="s-collapse" type="button" data-target="#services-it" style="color: purple; border-color: purple;">იტალიანო</button>
                <div class="s-collapse d-fc" id="services-it">
                    <div class="universal-banner-wrapper">
                        <div class="image-wrapper">
                            <img src="{{ asset($data['raw']['banner']) }}">
                        </div>
                        <div class="text-wrapper">
                            {{-- <h1>VIP - მასტერი</h1> --}}
                            <p contenteditable="true" data-text-to-value="#banner-text-it">{{ ($data['exists']) ? $data['raw']['banner_text_it'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}</p>
                        </div>
                    </div>

                    <div class="container-1280 content">
                        <div class="left d-fc">
                            <div class="top d-fc">
                                <button type="button" class="navigation active" data-has="category-it-0">
                                    <span><i class="gray white" id="glass"></i> კარ-ფანჯარა და საკეტები</span> 
                                    <i class="yellow white" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-it-1">
                                    <span><i class="gray" id="energy"></i> ელექტროობა</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-it-2">
                                    <span><i class="gray" id="pipe"></i> კანალიზაცია</span> 
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-it-3">
                                    <span><i class="gray" id="tap"></i> სანტექნიკა</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-it-4">
                                    <span><i class="gray" id="air-conditioner"></i> გათბობა/კონდიცირება</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-it-5">
                                    <span><i class="gray" id="washing-machine"></i> საყოფაცხოვრებო ტექნიკა</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                                <button type="button" class="navigation" data-has="category-it-6">
                                    <span><i class="gray" id="gear"></i> უნივერსალური სამუშაოები</span>
                                    <i class="yellow" id="nav-arrow"></i>
                                </button>
                            </div>
                            <div class="bottom">
                                <div class="left"><i class="white" id="user"></i></div>
                                <div class="right"><p>ხელმისაწვდომია <strong>X სპეციალისტი</strong></p></div>
                            </div>
                        </div>

                        <div class="right d-fc">
                            @for ($i = 0; $i < 7; $i++)
                                <div class="category d-fc {{ ($i == 0) ? '' : 'd-none' }}" id="category-it-{{ $i }}">
                                    <button type="button" class="universal-button w-100 mb-3 add-dropdown" data-belongs="{{ $i }}" data-locale="it">დროპდაუნის დამატება</button>
                                    @if ( $data['exists'] )
                                        @foreach ( $data['dropdowns_it'] as $dropdown )
                                            @if ( $dropdown['belongs'] == $i )
                                                <div class="universal-dropdowns">
                                                    <button type="button" data-toggle="collapse" data-target="#vip-dropdown-{{ $dropdown['has'] }}" aria-expanded="false" aria-controls="vip-dropdown-{{ $dropdown['has'] }}">
                                                        <p contenteditable="true" data-text-to-value="#dropdown-text-{{ $dropdown['has'] }}">{{ $dropdown['text'] }}</p>
                                                        <span class="gray" contenteditable="true" data-text-to-value="#dropdown-price-{{ $dropdown['has'] }}">{{ $dropdown['price'] }}</span>
                                                        {{-- <span class="icon-wrapper"><i class="white" id="nav-arrow"></i></span> --}}
                                                        <span class="remove-this-item">&times</span>
                                                    </button>
                                                    
                                                    <div class="collapse" id="vip-dropdown-{{ $dropdown['has'] }}">
                                                        <div class="universal-dropdown-items d-fc">
                                                            <a href="/enter/vip-services/create/{{ $dropdown['has'] }}/it/null" class="universal-button w-100 mb-3">სერვისის დამატება</a>
                                                            {{-- <button type="button" class="universal-button w-100 mb-3 add-service" data-belongs="{{ $dropdown['has'] }}" data-locale="it">სერვისის დამატება</button> --}}
                                                            @foreach ( $data['services'] as $index => $service )
                                                                @if ( $service['belongs'] == $dropdown['has'] )
                                                                    <div class="universal-dropdown-item">
                                                                        <p>{{ $service['outside_title'] }}</p>
                                                                        <a href="/enter/vip-services/edit/{{ $service['belongs'] }}/{{ $service['locale'] }}/{{ $service['id'] }}" class="ml-auto mr-3">რედაქტირება</a>
                                                                        {{-- <button type="button" class="remove-this-item">&times</button>
                                                                        <input type="hidden" name="amount_of_services_ka[]" value="null" required>
                                                                        <input type="hidden" name="ka_service_belongs[]" value="{{ $service['belongs'] }}" required>
                                                                        <input type="hidden" name="ka_service_id[]" value="{{ $service['id'] }}" required>
                                                                        <input type="hidden" name="ka_service_text[]" id="service-text-{{ $index }}" value="{{ $service['text'] }}" required> --}}
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="amount_of_dropdowns_it[]" value="null" required>
                                                    <input type="hidden" name="it_dropdown_belongs[]" value="{{ $dropdown['belongs'] }}" required>
                                                    <input type="hidden" name="it_dropdown_has[]" value="{{ $dropdown['has'] }}" required>
                                                    <input type="hidden" name="it_dropdown_text[]" id="dropdown-text-{{ $dropdown['has'] }}" value="{{ $dropdown['text'] }}" required>
                                                    <input type="hidden" name="it_dropdown_price[]" id="dropdown-price-{{ $dropdown['has'] }}" value="{{ $dropdown['price'] }}" required>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            {{-- Italian --}}
            
            @foreach (['ka', 'it'] as $locale)
                <input type="hidden" name="banner_text_{{ $locale }}" id="banner-text-{{ $locale }}" value="{{ ($data['exists']) ? $data['raw']['banner_text_'. $locale] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}">
            @endforeach
        </div>

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

            function dropdown_markup(belongs, has, locale) {
                return `<div class="universal-dropdowns">
                            <button type="button" data-toggle="collapse" data-target="#vip-dropdown-${has}" aria-expanded="false" aria-controls="vip-dropdown-${has}">
                                <p contenteditable="true" data-text-to-value="#dropdown-text-${has}">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
                                <span class="gray" contenteditable="true" data-text-to-value="#dropdown-price-${has}">₾70-120</span>
                                <span class="remove-this-item">&times</span>
                            </button>
                            <div class="collapse" id="vip-dropdown-${has}">
                                <div class="universal-dropdown-items d-fc">
                                    <button type="button" class="universal-button w-100 mb-3 add-service" data-belongs="${has}" data-locale="${locale}">სერვისის დამატება</button>
                                </div>
                            </div>
                            <input type="hidden" name="amount_of_dropdowns_${locale}[]" value="null" required>
                            <input type="hidden" name="${locale}_dropdown_belongs[]" value="${belongs}" required>
                            <input type="hidden" name="${locale}_dropdown_has[]" value="${has}" required>
                            <input type="hidden" name="${locale}_dropdown_text[]" id="dropdown-text-${has}" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required>
                            <input type="hidden" name="${locale}_dropdown_price[]" id="dropdown-price-${has}" value="₾70-120" required>
                        </div>`
            }

            // function service_markup(id, belongs, locale) {
            //     return `<div class="universal-dropdown-item">
            //                 <p contenteditable="true" data-text-to-value="#service-text-${id}">დააჭირეთ ტექსტი რომ შეცვალოთ</p>
            //                 <button type="button" class="remove-this-item">&times</button>
            //                 <input type="hidden" name="amount_of_services_${locale}[]" value="null" required>
            //                 <input type="hidden" name="${locale}_service_belongs[]" value="${belongs}" required>
            //                 <input type="hidden" name="${locale}_service_id[]" value="${id}" required>
            //                 <input type="hidden" name="${locale}_service_text[]" id="service-text-${id}" value="დააჭირეთ ტექსტი რომ შეცვალოთ" required>
            //             </div>`
            // }

            $('.vip-master-wrapper').on('click', '.add-dropdown', function() {
                let belongs = $(this).data('belongs')
                let has = generate_random_string(12)
                let locale = $(this).data('locale')
                $(this).parent('.category').append(dropdown_markup(belongs, has, locale))
            })

            $('.vip-master-wrapper').on('click', '.add-service', function() {
                let id = generate_random_string(12)
                let belongs = $(this).data('belongs')
                let locale = $(this).data('locale')
                $(this).parent('.universal-dropdown-items').append(service_markup(id, belongs, locale))
            })

            $('.vip-master-wrapper').on('click', '.universal-dropdowns > button .remove-this-item', function() {
                $(this).closest('.universal-dropdowns').remove()
            })

            $('.vip-master-wrapper').on('dblclick', '.universal-dropdowns .universal-dropdown-items .universal-dropdown-item button.remove-this-item', function() {
                $(this).closest('.universal-dropdown-item').remove()
            })
        })
    </script>
@endsection