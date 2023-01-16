<div class="form-section">
    <h5>შეიქმნა: {{ $data['created_at'] }}</h5>
</div>

<div class="form-section">
    <h5>სახელი</h5>
    <input class="form-control" type="text" name="f_name" value="{{ $data['f_name'] }}" required>
</div>

<div class="form-section">
    <h5>გვარი</h5>
    <input class="form-control" type="text" name="l_name" value="{{ $data['l_name'] }}" required>
</div>

<div class="form-section">
    <h5>ტელეფონის ნომერი</h5>
    <input class="form-control" type="number" name="number" value="{{ $data['number'] }}" placeholder="" required>
</div>