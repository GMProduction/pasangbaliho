<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\TransaksiModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;

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
                'advertisers.nama_instansi as namaInstansi', 
                'transaksi.id_baliho as idBaliho',
                'balihos.nama_baliho as namaMedia', 
                'balihos.id_kategori as idKategori', 
                'kategoris.kategori as kategori', 
                'harga_deal',
                'transaksi.status',
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
            ->orderBy('id_transaksi', 'DESC')
            ->get();
        return response()->json($permintaan, 200);
    }

    public function getNegosiasiById (Request $r){
        $permintaan = TransaksiModel::query()
                ->join('advertisers','transaksi.id_advertiser', '=', 'advertisers.id')
                ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
                ->join('kategoris', 'balihos.id_kategori', '=', 'kategoris.id_kategori')
                ->join('clients', 'balihos.id_client', '=', 'clients.id_client')
                ->select(
                    'id_transaksi',
                    'advertisers.id as idAdvertiser', 
                    'advertisers.nama as namaAdvertiser', 
                    'advertisers.telp as telp', 
                    'advertisers.email as email', 
                    'advertisers.alamat as alamat', 
                    'advertisers.nama_instansi as namaInstansi', 
                    'transaksi.id_baliho as idBaliho',
                    'balihos.nama_baliho as namaBaliho', 
                    'balihos.id_client as idClient', 
                    'clients.nama as namaClient', 
                    'clients.nama_instansi as instansiClient', 
                    'clients.email as emailClient', 
                    'clients.telp as telpClient', 
                    'clients.alamat as alamatClient', 
                    'balihos.id_kategori as idKategori', 
                    'balihos.harga_market as hargaMarket', 
                    'balihos.harga_max as hargaMax', 
                    'balihos.tampil_harga as tampilHarga', 
                    'kategoris.kategori as kategori', 
                    'harga_deal',
                    'transaksi.status',
                    'tanggal_transaksi',
                    'tanggal_awal',
                    'tanggal_akhir'
                    )
                ->where('transaksi.status', 'LIKE', '%'.$r->status.'%' )
                ->where('id_transaksi', '=', $r->id)
                ->first();
        if ($permintaan != null) {
            return response()->json($permintaan, 200);
        }
        return response()->json(['message' => 'No Data Found'], 202);
    }

    public function patchTransaksi (Request $r) {
        $body = '';
            $status ='permintaan';
            switch ($r->status) {
                case 'permintaan':
                    $status = 'negoharga';
                    $body = 'Permintaan Penawaran harga Anda telah kami konfirmasi';
                    break;
                case 'negoharga':
                    $status = 'pembayaran';
                    $body = 'Permintaan Penawaran harga Anda telah kami konfirmasi';
                    break;
                case 'pembayaran':
                    $status = 'negomateri';
                    $body = 'Penawaran Materi Anda telah kami terima dan setujui';
                    break;
                case 'negomateri':
                    $status = 'selesai';
                    $body = 'Penawaran Materi Anda telah kami terima dan setujui';
                    break;
                case 'batal':
                    $status = 'batal';
                    $body = 'Mohon Maaf Penawaran Anda Kami Batalkan';
                    break;
                default:
                    break;
            }
        try {
            $data = [
                'status' => $status,
                'terbaca_client' => 0,
                'terbaca_advertiser' => 0,
                'keterangan' => $r->keterangan
            ];
            
            if ($r->status == 'negoharga') {
                $hargaDeal = str_replace('.','',$r->hargaDeal);
                $data = Arr::add($data, 'harga_deal', $hargaDeal);
            }
            $update = TransaksiModel::query()
            ->where('id_transaksi', '=', $r->idTransaksi)
            ->update($data);
            if ($update) {
                // sendNotifAdvertiser($r->idAdvertiser, 'Pemberitahuan Transaksi', $body);
                // sendNotifClient($r->idClient, 'Pemberitahuan Transaksi', $body);
            }
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }


    public function getMediaUsedOn (Request $r) {
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
        return response()->json($transaksi, 200);
    }

    public function sendSms () {
         

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
                'balihos.harga_market as hargaMarket', 
                'balihos.harga_max as hargaMax', 
                'balihos.tampil_harga as tampilHarga',  
                'kategoris.kategori as kategori', 
                'harga_deal',
                'transaksi.status',
                'tanggal_transaksi',
                'tanggal_awal',
                'tanggal_akhir'
            )
            ->where('transaksi.status', '=', 'pembayaran')
            ->orderBy('id_transaksi', 'DESC')
            ->get();
        return response()->json($transaksi, 200);
    }
}
