@extends('admin.layout')


@section('content')
<form class="container-800 flex-column" action="/enter/pdf-form/store" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Pdf Content</label>
        <div class="col-sm-10">
          <textarea name="pdf_content" rows="10" col="50" class="form-control"></textarea >
        </div>
    </div>
    <div class="modal-content modal-1160 border-0 mx-auto">
            <button type="submit" class="universal-button ml-auto">ატვირთვა</button>

        </div>
</form>
@endsection