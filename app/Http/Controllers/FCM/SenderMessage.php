<?php

namespace App\Http\Controllers\FCM;


use App\Http\Controllers\Controller;

class SenderMessage extends Controller
{


    public function toFcm()
    {
        fcm()
            ->to('fc_bIrit9ew:APA91bHYHs-rbHxnL1z-rjAU7EzecZ8ygdpK6rQ82CGefb4xGHFUbWjFTnU_C0SD4FmPYzSL4CU3jcpGxpIUbfVI8TFt7QeA6KYTY1nuzp3SWeONz7kfrxqEFHe4NSxDFBfi5QCVoirG') // $recipients must an array
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
