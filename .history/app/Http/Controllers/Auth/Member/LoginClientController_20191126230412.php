<?php

namespace App\Http\Controllers\Auth\Member;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginClientController extends Controller
{
    //
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function postloginClient(Request $request)
    {
        if (Auth::guard('clients')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/dashboardClient');
        //    echo auth()->guard('client')->user();
            // echo Auth::guard('client')->user()->nama;
        } else {
            // Alert::error('Periksa username atau password anda', 'Gagal');
            return redirect()->back()->withInput();
        }

        // return redirect('/');
    }

    function logoutClient(){
        Auth::guard('client')->logout();
        return redirect('/');
    }
}
