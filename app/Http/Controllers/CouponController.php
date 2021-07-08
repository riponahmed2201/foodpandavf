<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function couponList(){
        Session::put('page','couponList');
        return view('coupon.coupon_list');
    }

    public function assignCoupon(){
        return view('coupon.assign_coupon');
    }
}
