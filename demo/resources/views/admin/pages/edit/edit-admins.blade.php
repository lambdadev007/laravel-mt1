@php
    use App\Http\Controllers\HelpersCT;
@endphp

@if ( $type == 'management' )
    <div class="form-section">
        <input class="form-control" type="text" name="name" placeholder="სახელი და გვარი" required value="{{ $data['name'] }}">
    </div>

    <div class="form-section">
        <input class="form-control" type="text" name="login" placeholder="ლოგინი" required value="{{ $data['login'] }}">
    </div>

    <div class="form-section d-flex">
        <input class="form-control" id="generate-here" type="text" name="password" placeholder="პაროლი (აქ არაფერი არ ჩაწერო თუ არ გინდა პაროლის შეცვლა)">
        <button type="button" class="string-generator px-2 py-1">დაგენერირება</button>
    </div>

    <div class="form-section">
        <input class="form-control" type="number" name="number" placeholder="ნომერი (არ არის აუცილებელი) " value="{{ $data['number'] }}">
    </div>

    <div class="form-section">
        <input class="form-control" type="email" name="email" placeholder="მეილი (არ არის აუცილებელი)" value="{{ $data['email'] }}">
    </div>

    <div class="form-section">
        <h5>კატეგორია/პრივილეგიები</h5>
        <div class="metrix-selector-wrapper w-100">
            <select name="category" class="w-100" required>
                <option {{ $data['category'] == 'admin' ? 'selected' : '' }} value="admin">ადმინისტრატორი</option>
                <option {{ $data['category'] == 'manager_design' ? 'selected' : '' }} value="manager_design">მენეჯერი - დიზაინი</option>
                <option {{ $data['category'] == 'manager_repairs' ? 'selected' : '' }} value="manager_repairs">მენეჯერი - რემონტი</option>
                <option {{ $data['category'] == 'manager_furniture' ? 'selected' : '' }} value="manager_furniture">მენეჯერი - ავეჯი</option>
                <option {{ $data['category'] == 'manager_cleaning' ? 'selected' : '' }} value="manager_cleaning">მენეჯერი - დასუფთავება</option>
                <option {{ $data['category'] == 'articles' ? 'selected' : '' }} value="articles">სტატიების მწერალი</option>
            </select>
        </div>
    </div>
@elseif ( $type == 'legal_entity' )
    <div class="form-section">
        <input class="form-control" type="text" name="name" placeholder="სახელი" required value="{{ $data['name'] }}">
    </div>

    <div class="form-section">
        <input class="form-control" type="text" name="identification_code" placeholder="საიდენტიფიკაციო კოდი" required value="{{ $data['identification_code'] }}">
    </div>

    <div class="form-section">
        <input class="form-control" type="text" name="login" placeholder="ლოგინი" required value="{{ $data['login'] }}">
    </div>

    <div class="form-section d-flex">
        <input class="form-control" id="generate-here" type="text" name="password" placeholder="პაროლი (აქ არაფერი არ ჩაწერო თუ არ გინდა პაროლის შეცვლა)">
        <button type="button" class="string-generator px-2 py-1">დაგენერირება</button>
    </div>

    <div class="form-section">
        <input class="form-control" type="number" name="number" placeholder="ნომერი " required value="{{ $data['number'] }}">
    </div>

    <div class="form-section">
        <input class="form-control" type="email" name="email" placeholder="მეილი (არ არის აუცილებელი)" value="{{ $data['email'] }}">
    </div>

    <div class="form-section">
        <h5>კატეგორია</h5>
        <select name="category" required>
            <option {{ $data['category'] == 'design' ? 'selected' : '' }} value="design">დიზაინი</option>
            <option {{ $data['category'] == 'repairs' ? 'selected' : '' }} value="repairs">რემონტი</option>
            <option {{ $data['category'] == 'furniture' ? 'selected' : '' }} value="furniture">ავეჯი</option>
            <option {{ $data['category'] == 'cleaning' ? 'selected' : '' }} value="cleaning">დასუფთავება</option>
        </select>
    </div>
@elseif ( $type == 'employee' )
    <div class="form-section">
        <input class="form-control" type="text" name="name" placeholder="სახელი" required value="{{ $data['name'] }}">
    </div>

    <div class="form-section">
        <input class="form-control" type="text" name="login" placeholder="ლოგინი" required value="{{ $data['login'] }}">
    </div>

    <div class="form-section d-flex">
        <input class="form-control" id="generate-here" type="text" name="password" placeholder="პაროლი" required>
        <button type="button" class="string-generator px-2 py-1">დაგენერირება</button>
    </div>

    <div class="form-section">
        <input class="form-control" type="number" name="number" placeholder="ნომერი " required value="{{ $data['number'] }}">
    </div>

    @if ( HelpersCT::is_admin() )
        <div class="form-section">
            <h5>კატეგორია</h5>
            <select name="category" required>
                <option {{ $data['category'] == 'design' ? 'selected' : '' }} value="design">დიზაინი</option>
                <option {{ $data['category'] == 'repairs' ? 'selected' : '' }} value="repairs">რემონტი</option>
                <option {{ $data['category'] == 'furniture' ? 'selected' : '' }} value="furniture">ავეჯი</option>
                <option {{ $data['category'] == 'cleaning' ? 'selected' : '' }} value="cleaning">დასუფთავება</option>
            </select>
        </div>
    @else 
        @php
            $c_key = Crypt::encrypt('type');
        @endphp

        <input type="hidden" name="c_key" value="{{ $c_key }}">
        <input type="hidden" name="{{ $c_key }}" value="{{ Crypt::encrypt($data['category']) }}">
    @endif
@endif

@php
    $t_key = Crypt::encrypt('type');
@endphp

<input type="hidden" name="t_key" value="{{ $t_key }}">
<input type="hidden" name="{{ $t_key }}" value="{{ Crypt::encrypt($type) }}">