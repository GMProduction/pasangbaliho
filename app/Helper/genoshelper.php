<?php

use App\models\FcmClientModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\models\FcmModel;

function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

function formatDate($tanggal)
{
    return date("Y-m-d", strtotime($tanggal));
}

function formatDateToSurat($tanggal)
{
    return date("d-M-Y", strtotime($tanggal));
}

function formatuang($angka)
{
    return  number_format($angka, 0, '', '.');
}

function hargaafterdiskon($diskon, $hargajual)
{
    $disctemp = ($diskon * $hargajual) / 100;
    $hasil = $hargajual - $disctemp;
    return 'Rp. ' . number_format($hasil, 0, ',', '.');
}

function berapaMenitSekarang($j)
{
    $c = Carbon::now();
    $d = $c->diffInMinutes($j);
    $jam = $c->diffInHours($j);
    if ($d <= 60) {
        $d = $d . ' Minutes Ago';
    } else if ($d > 60 && $jam <= 24) {
        $d = $c->diffInHours($j) . ' Hours Ago';
    } else if ($jam > 24) {
        $d = $c->diffInDays($j) . ' Days Ago';
    }
    return $d;
}

function getCountNotif($id)
{

    $query = DB::table('notifikasi_advertiser')
        ->select(DB::raw('count(*) as count'))
        ->where('id_advertiser', '=', $id)
        ->get();



    return $query;
}

function getToken()
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://x.rajaapi.com/poe",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return $data['token'];
}


function getProvince($token)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://x.rajaapi.com/MeP7c5ne" . $token . "/m/wilayah/provinsi",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return $data['data'];
}

function getCities($token, $idprovince)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://x.rajaapi.com/MeP7c5ne" . $token . "/m/wilayah/kabupaten?idpropinsi=" . $idprovince,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return $data['data'];
}

function sendNotifAdvertiser($idAdvertiser, $tittle, $body)
{
    $fcm = FcmModel::where('id_advertiser', $idAdvertiser)
        ->latest()->first();

    $to = $fcm->fcm_token;

    $data = array(
        'title' => $tittle,
        'body' => $body,
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
    // return json_encode($result, true);
}

function sendNotifClient($idClient, $tittle, $body)
{
    $fcm = FcmClientModel::where('id_client', $idClient)
        ->latest()->first();

    $to = $fcm->fcm_token;

    $data = array(
        'title' => $tittle,
        'body' => $body,
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
    // return json_encode($result, true);
}
