<?php

namespace App\Http\Controllers;

// * Included Models
    use App\Models\{Admins, Logs};

    // * Pages
        use App\Models\{Blog, BlogMeta, About, Homepage, Partners, Designer, Repairs, Furniture, Terms,sliderForm, Contact, OrderInfo, CompanyHotline,reciever,Pdf };
        use App\Models\Vip\{VipPage, VipOrders, VipServices};
        use App\Models\Projects\{Projects, ProjectsPage};
        use App\Models\Products\{MarketMeta, ProductCategories, Products};
        use App\Models\Vacancies\{VacanciesPage, VacanciesRegister, Workforce};
        use App\Models\Users\{Users, UserCards, UserAdresses};
    // * Pages
    
    use Illuminate\Support\Str;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Cookie;
    use Illuminate\Support\Facades\Session;
    use App\Http\Controllers\Controller;


    use Jenssegers\Agent\Agent;
// * Included Models

class AdminPagesCT extends AdminCore
{
    public function __construct() {
        parent::__construct();
        $agent = new Agent();

        if ( $agent->isMobile() 
            && Cookie::has('admin_cookie') 
                && Route::currentRouteAction() != 'App\Http\Controllers\AdminPagesCT@vacancies' ) return redirect('/enter/vacancies/workforce')->send();
    }

    public function login() {
        
        if ( Cookie::has('admin.info.logged') ) {
               
            return redirect('/enter');
        } else {
           
            return view('admin.pages.login');
        }
    }
    

    public function landing() {
        $data['misc'] = [];
        return view('admin.pages.landing', compact('data'));
    }

    // * Pages
        // * Singular
            public function homepage() {
                if ( Homepage::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Homepage::find(1)->toArray(), ['slides', 'mob_slides', 'video', 'about']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'homepage'
                ];

                return view('admin.pages.homepage', compact('data'));
            }

            public function administration($action = 'select', $id = null) {
                if ( !in_array($action, ['create', 'edit', 'select']) ) return redirect('/enter');
                
                $data['misc'] = [
                    'sidebar-category' => 'administration',
                    'sidebar-inner' => 'administration-'. $action
                ];

                if ( $action == 'select' ) {
                    $data['admins'] = Admins::where('id', '>', '2')->get()->toArray();
                }elseif ( $action == 'edit' && $id != null ) {
                    $data['admin'] = Admins::find($id);
                }

                return view('admin.pages.administration.'. $action, compact('data'));
            }
            // public function staff_projects($action = 'select', $id = null) {
            //     if ( !in_array($action, ['create', 'edit', 'select']) ) return redirect('/enter');
                
                
            //     $data['misc'] = [
            //         'sidebar-category' => 'staff_projects',
            //         'sidebar-inner' => 'staff_projects_'. $action
            //     ];
                
            //     if ( $action == 'select' ) {
            //         $data['users'] = Users::where('id', '>', '2')->get()->toArray();
            //     }elseif ( $action == 'edit' && $id != null ) {
            //         $data['users'] = Users::find($id);
            //     }

            //     return view('admin.pages.staff_projects.'. $action, compact('data'));
            // }

            public function staff_projects($action = 'select', $id = null) {
                if ( !in_array($action, ['create', 'edit', 'select']) ) return redirect('/enter');
                
                
                $data['misc'] = [
                    'sidebar-category' => 'staff_projects',
                    'sidebar-inner' => 'staff_projects_'. $action
                ];
                
                if ( $action == 'select' ) {
                    $data['admins'] = Admins::where(['category' => 'admin'])->get()->toArray();
                }elseif ( $action == 'edit' && $id != null ) {
                    $data['admins'] = Admins::find($id);
                }

                return view('admin.pages.staff_projects.'. $action, compact('data'));
            }
            public function partners() {
                if ( Partners::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Partners::find(1)->toArray(), ['slides']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'partners'
                ];

                return view('admin.pages.partners', compact('data'));
            }

