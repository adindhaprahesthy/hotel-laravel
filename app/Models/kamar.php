<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kamar extends Model
{
    protected $table = 'kamar';
    protected $primarykey = 'id_kamar';
    public $timestamps = false;
    protected $fillable = ['nomor_kamar','id_tipe_kamar'];

    use HasFactory;
}
