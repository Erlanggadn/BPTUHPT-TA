<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapiJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sapi_juals', function (Blueprint $table) {
            $table->id('id_jual');
            $table->string('kode_sapi');
            $table->string('jenis_sapi');
            $table->string('status');
            $table->date('tgl_siap');
            $table->timestamps();

            $table->foreign('kode_sapi')->references('id')->on('sapi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sapi_juals');
    }
}
