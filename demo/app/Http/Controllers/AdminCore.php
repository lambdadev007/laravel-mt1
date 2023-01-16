<?php

namespace App\Http\Controllers;

// * Included Models
    use App\Models\{Admins, Logs};

    // * Pages
        use App\Models\{SpecialImages, HomepageSlides, Partners, Contact, Offers, Projects};
        use App\Models\AboutUs\{AboutUsText, AboutUsTeam};
        use App\Models\Articles\{Articles, ArticleSections};
        use App\Models\Vacancies\{VacanciesG, VacanciesGI, VacanciesSG, VacanciesSGI, VacanciesS};
        use App\Models\Services\Consultation;
        use App\Models\Services\Design\{DesignContent, DesignSlides, DesignBottomText};
        use App\Models\Services\Repairs\{RepairsSlides, RepairsPrices, RepairsCategory, RepairsSubCategory, RepairsSubCategoryText};
        use App\Models\Services\Furniture\{FurnitureSlides, FurnitureContent, FurnitureMaterialsContent, FurnitureMaterialsCatalogue, FurnitureGallery};
        use App\Models\Services\VIPMaster\{VIPMasterServices, VIPMasterSubCategories};
        use App\Models\Services\Cleaning\{CleaningTopServices, CleaningBottomServices};
        use App\Models\Notifications;
    // * Pages

    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Facades\Cookie;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Session;
// * Included Models

class AdminCore extends HelpersCT
{
    public function __construct() {
        parent::__construct();

        // ! Valid for editing
            // foreach ( ['articles', 'offers', 'projects'] as $current_model ) {
            //     $data = $this->DB_to_arr(DB::table($current_model)->where([['time_of_expiration', '<' , time()], ['valid_for_editing', '=' , 'true']])->get());

            //     if ( $data != [] ) {
            //         $expired_ids = [];

            //         foreach ( $data as $item ) {
            //             $expired_ids[] = $item['id'];
            //         }

            //         foreach ( $expired_ids as $expired_id ) {
            //             DB::table($current_model)->where('id', $expired_id)->update(['valid_for_editing' => 'false']);
            //         }
            //     }
            // }
        // ! Valid for editing

        // * Reset Admin Session
            if ( Cookie::has('admin_cookie') ) {
                if ( !Session::has('admin.info.logged') ){
                    $data = json_decode(Crypt::decrypt(Cookie::get('admin_cookie'), false), true);
                    if ( array_key_exists('can_write', $data) ) {
                        foreach ( $data['can_write'] as $can_write_i => $can_write_v ) {
                            session(['admin.can_write.'.$can_write_i => $can_write_v]);
                        }
                    }

                    if ( array_key_exists('can_edit', $data) ) {
                        foreach ( $data['can_edit'] as $can_edit_i => $can_edit_v ) {
                            session(['admin.can_edit.'.$can_edit_i => $can_edit_v]);
                        }
                    }

                    foreach ( $data['info'] as $info_i => $info_v ) {
                        session(['admin.info.'.$info_i => $info_v]);
                    }
                }
            }
        // * Reset Admin Session

        // * Timeframes
            // * Days To Months
                $days = Notifications::where('current_timeframe', 'day')->get()->toArray();

                if ( $days != [] ) {
                    foreach ( $days as $day ) {
                        if ( json_decode($day['lifespan'])->day < time() ) {
                            $model = Notifications::find($day['id']);
                            $model->current_timeframe = 'month';
                            $model->save();
                        }
                    }
                }
            // * Days To Months

            // * Months To Years
                $months = Notifications::where('current_timeframe', 'month')->get()->toArray();

                if ( $months != [] ) {
                    foreach ( $months as $month ) {
                        if ( json_decode($month['lifespan'])->month < time() ) {
                            $model = Notifications::find($month['id']);
                            $model->current_timeframe = 'year';
                            $model->save();
                        }
                    }
                }
            // * Months To Years
        // * Timeframes
    }

    public function panel() {
        return view('admin.layout');
    }

    // * Core Methods
        public function store( $model_name, Request $request ) {
            if ( $model_name == 'administration' ) {
                if ( Admins::where('login', $request->login)->doesntExist() ) {
                    $action = $this->action('administration', null, 'save', $request);
                    if ( $action['reason'] != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/admin/administration/'. $action['type'] .'/edit')->with(['user_created' => true]);
                    }
                } else {
                    return redirect()->back()->with(['login_taken' => true]);
                }
            } elseif ( $this->checkSlug( $model_name ) == false ) {
                $this->action( $model_name, null, 'save', $request );
                return redirect('/admin/'. $model_name .'/edit')->with(['create_success' => true]);
            } else {
                return redirect()->back()->with(['slug_taken' => true]);
            }
        }

        public function update( $model_name, $id = null, Request $request ) {
            if ( $model_name == 'administration' ) {
                $requirement_1   = Admins::where('id', $id)->get()[0]->login == $request->login;
                $requirement_2   = Admins::where('login', $request->login)->doesntExist();

                if ( $requirement_1 || $requirement_2 ) {
                    $action = $this->action($model_name, $id, 'update', $request);
                    if ( $action['reason'] != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/admin/administration/'. $action['type'] .'/edit')->with(['update_success' => true]);
                    }
                } else {
                    return redirect()->back()->with(['login_taken' => true]);
                }
            } elseif ( $this->checkSlug( $model_name, $id) == 'no_slug' ) {
                $action = $this->action( $model_name, null, 'update', $request );
                if ( $action['reason'] != null ) {
                    return redirect()->back()->with([$action['reason'] => true]);
                } else {
                    return redirect()->back()->with(['update_success' => true]);
                }
            } elseif ( $this->checkSlug( $model_name, $id) == false ) {  
                $this->action( $model_name, $id, 'update', $request );
                return redirect('/admin/'. $model_name .'/edit')->with(['update_success' => true]);
            } else {
                return redirect()->back()->with(['slug_taken' => true]);
            }
        }

