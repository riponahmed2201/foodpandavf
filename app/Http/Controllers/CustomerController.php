<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function customerList(Request $request){
        Session::put('page','customerList');

        // $query = "select * from customers";

        $query = "select customers.*, admins.name as admin_name from customers left join admins on customers.vbr_id=admins.id";
                // dd($query);

        $data['allCustomerDataList'] = Customer::all();

        // $data['customerData'] = DB::table('customers')
        //     ->join('admins', 'customers.vbr_id', '=', 'admins.id')
        //     ->select('customers.*', 'admins.name as admin_name')
        //     ->orderBy('id','DESC')
        //     ->get();

            if ($request->isMethod('post')) {
                $name = $request->name;
                $status = $request->status;
                $mobile = $request->mobile;
                $coupon_code = $request->coupon_code;
               // $entry_date = date('Y-m-d', strtotime($request->entry_date));

                if($name == '-1' && $status == '-1' && $mobile == '-1' && $coupon_code == '-1'){
                }else{
                    $query = $query. " where 1=1 ";

                    if($name != '-1'){
                      $query = $query . " AND customers.name = '".$name."'";
                     // dd($query);
                    }

                    if($status != '-1'){
                        $query = $query . " AND customers.status = '".$status."'";
                    }

                    if($mobile != '-1'){
                        $query = $query . " AND customers.mobile = '".$mobile."'";
                    }

                    if($coupon_code != '-1'){
                        $query = $query . " AND customers.coupon_code = '".$coupon_code."'";
                    }

                    // if($entry_date != ''){
                    //     $query = $query . " AND customers.created_at = '".$entry_date."'";
                    //     // dd($query);
                    // }
                }

                $data['customerData'] = DB::select($query);
                // dd($data['customerData']);

                return view('customer.customer_list',$data);
            }

        $data['customerData'] = DB::select($query);
        //dd($data['customerData']);
        return view('customer.customer_list',$data);
    }
}
