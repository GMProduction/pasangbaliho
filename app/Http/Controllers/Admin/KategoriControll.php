<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\KategoriModel;

class KategoriControll extends Controller
{
    //
    public function getKategori() {
        $kategori = KategoriModel::query()
            ->select('id_kategori', 'kategori')
            // ->where('id_kategori', '=', 'asd')
            ->get();
        return response()->json($kategori);
    }
}
