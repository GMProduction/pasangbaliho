<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    //
    protected $table = "payment";

    protected $fillable = [
        'id_transaksi', 'type', 'nominal', 'status', 'url', 'vendor', 'no_rekening', 'atas_nama', 'keterangan'
    ];
}
