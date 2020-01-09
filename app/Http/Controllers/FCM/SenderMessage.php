<?php

namespace App\Http\Controllers\FCM;


use App\Http\Controllers\Controller;
use App\models\FcmClientModel;
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

        $apikey = 'AAAAzHLmzn4:APA91bELGa2d7lWLg6-k8XB53ApPMbF-taXt8gLoC-eM8qY9XgpzR58Mc5APWacCUHIIhXDAHWpXcrj1SJJsk1JDFPaj0VhcF7P60EajfSkThp2I9OJS4Lh6kJOd1WCuRopnmBa9ozqG';
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
        $fcm = FcmClientModel::where('id_client', '1')
            ->latest()->first();

        $to = $fcm->fcm_token;

        $data = array(
            'title' => 'Pesan',
            'body' => 'Pesanan anda sudah dalam proses',
            'notification_priority' => 'high'
        );

        $apikey = 'AAAATRwbVhs:APA91bE9GDZMlZPKqdvEk6vyhFo_lAvVzCCA03ubskskjYrYTOtP1ZfhrsAjLfJ-ChmDcXNIuAaKCtXowDaWBNgO4LcSclXTMgtn-dUmpqICfpTNQNKs30eBHow5MLq63z5DgKlUt0YW';
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
