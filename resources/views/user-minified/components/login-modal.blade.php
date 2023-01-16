<div class="modal fade modal-background" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal-label" aria-hidden="true">
<div class="modal-dialog modal-custom modal-820 modal-login-register modal-dialog-centered" role="document">
<div class="modal-content flex-row">
<div class="left">
<img src="{{ asset('images/homepage/modal-left.png') }}">
<span class="top">გაიარეთ <b>ავტორიზაცია</b> და მიიღეთ დამატებითი ბენეფიტები.</span>
<div class="bottom d-fc">
<span>არ გაქვთ ანგარიში?</span>
<button type="button" data-toggle="modal" data-target="#register-modal" data-dismiss="modal">რეგისტრაცია</button>
</div>
</div>
<div class="right d-fc w-100">
<div class="top-misc">
<h3>ავტორიზაცია</h3>
<span class="close-modal" data-dismiss="modal">&times</span>
</div>
<div class="form d-fc">
<form action="/user/login" method="post">
@csrf
<input type="text" name="email" value="{{ old('email') }}" placeholder="ელ. ფოსტა">
<div class="password">
<input type="password" name="password" placeholder="პაროლი">
{{-- <a href="#">აღდგენა</a> --}}
</div>
<button type="submit">შესვლა</button>
</form>
</div>
{{-- <div class="or-divider">
<div class="left"></div>
<span class="text">ან</span>
<div class="right"></div>
</div>
<div class="other-authorization">
<fb:login-button 
scope="public_profile,email"
onlogin="checkLoginState();">
</fb:login-button>
<button class="facebook" type="button">
<img src="{{ asset('images/homepage/facebook-white.svg') }}">
<span>Facebook</span>
</button>
<button class="google" type="button">
<img src="{{ asset('images/homepage/google-logo.svg') }}">
<span>Google</span>
</button>
</div> --}}
</div>
</div>
</div>
</div>

<div class="modal fade modal-background" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal-label" aria-hidden="true">
<div class="modal-dialog modal-custom modal-820 modal-login-register modal-dialog-centered" role="document">
<div class="modal-content register flex-row">
<div class="left">
<img src="{{ asset('images/homepage/modal-left.png') }}">
<span class="top">გაიარეთ <b>რეგისტრაცია</b> და მიიღეთ დამატებითი ბენეფიტები.</span>
<div class="bottom d-fc">
<span>გაქვთ უკვე ანგარიში?</span>
<button type="button" data-toggle="modal" data-target="#login-modal" data-dismiss="modal">ავტორიზაცია</button>
</div>
</div>
<div class="right d-fc w-100">
<div class="top-misc">
<h3>რეგისტრაცია</h3>
<span class="close-modal" data-dismiss="modal">&times</span>
</div>
<form class="form d-fc" action="/user/register" method="post">
@csrf
<input type="text" name="username" value="{{ old('username') }}" placeholder="სახელი" required>
<input type="email" name="email" value="{{ old('email') }}" placeholder="ელ. ფოსტა" required>
<input type="password" name="password" placeholder="პაროლი">
<input type="password" name="password_repeat" placeholder="გაიმეორეთ პაროლი">
{{-- <input type="text" placeholder="კოდი" value="აქ მე გუგლის რე-კაპჩას გავაკეთებ"> --}}
<button type="submit" class="w-100 mb-3">
<span class="mr-3">რეგისტრაცია</span>
<img src="{{ asset('images/xd-icons/white/arrow-right.svg') }}">
</button>
</form>
<div class="site-terms d-fc">
<span>რეგისტრაცია ღილაკზე დაჭერით ვეთანხმები</span>
<a href="#">საიტის წესებს</a>
</div>
{{-- <div class="or-divider">
<div class="left"></div>
<span class="text">ან</span>
<div class="right"></div>
</div>
<div class="other-authorization">
<button class="facebook" type="button">
<img src="{{ asset('images/homepage/facebook-white.svg') }}">
<span>Facebook</span>
</button>
<button class="google" type="button">
<img src="{{ asset('images/homepage/google-logo.svg') }}">
<span>Google</span>
</button>
</div> --}}
</div>
</div>
</div>
</div>