<?php

namespace App\Http\Controllers;

use App\Exports\VBRsExport;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class VbrController extends Controller
{
    public function vbrList(Request $request)
    {
        Session::put('page', 'vbrList');

        $data['vbrData'] = Admin::where('role', 'vbr')->get();

        $query = "select * from admins";

        if ($request->isMethod('post')) {
            $name = $request->name;
            $email = $request->email;
            $mobile = $request->mobile;

            if ($name == '-1' && $email == '-1' && $mobile == '-1') {
            } else {
                $query = $query . " where 1=1 ";

                if ($name != '-1') {
                    $query = $query . " AND name = '" . $name . "'";
                    // dd($query);
                }

                if ($email != '-1') {
                    $query = $query . " AND email = '" . $email . "'";
                    // dd($query);
                }

                if ($mobile != '-1') {
                    $query = $query . " AND mobile = '" . $mobile . "'";
                }
            }

            $data['vbrDataList'] = DB::select($query);
            return view('vbr.vbe_list', $data);
        }
        $data['vbrDataList'] = DB::select($query);
        return view('vbr.vbe_list', $data);
    }

    public function myCustomer(Request $request)
    {

        Session::put('page', 'mycustomer');
        $vbr_id = session('id');
        // $form_entry_date = date('Y-m-d', strtotime($request->entry_date));
        $data['customers'] = Customer::where('vbr_id', $vbr_id)->get();

        $query = "select * from customers";

        if ($request->isMethod('post')) {
            $name = $request->name;
            $entry_date = $request->entry_date;
            $mobile = $request->mobile;
            // dd($entry_date);

            if ($name == '-1' && $mobile == '-1' && $entry_date == '-1') {
            } else {
                $query = $query . " where 1=1 ";

                if ($name != '-1') {
                    $query = $query . " AND name = '" . $name . "'";
                    //  dd($query);
                }

                if ($mobile != '-1') {
                    $query = $query . " AND mobile = '" . $mobile . "'";
                }

                if ($entry_date != '-1') {
                    $query = $query . " AND created_at = '" . $entry_date . "'";
                    // dd($query);
                }
            }

            $data['customersDataList'] = DB::select($query);
            // dd($data['customersDataList']);
            return view('vbr.customer_list', $data);
        }

        // dd($customers);
        $data['customersDataList'] = DB::select($query);
        return view('vbr.customer_list', $data);
    }

    public function couponGenerate()
    {
        Session::put('page', 'couponGenerate');
        return view('vbr.coupon_generate');
    }

    public function createCustomer()
    {
        return view('vbr.create_customer');
    }

    public function addCustomer(Request $request)
    {

        // dd($request->all());

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'mobile' => 'required|numeric|unique:customers',
        ]);

        $auth = session('id');
        $vbrMobileNumber = DB::table('admins')->where('id', $auth)->first();
        $unUsedCoupon = DB::table('coupons')->select('coupon')->where('status', 0)->first();
        // dd($unUsedCoupon);

        if ($unUsedCoupon->coupon && $unUsedCoupon->coupon == 0) {
            if ($request->mobile && $vbrMobileNumber->mobile) {

                // customer message info
                $customer_sms_body = "প্রিয় গ্রাহক, আপনার foodpanda ইউনিক Voucher কুপন " . $unUsedCoupon->coupon . " তৈরি করা হয়েছে। এই কুপনটি শুধু নতুন User-দের জন্য প্রযোজ্য।";
                $customer_mobile = $request->mobile;

                $customer_sms_sent_response = $this->sms_sent($customer_mobile, $customer_sms_body);
                //dd( $customer_sms_sent_response);

                //vbr message info
                // $vbr_sms_body = "VBR Email " . $vbrMobileNumber->email . ", অভিনন্দন আপনি সফলভাবে কাস্টমার নম্বর " . $customer_mobile . "  একটি কুপন তৈরি করেছেন।";
                // $vbr_mobile = $vbrMobileNumber->mobile;

                // $vbr_sms_sent_response = $this->sms_sent($vbr_mobile, $vbr_sms_body);
                // dd($vbr_sms_sent_response);
            }
        } else {
            return response()->json('coupon');
        }


        // if ($unUsedCoupon->coupon) {
        //     if ($request->mobile) {

        //         $customer_sms_body = "Dear customer, Your FoodPanda unique voucher coupon is ".$unUsedCoupon->coupon." created. This coupon is applicable for new user.";
        //         $test = urlencode($customer_sms_body);
        //         $api_url = "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=Smartpick-dfe06f43-a143-4b3a-91e3-f75e071166c5&sid=HIGHVOLNONBRAND&sms=".$test."&msisdn=88".$request->mobile."&csms_id=123456789";

        //         // dd($request->all());
        //         // $api = "http://107.173.27.10/test?amount=" . $amount . "&c_id=" . $campaign_id;

        //         $output = json_decode(file_get_contents($api_url));

        //         $vbr_sms_body = "VBR ID XXXXX, Congratulations you have successfully created a customer number ".$request->mobile." with a coupon.";
        //         $vbr_test = urlencode($vbr_sms_body);
        //         $vbr_api_url = "https://smsplus.sslwireless.com/api/v3/send-sms?api_token=Smartpick-dfe06f43-a143-4b3a-91e3-f75e071166c5&sid=HIGHVOLNONBRAND&sms=".$vbr_test."&msisdn=88".$vbrMobileNumber->mobile."&csms_id=123456789";
        //         $vbr_output = json_decode(file_get_contents($vbr_api_url));

        //         //dd($output);
        //     }
        // }else {
        //     return redirect()->back()->with('success','Something Error Found, Please contact with admin section.');
        // }

        $customer = new Customer;
        $customer->name = $request->name;
        $customer->vbr_id = $auth;
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->date_of_birth = $request->date_of_birth;
        $customer->location = $request->location;
        $customer->coupon_code = $unUsedCoupon->coupon;
        $customer->status = 0;
        $customer->save();

        Coupon::where('coupon', $unUsedCoupon->coupon)
            ->update([
                'vbr_id' => session('id'),
                'status' => 2
            ]);

        return response()->json('success');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->vbrs_ids;
        foreach ($ids as $id) {
            $admin = Admin::find($id);
            if ($admin) {
                $admin->delete();
            }
        }
        return response()->json('success', 201);
    }

    public function activateAll(Request $request)
    {
        $ids = $request->vbrs_ids;
        foreach ($ids as $id) {
            $admin = Admin::find($id);
            if ($admin) {
                $admin->status = 1;
                $admin->save();
            }
        }
        return response()->json('success', 201);
    }

    public function deactivateAll(Request $request)
    {
        $ids = $request->vbrs_ids;
        foreach ($ids as $id) {
            $admin = Admin::find($id);
            if ($admin) {
                $admin->status = 0;
                $admin->save();
            }
        }
        return response()->json('success', 201);
    }


    public function createVbr()
    {
        return view('vbr.create_vbr');
    }

    public function addVbr(Request $request)
    {
        //dd(Hash::make($request->password));
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'mobile' => 'required|numeric|min:11|unique:admins',
            'password' => 'required',
        ]);

        $vbr = new Admin;
        $vbr->name = $request->name;
        $vbr->email = $request->email;
        $vbr->mobile = $request->mobile;
        $vbr->password = Hash::make($request->password);
        $vbr->status = 1;
        $vbr->role = 'vbr';
        $vbr->status = 0;
        $vbr->created_at = Carbon::now();

        $vbr->save();
        return redirect()->back()->with('success', 'Vbr Created Successfully!');
    }

    public function sendOTPToCustomer(Request $request)
    {
        $fourRandomDigit = rand(1000, 9999);
        $customerMobile = $request->mobile;
        $body_sms = $fourRandomDigit . " is your one time otp for foodpanda coupon.";

        $customer_sms_sent_response = $this->sms_sent($customerMobile, $body_sms);
        if ($customer_sms_sent_response) {
            return response()->json($fourRandomDigit);
        } else {
            return response()->json("error");
        }
        // dd($customer_sms_sent_response);
    }
    public function sms_sent($receiver, $body)
    {

        $response = Http::post('https://smsplus.sslwireless.com/api/v3/send-sms', [
            'api_token' => 'Smartpick-dfe06f43-a143-4b3a-91e3-f75e071166c5',
            'sid' => 'HIGHVOLNONBRAND',
            'sms' => $body,
            'msisdn' => $receiver,
            'csms_id' => '123456789'
        ]);

        return $response;
    }
}
