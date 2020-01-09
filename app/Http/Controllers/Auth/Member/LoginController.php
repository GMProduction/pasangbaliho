<?php

namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Master\advertiserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    //

    // use Socialite;
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


    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
{
    try {
        
        $user = Socialite::driver($driver)->user();
        $create = advertiserModel::firstOrCreate([
            'email' => $user->getEmail()
        ], [
            'nama' => $user->getName(),
            'api_token' => Hash::make($user->getEmail()),
            'email_verified_at' => Carbon::now()
            
        ]);
        $data = [
            'status' => 'Selamat datang '.$user->getName(),
            'text' => 'Anda login sebagai advertiser',
            'icon' => 'success'
        ];
        Auth::guard('advertiser')->login($create, true);
        return redirect($this->redirectPath())->with($data);
        // echo $create;
    } catch (\Exception $e) {
        return redirect()->route('login');
    }
}

    public function postlogin(Request $request)
    {
        // echo $request->email;    
        // echo $request->password;
        if (Auth::guard('advertiser')->attempt($request->only('email', 'password'))) {
            $data = [
                'status' => 'Selamat datang '.auth()->guard('advertiser')->user()->nama,
                'text' => ' Anda login sebagai advertiser',
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
            'status' => 'Anda Telah Logout',
            'text' => 'Terima Kasih',
            'icon' => 'success'
        ];
        Auth::guard('advertiser')->logout();
        return redirect('/')->with($data);;
    }
}
