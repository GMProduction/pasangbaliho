<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\TransaksiModel;
use Carbon\Carbon;

class TransaksiControll extends Controller
{
    //
    public function getNegosiasi (Request $r) {
        $id = [['id_transaksi', 'LIKE', '%' .$r->index . '%']];
        $namaAdvertiser = [['advertisers.nama', 'LIKE', '%' .$r->index . '%']];
        $namaMedia = [['balihos.nama_baliho', 'LIKE', '%' .$r->index . '%']];
        $kategori = [['kategoris.kategori', 'LIKE', '%' .$r->index . '%']];
        $permintaan = TransaksiModel::query()
            ->join('advertisers','transaksi.id_advertiser', '=', 'advertisers.id')
            ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
            ->join('kategoris', 'balihos.id_kategori', '=', 'kategoris.id_kategori')
            ->select(
                'id_transaksi',
                'advertisers.id as idAdvertiser', 
                'advertisers.nama as namaAdvertiser', 
                'transaksi.id_baliho as idBaliho',
                'balihos.nama_baliho as namaMedia', 
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
            ->where(function ($query) use ($id, $namaAdvertiser, $namaMedia, $kategori) {
                $query->where($id)
                    ->orWhere($namaAdvertiser)
                    ->orWhere($namaMedia)
                    ->orWhere($kategori);
            })
            ->where('transaksi.status', 'LIKE', '%'.$r->status.'%')
            ->orderBy('id_transaksi', 'ASC')
            ->get();
        return response()->json($permintaan);
    }

    public function getNegosiasiById (Request $r){
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
                ->where('transaksi.status', 'LIKE', '%'.$r->status.'%' )
                ->where('id_transaksi', '=', $r->id)
                ->first();
        if ($permintaan != null) {
            return response()->json($permintaan);
        }
        return null;
    }

    public function postPrice (Request $r) {
        try {
            $data = [
                'status' => 'permintaan',
                'terbaca_client' => 0,
                'terbaca_advertiser' => 0
            ];

            $update = TransaksiModel::query()
            ->where('id_transaksi', '=', $r->idTransaksi)
            ->update($data);
            // if ($update) {
            //     sendNotifAdvertiser('6', 'Pemberitahuan', 'Permintaan Harga Telah Dikirim');
            // }
            return response()->json([
                'status' => 'ok',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'data' => $exData[0],
            ]);
        }
    }

    public function getNegosiasiHarga() {
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
            ->where('transaksi.status', '=', 'negoharga')
            ->orderBy('id_transaksi', 'ASC')
            ->get();
        return response()->json($permintaan);
    }

    public function getNegosiasiHargaById(Request $r){
        $negoharga = TransaksiModel::query()
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
                ->where('transaksi.status', '=', 'negoharga')
                ->where('id_transaksi', '=', $r->id)
                ->first();
        return response()->json($negoharga);
    }

    public function setHargaDeal (Request $r) {
        try {
            $data = [
                'harga_deal' => $r->hargaDeal,
                'status' => 'negomateri',
                'terbaca_client' => 0,
                'terbaca_advertiser' => 0
            ];

            TransaksiModel::query()
            ->where('id_transaksi', '=', $r->idtransaksi)
            ->update($data);
            return response()->json([
                'status' => 'ok',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'data' => $exData[0],
            ]);
        }
    }

    public function getNegosiasiMateri() {
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
            ->where('transaksi.status', '=', 'negomateri')
            ->orderBy('id_transaksi', 'ASC')
            ->get();
        return response()->json($permintaan);
    }

    public function getNegosiasiMateriById(Request $r){
        
        $negoharga = TransaksiModel::query()
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
                ->where('transaksi.status', '=', 'negomateri')
                ->where('id_transaksi', '=', $r->id)
                ->first();
        return response()->json($negoharga);
    }

    public function setFinisNego (Request $r) {
        try {
            $data = [
                'status' => 'pembayaran',
                'terbaca_client' => 0,
                'terbaca_advertiser' => 0
            ];

            TransaksiModel::query()
            ->where('id_transaksi', '=', $r->idtransaksi)
            ->update($data);
            return response()->json([
                'status' => 'ok',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'data' => $exData[0],
            ]);
        }
    }

    public function getBalihoOnUsed (Request $r) {
        $now = Carbon::now()->format('Y-m-d');
        $transaksi = TransaksiModel::query()
            ->select(
                'id_transaksi',
                'id_baliho',
                'tanggal_awal',
                'tanggal_akhir',
                'status'
            )
            ->where('tanggal_akhir', '>', $now)
            ->where('status', '=' ,'selesai')
            ->where('id_baliho', '=', $r->id)
            ->get();
        return response()->json($transaksi);
    }
}
