<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterDetailKandangSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_detail_kandang_sapi', function (Blueprint $table) {
            $table->string('detail_id', 30)->primary();
            $table->string('kegiatan_id', 30);
            $table->string('sapi_id', 30);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('kegiatan_id')->references('kegiatan_id')->on('master_kegiatan_kandang')->onDelete('cascade');
            $table->foreign('sapi_id')->references('sapi_id')->on('master_sapi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_detail_kandang_sapi');
    }
}
