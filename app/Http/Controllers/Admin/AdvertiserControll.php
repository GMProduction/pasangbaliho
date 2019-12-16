<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;
use Illuminate\Support\Facades\DB;

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
    public function getCountAdvertiser(){
        $qtyAdvertiser = DB::table('advertisers')->count();
        return response()->json($qtyAdvertiser);
    }
}
