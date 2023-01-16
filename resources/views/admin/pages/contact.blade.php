@extends('admin.layout')

@section('content')
    <form class="d-fc" action="/enter/contact/update/null" method="post" enctype="multipart/form-data">
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

        {{-- Services --}}
            <div class="container-800 d-fc">
                <button class="s-collapse" type="button" data-target="#services">მომსახურებები</button>
                <div class="s-collapse d-fc" id="services">
                    <button type="button" class="universal-button w-100 my-3" id="add-services">დამატება</button>
                    @if ( $data['exists'] )
                        @foreach ( $data['services'] as $service )
                            <div class="position-relative mb-3">
                                <input class="form-control" type="text" name="services[]" value="{{ $service }}" placeholder="მომსახურება">
                                <span class="remove-this-item" style="right: 5px; top: 10%;">&times</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        {{-- Services --}}

        {{-- Content --}}
            <div class="container-800 d-fc">
                <button class="s-collapse" type="button" data-target="#content">ინფორმაცია</button>
                <div class="s-collapse d-fc" id="content">
                    <input class="form-control my-3" type="text" name="address" value="{{ ($data['exists']) ? $data['raw']['address'] : '' }}" placeholder="მისამართი">
                    <input class="form-control my-3" type="text" name="mobile_number" value="{{ ($data['exists']) ? $data['raw']['mobile_number'] : '' }}" placeholder="მობილური ტელეფონის ნომერი">
                    <input class="form-control my-3" type="text" name="house_number" value="{{ ($data['exists']) ? $data['raw']['house_number'] : '' }}" placeholder="ქალაქის ნომერი">
                    <input class="form-control my-3" type="email" name="mail" value="{{ ($data['exists']) ? $data['raw']['mail'] : '' }}" placeholder="მეილი">
                </div>
            </div>
        {{-- Content --}}
        
        <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
    </form>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            function service_markup() {
                return `<div class="position-relative mb-3">
                            <input class="form-control" type="text" name="services[]" placeholder="მომსახურება">
                            <span class="remove-this-item" style="right: 5px; top: 10%;">&times</span>
                        </div>`
            }

            $('#add-services').click(function() {
                $('#services').append(service_markup())
            })

            $('body').on('click', '.remove-this-item', function() {
                $(this).parent('.position-relative').remove()
            })
        })
    </script>
@endsection