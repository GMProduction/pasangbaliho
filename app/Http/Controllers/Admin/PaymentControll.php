<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\PaymentModel;
use Illuminate\Http\Request;

class PaymentControll extends Controller
{
    //
    public function getPayment(Request $r){
        $id = [['payment.id_transaksi', 'LIKE', '%' .$r->index . '%']];
        $namaAdvertiser = [['advertisers.nama', 'LIKE', '%' .$r->index . '%']];
        $namaMedia = [['balihos.nama_baliho', 'LIKE', '%' .$r->index . '%']];
        $payment = PaymentModel::query()
                    ->join('transaksi', 'payment.id_transaksi', '=', 'transaksi.id_transaksi')
                    ->join('advertisers','transaksi.id_advertiser', '=', 'advertisers.id')
                    ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
                    ->select(
                        'payment.id',
                        'payment.id_transaksi as idTransaksi',
                        'transaksi.id_advertiser as idAdvetiser',
                        'advertisers.nama as namaAdvertiser',
                        'balihos.nama_baliho as namaBaliho',
                        'advertisers.telp as telp', 
                        'advertisers.email as email', 
                        'advertisers.nama_instansi as namaInstansi', 
                        'transaksi.harga_deal as hargaDeal',
                        'type',
                        'nominal',
                        'payment.status'
                    )
                    ->where(function ($query) use ($id, $namaAdvertiser, $namaMedia) {
                        $query->where($id)
                            ->orWhere($namaAdvertiser)
                            ->orWhere($namaMedia);
                    })
                    ->where('payment.status', 'LIKE', '%'.$r->status.'%')
                    ->where('payment.type', 'LIKE', '%'.$r->type.'%')
                    ->orderBy('payment.id', 'ASC')
                    ->get();
        return response()->json($payment, 200);
    }


}
