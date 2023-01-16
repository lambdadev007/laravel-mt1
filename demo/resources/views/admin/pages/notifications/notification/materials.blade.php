<div class="accordion" id="notification-accordion">
    <div class="notification-info">
        <button class="notification-collapse-button" type="button" data-toggle="collapse" data-target="#details" aria-expanded="false" aria-controls="details">
            შეკვეთის დეტალები <span class="dire-right-arrow"></span>
        </button>

        <div class="notification-collapse collapse" id="details" aria-labelledby="details" data-parent="#notification-accordion">
            <div class="info-row">
                <span>შექმნის დრო:</span>
                <span>{{ $data['notification']['created_at'] }}</span>
            </div>
            <div class="info-row">
                <span>პროდუქტის წონა</span>
                <span>{{ json_decode($data['notification']['information'])->weight }} კგ</span>
            </div>
            <div class="info-row">
                <span>მიტანის დრო</span>
                <span>{{ $translations['delivery'][json_decode($data['notification']['information'])->delivery_time] }} </span>
            </div>
            <div class="info-row">
                <span>მიტანის ფასი</span>
                <span>{{ json_decode($data['notification']['information'])->delivery_price }} <span class="dire-lari"></span></span>
            </div>
            <div class="info-row">
                <span>დამკვეთი</span>
                <span>{{ json_decode($data['notification']['information'])->name }}</span>
            </div>
            <div class="info-row">
                <span>მისამართი</span>
                <span>{{ json_decode($data['notification']['information'])->address }}</span>
            </div>
            <div class="info-row">
                <span>ტელეფონი</span>
                <span>{{ json_decode($data['notification']['information'])->number }}</span>
            </div>
            <div class="info-row">
                <span>პროდუქტის ჩამონათვალი</span>
                <span></span>
            </div>
            <div class="info-row">
                <span>შეკვეთის თარიღი</span>
                <span>{{ $data['notification']['created_at'] }}</span>
            </div>
            <div class="info-row">
                <span>პროდუქტის კოდები</span>
                <span></span>
            </div>
            <div class="info-row">
                <span>სერვისის იდენტიფიკატორი</span>
                <span>{{ $data['notification']['id'] }}</span>
            </div>
        </div>

        <button class="notification-collapse-button" type="button" data-toggle="collapse" data-target="#send" aria-expanded="false" aria-controls="send">
            შეკვეთის გაგზავნა <span class="dire-right-arrow"></span>
        </button>

        <div class="notification-collapse details collapse" id="send" aria-labelledby="send" data-parent="#notification-accordion">
            <div class="info-row flex-column">
                <select name="delivery_man">
                    <option selected disabled>კურიერის არჩევა</option>
                    <option value="curier">კურიერი</option>
                </select>
                <select name="delivery_car">
                    <option selected disabled>მანქანის არჩევა</option>
                    <option value="delivery_car">მანქანა</option>
                </select>
                <select name="shops">
                    <option selected disabled>მაღაზიის არჩევა</option>
                    <option value="vesta">ვესტა ჯგუფი</option>
                    <option value="knauf">კნაუფი</option>
                    <option value="gorgia">გორგია</option>
                </select>
            </div>

            <div class="info-row flex-column">
                <h5>კომენტარი</h5>
                <textarea class="notification-comment" name="comment"></textarea>
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
    </div>
</div>