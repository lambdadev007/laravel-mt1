@if (Session::has('create_success'))
    <div class="alert alert-success text-center">შექმნა მოხდა წარმატებულად</div>
@endif

@if (Session::has('update_success'))
    <div class="alert alert-success text-center">განახლება მოხდა წარმატებულად</div>
@endif

@if (Session::has('delete_success'))
    <div class="alert alert-danger text-center">წაშლა მოხდა წარმატებულად</div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger text-center">მოხდა სერიოზული შეცდომა, გთხვოვთ დაუკავშირდეთ პროგრამისტს</div>
@endif

@if (Session::has('slug_taken'))
    <div class="alert alert-danger">სტატიის ბმული უკვე მოხმარებაშია</div>
@endif

@if (Session::has('login_taken'))
    <div class="alert alert-danger">ლოგინი უკვე მოხმარებაშია</div>
@endif

@if (Session::has('old_password_incorrect'))
    <div class="alert alert-danger">ძველი პაროლი არასწორია</div>
@endif

@if (Session::has('password_mismatch'))
    <div class="alert alert-danger">პაროლები არ ემთხვევა ერთმანეთს</div>
@endif

@if (Session::has('message_sent'))
    <div class="alert alert-success">მესიჯი გაიგზავნა</div>
@endif

@if (Session::has('select_staff'))
    <div class="alert alert-danger">გთხოვთ აირჩიოთ პერსონალი</div>
@endif

@if (Session::has('status_changed'))
    <div class="alert alert-success">შეკვეთის სტატუსი შეიცვალა წარმატებულად</div>
@endif

@if (Session::has('invalid_number'))
    <div class="alert alert-warning hide-alert text-center">ნომერი არ არის ვალიდური - მაგალითი: +995 555 10 10 10/995 555 10 10 10/555 10 10 10</div>
@endif

@if (Session::has('invalid_region'))
    <div class="alert alert-warning hide-alert text-center">ნომერი უნდა იყოს ქართული რეგიონის (+995)</div>
@endif