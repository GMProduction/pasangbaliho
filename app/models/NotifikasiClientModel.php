<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiClientModel extends Model
{
    protected $table = "notifikasi_client";
    protected $primaryKey  = 'id_notif';

    protected $fillable = [
        'id_notif',
        'id_client',
        'judul',
        'isi',
        'terlihat',
        'id_transaksi'
    ];

}
