<?php

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

Route::get('/locale/{locale}', 'PagesCT@locale');

Route::get('/', 'PagesCT@homepage');

/* 
*--------------------------------------------------------------------------
* Metrix
*--------------------------------------------------------------------------
*/

    // * About
        Route::get('/about-us', 'PagesCT@about_us');
    // * About

    // * Contact
        Route::get('/contact', 'PagesCT@contact');
        Route::post('/contact/send', 'PagesCT@contact_send');
    // * Contact

    // * User Section
        Route::get('/user/profile', 'UsersCT@user_profile');
        Route::get('/user/cart', 'UsersCT@cart');
        Route::get('/user/history', 'UsersCT@history');
        Route::get('/user/change-password', 'UsersCT@change_password');
        Route::get('/user/wishlist', 'UsersCT@wishlist');
        Route::get('/login', 'UsersCT@login');
        Route::get('/register', 'UsersCT@register');
        Route::get('/register/confirm', 'UsersCT@register_confirm');
        Route::get('/password-recovery', 'UsersCT@password_recovery');
        Route::get('/logout', 'UsersCT@logout');
        Route::post('/login', 'UsersCT@login');
        Route::post('/register', 'UsersCT@register');
        Route::post('/register/confirm', 'UsersCT@register_confirm');
        Route::post('/password-recovery', 'UsersCT@password_recovery');
        Route::post('/user/update-profile', 'UsersCT@update_user_profile');
        Route::post('/user/update-password', 'UsersCT@update_user_password');
    // * User Section

    Route::get('/payment', 'PagesCT@payment');
    Route::get('/delivery', 'PagesCT@delivery');
    Route::get('/supplier', 'PagesCT@supplier');

    // * Services
        Route::get('/vacancies', 'PagesCT@vacancies');
        Route::get('/consultation', 'PagesCT@consultation');
        Route::get('/design', 'PagesCT@design');
        Route::get('/repairs', 'PagesCT@repairs');
        Route::get('/furniture', 'PagesCT@furniture');
        Route::get('/furniture/materials', 'PagesCT@furniture_materials');
        Route::get('/furniture/gallery/{category}', 'PagesCT@furniture_gallery');
        Route::get('/vip-master', 'PagesCT@vip_master');
        Route::get('/cleaning', 'PagesCT@cleaning');
    // * Services

    // * Articles
        Route::get('/articles', 'PagesCT@articles');
        Route::get('/article/{slug}', 'PagesCT@article');
        Route::get('/article/{category}/{slug}', 'PagesCT@redirect_articles');
    // * Articles

    // * Offers
        Route::get('/offers', 'PagesCT@offers');
        Route::get('/offer/{slug}', 'PagesCT@offer');
        Route::get('/offer/{category}/{slug}', 'PagesCT@redirect_offers');
    // * Offers

    // * Projects
        Route::get('/projects', 'PagesCT@projects');
        Route::get('/project/{slug}', 'PagesCT@project');
        Route::get('/project/{category}/{slug}', 'PagesCT@redirect_projects');
    // * Projects
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
    Route::get('/admin', 'AdminCore@panel');
    
    Route::post('/admin/login', 'AdminUsers@login');
    Route::post('/admin/logout', 'AdminUsers@logout');

    Route::get('/admin/logs', 'AdminPages@logs');

    // * Notifications
        Route::get('/admin/notification-categories/{timeframe}', 'AdminNotifications@categories');
        Route::get('/admin/notifications/{type}/{timeframe}', 'AdminNotifications@notifications');
        Route::get('/admin/notification/{type}/{timeframe}/{id}', 'AdminNotifications@notification');
        Route::post('/notification', 'AdminNotifications@generator');
        Route::post('/admin/notification/finished', 'AdminNotifications@finished');
    // * Notifications

    // * Pages
        Route::get('/admin/pages/homepage', 'AdminPages@homepage');
        Route::get('/admin/pages/partners', 'AdminPages@partners');
        // * Vacancies
            Route::get('/admin/pages/vacancies', 'AdminPages@vacancies');
            Route::get('/admin/pages/vacancies-banners', 'AdminPages@vacancies_banners');
            Route::get('/admin/pages/vacancies-selects', 'AdminPages@vacancies_selects');
            Route::post('/admin/finalise-vacancy', 'AdminNotifications@vacancy');
        // * Vacancies
        Route::get('/admin/pages/about-us', 'AdminPages@about_us');
        Route::get('/admin/pages/consultation', 'AdminPages@consultation');
        Route::get('/admin/pages/contact', 'AdminPages@contact');
        Route::get('/admin/pages/design', 'AdminPages@design');
        Route::get('/admin/pages/repairs', 'AdminPages@repairs');
        Route::get('/admin/pages/furniture', 'AdminPages@furniture');
        Route::get('/admin/pages/furniture-materials', 'AdminPages@furniture_materials');
        Route::get('/admin/pages/furniture-gallery', 'AdminPages@furniture_gallery');
        Route::get('/admin/pages/furniture-gallery/{category}', 'AdminPages@furniture_gallery');
        Route::get('/admin/pages/vip-master', 'AdminPages@vip_master');
        Route::get('/admin/pages/cleaning-top', 'AdminPages@cleaning_top');
        Route::get('/admin/pages/cleaning-bottom', 'AdminPages@cleaning_bottom');

        // * Articles/Offers/Projects
            Route::get('/admin/article', 'AdminPages@article');
            Route::get('/admin/article/{category}', 'AdminPages@article');
            Route::get('/admin/article/{category}/{id}', 'AdminPages@article');

            Route::get('/admin/offer', 'AdminPages@offer');
            Route::get('/admin/offer/{category}', 'AdminPages@offer');
            Route::get('/admin/offer/{category}/{id}', 'AdminPages@offer');

            Route::get('/admin/project', 'AdminPages@project');
            Route::get('/admin/project/{category}', 'AdminPages@project');
            Route::get('/admin/project/{category}/{id}', 'AdminPages@project');
        // * Articles/Offers/Projects
    // * Pages

    // * Adminstration
        Route::get('/admin/administration', 'AdminPages@admins');
        Route::get('/admin/administration/{type}/{category}', 'AdminPages@admins');
        Route::get('/admin/administration/{type}/{category}/{id}', 'AdminPages@admins');

        Route::get('/admin/personal-edit', 'AdminPages@personal_edit');
        Route::post('/admin/personal-edit', 'AdminPages@personal_edit');

        // * Send Message
            Route::get('/admin/message/{page}', 'AdminPages@send_message');
            Route::post('/admin/send-message-to/{page}', 'AdminNotifications@send_message');
        // * Send Message
    // * Adminstration

    // * Users
        Route::get('/admin/users', 'AdminPages@users');
        Route::get('/admin/users/{category}/{id}', 'AdminPages@users');
    // * Users
    
    // * Core Methods
        Route::post('/admin/{model_name}/store', 'AdminCore@store');
        Route::post('/admin/{model_name}/update/{id}', 'AdminCore@update');
        Route::post('/admin/{model_name}/delete/{method}', 'AdminCore@delete');
        Route::post('/admin/{model_name}/restore', 'AdminCore@restore');
    // * Core Methods

    //* Ajax
        Route::post('/ajax-get-category', 'AjaxCT@ajax_get_category');
        Route::post('/ajax-cookies-agreement', 'AjaxCT@ajax_cookies_agreement');
        Route::post('/ajax-search', 'AjaxCT@ajax_search');
        Route::post('/ajax-validate-number', 'AjaxCT@ajax_validate_number');
        Route::post('/ajax-add-cart', 'AjaxCT@ajax_add_cart');
        Route::post('/ajax-remove-cart', 'AjaxCT@ajax_remove_cart');
        // Route::post('/ajax-admin-navbar', 'AjaxCT@ajax_admin_navbar');
    //* Ajax
/* 
*--------------------------------------------------------------------------
* Admin Panel
*--------------------------------------------------------------------------
*/