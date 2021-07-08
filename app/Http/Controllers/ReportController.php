<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function report(){
        Session::put('page','report');
    	return view('reports.report');
    }

    public function vbrReport(){
    	return view('reports.vbr_report');
    }
}
