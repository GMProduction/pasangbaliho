<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class BalihoModel extends Model
{
    use Notifiable;
    use HasApiTokens, Notifiable;
    protected $table = "balihos";
    protected $primary = 'id_baliho';

    protected $fillable = [
        'id_client', 'kategori', 'nama_baliho', 'ukuran_baliho', 'provinsi', 'kota', 'alamat', 'latitude', 'logitude',
        'min_harga', 'max_harga', 'deskripsi', 'url_360'
    ];

}
