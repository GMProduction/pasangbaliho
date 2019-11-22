<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\models\NotifikasiAdvertiserModel;
use Symfony\Component\HttpFoundation\Request;

class NotifikasiController extends Controller
{

    public function getDataNotifikasi(Request $request)
    {

        try {
            $notif = NotifikasiAdvertiserModel::where('id_advertiser', $request->idAdv)
                ->orderBy('created_at', 'DESC')
                ->paginate(20);

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data Notif',
                'slider' => $notif
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }
}
