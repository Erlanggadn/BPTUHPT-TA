<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPembayaranSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pembayaran_sapi', function (Blueprint $table) {
            $table->string('dbeli_id')->primary();
            $table->string('dbeli_beli');
            $table->string('dbeli_invoice');
            $table->string('dbeli_bukti');
            $table->string('dbeli_sudah');
            $table->string('dbeli_status');
            $table->string('dbeli_keterangan');

            $table->timestamps();

            $table->foreign('dbeli_beli')->references('belisapi_id')->on('master_pengajuan_sapi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_pembayaran_sapi');
    }
}
