<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengajuanSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengajuan_sapi', function (Blueprint $table) {
            $table->string('detail_id', 30)->primary();
            $table->string('belisapi_id', 30);
            $table->string('sjenis_id', 30);
            $table->string('detail_kategori', 30);
            $table->integer('detail_jumlah');
            $table->integer('detail_berat');
            $table->string('detail_kelamin', 30);

            $table->foreign('belisapi_id')->references('belisapi_id')->on('master_pengajuan_sapi')->onDelete('cascade');
            $table->foreign('sjenis_id')->references('sjenis_id')->on('master_sapi_jenis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengajuan_sapi');
    }
}
