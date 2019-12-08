<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Master\transaksiModel;
use Illuminate\Support\Carbon;
use App\models\NotificationModel;
use Illuminate\Support\Facades\DB;

class berjalanController extends Controller
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
    public function dataBerjalan()
    {
        $id = auth()->guard('advertiser')->user()->id;

        $c = Carbon::now();
        $jumNotif = $this->getJumlahNotif($id);

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
            ->where('transaksi.status','=','selesai')
            ->where('transaksi.tanggal_akhir','>=',$c)
            ->get();    

        $data = [
            'trans' => $query,
            'jumNotif' => $jumNotif
        ];

        return view('advertiser/data/berjalan')->with($data);
        // echo $data;
    }
}
