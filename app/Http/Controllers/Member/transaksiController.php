<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\transaksiModel;
use App\models\foto_transaksiModel;
use App\models\PaymentModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use Image;

class transaksiController extends Controller
{



    //
    public function showBerlangsung()
    {
        $id = auth()->guard('advertiser')->user()->id;

        $query = transaksiModel::query()
            ->select(
                'transaksi.*',
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
            // DB::raw('(select url_foto from foto_baliho, transaksi where foto_baliho.id_baliho = transaksi.id_baliho limit 1) as url_foto'))
            ->leftJoin('balihos', 'transaksi.id_baliho', 'balihos.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->leftJoin('foto_baliho', 'transaksi.id_baliho', 'foto_baliho.id_baliho')
            ->groupBy('transaksi.id_transaksi', 'balihos.id_baliho')
            // ->leftJoin('foto_baliho', function($join){
            //     $join->on('transaksi.id_baliho','=','foto_baliho.id_baliho')
            //         ->limit(1);
            // })
            // ->leftJoin('foto_baliho','transaksi.id_baliho','foto_baliho.id_baliho')
            ->where('id_advertiser', '=', $id)
            ->where('transaksi.status', '!=', 'selesai')
            ->get();

        $data = [
            'trans' => $query
        ];

        return view('advertiser/data/transaksiberlangsung')->with($data);
        // echo $data;
    }

    public function showDetailTransaksi($r)
    {

        if (auth()->guard('advertiser')->check()) {
            $id = auth()->guard('advertiser')->user()->id;
        }

        $transaksi = TransaksiModel::query()
            ->join('advertisers', 'transaksi.id_advertiser', '=', 'advertisers.id')
            ->join('balihos', 'transaksi.id_baliho', '=', 'balihos.id_baliho')
            ->join('kategoris', 'balihos.id_kategori', '=', 'kategoris.id_kategori')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftJoin('foto_baliho', 'transaksi.id_baliho', 'foto_baliho.id_baliho')
            ->where('id_transaksi', '=', $r)
            ->select(
                'id_transaksi',
                'advertisers.id as idAdvertiser',
                'advertisers.nama as namaAdvertiser',
                'advertisers.nama_instansi as namaInstansi',
                'transaksi.id_baliho as idBaliho',
                'balihos.nama_baliho as nama_baliho',
                'balihos.harga_market as harga_market',
                'provinsis.nama_provinsi as provinsi',
                'balihos.alamat as alamat',
                'balihos.id_kategori as idKategori',
                'kategoris.kategori as kategori',
                'foto_baliho.url_foto as url_foto',
                'kotas.nama_kota as kota',
                'transaksi.status',
                'tanggal_transaksi',
                'tanggal_awal',
                'tanggal_akhir',
                'harga_deal',
                DB::raw('(IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0)) as Pembayaran'),
                DB::raw('transaksi.harga_deal - (IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0)) as saldo'),
                DB::raw('(SELECT IF((transaksi.harga_deal - (IFNULL((SELECT SUM(payment.nominal) FROM payment WHERE payment.id_transaksi = transaksi.id_transaksi AND payment.status = "terima") ,0))) > 0,"Belum Lunas", "Lunas")) as paymentStatus')
            )
            ->get();

        $data = transaksiModel::query()
            ->select(
                'transaksi.*',
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
                'foto_baliho.url_foto as url_foto',
                'advertisers.nama as namaAd',
                'advertisers.email as email',
                'advertisers.telp as telp'
            )
            ->leftJoin('balihos', 'transaksi.id_baliho', 'balihos.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->leftJoin('foto_baliho', 'transaksi.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('advertisers', 'transaksi.id_advertiser', 'advertisers.id')
            ->where('id_transaksi', '=', $r)
            ->limit(1)
            ->get();

        $pamyent = PaymentModel::query()
            ->where('id_transaksi', '=', $r)
            ->get();

        $trans = [
            'data' => $transaksi,
            'payment' => $pamyent
        ];

        return view('advertiser/data/detailtransaksi')->with($trans);
        // echo $data;
    }

    public function addTransaksi(Request $r)
    {
        $mytime = Carbon::now();
        $hariini = $mytime->toDateString();

        try {
            //code...
            $messege = [
                'status' => 'Pemesanan anda akan segera kami proses, Silahkan cek dashboard anda',
                'icon' => 'success'
            ];
            $data = new transaksiModel();
            $data->id_baliho = $r->id_baliho;
            $data->id_advertiser = $r->id_advertiser;
            $data->status = 'permintaan';
            $data->tanggal_transaksi = $hariini;
            $data->harga_deal = $r->harga;
            $data->tanggal_awal = $r->mulai;
            $data->tanggal_akhir = $r->selesai;
            $data->save();
            return redirect()->back()->withInput()
                ->with($messege);
        } catch (\Throwable $e) {
            $messege = [
                'status' => 'Pemesanan anda gagal kami proses',
                'icon' => 'warning'
            ];
            //throw $th;
            $exData = explode('(', $e->getMessage());
            // Alert::error('Gagal \n' . $exData[0], 'Ooops');
            echo 'Gagal \n' . $exData[0], 'Ooops';
            // return redirect()->back()->withInput();
            return redirect()->back()->withInput()
                ->with($data);
        }
    }

    public function showpayment(Request $request)
    {
        $data = transaksiModel::query()
            ->select(
                'transaksi.*',
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
                'foto_baliho.url_foto as url_foto',
                'advertisers.nama as namaAd',
                'advertisers.email as email',
                'advertisers.telp as telp'
            )
            ->leftJoin('balihos', 'transaksi.id_baliho', 'balihos.id_baliho')
            ->leftjoin('kotas', 'balihos.id_kota', 'kotas.id_kota')
            ->leftjoin('provinsis', 'kotas.id_provinsi', 'provinsis.id_provinsi')
            ->leftjoin('kategoris', 'balihos.id_kategori', 'kategoris.id_kategori')
            ->leftJoin('foto_baliho', 'transaksi.id_baliho', 'foto_baliho.id_baliho')
            ->leftjoin('advertisers', 'transaksi.id_advertiser', 'advertisers.id')
            ->where('id_transaksi', '=', $request->request)
            ->limit(1)
            ->get();

        $trans = [
            'data' => $data
        ];

        return view('advertiser/data/payment')->with($trans);
    }

    public function editFoto(Request $r)
    {
        if ($r->hasFile('foto')) {
            $image = $r->file('foto');
            $imageName = $r->id . '.' . $image->getClientOriginalExtension();
            $imageSave = Image::make($image->getRealPath());
            $imageSave->save(public_path('assets/img/buktiTrans/' . $imageName));
        } else {
            $imageName = '';
        }

        try {
            $id = $r->id;
            $data = [
                'img' => $imageName
            ];
            foto_transaksiModel::updateOrCreate(
                [
                    'img' => $imageName,

                ],
                [
                    'id_transaksi' => $id,
                    'img' => $imageName
                ]
            );
            return view('dashboard/berlangsung/detail/payment/' . $id);
        } catch (\Throwable $th) {
            //throw $th;
            echo 'sad' . $th;
        }
    }
}
