<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\productModel;

class indexController extends Controller
{
    //

    public function index(){
        $product = productModel::query()
            ->take(8)
            ->get();

        $data =[
            'produk' => $product
        ];

        return view('main/index')->with($data);
       //echo $product;
    }

}
