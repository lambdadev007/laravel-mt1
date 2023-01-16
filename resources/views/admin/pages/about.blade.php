@extends('admin.layout')

@section('content')
    <form class="d-fc" action="/enter/about/update/null" method="post" enctype="multipart/form-data">
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

        <div class="about-wrapper">
            <div class="top">
                <div class="darker-section">
                    <div class="video-wrapper container-800 d-fc">
                        <iframe width="800" height="400" src="https://www.youtube.com/embed/{{ ($data['exists']) ? $data['raw']['link'] : 'C3iI6S7TuCA' }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <input class="form-control mt-3" type="text" name="link" placeholder="მხოლოდ კოდი - https://www.youtube.com/watch?v=0WfU2w-qB5I-ს კოდი არის 0WfU2w-qB5I წინააღმდეგ შემთხვევაში ვიდეო არ იმუშავებს" value="{{ ($data['exists']) ? $data['raw']['link'] : '' }}" required>
                    </div>
                </div>
            </div>

            <div class="middle d-fc">
                <div class="center d-fc">
                    <div class="ligher-section">
                        <div class="container-800 d-fc">
                            <div class="section-header">
                                <i class="square"></i>
                                <h2 id="title-0" contenteditable="true" data-html-to-value="#title-input-ka-0">{!! ($data['exists']) ? $data['content']['ka']['title_0'] : 'სათაური' !!}</h2>
                            </div>
                            <div class="paragraph-block">
                                <p contenteditable="true" data-html-to-value="#paragraph-block-input-ka-0">{!! ($data['exists']) ? $data['content']['ka']['paragraph_block_0'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' !!}</p>
                            </div>
                            <div class="image-block">
                                <button type="button" class="universal-button w-100 mb-2" id="add-inner-images">სურათების დამატება</button>
                                @if ( $data['exists'] )
                                    @if ( $data['inner_images'] != [] )
                                        @foreach ($data['inner_images'] as $index => $image)
                                            <label class="image-reader-wrapper d-fc" for="inner-image-{{ $index }}">
                                                <div class="remove-this-item image">&times;</div>
                                                <img class="image-loader" src="{{ asset($image['location']) }}">
                                                <span class="dire-edit"></span>
                                                <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="inner_images[]" id="inner-image-{{ $index }}">
                                                <input type="text" name="inner_image_alts[]" placeholder="სურათის ალტი" value="{{ $image['alt'] }}" required>
                                                <input type="hidden" name="amount_of_inner_images[]" value="null">
                                                <input type="hidden" name="existing_inner_images[]" value="{{ $image['location'] }}">
                                            </label>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="darker-section">
                        <div class="container-800 d-fc">
                            <div class="section-header">
                                <i class="square"></i>
                                <h2 id="title-1" contenteditable="true" data-html-to-value="#title-input-ka-1">{!! ($data['exists']) ? $data['content']['ka']['title_1'] : 'სათაური' !!}</h2>
                            </div>
                            <div class="paragraph-block mb-2">
                                <p contenteditable="true" data-html-to-value="#paragraph-block-input-ka-1">{!! ($data['exists']) ? $data['content']['ka']['paragraph_block_1'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' !!}</p>
                            </div>
                            <div class="category-buttons admin">
                                <a href="javascript:void(0)" id="furniture" class="">
                                    <i class="icon" id="couch"></i>
                                    <p class="mb-3">ავეჯის დამზადება</p>
                                    <i class="white" id="arrow-right"></i>
                                    <input type="text" class="form-control w-75" name="links[]" placeholder="ლინკი" value="{{ ($data['exists']) ? $data['links'][0] : 'https://www.metrix.ge/vip-master' }}" required>
                                </a>
                                <a href="javascript:void(0)" id="vip-master" class="">
                                    <i class="icon" id="wrench"></i>
                                    <p class="mb-3">ვიპ-მასტერი</p>
                                    <i class="white" id="arrow-right"></i>
                                    <input type="text" class="form-control w-75" name="links[]" placeholder="ლინკი" value="{{ ($data['exists']) ? $data['links'][1] : 'https://www.metrix.ge/designer' }}" required>
                                </a>
                                <a href="javascript:void(0)" id="designer" class="">
                                    <i class="icon" id="paint-brush"></i>
                                    <p class="mb-3">დიზაინერი</p>
                                    <i class="white reverse" id="arrow-right"></i>
                                    <input type="text" class="form-control w-75" name="links[]" placeholder="ლინკი" value="{{ ($data['exists']) ? $data['links'][2] : 'https://www.metrix.ge/furniture' }}" required>
                                </a>
                                <a href="javascript:void(0)" id="repairs" class="">
                                    <i class="icon" id="paint-roller"></i>
                                    <p class="mb-3">რემონტი</p>
                                    <i class="white reverse" id="arrow-right"></i>
                                    <input type="text" class="form-control w-75" name="links[]" placeholder="ლინკი" value="{{ ($data['exists']) ? $data['links'][3] : 'https://www.metrix.ge/repairs' }}" required>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="lighter-section">
                        <div class="container-800 d-fc">
                            <div class="section-header">
                                <i class="square"></i>
                                <h2 id="title-2" contenteditable="true" data-html-to-value="#title-input-ka-2">{!! ($data['exists']) ? $data['content']['ka']['title_2'] : 'სათაური' !!}</h2>
                            </div>
                            <div class="paragraph-block">
                                <p contenteditable="true" data-html-to-value="#paragraph-block-input-ka-2">{!! ($data['exists']) ? $data['content']['ka']['paragraph_block_2'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' !!}</p>
                            </div>
                        </div>
                    </div>

                    <div class="darker-section">
                        <div class="container-800 d-fc">
                            <div class="section-header">
                                <i class="square"></i>
                                <h2 id="title-3" contenteditable="true" data-html-to-value="#title-input-ka-3">{!! ($data['exists']) ? $data['content']['ka']['title_3'] : 'სათაური' !!}</h2>
                            </div>
                            <div class="paragraph-block">
                                <p contenteditable="true" data-html-to-value="#paragraph-block-input-ka-3">{!! ($data['exists']) ? $data['content']['ka']['paragraph_block_3'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bottom">
                <div class="lighter-section">
                    <div class="container-800 d-fc">
                        <div class="section-header">
                            <i class="square"></i>
                            <h2 id="title-4" contenteditable="true" data-html-to-value="#title-input-ka-4">{!! ($data['exists']) ? $data['content']['ka']['title_4'] : 'სათაური' !!}</h2>
                        </div>
                    </div>
                </div>

                <div class="container-800 flex-wrap" id="hr-container-ka">
                    <button type="button" class="universal-button w-100 mb-2" id="add-hr">ადამიანის დამატება</button>
                    @if ( $data['exists'] )
                        @if ( $data['hr'] != [] )
                            @foreach ($data['hr'] as $index => $hr)
                                <div class="hr-block d-fc hr-block-{{ $index }}">
                                    <div class="remove-this-item hr" data-index="{{ $index }}">&times;</div>
                                    <div class="image-wrapper">
                                        <label class="image-reader-wrapper" for="hr-image-{{ $index }}">
                                            <img class="image-loader" src="{{ asset($hr['image']) }}">
                                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" id="hr-image-{{ $index }}" name="hr_images[]">
                                            <input type="hidden" name="existing_hr_images[]" value="{{ $hr['image'] }}">
                                        </label>
                                        <div class="background-layer"></div>
                                    </div>
                                    <input type="text" class="name text-center mb-1" name="hr_name_ka[]" placeholder="სახელი" value="{{ $hr['ka']['name'] }}" required>
                                    <input type="text" class="profession text-center" name="hr_profession_ka[]" placeholder="პროფესია" value="{{ $hr['ka']['profession'] }}" required>
                                    <div class="bottom-border"></div>
                                    <input type="hidden" name="amount_of_hr[]" value="null">
                                </div>
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        </div>

        {{-- Italian --}}
            <button class="s-collapse active" type="button" data-target="#it-wrapper" style="color: purple; border-color: purple;">იტალიანო</button>
            <div class="s-collapse d-fc show" id="it-wrapper">
                <div class="about-wrapper">
                    <div class="middle d-fc">
                        <div class="center d-fc">
                            <div class="ligher-section">
                                <div class="container-800 d-fc">
                                    <div class="section-header">
                                        <i class="square"></i>
                                        <h2 id="title-0" contenteditable="true" data-html-to-value="#title-input-it-0">{!! ($data['exists']) ? $data['content']['it']['title_0'] : 'სათაური' !!}</h2>
                                    </div>
                                    <div class="paragraph-block">
                                        <p contenteditable="true" data-html-to-value="#paragraph-block-input-it-0">{!! ($data['exists']) ? $data['content']['it']['paragraph_block_0'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="darker-section">
                                <div class="container-800 d-fc">
                                    <div class="section-header">
                                        <i class="square"></i>
                                        <h2 id="title-1" contenteditable="true" data-html-to-value="#title-input-it-1">{!! ($data['exists']) ? $data['content']['it']['title_1'] : 'სათაური' !!}</h2>
                                    </div>
                                    <div class="paragraph-block mb-2">
                                        <p contenteditable="true" data-html-to-value="#paragraph-block-input-it-1">{!! ($data['exists']) ? $data['content']['it']['paragraph_block_1'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="lighter-section">
                                <div class="container-800 d-fc">
                                    <div class="section-header">
                                        <i class="square"></i>
                                        <h2 id="title-2" contenteditable="true" data-html-to-value="#title-input-it-2">{!! ($data['exists']) ? $data['content']['it']['title_2'] : 'სათაური' !!}</h2>
                                    </div>
                                    <div class="paragraph-block">
                                        <p contenteditable="true" data-html-to-value="#paragraph-block-input-it-2">{!! ($data['exists']) ? $data['content']['it']['paragraph_block_2'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="darker-section">
                                <div class="container-800 d-fc">
                                    <div class="section-header">
                                        <i class="square"></i>
                                        <h2 id="title-3" contenteditable="true" data-html-to-value="#title-input-it-3">{!! ($data['exists']) ? $data['content']['it']['title_3'] : 'სათაური' !!}</h2>
                                    </div>
                                    <div class="paragraph-block">
                                        <p contenteditable="true" data-html-to-value="#paragraph-block-input-it-3">{!! ($data['exists']) ? $data['content']['it']['paragraph_block_3'] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bottom">
                        <div class="lighter-section">
                            <div class="container-800 d-fc">
                                <div class="section-header">
                                    <i class="square"></i>
                                    <h2 id="title-4" contenteditable="true" data-html-to-value="#title-input-it-4">{!! ($data['exists']) ? $data['content']['it']['title_4'] : 'სათაური' !!}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="container-800 flex-wrap" id="hr-container-it">
                            <button type="button" class="universal-button w-100 mb-2" id="add-hr">ადამიანის დამატება</button>
                            @if ( $data['exists'] )
                                @if ( $data['hr'] != [] )
                                    @foreach ($data['hr'] as $index => $hr)
                                        <div class="hr-block d-fc hr-block-{{ $index }}">
                                            <input type="text" class="name text-center mb-1" name="hr_name_it[]" placeholder="სახელი" value="{{ $hr['it']['name'] }}" required>
                                            <input type="text" class="profession text-center" name="hr_profession_it[]" placeholder="პროფესია" value="{{ $hr['it']['profession'] }}" required>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        {{-- Italian --}}
        
        @foreach ( ['ka', 'it'] as $locale )
            @for ($i = 0; $i < 4; $i++)
                <input type="hidden" name="paragraph_block_{{ $locale }}_{{ $i }}" id="paragraph-block-input-{{ $locale }}-{{ $i }}" value="{{ ($data['exists']) ? $data['content'][$locale]['paragraph_block_'. $i] : 'დააჭირეთ ტექსტი რომ შეცვალოთ' }}" required>
            @endfor
            @for ($i = 0; $i < 5; $i++)
                <input type="hidden" name="title_{{ $locale }}_{{ $i }}" id="title-input-{{ $locale }}-{{ $i }}" value="{{ ($data['exists']) ? $data['content'][$locale]['title_'. $i] : 'სათაური' }}" required>
            @endfor
        @endforeach
        
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
            function inner_image_markup(i) {
                return `<label class="image-reader-wrapper d-fc" for="inner-image-${i}">
                            <div class="remove-this-item image">&times;</div>
                            <img class="image-loader" src="{{ asset('images/enter/upload-article-inner.jpg') }}">
                            <span class="dire-edit"></span>
                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="inner_images[]" id="inner-image-${i}" required>
                            <input type="text" class="text-center" name="inner_image_alts[]" placeholder="სურათის ალტი" required>
                            <input type="hidden" name="amount_of_inner_images[]" value="null">
                        </label>`
            }
            function hr_markup_ka(i) {
                return `<div class="hr-block d-fc hr-block-${i}">
                            <div class="remove-this-item hr" data-index="${i}">&times;</div>
                            <div class="image-wrapper">
                                <label class="image-reader-wrapper" for="hr-image-${i}">
                                    <img class="image-loader" src="{{ asset('images/enter/upload-hr.jpg') }}">
                                    <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" id="hr-image-${i}" name="hr_images[]" required>
                                </label>
                                <div class="background-layer"></div>
                            </div>
                            <input type="text" class="name text-center mb-1" name="hr_name_ka[]" placeholder="სახელი" required>
                            <input type="text" class="profession text-center" name="hr_profession_ka[]" placeholder="პროფესია" required>
                            <div class="bottom-border"></div>
                            <input type="hidden" name="amount_of_hr[]" value="null">
                        </div>`
            }

            function hr_markup_locale(i, locale) {
                return `<div class="hr-block d-fc hr-block-${i}">
                            <input type="text" class="name text-center mb-1" name="hr_name_${locale}[]" placeholder="სახელი" required>
                            <input type="text" class="profession text-center" name="hr_profession_${locale}[]" placeholder="პროფესია" required>
                        </div>`
            }

            $('#add-hr').click(function() {
                i = generate_random_string(16)
                $('#hr-container-ka').append(hr_markup_ka(i))
                $('#hr-container-it').append(hr_markup_locale(i, 'it'))
            })

            $('#add-inner-images').click(function() {
                $('.image-block').append(inner_image_markup(generate_random_string(16)))
            })

            $('.image-block').on('click', '.remove-this-item.image', function() {
                $(this).parents('label').remove()
            })

            $('div[id^="hr-container"]').on('click', '.remove-this-item.hr', function() {
                $(`.hr-block-${$(this).data('index')}`).remove()
            })
        })
    </script>
@endsection