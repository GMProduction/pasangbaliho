<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $table = "kategoris";
    protected $primaryKey  = 'id_kategori';

    protected $fillable = [
        'id_kategori', 'kategori'
    ];

}
