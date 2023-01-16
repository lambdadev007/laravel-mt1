@php
    use App\Models\Notifications;
    use App\Http\Controllers\HelpersCT;

    if ( HelpersCT::is_admin() ) {
        $amount_of_notifications = count(Notifications::where([['current_timeframe', 'day'], ['status', '!=', 'finished']])->get()->toArray());
    } elseif ( HelpersCT::is_manager() ) {
        $amount_of_notifications                = count(Notifications::where([['current_timeframe', 'day'], ['status', '!=', 'finished'], ['type', '!=', 'call_request']])->get()->toArray());
        $amount_of_notifications_call_request   = count(Notifications::where([['current_timeframe', 'day'], ['status', '!=', 'finished'], ['type', 'call_request'], ['call_request_category', Session::get('admin.info.category')]])->get()->toArray());
        $amount_of_notifications = $amount_of_notifications + $amount_of_notifications_call_request;
    }
@endphp

{{-- Sidebar --}}
    <ul class="admin-panel-sidebar accordion {{ Session::has('navbar.checked') ? 'active' : '' }}" id="admin-sidebar-accordion">
        {{-- Notifications --}}
            @if ( Session::get('admin.info.has_notifications') )
                <li class="category">
                    <a href="/admin/notification-categories/day" class="category-button sub-category-button waves-button">
                        <span>
                            <span class="dire-area"></span>
                            <span>ახალი შეტყობინებები - {{ $amount_of_notifications }}</span>
                        </span>
                    </a>
                </li>
                
                <li class="category">
                    <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#notifications" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'notifications' ? 'true' : 'false' }}" aria-controls="notifications">
                        <span>
                            <span class="dire-date"></span> შეტყობინებების არქივი
                        </span>
                        <span class="dire-right-arrow"></span>
                    </button>

                    <div class="collapse {{ ((isset($collapse['category'])) && $collapse['category'] == 'notifications') ? 'show' : '' }}" id="notifications" aria-labelledby="notifications" data-parent="#admin-sidebar-accordion">
                        <ul>
                            <li>
                                <a href="/admin/notification-categories/month" class="category-button sub-category-button waves-button">
                                    <span>
                                        <span class="dire-date"></span> ბოლო ერთი თვის
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/notification-categories/year" class="category-button sub-category-button waves-button">
                                    <span>
                                        <span class="dire-date"></span> ბოლო ერთი წლის
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        {{-- Notifications --}}

        {{-- Administration --}}
            @if ( HelpersCT::is_manager() || HelpersCT::is_admin() )
                <li class="category">
                    <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#admins-category" aria-expanded="{{ (isset($collapse['category'])) && $collapse['category'] == 'admins' ? 'true' : 'false' }}" aria-controls="admins-category">
                        <span>
                            <span class="dire-master-icon"></span> ადმინისტრაცია
                        </span>
                        <span class="dire-right-arrow"></span>
                    </button>

                    <div class="collapse {{ (isset($collapse['category'])) && $collapse['category'] == 'admins' ? 'show' : '' }}" id="admins-category" aria-labelledby="admins-category" data-parent="#admin-sidebar-accordion">
                        <ul class="accordion" id="admins-accordion">
                            @if ( HelpersCT::is_admin() )
                                <li {{-- Logs --}}>
                                    <a href="/admin/logs" class="category-button sub-category-button waves-button">
                                        <span>
                                            <span class="dire-master-icon"></span> ჟურნალი
                                        </span>
                                    </a>
                                </li>

                                <li {{-- Add --}}>
                                    <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#admins-add" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'admins-add' ? 'true' : 'false' }}" aria-controls="admins-add">
                                        <span>
                                            <span class="dire-master-icon"></span> დამატება
                                        </span>
                                        <span class="dire-right-arrow"></span>
                                    </button>

                                    <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'admins-add' ? 'show' : '' }}" id="admins-add" aria-labelledby="admins-add" data-parent="#admins-accordion">
                                        <ul>
                                            <li>
                                                <a class="sub-category-action" href="/admin/administration/management/create">
                                                    <span>
                                                        <span class="dire-right-arrow"></span> ადმინისტრატორის დამატება
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sub-category-action" href="/admin/administration/legal_entity/create">
                                                    <span>
                                                        <span class="dire-right-arrow"></span> მაღაზიის დამატება
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li {{-- Edit --}}>
                                    <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#admins-edit" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'admins-edit' ? 'true' : 'false' }}" aria-controls="admins-edit">
                                        <span>
                                            <span class="dire-master-icon"></span> რედაქტირება
                                        </span>
                                        <span class="dire-right-arrow"></span>
                                    </button>

                                    <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'admins-edit' ? 'show' : '' }}" id="admins-edit" aria-labelledby="admins-edit" data-parent="#admins-accordion">
                                        <ul>
                                            <li>
                                                <a class="sub-category-action" href="/admin/administration/management/edit">
                                                    <span>
                                                        <span class="dire-right-arrow"></span> ადმინისტრატორების რედაქტირება
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sub-category-action" href="/admin/administration/legal_entity/edit">
                                                    <span>
                                                        <span class="dire-right-arrow"></span> მაღაზიების რედაქტირება
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sub-category-action" href="/admin/administration/employee/edit">
                                                    <span>
                                                        <span class="dire-right-arrow"></span> პერსონალის რედაქტირება
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="sub-category-action" href="/admin/users">
                                                    <span>
                                                        <span class="dire-right-arrow"></span> მომხმარებლების რედაქტირება
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endif

                            <li {{-- Select --}}>
                                <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#send-message" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'send-message' ? 'true' : 'false' }}" aria-controls="send-message">
                                    <span>
                                        <span class="dire-master-icon"></span> მესიჯის გაგზავნა
                                    </span>
                                    <span class="dire-right-arrow"></span>
                                </button>
                                
                                <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'send-message' ? 'show' : '' }}" id="send-message" aria-labelledby="admins-edit" data-parent="#admins-accordion">
                                    <ul>
                                        <li>
                                            <a class="sub-category-action" href="/admin/message/staff">
                                                <span>
                                                    <span class="dire-right-arrow"></span> პერსონალის მონიშვნა
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="sub-category-action" href="/admin/message/shops">
                                                <span>
                                                    <span class="dire-right-arrow"></span> მაღაზიების მონიშვნა
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        {{-- Administration --}}

        {{-- Pages --}}
            @if ( Session::get('admin.can_edit.pages') == 'true' || HelpersCT::is_admin() )
                <li class="category">
                    <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#pages-category" aria-expanded="{{ (isset($collapse['category'])) && $collapse['category'] == 'pages' ? 'true' : 'false' }}" aria-controls="pages-category">
                        <span>
                            <span class="dire-design"></span> გვერდები
                        </span>
                        <span class="dire-right-arrow"></span>
                    </button>

                    
                    <div class="collapse {{ ((isset($collapse['category'])) && $collapse['category'] == 'pages') ? 'show' : '' }}" id="pages-category" aria-labelledby="pages-category" data-parent="#admin-sidebar-accordion">
                        <ul class="accordion" id="pages-accordion">
                            <li>
                                @if ( HelpersCT::is_admin() )
                                    <li>
                                        <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#vacancies" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'vacancies' ? 'true' : 'false' }}" aria-controls="vacancies">
                                            <span>
                                                <span class="dire-design"></span> ვაკანსიები
                                            </span>
                                            <span class="dire-right-arrow"></span>
                                        </button>

                                        <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'vacancies' ? 'show' : '' }}" id="vacancies" aria-labelledby="vacancies" data-parent="#pages-accordion">
                                            <ul>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/pages/vacancies">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> ვაკანსიები
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/pages/vacancies-banners">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> ვაკანსიების ბანერები
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/pages/vacancies-selects">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> ვაკანსიების ფორმა
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="/admin/pages/homepage" class="category-button sub-category-button waves-button">
                                            <span>
                                                <span class="dire-design"></span> მთავარი გვერდი
                                            </span>
                                        </a>
                                    </li>
                                
                                    <li>
                                        <a href="/admin/pages/partners" class="category-button sub-category-button waves-button">
                                            <span>
                                                <span class="dire-design"></span> პარტნიორები
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="/admin/pages/about-us" class="category-button sub-category-button waves-button">
                                            <span>
                                                <span class="dire-design"></span> ჩვენს შესახებ
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @if ( Session::has('admin.can_edit.consultation') || HelpersCT::is_admin() )
                                    <li>
                                        <a href="/admin/pages/consultation" class="category-button sub-category-button waves-button">
                                            <span>
                                                <span class="dire-design"></span> კონსულტაცია
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @if ( Session::has('admin.can_edit.contact') || HelpersCT::is_admin() )
                                    <li>
                                        <a href="/admin/pages/contact" class="category-button sub-category-button waves-button">
                                            <span>
                                                <span class="dire-design"></span> კონტაქტი
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @if ( Session::has('admin.can_edit.design') || HelpersCT::is_admin() )
                                    <li>
                                        <a href="/admin/pages/design" class="category-button sub-category-button waves-button">
                                            <span>
                                                <span class="dire-design"></span> დიზაინერი
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @if ( Session::has('admin.can_edit.repairs') || HelpersCT::is_admin() )
                                    <li>
                                        <a href="/admin/pages/repairs" class="category-button sub-category-button waves-button">
                                            <span>
                                                <span class="dire-design"></span> რემონტი
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @if ( Session::has('admin.can_edit.furniture') || HelpersCT::is_admin() )
                                    <li>
                                        <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#furniture" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'furniture' ? 'true' : 'false' }}" aria-controls="furniture">
                                            <span>
                                                <span class="dire-design"></span> ავეჯი
                                            </span>
                                            <span class="dire-right-arrow"></span>
                                        </button>

                                        <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'furniture' ? 'show' : '' }}" id="furniture" aria-labelledby="furniture" data-parent="#pages-accordion">
                                            <ul>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/pages/furniture">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> მთავარი გვერდი
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/pages/furniture-gallery">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> ნამუშევრების გალერეა
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/pages/furniture-materials">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> მასალები
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                                @if ( Session::has('admin.can_edit.vip_master') || HelpersCT::is_admin() )
                                    <li>
                                        <a href="/admin/pages/vip-master" class="category-button sub-category-button waves-button">
                                            <span>
                                                <span class="dire-design"></span> VIP-მასტერი
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @if ( Session::has('admin.can_edit.cleaning') || HelpersCT::is_admin() )
                                    <li>
                                        <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#cleaning" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'cleaning' ? 'true' : 'false' }}" aria-controls="cleaning">
                                            <span>
                                                <span class="dire-design"></span> დასუფთავება
                                            </span>
                                            <span class="dire-right-arrow"></span>
                                        </button>

                                        <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'cleaning' ? 'show' : '' }}" id="cleaning" aria-labelledby="cleaning" data-parent="#pages-accordion">
                                            <ul>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/pages/cleaning-top">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> ზედა
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/pages/cleaning-bottom">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> ქვედა
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            </li>
                        </ul>
                    </div>
                </li>
            @endif
        {{-- Pages --}}

        {{-- Content --}}
            @if ( Session::has('admin.can_write.content') || HelpersCT::is_admin() )
                <li class="category">
                    <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#content-category" aria-expanded="{{ (isset($collapse['category'])) && $collapse['category'] == 'content' ? 'true' : 'false' }}" aria-controls="content-category">
                        <span>
                            <span class="dire-edit"></span> კონტენტი
                        </span>
                        <span class="dire-right-arrow"></span>
                    </button>

                    <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['category'] == 'content' ? 'show' : '' }}" id="content-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                        <ul class="accordion" id="content-accordion">
                            {{-- Articles --}}
                                @if ( Session::has('admin.can_write.articles') || HelpersCT::is_admin())
                                    <li>
                                        <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#articles-category" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'articles' ? 'true' : 'false' }}" aria-controls="articles-category">
                                            <span>
                                                <span class="dire-edit"></span> სტატიები
                                            </span>
                                            <span class="dire-right-arrow"></span>
                                        </button>

                                        <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'articles' ? 'show' : '' }}" id="articles-category" aria-labelledby="articles-category" data-parent="#content-accordion">
                                            <ul>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/article/create">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> დამატება
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/article/edit">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> რედაქტირება
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            {{-- Articles --}}

                            {{-- Offers --}}
                                @if ( Session::has('admin.can_write.offers') || HelpersCT::is_admin() )
                                    <li>
                                        <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#offers-category" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'offers' ? 'true' : 'false' }}" aria-controls="offers-category">
                                            <span>
                                                <span class="dire-edit"></span> აქციები
                                            </span>
                                            <span class="dire-right-arrow"></span>
                                        </button>

                                        <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'offers' ? 'show' : '' }}" id="offers-category" aria-labelledby="offers-category" data-parent="#content-accordion">
                                            <ul>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/offer/create">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> დამატება
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/offer/edit">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> რედაქტირება
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            {{-- Offers --}}

                            {{-- Projects --}}
                                @if ( Session::has('admin.can_write.projects') || HelpersCT::is_admin() )
                                    <li>
                                        <button class="category-button sub-category-button waves-button" type="button" data-toggle="collapse" data-target="#projects-category" aria-expanded="{{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'projects' ? 'true' : 'false' }}" aria-controls="projects-category">
                                            <span>
                                                <span class="dire-edit"></span> ნამუშევრები
                                            </span>
                                            <span class="dire-right-arrow"></span>
                                        </button>

                                        <div class="collapse {{ (isset($collapse['sub_category'])) && $collapse['sub_category'] == 'projects' ? 'show' : '' }}" id="projects-category" aria-labelledby="projects-category" data-parent="#content-accordion">
                                            <ul>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/project/create">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> დამატება
                                                        </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="sub-category-action" href="/admin/project/edit">
                                                        <span>
                                                            <span class="dire-right-arrow"></span> რედაქტირება
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endif
                            {{-- Projects --}}
                        </ul>
                    </div>
                </li>
            @endif
        {{-- Content --}}
    </ul>
{{-- Sidebar --}}