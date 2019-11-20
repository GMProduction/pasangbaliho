<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\productModel;
use App\Master\transaksiModel;

class productController extends Controller
{
    //
    public function detailProduct(Request $req){
        $product = productModel::query()
        ->select('balihos.*','tanggal_awal','tanggal_akhir')
        ->leftJoin('transaksi','balihos.id_baliho', 'transaksi.id_baliho')
        ->where('balihos.id_baliho','=', $req->id)
        ->get();

        $dipesan = transaksiModel::query()
        ->where('id_baliho','=',$req->id)
        ->get();

        $data = [
            'produkDetail' => $product,
            'dipesan' => $dipesan
        ];

        return view('main/detailproduct')->with($data);
        // echo $product;
    }

    public function showProduct(){
        $product = productModel::query()
        ->paginate(12);

    $data =[
        'produk' => $product
    ];

    return view('main/product')->with($data);
    }

}
