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
            $table->string('dbeli_id', 30)->primary();
            $table->string('belisapi_id', 30);
            $table->string('dbeli_invoice');
            $table->string('dbeli_bukti')->nullable();
            $table->string('dbeli_sudah', 30);
            $table->string('dbeli_status', 30);
            $table->string('dbeli_keterangan', 255);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('belisapi_id')->references('belisapi_id')->on('master_pengajuan_sapi')->onDelete('cascade');
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
