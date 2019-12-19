<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ClientModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MitraControll extends Controller
{
    //
    public function getMitra(Request $r){
        $idmitra = [['id_client', 'LIKE', '%' .$r->index . '%']];
        $namamitra = [['nama', 'LIKE', '%' .$r->index . '%']];
        $namaInstansi = [['nama_instansi', 'LIKE', '%' .$r->index . '%']];
        $email = [['email', 'LIKE', '%' .$r->index . '%']];
        $alamat = [['alamat', 'LIKE', '%' .$r->index . '%']];
        $mitra = ClientModel::query()
            ->select(
                'id_client',
                'email',
                'nama', 
                'nama_instansi',
                'password',
                'no_ktp', 
                'npwp', 
                'nib', 
                'telp',
                'alamat',
                'status',
                'api_token',
                'email_verifed_at', 
                'remember_token'
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

    public function getMitraById(Request $r){
        $mitra = ClientModel::query()
            ->select(
                'id_client',
                'email',
                'nama', 
                'nama_instansi',
                'password',
                'no_ktp', 
                'npwp', 
                'nib', 
                'telp',
                'alamat',
                'status',
                'api_token',
                'email_verifed_at', 
                'remember_token'
            )
            ->where('id_client', '=', $r->id)
            ->first();
            
        if ($mitra != null) {
            return response()->json($mitra);
        }
        return null;
    }

    public function addMitra (Request $r){
        try {
            $mitra = new ClientModel();
            $mitra->email = $r->email;
            $mitra->nama = $r->nama;
            $mitra->nama_instansi = $r->namaInstansi;
            $mitra->password = Hash::make($r->password);
            $mitra->no_ktp = $r->noKtp;
            $mitra->npwp = $r->npwp;
            $mitra->nib = $r->nib;
            $mitra->telp = $r->telp;
            $mitra->alamat = $r->alamat;
            $mitra->status = 'terima';
            $mitra->api_token = Hash::make($r->email);
            $mitra->save();
            return response()->json([
                'sqlResponse' => true,
                'data' => $mitra
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'data' =>  $exData[0],
                'sqlResponse' => false,
            ]);
        }
    }

    public function editMitra(Request $r){
        $id = $r->idClient;

        try {
            $data = [
                'email' => $r->email,
                'nama' => $r->nama,
                'nama_instansi' => $r->namaInstansi,
                'no_ktp' => $r->noKtp,
                'npwp' => $r->npwp,
                'nib' => $r->nib,
                'telp' => $r->telp,
                'alamat' => $r->alamat,
            ];
            ClientModel::query()
                ->where('id_client', '=', $id)
                ->update($data);
            return response()->json([
                'sqlResponse' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'data' =>  $exData[0],
                'sqlResponse' => false,
            ]);
        }
    }

    public function deleteMitra(Request $r){
        $id = $r->id;
        try {
            ClientModel::query()
            ->where('id_client', '=', $id)
            ->delete();
            return response()->json([
                'sqlResponse' => true,
                'data' => $id
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'data' =>  $exData[0],
                'sqlResponse' => false,
            ]);
        }
    }
    public function getCountMitra(){
        $qtyMitra = DB::table('clients')->count();
        return response()->json($qtyMitra);
    }
}
