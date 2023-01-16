@if (Session::has('email_taken'))
<div class="alert alert-danger text-center">ემაილი გამოყენებაშია</div>
@endif
@if (Session::has('password_missmatch'))
<div class="alert alert-danger text-center">პაროლები არ ემთხვევა ერთმანეთს</div>
@endif
@if (Session::has('old_password_incorrect'))
<div class="alert alert-danger text-center">ძველი პაროლი არასწორია</div>
@endif
@if (Session::has('old_password_incorrect'))
<div class="alert alert-success text-center">პროფილის ცვლილებები დამახსოვრებულია</div>
@endif

@if (Session::has('password_incorrect'))
<div class="alert alert-danger text-center">პაროლი არასწორია</div>
@endif
@if (Session::has('register_success'))
<div class="alert alert-success text-center">რეგისტრაცია დამთავრებულია</div>
@endif
@if (Session::has('order_sent'))
<div class="alert alert-success text-center">შეკვეთა გაიგზავნა</div>
@endif
@if (Session::has('vacancy_sent'))
<div class="alert alert-success text-center">ვაკანსია გაიგზავნა</div>
@endif
@if (Session::has('select_vacancies'))
<div class="alert alert-danger text-center">გთხოვთ აირჩიოთ ვაკანსიები</div>
@endif
@if (Session::has('number_used'))
<div class="alert alert-danger text-center">ტელეფონის ნომერი გამოყენებაშია</div>
@endif
@if (Session::has('message_sent'))
<div class="alert alert-success text-center">თქვენი მესიჯი გაიგზავნა წარმატებულად</div>
@endif