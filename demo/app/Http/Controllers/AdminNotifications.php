<?php

namespace App\Http\Controllers;

// * Included Models
    use App\Models\Admins;

    use App\Models\Shops;
    use App\Models\Notifications;
    use App\Models\Messages;

    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Crypt;
    use Illuminate\Support\Facades\Session;
// * Included Models

class AdminNotifications extends AdminCore
{
    // * Methods
        private function counter($category, $timeframe, $status) {
            if ( $this->is_admin() ) {
                if ( $status == 'shalva_status' ) {
                    return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe], ['shalva_status', 'unseen']])->get()->toArray());
                }  elseif ( $status == 'unfinished' ) {
                    return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe], ['status', '!=', 'finished']])->get()->toArray());
                } elseif ( $status == 'total' ) {
                    return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe]])->get()->toArray());
                } else {
                    return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe], ['status', $status]])->get()->toArray());
                }
            } elseif ( $this->is_manager() ) {
                if ( $category == 'call_request' ) {
                    if ( $status == 'unfinished' ) {
                        return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe], ['call_request_category', Session::get('admin.info.category')], ['status', '!=', 'finished']])->get()->toArray());
                    } elseif ( $status == 'total' ) {
                        return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe], ['call_request_category', Session::get('admin.info.category')]])->get()->toArray());
                    } else {
                        return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe], ['call_request_category', Session::get('admin.info.category')], ['status', $status]])->get()->toArray());
                    }
                } else {
                    if ( $status == 'unfinished' ) {
                        return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe], ['status', '!=', 'finished']])->get()->toArray());
                    } elseif ( $status == 'total' ) {
                        return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe]])->get()->toArray());
                    } else {
                        return count(Notifications::where([['type', $category], ['current_timeframe', $timeframe], ['status', $status]])->get()->toArray());
                    }
                }
            }
        }

        public function generator(Request $request) {
            if ( $request->type != null ) {
                $lifespan_arr = [
                    'day'   => time() + 86400,
                    'month' => time() + 2765000,
                    'year'  => time() + 31540000
                ];

                $model                      = new Notifications;
                $model->type                = Crypt::decrypt($request->type);
                $model->status              = 'unseen';
                $model->finished            = null;
                $model->shalva_status       = 'unseen';
                $model->lifespan            = json_encode($lifespan_arr);
                $model->current_timeframe   = 'day';

                $type = Crypt::decrypt($request->type);

                $number = '';

                if ( $type == 'call_request' ) {
                    $validation = $this->validate_number($request->requester_number);

                    if ( $validation['valid'] ) {
                        $number = $validation['number'];
                    } else {
                        return redirect()->back()->with([$validation['reason'] => true]);
                    }

                    $call_request_category = Crypt::decrypt($request->call_request_category);

                    $data = [
                        'requester_name'        => $request->requester_name,
                        'requester_number'      => $number,
                        'call_request_category' => $call_request_category,
                    ];

                    $category = null;

                    if ( in_array($call_request_category, ['repairs', 'materials', 'master']) ) {
                        $category = 'repairs';
                    } else {
                        $category = $call_request_category;
                    }

                    $model->call_request_category = $call_request_category;
                    $model->information = json_encode($data);
                } elseif ( $type == 'vacancy' ) {
                    if ( $request->SGI == [] && Crypt::decrypt($request->vacancy_type) == 'employee' ) {
                        return redirect()->back()->with(['choose_a_vocation' => true]);
                    } else {
                        $validation = $this->validate_number($request->number);

                        if ( $validation['valid'] ) {
                            $number = $validation['number'];
                        } else {
                            return redirect()->back()->with([$validation['reason'] => true]);
                        }

                        $data = [
                            'number'            => $number,
                            'vacancy_type'      => Crypt::decrypt($request->vacancy_type),
                        ];

                        if ( Crypt::decrypt($request->vacancy_type) == 'employee' ) {
                            $vocations = [];

                            foreach ( $request->SGI as $vocation ) {
                                $vocations[] = $vocation;
                            }

                            $data['f_name']    = $request->f_name;
                            $data['l_name']    = $request->l_name;
                            $data['how_many']  = $request->how_many;
                            $data['vocations'] = $vocations;
                        }

                        if ( Crypt::decrypt($request->vacancy_type) == 'legal_entity' ) {
                            $data['company_name']           = $request->company_name;
                            $data['identification_code']    = $request->identification_code;
                            $data['mail']                   = $request->mail;
                            $data['field_of_activity']      = $request->field_of_activity;
                        }

                        $model->information = json_encode($data);
                    }
                } elseif ( $type == 'consultation' ) {
                    if ( $request->service_ids == null ) {
                        return redirect()->back()->with(['choose_a_service' => true]);
                    } else {
                        $validation = $this->validate_number($request->number);

                        if ( $validation['valid'] ) {
                            $number = $validation['number'];
                        } else {
                            return redirect()->back()->with([$validation['reason'] => true]);
                        }

                        $service_arr = [];

                        foreach ( $request->service_ids as $service ) {
                            $service_ids[] = $service;
                        }

                        $data = [
                            'name'      => $request->name,
                            'city'      => $request->city,
                            'region'    => $request->region,
                            'address'   => $request->address,
                            'number'    => $number,
                            'date'      => $request->date,
                            'services'  => $service_ids,
                            'total'     => $request->total_price,
                        ];

                        $model->information = json_encode($data);
                    }
                } elseif ( $type == 'contact' ) {
                    $validation = $this->validate_number($request->number);

                    if ( $validation['valid'] ) {
                        $number = $validation['number'];
                    } else {
                        return redirect()->back()->with([$validation['reason'] => true]);
                    }

                    $data = [
                        'team'      => $request->team,
                        'name'      => $request->name,
                        'number'    => $number,
                        'topic'     => $request->topic,
                        'message'   => $request->message,
                    ];

                    $model->information = json_encode($data);
                } elseif ( $type == 'vip_master' ) {
                    if ( $request->service_ids == null ) {
                        return redirect()->back()->with(['choose_a_service' => true]);
                    } else {
                        $validation = $this->validate_number($request->number);

                        if ( $validation['valid'] ) {
                            $number = $validation['number'];
                        } else {
                            return redirect()->back()->with([$validation['reason'] => true]);
                        }

                        $service_arr = [];

                        foreach ( $request->service_ids as $service ) {
                            $service_ids[] = $service;
                        }

                        $data = [
                            'name'      => $request->name,
                            'city'      => $request->city,
                            'region'    => $request->region,
                            'address'   => $request->address,
                            'number'    => $number,
                            'date'      => $request->date,
                            'services'  => $service_ids,
                            'total'     => $request->total_price,
                        ];

                        $model->information = json_encode($data);
                    }
                } elseif ( $type == 'cleaning' ) {
                    $validation = $this->validate_number($request->number);

                    if ( $validation['valid'] ) {
                        $number = $validation['number'];
                    } else {
                        return redirect()->back()->with([$validation['reason'] => true]);
                    }

                    $images = [];

                    if ( $request->images != null ) {
                        if ( count($request->images) <= 5 ) {
                            foreach ( $request->images as $index => $image) {
                                if ( $image->getSize() > 1100000 ) { 
                                    return redirect('/cleaning')->with(['pictures_too_large' => true]);
                                } else {
                                    $picture_name = 'cleaning-notification-image-'. time() .'-'. $index .'.'. $image->extension();
                                    $image->storeAs('images/notifications/', $picture_name, 'local');
                                    $images[] = 'images/notifications/'. $picture_name;
                                }
                            }
                        } else {
                            return redirect('/cleaning')->with(['too_many_pictures' => true]);
                        }
                    }

                    $price = (int)$request->square_price * (int)$request->area;

                    $data = [
                        'name'          => $request->name,
                        'city'          => $request->city,
                        'region'        => $request->region,
                        'address'       => $request->address,
                        'number'        => $number,
                        'date'          => $request->date,
                        'table'         => $request->table,
                        'images'        => $images,
                        'id'            => $request->id,
                        'price'         => $price,
                    ];

                    $model->information = json_encode($data);
                } elseif ( $type == 'materials' ) {
                    $validation = $this->validate_number($request->number);

                    if ( $validation['valid'] ) {
                        $number = $validation['number'];
                    } else {
                        return redirect()->back()->with([$validation['reason'] => true]);
                    }

                    $data = [
                        'weight'            => $request->weight,
                        'delivery_time'     => $request->delivery_time,
                        'delivery_price'    => $request->delivery_price,
                        'name'              => $request->name,
                        'address'           => $request->address,
                        'number'            => $number,
                    ];

                    $model->information = json_encode($data);
                }

                $model->save();

                Session::forget('cart');
                return redirect()->back()->with([$type .'_notification_confirmed' => true]);
            } else {
                return redirect()->back();
            }
        }

        public function vacancy(Request $request) {
            if ( Admins::where('login', $request->vacancy_login)->doesntExist() ) {
                if ( $request->vacancy_type == 'employee' ) {
                    foreach ( $request->vacancy_vocations as $id ) {
                        $vocations[] = $id;
                    }

                    $model = new Admins;
                    $model->name                    = $request->vacancy_name;
                    $model->login                   = $request->vacancy_login;
                    $model->password                = Hash::make($request->vacancy_password);
                    $model->category                = $request->vacancy_category;
                    $model->type                    = $request->vacancy_type;
                    $model->number                  = $request->vacancy_number;
                    $model->vocations               = json_encode($vocations);
                    $model->how_many                = $request->vacancy_how_many;
                    $model->save();
                }

                if ( $request->vacancy_type == 'legal_entity' ) {
                    $model = new Admins;
                    $model->name                    = $request->vacancy_company_name;
                    $model->identification_code     = $request->vacancy_identification_code;
                    $model->login                   = $request->vacancy_login;
                    $model->password                = Hash::make($request->vacancy_password);
                    $model->number                  = $request->vacancy_number;
                    $model->email                   = $request->vacancy_email;
                    $model->type                    = $request->vacancy_type;
                    $model->category                = $request->vacancy_category;
                    $model->field_of_activity       = $request->vacancy_field_of_activity;
                    $model->save();
                }
            } else {
                return redirect()->back()->with(['login_taken' => true]);
            }

            Notifications::where('id', $request->vacancy_id)->update(['status' => 'finished']);

            return redirect('/admin/notifications/vacancy/day');
        }

        public function finished(Request $request) {
            $finish = '';
            ($request->finished == 'successfuly') ? $finish = 'წარმატებულად' : $finish = 'წარუმატებლად';
            $this->create_log($request->id .' შეტყობინება დამთავრდა '. $finish);

            Notifications::where('id', $request->id)->update(['status' => 'finished']);
            Notifications::where('id', $request->id)->update(['finished' => $request->finished]);

            return redirect()->back()->with(['status_changed' => true]);
        }

        public function publication(Request $request) {
            Notifications::where('id', $request->id)->update(['publicity' => 'published']);

            return redirect()->back()->with(['status_changed' => true]);
        }

        public function send_message($page, Request $request) {
            if ( $page == 'staff'  ) {
                if ( $request->employee_ids != null ) {
                    $this->create_log('შეტყობინების გაგზავნა პერსონალთან');

                    $recipients = [];

                    foreach ( $request->employee_ids as $id ) {
                        $recipients[] = $id;
                    }

                    $recipients = array_unique($recipients);

                    $model              = new Messages;
                    $model->writer      = Session::get('admin.info.name');
                    $model->writer_id   = Session::get('admin.info.id');
                    $model->recipients  = json_encode($recipients);
                    $model->message     = $request->message;
                    $model->is_sent     = 'false';
                    $model->save();

                    return redirect('/admin/message/staff')->with(['message_sent' => true]);
                } else {
                    return redirect()->back()->with(['select_staff' => true]);
                }
            } elseif ( $page == 'shops' ) {
                $this->create_log('შეტყობინების გაგზავნა მაღაზიებთან');

                    $recipients = [];

                    foreach ( $request->shop_ids as $id ) {
                        $recipients[] = $id;
                    }

                    $recipients = array_unique($recipients);

                    $model              = new Messages;
                    $model->writer      = Session::get('admin.info.name');
                    $model->writer_id   = Session::get('admin.info.id');
                    $model->recipients  = json_encode($recipients);
                    $model->message     = $request->message;
                    $model->is_sent     = 'false';
                    $model->save();

                    return redirect('/admin/message/shops')->with(['message_sent' => true]);
            }
        }

        private function is_allowed_notifications($type) {
            if ( $this->is_admin() ) {
                return true;
            } elseif ( $this->is_manager() && $this->admin_category('design') ) {
                if ( in_array($type, ['call_request', 'vacancy', 'contact']) ) return true;
            } elseif ( $this->is_manager() && $this->admin_category('repairs') ) {
                if ( in_array($type, ['call_request', 'vacancy', 'contact', 'consultation', 'vip_master']) ) return true;
            } elseif ( $this->is_manager() && $this->admin_category('furniture') ) {
                if ( in_array($type, ['call_request', 'vacancy', 'contact']) ) return true;
            } elseif ( $this->is_manager() && $this->admin_category('furniture') ) {
                if ( in_array($type, ['call_request', 'vacancy', 'contact', 'cleaning']) ) return true;
            } else {
                return false;
            }
        }
    // * Methods

    // * Pages
        public function categories($timeframe = null) {
            if ( $this->is_manager() || $this->is_admin() ) {
                if ( $timeframe == null || !in_array($timeframe, ['day','month','year']) ) {
                    return redirect('/admin');
                } else {
                    $collapse = ['category' => 'notifications'];
                    if ( $this->is_admin() )                    $categories = ['call_request', 'vacancy', 'contact', 'consultation', 'materials', 'vip_master', 'cleaning'];
                    if ( $this->admin_category('design') )      $categories = ['call_request', 'vacancy', 'contact'];
                    if ( $this->admin_category('repairs') )     $categories = ['call_request', 'vacancy', 'contact', 'consultation', 'vip_master'];
                    if ( $this->admin_category('furniture') )   $categories = ['call_request', 'vacancy', 'contact'];
                    if ( $this->admin_category('cleaning') )    $categories = ['call_request', 'vacancy', 'contact', 'cleaning'];

                    if ( $this::is_admin() ) {
                        foreach ( $categories as $category ) {
                            $data['shalva_status'][$category]   =  $this->counter($category, $timeframe, 'shalva_status');
                            $data['unfinished'][$category]      =  $this->counter($category, $timeframe, 'unfinished');
                            $data['finished'][$category]        =  $this->counter($category, $timeframe, 'finished');
                            $data['unseen'][$category]          =  $this->counter($category, $timeframe, 'unseen');
                            $data['seen'][$category]            =  $this->counter($category, $timeframe, 'seen');
                            $data['total'][$category]           =  $this->counter($category, $timeframe, 'total');
                        }
                    } elseif ( $this->is_manager() ) {
                        foreach ( $categories as $category ) {
                            $data['unfinished'][$category]      = $this->counter($category, $timeframe, 'unfinished');
                            $data['finished'][$category]        = $this->counter($category, $timeframe, 'finished');
                            $data['unseen'][$category]          = $this->counter($category, $timeframe, 'unseen');
                            $data['seen'][$category]            = $this->counter($category, $timeframe, 'seen');
                            $data['total'][$category]           = $this->counter($category, $timeframe, 'total');
                        }
                    } elseif ( $this->is_employee() ) {
                        $data['unfinished']['call_request']     = $this->counter('call_request', $timeframe, 'unfinished');
                        $data['finished']['call_request']       = $this->counter('call_request', $timeframe, 'finished');
                        $data['unseen']['call_request']         = $this->counter('call_request', $timeframe, 'unseen');
                        $data['seen']['call_request']           = $this->counter('call_request', $timeframe, 'seen');
                        $data['total']['call_request']          = $this->counter('call_request', $timeframe, 'total');
                    }
                }

                $data['timeframe'] = $timeframe;

                return view('admin.pages.notifications.categories', compact('collapse', 'data'));
            } else {
                return redirect('/admin');
            }
        }

        public function notifications($type = null, $timeframe = null) {
            if ( $this->is_allowed_notifications($type) ) {
                if ( $type == null || $timeframe == null || !in_array($timeframe, ['day','month','year']) ) {
                    return redirect('/admin');
                } else {
                    $collapse = ['category' => 'notifications'];

                    $data = [
                        'type'          => $type,
                        'timeframe'     => $timeframe,
                        'notifications' => Notifications::where([['type', $type], ['current_timeframe', $timeframe]])->orderBy('id', 'desc')->orderBy('status', 'desc')->get()->toArray()
                    ];

                    return view('admin.pages.notifications.notifications', compact('collapse', 'data'));
                }
            } else {
                return redirect('/admin');
            }
        }

        public function notification($type = null, $timeframe = null, $id = null) {
            if ( $this->is_allowed_notifications($type) ) {
                if ( $type == null || $timeframe == null || !in_array($timeframe, ['day','month','year']) || $id == null) {
                    return redirect('/admin');
                } else {
                    if ( $this->is_constant() && Notifications::where('id', $id)->get()->toArray()[0]['shalva_status'] == 'unseen' ) {
                        Notifications::where('id', $id)->update(['shalva_status' => 'seen']);
                    }

                    if ( Notifications::where('id', $id)->get()->toArray()[0]['status'] == 'unseen' ) {
                        Notifications::where('id', $id)->update(['status' => 'seen']);
                    }

                    $collapse = ['category' => 'notifications'];

                    $data = [
                        'id'            => $id,
                        'type'          => $type,
                        'timeframe'     => $timeframe,
                        'notification'  => Notifications::where('id', $id)->get()->toArray()
                    ];

                    $data['notification'] = $data['notification'][0];

                    return view('admin.pages.notifications.notification', compact('collapse', 'data'));
                }
            } else {
                return redirect('/admin');
            }
        }
    // * Pages
}