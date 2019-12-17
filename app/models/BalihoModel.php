<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BalihoModel extends Model
{
    protected $table = "balihos";
    protected $primaryKey  = 'id_baliho';

    protected $fillable = [
        'id_client',
        'id_kategori',
        'nama_baliho', 
        'id_provinsi', 
        'id_kota', 
        'lebar', 
        'tinggi' , 
        'luas', 
        'alamat', 
        'latitude', 
        'longitude',
        'harga_client', 
        'harga_market', 
        'orientasi', 
        'posisi', 
        'tampilan', 
        'deskripsi', 
        'url_360',
        'status',
    ];

}
