<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProvinsiModel extends Model
{
    //
    protected $table = "provinsis";
    protected $primaryKey  = 'id_provinsi';

    protected $fillable = [
        'id_provinsi', 'nama_provinsi'
    ];
}
