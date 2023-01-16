@if (Session::has('registration_successful'))
    <div class="alert alert-success hide-alert text-center">რეგისტრაცია მოხდა წარმატებით</div>
@endif

@if (Session::has('login_error'))
    <div class="alert alert-warning hide-alert text-center">ნომერი ან პაროლი არასწორია</div>
@endif

@if (Session::has('call_request_notification_confirmed'))
    <div class="alert alert-success hide-alert text-center">ჩვენ მალე დაგიკავშირდებით, მადლობთ რომ სარგებლობთ ჩვენი მომსახურებით</div>
@endif

@if (Session::has('vacancy_notification_confirmed'))
    <div class="alert alert-success hide-alert text-center">თქვენი შეკვეთა დაფიქსირდა</div>
@endif

@if (Session::has('consultation_notification_confirmed'))
    <div class="alert alert-success hide-alert text-center">თქვენი შეკვეთა დაფიქსირდა</div>
@endif

@if (Session::has('contact_notification_confirmed'))
    <div class="alert alert-success hide-alert text-center">თქვენი შეტყობინება დაფიქსირდა</div>
@endif

@if (Session::has('vip_master_notification_confirmed'))
    <div class="alert alert-success hide-alert text-center">თქვენი შეკვეთა დაფიქსირდა</div>
@endif

@if (Session::has('cleaning_notification_confirmed'))
    <div class="alert alert-success hide-alert text-center">თქვენი შეკვეთა დაფიქსირდა</div>
@endif

@if (Session::has('choose_a_service'))
    <div class="alert alert-warning hide-alert text-center">გთხოვთ აირჩიოთ სერვისი</div>
@endif

@if (Session::has('choose_a_vocation'))
    <div class="alert alert-warning hide-alert text-center">გთხოვთ აირჩიოთ ვაკანსია</div>
@endif

@if (Session::has('too_many_pictures'))
    <div class="alert alert-warning hide-alert text-center">სურათების რაოდენობა არ უნდა აღემატებოდეს 5-ს</div>
@endif

@if (Session::has('pictures_too_large'))
    <div class="alert alert-warning hide-alert text-center">სურათების ზომები არ უნდა აღემატებოდეს 1 მეგაბაიტს</div>
@endif

@if (Session::has('invalid_number'))
    <div class="alert alert-warning hide-alert text-center">ნომერი არ არის ვალიდური</div>
@endif

@if (Session::has('invalid_region'))
    <div class="alert alert-warning hide-alert text-center">ნომერი უნდა იყოს ქართული რეგიონის (+995)</div>
@endif