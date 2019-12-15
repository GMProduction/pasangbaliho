<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FcmClientModel extends Model
{
    protected $table = "fcm_client";
    protected $primaryKey  = 'id_fcm';

    protected $fillable = [
        'id_fcm', 'id_client', 'fcm_token'
    ];

}
