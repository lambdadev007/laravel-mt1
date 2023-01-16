@extends('admin.layout')

@php
    use App\Http\Controllers\HelpersCT;

    $page_titles = [
        'administration'        => [
            'management'    => 'ადმინისტრატორის ინფორმაციის რედაქტირება',
            'legal_entity'  => 'მაღაზიის ინფორმაციის რედაქტირება',
            'employee'      => 'სამუშაო პერსონალის რედაქტირება',
            'personal'      => 'პაროლის შეცვლა',
        ],
        'users'                 => 'მომხმარებლის ინფორმაციის რედაქტირება',
        'shops'                 => 'მაღაზიის ინფორმაციის რედაქტირება',
        'homepage'              => 'მთავარი გვერდის რედაქტირება',
        'partners'              => 'პარტნიორების რედაქტირება',
        'about_us'              => 'ჩვენს შესახებ გვერდის რედაქტირება',
        'vacancies'             => 'ვაკანსიების გვერდის რედაქტირება',
        'vacancies_banners'     => 'ვაკანსიების ბანერების რედაქტირება',
        'vacancies_selects'     => 'ვაკანსიების ფორმის რედაქტირება',
        'consultation'          => 'კონსულტაციის გვერდის რედაქტირება',
        'contact'               => 'კონტაქტის გვერდის რედაქტირება',
        'design'                => 'დიზაინის გვერდის რედაქტირება',
        'repairs'               => 'რემონტის გვერდის რედაქტირება',
        'furniture'             => 'ავეჯის გვერდის რედაქტირება',
        'furniture_materials'   => 'ფურნიტურა და მასალების რედაქტირება',
        'furniture_gallery'     => 'პროექტები და ნამუშევრების რედაქტირება',
        'vip_master'            => 'VIP-მასტერის რედაქტირება',
        'cleaning_top'          => 'ზედა დასუფთავების რედაქტირება',
        'cleaning_bottom'       => 'ქვედა დასუფთავების რედაქტირება',
        'article'               => 'სტატიის რედაქტირება',
        'offer'                 => 'აქციის რედაქტირება',
        'project'               => 'ნამუშევრეის რედაქტირება',
    ];

    $soft_delete = [
        'true'  => 'წაშლილია',
        'false' => 'არ არის წაშლილი',
    ];

    $translate = [
        'ka' => 'ქართულად',
        'en' => 'ინგლისურად',
    ];

    $placeholders = [
        'მაგ: რემონტი, სახლის რემონტი, ევრო რემონტი, ფრანგული ჭერი / მაქსიმუმ 4 სიტყვა - 60 სიმბოლო',
        'მაქსიმუმ 155 სიმბოლო',
        'მაგ: სახურავის რემონტი / ტირეები ავტომატურად იქმნება / აუცილებელია და უნდა იყოს უნიკალური',
        'დააწექით კალენდარი რომ გამოვიდეს / არ არის აუცილებელი',
    ];

    $category_lang = [
        'admin'                 => 'ადმინისტრატორი',
        'executable'            => 'შეტყობინებების კოდი',   
        'materials'             => 'მასალები',
        'manager_design'        => 'მენეჯერი - დიზაინი',
        'manager_repairs'       => 'მენეჯერი - რემონტი',
        'manager_furniture'     => 'მენეჯერი - ავეჯი',
        'manager_cleaning'      => 'მენეჯერი - დასუფთავება',
        'design'                => 'დიზაინი',
        'repairs'               => 'რემონტი',
        'furniture'             => 'ავეჯი',
        'cleaning'              => 'დასუფთავება',
        'vip_master'            => 'ვიპ მასტერი',
        'articles'              => 'სტატიების მწერალი',
    ];
@endphp

