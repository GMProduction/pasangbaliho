<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;
use Illuminate\Support\Facades\Hash;


class AdvertiserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function loginByGoogle(Request $request)
    {

        $advertiser = AdvertiserModel::where([
            'email' => $request->email
        ])->first();

        if ($advertiser == null) {

            try {
                // $input = new AdvertiserModel();
                // $input->email = $request->email;
                // $input->nama = $request->nama;
                // $input->api_token = Hash::make($request->email);
                // $input->save();

                // $advertiser = AdvertiserModel::where([
                //     'email' => $request->email
                // ])->first(   );

                return response()->json([
                    'respon' => 'belum',
                    'message' => 'belum ada akun'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'terjadi kesalahan ' . $e
                ], 401);
            }
        } else {
            return response()->json([
                'respon' => 'success',
                'message' => 'login sukses',
                'advertiser' => $advertiser
            ]);
        }
    }


    public function registerAdvertiser(Request $request)
    {

        $advertiser = AdvertiserModel::where([
            'email' => $request->email
        ])->first();

        if ($advertiser == null) {

            try {
                $input = new AdvertiserModel();
                $input->email = $request->email;
                $input->nama = $request->nama;
                $input->telp = $request->telp;
                $input->password = Hash::make($request->password);
                $input->alamat = $request->alamat;
                $input->api_token = Hash::make($request->email);
                $input->save();

                $advertiser = AdvertiserModel::where([
                    'email' => $request->email
                ])->first();

                return response()->json([
                    'respon' => 'success',
                    'message' => 'login sukses',
                    'advertiser' => $advertiser
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'terjadi kesalahan ' . $e
                ], 401);
            }
        } else {
            return response()->json([
                'respon' => 'failure',
                'message' => 'Email sudah di pakai'
            ]);
        }
    }


    public function loginAdvertiser(Request $request)
    {

        $advertiser = AdvertiserModel::where(
            'email',
            $request->email
        )->first();

        if ($advertiser == null) {

            return response()->json([
                'respon' => 'failure',
                'message' => 'user tidak terdaftar'
            ], 401);
        } else {
            $password = $advertiser->password;

            if (Hash::check($request->password, $password)) {
                return response()->json([
                    'respon' => 'success',
                    'message' => 'login sukses',
                    'client' => $advertiser
                ]);
            } else {

                return response()->json([
                    'respon' => 'failure',
                    'message' => 'user tidak terdaftar'
                ], 401);
            }
        }
    }

    public function testMessage()
    {
        sendNotifAdvertiser(6, "tes", "testes");
    }
}
