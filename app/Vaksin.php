<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaksin extends Model
{
    protected $fillable = ['id_vaksin', 'nik', 'id_user', 'no_telp', 'tgl_lahir', 'status', 'alamat'];
    protected $table = "vaksins";
    protected $primaryKey = 'id_vaksin';


    public function tanggapan() {
        return $this->belongsTo('App\Tanggapan','id_vaksin','id_vaksin');
    }

    public function user() {
        return $this->belongsTo('App\User','id_user','id');
    }
}
