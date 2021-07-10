<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Coupon;
use App\Imports\CouponsImport;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function couponList(Request $request){
        Session::put('page','couponList');
        $data['couponDataList'] = Coupon::all();

         $query = "select * from coupons";

         if ($request->isMethod('post')) {
            $coupon_code = $request->coupon_code;
            $coupon_status = $request->coupon_status;
            if($coupon_code == '-1' && $coupon_status == '-1'){
            }else{
                $query = $query. " where 1=1 ";

                if($coupon_code != '-1'){
                  $query = $query . " AND coupon = '".$coupon_code."'";
                 // dd($query);
                }

                if($coupon_status != '-1'){
                    $query = $query . " AND status = '".$coupon_status."'";
                }
            }

            $data['couponList'] = DB::select($query);
            return view('coupon.coupon_list',$data);
         }

        // dd($couponList);
        $data['couponList'] = DB::select($query);
        return view('coupon.coupon_list',$data);
    }

    public function assignCoupon(){
        $data['vbrList'] = Admin::all();
        $data['couponList'] = Coupon::all();
        return view('coupon.assign_coupon',$data);
    }

    public function couponBatchUpload(Request $request)
    {
        $upload = $request->file('file');
        $filename = $_FILES['file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $accept_files = ["csv", "xlsx"];
        if(!in_array($ext, $accept_files)) {
            return redirect()->back()
            ->with('error', 'Invalid file extension. permitted file is .csv & .xlsx');
        }
        // get the file
        $upload = $request->file('file');
        $filePath = $upload->getRealPath();

        if($ext == "xlsx" || $ext == "csv") {
        $result = Excel::toArray(new CouponsImport, $upload);

        // dd($result);

            for($i =0; $i<count($result[0]) ;$i++){

                  if ($result[0][$i] && $result[0][$i][0] != null) {
                   // dd($result[0][$i][0]);
                    Coupon::create([
                        'coupon' =>$result[0][$i][0],
                        'status' => 0,
                        'assign_date' => date('Y-m-d H:i:s')
                    ]);
                  }
                }

        return back()->with('success','Coupon batch imported successfully!!');

    }
}
}
