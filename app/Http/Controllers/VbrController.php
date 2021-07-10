<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class VbrController extends Controller
{
    public function vbrList(Request $request){
         Session::put('page','vbrList');
        $vbrData=Admin::where('role','vbr')->get();

        $query = "select * from admins where role != admin";

        //dd($vbrData);
    	return view('vbr.vbe_list')->with(compact('vbrData'));
    }

    public function myCustomer(){
        Session::put('page','mycustomer');
        $vbr_id = session('id');
        $customers=Customer::where('vbr_id',$vbr_id)->get();
        // dd($customers);
    	return view('vbr.customer_list')->with(compact('customers'));
    }

    public function couponGenerate(){
        Session::put('page','couponGenerate');
    	return view('vbr.coupon_generate');
    }

    public function createCustomer(){
    	return view('vbr.create_customer');
    }

    public function addCustomer(Request $request){

        // dd($request->all());
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required|email|unique:customers',
                'mobile'=>'required',
            ]);

            $unUsedCoupon = DB::table('coupons')->select('coupon')->where('status',0)->first();

            // $chars = "BSH@KSS0171";
            // $coupon_code = "";
            // for ($i = 0; $i < 6; $i++) {
            //     $coupon_code .= $chars[mt_rand(0, strlen($chars)-1)];
            // }

            $auth = session('id');

             $customer = new Customer;
             $customer->name = $request->name;
             $customer->vbr_id = $auth;
             $customer->email = $request->email;
             $customer->mobile = $request->mobile;
             $customer->date_of_birth = $request->date_of_birth;
             $customer->location = $request->location;
             $customer->coupon_code = $unUsedCoupon->coupon;
             $customer->status=0;
             $customer->save();

            Coupon::where('coupon',$unUsedCoupon->coupon)
            ->update([
                'status' => 2,
            ]);

             return redirect()->back()->with('success','Customer Created Successfully!');
    }

    public function deleteAll(Request $request){
        $ids = $request->vbrs_ids;
        foreach ($ids as $id){
            $admin = Admin::find($id);
            if ($admin){
                $admin->delete();
            }
        }
        return response()->json('success',201);
    }

    public function activateAll(Request $request){
        $ids = $request->vbrs_ids;
        foreach ($ids as $id){
            $admin = Admin::find($id);
            if ($admin){
                $admin->status=1;
                $admin->save();
            }
        }
        return response()->json('success',201);
    }

    public function deactivateAll(Request $request){
        $ids = $request->vbrs_ids;
        foreach ($ids as $id){
            $admin = Admin::find($id);
            if ($admin){
                $admin->status=0;
                $admin->save();
            }
        }
        return response()->json('success',201);
    }


    public function createVbr(){
        return view('vbr.create_vbr');
    }

    public function addVbr(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:customers',
            'mobile'=>'required',
            'password'=>'required',
            ]);

         $vbr=new Admin;
         $vbr->name=$request->name;
         $vbr->email=$request->email;
         $vbr->mobile=$request->mobile;
         $vbr->password=Hash::make('123456');
         $vbr->status=1;
         $vbr->role='vbr';
         $vbr->status=0;

         $vbr->save();
         return redirect()->back()->with('success','Vbr Created Successfully!');
    }
}
