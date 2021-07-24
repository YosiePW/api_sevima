<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $fillable = ['id_tanggapan', 'id_vaksin', 'tanggapan', 'id_petugas'];
    protected $table = "tanggapans";
    protected $primaryKey = "id_tanggapan";
}
