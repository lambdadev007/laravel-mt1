<?php
namespace App\Http\Controllers;

// * Included Models
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Cookie;
    use Illuminate\Support\Facades\Session;

    // * Pages
        use App\Models\{Blog, BlogMeta, About, Homepage, Partners, Designer, Repairs, Furniture, Terms, Contact, OrderInfo, CompanyHotline,sliderForm,reciever};
        use App\Models\Vip\{VipPage, VipOrders, VipServices};
        use App\Models\Projects\{Projects, ProjectsPage};
        use App\Models\Products\{MarketMeta, ProductCategories, Products};
        use App\Models\Vacancies\{VacanciesPage, VacanciesRegister, Workforce};
        use App\Models\Users\{Users, UserCards, UserAdresses};
    // * Pages

    // * Other
        use Jenssegers\Agent\Agent;
        use Lotuashvili\LaravelSmsOffice\SmsOffice;

        use App\Mail\InvoiceMail;
        use App\Models\InvoiceMailBuffer;
    // * Other
// * Included Models

class PagesCT extends HelpersCT
{
    
    // * Pages
        // * Singular
            // php artisan migrate:refresh --path=/database/migrations/2020_07_05_120120_contact.php

            // public function __construct() {
            //     parent::__construct();
            //     if ( Session::get('locale') != 'it' ) session(['locale' => 'it']);
            //     if ( Route::currentRouteAction() != 'App\Http\Controllers\PagesCT@vip' ) return redirect('/vip-master')->send();
            // }

            public function homepage(Request $request) {
                // foreach ( VipServices::all()->toArray() as $item ) {
                //     if ( !in_array($item['id'], ['1', '2', '3', '4', '22', '48', '71', '73', '80', '122', '141']) ){
                //         $model = VipServices::find($item['id']);
                //         $model->og_slug = $item['outside_title'];
                //         $model->slug = \Str::slug($item['outside_title']);
                //         $model->save();
                //     }
                // }

                // echo('done');
                // exit();

                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( Homepage::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Homepage::find(1)->toArray(), ['slides', 'mob_slides', 'video', 'about']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }
                if ( Designer::where('id', 1)->exists() ) {
                    $data['designer']= Designer::find(1)->toArray();
                    $data['has_designer'] = true;
                } else {
                    $data['has_designer'] = false;
                }
                if ( Repairs::where('id', 1)->exists() ) {
                    $data['repairs'] = Repairs::find(1)->toArray();
                    $data['has_repairs'] = true;
                } else {
                    $data['has_repairs'] = false;
                }
                if ( Furniture::where('id', 1)->exists() ) {
                    $data['furniture'] = Furniture::find(1)->toArray();
                    $data['has_furniture'] = true;
                } else {
                    $data['has_furniture'] = false;
                }
                if ( VipPage::where('id', 1)->exists() ) {
                    $data['vip'] = VipPage::find(1)->toArray();
                    // $data['services'] = VipServices::all()->toArray();
                    $data['has_vip'] = true;
                } else {
                    $data['has_vip'] = false;
                }
                if ( $request->has('filter') && $request->filter!='all') {
                    $data['projects'] = Projects::where('show_on_homepage',1)->where('categories', 'like', '%'.$request->filter.'%')->orderBy('id','DESC')->limit(8)->get()->toArray();
                    $data['filter'] = $request->filter;
                } else {
                    $data['projects'] = Projects::where('show_on_homepage',1)->orderBy('id','DESC')->limit(8)->get()->toArray();
                    $data['filter'] = 'all';
                }
                

                return view('user.pages.homepage', compact('data', 'products_cookie', 'terms'));
            }

