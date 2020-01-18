<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class foto_transaksiModel extends Model
{
    //
    protected $table = 'foto_transaksi';

    protected $fillable = [
        'id_transaksi',
        'img'
    ];

}
