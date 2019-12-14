<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendEmail;

class MailSender extends Controller
{
    //
    public function send(Request $r){
        
        try {
            $fullpath = '';
            if ($r->hasFile('lampiran')) {
                # code...
                $lampiran = $r->file('lampiran');
                $path = $lampiran->getPath();
                $nama = $lampiran->getClientOriginalName();
                $fullpath  = $path.'/'.$nama; 
            }
            Mail::to('damn.john88@gmail.com')->send(new sendEmail($fullpath));
            return response()->json(['status' => $r->lampiran, 'path' => $path]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => 'failed'.$fullpath]);
        }
        
    }
}
