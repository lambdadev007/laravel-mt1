<?php

namespace App\Http\Controllers;

use App\Models\Admins;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AdminUsers extends AdminCore
{
    public function login(Request $request) {
        $login_object = Admins::where('login', $request->login)->get()->toArray();

        if ( $login_object != [] ) {
            $login_object = $login_object[0];

            if ( Hash::check($request->password, $login_object['password']) ) {
                if ( $login_object['soft_delete'] != 'true' ) {
                    $is_manager = false;

                    if ( strpos($login_object['category'], 'manager') === 0 ) {
                        $is_manager = true;

                        $category = substr($login_object['category'], 8, strlen($login_object['category']));
                        
                        if ($category == 'design' ) {
                            $admin['can_edit'] = [
                                'pages'          => true,
                                'design'         => true,
                            ];
                        } elseif ($category == 'repairs' ) {
                            $admin['can_edit'] = [
                                'pages'          => true,
                                'consultation'   => true,
                                'repairs'        => true,
                                'vip_master'     => true,
                            ];
                        } elseif ($category == 'furniture' ) {
                            $admin['can_edit'] = [
                                'pages'          => true,
                                'furniture'      => true,
                            ];
                        } elseif ($category == 'cleaning' ) {
                            $admin['can_edit'] = [
                                'pages'          => true,
                                'cleaning'       => true,
                            ];
                        } 

                        if ( in_array($category, ['design', 'repairs', 'furniture']) ) {
                            $admin['can_write'] = [
                                'content'       => true,
                                'articles'      => true,
                                'offers'        => true,
                                'projects'      => true,
                            ];
                        } elseif ( $category == 'cleaning' ) {
                            $admin['can_write'] = [
                                'content'       => true,
                                'articles'      => true,
                                'offers'        => true,
                            ];
                        }
                    }

                    if ( $login_object['category'] == 'articles' ) {
                        $admin['can_edit']  = [];
                        $admin['can_write'] = [
                            'content'       => true,
                            'articles'      => true,
                        ];
                    }

                    $admin['info'] = [
                        'logged'            => true,
                        'has_notifications' => true,
                        'name'              => $login_object['name'],
                        'category'          => $login_object['category'],
                        'type'              => $login_object['type'],
                        'id'                => $login_object['id'],
                    ];

                    if ( $login_object['category'] == 'articles' ) {
                        unset($admin['info']['has_notifications']);
                    }

                    if ( $is_manager == true ) {
                        $admin['info']['is_manager']    = true;
                        $admin['info']['category']      = $category;
                    }

                    Cookie::queue('admin_cookie', json_encode($admin), 43200);

                    return redirect('/admin');
                } else {
                    return redirect('/admin')->with([ 'user_deleted' => true ]);
                }
            } else {
                return redirect('/admin')->with([ 'login_error' => true ]);
            }
        } else {
            return redirect('/admin')->with([ 'login_error' => true ]);
        }
    }

    public function logout() {
        if ( \Request::method('post') ) {
            Cookie::queue(Cookie::forget('admin_cookie'));
            Session::forget('admin');
            return redirect('/admin')->with([ 'logout_successful' => true ]);
        } else {
            return redirect('/admin');
        }
    }
}