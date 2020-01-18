<?php

namespace App\Http\Controllers\Member\Client;

use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use App\models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class disewaController extends Controller
{
    //
    public function showDisewa()
    {

        if (auth()->guard('client')->check()) {
            $id = auth()->guard('client')->user()->id_client;
        }

        $disewa = TransaksiModel::query()
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
            'foto_baliho.url_foto as url_foto',
            'advertisers.nama as nama_advertiser',
            'foto_baliho.url_foto as url_foto'

        )
            // DB::raw('(select url_foto from foto_baliho, transaksi where foto_baliho.id_baliho = transaksi.id_baliho limit 1) as url_foto'))
            // ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftJoin('balihos', 'transaksi.id_baliho', 'balihos.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->leftJoin('foto_baliho', 'transaksi.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('advertisers', 'transaksi.id_advertiser', 'advertisers.id')
            ->leftjoin('clients','balihos.id_client','clients.id_client')
            ->groupBy('transaksi.id_transaksi', 'balihos.id_baliho')
        // ->leftJoin('foto_baliho', function($join){
        //     $join->on('transaksi.id_baliho','=','foto_baliho.id_baliho')
        //         ->limit(1);
        // })
        // ->leftJoin('foto_baliho','transaksi.id_baliho','foto_baliho.id_baliho')
            ->where('balihos.id_client', '=', $id)
            ->where('transaksi.status','!=','permintaan')
            ->where('transaksi.status','!=','pembayaran')
            ->where('transaksi.status','!=','negoharga')
            ->where('transaksi.status','!=','batal')
            ->paginate(10);
        return view('client/data/disewa', compact('disewa'));
    }
}
