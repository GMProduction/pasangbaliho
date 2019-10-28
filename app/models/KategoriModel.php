<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $table = "katetogis";
    protected $primary = 'id_kategori';

    protected $fillable = [
        'id_kategori', 'kategori'
    ];

}
