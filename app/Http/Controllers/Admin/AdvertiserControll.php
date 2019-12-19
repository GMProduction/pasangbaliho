<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdvertiserControll extends Controller
{
    //
    public function getAdvertiser (Request $r) {
        $id = [['id', 'LIKE', '%' .$r->index . '%']];
        $nama = [['nama', 'LIKE', '%' .$r->index . '%']];
        $namaInstansi = [['nama_instansi', 'LIKE', '%' .$r->index . '%']];
        $email = [['email', 'LIKE', '%' .$r->index . '%']];
        $alamat = [['alamat', 'LIKE', '%' .$r->index . '%']];
        $advertiser = AdvertiserModel::query()
            ->select(
                'id', 
                'email', 
                'nama', 
                'password', 
                'telp', 
                'alamat',
                'nama_instansi')
            ->where(function ($query) use ($id, $nama, $email, $alamat, $namaInstansi) {
                $query->where($id)
                    ->orWhere($nama)
                    ->orWhere($namaInstansi)
                    ->orWhere($email)
                    ->orWhere($alamat);
            })
            ->get();
            
        return response()->json($advertiser);
    }

    public function getAdvertiserById(Request $r){
        $advertiser = AdvertiserModel::query()
            ->select(
                'id', 
                'email', 
                'nama', 
                'password', 
                'telp', 
                'alamat',
                'nama_instansi'
            )
            ->where('id', '=', $r->id)
            ->first();
            
        if ($advertiser != null) {
            return response()->json($advertiser);
        }
        return null;
    }

    public function addAdvertiser (Request $r){
        try {
            $advertiser = new AdvertiserModel();
            $advertiser->email = $r->email;
            $advertiser->nama = $r->nama;
            $advertiser->nama_instansi = $r->namaInstansi;
            $advertiser->password = Hash::make($r->password);
            $advertiser->telp = $r->telp;
            $advertiser->alamat = $r->alamat;
            $advertiser->api_token = Hash::make($r->email);
            $advertiser->save();
            return response()->json([
                'sqlResponse' => true,
                'data' => $advertiser
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'data' =>  $exData[0],
                'sqlResponse' => false,
            ]);
        }
    }

    public function editAdvertiser(Request $r){
        $id = $r->id;

        try {
            $data = [
                'email' => $r->email,
                'nama' => $r->nama,
                'nama_instansi' => $r->namaInstansi,
                'telp' => $r->telp,
                'alamat' => $r->alamat,
            ];
            AdvertiserModel::query()
                ->where('id', '=', $id)
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

    public function deleteAdvertiser(Request $r){
        $id = $r->id;
        try {
            AdvertiserModel::query()
            ->where('id', '=', $id)
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

    public function getCountAdvertiser(){
        $qtyAdvertiser = DB::table('advertisers')->count();
        return response()->json($qtyAdvertiser);
    }
}
