<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Offers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class UsersCT extends HelpersCT
{
    //* Pages
        public function user_profile() {
            if ( !Session::has('user.logged') )  {
                return redirect('/');
            } else {
                $data = [
                    'user' => Users::where('number', Session::get('user.number'))->get()->toArray()[0]
                ];
                $offers = Offers::where('soft_delete', '!=' , 'true')->latest()->take(3)->get()->toArray();

                return view('user.users.user-profile', compact('data', 'offers'));
            }
        }

        public function history() {
            if ( !Session::has('user.logged') )  {
                return redirect('/');
            } else {
                $offers = Offers::where('soft_delete', '!=' , 'true')->latest()->take(3)->get()->toArray();

                return view('user.users.user-history', compact('offers'));
            }
        }

        public function change_password() {
            if ( !Session::has('user.logged') )  {
                return redirect('/');
            } else {
                $offers = Offers::where('soft_delete', '!=' , 'true')->latest()->take(3)->get()->toArray();

                return view('user.users.user-change-password', compact('offers'));
            }
        }

        public function wishlist() {
            if ( !Session::has('user.logged') )  {
                return redirect('/');
            } else {
                $offers = Offers::where('soft_delete', '!=' , 'true')->latest()->take(3)->get()->toArray();

                return view('user.users.user-wishlist', compact('offers'));
            }
        }
    //* Pages

    //* Core Methods
        public function register(Request $request) {
            if ( $request->isMethod('post') ) {
                if ( Users::where('number', $request->number)->doesntExist() ) {
                    if ( $request->password === $request->password_check ) {
                        if ( $this->validate_number($request->number)['valid'] ) {
                            if ( Session::has('temp_reg.confirmation') ) {
                                session([
                                    'temp_reg.confirmation'     => mt_rand(10000, 99999),
                                ]);
                            } else {
                                session([
                                    'temp_reg.confirmation'     => mt_rand(10000, 99999),
                                    'temp_reg.f_name'           => $request->f_name,
                                    'temp_reg.l_name'           => $request->l_name,
                                    'temp_reg.number'           => $this->validate_number($request->number)['number'],
                                    'temp_reg.password'         => Hash::make($request->password),
                                    'temp_reg.city'             => $request->city,
                                    'temp_reg.region'           => $request->region,
                                    'temp_reg.address'          => $request->address,
                                ]);
                            }

                            return redirect('/register/confirm');
                        } else {
                            return redirect()->back()->with(['invalid_number' => true]);
                        }
                    } else {
                        return redirect('/register')->with(['password_mismatch' => true]);
                    }
                } else {
                    return redirect('/register')->with(['number_taken' => true]);
                }
            } else {
                $offers = Offers::where('soft_delete', '!=' , 'true')->latest()->take(3)->get()->toArray();
                return view('user.users.register', compact('offers'));
            }
        }

        public function register_confirm(Request $request) {
            if ( $request->isMethod('post') ) {
                if ( $request->confirmation == Session::get('temp_reg.confirmation') ) {
                    $model = new Users;

                    $model->f_name        = Session::get('temp_reg.f_name');
                    $model->l_name        = Session::get('temp_reg.l_name');
                    $model->number        = Session::get('temp_reg.number');
                    $model->password      = Session::get('temp_reg.password');
                    $model->city          = Session::get('temp_reg.city');
                    $model->region        = Session::get('temp_reg.region');
                    $model->address       = Session::get('temp_reg.address');

                    $model->save();

                    Session::forget('temp_reg');

                    return redirect('/login')->with(['registration_successful' => true]);
                } else {
                    return redirect('/register/confirm')->with(['incorrect_code' => true]);
                }
    
            } else {
                $offers = Offers::where('soft_delete', '!=' , 'true')->latest()->take(3)->get()->toArray();
                return view('user.users.register-confirm', compact('offers'));
            }
        }

        public function login(Request $request) {
            if ( $request->isMethod('post') ) {
                $login_object = [];
                if ( $this->validate_number($request->number)['valid'] ) {
                    $login_object = Users::where('number', $this->validate_number($request->number)['number'])->get()->toArray();
                }

                if ( $login_object != [] ) {
                    $login_object = $login_object[0];

                    if ( Hash::check($request->password, $login_object['password']) ) {
                        $data = [
                            'user.logged'           => true,
                            'user.f_name'           => $login_object['f_name'],
                            'user.l_name'           => $login_object['l_name'],
                            'user.number'           => $login_object['number'],
                        ];

                        if ( $request->remember_token != null ) {
                            Cookie::queue('remember_token', json_encode($data), 2628000);
                        } else {
                            session($data);
                        }

                        return redirect('/');
                    } else {
                        return redirect('/login')->with([ 'login_error' => true ]);
                    }
                } else {
                    return redirect('/login')->with([ 'login_error' => true ]);
                }
            } else {
                $offers = Offers::where('soft_delete', '!=' , 'true')->latest()->take(3)->get()->toArray();
                return view('user.users.login', compact('offers'));
            }
        }

        public function password_recovery(Request $request) {
            if ( $request->isMethod('post') ) {
                return redirect('/login');
            } else {
                $offers = Offers::where('soft_delete', '!=' , 'true')->latest()->take(3)->get()->toArray();
                return view('user.users.password-recovery', compact('offers'));
            }
        }

        public function logout() {
            Session::forget('user');
            if ( Cookie::has('remember_token') ) {
                Cookie::queue(Cookie::forget('remember_token'));
            }

            return redirect()->back();
        }

        public function update_user_profile(Request $request) {
            if ( Session::has('user.logged') ) {
                if ( $this->validate_number($request->number)['valid'] ) {
                    Users::where('number', Session::get('user.number'))->update([
                        'f_name'        => $request->f_name,
                        'l_name'        => $request->l_name,
                        'number'        => $this->validate_number($request->number)['number'],
                        'city'          => $request->city,
                        'region'        => $request->region,
                        'address'       => $request->address,
                    ]);

                    $data = [
                        'user.logged'    => true,
                        'user.f_name'    => $request->f_name,
                        'user.l_name'    => $request->l_name,
                        'user.number'    => $this->validate_number($request->number)['number'],
                    ];

                    session($data);

                    if ( Cookie::has('remember_token') ) {
                        Cookie::queue('remember_token', json_encode($data), 2628000);
                    }

                    return redirect('/user/profile');
                } else {
                    return redirect('/user/profile')->with(['invalid_number']);
                }
            } else {
                return redirect('/');
            }
        }

        public function update_user_password(Request $request) {
            if ( Session::has('user.logged') ) {
                if ( Hash::check($request->old_password, Users::where('number', Session::get('user.number'))->get()[0]->password) ) {
                    if ( $request->password !== $request->password_check ) {
                        return redirect('/user/change-password')->with(['password_mismatch' => true]);
                    } else {
                        Users::where('number', Session::get('user.number'))->update(['password' => Hash::make($request->password)]);
                        return redirect('/user/change-password')->with(['password_changed' => true]);
                    }
                } else {
                    return redirect('/user/change-password')->with(['old_password_incorrect' => true]);
                }
            } else {
                return redirect('/');
            }
        }
    //* Core Methods
}
