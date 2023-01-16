@extends('admin.layout')


@section('content')
<form class="container-800 flex-column" action="/enter/reciever-form/update/<?=$data['row']['id']?>" method="post" enctype="multipart/form-data">
@csrf

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">ელ.ფოსტა</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control"  value="<?=$data['row']['name']?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ელ.ფოსტა</label>
      <div class="col-sm-10">
        <input type="email" name="email"  class="form-control"  value="<?=$data['row']['email']?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ტელეფონი</label>
      <div class="col-sm-10">
        <input type="text" name="phone"  class="form-control"  value="<?=$data['row']['phone']?>" />
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">გაუგზავნე მეილი</label>
      <div class="col-sm-10">
        <select class="form-control" name="send_email">
          <!-- <option>--- Select </option> -->
          <option value="yes" <?=$data['row']['send_email']=='yes'?'selected':''?>>დიახ</option>
          <option value="no" <?=$data['row']['send_email']=='no'?'selected':''?>>არა</option>
        </select>
      </div>
    </div> 
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">გაუგზავნე სმს</label>
      <div class="col-sm-10">
        <select class="form-control" name="send_sms">
          <!-- <option>--- Select </option> -->
          <option value="yes" <?=$data['row']['send_sms']=='yes'?'selected':''?>>დიახ</option>
          <option value="no" <?=$data['row']['send_sms']=='no'?'selected':''?>>არა</option>
        </select>
      </div>
    </div> 
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">სტატუსი</label>
      <div class="col-sm-10">
        <select class="form-control" name="status">
          <!-- <option>--- Select </option> -->
          <option value="1" <?=$data['row']['status']==1?'selected':''?>>აქტიური</option>
          <option value="0" <?=$data['row']['status']==0?'selected':''?>>პასიური</option>
        </select>
      </div>
    </div> 
    <div class="modal-content modal-1160 border-0 mx-auto">
            <button type="submit" class="universal-button ml-auto">ატვირთვა</button>
    </div>
</form>
@endsection