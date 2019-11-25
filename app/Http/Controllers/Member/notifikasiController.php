<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\NotificationModel;


class notifikasiController extends Controller
{
    //
    public function notif($n)
    {
        # code...
        $data = "";
        $notif = NotificationModel::query()
            ->where('id_advertiser','=',$n)
            ->get();
            return $data;
    }
    
}
