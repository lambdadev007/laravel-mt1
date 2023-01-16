<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Offers;
use App\Models\Projects;
use App\Models\Articles\Articles;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class HelpersCT extends Controller
{
    public function __construct() {
        if ( Session::get('locale') == null ) {
            session(['locale' => 'ka']);
        }

        // * User Session
            if ( Cookie::has('remember_token') ) {
                if ( !Session::has('user.logged') ){
                    $data = json_decode(Crypt::decrypt(Cookie::get('remember_token'), false), true);

                    foreach ( $data as $i => $v ) {
                        session([$i => $v]);
                    }
                }
            }
        // * User Session
    }

    protected function remove_time($array) {
        foreach ( $array as $index => $item ) {
            $array[$index]['created_at'] = substr($item['created_at'], 0, strpos($item['created_at'], ' '));
        }

        return $array;
    }

    public static function DB_to_arr($obj) {
        return json_decode(json_encode($obj),true);
    }

    public function create_log($action) {
        $model                  = new Logs;
        $model->initiator_id    = Session::get('admin.info.id');
        $model->action          = $action;
        $model->save();
    }

    public function validate_number($number) {
        $number = (int)$number;

        if ( strlen($number) == 13 ) {
            if ( substr($number, 0, 4) != '+995' ) {
                $data = [
                    'valid' => false,
                    'reason' => 'invalid_region'
                ];
                return $data;
            } else {
                $data = [
                    'valid' => true,
                    'number' => $number
                ];
                return $data;
            }
        } elseif ( strlen($number) == 12 ) {
            if ( substr($number, 0, 3) != '995' ) {
                $data = [
                    'valid' => false,
                    'reason' => 'invalid_region'
                ];
                return $data;
            } else {
                $data = [
                    'valid' => true,
                    'number' => substr_replace($number, '+'. $number, 0)
                ];
                return $data;
            }
        } elseif ( strlen($number) == 9 ) {
            $data = [
                'valid' => true,
                'number' => substr_replace($number, '+995'. $number, 0)
            ];
            return $data;
        } else {
            $data = [
                'valid' => false,
                'reason' => 'invalid_number'
            ];
            return $data;
        }
    }

    public static function admin_category($category) {
        return Session::get('admin.info.category') == $category;
    }

    public static function is_constant() {
        return Session::get('admin.info.id') == 1;
    }

    public static function is_admin() {
        return Session::get('admin.info.category') == 'admin';
    }

    public static function is_manager() {
        return Session::get('admin.info.is_manager');
    }

    public static function is_employee() {
        return Session::get('admin.info.type') == 'employee';
    }
}
