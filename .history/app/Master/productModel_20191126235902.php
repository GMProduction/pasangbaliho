<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    //

    protected $table = 'balihos';


    protected $fillable = [
        'id_client', 'id_baliho','kategori', 'nama_baliho', 'ukuran_baliho', 'provinsi', 'kota', 'alamat', 'latitude', 'longitude',
        'harga_client', 'harga_market', 'deskripsi', 'url_360', 'orientasi', 'venue', 'status', 'lebar', 'tinggi', 'luas' 
    ];

}
