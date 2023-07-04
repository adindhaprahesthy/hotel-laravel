<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id_pemesanan');
            $table->integer('nomor_pemesanan');    
            $table->string('nama_pemesan');
            $table->string('email_pemesan');
            $table->timestamp('tgl_pemesanan');
            $table->date('tgl_check_in');
            //$table->integer('durasi');  
            $table->date('tgl_check_out');
            $table->string('nama_tamu');
            $table->integer('jumlah_kamar'); 
            $table->unsignedBigInteger('id_tipe_kamar');  
            $table->enum('status_pemesanan', ['baru','check_in','check_out']);
            $table->unsignedBigInteger('id_user')->nullable();       

            $table->foreign('id_tipe_kamar')->references('id_tipe_kamar')->on('tipe_kamar');
            $table->foreign('id_user')->references('id_user')->on('users');
         
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
        Schema::dropIfExists('pemesanan');
    }
}
