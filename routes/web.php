<?php

use Illuminate\Support\Facades\Route;


Route::get('/','AdminAuthController@showLoginForm');
route::any('/admin/logout','adminauthcontroller@logout')->name('admin.logout');
route::post('/admin/login','adminauthcontroller@login')->name('admin.login');

Route::middleware('admin')->group(function(){
    Route::get('/dashboard','HomeController@index');
    route::get('/customer/list','customercontroller@customerlist')->name('customer.list');
    route::get('/coupon','couponcontroller@couponlist')->name('coupon.list');
    route::get('/assign/coupon','couponcontroller@assigncoupon')->name('assign.coupon');
    route::get('/vbr/list','vbrcontroller@vbrlist')->name('vbr.list');
    route::post('/vbr/update-status','vbrcontroller@updateVbrStatus')->name('update.vbrStaus');
    route::get('/create/vbr','vbrcontroller@createVbr')->name('create.vbr');
    route::post('/add/vbr','vbrcontroller@addVbr')->name('add.vbr');
    Route::get('/report','ReportController@report')->name('report');
    route::get('/vbr/report','reportcontroller@vbrreport')->name('vbr.report');
});

///
// Route::get('/vbr/login','VbrAuthController@vbrLoginForm');
// Route::post('/vbr-login','VbrAuthController@vbrLogin')->name('vbr.login');

Route::middleware('vbr')->group(function(){
    Route::get('/vbr/dashboard','HomeController@vbrDashboard');
    Route::get('/my/customer','VbrController@myCustomer')->name('mycustomer');
    route::get('/generate/coupon','vbrcontroller@coupongenerate')->name('coupon.generate');
    route::get('/create/customer','vbrcontroller@createCustomer')->name('create.customer');
    Route::post('/add/customer','vbrcontroller@addCustomer')->name('add.customer');
});

