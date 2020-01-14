<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\models\PaymentModel;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    //
    public function addPayment(Request $r)
    {
        $id = $r->idTrans;
        $bank = $r->bank;
        $rek = $r->rekening;
        $nama = $r->nama;
        try {
            //code...
            PaymentModel::insert(
                [
                    'id_transaksi' => $id,
                    'vendor' => $bank,
                    'atas_nama' => $nama,
                    'no_rekening' => $rek
                ]
            );
            $data = [
                'status' => 'berhasil',
                'text' => 'Berhasil',
                'icon' => 'success'
            ];
            return redirect()->back()->with($data);
        } catch (\Throwable $th) {
            $data = [
                'status' => 'gagal',
                'text' => 'gagal' . $th,
                'icon' => 'warning'
            ];
            //throw $th;
           //return redirect()->back()->with($data);
            echo $th;
        }
    }
}
