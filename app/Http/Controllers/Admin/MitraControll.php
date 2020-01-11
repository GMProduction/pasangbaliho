<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ClientModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            ->where('status', 'LIKE', '%'. $r->status .'%')
            ->where(function ($query) use ($idmitra, $namamitra, $email, $alamat, $namaInstansi) {
                $query->where($idmitra)
                    ->orWhere($namamitra)
                    ->orWhere($namaInstansi)
                    ->orWhere($email)
                    ->orWhere($alamat);
            })
            ->get();
        return response()->json($mitra, 200);
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
            ->where('status', 'LIKE', '%'. $r->status .'%')
            ->where('id_client', '=', $r->id)
            ->first();
            
        if ($mitra != null) {
            return response()->json($mitra, 200);
        }
        return response()->json(['message' => 'No Data Found'], 200);
    }

    public function addMitra (Request $r){

        $validator = Validator::make($r->all(),[
            'email' => 'required|unique:clients,email',
            'nama' => 'required',
            'namaInstansi' => 'required',
            'password' => 'required',
            'noKtp' => 'required',
            'npwp' => 'required',
            'nib' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errorType' => 'validation','error' => $validator->errors()], 202);           
        }
        
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
            return response()->json(['Succes' => 'Mitra Created!','data' => $mitra], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['errorType' => 'exception', 'error' =>  $exData[0]], 500);
        }
    }

    public function editMitra(Request $r){
        $id = $r->idClient;
        $mitra = ClientModel::where('id_client', $id)->first();

        if ($mitra != null) {
            $validator = Validator::make($r->all(),[
                'email' => 'required|unique:clients,email,' .$r->email. ',email',
                'nama' => 'required',
                'namaInstansi' => 'required',
                'password' => 'required',
                'noKtp' => 'required',
                'npwp' => 'required',
                'nib' => 'required',
                'telp' => 'required',
                'alamat' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errorType' => 'validation', 'error' => $validator->errors()], 202);           
            }
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
                    return response()->json(['Succes' => 'Mitra Modified!', 'data' => $data], 200);
            } catch (\Exception $e) {
                $exData = explode('(', $e->getMessage());
                return response()->json(['errorType' => 'exception', 'error' =>  $exData[0]], 500);
            }
        }
        return response()->json(['message' => 'No Data Found'], 200);
    }

    public function deleteMitra($id){
        $mitra = ClientModel::where('id_client', $id)->first();
        if ($mitra != null) {
            try {
                ClientModel::query()
                ->where('id_client', '=', $id)
                ->delete();
                return response()->json(['Succes' => 'Mitra Deleted !', 'data' => $mitra], 200);
            } catch (\Exception $e) {
                $exData = explode('(', $e->getMessage());
                return response()->json(['errorType' => 'exception', 'error' =>  $exData[0]], 500);
            }
        }
        return response()->json(['message' => 'No Data Found', 'id' => $id], 202);
    }

    public function getCountMitra(){
        $qtyMitra = DB::table('clients')->count();
        return response()->json($qtyMitra, 200);
    }
}
