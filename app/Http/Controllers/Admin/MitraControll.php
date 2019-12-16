<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\MitraModel;
use Illuminate\Support\Facades\DB;

class MitraControll extends Controller
{
    //
    public function getMitra(Request $r){
        $idmitra = [['id_client', 'LIKE', '%' .$r->index . '%']];
        $namamitra = [['nama', 'LIKE', '%' .$r->index . '%']];
        $namaInstansi = [['nama_instansi', 'LIKE', '%' .$r->index . '%']];
        $email = [['email', 'LIKE', '%' .$r->index . '%']];
        $alamat = [['alamat', 'LIKE', '%' .$r->index . '%']];
        $mitra = MitraModel::query()
            ->select(
                'id_client', 
                'email', 
                'nama', 
                'nama_instansi', 
                'status',
                'password', 
                'telp', 
                'alamat', 
                'api_token', 
                'email_verifed_at', 
                'remember_token', 
                'mib', 
                'npwp', 
                'no_ktp'
            )
            ->where(function ($query) use ($idmitra, $namamitra, $email, $alamat, $namaInstansi) {
                $query->where($idmitra)
                    ->orWhere($namamitra)
                    ->orWhere($namaInstansi)
                    ->orWhere($email)
                    ->orWhere($alamat);
            })
            ->get();
        return response()->json($mitra);
    }

    public function getCountMitra(){
        $qtyMitra = DB::table('clients')->count();
        return response()->json($qtyMitra);
    }
}
