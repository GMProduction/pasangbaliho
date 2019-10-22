<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use App\models\FotoBalihoModel;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class BalihoController extends Controller
{

    public function dataListAllBaliho()
    {

        try {
            $baliho = BalihoModel::join('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
                ->select(
                    'balihos.id_baliho as id_baliho',
                    'balihos.nama_baliho as nama_baliho',
                    'balihos.alamat as alamat',
                    'balihos.deskripsi as deskripsi',
                    'foto_baliho.url_foto as url_foto'
                )
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

    public function showDetailBaliho($id)
    {
        try {
            $baliho = BalihoModel::where('id_baliho', $id)
                ->first();

                $fotos = FotoBalihoModel::Where('id_baliho', $id)
                ->get();

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data baliho',
                'baliho' => $baliho,
                'foto' => $fotos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }
}
