<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MitraModel extends Model
{
    //
    protected $table = "clients";
    protected $primaryKey  = 'id_client';

    protected $fillable = [
        'email', 'nama', 'nama_instansi', 'status', 'password', 'mib', 'npwp', 'no_ktp', 'telp', 'alamat', 'api_token', 'email_verifed_at', 'remember_token'
    ];
}
