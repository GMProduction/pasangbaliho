<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\transaksiModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use App\models\NotificationModel;


class transaksiController extends Controller
{

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

    //
    public function showBerlangsung()
    {
        $id = auth()->guard('advertiser')->user()->id;


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
            ->get();

        $data = [
            'trans' => $query,
            'jumNotif' => $jumNotif
        ];

        return view('advertiser/data/transaksiBerlangsung')->with($data);
        // echo $data;
    }

    public function showDetailTransaksi(Request $r)
    {

        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

        $getNotif = $this->getJumlahNotif($id);


        $data = transaksiModel::query()
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
            ->leftJoin('balihos', 'transaksi.id_baliho', 'balihos.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->leftJoin('foto_baliho', 'transaksi.id_baliho', 'foto_baliho.id_baliho')
            ->where('id_transaksi', '=', $r->q)
            ->limit(1)
            ->get();

        $trans = [
            'data' => $data,
            'jumNotif' => $getNotif
        ];

        return view('advertiser/data/detailtransaksi')->with($trans);
        // echo $data; 
    }

    public function addTransaksi(Request $r)
    {
        $mytime = Carbon::now();
        $hariini = $mytime->toDateString();
        try {
            //code...
            $data = new transaksiModel();
            $data->id_baliho = $r->id_baliho;
            $data->id_advertiser = $r->id_advertiser;
            $data->status = 'permintaan';
            $data->tanggal_transaksi = $hariini;
            $data->tanggal_awal = $r->mulai;
            $data->tanggal_akhir = $r->selesai;
            $data->save();
            return redirect()->back()->withInput();
        } catch (\Throwable $e) {
            //throw $th;
            $exData = explode('(', $e->getMessage());
            // Alert::error('Gagal \n' . $exData[0], 'Ooops');
            echo 'Gagal \n' . $exData[0], 'Ooops';
            // return redirect()->back()->withInput();
        }
    }
}
