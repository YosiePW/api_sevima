<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRSakitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_sakits', function (Blueprint $table) {
            $table->bigIncrements('id_rumahsakit');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('nama_rs');
            $table->string('alamat');
            $table->string('jumlah_kamar');
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
        Schema::dropIfExists('r_sakits');
    }
}
