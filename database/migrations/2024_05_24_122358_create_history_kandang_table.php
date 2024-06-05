<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryKandangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_kandang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sapi');
            $table->string('kode_kandang');
            $table->string('kegiatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();

            $table->foreign('kode_sapi')->references('id')->on('sapi')->onDelete('cascade');
            $table->foreign('kode_kandang')->references('id_kandang')->on('jenis_kandang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_kandang');
    }
}
