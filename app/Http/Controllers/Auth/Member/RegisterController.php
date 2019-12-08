<?php

namespace App\Http\Controllers\Auth\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\advertiserModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Jobs\sendVerificationEmail;
use Carbon\Carbon;
use Alert;
use App\models\ClientModel;
use Auth;
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
            $this->middleware('guest:clients');
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
            $data = new advertiserModel();
            $data->nama = $req->nama;
            $data->email = $req->email;
            $data->alamat = $req->alamat;
            $data->password = Hash::make($req->password);
            $data->telp = $req->telp;
            $data->save();
            return redirect('/');
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
            $data = new ClientModel();
            $data->nama = $req->nama;
            $data->perusahaan = $req->perusahaan;
            $data->email = $req->email;
            $data->alamat = $req->alamat;
            $data->password = Hash::make($req->password);
            $data->telp = $req->telp;
            $data->save();
            return redirect('/');
        }
    }
}
