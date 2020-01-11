<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Master\transaksiModel;
use Illuminate\Support\Carbon;
use App\models\NotificationModel;
use Illuminate\Support\Facades\DB;

class testIpay88 extends Controller
{
    //
    public function index()
    {
        return view('test.testIpay');
    }

}
