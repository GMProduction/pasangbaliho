<?php

namespace App\Master;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class memberModel extends Authenticatable
{
    //
    use Notifiable;
    
    protected $table = 'tb_member';

    protected $guard = 'member';

    protected $fillable = [
        'nama','email','password','telp','alamat','status','verifikasi'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
