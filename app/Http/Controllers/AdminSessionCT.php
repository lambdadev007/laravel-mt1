<?php

namespace App\Http\Controllers;

use App\Models\Admins;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Lotuashvili\LaravelSmsOffice\SmsOffice;
use App\Mail\InvoiceMail;
use App\Models\InvoiceMailBuffer;
class AdminSessionCT extends AdminCore
{
    public function login(Request $request,SmsOffice $smsoffice) {

        session_start();
        if($request->has('otp')){
            $admin=$_SESSION['admin'];
            
            //start without entering otp:
            // Cookie::queue('admin_cookie', json_encode($admin), 43200);
            // return redirect('/enter');  
            //end without entering otp:

            if($request->input('otp')==$_SESSION['otp']){
                $admin=$_SESSION['admin'];
                Cookie::queue('admin_cookie', json_encode($admin), 43200);
                
                unset($_SESSION['otp']);
                return redirect('/enter');  
            }else{
                $verifyOtp=true;
                $otp_error='Invaild OTP Code';
                return view('admin.pages.login',compact('verifyOtp','otp_error'));
            }
            
        }
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

                    if ( $login_object['category'] == 'blogger' ) {
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
                        'is_super'          => $login_object['is_super'],
                    ];

                    if ( $login_object['category'] == 'articles' ) {
                        unset($admin['info']['has_notifications']);
                    }

                    if ( $is_manager == true ) {
                        $admin['info']['is_manager']    = true;
                        $admin['info']['category']      = $category;
                    }
                    $_SESSION['admin']=$admin;
                    $otp=rand(100000, 999999);
                    $_SESSION['otp']=$otp;
                    $message=" თქვენ მოითხოვეთ სისტემაში შესვლა, ერთჯერადი კოდია: ".$otp;
                    $nmbr=$login_object['number'];
                    // $smsoffice->send('597056520', $message);
                    //    $smsoffice->send('568557526', $message);
                    if(!empty($nmbr)){
                        $smsoffice->send($nmbr, $message);
                    }
                    $verifyOtp=$otp;
                    return view('admin.pages.login',compact('verifyOtp'));
                } else {
                    return redirect('/enter')->with(['user_deleted' => true]);
                }
            } else {
                return redirect('/enter')->with(['login_error' => true]);
            }
        } else {
            return redirect('/enter')->with(['login_error' => true]);
        }
    }

    public function logout() {
        if ( \Request::method('post') ) {
            Cookie::queue(Cookie::forget('admin_cookie'));
            return redirect('/enter')->with(['logout_successful' => true]);
        } else {
            return redirect('/enter');
        }
    }
}