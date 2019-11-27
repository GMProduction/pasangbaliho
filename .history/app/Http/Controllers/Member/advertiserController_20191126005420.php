<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\advertiserModel;
use App\models\NotificationModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Master\transaksiModel;

class advertiserController extends Controller
{
    //




    public function notif($n)
    {
        $c = Carbon::now();
        # code...
        $notif = NotificationModel::query()
            ->where('id_advertiser', '=', $n)
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        return $notif;
    }

    public function getJumlahNotif($id)
    {
        $query = DB::table('notifikasi_advertiser')
            ->select(DB::raw('count(*) as count'))
            ->where('id_advertiser', '=', $id)
            ->get();
        return $query;
    }

    public function showDashboard()
    {
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
            ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->leftJoin('foto_baliho', 'transaksi.id_baliho', 'foto_baliho.id_baliho')
            ->groupBy('transaksi.id_transaksi', 'balihos.id_baliho')
            // ->leftJoin('foto_baliho', function($join){
            //     $join->on('transaksi.id_baliho','=','foto_baliho.id_baliho')
            //         ->limit(1);
            // })
            // ->leftJoin('foto_baliho','transaksi.id_baliho','foto_baliho.id_baliho')
            ->where('id_advertiser', '=', $id)
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

        $getNotif = $this->getJumlahNotif($id);
        $data = [
            'jumNotif' => $getNotif,
            'trans' => $query,
            'jumTrans' => $jumTrans,
            'jumIklan' => $jumIklan
        ];


        return view('advertiser.index')->with($data);
    }

    public function showDetailProfil($id)
    {
        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

        $getNotif = $this->getJumlahNotif($id);


        $query = advertiserModel::query()
            ->where('id', '=', $id)
            ->get();

        $data = [
            'profile' => $query,
            'jumNotif' => $getNotif
        ];

        return view('advertiser.data.profil')->with($data);
        // echo $data;
    }



    public function showNotif()
    {
        $id = auth()->guard('advertiser')->user()->id;
        $notif = NotificationModel::query()
            ->where('id_advertiser', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        $getNotif = $this->getJumlahNotif($id);
        $data = [
            'notif' => $notif,
            'jumNotif' => $getNotif
        ];
        return view('advertiser.data.notif')->with($data);
    }
}
