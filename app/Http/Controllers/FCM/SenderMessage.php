<?php

namespace App\Http\Controllers\FCM;


use App\Http\Controllers\Controller;
use App\models\FcmModel;

class SenderMessage extends Controller
{

    public function toFcm()
    {
        $fcm = FcmModel::where('id_advertiser', '6')
        ->latest()->first();

        $to = $fcm->fcm_token;

        $data = array(
            'title' => 'Pesan',
            'body' => 'Pesanan anda sudah dalam proses',
            'notification_priority' => 'high'
        );

        $apikey = 'AIzaSyDQOCnyw7NrB3HLJEHAhF4rxqTvuCzmFQc';
        $fields = array('to' => $to, 'notification' => $data);
        $header = array('Authorization: key=' . $apikey, 'Content-Type: application/json');
        $url = 'https://fcm.googleapis.com/fcm/send';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        return json_encode($result, true);
    }

    public function toFcmClient()
    {
        $fcm = FcmModel::where('id_advertiser', '6')
        ->latest()->first();

        $to = $fcm->fcm_token;

        $data = array(
            'title' => 'Pesan',
            'body' => 'Pesanan anda sudah dalam proses',
            'notification_priority' => 'high'
        );

        $apikey = 'AIzaSyCtVhkhcte1L7e7FDehHlUSIS98daGSrns';
        $fields = array('to' => $to, 'notification' => $data);
        $header = array('Authorization: key=' . $apikey, 'Content-Type: application/json');
        $url = 'https://fcm.googleapis.com/fcm/send';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        return json_encode($result, true);
    }
}