        public function restore( $model_name ) {
            if ( request('id_string') != null ) {
                $id_array = explode('-', request('id_string'));

                foreach ( $id_array as $id ) {
                    if ( $model_name == 'administration' ) {
                        $log_title = 'ადმინისტრატორში';
                        $model = Admins::find($id);
                    } elseif ( $model_name == 'article' ) {
                        $log_title = 'სტატიებში';
                        $model = Articles::find($id);
                    } elseif ( $model_name == 'offer' ) {
                        $log_title = 'აქციებში';
                        $model = Offers::find($id);
                    } elseif ( $model_name == 'project' ) {
                        $log_title = 'ნამუშევრებში';
                        $model = Projects::find($id);
                    }
                    $model->soft_delete = 'false';
                    $model->save();
                }

                $this->create_log($log_title .' რბილად აღდგენა');

                return redirect()->back()->with(['update_success' => true]);
            } else {
                return redirect()->back()->with(['error' => true]);
            }
        }

        public function delete( $model_name, $method = 'soft' ) {
            if ( request('id_string') != null ) {
                $id_array = explode('-', request('id_string'));

                foreach ( $id_array as $id ) {
                    if ( $method == 'soft' ) {
                        if ( $model_name == 'administration' ) {
                            $log_title = 'ადმინისტრატორში';
                            $model = Admins::find($id);
                        } elseif ( $model_name == 'article' ) {
                            $log_title = 'სტატიებში';
                            $model = Articles::find($id);
                        } elseif ( $model_name == 'offer' ) {
                            $log_title = 'აქციებში';
                            $model = Offers::find($id);
                        } elseif ( $model_name == 'project' ) {
                            $log_title = 'ნამუშევრებში';
                            $model = Projects::find($id);
                        }

                        $model->soft_delete = 'true';
                        $model->save();
                    } elseif ( $method == 'hard' ) {
                        $banner = 'images/'. $model_name .'s/'. $model_name .'_'. Session::get('locale') .'_'. $id . '_banner.jpg';

                        if ( $model_name == 'administration' ) {
                            $this->create_log('ადმინისტრატორის მყარად წაშლა');

                            Admins::find($id)->delete();
                        } elseif ( $model_name == 'article' ) {
                            $this->create_log('სტატიის მყარად წაშლა');

                            $images_filter = 'images/articles/article-'. Session::get('locale') .'-'. $id;
                            $images = array_filter(Storage::files('images/articles'), function($value) use ($images_filter) {
                                return substr( $value, 0, strlen($images_filter) ) == $images_filter;
                            });

                            Storage::delete($images);
                            Articles::find($id)->delete();
                            ArticleSections::where('article_id', $id)->delete();
                        } elseif ( $model_name == 'offer' ) {
                            $this->create_log('აქციის მყარად წაშლა');

                            $images_filter = 'images/offers/offer-'. Session::get('locale') .'-'. $id;
                            $images = array_filter(Storage::files('images/offers'), function($value) use ($images_filter) {
                                return substr( $value, 0, strlen($images_filter) ) == $images_filter;
                            });

                            Storage::delete($images);
                            Offers::find($id)->delete();
                        } elseif ( $model_name == 'project' ) {
                            $this->create_log('ნამუშევრის მყარად წაშლა');

                            $images_filter = 'images/projects/project-'. Session::get('locale') .'-'. $id;
                            $images = array_filter(Storage::files('images/projects'), function($value) use ($images_filter) {
                                return substr( $value, 0, strlen($images_filter) ) == $images_filter;
                            });

                            Storage::delete($images);
                            Projects::find($id)->delete();
                        }
                    } else {
                        return redirect()->back()->with(['error' => true]);
                    }
                }

                if ( $method == 'soft' ) $this->create_log($log_title .' რბილად წაშლა');

                return redirect()->back()->with(['delete_success' => true]);
            } else {
                return redirect()->back()->with(['error' => true]);
            }
        }

