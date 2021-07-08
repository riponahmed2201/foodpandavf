<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Coupon;
use App\Imports\CouponsImport;

class CouponController extends Controller
{
    public function couponList(){
        Session::put('page','couponList');
        return view('coupon.coupon_list');
    }

    public function assignCoupon(){
        return view('coupon.assign_coupon');
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
                    ]);
                  }
                }

        return back()->with('success','Coupon batch imported successfully');

    }
}
}
