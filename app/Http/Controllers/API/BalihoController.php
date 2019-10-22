<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class BalihoController extends Controller
{

    public function dataListAllBaliho()
    {

        try {
            $baliho = BalihoModel::join('foto_baliho','balihos.id_baliho','foto_baliho.id_baliho')
            ->select('balihos.id_balihos as id_baliho')
            ->groupBy('id_baliho')
            ->get();

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data baliho',
                'baliho' => $baliho
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }


}
