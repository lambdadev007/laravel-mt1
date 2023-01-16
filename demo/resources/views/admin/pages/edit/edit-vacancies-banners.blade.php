<div class="vacancies-wrapper">
    <div class="vacancies-left-segment">
        <div class="vacancies-top-categories">
            <button type="button" data-type="employee">წესები თანამშრომლებისთვის</button>
            <button type="button" data-type="legal-entity">იურიდიული პირის რეგისტრაცია</button>
        </div>

        <div class="instructional-banner show opacity employee">
            <label for="employee" class="admin-image-wrapper">
                @if ( $data['employees_banner'] != [] )
                    @foreach ( $data['employees_banner'] as $employees_banner )
                        <img class="employee ajax-image" src="{{ asset($employees_banner['image']) }}">
                    @endforeach
                @else
                    <img class="employee ajax-image" src="{{ asset('images/temp/no-image.jpg') }}">
                @endif
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="employee" id="employee">
            </label>

            <label for="legal-entity" class="admin-image-wrapper">
                @if ( $data['legal_entities_banner'] != [] )
                    @foreach ( $data['legal_entities_banner'] as $legal_entities_banner )
                        <img class="legal-entity ajax-image" src="{{ asset($legal_entities_banner['image']) }}">
                    @endforeach
                @else
                    <img class="legal-entity ajax-image" src="{{ asset('images/temp/no-image.jpg') }}">
                @endif
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="legal_entity" id="legal-entity">
            </label>
        </div>
    </div>
</div>