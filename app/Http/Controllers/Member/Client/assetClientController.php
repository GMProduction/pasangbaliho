<?php

namespace App\Http\Controllers\Member\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Master\productModel;
use App\models\BalihoModel;
use App\models\FotoBalihoModel;
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
        if (auth()->guard('client')->check()) {
            $id = auth()->guard('client')->user()->id_client;
        }

        $product = BalihoModel::query()
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
                'balihos.status as status',
                'foto_baliho.url_foto as url_foto'
            )
            ->leftjoin('foto_baliho', 'balihos.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->where('id_client', '=', $id)
            ->orderBy('balihos.created_at', 'DESC')
            ->groupBy('balihos.id_baliho')
            ->paginate(10);



        $data = [
            'produk' => $product

        ];



        // return view('client/data/asset')->with($data);
        return view('client/data/asset', compact('product'));
        //   echo $product; 
    }

    public function showAddAsset()
    {
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

    public function addAsset(Request $r)
    {
        if (auth()->guard('client')->check()) {
            $id = auth()->guard('client')->user()->id_client;
        }
        $luas = $r->tinggi * $r->lebar;
        $data = new BalihoModel();
        $data->nama_baliho = $r->nama;
        $data->id_client = $id;
        $data->id_kategori = $r->jenmedia;
        $data->lebar = $r->lebar;
        $data->tinggi = $r->tinggi;
        $data->luas = $luas;
        $data->id_kota = $r->kota;
        $data->alamat = $r->alamat;
        $data->harga_client = str_replace(',', '', $r->harga);
        $data->orientasi = $r->orientasi;
        $data->posisi = $r->posisi;
        $data->tampilan = $r->tampil;
        $data->deskripsi = $r->deskripsi;
        $data->status = 'pending';
        $data->save();
        return redirect('/dashboardClient/asset');
        //echo $data;
    }


    public function editvisibleAsset(Request $r)
    {
        if (auth()->guard('client')->check()) {
            $id = auth()->guard('client')->user()->id_client;
        }
        $data = [
            'status' => $r->status
        ];
        BalihoModel::query()
            ->where('id_baliho', '=', $r->id)
            ->update($data);
    }

    public function detailAsset($id)
    {
        $aset = BalihoModel::query()
            ->select(
                    'balihos.*',
                    'kotas.nama_kota as kota',
                    'kategoris.kategori as kategori',
                    'provinsis.nama_provinsi as provinsi'
                    
            )
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->where('id_baliho', '=', $id)
            ->get();

        $kota = $this->getKota();
        $kategori = $this->getKategori();
        $provinsi = $this->getProvinsi();
        $foto = FotoBalihoModel::query()
            ->where('id_baliho', '=', $id)
            ->get();
        $data = [
            'kota' => $kota,
            'provinsi' => $provinsi,
            'kategori' => $kategori,
            'foto' => $foto,
            'asset' => $aset
        ];
        // return $aset;
        return view('client.data.sub.detailAsset')->with($data);
    }
}
