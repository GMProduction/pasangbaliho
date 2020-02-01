<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use App\models\FotoBalihoModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as Image;

class MediaControll extends Controller
{
    //
    public function getCountMedia(){
        $qtyMedia = DB::table('balihos')->where('status','=' ,'publish')->count();
        return response()->json($qtyMedia, 200);
    }

    public function getMedia(Request $r){
        try {
            $id = [['id_baliho', 'LIKE', '%' .$r->index . '%']];
        $nama = [['clients.nama', 'LIKE', '%' .$r->index . '%']];
        $nama_baliho = [['nama_baliho', 'LIKE', '%' .$r->index . '%']];
        $kategori = [['kategoris.kategori', 'LIKE', '%' .$r->index . '%']];
        $permintaan = BalihoModel::query()
            ->join('kotas', 'balihos.id_kota', '=', 'kotas.id_kota')
            ->join('provinsis', 'kotas.id_provinsi', '=', 'provinsis.id_provinsi')
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
                'provinsis.id_provinsi',
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
        $qty = $permintaan->count();
        return response()->json(['qty' => $qty, 'result' => $permintaan], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }
    public function getMediaExceptPending(Request $r){
        try {
            $id = [['id_baliho', 'LIKE', '%' .$r->index . '%']];
        $nama = [['clients.nama', 'LIKE', '%' .$r->index . '%']];
        $nama_baliho = [['nama_baliho', 'LIKE', '%' .$r->index . '%']];
        $kategori = [['kategoris.kategori', 'LIKE', '%' .$r->index . '%']];
        $permintaan = BalihoModel::query()
            ->join('kotas', 'balihos.id_kota', '=', 'kotas.id_kota')
            ->join('provinsis', 'kotas.id_provinsi', '=', 'provinsis.id_provinsi')
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
                'provinsis.id_provinsi',
                'provinsis.nama_provinsi',
                'balihos.id_kota',
                'kotas.nama_kota',
                'balihos.alamat', 'latitude', 'longitude',
                'harga_client', 'harga_market', 'orientasi', 'posisi', 'tampilan','deskripsi', 'url_360',
                'baliho.status'
            )
            ->where(function ($query) use ($id, $nama, $nama_baliho, $kategori) {
                $query->where($id)
                    ->orWhere($nama)
                    ->orWhere($nama_baliho)
                    ->orWhere($kategori);
            })
            ->where('balihos.status', 'LIKE', '%'.$r->status.'%')
            ->where('balihos.status', '!=', 'pending')
            ->orderBy('id_baliho', 'ASC')
            ->get();
        $qty = $permintaan->count();
        return response()->json(['qty' => $qty, 'result' => $permintaan], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }
    

    public function getMediaById(Request $r){

        $validator = Validator::make($r->all(),[
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 202); 
        }
        try {
            $permintaan = BalihoModel::query()
                ->join('kotas', 'balihos.id_kota', '=', 'kotas.id_kota')
                ->join('provinsis', 'kotas.id_provinsi', '=', 'provinsis.id_provinsi')
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
                    'provinsis.id_provinsi',
                    'provinsis.nama_provinsi',
                    'balihos.id_kota',
                    'kotas.nama_kota',
                    'balihos.alamat', 'latitude', 'longitude',
                    'harga_client', 'harga_market', 'harga_max', 'tampil_harga', 'orientasi', 'posisi', 'tampilan','deskripsi', 'url_360',
                    'balihos.status as status'
                )
                
                ->where('balihos.status', 'LIKE', '%'.$r->status.'%')
                ->where('id_baliho', '=', $r->id)
                ->first();
                if ($permintaan != null) {
                    return response()->json($permintaan, 200);
                }
                return response()->json(['message' => 'No Data Found!'], 202);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }

    

    

    public function patchMedia(Request $r){
        
        $validator = Validator::make($r->all(),[
            'idBaliho' => 'required',
            'idClient' => 'required',
            'idKategori' => 'required',
            'namaMedia' => 'required',
            'lebar' => 'required',
            'tinggi' => 'required',
            'idKota' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'hargaClient' => 'required',
            'statusHarga' => 'required',
            'tampilan' => 'required',
            'posisi' => 'required',
            'posisi' => 'required',
            'deskripsi' => 'required',
            'url360' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 202); 
        }

        try {
            $lebar = str_replace('.','',$r->lebar);
            $tinggi = str_replace('.','',$r->tinggi);
            $hargaClient = str_replace('.','',$r->hargaClient);
            $hargaMarket = str_replace('.','',$r->hargaMarket);
            $hargaMax = str_replace('.','',$r->hargaMax);
            $data = [
                'id_client' => $r->idClient,
                'id_kategori' => $r->idKategori,
                'nama_baliho' => $r->namaMedia,
                'lebar' => $lebar,
                'tinggi' => $tinggi,
                'luas' => ($lebar * $tinggi),
                'id_kota' => $r->idKota,
                'alamat' => $r->alamat,
                'harga_client' => $hargaClient,
                'deskripsi' => $r->deskripsi,
                'tampilan' => $r->tampilan,
                'posisi' => $r->posisi,
                'harga_market' => $hargaMarket,
                'harga_max' => $hargaMax,
                'tampil_harga' => $r->statusHarga,
                'latitude' => $r->latitude,
                'longitude' => $r->longitude,
                'url_360' => $r->url360,
                'status' => $r->status
            ];
            BalihoModel::query()
            ->where('id_baliho', '=', $r->idBaliho)
            ->update($data);
            return response()->json(['message' => 'success', 'id' => $r->idBaliho], 200);
            
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }

    public function addMedia (Request $r) {

        $validator = Validator::make($r->all(),[
            'idClient' => 'required',
            'idKategori' => 'required',
            'namaMedia' => 'required',
            'lebar' => 'required',
            'tinggi' => 'required',
            'idKota' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'hargaClient' => 'required',
            'statusHarga' => 'required',
            'tampilan' => 'required',
            'posisi' => 'required',
            'posisi' => 'required',
            'deskripsi' => 'required',
            'url360' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['validation' => $validator->errors()], 202); 
        }

        try {
            $lebar = str_replace('.','',$r->lebar);
            $tinggi = str_replace('.','',$r->tinggi);
            $hargaClient = str_replace('.','',$r->hargaClient);
            $hargaMarket = str_replace('.','',$r->hargaMarket);
            $hargaMax = str_replace('.','',$r->hargaMax);
            $baliho = new BalihoModel;
            $baliho->id_client = $r->idClient;
            $baliho->id_kategori = $r->idKategori;
            $baliho->nama_baliho = $r->namaMedia;
            $baliho->lebar = $lebar;
            $baliho->tinggi = $tinggi;
            $baliho->orientasi = $r->orientasi;
            $baliho->luas = ($lebar * $tinggi);
            $baliho->id_kota = $r->idKota;
            $baliho->alamat = $r->alamat;
            $baliho->latitude = $r->latitude;
            $baliho->longitude = $r->longitude;
            $baliho->harga_client = $hargaClient;
            $baliho->harga_market = $hargaMarket;
            $baliho->harga_max = $hargaMax;
            $baliho->tampil_harga = $r->statusHarga;
            $baliho->tampilan = $r->tampilan;
            $baliho->posisi = $r->posisi;
            $baliho->deskripsi = $r->deskripsi;
            $baliho->url_360 = $r->url360;
            $baliho->status = 'publish';
            $baliho->save();
            return response()->json(['message' => 'success', 'id' => $baliho->id_baliho], 200);
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }

    public function multipleUpload(Request $r){
        
        $validator = Validator::make($r->all(),[
            'idBaliho' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 202); 
        }

        try {
            if ($r->hasFile('gambar')) {
                foreach ($r->file('gambar')  as $key => $files) {
                    $now = Carbon::now()->format('YmdHisu');
                    $name = 'img_'.$now.'_'.($key+1).'.'.$files->getClientOriginalExtension();
                    $image_resize = Image::make($files);
                    $image_resize->resize(300, 150);
                    $image_resize->save(public_path('assets/thumbnails/' . $name));
                    $files->move(public_path('assets/original'), $name);
                    $foto = new FotoBalihoModel;
                    $foto->id_baliho = $r->idBaliho;
                    $foto->url_foto = $name;
                    $foto->save();
                }
                return response()->json(['message' => 'File Uploaded', 'file' => $r->files], 200);
            }else{
                return response()->json(['message' => 'No File Found'], 202);
            }
        } catch (\Exception $th) {
            return response()->json(['message' => $th], 500);
        }
    }

    public function getImageById (Request $r) {
        try {
            $image = FotoBalihoModel::query()
            ->select(
                'id_foto', 'id_baliho', 'url_foto'
            )
            ->where('id_baliho' , '=', $r->id)
            ->get();
        return response()->json($image, 200);
        } catch (\Exception $th) {
            return response()->json(['message' => $th], 500);
        }
    }

    public function deleteImage ($id) {
        try {
            FotoBalihoModel::query()
            ->where('id_foto', '=', $id)
            ->delete();
            return response()->json(['message' => 'success'], 200);

        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }

    public function patchStatusMedia (Request $r){

        $validator = Validator::make($r->all(),[
            'status' => 'required',
            'idBaliho' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 202); 
        }

        try {
            $data = [
                'status' => $r->status
            ];
            BalihoModel::query()
            ->where('id_baliho', '=', $r->idBaliho)
            ->update($data);
            return response()->json(['message' => 'success'], 200);
            
        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }

    public function delete ($id){

        //content type : x-www-form-urlencoded

        try {
            BalihoModel::query()
            ->where('id_baliho', '=', $id)
            ->delete();
            return response()->json(['message' => 'success'], 200);

        } catch (\Exception $e) {
            $exData = explode('(', $e->getMessage());
            return response()->json(['message' => $exData[0]],500);
        }
    }
}
