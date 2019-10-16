<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AdvertiserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $advertiser = AdvertiserModel::create($input);
        $success['token'] =  $advertiser->createToken('MyApp')->accessToken;
        $success['nama'] =  $advertiser->nama;
        return response()->json(['success' => $success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function getAdvertiser(Request $request)
    {
        $advertiser = AdvertiserModel::where(['email' => $request->email, 'password' => $request->password])
            ->first();


        return response()->json([
            'status' => $request->id,
            'advertiser' => $advertiser
        ]);
    }

    public function loginAdvertiser(Request $request)
    {
        $advertiser = AdvertiserModel::where([
            'email' => $request->email,
            'password' => $request->password
        ])
            ->first();

        if ($advertiser == null) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'user tidak terdaftar'
            ], 401);
        } else {
            return response()->json([
                'respon' => 'failure',
                'message' => 'user tidak terdaftar',
                'advertiser' => $advertiser
            ]);
        }
    }
}
