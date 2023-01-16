<?php
namespace App\Http\Controllers;

// * Included Models
    // * Pages
        use App\Models\{SpecialImages, HomepageSlides, Partners, Contact, Offers, Projects, Admins};
        use App\Models\AboutUs\{AboutUsText, AboutUsTeam};
        use App\Models\Articles\{Articles, ArticleSections};
        use App\Models\Vacancies\{VacanciesG, VacanciesGI, VacanciesSG, VacanciesSGI, VacanciesS};
        use App\Models\Services\Consultation;
        use App\Models\Services\Design\{DesignContent, DesignSlides, DesignBottomText};
        use App\Models\Services\Repairs\{RepairsSlides, RepairsPrices, RepairsCategory, RepairsSubCategory, RepairsSubCategoryText};
        use App\Models\Services\Furniture\{FurnitureSlides, FurnitureContent, FurnitureMaterialsContent, FurnitureMaterialsCatalogue, FurnitureGallery};
        use App\Models\Services\VIPMaster\{VIPMasterServices, VIPMasterSubCategories};
        use App\Models\Services\Cleaning\{CleaningTopServices, CleaningBottomServices};
    // * Pages

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Facades\Cookie;
    use Illuminate\Support\Facades\Session;
// * Included Models

class PagesCT extends HelpersCT
{
    private $projects_categories    = ['all', 'design', 'repairs', 'furniture'];
    private $articles_categories    = ['all', 'design', 'repairs', 'furniture', 'cleaning'];
    private $offers_categories      = ['all', 'materials', 'design', 'repairs', 'furniture', 'cleaning'];

    // * Pages
        public function locale($locale) {
            if ( in_array($locale, ['ka', 'en']) ) {
                session([ 'locale' => $locale ]);
            }
            
            return redirect()->back();
        }

        public function homepage() {
            $data = [
                'slides'        => HomepageSlides::all()->toArray(),
                'advert'        => SpecialImages::where('location', 'homepage')->get()->toArray(),
                'partners'      => Partners::all()->toArray(),
            ];
            $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
            $articles = Articles::where([['soft_delete', '!=' , 'true'], ['verification', 'verified'], ['locale', Session::get('locale')]])->latest()->take(5)->get()->toArray();
            $articles = $this->remove_time($articles);
            return view('user.pages.homepage', compact('data', 'offers', 'articles'));
        }

        public function about_us($page = 'company') {
            $data = [
                'text'          => AboutUsText::where('locale', Session::get('locale'))->get()->toArray(),
                'team'          => AboutUsTeam::where('locale', Session::get('locale'))->get()->toArray(),
                'page'          => $page,
            ];
            $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
            return view('user.pages.about-us', compact('data','offers'));
        }

        public function vacancies() {
            $data = [
                'employees'             => VacanciesS::where('type', 'employee')->get()->toArray(),
                'legal_entities'        => VacanciesS::where('type', 'legal_entity')->get()->toArray(),
                'employees_banner'      => SpecialImages::where('location', 'employee')->get()->toArray(),
                'legal_entities_banner' => SpecialImages::where('location', 'legal_entity')->get()->toArray(),
                'G'                     => VacanciesG::all()->toArray(),
                'GI'                    => VacanciesGI::all()->toArray(),
                'SG'                    => VacanciesSG::all()->toArray(),
                'SGI'                   => VacanciesSGI::all()->toArray()
            ];
            $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
            return view('user.pages.vacancies', compact('data', 'offers'));
        }

        public function contact() {
            $data = [
                'design'        => Contact::where('belongs', 'design')->get()->toArray(),
                'repairs'       => Contact::where('belongs', 'repairs')->get()->toArray(),
                'furniture'     => Contact::where('belongs', 'furniture')->get()->toArray(),
                'cleaning'      => Contact::where('belongs', 'cleaning')->get()->toArray(),
            ];

            $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
            return view('user.pages.contact', compact('data', 'offers'));
        }

        public function contact_send() {
            return redirect()->back()->with(['not_ready' => true]);
        }

        public function payment() { 
            $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
            return view('user.pages.payment', compact('offers')); 
        }

        public function delivery() {
            $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
            return view('user.pages.delivery', compact('offers'));
        }

        public function supplier() {
            $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
            return view('user.pages.supplier', compact('offers'));
        }

        //* Services
            public function consultation() {
                $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
                $data = [
                    'services' => Consultation::all()->toArray(),
                ];
                return view('user.pages.services.consultation', compact('data', 'offers'));
            }

            public function design() {
                $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
                $data = [
                    'slides'            => DesignSlides::all()->toArray(),
                    'advert'            => SpecialImages::where('location', 'design_advert')->get()->toArray(),
                    'design_left_pic'   => SpecialImages::where('location', 'design_left_pic')->get()->toArray(),
                    'design_right_pic'  => SpecialImages::where('location', 'design_right_pic')->get()->toArray(),
                    'content'           => DesignContent::where('locale', Session::get('locale'))->get()->toArray(),
                    'bottom_text'       => DesignBottomText::where('locale', Session::get('locale'))->get()->toArray(),
                ];
                return view('user.pages.services.design', compact('data', 'offers'));
            }

