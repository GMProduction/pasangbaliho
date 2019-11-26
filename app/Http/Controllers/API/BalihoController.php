<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use App\models\FotoBalihoModel;
use App\models\TransaksiModel;
use Carbon\Carbon;

class BalihoController extends Controller
{

    public function dataListAllBaliho()
    {

        try {
            $baliho = BalihoModel::leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->select(
                    'balihos.id_baliho as id_baliho',
                    'balihos.nama_baliho as nama_baliho',
                    'balihos.alamat as alamat',
                    'kotas.nama_kota as kota',
                    'kategoris.kategori as kategori',
                    'provinsis.nama_provinsi as provinsi',
                    'balihos.harga_client as harga_client',
                    'balihos.lebar as lebar',
                    'balihos.tinggi as tinggi',
                    'balihos.orientasi as orientasi',
                    'balihos.harga_market as harga_market',
                    'balihos.deskripsi as deskripsi',
                    'foto_baliho.url_foto as url_foto'
                )
                ->where('status', 'publish')
                ->groupBy('balihos.id_baliho')
                ->paginate(20);

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data baliho',
                'baliho' => $baliho
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }

    public function dataListBalihoSearchGlobal(Request $request)
    {
        $tambahan = $request->tambahan;
        try {
            $baliho = BalihoModel::leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->select(
                    'balihos.id_baliho as id_baliho',
                    'balihos.nama_baliho as nama_baliho',
                    'balihos.alamat as alamat',
                    'kotas.nama_kota as kota',
                    'kategoris.kategori as kategori',
                    'provinsis.nama_provinsi as provinsi',
                    'balihos.harga_client as harga_client',
                    'balihos.lebar as lebar',
                    'balihos.tinggi as tinggi',
                    'balihos.venue as venue',
                    'balihos.orientasi as orientasi',
                    'balihos.harga_market as harga_market',
                    'balihos.deskripsi as deskripsi',
                    'foto_baliho.url_foto as url_foto'
                )
                ->where('status', 'publish')
                ->where("nama_kota", "LIKE", $request->kota)
                ->where("kategori", "LIKE", $request->kategori)
                ->where(function ($q) use ($tambahan) {
                    $q->where('alamat', 'LIKE', '%' . $tambahan . '%')
                        ->orwhere('venue', 'LIKE', '%' . $tambahan . '%')
                        ->orwhere('deskripsi', 'LIKE', '%' . $tambahan . '%')
                        ->orwhere('nama_provinsi', 'LIKE', '%' . $tambahan . '%');
                })
                ->groupBy('balihos.id_baliho')
                ->orderBy($request->sortby, $request->urutan)
                ->paginate(20);

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data baliho',
                'baliho' => $baliho
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }

    public function showDetailBaliho($id)
    {
        try {
            $baliho = BalihoModel::leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->where('id_baliho', $id)
                ->first();

            $fotos = FotoBalihoModel::Where('id_baliho', $id)
                ->get();

            $transaksi = TransaksiModel::where("status", "selesai")
                ->where("id_baliho", $id)
                ->where("tanggal_akhir", ">", Carbon::now())
                ->get();

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data baliho',
                'baliho' => $baliho,
                'foto' => $fotos,
                'transaksi' => $transaksi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }
}
