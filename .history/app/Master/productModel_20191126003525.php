<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    //

    protected $table = 'balihos';


    protected $fillable = [
        'id_client', 'kategori', 'nama_baliho', 'ukuran_baliho', 'provinsi', 'kota', 'alamat', 'latitude', 'logitude',
        'harga_client', 'harga_market', 'deskripsi', 'url_360'
    ];

}
