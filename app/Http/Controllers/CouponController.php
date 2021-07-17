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
        $data['vbrDataList'] = Admin::where('role', 'vbr')->get();

         //$query = "select * from coupons";
         $query = "select coupons.*, admins.name as vbr_name from coupons left join admins on coupons.vbr_id=admins.id";


         if ($request->isMethod('post')) {
            $coupon_code = $request->coupon_code;
            $coupon_status = $request->coupon_status;
            $vbr_name = $request->vbr_name;

            $entry_date = date('Y-m-d', strtotime($request->entry_date));

            if($coupon_code == '-1' && $coupon_status == '-1' && $vbr_name == '-1' && $entry_date == ' '){
            }else{
                $query = $query. " where 1=1 ";

                if($coupon_code != '-1'){
                  $query = $query . " AND coupons.coupon = '".$coupon_code."'";
                 // dd($query);
                }

                if($coupon_status != '-1'){
                    $query = $query . " AND coupons.status = '".$coupon_status."'";
//                     dd($query);
                }

                if($vbr_name != '-1'){
                    $query = $query . " AND admins.name = '".$vbr_name."'";
                }
//                if(!empty($entry_date)){
//                    $query = $query . " AND coupons.created_at like '%".$entry_date."%'";
//                    // dd($query);
//                }
            }

            $data['couponList'] = DB::select($query);
            //dd($data['couponList']);
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

    public function changeCouponStatusBatchUpload(Request $request)
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

            for($i =0; $i<count($result[0]) ;$i++){

                  if ($result[0][$i] && $result[0][$i][0] != null) {
//                    dd($result[0][$i][0]);
                    Coupon::where('coupon',$result[0][$i][0])->update([
                        'status' => 1
                    ]);
                  }
                }

        return back()->with('success','Coupon status updated successfully!!');

        }
    }
}
