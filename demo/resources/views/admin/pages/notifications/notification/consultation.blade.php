@php
    use App\Models\Services\Consultation;
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
        <span>{{ json_decode($data['notification']['information'])->name }}</span>
    </div>
    <div class="info-row">
        <span>ქალაქი:</span>
        <span>{{ json_decode($data['notification']['information'])->city }}</span>
    </div>
    <div class="info-row">
        <span>რეგიონი:</span>
        <span>{{ json_decode($data['notification']['information'])->region }}</span>
    </div>
    <div class="info-row">
        <span>მისამართი:</span>
        <span>{{ json_decode($data['notification']['information'])->address }}</span>
    </div>
    <div class="info-row">
        <span>ტელეფონი:</span>
        <span>{{ json_decode($data['notification']['information'])->number }}</span>
    </div>
    <div class="info-row">
        <span>სტატუსი:</span>
        @if ( in_array(json_decode($data['notification']['information'])->date, ['as_soon_as_possible', 'before_visit']) )
            <span>{{ $translations['date'][json_decode($data['notification']['information'])->date] }}</span>
        @else
            <span>{{ json_decode($data['notification']['information'])->date }}</span>
        @endif
    </div>
    <div class="info-row">
        <span>სერვისების ფასების ჯამი:</span>
        <span>{{ json_decode($data['notification']['information'])->total }} <span class="dire-lari"></span></span>
    </div>
    <div class="info-row border-bottom-0">
        <span class="title">სერვისები</span>
    </div>
    <div id="services-accordion">
        @foreach (json_decode($data['notification']['information'])->services as $id)
            @php
                $obj = Consultation::where('id', $id)->get()->toArray();
                $obj = $obj[0];
            @endphp
            <button class="notification-collapse-button" type="button" data-toggle="collapse" data-target="#service-{{ $id }}" aria-expanded="false" aria-controls="service-{{ $id }}">
                სერვისის იდენტიფიკატორი: {{ $id }} <span class="dire-right-arrow"></span>
            </button>

            <div class="notification-collapse details collapse flex-column" id="service-{{ $id }}" aria-labelledby="service-{{ $id }}" data-parent="#services-accordion">
                <div class="info-row">
                    <span>სერვისის სახელი:</span>
                    <span>{{ $obj['title_'. Session::get('locale')] }}</span>
                </div>
                <div class="info-row">
                    <span class="cut-text">სერვისის აღწერა:</span>
                    <span>{{ $obj['title_'. Session::get('locale')] }}</span>
                </div>
                <div class="info-row">
                    <span>სერვისის ფასი:</span>
                    <span>{{ $obj['price'] }} <span class="dire-lari"></span></span>
                </div>
            </div>
        @endforeach
    </div>
    <div class="info-row finish">
        <a href="tel:{{ json_decode($data['notification']['information'])->number }}">
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