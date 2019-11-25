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

    public function getSlider(){
        $query = SliderModel::query()
            ->get();

        return $query;
    }





    public function index()
    {
        $c = Carbon::now();
        $id = "";
        if(auth()->guard('advertiser')->check()){
            $id = auth()->guard('advertiser')->user()->id;
        }
        
        $notif = $this->notif($id);
        $getNotif = $this->getJumlahNotif($id);
        $slider = $this->getSlider();

        $kota = KotaModel::query()
            ->get();
        $product = productModel::query()
            ->select('balihos.*', 'url_foto')
            ->leftJoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->groupBy('balihos.id_baliho')
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
