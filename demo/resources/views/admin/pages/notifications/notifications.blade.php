@extends('admin.layout')

@php
    use App\Http\Controllers\HelpersCT;

    $translations = [
        'categories' => [
            'materials'             => 'მასალები',
            'vip_master'            => 'ვიპ-მასტერი',
            'designer'              => 'დიზაინერი',
            'cleaning'              => 'დასუფთავება',
            'repairs'               => 'რემონტი',
            'vacancies'             => 'ვაკანსიები',
            'furniture'             => 'ავეჯი',
            'consultation'          => 'კონსულტაცია',
        ],
        'timeframes' => [
            'day'       => '24 საათის',
            'month'     => 'ერთი თვის',
            'year'      => 'ერთი წლის'
        ]
    ];
@endphp

@section('content')
    <h3 class="timeframe">{{ $translations['timeframes'][$data['timeframe']] }}</h3>

    @if ( HelpersCT::is_admin() && $data['type'] == 'call_request' )
        <select class="notification-sorting" id="call-request-category">
            <option data-sort="all" selected>ჯგუფი - ყველა</option>
            @foreach ( $translations['categories'] as $category_i => $category_v )
                <option data-sort="{{ $category_i }}">ჯგუფი - {{ $category_v }}</option>
            @endforeach
        </select>
    @endif

    <select class="notification-sorting" id="status">
        <option data-sort="all" selected>სტატუსი - ყველა</option>
        <option data-sort="unseen">სტატუსი - უნახავი</option>
        <option data-sort="seen">სტატუსი - ნანახი</option>
        <option data-sort="successfully">სტატუსი - დასრულებული წარმატებულად</option>
        <option data-sort="unsuccessfully">სტატუსი - დასრულებული წარუმატებლად</option>
    </select>

    <input type="number" id="id-sorting" placeholder="ინვოისის ნომრით სორტირება">

    <div class="notifications-wrapper">
        @if ( $data['notifications'] != [] )
            @foreach ( $data['notifications'] as $index => $notification )
                @php
                    $shalva_status = null;
                    if ( HelpersCT::is_admin() && $notification['shalva_status'] != 'seen' ) $shalva_status = 'shalva-unseen';

                    $notification_category_classes  = $notification['status'] .' '. $notification['finished'] .' '. $notification['id'];
                    $identifier_classes             = $notification['status'] .' '. $notification['finished'] .' '. $shalva_status;
                @endphp
                @if ( $data['type'] == 'call_request')
                    <a class="notification-category {{ json_decode($notification['information'])->call_request_category .' '. $notification_category_classes }}" href="/admin/notification/{{ $data['type'] }}/{{ $data['timeframe'] }}/{{ $notification['id'] }}">
                        <span class="title">{{ $translations['categories'][json_decode($notification['information'])->call_request_category] }}</span>
                        <span class="counter">
                            <span class="number">{{ $notification['id'] }}</span>
                            <div class="identifier {{ $identifier_classes }}"></div>
                        </span>
                    </a>
                @else
                    @php
                        $types = ['vacancy', 'consultation', 'contact', 'vip_master', 'cleaning', 'materials'];
                        $titles = [
                            'vacancy'             => 'ვაკანსია',
                            'consultation'        => 'კონსულტაცია',
                            'contact'             => 'კონტაქტი',
                            'vip_master'          => 'ვიპ-მასტერი',
                            'cleaning'            => 'დასუფთავება',
                            'materials'           => 'მასალები'
                        ];

                        $vacancy_types = [
                            'ka' => [
                                'employee'          => 'თანამშრომელი',
                                'legal_entity'      => 'იურიდიული პირი'
                            ],
                            'en' => [
                                'employee'          => 'Employee',
                                'legal_entity'      => 'Legal entity'
                            ],
                        ];
                    @endphp
                    @foreach ($types as $index => $type)
                        @php
                            if ( $data['type'] == 'vacancy' ) {
                                $vacancy_type = $vacancy_types[Session::get('locale')][json_decode($notification['information'])->vacancy_type];
                            }
                        @endphp

                        @if ( $data['type'] == $type )
                            <a class="notification-category {{ $notification_category_classes }}" href="/admin/notification/{{ $data['type'] }}/{{ $data['timeframe'] }}/{{ $notification['id'] }}">
                                <span class="title">{{ $titles[$type] }} - {{ ($data['type'] == 'vacancy') ? $vacancy_type : '' }}</span>
                                <span class="counter">
                                    <span class="number">{{ $notification['id'] }}</span>
                                    <div class="identifier {{ $identifier_classes }}"></div>
                                </span>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @elseif ( $data['type'] == 'materials' )
            <form action="/notification" method="post">
            @csrf
                <input type="hidden" name="weight" value="47">
                <input type="hidden" name="delivery_time" value="fast">
                <input type="hidden" name="delivery_price" value="27">
                <input type="hidden" name="name" value="შალვა მჭედლიშვილი">
                <input type="hidden" name="address" value="ახმეტის ქუჩა 18ა">
                <input type="hidden" name="number" value="597056520">
                <input type="hidden" name="type" value="materials">
                <button class="notification-category text-center" type="submit">ახალის შექმნა</button>
            </form>
        @else
            <h5 class="no-notifications">ეს კატეგორია ცარიელია</h5>
        @endif
    </div>

    <a href="/admin/notification-categories/{{ $data['timeframe'] }}" class="notifications-back-button"><span class="dire-left-arrow"></span></a>
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function() {
            let sort_status = 'all'

            $('.notification-sorting').change(function(){
                let sort_status = $('#status').find(':selected').data('sort')
                
                @if ( $data['type'] == 'call_request' )
                    let sort_category = $('#call-request-category').find(':selected').data('sort')
                @endif

                @if ( $data['type'] == 'call_request' )
                    if ( sort_status == 'all' && sort_category == 'all' ) {
                        $('.notification-category').removeClass('d-none')
                    } else if ( sort_status == 'all' && sort_category != 'all' ) {
                        $('.notification-category').removeClass('d-none')
                        $(`.notification-category:not(.${sort_category})`).addClass('d-none')
                    } else if ( sort_status != 'all' && sort_category == 'all' ) {
                        $('.notification-category').removeClass('d-none')
                        $(`.notification-category:not(.${sort_status})`).addClass('d-none')
                    } else if ( sort_status != 'all' && sort_category != 'all' ) {
                        $('.notification-category').removeClass('d-none')
                        $(`.notification-category:not(.${sort_status})`).addClass('d-none')
                        $(`.notification-category:not(.${sort_category})`).addClass('d-none')
                    }
                @else
                    if ( sort_status == 'all' ) {
                        $('.notification-category').removeClass('d-none')
                    } else {
                        $('.notification-category').removeClass('d-none')
                        $(`.notification-category:not(.${sort_status})`).addClass('d-none')
                    }
                @endif
            })

            $('#id-sorting').on('input', function() {
                $('.notification-category').addClass('d-none')
                $(`.notification-category[class*="${$(this).val()}"]`).removeClass('d-none')
            })
        })
    </script>
@endsection