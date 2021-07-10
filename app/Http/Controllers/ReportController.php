<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VBRsExport;
use App\Models\Admin;

class ReportController extends Controller
{
    public function report(){
        Session::put('page','report');
        $vbrName = Admin::where('role','vbr')->get();
        // dd($vbrName);
    	return view('reports.report',compact('vbrName'));
    }

    public function vbrReport(){
    	return view('reports.vbr_report');
    }

    public function exportToExcelReport(Request $request){
        // dd($request->all());
        $id = $request->name;
        return Excel::download(new VBRsExport($id), 'report.csv');
      }
}
