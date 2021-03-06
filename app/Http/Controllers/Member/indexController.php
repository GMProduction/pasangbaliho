<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Master\productModel;
use App\models\KotaModel;
use App\models\SliderModel;
use App\models\KategoriModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



use Artesaos\SEOTools\Facades\SEOTools;

class indexController extends Controller
{
    //

  

    public function getSlider()
    {
        $query = SliderModel::query()
            ->get();

        return $query;
    }

    public function getKategori(){
        $query = KategoriModel::query()
            ->get();
        return $query;
    }

    public function index()
    {

        SEOTools::setTitle('Solusi Media Iklan Anda');
        SEOTools::setDescription('website untuk menyewakan iklan dengan media iklan Billboard, Videotron, Website dan Blog, Parking Spot, Digital Display, Neon Box ');
        SEOTools::opengraph()->setUrl('http://pasangbaliho.com');
        SEOTools::setCanonical('https://pasangbaliho.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('https://pasangbaliho.com');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        $c = Carbon::now();
        $id = "";
        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

    
        $slider = $this->getSlider();
        $kategori = $this->getKategori();
        $kota = KotaModel::query()
            ->get();
        $product = productModel::query()
            ->select(
                'balihos.id_baliho as id_baliho',
                'balihos.nama_baliho as nama_baliho',
                'balihos.alamat as alamat',
                'balihos.harga_max as harga_max',
                'balihos.tampil_harga as tampil_harga',
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
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->where('balihos.status','=','publish')
            ->groupBy('balihos.id_baliho')
            ->orderBy('balihos.created_at','DESC')
            ->take(8)
            ->get();
        $data = [
            'produk' => $product,
            'kota' => $kota,
            'kategori' => $kategori,
            'slider' => $slider
        ];
        return view('main/index')->with($data);
    }

    public function showCorus(){
        $slider = $this->getSlider();
        $data = [
           
            'slider' => $slider
        ];

        return view('main/test')->with($data);    
    }

    public function showNews()
    {
        return view('main/news');
    }
}
