<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\AdminModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminControll extends Controller
{

    public function login (Request $r) {
        
        $admin = AdminModel::where('username', $r->username)->first();

        if ($admin != null) {
            $password = $admin['password'];
            if (Hash::check($r->password, $password)) {
                return response()->json(['user' => $admin, 'message' => 'Login Successfull'], 200);
            }
            return response()->json(['message' => 'Ooops, Password Salah!'], 202);
        }
        
        return response()->json(['message' => 'Ooops, User Tidak Di Temukan!'], 202);
    }

    public function register (Request $r) {

        $validator = Validator::make($r->all(),[
                'username' => 'required|unique:admin,username',
                'password' =>'required',
                'role' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 202);           
        }
        
        $input = $r->all();
        $input['password'] = bcrypt($input['password']);
        $input['api_token'] = bcrypt($input['username']);
        $admin = AdminModel::create($input);
        return response()->json(['data' => $admin], 200);
    }
}