            public function terms() {
                if ( Terms::where('id', 1)->exists() ) {
                    $data = Terms::find(1)->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'terms'
                ];

                return view('admin.pages.terms', compact('data'));
            }
            public function sliderForm($action=null,$id=null) {
                if ( in_array($action, ['create', 'select', 'edit', 'page']) ) {
                    switch($action){
                        case'select':
                            $data['rows'] = sliderForm::all()->toArray();
                        

                            $data['misc'] = [
                                'sidebar-category' => 'slider-form',
                                'sidebar-inner' => 'select'
                            ];
                            $status=[0=>'standard',1=>'company'];
                            return view('admin.pages.sliderForm.sliderForm', compact('data','status'));
                            break;
                        case 'create':
                            $data['misc'] = [
                                'sidebar-category' => 'slider-form',
                                'sidebar-inner' => 'create'
                            ];
                            return view('admin.pages.sliderForm.create',compact('data'));
                            break;  
                        case 'edit':
                            if ( sliderForm::where('id', $id)->exists() ) {
                                $data['row'] = sliderForm::find($id)->toArray();
                                $data['exists'] = true;
                            } else {
                                $data['exists'] = false;
                            }
                            $data['misc'] = [
                                'sidebar-category' => 'slider-form',
                                'sidebar-inner' => 'select'
                            ];
                            return view('admin.pages.sliderForm.edit',compact('data'));

                                break;   
                        default:
                            $data['rows'] = sliderForm::all()->toArray();
                        

                            $data['misc'] = [
                                'sidebar-category' => 'slider-form',
                                'sidebar-inner' => 'select'
                            ];
                            $status=[0=>'standard',1=>'company'];
                            return view('admin.pages.sliderForm.sliderForm', compact('data','status'));
                            break;
                    }
                }
               
            }
            public function pdf_form($action=null,$id=null) {
                if ( in_array($action, ['create', 'select', 'edit', 'page']) ) {
                    switch($action){
                        case'select':
                            $data['rows'] = Pdf::all()->toArray();
                        

                            $data['misc'] = [
                                'sidebar-category' => 'pdf-form',
                                'sidebar-inner' => 'select'
                            ];
                            $status=[1=>'Active',0=>'Deactive'];
                            return view('admin.pages.pdf.select', compact('data','status'));
                            break;
                        case 'create':
                            $data['misc'] = [
                                'sidebar-category' => 'pdf-form',
                                'sidebar-inner' => 'create'
                            ];
                            return view('admin.pages.pdf.create',compact('data'));
                            break;  
                        case 'edit':
                            if ( Pdf::where('id', $id)->exists() ) {
                                $data['row'] = Pdf::find($id)->toArray();
                                $data['exists'] = true;
                            } else {
                                $data['exists'] = false;
                            }
                            $data['misc'] = [
                                'sidebar-category' => 'pdf-form',
                                'sidebar-inner' => 'select'
                            ];
                            return view('admin.pages.pdf.edit',compact('data'));

                                break;   
                        default:
                            $data['rows'] = Pdf::all()->toArray();
                        

                            $data['misc'] = [
                                'sidebar-category' => 'pdf-form',
                                'sidebar-inner' => 'select'
                            ];
                            $status=[1=>'Active',0=>'Deactive'];
                            return view('admin.pages.pdf.select', compact('data','status'));
                            break;
                    }
                }
               
            }
            public function reciever($action=null,$id=null) {
                if ( in_array($action, ['create', 'select', 'edit', 'page']) ) {
                    switch($action){
                        case'select':
                            $data['rows'] = reciever::all()->toArray();
                        

                            $data['misc'] = [
                                'sidebar-category' => 'reciever-form',
                                'sidebar-inner' => 'select'
                            ];
                            $status=[1=>'Active',0=>'Deactive'];
                            return view('admin.pages.reciever.select', compact('data','status'));
                            break;
                        case 'create':
                            $data['misc'] = [
                                'sidebar-category' => 'reciever-form',
                                'sidebar-inner' => 'create'
                            ];
                            return view('admin.pages.reciever.create',compact('data'));
                            break;  
                        case 'edit':
                            if ( reciever::where('id', $id)->exists() ) {
                                $data['row'] = reciever::find($id)->toArray();
                                $data['exists'] = true;
                            } else {
                                $data['exists'] = false;
                            }
                            $data['misc'] = [
                                'sidebar-category' => 'reciever-form',
                                'sidebar-inner' => 'select'
                            ];
                            return view('admin.pages.reciever.edit',compact('data'));

                                break;   
                        default:
                            $data['rows'] = reciever::all()->toArray();
                        

                            $data['misc'] = [
                                'sidebar-category' => 'reciever-form',
                                'sidebar-inner' => 'select'
                            ];
                            $status=[1=>'Active',0=>'Deactive'];
                            return view('admin.pages.reciever.select', compact('data','status'));
                            break;
                    }
                }
               
            }

