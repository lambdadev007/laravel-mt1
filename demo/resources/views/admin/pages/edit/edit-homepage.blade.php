{{-- Design Ad --}}
    <div class="form-section">
        <h5 class="mb-3 text-center">დააჭირეთ მარცხენა სურათს რომ შეცვალოთ / სურათის ზომებია 350x350 პიქსელი</h5>
        <div class="universal-slider">
            <div class="static-image">
                <label for="design-advert" class="admin-image-wrapper d-flex">
                    @if ( $data['advert'] != [] )
                        @foreach ( $data['advert'] as $advert )
                            <img class="ajax-image w-100" src="{{ asset($advert['image']) }}">
                        @endforeach
                    @else
                        <img class="ajax-image w-100" src="{{ asset('images/temp/no-image.jpg') }}">
                    @endif
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="homepage_advert" id="design-advert">
                </label>
            </div>
            <div class="owl-carousel owl-theme">
                @foreach ($data['slides'] as $slide)
                    <div class="carousel-block">
                        <img class="lazy" src="{{ asset($slide['image']) }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
{{-- Design Ad --}}

{{-- Divider Line --}}
    <div class="my-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

{{-- Slides --}}
    <div class="form-section">
        <div class="slides-collapse-wrapper">
            <button class="slides-collapse" type="button" data-toggle="collapse" data-target="#slides" aria-expanded="true" aria-controls="slides">
                <span>სლაიდები / სურათის სიმაღლე უნდა იყოს 350 პიქსელი</span>
                <span class="dire-right-arrow-s"></span>
            </button>


            <div class="collapse show" id="slides">
                <div class="d-flex">
                    <button class="add-slide btn btn-primary w-100" type="button">სლაიდის დამატება</button>
                </div>
                
                <div class="row">
                    @foreach ($data['slides'] as $index => $slide)
                        <div class="slide-wrapper col-sm-12 col-md-6 my-3">
                            <button type="button" class="remove-this-slide btn btn-danger rounded-0">x</button>

                            <input type="hidden" name="amount_of_slides[]" value="{{ $index }}">

                            <label for="slide-{{ $index }}" class="admin-image-wrapper d-flex">
                                <img class="ajax-image w-100" src="{{ ($slide['image'] != null) ? asset($slide['image']) : asset('images/temp/no-image.jpg') }}">
                                <span class="hover-edit-notifier">
                                    <span class="dire-edit"></span>
                                </span>
                                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="slides[]" id="slide-{{ $index }}">
                                <input type="hidden" name="existing_slide[]" value="{{ $slide['image'] }}">
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
{{-- Slides --}}