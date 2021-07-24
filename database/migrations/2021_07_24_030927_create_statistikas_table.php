<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatistikasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistikas', function (Blueprint $table) {
            $table->bigIncrements('id_statistik');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('positif');
            $table->string('sembuh');
            $table->string('meninggal');
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
        Schema::dropIfExists('statistikas');
    }
}
