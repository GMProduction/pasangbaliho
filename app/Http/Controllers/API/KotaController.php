<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\FotoBalihoModel;
use App\models\KotaModel;

class KotaController extends Controller
{

    public function dataAllKota()
    {

        try {
            $kota = KotaModel::orderBy('namaKota', 'ASC')
                ->get();

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data kota',
                'kota' => $kota
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }
}
