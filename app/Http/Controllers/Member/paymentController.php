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
        $nom = str_replace(',','',$r->nominal);
        try {
            //code...
            // PaymentModel::insert(
            //     [
            //         'id_transaksi' => $id,
            //         'vendor' => $bank,
            //         'atas_nama' => $nama,
            //         'no_rekening' => $rek,
            //         'nominal' => $nom
            //     ]
            // );
            $insert = new PaymentModel();
            $insert->id_transaksi = $id;
            $insert->vendor = $bank;
            $insert->atas_nama = $nama;
            $insert->no_rekening = $rek;
            $insert->nominal = $nom;
            $insert->save();
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

    public function getResponse(Request $r)
    {

        $merchantcode     = $_REQUEST["MerchantCode"];
        $paymentid     = $_REQUEST["PaymentId"];
        $refno         = $_REQUEST["RefNo"];
        $amount     = $_REQUEST["Amount"];
        $ecurrency     = $_REQUEST["Currency"];
        $remark     = $_REQUEST["Remark"];
        $transid     = $_REQUEST["TransId"];
        $authcode     = $_REQUEST["AuthCode"];
        $estatus     = $_REQUEST["Status"];
        $errdesc     = $_REQUEST["ErrDesc"];
        $signature    = $_REQUEST["Signature"];

        switch ($estatus) {
            case "6":
                try {
                    $payment = new PaymentModel;
                    $payment->id_transaksi = $refno;
                    $payment->vendor = "Gateway";
                    $payment->status = "pending";
                    $payment->nominal = $amount;
                    $payment->type = "payment Gateway";
                    $payment->save();
                    // return redirect()->back()->with($data);
                } catch (\Throwable $th) {

                    //throw $th;
                    //return redirect()->back()->with($data);
                    echo $th;
                }
                break;
            case "1":
                try {
                    $data = [
                        "status" => "terima"
                    ];
                    PaymentModel::query()->where("id_transaksi", $refno)->update($data);
                    echo "RECEIVEOK";
                    // return redirect()->back()->with($data);
                } catch (\Throwable $th) {

                    //throw $th;
                    //return redirect()->back()->with($data);
                    echo $th;
                }
                break;
                break;
            default:
                break;
        }
    }
}
