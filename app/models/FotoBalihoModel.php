<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class FotoBalihoModel extends Model
{
    use Notifiable;
    use HasApiTokens, Notifiable;
    protected $table = "foto_baliho";
    protected $primary = 'id_foto';

    protected $fillable = [
        'id_foto','id_baliho','url_foto'
    ];

}
