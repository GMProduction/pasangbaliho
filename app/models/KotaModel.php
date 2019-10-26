<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class KotaModel extends Model
{
    use Notifiable;
    use HasApiTokens, Notifiable;
    protected $table = "kotas";
    protected $primary = 'id_kota';

    protected $fillable = [
        'id_kota', 'id_provinsi', 'nama_kota'
    ];

}
