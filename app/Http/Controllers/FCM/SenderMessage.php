<?php

namespace App\Http\Controllers\FCM;


use App\Http\Controllers\Controller;

class SenderMessage extends Controller
{


    public function toFcm()
    {
        fcm()
            ->to() // $recipients must an array
            ->priority('normal')
            ->timeToLive(0)
            ->data([
                'title' => 'Test FCM',
                'body' => 'This is a test of FCM',
            ])
            ->notification([
                'title' => 'Test FCM',
                'body' => 'This is a test of FCM',
            ])
            ->send();
    }
}
