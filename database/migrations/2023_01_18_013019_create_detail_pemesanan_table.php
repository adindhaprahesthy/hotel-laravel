<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id_detail_pemesanan');
            $table->unsignedBigInteger('id_pemesanan');       
            $table->unsignedBigInteger('id_kamar'); 
            $table->date('tgl_akses');   
            $table->integer('harga'); 

            $table->foreign('id_pemesanan')->references('id_pemesanan')->on('pemesanan');
            $table->foreign('id_kamar')->references('id_kamar')->on('kamar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pemesanan');
    }
}
