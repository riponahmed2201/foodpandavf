<?php

use Illuminate\Support\Facades\Route;



Route::get('/','AdminAuthController@showLoginForm');
Route::any('/admin/logout','AdminAuthController@logout')->name('admin.logout');
Route::post('/admin/login','AdminAuthController@login')->name('admin.login');

Route::middleware('admin')->group(function(){
    Route::get('/dashboard','HomeController@index');

    //password change
    Route::get('/admin/password/change','PasswordChangeController@adminPasswordChangeView')->name('adminPasswordChangeView');
    Route::post('/admin/password/change/check','PasswordChangeController@adminPasswordChangeCheck')->name('adminPasswordChangeCheck');

    Route::any('/customer/list','CustomerController@customerlist')->name('customer.list');
    Route::any('/coupon','CouponController@couponlist')->name('coupon.list');
    Route::get('/assign/coupon','CouponController@assigncoupon')->name('assign.coupon');
    Route::any('/vbr/list','VbrController@vbrlist')->name('vbr.list');
   // Route::post('/vbr/update-status','VbrController@updateVbrStatus')->name('update.vbrStaus');

    //vbr Delete & Approved & Inapproved
    Route::post('/delete/all/vbrs','VbrController@deleteAll');
    Route::post('/activate/all/vbrs','VbrController@activateAll');
    Route::post('/deactivate/all/vbrs','VbrController@deactivateAll');

    Route::get('/create/vbr','VbrController@createVbr')->name('create.vbr');
    Route::post('/add/vbr','VbrController@addVbr')->name('add.vbr');
    Route::get('/report','ReportController@report')->name('report');
    Route::get('/print-vbr-report-excel','ReportController@printVBRReportExcel')->name('printVBRReportExcel');
    Route::get('/vbr/report','ReportController@vbrreport')->name('vbr.report');
    Route::get('/export-excel-report','ReportController@exportToExcelReport')->name('exportToExcelReport');

    //excel upload
    Route::post('/coupon-excel-upload','CouponController@couponBatchUpload')->name('coupon.excel.upload');
    Route::post('/change-coupon-status-batch-upload','CouponController@changeCouponStatusBatchUpload')->name('changeCouponStatusBatchUpload');

});

///
// Route::get('/vbr/login','VbrAuthController@vbrLoginForm');
// Route::post('/vbr-login','VbrAuthController@vbrLogin')->name('vbr.login');

Route::middleware('vbr')->group(function(){
    Route::get('/vbr/dashboard','HomeController@vbrDashboard');
    Route::any('/my/customer','VbrController@myCustomer')->name('mycustomer');
    Route::get('/generate/coupon','VbrController@coupongenerate')->name('coupon.generate');
    Route::get('/create/customer','VbrController@createCustomer')->name('create.customer');
    Route::post('/add/customer','VbrController@addCustomer')->name('add.customer');

    // send OTP to customer
    Route::post('/send-otp-customer','VbrController@sendOTPToCustomer')->name('sendOTPToCustomer');

    //password change
    Route::get('/vbr/password/change','PasswordChangeController@vbrPasswordChangeView')->name('vbrPasswordChangeView');
    Route::post('/vbr/password/change/check','PasswordChangeController@vbrPasswordChangeCheck')->name('vbrPasswordChangeCheck');

});

