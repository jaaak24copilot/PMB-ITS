<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa',function(Blueprint $table){
            $table->id();
            $table->string('nama');
            $table->string('alamat_ktp');
            $table->string('alamat_saat_ini');
            $table->string('kecamatan_ktp');
            $table->string('kabupaten_ktp');
            $table->string('provinsi_ktp');
            $table->string('no_tlp')->nullable();
            $table->string('no_hp');
            $table->string('email');
            $table->string('kewarganegaraan');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('kabupaten_saat_ini');
            $table->string('provinsi_saat_ini');
            $table->string('jenis_kelamin');
            $table->string('status_perkawinan');
            $table->string('agama');
            $table->integer('status');
            //user id
            $table->unsignedBigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};
