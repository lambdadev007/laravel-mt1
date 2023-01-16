@extends('admin.layout')

@section('content')
    <form class="container-1280 d-fc" action="/enter/administration/store" method="post" enctype="multipart/form-data">
        @csrf
        {{-- Meta --}}
            <div class="container-800 d-fc">
                <button class="s-collapse active" type="button" data-target="#meta">მეტა ინფორმაცია</button>
                <div class="s-collapse d-fc show" id="meta">
                    <div class="form-section d-fc">
                        <h5>სახელი</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="name" placeholder="სახელი" value="{{ $data['admin']['name'] }}" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">ლოგინი</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="login" placeholder="ლოგინი" value="{{ $data['admin']['login'] }}" maxlength="60" required>
                    </div>
                    <div class="form-section d-fc">
                        <h5 class="mt-3">პაროლი</h5>
                        <span class="letter-counter">0/60</span>
                        <input class="form-control" type="text" name="password" placeholder="თუ არ გინდა შეცვლა არაფერი აქ არ დაწერო" value="" maxlength="60">
                    </div>
                    <input type="hidden" name="category" value="blogger">
                </div>
            </div>
        {{-- Meta --}}

        <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
    </form>
@endsection