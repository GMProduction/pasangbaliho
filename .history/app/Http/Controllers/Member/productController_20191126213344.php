<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\productModel;
use App\Master\transaksiModel;
use App\models\FotoBalihoModel;
use App\models\KotaModel;
use Illuminate\Support\Facades\DB;
use App\models\NotificationModel;
use Carbon\Carbon;

class productController extends Controller
{
    //

    public function notif($n)
    {
        $c = Carbon::now();
        # code...
        $notif = NotificationModel::query()
            ->where('id_advertiser', '=', $n)
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        return $notif;
    }

    public function getJumlahNotif($id)
    {
        $query = DB::table('notifikasi_advertiser')
            ->select(DB::raw('count(*) as count'))
            ->where('id_advertiser', '=', $id)
            ->get();
        return $query;
    }

    public function detailProduct(Request $req)
    {
        $c = Carbon::now('Y-M-d');

        $product = productModel::query()
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
            ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->where('balihos.id_baliho', '=', $req->id)
            ->get();

        $dipesan = transaksiModel::query()
            ->where('id_baliho', '=', $req->id)
            ->where('tanggal_akhir','>')
            ->get();

        $foto = FotoBalihoModel::query()
            ->where('id_baliho', '=', $req->id)
            ->get();

        $id = "";
        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

        $notif = $this->notif($id);
        $getNotif = $this->getJumlahNotif($id);

        $data = [
            'produkDetail' => $product,
            'dipesan' => $dipesan,
            'foto' => $foto,
            'notif' => $notif,
            'jumNotif' => $getNotif
        ];

        // return view('main/detailproduct')->with($data);
          echo $c;
    }

    public function showStreetView($id)
    {
        $street = productModel::query()
            ->select('url_360')
            ->where('id_baliho', '=', $id)
            ->get();

        return view('item.streetview')->with('street', $street);
        // echo $street;
    }

    public function showProduct()
    {
        $product = productModel::query()
            ->paginate(12);

        $data = [
            'produk' => $product
        ];

        return view('main/product')->with($data);
    }


    public function cariProduk(Request $r)
    {
        $kategori = $r->kategori;
        $id = "";
        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

        $notif = $this->notif($id);
        $jumNotif = $this->getJumlahNotif($id);

        $kota = KotaModel::query()
            ->get();

        $produk = productModel::query()
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
            ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->where('kategoris.kategori', '=', $r->k)
            ->orwhere('kotas.nama_kota', '=', $r->c)
            ->groupBy('balihos.id_baliho')
            // ->orwhere('kota','like','%'.$r->t.'%')
            // ->orwhere(function ($txt) use ($r) {
            //     $txt->orwhere('kategori','like','%'.$r->t.'%')
            //         ->orwhere('kota','like','%'.$r->t.'%')
            //         ->orwhere('provinsi','like','%'.$r->t.'%');
            // })
            ->paginate(12);
        // ->get();

        if ($r->d == 'all') {
            $produk = productModel::query()
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
                ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->groupBy('balihos.id_baliho')
                ->paginate(12);

            $data = [
                'produk' => $produk,
                'notif' => $notif,
                'jumNotif' => $jumNotif,
                'kota' => $kota
            ];
            $produk->appends($r->all('d'));
            // return view('main/product')->with($data);

            return view('main/product', compact(['produk', 'kota', 'jumNotif', 'notif']));
        } else {
            $produk->appends($r->all('k', 'c', 'p', 't', 'd'));


            return view('main/product', compact(['produk', 'kota', 'jumNotif', 'notif']));
        }
    }
}
