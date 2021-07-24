<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistika extends Model
{
    protected $fillable = ['id_statistik', 'provinsi', 'kota', 'positif', 'sembuh', 'meninggal'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = "statistikas";
    protected $primaryKey = 'id_statistik';
}
