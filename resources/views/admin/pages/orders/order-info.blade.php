@extends('admin.layout')

@section('content')
    <form class="container-1280 d-fc" action="/enter/order-info/update/null" method="post" enctype="multipart/form-data">
        @csrf

        {{-- Order Info --}}
                <button class="s-collapse active" type="button" data-target="#order-info">შეკვეთის ინფორმაცია</button>
                <div class="s-collapse d-fc show" id="order-info">
                    <h5 class="text-center my-4">ქალაქები</h5>
                    <div class="d-flex flex-wrap justify-content-between">
                        <button type="button" class="universal-button w-100 mb-3 add-input" data-type="cities">დამატება</button>
                        @if ( $data['exists'] )
                            @foreach ( $data['cities'] as $item )
                                <div class="d-flex position-relative col-3">
                                    <span class="remove-this-item" style="top: 4px; right: 20px">&times</span>
                                    <input type="text" name="cities[]" value="{{ $item }}" class="form-control">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <h5 class="text-center my-4">რაიონები</h5>
                    <div class="d-flex flex-wrap justify-content-between">
                        <button type="button" class="universal-button w-100 mb-3 add-input" data-type="regions">დამატება</button>
                        @if ( $data['exists'] )
                            @foreach ( $data['regions'] as $item )
                                <div class="d-flex position-relative col-3">
                                    <span class="remove-this-item" style="top: 4px; right: 20px">&times</span>
                                    <input type="text" name="regions[]" value="{{ $item }}" class="form-control">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <h5 class="text-center my-4">თარიღები (კონკრეტულ დროს)</h5>
                    <div class="d-flex flex-wrap justify-content-between">
                        <button type="button" class="universal-button w-100 mb-3 add-input" data-type="dates">დამატება</button>
                        @if ( $data['exists'] )
                            @foreach ( $data['dates'] as $item )
                                <div class="d-flex position-relative col-3">
                                    <span class="remove-this-item" style="top: 4px; right: 20px">&times</span>
                                    <input type="text" name="dates[]" value="{{ $item }}" class="form-control">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <h5 class="text-center my-4">დროის შუალედები (კონკრეტულ დროს)</h5>
                    <div class="d-flex flex-wrap justify-content-between">
                        <button type="button" class="universal-button w-100 mb-3 add-input" data-type="time_frames">დამატება</button>
                        @if ( $data['exists'] )
                            @foreach ( $data['time_frames'] as $item )
                                <div class="d-flex position-relative col-3">
                                    <span class="remove-this-item" style="top: 4px; right: 20px">&times</span>
                                    <input type="text" name="times_frames[]" value="{{ $item }}" class="form-control">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
        {{-- Order Info --}}

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

            function input_markup(type) {
                return `<div class="d-flex position-relative col-3">
                            <span class="remove-this-item" style="top: 4px; right: 20px">&times</span>
                            <input type="text" name="${type}[]" class="form-control">
                        </div>`
            }

            $('form').on('click', '.add-input', function() {
                let type = $(this).data('type')
                $(this).parent('.d-flex').append(input_markup(type))
            })

            $('form').on('click', '.universal-dropdowns > button .remove-this-item', function() {
                $(this).closest('.universal-dropdowns').remove()
            })
        })
    </script>
@endsection