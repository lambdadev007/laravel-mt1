<?php

namespace App\Http\Controllers;

// * Included Models
    use App\Models\{Admins, Users, Logs};

    // * Pages
        use App\Models\{SpecialImages, HomepageSlides, Partners, Contact, Offers, Projects};
        use App\Models\AboutUs\{AboutUsText, AboutUsTeam};
        use App\Models\Articles\{Articles, ArticleSections};
        use App\Models\Vacancies\{VacanciesG, VacanciesGI, VacanciesSGI, VacanciesSG, VacanciesS};
        use App\Models\Services\Consultation;
        use App\Models\Services\Design\{DesignContent, DesignSlides, DesignBottomText};
        use App\Models\Services\Repairs\{RepairsSlides, RepairsPrices, RepairsCategory, RepairsSubCategory, RepairsSubCategoryText};
        use App\Models\Services\Furniture\{FurnitureSlides, FurnitureContent, FurnitureMaterialsContent, FurnitureMaterialsCatalogue, FurnitureGallery};
        use App\Models\Services\VIPMaster\{VIPMasterServices, VIPMasterSubCategories};
        use App\Models\Services\Cleaning\{CleaningTopServices, CleaningBottomServices};
    // * Pages

    use Illuminate\Support\Str;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Session;
// * Included Models

