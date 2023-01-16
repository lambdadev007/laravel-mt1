@extends('admin.layout')

@section('content')
    <span class="mb-3 text-center">თუ მოქმედების ტექსტი შემოკლებულია კურსორი მიიტანე მთლიანი ვერსია რომ ნახო </br> თუ ცარიელია მაშინ დღეს არაფერი ჯერ არ მოხდა <b>(კალენდარი მაინც მუშაობს)</b></span>

    <div class="logs-wrapper">
        <div class="calendar-search">
            <input type="text" class="logs-datepicker" placeholder="დააწკაპუნე კალენდრით რომ მოძებნო">
        </div>

        <div class="logs">
            <div class="log border-top">
                <span class="initiator"><b>სახელი</b></span>
                <span class="action"><b>მოქმედება</b></span>
                <span class="date"><b>დრო</b></span>
            </div>
            @foreach ( $data['logs'] as $log )
                @php
                    $class = '';

                    if ( $log['created_at'] != date('Y/m/d') ) {
                        $class = 'd-none';
                    }
                @endphp
                
                <div class="log {{ $log['created_at'] .' '. $class }}">
                    @foreach ( $data['admins'] as $admin )
                        @if ( $log['initiator_id'] == $admin['id'] )
                            <span class="initiator">{{ $admin['name'] }}</span>
                        @endif
                    @endforeach
                    <span class="action" data-toggle="tooltip" data-placement="top" title="{{ $log['action'] }}">{{ $log['action'] }}</span>
                    <span class="date">{{ $log['created_at'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.logs-datepicker').datepicker({
                maxViewMode: 1,
                todayBtn: "linked",
                clearBtn: true,
                orientation: "auto",
                daysOfWeekHighlighted: "0,6",
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy/mm/dd',
                language: 'ka-GE'
            })

            $('.calendar-search input').change(function() {
                let date = $(this).val()

                $('.log').each(function() {
                    if ( $(this).hasClass(date) ) {
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                    }
                })
            })
        })
    </script>
@endsection