<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\PaymentModel;
use Illuminate\Http\Request;
use App\models\TransaksiModel;
use Illuminate\Support\Facades\DB;

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
                        'vendor',
                        'atas_nama',
                        'no_rekening',
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
    public function getPaymentById(Request $r){
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
                        'advertisers.alamat as alamat', 
                        'advertisers.nama_instansi as namaInstansi', 
                        'transaksi.harga_deal as hargaDeal',
                        'type',
                        'nominal',
                        'vendor',
                        'atas_nama',
                        'no_rekening',
                        'payment.status'
                    )
                    ->where('payment.id', '=', $r->id)
                    ->where('payment.status', 'LIKE', '%'.$r->status.'%')
                    ->where('payment.type', 'LIKE', '%'.$r->type.'%')
                    ->first();
        if($payment != null){
            return response()->json($payment, 200);
        }
        return response()->json(['message' => 'No Data Found'], 202);
    }

    public function getSaldoPayment(){
        $transaksi = TransaksiModel::query()
            ->join('advertisers','transaksi.id_advertiser', '=', 'advertisers.id')
            ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
            ->join('kategoris', 'balihos.id_kategori', '=', 'kategoris.id_kategori')
            ->select(
                'id_transaksi',
                'advertisers.id as idAdvertiser', 
                'advertisers.nama as namaAdvertiser', 
                'advertisers.nama_instansi as namaInstansi', 
                'transaksi.id_baliho as idBaliho',
                'balihos.nama_baliho as namaMedia', 
                'balihos.id_kategori as idKategori', 
                'kategoris.kategori as kategori', 
                'transaksi.status',
                'tanggal_transaksi',
                'tanggal_awal',
                'tanggal_akhir',
                'harga_deal',
                DB::raw('(IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0)) as Pembayaran'),
                DB::raw('transaksi.harga_deal - (IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0)) as saldo'),
                DB::raw('(SELECT IF((transaksi.harga_deal - (IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0))) > 0,"Belum Lunas", "Lunas")) as paymentStatus')
            )
            ->get();
        return response()->json($transaksi, 200);
    }
    public function getSaldoPaymentById(Request $r){
        $transaksi = TransaksiModel::query()
            ->join('advertisers','transaksi.id_advertiser', '=', 'advertisers.id')
            ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
            ->join('kategoris', 'balihos.id_kategori', '=', 'kategoris.id_kategori')
            ->select(
                'id_transaksi',
                'advertisers.id as idAdvertiser', 
                'advertisers.nama as namaAdvertiser', 
                'advertisers.nama_instansi as namaInstansi', 
                'advertisers.telp as telp', 
                'advertisers.email as email',
                'transaksi.id_baliho as idBaliho',
                'balihos.nama_baliho as namaBaliho', 
                'balihos.id_kategori as idKategori', 
                'balihos.harga_market as hargaMarket', 
                'balihos.harga_max as hargaMax', 
                'balihos.tampil_harga as tampilHarga',
                'kategoris.kategori as kategori', 
                'transaksi.status',
                'tanggal_transaksi',
                'tanggal_awal',
                'tanggal_akhir',
                'harga_deal',
                DB::raw('(IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0)) as Pembayaran'),
                DB::raw('transaksi.harga_deal - (IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0)) as saldo'),
                DB::raw('(SELECT IF((transaksi.harga_deal - (IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0))) > 0,"Belum Lunas", "Lunas")) as paymentStatus')
            )
            ->where('id_transaksi', '=', $r->id)
            ->first();
            if ($transaksi != null) {
                return response()->json($transaksi, 200);
            }
            return response()->json(['message' => 'No Data Found'], 202);
    }

    public function patchPayment(Request $r){
        try {
            $data = [
                'status' => $r->status,
                'keterangan' => $r->keterangan
            ];
            
            PaymentModel::query()
            ->where('id', '=', $r->id)
            ->update($data);
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }

}
