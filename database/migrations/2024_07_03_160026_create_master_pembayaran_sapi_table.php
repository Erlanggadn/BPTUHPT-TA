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
            $table->timestamps();
            $table->string('dbeli_beli');

            $table->foreign('dbeli_beli')->references('detail_id')->on('detail_pengajuan_sapi')->onDelete('cascade');
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
