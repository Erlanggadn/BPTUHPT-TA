<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengajuanRumputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengajuan_rumput', function (Blueprint $table) {
            $table->string('drumput_id')->primary();
            $table->string('drumput_pengajuan');
            $table->string('drumput_jenis');
            $table->string('drumput_kategori');
            $table->integer('drumput_berat');
            $table->string('drumput_satuan');
            $table->timestamps();

            $table->foreign('drumput_pengajuan')->references('belirum_id')->on('master_pengajuan_rumput')->onDelete('cascade');
            $table->foreign('drumput_jenis')->references('rum_id')->on('master_rumput_jenis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengajuan_rumput');
    }
}
