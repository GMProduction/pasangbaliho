<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;
use App\models\TransaksiModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{

    public function dataTransaksi(Request $request)
    {
        try {
            $transaksi = TransaksiModel::leftjoin('balihos', 'balihos.id_baliho', 'transaksi.id_baliho')
                ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->select(
                    'balihos.id_baliho as id_baliho',
                    'balihos.nama_baliho as nama_baliho',
                    'balihos.alamat as alamat',
                    'kotas.nama_kota as nama_kota',
                    'kategoris.kategori as kategori',
                    'provinsis.nama_provinsi as nama_provinsi',
                    'transaksi.id_transaksi as id_transaksi',
                    'transaksi.harga_ditawarkan as harga_ditawarkan',
                    'transaksi.harga_deal as harga_deal',
                    'transaksi.status as status',
                    'transaksi.status_pembayaran as status_pembayaran',
                    'transaksi.tanggal_transaksi as tanggal_transaksi',
                    'transaksi.terbaca_advertiser as terbaca_advertiser',
                    'transaksi.tanggal_awal as tanggal_awal',
                    'transaksi.tanggal_akhir as tanggal_akhir',
                    'transaksi.keterangan_batal as keterangan_batal',
                    'transaksi.created_at as created_at',
                    'transaksi.updated_at as updated_at',
                    'foto_baliho.url_foto as url_foto'
                )

                ->where("id_advertiser", $request->id_advertiser)
                ->where("transaksi.status", $request->status)
                ->groupBy('transaksi.id_transaksi', 'balihos.id_baliho')
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

    public function detailTransaksi($idTransaksi)
    {
        try {

            $transTable = TransaksiModel::find($idTransaksi);
            $transTable->terbaca_advertiser = '1';
            $transTable->save();

            $transaksi = TransaksiModel::leftjoin('balihos', 'balihos.id_baliho', 'transaksi.id_baliho')
                ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->select(
                    'balihos.id_baliho as id_baliho',
                    'balihos.nama_baliho as nama_baliho',
                    'balihos.alamat as alamat',
                    'kotas.nama_kota as nama_kota',
                    'kategoris.kategori as kategori',
                    'provinsis.nama_provinsi as nama_provinsi',
                    'transaksi.id_transaksi as id_transaksi',
                    'transaksi.harga_ditawarkan as harga_ditawarkan',
                    'transaksi.harga_deal as harga_deal',
                    'transaksi.status as status',
                    'transaksi.status_pembayaran as status_pembayaran',
                    'transaksi.tanggal_transaksi as tanggal_transaksi',
                    'transaksi.terbaca_advertiser as terbaca_advertiser',
                    'transaksi.tanggal_awal as tanggal_awal',
                    'transaksi.tanggal_akhir as tanggal_akhir',
                    'transaksi.keterangan_batal as keterangan_batal',
                    'transaksi.created_at as created_at',
                    'transaksi.updated_at as updated_at',
                    'foto_baliho.url_foto as url_foto'
                )
                ->where("id_transaksi", $idTransaksi)
                ->groupBy('transaksi.id_transaksi', 'balihos.id_baliho')
                ->orderBy("created_at", "DESC")
                ->first();

            return response()->json([
                'respon' => 'success',
                'message' => 'fetch detail transaksi berhasil',
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
        $cekAdvertiser = AdvertiserModel::where('id', $request->id_advertiser)
            ->where('api_token', $request->apiToken)
            ->first();

        if ($cekAdvertiser != null) {
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
        } else {
            return response()->json([
                'respon' => 'authError',
                'message' => 'terjadi kesalahan, mohon login kembali...'
            ], 500);
        }
    }

    public function setujuiHarga(Request $request)
    {
        $cekAdvertiser = AdvertiserModel::where('id', $request->idAdvertiser)
            ->where('api_token', $request->apiToken)
            ->first();

        if ($cekAdvertiser != null) {
            try {
                $data = TransaksiModel::where('id_transaksi', $request->idTransaksi)->first();
                $transaksi = TransaksiModel::find($request->idTransaksi);
                $transaksi->status = 'negomateri';
                $transaksi->harga_deal = $data->harga_ditawarkan;
                $transaksi->save();

                return response()->json([
                    'respon' => 'success',
                    'message' => 'harga di setujui berhasil'
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
            ], 500);
        }
    }

    public function countNewTransaksi(Request $request)
    {
        if ($request->idAdv != null) {
            try {
                $newTransaksi = TransaksiModel::where("terbaca_advertiser", "0")
                    ->where("id_advertiser", $request->idAdv)
                    ->count();

                return response()->json([
                    'respon' => 'success',
                    'message' => 'count transaksi berhasil',
                    'count' => $newTransaksi
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'terjadi kesalahan ' . $e
                ], 500);
            }
        }
    }

    public function setReadAdvertiser(Request $request)
    {
        if ($request->idAdv != null) {
            try {
                $transTable = (new TransaksiModel())->getTable();

                DB::table($transTable)->where("terbaca_advertiser", "0")
                    ->where("id_advertiser", $request->idAdv)->update(['terbaca_advertiser' => '1']);

                return response()->json([
                    'respon' => 'success',
                    'message' => 'read berhasil'
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'terjadi kesalahan ' . $e
                ], 500);
            }
        }
    }


    public function setReadPerTransaksi(Request $request)
    {
        if ($request->idTransaksi != null) {
            try {
                $transTable = TransaksiModel::find($request->idTransaksi);
                $transTable->terbaca_advertiser = '1';
                $transTable->save();

                return response()->json([
                    'respon' => 'success',
                    'message' => 'read berhasil'
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'terjadi kesalahan ' . $e
                ], 500);
            }
        }
    }

    //CLIENT
    public function dataTransaksiClient(Request $request)
    {
        try {
            $transaksi = TransaksiModel::leftjoin('balihos', 'balihos.id_baliho', 'transaksi.id_baliho')
                ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->select(
                    'balihos.id_baliho as id_baliho',
                    'balihos.id_client as id_client',
                    'balihos.nama_baliho as nama_baliho',
                    'balihos.alamat as alamat',
                    'kotas.nama_kota as nama_kota',
                    'kategoris.kategori as kategori',
                    'provinsis.nama_provinsi as nama_provinsi',
                    'transaksi.id_transaksi as id_transaksi',
                    'transaksi.harga_ditawarkan as harga_ditawarkan',
                    'transaksi.harga_deal as harga_deal',
                    'transaksi.status as status',
                    'transaksi.status_pembayaran as status_pembayaran',
                    'transaksi.tanggal_transaksi as tanggal_transaksi',
                    'transaksi.terbaca_advertiser as terbaca_advertiser',
                    'transaksi.tanggal_awal as tanggal_awal',
                    'transaksi.tanggal_akhir as tanggal_akhir',
                    'transaksi.keterangan_batal as keterangan_batal',
                    'transaksi.created_at as created_at',
                    'transaksi.updated_at as updated_at',
                    'foto_baliho.url_foto as url_foto'
                )

                ->where("id_client", $request->idClient)
                ->where("transaksi.status", $request->status)
                ->groupBy('transaksi.id_transaksi', 'balihos.id_baliho')
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

    public function allDataTransaksiClient(Request $request)
    {
        try {
            $transaksi = TransaksiModel::leftjoin('balihos', 'balihos.id_baliho', 'transaksi.id_baliho')
                ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->select(
                    'balihos.id_baliho as id_baliho',
                    'balihos.id_client as id_client',
                    'balihos.nama_baliho as nama_baliho',
                    'balihos.alamat as alamat',
                    'kotas.nama_kota as nama_kota',
                    'kategoris.kategori as kategori',
                    'provinsis.nama_provinsi as nama_provinsi',
                    'transaksi.id_transaksi as id_transaksi',
                    'transaksi.harga_ditawarkan as harga_ditawarkan',
                    'transaksi.harga_deal as harga_deal',
                    'transaksi.status as status',
                    'transaksi.status_pembayaran as status_pembayaran',
                    'transaksi.tanggal_transaksi as tanggal_transaksi',
                    'transaksi.terbaca_advertiser as terbaca_advertiser',
                    'transaksi.tanggal_awal as tanggal_awal',
                    'transaksi.tanggal_akhir as tanggal_akhir',
                    'transaksi.keterangan_batal as keterangan_batal',
                    'transaksi.created_at as created_at',
                    'transaksi.updated_at as updated_at',
                    'foto_baliho.url_foto as url_foto'
                )

                ->where("id_client", $request->idClient)
                ->groupBy('transaksi.id_transaksi', 'balihos.id_baliho')
                ->orderBy("updated_at", "DESC")
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

    public function countNewTransaksiClient(Request $request)
    {
        if ($request->idClient != null) {
            try {
                $newTransaksi = TransaksiModel::leftjoin('balihos', 'balihos.id_baliho', 'transaksi.id_baliho')
                    ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                    ->select(
                        'balihos.id_baliho as id_baliho',
                        'balihos.id_client as id_client',
                        'transaksi.terbaca_client as terbaca_client'
                    )
                    ->where("terbaca_client", "0")
                    ->where("terbaca_client", $request->idClient)
                    ->count();

                return response()->json([
                    'respon' => 'success',
                    'message' => 'count transaksi berhasil',
                    'count' => $newTransaksi
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'respon' => 'failure',
                    'message' => 'terjadi kesalahan ' . $e
                ], 500);
            }
        }
    }
}
