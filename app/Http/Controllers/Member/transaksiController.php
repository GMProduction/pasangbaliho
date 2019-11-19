<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\transaksiModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class transaksiController extends Controller
{
    
    //
    public function showBerlangsung(){
        $id = auth()->guard('advertiser')->user()->id;
        $data = transaksiModel::query()
        ->select('transaksi.*','nama_baliho', 'provinsi', 'kota', 'alamat', 
        DB::raw('(select url_foto from foto_baliho, transaksi where foto_baliho.id_baliho = transaksi.id_baliho limit 1) as url_foto'))
        ->leftJoin('balihos','transaksi.id_baliho','balihos.id_baliho')
        // ->leftJoin('foto_baliho', function($join){
        //     $join->on('transaksi.id_baliho','=','foto_baliho.id_baliho')
        //         ->limit(1);
        // })
        // ->leftJoin('foto_baliho','transaksi.id_baliho','foto_baliho.id_baliho')
        ->where('id_advertiser','=',$id)
        ->get();
        

        return view('advertiser/data/transaksiBerlangsung')->with('data',$data);
        // echo $data;
    }

    public function showDetailTransaksi(Request $r){
        $data = transaksiModel::query()
        ->select('transaksi.*','balihos.nama_baliho', 'balihos.provinsi', 'balihos.kota', 'balihos.alamat','foto_baliho.url_foto')
        ->leftJoin('balihos','transaksi.id_baliho','balihos.id_baliho')
        ->leftJoin('foto_baliho','transaksi.id_baliho','foto_baliho.id_baliho')
        ->where('id_transaksi','=',$r->q)
        ->limit(1)
        ->get();

        return view('advertiser/data/detailtransaksi')->with('data',$data);
        // echo $data; 
    }

    public function addTransaksi(Request $r){
        $mytime = Carbon::now();
        $hariini = $mytime->toDateString();   
        try {
            //code...
            $data = new transaksiModel();
            $data->id_baliho = $r->id_baliho;
            $data->id_advertiser = $r->id_advertiser;
            $data->status = 'permintaan';
            $data->tanggal_transaksi = $hariini;
            $data->tanggal_awal = $r->mulai;
            $data->tanggal_akhir = $r->selesai;
            $data->save();
            return redirect()->back()->withInput();
        } catch (\Throwable $e) {
            //throw $th;
            $exData = explode('(', $e->getMessage());
                // Alert::error('Gagal \n' . $exData[0], 'Ooops');
                echo 'Gagal \n' . $exData[0], 'Ooops';
               // return redirect()->back()->withInput();
        }

    }
}
