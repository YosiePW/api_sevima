<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaksinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaksins', function (Blueprint $table) {
            $table->bigIncrements('id_vaksin');
            $table->unsignedBigInteger('id_user');
            $table->string('nik')->unique();
            $table->string('no_telp');
            $table->string('tgl_lahir');
            $table->string('alamat');
            $table->enum('status', ['proses', 'vaksin1', 'vaksin2']);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaksins');
    }
}
