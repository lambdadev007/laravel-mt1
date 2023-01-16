@extends('admin.layout')

@section('content')
    <form class="d-fc" action="/enter/company-hotline/update/null" method="post" enctype="multipart/form-data">
        @csrf
            <div class="container-800 d-fc">
                <button class="s-collapse active" type="button" data-target="#number">საიტის გლობალური ნომერი</button>
                <div class="s-collapse d-fc show" id="number">
                    <div class="form-section d-fc">
                        <span class="mb-4">აქ ჩაწერილი ნომერს უნდა ჰქონდეს ცარიელი ადგილები ციფრებს შორის და არ უნდა ჰქონდეს +995 დასაწყისში, <b>მაგალითად: 555 10 20 30</b></span>
                        <input class="form-control" type="text" name="visible_phone_number" placeholder="ნომერი" value="{{ ($data['exists']) ? $data['visible_phone_number'] : '' }}" required>
                    </div>
                </div>
                <button class="s-collapse active" type="button" data-target="#vip_number">ვიპ მასტერის ნომერი</button>
                <div class="s-collapse d-fc show" id="vip_number">
                    <div class="form-section d-fc">
                        <span class="mb-4">აქ ჩაწერილი ნომერს უნდა ჰქონდეს ცარიელი ადგილები ციფრებს შორის და არ უნდა ჰქონდეს +995 დასაწყისში, <b>მაგალითად: 555 10 20 30</b></span>
                        <input class="form-control" type="text" name="visible_phone_vip_number" placeholder="ნომერი" value="{{ ($data['exists']) ? $data['visible_phone_vip_number'] : '' }}" required>
                    </div>
                </div>
            </div>
        
        <button type="submit" class="universal-button align-self-end">ატვირთვა</button>
    </form>
@endsection