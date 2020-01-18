<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;
use App\models\PaymentModel;
use App\models\TransaksiModel;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function getSaldoPayment(Request $request)
    {
        $transaksi = TransaksiModel::query()
            ->join('advertisers', 'transaksi.id_advertiser', '=', 'advertisers.id')
            ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
            ->join('kategoris', 'balihos.id_kategori', '=', 'kategoris.id_kategori')
            ->join('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->join('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->join('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->select(
                'id_transaksi',
                'advertisers.id as advertisers',

                'kotas.nama_kota as nama_kota',
                'foto_baliho.url_foto as url_foto',
                'kategoris.kategori as kategori',
                'provinsis.nama_provinsi as nama_provinsi',
                'advertisers.nama as namaAdvertiser',
                'advertisers.nama_instansi as namaInstansi',
                'transaksi.id_baliho as id_baliho',
                'balihos.nama_baliho as nama_baliho',
                'balihos.id_kategori as id_kategori',
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
            ->where("id_transaksi", $request->idTransaksi)
            ->first();

        if ($transaksi != null) {
            return response()->json([
                'respon' => 'success',
                'message' => 'fetch transaksi berhasil',
                'transaksi' => $transaksi
            ], 200);
        }
        return response()->json([
            'respon' => 'empty',
            'message' => 'no data'
        ], 202);
    }

    public function konfirmasiPembayaran(Request $request)
    {
        $cekAdvertiser = AdvertiserModel::where('id', $request->idAdvertiser)
            ->where('api_token', $request->apiToken)
            ->first();

        if ($cekAdvertiser != null) {
            try {
                $payment = new PaymentModel();
                $payment->id_transaksi = $request->idTransaksi;
                $payment->type = "Manual Payment";
                $payment->nominal = $request->nominal;
                $payment->vendor = $request->vendor;
                $payment->atas_nama = $request->atasNama;
                $payment->no_rekening = $request->nomorRekening;
                $payment->save();

                return response()->json([
                    'respon' => 'success',
                    'message' => 'pengajuan permintaan berhasil'
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'terjadi kesalahan ' . $e
                ], 500);
            }
        } else {
            return response()->json([
                'respon' => 'authError',
                'message' => 'terjadi kesalahan, mohon login kembali...'
            ], 401);
        }
    }
}
