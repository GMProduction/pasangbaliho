<?php

namespace App\Http\Controllers\Member\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use App\models\TransaksiModel;
use Illuminate\Support\Facades\DB;

class clientController extends Controller
{
    //
    function jumMedia($id){
        $media = BalihoModel::query()
            ->select(DB::raw('count(*) as count'))
            ->where('id_client','=',$id)
            ->get();
        return $media;
    }

    function jumDisewa($id){
        $sewa = TransaksiModel::query()
            ->select(DB::raw('count(*) as count'))
            ->leftjoin('balihos','balihos.id_baliho','transaksi.id_baliho')
            ->where('balihos.id_client','=',$id)
            ->where('transaksi.status','!=','selesai')
            ->get();
            return $sewa;
    }

    public function showDashboard()
    {
        if (auth()->guard('client')->check()) {
            $id = auth()->guard('client')->user()->id_client;
        }
        $media = $this->jumMedia($id);
        $sewa = $this->jumDisewa($id);

        $data = [
            'media' => $media,
            'sewa' => $sewa
        ];
        return view('client.index')->with($data);
    }
    
    public function showProfile(){
       
    }

    public function showAsset(){
        return view('client.data.asset');
    }
}