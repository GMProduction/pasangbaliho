<?php

namespace App\Http\Controllers\FCM;


use App\Http\Controllers\Controller;

class SenderMessage extends Controller
{


    public function sendNotificaton()
    { }

    public function toFcm()
    {
        $to = "fc_bIrit9ew:APA91bHYHs-rbHxnL1z-rjAU7EzecZ8ygdpK6rQ82CGefb4xGHFUbWjFTnU_C0SD4FmPYzSL4CU3jcpGxpIUbfVI8TFt7QeA6KYTY1nuzp3SWeONz7kfrxqEFHe4NSxDFBfi5QCVoirG";
        $data = array(
            'title' => 'Pesan',
            'body' => 'Pesanan anda sudah dalam proses'
            'icon' => 'https://www.google.com/url?sa=i&source=images&cd=&ved=2ahUKEwiqp-bwruvlAhUKto8KHSLdACwQjRx6BAgBEAQ&url=https%3A%2F%2Fthenounproject.com%2Fterm%2Ftest%2F&psig=AOvVaw0bYw5OCCOgcqEVjQmjMQdJ&ust=1573878079052673'
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
