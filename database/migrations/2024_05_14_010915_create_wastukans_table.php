<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWastukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     ** @return void
     */
    public function up()
    {
        Schema::create('wastukans', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->bigInteger('nomor_lahan');
            $table->string('kode_pakan', 50);
            $table->date('tanggal_tanam');
            $table->date('tanggal_panen')->nullable();
            $table->string('kegiatan');
            $table->bigInteger('berat');
            $table->string('status');
            $table->string('pesan')->nullable();
            $table->timestamps();

            $table->foreign('kode_pakan')->references('kode_rumput')->on('rumputs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wastukans');
    }
}
