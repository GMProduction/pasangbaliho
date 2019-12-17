<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = "transaksi";
    protected $primaryKey  = 'id_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_baliho',
        'id_advertiser',
        'harga_ditawarkan',
        'harga_deal',
        'status',
        'status_pembayaran',
        'tanggal_transaksi',
        'tanggal_awal',
        'tanggal_akhir',
        'terbaca_client',
        'terbaca_advertiser'
    ];
}
