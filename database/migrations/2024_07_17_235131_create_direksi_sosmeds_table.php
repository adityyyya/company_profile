<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireksiSosmedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direksi_sosmed', function (Blueprint $table) {
            $table->bigIncrements('id_direksi_sosmed');
            $table->unsignedBigInteger('id_direksi');
            $table->foreign('id_direksi')->references('id_direksi')->on('direksi')->onDelete('cascade');
            $table->enum('jenis',['facebook','instagram','linkedin']);
            $table->text('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direksi_sosmed');
    }
}
