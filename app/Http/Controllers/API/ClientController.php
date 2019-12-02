<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ClientModel;



class ClientController extends Controller
{
    public $successStatus = 200;

    public function cekLoginClient(Request $request)
    {
        try {
            $client = ClientModel::where([
                'id_client' => $request->idClient
            ])->first();

            if ($client != null) {
                $token = $client->api_token;
                if ($token == $request->apiToken) {
                    return response()->json([
                        'respon' => 'success',
                        'message' => 'cek client sukses',
                        'client' => $client
                    ]);
                } else {
                    return response()->json([
                        'respon' => 'failure',
                        'message' => 'token not match '
                    ], 401);
                }
            } else {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'belum terdaftar'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 401);
        }
    }

    public function loginClient(Request $request)
    {
        $client = ClientModel::where([
            'email' => $request->email,
            'password' => $request->password
        ])
            ->first();

        if ($client == null) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'user tidak terdaftar'
            ], 401);
        } else {
            return response()->json([
                'respon' => 'success',
                'message' => 'login sukses',
                'client' => $client
            ]);
        }
    }
}
