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
