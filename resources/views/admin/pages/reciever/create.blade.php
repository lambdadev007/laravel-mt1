@extends('admin.layout')


@section('content')
<form class="container-800 flex-column" action="/enter/reciever-form/store" method="post" enctype="multipart/form-data">
@csrf
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">სახელი და გვარი</label>
      <div class="col-sm-10">
        <input type="text" name="name" class="form-control"  >
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ელ.ფოსტა</label>
      <div class="col-sm-10">
        <input type="email" name="email"  class="form-control"  >
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">ტელეფონი</label>
      <div class="col-sm-10">
        <input type="text" name="phone"  class="form-control"  >
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">გაუგზავნე მეილი</label>
      <div class="col-sm-10">
        <select class="form-control" name="send_email">
          <!-- <option>--- Select </option> -->
          <option value="yes">დიახ</option>
          <option value="no">არა</option>
        </select>
      </div>
    </div> 
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">გაუგზავნე სმს</label>
      <div class="col-sm-10">
        <select class="form-control" name="send_sms">
          <!-- <option>--- Select </option> -->
          <option value="yes">დიახ</option>
          <option value="no">არა</option>
        </select>
      </div>
    </div> 
    <!-- <div class="form-group row d-none">
      <label class="col-sm-2 col-form-label">Setting For</label>
      <div class="col-sm-10">
        <select class="form-control" name="status">
          <option value="1">Company</option>
        </select>
      </div>
    </div>   -->
    <div class="modal-content modal-1160 border-0 mx-auto">
            <button type="submit" class="universal-button ml-auto">ატვირთვა</button>

        </div>
</form>
@endsection