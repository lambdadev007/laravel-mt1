@extends('admin.layout')
@php
use Illuminate\Support\Facades\Hash;
@endphp
@section('content')
    <form class="container-800 flex-column" action="/enter/staff_projects/update/{{ $data['admins']['id'] }}" method="post" enctype="multipart/form-data" oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "Passwords do not match." : "")'>
        @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">სახელი</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" value="{{ $data['admins']['name'] }}" id="name" class="form-control w-50 mx-auto text-center" placeholder="სახელი" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">გვარი</label>
                    <div class="col-sm-10">
                    <input type="text"  name="surname" value="{{ $data['admins']['surname'] }}" id="surname" class="form-control w-50 mx-auto text-center" placeholder="გვარი" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ტელეფონი</label>
                    <div class="col-sm-10">
                    <input type="text" name="number" value="{{ $data['admins']['number'] }}" id="number" class="form-control w-50 mx-auto text-center" maxlength="9" placeholder="ტელეფონი" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ელ.ფოსტა</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" value="{{ $data['admins']['email'] }}" id="email" class="form-control w-50 mx-auto text-center" placeholder="ელ.ფოსტა" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ნიკი</label>
                    <div class="col-sm-10">
                    <input type="text" name="login" value="{{ $data['admins']['login'] }}"  class="form-control w-50 mx-auto text-center" placeholder="მომხმარებლის სახელი (ნიკი)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="password1">პაროლი</label>
                    <div class="col-sm-10">
                    <input type="password" name="password"  id="password1" class="form-control w-50 mx-auto text-center" placeholder="პაროლი" >
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="password2">Confirm Password</label>
                    <div class="col-sm-10">
                    <input type="password" name="confirm_password" id="password2" class="form-control w-50 mx-auto text-center" placeholder="Confirm Password" required>
                    </div>
                </div> -->

        <div class="modal-content modal-1160 border-0 mx-auto">
            <button type="submit" class="universal-button ml-auto">ატვირთვა</button>
        </div>

    </form>
@endsection

