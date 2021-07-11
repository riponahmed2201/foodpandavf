<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Coupon;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('auth');
 //    }

    public function index(){
        Session::put('page','dashboard');

        $data['totalCustomer'] = Customer::count();
        $data['totalVBR'] = Admin::where('role', 'vbr')->count();
        $data['totalCoupon'] = Coupon::select('coupon')->count();
        // dd($data['totalCoupon']);
    	return view('dashboard.dashboard',$data);
    }

    public function vbrDashboard(){
        Session::put('page','vbr_dashboard');

        $auth_id = session('id');
        $data['myCustomer'] = Customer::where('vbr_id', $auth_id)->count();
        $data['todayCustomerCount'] = Customer::whereDate('created_at', Carbon::today())->count();

    	return view('dashboard.vbr_dashboard',$data);
    }
}
