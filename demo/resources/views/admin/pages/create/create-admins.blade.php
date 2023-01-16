@if ( $type == 'management' )
    <div class="form-section">
        <input class="form-control" type="text" name="name" placeholder="სახელი და გვარი" required>
    </div>

    <div class="form-section">
        <input class="form-control" type="text" name="login" placeholder="ლოგინი" required>
    </div>

    <div class="form-section d-flex">
        <input class="form-control" id="generate-here" type="text" name="password" placeholder="პაროლი" required>
        <button type="button" class="string-generator px-2 py-1">დაგენერირება</button>
    </div>

    <div class="form-section">
        <input class="form-control" type="number" name="number" placeholder="ნომერი (არ არის აუცილებელი) ">
    </div>

    <div class="form-section">
        <input class="form-control" type="email" name="email" placeholder="მეილი (არ არის აუცილებელი)">
    </div>

    <div class="form-section">
        <h5>კატეგორია/პრივილეგიები</h5>
        <div class="metrix-selector-wrapper mb-3">
            <select name="category" class="w-100" required>
                <option value="admin">ადმინისტრატორი</option>
                <option value="manager_design">მენეჯერი - დიზაინი</option>
                <option value="manager_repairs">მენეჯერი - რემონტი</option>
                <option value="manager_furniture">მენეჯერი - ავეჯი</option>
                <option value="manager_cleaning">მენეჯერი - დასუფთავება</option>
                <option value="articles">სტატიების მწერალი</option>
            </select>
        </div>
    </div>
@elseif ( $type == 'legal_entity' )
    <div class="form-section">
        <input class="form-control" type="text" name="name" placeholder="სახელი" required>
    </div>

    <div class="form-section">
        <input class="form-control" type="text" name="identification_code" placeholder="საიდენტიფიკაციო კოდი" required>
    </div>

    <div class="form-section">
        <h5>საქმიანობის სფერო</h5>
        <select name="field_of_activity" id="" required>
            @foreach ( $selects as $select )
                <option value="{{ $select['id'] }}">{{ $select['title_'. Session::get('locale')] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-section">
        <input class="form-control" type="text" name="login" placeholder="ლოგინი" required>
    </div>

    <div class="form-section d-flex">
        <input class="form-control" id="generate-here" type="text" name="password" placeholder="პაროლი" required>
        <button type="button" class="string-generator px-2 py-1">დაგენერირება</button>
    </div>

    <div class="form-section">
        <input class="form-control" type="text" name="number" placeholder="ნომერი " required>
    </div>

    <div class="form-section">
        <input class="form-control" type="email" name="email" placeholder="მეილი (არ არის აუცილებელი)">
    </div>

    <div class="form-section">
        <h5>კატეგორია/პრივილეგიები</h5>
        <select name="category" required>
            <option value="design">დიზაინი</option>
            <option value="repairs">რემონტი</option>
            <option value="furniture">ავეჯი</option>
            <option value="cleaning">დასუფთავება</option>
        </select>
    </div>
@endif

@php
    $key = Crypt::encrypt('type');
@endphp

<input type="hidden" name="key" value="{{ $key }}">
<input type="hidden" name="{{ $key }}" value="{{ Crypt::encrypt($type) }}">