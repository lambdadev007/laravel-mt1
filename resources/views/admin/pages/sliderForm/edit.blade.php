@extends('admin.layout')


@section('content')
<form class="container-800 flex-column" action="/enter/slider-form/update/<?=$data['row']['id']?>" method="post" enctype="multipart/form-data">
@csrf

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">კვ.მ ლიმიტი</label>
      <div class="col-sm-10">
        <input type="text" name="square_limit" class="form-control"  value="<?=$data['row']['square_limit']?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ფასი ლიმიტს ქვემოთ</label>
      <div class="col-sm-10">
        <input type="text" name="price_low"  class="form-control"  value="<?=$data['row']['price_low']?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">კოეფიციენტი ლიმიტს ზემოთ</label>
      <div class="col-sm-10">
        <input type="text" name="price_high"  class="form-control"  value="<?=$data['row']['price_high']?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ვისთვის</label>
      <div class="col-sm-10">
        <select class="form-control" name="status">
          <!-- <option>--- Select </option> -->
          <option value="0" <?=$data['row']['status']==0?'selected':''?>>ფიზიკური პირი</option>
          <option value="1" <?=$data['row']['status']==1?'selected':''?>>კომპანია</option>
        </select>
      </div>
    </div> 
    <div class="modal-content modal-1160 border-0 mx-auto">
            <button type="submit" class="universal-button ml-auto">ატვირთვა</button>
    </div>
</form>
@endsection