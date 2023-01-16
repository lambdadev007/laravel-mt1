<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* 
*--------------------------------------------------------------------------
* Metrix
*--------------------------------------------------------------------------
*/
    // Route::get('/sitemap', function() {
    //     SitemapGenerator::create('https://www.metrix.ge/')->writeToFile('sitemap.xml');
    //     return 'Sitemap Generated';
    // });
    // Route::get('/set-config', function() {
    //     \Artisan::call('config:cache');
    //     return '<h1>Config Set</h1>';
    // });
    // * Pages
        Route::get('/', 'PagesCT@homepage');
        Route::get('/about', 'PagesCT@about');
        Route::get('/vip-master', 'PagesCT@vip');
        Route::get('/vip-master/{action}', 'PagesCT@vip');
        Route::get('/vip-services/{slug}', 'PagesCT@vip_services');

        Route::get('/vacancies', 'PagesCT@vacancies');
        Route::post('/send-vacancy', 'PagesCT@sent_vacancy');

        Route::get('/repairs', 'PagesCT@repairs');
        Route::get('/repair/{id}', 'PagesCT@repair');
        Route::post('/repair-invoice', 'PagesCT@repair_invoice');
        Route::get('/designer', 'PagesCT@designer');
        Route::get('/furniture', 'PagesCT@furniture');
        Route::get('/contact', 'PagesCT@contact');

        Route::get('/search', 'PagesCT@search');
        // * Market
            Route::get('/market', 'PagesCT@market');
            Route::get('/market/product/{slug}', 'PagesCT@market_product');
        // * Market
        // * Blog
            Route::get('/blog', 'PagesCT@blog');
            Route::get('/blog/{slug}', 'PagesCT@article');
            Route::get('/article/repairs/rogor-shevarchiot-saremonto-kompania', function() {
                return redirect('/blog/rogor-shevarchiot-saremonto-kompania', 301); 
            });
        // * Blog
        // * Projects
            Route::get('/projects', 'PagesCT@projects');
            Route::get('/projects/single/{id}', 'PagesCT@projects_singles');
        // * Projects
            Route::get('/projects/single', 'PagesCT@projects_single');
        // * for testing route Projects
            Route::get('/projects/design', 'PagesCT@projects_design');
        // * User
            Route::get('/profile', 'PagesCT@profile');
            Route::get('/cart', 'PagesCT@cart');
            Route::get('/purchase-history', 'PagesCT@purchase_history');

            Route::post('/user/register', 'PagesCT@user_register');
            Route::post('/user/login', 'PagesCT@user_login');
            Route::post('/user/logout', 'PagesCT@user_logout');
            Route::post('/user/update', 'PagesCT@user_update');

            Route::post('/sliderform', 'PagesCT@slider_invoice');
        // * User
    // * Pages

    Route::post('/order/{action}', 'PagesCT@order');
    Route::post('/locale', 'PagesCT@change_locale');
    Route::post('/sendsms/{type}', 'PagesCT@sendsms');

    // * Ajax
        Route::post('/market-sorting-ajax', 'PagesCT@market_sorting_ajax');
        Route::post('/market-product-cookie', 'PagesCT@market_product_cookie');
        Route::post('/market-find-product', 'PagesCT@market_find_product');
        Route::post('/market-favorites', 'PagesCT@market_favorites');
        Route::post('/market-style', 'PagesCT@market_style');
        Route::post('/grab-user', 'PagesCT@grab_user');
    // * Ajax
/* 
*--------------------------------------------------------------------------
* Metrix
*--------------------------------------------------------------------------
*/

/* 
*--------------------------------------------------------------------------
* Admin Panel
*--------------------------------------------------------------------------
*/
    Route::get('/admin/login', 'AdminPagesCT@login');
    Route::post('/admin/login', 'AdminSessionCT@login');
    Route::post('/admin/logout', 'AdminSessionCT@logout');

    Route::get('/admin', 'AdminPagesCT@landing');
    // * Pages
        Route::get('/admin/homepage', 'AdminPagesCT@homepage');
        Route::get('/admin/contact', 'AdminPagesCT@contact');
        Route::get('/admin/partners', 'AdminPagesCT@partners');
        Route::get('/admin/about', 'AdminPagesCT@about');
        Route::get('/admin/terms', 'AdminPagesCT@terms');
        Route::get('/admin/vacancies/{action}', 'AdminPagesCT@vacancies');
        Route::get('/admin/vacancies-register', 'AdminPagesCT@vacancies_register');
        Route::get('/admin/company-hotline', 'AdminPagesCT@company_hotline');
        
        Route::get('/admin/slider-form/{action}/{id}', 'AdminPagesCT@sliderForm');
        Route::get('/admin/slider-form/{action}', 'AdminPagesCT@sliderForm');

        Route::get('/admin/reciever-form/{action}/{id}', 'AdminPagesCT@reciever');
        Route::get('/admin/reciever-form/{action}', 'AdminPagesCT@reciever');
        
        

        // * Services
            Route::get('/admin/vip-master', 'AdminPagesCT@vip');
            Route::get('/admin/vip-services/select', 'AdminPagesCT@vip');
            Route::get('/admin/vip-services/{action}/{belongs}/{locale}/{id}', 'AdminPagesCT@vip_services');
            Route::get('/admin/designer', 'AdminPagesCT@designer');
            Route::get('/admin/repairs', 'AdminPagesCT@repairs');
            Route::get('/admin/furniture', 'AdminPagesCT@furniture');
        // * Services
        // * Admins
            Route::get('/admin/administration/{action}', 'AdminPagesCT@administration');
            Route::get('/admin/administration/{action}/{id}', 'AdminPagesCT@administration');

        // * Admins
        // * Staff Projects
        Route::get('/admin/staff_projects/{action}', 'AdminPagesCT@staff_projects');
        Route::get('/admin/staff_projects/{action}/{id}', 'AdminPagesCT@staff_projects');

        // * Admins
        // * Pdf
        Route::get('/admin/pdf-form/{action}', 'AdminPagesCT@pdf_form');
        Route::get('/admin/pdf-form/{action}/{id}', 'AdminPagesCT@pdf_form');

        
        // * Admins
        // * Blog
            Route::get('/admin/blog/{action}', 'AdminPagesCT@blog');
            Route::get('/admin/blog/{action}/{id}', 'AdminPagesCT@blog');
        // * Blog
        // * Projects
        Route::get('/admin/projects', 'AdminPagesCT@projects');
            Route::get('/admin/projects/{action}', 'AdminPagesCT@projects');
            Route::get('/admin/projects/{action}/{id}', 'AdminPagesCT@projects');
        // * Projects
        // * Market
            Route::get('/admin/product-categories', 'AdminPagesCT@product_categories');
            Route::get('/admin/product/{action}', 'AdminPagesCT@market_product');
            Route::get('/admin/product/{action}/{id}', 'AdminPagesCT@market_product');
        // * Market
        // * Orders
            Route::get('/admin/order-info', 'AdminPagesCT@order_info');
            Route::get('/admin/orders/{action}', 'AdminPagesCT@orders');
        // * Orders
    // * Pages

    // * Core Methods
        Route::post('/admin/{table}/store', 'AdminCore@store');
        Route::post('/admin/{table}/update/{id}', 'AdminCore@update');
        Route::post('/admin/{table}/delete/{method}', 'AdminCore@delete');
        Route::post('/admin/{table}/restore', 'AdminCore@restore');

        // Route::post('/admin/slider-form/{action}', 'HelpersCT@slider');
    // * Core Methods
/* 
*--------------------------------------------------------------------------
* Admin Panel
*--------------------------------------------------------------------------
*/