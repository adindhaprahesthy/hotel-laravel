<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipe_kamar extends Model
{
    protected $table = 'tipe_kamar';
    protected $primarykey = 'id_tipe_kamar';
    public $timestamps = false;
    protected $fillable = ['nama_tipe_kamar','harga','deskripsi','foto'];

    use HasFactory;
}
