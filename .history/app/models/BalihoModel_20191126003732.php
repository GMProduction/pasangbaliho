<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BalihoModel extends Model
{
    protected $table = "balihos";
    protected $primaryKey  = 'id_baliho';

    protected $fillable = [
        'id_client', 'kategori', 'nama_baliho', 'ukuran_baliho', 'provinsi', 'kota', 'alamat', 'latitude', 'longitude',
        'harga_client', 'harga_market', 'deskripsi', 'url_360', 'orientasi', 'venue', 'status', 'lebar', 'tinggi', 'luas'
    ];

}
