<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class HomeController extends Controller
{
	// public function __construct()
 //    {
 //        $this->middleware('auth');
 //    }

    public function index(){
    	return view('dashboard.dashboard');
    }

    public function vbrDashboard(){
    	return view('dashboard.vbr_dashboard');
    }
}
