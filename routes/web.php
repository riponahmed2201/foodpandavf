<?php

use Illuminate\Support\Facades\Route;


Route::get('/','AdminAuthController@showLoginForm');
route::any('/admin/logout','AdminAuthController@logout')->name('admin.logout');
route::post('/admin/login','AdminAuthController@login')->name('admin.login');

Route::middleware('admin')->group(function(){
    Route::get('/dashboard','HomeController@index');
    route::get('/customer/list','Customercontroller@customerlist')->name('customer.list');
    route::get('/coupon','CouponController@couponlist')->name('coupon.list');
    route::get('/assign/coupon','CouponController@assigncoupon')->name('assign.coupon');
    route::get('/vbr/list','VbrController@vbrlist')->name('vbr.list');
    route::post('/vbr/update-status','VbrController@updateVbrStatus')->name('update.vbrStaus');
    route::get('/create/vbr','VbrController@createVbr')->name('create.vbr');
    route::post('/add/vbr','VbrController@addVbr')->name('add.vbr');
    Route::get('/report','ReportController@report')->name('report');
    route::get('/vbr/report','ReportController@vbrreport')->name('vbr.report');
});

///
// Route::get('/vbr/login','VbrAuthController@vbrLoginForm');
// Route::post('/vbr-login','VbrAuthController@vbrLogin')->name('vbr.login');

Route::middleware('vbr')->group(function(){
    Route::get('/vbr/dashboard','HomeController@vbrDashboard');
    Route::get('/my/customer','VbrController@myCustomer')->name('mycustomer');
    route::get('/generate/coupon','VbrController@coupongenerate')->name('coupon.generate');
    route::get('/create/customer','VbrController@createCustomer')->name('create.customer');
    Route::post('/add/customer','VbrController@addCustomer')->name('add.customer');
});

