<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBeliSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_beli_sapi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('detailsapi_bayar');
            $table->string('detailsapi_sapi');

            $table->foreign('detailsapi_sapi')->references('sapi_id')->on('master_sapi')->onDelete('cascade');
            $table->foreign('detailsapi_bayar')->references('dbeli_id')->on('master_pembayaran_sapi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_beli_sapi');
    }
}
