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
        $nom = str_replace(',', '', $r->nominal);
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




    function iPay88_signature($source)
    {
        return base64_encode(hex2bin(sha1($source)));
    }

    function hex2bin($hexSource)
    {
        for ($i = 0; $i < strlen($hexSource); $i = $i + 2) {
            $bin .= chr(hexdec(substr($hexSource, $i, 2)));
        }

        return $bin;
    }

    public function getResponse()
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

        $nomleng = strlen($amount);
        $subs = substr($amount, 0, $nomleng - 2);

        $merchankeySandbox = "5Z1cr9UxDk";
        $merhankeyProduksi = "xEXx3CJsGJ";
        $encrip = $merhankeyProduksi . $merchantcode . '' . $paymentid . '' . $refno . '' . $amount . $ecurrency . $estatus;

        $signatureBaru = $this->iPay88_signature($encrip);


        if ($signature == $signatureBaru) {

            switch ($estatus) {
                case "6":


                    try {
                        $payment = new PaymentModel;
                        $payment->id_transaksi = $refno;
                        $payment->vendor = "Gateway";
                        $payment->status = "pending";
                        $payment->id_reff = $transid;

                        $payment->nominal = $subs;
                        $payment->keterangan = $errdesc;
                        $payment->type = "payment Gateway";
                        $payment->save();
                        // return redirect()->back()->with($data);
                    } catch (\Throwable $th) {

                        //throw $th;
                        //return redirect()->back()->with($data);
                        echo $th;
                        error_log($th);
                    }
                    break;
                case "1":
                    try {
                        PaymentModel::updateOrCreate(
                            ["id_reff" => $transid],
                            ['keterangan' => $errdesc,
                            'id_transaksi' => $refno,
                            'vendor' => "Gateway",
                            'nominal' => $subs,
                            'status' => "terima",
                            'type' => "payment Gateway"
                            ]
                        );
                            echo "RECEIVEOK";

                        // return redirect()->back()->with($data);
                    } catch (\Throwable $th) {

                        //throw $th;
                        //return redirect()->back()->with($data);
                        echo $th;
                    }
                    break;
                default:
                    break;
            }
        }
    }
}
