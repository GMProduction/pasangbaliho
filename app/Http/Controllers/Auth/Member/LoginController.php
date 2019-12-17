<?php

namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Master\advertiserModel;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    //

    
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        
        $this->middleware('guest:advertiser')->except('logout');
        $this->middleware('guest:client')->except('logout');
    }

    public function showLoginForm()
    {

        return view('auth.member.login');
    }

    public function postlogin(Request $request)
    {
        $data = [
            'status' => 'Anda login sebagai advertiser',
            'icon' => 'success'
        ];
        if (FacadesAuth::guard('advertiser')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/')
                ->with($data);
        } else {    
            // Alert::error('Periksa username atau password anda', 'Gagal');
            return redirect()->back()->withInput()
                ->with($data);
        }

        // return redirect('/');
    }




    function logout()
    {
        $data = [
            'status' => 'Anda Telah logged out!',
            'icon' => 'success'
        ];
        FacadesAuth::guard('advertiser')->logout();
        return redirect('/')->with($data);;
    }
}
