<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id_client');
            $table->string('email', 191)->unique();
            $table->string('nama' , 150);
            $table->string('password', 191);
            $table->string('telp', 20);
            $table->string('nama_instansi', 191);
            $table->string('alamat', 191);
            $table->string('api_token', 191);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('mib', 100);
            $table->string('npwp', 100);
            $table->string('no_ktp', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('clients');
    }
}
