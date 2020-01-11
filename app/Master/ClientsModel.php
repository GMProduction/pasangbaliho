<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ClientsModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';
    protected $guard = 'client';
    protected $fillable = [
        'nama','email','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
