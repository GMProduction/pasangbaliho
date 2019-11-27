<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;

class AdvertiserControll extends Controller
{
    //
    public function getAdvertiser () {
        $advertiser = AdvertiserModel::query()
            ->select('id', 'email', 'nama', 'password', 'telp', 'alamat')
            ->get();
        return response()->json($advertiser);
    }
}
