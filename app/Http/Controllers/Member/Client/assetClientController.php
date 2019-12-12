<?php

namespace App\Http\Controllers\Member\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Master\productModel;
use App\models\KotaModel;
use App\models\KategoriModel;
use App\models\ProvinsiModel;


class assetClientController extends Controller
{
    //

    public function getKota()
    {
        $data = KotaModel::query()
            ->get();
        return $data;
    }

    public function getProvinsi()
    {
        $data = ProvinsiModel::query()
            ->get();
        return $data;
    }

    public function getKategori()
    {
        $data = KategoriModel::query()
            ->get();
        return $data;
    }


    public function showAsset(Request $req)
    {
        

        $product = productModel::query()
            ->select(
                'balihos.id_baliho as id_baliho',
                'balihos.nama_baliho as nama_baliho',
                'balihos.alamat as alamat',
                'kotas.nama_kota as kota',
                'kategoris.kategori as kategori',
                'provinsis.nama_provinsi as provinsi',
                'balihos.harga_client as harga_client',
                'balihos.lebar as lebar',
                'balihos.tinggi as tinggi',
                'balihos.orientasi as orientasi',
                'balihos.harga_market as harga_market',
                'balihos.deskripsi as deskripsi',
                'foto_baliho.url_foto as url_foto'
            )
            ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'balihos.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->orderBy('balihos.created_at', 'DESC')
            ->groupBy('balihos.id_baliho')
            ->get();



        $data = [
            'produk' => $product
          
        ];



        return view('client/data/asset')->with($data);
        //   echo $product; 
    }

    public function showAddAsset(){
        $kota = $this->getKota();
        $kategori = $this->getKategori();
        $provinsi = $this->getProvinsi();
        $data = [
            'kota' => $kota,
            'provinsi' => $provinsi,
            'kategori' => $kategori
        ];

        return view('client.data.sub.tambahMedia')->with($data);
    }
}
