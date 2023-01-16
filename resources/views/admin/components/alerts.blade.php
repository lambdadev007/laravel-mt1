@if (Session::has('logout_successful'))
    <div class="alert alert-success">გამოსვლა მოხდა წარმატებულად</div>
@endif

@if (Session::has('login_error'))
    <div class="alert alert-danger">ლოგინი ან პაროლი არასწორია</div>
@endif

@if (Session::has('email'))
    <div class="alert alert-danger">Იმეილი უკვე არსებობს</div>
@endif

@if (Session::has('user_deleted'))
    <div class="alert alert-danger">მომხმარებელი დაბლოკილია</div>
@endif

@if (Session::has('create_success'))
    <div class="alert alert-success text-center">შექმნა მოხდა წარმატებულად</div>
@endif
@if (Session::has('admin_created'))
    <div class="alert alert-success text-center">ადმინისტრატორი წარმატებით შეიქმნა</div>
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
@if (Session::has('login_name'))
    <div class="alert alert-danger">მომხმარებლის სახელი უკვე გადის</div>
@endif