            public function repairs() {
                $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
                $data = [
                    'slides'         => RepairsSlides::all()->toArray(),
                    'advert'        => SpecialImages::where('location', 'repairs')->get()->toArray(),
                    'prices'         => RepairsPrices::where('locale', Session::get('locale'))->get()->toArray(),
                    'category'       => RepairsCategory::where('locale', Session::get('locale'))->get()->toArray(),
                    'sub_category' => [
                            'first'  => RepairsSubCategory::where([['locale', Session::get('locale')], ['belongs', 'first']])->get()->toArray(),
                            'second' => RepairsSubCategory::where([['locale', Session::get('locale')], ['belongs', 'second']])->get()->toArray(),
                            'third'  => RepairsSubCategory::where([['locale', Session::get('locale')], ['belongs', 'third']])->get()->toArray(),
                    ],
                    'sub_category_text' => RepairsSubCategoryText::where([['locale', Session::get('locale')]])->get()->toArray(),
                ];
                return view('user.pages.services.repairs', compact('data', 'offers'));
            }

            public function furniture() {
                $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')], ['category', 'furniture']])->latest()->take(3)->get()->toArray();
                $articles = Articles::where([['soft_delete', '!=' , 'true'], ['verification', 'verified'], ['locale', Session::get('locale')], ['category', 'furniture']])->latest()->take(5)->get()->toArray();
                $articles = $this->remove_time($articles);
                $data = [
                    'partners'  => Partners::all()->toArray(),
                    'slides'    => FurnitureSlides::all()->toArray(),
                    'advert'        => SpecialImages::where('location', 'furniture')->get()->toArray(),
                    'content'   => FurnitureContent::where('locale', Session::get('locale'))->get()->toArray(),
                ];
                return view('user.pages.services.furniture', compact('data', 'offers', 'articles'));
            }

            public function furniture_materials() {
                $data = [
                    'partners'  => Partners::all()->toArray(),
                    'content'   => FurnitureMaterialsContent::where('locale', Session::get('locale'))->get()->toArray(),
                    'catalogue' => FurnitureMaterialsCatalogue::where('locale', Session::get('locale'))->get()->toArray(),
                ];
                return view('user.pages.services.furniture-materials', compact('data'));
            }

            public function furniture_gallery($category = 'kitchen') {
                $categories = ['kitchen','sleeping_room','reception','childrens_room','office_furniture','soft_furniture'];
                if ( in_array($category, $categories) ) {
                    $data = [
                        'category' => $category,
                        'gallery' => FurnitureGallery::where('category', $category)->get()->toArray(),
                    ];
                    return view('user.pages.services.furniture-gallery', compact('data'));
                } else {
                    redirect()->back();
                }
            }

            public function vip_master() {
                $data = [
                    'services'      => VIPMasterServices::all()->toArray(),
                    'categories'    => [
                        'door-window'       => VIPMasterSubCategories::where('belongs', 'door-window')->get()->toArray(),
                        'electricity'       => VIPMasterSubCategories::where('belongs', 'electricity')->get()->toArray(),
                        'pipes'             => VIPMasterSubCategories::where('belongs', 'pipes')->get()->toArray(),
                        'water-supply'      => VIPMasterSubCategories::where('belongs', 'water-supply')->get()->toArray(),
                        'conditioning'      => VIPMasterSubCategories::where('belongs', 'conditioning')->get()->toArray(),
                        'house-technic'     => VIPMasterSubCategories::where('belongs', 'house-technic')->get()->toArray(),
                        'universal'         => VIPMasterSubCategories::where('belongs', 'universal')->get()->toArray(),
                    ],
                ];
                
                $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')], ['category', 'furniture']])->latest()->take(3)->get()->toArray();

                return view('user.pages.services.vip-master', compact('data', 'offers'));
            }

            public function cleaning() {
                $data = [
                    'top_services' => [
                        'after-renovation'      => CleaningTopServices::where('belongs', 'after-renovation')->get()->toArray(),
                        'during-renovation'     => CleaningTopServices::where('belongs', 'during-renovation')->get()->toArray(),
                        'facade-cleaning'       => CleaningTopServices::where('belongs', 'facade-cleaning')->get()->toArray(),
                        'window-cleaning'       => CleaningTopServices::where('belongs', 'window-cleaning')->get()->toArray(),
                        'every-day-cleaning'    => CleaningTopServices::where('belongs', 'every-day-cleaning')->get()->toArray(),
                        'complex-cleaning'      => CleaningTopServices::where('belongs', 'complex-cleaning')->get()->toArray(),
                        'cleaner-woman'         => CleaningTopServices::where('belongs', 'cleaner-woman')->get()->toArray(),
                    ],

                    'bottom_services'    => CleaningBottomServices::all()->toArray(),
                ];
                
                $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')], ['category', 'cleaning']])->latest()->take(3)->get()->toArray();

                return view('user.pages.services.cleaning', compact('data', 'offers'));
            }
        //* Services
    // * Pages

