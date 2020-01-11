<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Master\productModel;
use App\models\KotaModel;
use App\models\NotificationModel;
use App\models\SliderModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


use Artesaos\SEOTools\Facades\SEOTools;

class indexController extends Controller
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

    public function getSlider()
    {
        $query = SliderModel::query()
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

        $notif = $this->notif($id);
        $getNotif = $this->getJumlahNotif($id);
        $slider = $this->getSlider();

        $kota = KotaModel::query()
            ->get();
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
            ->where('balihos.status','=','publish')
            ->groupBy('balihos.id_baliho')
            ->orderBy('balihos.created_at','DESC')
            ->take(8)
            ->get();


           

        $data = [
            'produk' => $product,
            'kota' => $kota,
            'notif' => $notif,
            'jumNotif' => $getNotif,
            'slider' => $slider
        ];

       

        return view('main/index')->with($data);




        // echo $notif;
    }

    public function showNews()
    {
        return view('main/news');
    }
}
