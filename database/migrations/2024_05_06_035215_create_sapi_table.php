<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sapi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('jenis');
            $table->integer('urutan_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_induk');
            $table->string('riwayat_penyakit')->default('tidak ada');
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
        Schema::dropIfExists('sapi');
    }
}