        private function action( $model_name, $model_id = null, $action = 'save', $request ) {
            if ( $model_name == 'administration'                && $action == 'save' ) {
                $this->create_log('ახალი ადმინის შექმნა');

                $number = null;
                $data = [
                    'reason'    => null,
                    'type'      => null
                ];

                if ( $request->has('number') && $request->number != null ) {
                    $validation = $this->validate_number($request->number);

                    if ( $validation['valid'] ) {
                        $number = $validation['number'];
                    } else {
                        $data['reason'] = $validation['reason'];
                        return $data;
                    }
                }

                $model                          = new Admins;
                $model->name                    = $request->name;
                $model->login                   = $request->login;
                $model->password                = Hash::make($request->password);
                $model->number                  = ($request->has('number'))                 ? $number                           : null;
                $model->email                   = ($request->has('email'))                  ? $request->email                   : null;
                $model->identification_code     = ($request->has('identification_code'))    ? $request->identification_code     : null;
                $model->field_of_activity       = ($request->has('field_of_activity'))      ? $request->field_of_activity       : null;
                $model->category                = $request->category;
                $model->type                    = Crypt::decrypt($request->input($request->key));
                $model->save();

                $data['type'] = $model->type;

                return $data;
            } elseif ( $model_name == 'administration'          && $action == 'update' ) {
                $this->create_log('ადმინის რედაქტირება');

                $number = null;
                $data = [
                    'reason'    => null,
                    'type'      => null
                ];

                if ( $request->has('number') && $request->number != null ) {
                    $validation = $this->validate_number($request->number);

                    if ( $validation['valid'] ) {
                        $number = $validation['number'];
                    } else {
                        $data['reason'] = $validation['reason'];
                        return $data;
                    }
                }

                $model                              = Admins::find($model_id);
                $model->name                        = $request->name;
                $model->login                       = $request->login;
                if ( $request->password != null )     $model->password                          = Hash::make($request->password);
                $model->number                      = ($request->has('number'))                 ? $number                           : null;
                $model->email                       = ($request->has('email'))                  ? $request->email                   : null;
                $model->identification_code         = ($request->has('identification_code'))    ? $request->identification_code     : null;
                $model->field_of_activity           = ($request->has('field_of_activity'))      ? $request->field_of_activity       : null;
                $model->category                    = ($request->has('category'))               ? $request->category                : Crypt::decrypt($request->input($request->c_key));
                $model->type                        = Crypt::decrypt($request->input($request->t_key));
                $model->save();

                $data['type'] = $model->type;

                return $data;
            //* Pages
                } elseif ( $model_name == 'homepage'            && $action == 'update' ) {
                    $this->create_log('მთავარი გვერდის რედაქტირება');

                    HomepageSlides::truncate();

                    if ( $request->has('amount_of_slides') ) {
                        foreach ( $request->amount_of_slides as $index => $value ) {
                            $model = new HomepageSlides;

                            if ( $request->hasFile('slides.'. $index) ) {
                                if ( $request->slides[$index]->isValid() ) {
                                    if ( $request->slides[$index]->extension() == 'jpg' ) {
                                        $image = 'homepage-slide-'. $index .'.jpeg';
                                    } else {
                                        $image = 'homepage-slide-'. $index .'.'. $request->slides[$index]->extension();
                                    }
                                    $request->slides[$index]->storeAs('images/homepage/', $image, 'local');
                                    $model->image = 'images/homepage/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_slide.'. $index) ) {
                                $model->image = $request->existing_slide[$index];
                            }

                            $model->save();
                        }
                    }

                    if ( $request->hasFile('homepage_advert') ) {
                        if ( SpecialImages::where('location', 'homepage')->exists() ) {
                            $request->homepage_advert->storeAs('images/homepage/', 'homepage-advert.jpeg', 'local');
                            SpecialImages::where('location', 'homepage')->update(['image' => 'images/homepage/homepage-advert.jpeg?'. time()]);
                        } else {
                            $request->homepage_advert->storeAs('images/homepage/', 'homepage-advert.jpeg', 'local');
                            $model = new SpecialImages;
                            $model->location = 'homepage';
                            $model->image = 'images/homepage/homepage-advert.jpeg?'. time();
                            $model->save();
                        }
                    }

                    return;
                } elseif ( $model_name == 'partners'            && $action == 'update' ) {
                    $this->create_log('პარტნიორების სლაიდერის რედაქტირება');

                    Partners::truncate();

                    if ( $request->has('amount_of_slides') ) {
                        foreach ( $request->amount_of_slides as $index => $value ) {
                            $model = new Partners;

                            $model->title = $request->slide_title[$index];

                            if ( $request->hasFile('slides.'. $index) ) {
                                if ( $request->slides[$index]->isValid() ) {
                                    if ( $request->slides[$index]->extension() == 'jpg' ) {
                                        $image = 'partner-'. $index .'.jpeg';
                                    } else {
                                        $image = 'partner-'. $index .'.'. $request->slides[$index]->extension();
                                    }
                                    $request->slides[$index]->storeAs('images/partners/', $image, 'local');
                                    $model->image = 'images/partners/' . $image .'?'. time();;
                                }
                            } elseif ( $request->has('existing_slide.'. $index) ) {
                                $model->image = $request->existing_slide[$index];
                            }

                            $model->save();
                        }
                    }

                    return;
                } elseif ( $model_name == 'vacancies'           && $action == 'update' ) {
                    $this->create_log('ვაკანსიების გვერდის რედაქტირება');
                    
                    VacanciesG::truncate();
                    VacanciesGI::truncate();
                    VacanciesSG::truncate();
                    VacanciesSGI::truncate();

                    foreach ( $request->amount_of_groups as $Gi => $G ) {
                        $model = new VacanciesG;
                        $model->has         = $request->group_has[$Gi];
                        $model->save();
                    }

                    foreach ( $request->amount_of_group_items as $GIi => $GI ) {
                        $model = new VacanciesGI;
                        $model->belongs     = $request->group_item_belongs[$GIi];
                        $model->has         = $request->group_item_has[$GIi];
                        $model->child_type  = $request->group_item_child_type[$GIi];
                        $model->title_ka    = $request->group_item_title_ka[$GIi];
                        $model->title_en    = $request->group_item_title_en[$GIi];

                        if ( $request->hasFile('GI_image.'. $GIi) ) {
                            if ( $request->GI_image[$GIi]->extension() == 'jpg' ) {
                                $image = 'group-item-image-'. $GIi .'.jpeg';
                            } else {
                                $image = 'group-item-image-'. $GIi .'.'. $request->GI_image[$GIi]->extension();
                            }
                            $request->GI_image[$GIi]->storeAs('images/vacancies/', $image, 'local');
                            $model->image = 'images/vacancies/'. $image .'?'. time();
                        } elseif ( $request->has('existing_GI_image.'. $GIi) ) {
                            $model->image = $request->existing_GI_image[$GIi];
                        }

                        $model->save();
                    }

                    if ( $request->has('amount_of_sub_groups') ) {
                        foreach ( $request->amount_of_sub_groups as $SGi => $SG ) {
                            $model = new VacanciesSG;
                            $model->belongs     = $request->sub_group_belongs[$SGi];
                            $model->has         = $request->sub_group_has[$SGi];
                            $model->title_ka    = $request->sub_group_title_ka[$SGi];
                            $model->title_en    = $request->sub_group_title_en[$SGi];

                            if ( $request->hasFile('SG_image.'. $SGi) ) {
                                if ( $request->SG_image[$SGi]->extension() == 'jpg' ) {
                                    $image = 'sub-group-image-'. $SGi .'.jpeg';
                                } else {
                                    $image = 'sub-group-image-'. $SGi .'.'. $request->SG_image[$SGi]->extension();
                                }
                                $request->SG_image[$SGi]->storeAs('images/vacancies/', $image, 'local');
                                $model->image = 'images/vacancies/'. $image .'?'. time();
                            } elseif ( $request->has('existing_SG_image.'. $SGi) ) {
                                $model->image = $request->existing_SG_image[$SGi];
                            }

                            $model->save();
                        }
                    }

                    foreach ( $request->amount_of_sub_group_items as $SGIi => $SGI ) {
                        $model = new VacanciesSGI;
                        $model->belongs     = $request->sub_group_item_belongs[$SGIi];
                        $model->title_ka    = $request->sub_group_item_title_ka[$SGIi];
                        $model->title_en    = $request->sub_group_item_title_en[$SGIi];

                        $model->save();
                    }

                    return;
                } elseif ( $model_name == 'vacancies_banners'   && $action == 'update' ) {
                    $this->create_log('ვაკანსიების სურათების რედაქტირება');

                    foreach ( ['employee', 'legal-entity'] as $item ) {
                        if ( $request->hasFile($item) ) {
                            $request->file($item)->storeAs('images/vacancies/', 'vacancies-' . $item .'-banner.jpg', 'local');
                        }
                    }

                    foreach ( ['employee', 'legal_entity'] as $item ) {
                        if ( $request->hasFile($item) ) {
                            if ( SpecialImages::where('location', $item)->exists() ) {
                                $request->file($item)->storeAs('images/vacancies/', $item .'.jpeg', 'local');
                                SpecialImages::where('location', $item)->update(['image' => 'images/vacancies/'. $item .'.jpeg?'. time()]);
                            } else {
                                $request->file($item)->storeAs('images/vacancies/', $item .'.jpeg', 'local');
                                $model = new SpecialImages;
                                $model->location = $item;
                                $model->image = 'images/vacancies/'. $item .'.jpeg?'. time();
                                $model->save();
                            }
                        }
                    }

                    return;
                } elseif ( $model_name == 'vacancies_selects'   && $action == 'update' ) {
                    $this->create_log('ვაკანსიების ფორმის რედაქტირება');

                    VacanciesS::truncate();

                    if ( $request->has('amount_of_employees') ) {
                        foreach ( $request->amount_of_employees as $index => $employee ) {
                            $model = new VacanciesS;
                            $model->title_ka    = $request->employee_ka[$index];
                            $model->title_en    = $request->employee_en[$index];
                            $model->type        = 'employee';
                            $model->save();
                        }
                    }

                    if ( $request->has('amount_of_legal_entities') ) {
                        foreach ( $request->amount_of_legal_entities as $index => $legal_entity ) {
                            $model = new VacanciesS;
                            $model->title_ka    = $request->legal_entity_ka[$index];
                            $model->title_en    = $request->legal_entity_en[$index];
                            $model->type        = 'legal_entity';
                            $model->save();
                        }
                    }

                    return;
                } elseif ( $model_name == 'about_us'            && $action == 'update' ) {
                    $this->create_log('ჩვენს შესახებ გვერდის რედაქტირება');

                    AboutUsText::where('locale', Session::get('locale'))->delete();
                    AboutUsTeam::where('locale', Session::get('locale'))->delete();

                    $model = new AboutUsText;

                    if ( $request->hasFile('company_image') ) {
                        $request->company_image->storeAs('images/about-us/', 'about-us.jpg', 'local');
                    }

                    $model->company_description             = $request->company_description;
                    $model->company_footer                  = $request->company_footer;
                    $model->team_header                     = $request->team_header;
                    $model->mission_header                  = $request->mission_header;
                    $model->mission_description             = $request->mission_description;
                    $model->mission_footer_header           = $request->mission_footer_header;
                    $model->mission_footer_description      = $request->mission_footer_description;
                    $model->locale                          = Session::get('locale');

                    $model->save();

                    if ( $request->has('amount_of_team_members') ) {
                        foreach ( $request->amount_of_team_members as $index => $value ) {
                            $model = new AboutUsTeam;

                            if ( $request->hasFile('team_images.'. $index) ) {
                                if ( $request->team_images[$index]->isValid() ) {
                                    if ( $request->team_images[$index]->extension() == 'jpg' ) {
                                        $image = Session::get('locale') . '-member-' . $index .'.jpeg';
                                    } else {
                                        $image = Session::get('locale') . '-member-' . $index .'.'. $request->team_images[$index]->extension();
                                    }
                                    $request->team_images[$index]->storeAs('images/about-us/', $image, 'local');
                                    $model->image = 'images/about-us/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_member_image.'. $index) ) {
                                $model->image = $request->existing_member_image[$index];
                            }

                            $model->name            = $request->member_name[$index];
                            $model->profession      = $request->member_profession[$index];
                            $model->locale          = Session::get('locale');

                            $model->save();
                        }
                    }

                    return;
                } elseif ( $model_name == 'consultation'        && $action == 'update' ) {
                    $this->create_log('კონსულტაციის გვერდის რედაქტირება');

                    Consultation::truncate();

                    if ( $request->has('amount_of_services') ) {
                        foreach ( $request->amount_of_services as $index => $value ) {
                            $model = new Consultation;

                            $model->title_ka = $request->title_ka[$index];
                            $model->title_en = $request->title_en[$index];
                            $model->description_ka = $request->description_ka[$index];
                            $model->description_en = $request->description_en[$index];

                            $model->price = (int)$request->price[$index];
                            if ( $this->is_admin() ) {
                                $model->group = $request->group;
                            } else {
                                $model->group = Session::get('admin.info.category');
                            }
                            $model->save();
                        } 
                    }
                    return;
                } elseif ( $model_name == 'contact'             && $action == 'update' ) {
                    $this->create_log('კონტაქტის გვერდის რედაქტირება');

                    Contact::truncate();

                    if ( $request->has('amount_of_contacts') ) {
                        foreach ( $request->amount_of_contacts as $index => $value ) {
                            $model = new Contact;

                            $number = str_replace(' ', '', $request->number[$index]);
                            $number = $this->validate_number($number);

                            if ( $number['valid'] ) {
                                $number = $number['number'];
                            } else {
                                $number = 'ნომერი არ იყო ვალიდური';
                            }

                            $model->number  = $number;
                            $model->belongs = $request->belongs[$index];

                            $model->name_ka = $request->name_ka[$index];
                            $model->name_en = $request->name_en[$index];

                            $model->profession_ka = $request->profession_ka[$index];
                            $model->profession_en = $request->profession_en[$index];

                            $model->save();
                        } 
                    }
                    return;
                } elseif ( $model_name == 'design'              && $action == 'update' ) {
                    $this->create_log('დიზაინის გვერდის რედაქტირება');

                    DesignSlides::truncate();
                    DesignContent::where('locale', Session::get('locale'))->delete();
                    DesignBottomText::where('locale', Session::get('locale'))->delete();

                    if ( $request->has('amount_of_slides') ) {
                        foreach ( $request->amount_of_slides as $index => $value ) {
                            $model = new DesignSlides;

                            if ( $request->hasFile('slides.'. $index) ) {
                                if ( $request->slides[$index]->isValid() ) {
                                    if ( $request->slides[$index]->extension() == 'jpg' ) {
                                        $image = 'design-slide-'. $index .'.jpeg';
                                    } else {
                                        $image = 'design-slide-'. $index .'.'. $request->slides[$index]->extension();
                                    }
                                    $request->slides[$index]->storeAs('images/design/', $image, 'local');
                                    $model->image = 'images/design/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_slide.'. $index) ) {
                                $model->image = $request->existing_slide[$index];
                            }

                            $model->save();
                        }
                    }

                    if ( $request->has('amount_of_sections') ) {
                        foreach ( $request->amount_of_sections as $index => $value ) {
                            $model = new DesignContent;

                            if ( $request->hasFile('image.'. $index) ) {
                                if ( $request->image[$index]->isValid() ) {
                                    if ( $request->image[$index]->extension() == 'jpg' ) {
                                        $image = 'design-'. Session::get('locale') .'-content-banner-'. $index .'.jpeg';
                                    } else {
                                        $image = 'design-'. Session::get('locale') .'-content-banner-'. $index .'.'. $request->image[$index]->extension();
                                    }
                                    $request->image[$index]->storeAs('images/design/', $image, 'local');
                                    $model->image = 'images/design/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_image.'. $index) ) {
                                $model->image = $request->existing_image[$index];
                            }

                            $model->title               = $request->title[$index];
                            $model->description         = $request->description[$index];
                            $model->locale              = Session::get('locale');
                            $model->save();
                        }
                    }

                    if ( $request->has('design_bottom_title') || $request->has('design_bottom_text') ) {
                        $model = new DesignBottomText;
                        $model->title                   = $request->design_bottom_title;
                        $model->text                    = $request->design_bottom_text;
                        $model->locale                  = Session::get('locale');
                        $model->save();
                    }

                    foreach ( ['advert', 'left_pic', 'right_pic'] as $item ) {
                        if ( $request->hasFile('design_'. $item) ) {
                            if ( SpecialImages::where('location', $item)->exists() ) {
                                $request->file('design_'. $item)->storeAs('images/design/', 'design-'. $item .'.jpeg', 'local');
                                SpecialImages::where('location', 'design_'. $item)->update(['image' => 'images/design/design-'. $item .'.jpeg?'. time()]);
                            } else {
                                $request->file('design_'. $item)->storeAs('images/design/', 'design-'. $item .'.jpeg', 'local');
                                $model = new SpecialImages;
                                $model->location = 'design_'. $item;
                                $model->image = 'images/design/design-'. $item .'.jpeg?'. time();
                                $model->save();
                            }
                        }
                    }

                    return;
                } elseif ( $model_name == 'repairs'             && $action == 'update' ) {
                    $this->create_log('რემონტის გვერდის რედაქტირება');

                    RepairsSlides::truncate();
                    RepairsPrices::where('locale', Session::get('locale'))->delete();
                    RepairsCategory::where('locale', Session::get('locale'))->delete();
                    RepairsSubCategory::where('locale', Session::get('locale'))->delete();
                    RepairsSubCategoryText::where('locale', Session::get('locale'))->delete();

                    if ( $request->has('amount_of_slides') ) {
                        foreach ( $request->amount_of_slides as $index => $value ) {
                            $model = new RepairsSlides;

                            if ( $request->hasFile('slides.'. $index) ) {
                                if ( $request->slides[$index]->isValid() ) {
                                    if ( $request->slides[$index]->extension() == 'jpg' ) {
                                        $image = 'repairs-slide-'. $index .'.jpeg';
                                    } else {
                                        $image = 'repairs-slide-'. $index .'.'. $request->slides[$index]->extension();
                                    }
                                    $request->slides[$index]->storeAs('images/repairs/', $image, 'local');
                                    $model->image = 'images/repairs/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_slide.'. $index) ) {
                                $model->image = $request->existing_slide[$index];
                            }

                            $model->save();
                        }
                    }

                    for ( $i = 0; $i < 3; $i++ ) {
                        $model = new RepairsCategory;
                        $model->title = $request->category_title[$i];
                        
                        if ( $request->category_price[$i] === null ) {
                            $model->price = 0;
                        } else {
                            $model->price = $request->category_price[$i];
                        }
                        
                        $model->description = $request->category_description[$i];
                        $model->locale = Session::get('locale');
                        $model->save();
                    }

                    if ( $request->has('amount_of_first_sub_sections') ) {
                        foreach ( $request->amount_of_first_sub_sections as $index => $value ) {
                            $model                  = new RepairsSubCategory;
                            $model->belongs         = 'first';
                            $model->has             = $request->first_sub_sections_has[$index];
                            $model->title           = $request->first_sub_category_title[$index];
                            $model->locale          = Session::get('locale');
                            $model->save();
                        }
                    }

                    if ( $request->has('amount_of_second_sub_sections') ) {
                        foreach ( $request->amount_of_second_sub_sections as $index => $value ) {
                            $model                  = new RepairsSubCategory;
                            $model->belongs         = 'second';
                            $model->has             = $request->second_sub_sections_has[$index];
                            $model->title           = $request->second_sub_category_title[$index];
                            $model->locale          = Session::get('locale');
                            $model->save();
                        }
                    }

                    if ( $request->has('amount_of_third_sub_sections') ) {
                        foreach ( $request->amount_of_third_sub_sections as $index => $value ) {
                            $model                  = new RepairsSubCategory;
                            $model->belongs         = 'third';
                            $model->has             = $request->third_sub_sections_has[$index];
                            $model->title           = $request->third_sub_category_title[$index];
                            $model->locale          = Session::get('locale');
                            $model->save();
                        }
                    }

                    if ( $request->has('amount_of_sub_section_texts') ) {
                        foreach ( $request->amount_of_sub_section_texts as $index => $value ) {
                            $model                  = new RepairsSubCategoryText;
                            $model->belongs         = $request->sub_section_text_belongs[$index];
                            $model->description     = $request->sub_category_descriptions[$index]; 
                            $model->locale          = Session::get('locale');
                            $model->save();
                        }
                    }

                    if ( $request->has('amount_of_info_boxes') ) {
                        foreach ( $request->amount_of_info_boxes as $index => $value ) {
                            $model                  = new RepairsPrices;
                            $model->title           = $request->info_box_title[$index];
                            $model->description     = $request->info_box_description[$index];
                            $model->price           = $request->info_box_price[$index];
                            $model->locale          = Session::get('locale');
                            $model->save();
                        }
                    }

                    if ( $request->hasFile('repairs_advert') ) {
                        if ( SpecialImages::where('location', 'repairs')->exists() ) {
                            $request->repairs_advert->storeAs('images/repairs/', 'repairs-advert.jpeg', 'local');
                            SpecialImages::where('location', 'repairs')->update(['image' => 'images/repairs/repairs-advert.jpeg?'. time()]);
                        } else {
                            $request->repairs_advert->storeAs('images/repairs/', 'repairs-advert.jpeg', 'local');
                            $model = new SpecialImages;
                            $model->location = 'repairs';
                            $model->image = 'images/repairs/repairs-advert.jpeg?'. time();
                            $model->save();
                        }
                    }

                    return;
                } elseif ( $model_name == 'furniture'           && $action == 'update' ) {
                    $this->create_log('ავეჯის გვერდის რედაქტირება');

                    FurnitureSlides::truncate();
                    FurnitureContent::where('locale', Session::get('locale'))->delete();

                    if ( $request->has('amount_of_slides') ) {
                        foreach ( $request->amount_of_slides as $index => $value ) {
                            $model = new FurnitureSlides;

                            $model->link = request('slide_link')[$index];

                            if ( $request->hasFile('slides.'. $index) ) {
                                if ( $request->slides[$index]->isValid() ) {
                                    if ( $request->slides[$index]->extension() == 'jpg' ) {
                                        $image = 'furniture-slide-'. $index .'.jpeg';
                                    } else {
                                        $image = 'furniture-slide-'. $index .'.'. $request->slides[$index]->extension();
                                    }
                                    $request->slides[$index]->storeAs('images/furniture/', $image, 'local');
                                    $model->image = 'images/furniture/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_slide.'. $index) ) {
                                $model->image = $request->existing_slide[$index];
                            }

                            $model->save();
                        }
                    }

                    if ( request('amount_of_sections') != null ) {
                        foreach ( request('amount_of_sections') as $index => $value ) {
                            $model = new FurnitureContent;

                            if ( $request->hasFile('image.'. $index) ) {
                                if ( $request->image[$index]->isValid() ) {
                                    if ( $request->image[$index]->extension() == 'jpg' ) {
                                        $image = 'furniture-'. Session::get('locale') .'-content-banner-'. $index .'.jpeg';
                                    } else {
                                        $image = 'furniture-'. Session::get('locale') .'-content-banner-'. $index .'.'. $request->image[$index]->extension();
                                    }
                                    $request->image[$index]->storeAs('images/furniture/', $image, 'local');
                                    $model->image = 'images/furniture/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_image.'. $index) ) {
                                $model->image = $request->existing_image[$index];
                            }

                            if ( $request->has('title.'. $index) )       $model->title       = $request->title[$index];
                            if ( $request->has('description.'. $index) ) $model->description = $request->description[$index];
                            $model->save();
                        }
                    }

                    if ( $request->hasFile('furniture_advert') ) {
                        if ( SpecialImages::where('location', 'furniture')->exists() ) {
                            $request->furniture_advert->storeAs('images/furniture/', 'furniture-advert.jpeg', 'local');
                            SpecialImages::where('location', 'furniture')->update(['image' => 'images/furniture/furniture-advert.jpeg?'. time()]);
                        } else {
                            $request->furniture_advert->storeAs('images/furniture/', 'furniture-advert.jpeg', 'local');
                            $model = new SpecialImages;
                            $model->location = 'furniture';
                            $model->image = 'images/furniture/furniture-advert.jpeg?'. time();
                            $model->save();
                        }
                    }

                    if ( $request->hasFile('projects_image') ) {
                        $request->projects_image->storeAs('images/furniture/', 'projects.jpg', 'local');
                    }
                    if ( $request->hasFile('furniture_and_materials_image') ) {
                        $request->furniture_and_materials_image->storeAs('images/furniture/', 'furniture-and-materials.jpg', 'local');
                    }

                    return;
                } elseif ( $model_name == 'furniture_materials' && $action == 'update' ) {
                    $this->create_log('ავეჯის მასალების გვერდის რედაქტირება');

                    FurnitureMaterialsContent::where('locale', Session::get('locale'))->delete();
                    FurnitureMaterialsCatalogue::where('locale', Session::get('locale'))->delete();

                    $model = new FurnitureMaterialsContent;

                    if ( $request->hasFile('furniture_materials_banner') ){
                        $request->furniture_materials_banner->storeAs('images/furniture-materials/', 'furniture-materials-banner.jpg', 'local');
                    }
                    $model->description = $request->description;
                    
                    $model->save();

                    if ( $request->has('amount_of_catalogues') ) {
                        foreach ( $request->amount_of_catalogues as $index => $value ) {
                            $model = new FurnitureMaterialsCatalogue;

                            if ( $request->hasFile('catalogue_image.'. $index) ) {
                                if ( $request->catalogue_image[$index]->isValid() ) {
                                    if ( $request->catalogue_image[$index]->extension() == 'jpg' ) {
                                        $image = 'furniture-materials-'. Session::get('locale') . '-catalogue-image-'. $index .'.jpeg';
                                    } else {
                                        $image = 'furniture-materials-'. Session::get('locale') . '-catalogue-image-'. $index .'.'. $request->catalogue_image[$index]->extension();
                                    }
                                    $request->catalogue_image[$index]->storeAs('images/furniture-materials/', $image, 'local');
                                    $model->image = 'images/furniture-materials/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_catalogue_image.'. $index) ) {
                                $model->image = $request->existing_catalogue_image[$index];
                            }

                            if ( $request->has('catalogue_title.'. $index) ) {
                                $model->title = $request->catalogue_title[$index];
                            }

                            if ( $request->hasFile('catalogue_file.'. $index) ) {
                                $file = 'catalogue-file-'. Session::get('locale') .'-'. $index . '.pdf';
                                $request->catalogue_file[$index]->storeAs('files/catalogues/', $file, 'local');
                                $model->link = 'files/catalogues/' . $file;
                            }  elseif ( $request->has('existing_catalogue_file.'. $index) ) {
                                $model->link = $request->existing_catalogue_file[$index];
                            }

                            $model->save();
                        }
                    }
                    
                    return;
                } elseif ( $model_name == 'furniture_gallery'   && $action == 'update' ) {
                    $this->create_log('ავეჯის გალერეის რედაქტირება');

                    FurnitureGallery::truncate();

                    if ( $request->has('amount_of_images') ) {
                        foreach ( $request->amount_of_images as $index => $value ) {
                            $model = new FurnitureGallery;
                            $model->category = request('category')[$index];

                            if ( $request->hasFile('gallery_images.'. $index) ) {
                                if ( $request->gallery_images[$index]->isValid() ) {
                                    if ( $request->gallery_images[$index]->extension() == 'jpg' ) {
                                        $image = 'furniture-gallery-image'. $index .'.jpeg';
                                    } else {
                                        $image = 'furniture-gallery-image'. $index .'.'. $request->gallery_images[$index]->extension();
                                    }
                                    $request->gallery_images[$index]->storeAs('images/furniture-gallery/', $image, 'local');
                                    $model->image = 'images/furniture-gallery/' . $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_gallery_image.'. $index) ) {
                                $model->image = $request->existing_gallery_image[$index];
                            }

                            $model->save();
                        }
                    }

                    return;
                } elseif ( $model_name == 'vip_master'          && $action == 'update' ) {
                    $this->create_log('ვიპ მასტერის გვერდის რედაქტირება');

                    VIPMasterSubCategories::truncate();
                    VIPMasterServices::truncate();

                    if ( $request->has('amount_of_sub_categories') ) {
                        foreach ( $request->amount_of_sub_categories as $index => $sub_categories ) {
                            $model = new VIPMasterSubCategories;

                            $model->title_ka    = $request->sub_category_titles_ka[$index];
                            $model->title_en    = $request->sub_category_titles_en[$index];
                            $model->belongs     = $request->belongs_category[$index];
                            $model->has         = $request->has[$index];

                            $model->save();
                        }
                    }

                    if ( $request->has('amount_of_services') ) {
                        foreach ( $request->amount_of_services as $index => $services ) {
                            $model = new VIPMasterServices;

                            $model->title_ka    = $request->service_title_ka[$index];
                            $model->title_en    = $request->service_title_en[$index];
                            $model->price       = $request->service_price[$index];
                            $model->belongs     = $request->belongs_sub_category[$index];

                            $model->save();
                        }
                    }

                    return;
                } elseif ( $model_name == 'cleaning_top'        && $action == 'update' ) {
                    $this->create_log('ზედა დასუფთავების რედაქტირება');

                    CleaningTopServices::truncate();

                    $category_array = ['after-renovation', 'during-renovation', 'facade-cleaning', 'window-cleaning', 'every-day-cleaning', 'complex-cleaning', 'cleaner-woman'];
                    
                    foreach ( $category_array as $index => $category ) {
                        $model = new CleaningTopServices;

                        if ( $request->hasFile('top_service_images.'. $index) ) {
                            if ( $request->top_service_images[$index]->extension() == 'jpg' ) {
                                $image = 'top-service-image-' . $index .'.jpeg';
                            } else {
                                $image = 'top-service-image-' . $index .'.'. $request->top_service_images[$index]->extension();
                            }
                            $request->top_service_images[$index]->storeAs('images/cleaning/', $image, 'local');
                            $model->image = 'images/cleaning/'. $image .'?'. time();
                        } elseif ( $request->has('existing_top_service_image.'. $index) ) {
                            $model->image = $request->existing_top_service_image[$index];
                        }

                        $model->title_ka            = $request->top_titles_ka[$index];
                        $model->title_en            = $request->top_titles_en[$index];

                        $model->description_ka      = $request->top_descriptions_ka[$index];
                        $model->description_en      = $request->top_descriptions_en[$index];

                        $model->price               = $request->top_prices[$index];
                        $model->belongs             = $category;

                        $model->save();
                    }

                    return;
                } elseif ( $model_name == 'cleaning_bottom'     && $action == 'update' ) {
                    $this->create_log('ქვედა დასუფთავების რედაქტირება');

                    CleaningBottomServices::truncate();

                    if ( $request->has('amount_of_bottom_services') ) {
                        foreach ( $request->amount_of_bottom_services as $index => $services ) {
                            $model = new CleaningBottomServices;

                            $model->title_ka            = $request->bottom_service_titles_ka[$index];
                            $model->title_en            = $request->bottom_service_titles_en[$index];

                            $model->description_ka      = $request->bottom_service_descriptions_ka[$index];
                            $model->description_en      = $request->bottom_service_descriptions_en[$index];

                            $model->price               = $request->bottom_prices[$index];

                            $model->save();
                        }
                    }

                    return;
            //* Pages
            } elseif ( $action == 'save' ) {
                if ( $model_name == 'article' ) {
                    $this->create_log('სტატიის შექმნა');
                    
                    $model = new Articles;
                    
                    if ( Session::has('admin.can_write.articles') || $this->is_admin() ) {
                        if ( $this->admin_category('articles') ) {
                            $model->verification = 'unverified';
                            $model->valid_for_editing = 'true';
                        } else {
                            $model->verification = 'verified';
                            $model->valid_for_editing = 'false';
                        }
                    }
                } elseif ( $model_name == 'offer' ) {
                    $this->create_log('აქციის შექმნა');

                    $model = new Offers;
                } elseif ( $model_name == 'project' ) {
                    $this->create_log('ნამუშევრის შექმნა');

                    $model = new Projects;
                } else {
                    return;
                }

                $model->slug = Str::slug($request->slug, '-');
                if ( $request->has('category') ) {
                    $model->category = $request->category;
                } else {
                    $model->category = Crypt::decrypt($request->hidden_category);
                }
                $model->save();
            } elseif ( $action == 'update' ) {
                if ( $model_name == 'article' ) {
                    $this->create_log('სტატიის რედაქტირება');
                    
                    $model = Articles::find($model_id);
                    
                    if ( Session::has('admin.can_write.articles') || $this->is_admin() ) {
                        if ( $this->admin_category('articles') ) {
                            $model->verification = 'unverified';
                            $model->valid_for_editing = 'true';
                        } else {
                            $model->verification = 'verified';
                            $model->valid_for_editing = 'false';
                        }
                    }
                } elseif ( $model_name == 'offer' ) {
                    $this->create_log('აქციის რედაქტირება');

                    $model = Offers::find($model_id);
                } elseif ( $model_name == 'project' ) {
                    $this->create_log('ნამუშევრის რედაქტირება');

                    $model = Projects::find($model_id);
                }
            }

            if ( $model_name == 'project' ) {
                $model->status              = $request->status;
                $model->location            = $request->location;
                $model->area                = $request->area;
                $model->duration            = $request->duration;
                $model->starts              = str_replace( '.', '-', $request->starts);
                $model->ends                = str_replace( '.', '-', $request->ends);
                $model->price               = $request->price;
                $model->materials           = $request->materials;
                $model->hidden_fields       = $request->hidden_fields;
                
                if ( $request->has('amount_of_slides') ) {
                    $project_slides = [];

                    foreach ( $request->amount_of_slides as $index => $value ) {
                        if ( $request->hasFile('slides.'. $index) ) {
                            if ( $request->slides[$index]->isValid() ) {
                                if ( $request->slides[$index]->extension() == 'jpg' ) {
                                    $slide = $model_name .'-'. Session::get('locale') .'-'. $model->id .'-'. 'slide' .'-'. $index .'.jpeg';
                                } else {
                                    $slide = $model_name .'-'. Session::get('locale') .'-'. $model->id .'-'. 'slide' .'-'. $index .'.'. $request->slides[$index]->extension();
                                }
                                $request->slides[$index]->storeAs('images/'. $model_name .'s/', $slide, 'local');
                                $project_slides[$index] = 'images/'. $model_name .'s/' . $slide .'?'. time();
                            }
                        } elseif ( $request->has('existing_slide.'. $index) ) {
                            $project_slides[$index] = $request->existing_slide[$index];
                        }
                    }

                    $model->slides = implode(';', $project_slides);
                } elseif ( !$request->has('amount_of_slides') ) {
                    $model->slides = null;
                }
            }

            $model->locale = Session::get('locale');

            if ( $model_name == 'article' && $action == 'save' || $model_name == 'offer' && $action == 'save' || $model_name == 'project' && $action == 'save' ) {
                $model->author                  = Session::get('admin.info.name');
                $model->time_of_expiration      = (int)time() + 3600;
                if ( $model_name == 'article' ) $model->author_id = Session::get('admin.info.id');
            }

            if ( $this->is_admin() && $model_name == 'article' ) {
                if ( $request->has('author') ) {
                    $author = explode('-', $request->author);
                    $model->author_id   = $author[0];
                    $model->author      = $author[1];
                }
            }

            if ( $request->has('valid') )                 $model->valid = str_replace('/', '-', $request->valid);
            
            if ( $request->has('slug') ) {
                $model->og_slug = $request->slug;
                $model->slug = Str::slug($request->slug, '-');
            }

            if ( $request->has('category') ) {
                $model->category = $request->category;
            } else {
                $model->category = Crypt::decrypt($request->hidden_category);
            }
            if ( $request->has('seo_keywords') )          $model->seo_keywords = $request->seo_keywords;
            if ( $request->has('seo_description') )       $model->seo_description = $request->seo_description;

            if ( $request->hasFile('card_image') ){
                if ( $request->card_image->isValid() ) {
                    if ( $request->card_image->extension() == 'jpg' ) {
                        $card_banner = $model_name .'-'. Session::get('locale') .'-'. $model->id .'-card-banner.jpeg';
                    } else {
                        $card_banner = $model_name .'-'. Session::get('locale') .'-'. $model->id .'-card-banner.'. $request->card_image->extension();
                    }
                    $request->card_image->storeAs('images/'. $model_name .'s/', $card_banner, 'local');
                    $model->card_image = 'images/'. $model_name .'s/' . $card_banner;
                }
            }

            if ( $request->hasFile('image') ) {
                if ( $request->image->isValid() ) {
                    if ( $request->image->extension() == 'jpg' ) {
                        $image = $model_name .'-'. Session::get('locale') .'-'. $model->id .'-banner.jpeg';
                    } else {
                        $image = $model_name .'-'. Session::get('locale') .'-'. $model->id .'-banner.'. $request->image->extension();
                    }
                    $request->image->storeAs('images/'. $model_name .'s/', $image, 'local');
                    $model->image = 'images/'. $model_name .'s/' . $image .'?'. time();
                }
            }
            
            if ( $request->has('title') )                 $model->title = $request->title;
            if ( $request->has('description') )           $model->description = $request->description;

            $model->save();

            // * Sub Articles
                if ( $model_name == 'article' && $action == 'update'  ) {
                    ArticleSections::where('article_id', $model_id)->delete();
                }
                
                if ( $model_name == 'article' || $model_name == 'temp_article' ) {
                    if ( $request->has('amount_of_sections') ) {
                        foreach ( $request->amount_of_sections as $index => $value ) {
                            $article_sections = new ArticleSections;
                            $article_sections->article_id = $model->id;

                            if ( $request->hasFile('section_images.'. $index) ) {
                                if ( $request->section_images[$index]->extension() == 'jpg' ) {
                                    $asb = 'article-'. Session::get('locale') .'-'. $model->id .'-section-banner-'. $index .'.jpeg';
                                } else {
                                    $asb = 'article-'. Session::get('locale') .'-'. $model->id .'-section-banner-'. $index .'.'. $request->section_images[$index]->extension();
                                }
                                $request->section_images[$index]->storeAs('images/articles/', $asb, 'local');
                                $article_sections->image = 'images/articles/'. $asb;
                            } elseif ( $request->has('existing_image.'. $index) ) {
                                $article_sections->image = $request->existing_image[$index];
                            }

                            $article_sections->title = $request->section_title[$index];
                            $article_sections->description = $request->section_description[$index];
                            $article_sections->timestamps = false;
                            $article_sections->save();
                        }
                    }
                }
            // * Sub Articles
        }

        private function checkSlug( $category = null, $id = null ) {
            $category_validator = ['offer', 'article', 'project'];

            if ( $category == null || !in_array($category, $category_validator) ) return 'no_slug';

            if ( $category == 'offer' )     $slug = Offers::where('slug', Str::slug(request('slug'), '-'))->get()->toArray();
            if ( $category == 'article' )   $slug = Articles::where('slug', Str::slug(request('slug'), '-'))->get()->toArray();
            if ( $category == 'project' )   $slug = Projects::where('slug', Str::slug(request('slug'), '-'))->get()->toArray();

            if ( $id != null ) {
                if ( $slug != null  ) {
                    if ( $slug[0]['id'] == $id ) {
                        return false;
                    } else {
                        return true;
                    }
                } elseif ( $slug == [] ) {
                    return false;
                }
            } elseif ( $id == null ) {

                if ( $slug == [] ) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    // * Core Methods
}