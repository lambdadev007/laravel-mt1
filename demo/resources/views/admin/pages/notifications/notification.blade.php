@extends('admin.layout')

@php
    $translations = [
        'categories' => [
            'vacancy'               => 'ვაკანსია',
            'materials'             => 'მასალები',
            'vip_master'            => 'ვიპ-მასტერი',
            'designer'              => 'დიზაინერი',
            'cleaning'              => 'დასუფთავება',
            'repairs'               => 'რემონტი',
            'furniture'             => 'ავეჯი',
            'consultation'          => 'კონსულტაცია',
        ],
        'date' => [
            'as_soon_as_possible'   => 'დაუყოვნებლივ',
            'before_visit'          => 'დრო შემითანხმეთ ვიზიტამდე',
        ],
        'delivery' => [
            'regular'               => 'ჩვეულებრივი',
            'fast'                  => 'სწრაფი'
        ]
    ];
@endphp

@section('content')
    <div class="notifications-wrapper">
        @if ( $data['type'] == 'call_request' )
            @include('admin.pages.notifications.notification.call-request')
        @elseif ( $data['type'] == 'vacancy' )
            @include('admin.pages.notifications.notification.vacancy')
        @elseif ( $data['type'] == 'contact' )
            @include('admin.pages.notifications.notification.contact')
        @elseif ( $data['type'] == 'consultation' )
            @include('admin.pages.notifications.notification.consultation')
        @elseif ( $data['type'] == 'vip_master' )
            @include('admin.pages.notifications.notification.vip-master')
        @elseif ( $data['type'] == 'cleaning' )
            @include('admin.pages.notifications.notification.cleaning')
        @elseif ( $data['type'] == 'materials' )
            @include('admin.pages.notifications.notification.materials')
        @endif
    </div>
    <a href="/admin/notifications/{{ $data['type'] }}/{{ $data['timeframe'] }}" class="notifications-back-button"><span class="dire-left-arrow"></span></a>
@endsection

@section('bottom_js')
    <script type="text/javascript">
        @if ( $data['type'] == 'vacancy' )
            $(document).ready(function() {
                $('.finalise-vacancy').click(function() {
                    $('.vacancy-info').toggleClass('d-none');
                    $('.vacancy-registration').toggleClass('d-none');
                })
            })
        @endif
    </script>
@endsection