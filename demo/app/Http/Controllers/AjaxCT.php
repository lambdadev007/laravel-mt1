<?php

namespace App\Http\Controllers;

use App\Http\Controllers\TranslationCT;

use App\Models\Admins;
use App\Models\Shops;

use App\Models\{Offers, Projects};
use App\Models\Articles\{Articles, ArticleSections};

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class AjaxCT extends HelpersCT
{
    public function ajax_get_category(Request $request) {
        if ( $request->ajax() ) {
            session(['user.categories.'. $request->page => $request->category]);

            return;
        } else {
            return;
        }
    }

    public function ajax_search(Request $request) {
        if ( $request->ajax() ) {
            $TC = new TranslationCT;
            $local = [
                'ka' => [
                    'article' => 'სტატიები'
                ],
                'en' => [
                    'article' => 'Articles'
                ],
            ];

            $data = [];

            if ( Articles::where('title', 'like', '%'. $request->keyword_ .'%')->exists() ) {
                foreach ( Articles::where('title', 'like', '%'. $request->keyword_ .'%')->get()->toArray() as $item ) {
                    $data[] = [
                        'link'      => '/article/'. $item['category'] .'/'. $item['slug'],
                        'title'     =>  $TC->T($local, 'article') .' - '. $item['title'],
                    ];
                }
            }

            if ( Offers::where('title', 'like', '%'. $request->keyword_ .'%')->exists() ) {
                foreach ( Offers::where('title', 'like', '%'. $request->keyword_ .'%')->get()->toArray() as $item ) {
                    $data[] = [
                        'link'      => '/offer/'. $item['category'] .'/'. $item['slug'],
                        'title'     => $TC->TG('offers') .' - '. $item['title'],
                    ];
                }
            }

            if ( Projects::where('title', 'like', '%'. $request->keyword_ .'%')->exists() ) {
                foreach ( Projects::where('title', 'like', '%'. $request->keyword_ .'%')->get()->toArray() as $item ) {
                    $data[] = [
                        'link'      => '/project/'. $item['category'] .'/'. $item['slug'],
                        'title'     => $TC->TG('projects') .' - '. $item['title'],
                    ];
                }
            }

            return $data;
        } else {
            return;
        }
    }

    public function ajax_cookies_agreement(Request $request) {
        if ( $request->ajax() ) {
            if ( $request->cookies_agreement == 'true' ) {
                Cookie::queue('cookies_agreement', 'true', 525600);
                return response('success');
            } else {
                return;
            }
        }
    }

    // public function ajax_admin_navbar(Request $request) {
    //     if ( $request->ajax() ) {
    //         if ( request('checked') == 'true' ) {
    //             session(['navbar.checked' => true]);
    //             return;
    //         } else {
    //             Session::forget('navbar.checked');
    //             return;
    //         }
    //     }
    // }

    public function ajax_add_cart(Request $request) {
        if ( $request->ajax() ) {
            session(['cart.' . $request->category . '.services.' . $request->id => [
                    'id'            => $request->id,
                    'price'         => $request->price,
                    'visible_name'  => $request->visible_name,
                ],
                'cart.' . $request->category . '.total_price' => $request->total_price,
            ]);

            if ( (int)$request->total_price < 0 ) {
                Session::forget('cart');
            }
            return;
        } else {
            return;
        }
    }

    public function ajax_remove_cart(Request $request) {
        if ( $request->ajax() ) {
            Session::forget('cart.' . $request->category . '.services.' . $request->id);
            Session::forget('cart.' . $request->category . '.total_price');
            session(['cart.' . $request->category . '.total_price' => $request->total_price]);
            return;
        } else {
            return;
        }
    }

    public function ajax_validate_number(Request $request) {
        if ( $request->ajax() ) {
            if ( $this->validate_number($request->number)['valid'] ) {
                Session::put('validation_code', mt_rand(10000, 99999));
                return 'Success '. Session::get('validate_code');
            } else {
                return 'Failure';
            }
        } else {
            return;
        }
    }
}
