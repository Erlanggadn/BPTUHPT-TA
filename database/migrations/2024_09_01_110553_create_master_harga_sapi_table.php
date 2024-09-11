<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterHargaSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_harga_sapi', function (Blueprint $table) {
            $table->string('hs_id', 30)->primary();
            $table->string('sjenis_id', 30);
            $table->string('hs_kelamin', 30);
            $table->string('hs_kategori', 100);
            $table->bigInteger('hs_harga');

            $table->foreign('sjenis_id')->references('sjenis_id')->on('master_sapi_jenis')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_harga_sapi');
    }
}
