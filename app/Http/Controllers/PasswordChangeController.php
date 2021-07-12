<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function adminPasswordChangeView()
    {
        Session::put('page','adminPasswordChange');
        return view('profile.adminChangePassword');
    }

    public function adminPasswordChangeCheck(Request $request)
    {
        //dd($request->password , $request->password_confirmation);
//        $this->validate($request,[
//            'old_password' => 'required',
//            'password' => 'required|confirmed|min:6',
//        ]);

        $auth_id = session('id');
        $auth_info = DB::table('admins')->where('id',$auth_id)->first();

        if($request->password == $request->password_confirmation){
            if (Hash::check($request->old_password, $auth_info->password)) {
                if(Hash::check($request->password,$auth_info->password)){
                    $users = Admin::find($auth_id);
                    $users->password = Hash::make($request->password);
                    $users->save();
                    Session::flash('success','You have successfully changed the password');
                    $request->session()->flush();
                    return redirect('/');
                }else{
                    Session::flash('failed','New password cannot be the same as old password');
                    return redirect()->back();
                }
            }else{
                Session::flash('failed','Old password does not matched!');
                return redirect()->back();
            }
        }else{
            Session::flash('failed','New password and confirmed password does not matched!');
            return redirect()->back();
        }
    }

    public function vbrPasswordChangeCheck(Request $request)
    {
        $auth_id = session()->get('id');
        $auth_info = DB::table('admins')->where('id',$auth_id)->first();

        if($request->password == $request->password_confirmation){
            if (Hash::check($request->old_password, $auth_info->password)) {
                if(Hash::check($request->password,$auth_info->password)){
                    $users = Admin::find($auth_id);
                    $users->password = Hash::make($request->password);
                    $users->save();
                    Session::flash('success','You have successfully changed the password');
                    $request->session()->flush();
                    return redirect('/');
                }else{
                    Session::flash('failed','New password cannot be the same as old password');
                    return redirect()->back();
                }
            }else{
                Session::flash('failed','Old password does not matched!');
                return redirect()->back();
            }
        }else{
            Session::flash('failed','New password and confirmed password does not matched!');
            return redirect()->back();
        }
    }

    public function vbrPasswordChangeView()
    {
        Session::put('page','adminPasswordChange');
        return view('profile.vbrChangePassword');
    }

}
