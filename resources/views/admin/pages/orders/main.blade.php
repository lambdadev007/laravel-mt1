@extends('admin.layout')

@section('content')
    <form class="container-1280 d-fc" action="/enter/vip-master/update/null" method="post" enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-wrap">
            @foreach ( $data['orders'] as $order )
                @php
                    $service_name = '';
                    foreach ( $data['vip_page']['services'] as $service ) {
                        if ( $order['service_id'] == $service['id'] ) $service_name = $service['text'];
                    }
                @endphp
                <div class="col-3">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $service_name }}</li>
                            <li class="list-group-item">{{ $order['name'] }} {{ $order['last_name'] }}</li>
                            <li class="list-group-item">{{ $order['phone_number'] }}</li>
                            <li class="list-group-item">{{ $order['city'] }}</li>
                            <li class="list-group-item">{{ $order['region'] }}</li>
                            @if ( $order['date_type'] == 'any_time' )
                                <li class="list-group-item">ნებისმიერ დროს</li>
                            @else
                                <li class="list-group-item">{{ $order['date'] }}</li>
                                <li class="list-group-item">{{ $order['time_frame'] }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </form>
@endsection