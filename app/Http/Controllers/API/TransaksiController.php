<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use App\models\FotoBalihoModel;
use App\models\TransaksiModel;
use Carbon\Carbon;

class TransaksiController extends Controller
{

    public function dataTransaksi(Request $request)
    {
        try {
            $transaksi = TransaksiModel::join('balihos', 'balihos.id_baliho', 'transaksi.id_baliho')
                ->join('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->select(
                    'balihos.id_baliho as id_baliho',
                    'balihos.nama_baliho as nama_baliho',
                    'balihos.alamat as alamat',
                    'balihos.kota as kota',
                    'balihos.provinsi as provinsi',
                    'transaksi.id_transaksi as id_transaksi',
                    'transaksi.harga_ditawarkan as harga_ditawarkan',
                    'transaksi.harga_deal as harga_deal',
                    'transaksi.status as status',
                    'transaksi.status_pembayaran as status_pembayaran',
                    'transaksi.tanggal_transaksi as tanggal_transaksi',
                    'transaksi.tanggal_awal as tanggal_awal',
                    'transaksi.tanggal_akhir as tanggal_akhir',
                    'transaksi.created_at as created_at',
                    'transaksi.updated_at as updated_at',
                    'foto_baliho.url_foto as url_foto'
                )
                ->where("id_advertiser", $request->id_advertiser)
                ->where("status", $request->status)
                ->orderBy("created_at", "DESC")
                ->paginate(20);

            return response()->json([
                'respon' => 'success',
                'message' => 'fetch data transaksi berhasil',
                'transaksi' => $transaksi
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }


    public function ajukanPenawaran(Request $request)
    {
        try {
            $transaksi = new TransaksiModel();
            $transaksi->id_baliho = $request->id_baliho;
            $transaksi->id_advertiser = $request->id_advertiser;
            $transaksi->status = "permintaan";
            $transaksi->tanggal_transaksi = Carbon::now()->format('Y-m-d');
            $transaksi->tanggal_awal = $request->tanggal_awal;
            $transaksi->tanggal_akhir = $request->tanggal_akhir;
            $transaksi->save();

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
    }
}
