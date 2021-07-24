<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSakit extends Model
{
    protected $fillable = ['id_rumahsakit', 'provinsi', 'kota', 'nama_rs', 'alamat', 'jumlah_kamar'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = "r_sakits";
    protected $primaryKey = 'id_rumahsakit';
}
