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
    public function getProvinsi (Request $r){
        $id = [['id_provinsi', 'LIKE', '%' .$r->index . '%']];
        $nama = [['nama_provinsi', 'LIKE', '%' .$r->index . '%']];
        $provinsi = ProvinsiModel::query()
            ->select('id_provinsi', 'nama_provinsi')
            ->where(function ($query) use ($nama, $id){
                $query->orWhere($id)
                ->orWhere($nama);
            })
            ->get();
        return response()->json($provinsi, 200);
    }

    public function getProvinsiById (Request $r){
        
        $provinsi = ProvinsiModel::query()
            ->select('id_provinsi', 'nama_provinsi')
            ->where('id_provinsi', '=', $r->id)
            ->first();
        if ($provinsi != null) {
            return response()->json($provinsi, 200);
        }
        return response()->json(['message' => 'No Data Found!'], 202);
    }

    public function getKota(Request $r) {
        $namaProvinsi = [['provinsis.nama_provinsi', 'LIKE', '%' .$r->index . '%']];
        $nama = [['nama_kota', 'LIKE', '%' .$r->index . '%']];
        $id = [['id_kota', 'LIKE', '%' .$r->index . '%']];
        $kota = KotaModel::query()
                ->join('provinsis', 'kotas.id_provinsi', '=', 'provinsis.id_provinsi')
                ->select('provinsis.id_provinsi', 'provinsis.nama_provinsi' , 'id_kota', 'nama_kota')
                ->where(function ($query) use ($namaProvinsi, $nama, $id){
                        $query->where($namaProvinsi)
                        ->orWhere($id)
                        ->orWhere($nama);
                    })
                ->get();
        return response()->json($kota, 200);
    }

    public function getKotaById(Request $r) {
        $kota = KotaModel::query()
                ->join('provinsis', 'kotas.id_provinsi', '=', 'provinsis.id_provinsi')
                ->select('provinsis.id_provinsi', 'provinsis.nama_provinsi' , 'id_kota', 'nama_kota')
                ->where('id_kota', '=', $r->id)
                ->first();
        if ($kota != null) {
            return response()->json($kota, 200);
        }
        return response()->json(['message' => 'No Data Found!'], 202);
    }

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
    
}
