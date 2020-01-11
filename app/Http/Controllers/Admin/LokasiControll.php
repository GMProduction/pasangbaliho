<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\KotaModel;
use App\models\ProvinsiModel;
use Illuminate\Support\Facades\Validator;

class LokasiControll extends Controller
{
    //
    public function addProvinsi(Request $r){

        $validator = Validator::make($r->all(),[
            'namaProvinsi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 202); 
        }
        try {
            $provinsi = new ProvinsiModel();
            $provinsi->nama_provinsi = $r->namaProvinsi;
            $provinsi->save();
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }

    public function getProvinsi (){
        $provinsi = ProvinsiModel::query()
            ->select('id_provinsi', 'nama_provinsi')
            ->get();
        return response()->json($provinsi, 200);
    }

    public function addKota(Request $r){

        $validator = Validator::make($r->all(),[
            'idProvinsi' => 'required',
            'namaKota' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 202); 
        }
        try {
            $kota = new KotaModel();
            $kota->id_provinsi = $r->idProvinsi;
            $kota->nama_kota = $r->namaKota;
            $kota->save();
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }
    public function getKota (Request $r) {
        $kota = KotaModel::query()
        ->select('id_provinsi', 'id_kota', 'nama_kota')
        ->where('id_provinsi', '=', $r->id)
        ->get();

        return response()->json($kota, 200);
    }
}