@section('content')
    @if ( $stage == 'select' )
        @if ( $data == [] )
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div class="alert alert-info my-3">ჯერ ჯერობით არ არის</div>
                {{-- <a href="/admin/{{ $form_data['model_name'] }}/create" class="split-button pulse-button">
                    <span>დამატება</span>
                    <span class="dire-left-arrow-s"></span>
                </a> --}}
            </div>
        @endif
        
        {{-- Select --}}
            @if ( $data != [] )
                {{-- Action Modal And Sort --}}
                    {{-- Action and Sort --}}
                        <div class="action-and-sort-wrapper">
                            <div class="action-modal-caller {{ ($data == []) ? 'd-none' : '' }}">
                                <button disabled type="button" class="split-button" data-toggle="modal" data-target="#action-modal">
                                    <span class="modal-caller-icon dire-right-arrow-s"></span>
                                    <span class="modal-caller-text">მონიშნულებზე მოქმედება</span>
                                </button>
                            </div>

                            @if ( HelpersCT::is_admin() )
                                <div class="admin-sort-wrapper">
                                    <div class="metrix-selector-wrapper w-100">
                                        <select class="w-100">
                                            <option data-sort="all">ყველა</option>
                                            @if ( $form_data['model_name'] == 'admins' )
                                                <option data-sort="admin">ადმინისტრატორი</option>
                                                <option data-sort="manager_design">მენეჯერი - დიზაინი</option>
                                                <option data-sort="manager_repairs">მენეჯერი - რემონტი</option>
                                                <option data-sort="manager_furniture">მენეჯერი - ავეჯი</option>
                                                <option data-sort="manager_cleaning">მენეჯერი - დასუფთავება</option>
                                                <option data-sort="articles">სტატიების მწერალი</option>
                                            @endif
                                            @if ( $form_data['model_name'] == 'article' )
                                                <option data-sort="verified">გადამოწმებულია</option>
                                                <option data-sort="unverified">გადაუმოწმებელია</option>
                                                <option data-sort="design">დიზაინერი</option>
                                                <option data-sort="repairs">რემონტი</option>
                                                <option data-sort="furniture">ავეჯი</option>
                                                <option data-sort="cleaning">დასუფთავება</option>
                                            @endif
                                            @if ( $form_data['model_name'] == 'offer' )
                                                <option data-sort="design">დიზაინერი</option>
                                                <option data-sort="repairs">რემონტი</option>
                                                <option data-sort="furniture">ავეჯი</option>
                                            @endif
                                            @if ( $form_data['model_name'] == 'project' )
                                                <option data-sort="repairs">რემონტი</option>
                                                <option data-sort="furniture">ავეჯი</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                    {{-- Action and Sort --}}

                    {{-- Modal --}}
                        <div class="modal fade" id="action-modal" tabindex="-1" role="dialog" aria-labelledby="action-modal-label" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="action-modal-label">დარწმუნებული ხართ ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body row">

                                        <div class="col-md-6 col-sm-12 d-flex flex-column">
                                            <span class="text-center mb-4"><b>წაშლა</b></span>

                                            <form action="/admin/{{ $form_data['model_name'] }}/delete/soft" method="post" class="d-flex">
                                            @csrf
                                                <input type="hidden" name="id_string" value>
                                                <button type="submit" class="split-button w-100">
                                                    <span class="bg-warning w-100">რბილი წაშლა</span>
                                                    <span class="dire-left-arrow bg-dark text-light"></span>
                                                </button>
                                            </form>

                                            @if ( HelpersCT::is_admin() )
                                                <form action="/admin/{{ $form_data['model_name'] }}/delete/hard" method="post" class="d-flex">
                                                @csrf
                                                    <input type="hidden" name="id_string" value>
                                                    <button type="submit" class="split-button w-100 my-3">
                                                        <span class="bg-danger w-100">მყარი წაშლა</span>
                                                        <span class="dire-left-arrow bg-dark text-light"></span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                        <div class="col-md-6 col-sm-12 d-flex flex-column">
                                            <span class="text-center mb-4"><b>აღდენა</b></span>

                                            <form action="/admin/{{ $form_data['model_name'] }}/restore" method="post" class="d-flex">
                                            @csrf
                                                <input type="hidden" name="id_string" value>
                                                <button type="submit" class="split-button w-100">
                                                    <span class="bg-info w-100">რბილად წაშლილის აღდგენა</span>
                                                    <span class="dire-left-arrow bg-dark text-light"></span>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="col-sm-12 mt-5 d-flex flex-column">
                                            <button type="button" class="split-button align-self-end" data-dismiss="modal">
                                                <span>უკან დაბრუნება</span>
                                                <span class="dire-left-arrow"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- Modal --}}
                {{-- Action Modal And Sort --}}

                {{-- Administration Select --}}
                    @if ( $form_data['model_name'] == 'administration' )
                        <div class="admin-panel-custom-items-wrapper">
                            @foreach ($data as $user)
                                @if ( $user['id'] != 1 )
                                    <div class="admin-panel-custom-item admin-sort-item {{ $user['category'] }}">
                                        {{-- Action Checker --}}
                                            <label class="check-for-action-label" for="action-checkbox-{{ $user['id'] }}">მონიშვნა</label>
                                            <input class="check-for-action-checkbox" type="checkbox" id="action-checkbox-{{ $user['id'] }}" data-id={{ $user['id'] }}>
                                        {{-- Action Checker --}}
                                        <span class="delete-status {{ $user['soft_delete'] }}">{{ $soft_delete[$user['soft_delete']] }}</span>
                                        <span>სახელი: <b>{{ $user['name'] }}</b></span>
                                        <span>კატეგორია: <b>{{ $category_lang[$user['category']] }}</b></span>
                                        <a href="/admin/administration/{{ $type }}/edit/{{ $user['id'] }}" class="split-button align-self-end mt-5">
                                            <span class="bg-info">რედაქტირება</span>
                                            <span class="dire-left-arrow"></span>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                {{-- Administration Select --}}

                {{-- Users Select --}}
                    @if ( $form_data['model_name'] == 'users' )
                        <div class="admin-panel-custom-items-wrapper custom-users-wrapper">
                            @foreach ($data as $user)
                                <div class="admin-panel-custom-item admin-sort-item">
                                    <span>სახელი: <b>{{ $user['f_name'] .' '. $user['l_name'] }}</b></span>
                                    <span>ნომერი: <b>{{ $user['number'] }}</b></span>
                                    <a href="/admin/users/edit/{{ $user['id'] }}" class="split-button align-self-end mt-5">
                                        <span class="bg-info">რედაქტირება</span>
                                        <span class="dire-left-arrow"></span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                {{-- Users Select --}}

                {{-- Articles Select --}}
                    @if ( $form_data['model_name'] == 'article' )
                        <div class="articles-wrapper bg-transparent">
                            @foreach ($data as $index => $article)
                                <div class="article-card admin-sort-item {{ $article['category'] }} {{ $article['verification'] }}">
                                    <span class="views">{{ $article['views'] }} ნახვა</span>
                                    @if ( !HelpersCT::admin_category('articles') )
                                        @if ( $article['valid_for_editing'] == 'true' || HelpersCT::is_admin() )
                                            {{-- Action Checker --}}
                                                <label class="check-for-action-label" for="action-checkbox-{{ $article['id'] }}">მონიშვნა</label>
                                                <input class="check-for-action-checkbox" type="checkbox" id="action-checkbox-{{ $article['id'] }}" data-id={{ $article['id'] }}>
                                                <span class="delete-status {{ $article['soft_delete'] }}">{{ $soft_delete[$article['soft_delete']] }}</span>
                                            {{-- Action Checker --}}
                                        @endif
                                    @endif
                                    <div class="article-image-wrapper">
                                        <img src="{{ asset($article['card_image']) }}" alt="{{ $article['seo_description'] }}">
                                    </div>
                                    <div class="article-content">
                                        <div class="article-text">
                                            <span class="article-date"><b>{{ $article['created_at'] }}</b></span>
                                            <span class="article-description" title="">
                                                კატეგორია: {{ $article['category'] !== null ? $category_lang[$article['category']] : 'კატეგორია არ არის დასმული' }} <br> 
                                                <span class="cut-article-description" title="{{ $article['seo_description'] }}">{{ $article['seo_description'] }}</span>
                                            </span>
                                        </div>
                                        @if ( HelpersCT::admin_category('articles') && $article['valid_for_editing'] == 'true' || HelpersCT::is_admin() || Session::get('admin.can_write.articles') )
                                            <a href="/admin/article/edit/{{ $article['id'] }}" class="split-button">
                                                <span class="dire-right-arrow-s"></span>
                                                <span>რედაქტირება</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                {{-- Articles Select --}}
                
                {{-- Offers Select --}}
                    @if ( $form_data['model_name'] == 'offer' )
                        <div class="special-offers-wrapper">
                            @foreach ($data as $index => $offer)  
                                <div class="offer-card-wrapper admin-offer-card-wrapper admin-sort-item {{ $offer['category'] }}">
                                    @if ( $offer['valid_for_editing'] == 'true' || HelpersCT::is_admin() )
                                        {{-- Action Checker --}}
                                            <label class="check-for-action-label" for="action-checkbox-{{ $offer['id'] }}">მონიშვნა</label>
                                            <input class="check-for-action-checkbox" type="checkbox" id="action-checkbox-{{ $offer['id'] }}" data-id={{ $offer['id'] }}>
                                            <span class="delete-status {{ $offer['soft_delete'] }}">{{ $soft_delete[$offer['soft_delete']] }}</span>
                                        {{-- Action Checker --}}
                                    @endif
                                    <span class="offer-validity">ძალაშია: {{ $offer['valid'] == null ? 'არ არის მითითებული' : $offer['valid'] }}</span>

                                    <span class="offer-validity category">კატეგორია: {{ $offer['category'] == null ? 'არ არის მითითებული' : $category_lang[$offer['category']] }}</span>

                                    @if ( $offer['valid_for_editing'] == 'true' || HelpersCT::is_admin() )
                                        <a href="/admin/offer/edit/{{ $offer['id'] }}" class="split-button">
                                            <span class="dire-right-arrow"></span>
                                            <span>რედაქტირება</span>
                                        </a>
                                    @endif

                                    <div class="offer-banner-container">
                                        <img src="{{ asset($offer['card_image']) }}" alt="{{ $offer['title'] == null ? 'სურათი არ არის მითითებული' : $offer['title'] }}">
                                    </div>
                                    <div class="offer-footer offer-footer-admin">
                                        <a href="javascript:void(0)">{{ $offer['title'] == null ? 'სათაური არ არის მითითებული' : $offer['title'] }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                {{-- Offers Select --}}

                {{-- Projects Select --}}
                    @if ( $form_data['model_name'] == 'project' )
                        <div class="projects-wrapper stage-select">
                            @foreach ($data as $index => $project)
                                <div class="project-card admin-sort-item {{ $project['category'] }}">
                                    <a href="{{ $project['valid_for_editing'] == 'true' || HelpersCT::is_admin() ? '/admin/project/edit/' . $project['id'] : 'javascript:void(0)' }}">
                                        @if ( $project['valid_for_editing'] == 'true' || HelpersCT::is_admin() )
                                            {{-- Action Checker --}}
                                                <label class="check-for-action-label" for="action-checkbox-{{ $project['id'] }}">მონიშვნა</label>
                                                <input class="check-for-action-checkbox" type="checkbox" id="action-checkbox-{{ $project['id'] }}" data-id={{ $project['id'] }}>
                                                <span class="delete-status {{ $project['soft_delete'] }}">{{ $soft_delete[$project['soft_delete']] }}</span>
                                            {{-- Action Checker --}}
                                        @endif
                                        <div class="views">{{ $project['views'] }} ნახვა</div>
                                        <div class="status">{{ $project['status'] }}</div>
                                        <div class="project-card-image-wrapper">
                                            <img src="{{ asset( $project['card_image'] ) }}"  alt="{{ $project['title'] }}" title="{{ $project['title'] }}">
                                        </div>
                                        <div class="project-card-title">{{ $project['title'] }}</div>
                                        <div class="project-card-info">
                                            <span>კატეგორია: <b>{{ $category_lang[$project['category']] }}</b></span>
                                        </div>
                                    </a> 
                                </div>
                            @endforeach
                        </div>
                    @endif
                {{-- Projects Select --}}
            @endif
        {{-- Select --}}
    @elseif ( $stage == 'edit' )
        <form class="create-form" enctype="multipart/form-data" action="/admin/{{ $form_data['model_name'] }}/update/{{ $data['id'] }}" method="post">
            @csrf

            <div class="page-title-wrapper">
                <div class="page-title-line"></div>
                <h3 class="page-title cut-text-lg"
                title="
                {{ ($form_data['model_name'] != 'administration') ? $page_titles[$form_data['model_name']] : $page_titles[$form_data['model_name']][$type] }} 
                {{ ($form_data['model_name'] != 'administration' && $form_data['model_name'] != 'vip_master') ? $translate[Session::get('locale')] : '' }}
                ">
                    {{ ($form_data['model_name'] != 'administration') ? $page_titles[$form_data['model_name']] : $page_titles[$form_data['model_name']][$type] }}
                    {{ ($form_data['model_name'] != 'administration' && $form_data['model_name'] != 'vip_master') ? $translate[Session::get('locale')] : '' }}
                </h3>
                <div class="page-title-line"></div>
            </div>

            {{-- Category --}}
                @if ( isset($form_data['has_category']) && HelpersCT::is_admin() )
                    <div class="form-section">
                        <h5>კატეგორია</h5>
                        <div class="metrix-selector-wrapper">
                            <select class="form-control" name="category">
                                <option disabled value="">აირჩიეთ კატეგორია</option>
                                @if ( $form_data['model_name'] == 'article' )
                                    <option {{ $data['category'] == 'design'    ? 'selected' : '' }} value="design">დიზაინი</option>
                                    <option {{ $data['category'] == 'repairs'   ? 'selected' : '' }} value="repairs">რემონტი</option>
                                    <option {{ $data['category'] == 'furniture' ? 'selected' : '' }} value="furniture">ავეჯი</option>
                                    <option {{ $data['category'] == 'cleaning'  ? 'selected' : '' }} value="cleaning">დასუფთავება</option>
                                @elseif ( $form_data['model_name'] == 'offer' )
                                    <option {{ $data['category'] == 'materials' ? 'selected' : '' }} value="materials">მასალები</option>
                                    <option {{ $data['category'] == 'design'    ? 'selected' : '' }} value="design">დიზაინი</option>
                                    <option {{ $data['category'] == 'repairs'   ? 'selected' : '' }} value="repairs">რემონტი</option>
                                    <option {{ $data['category'] == 'furniture' ? 'selected' : '' }} value="furniture">ავეჯი</option>
                                    <option {{ $data['category'] == 'cleaning'  ? 'selected' : '' }} value="cleaning">დასუფთავება</option>
                                @elseif ( $form_data['model_name'] == 'project' )
                                    <option {{ $data['category'] == 'design'    ? 'selected' : '' }} value="design">დიზაინი</option>
                                    <option {{ $data['category'] == 'repairs'   ? 'selected' : '' }} value="repairs">რემონტი</option>
                                    <option {{ $data['category'] == 'furniture' ? 'selected' : '' }} value="furniture">ავეჯი</option>
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
                                    <option {{ $data['category'] == 'materials' ? 'selected' : '' }} value="materials">მასალები</option>
                                    <option {{ $data['category'] == 'design'    ? 'selected' : '' }} value="design">დიზაინი</option>
                                    <option {{ $data['category'] == 'repairs'   ? 'selected' : '' }} value="repairs">რემონტი</option>
                                    <option {{ $data['category'] == 'furniture' ? 'selected' : '' }} value="furniture">ავეჯი</option>
                                    <option {{ $data['category'] == 'cleaning'  ? 'selected' : '' }} value="cleaning">დასუფთავება</option>
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
                        <h5>ბმული</h5>
                        <input class="form-control" type="text" value="{{ $data['og_slug'] }}" placeholder="მაგ: სახურავის რემონტი / ტირეები ავტომატურად იქმნება" name="slug" required>
                    </div>
                @endif
            {{-- Slug --}}

            {{-- Seo --}}
                @if ( isset($form_data['has_seo']) )
                    <div class="form-section">
                        <h5>მეტა კეივორდები</h5>
                        <input class="form-control" type="text" name="seo_keywords" value="{{ $data['seo_keywords'] }}" placeholder="{{ $placeholders[0] }}" maxlength="60">
                    </div>
                    
                    <div class="form-section">
                        <h5>მეტა დესქრიპშენი / აუცილებელია</h5>
                        <input class="form-control" type="text" name="seo_description" value="{{ $data['seo_description'] }}" placeholder="{{ $placeholders[1] }}" maxlength="155" required>
                    </div>
                @endif
            {{-- Seo --}}

            {{-- Includes --}}
                @if ( $form_data['model_name'] == 'administration')
                    @include('admin.pages.edit.edit-admins')
                @elseif ( $form_data['model_name'] == 'users' )
                    @include('admin.pages.edit.edit-users')
                @elseif ( $form_data['model_name'] == 'homepage' )
                    @include('admin.pages.edit.edit-homepage')
                @elseif ( $form_data['model_name'] == 'partners' )
                    @include('admin.pages.edit.edit-partners')
                @elseif ( $form_data['model_name'] == 'about_us' )
                    @include('admin.pages.edit.edit-about-us')
                @elseif ( $form_data['model_name'] == 'vacancies' )
                    @include('admin.pages.edit.edit-vacancies')
                @elseif ( $form_data['model_name'] == 'vacancies_banners' )
                    @include('admin.pages.edit.edit-vacancies-banners')
                @elseif ( $form_data['model_name'] == 'vacancies_selects' )
                    @include('admin.pages.edit.edit-vacancies-selects')
                @elseif ( $form_data['model_name'] == 'consultation' )
                    @include('admin.pages.edit.edit-consultation')
                @elseif ( $form_data['model_name'] == 'contact' )
                    @include('admin.pages.edit.edit-contact')
                @elseif ( $form_data['model_name'] == 'design' )
                    @include('admin.pages.edit.edit-design')
                @elseif ( $form_data['model_name'] == 'repairs' )
                    @include('admin.pages.edit.edit-repairs')
                @elseif ( $form_data['model_name'] == 'furniture' )
                    @include('admin.pages.edit.edit-furniture')
                @elseif ( $form_data['model_name'] == 'furniture_materials' )
                    @include('admin.pages.edit.edit-furniture-materials')
                @elseif ( $form_data['model_name'] == 'furniture_gallery' )
                    @include('admin.pages.edit.edit-furniture-gallery')
                @elseif ( $form_data['model_name'] == 'vip_master' )
                    @include('admin.pages.edit.edit-vip-master')
                @elseif ( $form_data['model_name'] == 'cleaning_top' )
                    @include('admin.pages.edit.edit-cleaning-top')
                @elseif ( $form_data['model_name'] == 'cleaning_bottom' )
                    @include('admin.pages.edit.edit-cleaning-bottom')
                @elseif ( $form_data['model_name'] == 'article' )
                    @include('admin.pages.edit.edit-articles')
                @elseif ( $form_data['model_name'] == 'offer' )
                    @include('admin.pages.edit.edit-offers')
                @elseif ( $form_data['model_name'] == 'project' )
                    @include('admin.pages.edit.edit-projects')
                @endif
            {{-- Includes --}}

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="split-button">
                    <span>განახლება</span>
                    <span class="dire-right-arrow"></span>
                </button>
            </div>
        </form>
    @endif
@endsection

@section('bottom_js')
    @include('admin.pages.edit.bottom-javascript')
@endsection