    // * Articles/Offers/Projects
        // * Articles
            public function articles() {
                if ( Session::has('user.categories.articles') ) {
                    $category = Session::get('user.categories.articles');
                } else {
                    $category = 'all';
                }
                
                if ( $category != 'all' && in_array($category, $this->articles_categories)) {
                    $query_articles    = [['soft_delete', '!=' , 'true'], ['verification', 'verified'], ['locale', Session::get('locale')], ['category', $category]];
                    $query_offers      = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')], ['category', $category]];
                } elseif ( $category == 'all' ) {
                    $query_articles    = [['soft_delete', '!=' , 'true'], ['verification', 'verified'], ['locale', Session::get('locale')]];
                    $query_offers      = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]];
                } else {
                    $category = 'all';
                    $query_articles    = [['soft_delete', '!=' , 'true'], ['verification', 'verified'], ['locale', Session::get('locale')]];
                    $query_offers      = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]];
                }

                $articles   = Articles::where($query_articles)->get()->toArray();
                $offers     = Offers::where($query_offers)->latest()->take(3)->get()->toArray();

                $articles = $this->remove_time($articles);

                return view('user.pages.articles.articles', compact('category', 'articles', 'offers'));
            }

            public function article($slug) {
                $articles = Articles::where([['soft_delete', '!=' , 'true'], ['verification', 'verified'], ['locale', Session::get('locale')]])->latest()->take(5)->get()->toArray();
                $article = Articles::where('slug', $slug)->get()->toArray();

                if ( array_key_exists(0, $article ) ) {
                    $add_views = Articles::find($article[0]['id']);
                    $add_views->views = $article[0]['views'] + 1;
                    $add_views->save();

                    $article = $article[0];
                    $article_sections = ArticleSections::where('article_id', $article['id'])->get()->toArray();
                } else {
                    return redirect()->back();
                }

                $articles = $this->remove_time($articles);
                $article['created_at'] = substr($article['created_at'], 0, strpos($article['created_at'], ' '));

                $author = Admins::where('id', $article['author_id'])->get()[0]->name;

                return view('user.pages.articles.article', compact('articles', 'article', 'article_sections', 'author'));
            }

            public function redirect_articles($category, $slug) {
                return redirect($to = 'article/'.$slug, $status = 301);
            }
        // * Articles

        // * Offers
            public function offers() {
                if ( Session::has('user.categories.offers') ) {
                    $category = Session::get('user.categories.offers');
                } else {
                    $category = 'all';
                }
                
                if ( $category != 'all' && in_array($category, $this->offers_categories)) {
                    $query_offers = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')], ['category', $category]];
                } elseif ( $category == 'all' ) {
                    $query_offers = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]];
                } else {
                    $category = 'all';
                    $query_offers = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]];
                }

                $offers = Offers::where($query_offers)->get()->toArray();
                $offers_page = true;

                return view('user.pages.offers.offers', compact('category', 'offers', 'offers_page'));
            }

            public function offer($slug) {
                $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();
                $offer = Offers::where('slug', $slug)->get()->toArray();

                if ( array_key_exists( 0, $offer ) ) {
                    $offer = $offer[0];
                } else {
                    return redirect()->back();
                }

                return view('user.pages.offers.offer', compact('offers', 'offer'));
            }

            public function redirect_offers($category, $slug) {
                return redirect($to = 'offer/'.$slug, $status = 301);
            }
        // * Offers

        // * Projects
            public function projects() {
                if ( Session::has('user.categories.projects') ) {
                    $category = Session::get('user.categories.projects');
                } else {
                    $category = 'all';
                }

                if ( $category != 'all' && in_array($category, $this->projects_categories)) {
                    $query_projects = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')], ['category', $category]];
                    $query_offers   = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')], ['category', $category]];
                    
                } elseif ( $category == 'all' ) {
                    $query_projects = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]];
                    $query_offers   = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]];
                } else {
                    $category = 'all';
                    $query_projects = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]];
                    $query_offers   = [['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]];
                }

                $projects = Projects::where($query_projects)->get()->toArray();
                $offers = Offers::where($query_offers)->latest()->take(3)->get()->toArray();

                return view('user.pages.projects.projects', compact('category', 'projects', 'offers'));
            }

            public function project($slug) {  
                $project = Projects::where('slug', $slug)->get()->toArray();

                if ( array_key_exists( 0, $project ) ) {
                    ($project[0]['slides'] != null) ? $slides = explode(';', $project[0]['slides']) : $slides = [];
                    //? array_unshift($slides, $project[0]['image']);
                    $offers = Offers::where([['soft_delete', '!=' , 'true'], ['locale', Session::get('locale')]])->latest()->take(3)->get()->toArray();

                    $add_views = Projects::find($project[0]['id']);
                    $add_views->views = $project[0]['views'] + 1;
                    $add_views->save();

                    $project = $project[0];
                    $hidden_fields = explode('-', $project['hidden_fields']);
                } else {
                    return redirect()->back();
                }

                return view('user.pages.projects.project', compact('project', 'slides', 'offers', 'hidden_fields'));
            }

            public function redirect_projects($category, $slug) {
                return redirect($to = 'project/'.$slug, $status = 301);
            }
        // * Projects
    // * Articles/Offers/Projects
}
