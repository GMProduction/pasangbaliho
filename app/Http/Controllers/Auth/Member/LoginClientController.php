<?php

namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginClientController extends Controller
{
    //
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('guest:client')->except('logout');
    }

    public function showLoginForm()
    {

        return view('auth.member.login');
    }

    public function postloginClient(Request $request)
    {
        
        if (FacadesAuth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/')
                ->with('status', 'You are Logged in as '. FacadesAuth::guard('client')->user()->nama);
            //    echo auth()->guard('client')->user();
            // echo Auth::guard('client')->user()->nama;
        } else {
            // Alert::error('Periksa username atau password anda', 'Gagal');
            return redirect()->back()->withInput()
                ->with('status', 'Cek email / password');
        }

        // return redirect('/');
    }

    function logoutClient()
    {
        FacadesAuth::guard('client')->logout();
        return redirect('/')->with('status', 'You are Logged Out');;
    }
}
