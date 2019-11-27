<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ClientModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';

    protected $guard = 'client';

    protected $fillable = [
        'nama','email','password','telp','alamat','perusahaan'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
