<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('auth');
 //    }

    public function index(){
        Session::put('page','dashboard');
    	return view('dashboard.dashboard');
    }

    public function vbrDashboard(){
        Session::put('page','vbr_dashboard');
    	return view('dashboard.vbr_dashboard');
    }
}
