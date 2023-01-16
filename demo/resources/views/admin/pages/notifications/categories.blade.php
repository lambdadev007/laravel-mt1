@extends('admin.layout')

@php
    use App\Http\Controllers\HelpersCT;

    $translations = [
        'timeframes' => [
            'day'       => '24 საათის',
            'month'     => 'ერთი თვის',
            'year'      => 'ერთი წლის'
        ]
    ];

    $statuses   = ['unfinished', 'finished', 'unseen', 'seen', 'total'];

    foreach ( $statuses as $status ) {
        if ( array_key_exists('call_request',   $data['total']) )    $translations['categories']['call_request']     = 'ზარის შეკვეთა';
        if ( array_key_exists('vacancy',        $data['total']) )    $translations['categories']['vacancy']          = 'ვაკანსიები';
        if ( array_key_exists('contact',        $data['total']) )    $translations['categories']['contact']          = 'კონტაქტი';
        if ( array_key_exists('consultation',   $data['total']) )    $translations['categories']['consultation']     = 'კონსულტაცია';
        if ( array_key_exists('materials',      $data['total']) )    $translations['categories']['materials']        = 'მასალები';
        if ( array_key_exists('vip_master',     $data['total']) )    $translations['categories']['vip_master']       = 'ვიპ-მასტერი';
        if ( array_key_exists('cleaning',       $data['total']) )    $translations['categories']['cleaning']         = 'დასუფთავება';
    }
@endphp

@section('content')
    <h3 class="timeframe">{{ $translations['timeframes'][$data['timeframe']] }}</h3>

    <div class="notifications-wrapper">
        @foreach ( $translations['categories'] as $index => $category_translation )
            @php
                if ( $data['unseen'][$index] > 0 ) {
                    $status = 'unseen';
                } elseif ( $data['seen'][$index] > 0 ) {
                    $status = 'seen';
                } else {
                    $status = 'finished successfully';
                }

                $shalva_status = '';

                if ( HelpersCT::is_admin() && $data['shalva_status'][$index] > 0 ) {
                    $shalva_status = 'shalva-unseen';
                }
            @endphp
            <a class="notification-category" href="/admin/notifications/{{ $index }}/{{ $data['timeframe'] }}">
                <span class="title">{{ $category_translation }}</span>
                <span class="counter">
                    @if ( $data['timeframe'] == 'day' )
                        <span class="number">{{ $data['unfinished'][$index] }}</span>
                    @else
                        <span class="number">{{ $data['total'][$index] }}</span>
                    @endif
                    <div class="identifier {{ $status }} {{ $shalva_status }}"></div>
                </span>
            </a>
        @endforeach
    </div>
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.notification-category .counter .number').each(function() {
                if ( parseInt($(this).text()) > 0 ) {
                    $(this).parent('span').siblings('.title').css('color', 'rgba(var(--metrix-yellow-accent),1)')
                }
            })
        })
    </script>
@endsection