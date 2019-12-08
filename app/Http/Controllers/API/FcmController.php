<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\models\FcmModel;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class FcmController extends Controller
{

    public function insertFcmAdvertiser(Request $request)
    {

        try {

            $getToken = FcmModel::where("fcm_token", $request->fcmToken)
                ->first();

            if ($request->idAdv != "0") {
                if ($getToken == null) {
                    $insToken = new FcmModel();
                    $insToken->id_advertiser = $request->idAdv;
                    $insToken->fcm_token = $request->fcmToken;
                    $insToken->save();
                } else {
                    $fcmTable = (new FcmModel())->getTable();
                    DB::table($fcmTable)->where("fcm_token", $request->fcmToken)->update(['id_advertiser' => $request->idAdv]);
                }
            }
            return response()->json([
                'respon' => 'success',
                'message' => 'success insert fcm'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }

    public function deleteFcmAdvertiser(Request $request)
    {
        try {

            $fcmAdvertiser = FcmModel::where("fcm_token",$request->fcmToken)
                ->delete();
            return response()->json([
                'respon' => 'success',
                'message' => 'success delete fcm'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }
}
