<?php

namespace App\Http\Controllers;

use App\Models\{Logs, Blog, Terms,sliderForm};

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;



use App\Models\Products\{ProductCategories, Products};

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

    // * Unused
        // protected function remove_time($array) {
        //     foreach ( $array as $index => $item ) {
        //         $array[$index]['created_at'] = substr($item['created_at'], 0, strpos($item['created_at'], ' '));
        //     }

        //     return $array;
        // }

        // public static function DB_to_arr($obj) {
        //     return json_decode(json_encode($obj),true);
        // }

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
    // * Unused

    public function create_log($action) {
        $model                  = new Logs;
        $model->initiator_id    = HelpersCT::decode_cookie('admin_cookie')['info']['id'];
        $model->action          = $action;
        $model->save();
    }

    public static function phantom_var($variable, $arg, $value) {
        if ( isset($variable) ) {
            if ( array_key_exists($arg, $variable) ) {
                if ( $variable[$arg] == $value ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // * Admin Session Cookie Queries
        public static function decode_cookie($cookie) {
            return json_decode(Cookie::get($cookie), true);
        }

        public static function admin_category($category) {
            return HelpersCT::decode_cookie('admin_cookie')['info']['category'] == $category;
        }

        public static function is_constant() {
            return HelpersCT::decode_cookie('admin_cookie')['info']['id'] == 1;
        }

        public static function is_admin() {
            return HelpersCT::decode_cookie('admin_cookie')['info']['category'] == 'admin';
        }

        public static function is_manager() {
            if ( array_key_exists('is_manager', HelpersCT::decode_cookie('admin_cookie')['info']) ) {
                return true;
            } else {
                return false;
            }
        }

        public static function is_employee() {
            return HelpersCT::decode_cookie('admin_cookie')['info']['type'] == 'employee';
        }
    // * Admin Session Cookie Queries

    // * General Functions
        protected function decode_data($raw_data, $keyword_array) {
            $data['raw'] = $raw_data;
            foreach ( $keyword_array as $keyword ) {
                $data[$keyword] = json_decode($raw_data[$keyword], true);
            }
            return $data;
        }

        protected function getProductCategories() {
            if ( ProductCategories::where('id', 1)->exists() ) {
                $product_categories = $this->decode_data(ProductCategories::find(1)->toArray(), ['main', 'groups', 'sub_groups']);
                $product_categories['exists'] = true;
            } else {
                $product_categories['exists'] = false;
            }
                return $product_categories;
        }

        protected function getProductsCookie() {
            $products_cookie = [];
            $search_keys = [];

            if ( Cookie::has('products_cookie_000') ) {
                $search_keys = array_keys(json_decode(Cookie::get('products_cookie_000'), true));
                $products_cookie = Products::whereIn('id', $search_keys)->get()->toArray();
            }

            return $products_cookie;
        }

        protected function getTerms() {
            $terms = [];
            if ( Terms::where('id', 1)->exists() ) {
                $terms['content'] = terms::find(1)->toArray()['content'];
                $terms['exists'] = true;
            } else {
                $terms['exists'] = false;
            }
            return $terms;
        }

        protected function destroyFilters() {
            Session::forget('market');
        }
    // * General Functions

    
}