            public function vacancies($action = null) {
                switch ($action) {
                    case 'workforce':
                        if ( VacanciesPage::where('id', 1)->exists() ) {
                            $data = $this->decode_data(VacanciesPage::find(1)->toArray(), ['categories', 'sub_categories']);
                            $data['workforce'] = Workforce::where('activated', 'true')->get()->toArray();
                            $data['exists'] = true;
                        } else {
                            $data['exists'] = false;
                        }

                        $data['misc'] = [
                            'sidebar-category' => 'vacancies',
                            'sidebar-inner' => 'workforce',
                        ];

                        return view('admin.pages.vacancies.workforce', compact('data'));
                        break;
                    case 'activate':
                        if ( VacanciesPage::where('id', 1)->exists() ) {
                            $data = $this->decode_data(VacanciesPage::find(1)->toArray(), ['categories', 'sub_categories']);
                            $data['workforce'] = Workforce::where('activated', 'false')->orderBy('type', 'desc')->get()->toArray();
                            $data['exists'] = true;
                        } else {
                            $data['exists'] = false;
                        }

                        $data['misc'] = [
                            'sidebar-category' => 'vacancies',
                            'sidebar-inner' => 'activate',
                        ];

                        return view('admin.pages.vacancies.activate', compact('data'));
                        break;
                    case 'page':
                        if ( VacanciesPage::where('id', 1)->exists() ) {
                            $data = $this->decode_data(VacanciesPage::find(1)->toArray(), ['categories', 'sub_categories']);
                            $data['exists'] = true;
                        } else {
                            $data['exists'] = false;
                        }

                        $data['misc'] = [
                            'sidebar-category' => 'vacancies',
                            'sidebar-inner' => 'page',
                        ];

                        return view('admin.pages.vacancies.page', compact('data'));
                        break;
                    default:
                        return redirect('/enter');
                        break;
                }
            }

            public function vacancies_register() {
                if ( VacanciesRegister::where('id', 1)->exists() ) {
                    $data = VacanciesRegister::find(1)->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'vacancies',
                    'sidebar-inner' => 'register'
                ];

                return view('admin.pages.vacancies.register-modal', compact('data'));
            }

