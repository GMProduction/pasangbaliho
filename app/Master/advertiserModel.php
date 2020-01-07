<?php

namespace App\Master;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class advertiserModel extends Authenticatable
{
    //
    use Notifiable;

    protected $table = 'advertisers';

    protected $guard = 'advertiser';

    protected $fillable = [
        'nama','email','password','telp','alamat','status','verifikasi', 'nama_instansi', 'api_token', 'email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
