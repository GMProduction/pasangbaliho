<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class AdvertiserModel extends Authenticatable
{
    use Notifiable;
    use HasApiTokens, Notifiable;
    protected $table = "advertisers";
    protected $primaryKey  = 'id';

    protected $fillable = [
        'id', 'email', 'nama', 'password', 'telp', 'alamat', 'fcm_token_android'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
