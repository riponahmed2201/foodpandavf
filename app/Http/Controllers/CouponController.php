<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function couponList(){
    	return view('coupon.coupon_list');
    }

    public function assignCoupon(){
    	return view('coupon.assign_coupon');
    }
}
