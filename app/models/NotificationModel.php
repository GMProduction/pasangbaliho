<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    //

    protected $table = "notifikasi_advertiser";
    protected $primaryKey  = 'id_notif';

    protected $fillable = [
        'id_advertiser', 'judul', 'isi', 'id_transaksi', 'terlihat', 'created_at'
    ];
}
