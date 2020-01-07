<?php

namespace App\Http\Controllers\Member\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BalihoModel;
use Illuminate\Support\Facades\DB;

class clientController extends Controller
{
    //
    function jumMedia($id){
        $media = BalihoModel::query()
            ->select(DB::raw('count(*) as count'))
            ->where('id_client','=',$id)
            ->get();
        return $media;
    }

    public function showDashboard()
    {
        if (auth()->guard('client')->check()) {
            $id = auth()->guard('client')->user()->id;
        }
        $media = $this->jumMedia($id);

        $data = [
            'media' => $media
        ];
        return view('client.index')->with($data);
    }
    
    public function showProfile(){
       
    }

    public function showAsset(){
        return view('client.data.asset');
    }
}