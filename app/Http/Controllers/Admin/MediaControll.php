<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use App\models\FotoBalihoModel;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image as Image;

class MediaControll extends Controller
{
    //
    public function getCountMedia(){
        $qtyMedia = DB::table('balihos')->where('status','!=' ,'pending')->count();
        return response()->json($qtyMedia);
    }

    public function getMedia(Request $r){
        $id = [['id_baliho', 'LIKE', '%' .$r->index . '%']];
        $nama = [['clients.nama', 'LIKE', '%' .$r->index . '%']];
        $nama_baliho = [['nama_baliho', 'LIKE', '%' .$r->index . '%']];
        $kategori = [['kategoris.kategori', 'LIKE', '%' .$r->index . '%']];
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
        'harga_client', 'harga_market', 'orientasi', 'posisi', 'tampilan','deskripsi', 'url_360'
            )
            ->where(function ($query) use ($id, $nama, $nama_baliho, $kategori) {
                $query->where($id)
                    ->orWhere($nama)
                    ->orWhere($nama_baliho)
                    ->orWhere($kategori);
            })
            ->where('balihos.status', 'LIKE', '%'.$r->status.'%')
            ->orderBy('id_baliho', 'ASC')
            ->get();
        return response()->json($permintaan);
    }
    

    public function getMediaById(Request $r){
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
                    'harga_client', 'harga_market', 'orientasi', 'posisi', 'tampilan','deskripsi', 'url_360'
                )
                ->where('balihos.status', 'LIKE', '%'.$r->status.'%')
                ->where('id_baliho', '=', $r->id)
                ->first();
        if ($permintaan != null) {
            return response()->json($permintaan);
        }
        return null;
    }

    public function getMediaExceptPending(Request $r){
        $id = [['id_baliho', 'LIKE', '%' .$r->index . '%']];
        $nama = [['clients.nama', 'LIKE', '%' .$r->index . '%']];
        $nama_baliho = [['nama_baliho', 'LIKE', '%' .$r->index . '%']];
        $kategori = [['kategoris.kategori', 'LIKE', '%' .$r->index . '%']];
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
        'harga_client', 'harga_market', 'orientasi', 'posisi', 'tampilan', 'deskripsi', 'url_360'
            )
            ->where(function ($query) use ($id, $nama, $nama_baliho, $kategori) {
                $query->where($id)
                    ->orWhere($nama)
                    ->orWhere($nama_baliho)
                    ->orWhere($kategori);
            })
            ->where('balihos.status', '!=', 'pending')
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
                $image_resize->resize(300, 300);
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
                $image_resize->resize(300, 300);
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
                $image_resize->resize(300, 300);
                $image_resize->save(public_path('assets/thumbnails/' . $namaFoto));
                $r->gambar3->move(public_path('assets/original'), $namaFoto);
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
                'id_client' => $r->idClient,
                'id_kategori' => $r->idKategori,
                'nama_baliho' => $r->namaMedia,
                'lebar' => $r->lebar,
                'tinggi' => $r->tinggi,
                'luas' => ($r->lebar * $r->tinggi),
                'id_provinsi' => $r->idProvinsi,
                'id_kota' => $r->idKota,
                'alamat' => $r->alamat,
                'harga_client' => $r->hargaClient,
                'deskripsi' => $r->deskripsi,
                'tampilan' => $r->tampilan,
                'posisi' => $r->posisi,
                'harga_market' => $r->hargaMarket,
                'latitude' => $r->latitude,
                'longitude' => $r->longitude,
                'url_360' => $r->url360,
                'status' => $r->status
            ];
            $updated = BalihoModel::query()
            ->where('id_baliho', '=', $r->idBaliho)
            ->update($data);
            if ($updated) {
                if ($this->upload($r, $r->idBaliho)) {
                    return response()->json([
                        'status' => 'ok',
                        'upload' => 'ok',
                        'update' => $data
                    ]);
                }else{
                    return response()->json([
                        'status' => 'ok',
                        'upload' => 'failed',
                        'update' => $data
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
            $baliho->nama_baliho = $r->namaMedia;
            $baliho->lebar = $r->lebar;
            $baliho->tinggi = $r->tinggi;
            $baliho->orientasi = $r->orientasi;
            $baliho->luas = ($r->lebar * $r->tinggi);
            $baliho->id_provinsi = $r->idProvinsi;
            $baliho->id_kota = $r->idKota;
            $baliho->alamat = $r->alamat;
            $baliho->latitude = $r->latitude;
            $baliho->longitude = $r->longitude;
            $baliho->harga_client = $r->hargaClient;
            $baliho->harga_market = $r->hargaMarket;
            $baliho->tampilan = $r->tampilan;
            $baliho->posisi = $r->posisi;
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

    public function updateStatusMedia (Request $r){
        try {
            $data = [
                'status' => $r->status
            ];
            BalihoModel::query()
            ->where('id_baliho', '=', $r->idBaliho)
            ->update($data);
            
            return response()->json([
                'status' => 'ok',
                'update' => $data
            ]);
            
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'status' => 'failed',
                'data' => $exData[0],
                'data' => $e,
            ]);
        }
    }

    public function delete (Request $r){
        $id = $r->id;
        try {
            BalihoModel::query()
            ->where('id_baliho', '=', $id)
            ->delete();
            return response()->json([
                'sqlResponse' => true,
                'data' => $id
            ]);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json([
                'data' =>  $exData[0],
                'sqlResponse' => false,
            ]);
        }
    }
}
