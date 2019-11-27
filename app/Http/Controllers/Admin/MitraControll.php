<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\MitraModel;

class MitraControll extends Controller
{
    //
    public function getMitra(){
        $mitra = MitraModel::query()
            ->select(
                'id_client', 'email', 'nama', 'password', 'telp', 'alamat', 'api_token', 'email_verifed_at', 'remember_token', 'mib', 'npwp', 'no_ktp'
            )
            ->get();
        return response()->json($mitra);
    }
}
