<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class VbrController extends Controller
{
    public function vbrList(){
        $vbrData=Admin::where('role','vbr')->get();
        //dd($vbrData);
    	return view('vbr.vbe_list')->with(compact('vbrData'));
    }

    public function myCustomer(){
        $customers=Customer::all();
        //dd($customers);
    	return view('vbr.customer_list')->with(compact('customers'));
    }

    public function couponGenerate(){
    	return view('vbr.coupon_generate');
    }

    public function createCustomer(){
    	return view('vbr.create_customer');
    }

    public function addCustomer(Request $request){
             $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:customers',
            'mobile'=>'required',
            ]);

            $chars = "BSH@KSS0171";
            $coupon_code = "";
            for ($i = 0; $i < 6; $i++) {
                $coupon_code .= $chars[mt_rand(0, strlen($chars)-1)];
            }

            $auth = session('id');

             $customer=new Customer;
             $customer->name=$request->name;
             $customer->vbr_id=$auth;
             $customer->email=$request->email;
             $customer->mobile=$request->mobile;
             $customer->date_of_birth=$request->date_of_birth;
             $customer->location=$request->location;
             $customer->coupon_code=$coupon_code;
             $customer->status=0;
             
             $customer->save();
             return redirect()->back()->with('success','Customer Created Successfully!');
    }

    public function updateVbrStatus(Request $request){
         if ($request->ajax()) {
                $data=$request->all();
                //echo "<pre>"; print_r($data);die();
                if ($data['status']=="Approved") {
                    $status=1;
                }else{
                    $status=0;
                }
                Admin::where('id',$data['vbr_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'vbr_id'=>$data['vbr_id']]);
         }
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
