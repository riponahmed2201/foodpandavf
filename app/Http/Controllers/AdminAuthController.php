<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest:system_admin')->except('logout');
    // }

    private $errors = [];

    protected $redirectTo = '/dashboard';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $auth = Admin::where('email', '=', $request->email)->first();
        if ($auth) {
            if (Hash::check($request->password, $auth->password)) {
                session([
                    'id' => $auth->id,
                    'name' => $auth->name,
                    'email' => $auth->email,
                    'role' => $auth->role,
                ]);
                if ($auth->role == 'admin') {
                    return redirect('/dashboard');
                } elseif ($auth->role == 'vbr') {
                    if ($auth->status == 1) {
                        return redirect('/vbr/dashboard');
                    } else {
                        return redirect('/')->with('failed', 'Your are not active.');
                    }
                } else {
                    return redirect('/');
                }
            } else {
                // return redirect('/')
                //     ->withInput($request->only('email'))
                //     ->withErrors($this->errors);
                return redirect('/')->with('failed', 'Password do not match.');
            }
        } else {
            return back()->with('failed', 'No account for this email');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
