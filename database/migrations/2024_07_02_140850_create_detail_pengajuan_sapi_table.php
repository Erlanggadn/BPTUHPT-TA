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
            $table->string('detail_id')->primary();
            $table->string('detail_pengajuan');
            $table->string('detail_jenis');
            $table->string('detail_kategori');
            $table->integer('detail_jumlah');
            $table->string('detail_kelamin');

            $table->foreign('detail_pengajuan')->references('belisapi_id')->on('master_pengajuan_sapi')->onDelete('cascade');
            $table->foreign('detail_jenis')->references('sjenis_id')->on('master_sapi_jenis')->onDelete('cascade');
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
