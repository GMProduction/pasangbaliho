<?php

namespace App\Http\Controllers\FCM;


use App\Http\Controllers\Controller;
use App\models\AdvertiserModel;
use App\models\FcmModel;

class SenderMessage extends Controller
{


    public function sendNotificaton()
    { }

    public function toFcm()
    {
        $fcm = FcmModel::where('id_advertiser', '6')
            ->last();
        $to = $fcm->fcm_token;

        $data = array(
            'title' => 'Pesan',
            'body' => 'Pesanan anda sudah dalam proses',
            'notification_priority' => 'high'
        );

        $apikey = 'AAAAAkPEgO0:APA91bHHWjxxeA6d66UHQezAKGc7IiQ-DTt64daEsYx6PLHPuB0cUQSDke3lrQ2GzTojdViVqIViFbJGsJcGiWZVb-Lgj51HWTe91Zq1rP21Taw2SpwrTY9D8M3EWCg-6QGcPYtTk_0B';
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
