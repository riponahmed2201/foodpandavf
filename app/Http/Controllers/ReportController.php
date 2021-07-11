<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VBRsExport;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

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
        $all_vbr_name = '';
        if ($request->name == 'all') {
            $all_vbr_name = 'all';
        }else {
            $all_vbr_name = $request->name;
        }
        return Excel::download(new VBRsExport($all_vbr_name), 'report.csv');
      }

      public function printVBRReportExcel(Request $request)
      {
        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));
        $vbrName = $request->vbr_name;
        // SELECT * FROM `admins` WHERE created_at BETWEEN '2021-07-08 16:07:14' AND '2021-07-08 18:42:15' AND role = 'vbr'

        if ($request->vbr_name == 'all') {
            $report =  DB::select("select * from admins where created_at BETWEEN '".$from_date."' AND '".$to_date."' AND role='vbr'");
        }else {
            $report =  DB::select("select * from admins where created_at BETWEEN '".$from_date."' AND '".$to_date."' AND id='".$vbrName."' AND role='vbr'");
        }

        //dd($report);

        return response()->json($report);

      }
}
