<div id="modals-wrapper">
    @if ( $data['exists'] && $data['content'] != [] )
        @foreach ( $data['content']['modals'] as $m_index => $modal )
            <div class="modal fade modal-background" id="card-modal-{{ $m_index }}" tabindex="-1" role="dialog" aria-labelledby="card-modal-{{ $m_index }}-label" aria-hidden="true">
                <div class="modal-dialog modal-custom modal-service modal-1160 modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="top-misc">
                            <h3 class="modal-title">პაკეტის შესახებ</h3>
                            <span class="close-modal" data-dismiss="modal">&times</span>
                        </div>

                        <div class="universal-banner-wrapper">
                            <label class="image-reader-wrapper d-fc" for="modal-{{ $m_index }}">
                                <div class="image-wrapper">
                                    <img class="image-loader" src="{{ asset($modal['banner_location']) }}">
                                    <div class="background-layer"></div>
                                    <input type="file" accept="image/png, image/jpeg, image/webp" class="image-input d-none" name="modal_banners[]" id="modal-{{ $m_index }}">
                                    <input type="hidden" name="existing_modal_banners[]" value="{{ $modal['banner_location'] }}" required>
                                </div>
                                <input type="text" class="form-control text-center" name="modal_banner_alts[]" placeholder="სურათის alt ინფორმაცია" value="{{ $modal['banner_alt'] }}" required>
                            </label>
                            <div class="text-wrapper">
                                <h2 contenteditable="true" data-text-to-value="#modal-title-{{ $m_index }}">{{ $modal['title'] }}</h2>
                                <p contenteditable="true" data-text-to-value="#modal-description-{{ $m_index }}">{{ $modal['description'] }}</p>
                            </div>
                        </div>

                        <p class="information container-1000" contenteditable="true" data-html-to-value="#modal-information-{{ $m_index }}">{!! $modal['information'] !!}</p>

                        <div class="lists d-fc container-1000">
                            <button type="button" class="universal-button add-modal-list w-100 mb-3" data-has-stages="false" data-modal-id="{{ $modal['has'] }}">ჩამონათვალის დამატება</button>
                            <button type="button" class="universal-button add-modal-list w-100 mb-3" data-has-stages="true" data-modal-id="{{ $modal['has'] }}">ჩამონათვალის დამატება ეტაპებით</button>
                            @if ( array_key_exists('modal_lists', $data['content']) )
                                @foreach ( $data['content']['modal_lists'] as $list )
                                    @if ( $list['belongs'] == $modal['has'] )
                                        @if ( $list['has_stages'] == 'true' )
                                            <div class="list-wrapper d-fc w-100">
                                                <span class="remove-this-item">&times</span>
                                                <div class="title">
                                                    <h3 contenteditable="true" data-text-to-value="#list-titles-{{ $list['has'] }}">{{ $list['title'] }}</h3>
                                                </div>
                                                <div class="list-stages d-fc mb-3">
                                                    <button type="button" class="universal-button add-modal-stage w-100 mb-3" data-list-id="{{ $list['has'] }}">ეტაპის დამატება</button>
                                                    @if ( array_key_exists('modal_stages', $data['content']) )
                                                        @foreach ( $data['content']['modal_stages'] as $stage_index => $stage )        
                                                            @if ( $list['has'] == $stage['belongs'] )
                                                                @php
                                                                    if ( $stage['first'] == 'true' ) {
                                                                        $carry_stage_id = $stage['has'];
                                                                    } else {
                                                                        $carry_stage_id = null;
                                                                    }
                                                                @endphp
                                                                <div class="stage-wrapper d-flex mb-3 {{ $stage['has'] }}">
                                                                    <input type="text" class="pl-1 mr-3" name="stage_names[]" value="{{ $stage['name'] }}" placeholder="ეტაპის სახელი" required>
                                                                    <button type="button" class="admin-service-stage-toggle mr-3" data-target="{{ $stage['has'] }}" data-stage-first="{{ $stage['first'] }}">ეტაპზე გადასვლა</button>
                                                                    @if ( $stage['first'] == 'false' )
                                                                        <button type="button" class="remove-this-stage mr-3" data-target=".{{ $stage['has'] }}">ეტაპის წაშლა</button>
                                                                    @endif
                                                                    <div class="stage-color {{ ($stage['first'] == 'true') ? '' : 'inactive' }}"></div>
                                                                    <input type="hidden" name="amount_of_stages[]" value="null" required>
                                                                    <input type="hidden" name="stage_has[]" value="{{ $stage['has'] }}" required>
                                                                    <input type="hidden" name="stage_belongs[]" value="{{ $stage['belongs'] }}" required>
                                                                    <input type="hidden" name="stage_first[]" value="{{ $stage['first'] }}" required>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="list d-fc">
                                                    <div class="d-flex mb-3">
                                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="{{ $list['has'] }}" data-type="double" data-stage="true" data-stage-id="{{ $carry_stage_id }}" data-stage-first="true">ტექსტი</button>
                                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="{{ $list['has'] }}" data-type="red" data-stage="true" data-stage-id="{{ $carry_stage_id }}" data-stage-first="true"><i class="red" id="times"></i></button>
                                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="{{ $list['has'] }}" data-type="green" data-stage="true" data-stage-id="{{ $carry_stage_id }}" data-stage-first="true"><span><i class="green" id="checkmark"></i></span></button>
                                                    </div>
                                                    @if ( array_key_exists('modal_list_items', $data['content']) )
                                                        @foreach ( $data['content']['modal_list_items'] as $li_index => $list_item)
                                                            @if ( $list_item['belongs'] == $list['has'] )
                                                                @if ( $list_item['type'] == 'double' )
                                                                    <div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
                                                                        <span class="remove-this-item">&times</span>
                                                                        <p contenteditable="true" data-html-to-value="#list-item-left-text-{{ $li_index }}">{!! $list_item['left_text'] !!}</p>
                                                                        <span contenteditable="true" data-html-to-value="#list-item-right-text-{{ $li_index }}">{!! $list_item['right_text'] !!}</span>
                                                                        <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                                                        <input type="hidden" name="list_item_belongs[]" value="{{ $list_item['belongs'] }}" required>
                                                                        <input type="hidden" name="list_item_type[]" value="double" required>
                                                                        <input type="hidden" id="list-item-left-text-{{ $li_index }}" name="list_item_left_text[]" value="{{ $list_item['left_text'] }}" required>
                                                                        <input type="hidden" id="list-item-right-text-{{ $li_index }}" name="list_item_right_text[]" value="{{ $list_item['right_text'] }}" required>
                                                                        <input type="hidden" name="list_item_stage_first[]" value="{{ $list_item['stage_first'] }}" required>
                                                                        <input type="hidden" name="list_item_is_staged[]" value="{{ $list_item['is_staged'] }}" required>
                                                                        <input type="hidden" name="list_item_stage[]" value="{{ $list_item['stage'] }}" required>
                                                                    </div>
                                                                @elseif ( $list_item['type'] == 'red' )
                                                                    <div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
                                                                        <span class="remove-this-item">&times</span>
                                                                        <p contenteditable="true" data-html-to-value="#list-item-left-text-{{ $li_index }}">{!! $list_item['left_text'] !!}</p>
                                                                        <span><i class="red" id="times"></i></span>
                                                                        <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                                                        <input type="hidden" name="list_item_belongs[]" value="{{ $list_item['belongs'] }}" required>
                                                                        <input type="hidden" name="list_item_type[]" value="red" required>
                                                                        <input type="hidden" id="list-item-left-text-{{ $li_index }}" name="list_item_left_text[]" value="{{ $list_item['left_text'] }}" required>
                                                                        <input type="hidden" name="list_item_stage_first[]" value="{{ $list_item['stage_first'] }}" required>
                                                                        <input type="hidden" name="list_item_is_staged[]" value="{{ $list_item['is_staged'] }}" required>
                                                                        <input type="hidden" name="list_item_stage[]" value="{{ $list_item['stage'] }}" required>
                                                                    </div>
                                                                @elseif ( $list_item['type'] == 'green' )
                                                                    <div class="item {{ $list_item['stage'] }} {{ ($list_item['stage_first'] == 'true') ? '' : 'd-none' }}">
                                                                        <span class="remove-this-item">&times</span>
                                                                        <p contenteditable="true" data-html-to-value="#list-item-left-text-{{ $li_index }}">{!! $list_item['left_text'] !!}</p>
                                                                        <span><i class="green" id="checkmark"></i></span>
                                                                        <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                                                        <input type="hidden" name="list_item_belongs[]" value="{{ $list_item['belongs'] }}" required>
                                                                        <input type="hidden" name="list_item_type[]" value="green" required>
                                                                        <input type="hidden" id="list-item-left-text-{{ $li_index }}" name="list_item_left_text[]" value="{{ $list_item['left_text'] }}" required>
                                                                        <input type="hidden" name="list_item_stage_first[]" value="{{ $list_item['stage_first'] }}" required>
                                                                        <input type="hidden" name="list_item_is_staged[]" value="{{ $list_item['is_staged'] }}" required>
                                                                        <input type="hidden" name="list_item_stage[]" value="{{ $list_item['stage'] }}" required>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="hidden" name="amount_of_lists[]" value="null" required>
                                                <input type="hidden" id="list-titles-{{ $list['has'] }}" name="list_titles[]" value="{{ $list['title'] }}" required>
                                                <input type="hidden" name="list_has[]" value="{{ $list['has'] }}" required>
                                                <input type="hidden" name="list_belongs[]" value="{{ $list['belongs'] }}" required>
                                                <input type="hidden" name="list_has_stages[]" value="{{ $list['has_stages'] }}" required>
                                            </div>
                                        @elseif ( $list['has_stages'] == 'false' )
                                            <div class="list-wrapper d-fc w-100">
                                                <span class="remove-this-item">&times</span>
                                                <div class="title">
                                                    <h3 contenteditable="true" data-text-to-value="#list-titles-{{ $list['has'] }}">{{ $list['title'] }}</h3>
                                                </div>
                                                <div class="list d-fc">
                                                    <div class="d-flex mb-3">
                                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="{{ $list['has'] }}" data-type="double" data-stage="false" data-stage-id="null" data-stage-first="null">ტექსტი</button>
                                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="{{ $list['has'] }}" data-type="red" data-stage="false" data-stage-id="null" data-stage-first="null"><i class="red" id="times"></i></button>
                                                        <button type="button" class="universal-button add-modal-list-item w-auto px-3 mr-3" data-list-id="{{ $list['has'] }}" data-type="green" data-stage="false" data-stage-id="null" data-stage-first="null"><span><i class="green" id="checkmark"></i></span></button>
                                                    </div>
                                                    @if ( array_key_exists('modal_list_items', $data['content']) )
                                                        @foreach ( $data['content']['modal_list_items'] as $li_index => $list_item)
                                                            @if ( $list_item['belongs'] == $list['has'] )
                                                                @if ( $list_item['type'] == 'double' )
                                                                    <div class="item">
                                                                        <span class="remove-this-item">&times</span>
                                                                        <p contenteditable="true" data-html-to-value="#list-item-left-text-{{ $li_index }}">{!! $list_item['left_text'] !!}</p>
                                                                        <span contenteditable="true" data-html-to-value="#list-item-right-text-{{ $li_index }}">{!! $list_item['right_text'] !!}</span>
                                                                        <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                                                        <input type="hidden" name="list_item_belongs[]" value="{{ $list_item['belongs'] }}" required>
                                                                        <input type="hidden" name="list_item_type[]" value="double" required>
                                                                        <input type="hidden" id="list-item-left-text-{{ $li_index }}" name="list_item_left_text[]" value="{{ $list_item['left_text'] }}" required>
                                                                        <input type="hidden" id="list-item-right-text-{{ $li_index }}" name="list_item_right_text[]" value="{{ $list_item['right_text'] }}" required>
                                                                        <input type="hidden" name="list_item_stage_first[]" value="{{ $list_item['stage_first'] }}" required>
                                                                        <input type="hidden" name="list_item_is_staged[]" value="{{ $list_item['is_staged'] }}" required>
                                                                        <input type="hidden" name="list_item_stage[]" value="{{ $list_item['stage'] }}" required>
                                                                    </div>
                                                                @elseif ( $list_item['type'] == 'red' )
                                                                    <div class="item">
                                                                        <span class="remove-this-item">&times</span>
                                                                        <p contenteditable="true" data-html-to-value="#list-item-left-text-{{ $li_index }}">{!! $list_item['left_text'] !!}</p>
                                                                        <span><i class="red" id="times"></i></span>
                                                                        <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                                                        <input type="hidden" name="list_item_belongs[]" value="{{ $list_item['belongs'] }}" required>
                                                                        <input type="hidden" name="list_item_type[]" value="red" required>
                                                                        <input type="hidden" id="list-item-left-text-{{ $li_index }}" name="list_item_left_text[]" value="{{ $list_item['left_text'] }}" required>
                                                                        <input type="hidden" name="list_item_stage_first[]" value="{{ $list_item['stage_first'] }}" required>
                                                                        <input type="hidden" name="list_item_is_staged[]" value="{{ $list_item['is_staged'] }}" required>
                                                                        <input type="hidden" name="list_item_stage[]" value="{{ $list_item['stage'] }}" required>
                                                                    </div>
                                                                @elseif ( $list_item['type'] == 'green' )
                                                                    <div class="item">
                                                                        <span class="remove-this-item">&times</span>
                                                                        <p contenteditable="true" data-html-to-value="#list-item-left-text-{{ $li_index }}">{!! $list_item['left_text'] !!}</p>
                                                                        <span><i class="green" id="checkmark"></i></span>
                                                                        <input type="hidden" name="amount_of_list_items[]" value="null" required>
                                                                        <input type="hidden" name="list_item_belongs[]" value="{{ $list_item['belongs'] }}" required>
                                                                        <input type="hidden" name="list_item_type[]" value="green" required>
                                                                        <input type="hidden" id="list-item-left-text-{{ $li_index }}" name="list_item_left_text[]" value="{{ $list_item['left_text'] }}" required>
                                                                        <input type="hidden" name="list_item_stage_first[]" value="{{ $list_item['stage_first'] }}" required>
                                                                        <input type="hidden" name="list_item_is_staged[]" value="{{ $list_item['is_staged'] }}" required>
                                                                        <input type="hidden" name="list_item_stage[]" value="{{ $list_item['stage'] }}" required>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input type="hidden" name="amount_of_lists[]" value="null" required>
                                                <input type="hidden" id="list-titles-{{ $list['has'] }}" name="list_titles[]" value="{{ $list['title'] }}" required>
                                                <input type="hidden" name="list_has[]" value="{{ $list['has'] }}" required>
                                                <input type="hidden" name="list_belongs[]" value="{{ $list['belongs'] }}" required>
                                                <input type="hidden" name="list_has_stages[]" value="{{ $list['has_stages'] }}" required>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" name="modal_has[]" value="{{ $modal['has'] }}">
                <input type="hidden" id="modal-title-{{ $m_index }}" name="modal_titles[]" value="{{ $modal['title'] }}">
                <input type="hidden" id="modal-description-{{ $m_index }}" name="modal_descriptions[]" value="{{ $modal['description'] }}">
                <input type="hidden" id="modal-information-{{ $m_index }}" name="modal_informations[]" value="{{ $modal['information'] }}">
            </div>
        @endforeach
    @endif
</div>