<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class transaksiModel extends Model
{
    //

    use Notifiable;
    
    protected $table = 'transaksi';

    protected $guard = 'advertiser';

    protected $fillable = [
        'id_baliho','id_advertiser','harga_ditawarkan','harga_deal','status','status_pembayaran','tanggal_transaksi', 'tanggal_awal', 'tanggal_akhir'
    ];

    

}
