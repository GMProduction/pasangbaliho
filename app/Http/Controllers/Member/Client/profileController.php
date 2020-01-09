<?php

namespace App\Http\Controllers\Member\client;

use App\Http\Controllers\Controller;
use App\Master\clientModel;
use Illuminate\Http\Request;

class profileController extends Controller
{
    //
    public function getDataProfile(){
        if (auth()->guard('client')->check()) {
            $id = auth()->guard('client')->user()->id;
        }
        $query = clientModel::query()
            ->where('id','=',$id)
            ->get();

        $data = [
            'profile' => $query
        ];

        return view('client.data.profile')->with($data);
        // echo $query;

    }
}