class AdminPages extends AdminCore
{
    // * Administration
        public function admins( $type = 'management', $category = 'create', $id = null) {
            if ( $this->is_admin() ) {
                if ( $category == 'create' ) {
                    $collapse   = [
                        'category' => 'admins',
                        'sub_category' => 'admins-add',
                    ];
                    $form_data  = ['model_name' => 'administration'];
                    $type       = $type;
                    $selects    = VacanciesS::where('type', 'legal_entity')->get()->toArray();
                    $data       = ['type' => $type];

                    return view('admin.pages.create', compact('collapse', 'form_data', 'type', 'selects', 'data'));
                }

                if ( $category == 'edit' ) {
                    if ($id != null) {
                        if ( Admins::where('id', $id)->doesntExist() ) {
                            return redirect()->back();
                        } else {
                            $stage      = 'edit';
                            $collapse   = [
                                'category' => 'admins',
                                'sub_category' => 'admins-edit',
                            ];
                            $form_data  = ['model_name' => 'administration'];
                            $type       = $type;
                            $selects    = VacanciesS::where('type', 'legal_entity')->get()->toArray();
                            $data       = Admins::where('id', $id)->get()->toArray();
                            $data       = $data[0];

                            return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'type', 'selects', 'data'));
                        }
                    } else {
                        $stage      = 'select';
                        $collapse   = [
                            'category' => 'admins',
                            'sub_category' => 'admins-edit',
                        ];
                        $form_data  = ['model_name' => 'administration'];
                        $type       = $type;
                        $data       = Admins::where('type', $type)->get()->toArray();

                        return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'type', 'data'));
                    }
                }
            } else {
                return redirect('/admin');
            }
        }

        public function personal_edit(Request $request) {
            if ( $request->isMethod('post') ) {
                if ( Hash::check($request->current_password, Admins::where('id', Session::get('admin.info.id'))->get()[0]->password) ) {
                    if ( $request->new_password === $request->repeat_password ) {
                        $this->create_log('თავისი პაროლის შეცვლა');

                        Admins::where('id', Session::get('admin.info.id'))->update(['password' => Hash::make($request->new_password)]);
                        return redirect()->back()->with(['update_success' => true]);
                    } else {
                        return redirect()->back()->with(['password_mismatch' => true]);
                    }
                } else {
                    return redirect()->back()->with(['old_password_incorrect' => true]);
                }
            } else {
                $data = Admins::where('id', Session::get('admin.info.id'))->get()->toArray();
                $data = $data[0];

                return view('admin.pages.edit.edit-personal');
            }
        }
    // * Administration
    
    // * Users
        public function users($stage = 'select', $id = null) {
            if ( $this->is_admin() ) {
                if ($id != null) {
                    if ( Users::where('id', $id)->doesntExist() ) {
                        return redirect()->back();
                    } else {
                        $stage      = 'edit';
                        $collapse   = [
                            'category' => 'admins',
                            'sub_category' => 'admins-edit',
                        ];
                        $form_data  = ['model_name' => 'users'];
                        $data       = Users::where('id', $id)->get()->toArray();
                        $data       = $data[0];

                        return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
                    }
                } else {
                    $stage      = 'select';
                    $collapse   = [
                        'category' => 'admins',
                        'sub_category' => 'admins-edit',
                    ];
                    $form_data  = ['model_name' => 'users'];
                    $data       = Users::all()->toArray();

                    return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
                }
            } else {
                return redirect('/admin');
            }
        }
    // * Users

    // * Logs
        public function logs() {
            if ( $this->is_admin() ) {
                $collapse   = ['category' => 'admins'];

                $data = [
                    'logs'      => Logs::orderBy('created_at', 'desc')->get()->toArray(),
                    'admins'    => Admins::all()->toArray()
                ];

                $data['logs'] = $this->remove_time($data['logs']);


                foreach ( $data['logs'] as $index => $log ) {
                    $data['logs'][$index]['created_at'] = str_replace('-', '/', $log['created_at']);
                }

                return view('admin.pages.logs', compact('collapse', 'data'));
            } else {
                return redirect('/admin');
            }
        }
    // * Logs

    // * Pages
        public function homepage() {
            if ( $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'homepage',
                ];

                $form_data = [
                    'model_name'    => 'homepage',
                    'has_slides'    => true,
                ];

                $data = [
                    'id'            => 'null',
                    'slides'        => HomepageSlides::all()->toArray(),
                    'advert'        => SpecialImages::where('location', 'homepage')->get()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function partners() {
            if ( $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'partners',
                ];

                $form_data = [
                    'model_name'    => 'partners',
                    'has_slides'    => true,
                ];

                $data = [
                    'id'            => 'null',
                    'slides'        => Partners::all()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function about_us() {
            if ( $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'about_us',
                ];

                $form_data = [
                    'model_name'    => 'about_us',
                ];

                $data = [
                    'id'            => 'null',
                    'text'          => AboutUsText::where('locale', Session::get('locale'))->get()->toArray(),
                    'team'          => AboutUsTeam::where('locale', Session::get('locale'))->get()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }   

        // * Vacancies
            public function vacancies() {
                if ( $this->is_admin() ) {
                    $stage = 'edit';

                    $collapse = [
                        'category'      => 'pages',
                        'sub_category'  => 'vacancies',
                    ];

                    $form_data = [
                        'model_name'    => 'vacancies',
                    ];

                    $data = [
                        'id'            => 'null',
                        'G'             => VacanciesG::all()->toArray(),
                        'GI'            => VacanciesGI::all()->toArray(),
                        'SG'            => VacanciesSG::all()->toArray(),
                        'SGI'           => VacanciesSGI::all()->toArray()
                    ];

                    return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
                } else {
                    return redirect('/admin');
                }
            }   

            public function vacancies_selects() {
                if ( $this->is_admin() ) {
                    $stage = 'edit';

                    $collapse = [
                        'category'      => 'pages',
                        'sub_category'  => 'vacancies_selects',
                    ];

                    $form_data = [
                        'model_name'    => 'vacancies_selects',
                    ];

                    $data = [
                        'id'                => 'null',
                        'employees'         => VacanciesS::where('type', 'employee')->get()->toArray(),
                        'legal_entities'    => VacanciesS::where('type', 'legal_entity')->get()->toArray(),
                    ];

                    return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
                } else {
                    return redirect('/admin');
                }
            }   

            public function vacancies_banners() {
                if ( $this->is_admin() ) {
                    $stage = 'edit';

                    $collapse = [
                        'category'      => 'pages',
                        'sub_category'  => 'vacancies_banners',
                    ];

                    $form_data = [
                        'model_name'    => 'vacancies_banners',
                    ];

                    $data = [
                        'id'                    => 'null',
                        'employees_banner'      => SpecialImages::where('location', 'employee')->get()->toArray(),
                        'legal_entities_banner' => SpecialImages::where('location', 'legal_entity')->get()->toArray(),
                    ];

                    return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
                } else {
                    return redirect('/admin');
                }
            }   

            public function send_message($page = null) {
                if ( $page != null ) {
                    if ( $this->is_admin() || $this->is_manager() ) {
                        $collapse   = [
                            'category' => 'admins',
                            'sub_category' => 'send-message',
                        ];

                        if ( $page == 'staff' ) {
                            $data = [
                                'page'          => $page,
                                'G'             => VacanciesG::all()->toArray(),
                                'GI'            => VacanciesGI::all()->toArray(),
                                'SG'            => VacanciesSG::all()->toArray(),
                                'SGI'           => VacanciesSGI::all()->toArray(),
                                'employees'     => Admins::where('type', 'employee')->get()->toArray(),
                            ];
                        } elseif ( $page == 'shops' ) {
                            $data = [
                                'page'          => $page,
                                'categories'    => VacanciesS::where('type', 'legal_entity')->get()->toArray(),
                                'shops'         => Admins::where('type', 'legal_entity')->get()->toArray(),
                            ];
                        }

                        return view('admin.pages.send-message', compact('collapse', 'data'));
                    } else {
                        return redirect('/admin');
                    }
                } else {
                    return redirect('/admin');
                }
            }
        // * Vacancies

        public function consultation() {
            if ( Session::has('admin.can_edit.consultation') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'consultation',
                ];

                $form_data = [
                    'model_name'    => 'consultation',
                ];

                $data = [
                    'id'            => 'null',
                    'content'       => Consultation::all()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function contact() {
            if ( Session::has('admin.can_edit.contact') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'contact',
                ];

                $form_data = [
                    'model_name'    => 'contact',
                ];

                $data = [
                    'id'            => 'null',
                    'design'        => Contact::where('belongs', 'design')->get()->toArray(),
                    'repairs'       => Contact::where('belongs', 'repairs')->get()->toArray(),
                    'furniture'     => Contact::where('belongs', 'furniture')->get()->toArray(),
                    'cleaning'      => Contact::where('belongs', 'cleaning')->get()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function design() {
            if ( Session::has('admin.can_edit.design') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      =>'pages',
                    'sub_category'  =>'design',
                ];

                $form_data = [
                    'model_name'    =>'design',
                    'has_slides'    => true,
                ];

                $data = [
                    'id'                =>'null',
                    'slides'            => DesignSlides::all()->toArray(),
                    'advert'            => SpecialImages::where('location', 'design_advert')->get()->toArray(),
                    'design_left_pic'   => SpecialImages::where('location', 'design_left_pic')->get()->toArray(),
                    'design_right_pic'  => SpecialImages::where('location', 'design_right_pic')->get()->toArray(),
                    'content'           => DesignContent::where('locale', Session::get('locale'))->get()->toArray(),
                    'bottom_text'       => DesignBottomText::where('locale', Session::get('locale'))->get()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function repairs() {
            if ( Session::has('admin.can_edit.repairs') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category' => 'pages',
                    'sub_category' => 'repairs',
                ];

                $form_data = [
                    'model_name' => 'repairs',
                    'has_slides' => true,
                ];

                $data = [
                    'id'                => 'null',
                    'slides'            => RepairsSlides::all()->toArray(),
                    'advert'            => SpecialImages::where('location', 'repairs')->get()->toArray(),
                    'prices'            => RepairsPrices::where('locale', Session::get('locale'))->get()->toArray(),
                    'category'          => RepairsCategory::where('locale', Session::get('locale'))->get()->toArray(),
                    'sub_category' => [
                        'first'         => RepairsSubCategory::where([['locale', Session::get('locale')], ['belongs', 'first']])->get()->toArray(),
                        'second'        => RepairsSubCategory::where([['locale', Session::get('locale')], ['belongs', 'second']])->get()->toArray(),
                        'third'         => RepairsSubCategory::where([['locale', Session::get('locale')], ['belongs', 'third']])->get()->toArray(),
                    ],
                    'sub_category_text' => RepairsSubCategoryText::where([['locale', Session::get('locale')]])->get()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function furniture() {
            if ( Session::has('admin.can_edit.furniture') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'furniture',
                ];

                $form_data = [
                    'model_name'    => 'furniture',
                    'has_slides'    => true,
                ];

                $data = [
                    'id'            => 'null',
                    'slides'        => FurnitureSlides::all()->toArray(),
                    'advert'        => SpecialImages::where('location', 'furniture')->get()->toArray(),
                    'content'       => FurnitureContent::where('locale', Session::get('locale'))->get()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function furniture_materials() {
            if ( Session::has('admin.can_edit.furniture') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'furniture',
                ];

                $form_data = [
                    'model_name'    => 'furniture_materials'
                ];

                $data = [
                    'id'            => 'null',
                    'content'       => FurnitureMaterialsContent::where('locale', Session::get('locale'))->get()->toArray(),
                    'catalogue'     => FurnitureMaterialsCatalogue::where('locale', Session::get('locale'))->get()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function furniture_gallery($category = 'kitchen') {
            $categories = ['kitchen','sleeping_room','reception','childrens_room','office_furniture','soft_furniture'];

            if ( Session::has('admin.can_edit.furniture') && in_array($category, $categories) || $this->is_admin() && in_array($category, $categories) ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'furniture',
                ];

                $form_data = [
                    'model_name'    => 'furniture_gallery'
                ];

                $data = [
                    'id'            => 'null',
                    'category'      => $category,
                    'gallery'       => FurnitureGallery::all()->toArray()
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function vip_master() {
            if ( Session::has('admin.can_edit.vip_master') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'vip_master',
                ];

                $form_data = [
                    'model_name'    => 'vip_master'
                ];

                $data = [
                    'id'            => 'null',
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

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function cleaning_top() {
            if ( Session::has('admin.can_edit.cleaning') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'cleaning',
                ];

                $form_data = [
                    'model_name'    => 'cleaning_top'
                ];

                $data = [
                    'id'           => 'null',
                    'top_services' => [
                        'after-renovation'      => CleaningTopServices::where('belongs', 'after-renovation')->get()->toArray(),
                        'during-renovation'     => CleaningTopServices::where('belongs', 'during-renovation')->get()->toArray(),
                        'facade-cleaning'       => CleaningTopServices::where('belongs', 'facade-cleaning')->get()->toArray(),
                        'window-cleaning'       => CleaningTopServices::where('belongs', 'window-cleaning')->get()->toArray(),
                        'every-day-cleaning'    => CleaningTopServices::where('belongs', 'every-day-cleaning')->get()->toArray(),
                        'complex-cleaning'      => CleaningTopServices::where('belongs', 'complex-cleaning')->get()->toArray(),
                        'cleaner-woman'         => CleaningTopServices::where('belongs', 'cleaner-woman')->get()->toArray(),
                    ],
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function cleaning_bottom() {
            if ( Session::has('admin.can_edit.cleaning') || $this->is_admin() ) {
                $stage = 'edit';

                $collapse = [
                    'category'      => 'pages',
                    'sub_category'  => 'cleaning',
                ];

                $form_data = [
                    'model_name'    => 'cleaning_bottom'
                ];

                $data = [
                    'id'           => 'null',

                    'bottom_services'    => CleaningBottomServices::all()->toArray(),
                ];

                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function article( $category = 'create', $id = null) {
            if ( Session::has('admin.can_write.articles') || $this->is_admin() ) {
                if ( $category == 'create' ) {
                    $collapse = [
                        'category'      =>'content',
                        'sub_category'  =>'articles',
                    ];
                    $form_data = [
                        'model_name'     =>'article',
                        'has_category'   => true,
                        'has_slug'       => true,
                        'has_seo'        => true,
                    ];

                    $admins = [];

                    if ( $this->is_admin() ) {
                        $admins = Admins::where('type', 'management')->get()->toArray();
                    }

                    $slugs = [];
                    $og_slugs = [];

                    foreach ( Articles::all()->toArray() as $slug ) {
                        $slugs[] = $slug['slug'];
                        $og_slugs[] = $slug['og_slug'];
                    }

                    return view('admin.pages.create', compact('collapse', 'form_data', 'admins', 'slugs', 'og_slugs'));
                }

                if ( $category == 'edit' ) {
                    if ($id != null) {
                        if ( Articles::where('id', $id)->doesntExist() ) {
                            return redirect()->back();
                        } else {
                            if ( $this->admin_category('articles') && Articles::where('id', $id)->get()->toArray()[0]['valid_for_editing'] == 'false' ) {
                                return redirect('/admin');
                            } else {
                                $stage = 'edit';
                                $collapse = [
                                    'category'      => 'content',
                                    'sub_category'  => 'articles',
                                ];
                                
                                $form_data = [
                                    'model_name'     => 'article',
                                    'has_category'   => true,
                                    'has_slug'       => true,
                                    'has_seo'        => true,
                                ];

                                $data = Articles::where('id', $id)->get()->toArray();
                                $sections = ArticleSections::where('article_id', $id)->get();
                                $data = $this->remove_time($data);
                                $data = $data[0];

                                $admins = [];

                                if ( $this->is_admin() ) {
                                    $admins = Admins::where('type', 'management')->get()->toArray();
                                }

                                $slugs = [];
                                $og_slugs = [];

                                foreach ( Articles::where('id', '!=', $id)->get()->toArray() as $slug ) {
                                    $slugs[] = $slug['slug'];
                                    $og_slugs[] = $slug['og_slug'];
                                }

                                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data', 'admins', 'sections', 'slugs', 'og_slugs'));
                            }
                        }
                    } else {
                        $stage = 'select';
                        $collapse = [
                            'category' => 'content',
                            'sub_category' => 'articles',
                        ];
                        $form_data = ['model_name' => 'article'];
                        if ( $this->is_admin() ) {
                            $data = Articles::where([['locale', Session::get('locale')]])->get()->toArray();
                        } elseif ( $this->admin_category('articles') ) {
                            $data = Articles::where([['locale', Session::get('locale')], ['author_id', Session::get('admin.info.id')]])->get()->toArray();
                        } else {
                            $data = Articles::where([['locale', Session::get('locale')], ['category', Session::get('admin.info.category')]])->get()->toArray();
                        }
                        
                        $data = $this->remove_time($data);
                        
                        return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
                    }
                }
            } else {
                return redirect('/admin');
            }
        }

        public function offer( $category = 'create', $id = null) {
            if ( $category == 'create' ) {
                
                $collapse = [
                    'category'      => 'content',
                    'sub_category'  => 'offers',
                ];
                $form_data = [
                    'model_name'     => 'offer',
                    'has_slug'       =>  true,
                    'has_seo'        =>  true,
                    'has_category'   =>  true,
                ];

                $slugs = [];
                $og_slugs = [];

                foreach ( Offers::all()->toArray() as $slug ) {
                    $slugs[] = $slug['slug'];
                    $og_slugs[] = $slug['og_slug'];
                }

                return view('admin.pages.create', compact('collapse', 'form_data', 'slugs', 'og_slugs'));
            }

            if ( $category == 'edit' ) {
                if ($id != null) {
                    if ( Offers::where('id', $id)->doesntExist() ) {
                        return redirect()->back();
                    } else {
                        $stage = 'edit';
                        
                        $collapse = [
                            'category'      => 'content',
                            'sub_category'  => 'offers',
                        ];
                        $form_data = [
                            'model_name'     => 'offer',
                            'has_slug'       => true,
                            'has_seo'        => true,
                            'has_category'   => true,
                        ];

                        $data = Offers::where('id', $id)->get()->toArray();
                        $data = $data[0];

                        $slugs = [];
                        $og_slugs = [];

                        foreach ( Offers::where('id', '!=', $id)->get()->toArray() as $slug ) {
                            $slugs[] = $slug['slug'];
                            $og_slugs[] = $slug['og_slug'];
                        }
                        
                        return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data', 'slugs', 'og_slugs'));
                    }

                } else {
                    $stage = 'select';

                    $collapse = [
                        'category' => 'content',
                        'sub_category' => 'offers',
                    ];
                    $form_data = ['model_name' => 'offer'];

                    $data = Offers::where([['locale', Session::get('locale')]])->get()->toArray();

                    return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data'));
                }
            }
        }

        public function project( $category = 'create', $id = null) {
            if ( Session::has('admin.can_write.projects') || $this->is_admin() ) {
                if ( $category == 'create' ) {
                    $collapse = [
                        'category'      => 'content',
                        'sub_category'  => 'projects',
                    ];

                    $form_data = [
                        'model_name'     => 'project',
                        'has_slug'       => true,
                        'has_seo'        => true,
                        'has_category'   => true,
                        'has_slides'     => true,
                    ];

                    $slugs = [];
                    $og_slugs = [];

                    foreach ( Projects::all()->toArray() as $slug ) {
                        $slugs[] = $slug['slug'];
                        $og_slugs[] = $slug['og_slug'];
                    }

                    return view('admin.pages.create', compact('collapse', 'form_data', 'slugs', 'og_slugs'));
                }

                if ( $category == 'edit' ) {
                    if ($id != null) {
                        if ( Projects::where('id', $id)->doesntExist() ) {
                            return redirect()->back();
                        } else {
                            if ( Session::get('admin.info.category') != 'admin' && Projects::where('id', $id)->get()[0]->valid_for_editing == 'false' ) {
                                return redirect()->back();
                            } else {
                                $stage = 'edit';

                                $collapse = [
                                    'category'       => 'content',
                                    'sub_category'   => 'projects',
                                ];

                                $form_data = [
                                    'model_name'     => 'project',
                                    'has_slug'       => true,
                                    'has_seo'        => true,
                                    'has_category'   => true,
                                    'has_slides'     => true,
                                ];

                                $data = Projects::where('id', $id)->get()->toArray();
                                $data = $data[0];

                                ($data['slides'] != null) ? $slides = explode(';', $data['slides']) : $slides = [];

                                $slugs = [];
                                $og_slugs = [];

                                foreach ( Projects::where('id', '!=', $id)->get()->toArray() as $slug ) {
                                    $slugs[] = $slug['slug'];
                                    $og_slugs[] = $slug['og_slug'];
                                }

                                $hidden_fields = explode('-', $data['hidden_fields']);

                                return view('admin.pages.edit', compact('stage', 'collapse', 'form_data', 'data', 'slides', 'slugs', 'og_slugs', 'hidden_fields'));
                            }
                        }
                    } else {
                        $stage = 'select';
                        $collapse = [
                            'category' => 'content',
                            'sub_category' => 'projects',
                        ];
                        $form_data = ['model_name' => 'project'];
                        if ( $this->is_admin() ) {
                            $data = Projects::where([['locale', Session::get('locale')]])->get()->toArray();
                        } else {
                            $data = Projects::where('category', Session::get('admin.info.category'))->get()->toArray();
                        }

                        return view('admin.pages.edit', compact('stage', 'form_data', 'collapse', 'data'));
                    }
                }
            } else {
                return redirect('/admin');
            }
        }
    // * Pages
}