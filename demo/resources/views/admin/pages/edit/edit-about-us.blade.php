<div class="category-selector-wrapper container-fluid">
    <div class="category-selector w-100">
        <div class="d-flex justify-content-between w-100">
            {{-- About Left Side --}}
                <div class="about-left-side-wrapper m-0">
                    <div class="category-selector">
                        <button type="button" class="active" data-category="company">კომპანია</button>
                        <button type="button" class="" data-category="team">გუნდი</button>
                        <button type="button" class="" data-category="mission">მისია</button>
                    </div>

                    <div class="about-content-wrapper">
                        {{-- Company --}}
                            <div class="company-wrapper show">
                                <div class="company-img-wrapper">
                                    <label for="company-image" class="admin-image-wrapper d-flex">
                                        <img class="ajax-image mx-auto" src="{{ asset('images/about-us/about-us.jpg') }}">
                                        <span class="hover-edit-notifier">
                                            <span class="dire-edit"></span>
                                        </span>
                                        <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="company_image" id="company-image">
                                    </label>
                                </div>
                                <div class="company-description">
                                    @if ( $data['text'] != [] )
                                        <textarea class="text-editor" name="company_description">{!! $data['text'][0]['company_description'] !!}</textarea>
                                        <span class="company-footer" contenteditable="true" data-text-to-value="#company-footer-input">{{ $data['text'][0]['company_footer'] }}</span>
                                        <input id="company-footer-input" type="hidden" name="company_footer" value="{{ $data['text'][0]['company_footer'] }}">
                                    @else
                                        <textarea class="text-editor" name="company_description">აღწერა</textarea>
                                        <span class="company-footer" contenteditable="true" data-text-to-value="#company-footer-input">ტექსტი</span>
                                        <input id="company-footer-input" type="hidden" name="company_footer" value="ტექსტი">
                                    @endif
                                </div>
                            </div>
                        {{-- Company --}}

                        {{-- Team --}}
                            <div class="team-wrapper">
                                <div class="team-text">
                                    @if ( $data['text'] != [] )
                                        <p contenteditable="true" data-text-to-value="#team-header-input">{{ $data['text'][0]['team_header'] }}</p>
                                        <input id="team-header-input" type="hidden" name="team_header" value="{{ $data['text'][0]['team_header'] }}">
                                    @else
                                        <p contenteditable="true" data-text-to-value="#team-header-input">სათაური</p>
                                        <input id="team-header-input" type="hidden" name="team_header" value="სათაური">
                                    @endif
                                </div>

                                <button type="button" class="split-button w-100 add-team-members">
                                    <span class="w-100">გუნდის წევრის დამატება</span>
                                </button>

                                <div class="team-bloks">
                                    @foreach ( $data['team'] as $index => $team )
                                        <div class="team-block">
                                            <label for="team-image-{{ $index }}" class="admin-image-wrapper member-img d-flex">
                                                <img class="ajax-image mx-auto" src="{{ asset($team['image']) }}">
                                                <span class="hover-edit-notifier">
                                                    <span class="dire-edit"></span>
                                                </span>
                                                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="team_images[]" id="team-image-{{ $index }}">
                                            </label>
                                            <div class="member-name" contenteditable="true" data-text-to-value="#member-name-input-{{ $index }}">{{ $team['name'] }}</div>
                                            <div class="member-position" contenteditable="true" data-text-to-value="#member-profession-input-{{ $index }}">{{ $team['profession'] }}</div>

                                            <button type="button" class="split-button w-100 remove-team-member">
                                                <span class="w-100">წაშლა</span>
                                            </button>

                                            <input type="hidden" name="existing_member_image[]" value="{{ $team['image'] }}">
                                            <input id="member-name-input-{{ $index }}" type="hidden" name="member_name[]" value="{{ $team['name'] }}">
                                            <input id="member-profession-input-{{ $index }}" type="hidden" name="member_profession[]" value="{{ $team['profession'] }}">
                                            <input type="hidden" name="amount_of_team_members[]" value="{{ $index }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        {{-- Team --}}

                        {{-- Mission --}}
                            <div class="mission-wrapper">
                                @if ( $data['text'] != [] )
                                    <h3 contenteditable="true" data-text-to-value="#mission-header-input">{{ $data['text'][0]['mission_header'] }}</h3>
                                    <p contenteditable="true" data-text-to-value="#mission-description-input">{{ $data['text'][0]['mission_description'] }}</p>
                                    <div class="mission-btn">
                                        <span contenteditable="true" data-text-to-value="#mission-footer-header-input">{{ $data['text'][0]['mission_footer_header'] }}</span>
                                        <p contenteditable="true" data-text-to-value="#mission-footer-description-input">{{ $data['text'][0]['mission_footer_description'] }}</p>
                                    </div>

                                    <input id="mission-header-input" type="hidden" name="mission_header" value="{{ $data['text'][0]['mission_header'] }}">
                                    <input id="mission-description-input" type="hidden" name="mission_description" value="{{ $data['text'][0]['mission_description'] }}">
                                    <input id="mission-footer-header-input" type="hidden" name="mission_footer_header" value="{{ $data['text'][0]['mission_footer_header'] }}">
                                    <input id="mission-footer-description-input" type="hidden" name="mission_footer_description" value="{{ $data['text'][0]['mission_footer_description'] }}">
                                @else
                                    <h3 contenteditable="true" data-text-to-value="#mission-header-input">სათაური</h3>
                                    <p contenteditable="true" data-text-to-value="#mission-description-input">აღწერა</p>
                                    <div class="mission-btn">
                                        <span contenteditable="true" data-text-to-value="#mission-footer-header-input">ქვედა ტექსტის სათაური</span>
                                        <p contenteditable="true" data-text-to-value="#mission-footer-description-input">ქვედა ტექსტი</p>
                                    </div>

                                    <input id="mission-header-input" type="hidden" name="mission_header" value="სათაური">
                                    <input id="mission-description-input" type="hidden" name="mission_description" value="აღწერა">
                                    <input id="mission-footer-header-input" type="hidden" name="mission_footer_header" value="ქვედა ტექსტის სათაური">
                                    <input id="mission-footer-description-input" type="hidden" name="mission_footer_description" value="ქვედა ტექსტი">
                                @endif
                            </div>
                        {{-- Mission --}}
                    </div>
                </div>
            {{-- About Left Side --}}
        </div>
    </div>
</div>