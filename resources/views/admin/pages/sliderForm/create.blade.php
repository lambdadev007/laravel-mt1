@extends('admin.layout')


@section('content')
<form class="container-800 flex-column" action="/enter/slider-form/store" method="post" enctype="multipart/form-data">
@csrf
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">კვ.მ ლიმიტი</label>
      <div class="col-sm-10">
        <input type="text" name="square_limit" class="form-control"  >
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ფასი ლიმიტს ქვემოთt</label>
      <div class="col-sm-10">
        <input type="text" name="price_low"  class="form-control"  >
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">კოეფიციენტი ლიმიტს ზემოთ</label>
      <div class="col-sm-10">
        <input type="text" name="price_high"  class="form-control"  >
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ვისთვის?</label>
      <div class="col-sm-10">
        <select class="form-control" name="status">
          <option selected>--- არჩევა </option>
          <option value="0">ფიზიკური პირი</option>
          <option value="1">კომპანია</option>
        </select>
      </div>
    </div>  
    <div class="modal-content modal-1160 border-0 mx-auto">
            <button type="submit" class="universal-button ml-auto">ატვირთვა</button>
        </div>
</form>
@endsection