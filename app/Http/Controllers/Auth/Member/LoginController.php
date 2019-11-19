<?php

namespace App\Http\Controllers\Auth\Member;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Master\advertiserModel;

class LoginController extends Controller
{
    //

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {

        return view('auth.member.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::guard('advertiser')->attempt($request->only('email', 'password'))) {
            return redirect('/');
        } else {
            // Alert::error('Periksa username atau password anda', 'Gagal');
            return redirect()->back()->withInput();
        }

        // return redirect('/');
    }

    function logout()
    {
        Auth::guard('advertiser')->logout();
        return redirect('/');
    }
}