            public function about() {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( About::where('id', 1)->exists() ) {
                    $data = $this->decode_data(About::find(1)->toArray(), ['content', 'links', 'inner_images', 'hr']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                return view('user.pages.about', compact('data', 'products_cookie', 'terms'));
            }

            public function vip($action = null) {
                if ( $action == null ) $action = 'kar-fanjara-da-saketebi';
                if ( !in_Array($action, ['kar-fanjara-da-saketebi', 'eleqtrooba', 'kanalizacia', 'santeqnika', 'gatboba-kondicireba', 'sakhopacxovrebo-teqnika', 'universaluri-samushaoebi']) ) return redirect('/vip-master');

                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $current_page = 'services';
                $vip_number_toggle = true;

                if ( VipPage::where('id', 1)->exists() ) {
                    $data = $this->decode_data(VipPage::find(1)->toArray(), ['meta', 'dropdowns_ka', 'dropdowns_it', 'services_ka', 'services_it']);
                    $data['services'] = VipServices::all()->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                if ( Terms::where('id', 1)->exists() ) {
                    $data['terms']['content'] = Terms::find(1)->toArray()['content'];
                    $data['terms']['exists'] = true;
                } else {
                    $data['terms']['exists'] = false;
                }

                if ( OrderInfo::where('id', 1)->exists() ) {
                    $data['order_info']['content'] = $this->decode_data(OrderInfo::find(1)->toArray(), ['cities', 'regions', 'dates', 'time_frames']);
                    $data['order_info']['exists'] = true;
                } else {
                    $data['order_info']['exists'] = false;
                }

                $data['action'] = $action;
                $data['meta_index'] = array_search($action, ['kar-fanjara-da-saketebi', 'eleqtrooba', 'kanalizacia', 'santeqnika', 'gatboba-kondicireba', 'sakhopacxovrebo-teqnika', 'universaluri-samushaoebi']);

                $data['workforce_counter'] = count($data['workforce'] = Workforce::where('activated', 'true')->get()->toArray());
                $data['is_vip_number'] = true;

                return view('user.pages.vip-master', compact('data', 'products_cookie', 'current_page', 'vip_number_toggle', 'terms'));
            }

            public function vip_services($slug = null) {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $current_page = 'services';

                $dropdowns = $this->decode_data(VipPage::find(1)->toArray(), ['dropdowns_ka', 'dropdowns_it']);
                $dropdowns = array_merge($dropdowns['dropdowns_ka'], $dropdowns['dropdowns_it']);
                $link_array = ['kar-fanjara-da-saketebi', 'eleqtrooba', 'kanalizacia', 'santeqnika', 'gatboba-kondicireba', 'sakhopacxovrebo-teqnika', 'universaluri-samushaoebi'];
                $data['parent-info'] = [
                    'name' => '',
                    'link' => ''
                ];
                $data['service'] = VipServices::where('slug', $slug)->get()->first();
                $data['services'] = [];
                foreach ( $dropdowns as $dropdown ) {
                    if ( $dropdown['has'] == $data['service']->belongs ) {
                        $data['parent-info'] = [
                            'name' => $dropdown['text'],
                            'link' => '/vip-master/'. $link_array[$dropdown['belongs']]
                        ];
                    }
                }
                $services_raw = VipServices::where('belongs', $data['service']->belongs)->get()->toArray();
                $rand_num = 6;
                if ( count($services_raw) < 6 ) $rand_num = count($services_raw);
                $rand = array_rand($services_raw, $rand_num);
                foreach ( $services_raw as $i => $service ) {
                    if ( in_array($i, $rand) ) $data['services'][] = ['slug' => $service['slug'], 'title' => $service['outside_title']];
                }

                $data['workforce_counter'] = count($data['workforce'] = Workforce::where('activated', 'true')->get()->toArray());
                $data['is_vip_number'] = true;

                return view('user.pages.vip-services', compact('data', 'products_cookie', 'current_page', 'terms'));
            }

            public function vacancies() {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( VacanciesPage::where('id', 1)->exists() ) {
                    $data = $this->decode_data(VacanciesPage::find(1)->toArray(), ['categories', 'sub_categories']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                if ( VacanciesRegister::where('id', 1)->exists() ) {
                    $data['register-modal']['content'] = VacanciesRegister::find(1)->toArray()['content'];
                    $data['register-modal']['exists'] = true;
                } else {
                    $data['register-modal']['exists'] = false;
                }

                return view('user.pages.vacancies', compact('data', 'products_cookie', 'terms'));
            }
            
            public function repairs(Request $request) {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $current_page = 'services';
                if ( Repairs::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Repairs::find(1)->toArray(), ['banner_text', 'content', 'middle', 'bottom']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }
                $data['projects'] = Projects::where('show_on_servicepage',1)->where('categories', 'like', '%repairs%')->orderBy('id','DESC')->limit(8)->get()->toArray();
                    $data['filter'] = 'repairs';
                // dd($data);
                return view('user.pages.repairs.repairs', compact('data', 'products_cookie', 'current_page', 'terms'));
            }

            public function repair($id = null,Request $request) {
                if ( $id == null ) return redirect('/repairs');
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $current_page = 'services';
                if ( Repairs::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Repairs::find(1)->toArray(), ['content']);
                    $data = [
                        'raw' => $data['raw'],
                        'content' => [
                            'modal' => $data['content']['modals'][$id],
                            'modal_lists' => $data['content']['modal_lists'],
                            'modal_list_items' => $data['content']['modal_list_items']
                        ]
                    ];
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }
                // if ( $request->has('filter') && $request->filter!='all') {
                //     $data['projects'] = Projects::where('show_on_servicepage',1)->where('categories', 'like', '%'.$request->filter.'%')->orderBy('id','DESC')->limit(12)->get()->toArray();
                //     $data['filter'] = $request->filter;
                // } elseif($request->has('filter') && $request->filter=='all') {
                //     $data['projects'] = Projects::where('show_on_servicepage',1)->orderBy('id','DESC')->limit(12)->get()->toArray();
                //     $data['filter'] = 'all';
                // }else{
                //     $data['projects'] = Projects::where('show_on_servicepage',1)->where('categories', 'like', '%repairs%')->orderBy('id','DESC')->limit(12)->get()->toArray();
                //     $data['filter'] = 'repairs';
                // }
                $data['projects'] = Projects::where('show_on_servicepage',1)->where('categories', 'like', '%repairs%')->orderBy('id','DESC')->limit(8)->get()->toArray();
                    $data['filter'] = 'repairs';
                if ( $id == 0 ) $data['has_invoice'] = true;
                return view('user.pages.repairs.repair', compact('data', 'products_cookie', 'current_page', 'terms'));
            }

            public function repair_invoice(Request $request) {
                $data = [];
                $data['email'] = $request->requestor_email;
                $data['type'] = $request->requestor_type;
                $data['name'] = $request->name;
                $data['phone_number'] = $request->phone_number;
                $data['p_id'] = $request->p_id;

                if ( Cookie::has('invoice_sent') ) return redirect()->back()->with(['invoice_already_sent' => true]);

                if ( Repairs::where('id', 1)->exists() ) {
                    $repairs = Repairs::find(1);
                    $flat_size = (int)$request->flat_size;
                    if ( $flat_size > 80 ) {
                        $price = $flat_size * (float)$repairs->invoice_price_high;
                    } else {
                        $price = (float)$repairs->invoice_price_low;
                    }

                    if ( date('d.m.Y') != $repairs->invoice_counter_date ) {
                        $repairs->update(['invoice_counter_date' => date('d.m.Y'), 'invoice_counter_int' => 2]);
                        $data['invoice_counter'] = 1;
                    } else {
                        $int_counter = $repairs->invoice_counter_int;
                        $int_counter++;
                        $data['invoice_counter'] = $repairs->invoice_counter_int;
                        $repairs->update(['invoice_counter_int' => $int_counter]);
                    }

                } else {
                    return redirect('/repairs');
                }
                $data['price'] = $price;
                
                if ( InvoiceMailBuffer::where('id', 1)->exists() ) {
                    InvoiceMailBuffer::find(1)->update($data);
                } else {
                    InvoiceMailBuffer::create($data);
                }

                \Mail::send('mail.invoice_alert', $data, function ($message) {
                    $data = InvoiceMailBuffer::find(1)->toArray();
                    $pdf = \PDF::loadView('user.pages.repairs.invoice', ['data' => $data]);
                    $message->attachData($pdf->output(), 'invoice.pdf');
                    $message->to('metrix.ge@gmail.com');
                    $message->from('metrixsmsoffice@gmail.com');
                });
                \Mail::send('mail.invoice_alert', $data, function ($message) {
                    $data = InvoiceMailBuffer::find(1)->toArray();
                    $pdf = \PDF::loadView('user.pages.repairs.invoice', ['data' => $data]);
                    $message->attachData($pdf->output(), 'invoice.pdf');
                    $message->to('info@metrix.ge');
                    $message->from('metrixsmsoffice@gmail.com');
                });
                \Mail::send('mail.invoice_alert', $data, function ($message) {
                    $data = InvoiceMailBuffer::find(1)->toArray();
                    $pdf = \PDF::loadView('user.pages.repairs.invoice', ['data' => $data]);
                    $message->attachData($pdf->output(), 'invoice.pdf');
                    $message->to($data['email']);
                    $message->from('metrixsmsoffice@gmail.com');
                });

                Cookie::queue('invoice_sent', true, 60);
                
                $pdf = \PDF::loadView('user.pages.repairs.invoice', ['data' => $data]);
                return $pdf->download('invoice.pdf');

                return redirect()->back()->with(['invoice_sent' => true]);
            }


            //sliderForm
            public function slider_invoice(Request $request,SmsOffice $smsoffice) {
                session_start();
                // print_r($_POST);
                // exit;
                $data=[];
                if(isset($_POST['action']) && $_POST['action']=='first_form'){
                    extract($_POST);
                    
                    if($is_company!='false'){
                        
                        $row=sliderForm::where('status',1)->get()->toArray();
                        foreach($row as $frm):
                        
                            if($calculate_form > $frm['square_limit']){
                                
                                $price=$calculate_form*$frm['price_high'];
                            }else{
                                
                                $price=$frm['price_low'];//$calculate_form*$frm['price_low'];
                            }
                        endforeach;
                    }else{
                        $row=sliderForm::where('status',0)->get()->toArray();
                        foreach($row as $frm):
                        
                            if($calculate_form > $frm['square_limit']){
                                
                                $price=$calculate_form*$frm['price_high'];
                            }else{
                                
                                $price=$frm['price_low'];//$calculate_form*$frm['price_low'];
                            }
                        endforeach;
                    }
                    
                    $data['status']='success';
                    $data['price']=$price;
                    return json_encode($data);

                }
                if($request->has('is_company')){
                    $data['is_company']=true;
                    $data['form']=sliderForm::where('status',1)->get()->toArray();
                    foreach($data['form'] as $frm):
                   
                        if($request->input('calculate_form') > $frm['square_limit']){
                            
                            $price=$request->input('calculate_form')*$frm['price_high'];
                        }else{
                            
                            $price=$frm['price_low'];// $request->input('calculate_form')*$frm['price_low'];
                        }
                    endforeach;
                }else{
                    $data['is_company']=false;
                    $data['form']=sliderForm::where('status',0)->get()->toArray();
                    foreach($data['form'] as $frm):
                   
                        if($request->input('calculate_form') > $frm['square_limit']){
                            
                            $price=$request->input('calculate_form')*$frm['price_high'];
                        }else{
                            
                            $price=$frm['price_low'];// $request->input('calculate_form')*$frm['price_low'];
                        }
                    endforeach;
                }
                if ( Repairs::where('id', 1)->exists() ) {
                    $repairs = Repairs::find(1);
                    //$flat_size = (int)$request->flat_size;
                    // if ( $flat_size > 80 ) {
                    //     $price = $flat_size * (float)$repairs->invoice_price_high;
                    // } else {
                    //     $price = (float)$repairs->invoice_price_low;
                    // }

                    if ( date('d.m.Y') != $repairs->invoice_counter_date ) {
                        $repairs->update(['invoice_counter_date' => date('d.m.Y'), 'invoice_counter_int' => 2]);
                        $data['invoice_counter'] = 1;
                    } else {
                        $int_counter = $repairs->invoice_counter_int;
                        $int_counter++;
                        $data['invoice_counter'] = $repairs->invoice_counter_int;
                        $repairs->update(['invoice_counter_int' => $int_counter]);
                    }

                }
                
              
                
                
                $data['price'] = $price;
                $data['fill'] = $request->input('calculate_form2');
                $data['full_name'] = $request->input('full_name2');
                $data['email'] = $request->input('email2');
                $data['phone_number'] = $request->input('phone_number2');
                $_SESSION['data'] = $data;

                //   $smsoffice->send('597056520', 'New invoice request');
                $receiver=reciever::where('status',1)->get()->toArray();
                foreach($receiver as $rec):
                    if($rec['send_email']=='yes' && !empty($rec['email'])){
                        $email=$rec['email'];
                        \Mail::send('mail.invoice_slider',$data, function ($message) use(&$email,&$data){
                            // $data = InvoiceMailBuffer::find(1)->toArray();
                            $pdf = \PDF::loadView('user.pages.repairs.invoice_slider',['data'=>$data]);
                            $message->subject('New Invoice');
                            $message->attachData($pdf->output(), 'invoice.pdf');
                            $message->to($email);
                            $message->from('metrixsmsoffice@gmail.com');
                        });
                    }
                    if($rec['send_sms']=='yes' && !empty($rec['phone'])){
                        $smsoffice->send($rec['phone'], 'New invoice request');
                    }
                endforeach;
                // exit;
                
                // \Mail::send('mail.invoice_alert', $data, function ($message) {
                //     $data = InvoiceMailBuffer::find(1)->toArray();
                //     $pdf = \PDF::loadView('user.pages.repairs.invoice', ['data' => $data]);
                //     $message->attachData($pdf->output(), 'invoice.pdf');
                //     $message->to('info@metrix.ge');
                //     $message->from('metrixsmsoffice@gmail.com');
                // });
                $pdf = \PDF::loadView('user.pages.repairs.invoice_slider',['data'=>$data]);
                
                return $pdf->download('invoice.pdf');
                

                return redirect()->back()->with(['invoice_sent' => true]);

            }
            public function designer(Request $request) {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $current_page = 'services';
                if ( Designer::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Designer::find(1)->toArray(), ['banner_text', 'content', 'tabs', 'render']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                // if ( $request->has('filter') && $request->filter!='all') {
                //     $data['projects'] = Projects::where('show_on_servicepage',1)->where('categories', 'like', '%'.$request->filter.'%')->orderBy('id','DESC')->limit(12)->get()->toArray();
                //     $data['filter'] = $request->filter;
                // } elseif($request->has('filter') && $request->filter=='all') {
                //     $data['projects'] = Projects::where('show_on_servicepage',1)->orderBy('id','DESC')->limit(12)->get()->toArray();
                //     $data['filter'] = 'all';
                // }else{
                //     $data['projects'] = Projects::where('show_on_servicepage',1)->where('categories', 'like', '%designer%')->orderBy('id','DESC')->limit(12)->get()->toArray();
                //     $data['filter'] = 'designer';
                // }
                $data['projects'] = Projects::where('show_on_servicepage',1)->where('categories', 'like', '%designer%')->orderBy('id','DESC')->limit(8)->get()->toArray();
                    $data['filter'] = 'designer';
                return view('user.pages.designer', compact('data', 'products_cookie', 'current_page', 'terms'));
            }

            public function furniture(Request $request) {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $current_page = 'services';
                if ( Furniture::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Furniture::find(1)->toArray(), ['banner_text', 'content', 'bottom']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }
                $data['projects'] = Projects::where('show_on_servicepage',1)->where('categories', 'like', '%furniture%')->orderBy('id','DESC')->limit(8)->get()->toArray();
                    $data['filter'] = 'all';
                return view('user.pages.furniture', compact('data', 'products_cookie', 'current_page', 'terms'));
            }

            public function contact() {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( Contact::where('id', 1)->exists() ) {
                    $data = $this->decode_data(Contact::find(1)->toArray(), ['services']);
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                $current_page = 'contact';
                return view('user.pages.contact', compact('data', 'products_cookie', 'current_page', 'terms'));
            }

            public function search(Request $request) {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $data['search_keyword'] = $request->keyword;
                $data['articles'] = Blog::where('title', 'like', '%'. $request->keyword .'%')->get()->toArray();
                $data['products'] = Products::where('name', 'like', '%'. $request->keyword .'%')->get()->toArray();
                $data['amount_of_results'] = count($data['articles']) + count($data['products']);

                return view('user.pages.search', compact('data', 'products_cookie', 'terms'));
            }
        // * Singular

        // * Market
            public function market(Request $request) {
                if ( $request->has('category') && !$request->has('group') ) return redirect('/');
                if ( $request->has('group') ) {
                    if ( Session::has('market.group') ) if ( Session::get('market.group') != $request->group ) Session::forget('market.filters');
                    Session::put('market.group', $request->group);
                }
                if ( $request->has('category') ) {
                    if ( Session::has('market.category') ) if ( Session::get('market.category') != $request->category ) Session::forget('market.filters');
                    Session::put('market.category', $request->category);
                }

                if ( MarketMeta::where('id', 1)->exists() ) {
                    $meta = MarketMeta::find(1)->toArray();
                    $meta['exists'] = true;
                } else {
                    $meta['exists'] = false;
                }

                $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

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
                                $products = Products::where($query)->whereIn('country', $query_filters['country'])->whereIn('brand', $query_filters['brand'])->orderBy('brand', 'asc')->orderBy('price', $sort_by)->paginate($paginate_for);
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

                // * Favorites
                    $favorite_ids = [];
                    if ( Cookie::has('favorites_000') ) $favorite_ids = json_decode(Cookie::get('favorites_000'), true);
                    session(['favorites' => $favorite_ids]);
                    $favorites = Products::whereIn('id', array_keys($favorite_ids))->orderBy('brand', 'asc')->orderBy('price', $sort_by)->get()->toArray();
                // * Favorites

                $compact = false;
                if ( Session::has('market_compact') && Session::get('market_compact') == true ) $compact = true;
                
                $current_page = 'market';

                return view('user.pages.market.market', compact('meta', 'product_categories', 'products_cookie', 'get_data', 'products', 'favorites', 'filters', 'compact', 'current_page', 'terms'));
            }
            public function projects_singles(Request $request, $id){
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( ProjectsPage::where('id', 1)->exists() ) {
                    $data['raw'] = ProjectsPage::find(1)->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }
                if ( $request->has('open') ) {
                    $data['open'] = $request->open;
                } else {
                    $data['open'] = false;
                }
                // $projects = Projects::;
                $single_projects = Projects::where('id',$id)->first();
                if(empty($single_projects)){
                    return redirect('/projects');
                }
                // print_r($single_projects);
                // exit;

                $similar_projects = Projects::where([['id', '!=', $single_projects['id']], ['categories', $single_projects['categories']]])->inRandomOrder()->limit(4)->get();

                return view('user.pages.single_projects', compact('data','single_projects','products_cookie','terms','similar_projects'));
            }
            public function projects_single(Request $request){
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( ProjectsPage::where('id', 1)->exists() ) {
                    $data['raw'] = ProjectsPage::find(1)->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                if ( $request->has('filter') ) {
                    $data['projects'] = Projects::where('categories', 'like', '%'.$request->filter.'%')->latest()->paginate(10);
                    $data['filter'] = $request->filter;
                } else {
                    $data['projects'] = Projects::latest()->paginate(10);
                    $data['filter'] = 'all';
                }

                if ( $request->has('open') ) {
                    $data['open'] = $request->open;
                } else {
                    $data['open'] = false;
                }

                $current_page = 'projects';

                $single_projects = Projects::get();

                return view('user.pages.single_projects', compact('data', 'products_cookie', 'current_page', 'terms','single_projects'));
           
            }
            public function projects_design(Request $request){
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( ProjectsPage::where('id', 1)->exists() ) {
                    $data['raw'] = ProjectsPage::find(1)->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                if ( $request->has('filter') ) {
                    $data['projects'] = Projects::where('categories', 'like', '%'.$request->filter.'%')->latest()->paginate(10);
                    $data['filter'] = $request->filter;
                } else {
                    $data['projects'] = Projects::latest()->paginate(10);
                    $data['filter'] = 'all';
                }

                if ( $request->has('open') ) {
                    $data['open'] = $request->open;
                } else {
                    $data['open'] = false;
                }

                $current_page = 'projects';

                return view('user.pages.design_single_projects', compact('data', 'products_cookie', 'current_page', 'terms'));
           
            }
            public function market_product($slug = null) {
                $this->destroyFilters();
                if ( $slug == null ) return redirect('/');

                if ( Products::where('slug', $slug)->exists() ) {
                    $product = Products::where('slug', $slug)->get()->first()->toArray();
                } else {
                    return redirect('/');
                }

                $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $similar_products = Products::where([['id', '!=', $product['id']], ['belongs_category', $product['belongs_category']]])->take(8)->get()->toArray();

                $current_page = 'market';
                return view('user.pages.market.product', compact('product_categories', 'products_cookie', 'product', 'similar_products', 'current_page', 'terms'));
            }
        // * Market

        // * Blog
            public function blog() {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( BlogMeta::where('id', 1)->exists() ) {
                    $data['meta'] = BlogMeta::find(1)->toArray();
                    $data['meta']['exists'] = true;
                } else {
                    $data['meta']['exists'] = false;
                }

                $data['articles'] = Blog::where('locale', Session::get('locale'))->paginate(16);
                $data['header_articles'] = Blog::where('locale', Session::get('locale'))->orderBy('id', 'DESC')->get()->take(4);
                $current_page = 'blog';
                
                return view('user.pages.blog.outer', compact('data', 'products_cookie', 'current_page', 'terms'));
            }

            public function article($slug) {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                if ( Blog::where('slug', $slug)->doesntExist() ) {
                    return redirect('/blog');
                } else {
                    $article = Blog::where('slug', $slug)->get()->first()->toArray();

                    $add_views = Blog::find($article['id']);
                    $add_views->views = $article['views'] + 1;
                    $add_views->save();

                    $article['views'] = $article['views'] + 1;
                    if ( $article['author'] == 'ადმინისტრატორი' ) $article['author'] = 'კომპანია მეტრიქსი';
                    $data = [
                        'article' => $article,
                        'similar_articles' => Blog::where('category', $article['category'])->get()->toArray()
                    ];
                    $current_page = 'blog';
                    
                    return view('user.pages.blog.inner', compact('data', 'products_cookie', 'current_page', 'terms'));
                }
            }
        // * Blog

        // * Projects
            public function projects(Request $request) {
                $this->destroyFilters();
                // $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();
                $projects=Projects::all();
                $data['total_counts']=$projects->count();
                if ( ProjectsPage::where('id', 1)->exists() ) {
                    $data['raw'] = ProjectsPage::find(1)->toArray();
                    $data['exists'] = true;
                } else {
                    $data['exists'] = false;
                }

                if ( $request->has('filter') ) {
                    $data['total_showed']=16;
                    $projects=Projects::where('categories', 'like', '%'.$request->filter.'%')->get();
                    $data['total_counts']=$projects->count();
                    $data['projects'] = Projects::where('categories', 'like', '%'.$request->filter.'%')->orderBy('id', 'DESC')->limit(16)->get();
                    $data['filter'] = $request->filter;
                } elseif($request->has('page')){
                    
                    $page=$request->input('page');
                    $offset=($page-1)*16;
                    $data['total_showed']=$offset+16;
                    $data['projects'] = Projects::orderBy('id', 'DESC')->offset($offset)->limit(16)->get();
                    
                    $data['filter'] = 'all';
                }else {
                    $data['total_showed']=16;
                    $data['projects'] = Projects::orderBy('id', 'DESC')->offset(0)->limit(16)->get();
                    $data['filter'] = 'all';
                }
                // if(count($data['projects'])==0){
                //     $data['show_all']=true;
                //     // $data['projects'] = Projects::orderBy('id', 'DESC')->offset(0)->limit(16)->get();
                //     // $data['filter'] = 'all';
                // }
                
                
                // echo"<pre>";
                // print_r($data['total_counts']);
                // echo"</pre>";

                // exit;
                if ( $request->has('open') ) {
                    $data['open'] = $request->open;
                } else {
                    $data['open'] = false;
                }

                $current_page = 'projects';

                return view('user.pages.projects', compact('data', 'products_cookie', 'current_page', 'terms'));
            }
        // * Projects
    // * Pages

    // * Users
        public function cart() {
            $this->destroyFilters();
            $product_categories = $this->getProductCategories();
            $products_cookie = $this->getProductsCookie();
            $terms = $this->getTerms();

            $current_page = 'market';
            return view('user.pages.market.cart', compact('product_categories', 'products_cookie', 'current_page', 'terms'));
        }

        public function purchase_history() {
            $this->destroyFilters();
            $product_categories = $this->getProductCategories();
            $products_cookie = $this->getProductsCookie();
            $terms = $this->getTerms();

            $current_page = 'market';
            return view('user.pages.market.purchase-history', compact('product_categories', 'products_cookie', 'current_page', 'terms'));
        }

        public function profile() {
            if ( Cookie::has('user_000') ) {
                $this->destroyFilters();
                $product_categories = $this->getProductCategories();
                $products_cookie = $this->getProductsCookie();
                $terms = $this->getTerms();

                $data = Users::where('email', json_decode(Cookie::get('user_000'), true)['email'])->get()->first()->toArray();

                $current_page = 'market';
                return view('user.pages.market.profile', compact('data', 'product_categories', 'products_cookie', 'current_page', 'terms'));
            } else {
                return redirect('/');
            }
        }

        public function user_register(Request $request) {
            
            
            if ( Users::where('email', $request->email)->exists() ) return redirect()->back()->with(['email_taken' => true]);
            if ( $request->password !== $request->password_repeat ) return redirect()->back()->with(['password_missmatch' => true]);
            if ( $request->$terms !== 'on') return redirect()->back()->with(['terms_checks' => true]);
            
            $password = Crypt::encrypt($request->password);
            $data = [
                'username' => $request->username,
                'email' => $request->email
            ];

            $model = new Users;
            $model->username = $data['username'];
            $model->email = $data['email'];
            $model->password = $password;
            $model->save();

            Cookie::queue('user_000', json_encode($data), 43200);
            return redirect()->back()->with(['register_success' => true]);
        }

        public function user_login(Request $request) {
            if ( Users::where('email', $request->email)->exists() ) {
                $password = Crypt::decrypt(Users::where('email', $request->email)->get()[0]->password);
                if ( $password === $request->password ) {
                    $data = [
                        'username' => $request->username,
                        'email' => $request->email,
                    ];
                    Cookie::queue('user_000', json_encode($data), 43200);

                    return redirect()->back();
                }
            } else {
                return redirect()->back()->with(['password_incorrect' => true]);
            }
        }

        public function user_update(Request $request) {
            if ( Cookie::has('user_000') ) {
                $db_user = Users::where('email', json_decode(Cookie::get('user_000'))->email);
                if ( $db_user->exists() ) {
                    if ( $request->new_password !== $request->repeat_new_password ) return redirect()->back()->with(['password_missmatch' => true]);
                    if ( Crypt::decrypt($db_user->get()[0]->password) !== $request->current_password ) return redirect()->back()->with(['password_missmatch' => true]);
                    if ( $request->email !== json_decode(Cookie::get('user_000'))->email 
                        && Users::where('email', $request->email)->exists() ) return redirect()->back()->with(['email_taken' => true]);

                    $model = Users::find($db_user->get()[0]->id);
                    $model->username = $request->username;
                    $model->last_name = $request->last_name;
                    $model->email = $request->email;
                    $model->phone_number = $request->phone_number;
                    $model->password = Crypt::encrypt($request->new_password);
                    $model->save();

                    $data = [
                        'username' => $request->username,
                        'email' => $request->email,
                    ];

                    Cookie::queue('user_000', json_encode($data), 43200);

                    return redirect()->back()->with(['profile_changes_saved' => true]);
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/');
            }
        }

        public function user_logout(Request $request) {
            Cookie::queue(Cookie::forget('user_000'));
            return redirect()->back();
        }
    // * Users

    // * Communication
        public function sendsms($type = null, Request $request, SmsOffice $smsoffice) {
            switch ($type) {
                case 'contact':
                    $message = 'სახელი: ' .$request->name. '
ემაილი: ' .$request->email. '
სერვისის ტიპი: ' .$request->service_type. '
მესიჯი: ' .$request->message;
                    $smsoffice->send('597056520', $message);
                    break;
                case 'vip':
                    $message = 'ზარის მოთხოვნა:
სახელი: ' .$request->name. '
მობ. ნომერი: ' .$request->number;
                    $smsoffice->send('597056520', $message);
                    break;
                case 'workforce':
                    foreach ( Workforce::where('selected_vacancies', 'like', '%' .$request->message_target. '%')->get() as $item ) {
                        $smsoffice->send('597056520', $request->message_text);
                        // $smsoffice->send($item->phone_number, $request->message_text);
                    }
                break;
            }

            return redirect()->back()->with(['message_sent' => true]);
        }
    // * Communication

    // * Post
        public function sent_vacancy(Request $request) {
            if ( $this->validate_number($request->phone_number)['valid'] ) {
                if ( Workforce::where('phone_number', $request->phone_number)->exists() ) return redirect()->back()->with(['number_used' => true]);
                $model = new Workforce;

                if ( $request->selected_vacancies == null || $request->selected_vacancies == '' ) return redirect()->back()->with(['select_vacancies' => true]);

                if ( $request->type == 'worker' ) {
                    $model->type = $request->type;
                    $model->name = $request->name;
                    $model->last_name = $request->last_name;
                    if ( $request->amount_of_workers == null ) {
                        $model->amount_of_workers = 'alone';
                    } else {
                        $model->amount_of_workers = $request->amount_of_workers;
                    }
                    
                    $model->phone_number = $request->phone_number;

                    $selected_vacancies = [];

                    foreach ( explode('-', $request->selected_vacancies) as $selected_vacancy ) {
                        $selected_vacancies[] = $selected_vacancy;
                    }

                    $model->selected_vacancies = json_encode($selected_vacancies);

                    $model->save();
                } elseif ( $request->type == 'legal-entity' ) {
                    $model->type = $request->type;
                    $model->company_name = $request->company_name;
                    $model->identification_code = $request->identification_code;
                    $model->legal_entity_name = $request->legal_entity_name;
                    $model->shop_address = $request->shop_address;
                    $model->mail = $request->mail;
                    $model->phone_number = $request->phone_number;

                    $selected_vacancies = [];

                    foreach ( explode('-', $request->selected_vacancies) as $selected_vacancy ) {
                        $selected_vacancies[] = $selected_vacancy;
                    }

                    $model->selected_vacancies = json_encode($selected_vacancies);
                    
                    $model->save();
                }
                return redirect()->back()->with(['vacancy_sent' => true]);
            } else {
                return redirect()->back();
            }
        }

        public function order(Request $request, $action = null) {
            if ( $action == null || !in_array($action, ['vip']) ) return redirect('/');

            $model = new VipOrders;

            $model->service_id = $request->service_id;
            $model->name = $request->name;
            $model->last_name = $request->last_name;
            $model->phone_number = $request->phone_number;
            $model->city = $request->city;
            $model->region = $request->region;
            $model->date_type = $request->date_type;
            if ( $request->date_type == 'defined_time' ) {
                $model->date = $request->date;
                $model->time_frame = $request->time_frame;
            }

            $model->save();

            return redirect()->back()->with(['order_sent' => true]);
        }

        public function change_locale(Request $request) {
            session(['locale' => $request->locale]);
            return redirect()->back();
        }
    // * Post

    // * Ajax
        public function market_sorting_ajax(Request $request) {
            if ( $request->ajax() ) {
                if ( $request->has('sort')) {
                    if ( in_array($request->sort['keywords'], ['country', 'brand']) ) {
                        $data = [];
                        if ( Session::has('market.filters.'. $request->sort['keywords']) ) {
                            foreach( Session::get('market.filters.'. $request->sort['keywords']) as $index => $keyword ) {
                                $data[$index] = $keyword;
                            }
                        }
                        if ( in_array($request->sort['values'], $data) ) {
                            unset($data[array_search($request->sort['values'], $data)]);
                        } else {
                            $data[] = $request->sort['values'];
                        }
                        session(['market.filters.'. $request->sort['keywords'] => $data]);
                    } else {
                        foreach ( $request->sort['keywords'] as $index => $keyword ) {
                            session(['market.'. $keyword => $request->sort['values'][$index]]);
                        }
                    }
                    return;
                }
                return;
            }
            return;
        }

        public function market_product_cookie(Request $request) {
            if ( $request->ajax() ) {
                if ( $request->has('data')) {
                    if ( $request->data['action'] == 'add' ) {
                        if ( Cookie::has('products_cookie_000') ) {
                            $data = json_decode(Cookie::get('products_cookie_000'), true);
                            $product = Products::find($request->data['key']);

                            if ( array_key_exists($request->data['key'], $data) ) {
                                if ( $product->has_variants == 'false' ) {
                                    return 'already-exists';
                                } else {
                                    if ( in_array($request->data['variant_id'], $data[$request->data['key']]['variants']) ) {
                                        return 'already-exists';
                                    } else {
                                        $data[$request->data['key']]['variants'][] = $request->data['variant_id'];
                                    }
                                }
                            } else {
                                $data[$request->data['key']]['has_variants'] = $request->data['has_variants'];
                                if ( $request->data['has_variants'] == 'true' ) $data[$request->data['key']]['variants'][] = $request->data['variant_id'];
                            }

                            Cookie::queue('products_cookie_000', json_encode($data), 43200);
                            return;
                        } else {
                            $data = [];
                            $data[$request->data['key']]['has_variants'] = $request->data['has_variants'];
                            $data[$request->data['key']]['variants'][] = $request->data['variant_id'];
                            Cookie::queue('products_cookie_000', json_encode($data), 43200);
                            return;
                        }
                    } elseif ( $request->data['action'] == 'remove' ) {
                        if ( Cookie::has('products_cookie_000') ) {
                            $data = json_decode(Cookie::get('products_cookie_000'), true);

                            if ( $request->data['has_variants'] == 'true' ) {
                                if ( array_key_exists($request->data['key'], $data) ) {
                                    $index = array_search($request->data['variant_id'], $data[$request->data['key']]['variants']);
                                    unset($data[$request->data['key']]['variants'][$index]);

                                    if ( $data[$request->data['key']]['variants'] == [] ) unset($data[$request->data['key']]);
                                }
                            } else {
                                if ( array_key_exists($request->data['key'], $data) ) {
                                    unset($data[$request->data['key']]);
                                }
                            }

                            Cookie::queue('products_cookie_000', json_encode($data), 43200);
                            return;
                        }
                        return;
                    }
                    return;
                }
                return;
            }
            return;
        }

        public function market_find_product(Request $request) {
            if ( $request->ajax() ) {
                if ( $request->has('key')) {
                    $data = $this->decode_data(Products::find($request->key)->toArray(), ['variants']);
                    $data = [
                        'raw' => [
                            'id'                => $data['raw']['id'],
                            'brand'             => $data['raw']['brand'],
                            'price'             => $data['raw']['price'],
                            'measuring'         => $data['raw']['measuring'],
                            'has_variants'      => $data['raw']['has_variants'],
                            'discount'          => $data['raw']['discount'],
                            'discount_amount'   => $data['raw']['discount_amount'],
                            'name'              => $data['raw']['name'],
                            'image'             => $data['raw']['image'],
                            'image_alt'         => $data['raw']['image_alt'],
                        ],
                        'variants' => $data['variants']
                    ];
                    return $data;
                }
                return;
            }
            return;
        }

        public function market_favorites(Request $request) {
            if ( $request->ajax() ) {
                if ( $request->has('key')) {
                    $favorites = [];
                    if ( Cookie::has('favorites_000') ) $favorites = json_decode(Cookie::get('favorites_000'), true);
                    $key = $request->key;
                    $variant_index = $request->variant_index;

                    if ( $variant_index != null ) {
                        if ( array_key_exists($key, $favorites) ) {
                            if ( is_array($favorites[$key]) ) {
                                if ( in_array($variant_index, $favorites[$key]['variants']) ) {
                                    unset($favorites[$key]['variants'][array_search($variant_index, $favorites[$key]['variants'])]);
                                    if ( $favorites[$key]['variants'] == [] ) unset($favorites[$key]);
                                } else {
                                    $favorites[$key]['variants'][] = $variant_index;
                                }
                            } else {
                                $favorites[$key]['variants'][] = $variant_index;
                            }
                        } else {
                            $favorites[$key]['variants'][] = $variant_index;
                        }
                    } else {
                        if ( array_key_exists($key, $favorites) ) {
                            unset($favorites[$key]);
                        } else {
                            $favorites[$key]['variants'][] = null;
                        }
                    }

                    Cookie::queue('favorites_000', json_encode($favorites), 864000);
                    return;
                }
                return;
            }
            return;
        }

        public function market_style(Request $request) {
            if ( $request->ajax() ) {
                if ( $request->has('style')) {
                    if ( $request->style === 'regular' ) {
                        session(['market_compact' => true]);
                    } else {
                        session(['market_compact' => false]);
                    }
                }
                return;
            }
            return;
        }

        public function grab_user(Request $request) {
            if ( $request->ajax() ) {
                if ( Cookie::has('user_000') ) {
                    
                }
            }
            return;
        }
        public function verifyNumber(Request $request,SmsOffice $smsoffice){
            session_start();
            // print_r($_POST);
            if(isset($_REQUEST['action']) && $_REQUEST['action']=="verify"){
                $otp=rand(100000, 999999);
                $_SESSION['form_otp']=$otp;
                $message=" თქვენ მოითხოვეთ სისტემაში შესვლა, ერთჯერადი კოდია: ".$otp;
               $nmbr=$_POST['number'];
               $response = $smsoffice->send($nmbr, $message);
            //    $response=json_decode($response,true);
    
            //    print_r($response);
                return $response;
            }elseif(isset($_REQUEST['action']) && $_REQUEST['action']=="submit_otp"){
                $data=[];
                if($_REQUEST['otp']==$_SESSION['form_otp']){
                    $data['status']="success";
                    $data['msg']="Number Verified";
                    unset($_SESSION['form_otp']);
                    return json_encode($data); 
                }else{
                    $data['status']="error";
                    $data['msg']="Invaild OTP Code";
                    
                    return json_encode($data);
                }
            }
            
        }
    // * Ajax
}
