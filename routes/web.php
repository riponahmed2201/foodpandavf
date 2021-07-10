<?php

use Illuminate\Support\Facades\Route;



Route::get('/','AdminAuthController@showLoginForm');
Route::any('/admin/logout','AdminAuthController@logout')->name('admin.logout');
Route::post('/admin/login','AdminAuthController@login')->name('admin.login');

Route::middleware('admin')->group(function(){
    Route::get('/dashboard','HomeController@index');
    Route::any('/customer/list','CustomerController@customerlist')->name('customer.list');
    Route::any('/coupon','CouponController@couponlist')->name('coupon.list');
    Route::get('/assign/coupon','CouponController@assigncoupon')->name('assign.coupon');
    Route::get('/vbr/list','VbrController@vbrlist')->name('vbr.list');
   // Route::post('/vbr/update-status','VbrController@updateVbrStatus')->name('update.vbrStaus');

    //vbr Delete & Approved & Inapproved
    Route::post('/delete/all/vbrs','VbrController@deleteAll');
    Route::post('/activate/all/vbrs','VbrController@activateAll');
    Route::post('/deactivate/all/vbrs','VbrController@deactivateAll');

    Route::get('/create/vbr','VbrController@createVbr')->name('create.vbr');
    Route::post('/add/vbr','VbrController@addVbr')->name('add.vbr');
    Route::get('/report','ReportController@report')->name('report');
    Route::get('/vbr/report','ReportController@vbrreport')->name('vbr.report');

    //excel upload
    Route::post('/coupon-excel-upload','CouponController@couponBatchUpload')->name('coupon.excel.upload');

});

///
// Route::get('/vbr/login','VbrAuthController@vbrLoginForm');
// Route::post('/vbr-login','VbrAuthController@vbrLogin')->name('vbr.login');

Route::middleware('vbr')->group(function(){
    Route::get('/vbr/dashboard','HomeController@vbrDashboard');
    Route::get('/my/customer','VbrController@myCustomer')->name('mycustomer');
    Route::get('/generate/coupon','VbrController@coupongenerate')->name('coupon.generate');
    Route::get('/create/customer','VbrController@createCustomer')->name('create.customer');
    Route::post('/add/customer','VbrController@addCustomer')->name('add.customer');

});

