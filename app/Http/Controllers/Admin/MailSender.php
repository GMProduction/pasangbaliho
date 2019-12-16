<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Storage;

class MailSender extends Controller
{
    //
    public function send(Request $r){
        try {
            if ($r->hasFile('lampiran')) {
                $lampiran = $r->file('lampiran');
                Mail::to('damn.john88@gmail.com')->send(new sendEmail($lampiran));
                return response()->json(['status' => 'success', 'data' => 'delivered']);
            }else{
                return response()->json(['status' => 'success', 'data' => 'failed']);
            }
        } catch (\Exception $th) {
            return response()->json(['status' => 'failed', 'Exception' => $th]);
        }
        
    }
}
