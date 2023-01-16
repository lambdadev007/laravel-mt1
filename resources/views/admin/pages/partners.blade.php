@extends('admin.layout')

@section('content')
    <form class="d-fc" action="/enter/partners/update/null" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}
        @if ( $data['exists'] )
            <div class="partners-slider-wrapper">
                <div class="owl-carousel" id="partners-slider">
                    @foreach ( $data['slides'] as $slide )
                        <div class="carousel-block">
                            <img class="owl-lazy" data-src="{{ asset($slide['location']) }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <button type="button" class="universal-button w-100 my-3" id="add-slides">დამატება</button>

        <div class="partner-images mb-5" id="slider-images">
            @if ( $data['exists'] )
                @foreach ( $data['slides'] as $index => $slide )
                    <label class="image-reader-wrapper d-fc w-100" for="slide-{{ $index }}">
                        <div class="remove-this-item slide">&times;</div>
                        <img class="image-loader" src="{{ asset($slide['location']) }}">
                        <span class="dire-edit"></span>
                        <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="partner_slides[]" id="slide-{{ $index }}">
                        <input type="text" class="text-center form-control" name="partner_slide_alts[]" placeholder="სურათის ალტი" value="{{ $slide['alt'] }}" required>
                        <input type="hidden" name="existing_partner_slides[]" value="{{ $slide['location'] }}">
                        <input type="hidden" name="amount_of_partner_slides[]" value="null">
                    </label>
                @endforeach
            @endif
        </div>

        <button type="submit" class="universal-button align-self-end">გაგზავნა</button>
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
            function slide_markup(i) {
                return `<label class="image-reader-wrapper d-fc w-100 mb-2" for="slide-${i}">
                            <div class="remove-this-item slide">&times;</div>
                            <img class="image-loader" src="{{ asset('images/enter/upload-285-130.jpg') }}">
                            <span class="dire-edit"></span>
                            <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="partner_slides[]" id="slide-${i}" required>
                            <input type="text" class="text-center form-control" name="partner_slide_alts[]" placeholder="სურათის ალტი" required>
                            <input type="hidden" name="amount_of_partner_slides[]" value="null">
                        </label>`
            }

            $('#add-slides').click(function() {
                $('#slider-images').append(slide_markup(generate_random_string(16)))
            })

            $('body').on('click', '.remove-this-item.slide', function() {
                $(this).parents('label').remove()
            })
        })
    </script>
@endsection