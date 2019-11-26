<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\transaksiModel;

class DashboardControll extends Controller
{
    //
    public function getPermintaanharga () {
        $transaksi = transaksiModel::query()
            ->join('advertisers','transaksi.id_advertiser', '=', 'advertisers.id')
            ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
            ->select(
                'id_transaksi',
                'id_baliho',
                'id_advertiser',
                'harga_ditawarkan',
                'harga_deal',
                'status',
                'status_pembayaran',
                'tanggal_transaksi',
                'tanggal_awal',
                'tanggal_akhir',
                'created_at',
                'updated_at'
            )
            ->where('transaksi.status', '=', 'permintaan')
            ->orderBy('id_transaksi', 'ASC')
            ->get();
        return response()->json($transaksi);
    }
}
