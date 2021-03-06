<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\advertiserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Master\transaksiModel;

class advertiserController extends Controller
{
    //



   

    public function showDashboard()
    {
        $mytime = Carbon::now();
        $hariini = $mytime->toDateString();
 


        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

        $query = transaksiModel::query()
            ->select(
                'transaksi.*',
                'balihos.id_baliho as id_baliho',
                'balihos.nama_baliho as nama_baliho',
                'balihos.alamat as alamat',
                'kotas.nama_kota as kota',
                'kategoris.kategori as kategori',
                'provinsis.nama_provinsi as provinsi',
                'balihos.harga_client as harga_client',
                'balihos.lebar as lebar',
                'balihos.tinggi as tinggi',
                'balihos.orientasi as orientasi',
                'balihos.harga_market as harga_market',
                'balihos.deskripsi as deskripsi',
                'foto_baliho.url_foto as url_foto'
            )
            // DB::raw('(select url_foto from foto_baliho, transaksi where foto_baliho.id_baliho = transaksi.id_baliho limit 1) as url_foto'))
            ->leftJoin('balihos', 'transaksi.id_baliho', 'balihos.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->leftJoin('foto_baliho', 'transaksi.id_baliho', 'foto_baliho.id_baliho')
            ->groupBy('transaksi.id_transaksi', 'balihos.id_baliho')
            // ->leftJoin('foto_baliho', function($join){
            //     $join->on('transaksi.id_baliho','=','foto_baliho.id_baliho')
            //         ->limit(1);
            // })
            // ->leftJoin('foto_baliho','transaksi.id_baliho','foto_baliho.id_baliho')
            ->where('id_advertiser', '=', $id)
            ->where('transaksi.status','!=','selesai')
            ->orwhere('transaksi.tanggal_awal', '>=', $hariini)
            ->orderBy('transaksi.created_at', 'desc')
            ->get();

        $jumTrans = DB::table('transaksi')
            ->select(DB::raw('count(*) as count'))
            ->where('id_advertiser', '=', $id)
            ->where('status', '!=', 'selesai')
            ->get();

        $jumIklan = DB::table('transaksi')
            ->select(DB::raw('count(*) as count'))
            ->where('id_advertiser', '=', $id)
            ->where('status', '=', 'selesai')
            ->get();

        $data = [
            'trans' => $query,
            'jumTrans' => $jumTrans,
            'jumIklan' => $jumIklan
        ];


        return view('advertiser.index')->with($data);
    }

    public function showDetailProfil($id)
    {
    


        $query = advertiserModel::query()
            ->where('id', '=', $id)
            ->get();

        $data = [
            'profile' => $query
        ];

        return view('advertiser.data.profil')->with($data);
        // echo $data;
    }



    
}
