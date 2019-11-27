<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use App\models\FotoBalihoModel;
use Image;

class MediaControll extends Controller
{
    //
    public function getPermintaanMedia(){
        $permintaan = BalihoModel::query()
            ->join('provinsis', 'balihos.id_provinsi', '=', 'provinsis.id_provinsi')
            ->join('kotas', 'balihos.id_kota', '=', 'kotas.id_kota')
            ->join('kategoris', 'balihos.id_kategori', '=','kategoris.id_kategori')
            ->join('clients', 'balihos.id_client', '=', 'clients.id_client')
            ->select(
                'id_baliho',
                'balihos.id_client',
                'clients.nama',
                'balihos.id_kategori', 
                'kategoris.kategori',
                'nama_baliho', 
                'lebar', 'tinggi' , 'luas',
                'balihos.id_provinsi',
                'provinsis.nama_provinsi',
                'balihos.id_kota',
                'kotas.nama_kota',
                'balihos.alamat', 'latitude', 'longitude',
        'harga_client', 'harga_market', 'orientasi', 'venue', 'deskripsi', 'url_360'
            )
            ->where('status', '=', 'pending')
            ->orderBy('id_baliho', 'ASC')
            ->get();
        return response()->json($permintaan);
    }

    public function getPermintaanMediaById(Request $r){
        $permintaan = BalihoModel::query()
                ->join('provinsis', 'balihos.id_provinsi', '=', 'provinsis.id_provinsi')
                ->join('kotas', 'balihos.id_kota', '=', 'kotas.id_kota')
                ->join('kategoris', 'balihos.id_kategori', '=','kategoris.id_kategori')
                ->join('clients', 'balihos.id_client', '=', 'clients.id_client')
                ->select(
                    'id_baliho',
                    'balihos.id_client',
                    'clients.nama',
                    'balihos.id_kategori', 
                    'kategoris.kategori',
                    'nama_baliho', 
                    'lebar', 'tinggi' , 'luas',
                    'balihos.id_provinsi',
                    'provinsis.nama_provinsi',
                    'balihos.id_kota',
                    'kotas.nama_kota',
                    'balihos.alamat', 'latitude', 'longitude',
            'harga_client', 'harga_market', 'orientasi', 'venue', 'deskripsi', 'url_360'
                )
                ->where('status', '=', 'pending')
                ->where('id_baliho', '=', $r->id)
                ->first();
        return response()->json($permintaan);
    }

    public function getMediaPublish(){
        $permintaan = BalihoModel::query()
            ->join('provinsis', 'balihos.id_provinsi', '=', 'provinsis.id_provinsi')
            ->join('kotas', 'balihos.id_kota', '=', 'kotas.id_kota')
            ->join('kategoris', 'balihos.id_kategori', '=','kategoris.id_kategori')
            ->join('clients', 'balihos.id_client', '=', 'clients.id_client')
            ->select(
                'id_baliho',
                'balihos.id_client',
                'clients.nama',
                'balihos.id_kategori', 
                'kategoris.kategori',
                'nama_baliho', 
                'lebar', 'tinggi' , 'luas',
                'balihos.id_provinsi',
                'provinsis.nama_provinsi',
                'balihos.id_kota',
                'kotas.nama_kota',
                'balihos.alamat', 'latitude', 'longitude',
        'harga_client', 'harga_market', 'orientasi', 'venue', 'deskripsi', 'url_360'
            )
            ->where('status', '=', 'publish')
            ->orderBy('id_baliho', 'ASC')
            ->get();
        return response()->json($permintaan);
    }
    public function getMediaBlock(){
        $permintaan = BalihoModel::query()
            ->join('provinsis', 'balihos.id_provinsi', '=', 'provinsis.id_provinsi')
            ->join('kotas', 'balihos.id_kota', '=', 'kotas.id_kota')
            ->join('kategoris', 'balihos.id_kategori', '=','kategoris.id_kategori')
            ->join('clients', 'balihos.id_client', '=', 'clients.id_client')
            ->select(
                'id_baliho',
                'balihos.id_client',
                'clients.nama',
                'balihos.id_kategori', 
                'kategoris.kategori',
                'nama_baliho', 
                'lebar', 'tinggi' , 'luas',
                'balihos.id_provinsi',
                'provinsis.nama_provinsi',
                'balihos.id_kota',
                'kotas.nama_kota',
                'balihos.alamat', 'latitude', 'longitude',
        'harga_client', 'harga_market', 'orientasi', 'venue', 'deskripsi', 'url_360'
            )
            ->where('status', '=', 'block')
            ->orderBy('id_baliho', 'ASC')
            ->get();
        return response()->json($permintaan);
    }
    public function getAllMedia(){
        $permintaan = BalihoModel::query()
            ->join('provinsis', 'balihos.id_provinsi', '=', 'provinsis.id_provinsi')
            ->join('kotas', 'balihos.id_kota', '=', 'kotas.id_kota')
            ->join('kategoris', 'balihos.id_kategori', '=','kategoris.id_kategori')
            ->join('clients', 'balihos.id_client', '=', 'clients.id_client')
            ->select(
                'id_baliho',
                'balihos.id_client',
                'clients.nama',
                'balihos.id_kategori', 
                'kategoris.kategori',
                'nama_baliho', 
                'lebar', 'tinggi' , 'luas',
                'balihos.id_provinsi',
                'provinsis.nama_provinsi',
                'balihos.id_kota',
                'kotas.nama_kota',
                'balihos.alamat', 'latitude', 'longitude',
        'harga_client', 'harga_market', 'orientasi', 'venue', 'deskripsi', 'url_360'
            )
            ->orderBy('id_baliho', 'ASC')
            ->get();
        return response()->json($permintaan);
    }


