<?php

namespace App\Master;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class clientModel extends Authenticatable
{
    //
    use Notifiable;

    protected $table = 'clients';



    protected $fillable = [
        'nama','email','password','telp','alamat','nama_instansi', 'nib','npwp','no_ktp'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
