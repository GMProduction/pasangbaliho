<?php

namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\advertiserModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\models\ClientModel;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //

    use RegistersUsers;
    protected $redirectTo = '/';

    public function __construct()
        {
            $this->middleware('guest');
            $this->middleware('guest:advertiser');
            $this->middleware('guest:client');
        }

    public function showOptionRegister()
    {
        return view('auth.member.optionRegister');
    }

    public function showRegisterClient()
    {
        return view('auth.member.registrationClient');
    }

    public function showRegisterAdvertiser()
    {
        return view('auth.member.registrationAdvertiser');
    }

    private function isValidGeneral(Request $req)
    {
        $messages = [];

        $rules = [
            'nama' => 'required|max:191',
            'email' => 'required|max:191|unique:advertisers,email',
            // 'password' => 'required|string|min:6|confirmed',
        ];

        return Validator::make($req->all(), $rules, $messages);
    }

    public function registerAdvertiser(Request $req)
    {
        if ($this->isValidGeneral($req)->fails()) {
            $errors = $this->isValidGeneral($req)->errors();
            return redirect()->back()->withErrors($errors)->withInput();
            //echo $errors;

        } else {
            $masage = [
                'status' => 'Pendaftaran Advertiser Berhasil, Silahkan Login kembali',
                'icon' => 'success'
            ];
            $data = new advertiserModel();
            $data->nama = $req->nama;
            $data->email = $req->email;
            $data->nama_instansi = $req->nama_instansi;
            $data->alamat = $req->alamat;
            $data->password = Hash::make($req->password);
            $data->telp = $req->telp;
            $data->api_token = Hash::make($req->email);
            $data->save();
            return redirect('/')->with($masage);
        }
    }

    private function isValidGeneralClient(Request $req)
    {
        $messages = [];

        $rules = [
            'nama' => 'required|max:191',
            'email' => 'required|max:191|unique:clients,email',
            // 'password' => 'required|string|min:6|confirmed',
        ];

        return Validator::make($req->all(), $rules, $messages);
    }

    public function registerClient(Request $req)
    {
        if ($this->isValidGeneralClient($req)->fails()) {
            $errors = $this->isValidGeneralClient($req)->errors();
             return redirect()->back()->withErrors($errors)->withInput();
            //echo $errors;

        } else {
            $masage = [
                'status' => 'Pendaftaran Klien Berhasil, Silahkan Tunggu Konfirmasi dari Admin',
                'icon' => 'success'
            ];
            $data = new ClientModel();
            $data->nama = $req->nama;
            $data->nama_instansi = $req->nama_instansi;
            $data->email = $req->email;
            $data->alamat = $req->alamat;
            $data->password = Hash::make($req->password);
            $data->telp = $req->telp;
            $data->save();
            return redirect('/')->with($masage);
        }
    }
}
