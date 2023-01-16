@extends('admin.layout')

@section('content')
    <div class="page-title-wrapper">
        <div class="page-title-line"></div>
        <h3 class="page-title cut-text-lg">პაროლის შეცვლა</h3>
        <div class="page-title-line"></div>
    </div>

    <form class="create-form" action="/admin/personal-edit" method="post">
        @csrf
        <div class="form-section">
            <input class="form-control" type="password" name="current_password" autocomplete="current-password" placeholder="ძველი პაროლი" required>
        </div>

        <div class="form-section mt-1">
            <input class="form-control check-against-each-other" type="password" name="new_password" autocomplete="new-password" placeholder="ახალი პაროლი" required>
        </div>

        <div class="form-section mt-1">
            <input class="form-control check-against-each-other" type="password" name="repeat_password" autocomplete="new-password" placeholder="პაროლის გამეორება" required>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="split-button">
                <span>განახლება</span>
                <span class="dire-right-arrow"></span>
            </button>
        </div>
    </form>
@endsection

@section('bottom_js')
    <script type="text/javascript">
        $(document).ready(function() {
            let selector_I = '.check-against-each-other[name="repeat_password"]';
            let selector_II = '.check-against-each-other[name="new_password"]';
            
            $(selector_I).keyup(function() {
                if ( $(selector_I).val() !== $(selector_II).val() ) {
                    $(selector_I).addClass('border-danger')
                    $('.split-button').addClass('disabled')
                    $('.split-button').attr('disabled', true)
                } else {
                    $(selector_I).removeClass('border-danger')
                    $('.split-button').removeClass('disabled')
                    $('.split-button').attr('disabled', false)
                }
            })
        })
    </script>
@endsection