    private function upload (Request $r, $idbaliho) {
        try {
            if ($r->hasFile('gambar1')) {
                $image = $r->file('gambar1');
                $namaFoto = 'gambar_'.$idbaliho.'-1.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image);
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('assets/thumbnails/' . $namaFoto));
                $r->gambar1->move(public_path('assets/original'), $namaFoto);
                $foto = new FotoBalihoModel;
                $foto->id_baliho = $idbaliho;
                $foto->url_foto = $namaFoto;
                $foto->save();
            }
            if ($r->hasFile('gambar2')) {
                $image = $r->file('gambar2');
                $namaFoto = 'gambar_'.$idbaliho.'-2.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image);
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('assets/thumbnails/' . $namaFoto));
                $r->gambar2->move(public_path('assets/original'), $namaFoto);
                $foto = new FotoBalihoModel;
                $foto->id_baliho = $idbaliho;
                $foto->url_foto = $namaFoto;
                $foto->save();
            }
            if ($r->hasFile('gambar3')) {
                $image = $r->file('gambar3');
                $namaFoto = 'gambar_'.$idbaliho.'-3.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image);
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('assets/thumbnails/' . $namaFoto));
                $r->gambar3->move(public_path('assets/original'), $namaFoto);
                $foto = new FotoBalihoModel;
                $foto->id_baliho = $idbaliho;
                $foto->url_foto = $namaFoto;
                $foto->save();
            }
            if ($r->hasFile('gambar4')) {
                $image = $r->file('gambar4');
                $namaFoto = 'gambar_'.$idbaliho.'-4.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image);
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('assets/thumbnails/' . $namaFoto));
                $r->gambar4->move(public_path('assets/original'), $namaFoto);
                $foto = new FotoBalihoModel;
                $foto->id_baliho = $idbaliho;
                $foto->url_foto = $namaFoto;
                $foto->save();
            }
            if ($r->hasFile('gambar5')) {
                $image = $r->file('gambar5');
                $namaFoto = 'gambar_'.$idbaliho.'-5.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image);
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('assets/thumbnails/' . $namaFoto));
                $r->gambar5->move(public_path('assets/original'), $namaFoto);
                $foto = new FotoBalihoModel;
                $foto->id_baliho = $idbaliho;
                $foto->url_foto = $namaFoto;
                $foto->save();
            }
            if ($r->hasFile('gambar6')) {
                $image = $r->file('gambar6');
                $namaFoto = 'gambar_'.$idbaliho.'-6.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image);
                $image_resize->resize(150, 150);
                $image_resize->save(public_path('assets/thumbnails/' . $namaFoto));
                $r->gambar6->move(public_path('assets/original'), $namaFoto);
                $foto = new FotoBalihoModel;
                $foto->id_baliho = $idbaliho;
                $foto->url_foto = $namaFoto;
                $foto->save();
            }
            return true;
            
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function konfirmasiMedia(Request $r){
        
        try {
            $data = [
                'harga_market' => $r->hargaMarket,
                'latitude' => $r->latitude,
                'longitude' => $r->longitude,
                'url_360' => $r->url360,
                'status' => $r->status
            ];
            $updated = BalihoModel::query()
            ->where('id_baliho', '=', $r->idbaliho)
            ->update($data);
            if ($updated) {
                if ($this->upload($r, $r->idbaliho)) {
                    return response()->json([
                        'status' => 'ok',
                        'upload' => 'ok',
                        'update' => $updated
                    ]);
                }else{
                    return response()->json([
                        'status' => 'ok',
                        'upload' => 'failed',
                        'update' => $updated
                    ]);
                }
            }
            
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'data' => $exData[0],
                'data' => $e,
            ]);
        }
    }

    public function addMedia (Request $r) {
        try {
            $baliho = new BalihoModel;
            $baliho->id_client = $r->idClient;
            $baliho->id_kategori = $r->idKategori;
            $baliho->nama_baliho = $r->namaBaliho;
            $baliho->lebar = $r->lebar;
            $baliho->tinggi = $r->tinggi;
            $baliho->luas = $r->luas;
            $baliho->id_provinsi = $r->idProvinsi;
            $baliho->id_kota = $r->idKota;
            $baliho->alamat = $r->alamat;
            $baliho->latitude = $r->latitude;
            $baliho->longitude = $r->longitude;
            $baliho->harga_client = $r->hargaClient;
            $baliho->harga_market = $r->hargaMarket;
            $baliho->orientasi = $r->orientasi;
            $baliho->venue = $r->venue;
            $baliho->deskripsi = $r->deskripsi;
            $baliho->url_360 = $r->url360;
            $baliho->status = 'publish';
            if ($baliho->save()) {
                if ($this->upload($r, $baliho->id_baliho)) {
                    return response()->json([
                        'status' => 'ok',
                        'upload' => 'ok',
                        'data' => $baliho,
                        'id' => $baliho->id_baliho
                    ]);
                }else{
                    return response()->json([
                        'status' => 'ok',
                        'upload' => 'failed',
                        'data' => $baliho
                    ]);
                }
            }
        
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'data' => $exData[0],
                'data' => $e,
            ]);
        }
    }
}
