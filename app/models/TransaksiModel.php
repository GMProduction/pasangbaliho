<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = "transaksi";
    protected $primary = 'idTransaksi';

    protected $fillable = [
        'idTransaksi',
        'id_baliho',
        'id_advertiser',
        'harga_ditawarkan',
        'harga_deal',
        'status',
        'status_pembayaran',
        'tanggal_transaksi',
        'tanggal_awal',
        'tanggal_akhir',
        'created_at',
        'updated_at'
    ];
}
