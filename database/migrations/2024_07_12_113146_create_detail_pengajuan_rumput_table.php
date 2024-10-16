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
            $table->string('drumput_id', 30)->primary();
            $table->string('belirum_id', 30);
            $table->string('rum_id', 30);
            $table->string('drumput_kategori', 30);
            $table->integer('drumput_berat');
            $table->string('drumput_satuan', 30);
            $table->timestamps();

            $table->foreign('belirum_id')->references('belirum_id')->on('master_pengajuan_rumput')->onDelete('cascade');
            $table->foreign('rum_id')->references('rum_id')->on('master_rumput_jenis')->onDelete('cascade');
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
