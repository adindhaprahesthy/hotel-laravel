<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'id_detaiL_pemesanan';
    public $timestamps = false; 

    protected $fillable = ['id_pemesanan', 'id_kamar', 'tgl_akses', 'harga'];

    public function pemesanan(){
        return $this->belongsTo('App\pemesanan', 'id_pemesanan', 'id_pemesanan'); 
    }

    public function kamar(){
        return $this->belongsTo('App\kamar', 'id_kamar', 'id_kamar'); 
    }
}
