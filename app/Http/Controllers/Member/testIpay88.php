<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Master\transaksiModel;
use Illuminate\Support\Carbon;
use App\models\NotificationModel;
use Illuminate\Support\Facades\DB;

class testIpay88 extends Controller
{
    //
    public function index()
    {
        return view('test.testIpay');
    }


    public function posIpay()
    {

        $url = "https://sandbox.ipay88.co.id/epayment/entry.asp";

        //create array of data to be posted
        $post_data['MerchantCode'] = 'ID01270';
        $post_data['PaymentId'] = 26;
        $post_data['RefNo'] = '10000124';
        $post_data['Amount'] = 1000000;
        $post_data['Currency'] = 'IDR';
        $post_data['ProdDesc'] = 'Pasang Baliho';
        $post_data['UserName'] = 'Taufik';
        $post_data['UserEmail'] = 'pradanamahendra@gmail.com';
        $post_data['UserContact'] = '08975552512';
        $post_data['Remark'] = '';
        $post_data['Lang'] = 'UTF-8';
        $post_data['Signature'] = 'uBdSzNbroZTUo9BK1S5DAgtXGsc=';
        $post_data['ResponseURL'] = "https://www.pasangbaliho.com";
        $post_data['BackendURL'] = "https://www.pasangbaliho.com";

        //traverse array and prepare data for posting (key1=value1)
        foreach ($post_data as $key => $value) {
            $post_items[] = $key . '=' . $value;
        }

        //create the final string to be posted using implode()
        $post_string = implode('&', $post_items);

        //create cURL connection
        $curl_connection = curl_init($url);

        //set options
        curl_setopt($curl_connection, CURLOPT_POST, true);
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
        //set data to be posted
        curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

        //perform our request
        $result = curl_exec($curl_connection);

        //show information regarding the request
        // print_r(curl_getinfo($curl_connection));
        // echo curl_errno($curl_connection) . '-' . curl_error($curl_connection);
        echo $result;

        //close the connection
        curl_close($curl_connection);
    }
}
