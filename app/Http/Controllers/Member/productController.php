<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\productModel;
use App\Master\transaksiModel;
use App\models\FotoBalihoModel;
use App\models\KategoriModel;
use App\models\KotaModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;

class productController extends Controller
{
    //

    public function getKategori(){
        $query = KategoriModel::query()
            ->get();
        return $query;
    }

    public function detailProduct($url, $id)
    {

        $c = Carbon::now();
        $day = $c->isoFormat('Y-MM-DD');



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
                'balihos.harga_max as harga_max',
                'balihos.tampil_harga as tampil_harga',
                'balihos.deskripsi as deskripsi',
                'balihos.latitude as latitude',
                'balihos.longitude as longitude',
                'foto_baliho.url_foto as url_foto'
            )
            ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->where('balihos.id_baliho', '=', $id)
            ->orderBy('balihos.created_at', 'DESC')
            ->groupBy('balihos.id_baliho')
            ->get();

        $produkRelated = productModel::query()
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
                'balihos.harga_max as harga_max',
                'balihos.tampil_harga as tampil_harga',
                'balihos.deskripsi as deskripsi',
                'foto_baliho.url_foto as url_foto'
            )
            ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->where('balihos.status', '=', 'publish')
            ->where('kotas.nama_kota', 'like', $product[0]->kota)
            ->groupBy('balihos.id_baliho')
            ->orderBy('balihos.created_at', 'DESC')
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $kategoriRelated = productModel::query()
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
                'balihos.harga_max as harga_max',
                'balihos.tampil_harga as tampil_harga',
                'balihos.deskripsi as deskripsi',
                'foto_baliho.url_foto as url_foto'
            )
            ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->where('balihos.status', '=', 'publish')
            ->where('kategoris.kategori', 'like', $product[0]->kategori)
            ->groupBy('balihos.id_baliho')
            ->orderBy('balihos.created_at', 'DESC')
            ->inRandomOrder()
            ->limit(5)
            ->get();


        $dipesan = transaksiModel::query()
            ->where('id_baliho', '=', $id)
            ->where('tanggal_akhir', '>', $day)
            ->where('status', '!=', 'permintaan')
            ->get();

        $foto = FotoBalihoModel::query()
            ->where('id_baliho', '=', $id)
            ->get();

        $idM = "";
        if (auth()->guard('advertiser')->check()) {
            $idM = auth()->guard('advertiser')->user()->id;
        }




        $data = [
            'produkDetail' => $product,
            'dipesan' => $dipesan,
            'foto' => $foto,
            'related' => $produkRelated,
            'kategori' => $kategoriRelated

        ];


        $uri = $product[0]->kategori . ' ' . $product[0]->alamat . ' ' . $product[0]->kota . ' ' . $product[0]->provinsi;
        $urlweb = str_replace(' ', '-', $uri);

        SEOTools::setTitle($uri);
        SEOTools::setDescription($product[0]->deskripsi . ' ' . $product[0]->orientasi . ' ' . $product[0]->alamat . ' ' . $product[0]->kota . ' ' . $product[0]->provinsi);
        SEOTools::opengraph()->setUrl('http://current.url.com');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

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


    public function cariProduk(Request $r)
    {
        $kategori = $this->getKategori();
       
        $id = "";
        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

        $order = $r->s;
        $kolom = 'balihos.created_at';
        if ($order == null) {
            $order = 'DESC';
        }
        if ($order !== null) {
            $kolom = 'balihos.harga_market';
        }
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
                'balihos.harga_max as harga_max',
                'balihos.tampil_harga as tampil_harga',
                'balihos.deskripsi as deskripsi',
                'foto_baliho.url_foto as url_foto'
            )
            ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            // ->where('kategoris.kategori', '=', $r->k)
            // ->where('kotas.nama_kota', '=', $r->c)
            // ->where(
            //     ['kategoris.kategori', '=', $r->k],
            //     ['kotas.nama_kota', '=', $r->c]
            // )
            // ->when(DB::raw('select kategori from kategoris where kategori = '.$r->k), '=', $r->k, function ($q) use ($r) {
            //      $q->where('kategoris.kategori', '=', $r->k);
            // })
            // ->when('kotas.nama_kota', '=', $r->c, function ($q) use ($r) {
            //      $q->where('kotas.nama_kota', '=', $r->c);
            // })
            ->where("kotas.nama_kota", "LIKE",  $r->c)
            ->where("kategoris.kategori", "LIKE", $r->k)
            ->where(function ($q) use ($r) {
                $q->where('balihos.nama_baliho', 'like', '%' . $r->t . '%');
            })

            // ->where(function ($q) use ($r){
            //     $q->where('kategoris.kategori', '=', $r->k)
            //       ->where('kotas.nama_kota', '=', $r->c);
            // })
            // ->orwhere(function ($q) use ($r){
            //     $q->where('kategoris.kategori', '=', $r->k)
            //       ->where('kotas.nama_kota', '=', $r->c);
            // })
            ->groupBy('balihos.id_baliho')
            ->orderBy($kolom, $order)
            ->where('balihos.status', '=', 'publish')
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
                    'balihos.harga_max as harga_max',
                    'balihos.tampil_harga as tampil_harga',
                    'balihos.deskripsi as deskripsi',
                    'foto_baliho.url_foto as url_foto'
                )
                ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
                ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
                ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
                ->groupBy('balihos.id_baliho')
                ->orderBy('balihos.created_at', 'DESC')
                ->where('balihos.status', '=', 'publish')
                ->paginate(12);

            $data = [
                'produk' => $produk,
                'kota' => $kota
            ];
            $produk->appends($r->all('d'));
            // return view('main/product')->with($data);

            return view('main/product', compact(['produk', 'kota','kategori']));
        } else {
            $produk->appends($r->all('k', 'c', 'p', 't', 'd','s'));


            return view('main/product', compact(['produk', 'kota','kategori']));
        }
    }
}
