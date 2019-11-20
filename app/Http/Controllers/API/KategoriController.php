<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\models\KategoriModel;

class KategoriController extends Controller
{

    public function dataAllKategori()
    {

        try {
            $kategori = KategoriModel ::orderBy('kategori', 'ASC')
                ->get();

            return response()->json([
                'respon' => 'success',
                'message' => 'success fetch data kota',
                'kategori' => $kategori
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'respon' => 'failure',
                'message' => 'terjadi kesalahan ' . $e
            ], 500);
        }
    }
}
