@extends('admin.layout')


@section('content')
<form class="container-800 flex-column" action="/enter/pdf-form/update/<?=$data['row']['id']?>" method="post" enctype="multipart/form-data">
@csrf

  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Pdf Content</label>
      <div class="col-sm-10">
        <textarea name="pdf_content" rows="15" col="50" class="form-control">{{ html_entity_decode($data['row']['pdf_content']) }}</textarea >
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <select class="form-control" name="status">
          <!-- <option>--- Select </option> -->
          <option value="1" <?=$data['row']['status']==1?'selected':''?>>Active</option>
          <option value="0" <?=$data['row']['status']==0?'selected':''?>>Deactive</option>
        </select>
      </div>
    </div> 
    <div class="modal-content modal-1160 border-0 mx-auto">
            <button type="submit" class="universal-button ml-auto">ატვირთვა</button>
    </div>
</form>
@endsection