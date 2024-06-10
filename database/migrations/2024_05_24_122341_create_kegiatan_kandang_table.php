<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanKandangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_kandang', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->string('kode_kandang');
            $table->foreign('kode_kandang')->references('id_kandang')->on('jenis_kandang')->onDelete('cascade');
            $table->date('tanggal_kegiatan');
            $table->text('kegiatan');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('kegiatan_sapi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kegiatan');
            $table->string('kode_sapi');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan_kandang')->onDelete('cascade');
            $table->date('tanggal_kegiatan');
            $table->foreign('kode_sapi')->references('id')->on('sapi')->onDelete('cascade');
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
        Schema::dropIfExists('kegiatan_sapi');
        Schema::dropIfExists('kegiatan_kandang');
    }
}
