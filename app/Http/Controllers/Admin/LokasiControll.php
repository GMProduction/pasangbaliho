<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\KotaModel;
use App\models\ProvinsiModel;

class LokasiControll extends Controller
{
    //
    public function getProvinsi (){
        $provinsi = ProvinsiModel::query()
            ->select('id_provinsi', 'nama_provinsi')
            ->get();
        return response()->json($provinsi);
    }

    public function getKota (Request $r) {
        $kota = KotaModel::query()
        ->select('id_provinsi', 'id_kota', 'nama_kota')
        ->where('id_provinsi', '=', $r->id)
        ->get();

        return response()->json($kota);
    }
}
