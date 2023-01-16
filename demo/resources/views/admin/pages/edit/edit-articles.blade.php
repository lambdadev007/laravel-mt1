@php
    use App\Http\Controllers\HelpersCT;
@endphp

{{-- Divider Line --}}
    <div class="my-5">
        <div class="divider-line"></div>
    </div>
{{-- Divider Line --}}

<div class="form-section">
    <h5>ქარდის სურათი / არ არის აუცილებელი / ზომები: 240x160 პიქსელი</h5>
    <div class="articles-wrapper bg-transparent">
        <div class="article-card">
            <span class="views">{{ $data['views'] }} ნახვა</span>
            <div class="article-image-wrapper">
                <label for="article-card-image" class="admin-image-wrapper">
                    <img class="ajax-image" src="{{ ($data['card_image'] != null) ? asset($data['card_image']) : asset('images/temp/no-image.jpg') }}">
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="card_image" id="article-card-image">
                </label>
            </div>
            <div class="article-content">
                <div class="article-text">
                    <span class="article-date">{{ $data['created_at'] }}<b></b></span>
                    <span class="article-description text-success"><b>მეტა დესქრიფშინი</b></span>
                    <span id="article-description" class="article-description" contenteditable="true" data-text-to-value='input[name="seo_description"]'> {{ $data['seo_description'] }} </span>
                </div>
                <button class="split-button" type="button">
                    <span class="dire-right-arrow-s"></span>
                    <span>ვრცლად</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="article-wrapper">
    <div class="article-top-section">
        <div class="article-image">
            <label for="article-header-image" class="admin-image-wrapper">
                <img class="ajax-image" src="{{ ($data['image'] != null) ? asset($data['image']) : asset('images/temp/no-image.jpg') }}">
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="image" id="article-header-image">
            </label>
        </div>
        <div class="article-text">
            <h1 class="article-title" contenteditable="true" data-text-to-value="#article-title">{{ $data['title'] }}</h1>
            <input type="hidden" id="article-title" name="title" value="{{ $data['title'] }}">
            @if ( HelpersCT::is_admin() )
                <div class="d-flex mb-3">
                    <span class="article-date-author w-100 d-flex align-items-center">{{ $data['created_at'] }} | ავტორი: 
                        <select class="w-50 ml-auto" name="author">
                            @foreach ($admins as $admin)
                                <option {{ ($data['author_id'] == $admin['id']) ? 'selected' : '' }} value="{{ $admin['id'] .'-'. $admin['name'] }}">{{ $admin['name'] }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
            @else
                <div class="d-table">
                    <span class="article-date-author">{{ $data['created_at'] }} | ავტორი: {{ $data['author'] }}</span>
                </div>
            @endif
            <div class="article-description">
                <textarea name="description" class="text-editor">{!! $data['description'] !!}</textarea>
            </div>
        </div>
    </div>

    <div class="article-content">
        {{-- Article Sub Sections --}}
            <div class="page-title-wrapper">
                <div class="page-title-line"></div>
                <h3 class="page-title">სტატიის ქვესექციები</h3>
                <div class="page-title-line"></div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="button" class="add-article-section split-button">
                    <span>ქვესექციების დამატება</span>
                </button>
            </div>

            <div class="form-section form-sub-section-wrapper">
                @foreach ($sections as $index => $section)
                    <div class="form-sub-section form-section">
                        <button class="sub-section-collapse" type="button" data-toggle="collapse" data-target="#article-section-{{ $index }}" aria-expanded="false" aria-controls="article-section-{{ $index }}">
                            <span>{{ $section['title'] }}</span>
                            <span class="dire-right-arrow-s"></span>
                        </button>

                        <div class="collapse" id="article-section-{{ $index }}">
                            <button type="button" class="remove-this-article-section btn btn-danger rounded-0">ქვე სექციის წაშლა</button>

                            <input type="hidden" name="amount_of_sections[]" value="{{ $index }}">

                            <div class="form-section">
                                <label for="article-section-header-image-{{ $index }}" class="admin-image-wrapper d-flex mx-auto w-75">
                                    <img class="ajax-image mx-auto w-100" src="{{ ($section['image'] != null) ? asset($section['image']) : asset('images/temp/no-image.jpg') }}">
                                    <span class="hover-edit-notifier">
                                        <span class="dire-edit"></span>
                                    </span>
                                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="section_images[]" id="article-section-header-image-{{ $index }}">
                                </label>
                                <input type="hidden" name="existing_image[]" value="{{ $section['image'] }}">
                            </div>
                            
                            <div class="form-section">
                                <h5>სათაური</h5>
                                <input class="form-control" type="text" name="section_title[]" value="{{ $section['title'] }}" placeholder="{{ $placeholders[0] }}" maxlength="60">
                            </div>

                            <div class="form-section">
                                <h5>სტატიის აღწერა</h5>
                                <textarea class="text-editor" name="section_description[]">{{ $section['description'] }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        {{-- Article Sub Sections --}}
    </div>
</div>