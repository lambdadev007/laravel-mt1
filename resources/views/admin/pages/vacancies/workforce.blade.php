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
    <form class="d-fc" action="/enter/workforce/delete/hard" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <h5 class="vacancies" id="countdown">24:00:00</h5> --}}

        <div class="vacancies-wrapper d-fc container-1280">
            <div class="top d-fc">
                <div class="category-buttons">
                    @if ( $agent->isMobile() || $agent->isTablet() )
                        <button type="button" class="active" data-group="repairs"><i id="paint-roller"></i></button>
                        <button type="button" class="" data-group="vip"><i id="wrench"></i></button>
                        <button type="button" class="" data-group="design"><i id="paint-brush"></i></button>
                        <button type="button" class="" data-group="furniture"><i id="couch"></i></button>
                        <button type="button" class="" data-group="legal-entity"><i id="legal-entity"></i></button>
                    @else
                        <button type="button" class="active" data-group="repairs"><i id="paint-roller"></i> <p>რემონტი</p></button>
                        <button type="button" class="" data-group="vip"><i id="wrench"></i> <p>ვიპ-მასტერი</p></button>
                        <button type="button" class="" data-group="design"><i id="paint-brush"></i> <p>დიზაინერი</p></button>
                        <button type="button" class="" data-group="furniture"><i id="couch"></i> <p>ავეჯის დამზადება</p></button>
                        <button type="button" class="" data-group="legal-entity"><i id="legal-entity"></i> <p>იურიდიული პირებისთვის</p></button>
                    @endif
                </div>
            </div>
            <div class="bottom">
                @foreach (['furniture', 'vip', 'design', 'repairs', 'legal-entity'] as $group)
                    <div class="left w-100 d-fc {{ ($group != 'repairs') ? 'd-none' : '' }}" id="{{ $group }}">
                        @if ( $data['exists'] )
                            @foreach ( $data['categories'] as $category )
                                @if ( $category['belongs'] == $group )
                                    @foreach ( $data['sub_categories'] as $sub_category )
                                        @if ( $sub_category['belongs'] == $category['has'] )
                                            <div class="universal-dropdowns">
                                                <button type="button" data-toggle="collapse" data-target="#vacancies-dropdown-{{ $sub_category['id'] }}" aria-expanded="false" aria-controls="vacancies-dropdown-{{ $sub_category['id'] }}">
                                                    <div class="d-flex justify-content-start {{ ($agent->isMobile() || $agent->isTablet()) ? 'w-75' : 'w-25' }}">
                                                        @php
                                                            $count = 0;
                                                            foreach ( $data['workforce'] as $workforce ) {
                                                                foreach ( json_decode($workforce['selected_vacancies'], true) as $selected_vacancy ) {
                                                                    if ( $selected_vacancy == $sub_category['id'] ) {
                                                                        $count++;
                                                                    }
                                                                }
                                                            }
                                                        @endphp
                                                        <p>{{ $sub_category['title'] }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-center {{ ($agent->isMobile() || $agent->isTablet()) ? 'w-0' : 'w-25' }}"></div>
                                                    <div class="d-flex justify-content-center {{ ($agent->isMobile() || $agent->isTablet()) ? 'w-0' : 'w-25' }}"></div>
                                                    <div class="w-25 d-flex justify-content-end">
                                                        <span class="icon-wrapper bg-white mr-3" style="color: rgb(var(--metrix-orange-accent))">{{ $count }}</span>
                                                        <span class="icon-wrapper send-msg-to-group bg-white" data-toggle="modal" data-target="#send-message" data-id="{{ $sub_category['id'] }}"><i class="orange" id="contact-envelope"></i></span>
                                                    </div>
                                                </button>
                                                <div class="collapse" id="vacancies-dropdown-{{ $sub_category['id'] }}">
                                                    <div class="universal-dropdown-items d-fc">
                                                        @foreach ( $data['workforce'] as $workforce )
                                                            @foreach ( json_decode($workforce['selected_vacancies'], true) as $selected_vacancy )
                                                                @if ( $selected_vacancy == $sub_category['id'] )
                                                                    <div class="universal-dropdown-item">
                                                                        <div class="d-fc">
                                                                            @if ( $workforce['type'] == 'worker' )
                                                                                <button type="button" class="workforce-toggle d-flex align-items-center" data-toggle="collapse" data-target="#workforce-dropdown-{{ $sub_category['id'] }}-{{ $workforce['id'] }}" aria-expanded="false" aria-controls="workforce-dropdown-{{ $sub_category['id'] }}-{{ $workforce['id'] }}">
                                                                                    <p class="d-flex mr-3 no-propagation"><a href="tel:{{ $workforce['phone_number'] }}"><i class="yellow" id="awesome-phone"></i></a></p>
                                                                                    <p class="d-flex align-items-center">{{ $workforce['name'] }} {{ $workforce['last_name'] }}</p>
                                                                                    <label class="universal-checkbox-wrapper ml-auto"><input class="check-for-action-checkbox" type="checkbox" data-id="{{ $workforce['id'] }}"> <div class="before"></div> <div class="after"></div></label>
                                                                                </button>
                                                                                <div class="collapse" id="workforce-dropdown-{{ $sub_category['id'] }}-{{ $workforce['id'] }}">
                                                                                    <div class="d-fc">
                                                                                        <p>{{ $group_translation[$workforce['amount_of_workers']] }}</p>
                                                                                        <p class="d-flex">{{ $workforce['phone_number'] }} <a href="tel:{{ $workforce['phone_number'] }}"><i class="yellow" id="awesome-phone"></i></a></p>
                                                                                    </div>
                                                                                </div>
                                                                            @elseif ( $workforce['type'] == 'legal-entity' )
                                                                                <button type="button" class="workforce-toggle d-flex align-items-center" data-toggle="collapse" data-target="#workforce-dropdown-{{ $sub_category['id'] }}-{{ $workforce['id'] }}" aria-expanded="false" aria-controls="workforce-dropdown-{{ $sub_category['id'] }}-{{ $workforce['id'] }}">
                                                                                    <p class="d-flex mr-3 no-propagation"><a href="tel:{{ $workforce['phone_number'] }}"><i class="yellow" id="awesome-phone"></i></a></p>
                                                                                    <p class="d-flex align-items-center">{{ $workforce['company_name'] }}</p>
                                                                                    <label class="universal-checkbox-wrapper ml-auto"><input class="check-for-action-checkbox" type="checkbox" data-id="{{ $workforce['id'] }}"> <div class="before"></div> <div class="after"></div></label>
                                                                                </button>
                                                                                <div class="collapse" id="workforce-dropdown-{{ $sub_category['id'] }}-{{ $workforce['id'] }}">
                                                                                    <div class="d-fc">
                                                                                        <p>საიდენტიფიკაციო კოდი: {{ $workforce['identification_code'] }}</p>
                                                                                        <p>საკონტაქტო პირის სახელი: {{ $workforce['legal_entity_name'] }}</p>
                                                                                        <p>მაღაზიის მისამართი: {{ $workforce['shop_address'] }}</p>
                                                                                        <p>ემაილი: {{ $workforce['mail'] }}</p>
                                                                                        <p class="d-flex">{{ $workforce['phone_number'] }} <a href="tel:{{ $workforce['phone_number'] }}"><i class="yellow" id="awesome-phone"></i></a></p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="container-1280 d-fc">
            <input type="hidden" name="id_string">
            <button type="submit" class="universal-button align-self-end" onclick="return confirm('Are you sure you want to delete this?');">მონიშნულების წაშლა</button>
        </div>
    </form>
    <div class="modal fade modal-background" id="send-message" tabindex="-1" role="dialog" aria-labelledby="send-message-label" aria-hidden="true">
        <div class="modal-dialog modal-custom modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="d-fc" action="/sendsms/workforce" method="post">
                    @csrf
                    <textarea class="form-control" name="message_text" cols="20" rows="10" placeholder="ჩაწერეთ თქვენი მესიჯი"></textarea>
                    <input type="hidden" name="message_target">
                    <button type="submit" class="universal-button w-75 my-3 mx-auto">გაგზავნა</button>
                </form>
            </div>
        </div>
    </div>
    
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

        $('.send-msg-to-group').click(function() {
            $('#send-message input[name="message_target"]').val($(this).data('id'))
        })

        $('.workforce-toggle .universal-checkbox-wrapper, .no-propagation').click(function(e) {
            e.stopPropagation()
        })
    </script>
@endsection