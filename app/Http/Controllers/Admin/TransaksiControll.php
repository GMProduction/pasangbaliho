<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\transaksiModel;

class TransaksiControll extends Controller
{
    //
    public function getPermintaanharga () {
        $permintaan = transaksiModel::query()
            ->join('advertisers','transaksi.id_advertiser', '=', 'advertisers.id')
            ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
            ->join('kategoris', 'balihos.id_kategori', '=', 'kategoris.id_kategori')
            ->select(
                'id_transaksi',
                'advertisers.id as idAdvertiser', 
                'advertisers.nama as namaAdvertiser', 
                'transaksi.id_baliho as idBaliho',
                'balihos.nama_baliho as namaBaliho', 
                'balihos.id_kategori as idKategori', 
                'kategoris.kategori as kategori', 
                'harga_ditawarkan',
                'harga_deal',
                'transaksi.status',
                'status_pembayaran',
                'tanggal_transaksi',
                'tanggal_awal',
                'tanggal_akhir'
            )
            ->where('transaksi.status', '=', 'permintaan')
            ->orderBy('id_transaksi', 'ASC')
            ->get();
        return response()->json($permintaan);
    }

    public function getPermintaanHargaById(Request $r){
        $permintaan = TransaksiModel::query()
                ->join('advertisers','transaksi.id_advertiser', '=', 'advertisers.id')
                ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
                ->join('kategoris', 'balihos.id_kategori', '=', 'kategoris.id_kategori')
                ->select(
                    'id_transaksi',
                    'advertisers.id as idAdvertiser', 
                    'advertisers.nama as namaAdvertiser', 
                    'transaksi.id_baliho as idBaliho',
                    'balihos.nama_baliho as namaBaliho', 
                    'balihos.id_kategori as idKategori', 
                    'kategoris.kategori as kategori', 
                    'harga_ditawarkan',
                    'harga_deal',
                    'transaksi.status',
                    'status_pembayaran',
                    'tanggal_transaksi',
                    'tanggal_awal',
                    'tanggal_akhir'
                    )
                ->where('transaksi.status', '=', 'permintaan')
                ->where('id_transaksi', '=', $r->id)
                ->first();
        return response()->json($permintaan);
    }

    public function setPemberianHarga (Request $r) {
        try {
            $data = [
                'harga_ditawarkan' => $r->hargaPenawaran,
                'status' => 'negoharga',
                'terbaca_client' => 0,
                'terbaca_advertiser' => 0
            ];

            TransaksiModel::query()
            ->where('id_transaksi', '=', $r->idtransaksi)
            ->update($data);
            return response()->json([
                'status' => 'ok',
                'data' => $data,
                // 'data' => '',
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'data' => $exData[0],
            ]);
        }
    }
}
