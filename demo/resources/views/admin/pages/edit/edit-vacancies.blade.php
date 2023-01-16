<div class="vacancies-wrapper">
    <div class="vacancies-left-segment w-100">
        <div class="vacancies-tabs">
            <button type="button" class="add-group split-button w-100">
                <span class="w-100">ვაკანსიების ჯგუფის დამატება</span>
            </button>

            @foreach ( $data['G'] as $Gi => $G )
                {{-- Group --}}
                    <div class="group">
                        {{-- Group action buttons --}}
                            <div class="buttons-wrapper">
                                <button type="button" class="delete-button delete-group">ჯგუფის წაშლა</button>
                                <button type="button" class="add-group-item split-button w-100" data-has="{{ $G['has'] }}" data-child-type="sub_group">
                                    <span class="w-100">ჯგუფის შვილის დამატება ქვე ჯგუფებით</span>
                                </button>
                                <button type="button" class="add-group-item split-button w-100" data-has="{{ $G['has'] }}" data-child-type="checkbox_item">
                                    <span class="w-100">ჯგუფის შვილის დამატება ქვე ჯგუფების გარეშე</span>
                                </button>
                            </div>
                        {{-- Group action buttons --}}
                        
                        {{-- Group items --}}
                            <div class="group-items-wrapper">
                                @foreach ( $data['GI'] as $GIi => $GI )
                                    @if ( $GI['belongs'] == $G['has'] )
                                        <div class="group-item-wrapper {{ $GI['child_type'] }}">
                                            <button class="group-item" type="button" data-toggle="collapse" aria-expanded="true" aria-controls="group-item-{{ $GIi }}" data-target="#group-item-{{ $GIi }}">
                                                <div class="outer">
                                                    <label for="group-item-image-{{ $GIi }}" class="admin-image-wrapper">
                                                        <img class="ajax-image" src="{{ asset($GI['image']) }}">
                                                        <span class="hover-edit-notifier">
                                                            <span class="dire-edit"></span>
                                                        </span>
                                                        <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="GI_image[]" id="group-item-image-{{ $GIi }}">
                                                        <input type="hidden" name="existing_GI_image[]" value="{{ $GI['image'] }}">
                                                    </label>
                                                </div>
                                                <div class="inner">
                                                    <div class="d-flex flex-column w-100">
                                                        <input type="text" name="group_item_title_ka[]" value="{{ $GI['title_ka'] }}" placeholder="სათაური" required>
                                                        <input type="text" name="group_item_title_en[]" value="{{ $GI['title_en'] }}" placeholder="Title" required>
                                                    </div>
                                                    <div><span class="dire-right-arrow"></span></div>
                                                </div>
                                            </button>

                                            <div class="collapse group-item show" id="group-item-{{ $GIi }}">
                                                <div class="buttons-wrapper">
                                                    <button type="button" class="delete-button delete-group-item">ჯგუფის შვილის წაშლა</button>
                                                    @if ( $GI['child_type'] == 'sub_group' )
                                                        <button type="button" class="add-sub-group split-button w-100" data-has="{{ $GI['has'] }}">
                                                            <span class="w-100">ქვე ჯგუფის დამატება</span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="add-checkbox-item split-button w-100" data-has="{{ $GI['has'] }}">
                                                            <span class="w-100">ჩეკბოქსის დამატება</span>
                                                        </button>
                                                    @endif
                                                </div>

                                                @if ( $GI['child_type'] == 'sub_group' )
                                                    <div class="sub-groups-wrapper">
                                                        @foreach ( $data['SG'] as $SGi => $SG )
                                                            @if ( $SG['belongs'] == $GI['has'] )
                                                                {{-- Sub groups --}}
                                                                    <div class="sub-group">
                                                                        <button class="sub-group-item" type="button" data-toggle="collapse" aria-expanded="true" aria-controls="sub-group-item-{{ $SGi }}" data-target="#sub-group-item-{{ $SGi }}">
                                                                            <div class="outer">
                                                                                <label for="sub-group-image-{{ $SGi }}" class="admin-image-wrapper">
                                                                                    <img class="ajax-image" src="{{ asset($SG['image']) }}">
                                                                                    <span class="hover-edit-notifier">
                                                                                        <span class="dire-edit"></span>
                                                                                    </span>
                                                                                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="SG_image[]" id="sub-group-image-{{ $SGi }}">
                                                                                    <input type="hidden" name="existing_SG_image[]" value="{{ $SG['image'] }}">
                                                                                </label>
                                                                            </div>
                                                                            <div class="inner">
                                                                                <div class="d-flex flex-column w-100">
                                                                                    <input type="text" name="sub_group_title_ka[]" value="{{ $SG['title_ka'] }}" placeholder="სათაური" required>
                                                                                    <input type="text" name="sub_group_title_en[]" value="{{ $SG['title_en'] }}" placeholder="Title" required>
                                                                                </div>
                                                                                <div><span class="dire-right-arrow"></span></div>
                                                                            </div>
                                                                        </button>

                                                                        <div class="collapse sub-group-item show" id="sub-group-item-{{ $SGi }}">
                                                                            <div class="buttons-wrapper">
                                                                                <button type="button" class="delete-button delete-sub-group">ქვე ჯგუფის წაშლა</button>
                                                                                <button type="button" class="add-checkbox-item split-button w-100" data-has="{{ $SG['has'] }}">
                                                                                    <span class="w-100">ჩექბოქსის დამატება</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="checkbox-items-wrapper">
                                                                                @foreach ( $data['SGI'] as $SGIi => $SGI )
                                                                                    @if ( $SGI['belongs'] == $SG['has'] )
                                                                                        {{-- Sub group items--}}
                                                                                            <div class="checkbox-item">
                                                                                                <div class="d-flex flex-column w-100">
                                                                                                    <input type="text" name="sub_group_item_title_ka[]" value="{{ $SGI['title_ka'] }}" placeholder="სათაური" required>
                                                                                                    <input type="text" name="sub_group_item_title_en[]" value="{{ $SGI['title_en'] }}" placeholder="Title" required>
                                                                                                </div>
                                                                                                <button type="button" class="remove-this-checkbox-item">X</button>
                                                                                                <input type="hidden" name="amount_of_sub_group_items[]" value="{{ $SGIi }}">
                                                                                                <input type="hidden" name="sub_group_item_belongs[]" value="{{ $SGI['belongs'] }}">
                                                                                            </div>
                                                                                        {{-- Sub group items--}}
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>

                                                                        <input type="hidden" name="amount_of_sub_groups[]" value="{{ $SGi }}">
                                                                        <input type="hidden" name="sub_group_belongs[]" value="{{ $SG['belongs'] }}">
                                                                        <input type="hidden" name="sub_group_has[]" value="{{ $SG['has'] }}">
                                                                    </div>
                                                                {{-- Sub groups --}}
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div class="checkbox-items-wrapper">
                                                        @foreach ( $data['SGI'] as $SGIi => $SGI )
                                                            @if ( $SGI['belongs'] == $GI['has'] )
                                                                {{-- Sub group items--}}
                                                                    <div class="checkbox-item">
                                                                        <div class="d-flex flex-column w-100">
                                                                            <input type="text" name="sub_group_item_title_ka[]" value="{{ $SGI['title_ka'] }}" placeholder="სათაური" required>
                                                                            <input type="text" name="sub_group_item_title_en[]" value="{{ $SGI['title_en'] }}" placeholder="Title" required>
                                                                        </div>
                                                                        <button type="button" class="remove-this-checkbox-item">X</button>
                                                                        <input type="hidden" name="amount_of_sub_group_items[]" value="{{ $SGIi }}">
                                                                        <input type="hidden" name="sub_group_item_belongs[]" value="{{ $SGI['belongs'] }}">
                                                                    </div>
                                                                {{-- Sub group items--}}
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <input type="hidden" name="amount_of_group_items[]" value="{{ $GIi }}">
                                            <input type="hidden" name="group_item_belongs[]" value="{{ $GI['belongs'] }}">
                                            <input type="hidden" name="group_item_has[]" value="{{ $GI['has'] }}">
                                            <input type="hidden" name="group_item_child_type[]" value="{{ $GI['child_type'] }}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        {{-- Group items --}}

                        <input type="hidden" name="amount_of_groups[]" value="{{ $Gi }}">
                        <input type="hidden" name="group_has[]" value="{{ $G['has'] }}">
                    </div>
                {{-- Group --}}
            @endforeach
        </div>
    </div>
</div>