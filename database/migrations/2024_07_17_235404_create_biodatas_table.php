<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
           $table->bigIncrements('id_biodata');
           $table->unsignedBigInteger('id_user');
           $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
           $table->string('nik',20)->nullable();
           $table->enum('jenis_kelamin',['L','P'])->nullable();
           $table->string('telepon',50)->nullable();
           $table->text('alamat')->nullable();
           $table->string('foto')->nullable();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodata');
    }
}
