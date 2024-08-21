<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPengajuanSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pengajuan_sapi', function (Blueprint $table) {
            $table->string('belisapi_id', 30)->primary();
            // IDENTITAS PEMBELI
            $table->string('belisapi_orang', 30);
            $table->bigInteger('belisapi_nohp');
            $table->string('belisapi_alamat', 255);
            $table->string('belisapi_surat');
            $table->date('belisapi_tanggal');
            $table->string('belisapi_alasan', 255);
            // KEPALA BALAI
            $table->string('belisapi_status', 30);
            $table->string('belisapi_keterangan', 255);
            $table->timestamps();

            $table->foreign('belisapi_orang')->references('pembeli_id')->on('pembeli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pengajuan_sapi');
    }
}
