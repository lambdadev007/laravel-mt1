@php
    use App\Models\Vacancies\{VacanciesSGI, VacanciesS};

    use Jenssegers\Agent\Agent;
    $agent = new Agent;
@endphp

<div class="notification-info">
    <div class="vacancy-info">
        <div class="info-row">
            <span>შექმნის დრო:</span>
            <span>{{ $data['notification']['created_at'] }}</span>
        </div>

        @if ( json_decode($data['notification']['information'])->vacancy_type == 'employee' )
            <div class="info-row">
                <span>სახელი:</span>
                <span>{{ json_decode($data['notification']['information'])->f_name }}</span>
            </div>
            <div class="info-row">
                <span>გვარი:</span>
                <span>{{ json_decode($data['notification']['information'])->l_name }}</span>
            </div>
            <div class="info-row">
                <span>ტელეფონი:</span>
                <span>{{ json_decode($data['notification']['information'])->number }}</span>
            </div>
            <div class="info-row">
                <span>თანამშრომლების რაოდენობა:</span>
                <span>{{ VacanciesS::where('id', json_decode($data['notification']['information'])->how_many)->get()->toArray()[0]['title_'. Session::get('locale')] }}</span>
            </div>
            <div class="info-row border-bottom-0">
                <span class="title">არჩეული ვაკანსიები</span>
            </div>
            <div id="vocations-accordion">
                @foreach (json_decode($data['notification']['information'])->vocations as $id)
                    @php
                        $obj = VacanciesSGI::where('id', $id)->get()->toArray();
                        $obj = $obj[0];
                    @endphp
                    <div class="info-row">
                        <span>{{ $obj['id'] }}:</span>
                        <span>{{ $obj['title_'. Session::get('locale')] }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        @if ( json_decode($data['notification']['information'])->vacancy_type == 'legal_entity' )
            <div class="info-row">
                <span>კომპანიის დასახელება:</span>
                <span>{{ json_decode($data['notification']['information'])->company_name }}</span>
            </div>
            <div class="info-row">
                <span>საიდენტიფიკაციო კოდი:</span>
                <span>{{ json_decode($data['notification']['information'])->identification_code }}</span>
            </div>
            <div class="info-row">
                <span>საკონტაქტო ნომერი:</span>
                <span>{{ json_decode($data['notification']['information'])->number }}</span>
            </div>
            <div class="info-row">
                <span>საკონტაქტო მეილი:</span>
                <span>{{ json_decode($data['notification']['information'])->mail }}</span>
            </div>
            <div class="info-row">
                <span>საქმიანობის სფერო:</span>
                <span>{{ VacanciesS::where('id', json_decode($data['notification']['information'])->field_of_activity)->get()->toArray()[0]['title_'. Session::get('locale')] }}</span>
            </div>
        @endif

        <div class="info-row finish">
            <a href="tel:{{ json_decode($data['notification']['information'])->number }}">
                <span>დარეკვა</span>
            </a>
        </div>

        @if ( $data['notification']['status'] != 'finished' )
            <div class="info-row finish">
                <button type="button" class="finalise-vacancy">
                    <span>ვაკანსიის გააქტიურება</span>
                    <span class="identifier finished successfully"></span>
                </button>
            </div>
            <div class="info-row finish">
                <form action="/admin/notification/finished" method="POST">
                    @csrf
                    <button type="submit">
                        <span>ვაკანსიის უარყოფა</span>
                        <span class="identifier finished unsuccessfully"></span>
                    </button>
                    <input type="hidden" name="id" value="{{ $data['notification']['id'] }}">
                    <input type="hidden" name="finished" value="unsuccessfully">
                </form>
            </div>
        @endif
    </div>

    @if ( $data['notification']['status'] != 'finished' )
        <div class="vacancy-registration d-none">
            <div class="info-row finish">
                <button type="button" class="finalise-vacancy">
                    <span>უკან დაბრუნება</span>
                    <span class="identifier finished unsuccessfully"></span>
                </button>
            </div>
            @if ( json_decode($data['notification']['information'])->vacancy_type == 'employee' )
                <form action="/admin/finalise-vacancy" method="post">
                    @csrf
                    <div class="info-row border-bottom-0">
                        <span class="title">ვაკანსიორის ადმინ პანელში დარეგისტრირება</span>
                    </div>
                    <div class="info-row">
                        <span>თანამშრომლების რაოდენობა:</span>
                        <span>{{ VacanciesS::where('id', json_decode($data['notification']['information'])->how_many)->get()->toArray()[0]['title_'. Session::get('locale')] }}</span>
                    </div>
                    <div class="info-row">
                        <span>სახელი და გვარი:</span>
                        <span><input type="text" name="vacancy_name" readonly value="{{ json_decode($data['notification']['information'])->f_name .' '. json_decode($data['notification']['information'])->l_name }}" required></span>
                    </div>
                    <div class="info-row">
                        <span>ტელ-ნომერი:</span>
                        <span><input type="text" name="vacancy_number" readonly value="{{ json_decode($data['notification']['information'])->number }}" required></span>
                    </div>
                    <div class="info-row">
                        <span>ლოგინი:</span>
                        <span><input type="text" name="vacancy_login" placeholder="ლოგინი აქ" required></span>
                    </div>
                    <div class="info-row">
                        <span>პაროლი: <button type="button" class="string-generator">დაგენერირება</button></span>
                        <span><input type="text" name="vacancy_password" id="generate-here" placeholder="პაროლი აქ" required></span>
                    </div>
                    <div class="info-row">
                        <span>კატეგორია:</span>
                        <span>
                            <select name="vacancy_category">
                                <option value="design">დიზაინი</option>
                                <option value="repairs">რემონტი</option>
                                <option value="furniture">ავეჯი</option>
                                <option value="cleaning">დასუფთავება</option>
                            </select>
                        </span>
                    </div>
                    <div class="info-row finish">
                        <button type="submit">
                            <span>რეგისტრაციის დასრულება</span>
                            <span class="identifier finished successfully"></span>
                        </button>
                    </div>
                    <input type="hidden" name="vacancy_id" value="{{ $data['notification']['id'] }}">
                    <input type="hidden" name="vacancy_type" value="{{ json_decode($data['notification']['information'])->vacancy_type }}">
                    <input type="hidden" name="vacancy_how_many" value="{{ json_decode($data['notification']['information'])->how_many }}">
                    @foreach (json_decode($data['notification']['information'])->vocations as $id)
                        <input type="hidden" name="vacancy_vocations[]" value="{{ $id }}">
                    @endforeach
                </form>
            @endif

            @if ( json_decode($data['notification']['information'])->vacancy_type == 'legal_entity' )
                <form action="/admin/finalise-vacancy" method="post">
                    @csrf
                    <div class="info-row">
                        <span>საქმიანობის სფერო:</span>
                        <span>{{ VacanciesS::where('id', json_decode($data['notification']['information'])->field_of_activity)->get()->toArray()[0]['title_'. Session::get('locale')] }}</span>
                    </div>
                    <div class="info-row">
                        <span>კომპანიის დასახელება:</span>
                        <span><input type="text" name="vacancy_company_name" readonly value="{{ json_decode($data['notification']['information'])->company_name }}" required></span>
                    </div>
                    <div class="info-row">
                        <span>საიდენტიფიკაციო კოდი:</span>
                        <span><input type="text" name="vacancy_identification_code" readonly value="{{ json_decode($data['notification']['information'])->identification_code }}" required></span>
                    </div>
                    <div class="info-row">
                        <span>საკონტაქტო ნომერი:</span>
                        <span><input type="text" name="vacancy_number" readonly value="{{ json_decode($data['notification']['information'])->number }}" required></span>
                    </div>
                    <div class="info-row">
                        <span>საკონტაქტო მეილი:</span>
                        <span><input type="text" name="vacancy_mail" readonly value="{{ json_decode($data['notification']['information'])->mail }}" required></span>
                    </div>
                    <div class="info-row">
                        <span>ლოგინი:</span>
                        <span><input type="text" name="vacancy_login" placeholder="ლოგინი აქ" required></span>
                    </div>
                    <div class="info-row">
                        <span>პაროლი: <button type="button" class="string-generator">დაგენერირება</button></span>
                        <span><input type="text" name="vacancy_password" id="generate-here" placeholder="პაროლი აქ" required></span>
                    </div>
                    <div class="info-row">
                        <span>კატეგორია:</span>
                        <span>
                            <select name="vacancy_category">
                                <option value="design">დიზაინი</option>
                                <option value="repairs">რემონტი</option>
                                <option value="furniture">ავეჯი</option>
                                <option value="cleaning">დასუფთავება</option>
                            </select>
                        </span>
                    </div>
                    <div class="info-row finish">
                        <button type="submit">
                            <span>რეგისტრაციის დასრულება</span>
                            <span class="identifier finished successfully"></span>
                        </button>
                    </div>
                    <input type="hidden" name="vacancy_id" value="{{ $data['notification']['id'] }}">
                    <input type="hidden" name="vacancy_type" value="{{ json_decode($data['notification']['information'])->vacancy_type }}">
                    <input type="hidden" name="vacancy_field_of_activity" value="{{ json_decode($data['notification']['information'])->field_of_activity }}">
                </form>
            @endif
        </div>
    @endif
</div>