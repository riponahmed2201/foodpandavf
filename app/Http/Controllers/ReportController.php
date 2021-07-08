<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(){
    	return view('reports.report');
    }

    public function vbrReport(){
    	return view('reports.vbr_report');
    }
}