            public function about() {
                if ( About::where('id', 1)->exists() ) {
                    $data = $this->decode_data(About::find(1)->toArray(), ['content', 'links', 'inner_images', 'hr']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'about'
                ];

                return view('admin.pages.about', compact('data'));
            }

            public function vip() {
                if ( VipPage::where('id', 1)->exists() ) {
                    $data = $this->decode_data(VipPage::find(1)->toArray(), ['meta', 'dropdowns_ka', 'dropdowns_it', 'services_ka', 'services_it']);
                    $data['services'] = VipServices::all()->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'vip'
                ];

                // foreach ( $data['services_ka'] as $i => $service ) {
                //     $model = new VipServices;
                //     $model->belongs = $service['belongs'];
                //     $model->slug = $service['id'];
                //     $model->og_slug = $service['id'];
                //     $model->meta_title = $service['text'];
                //     $model->save();
                // }

                return view('admin.pages.vip-master', compact('data'));
            }

            public function vip_services($action = 'create', $belongs = null, $locale = null, $id = null) {
                if ( $action == 'create' ) {
                    if ( $belongs == null ) return redirect('/enter');
                    $data['belongs'] = $belongs;
                    $data['locale'] = $locale;

                    $slugs = [];
                    $og_slugs = [];

                    foreach ( VipServices::all()->toArray() as $slug ) {
                        $slugs[] = $slug['slug'];
                        $og_slugs[] = $slug['og_slug'];
                    }

                    $data['misc'] = [
                        'sidebar-category' => 'pages',
                        'sidebar-inner' => 'vip',
                        'slug-check' => true,
                        'slugs' => $slugs,
                        'og_slugs' => $og_slugs
                    ];

                    return view('admin.pages.vip-services.create', compact('data'));
                } elseif ( $action == 'edit' && $id != null ) {
                    $data = VipServices::find($id)->toArray();

                    $slugs = [];
                    $og_slugs = [];

                    foreach ( VipServices::all()->toArray() as $slug ) {
                        $slugs[] = $slug['slug'];
                    }
                    
                    $data['misc'] = [
                        'sidebar-category' => 'pages',
                        'sidebar-inner' => 'vip',
                        'slug-check' => true,
                        'slugs' => $slugs,
                        'og_slugs' => $og_slugs
                    ];

                    return view('admin.pages.vip-services.edit', compact('data'));
                } else {
                    return redirect('/enter');
                }

            }

            public function designer() {
                if ( Designer::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Designer::find(1)->toArray(), ['banner_text', 'content', 'tabs', 'render']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'designer'
                ];

                return view('admin.pages.services.designer', compact('data'));
            }

            public function repairs() {
                if ( Repairs::where('id', 1)->exists() ) {
                    $raw = Repairs::find(1);
                    $data = $this->decode_data($raw->toArray(), ['banner_text', 'content', 'middle', 'bottom']);
                    $data['content']['invoice_price_low'] = $raw->invoice_price_low;
                    $data['content']['invoice_price_high'] = $raw->invoice_price_high;
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'repairs'
                ];

                return view('admin.pages.services.repairs', compact('data'));
            }

            public function furniture() {
                if ( Furniture::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Furniture::find(1)->toArray(), ['banner_text', 'content', 'bottom']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'furniture'
                ];

                return view('admin.pages.services.furniture', compact('data'));
            }

            public function contact() {
                if ( Contact::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Contact::find(1)->toArray(), ['services']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'contact'
                ];

                return view('admin.pages.contact', compact('data'));
            }

            public function orders( $action = null ) {
                if ( $action == null || !in_array($action, ['vip']) ) return redirect('/enter');
                $data['orders'] = VipOrders::all()->toArray();

                if ( VipPage::where('id', 1)->exists() ) {
                    $data['vip_page'] = VipPage::find(1)->toArray();
                    $data['vip_page']['services'] = VipServices::all()->toArray();
                    $data['vip_page']['exists'] = true;
                } else {
                    $data['vip_page']['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'orders',
                    'sidebar-inner' => 'vip-orders'
                ];

                return view('admin.pages.orders.main', compact('data'));
            }

            public function order_info() {
                if ( OrderInfo::where('id', 1)->exists() ) {
                    $data = $this->decode_data(OrderInfo::find(1)->toArray(), ['cities', 'regions', 'dates', 'time_frames']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'order-info'
                ];

                return view('admin.pages.orders.order-info', compact('data'));
            }

            public function company_hotline() {
                if ( CompanyHotline::where('id', 1)->exists() ) {
                    $data = CompanyHotline::where('id', 1)->get()->first()->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'pages',
                    'sidebar-inner' => 'company-hotline'
                ];

                return view('admin.pages.company-hotline', compact('data'));
            }
        // * Singular

        // * Content
            // * Blog
                public function blog( $action = 'create', $id = null ) {
                    if ( in_array($action, ['create', 'select', 'edit', 'page']) ) {
                        switch ($action) {
                            case 'create':
                                $slugs = [];
                                $og_slugs = [];

                                foreach ( Blog::all()->toArray() as $slug ) {
                                    $slugs[] = $slug['slug'];
                                    $og_slugs[] = $slug['og_slug'];
                                }

                                $data['misc'] = [
                                    'sidebar-category' => 'blog',
                                    'sidebar-inner' => 'create',
                                    'slug-check' => true,
                                    'slugs' => $slugs,
                                    'og_slugs' => $og_slugs
                                ];

                                return view('admin.pages.blog.create', compact('data'));
                                break;
                            case 'edit':
                                if ( Blog::where('id', $id)->exists() ) {
                                    if ( json_decode(Cookie::get('admin_cookie'))->info->category != 'admin' ) {
                                        if ( Blog::find($id)->author_id !== json_decode(Cookie::get('admin_cookie'))->info->id && (strtotime('now') - strtotime(Blog::find($id)->created_at)) > 172800 ) {
                                            return redirect('/enter');
                                        }
                                    }

                                    $slugs = [];
                                    $og_slugs = [];

                                    foreach ( Blog::all()->toArray() as $slug ) {
                                        $slugs[] = $slug['slug'];
                                        $og_slugs[] = $slug['og_slug'];
                                    }

                                    $data['misc'] = [
                                        'sidebar-category' => 'blog',
                                        'sidebar-inner' => 'select',
                                        'slug-check' => true,
                                        'slugs' => $slugs,
                                        'og_slugs' => $og_slugs,
                                    ];

                                    $data['raw'] = Blog::find($id)->toArray();

                                    return view('admin.pages.blog.edit', compact('data'));
                                } else {
                                    return redirect('/enter');
                                }
                                break;
                            case 'select':
                                if ( json_decode(Cookie::get('admin_cookie'))->info->category == 'admin' ) {
                                    $data['articles'] = Blog::all()->toArray();
                                } else {
                                    $data['articles'] = Blog::where('author_id', json_decode(Cookie::get('admin_cookie'))->info->id)->get()->toArray();
                                    $article_date_filter = [];
                                    foreach ($data['articles'] as $article) {
                                        if ( (strtotime('now') - strtotime($article['created_at'])) < 172800 ) $article_date_filter[] = $article;
                                    }
                                    $data['articles'] = $article_date_filter;
                                }

                                $data['misc'] = [
                                    'sidebar-category' => 'blog',
                                    'sidebar-inner' => 'select',
                                ];

                                return view('admin.pages.blog.select', compact('data'));
                                break;
                            case 'page':
                                if ( BlogMeta::where('id', 1)->exists() ) {
                                    $data = BlogMeta::find(1)->toArray();
                                    $data['exists'] = true;
                                } else {
                                    $data['exists'] = false;
                                }

                                $data['misc'] = [
                                    'sidebar-category' => 'blog',
                                    'sidebar-inner' => 'page',
                                ];

                                return view('admin.pages.blog.page', compact('data'));
                                break;
                            default:
                                return redirect('/enter');
                                break;
                        }
                    } else {
                        return redirect('/enter');
                    }
                }
            // * Blog

            // * Projects
                public function projects( $action = 'create', $id = null ) {
                    if ( in_array($action, ['create', 'select', 'edit', 'edit-page']) ) {
                        switch ($action) {
                            case 'create':
                                $data['misc'] = [
                                    'sidebar-category' => 'projects',
                                    'sidebar-inner' => 'create'
                                ];

                                return view('admin.pages.projects.create', compact('data'));
                                break;
                            case 'edit':
                                if ( Projects::where('id', $id)->exists() ) {
                                    $data = $this->decode_data(Projects::find($id)->toArray(), ['card_image', 'card_info', 'title', 'banner', 'information', 'categories', 'sections', 'section_items']);

                                    $data['misc'] = [
                                        'sidebar-category' => 'projects',
                                        'sidebar-inner' => 'select'
                                    ];

                                    if ( $data['section_items'] != [] ) {
                                        $data['last_item_num'] = end($data['section_items'])['item-number'];
                                    } else {
                                        $data['last_item_num'] = 0;
                                    }

                                    return view('admin.pages.projects.edit', compact('data'));
                                } else {
                                    return redirect('/enter');
                                }
                                break;
                            case 'select':
                                $data['misc'] = [
                                    'sidebar-category' => 'projects',
                                    'sidebar-inner' => 'select'
                                ];

                                $data['projects'] = Projects::orderBy('id','DESC')->get()->toArray();
                                // var_dump($data['projects']);
                                // exit;
                                return view('admin.pages.projects.select', compact('data'));
                                break;
                            case 'edit-page':
                                $data['misc'] = [
                                    'sidebar-category' => 'projects',
                                    'sidebar-inner' => 'update-page',
                                ];

                                if ( ProjectsPage::where('id', 1)->exists() ) {
                                    $data['raw'] = ProjectsPage::find(1)->toArray();
                                    $data['exists'] = true;
                                } else {
                                    $data['exists'] = false;
                                }

                                return view('admin.pages.projects.edit-page', compact('data'));
                                break;
                            default:
                                return redirect('/enter');
                                break;
                        }
                    } else {
                        return redirect('/enter');
                    }
                }
            // * Projects
        // * Content

        // * Market
            public function product_categories() {
                if ( ProductCategories::where('id', 1)->exists() ) {
                    $data = $this->decode_data(ProductCategories::find(1)->toArray(), ['main', 'groups', 'sub_groups']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $data['misc'] = [
                    'sidebar-category' => 'market',
                    'sidebar-inner' => 'product-categories',
                ];

                return view('admin.pages.market.product-categories', compact('data'));
            }

            public function market_product( $action = 'create', $id = null, Request $request ) {
                if ( in_array($action, ['create', 'select', 'edit']) ) {
                    if ( ProductCategories::where('id', 1)->exists() ) {
                        $product_categories = $this->decode_data(ProductCategories::find(1)->toArray(), ['main', 'groups', 'sub_groups']);
                        $product_categories['exists'] = true;
                    } else {
                        return redirect('admin/product-categories');
                    }

                    switch ($action) {
                        case 'create':
                            foreach ( Products::all()->toArray() as $slug ) {
                                $slugs[] = $slug['slug'];
                                $og_slugs[] = $slug['og_slug'];
                            }
                            $data['misc'] = [
                                'sidebar-category' => 'market',
                                'sidebar-inner' => 'market-create',
                                'slug-check' => true,
                                'slugs' => $slugs,
                                'og_slugs' => $og_slugs
                            ];

                            return view('admin.pages.market.create', compact('data', 'product_categories'));
                            break;
                        case 'edit':
                            foreach ( Products::all()->toArray() as $slug ) {
                                $slugs[] = $slug['slug'];
                                $og_slugs[] = $slug['og_slug'];
                            }
                            $data['misc'] = [
                                'sidebar-category' => 'market',
                                'sidebar-inner' => 'market-select',
                                'slug-check' => true,
                                'slugs' => $slugs,
                                'og_slugs' => $og_slugs
                            ];

                            $data['product'] = Products::find($id)->toArray();

                            return view('admin.pages.market.edit', compact('data', 'product_categories'));
                            break;
                        case 'select':
                            if ( $request->has('category') && !$request->has('group') ) return redirect('/enter');
                            if ( $request->has('group') ) {
                                if ( Session::has('market.group') ) if ( Session::get('market.group') != $request->group ) Session::forget('market.filters');
                                Session::put('market.group', $request->group);
                            }
                            if ( $request->has('category') ) {
                                if ( Session::has('market.category') ) if ( Session::get('market.category') != $request->category ) Session::forget('market.filters');
                                Session::put('market.category', $request->category);
                            }
                            
                            $product_categories = $this->getProductCategories();

                            $get_data = [
                                'has_group' => false,
                                'has_category' => false,
                                'group' => null,
                                'category' => null
                            ];

                            if ( $request->has('group') ) {
                                foreach ( $product_categories['groups'] as $group ) {
                                    if ( $group['has'] == $request->group ) {
                                        $get_data['has_group'] = true;
                                        $get_data['group'] = $request->group;
                                        $get_data['current_group_name'] = $group['title'];
                                    }
                                }

                                if ( $request->has('category') ) {
                                    foreach ( $product_categories['sub_groups'] as $sub_groups ) {
                                        if ( $sub_groups['search_id'] == $request->category ) {
                                            $get_data['has_category'] = true;
                                            $get_data['category'] = $request->category;
                                            $get_data['current_category_name'] = $sub_groups['title'];
                                        }
                                    }
                                }
                            }

                            // * Sorting
                                if ( Session::has('market.amount') ) {
                                    $paginate_for = Session::get('market.amount');
                                } else {
                                    $paginate_for = 16;
                                }

                                if ( Session::has('market.sort') ) {
                                    $sort_by = Session::get('market.sort');
                                } else {
                                    $sort_by = 'desc';
                                }
                            // * Sorting

                            // * Products
                                $query = [['id', '!=', 'null']];
                                
                                if ( $request->has('group') )       $query = [['belongs_category', $get_data['group']]];
                                if ( $request->has('category') )    $query[] = ['belongs_sub_category', $get_data['category']];

                                if ( Session::has('market.price-range-min') ) {
                                    $query[] = ['price', '>=', Session::get('market.price-range-min')];
                                    $query[] = ['price', '<=', Session::get('market.price-range-max')];
                                }

                                // * This is for Filters too 
                                    $filters['checked'] = [];

                                    if ( Session::has('market.filters.country') && Session::get('market.filters.country') != [] 
                                            || Session::has('market.filters.brand') && Session::get('market.filters.brand') != [] ) {
                                        $query_filters = [
                                            'country' => [],
                                            'brand' => []
                                        ];

                                        foreach ( ['country', 'brand'] as $keyword ) {
                                            if ( Session::has('market.filters.'. $keyword) ) {
                                                foreach ( Session::get('market.filters.'. $keyword) as $checked_filters ) {
                                                    $query_filters[$keyword][] = $checked_filters;
                                                    $filters['checked'][] = $checked_filters;
                                                }
                                            }
                                        }

                                        if ( $query_filters['country'] != [] && $query_filters['brand'] != [] ) {
                                            $products = Products::where($query)->whereIn('country', $query_filters['country'])->whereIn('brand', $query_filters['brand']->orderBy('brand', 'asc'))->orderBy('price', $sort_by)->paginate($paginate_for);
                                        } elseif ( $query_filters['country'] != [] ) {
                                            $products = Products::where($query)->whereIn('country', $query_filters['country'])->orderBy('brand', 'asc')->orderBy('price', $sort_by)->paginate($paginate_for);
                                        } elseif ( $query_filters['brand'] != [] ) {
                                            $products = Products::where($query)->whereIn('brand', $query_filters['brand'])->orderBy('brand', 'asc')->orderBy('price', $sort_by)->paginate($paginate_for);
                                        }
                                    } else {
                                        $products = Products::where($query)->orderBy('brand', 'asc')->orderBy('price', $sort_by)->paginate($paginate_for);
                                    }
                                // * This is for Filters too
                            // * Products

                            // * Filters
                                $filters['general'] = [
                                    'country' => [],
                                    'brand' => []
                                ];

                                foreach ( Products::where($query)->get()->toArray() as $index => $product ) {
                                    $filters['general']['country'][] = $product['country'];
                                    $filters['general']['brand'][] = $product['brand'];
                                }

                                $filters['general']['country'] = array_unique($filters['general']['country']);
                                $filters['general']['brand'] = array_unique($filters['general']['brand']);
                            // * Filters

                            $data['misc'] = [
                                'sidebar-category' => 'market',
                                'sidebar-inner' => 'market-select'
                            ];

                            if ( MarketMeta::where('id', 1)->exists() ) {
                                $data['meta'] = MarketMeta::find(1)->toArray();
                                $data['meta']['exists'] = true;
                            } else {
                                $data['meta']['exists'] = false;
                            }

                            return view('admin.pages.market.select', compact('data', 'product_categories', 'get_data', 'products', 'filters'));
                            break;
                    }
                } else {
                    return redirect('/enter');
                }
            }
        // * Market
    // * Pages
    
    // * Ajax
        public function create_vip_item(Request $request) {
            if ( $request->ajax() ) {
                
            }
            return;
        }
    // * Ajax
}