<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FotoBalihoModel extends Model
{
    protected $table = "foto_baliho";
    protected $primary = 'id_foto';

    protected $fillable = [
        'id_foto','id_baliho','url_foto'
    ];

}
