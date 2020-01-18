<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BalihoModel extends Model
{
    protected $table = "balihos";
    protected $primaryKey  = 'id_baliho';

    protected $fillable = [
        'id_baliho',
        'id_client',
        'id_kategori',
        'nama_baliho', 
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
        'tampilan', 
        'posisi', 
        'deskripsi', 
        'url_360',
        'status',
    ];

}
