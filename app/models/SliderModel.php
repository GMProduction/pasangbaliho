<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
    protected $table = "slider";
    protected $primary = 'id_slider';

    protected $fillable = [
        'id_slider',
        'title',
        'deskripsi',
        'link',
        'url_foto'
    ];

}
