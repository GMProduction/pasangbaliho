<?php

namespace App\models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class AdminModel extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'admin';
    //

    protected $fillable = [
        'username',  'password', 'role', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
