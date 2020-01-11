<?php

namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Master\clientModel;

class LoginClientController extends Controller
{
    //
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    public function __construct()
    {
        // $this->middleware('guest:client')->except('logout');
    }

    public function showLoginForm()
    {

        return view('auth.member.login');
    }

    public function postloginClient(Request $request)
    {
        
        if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $data = [
                'status' => 'Selamat datang '.auth()->guard('client')->user()->nama,
                'text' => ' Anda login sebagai klien',
                'icon' => 'success'
            ];
            if(auth()->guard('client')->user()->status === 'pending'){
                $data1 = [
                    'status' => 'Belum bisa login',
                    'text' => ' Mohon tunggu konfirmasi dari admin untuk dapat login',
                    'icon' => 'warning'
                ];
                return redirect()->back()->withInput()
                ->with($data1);
            }else if(auth()->guard('client')->user()->status === 'tolak'){
                $data1 = [
                    'status' => 'Akun anda ditolak',
                    'text' => 'Mohon maaf pendaftaran anda ditolak',
                    'icon' => 'warning'
                ];
                return redirect()->back()->withInput()
                ->with($data1);
            }
            else{
                return redirect()->intended('/')
                ->with($data);
            }
            
            //    echo auth()->guard('client')->user();
            // echo Auth::guard('web')->user();
        } else {
            $data = [
                'status' => 'Login Gagal',
                'title' => 'Password / Email tidak cocok',
                'icon' => 'success'
            ];
            return redirect()->back()->withInput()
                ->with($data);
        }

    }

    function logoutClient()
    {
        $data = [
            'status' => 'Anda Telah Logout',
            'text' => 'Terima Kasih',
            'icon' => 'success'
        ];
        Auth::guard('client')->logout();
        return redirect('/')->with($data);;
    }
}
