<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FcmModel extends Model
{
    protected $table = "fcm";
    protected $primaryKey  = 'id_fcm';

    protected $fillable = [
        'id_fcm', 'id_advertiser', 'fcm_token'
    ];

}
