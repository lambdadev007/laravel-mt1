{{-- Cookies Popup --}}
    @if ( !Cookie::has('cookies_agreement') )
        <div class="cookies-popup-wrapper">
            <p>ჩვენ გაცნობებთ, რომ ეს საიტი იყენებს საკუთარი, ტექნიკური და მესამე მხარის cookies, რათა დარწმუნდეთ, რომ ჩვენი ვებ გვერდი არის მოსახერხებელი და უზრუნველყოს მაღალი ფუნქციონირება ვებგვერდზე. ამ ვებ-გვერდის გასაგრძელებლად, თქვენ განაცხადებთ, რომ მიიღოთ ქუქი-ფაილების გამოყენება.</p>
            <div class="cookies-popup-buttons">
                <button type="button">გასაგებია</button>
            </div>
        </div>
    @endif
{{-- Cookies Popup --}}