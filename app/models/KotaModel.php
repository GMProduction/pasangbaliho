<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class KotaModel extends Model
{
    protected $table = "kotas";
    protected $primary = 'id_kota';

    protected $fillable = [
        'id_kota', 'id_provinsi', 'nama_kota'
    ];

}
