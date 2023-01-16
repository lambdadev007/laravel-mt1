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
            <span class="views">0 ნახვა</span>
            <div class="article-image-wrapper">
                <label for="article-card-image" class="admin-image-wrapper">
                    <img class="ajax-image" src="{{ asset('images/temp/upload.jpg') }}">
                    <span class="hover-edit-notifier">
                        <span class="dire-edit"></span>
                    </span>
                    <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="card_image" id="article-card-image">
                </label>
            </div>
            <div class="article-content">
                <div class="article-text">
                    <span class="article-date">{{ now() }}<b></b></span>
                    <span class="article-description text-success"><b>მეტა დესქრიფშინი</b></span>
                    <span id="article-description" class="article-description" contenteditable="true" data-text-to-value='input[name="seo_description"]'>თუ ტექსტი ნამეტანად გრძელია ის ავტომატურად შემოკლდება</span>
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
                <img class="ajax-image" src="{{ asset('images/temp/upload.jpg') }}">
                <span class="hover-edit-notifier">
                    <span class="dire-edit"></span>
                </span>
                <input type="file" accept="image/png, image/jpeg" class="ajax-input d-none" name="image" id="article-header-image">
            </label>
        </div>
        <div class="article-text">
            <h1 class="article-title" contenteditable="true" data-text-to-value="#article-title">სათაური - დააჭირეთ რომ შეცვალოთ</h1>
            <input type="hidden" id="article-title" name="title" value="სათაური - დააჭირეთ რომ შეცვალოთ">
                @if ( HelpersCT::is_admin() )
                    <div class="d-flex mb-3">
                        <span class="article-date-author w-100 d-flex align-items-center">{{ now() }} | ავტორი: 
                            <select class="w-50 ml-auto" name="author">
                                @foreach ($admins as $admin)
                                    <option {{ (Session::get('admin.info.id') == $admin['id']) ? 'selected' : '' }} value="{{ $admin['id'] .'-'. $admin['name'] }}">{{ $admin['name'] }}</option>
                                @endforeach
                            </select>
                        </span>
                    </div>
                @else
                    <div class="d-table">
                        <span class="article-date-author">{{ now() }} | ავტორი: {{ Session::get('admin.info.name') }}</span>
                    </div>
                @endif
            <div class="article-description">
                <textarea name="description" class="text-editor"><p>აღწერა</p></textarea>
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

            </div>
        {{-- Article Sub Sections --}}
    </div>
</div>