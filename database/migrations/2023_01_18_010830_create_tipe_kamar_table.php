<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_kamar', function (Blueprint $table) {
            $table->bigIncrements('id_tipe_kamar');
            $table->string('nama_tipe_kamar');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->text('foto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_kamar');
    }
}