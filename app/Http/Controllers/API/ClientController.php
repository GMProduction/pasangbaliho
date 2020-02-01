<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ClientModel;
use Illuminate\Support\Facades\Hash;

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

        $client = ClientModel::where(
            'email',
            $request->email
        )->first();

        if ($client == null) {

            return response()->json([
                'respon' => 'failure',
                'message' => 'user tidak terdaftar'
            ], 401);
        } else {
            $password = $client->password;

            if (Hash::check($request->password, $password)) {
                if($client->status == "terima"){
                    return response()->json([
                        'respon' => 'success',
                        'message' => 'login sukses',
                        'client' => $client
                    ]);
                }else{
                    return response()->json([
                        'respon' => 'failure',
                        'message' => 'Akun anda belum di konfirmasi oleh admin',
                    ]);
                }
            } else {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'user tidak terdaftar'
                ], 401);
            }
        }
    }

    public function registerClient(Request $request)
    {

        $client = ClientModel::where([
            'email' => $request->email
        ])->first();

        if ($client == null) {

            try {
                $input = new ClientModel();
                $input->email = $request->email;
                $input->nama = $request->nama;
                $input->nama_instansi = $request->namaInstansi;
                $input->telp = $request->telp;
                $input->password = Hash::make($request->password);
                $input->alamat = $request->alamat;
                $input->api_token = Hash::make($request->email);
                $input->save();

                return response()->json([
                    'respon' => 'success',
                    'message' => 'Pendaftaran berhasil'
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
                'message' => 'Email sudah di pakai',
            ]);
        }
    }
}
