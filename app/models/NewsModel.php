<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = "news";
    protected $primaryKey  = 'id_news';

    protected $fillable = [
        'id_news',
        'judul',
        'isi',
        'gambar',
        'link'
    ];

}
