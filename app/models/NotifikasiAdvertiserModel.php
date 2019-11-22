<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiAdvertiserModel extends Model
{
    protected $table = "notifikasi_advertiser";
    protected $primaryKey  = 'id_notif';

    protected $fillable = [
        'id_notif',
        'id_advertiser',
        'judul',
        'isi',
        'terbaca',
        'id_transaksi',
        'link'
    ];

}
