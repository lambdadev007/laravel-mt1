@php
    use Jenssegers\Agent\Agent;
    $agent = new Agent;
@endphp

<div class="notification-info">
    <div class="info-row">
        <span>შექმნის დრო:</span>
        <span>{{ $data['notification']['created_at'] }}</span>
    </div>
    <div class="info-row">
        <span>სახელი:</span>
        <span>{{ json_decode($data['notification']['information'])->requester_name }}</span>
    </div>
    <div class="info-row">
        <span>ნომერი:</span>
        <span>{{ json_decode($data['notification']['information'])->requester_number }}</span>
    </div>
    <div class="info-row">
        <span>სასურველი ჯგუფი:</span>
        <span>{{ $translations['categories'][json_decode($data['notification']['information'])->call_request_category] }}</span>
    </div>
    <div class="info-row finish">
        <a href="tel:{{ json_decode($data['notification']['information'])->requester_number }}">
            <span>დარეკვა</span>
        </a>
    </div>
    @if ( $data['notification']['status'] != 'finished' )
        <div class="info-row finish">
            <form action="/admin/notification/finished" method="POST">
                @csrf
                <button type="submit">
                    <span>დასრულება - წარმატებულად</span>
                    <span class="identifier finished successfully"></span>
                </button>
                <input type="hidden" name="id" value="{{ $data['notification']['id'] }}">
                <input type="hidden" name="finished" value="successfully">
            </form>
        </div>
        <div class="info-row finish">
            <form action="/admin/notification/finished" method="POST">
                @csrf
                <button type="submit">
                    <span>დასრულება - წარუმატებლად</span>
                    <span class="identifier finished unsuccessfully"></span>
                </button>
                <input type="hidden" name="id" value="{{ $data['notification']['id'] }}">
                <input type="hidden" name="finished" value="unsuccessfully">
            </form>
        </div>
    @endif
</div>