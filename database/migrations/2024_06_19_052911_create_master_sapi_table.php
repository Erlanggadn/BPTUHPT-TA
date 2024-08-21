<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterSapiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_sapi', function (Blueprint $table) {
            $table->string('sapi_id', 30)->primary();
            $table->string('sapi_jenis', 50);
            $table->integer('sapi_urutan_lahir');
            $table->date('sapi_tanggal_lahir');
            $table->string('sapi_no_induk', 30);
            $table->string('sapi_keterangan', 255);
            $table->string('sapi_kelamin', 30);
            $table->integer('sapi_umur')->nullable(); 
            $table->string('sapi_status', 30)->nullable(); 
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('sapi_jenis')->references('sjenis_id')->on('master_sapi_jenis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_sapi');
    }
}
