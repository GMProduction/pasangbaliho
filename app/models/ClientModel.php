<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ClientModel extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_client';
    protected $table = 'clients';

    protected $guard = 'client';

    protected $fillable = [
        'id_client',
        'email',
        'nama', 
        'nama_instansi',
        'password',
        'no_ktp', 
        'npwp', 
        'nib', 
        'telp',
        'alamat',
        'status',
        'api_token',
        'email_verifed_at', 
        'remember_token', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
