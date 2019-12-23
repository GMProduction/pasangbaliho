<?php

namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Master\advertiserModel;
use Illuminate\Support\Facades\Auth as Auth;

class LoginController extends Controller
{
    //

    
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        
        $this->middleware('guest');
        
    }

    public function showLoginForm()
    {

        return view('auth.member.login');
    }

    public function postlogin(Request $request)
    {
        // echo $request->email;    
        // echo $request->password;
        if (Auth::guard('advertiser')->attempt($request->only('email', 'password'))) {
            $data = [
                'status' => 'Anda login sebagai advertiser',
                'icon' => 'success'
            ];
            return redirect()->intended('/')
                ->with($data);
            // echo auth()->guard('advertiser')->user();

        } else {    
            $data = [
                'status' => 'Login Gagal',
                'title' => 'Password / Email tidak cocok',
                'icon' => 'success'
            ];
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
        Auth::guard('advertiser')->logout();
        return redirect('/')->with($data);;
    }
}
