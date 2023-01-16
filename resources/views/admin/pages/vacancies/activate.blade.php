@extends('admin.layout')

@php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();

    $group_translation = [
        'group' => 'ვმუშაობთ ჯგუფი',
        'small_group' => 'ვმუშაობთ 2-3 კაცი',
        'alone' => 'ვმუშაობ მარტო'
    ];
@endphp

@section('content')
    <form class="d-fc" action="/enter/vacancies-activate/update/null" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 id="countdown">სესია მოკვდება 24:00:00 საათში</h5> --}}

        <div class="vacancies-wrapper d-fc container-1280">
            <div class="bottom">
                <div class="left w-100 d-fc">
                    @if ( $data['exists'] )
                        <div class="universal-dropdowns">
                            <div class="collapse show" id="vacancies-dropdown">
                                <div class="universal-dropdown-items d-fc">
                                    @foreach ( $data['workforce'] as $workforce )
                                        <div class="universal-dropdown-item">
                                            <div class="d-fc">
                                                @if ( $workforce['type'] == 'worker' )
                                                    <button type="button" class="workforce-toggle" data-toggle="collapse" data-target="#workforce-dropdown-{{ $workforce['id'] }}" aria-expanded="false" aria-controls="workforce-dropdown-{{ $workforce['id'] }}">
                                                        <p class="d-flex align-items-center">პერსონალი - {{ $workforce['name'] }} {{ $workforce['last_name'] }} <i class="dark" id="nav-arrow"></i></p>
                                                    </button>
                                                    <div class="collapse" id="workforce-dropdown-{{ $workforce['id'] }}">
                                                        <div class="d-fc">
                                                            @foreach ( json_decode($workforce['selected_vacancies'], true) as $vacancy )
                                                                @foreach ( $data['sub_categories'] as $sub_category )
                                                                    @if ( $sub_category['id'] == $vacancy )
                                                                        <p>არჩეული ვაკანსიები : {{ $sub_category['title'] }}</p>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                            <p>{{ $group_translation[$workforce['amount_of_workers']] }}</p>
                                                            <p class="d-flex">{{ $workforce['phone_number'] }} <a href="tel:{{ $workforce['phone_number'] }}"><i class="yellow" id="awesome-phone"></i></a></p>
                                                        </div>
                                                    </div>
                                                @elseif ( $workforce['type'] == 'legal-entity' )
                                                    <button type="button" class="workforce-toggle" data-toggle="collapse" data-target="#workforce-dropdown-{{ $workforce['id'] }}" aria-expanded="false" aria-controls="workforce-dropdown-{{ $workforce['id'] }}">
                                                        <p class="d-flex align-items-center">იურიდიული პირი - {{ $workforce['company_name'] }} <i class="dark" id="nav-arrow"></i></p>
                                                    </button>
                                                    <div class="collapse" id="workforce-dropdown-{{ $workforce['id'] }}">
                                                        <div class="d-fc">
                                                            @foreach ( json_decode($workforce['selected_vacancies'], true) as $vacancy )
                                                                @foreach ( $data['sub_categories'] as $sub_category )
                                                                    @if ( $sub_category['id'] == $vacancy )
                                                                        <p>არჩეული ვაკანსიები : {{ $sub_category['title'] }}</p>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                            <p>საიდენტიფიკაციო კოდი: {{ $workforce['identification_code'] }}</p>
                                                            <p>საკონტაქტო პირის სახელი: {{ $workforce['legal_entity_name'] }}</p>
                                                            <p>მაღაზიის მისამართი: {{ $workforce['shop_address'] }}</p>
                                                            <p>ემაილი: {{ $workforce['mail'] }}</p>
                                                            <p class="d-flex">{{ $workforce['phone_number'] }} <a href="tel:{{ $workforce['phone_number'] }}"><i class="yellow" id="awesome-phone"></i></a></p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <label class="universal-checkbox-wrapper"><input type="checkbox" value="{{ $workforce['id'] }}"> <div class="before"></div> <div class="after"></div></label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="d-flex w-50 align-self-end">
            <input type="hidden" name="id_string" value="">
            <button type="button" class="universal-button w-50 mr-3 bg-danger" onclick="return confirm('Are you sure you want to delete this?');">
                <span class="mr-3">მონიშნულების წაშლა</span> 
                <label class="universal-radio-wrapper"><input type="radio" name="action" value="delete" required> <div class="before"></div> <div class="after"></div></label>
            </button>
            <button type="button" class="universal-button w-50 bg-success">
                <span class="mr-3">მონიშნულების გააქტიურება</span> 
                <label class="universal-radio-wrapper"><input type="radio" name="action" value="activate" required> <div class="before"></div> <div class="after"></div></label>
            </button>
        </div>

        <button type="submit" disabled class="universal-button align-self-end mt-3">გაგზავნა</button>
    </form>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.universal-checkbox-wrapper input').change(function() {
                let id_array = []
                let id_string = ''

                $('.universal-checkbox-wrapper input:checked').each(function() {
                    id_array.push($(this).val())
                })

                id_string = id_array.join('-')

                $('input[name="id_string"]').val(id_string)

                if ( $('input[name="action"]:checked').length > 0 && $('.universal-checkbox-wrapper input:checked').length > 0 ) {
                    $('button[type="submit"]').prop('disabled', false)
                }
            })
        })

        $('input[name="action"]').change(function() {
            if ( $('input[name="action"]:checked').length > 0 && $('.universal-checkbox-wrapper input:checked').length > 0 ) {
                $('button[type="submit"]').prop('disabled', false)
            }
        })
    </script>
@endsection