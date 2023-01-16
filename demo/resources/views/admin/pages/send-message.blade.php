@php
    use App\Http\Controllers\HelpersCT;
@endphp

@extends('admin.layout')

@section('content')
    @if ( $data['page'] == 'staff' )
        <div class="vacancies-wrapper send-message staff">
            <form action="/admin/send-message-to/staff" method="post" class="d-flex flex-column">
                @csrf
                <button type="button" id="selection-to-message" class="send-message-buttons" disabled>მესიჯის დაწერა (მინიმუმ ერთი ადამიანი უნდა იყოს მონიშნული)</button>
                <button type="button" id="message-to-selection" class="send-message-buttons d-none">უკან დაბრუნება</button>

                <div class="vacancies-left-segment w-100" id="selection">
                    <div class="vacancies-tabs">
                        @foreach ( $data['G'] as $Gi => $G )
                            {{-- Groups --}}
                                <div class="group">
                                    {{-- Group items --}}
                                        <div class="group-items-wrapper">
                                            @foreach ( $data['GI'] as $GIi => $GI )
                                                @if ( $GI['belongs'] == $G['has'] )
                                                    <div class="group-item-wrapper border-0 {{ $GI['child_type'] }}">
                                                        <button class="group-item" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="group-item-{{ $GIi }}" data-target="#group-item-{{ $GIi }}">
                                                            <div class="outer">
                                                                <img src="{{ asset($GI['image']) }}">
                                                            </div>
                                                            <div class="inner">
                                                                <p>{{ $GI['title_'. Session::get('locale')] }}</p>
                                                                <div><span class="dire-right-arrow"></span></div>
                                                            </div>
                                                        </button>

                                                        <div class="collapse group-item" id="group-item-{{ $GIi }}">
                                                            @if ( $GI['child_type'] == 'sub_group' )
                                                                {{-- Sub groups --}}
                                                                    <div class="sub-groups-wrapper">
                                                                        @foreach ( $data['SG'] as $SGi => $SG )
                                                                            @if ( $SG['belongs'] == $GI['has'] )
                                                                                <div class="sub-group border-0">
                                                                                    <button class="sub-group-item" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="sub-group-item-{{ $SGi }}" data-target="#sub-group-item-{{ $SGi }}">
                                                                                        <div class="outer">
                                                                                            <img src="{{ asset($SG['image']) }}">
                                                                                        </div>
                                                                                        <div class="inner">
                                                                                            <p>{{ $SG['title_'. Session::get('locale')] }}</p>
                                                                                            <div><span class="dire-right-arrow"></span></div>
                                                                                        </div>
                                                                                    </button>

                                                                                    <div class="collapse sub-group-item" id="sub-group-item-{{ $SGi }}">
                                                                                        {{-- Sub group items--}}
                                                                                            <div class="checkbox-items-wrapper border-0"> 
                                                                                                @foreach ( $data['SGI'] as $SGIi => $SGI )
                                                                                                    @if ( $SGI['belongs'] == $SG['has'] )
                                                                                                        <div class="staff-group">
                                                                                                            <button class="staff-group-collapse" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="staff-group-collapse-{{ $SGIi }}" data-target="#staff-group-collapse-{{ $SGIi }}">
                                                                                                                <div class="inner">
                                                                                                                    <p>{{ $SGI['title_'. Session::get('locale')] }}</p>
                                                                                                                    <div><span class="dire-right-arrow"></span></div>
                                                                                                                </div>
                                                                                                            </button>

                                                                                                            <div class="collapse staff-group-collapse" id="staff-group-collapse-{{ $SGIi }}">
                                                                                                                <div class="checkbox-item select-all">
                                                                                                                    <label class="w-100 text-center">ყველას მონიშვნა</label>
                                                                                                                </div>
                                                                                                                <div class="checkbox-item deselect-all">
                                                                                                                    <label class="w-100 text-center">მონიშნულების გაუქმება</label>
                                                                                                                </div>
                                                                                                                @foreach ( $data['employees'] as $employee_index => $employee )
                                                                                                                    @if ( in_array($SGI['id'], json_decode($employee['vocations'])) )
                                                                                                                        <div class="checkbox-item">
                                                                                                                            <label for="{{ $SGIi .'-'. $employee_index }}">{{ $employee['name'] }}</label>
                                                                                                                            <span>
                                                                                                                                <a class="call-button" href="tel:{{ $employee['number'] }}">დარეკვა - ({{ $employee['number'] }})</a>
                                                                                                                                <input type="checkbox" id="{{ $SGIi .'-'. $employee_index }}" name="employee_ids[]" value="{{ $employee['id'] }}">
                                                                                                                            </span>
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </div> 
                                                                                        {{-- Sub group items--}}
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                {{-- Sub groups --}}
                                                            @else
                                                                {{-- Sub group items --}}
                                                                    <div class="checkbox-items-wrapper">
                                                                        @foreach ( $data['SGI'] as $SGIi => $SGI )
                                                                            @if ( $SGI['belongs'] == $GI['has'] )
                                                                                <div class="staff-group"> 
                                                                                    <button class="staff-group-collapse" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="staff-group-collapse-{{ $SGIi }}" data-target="#staff-group-collapse-{{ $SGIi }}">
                                                                                        <div class="inner">
                                                                                            <p>{{ $SGI['title_'. Session::get('locale')] }}</p>
                                                                                            <div><span class="dire-right-arrow"></span></div>
                                                                                        </div>
                                                                                    </button>

                                                                                    <div class="collapse staff-group-collapse" id="staff-group-collapse-{{ $SGIi }}">
                                                                                        <div class="checkbox-item select-all">
                                                                                            <label class="w-100 text-center">ყველას მონიშვნა</label>
                                                                                        </div>
                                                                                        @foreach ( $data['employees'] as $employee_index => $employee )
                                                                                            @if ( in_array($SGI['id'], json_decode($employee['vocations'])) )
                                                                                                <div class="checkbox-item">
                                                                                                    <label for="{{ $SGIi .'-'. $employee_index }}">{{ $employee['name'] }}</label>
                                                                                                    <span>
                                                                                                        <a href="tel:{{ $employee['number'] }}">დარეკვა - ({{ $employee['number'] }})</a>
                                                                                                        <input type="checkbox" id="{{ $SGIi .'-'. $employee_index }}" name="employee_ids[]" value="{{ $employee['id'] }}">
                                                                                                    </span>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div> 
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                {{-- Sub group items --}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    {{-- Group items --}}
                                </div>
                            {{-- Groups --}}
                        @endforeach
                    </div>
                </div>

                <div class="write-message-wrapper d-none">
                    <textarea name="message" rows="15" placeholder="თქვენი მესიჯი" required></textarea>
                    <button class="split-button ml-auto mt-3">
                        <span>გაგზავნა</span>
                        <span class="dire-right-arrow"></span>
                    </button>
                </div>
            </form>
        </div>
    @elseif ( $data['page'] == 'shops' )
        <div class="send-message shop">
            <form action="/admin/send-message-to/shops" method="post" class="d-flex flex-column">
                @csrf
                <button type="button" id="selection-to-message" class="send-message-buttons" disabled>მესიჯის დაწერა (მინიმუმ ერთი ადამიანი უნდა იყოს მონიშნული)</button>
                <button type="button" id="message-to-selection" class="send-message-buttons d-none">უკან დაბრუნება</button>

                <div class="shop-groups" id="selection">
                    @foreach ( $data['categories'] as $category_index => $category )
                        <div class="shop-group-wrapper">
                            <button class="shop-group" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="shop-group-{{ $category_index }}" data-target="#shop-group-{{ $category_index }}">
                                <p>{{ $category['title_'. Session::get('locale')] }}</p>
                                <div><span class="dire-right-arrow"></span></div>
                            </button>

                            <div class="collapse shop-group" id="shop-group-{{ $category_index }}">
                                <div class="checkbox-item select-all">
                                    <label class="w-100 text-center">ყველას მონიშვნა</label>
                                </div>
                                <div class="checkbox-item deselect-all">
                                    <label class="w-100 text-center">მონიშნულების გაუქმება</label>
                                </div>
                                @foreach ( $data['shops'] as $shop_index => $shop )
                                    @if ( $shop['field_of_activity'] == $category['id'] )
                                        @if ( HelpersCT::is_admin() )
                                            <div class="checkbox-item">
                                                <label for="{{ $category_index .'-'. $shop_index }}">{{ $shop['name'] }}</label>
                                                <span>
                                                    <a class="call-button" href="tel:{{ $shop['number'] }}">დარეკვა - ({{ $shop['number'] }})</a>
                                                    <input type="checkbox" id="{{ $category_index .'-'. $shop_index }}" name="shop_ids[]" value="{{ $shop['id'] }}">
                                                </span>
                                            </div>
                                        @else
                                            @if ( $shop['category'] == Session::get('admin.info.category') )
                                                <div class="checkbox-item">
                                                    <label for="{{ $category_index .'-'. $shop_index }}">{{ $shop['name'] }}</label>
                                                    <span>
                                                        <a class="call-button" href="tel:{{ $shop['number'] }}">დარეკვა - ({{ $shop['number'] }})</a>
                                                        <input type="checkbox" id="{{ $category_index .'-'. $shop_index }}" name="shop_ids[]" value="{{ $shop['id'] }}">
                                                    </span>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="write-message-wrapper d-none">
                    <textarea name="message" rows="15" placeholder="თქვენი მესიჯი" required></textarea>
                    <button class="split-button ml-auto mt-3">
                        <span>გაგზავნა</span>
                        <span class="dire-right-arrow"></span>
                    </button>
                </div>
            </form>
        </div>
    @endif
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#selection-to-message').click(function() {
                $('#selection').toggleClass('d-none')
                $('.write-message-wrapper').toggleClass('d-none')
                $('.send-message-buttons').toggleClass('d-none')
            })

            $('#message-to-selection').click(function() {
                $('#selection').toggleClass('d-none')
                $('.write-message-wrapper').toggleClass('d-none')
                $('.send-message-buttons').toggleClass('d-none')
            })

            function admin_checkbox_check() {
                if ( $('.checkbox-item input[type="checkbox"]:checked').length > 0 ) {
                    $('#selection-to-message').text('მესიჯის დაწერა')
                    $('#selection-to-message').attr('disabled', false)
                } else {
                    $('#selection-to-message').text('მესიჯის დაწერა (მინიმუმ ერთი ადამიანი უნდა იყოს მონიშნული)')
                    $('#selection-to-message').attr('disabled', true)
                }
            }

            $('.checkbox-item input[type="checkbox"]').change(function() {
                admin_checkbox_check()
            })

            $('.checkbox-item.select-all').click(function () {
                $(this).siblings('.checkbox-item').children('span').children('input').prop('checked', true)
                admin_checkbox_check()
            })

            $('.checkbox-item.deselect-all').click(function () {
                $(this).siblings('.checkbox-item').children('span').children('input').prop('checked', false)
                admin_checkbox_check()
            })
        })
    </script>
@endsection