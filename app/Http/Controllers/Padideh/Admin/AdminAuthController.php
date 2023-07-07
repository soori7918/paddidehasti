<?php

namespace App\Http\Controllers\Padideh\Admin;

use App\Http\Controllers\Controller;
use App\Models\Padideh\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{

    public function login()
    {
        return view('Padideh.auth.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'mobile' => 'required|regex:/^09\d{9}$/',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['mobile' => $request->mobile, 'password' =>$request->password , 'access_status' => 1], true)) {
            return redirect()->route('panel.dashboard');
        } else{
            return back()->withErrors([
                'حساب کاربری شما غیر فعال است لطفا با پشتیبانی تماس بگیرید'
            ]);
        }

    }

    public function authenticate(Request $request){
        // Retrive Input
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // if success login

            return redirect('berhasil');

            //return redirect()->intended('/details');
        }
        // if failed login
        return redirect('login');
    }

}
