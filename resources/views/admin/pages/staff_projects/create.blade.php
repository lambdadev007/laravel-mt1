@extends('admin.layout')

@section('content')
    <form class="container-800 flex-column" action="/enter/staff_projects/store" method="post" enctype="multipart/form-data" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "Passwords do not match." : "")'>
        @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">სახელი</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" id="name"  class="form-control w-50 mx-auto text-center" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">გვარი</label>
                    <div class="col-sm-10">
                    <input type="text"  name="surname" id="surname" class="form-control w-50 mx-auto text-center" placeholder="Sur Name" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ტელეფონი</label>
                    <div class="col-sm-10">
                    <input type="text" name="number" id="number" class="form-control w-50 mx-auto text-center" maxlength="9" placeholder="Telephone" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ელ.ფოსტა</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" id="email" class="form-control w-50 mx-auto text-center" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ნიკი</label>
                    <div class="col-sm-10">
                    <input type="text" name="login"  class="form-control w-50 mx-auto text-center" placeholder="User Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="password1">პაროლი</label>
                    <div class="col-sm-10">
                    <input type="password" name="password" id="password1" class="form-control w-50 mx-auto text-center" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="password2">პაროლის გამეორება</label>
                    <div class="col-sm-10">
                    <input type="password" name="confirm_password" id="password2" class="form-control w-50 mx-auto text-center" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2 modal-content modal-1160 border-0">
                        <button type="submit" class="universal-button ml-auto text-left">დაამატეთ</button>
                    </div>
                </div>

    </form>
@endsection
