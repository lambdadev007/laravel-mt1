@extends('user.layout')

@php
    use Jenssegers\Agent\Agent;

    $agent = new Agent();
@endphp

@if ( $data['exists'] )
    @section('meta')
        <meta property="og:url" content="{{ url()->current() }}"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="{{ $data['raw']['meta_title'] }}"/>
        <meta property="og:description" content="{{ $data['raw']['meta_description'] }}"/>
        <meta property="og:image" content="{{ asset('images/logos/logo.png') }}"/>

        <title>{{ $data['raw']['meta_title'] }}</title>
        <meta name="keywords" content="{{ $data['raw']['meta_keywords'] }}">
        <meta name="description" content="{{ $data['raw']['meta_description'] }}">
    @endsection
@endif

@section('content')
    <div class="vacancies-wrapper d-fc container-1280">
        <div class="top d-fc">
            <div class="sunken-title">
                <h1>ვაკანსიები</h1> <i class="square"></i> @if ( !$agent->isMobile() ) <i id="question-mark"></i> @endif <a href="#how-to-register" data-toggle="modal" data-target="#how-to-register">როგორ დავრეგისტრირდე</a>
            </div>
            <div class="sunken-title-line"></div>
            <div class="category-buttons">
                @if ( $agent->isMobile() )
                    <button class="active" data-group="repairs"><i id="paint-roller"></i></button>
                    <button class="" data-group="vip"><i id="wrench"></i></button>
                    <button class="" data-group="design"><i id="paint-brush"></i></button>
                    <button class="" data-group="furniture"><i id="couch"></i></button>
                    <button class="" data-group="legal-entity"><i id="legal-entity"></i></button>
                @else
                    <button class="active" data-group="repairs"><i id="paint-roller"></i> <p>რემონტი</p></button>
                    <button class="" data-group="vip"><i id="wrench"></i> <p>ვიპ-მასტერი</p></button>
                    <button class="" data-group="design"><i id="paint-brush"></i> <p>დიზაინერი</p></button>
                    <button class="" data-group="furniture"><i id="couch"></i> <p>ავეჯის დამზადება</p></button>
                    <button class="" data-group="legal-entity"><i id="legal-entity"></i> <p>იურიდიული პირებისთვის</p></button>
                @endif
            </div>
        </div>
        <form class="bottom" action="/send-vacancy" method="post">
            @csrf
            @foreach (['furniture', 'vip', 'design', 'repairs', 'legal-entity'] as $group)
                <div class="left d-fc {{ ($group != 'repairs') ? 'd-none' : '' }}" id="{{ $group }}">
                    @if ( !$agent->isMobile() && !$agent->isTablet() )
                        <div class="vacancies-dropdowns-header">
                            <span class="justify-content-start"><i class="dark" id="user"></i> ვაკანსიის დასახელება</span>
                            <span class=""><i class="dark" id="calendar"></i> ბოლო ვადა</span>
                            <span><i class="dark" id="pin"></i> სამუშაო არეალი</span>
                            <span></span>
                        </div>
                    @endif
                    @if ( $data['exists'] )
                        @foreach ( $data['categories'] as $category )
                            @if ( $category['belongs'] == $group )
                                <div class="universal-dropdowns">
                                    <button type="button" data-toggle="collapse" data-target="#vacancies-dropdown-{{ $category['has'] }}" aria-expanded="true" aria-controls="vacancies-dropdown-{{ $category['has'] }}">
                                        <div class="d-flex justify-content-start w-25">
                                            <p>{{ $category['title'] }}</p>
                                        </div>
                                        @if ( $agent->isMobile() )
                                            <div class="d-flex justify-content-center w-25">
                                                <span class="gray">{{ $category['final_date'] }}</span>
                                            </div>
                                        @endif
                                        <div class="d-flex justify-content-center w-25">
                                            <span class="gray">{{ $category['area_of_expertise'] }}</span>
                                        </div>
                                        <div class="w-25 d-flex justify-content-end">
                                            <span class="icon-wrapper"><i class="white" id="nav-arrow"></i></span>
                                        </div>
                                    </button>
                                    <div class="collapse show" id="vacancies-dropdown-{{ $category['has'] }}">
                                        <div class="universal-dropdown-items d-fc">
                                            @foreach ( $data['sub_categories'] as $sub_category )
                                                @if ( $sub_category['belongs'] == $category['has'] )
                                                    <div class="universal-dropdown-item">
                                                        <p>{{ $sub_category['title'] }}</p>
                                                        <label class="universal-checkbox-wrapper"><input type="checkbox" value="{{ $sub_category['id'] }}"> <div class="before"></div> <div class="after"></div></label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach

            @if ( $agent->isMobile() )
                <button type="button" data-toggle="modal" data-target="#vacancies-modal" id="vacancies-modal-button" class="d-none">გაგზავნა</button>
                <div class="modal fade modal-background" id="vacancies-modal" tabindex="-1" role="dialog" aria-labelledby="vacancies-modal-label" aria-hidden="true">
                    <div class="modal-dialog modal-custom modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form class="container-790 d-fc" method="post">
                                @csrf
                                <div class="universal-card d-fc" data-type="worker">
                                    <p class="top-text">თქვენ გაქვთ მონიშნული <br> <strong>0 ვაკანსია</strong></p>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="სახელი" required>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="გვარი" required>
                                    <div class="select-wrapper">
                                        <select name="amount_of_workers">
                                            <option disabled selected>თანამშრომლების რაოდენობა</option>
                                            <option value="alone">ვმუშაობ მარტო</option>
                                            <option value="small_group">ვმუშაობთ 2-3 კაცი</option>
                                            <option value="group">ვმუშაობთ ჯგუფი</option>
                                        </select>
                                        <i class="orange" id="nav-arrow"></i>
                                    </div>
                                    <div class="number-input-wrapper"><input type="number" name="phone_number" value="{{ old('number') }}" placeholder="ტელეფონის ნომერი" required> <div class="icon-wrapper"><i class="white" id="envelope"></i></div></div>
                                    {{-- <input type="text" placeholder="SMS კოდი" required> --}}
                                    <p class="bottom-text">გაგზავნის ღილაკზე დაჭერით ეთანხმებით <br> <a href="#">საიტის წესებს</a></p>
                                    <input type="hidden" name="selected_vacancies" value="" required>
                                    <input type="hidden" name="type" value="worker" required>
                                    <button type="submit" class="bottom-button">გაგზავნა</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="right">
                    <div class="universal-card d-fc" data-type="worker">
                        <p class="top-text">თქვენ გაქვთ მონიშნული <br> <strong>0 ვაკანსია</strong></p>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="სახელი" required>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="გვარი" required>
                        <div class="select-wrapper">
                            <select name="amount_of_workers">
                                <option disabled selected>თანამშრომლების რაოდენობა</option>
                                <option value="alone">ვმუშაობ მარტო</option>
                                <option value="small_group">ვმუშაობთ 2-3 კაცი</option>
                                <option value="group">ვმუშაობთ ჯგუფი</option>
                            </select>
                            <i class="orange" id="nav-arrow"></i>
                        </div>
                        <div class="number-input-wrapper"><input type="number" name="phone_number" value="{{ old('number') }}" placeholder="ტელეფონის ნომერი" required> <div class="icon-wrapper"><i class="white" id="envelope"></i></div></div>
                        {{-- <input type="text" placeholder="SMS კოდი" required> --}}
                        <p class="bottom-text">გაგზავნის ღილაკზე დაჭერით ეთანხმებით <br> <a href="#">საიტის წესებს</a></p>
                        <input type="hidden" name="selected_vacancies" value="" required>
                        <input type="hidden" name="type" value="worker" required>
                        <button type="submit" class="bottom-button" disabled>გაგზავნა</button>
                    </div>
                </div>
            @endif
        </form>
        <div id="refresh-vacancies" class="d-none"></div>
    </div>

    <div class="modal fade modal-background" id="how-to-register" tabindex="-1" role="dialog" aria-labelledby="how-to-register-label" aria-hidden="true">
        <div class="modal-dialog modal-custom modal-1160 modal-terms modal-dialog-centered" role="document">
            <div class="modal-content terms-background">
                <div class="top-misc">
                    <h3 class="modal-title">როგორ დავრეგისტრირდე</h3>
                    <span class="close-modal" data-dismiss="modal">&times</span>
                </div>
                <div class="d-fc container-1000">
                    @if ( $data['register-modal']['exists'] )
                        {!! $data['register-modal']['content'] !!}
                    @else
                        <h3>ინფორმაციის სიზუსტე</h3>
                        <p>ბანკი არ არის პასუხისმგებელი ვებ-გვერდზე მითითებული ინფორმაციის შინაარსის სიზუსტეზე, მიუხედავად ჩვენი დიდი ძალისხმევისა მოგაწოდოთ უტყუარი ინფორმაცია. აღნიშნული არ წარმოადგენს დადასტურებას და გარანტიას, რომ ვებ-გვერდზე მითითებული ინფორმაცია არის ზუსტი, უტყუარი და შესაფერისი მისი ნებისმიერი გამოყენებისთვის. ბანკის ვებ-გვერდზე არსებული ნებისმიერი ინფორმაცია მითითებულია  „როგორც არის" ("As Is") საწყისზე. შესაბამისად, ვებ-გვერდზე არსებული ნებისმიერი ინფორმაციის გამოყენება სრულად წარმოადგენს მომხმარებლის პირად რისკს და ბანკი არ არის პასუხისმგებელი ვებ-გვერდზე გამოქვეყნებული ინფორმაციის გამოყენებით დამდგარ ზიანზე. წინამდებარე დათქმა არ ეხება ბანკის ვებ-გვერდზე განთავსებული ხელშეკრულების შემადგენელ ნაწილებს. <br><br> ვებ-გვერდზე არსებული ინფორმაცია არ წარმოადგენს დაპირებას მომსახურებაზე/პროდუქტზე ან რაიმე სახის სახელშეკრულებო ურთიერთობით ბანკის შებოჭვის საფუძველს.</p> 

                        <br><br><br>

                        <h3>პასუხისმგებლობის შეზღუდვა </h3>
                        <p>ბანკი და მისი შესაბამისი თანამშრომლები არ არიან პასუხისმგებელნი დამდგარი შედეგისათვის, რომელიც მოიცავს პირდაპირ, არაპირდაპირ, სპეციალურ, შემთხვევით, მიზეზ-შედეგობრივ, არასახელშეკრულებო ზიანს, რაც გამოწვეულია ვებ-გვერდზე მითითებული ინფორმაციის გამოყენებით. <br><br> ბანკი არ აგებს პასუხს ვებ-გვერდის გამოყენებით გამოწვეულ რაიმე სახის ზიანზე, დანაკარგზე, თუნდაც  ტექნიკური შეფერხების, დეფექტის, ოპერაციის გაუქმება/შეჩერების, კომპიუტერული ვირუსის, ან სისტემის გაუმართაობის შემთხვევაში. <br><br>  ვებ-გვერდზე წარმოდგენილი შინაარსის ხელმისაწვდომობა შესაძლოა დამოკიდებული იყოს საძიებო სისტემის ფუნქციებსა და შეზღუდვებზე. ბანკი არ იღებს პასუხისმგებლობას იმ შემთხვევებზე, თუ ვებ-გვერდის შემადგენელი გარკვეული კომპონენტები არაა ხელმისაწვდომი თქვენთვის.</p>
                        
                        <br><br><br>

                        <h3>ვებ-გვერდის გამოყენება</h3>
                        <p>ვებ-გვერდზე მითითებული ინფორმაცია განკუთვნილია მხოლოდ მომხმარებლების პირადი გამოყენებისთვის. თქვენ ვალდებული ხართ, ვებ-გვერდზე განთავსებული ინფორმაცია, ასევე ვებ-გვერდის სტრუქტურა, გამოსახულება და დიაზინი არ გაავრცელოთ, არ გადასცეთ, არ მოახდინოთ მისი ასლების დამზადება ან/და რეპროდუცირება (მათ შორის სოციალურ მედიაში) კომერციული მიზნებისთვის, ბანკის წინასწარი წერილობითი თანხმობის გარეშე, რაც ჩვენს ერთპიროვნულ დისკრეციას წარმოადგენს. ბანკის წინასწარი წერილობითი თანხმობა არ არის საჭირო, თუ ვებ-გვერდზე მითითებული ინფორმაციის/შინაარსის გამოყენება ხდება ბანკის წინასწარ განცხადებული თანხმობის შესაბამისად, ან ასეთი ინფორმაცია გამოიყენება პირადი მოხმარებისთვის, საგანმანათლებლო ან ინფორმაციული მიზნებისთვის. <br><br> ვებ-გვერდისა და სისტემის არაავტორიზებული გამოყენება (მათ შორის არარსებული დასახელებით და კოდით) სასტიკად აკრძალულია. იქ სადაც მოითხოვება რეგისტრაცია და პაროლის გამოყენება, თქვენ ვალდებული ხართ, კონფიდენციალურად შეინახოთ და არ დაუშვათ მესამე პირის მიერ ვებ-გვერდზე წვდომის შესაძლებლობა თქვენ მაგივრად. <br><br> შესაძლებელია, რომ ვებ-გვერდის რომელიმე კონკრეტული გვერდი შეიცავდეს წინამდებარე წესებისაგან და პირობებისაგან განსხვავებულ დანაწესებს. მათ შორის კოლიზიის არსებობის შემთხვევაში, უპირატესობა ენიჭება წინამდებარე დანაწესებს.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if ( $agent->isMobile() || $agent->isTablet() )
        <script type="text/javascript">
            $(document).ready(function() {
                $('.universal-checkbox-wrapper input').change(function() {
                    let count = String($('.universal-checkbox-wrapper input:checked').length)
                    if ( count > 0 ) {
                        $('#vacancies-modal-button').removeClass('d-none')
                    } else {
                        $('#vacancies-modal-button').addClass('d-none')
                    }
                })
            })
        </script>
    @endif
@endsection