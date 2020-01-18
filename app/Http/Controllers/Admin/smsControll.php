<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewSaleOccurred;


class smsControll extends Controller
{
    //
    public function sms(Request $request){
        $payload = $request->all();
 
        if($payload['type'] == 'charge.succeeded'){
           Notification::route('nexmo', config('services.nexmo.sms_to'))
                        ->notify(new NewSaleOccurred($payload));
        }
 
        return response('Webhook received');
    }
}
