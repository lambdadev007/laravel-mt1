<button class="locale-collapser" type="button" data-toggle="collapse" data-target="#employee" aria-expanded="true" aria-controls="employee">
    <span>თანამშრომლების რაოდენობა</span>
    <span class="dire-right-arrow-s"></span>
</button>

<div id="employee" class="collapse show">
    <button type="button" class="split-button add-employee w-100">
        <span class="w-100">დამატება</span>
    </button>

    @foreach ($data['employees'] as $index => $employee)
        <div class="selects-item">
            <button type="button" class="remove-this-employee">X</button>
            <input type="text" name="employee_ka[]" placeholder="ქართულად" value="{{ $employee['title_ka'] }}" required>
            <input type="text" name="employee_en[]" placeholder="ინგლისურად" value="{{ $employee['title_en'] }}" required>
            <input type="hidden" name="amount_of_employees[]" value="{{ $index }}">
        </div>
    @endforeach
</div>

<button class="locale-collapser mt-5" type="button" data-toggle="collapse" data-target="#legal-entity" aria-expanded="true" aria-controls="legal-entity">
    <span>საქმიანობის სფერო</span>
    <span class="dire-right-arrow-s"></span>
</button>

<div id="legal-entity" class="collapse show">
    <button type="button" class="split-button add-legal-entity w-100">
        <span class="w-100">დამატება</span>
    </button>

    @foreach ($data['legal_entities'] as $index => $legal_entity)
        <div class="selects-item">
            <button type="button" class="remove-this-legal-entity">X</button>
            <input type="text" name="legal_entity_ka[]" placeholder="ქართულად" value="{{ $legal_entity['title_ka'] }}">
            <input type="text" name="legal_entity_en[]" placeholder="ინგლისურად" value="{{ $legal_entity['title_en'] }}">
            <input type="hidden" name="amount_of_legal_entities[]" value="{{ $index }}">
        </div>
    @endforeach
</div>