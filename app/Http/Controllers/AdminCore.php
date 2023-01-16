<?php

namespace App\Http\Controllers;

// * Included Models
    use App\Models\{Admins, Logs};

    // * Pages
        use App\Models\{Blog, BlogMeta, About, Homepage, Partners, Designer, Repairs, Furniture, Terms, Contact, OrderInfo, CompanyHotline,sliderForm,reciever, Pdf};
        use App\Models\Vip\{VipPage, VipOrders, VipServices};
        use App\Models\Projects\{Projects, ProjectsPage};
        use App\Models\Products\{MarketMeta, ProductCategories, Products};
        use App\Models\Vacancies\{VacanciesPage, VacanciesRegister, Workforce};
        use App\Models\Users\{Users, UserCards, UserAdresses};
    // * Pages

    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Cookie;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Session;
    
    use HTMLMin\HTMLMin\Facades\HTMLMin;
    use Intervention\Image\Facades\Image;
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
                // if ( !$this->admin_cookie(false, 'logged') ){
                    // $data = json_decode(Crypt::decryptString(Cookie::get('admin_cookie'), false));
                    // if ( array_key_exists('can_write', $data) ) {
                    //     foreach ( $data['can_write'] as $can_write_i => $can_write_v ) {
                    //         session(['admin.can_write.'.$can_write_i => $can_write_v]);
                    //     }
                    // }

                    // if ( array_key_exists('can_edit', $data) ) {
                    //     foreach ( $data['can_edit'] as $can_edit_i => $can_edit_v ) {
                    //         session(['admin.can_edit.'.$can_edit_i => $can_edit_v]);
                    //     }
                    // }

                    // foreach ( $data['info'] as $info_i => $info_v ) {
                    //     session(['admin.info.'.$info_i => $info_v]);
                    // }
                // }
            }
        // * Reset Admin Session

        // * Check for Admin Session
            if ( !Cookie::has('admin_cookie') ) {
                if ( Route::current()->uri !== 'enter/login' ) {
                    return redirect('/enter/login')->send();
                }
            } elseif ( Cookie::has('admin_cookie') ) {
                if ( Route::current()->uri === 'enter/login' ) {
                    return redirect('/enter')->send();
                }
            }
        // * Check for Admin Session

        // * Timeframes
            // * Days To Months
                // $days = Notifications::where('current_timeframe', 'day')->get()->toArray();

                // if ( $days != [] ) {
                //     foreach ( $days as $day ) {
                //         if ( json_decode($day['lifespan'])->day < time() ) {
                //             $model = Notifications::find($day['id']);
                //             $model->current_timeframe = 'month';
                //             $model->save();
                //         }
                //     }
                // }
            // * Days To Months

            // * Months To Years
                // $months = Notifications::where('current_timeframe', 'month')->get()->toArray();

                // if ( $months != [] ) {
                //     foreach ( $months as $month ) {
                //         if ( json_decode($month['lifespan'])->month < time() ) {
                //             $model = Notifications::find($month['id']);
                //             $model->current_timeframe = 'year';
                //             $model->save();
                //         }
                //     }
                // }
            // * Months To Years
        // * Timeframes
    }

    // * Core Methods
    
        public function store( $table, Request $request ) {
            if($table == 'slider-form'){
                
                $action = $this->action($table, null, 'save', $request);
                    if ( $action == null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/slider-form/select')->with(['create_success' => true]);
                    }
           }else if ( $table == 'staff_projects' ) {
                
                if ( Admins::where('login', $request->login)->doesntExist() ) {

                    
                    $action = $this->action('staff_projects', null, 'save', $request);
                   
                    if ( $action['reason'] != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/staff_projects/select')->with(['admin_created' => true]);
                    }
                } else {
                    return redirect()->back()->with(['login_name' => true]);
                }
            }if($table == 'pdf-form'){
                
                $action = $this->action($table, null, 'save', $request);
                    if ( $action['reason'] != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/pdf-form/select')->with(['create_success' => true]);
                    }
           }else if ( $table == 'reciever-form' ) {
                
                if ( reciever::where('email', $request->email)->doesntExist() ) {

                    
                    $action = $this->action('reciever-form', null, 'save', $request);
                    
                    if ( $action['reason'] != null ) {
                        
                        return redirect('/enter/reciever-form/select')->with([$action['reason'] => true]);
                    } else {
                        
                        return redirect('/enter/reciever-form/select')->with(['create_success' => true]);
                    }
                } else {
                   
                    return redirect('/enter/reciever-form/select')->with(['email' => true]);
                }
            }else if ( $table == 'administration' ) {
                if ( Admins::where('login', $request->login)->doesntExist() ) {
                    $action = $this->action('administration', null, 'save', $request);
                    if ( $action['reason'] != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/administration/'. $action['type'] .'/edit')->with(['user_created' => true]);
                    }
                } else {
                    return redirect()->back()->with(['login_taken' => true]);
                }
            } elseif ( $this->checkSlug( $table ) == false ) {
                $this->action( $table, null, 'save', $request );
                return redirect('/enter/'. $table .'/select')->with(['create_success' => true]);
            } else {
                return redirect()->back()->with(['slug_taken' => true]);
            }


            
            
            exit;

        }

        public function update( $table, $id = null, Request $request ) {
           
           if($table == 'slider-form'){
                
                $action = $this->action($table, $id, 'update', $request);
                    if ( $action != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/slider-form/'. $action['type'] .'/edit')->with(['update_success' => true]);
                    }
           }else if ( $table == 'staff_projects' ) {  
               
                    $action = $this->action($table, $id, 'update', $request);
                    if ( $action == null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/staff_projects/select')->with(['update_success' => true]);
                    }
            }else if ( $table == 'pdf-form' ) {  
                    $action = $this->action($table, $id, 'update', $request);
                    if ( $action['reason'] != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/pdf-form/select')->with(['update_success' => true]);
                    }
            }else if ( $table == 'reciever-form' ) {  
                
                    $action = $this->action($table, $id, 'update', $request);
                    if ( $action != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/reciever-form/'. $action['type'] .'/edit')->with(['update_success' => true]);
                    }
            }
             elseif( $table == 'administration' ) {
                $requirement_1   = Admins::find($id)->login == $request->login;
                $requirement_2   = Admins::where('login', $request->login)->doesntExist();

                if ( $requirement_1 || $requirement_2 ) {
                    $action = $this->action($table, $id, 'update', $request);
                    if ( $action != null ) {
                        return redirect()->back()->with([$action['reason'] => true]);
                    } else {
                        return redirect('/enter/administration/'. $action['type'] .'/edit')->with(['update_success' => true]);
                    }
                } else {
                    return redirect()->back()->with(['login_taken' => true]);
                }
            } elseif ( $this->checkSlug( $table, $id ) == 'no_slug' ) {
                $action = $this->action( $table, null, 'update', $request );
                if ( $action != null ) {
                    return redirect()->back()->with([$action['reason'] => true]);
                } else {
                    return redirect()->back()->with(['update_success' => true]);
                }
            } elseif ( $this->checkSlug( $table, $id ) == false ) {  
                $this->action( $table, $id, 'update', $request );
                return redirect('/enter/'. $table .'/select')->with(['update_success' => true]);
            } else {
                return redirect()->back()->with(['slug_taken' => true]);
            }




            
        }

        public function restore( $table ) {
            if ( request('id_string') != null ) {
                $id_array = explode('-', request('id_string'));

                foreach ( $id_array as $id ) {
                    if ( $table == 'administration' ) {
                        $log_title = 'ადმინისტრატორში';
                        $table = Admins::find($id);
                    } elseif ( $table == 'blog' ) {
                        $log_title = 'სტატიებში';
                        $table = Blog::find($id);
                    }
                    $table->soft_delete = 'false';
                    $table->save();
                }

                $this->create_log($log_title .' რბილად აღდგენა');

                return redirect()->back()->with(['update_success' => true]);
            } else {
                return redirect()->back()->with(['error' => true]);
            }
        }

        public function delete( $table, $method = 'soft' ) {
            if ( request('id_string') != null ) {
                $id_array = explode('-', request('id_string'));
                $id_array = array_unique($id_array);

                foreach ( $id_array as $id ) {
                    if ( $method == 'soft' ) {
                        if ( $table == 'administration' ) {
                            $log_title = 'ადმინისტრატორში';
                            $model = Admins::find($id);
                        }  elseif ( $table == 'blog' ) {
                            $log_title = 'სტატიებში';
                            $model = Blog::find($id);
                        }

                        $model->soft_delete = 'true';
                        $model->save();
                    } elseif ( $method == 'hard' ) {
                        switch ($table) {
                            case 'slider-form':
                                $this->create_log('სამუდამოდ ამოიღეთ სლაიდერის ფორმა');
                                sliderForm::find($id)->delete();
                                break;
                            case 'staff_projects':
                                    $this->create_log('სამუდამოდ ამოიღეთ სლაიდერის ფორმა');
                                    Admins::find($id)->delete();
                                    break;
                            case 'pdf-form':
                                $this->create_log('სამუდამოდ ამოიღეთ სლაიდერის ფორმა');
                                Pdf::find($id)->delete();
                                break;
                            case 'reciever-form':
                                    $this->create_log('სამუდამოდ ამოიღეთ სლაიდერის ფორმა');
                                    reciever::find($id)->delete();
                                    break;
                            case 'administration':
                                $this->create_log('ადმინისტრატორის მყარად წაშლა');

                                Admins::find($id)->delete();
                                break;
                            case 'blog':
                                $this->create_log('სტატიის მყარად წაშლა');

                                Storage::deleteDirectory('images/articles/'. $id);
                                Blog::find($id)->delete();
                                break;
                            case 'project':
                                $this->create_log('ნამუშევრის წაშლა');
                                Projects::find($id)->delete();
                                Storage::deleteDirectory('images/projects/'. $id);
                               
                                break;
                            case 'project-image':
                                    $this->create_log('ნამუშევრის წაშლა');
                                    // print_r(request('img-thumb'));
                                    // exit;
                                    $item_number=request('item_number');
                                    $type=request('type');
                                    $img=substr(request('img_'.$item_number),0,strpos(request('img_'.$item_number),'?'));
                                    $img_thumb=substr(request('img_thumb_'.$item_number),0,strpos(request('img_thumb_'.$item_number),'?'));
                                    
                                    Storage::delete('/'.$img);
                                    Storage::delete('/'.$img_thumb);
                                    // exit;
                                    $model=projects::find($id);

                                    $projects=projects::where('id',$id)->get()->toArray();
                                    // print_r($projects);
                                    // echo"<br>";
                                        $items=[];
                                    foreach ($projects as $index => $project){
                                        $selection_items=json_decode($project['section_items'],true);
                                        // print_r($selection_items);
                                        foreach($selection_items as $item){
                                            if($item['type']==$type && $item['item-number']==$item_number){
                                                continue;
                                            }else{
                                                $items[]=$item;
                                            }
                                        }
                                    }
                                    
                                    ksort($items);
                                    $model->section_items = json_encode($items);
                                    $model->save();
                                    // echo'<br>';
                                    // print_r($items);

                                    // exit;

                                    return redirect('/enter/projects/edit/'.$id)->with(['delete_success' => true]);
                                    break;
                            case 'product':
                                $this->create_log('პოროდუქტის წაშლა');

                                Storage::deleteDirectory('images/products/'. $id);
                                Products::find($id)->delete();
                                break;

                                case 'product':
                                    $this->create_log('პოროდუქტის წაშლა');    
                                    Projects::find($id);
                                    Storage::deleteDirectory('images/projects/'. $id);
                                    break;

                            case 'workforce':
                                $this->create_log('სამუშაო ბაზიდან წაშლა');
                                Workforce::find($id)->delete();
                                break;
                            case 'vip-services':
                                $this->create_log('ვიპ სერვისის წაშლა');
                                VipServices::find($id)->delete();
                                return redirect('/enter/vip-services/select')->with(['delete_success' => true]);
                                break;
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

        private function action( $table, $model_id = null, $action = 'save', $request ) {
            
            $watermarkImagePath ='images/logos/symbol.png';//waterMark Image
            
            if ( $action == 'save' ) {
                switch ($table) {
                    case'slider-form':

                        
                        $data = [
                            'reason'    => null,
                            'type'      => null
                        ];
                        $model               = new sliderForm;
                        
                        $model->square_limit =$request->square_limit;
                        $model->price_low =$request->price_low;
                        $model->price_high =$request->price_high;
                        $model->status =$request->status;
                        
                        $model->save();
                        $data['type'] = $model->type;

                        return $data;
                        break;
                    case 'administration':
                        $this->create_log('ახალი ადმინის შექმნა');

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
                        // $model->number                  = ($request->has('number'))                 ? $number                           : null;
                        // $model->email                   = ($request->has('email'))                  ? $request->email                   : null;
                        // $model->identification_code     = ($request->has('identification_code'))    ? $request->identification_code     : null;
                        // $model->field_of_activity       = ($request->has('field_of_activity'))      ? $request->field_of_activity       : null;
                        $model->category                = $request->category;
                        $model->type                    = 'blogger';
                        
                        // $model->type                    = Crypt::decrypt($request->input($request->key));
                        $model->save();

                        $data['type'] = $model->type;

                        return $data;
                        break;

                        case 'staff_projects':
                            $this->create_log('ახალი ადმინის შექმნა');
    
                            $data = [
                                'reason'    => null,
                                'type'      => null
                            ];
    
                            $model                          = new Admins;
                            $model->surname                = $request->surname;
                            $model->name               = $request->name;
                            $model->number            = $request->number;
                            $model->email                   = $request->email;
                            $model->login                   = $request->login;
                            
                            $model->password                = Hash::make($request->password);



                            // $model->login                   = $request->login;
                            // $model->password                = Hash::make($request->password);
                            // $model->number                  = ($request->has('number'))                 ? $number                           : null;
                            // $model->email                   = ($request->has('email'))                  ? $request->email                   : null;
                            // $model->identification_code     = ($request->has('identification_code'))    ? $request->identification_code     : null;
                            // $model->field_of_activity       = ($request->has('field_of_activity'))      ? $request->field_of_activity       : null;
                            $model->category                = 'admin';
                            $model->type                    = 'admin';
                            
                            // $model->type                    = Crypt::decrypt($request->input($request->key));
                            $model->save();
    
                            $data['type'] = $model->type;
    
                            return $data;
                            break;

                            case 'pdf-form':
                                $this->create_log('ახალი ადმინის შექმნა');
        
                                $data = [
                                    'reason'    => null,
                                    'type'      => null
                                ];
                                $public=public_path();
                                $root=base_path();
                                $fileName=$root.'/resources/views/user/pages/repairs/invoice_slider.blade.php';
                                $file=fopen($fileName,'w+');
                                fputs($file,$request->pdf_content);
                                $model                          = new Pdf;
                                $model->pdf_content                = htmlspecialchars($request->pdf_content);
                                $model->status                    = '1';
                                $model->save();
        
                                $data['type'] = $model->type;
        
                                return $data;
                                break;

                            case 'reciever-form':
                                $this->create_log('ახალი ადმინის შექმნა');
        
                                $data = [
                                    'reason'    => null,
                                    'type'      => null
                                ];
        
                                $model                      = new reciever;
                                $model->name                = $request->name;
                                $model->email               = $request->email;
                                $model->phone               = $request->phone;
                                $model->send_email          = $request->send_email;
                                $model->send_sms            = $request->send_sms;
                                // $model->status              = $request->status;

                                // $model->identification_code     = ($request->has('identification_code'))    ? $request->identification_code     : null;
                                // $model->field_of_activity       = ($request->has('field_of_activity'))      ? $request->field_of_activity       : null;
                                // $model->category                = $request->category;
                                // $model->type                    = 'blogger';
                                
                                // $model->type                    = Crypt::decrypt($request->input($request->key));
                                $model->save();
        
                                $data['type'] = $model->type;
        
                                return $data;
                                break;


                    case 'blog':
                        // * Init
                            $this->create_log('სტატიის შექმნა');
                        
                            $model = new Blog;
                            $model->og_slug = $request->slug;
                            $model->slug = Str::slug($request->slug, '-');
                            $model->locale = $request->locale;

                            $model->save();
                        // * Init
                        
                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                            $model->date_created = date('d.m.Y');
                        // * Meta

                        // * Author
                            $cookie = json_decode(Cookie::get('admin_cookie'));
                            $model->author = Admins::find($cookie->info->id)->name;
                            $model->author_id = $cookie->info->id;
                            if ( $cookie->info->id == 1 ) $model->author = 'კომპანია მეტრიქსი';
                        // * Author
                        
                        // * Card
                            if ( $request->hasFile('card_image') ) {
                                

                                if ( $request->card_image->isValid() ) {
                                    if ( $request->card_image->extension() == 'jpg' ) {
                                        $image = 'card-image.jpeg';
                                    } else {
                                        $image = 'card-image.'. $request->card_image->extension();
                                    }
                                    $request->card_image->storeAs('images/articles/'. $model->id .'/', $image, 'local');
                                    // $dir='images/articles/'.$model->id;
                                    //             if(!is_dir($dir)){
                                    //                 mkdir($dir);
                                    //             }
                                    //                 $fileName = basename($_FILES["card_image"]["name"]); 
                                    //                 $targetFilePath = $dir.'/'.$fileName; 
                                    //                 $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //                 if(move_uploaded_file($_FILES["card_image"]["tmp_name"], $targetFilePath)){ 
                                                        
                                    //                     $image = Image::make(public_path($dir.'/'.$fileName));
                                    //                     $imageWidth = $image->width();
                                    //                     $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //                     $watermarkSize = round(20 * $imageWidth / 50);
                                    //                     $watermarkSource->resize(30,30, function ($constraint) {
                                    //                         $constraint->aspectRatio();
                                    //                     });

                                    //                     /* insert watermark at bottom-left corner with 5px offset */
                                    //                     $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //                     $image->save(public_path($dir.'/'.$fileName));
                                                    
                                                            
                                              
                                    //                 }
                                    $model->card_image = 'images/articles/'. $model->id .'/'. $image .'?'. time();
                                }
                            }
                            $model->card_description = $request->card_description;
                        // * Card

                        // * Article Content
                            $model->category = $request->category;

                            if ( $request->hasFile('banner') ) {
                                
                                if ( $request->banner->isValid() ) {
                                    if ( $request->banner->extension() == 'jpg' ) {
                                        $image = 'banner.jpeg';
                                    } else {
                                        $image = 'banner.'. $request->banner->extension();
                                    }
                                    $request->banner->storeAs('images/articles/'. $model->id .'/', $image, 'local');
                                    // $dir='images/articles/'.$model->id;
                                    //             if(!is_dir($dir)){
                                    //                 mkdir($dir);
                                    //             }
                                    //                 $fileName = basename($_FILES["banner"]["name"]); 
                                    //                 $targetFilePath = $dir.'/'.$fileName; 
                                    //                 $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //                 if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFilePath)){ 
                                                        
                                    //                     $image = Image::make(public_path($dir.'/'.$fileName));
                                    //                     $imageWidth = $image->width();
                                    //                     $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //                     $watermarkSize = round(20 * $imageWidth / 50);
                                    //                     $watermarkSource->resize(30,30, function ($constraint) {
                                    //                         $constraint->aspectRatio();
                                    //                     });

                                    //                     /* insert watermark at bottom-left corner with 5px offset */
                                    //                     $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //                     $image->save(public_path($dir.'/'.$fileName));
                                                    
                                                            
                                              
                                    //                 }
                                    $model->banner = 'images/articles/'. $model->id .'/'. $image .'?'. time();
                                }
                            }
                            
                            $model->title = $request->title;

                            $content = [];

                            for ( $i = 0; $i < 3; $i++ ) {
                                if ( $request->input('paragraph_block_'. $i) != null ) $content['paragraph_block_'. $i] = $request->input('paragraph_block_'. $i);
                            }

                            $content['spec_deal_text'] = $request->spec_deal_text;
                            $content['spec_deal_url'] = $request->spec_deal_url;

                            $content = json_encode($content);

                            $model->content = $content;

                            $sidebar_links = null;

                            foreach (['vip', 'design', 'furniture', 'repairs'] as $category) {
                                if ( $request->has('sidebar_link_'. $category) ) {
                                    $sidebar_links[$category] = $request->input('sidebar_link_'. $category);
                                }
                            }

                            $model->sidebar_links = json_encode($sidebar_links);

                            $inner_images = null;
                            $inner_image_alts = null;
                           
                            if ( $request->has('amount_of_inner_images') ) {
                                
                                foreach ( $request->amount_of_inner_images as $index => $value ) {
                                    if ( $request->hasFile('inner_images.'. $index) ) {
                                        if ( $request->file('inner_images.'. $index)->isValid() ) {
                                            if ( $request->inner_images[$index]->extension() == 'jpg' ) {
                                                $image = $request->inner_image_alts[$index] .'.jpeg';
                                            } else {
                                                $image = $request->inner_image_alts[$index] .'.'. $request->inner_images[$index]->extension();
                                            }
                                            $request->inner_images[$index]->storeAs('images/articles/'. $model->id .'/', $image, 'local');
                                            // $dir='images/articles/'.$model->id;
                                            //     if(!is_dir($dir)){
                                            //         mkdir($dir);
                                            //     }
                                            //         $fileName = basename($_FILES["amount_of_inner_images"]["name"][$index]); 
                                            //         $targetFilePath = $dir.'/'.$fileName; 
                                            //         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                            //         if(move_uploaded_file($_FILES["amount_of_inner_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                        
                                            //             $image = Image::make(public_path($dir.'/'.$fileName));
                                            //             $imageWidth = $image->width();
                                            //             $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                            //             $watermarkSize = round(20 * $imageWidth / 50);
                                            //             $watermarkSource->resize(30,30, function ($constraint) {
                                            //                 $constraint->aspectRatio();
                                            //             });

                                            //             /* insert watermark at bottom-left corner with 5px offset */
                                            //             $image->insert($watermarkSource, 'top-left', 30, 0);
                                            //             $image->save(public_path($dir.'/'.$fileName));
                                                            
                                                            
                                              
                                            //         }
                                            $inner_images[] = 'images/articles/'. $model->id .'/'. $image .'?'. time();
                                            $inner_image_alts[] = $request->inner_image_alts[$index];
                                        }
                                    }
                                }
                            }
                            
                            $model->inner_images = json_encode($inner_images);
                            $model->inner_image_alts = json_encode($inner_image_alts);
                        // * Article Content

                        $model->save();
                        return;
                        break;
                        // digiwised add work 
                    case 'projects':
                            
                            // * Init
                                $this->create_log('ნამუშევრის შექმნა');
                                
                                $model = new Projects;
                        
                                $model->save();
                                // $model->id=100;
                                $project_title = Str::slug($request->project_title);
                        
                                $project_address = Str::slug($request->project_address);

                                $embd_video = Str::slug($request->embd_video);

                                $embds_videos = Str::slug($request->embds_videos);

                             

                                $model->customer = $request->customer;
                                
                                


                            // * Card
                                $card_image = [];
                        
                                if ( $request->hasFile('card_image') ) {
                                    
                                    if ( $request->card_image->isValid() ) {
                                        if ( $request->card_image->extension() == 'jpg' ) {
                                            $image = $project_title .'.jpeg';
                                        } else {
                                            $image =$request->card_image.'.'. $request->card_image->extension();
                                        }
                                        
                                        $request->card_image->storeAs('images/projects/'. $model->id .'/', $image, 'local');

                                        // $dir='images/projects/'.$model->id;
                                        // if(!is_dir($dir)){
                                        //     mkdir($dir);
                                        // }
                                        //     $fileName = basename($_FILES["card_image"]["name"]); 
                                        //     $targetFilePath = $dir.'/'.$fileName; 
                                        //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                        //     if(move_uploaded_file($_FILES["card_image"]["tmp_name"], $targetFilePath)){ 
                                                
                                        //         $image = Image::make(public_path($dir.'/'.$fileName));
                                        //         $imageWidth = $image->width();
                                        //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                        //         // $watermarkSize = round(20 * $imageWidth / 100);
                                        //         $watermarkSource->resize(50, 50, function ($constraint) {
                                        //             $constraint->aspectRatio();
                                        //         });

                                        //         /* insert watermark at bottom-left corner with 5px offset */
                                        //         $image->insert($watermarkSource, 'top-left', 25, 0);
                                        //         $image->save(public_path($dir.'/'.$fileName));
                                                    
                                      
                                        //     }   
                                        $card_image = [
                                            'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                            'alt' => $project_title
                                        ];

                                        $model->card_image = json_encode($card_image);
                                    }
                                }
                                
                                foreach ( $this->locales as $locale ) {
                                    $card_info[$locale] = '';
                                    $card_info[$locale] = $request->input('card_description_'. $locale);
                                    $model->card_info = json_encode($card_info);
                                }
                            // * Card
                        
                            // * In Progress
                                $model->in_progress = $request->in_progress;
                            // * In Progress
                        
                            // * Banner
                                $banner = [];
                        
                                if ( $request->hasFile('banner') ) {
                                    if ( $request->banner->isValid() ) {
                                        if ( $request->banner->extension() == 'jpg' ) {
                                            $image = $request->banner_alt .'.jpeg';
                                        } else {
                                            $image = $request->banner_alt .'.'. $request->banner->extension();
                                        }
                                        $request->banner->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                        // $dir='images/projects/'.$model->id;
                                        // if(!is_dir($dir)){
                                        //     mkdir($dir);
                                        // }
                                        //     $fileName = basename($_FILES["banner"]["name"]); 
                                        //     $targetFilePath = $dir.'/'.$fileName; 
                                        //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                        //     if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFilePath)){ 
                                                
                                        //         $image = Image::make(public_path($dir.'/'.$fileName));
                                        //         $imageWidth = $image->width();
                                        //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                        //         $watermarkSize = round(20 * $imageWidth / 50);
                                        //         $watermarkSource->resize(30,30, function ($constraint) {
                                        //             $constraint->aspectRatio();
                                        //         });

                                        //         /* insert watermark at bottom-left corner with 5px offset */
                                        //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                        //         $image->save(public_path($dir.'/'.$fileName));
                                                    
                                      
                                        //     }   
                                        $banner = [
                                            'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                            'alt' => $request->banner_alt
                                        ];
                                        $model->banner = json_encode($banner);
                                    }
                                }
                            // * Banner
                        
                            // * Title
                                foreach ( $this->locales as $locale ) {
                                    $title[$locale] = '';
                                    $title[$locale] = $request->input('title_'. $locale);
                                    if ( $locale === 'ka' ) $title[$locale] = $request->project_title;
                                    $model->title = json_encode($title);
                                }
                            // * Title
                            // project address 
                            foreach ( $this->locales as $locale ) {
                                $address[$locale] = '';
                                $address[$locale] = $request->input('project_address_'. $locale);
                                if ( $locale === 'ka' ) $address[$locale] = $request->project_address;
                                $model->project_address = json_encode($address);
                            }
                            

                            // embd video 
                            foreach ( $this->locales as $locale ) {
                                $embdvideo[$locale] = '';
                                $embdvideo[$locale] = $request->input('embd_video_'. $locale);
                                if ( $locale === 'ka' ) $embdvideo[$locale] = $request->embd_video;
                                $model->embd_video = json_encode($embdvideo);
                            }

                            foreach ( $this->locales as $locale ) {
                                $embdsvideos[$locale] = '';
                                $embdsvideos[$locale] = $request->input('embds_videos_'. $locale);
                                if ( $locale === 'ka' ) $embdsvideos[$locale] = $request->embds_videos;
                                $model->embds_videos = json_encode($embdsvideos);
                            }
                            // embd video 

                            // * Categories
                                $categories = [];
                        
                                foreach ( $request->categories as $category ) {
                                    $categories[] = $category;
                                }
                        
                                $model->categories = json_encode($categories);
                            // * Categories
                        
                            // * Information
                                foreach ( $this->locales as $locale ) {
                                    $information[$locale] = '';
                                    $information[$locale] = $request->input('information_'. $locale);
                                    $model->information = json_encode($information);
                                }
                            // * Information
                        
                            // * Sections
                                $sections = [];
                                $items = [];
                                $mobile_items = [];
                        
                                if ( $request->has('amount_of_sections') ) {
                                    foreach ( $request->amount_of_sections as $index => $nulls ) {
                                        $sections[$index]['has'] = $request->section_has[$index];
                        
                                        foreach ( $this->locales as $locale ) {
                                            // $sections[$index]['titles'][$locale] = $request->input('section_titles_'. $locale)[$index];
                                            $sections[$index]['titles'][$locale] = null;
                                        }
                                    }
                                }
                                
                                
                               
                        
                                $model->sections = json_encode($sections);
                               
                                if ( $request->has('amount_of_images') ) {
                                    
                                    foreach ( $request->desktop_img as $index => $item_number ) {
                                        

                                        // if ( $request->hasFile('images.'. $index) ) {
                                        //     if ( $request->file('images.'. $index)->isValid() ) {
                                        //         if ( $request->images[$index]->extension() == 'jpg' ) {
                                        //             $image = $project_title .'-section-image-' .$index. '.jpeg';
                                        //         } else {
                                        //             $image = $project_title .'-section-image-' .$index. '.'. $request->images[$index]->extension();
                                        //         }
                                                // $request->images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                                
                                                // Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail-'. $image);
                                                $dir='images/projects/'.$model->id;
                                                if(!is_dir($dir)){
                                                    mkdir($dir);
                                                }
                                                    $fileName = basename($_FILES["amount_of_images"]["name"][$item_number]); 
                                                    $targetFilePath = $dir.'/'.$fileName; 
                                                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                                    if(move_uploaded_file($_FILES["amount_of_images"]["tmp_name"][$item_number], $targetFilePath)){ 
                                                        
                                                        $image = Image::make(public_path($dir.'/'.$fileName));
                                                        $imageWidth = $image->width();
                                                        $watermarkSource =  Image::make(public_path($watermarkImagePath));//waterMark Image

                                                        $watermarkSize = round( $imageWidth / 20);
                                                        $watermarkSize2 = round( $imageWidth / 15);
                                                        // $watermarkSource->resize($watermarkSize,30, function ($constraint) {
                                                        //     $constraint->aspectRatio();
                                                        // });
                                                        $watermarkSource->resize($watermarkSize,$watermarkSize2);
                                                                                
                                                        /* insert watermark at bottom-left corner with 5px offset */
                                                        $image->insert($watermarkSource, 'top-left',round($watermarkSize/2) , 0);
                                                        $image->save(public_path($dir.'/'.$fileName));
                                                        $webp=substr($fileName,0,strpos($fileName,'.')).'.webp';
                                                        Image::make('images/projects/'. $model->id .'/'. $fileName)->encode('webp', 90)->resize(1920, 1080)->save('images/projects/'. $model->id .'/'. 'thumbnail-'. $webp);   
                                              
                                                    }   
                                                $items[] = [
                                                    'type' => 'image',
                                                    'item-number' => $item_number,
                                                    'is_feature'=>$request->has('image_desktop_feature_'.$item_number)?'1':'0',
                                                    'belongs' => $request->input('belongs-'. $item_number),
                                                    'location' => 'images/projects/'. $model->id .'/'. $fileName .'?'. time(),
                                                    'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail-'. $webp .'?'. time(),
                                                    'alt' => $project_title. '-regular-' .$item_number
                                                ];
                                            // }
                                        // }

                                    }
                                }
                                
                                if ( $request->has('amount_of_mobile_images') ) {
                                    

                                    foreach ( $request->mobi_img as $index => $item_number ) {
                                        // if ( $request->hasFile('mobile_images.'. $index) ) {
                                        //     if ( $request->file('mobile_images.'. $index)->isValid() ) {
                                        //         if ( $request->mobile_images[$index]->extension() == 'jpg' ) {
                                        //             $image = $project_title .'-mobile-image-' .$index. '.jpeg';
                                        //         } else {
                                        //             $image = $project_title .'-mobile-image-' .$index. '.'. $request->mobile_images[$index]->extension();
                                        //         }
                                        //         //$request->mobile_images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                        //         Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail-'. $image);
                                                $dir='images/projects/'.$model->id;
                                                if(!is_dir($dir)){
                                                    mkdir($dir);
                                                }
                                                    $fileName = basename($_FILES["amount_of_mobile_images"]["name"][$index]); 
                                                    $targetFilePath = $dir.'/'.$fileName; 
                                                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                                    if(move_uploaded_file($_FILES["amount_of_mobile_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                        
                                                        $image = Image::make(public_path($dir.'/'.$fileName));
                                                        $imageWidth = $image->width();
                                                        $watermarkSource =  Image::make(public_path($watermarkImagePath));//waterMark Image

                                                        $watermarkSize = round( $imageWidth / 20);
                                                        $watermarkSize2 = round( $imageWidth / 15);
                                                        // $watermarkSource->resize($watermarkSize,30, function ($constraint) {
                                                        //     $constraint->aspectRatio();
                                                        // });
                                                        $watermarkSource->resize($watermarkSize,$watermarkSize2);
                                                                                
                                                        /* insert watermark at bottom-left corner with 5px offset */
                                                        $image->insert($watermarkSource, 'top-left',round($watermarkSize/2) , 0);
                                                        $image->save(public_path($dir.'/'.$fileName));
                                                        $webp=substr($fileName,0,strpos($fileName,'.')).'.webp';

                                                        Image::make('images/projects/'. $model->id .'/'. $fileName)->encode('webp', 90)->resize(1920, 1080)->save('images/projects/'. $model->id .'/'. 'thumbnail-'. $webp);   
                                                            
                                              
                                                    }   
                                                $items[] = [
                                                    'type' => 'mobile_image',
                                                    'item-number' => $item_number,
                                                    'is_feature'=>$request->has('image_mobile_feature_'.$item_number)?'1':'0',
                                                    'belongs' => $request->input('belongs-'. $item_number),
                                                    'location' => 'images/projects/'. $model->id .'/'. $fileName .'?'. time(),
                                                    'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail-'. $webp .'?'. time(),
                                                    'alt' => $project_title. '-mobile-' .$item_number
                                                ];
                                        //     }
                                        // }
                                        

                                    }
                                }
                               


                                // if ( $request->has('amount_of_images') ) {
                                //     $i=0;
                                //     foreach ( $request->amount_of_images as $index => $item_number ) {
                                //         if ( $request->hasFile('images.'. $index) ) {
                                //             if ( $request->file('images.'. $index)->isValid() ) {
                                //                 if ( $request->images[$index]->extension() == 'jpg' ) {
                                //                     $image = $project_title .'-section-image-' .$index. '.jpeg';
                                //                 } else {
                                //                     $image = $project_title .'-section-image-' .$index. '.'. $request->images[$index]->extension();
                                //                 }
                                //                 // $request->images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                                
                                //                 Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail-'. $image);
                                //                 $dir='images/projects/'.$model->id;
                                //                 if(!is_dir($dir)){
                                //                     mkdir($dir);
                                //                 }
                                //                     $fileName = basename($_FILES["amount_of_images"][$i]["name"]); 
                                //                     $targetFilePath = $dir.'/'.$fileName; 
                                //                     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                //                     if(move_uploaded_file($_FILES["amount_of_images"][$i]["tmp_name"], $targetFilePath)){ 
                                                        
                                //                         $image = Image::make(public_path($dir.'/'.$fileName));
                                //                         /* insert watermark at bottom-left corner with 5px offset */
                                //                         $image->insert(public_path('images/logos/favicon.png'), 'top-left', 5, 5);
                                //                         $image->save(public_path($dir.'/'.$fileName));
                                                            
                                              
                                //                     }   
                                //                 $items[$item_number] = [
                                //                     'type' => 'image',
                                //                     'item-number' => $item_number,
                                //                     'belongs' => $request->input('belongs-'. $item_number),
                                //                     'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                //                     'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail-'. $fileName .'?'. time(),
                                //                     'alt' => $project_title. '-regular-' .$item_number
                                //                 ];
                                //             }
                                //         }
                                //         $i++;

                                //     }
                                // }
                        
                                // if ( $request->has('amount_of_mobile_images') ) {
                                    

                                //     foreach ( $request->amount_of_mobile_images as $index => $item_number ) {
                                //         if ( $request->hasFile('mobile_images.'. $index) ) {
                                //             if ( $request->file('mobile_images.'. $index)->isValid() ) {
                                //                 if ( $request->mobile_images[$index]->extension() == 'jpg' ) {
                                //                     $image = $project_title .'-mobile-image-' .$index. '.jpeg';
                                //                 } else {
                                //                     $image = $project_title .'-mobile-image-' .$index. '.'. $request->mobile_images[$index]->extension();
                                //                 }
                                //                 //$request->mobile_images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                //                 Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail-'. $image);
                                //                 $dir='images/projects/'.$model->id;
                                //                 if(!is_dir($dir)){
                                //                     mkdir($dir);
                                //                 }
                                //                     $fileName = basename($_FILES["amount_of_mobile_images"][$i]["name"]); 
                                //                     $targetFilePath = $dir.'/'.$fileName; 
                                //                     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                //                     if(move_uploaded_file($_FILES["amount_of_mobile_images"][$i]["tmp_name"], $targetFilePath)){ 
                                                        
                                //                         $image = Image::make(public_path($dir.'/'.$fileName));
                                //                         /* insert watermark at bottom-left corner with 5px offset */
                                //                         $image->insert(public_path('images/logos/favicon.png'), 'top-left', 5, 5);
                                //                         $image->save(public_path($dir.'/'.$fileName));
                                                            
                                              
                                //                     }   
                                //                 $items[$item_number] = [
                                //                     'type' => 'mobile_image',
                                //                     'item-number' => $item_number,
                                //                     'belongs' => $request->input('belongs-'. $item_number),
                                //                     'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                //                     'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail-'. $image .'?'. time(),
                                //                     'alt' => $project_title. '-mobile-' .$item_number
                                //                 ];
                                //             }
                                //         }
                                        

                                //     }
                                // }
                        
                                if ( $request->has('amount_of_videos') ) {
                                    foreach ( $request->amount_of_videos as $index => $item_number ) {
                                       if($item_number==0){
                                        $text='რემონტამდე';
                                       }elseif($item_number==1){
                                        $text='რემონტის შემდეგ';
                                       }
                                       
                                        $items[] = [
                                            'type' => 'video',
                                            'text' =>$text,
                                            'item-number' => $index,
                                            'belongs' => $request->input('belongs-'. $index),
                                            'code' => $item_number,
                                        ];
                                    }
                                }   

                                if ( $request->has('mobile_video') ) {
                                    foreach ( $request->mobile_video as $index => $item_number ) {
                                       if($item_number==0){
                                        $text='რემონტამდე';
                                       }elseif($item_number==1){
                                        $text='რემონტის შემდეგ';
                                       }
                                       
                                        $items[] = [
                                            'type' => 'mobile_video',
                                            'text' =>$text,
                                            'item-number' => $index,
                                            'belongs' => $request->input('belongs-'. $index),
                                            'code' => $item_number,
                                        ];
                                    }
                                } 
                           
                                // echo "<pre>";
                                // print_r($items);
                                // echo "</pre>";
                                // exit;        
                                ksort($items);
                                $model->section_items = json_encode($items);
                                if($request->has('show_on_homepage')){
                                    $model->show_on_homepage = 1;
                                }else{
                                    $model->show_on_homepage = 0;

                                }
                                if($request->has('show_on_servicepage')){
                                    $model->show_on_servicepage=1;
                                }else{
                                    $model->show_on_servicepage=0;

                                }
                                
                               
                            // * Sections
                            $model->save();
                            return;
                            break;
                        // digiwised add work 
                    case 'product':
                        // * Init
                            $this->create_log('პროდუქტის დამატება');
                        
                            $model = new Products;
                            $model->og_slug = $request->slug;
                            $model->slug = Str::slug($request->slug, '-');

                            $model->save();
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Misc
                            $model->belongs_category = $request->belongs_category;
                            $model->belongs_sub_category = $request->belongs_sub_category;
                            $model->brand = $request->brand;
                            $model->country = $request->country;
                        // * Misc

                        // * Price and Variants
                            $model->price = (float)$request->price;
                            if ( $request->has('discount') ) {
                                $model->discount = $request->discount;
                                $model->discount_amount = (float)(100 - $request->discount_amount) / 100;
                                $model->discount_amount_original = $request->discount_amount;
                            } else {
                                $model->discount = 'false';
                                $model->discount_amount = 0;
                                $model->discount_amount_original = 0;
                            }
                            $model->measuring = $request->measuring;

                            $model->has_variants = $request->has_variants;
                            $variants = [];

                            if ( $request->has('amount_of_variants') ) {
                                foreach ( $request->amount_of_variants as $index => $nulls ) {
                                    $variants[$index] = [
                                        'weights' => $request->variant_weights[$index],
                                        'prices' => (float)$request->variant_prices[$index]
                                    ];
                                }
                            }

                            $model->variants = json_encode($variants);
                        // * Price and Variants

                        // * Main
                            if ( $request->hasFile('image') ) {
                                if ( $request->image->isValid() ) {
                                    if ( $request->image->extension() == 'jpg' ) {
                                        // $image = $request->image_alt .'.jpeg';
                                        $image = Str::slug($request->meta_title) .'.jpeg';
                                    } else {
                                        // $image = $request->image_alt .'.'. $request->image->extension();
                                        $image = Str::slug($request->meta_title) .'.'. $request->image->extension();
                                    }
                                    $request->image->storeAs('images/products/'. $model->id .'/', $image, 'local');
                                    // $dir='images/products/'.$model->id;
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["image"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     } 
                                    Image::make('images/products/'. $model->id .'/'. $image)->encode('webp', 90)->resize(400, 400)->save('images/products/'. $model->id .'/'. $image);
                                    $model->image = 'images/products/'. $model->id .'/'. $image .'?'. time();

                                    Image::make('images/products/'. $model->id .'/'. $image)->encode('webp', 90)->resize(130, 130)->save('images/products/'. $model->id .'/thumbnail_'. $image);
                                    $model->card_image = 'images/products/'. $model->id .'/thumbnail_'. $image .'?'. time();
                                }
                            }
                            $model->image_alt = $request->meta_title;

                            // * Card
                                // $model->card_image_alt = 'thumbnail_'. $request->image_alt;
                                $model->card_image_alt = 'thumbnail_'. Str::slug($request->meta_title);
                                $model->card_description = $request->card_description;
                            // * Card

                            $model->name = $request->product_name;
                            // $model->card_description = $request->card_description;
                            $model->card_description = $request->product_name;

                            $additional_info = [];

                            if ( $request->has('amount_of_additional_info') ) {
                                foreach ( $request->amount_of_additional_info as $index => $nulls ) {
                                    $additional_info[$index] = [
                                        'left' => $request->additional_information_left[$index],
                                        'right' => $request->additional_information_right[$index]
                                    ];
                                }
                            }

                            $model->additional_information = json_encode($additional_info);
                        // * Main

                        $model->save();
                        return;
                        break;
                    case 'vip-services':
                        
                        // * Init
                            $this->create_log('ვიპ-მასტერის სერვისის დამატება');
                        
                            $model = new VipServices;
                            $model->og_slug = $request->slug;
                            $model->slug = Str::slug($request->slug, '-');
                            $model->locale = $request->locale;

                            $model->save();
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->inner_title = $request->inner_title;
                            $model->outside_title = $request->outside_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta
                        
                        // * Image
                            if ( $request->hasFile('image') ) {
                                if ( $request->image->isValid() ) {
                                    if ( $request->image->extension() == 'jpg' ) {
                                        $image = 'image.jpeg';
                                    } else {
                                        $image = 'image.'. $request->image->extension();
                                    }
                                    $request->image->storeAs('images/vip-services/'. $model->id .'/', $image, 'local');
                                    // $dir='images/vip-services/'.$model->id;
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["image"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     }
                                    Image::make('images/vip-services/'. $model->id .'/'. $image)->encode('webp', 90)->resize(400, 400)->save('images/vip-services/'. $model->id .'/'. $image);
                                    $model->image = 'images/vip-services/'. $model->id .'/'. $image .'?'. time();
                                }
                            }
                        // * Image

                        // * Data
                            $model->description = $request->description;
                            $model->description_lg = $request->description_lg;
                            $model->belongs = $request->belongs;
                        // * Data
                        
                        $model->save();
                        return;
                        break;
                }
            } elseif ( $action == 'update' ) {
                
                switch ($table) {
                    case 'pdf-form':
                        $this->create_log('ახალი ადმინის შექმნა');

                        $data = [
                            'reason'    => null,
                            'type'      => null
                        ];
                        $public=public_path();
                        $root=base_path();
                        $fileName=$root.'/resources/views/user/pages/repairs/invoice_slider.blade.php';
                        $file=fopen($fileName,'w+');
                        fputs($file,$request->pdf_content);
                        
                        $model                          = Pdf::find($model_id);
                        $model->pdf_content                = htmlspecialchars($request->pdf_content);
                        $model->status                    = $request->status;
                        $model->updated_at                    = date('Y-m-d H:i:s');
                        $model->save();

                        $data['type'] = $model->type;

                        return $data;
                        break;
                    case'slider-form':

                        
                        $data = [
                            'reason'    => null,
                            'type'      => null
                        ];
                        $model               = sliderForm::find($model_id);
                        
                        $model->square_limit =$request->square_limit;
                        $model->price_low =$request->price_low;
                        $model->price_high =$request->price_high;
                        $model->status =$request->status;
                        
                        $model->save();
                        $data['type'] = $model->type;

                        return $data;
                        break;
                    case 'administration':
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
                        // $model->number                      = ($request->has('number'))                 ? $number                           : null;
                        // $model->email                       = ($request->has('email'))                  ? $request->email                   : null;
                        // $model->identification_code         = ($request->has('identification_code'))    ? $request->identification_code     : null;
                        // $model->field_of_activity           = ($request->has('field_of_activity'))      ? $request->field_of_activity       : null;
                        // $model->category                    = ($request->has('category'))               ? $request->category                : Crypt::decrypt($request->input($request->c_key));
                        // $model->type                        = Crypt::decrypt($request->input($request->t_key));
                        $model->type                        = 'blogger';
                        $model->category                    = $request->category;
                        $model->save();

                        $data['type'] = $model->type;

                        return $data;
                        break;
                    case 'staff_projects':
                            $this->create_log('ახალი ადმინის შექმნა');
    
                            $data = [
                                'reason'    => null,
                                'type'      => null
                            ];
    
                            $model                          = Admins::find($model_id);
                            $model->surname                 = $request->surname;
                            $model->name                    = $request->name;
                            $model->number                  = $request->number;
                            $model->email                   = $request->email;
                            $model->login                   = $request->login;
                            if(!empty($request->password)){

                                $model->password                = Hash::make($request->password);
                            }



                            // $model->login                   = $request->login;
                            // $model->password                = Hash::make($request->password);
                            // $model->number                  = ($request->has('number'))                 ? $number                           : null;
                            // $model->email                   = ($request->has('email'))                  ? $request->email                   : null;
                            // $model->identification_code     = ($request->has('identification_code'))    ? $request->identification_code     : null;
                            // $model->field_of_activity       = ($request->has('field_of_activity'))      ? $request->field_of_activity       : null;
                            // $model->category                = $request->category;
                            // $model->type                    = 'blogger';
                            
                            // $model->type                    = Crypt::decrypt($request->input($request->key));
                            
                            $model->save();
    
                            // $data['type'] = $model->type;
    
                            return $data;
                            break;

                            
                    case 'reciever-form':
                                $this->create_log('ახალი ადმინის შექმნა');
        
                                $data = [
                                    'reason'    => null,
                                    'type'      => null
                                ];
        
                                $model                      = reciever::find($model_id);
                                $model->name                = $request->name;
                                $model->email               = $request->email;
                                $model->phone               = $request->phone;
                                $model->send_email          = $request->send_email;
                                $model->send_sms            = $request->send_sms;
                                $model->status              = $request->status;

                                
                                // $model->password                = Hash::make($request->password);
    
    
    
                                // $model->login                   = $request->login;
                                // $model->password                = Hash::make($request->password);
                                // $model->number                  = ($request->has('number'))                 ? $number                           : null;
                                // $model->email                   = ($request->has('email'))                  ? $request->email                   : null;
                                // $model->identification_code     = ($request->has('identification_code'))    ? $request->identification_code     : null;
                                // $model->field_of_activity       = ($request->has('field_of_activity'))      ? $request->field_of_activity       : null;
                                // $model->category                = $request->category;
                                // $model->type                    = 'blogger';
                                
                                // $model->type                    = Crypt::decrypt($request->input($request->key));
                                
                                $model->save();
        
                                // $data['type'] = $model->type;
        
                                return $data;
                                break;


                    case 'blog':
                        // * Init
                            $this->create_log('სტატიის რედაქტირება');
                        
                            $model = Blog::find($model_id);
                            $model->og_slug = $request->slug;
                            $model->slug = Str::slug($request->slug, '-');
                            $model->locale = $request->locale;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Card
                            if ( $request->hasFile('card_image') ) {
                                if ( $request->card_image->isValid() ) {
                                    if ( $request->card_image->extension() == 'jpg' ) {
                                        $image = 'card-image.jpeg';
                                    } else {
                                        $image = 'card-image.'. $request->card_image->extension();
                                    }
                                    $request->card_image->storeAs('images/articles/'. $model->id .'/', $image, 'local');
                                    Image::make('images/articles/'. $model->id .'/'. $image)->encode('webp', 90)->resize(350, 220)->save('images/articles/'. $model->id .'/'. $image);

                                    // $dir='images/articles/'.$model->id;
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["card_image"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["card_image"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                        
                                                
                                  
                                    //     }
                                        Image::make('images/articles/'. $model->id .'/'. $image)->encode('webp', 90)->resize(350, 220)->save('images/articles/'. $model->id .'/'. $image);
                                    $model->card_image = 'images/articles/'. $model->id .'/'. $image .'?'. time();
                                }
                            }
                            $model->card_description = $request->card_description;
                        // * Card

                        // * Article Content
                            $model->category = $request->category;

                            if ( $request->hasFile('banner') ) {
                                if ( $request->banner->isValid() ) {
                                    if ( $request->banner->extension() == 'jpg' ) {
                                        $image = 'banner.jpeg';
                                    } else {
                                        $image = 'banner.'. $request->banner->extension();
                                    }
                                    $request->banner->storeAs('images/articles/'. $model->id .'/', $image, 'local');
                                    // $dir='images/articles/'.$model->id;
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                        
                                                
                                  
                                    //     }
                                    Image::make('images/articles/'. $model->id .'/'. $image)->encode('webp', 90)->resize(1000, 400)->save('images/articles/'. $model->id .'/'. $image);
                                    $model->banner = 'images/articles/'. $model->id .'/'. $image .'?'. time();
                                }
                            }

                            $model->title = $request->title;

                            $content = [];

                            for ( $i = 0; $i < 3; $i++ ) {
                                if ( $request->input('paragraph_block_'. $i) != null ) $content['paragraph_block_'. $i] = $request->input('paragraph_block_'. $i);
                            }

                            ( $request->spec_deal_text != null ) ? $content['spec_deal_text'] = $request->spec_deal_text : $content['spec_deal_text'] = 'null';
                            ( $request->spec_deal_url != null ) ? $content['spec_deal_url'] = $request->spec_deal_url : $content['spec_deal_url'] = 'null';

                            $content = json_encode($content);

                            $model->content = $content;

                            $sidebar_links = null;

                            foreach (['vip', 'design', 'furniture', 'repairs'] as $category) {
                                if ( $request->has('sidebar_link_'. $category) ) {
                                    $sidebar_links[$category] = $request->input('sidebar_link_'. $category);
                                }
                            }

                            $model->sidebar_links = json_encode($sidebar_links);

                            $inner_images = null;
                            $inner_image_alts = null;

                            if ( $request->has('amount_of_inner_images') ) {
                                foreach ( $request->amount_of_inner_images as $index => $value ) {
                                    if ( $request->hasFile('inner_images.'. $index) ) {
                                        if ( $request->file('inner_images.'. $index)->isValid() ) {
                                            if ( $request->inner_images[$index]->extension() == 'jpg' ) {
                                                $image = $request->inner_image_alts[$index] .'.jpeg';
                                            } else {
                                                $image = $request->inner_image_alts[$index] .'.'. $request->inner_images[$index]->extension();
                                            }
                                            $request->inner_images[$index]->storeAs('images/articles/'. $model->id .'/', $image, 'local');
                                            $inner_images[] = 'images/articles/'. $model->id .'/'. $image .'?'. time();
                                            $inner_image_alts[] = $request->inner_image_alts[$index];
                                        }
                                    } elseif ( $request->has('existing_inner_images.'. $index) ) {
                                        $inner_images[] = $request->existing_inner_images[$index];
                                        $inner_image_alts[] = $request->inner_image_alts[$index];
                                    }
                                }
                            }

                            $model->inner_images = json_encode($inner_images);
                            $model->inner_image_alts = json_encode($inner_image_alts);
                        // * Article Content

                        $model->save();

                        return;
                        break;
                    case 'blog-meta':
                        // * Init
                            $this->create_log('ბლოგის რედაქტირება');
                            ( BlogMeta::where('id', 1)->exists() ) ? $model = BlogMeta::find(1) : $model = new BlogMeta;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        $model->save();
                        return;
                        break;
                    case 'homepage':
                        // * Init
                            $this->create_log('მთავარი გვერდის რედაქტირება');
                            ( Homepage::where('id', 1)->exists() ) ? $model = Homepage::find(1) : $model = new Homepage;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                            $model->text_add = implode(',',$request->text_add);
                            $model->text_paragraph = implode(',',$request->text_paragraph);
                            $model->add_link = implode(',',$request->add_link);
                            $model->add_button = implode(',',$request->add_button);
                        // * Meta

                        // * Slider
                            $slides = [];

                            if ( $request->has('amount_of_homepage_slides') ) {
                                foreach ( $request->amount_of_homepage_slides as $index => $value )
                               
                                 {
                                    if ( $request->hasFile('homepage_slides.'. $index) ) {
                                        if ( $request->file('homepage_slides.'. $index)->isValid() ) {
                                            if ( $request->homepage_slides[$index]->extension() == 'jpg' ) {
                                                $image = $request->homepage_slide_alts[$index] .'.jpeg';
                                            } else {
                                                $image = $request->homepage_slide_alts[$index] .'.'. $request->homepage_slides[$index]->extension();
                                            }
                                            $request->homepage_slides[$index]->storeAs('images/homepage/', $image, 'local');

                                            // $dir='images/homepage';
                                            // if(!is_dir($dir)){
                                            //     mkdir($dir);
                                            // }
                                            //     $fileName = basename($_FILES["homepage_slides"]["name"][$index]); 
                                            //     $targetFilePath = $dir.'/'.$fileName; 
                                            //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                            //     if(move_uploaded_file($_FILES["homepage_slides"]["tmp_name"][$index], $targetFilePath)){ 
                                                    
                                            //         $image = Image::make(public_path($dir.'/'.$fileName));
                                            //         $imageWidth = $image->width();
                                            //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));
    
                                            //         $watermarkSize = round(20 * $imageWidth / 50);
                                            //         $watermarkSource->resize(30,30, function ($constraint) {
                                            //             $constraint->aspectRatio();
                                            //         });
    
                                            //         /* insert watermark at bottom-left corner with 5px offset */
                                            //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                            //         $image->save(public_path($dir.'/'.$fileName));
                                                        
                                          
                                            //     }  

                                            $slides[$index]['location'] = 'images/homepage/'. $image .'?'. time();
                                            $slides[$index]['alt'] = $request->homepage_slide_alts[$index];
                                        }
                                    } elseif ( $request->has('existing_homepage_slides.'. $index) ) {
                                        $slides[$index]['location'] = $request->existing_homepage_slides[$index];
                                        $slides[$index]['alt'] = $request->homepage_slide_alts[$index];
                                    }
                                    
                                }
                            }

                            $model->slides = json_encode($slides);
                        // * Slider

                        // * Mob Slider
                            $mob_slides = [];

                            if ( $request->has('amount_of_mob_homepage_slides') ) {
                                foreach ( $request->amount_of_mob_homepage_slides as $index => $value ) {
                                    if ( $request->hasFile('mob_homepage_slides.'. $index) ) {
                                        if ( $request->file('mob_homepage_slides.'. $index)->isValid() ) {
                                            if ( $request->mob_homepage_slides[$index]->extension() == 'jpg' ) {
                                                $image = $request->mob_homepage_slide_alts[$index] .'.jpeg';
                                            } else {
                                                $image = $request->mob_homepage_slide_alts[$index] .'.'. $request->mob_homepage_slides[$index]->extension();
                                            }
                                            $request->mob_homepage_slides[$index]->storeAs('images/homepage/', $image, 'local');
                                            $mob_slides[$index]['location'] = 'images/homepage/'. $image .'?'. time();
                                            $mob_slides[$index]['alt'] = $request->mob_homepage_slide_alts[$index];
                                        }
                                    } elseif ( $request->has('existing_mob_homepage_slides.'. $index) ) {
                                        $mob_slides[$index]['location'] = $request->existing_mob_homepage_slides[$index];
                                        $mob_slides[$index]['alt'] = $request->mob_homepage_slide_alts[$index];
                                    }
                                }
                            }

                            $model->mob_slides = json_encode($mob_slides);
                        // * Slider

                        // * Video
                            $video = [];
                            foreach ( $this->locales as $locale ) {
                                ( $request->input('video_text_'. $locale) != null ) ? $video['video_text'][$locale] = $request->input('video_text_'. $locale) : $video['video_text'][$locale] = 'null';
                            }
                            ( $request->video_link != null ) ? $video['video_link'] = $request->video_link : $video['video_link'] = '#';
                            ( $request->video_button_link != null ) ? $video['video_button_link'] = $request->video_button_link : $video['video_button_link'] = '#';

                            $model->video = json_encode($video);
                        // * Video

                        // * About
                            $about = [];

                            foreach ( $this->locales as $locale ) {
                                for ($i = 0; $i < 4; $i++) {
                                    ( $request->input('about_text_'. $locale .'_'. $i) != null ) ? $about[$locale]['text_'. $i] = $request->input('about_text_'. $locale .'_'. $i) : $about[$locale]['text_'. $i] = 'null';
                                }
                            }

                            $model->about = json_encode($about);
                        // * About

                        $model->save();

                        return;
                        break;
                    case 'contact':
                        // * Init
                            $this->create_log('მთავარი გვერდის რედაქტირება');
                            ( Contact::where('id', 1)->exists() ) ? $model = Contact::find(1) : $model = new Contact;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Services
                            $services = [];

                            if ( $request->has('services') ) {
                                foreach ( $request->services as $service ) {
                                    $services[] = $service;
                                }
                            }

                            $model->services = json_encode($services);
                        // * Services

                        // * Content
                            foreach ( ['address', 'mobile_number', 'house_number', 'mail'] as $input ) {
                                $model->$input = $request->input($input);
                            }
                        // * Content

                        $model->save();
                        
                        return;
                        break;
                    case 'partners':
                        // * Init
                            $this->create_log('პარტნიორების რედაქტირება');
                            ( Partners::where('id', 1)->exists() ) ? $model = Partners::find(1) : $model = new Partners;
                        // * Init

                        // * Slider
                            $slides = [];

                            if ( $request->has('amount_of_partner_slides') ) {
                                foreach ( $request->amount_of_partner_slides as $index => $value ) {
                                    if ( $request->hasFile('partner_slides.'. $index) ) {
                                        if ( $request->file('partner_slides.'. $index)->isValid() ) {
                                            if ( $request->partner_slides[$index]->extension() == 'jpg' ) {
                                                $image = $request->partner_slide_alts[$index] .'.jpeg';
                                            } else {
                                                $image = $request->partner_slide_alts[$index] .'.'. $request->partner_slides[$index]->extension();
                                            }
                                            $request->partner_slides[$index]->storeAs('images/partners/', $image, 'local');

                                            // $dir='images/partners/';
                                            // if(!is_dir($dir)){
                                            //     mkdir($dir);
                                            // }
                                            //     $fileName = basename($_FILES["partner_slides"]["name"][$index]); 
                                            //     $targetFilePath = $dir.'/'.$fileName; 
                                            //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                            //     if(move_uploaded_file($_FILES["partner_slides"]["tmp_name"][$index], $targetFilePath)){ 
                                                    
                                            //         $image = Image::make(public_path($dir.'/'.$fileName));
                                            //         $imageWidth = $image->width();
                                            //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));
        
                                            //         $watermarkSize = round(20 * $imageWidth / 50);
                                            //         $watermarkSource->resize(30,30, function ($constraint) {
                                            //             $constraint->aspectRatio();
                                            //         });
        
                                            //         /* insert watermark at bottom-left corner with 5px offset */
                                            //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                            //         $image->save(public_path($dir.'/'.$fileName));
                                                        
                                          
                                            //     } 
                                            
                                            Image::make('images/partners/'. $image)->encode('webp', 90)->resize(285, 130)->save('images/partners/'. $image);
                                            $slides[$index]['location'] = 'images/partners/'. $image .'?'. time();
                                            $slides[$index]['alt'] = $request->partner_slide_alts[$index];
                                        }
                                    } elseif ( $request->has('existing_partner_slides.'. $index) ) {
                                        $slides[$index]['location'] = $request->existing_partner_slides[$index];
                                        $slides[$index]['alt'] = $request->partner_slide_alts[$index];
                                    }
                                }
                            }

                            $model->slides = json_encode($slides);
                        // * Slider

                        $model->save();

                        return;
                        break;
                    case 'terms':
                        // * Init
                            $this->create_log('წესების და პირობების რედაქტირება');
                            ( Terms::where('id', 1)->exists() ) ? $model = Terms::find(1) : $model = new Terms;
                        // * Init

                        $model->content = $request->content;

                        $model->save();

                        return;
                        break;
                    case 'about':
                        // * Init
                            $this->create_log('ჩვენს შესახებ გვერდის რედაქტირება');
                            ( About::where('id', 1)->exists() ) ? $model = About::find(1) : $model = new About;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Video Links
                            $model->link = $request->link;
                        // * Video Links    

                        // * Content
                            $content = [];

                            foreach ( $this->locales as $locale ) {
                                for ( $i = 0; $i < 4; $i++ ) {
                                    ( $request->input('paragraph_block_'. $locale .'_'. $i) != null ) ? $content[$locale]['paragraph_block_'. $i] = $request->input('paragraph_block_'. $locale .'_'. $i) : $content[$locale]['paragraph_block_'. $i] = 'null';
                                }

                                for ( $i = 0; $i < 5; $i++ ) {
                                    ( $request->input('title_'. $locale .'_'. $i) != null ) ? $content[$locale]['title_'. $i] = $request->input('title_'. $locale .'_'. $i) : $content[$locale]['title_'. $i] = 'null';
                                }
                            }

                            $model->content = json_encode($content);
                        // * Content

                        // * Links
                            $links = [];

                            foreach ( $request->links as $link ) {
                                $links[] = $link;
                            }

                            $model->links = json_encode($links);
                        // * Links

                        // * Inner Images
                            $inner_images = [];

                            if ( $request->has('amount_of_inner_images') ) {
                                foreach ( $request->amount_of_inner_images as $index => $value ) {
                                    if ( $request->hasFile('inner_images.'. $index) ) {
                                        if ( $request->file('inner_images.'. $index)->isValid() ) {
                                            if ( $request->inner_images[$index]->extension() == 'jpg' ) {
                                                $image = $request->inner_image_alts[$index] .'.jpeg';
                                            } else {
                                                $image = $request->inner_image_alts[$index] .'.'. $request->inner_images[$index]->extension();
                                            }
                                            $request->inner_images[$index]->storeAs('images/about/', $image, 'local');

                                            // $dir='images/about';
                                            // if(!is_dir($dir)){
                                            //     mkdir($dir);
                                            // }
                                            //     $fileName = basename($_FILES["inner_images"]["name"][$index]); 
                                            //     $targetFilePath = $dir.'/'.$fileName; 
                                            //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                            //     if(move_uploaded_file($_FILES["inner_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                    
                                            //         $image = Image::make(public_path($dir.'/'.$fileName));
                                            //         $imageWidth = $image->width();
                                            //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));
    
                                            //         $watermarkSize = round(20 * $imageWidth / 50);
                                            //         $watermarkSource->resize(30,30, function ($constraint) {
                                            //             $constraint->aspectRatio();
                                            //         });
    
                                            //         /* insert watermark at bottom-left corner with 5px offset */
                                            //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                            //         $image->save(public_path($dir.'/'.$fileName));
                                                        
                                          
                                            //     }  


                                            $inner_images[$index]['location'] = 'images/about/'. $image .'?'. time();
                                            $inner_images[$index]['alt'] = $request->inner_image_alts[$index];
                                        }
                                    } elseif ( $request->has('existing_inner_images.'. $index) ) {
                                        $inner_images[$index]['location'] = $request->existing_inner_images[$index];
                                        $inner_images[$index]['alt'] = $request->inner_image_alts[$index];
                                    }
                                }
                            }

                            $model->inner_images = json_encode($inner_images);
                        // * Inner Images

                        // * HR
                            $hr = [];

                            if ( $request->has('amount_of_hr') ) {
                                foreach ( $request->amount_of_hr as $index => $value ) {
                                    if ( $request->hasFile('hr_images.'. $index) ) {
                                        if ( $request->file('hr_images.'. $index)->isValid() ) {
                                            if ( $request->hr_images[$index]->extension() == 'jpg' ) {
                                                $image = $request->hr_name_ka[$index].'.jpeg';
                                            } else {
                                                $image = $request->hr_name_ka[$index].'.'. $request->hr_images[$index]->extension();
                                            }
                                            $request->hr_images[$index]->storeAs('images/about/', $image, 'local');
                                            // $dir='images/about';
                                            // if(!is_dir($dir)){
                                            //     mkdir($dir);
                                            // }
                                            //     $fileName = basename($_FILES["hr_images"]["name"][$index]); 
                                            //     $targetFilePath = $dir.'/'.$fileName; 
                                            //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                            //     if(move_uploaded_file($_FILES["hr_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                    
                                            //         $image = Image::make(public_path($dir.'/'.$fileName));
                                            //         $imageWidth = $image->width();
                                            //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));
    
                                            //         $watermarkSize = round(20 * $imageWidth / 50);
                                            //         $watermarkSource->resize(30,30, function ($constraint) {
                                            //             $constraint->aspectRatio();
                                            //         });
    
                                            //         /* insert watermark at bottom-left corner with 5px offset */
                                            //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                            //         $image->save(public_path($dir.'/'.$fileName));
                                                        
                                          
                                            //     }  


                                            $hr[$index]['image'] = 'images/about/'. $image .'?'. time();
                                            foreach ( $this->locales as $locale ) {
                                                $hr[$index][$locale]['name'] = $request->input('hr_name_'. $locale)[$index];
                                                $hr[$index][$locale]['profession'] = $request->input('hr_profession_'. $locale)[$index];
                                            }
                                        }
                                    } elseif ( $request->has('existing_hr_images.'. $index) ) {
                                        $hr[$index]['image'] = $request->existing_hr_images[$index];
                                        $hr[$index]['alt'] = $request->hr_name_ka[$index];
                                        foreach ( $this->locales as $locale ) {
                                            $hr[$index][$locale]['name'] = $request->input('hr_name_'. $locale)[$index];
                                            $hr[$index][$locale]['profession'] = $request->input('hr_profession_'. $locale)[$index];
                                        }
                                    }
                                }
                            }

                            $model->hr = json_encode($hr);
                        // * HR

                        $model->save();
                        return;
                        break;
                    case 'projects-page':
                        // * Init
                            $this->create_log('ნამუშევრების გვერდის რედაქტირება');
                            ( ProjectsPage::where('id', 1)->exists() ) ? $model = ProjectsPage::find(1) : $model = new ProjectsPage;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Titles
                            // foreach ( Projects::all() as $project ) {
                            //     $projects_model = Projects::find($project->id);

                            //     $titles = json_decode($project->title);
                            //     $titles->ka = $request->titles;
                            //     $titles = json_encode($titles);

                            //     $projects_model->title = $titles;
                            //     $projects_model->save();
                            // }
                            // $model->titles = $request->titles;
                        // * Titles

                        // * Banner
                            if ( $request->hasFile('banner') ) {
                                if ( $request->banner->isValid() ) {
                                    if ( $request->banner->extension() == 'jpg' ) {
                                        $image = 'main-banner.jpeg';
                                    } else {
                                        $image = 'main-banner.'. $request->banner->extension();
                                    }
                                    $request->banner->storeAs('images/projects/', $image, 'local');
                                    $model->banner = 'images/projects/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_banner') ) {
                                $model->banner = $request->existing_banner;
                            }

                            if ( $request->hasFile('mob_banner') ) {
                                if ( $request->mob_banner->isValid() ) {
                                    if ( $request->mob_banner->extension() == 'jpg' ) {
                                        $image = 'mob-banner.jpeg';
                                    } else {
                                        $image = 'mob-banner.'. $request->mob_banner->extension();
                                    }
                                    $request->mob_banner->storeAs('images/projects/', $image, 'local');
                                    $model->mob_banner = 'images/projects/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_mob_banner') ) {
                                $model->mob_banner = $request->existing_mob_banner;
                            }
                        // * Banner

                        $model->save();
                        return;
                        break;
                        // digiwised work 
                    case 'projects':
                            // * Init
                                $this->create_log('ნამუშევრის რედაქტირება');
                                //Storage::deleteDirectory('images/projects/'. $model_id);
                                
                                $model = Projects::find($model_id);
    
                                // $project_title = Str::slug($request->project_title);
                                $project_title = $request->project_title;

                                $project_address = $request->project_address;

                                $embd_video = $request->embd_video;

                                $embds_videos = $request->embds_videos;

                                
                                $model->customer = $request->customer;

                                
                            // * Init
    
                            // * Card
                                $card_image = [];
    
                                if ( $request->hasFile('card_image') ) {
                                    if ( $request->card_image->isValid() ) {
                                        if ( $request->card_image->extension() == 'jpg' ) {
                                            $image = $project_title .'.jpeg';
                                        } else {
                                            $image = $request->card_image .'.'. $request->card_image->extension();
                                        }
                                        $request->card_image->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                        // $dir='images/projects/'.$model->id;
                                        // if(!is_dir($dir)){
                                        //     mkdir($dir);
                                        // }
                                        //     $fileName = basename($_FILES["card_image"]["name"]); 
                                        //     $targetFilePath = $dir.'/'.$fileName; 
                                        //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                        //     if(move_uploaded_file($_FILES["card_image"]["tmp_name"], $targetFilePath)){ 
                                                
                                        //         $image = Image::make(public_path($dir.'/'.$fileName));
                                        //         $imageWidth = $image->width();
                                        //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                        //         // $watermarkSize = round(20 * $imageWidth / 50);
                                        //         $watermarkSource->resize(30,30, function ($constraint) {
                                        //             $constraint->aspectRatio();
                                        //         });

                                        //         /* insert watermark at bottom-left corner with 5px offset */
                                        //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                        //         $image->save(public_path($dir.'/'.$fileName));
                                                    
                                      
                                        //     } 
                                        $card_image = [
                                            'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                            'alt' => $project_title
                                        ];
                                        $model->card_image = json_encode($card_image);
                                    }
                                }else{
                                    $model->card_image=$request->input('old_card_image');
                                }
    
                                foreach ( $this->locales as $locale ) {
                                    $card_info[$locale] = '';
                                    $card_info[$locale] = $request->input('card_description_'. $locale);
                                    $model->card_info = json_encode($card_info);
                                }
                            // * Card
    
                            // * In Progress
                                $model->in_progress = $request->in_progress;
                            // * In Progress
    
                            // * Banner
                                $banner = [];
    
                                if ( $request->hasFile('banner') ) {
                                    if ( $request->banner->isValid() ) {
                                        if ( $request->banner->extension() == 'jpg' ) {
                                            $image = $request->banner_alt .'.jpeg';
                                        } else {
                                            $image = $request->banner_alt .'.'. $request->banner->extension();
                                        }
                                        $request->banner->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                        // $dir='images/projects/'.$model->id;
                                        // if(!is_dir($dir)){
                                        //     mkdir($dir);
                                        // }
                                        //     $fileName = basename($_FILES["banner"]["name"]); 
                                        //     $targetFilePath = $dir.'/'.$fileName; 
                                        //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                        //     if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFilePath)){ 
                                                
                                        //         $image = Image::make(public_path($dir.'/'.$fileName));
                                        //         $imageWidth = $image->width();
                                        //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                        //         $watermarkSize = round(20 * $imageWidth / 50);
                                        //         $watermarkSource->resize(30,30, function ($constraint) {
                                        //             $constraint->aspectRatio();
                                        //         });

                                        //         /* insert watermark at bottom-left corner with 5px offset */
                                        //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                        //         $image->save(public_path($dir.'/'.$fileName));
                                                    
                                      
                                        //     }
                                        $banner = [
                                            'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                            'alt' => $request->banner_alt
                                        ];
                                        $model->banner = json_encode($banner);
                                    }
                                }
                            // * Banner
                            // project address 
                            foreach ( $this->locales as $locale ) {
                                $address[$locale] = '';
                                $address[$locale] = $request->input('project_address_'. $locale);
                                if ( $locale === 'ka' ) $address[$locale] = $request->project_address;
                                $model->project_address = json_encode($address);
                            }
                            // peoject address 
                          
                            // embd video 
                            foreach ( $this->locales as $locale ) {
                                $embdvideo[$locale] = '';
                                $embdvideo[$locale] = $request->input('embd_video_'. $locale);
                                if ( $locale === 'ka' ) $embdvideo[$locale] = $request->embd_video;
                                $model->embd_video = json_encode($embdvideo);
                            }

                            foreach ( $this->locales as $locale ) {
                                $embdsvideos[$locale] = '';
                                $embdsvideos[$locale] = $request->input('embds_videos_'. $locale);
                                if ( $locale === 'ka' ) $embdsvideos[$locale] = $request->embds_videos;
                                $model->embds_videos = json_encode($embdsvideos);
                            }
                            // * Title
                                foreach ( $this->locales as $locale ) {
                                    $title[$locale] = '';
                                    $title[$locale] = $request->input('title_'. $locale);
                                    if ( $locale === 'ka' ) $title[$locale] = $request->project_title;
                                    $model->title = json_encode($title);
                                }
                            // * Title
    
                            // * Categories
                                $categories = [];
    
                                foreach ( $request->categories as $category ) {
                                    $categories[] = $category;
                                }
    
                                $model->categories = json_encode($categories);
                            // * Categories
    
                            // * Information
                                foreach ( $this->locales as $locale ) {
                                    $information[$locale] = '';
                                    $information[$locale] = $request->input('information_'. $locale);
                                    $model->information = json_encode($information);
                                }
                            // * Information
    
                            // * Sections
                                $sections = [];
                                $items = [];
    
                                if ( $request->has('amount_of_sections') ) {
                                    foreach ( $request->amount_of_sections as $index => $nulls ) {
                                        $sections[$index]['has'] = $request->section_has[$index];
    
                                        foreach ( $this->locales as $locale ) {
                                            $sections[$index]['titles'][$locale] = $request->input('section_titles_'. $locale)[$index];
                                        }
                                    }
                                }
    
                                $model->sections = json_encode($sections);
                                
                                // if($request->has('old_images_desktop')){
                                //     foreach($request->old_images_desktop as $index => $item_number){
                                //         $item=json_decode($item_number,true);
                                //         $item['is_feature']=isset($request->image_desktop_feature[$index])?'1':'0';
                                //         $items[]=$item;
                                //     }
                                // }
                                if ( $request->has('desktop_img') ) {
                                    $i=0;
                                        foreach ( $request->desktop_img as $index => $item_number ) {
                                            if ( $request->has('old_images_desktop_'.$index) ) {
                                                
                                                $items[] = [
                                                    'type' => 'image',
                                                    'item-number' => $item_number,
                                                    'belongs' => $request->input('belongs-'. $item_number),
                                                    'is_feature'=>$request->has('image_desktop_feature_'.$item_number)?'1':'0',
                                                    'location' => $request->input('old_images_desktop_'.$item_number),
                                                    'thumbnail' => $request->input('old_thumbnail_desktop_'.$item_number),
                                                    'alt' => $project_title. '-regular-' .$item_number
                                                ];
                                                $i=$item_number+1;
                                            }
                                    //         elseif ( isset($request->amount_of_images[$index]) ) {
                                    // //             if ( $request->file('images.'. $index)->isValid() ) {
                                    // //                 if ( $request->images[$index]->extension() == 'jpg' ) {
                                    // //                     $image = $project_title .'-section-image-' .$index. '.jpeg';
                                    // //                 } else {
                                    // //                     $image = $project_title .'-section-image-' .$index. '.'. $request->images[$index]->extension();
                                    // //                 }
                                    // //                 $request->images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                    // //                 Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail_'. $image);
                                    //                     $dir='images/projects/'.$model->id;
                                    //                     if(!is_dir($dir)){
                                    //                         mkdir($dir);
                                    //                     }
                                    //                         $fileName = basename($_FILES["amount_of_images"]["name"][$index]); 
                                    //                         $targetFilePath = $dir.'/'.$fileName; 
                                    //                         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //                         if(move_uploaded_file($_FILES["amount_of_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                                
                                    //                             $image = Image::make(public_path($dir.'/'.$fileName));
                                    //                             $imageWidth = $image->width();
                                    //                             $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));
                        
                                    //                             $watermarkSize = round(20 * $imageWidth / 50);
                                    //                             $watermarkSource->resize(30,30, function ($constraint) {
                                    //                                 $constraint->aspectRatio();
                                    //                             });
                        
                                    //                             /* insert watermark at bottom-left corner with 5px offset */
                                    //                             $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //                             $image->save(public_path($dir.'/'.$fileName));
                                                                    
                                                    
                                    //                         }   
                                    //                     $items[] = [
                                    //                         'type' => 'image',
                                    //                         'item-number' => $item_number,
                                    //                         'is_feature'=>$request->has('image_desktop_feature_'.$item_number)?'1':'0',
                                    //                         'belongs' => $request->input('belongs-'. $item_number),
                                    //                         'location' => 'images/projects/'. $model->id .'/'. $fileName .'?'. time(),
                                    //                         'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail-'. $fileName .'?'. time(),
                                    //                         'alt' => $project_title. '-regular-' .$item_number
                                    //                     ];
                                    
                                    
                                    
                                    // //                 $items[] = [
                                    // //                     'type' => 'image',
                                    // //                     'item-number' => $item_number,
                                    // //                     'belongs' => $request->input('belongs-'. $item_number),
                                    // //                     'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                    // //                     'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail_'. $image .'?'. time(),
                                    // //                     'alt' => $project_title. '-regular-' .$item_number
                                    // //                 ];
                                    // //             }
                                    //         }
                                        }
                                        if($request->hasFile('amount_of_images')){
                                            foreach ( $request->amount_of_images as $index => $item_number ) {
                                                if ( isset($request->amount_of_images[$index]) ) {
                                                    //             if ( $request->file('images.'. $index)->isValid() ) {
                                                    //                 if ( $request->images[$index]->extension() == 'jpg' ) {
                                                    //                     $image = $project_title .'-section-image-' .$index. '.jpeg';
                                                    //                 } else {
                                                    //                     $image = $project_title .'-section-image-' .$index. '.'. $request->images[$index]->extension();
                                                    //                 }
                                                    //                 $request->images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                                    //                 Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail_'. $image);
                                                                        $dir='images/projects/'.$model->id;
                                                                        if(!is_dir($dir)){
                                                                            mkdir($dir);
                                                                        }
                                                                            $fileName = basename($_FILES["amount_of_images"]["name"][$index]); 
                                                                            $targetFilePath = $dir.'/'.$fileName; 
                                                                            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                                                            if(move_uploaded_file($_FILES["amount_of_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                                                
                                                                                $image = Image::make(public_path($dir.'/'.$fileName));
                                                                                $imageWidth = $image->width();
                                                                                $watermarkSource =  Image::make(public_path($watermarkImagePath));
                                        
                                                                                $watermarkSize = round( $imageWidth / 20);
                                                                                $watermarkSize2 = round( $imageWidth / 15);
                                                                                // $watermarkSource->resize($watermarkSize,30, function ($constraint) {
                                                                                //     $constraint->aspectRatio();
                                                                                // });
                                                                                $watermarkSource->resize($watermarkSize,$watermarkSize2);
                                                                                
                                                                                /* insert watermark at bottom-left corner with 5px offset */
                                                                                $image->insert($watermarkSource, 'top-left',round($watermarkSize/2) , 0);
                                                                                $image->save(public_path($dir.'/'.$fileName));
                                                                                $webp=substr($fileName,0,strpos($fileName,'.')).'.webp';
                                                                                
                                                                                Image::make('images/projects/'. $model->id .'/'. $fileName)->encode('webp', 90)->resize(1920, 1080)->save('images/projects/'. $model->id .'/'. 'thumbnail-'. $webp);
                                                                                    
                                                                    
                                                                            }   
                                                                        $items[] = [
                                                                            'type' => 'image',
                                                                            'item-number' => $i,
                                                                            'is_feature'=>isset($request->image_desktop_feature[$index])?'1':'0',
                                                                            'belongs' => $request->input('belongs-'. $i),
                                                                            'location' => 'images/projects/'. $model->id .'/'. $fileName .'?'. time(),
                                                                            'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail-'. $webp .'?'. time(),
                                                                            'alt' => $project_title. '-regular-' .$i
                                                                        ];
                                                    
                                                                        $i++;
                                                    
                                                    //                 $items[] = [
                                                    //                     'type' => 'image',
                                                    //                     'item-number' => $item_number,
                                                    //                     'belongs' => $request->input('belongs-'. $item_number),
                                                    //                     'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                                    //                     'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail_'. $image .'?'. time(),
                                                    //                     'alt' => $project_title. '-regular-' .$item_number
                                                    //                 ];
                                                    //             }
                                                            }
                                            }
                                        }
                                        
                                    }
                                    
                                    if ( $request->has('mobi_img') ) {
                                        $i=0;
                                        foreach ( $request->mobi_img as $index => $item_number ) {
                                            
                                            if ($request->has('old_images_mobile_'.$index) ) {
                                                // echo"old ".$item_number;
                                                $items[] = [
                                                    'type' => 'mobile_image',
                                                    'item-number' => $item_number,
                                                    'is_feature'=>$request->has('image_mobile_feature_'.$index)?'1':'0',
                                                    'belongs' => $request->input('belongs-'. $item_number),
                                                    'location' => $request->input('old_images_mobile_'.$item_number),
                                                    'thumbnail' => $request->input('old_thumbnail_mobile_'.$item_number),
                                                    'alt' => $project_title. '-mobile-' .$item_number
                                                ];
                                                $i=$item_number+1;
                                            }
                                            // elseif ( isset($request->amount_of_mobile_images[$index]) ) {
                                            //     // echo"new".$item_number;`
                                            //     // if ( $request->file('mobile_images.'. $index)->isValid() ) {
                                            //         // if ( $request->mobile_images[$index]->extension() == 'jpg' ) {
                                            //         //     $image = $project_title .'-mobile-image-' .$index. '.jpeg';
                                            //         // } else {
                                            //         //     $image = $project_title .'-mobile-image-' .$index. '.'. $request->mobile_images[$index]->extension();
                                            //         // }
                                            //         // $request->mobile_images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                            //         // Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail_'. $image);
                                            //         // $items[$item_number] = [
                                            //         //     'type' => 'mobile_image',
                                            //         //     'item-number' => $item_number,
                                            //         //     'belongs' => $request->input('belongs-'. $item_number),
                                            //         //     'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                            //         //     'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail_'. $image .'?'. time(),
                                            //         //     'alt' => $project_title. '-mobile-' .$item_number
                                            //         // ];
                                            //         $dir='images/projects/'.$model->id;
                                            //     if(!is_dir($dir)){
                                            //         mkdir($dir);
                                            //     }
                                            //         $fileName = basename($_FILES["amount_of_mobile_images"]["name"][$index]); 
                                            //         $targetFilePath = $dir.'/'.$fileName; 
                                            //         $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                            //         if(move_uploaded_file($_FILES["amount_of_mobile_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                        
                                            //             $image = Image::make(public_path($dir.'/'.$fileName));
                                            //             $imageWidth = $image->width();
                                            //             $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                            //             $watermarkSize = round(20 * $imageWidth / 50);
                                            //             $watermarkSource->resize(30,30, function ($constraint) {
                                            //                 $constraint->aspectRatio();
                                            //             });

                                            //             /* insert watermark at bottom-left corner with 5px offset */
                                            //             $image->insert($watermarkSource, 'top-left', 30, 0);
                                            //             $image->save(public_path($dir.'/'.$fileName));
                                                            
                                              
                                            //         }   
                                            //     $items[] = [
                                            //         'type' => 'mobile_image',
                                            //         'item-number' => $item_number,
                                            //         'is_feature'=>$request->has('image_mobile_feature_'.$item_number)?'1':'0',
                                            //         'belongs' => $request->input('belongs-'. $item_number),
                                            //         'location' => 'images/projects/'. $model->id .'/'. $fileName .'?'. time(),
                                            //         'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail-'. $fileName .'?'. time(),
                                            //         'alt' => $project_title. '-mobile-' .$item_number
                                            //     ];
                                            //     // }
                                            // }
                                            
                                        }
                                        if($request->hasFile('amount_of_mobile_images')){
                                            foreach ( $request->amount_of_mobile_images as $index => $item_number ) {
                                                if ( isset($request->amount_of_mobile_images[$index]) ) {
                                                    // echo"new".$item_number;`
                                                    // if ( $request->file('mobile_images.'. $index)->isValid() ) {
                                                        // if ( $request->mobile_images[$index]->extension() == 'jpg' ) {
                                                        //     $image = $project_title .'-mobile-image-' .$index. '.jpeg';
                                                        // } else {
                                                        //     $image = $project_title .'-mobile-image-' .$index. '.'. $request->mobile_images[$index]->extension();
                                                        // }
                                                        // $request->mobile_images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                                        // Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail_'. $image);
                                                        // $items[$item_number] = [
                                                        //     'type' => 'mobile_image',
                                                        //     'item-number' => $item_number,
                                                        //     'belongs' => $request->input('belongs-'. $item_number),
                                                        //     'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                                        //     'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail_'. $image .'?'. time(),
                                                        //     'alt' => $project_title. '-mobile-' .$item_number
                                                        // ];
                                                        $dir='images/projects/'.$model->id;
                                                    if(!is_dir($dir)){
                                                        mkdir($dir);
                                                    }
                                                        $fileName = basename($_FILES["amount_of_mobile_images"]["name"][$index]); 
                                                        $targetFilePath = $dir.'/'.$fileName; 
                                                        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                                        if(move_uploaded_file($_FILES["amount_of_mobile_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                            
                                                            $image = Image::make(public_path($dir.'/'.$fileName));
                                                            $imageWidth = $image->width();
                                                            $watermarkSource =  Image::make(public_path($watermarkImagePath));

                                                            $watermarkSize = round( $imageWidth / 20);
                                                            $watermarkSize2 = round( $imageWidth / 15);
                                                            // $watermarkSource->resize($watermarkSize,30, function ($constraint) {
                                                            //     $constraint->aspectRatio();
                                                            // });
                                                            $watermarkSource->resize($watermarkSize,$watermarkSize2);
                                                                                
                                                            /* insert watermark at bottom-left corner with 5px offset */
                                                            $image->insert($watermarkSource, 'top-left',round($watermarkSize/2) , 0);
                                                            $image->save(public_path($dir.'/'.$fileName));
                                                            $webp=substr($fileName,0,strpos($fileName,'.')).'.webp';

                                                            Image::make('images/projects/'. $model->id .'/'. $fileName)->encode('webp', 90)->resize(1920, 1080)->save('images/projects/'. $model->id .'/'. 'thumbnail-'. $webp);
                                                                
                                                
                                                        }   
                                                    $items[] = [
                                                        'type' => 'mobile_image',
                                                        'item-number' => $i,
                                                        'is_feature'=>isset($request->image_mobile_feature[$index])?'1':'0',
                                                        'belongs' => $request->input('belongs-'. $i),
                                                        'location' => 'images/projects/'. $model->id .'/'. $fileName .'?'. time(),
                                                        'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail-'. $webp .'?'. time(),
                                                        'alt' => $project_title. '-mobile-' .$i
                                                    ];
                                                    // }
                                                    $i++;
                                                }
                                            }
                                        }
                                    }

                                // if ( $request->has('amount_of_images') ) {
                                //     foreach ( $request->amount_of_images as $index => $item_number ) {
                                //         if ( $request->hasFile('images.'. $index) ) {
                                //             if ( $request->file('images.'. $index)->isValid() ) {
                                //                 if ( $request->images[$index]->extension() == 'jpg' ) {
                                //                     $image = $project_title .'-section-image-' .$index. '.jpeg';
                                //                 } else {
                                //                     $image = $project_title .'-section-image-' .$index. '.'. $request->images[$index]->extension();
                                //                 }
                                //                 $request->images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                //                 Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail_'. $image);
                                //                 $items[] = [
                                //                     'type' => 'image',
                                //                     'item-number' => $item_number,
                                //                     'belongs' => $request->input('belongs-'. $item_number),
                                //                     'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                //                     'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail_'. $image .'?'. time(),
                                //                     'alt' => $project_title. '-regular-' .$item_number
                                //                 ];
                                //             }
                                //         } elseif ( $request->has('existing_images.'. $index) ) {
                                //             $items[$item_number] = [
                                //                 'type' => 'image',
                                //                 'item-number' => $item_number,
                                //                 'belongs' => $request->input('belongs-'. $item_number),
                                //                 'location' => $request->input('existing_images.'. $index),
                                //                 'thumbnail' => $request->input('existing_thumbnails.'. $index),
                                //                 'alt' => $project_title. '-regular-' .$item_number
                                //             ];
                                //         }
                                //     }
                                // }
    
                                // if ( $request->has('amount_of_mobile_images') ) {
                                //     foreach ( $request->amount_of_mobile_images as $index => $item_number ) {
                                //         if ( $request->hasFile('mobile_images.'. $index) ) {
                                //             if ( $request->file('mobile_images.'. $index)->isValid() ) {
                                //                 if ( $request->mobile_images[$index]->extension() == 'jpg' ) {
                                //                     $image = $project_title .'-mobile-image-' .$index. '.jpeg';
                                //                 } else {
                                //                     $image = $project_title .'-mobile-image-' .$index. '.'. $request->mobile_images[$index]->extension();
                                //                 }
                                //                 $request->mobile_images[$index]->storeAs('images/projects/'. $model->id .'/', $image, 'local');
                                //                 Image::make('images/projects/'. $model->id .'/'. $image)->encode('webp', 90)->resize(360, 175)->save('images/projects/'. $model->id .'/'. 'thumbnail_'. $image);
                                //                 $items[$item_number] = [
                                //                     'type' => 'mobile_image',
                                //                     'item-number' => $item_number,
                                //                     'belongs' => $request->input('belongs-'. $item_number),
                                //                     'location' => 'images/projects/'. $model->id .'/'. $image .'?'. time(),
                                //                     'thumbnail' => 'images/projects/'. $model->id .'/'. 'thumbnail_'. $image .'?'. time(),
                                //                     'alt' => $project_title. '-mobile-' .$item_number
                                //                 ];
                                //             }
                                //         } elseif ( $request->has('existing_mobile_images.'. $index) ) {
                                //             $items[$item_number] = [
                                //                 'type' => 'image',
                                //                 'item-number' => $item_number,
                                //                 'belongs' => $request->input('belongs-'. $item_number),
                                //                 'location' => $request->input('existing_mobile_images.'. $index),
                                //                 'thumbnail' => $request->input('existing_mobile_thumbnails.'. $index),
                                //                 'alt' => $project_title. '-mobile-' .$item_number
                                //             ];
                                //         }
                                //     }
                                // }
                                if ( $request->has('mobile_video') ) {
                                    foreach ( $request->mobile_video as $index => $item_number ) {
                                       if($item_number==0){
                                        $text='რემონტამდე';
                                       }elseif($item_number==1){
                                        $text='რემონტის შემდეგ';
                                       }
                                       
                                        $items[] = [
                                            'type' => 'mobile_video',
                                            'text' =>$text,
                                            'item-number' => $index,
                                            'belongs' => $request->input('belongs-'. $index),
                                            'code' => $item_number,
                                        ];
                                    }
                                } 
                                if ( $request->has('amount_of_videos') ) {
                                    foreach ( $request->amount_of_videos as $index => $item_number ) {
                                        if($index==0){
                                            $text='რემონტამდე';
                                           }elseif($index==1){
                                            $text='რემონტის შემდეგ';

                                           }
                                        $items[] = [
                                            'type' => 'video',
                                            'text' => $text,
                                            'item-number' => $index,
                                            'belongs' => $request->input('belongs-'. $index),
                                            'code' => $item_number,
                                        ];
                                    }
                                }

                                
                                // echo "<pre>";
                                // print_r($items);
                                // echo "</pre>";
                                // exit; 
                                ksort($items);
                                
                                $model->section_items = json_encode($items);
                                if($request->has('show_on_homepage')){
                                    $model->show_on_homepage = 1;
                                }else{
                                    $model->show_on_homepage = 0;

                                }
                                if($request->has('show_on_servicepage')){
                                    $model->show_on_servicepage=1;
                                }else{
                                    $model->show_on_servicepage=0;

                                }
                                
                            // * Sections
                                
                            $model->save();
                            return;
                            break;
                        // digiwised work 
                    case 'vip-master':
                        // * Init
                            $this->create_log('ვიპ-მასტერის გვერდის რედაქტირება');
                            ( VipPage::where('id', 1)->exists() ) ? $model = VipPage::find(1) : $model = new VipPage;
                        // * Init

                        // * Init
                            $meta = [];
                            
                            for ( $i = 0; $i < 7; $i++ ) {
                                $meta[$i]['meta_title'] = $request->meta_title[$i];
                                $meta[$i]['meta_keywords'] = $request->meta_keywords[$i];
                                $meta[$i]['meta_description'] = $request->meta_description[$i];
                            }

                            $model->meta = json_encode($meta);
                        // * Init
                        
                        // * Page
                            if ( $request->hasFile('banner') ) {
                                if ( $request->banner->isValid() ) {
                                    if ( $request->banner->extension() == 'jpg' ) {
                                        $image = 'main-banner.jpeg';
                                    } else {
                                        $image = 'main-banner.'. $request->banner->extension();
                                    }
                                    $request->banner->storeAs('images/vip-master/', $image, 'local');
                                    // $dir='images/vip-master';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     }  
                                    $model->banner = 'images/vip-master/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_banner') ) {
                                $model->banner = $request->existing_banner;
                            }

                            if ( $request->hasFile('mob_banner') ) {
                                if ( $request->mob_banner->isValid() ) {
                                    if ( $request->mob_banner->extension() == 'jpg' ) {
                                        $image = 'mob-banner.jpeg';
                                    } else {
                                        $image = 'mob-banner.'. $request->mob_banner->extension();
                                    }
                                    $request->mob_banner->storeAs('images/vip-master/', $image, 'local');
                                    // $dir='images/vip-master';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["mob_banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["mob_banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     }  

                                    $model->mob_banner = 'images/vip-master/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_mob_banner') ) {
                                $model->mob_banner = $request->existing_mob_banner;
                            }

                            $model->banner_text_ka = $request->banner_text_ka;
                            $model->banner_text_it = $request->banner_text_it;
                            // foreach ( $this->locales as $locale ) {
                            // }
                        // * Page

                        // * Services
                            $dropdowns = [
                                'ka' => [],
                                'it' => []
                            ];
                            $services = [
                                'ka' => [],
                                'it' => []
                            ];

                            foreach ( $this->locales as $locale ) {
                                if ( $request->has('amount_of_dropdowns_'. $locale) ) {
                                    foreach ( $request->input('amount_of_dropdowns_'. $locale) as $index => $dropdown ) {
                                        $dropdowns[$locale][$index] = [
                                            'belongs' => $request->input($locale .'_dropdown_belongs')[$index],
                                            'has' => $request->input($locale .'_dropdown_has')[$index],
                                            'text' => $request->input($locale .'_dropdown_text')[$index],
                                            'price' => $request->input($locale .'_dropdown_price')[$index]
                                        ];
                                    }
                                }


                                // if ( $request->has('amount_of_services_'. $locale) ) {
                                //     foreach ( $request->input('amount_of_services_'. $locale) as $index => $service ) {
                                //         $services[$locale][$index] = [
                                //             'belongs' => $request->input($locale .'_service_belongs')[$index],
                                //             'id' => $request->input($locale .'_service_id')[$index],
                                //             'text' => $request->input($locale .'_service_text')[$index]
                                //         ];
                                //     }
                                // }
                            }

                            $model->dropdowns_ka = json_encode($dropdowns['ka']);
                            $model->dropdowns_it = json_encode($dropdowns['it']);
                            $model->services_ka = json_encode($services['ka']);
                            $model->services_it = json_encode($services['it']);
                        // * Services

                        $model->save();
                        return;
                        break;
                    case 'vip-services':
                        // * Init
                            $this->create_log('ვიპ-მასტერის სერვისის რედაქტირება');
                        
                            $model = VipServices::find($model_id);
                            $model->og_slug = $request->slug;
                            $model->slug = Str::slug($request->slug, '-');
                            $model->locale = $request->locale;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->inner_title = $request->inner_title;
                            $model->outside_title = $request->outside_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta
                        
                        // * Image
                            if ( $request->hasFile('image') ) {
                                if ( $request->image->isValid() ) {
                                    if ( $request->image->extension() == 'jpg' ) {
                                        $image = 'image.jpeg';
                                    } else {
                                        $image = 'image.'. $request->image->extension();
                                    }
                                    $request->image->storeAs('images/vip-services/'. $model->id .'/', $image, 'local');
                                    // $dir='images/vip-services/'.$model->id;
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["image"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     }
                                    Image::make('images/vip-services/'. $model->id .'/'. $image)->encode('webp', 90)->resize(400, 400)->save('images/vip-services/'. $model->id .'/'. $image);
                                    $model->image = 'images/vip-services/'. $model->id .'/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_image') ) {
                                $model->image = $request->existing_image;
                            }
                        // * Image

                        // * Data
                            $model->description = $request->description;
                            $model->description_lg = $request->description_lg;
                            $model->belongs = $request->belongs;
                        // * Data

                        $model->save();
                        return;
                        break;
                    case 'designer':
                        // * Init
                            $this->create_log('დიზაინერის გვერდის რედაქტირება');
                            ( Designer::where('id', 1)->exists() ) ? $model = Designer::find(1) : $model = new Designer;
                        // * Init

                        // * Page
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;

                            if ( $request->hasFile('banner') ) {
                                if ( $request->banner->isValid() ) {
                                    if ( $request->banner->extension() == 'jpg' ) {
                                        $image = 'main-banner.jpeg';
                                    } else {
                                        $image = 'main-banner.'. $request->banner->extension();
                                    }
                                    $request->banner->storeAs('images/designer/', $image, 'local');
                                    // $dir='images/designer';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                    //     }  

                                    $model->banner = 'images/designer/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_banner') ) {
                                $model->banner = $request->existing_banner;
                            }

                            if ( $request->hasFile('mob_banner') ) {
                                if ( $request->mob_banner->isValid() ) {
                                    if ( $request->mob_banner->extension() == 'jpg' ) {
                                        $image = 'mob-banner.jpeg';
                                    } else {
                                        $image = 'mob-banner.'. $request->mob_banner->extension();
                                    }
                                    $request->mob_banner->storeAs('images/designer/', $image, 'local');
                                    $dir='images/designer';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["mob_banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["mob_banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     }  

                                    $model->mob_banner = 'images/designer/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_mob_banner') ) {
                                $model->mob_banner = $request->existing_mob_banner;
                            }

                            $banner_text = [];

                            foreach ( $this->locales as $locale ) {
                                $banner_text[$locale] = $request->input('banner_text_'. $locale);
                            }
                            $model->banner_text = json_encode($banner_text);
                        // * Page

                        // * Cards
                            $model->content = json_encode($this->serviceCards($request));
                        // * Cards

                        // * Tabs
                            $tabs = [];

                            if ( $request->has('amount_of_designer_tabs') ) {
                                foreach ( $request->amount_of_designer_tabs as $index => $tab ) {
                                    if ( $request->hasFile('designer_tab_images.'. $index) ) {
                                        if ( $request->file('designer_tab_images.'. $index)->isValid() ) {
                                            if ( $request->designer_tab_images[$index]->extension() == 'jpg' ) {
                                                $image = $request->designer_tab_image_alts[$index] .'.jpeg';
                                            } else {
                                                $image = $request->designer_tab_image_alts[$index] .'.'. $request->designer_tab_images[$index]->extension();
                                            }
                                            $request->designer_tab_images[$index]->storeAs('images/designer/', $image, 'local');
                                            $dir='images/designer';
                                            // if(!is_dir($dir)){
                                            //     mkdir($dir);
                                            // }
                                            //     $fileName = basename($_FILES["designer_tab_images"]["name"][$index]); 
                                            //     $targetFilePath = $dir.'/'.$fileName; 
                                            //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                            //     if(move_uploaded_file($_FILES["designer_tab_images"]["tmp_name"][$index], $targetFilePath)){ 
                                                    
                                            //         $image = Image::make(public_path($dir.'/'.$fileName));
                                            //         $imageWidth = $image->width();
                                            //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));
        
                                            //         $watermarkSize = round(20 * $imageWidth / 50);
                                            //         $watermarkSource->resize(30,30, function ($constraint) {
                                            //             $constraint->aspectRatio();
                                            //         });
        
                                            //         /* insert watermark at bottom-left corner with 5px offset */
                                            //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                            //         $image->save(public_path($dir.'/'.$fileName));
                                                        
                                          
                                            //     }  
        
                                            $tabs[$index] = [
                                                'image_location' => 'images/designer/'. $image .'?'. time(),
                                                'image_alt' => $request->designer_tab_image_alts[$index]
                                            ];
                                        }
                                    } elseif ( $request->has('existing_designer_tab_images.'. $index) ) {
                                        $tabs[$index] = [
                                            'image_location' => $request->existing_designer_tab_images[$index],
                                            'image_alt' => $request->designer_tab_image_alts[$index]
                                        ];
                                    }

                                    foreach ( $this->locales as $locale ) {
                                        $tabs[$index][$locale]['title'] = $request->input('designer_tab_titles_'. $locale)[$index];
                                        $tabs[$index][$locale]['text'] = $request->input('designer_tab_texts_'. $locale)[$index];
                                    }
                                }
                            }

                            $model->tabs = json_encode($tabs);
                        // * Tabs

                        // * Renders
                            $render = [];

                            for ( $index = 0; $index < 4; $index++ ) { 
                                if ( $request->hasFile('designer_render_images.'. $index) ) {
                                    if ( $request->designer_render_images[$index]->extension() == 'jpg' ) {
                                        $image = $request->designer_render_image_alts[$index] .'.jpeg';
                                    } else {
                                        $image = $request->designer_render_image_alts[$index] .'.'. $request->designer_render_images[$index]->extension();
                                    }

                                    $request->designer_render_images[$index]->storeAs('images/designer/', $image, 'local');
                                    // $dir='images/designer';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["designer_render_images"]["name"][$index]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["designer_render_images"]["tmp_name"][$index], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     }  


                                    $render[$index] = [
                                        'location' => 'images/designer/'. $image .'?'. time(),
                                        'alt' => $request->designer_render_image_alts[$index]
                                    ];
                                } elseif ( $request->has('existing_designer_render_images.'. $index) ) {
                                    $render[$index] = [
                                        'location' => $request->existing_designer_render_images[$index],
                                        'alt' => $request->designer_render_image_alts[$index]
                                    ];
                                }
                            }

                            $model->render = json_encode($render);
                        // * Renders

                        $model->save();
                        return;
                        break;
                    case 'repairs':
                        // * Init
                            $this->create_log('რემონტის გვერდის რედაქტირება');
                            ( Repairs::where('id', 1)->exists() ) ? $model = Repairs::find(1) : $model = new Repairs;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Meta
                            $model->invoice_price_low = $request->invoice_price_low;
                            $model->invoice_price_high = $request->invoice_price_high;
                        // * Meta

                        // * Page
                            if ( $request->hasFile('banner') ) {
                                if ( $request->banner->isValid() ) {
                                    if ( $request->banner->extension() == 'jpg' ) {
                                        $image = 'main-banner.jpeg';
                                    } else {
                                        $image = 'main-banner.'. $request->banner->extension();
                                    }
                                    $request->banner->storeAs('images/repairs/', $image, 'local');
                                    // $dir='images/repairs';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                    //     }  
                                    $model->banner = 'images/repairs/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_banner') ) {
                                $model->banner = $request->existing_banner;
                            }

                            if ( $request->hasFile('mob_banner') ) {
                                if ( $request->mob_banner->isValid() ) {
                                    if ( $request->mob_banner->extension() == 'jpg' ) {
                                        $image = 'mob-banner.jpeg';
                                    } else {
                                        $image = 'mob-banner.'. $request->mob_banner->extension();
                                    }
                                    $request->mob_banner->storeAs('images/repairs/', $image, 'local');
                                    // $dir='images/repairs';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["mob_banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["mob_banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     }  

                                    $model->mob_banner = 'images/repairs/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_mob_banner') ) {
                                $model->mob_banner = $request->existing_mob_banner;
                            }

                            $banner_text = [];

                            foreach ( $this->locales as $locale ) {
                                $banner_text[$locale] = $request->input('banner_text_'. $locale);
                            }
                            $model->banner_text = json_encode($banner_text);
                        // * Page

                        // * Cards
                            $model->content = json_encode($this->serviceCards($request));
                        // * Cards

                        // * Middle
                            $middle = [];

                            foreach ( $this->locales as $locale ) {
                                for ( $index = 0; $index < 4; $index++ ) { 
                                    $middle[$locale][$index] = [
                                        'title' => $request->input('middle_titles_'. $locale)[$index],
                                        'text' => $request->input('middle_texts_'. $locale)[$index]
                                    ];
                                }
                            }

                            $model->middle = json_encode($middle);
                        // * Middle

                        // * Bottom
                            $bottom = [];

                            foreach ( $this->locales as $locale ) {
                                for ( $index = 0; $index < 6; $index++ ) { 
                                    $bottom[$locale][$index]['text'] = $request->input('bottom_texts_'. $locale)[$index];
                                }
                            }

                            $model->bottom = json_encode($bottom);
                        // * Bottom
                        
                        $model->save();
                        return;
                        break;
                    case 'furniture':
                        // * Init
                            $this->create_log('ავეჯის გვერდის რედაქტირება');
                            ( Furniture::where('id', 1)->exists() ) ? $model = Furniture::find(1) : $model = new Furniture;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Page
                            if ( $request->hasFile('banner') ) {
                                if ( $request->banner->isValid() ) {
                                    if ( $request->banner->extension() == 'jpg' ) {
                                        $image = 'main-banner.jpeg';
                                    } else {
                                        $image = 'main-banner.'. $request->banner->extension();
                                    }
                                    $request->banner->storeAs('images/furniture/', $image, 'local');
                                    // $dir='images/furniture';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                    //     }  

                                    $model->banner = 'images/furniture/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_banner') ) {
                                $model->banner = $request->existing_banner;
                            }

                            if ( $request->hasFile('mob_banner') ) {
                                if ( $request->mob_banner->isValid() ) {
                                    if ( $request->mob_banner->extension() == 'jpg' ) {
                                        $image = 'mob-banner.jpeg';
                                    } else {
                                        $image = 'mob-banner.'. $request->mob_banner->extension();
                                    }
                                    $request->mob_banner->storeAs('images/furniture/', $image, 'local');
                                    // $dir='images/furniture';
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["mob_banner"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["mob_banner"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                    //     }  

                                    $model->mob_banner = 'images/furniture/'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_mob_banner') ) {
                                $model->mob_banner = $request->existing_mob_banner;
                            }

                            $banner_text = [];

                            foreach ( $this->locales as $locale ) {
                                $banner_text[$locale] = $request->input('banner_text_'. $locale);
                            }
                            $model->banner_text = json_encode($banner_text);
                        // * Page

                        // * Cards
                            $model->content = json_encode($this->serviceCards($request));
                        // * Cards

                        // * Bottom
                            $bottom = [];

                            foreach ( $this->locales as $locale ) {
                                for ( $index = 0; $index < 4; $index++ ) { 
                                    $bottom[$locale][$index] = [
                                        'title' => $request->input('bottom_titles_'. $locale)[$index],
                                        'text' => $request->input('bottom_texts_'. $locale)[$index]
                                    ];
                                }
                            }

                            $model->bottom = json_encode($bottom);
                        // * Bottom

                        $model->save();
                        return;
                        break;
                    case 'vacancies':
                        // * Init
                            $this->create_log('ვაკანსიების რედაქტირება');
                            ( VacanciesPage::where('id', 1)->exists() ) ? $model = VacanciesPage::find(1) : $model = new VacanciesPage;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Categories
                            $categories = [];

                            if ( $request->has('amount_of_categories') ) {
                                foreach ( $request->amount_of_categories as $index => $nulls ) {
                                    $categories[$index] = [
                                        'title' => $request->category_titles[$index],
                                        'final_date' => $request->category_final_date[$index],
                                        'area_of_expertise' => $request->category_area_of_expertise[$index],
                                        'belongs' => $request->category_belongs[$index],
                                        'has' => $request->category_has[$index]
                                    ];
                                }
                            }

                            $model->categories = json_encode($categories);
                        // * Categories
                        
                        // * Sub-Categories
                            $sub_categories = [];

                            if ( $request->has('amount_of_sub_categories') ) {
                                foreach ( $request->amount_of_sub_categories as $index => $nulls ) {
                                    $sub_categories[$index] = [
                                        'id' => $request->sub_category_ids[$index],
                                        'title' => $request->sub_category_titles[$index],
                                        'belongs' => $request->sub_category_belongs[$index]
                                    ];
                                }
                            }

                            $model->sub_categories = json_encode($sub_categories);
                        // * Sub-Categories

                        $model->save();
                        return;
                        break;
                    case 'vacancies-register':
                        // * Init
                            $this->create_log('როგორ დავრეგისტრირდე ვაკანსიებში რედაქტირება');
                            ( VacanciesRegister::where('id', 1)->exists() ) ? $model = VacanciesRegister::find(1) : $model = new VacanciesRegister;
                        // * Init

                        $model->content = $request->content;

                        $model->save();
                        return;
                        break;
                    case 'vacancies-activate':
                        // * Init
                            $this->create_log('ვაკანსიების აქტივაცია');
                        // * Init

                        $ids = array_unique(explode('-', $request->id_string));

                        if ( $request->action == 'delete' ) {
                            foreach ( $ids as $id ) {
                                Workforce::find($id)->delete();
                            }
                        } elseif ( $request->action == 'activate' ) {
                            foreach ( $ids as $id ) {
                                Workforce::find($id)->update(['activated' => 'true']);
                            }
                        }
                        return;
                        break;
                    case 'product-categories':
                        // * Init
                            $this->create_log('მარკეტის კატეგორიების რედაქტირება');
                            ( ProductCategories::where('id', 1)->exists() ) ? $model = ProductCategories::find(1) : $model = new ProductCategories;
                        // * Init


                        // * Main
                            $main = [];

                            if ( $request->has('amount_of_main_groups') ) {
                                foreach ( $request->amount_of_main_groups as $main_index => $nulls ) {
                                    $main[$main_index] = [
                                        'title' => $request->main_category_titles[$main_index],
                                        'has' => $request->main_group_has[$main_index]
                                    ];
                                }
                            }

                            $model->main = json_encode($main);
                        // * Main

                        // * Groups
                            $groups = [];

                            if ( $request->has('amount_of_category_groups') ) {
                                foreach ( $request->amount_of_category_groups as $group_index => $nulls ) {
                                    $groups[$group_index] = [
                                        'title' => $request->category_group_titles[$group_index],
                                        'belongs' => $request->category_group_belongs[$group_index],
                                        'has' => $request->category_group_has[$group_index]
                                    ];
                                }
                            }

                            $model->groups = json_encode($groups);
                        // * Groups

                        // * Sub Groups
                            $sub_groups = [];

                            if ( $request->has('amount_of_sub_groups') ) {
                                foreach ( $request->amount_of_sub_groups as $sub_group_index => $nulls ) {
                                    $sub_groups[$sub_group_index] = [
                                        'title' => $request->sub_group_titles[$sub_group_index],
                                        'belongs' => $request->sub_group_belongs[$sub_group_index],
                                        'search_id' => $request->sub_group_search_ids[$sub_group_index]
                                    ];
                                }
                            }

                            $model->sub_groups = json_encode($sub_groups);
                        // * Sub Groups

                        $model->save();
                        return;
                        break;
                    case 'product':
                        // * Init
                            $this->create_log('პროდუქტის რედაქტირება');
                        
                            $model = Products::find($model_id);
                            $model->og_slug = $request->slug;
                            $model->slug = Str::slug($request->slug, '-');
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        // * Misc
                            $model->belongs_category = $request->belongs_category;
                            $model->belongs_sub_category = $request->belongs_sub_category;
                            $model->brand = $request->brand;
                            $model->country = $request->country;
                        // * Misc

                        // * Price and Variants
                            $model->price = (float)$request->price;
                            if ( $request->has('discount') ) {
                                $model->discount = $request->discount;
                                $model->discount_amount = (float)(100 - $request->discount_amount) / 100;
                                $model->discount_amount_original = $request->discount_amount;
                            } else {
                                $model->discount = 'false';
                                $model->discount_amount = 0;
                                $model->discount_amount_original = 0;
                            }
                            $model->measuring = $request->measuring;

                            $model->has_variants = $request->has_variants;
                            $variants = [];

                            if ( $request->has('amount_of_variants') ) {
                                foreach ( $request->amount_of_variants as $index => $nulls ) {
                                    $variants[$index] = [
                                        'weights' => $request->variant_weights[$index],
                                        'prices' => (float)$request->variant_prices[$index]
                                    ];
                                }
                            }

                            $model->variants = json_encode($variants);
                        // * Price and Variants

                        // * Main
                            if ( $request->hasFile('image') ) {
                                if ( $request->image->isValid() ) {
                                    if ( $request->image->extension() == 'jpg' ) {
                                        $image = Str::slug($request->meta_title) .'.jpeg';
                                    } else {
                                        $image = Str::slug($request->meta_title) .'.'. $request->image->extension();
                                    }

                                    $request->image->storeAs('images/products/'. $model->id .'/', $image, 'local');
                                    // $dir='images/products/'.$model->id;
                                    // if(!is_dir($dir)){
                                    //     mkdir($dir);
                                    // }
                                    //     $fileName = basename($_FILES["image"]["name"]); 
                                    //     $targetFilePath = $dir.'/'.$fileName; 
                                    //     $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                    //     if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){ 
                                            
                                    //         $image = Image::make(public_path($dir.'/'.$fileName));
                                    //         $imageWidth = $image->width();
                                    //         $watermarkSource =  Image::make(public_path('images/logos/favicon.png'));

                                    //         $watermarkSize = round(20 * $imageWidth / 50);
                                    //         $watermarkSource->resize(30,30, function ($constraint) {
                                    //             $constraint->aspectRatio();
                                    //         });

                                    //         /* insert watermark at bottom-left corner with 5px offset */
                                    //         $image->insert($watermarkSource, 'top-left', 30, 0);
                                    //         $image->save(public_path($dir.'/'.$fileName));
                                                
                                  
                                    //     } 


                                    Image::make('images/products/'. $model->id .'/'. $image)->encode('webp', 90)->resize(400, 400)->save('images/products/'. $model->id .'/'. $image);
                                    $model->image = 'images/products/'. $model->id .'/'. $image .'?'. time();
                                    
                                    Image::make('images/products/'. $model->id .'/'. $image)->encode('webp', 90)->resize(130, 130)->save('images/products/'. $model->id .'/thumbnail_'. $image);
                                    $model->card_image = 'images/products/'. $model->id .'/thumbnail_'. $image .'?'. time();
                                }
                            } elseif ( $request->has('existing_image') ) {
                                $model->image = $request->existing_image;
                            }
                            $model->image_alt = $request->meta_title;

                            // * Card
                                $model->card_image_alt = 'thumbnail_'. Str::slug($request->meta_title);
                                $model->card_description = $request->product_name;
                            // * Card

                            $model->name = $request->product_name;
                            $model->description = $request->product_description;

                            $additional_info = [];

                            if ( $request->has('amount_of_additional_info') ) {
                                foreach ( $request->amount_of_additional_info as $index => $nulls ) {
                                    $additional_info[$index] = [
                                        'left' => $request->additional_information_left[$index],
                                        'right' => $request->additional_information_right[$index]
                                    ];
                                }
                            }

                            $model->additional_information = json_encode($additional_info);
                        // * Main

                        $model->save();
                        return;
                        break;
                    case 'market-meta':
                        // * Init
                            $this->create_log('მთავარი გვერდის რედაქტირება');
                            ( MarketMeta::where('id', 1)->exists() ) ? $model = MarketMeta::find(1) : $model = new MarketMeta;
                        // * Init

                        // * Meta
                            $model->meta_title = $request->meta_title;
                            $model->meta_keywords = $request->meta_keywords;
                            $model->meta_description = $request->meta_description;
                        // * Meta

                        $model->save();
                        return;
                        break;
                    case 'order-info':
                        // * Init
                            ( OrderInfo::where('id', 1)->exists() ) ? $model = OrderInfo::find(1) : $model = new OrderInfo;
                        // * Init

                        $items = [];

                        foreach ( ['cities', 'regions', 'dates', 'time_frames'] as $request_name ) {
                            if ( $request->has($request_name) ) {
                                foreach ( $request->input($request_name) as $item ) {
                                    $items[] = $item;
                                }
                            }
                            $model->$request_name = json_encode($items);
                            $items = [];
                        }

                        $model->save();

                        return;
                        break;
                    case 'company-hotline':
                        // * Init
                            ( CompanyHotline::where('id', 1)->exists() ) ? $model = CompanyHotline::find(1) : $model = new CompanyHotline;
                        // * Init

                        $model->visible_phone_number = $request->visible_phone_number;
                        $call_number = str_replace(' ', '', $request->visible_phone_number);
                        $call_number = '+995'.$call_number;
                        $model->call_phone_number = $call_number;

                        $model->visible_phone_vip_number = $request->visible_phone_vip_number;
                        $call_vip_number = str_replace(' ', '', $request->visible_phone_vip_number);
                        $call_vip_number = '+995'.$call_vip_number;
                        $model->call_phone_vip_number = $call_vip_number;

                        $model->save();

                        return;
                        break;
                }
            }
        }

        private function checkSlug($table = null, $id = null) {
            $table_validator = ['blog', 'vip-services'];

            if ( $table == 'projects' || $table == 'product' ) return false;

            if ( $table == null || !in_array($table, $table_validator) ) return 'no_slug';

            if ( $table == 'blog' )   $slug = Blog::where('slug', Str::slug(request('slug'), '-'))->get()->toArray();
            if ( $table == 'vip-services' )   $slug = VipServices::where('slug', Str::slug(request('slug'), '-'))->get()->toArray();

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

        private function serviceCards($request) {
            $content = [];

            if ( $request->has('amount_of_cards') ) {
                foreach ( $request->amount_of_cards as $index => $value ) {
                    $content['cards'][$index] = [
                        'title' =>  $request->card_titles[$index],
                        'price' =>  $request->card_prices[$index],
                        'description' =>  $request->card_descriptions[$index]
                    ];

                    if ( $request->hasFile('modal_banners.'. $index) ) {
                        if ( $request->file('modal_banners.'. $index)->isValid() ) {
                            if ( $request->modal_banners[$index]->extension() == 'jpg' ) {
                                $image = $request->modal_banner_alts[$index] .'.jpeg';
                            } else {
                                $image = $request->modal_banner_alts[$index] .'.'. $request->modal_banners[$index]->extension();
                            }
                            $request->modal_banners[$index]->storeAs('images/designer/', $image, 'local');
                            $content['modals'][$index] = [
                                'banner_location' => 'images/designer/'. $image .'?'. time(),
                                'banner_alt' => $request->modal_banner_alts[$index],
                            ];
                        }
                    } elseif ( $request->has('existing_modal_banners.'. $index) ) {
                        $content['modals'][$index] = [
                            'banner_location' => $request->existing_modal_banners[$index],
                            'banner_alt' => $request->modal_banner_alts[$index],
                        ];
                    }

                    $content['modals'][$index]['has'] = $request->modal_has[$index];
                    $content['modals'][$index]['title'] = $request->modal_titles[$index];
                    $content['modals'][$index]['description'] = $request->modal_descriptions[$index];
                    $content['modals'][$index]['information'] = $request->modal_informations[$index];
                }
            }

            if ( $request->has('amount_of_lists') ) {
                foreach ( $request->amount_of_lists as $index => $list ) {
                    $content['modal_lists'][$index] = [
                        'has' => $request->list_has[$index],
                        'belongs' => $request->list_belongs[$index],
                        'title' => $request->list_titles[$index],
                        'has_stages' => $request->list_has_stages[$index]
                    ];
                }
            }

            if ( $request->has('amount_of_stages') ) {
                foreach ( $request->amount_of_stages as $index => $stage ) {
                    $content['modal_stages'][$index] = [
                        'name' => $request->stage_names[$index],
                        'has' => $request->stage_has[$index],
                        'belongs' => $request->stage_belongs[$index],
                        'first' => $request->stage_first[$index]
                    ];
                }
            }
            
            if ( $request->has('amount_of_list_items') ) {
                $double_index = 0;
                foreach ( $request->amount_of_list_items as $index => $list_item ) {
                    $content['modal_list_items'][$index] = [
                        'belongs' => $request->list_item_belongs[$index],
                        'type' => $request->list_item_type[$index],
                        'left_text' => $request->list_item_left_text[$index]
                    ];

                    if ( $request->list_item_type[$index] == 'double' ) {
                        $content['modal_list_items'][$index]['right_text'] = $request->list_item_right_text[$double_index];
                        $double_index++;
                    }

                    $content['modal_list_items'][$index]['is_staged'] = $request->list_item_is_staged[$index];
                    $content['modal_list_items'][$index]['stage'] = $request->list_item_stage[$index];
                    $content['modal_list_items'][$index]['stage_first'] = $request->list_item_stage_first[$index];
                }
            }

            return $content;
        }

        public $locales = ['ka', 'it'];
    // * Core Methods
}