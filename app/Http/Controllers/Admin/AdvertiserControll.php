<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            ->select('id', 'email', 'nama', 'nama_instansi', 'password', 'telp', 'alamat', 'api_token')
            ->where(function ($query) use ($id, $nama, $email, $alamat, $namaInstansi) {
                $query->where($id)
                    ->orWhere($nama)
                    ->orWhere($namaInstansi)
                    ->orWhere($email)
                    ->orWhere($alamat);
            })
            ->get();
        return response()->json($advertiser, 200);
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
            return response()->json($advertiser, 200);
        }
        return response()->json(['message' => 'No Data Found'], 202);
    }

    public function addAdvertiser (Request $r){
        $validator = Validator::make($r->all(),[
            'email' => 'required|unique:advertisers,email',
            'nama' => 'required',
            'namaInstansi' => 'required',
            'password' => 'required',
            'telp' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errorType' => 'validation', 'error' => $validator->errors()], 202);           
        }

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
            return response()->json(['Succes' => 'Advertiser Created!','data' => $advertiser], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['errorType' => 'exception', 'error' =>  $exData[0]], 500);
        }
    }

    public function editAdvertiser(Request $r){
        $id = $r->id;

        $advertiser = AdvertiserModel::where('id', $id)->first();

        if ($advertiser != null) {
            $validator = Validator::make($r->all(),[
                'email' => 'required|unique:advertisers,email,' .$r->email. ',email',
                'nama' => 'required',
                'namaInstansi' => 'required',
                'password' => 'required',
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
                    'telp' => $r->telp,
                    'alamat' => $r->alamat,
                ];
                AdvertiserModel::query()
                    ->where('id', '=', $id)
                    ->update($data);
                return response()->json(['Succes' => 'Advertiser Modified!', 'data' => $data], 200);
            } catch (\Exception $e) {
                $exData = explode('(', $e->getMessage());
                return response()->json(['errorType' => 'exception', 'error' =>  $exData[0]], 500);
            }
        }

        return response()->json(['message' => 'No Data Found'], 202);
    }

    public function deleteAdvertiser(Request $r){
        $id = $r->id;

        $advertiser = AdvertiserModel::where('id', $id)->first();

        if ($advertiser != null) {
            try {
                AdvertiserModel::query()
                ->where('id', '=', $id)
                ->delete();
                return response()->json(['Succes' => 'Advertiser Deleted !', 'data' => $advertiser], 200);
            } catch (\Exception $e) {
                $exData = explode('(', $e->getMessage());
                return response()->json(['errorType' => 'exception', 'error' =>  $exData[0]], 500);
            }
        }

        return response()->json(['message' => 'No Data Found'], 202);
    }

    public function getCountAdvertiser(){
        $qtyAdvertiser = DB::table('advertisers')->count();
        return response()->json($qtyAdvertiser, 200);
    }
}
