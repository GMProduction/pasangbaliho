<?php

namespace App\Http\Controllers\FCM;


use App\Http\Controllers\Controller;
use Benwilkins\FCM\FcmMessage;

class SenderMessage extends Controller
{

    public function via()
    {
        return ['fcm'];
    }

    public function toFcm()
    {
        $message = new FcmMessage();
        $message->content([
            'title'        => 'Foo',
            'body'         => 'Bar',
            'sound'        => '', // Optional
            'icon'         => '', // Optional
            'click_action' => '' // Optional
        ])->data([
            'param1' => 'baz' // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.

        return $message;
    }
}
