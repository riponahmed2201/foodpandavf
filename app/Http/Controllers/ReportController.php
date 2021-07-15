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
        $from_date = date('Y-m-d 00:00:01', strtotime($request->from_date));
        $to_date = date('Y-m-d 23:59:59', strtotime($request->to_date));

        $vbrName = $request->vbr_name;
        // SELECT customers.*, admins.name as vbr_name FROM `customers`
        // INNER JOIN admins on customers.vbr_id=admins.id
        // WHERE customers.created_at BETWEEN '2021-07-08' AND '2021-07-10' AND admins.id = 2

        if ($request->vbr_name == 'all') {

            $report =  DB::select("SELECT customers.*, admins.name as vbr_name FROM `customers`
                                    INNER JOIN admins on customers.vbr_id=admins.id
                                    WHERE customers.created_at BETWEEN '".$from_date."' AND '".$to_date."' AND admins.role = 'vbr'");
        }else {
            $report =  DB::select("SELECT customers.*, admins.name as vbr_name FROM `customers`
                                    INNER JOIN admins on customers.vbr_id=admins.id
                                    WHERE customers.created_at BETWEEN '".$from_date."' AND '".$to_date."' AND admins.id = '".$vbrName."'");
            }
        //dd($report);
        return response()->json($report);
      }
}
