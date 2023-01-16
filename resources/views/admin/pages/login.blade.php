@extends('admin.layout')

@section('content')
    <div class="form-logo">
        <img src="{{ asset('images/logos/Logo-Eng.svg') }}" alt="ლოგო">
    </div>
<?php
// if(isset($verifyOtp)){
//     print_r($admin);

// }
?>
    <div class="admin-login-form container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="form-card card card-body d-fc">
                    <form action="/enter/login" method="post">
                        @csrf
                        {{-- Alerts --}}
                            @if (Session::has('logout_successful'))
                                <div class="alert alert-success">გამოსვლა მოხდა წარმატებულად</div>
                            @endif
                            @if (Session::has('login_error'))
                                <div class="alert alert-danger">ლოგინი ან პაროლი არასწორია</div>
                            @endif
                            @if (Session::has('user_deleted'))
                                <div class="alert alert-danger">მომხმარებელი დაბლოკილია</div>
                            @endif
                            @if (isset($otp_error))
                                
                                <div class="alert alert-danger">არასწორი OTP კოდი</div>
                            @endif
                        {{-- Alerts --}}
                        @if(isset($verifyOtp))
                            <!-- <div class="form-group">
                                <input type="text" name="login" value="{{ old('login') }}" class="form-control form-control-lg" placeholder="ლოგინი">
                            </div> -->
                            <div class="form-group">
                                <label for="">შეიყვანეთ ვერიფიკაციის კოდი </label>
                                <input type="text" name="otp" class="form-control form-control-lg" placeholder="">
                                <!-- <input type="hidden" name="admin" value="<?php //print_r($admin)?>"> -->
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <!-- <a href="/" class="universal-button">საიტზე დაბრუნება</a> -->
                                <button type="submit" class="universal-button"><span>დადასტურება</span></button>
                            </div>          

                        
                        @else
                       

                        <div class="form-group">
                            <input type="text" name="login" value="{{ old('login') }}" class="form-control form-control-lg" placeholder="ლოგინი">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="პაროლი">
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/" class="universal-button">საიტზე დაბრუნება</a>
                            <button type="submit" class="universal-button"><span>შესვლა</span></button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection