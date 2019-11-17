<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BalihoModel extends Model
{
    protected $table = "balihos";
    protected $primaryKey  = 'id_baliho';

    protected $fillable = [
        'id_client', 'kategori', 'nama_baliho', 'ukuran_baliho', 'provinsi', 'kota', 'alamat', 'latitude', 'logitude',
        'min_harga', 'max_harga', 'deskripsi', 'url_360'
    ];

}
