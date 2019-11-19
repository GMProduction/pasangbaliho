<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MemberModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tb_member', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('alamat');
            $table->string('telp');
            $table->string('status');
            $table->string('verifikasi');
            $table->rememberToken();
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
        Schema::dropIfExists('tb_member');
    }
}
