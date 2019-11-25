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
    public $id = "";
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

        $product = productModel::query()
            ->where('balihos.id_baliho', '=', $req->id)
            ->get();

        $dipesan = transaksiModel::query()
            ->where('id_baliho', '=', $req->id)
            ->get();

        $foto = FotoBalihoModel::query()
            ->where('id_baliho', '=', $req->id)
            ->get();

        
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

        return view('main/detailproduct')->with($data);
        //   echo $product;
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

    public function cariProduk1(Request $r)
    {
        $kategori = $r->kategori;


        $produk = productModel::query()
            ->where('kategori', '=', $kategori)
            ->orwhere('kota', '=', $r->kota)
            // ->paginate();
            ->get();
        // $produk->appends($r->all('kategori','kota'));

        $data = [
            'produk' => $produk
            // 'pagi' => $this->cariPagination($r)
        ];

        return view('main/product')->with($data);
        //  echo $produk;

    }

    public function cariProduk(Request $r)
    {
        $kategori = $r->kategori;

        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

        $notif = $this->notif($id);
        $jumNotif = $this->getJumlahNotif($id);

        $kota = KotaModel::query()
            ->get();

        $produk = productModel::query()
            ->select('balihos.*', 'url_foto')
            ->where('kategori', '=', $r->k)
            ->orwhere('kota', '=', $r->c)
            ->leftJoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
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
                ->select('balihos.*', 'url_foto')
                ->leftJoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
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
