@php
    use App\Http\Controllers\HelpersCT;
@endphp

<ul class="admin-panel-sidebar d-fc accordion" id="admin-sidebar-accordion">
    {{-- Content --}}
        @if ( Session::has('admin.can_write.content') || HelpersCT::is_admin() )
            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#administration-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'market')) ? 'true' : 'false' }}" aria-controls="administration-category">
                    <span>
                        <span class="dire-edit"></span> ბლოგის მომხმარებლები
                    </span>
                    <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'administration')) ? 'show' : '' }}" id="administration-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        @if (HelpersCT::is_admin())
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'administration-create')) ? 'disabled' : '' }}" href="/enter/administration/create">
                                    <span><span class="dire-right-arrow"></span> ბლოგერის დამატება</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'administration-select')) ? 'disabled' : '' }}" href="/enter/administration/select">
                                    <span><span class="dire-right-arrow"></span> ბლოგერის რედაქტირება</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#staff_projects-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'staff_projects')) ? 'true' : 'false' }}" aria-controls="administration-category">
                    <span>
                        <span class="dire-edit">  <span class="edit-text"><a class="sub-category-action" href="/enter/staff_projects/select"> ადმინები</a></span></span>
                    </span> 
                    <!--<span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'staff_projects')) ? 'show' : '' }}" id="staff_projects-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        @if (HelpersCT::is_admin())
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'staff_projects_create')) ? 'disabled' : '' }}" href="/enter/staff_projects/create">
                                    <span><span class="dire-right-arrow"></span> შექმნა</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'staff_projects_select')) ? 'disabled' : '' }}" href="/enter/staff_projects/select">
                                    <span><span class="dire-right-arrow"></span> რედაქტირება</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>-->
            </li>
            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#market-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'market')) ? 'true' : 'false' }}" aria-controls="market-category">
                    <span>
                        <span class="dire-edit"></span> მარკეტი
                    </span>
                    <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'market')) ? 'show' : '' }}" id="market-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        @if (HelpersCT::is_admin())
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'market-create')) ? 'disabled' : '' }}" href="/enter/product/create">
                                    <span><span class="dire-right-arrow"></span> პროდუქტის დამატება</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'market-select')) ? 'disabled' : '' }}" href="/enter/product/select">
                                    <span><span class="dire-right-arrow"></span> პროდუქტის რედაქტირება</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'product-categories')) ? 'disabled' : '' }}" href="/enter/product-categories">
                                    <span><span class="dire-right-arrow"></span> კატეგორიები</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>

            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#vacancies-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'vacancies')) ? 'true' : 'false' }}" aria-controls="vacancies-category">
                    <span>
                        <span class="dire-edit"></span> ვაკანსიები
                    </span>
                    <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'vacancies')) ? 'show' : '' }}" id="vacancies-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        @if (HelpersCT::is_admin())
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'workforce')) ? 'disabled' : '' }}" href="/enter/vacancies/workforce">
                                    <span><span class="dire-right-arrow"></span> სამუშაო ბაზა</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'activate')) ? 'disabled' : '' }}" href="/enter/vacancies/activate">
                                    <span><span class="dire-right-arrow"></span> ვაკანსიების გააქტიურება</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'page')) ? 'disabled' : '' }}" href="/enter/vacancies/page">
                                    <span><span class="dire-right-arrow"></span> ვაკანსიების გვერდი</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'register')) ? 'disabled' : '' }}" href="/enter/vacancies-register">
                                    <span><span class="dire-right-arrow"></span> როგორ დავრეგისტრირდე</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>

            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#pages-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'pages')) ? 'true' : 'false' }}" aria-controls="pages-category">
                    <span>
                        <span class="dire-edit"></span> გვერდები
                    </span>
                    <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'pages')) ? 'show' : '' }}" id="pages-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'homepage')) ? 'disabled' : '' }}" href="/enter/homepage">
                                <span><span class="dire-right-arrow"></span> მთავარი გვერდი</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'about')) ? 'disabled' : '' }}" href="/enter/about">
                                <span><span class="dire-right-arrow"></span> ჩვენს შესახებ</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'designer')) ? 'disabled' : '' }}" href="/enter/designer">
                                <span><span class="dire-right-arrow"></span> დიზაინერი</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'repairs')) ? 'disabled' : '' }}" href="/enter/repairs">
                                <span><span class="dire-right-arrow"></span> რემონტი</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'furniture')) ? 'disabled' : '' }}" href="/enter/furniture">
                                <span><span class="dire-right-arrow"></span> ავეჯის დამზადება</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'vip')) ? 'disabled' : '' }}" href="/enter/vip-master">
                                <span><span class="dire-right-arrow"></span> VIP - მასტერი</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'contact')) ? 'disabled' : '' }}" href="/enter/contact">
                                <span><span class="dire-right-arrow"></span> კონტაქტი</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'partners')) ? 'disabled' : '' }}" href="/enter/partners">
                                <span><span class="dire-right-arrow"></span> პარტნიორები</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'terms')) ? 'disabled' : '' }}" href="/enter/terms">
                                <span><span class="dire-right-arrow"></span> წესები და პირობები</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'order-info')) ? 'disabled' : '' }}" href="/enter/order-info">
                                <span><span class="dire-right-arrow"></span> შეკვეთების ინფორმაცია(თარიღები)</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'company-hotline')) ? 'disabled' : '' }}" href="/enter/company-hotline">
                                <span><span class="dire-right-arrow"></span> საიტის ტელეფონის ნომერი</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#orders-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'orders')) ? 'true' : 'false' }}" aria-controls="orders-category">
                    <span>
                        <span class="dire-edit"></span> შეკვეთები
                    </span>
                    <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'orders')) ? 'show' : '' }}" id="orders-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        <li>
                            <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'vip-orders')) ? 'disabled' : '' }}" href="/enter/orders/vip">
                                <span><span class="dire-right-arrow"></span> ვიპ-მასტერი</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#projects-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'projects')) ? 'true' : 'false' }}" aria-controls="projects-category">
                    <span>
                        <span class="dire-edit"><span class="edit-text"><a class="sub-category-action" href="/enter/projects/select"> ნამუშევრები</a></span></span> 
                    </span>
                <!--    <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'projects')) ? 'show' : '' }}" id="projects-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        {{-- Projects --}}
                            @if (HelpersCT::is_admin())
                                <li>
                                    <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'create')) ? 'disabled' : '' }}" href="/enter/projects/select">
                                        <span><span class="dire-right-arrow"></span> დამატება</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'select')) ? 'disabled' : '' }}" href="/enter/projects/select">
                                        <span><span class="dire-right-arrow"></span> რედაქტირება</span>
                                    </a>
                                </li>
                                <!-- <li>
                                    <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'update-page')) ? 'disabled' : '' }}" href="/enter/projects/edit-page">
                                        <span><span class="dire-right-arrow"></span> გვერდის რედაქტირება</span>
                                    </a>
                                </li> 
                            @endif
                        {{-- Projects --}}
                    </ul>
                </div> 
            </li> -->
        @endif 

            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#blog-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'blog')) ? 'true' : 'false' }}" aria-controls="blog-category">
                    <span>
                        <span class="dire-edit"></span> ბლოგი
                    </span>
                    <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'blog')) ? 'show' : '' }}" id="blog-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        {{--Blog --}}
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'create')) ? 'disabled' : '' }}" href="/enter/blog/create">
                                    <span><span class="dire-right-arrow"></span> დამატება</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'select')) ? 'disabled' : '' }}" href="/enter/blog/select">
                                    <span><span class="dire-right-arrow"></span> რედაქტირება</span>
                                </a>
                            </li>
                            @if (HelpersCT::is_admin())
                                <li>
                                    <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'page')) ? 'disabled' : '' }}" href="/enter/blog/page">
                                        <span><span class="dire-right-arrow"></span> გარე გვერდის სეო</span>
                                    </a>
                                </li>
                            @endif
                        {{--Blog --}}
                    </ul>
                </div>
            </li>
            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#slider-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'slider-form')) ? 'true' : 'false' }}" aria-controls="blog-category">
                    <span>
                        <span class="dire-edit"><span class="edit-text"><a class="sub-category-action" href="/enter/slider-form/select"> კონსულტაციის ფორმა </a><span><span> 
                    </span>
                    <!-- <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'slider-form')) ? 'show' : '' }}" id="slider-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        {{--Slider Form--}}
                        @if (HelpersCT::is_admin())
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'create')) ? 'disabled' : '' }}" href="/enter/slider-form/create">
                                    <span><span class="dire-right-arrow"></span> დამატება</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'select')) ? 'disabled' : '' }}" href="/enter/slider-form/select">
                                    <span><span class="dire-right-arrow"></span> რედაქტირება</span>
                                </a>
                            </li>
                            
                                
                            @endif 
                        {{--Slider Form --}}
                    </ul>
                </div>
            </li> -->

            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#reciever-form-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'reciever-form')) ? 'true' : 'false' }}" aria-controls="blog-category">
                    <span>
                        <span class="dire-edit"><span class="edit-text"><a class="class="sub-category-action" href="/enter/reciever-form/select"> ფორმის მიმღები </a></span></span>
                    </span>
                   <!-- <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'reciever-form')) ? 'show' : '' }}" id="reciever-form-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        {{--Reciever Form--}}
                        @if (HelpersCT::is_admin())
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'create')) ? 'disabled' : '' }}" href="/enter/reciever-form/create">
                                    <span><span class="dire-right-arrow"></span> დამატება</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'select')) ? 'disabled' : '' }}" href="/enter/reciever-form/select">
                                    <span><span class="dire-right-arrow"></span> რედაქტირება</span>
                                </a>
                            </li>
                            
                                
                            @endif
                        {{--Reciever Form--}}
                    </ul>
                </div>
            </li> -->

            <li class="category d-fc">
                <button class="category-button waves-button" type="button" data-toggle="collapse" data-target="#pdf-form-category" aria-expanded="{{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'pdf-form')) ? 'true' : 'false' }}" aria-controls="blog-category">
                    <span>
                        <span class="dire-edit"><span class="edit-text"><a class="sub-category-action" href="/enter/pdf-form/select">Pdf ტექსტი</a></span></span> 
                    </span>
                   <!-- <span class="dire-right-arrow"></span>
                </button>

                <div class="collapse {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-category', 'pdf-form')) ? 'show' : '' }}" id="pdf-form-category" aria-labelledby="content-category" data-parent="#admin-sidebar-accordion">
                    <ul class="accordion" id="content-accordion">
                        {{--pdf Form--}}
                        @if (HelpersCT::is_admin())
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'create')) ? 'disabled' : '' }}" href="/enter/pdf-form/create">
                                    <span><span class="dire-right-arrow"></span> დამატება</span>
                                </a>
                            </li>
                            <li>
                                <a class="sub-category-action {{ (HelpersCT::phantom_var($data['misc'], 'sidebar-inner', 'select')) ? 'disabled' : '' }}" href="/enter/pdf-form/select">
                                    <span><span class="dire-right-arrow"></span> რედაქტირება</span>
                                </a>
                            </li>
                            
                                
                            @endif
                        {{--pdf Form--}}
                    </ul>
                </div>
            </li> -->
    {{-- Content --}}
</ul>