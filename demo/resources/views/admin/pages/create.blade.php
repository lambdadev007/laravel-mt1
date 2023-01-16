@extends('admin.layout')

@php
    use App\Http\Controllers\HelpersCT;

    $page_titles = [
        'administration'        => [
            'management'    => 'ადმინისტრატორის დამატება',
            'legal_entity'  => 'მაღაზიის დამატება',
        ],
        'shops'                 => 'მაღაზიის დამატება',
        'article'               => 'სტატიის შექმნა',
        'offer'                 => 'აქციის შექმნა',
        'project'               => 'ნამუშევრის შექმნა',
    ];

    $placeholders = [
        0 => 'მაგ: რემონტი, სახლის რემონტი, ევრო რემონტი, ფრანგული ჭერი / მაქსიმუმ 4 სიტყვა - 60 სიმბოლო',
        1 => 'მაქსიმუმ 155 სიმბოლო',
    ];

    $translate = [
        'ka' => 'ქართულად',
        'en' => 'ინგლისურად',
    ];
@endphp

@section('content')
    {{-- Create --}}
        <form class="create-form" enctype="multipart/form-data" action="/admin/{{$form_data['model_name']}}/store" method="post">
            @csrf

            <div class="page-title-wrapper">
                <div class="page-title-line"></div>
                <h3 class="page-title" title="
                {{ ($form_data['model_name'] != 'administration') ? $page_titles[$form_data['model_name']] : $page_titles[$form_data['model_name']][$type] }} 
                {{ ($form_data['model_name'] != 'administration') ? $translate[Session::get('locale')] : '' }}
                ">
                    {{ ($form_data['model_name'] != 'administration') ? $page_titles[$form_data['model_name']] : $page_titles[$form_data['model_name']][$type] }} 
                    {{ ($form_data['model_name'] != 'administration') ? $translate[Session::get('locale')] : '' }}
                </h3>
                <div class="page-title-line"></div>
            </div>

            {{-- Category --}}
                @if ( isset($form_data['has_category']) && HelpersCT::is_admin() || isset($form_data['has_category']) && HelpersCT::admin_category('articles') )
                    <div class="form-section">
                        <h5>კატეგორია</h5>
                        <div class="metrix-selector-wrapper">
                            <select class="form-control" name="category">
                                <option disabled value="">აირჩიეთ კატეგორია</option>
                                @if ( $form_data['model_name'] == 'article' )
                                    <option value="design">დიზაინი</option>
                                    <option value="repairs">რემონტი</option>
                                    <option value="furniture">ავეჯი</option>
                                    <option value="cleaning">დასუფთავება</option>
                                @elseif ( $form_data['model_name'] == 'offer' )
                                    <option value="materials">მასალები</option>
                                    <option value="design">დიზაინი</option>
                                    <option value="repairs">რემონტი</option>
                                    <option value="furniture">ავეჯი</option>
                                    <option value="cleaning">დასუფთავება</option>
                                @elseif ( $form_data['model_name'] == 'project' )
                                    <option value="design">დიზაინი</option>
                                    <option value="repairs">რემონტი</option>
                                    <option value="furniture">ავეჯი</option>
                                @endif
                            </select>
                        </div>
                    </div>
                @elseif ( isset($form_data['has_category']) )
                    @if ( $form_data['model_name'] == 'offer' )
                        <div class="form-section">
                            <h5>კატეგორია</h5>
                            <div class="metrix-selector-wrapper">
                                <select class="form-control" name="category">
                                    <option disabled value="">აირჩიეთ კატეგორია</option>
                                    <option value="materials">მასალები</option>
                                    <option value="design">დიზაინი</option>
                                    <option value="repairs">რემონტი</option>
                                    <option value="furniture">ავეჯი</option>
                                    <option value="cleaning">დასუფთავება</option>
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="hidden_category" value="{{ Crypt::encrypt(Session::get('admin.info.category')) }}">                   
                    @endif
                @endif 
            {{-- Category --}}

            {{-- Slug --}}
                @if ( isset($form_data['has_slug']) )
                    <div class="form-section">
                        <h5>ბმული / აუცილებელია და უნდა იყოს უნიკალური</h5>
                        <input class="form-control" type="text" placeholder="მაგ: სახურავის რემონტი / ტირეები ავტომატურად იქმნება" name="slug" required>
                    </div>
                @endif
            {{-- Slug --}}

            {{-- Seo --}}
                @if ( isset($form_data['has_seo']) )
                    <div class="form-section">
                        <h5>მეტა კეივორდები / აუცილებელია</h5>
                        <input class="form-control" type="text" name="seo_keywords" placeholder="{{ $placeholders[0] }}" maxlength="60" required>
                    </div>

                    @if ( $form_data['model_name'] != 'article' )
                        <div class="form-section">
                            <h5>მეტა დესქრიპშენი / აუცილებელია</h5>
                            <input class="form-control" type="text" name="seo_description" placeholder="{{ $placeholders[1] }}" maxlength="155" required>
                        </div>
                    @elseif ( $form_data['model_name'] == 'article' )
                        <input type="hidden" name="seo_description" value="თუ ტექსტი ნამეტანად გრძელია ის ავტომატურად შემოკლდება" contenteditable="true" data-value-to-text="#article-description" required>
                    @endif
                @endif
            {{-- Seo --}}

            @if ( $form_data['model_name'] == 'administration')
                @include('admin.pages.create.create-admins')
            @elseif ( $form_data['model_name'] == 'article' )
                @include('admin.pages.create.create-articles')
            @elseif ( $form_data['model_name'] == 'offer' )
                @include('admin.pages.create.create-offers')
            @elseif ( $form_data['model_name'] == 'project' )
                @include('admin.pages.create.create-projects')
            @endif

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="split-button">
                    <span>ატვირთვა</span>
                    <span class="dire-right-arrow"></span>
                </button>
            </div>

        </form>
    {{-- Create --}}
@endsection

@section('bottom_js')
    @include('admin.pages.create.bottom-javascript')
@endsection